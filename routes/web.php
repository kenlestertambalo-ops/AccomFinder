<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerAuthController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SavedPropertyController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

// Student Login Page
Route::get('/student/login', [
    AuthController::class,
    'showLogin'
])->name('student.login');


// Student Login Submit
Route::post('/student/login', [
    AuthController::class,
    'login'
])->name('student.login.post');


// Student Register Page
Route::get('/student/register', [
    StudentRegisterController::class,
    'showRegister'
])->name('student.register');


// Student Register Submit
Route::post('/student/register', [
    StudentRegisterController::class,
    'register'
])->name('student.register.submit');

Route::get('/student/register', [StudentRegisterController::class, 'showRegister'])
    ->name('student.register');

Route::post('/student/register', [StudentRegisterController::class, 'register'])
    ->name('student.register.submit');

Route::get('/student/otp', [StudentRegisterController::class, 'showOtp'])
    ->name('student.otp');

Route::post('/student/otp', [StudentRegisterController::class, 'verifyOtp'])
    ->name('student.otp.verify');


// Student Dashboard
Route::get('/student/dashboard', [
    AccommodationController::class,
    'studentDashboard'
])->name('student.dashboard');


// Student Logout
Route::get('/student/logout', function () {

    session()->forget([
        'student_id',
        'student_name',
        'student_email'
    ]);

    return redirect()
        ->route('student.login')
        ->with('success', 'You have been logged out.');

})->name('student.logout');


/*
|--------------------------------------------------------------------------
| STUDENT SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/student/search', function (\Illuminate\Http\Request $request) {

    $query = \App\Models\Accommodation::query();


    /*
    |--------------------------------------------------------------------------
    | SEARCH BY PROPERTY NAME OR LOCATION
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            $q->where(
                'name',
                'LIKE',
                '%' . $search . '%'
            )
            ->orWhere(
                'address',
                'LIKE',
                '%' . $search . '%'
            );

        });
    }


    /*
    |--------------------------------------------------------------------------
    | PRICE FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->filled('price')) {

        switch ($request->price) {

            case 'Below 2000':

                // Less than ₱2,000
                $query->where(
                    'price',
                    '<',
                    2000
                );

                break;


            case '2000-5000':

                // ₱2,000 to ₱5,000
                $query->whereBetween(
                    'price',
                    [2000, 5000]
                );

                break;


            case 'Above 5000':

                // More than ₱5,000
                $query->where(
                    'price',
                    '>',
                    5000
                );

                break;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PROPERTY TYPE FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->filled('type')) {

        $query->where(
            'type',
            $request->type
        );
    }


    /*
    |--------------------------------------------------------------------------
    | AVAILABILITY FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->filled('availability')) {

        $query->where(
            'status',
            $request->availability
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GET SEARCH RESULTS
    |--------------------------------------------------------------------------
    */

    $listings = $query
        ->latest()
        ->get();


    /*
    |--------------------------------------------------------------------------
    | RETURN SEARCH PAGE
    |--------------------------------------------------------------------------
    */

    return view(
        'student.search',
        compact('listings')
    );

})->name('student.search');


/*
|--------------------------------------------------------------------------
| STUDENT SAVED
|--------------------------------------------------------------------------
*/

// Saved Properties Page
Route::get('/student/saved', [
    SavedPropertyController::class,
    'index'
])->name('student.saved');


// Save Property
Route::post('/student/saved/{id}', [
    SavedPropertyController::class,
    'store'
])->name('student.saved.store');


// Remove Saved Property
Route::delete('/student/saved/{id}', [
    SavedPropertyController::class,
    'destroy'
])->name('student.saved.remove');


/*
|--------------------------------------------------------------------------
| STUDENT MESSAGES
|--------------------------------------------------------------------------
*/

// Student Messages
Route::get('/student/messages', [
    InquiryController::class,
    'studentMessages'
])->name('student.messages');


// Student Reply to Owner
Route::post('/student/messages/{id}/reply', [
    InquiryController::class,
    'studentReply'
])->name('student.messages.reply');


/*
|--------------------------------------------------------------------------
| STUDENT ACCOMMODATION DETAILS
|--------------------------------------------------------------------------
*/

Route::get('/student/accommodation/{id}', [
    AccommodationController::class,
    'show'
])->name('student.accommodation.show');


/*
|--------------------------------------------------------------------------
| OWNER AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Owner Login Page
Route::get('/owner/login', [
    OwnerAuthController::class,
    'showLogin'
])->name('owner.login');


// Owner Login Submit
Route::post('/owner/login', [
    OwnerAuthController::class,
    'login'
])->name('owner.login.post');


// Owner Register Page
Route::get('/owner/register', [
    OwnerAuthController::class,
    'showRegister'
])->name('owner.register');


// Owner Register Submit
Route::post('/owner/register', [
    OwnerAuthController::class,
    'register'
])->name('owner.register.submit');

Route::get('/owner/otp', [OwnerAuthController::class, 'showOtp'])
    ->name('owner.otp');

Route::post('/owner/otp', [OwnerAuthController::class, 'verifyOtp'])
    ->name('owner.otp.verify');


// Owner Logout
Route::get('/owner/logout', function () {

    session()->forget([
        'owner_id',
        'owner_name',
        'owner_email'
    ]);

    return redirect()
        ->route('owner.login')
        ->with('success', 'You have been logged out.');

})->name('owner.logout');


/*
|--------------------------------------------------------------------------
| OWNER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/owner/dashboard', [
    OwnerController::class,
    'dashboard'
])->name('owner.dashboard');


/*
|--------------------------------------------------------------------------
| OWNER LISTINGS
|--------------------------------------------------------------------------
*/

// Owner Listings
Route::get('/owner/listings', [
    OwnerController::class,
    'listings'
])->name('owner.listings');


// Create Listing Page
Route::get('/owner/listings/create', [
    AccommodationController::class,
    'create'
])->name('owner.listings.create');


// Store Listing
Route::post('/owner/listings/store', [
    AccommodationController::class,
    'store'
])->name('owner.listings.store');


// Edit Listing
Route::get('/owner/listings/{id}/edit', [
    OwnerController::class,
    'editListing'
])->name('owner.listings.edit');


// Update Listing
Route::put('/owner/listings/{id}', [
    OwnerController::class,
    'updateListing'
])->name('owner.listings.update');


// Delete Listing
Route::delete('/owner/listings/{id}', [
    OwnerController::class,
    'deleteListing'
])->name('owner.listings.delete');


/*
|--------------------------------------------------------------------------
| OWNER TENANTS
|--------------------------------------------------------------------------
*/

// Tenant Records
Route::get('/owner/tenants', [
    OwnerController::class,
    'tenants'
])->name('owner.tenants');


// Add Tenant
Route::post('/owner/tenants', [
    OwnerController::class,
    'storeTenant'
])->name('owner.tenants.store');


// Edit Tenant
Route::get('/owner/tenants/{id}/edit', [
    OwnerController::class,
    'editTenant'
])->name('owner.tenants.edit');

// Update Tenant
Route::put('/owner/tenants/{id}', [
    OwnerController::class,
    'updateTenant'
])->name('owner.tenants.update');


// Delete Tenant
Route::delete('/owner/tenants/{id}', [
    OwnerController::class,
    'deleteTenant'
])->name('owner.tenants.delete');

/*
|--------------------------------------------------------------------------
| OWNER PAYMENTS
|--------------------------------------------------------------------------
*/

// Owner Payments
Route::get('/owner/payments', [
    PaymentController::class,
    'index'
])->name('owner.payments');


// Save Payment
Route::post('/owner/payments', [
    PaymentController::class,
    'store'
])->name('owner.payments.store');

// Edit Payment
Route::get('/owner/payments/{id}/edit', [
    PaymentController::class,
    'edit'
])->name('owner.payments.edit');

// Update Payment
Route::put('/owner/payments/{id}', [
    PaymentController::class,
    'update'
])->name('owner.payments.update');

// Delete Payment
Route::delete('/owner/payments/{id}', [
    PaymentController::class,
    'destroy'
])->name('owner.payments.delete');

/*
|--------------------------------------------------------------------------
| OWNER REPORTS
|--------------------------------------------------------------------------
*/

Route::get(
    '/owner/reports',
    [OwnerController::class, 'reports']
)->name('owner.reports');

/*
|--------------------------------------------------------------------------
| OWNER MESSAGES
|--------------------------------------------------------------------------
*/

// Owner Messages
Route::get('/owner/messages', [
    InquiryController::class,
    'ownerMessages'
])->name('owner.messages');


// Owner Reply to Student
Route::post('/owner/messages/{id}/reply', [
    InquiryController::class,
    'reply'
])->name('owner.messages.reply');


/*
|--------------------------------------------------------------------------
| STUDENT INQUIRIES
|--------------------------------------------------------------------------
*/

// Student sends initial inquiry
Route::post('/student/inquiry/{id}', [
    InquiryController::class,
    'store'
])->name('student.inquiry.store');
