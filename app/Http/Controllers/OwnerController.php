<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Accommodation;
use App\Models\Inquiry;
use App\Models\Payment;
use App\Models\Tenant;
use App\Models\Room;

class OwnerController extends Controller
{
    private function checkOwner()
    {
        if (!session('owner_id')) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | SYNCHRONIZE ROOM OCCUPANCY
    |--------------------------------------------------------------------------
    */

    private function syncRoomOccupancy($roomId)
    {
        if (!$roomId) {
            return;
        }

        $room = Room::find($roomId);

        if (!$room) {
            return;
        }

        $activeTenants = Tenant::where('room_id', $room->id)
            ->where('status', 'Active')
            ->count();

        $capacity = (int) $room->capacity;

        $room->current_occupants = $activeTenants;

        if ($room->status !== 'Maintenance') {
            $room->status = $activeTenants >= $capacity
                ? 'Occupied'
                : 'Available';
        }

        $room->save();
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK ROOM CAPACITY
    |--------------------------------------------------------------------------
    */

    private function checkRoomCapacity($room, $tenantId = null)
    {
        $query = Tenant::where('room_id', $room->id)
            ->where('status', 'Active');

        if ($tenantId) {
            $query->where('id', '!=', $tenantId);
        }

        $activeTenants = $query->count();

        if ($activeTenants >= (int) $room->capacity) {
            throw ValidationException::withMessages([
                'room_id' => 'This room has reached its maximum capacity of '
                    . $room->capacity . ' occupants. Please select another room.',
            ]);
        }

        if ($room->status === 'Maintenance') {
            throw ValidationException::withMessages([
                'room_id' => 'This room is currently under maintenance and cannot accept tenants.',
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $ownerId = session('owner_id');

        $totalProperties = Accommodation::where('owner_id', $ownerId)->count();

        $activeTenants = Tenant::where('owner_id', $ownerId)
            ->where('status', 'Active')
            ->count();

        $monthlyRevenue = Payment::where('owner_id', $ownerId)
            ->sum('amount');

        $unreadMessages = Inquiry::where('owner_id', $ownerId)
            ->where('status', 'Unread')
            ->count();

        $tenants = Tenant::where('owner_id', $ownerId)
            ->latest()
            ->take(5)
            ->get();

        $listings = Accommodation::where('owner_id', $ownerId)
            ->with('roomRecords')
            ->latest()
            ->get();

        return view('owner.dashboard', compact(
            'totalProperties',
            'activeTenants',
            'monthlyRevenue',
            'unreadMessages',
            'tenants',
            'listings'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | LISTINGS
    |--------------------------------------------------------------------------
    */

    public function listings()
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $listings = Accommodation::where('owner_id', session('owner_id'))
            ->with('roomRecords')
            ->latest()
            ->get();

        return view('owner.listings', compact('listings'));
    }

    public function editListing($id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $listing = Accommodation::where('owner_id', session('owner_id'))
            ->with('roomRecords')
            ->findOrFail($id);

        return view('owner.listing-edit', compact('listing'));
    }

    public function updateListing(Request $request, $id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $listing = Accommodation::where('owner_id', session('owner_id'))
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Full,Unavailable',
            'description' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $listing->update($validated);

        return redirect()->route('owner.listings.edit', $listing->id)
            ->with('success', 'Listing updated successfully!');
    }

    public function deleteListing($id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $listing = Accommodation::where('owner_id', session('owner_id'))
            ->findOrFail($id);

        $listing->delete();

        return redirect()->route('owner.listings')
            ->with('success', 'Listing deleted successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | TENANT PROPERTY SELECTION
    |--------------------------------------------------------------------------
    */

    public function tenants()
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $properties = Accommodation::where('owner_id', session('owner_id'))
            ->withCount('roomRecords')
            ->latest()
            ->get();

        return view('owner.tenants', compact('properties'));
    }

    /*
    |--------------------------------------------------------------------------
    | TENANT ROOM SELECTION
    |--------------------------------------------------------------------------
    */

    public function tenantRooms($accommodation)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $property = Accommodation::where('owner_id', session('owner_id'))
            ->findOrFail($accommodation);

        $rooms = Room::where('accommodation_id', $property->id)
            ->withCount([
                'tenants',
                'tenants as active_tenants_count' => function ($query) {
                    $query->where('status', 'Active');
                },
            ])
            ->orderBy('room_name')
            ->get();

        foreach ($rooms as $room) {
            $this->syncRoomOccupancy($room->id);
            $room->refresh();
        }

        return view('owner.tenant-rooms', compact(
            'property',
            'rooms'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | TENANTS ASSIGNED TO A ROOM
    |--------------------------------------------------------------------------
    */

    public function roomTenants($accommodation, $room)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $property = Accommodation::where('owner_id', session('owner_id'))
            ->findOrFail($accommodation);

        $roomRecord = Room::where('accommodation_id', $property->id)
            ->findOrFail($room);

        $this->syncRoomOccupancy($roomRecord->id);

        $roomRecord->refresh();

        $tenants = Tenant::where('owner_id', session('owner_id'))
            ->where('accommodation_id', $property->id)
            ->where('room_id', $roomRecord->id)
            ->latest()
            ->get();

        $assignedLedgerTenant = $tenants->firstWhere(
            'id',
            (int) ($roomRecord->ledger_tenant_id ?? 0)
        );

        return view('owner.room-tenants', compact(
            'property',
            'roomRecord',
            'tenants',
            'assignedLedgerTenant'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | ASSIGN RENTAL LEDGER ACCESS
    |--------------------------------------------------------------------------
    */

    public function assignLedgerAccess(Request $request, $accommodation, $room)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $validated = $request->validate([
            'tenant_id' => 'required|integer',
        ]);

        $property = Accommodation::where('owner_id', session('owner_id'))
            ->findOrFail($accommodation);

        $roomRecord = Room::where('accommodation_id', $property->id)
            ->findOrFail($room);

        $tenant = Tenant::where('owner_id', session('owner_id'))
            ->where('accommodation_id', $property->id)
            ->where('room_id', $roomRecord->id)
            ->where('status', 'Active')
            ->findOrFail($validated['tenant_id']);

        $roomRecord->ledger_tenant_id = $tenant->id;
        $roomRecord->save();

        return redirect()->route('owner.tenants.room', [
            'accommodation' => $property->id,
            'room' => $roomRecord->id,
        ])->with('success', $tenant->name . ' has been assigned to view this room rental ledger.');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE TENANT
    |--------------------------------------------------------------------------
    */

    public function storeTenant(Request $request)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $ownerId = session('owner_id');

        $validated = $request->validate([
            'accommodation_id' => 'required|integer|exists:accommodations,id',
            'room_id' => 'required|integer|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'property_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'due_day' => 'required|integer|min:1|max:31',
            'status' => 'required|in:Active,Inactive',
        ]);

        $property = Accommodation::where('owner_id', $ownerId)
            ->findOrFail($validated['accommodation_id']);

        $room = Room::where('accommodation_id', $property->id)
            ->findOrFail($validated['room_id']);

        DB::transaction(function () use (
            $validated,
            $ownerId,
            $property,
            $room
        ) {
            if ($validated['status'] === 'Active') {
                $this->checkRoomCapacity($room);
            }

            Tenant::create([
                'owner_id' => $ownerId,
                'accommodation_id' => $property->id,
                'room_id' => $room->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'property_type' => $validated['property_type'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'] ?? null,
                'monthly_rent' => $validated['monthly_rent'],
                'due_day' => $validated['due_day'],
                'status' => $validated['status'],
            ]);

            $this->syncRoomOccupancy($room->id);
        });

        return redirect()
            ->route('owner.tenants.room', [
                'accommodation' => $property->id,
                'room' => $room->id,
            ])
            ->with('success', 'Tenant added successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT TENANT
    |--------------------------------------------------------------------------
    */

    public function editTenant($id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $tenant = Tenant::where('owner_id', session('owner_id'))
            ->findOrFail($id);

        return view('owner.tenant-edit', compact('tenant'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE TENANT
    |--------------------------------------------------------------------------
    */

    public function updateTenant(Request $request, $id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $ownerId = session('owner_id');

        $tenant = Tenant::where('owner_id', $ownerId)
            ->findOrFail($id);

        $validated = $request->validate([
            'accommodation_id' => 'required|integer|exists:accommodations,id',
            'room_id' => 'required|integer|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'property_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'due_day' => 'required|integer|min:1|max:31',
            'status' => 'required|in:Active,Inactive',
        ]);

        $property = Accommodation::where('owner_id', $ownerId)
            ->findOrFail($validated['accommodation_id']);

        $room = Room::where('accommodation_id', $property->id)
            ->findOrFail($validated['room_id']);

        $oldRoomId = $tenant->room_id;

        DB::transaction(function () use (
            $tenant,
            $validated,
            $property,
            $room,
            $id
        ) {
            if ($validated['status'] === 'Active') {
                $this->checkRoomCapacity($room, $id);
            }

            $tenant->update([
                'accommodation_id' => $property->id,
                'room_id' => $room->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'property_type' => $validated['property_type'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'] ?? null,
                'monthly_rent' => $validated['monthly_rent'],
                'due_day' => $validated['due_day'],
                'status' => $validated['status'],
            ]);

            $this->syncRoomOccupancy($room->id);
        });

        if ($oldRoomId && (int) $oldRoomId !== (int) $room->id) {
            $this->syncRoomOccupancy($oldRoomId);
        }

        return redirect()
            ->route('owner.tenants.room', [
                'accommodation' => $property->id,
                'room' => $room->id,
            ])
            ->with('success', 'Tenant updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE TENANT
    |--------------------------------------------------------------------------
    */

    public function deleteTenant($id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $tenant = Tenant::where('owner_id', session('owner_id'))
            ->findOrFail($id);

        $propertyId = $tenant->accommodation_id;
        $roomId = $tenant->room_id;

        DB::transaction(function () use ($tenant, $roomId) {
            $tenant->delete();

            if ($roomId) {
                $this->syncRoomOccupancy($roomId);
            }
        });

        if ($propertyId && $roomId) {
            return redirect()->route('owner.tenants.room', [
                'accommodation' => $propertyId,
                'room' => $roomId,
            ])->with('success', 'Tenant deleted successfully!');
        }

        return redirect()->route('owner.tenants')
            ->with('success', 'Tenant deleted successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | TENANT STATEMENT OF ACCOUNT
    |--------------------------------------------------------------------------
    */

    public function tenantStatement($id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $tenant = Tenant::where('owner_id', session('owner_id'))
            ->with(['accommodation', 'room', 'payments'])
            ->findOrFail($id);

        if (!$tenant->start_date) {
            return redirect()->route('owner.tenants')
                ->with('error', 'Tenant rental start date is missing.');
        }

        $start = Carbon::parse($tenant->start_date)->startOfMonth();

        $end = $tenant->end_date
            ? Carbon::parse($tenant->end_date)->startOfMonth()
            : Carbon::now()->startOfMonth();

        $monthlyRent = (float) $tenant->monthly_rent;
        $dueDay = min(max((int) ($tenant->due_day ?? 5), 1), 31);

        $paymentsByMonth = $tenant->payments
            ->filter(function ($payment) {
                return strtolower($payment->status ?? '') === 'paid'
                    && $payment->billing_month;
            })
            ->groupBy(function ($payment) {
                return Carbon::parse($payment->billing_month)->format('Y-m');
            });

        $ledger = collect();

        for ($month = $start->copy(); $month->lte($end); $month->addMonth()) {
            $billingMonth = $month->format('Y-m');
            $monthPayments = $paymentsByMonth->get($billingMonth, collect());

            $amountPaid = (float) $monthPayments->sum('amount');
            $balance = max(0, $monthlyRent - $amountPaid);

            $dueDate = $month->copy()->day(
                min($dueDay, $month->daysInMonth)
            );

            if ($balance <= 0) {
                $status = 'Paid';
            } elseif ($amountPaid > 0) {
                $status = 'Partially Paid';
            } elseif ($dueDate->lt(now()->startOfDay())) {
                $status = 'Overdue';
            } elseif ($dueDate->gt(now()->startOfDay())) {
                $status = 'Upcoming';
            } else {
                $status = 'Unpaid';
            }

            $ledger->push([
                'billing_month' => $month->copy(),
                'due_date' => $dueDate,
                'rent' => $monthlyRent,
                'paid' => $amountPaid,
                'balance' => $balance,
                'status' => $status,
                'payments' => $monthPayments->sortBy('payment_date'),
            ]);
        }

        $totalCharges = (float) $ledger->sum('rent');
        $totalPaid = (float) $ledger->sum('paid');
        $totalBalance = (float) $ledger->sum('balance');

        return view('owner.tenant-statement', compact(
            'tenant',
            'ledger',
            'totalCharges',
            'totalPaid',
            'totalBalance'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | TENANT RENTAL LEDGER
    |--------------------------------------------------------------------------
    */

    public function tenantLedger($id)
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        return $this->tenantStatement($id);
    }

    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    public function reports()
    {
        if ($redirect = $this->checkOwner()) {
            return $redirect;
        }

        $ownerId = session('owner_id');

        $totalRevenue = Payment::where('owner_id', $ownerId)
            ->where('status', 'Paid')
            ->sum('amount');

        $pendingRevenue = Payment::where('owner_id', $ownerId)
            ->where('status', 'Pending')
            ->sum('amount');

        $upcomingPayments = Payment::where('owner_id', $ownerId)
            ->where('status', 'Pending')
            ->whereDate('payment_date', '>=', now()->toDateString())
            ->sum('amount');

        $totalExpected = (float) $totalRevenue + (float) $pendingRevenue;

        $collectionRate = $totalExpected > 0
            ? ((float) $totalRevenue / $totalExpected) * 100
            : 0;

        $monthlyRevenue = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyRevenue[] = (float) Payment::where('owner_id', $ownerId)
                ->where('status', 'Paid')
                ->whereYear('payment_date', now()->year)
                ->whereMonth('payment_date', $month)
                ->sum('amount');
        }

        $monthlyLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
        ];

        $pendingPayments = Payment::where('owner_id', $ownerId)
            ->where('status', 'Pending')
            ->count();

        return view('owner.reports', compact(
            'totalRevenue',
            'pendingRevenue',
            'upcomingPayments',
            'collectionRate',
            'monthlyRevenue',
            'monthlyLabels',
            'pendingPayments'
        ));
    }
}
