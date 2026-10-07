<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $totalProperties = Accommodation::where(
            'owner_id',
            $ownerId
        )->count();


        $activeTenants = Tenant::where(
            'owner_id',
            $ownerId
        )
        ->where(
            'status',
            'Active'
        )
        ->count();


        $monthlyRevenue = Payment::where(
            'owner_id',
            $ownerId
        )->sum('amount');


        $unreadMessages = Inquiry::where(
            'owner_id',
            $ownerId
        )
        ->where(
            'status',
            'Unread'
        )
        ->count();


        $tenants = Tenant::where(
            'owner_id',
            $ownerId
        )
        ->latest()
        ->take(5)
        ->get();


        $listings = Accommodation::where(
            'owner_id',
            $ownerId
        )
        ->latest()
        ->get();


        return view(
            'owner.dashboard',
            compact(
                'totalProperties',
                'activeTenants',
                'monthlyRevenue',
                'unreadMessages',
                'tenants',
                'listings'
            )
        );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $listings = Accommodation::where(
            'owner_id',
            $ownerId
        )
        ->latest()
        ->get();


        return view(
            'owner.listings',
            compact('listings')
        );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $listing = Accommodation::where(
            'owner_id',
            $ownerId
        )
        ->findOrFail($id);


        return view(
            'owner.listing-edit',
            compact('listing')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE LISTING
    |--------------------------------------------------------------------------
    */

    public function updateListing(
        Request $request,
        $id
    ) {

        $ownerId = session('owner_id');

        if (!$ownerId) {

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $listing = Accommodation::where(
            'owner_id',
            $ownerId
        )
        ->findOrFail($id);


        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'required',
                'string',
                'max:255'
            ],

            'price' => [
                'required',
                'numeric'
            ],

            'status' => [
                'required',
                'string'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'latitude' => [
                'nullable',
                'numeric'
            ],

            'longitude' => [
                'nullable',
                'numeric'
            ],

        ]);


        $listing->update([

            'name' => $request->name,

            'address' => $request->address,

            'price' => $request->price,

            'status' => $request->status,

            'description' => $request->description,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

        ]);


        return redirect()
            ->route('owner.listings')
            ->with(
                'success',
                'Listing updated successfully!'
            );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $listing = Accommodation::where(
            'owner_id',
            $ownerId
        )
        ->findOrFail($id);


        $listing->delete();


        return redirect()
            ->route('owner.listings')
            ->with(
                'success',
                'Listing deleted successfully!'
            );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $tenants = Tenant::where(
            'owner_id',
            $ownerId
        )
        ->latest()
        ->get();


        return view(
            'owner.tenants',
            compact('tenants')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | STORE TENANT
    |--------------------------------------------------------------------------
    */

    public function storeTenant(
        Request $request
    ) {

        $ownerId = session('owner_id');

        if (!$ownerId) {

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255'
            ],

            'phone' => [
                'required',
                'string',
                'max:30'
            ],

            'property_type' => [
                'required',
                'string',
                'max:100'
            ],

            'start_date' => [
                'required',
                'date'
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],

            'monthly_rent' => [
                'required',
                'numeric',
                'min:0'
            ],

            'status' => [
                'required',
                'string',
                'in:Active,Inactive'
            ],

        ]);


        Tenant::create([

            'owner_id' => $ownerId,

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'property_type' => $request->property_type,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'monthly_rent' => $request->monthly_rent,

            'status' => $request->status,

        ]);


        return redirect()
            ->route('owner.tenants')
            ->with(
                'success',
                'Tenant added successfully!'
            );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $tenant = Tenant::where(
            'owner_id',
            $ownerId
        )
        ->findOrFail($id);


        return view(
            'owner.tenant-edit',
            compact('tenant')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE TENANT
    |--------------------------------------------------------------------------
    */

    public function updateTenant(
        Request $request,
        $id
    ) {

        $ownerId = session('owner_id');

        if (!$ownerId) {

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $tenant = Tenant::where(
            'owner_id',
            $ownerId
        )
        ->findOrFail($id);


        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255'
            ],

            'phone' => [
                'required',
                'string',
                'max:30'
            ],

            'property_type' => [
                'required',
                'string',
                'max:100'
            ],

            'start_date' => [
                'required',
                'date'
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],

            'monthly_rent' => [
                'required',
                'numeric',
                'min:0'
            ],

            'status' => [
                'required',
                'string',
                'in:Active,Inactive'
            ],

        ]);


        $tenant->update([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'property_type' => $request->property_type,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'monthly_rent' => $request->monthly_rent,

            'status' => $request->status,

        ]);


        return redirect()
            ->route('owner.tenants')
            ->with(
                'success',
                'Tenant updated successfully!'
            );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        $tenant = Tenant::where(
            'owner_id',
            $ownerId
        )
        ->findOrFail($id);


        $tenant->delete();


        return redirect()
            ->route('owner.tenants')
            ->with(
                'success',
                'Tenant deleted successfully!'
            );
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

            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL REVENUE
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Payment::where(
            'owner_id',
            $ownerId
        )
        ->where(
            'status',
            'Paid'
        )
        ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | PENDING PAYMENTS
        |--------------------------------------------------------------------------
        */

        $pendingRevenue = Payment::where(
            'owner_id',
            $ownerId
        )
        ->where(
            'status',
            'Pending'
        )
        ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | UPCOMING PAYMENTS
        |--------------------------------------------------------------------------
        */

        $upcomingPayments = Payment::where(
            'owner_id',
            $ownerId
        )
        ->where(
            'status',
            'Pending'
        )
        ->whereDate(
            'payment_date',
            '>=',
            now()->toDateString()
        )
        ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | COLLECTION RATE
        |--------------------------------------------------------------------------
        */

        $totalExpected =
            (float) $totalRevenue +
            (float) $pendingRevenue;


        if ($totalExpected > 0) {

            $collectionRate =
                (
                    (float) $totalRevenue /
                    $totalExpected
                ) * 100;

        } else {

            $collectionRate = 0;

        }


        /*
        |--------------------------------------------------------------------------
        | MONTHLY REVENUE
        |--------------------------------------------------------------------------
        */

        $monthlyRevenue = [];


        for (
            $month = 1;
            $month <= 12;
            $month++
        ) {

            $monthlyRevenue[] =
                (float) Payment::where(
                    'owner_id',
                    $ownerId
                )
                ->where(
                    'status',
                    'Paid'
                )
                ->whereYear(
                    'payment_date',
                    now()->year
                )
                ->whereMonth(
                    'payment_date',
                    $month
                )
                ->sum('amount');

        }


        /*
        |--------------------------------------------------------------------------
        | MONTH LABELS
        |--------------------------------------------------------------------------
        */

        $monthlyLabels = [

            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec',

        ];


        /*
        |--------------------------------------------------------------------------
        | PENDING COUNT
        |--------------------------------------------------------------------------
        */

        $pendingPayments = Payment::where(
            'owner_id',
            $ownerId
        )
        ->where(
            'status',
            'Pending'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | REPORT VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'owner.reports',
            compact(

                'totalRevenue',

                'pendingRevenue',

                'upcomingPayments',

                'collectionRate',

                'monthlyRevenue',

                'monthlyLabels',

                'pendingPayments'

            )
        );
    }

}
