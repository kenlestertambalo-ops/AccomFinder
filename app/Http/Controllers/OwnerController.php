<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Accommodation;
use App\Models\Inquiry;
use App\Models\Payment;
use App\Models\Tenant;

class OwnerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OWNER DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

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
    | OWNER LISTINGS
    |--------------------------------------------------------------------------
    */

    public function listings()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $listings = Accommodation::where('owner_id', $ownerId)
            ->latest()
            ->get();

        return view('owner.listings', compact('listings'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT LISTING
    |--------------------------------------------------------------------------
    */

    public function editListing($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $listing = Accommodation::where('owner_id', $ownerId)
            ->with('roomRecords')
            ->findOrFail($id);

        return view('owner.listing-edit', compact('listing'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE LISTING
    |--------------------------------------------------------------------------
    */

    public function updateListing(Request $request, $id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $listing = Accommodation::where('owner_id', $ownerId)
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

    /*
    |--------------------------------------------------------------------------
    | DELETE LISTING
    |--------------------------------------------------------------------------
    */

    public function deleteListing($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $listing = Accommodation::where('owner_id', $ownerId)
            ->findOrFail($id);

        $listing->delete();

        return redirect()->route('owner.listings')
            ->with('success', 'Listing deleted successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | TENANTS
    |--------------------------------------------------------------------------
    */

    public function tenants()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $tenants = Tenant::where('owner_id', $ownerId)
            ->latest()
            ->get();

        return view('owner.tenants', compact('tenants'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE TENANT
    |--------------------------------------------------------------------------
    */

    public function storeTenant(Request $request)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'property_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'due_day' => 'required|integer|min:1|max:31',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        Tenant::create([
            'owner_id' => $ownerId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'property_type' => $validated['property_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'monthly_rent' => $validated['monthly_rent'],
            'due_day' => $validated['due_day'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('owner.tenants')
            ->with('success', 'Tenant added successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT TENANT
    |--------------------------------------------------------------------------
    */

    public function editTenant($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $tenant = Tenant::where('owner_id', $ownerId)
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
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $tenant = Tenant::where('owner_id', $ownerId)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'property_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'due_day' => 'required|integer|min:1|max:31',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        $tenant->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'property_type' => $validated['property_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'monthly_rent' => $validated['monthly_rent'],
            'due_day' => $validated['due_day'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('owner.tenants')
            ->with('success', 'Tenant updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE TENANT
    |--------------------------------------------------------------------------
    */

    public function deleteTenant($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $tenant = Tenant::where('owner_id', $ownerId)
            ->findOrFail($id);

        $tenant->delete();

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
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $tenant = Tenant::where('owner_id', $ownerId)
            ->with(['accommodation', 'payments'])
            ->findOrFail($id);

        if (!$tenant->start_date || !$tenant->end_date) {
            return redirect()->route('owner.tenants')
                ->with('error', 'Tenant rental dates are incomplete.');
        }

        $start = Carbon::parse($tenant->start_date)->startOfMonth();
        $end = Carbon::parse($tenant->end_date)->startOfMonth();

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
    | REPORTS
    |--------------------------------------------------------------------------
    */

    public function reports()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

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
