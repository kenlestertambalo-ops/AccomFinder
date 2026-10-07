<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\Student;
use App\Models\Inquiry;
use App\Models\Owner;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        return redirect()->route('admin.dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalListings = Accommodation::count();

        $totalStudents = Student::count();

        $totalInquiries = Inquiry::count();

        $totalOwners = Owner::count();

        return view('admin.dashboard', compact(
            'totalListings',
            'totalStudents',
            'totalInquiries',
            'totalOwners'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE LISTINGS PAGE
    |--------------------------------------------------------------------------
    */

    public function listings()
    {
        /*
        | Only listings waiting for admin decision
        | are shown here.
        */

        $listings = Accommodation::where(
            'approval_status',
            'pending'
        )
        ->latest()
        ->get();

        return view(
            'admin.listings',
            compact('listings')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE LISTING
    |--------------------------------------------------------------------------
    */

    public function approveListing($id)
    {
        $listing = Accommodation::findOrFail($id);

        /*
        | Only change the listing when
        | the ADMIN clicks Approve.
        */

        $listing->approval_status = 'approved';
        $listing->save();

        return redirect()
            ->route('admin.listings')
            ->with(
                'success',
                'Listing approved successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DECLINE LISTING
    |--------------------------------------------------------------------------
    */

    public function declineListing($id)
    {
        $listing = Accommodation::findOrFail($id);

        /*
        | Only change the listing when
        | the ADMIN clicks Decline.
        */

        $listing->approval_status = 'declined';
        $listing->save();

        return redirect()
            ->route('admin.listings')
            ->with(
                'success',
                'Listing declined successfully.'
            );
    }
}
