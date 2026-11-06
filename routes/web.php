
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
| STUDENT AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/student/login', [
    AuthController::class,
    'showLogin'
])->name('student.login');

Route::post('/student/login', [
    AuthController::class,
    'login'
])->name('student.login.post');

Route::get('/student/register', [
    StudentRegisterController::class,
    'showRegister'
])->name('student.register');

Route::post('/student/register', [
    StudentRegisterController::class,
    'register'
])->name('student.register.submit');

Route::get('/student/otp', [
    StudentRegisterController::class,
    'showOtp'
])->name('student.otp');

Route::post('/student/otp', [
    StudentRegisterController::class,
    'verifyOtp'
])->name('student.otp.verify');


/*
|--------------------------------------------------------------------------
| STUDENT FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get('/student/forgot-password', [
    AuthController::class,
    'showForgotPassword'
])->name('student.password.request');

Route::post('/student/forgot-password', [
    AuthController::class,
    'sendResetLink'
])->name('student.password.email');

Route::get('/student/verify-reset-otp', [
    AuthController::class,
    'showResetOtp'
])->name('student.password.otp');

Route::post('/student/verify-reset-otp', [
    AuthController::class,
    'verifyResetOtp'
])->name('student.password.otp.verify');

Route::get('/student/reset-password/{token}', [
    AuthController::class,
    'showResetPassword'
])->name('student.password.reset');

Route::post('/student/reset-password', [
    AuthController::class,
    'resetPassword'
])->name('student.password.update');


/*
|--------------------------------------------------------------------------
| STUDENT DASHBOARD AND LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/student/dashboard', [
    AccommodationController::class,
    'studentDashboard'
])->name('student.dashboard');

Route::get('/student/logout', function () {
    session()->forget([
        'student_id',
        'student_name',
        'student_email',
        'login_lockout_email',
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

    // Search by accommodation name or address
    if ($request->filled('search')) {
        $search = trim($request->input('search'));

        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('address', 'LIKE', '%' . $search . '%');
        });
    }

    // Filter by price
    if ($request->filled('price')) {
        switch ($request->input('price')) {

            case 'Below 2000':
                $query->where('price', '<', 2000);
                break;

            case '2000-5000':
                $query->whereBetween('price', [2000, 5000]);
                break;

            case 'Above 5000':
                $query->where('price', '>', 5000);
                break;
        }
    }

    // Filter by accommodation type
    if (
        $request->filled('type') &&
        $request->input('type') !== 'All Types'
    ) {
        $query->where('type', $request->input('type'));
    }

    // No approval status required.
    // Show only accommodations marked Available.
    $query->where('status', 'Available');

    $listings = $query->latest()->get();

    return view('student.search', compact('listings'));

})->name('student.search');


/*
|--------------------------------------------------------------------------
| STUDENT SAVED PROPERTIES
|--------------------------------------------------------------------------
*/

Route::get('/student/saved', [
    SavedPropertyController::class,
    'index'
])->name('student.saved');

Route::post('/student/saved/{id}', [
    SavedPropertyController::class,
    'store'
])->name('student.saved.store');

Route::delete('/student/saved/{id}', [
    SavedPropertyController::class,
    'destroy'
])->name('student.saved.remove');


/*
|--------------------------------------------------------------------------
| STUDENT MESSAGES
|--------------------------------------------------------------------------
*/

Route::get('/student/messages', [
    InquiryController::class,
    'studentMessages'
])->name('student.messages');

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
| STUDENT INQUIRIES
|--------------------------------------------------------------------------
*/

Route::post('/student/inquiry/{id}', [
    InquiryController::class,
    'store'
])->name('student.inquiry.store');


/*
|--------------------------------------------------------------------------
| OWNER AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/owner/login', [
    OwnerAuthController::class,
    'showLogin'
])->name('owner.login');

Route::post('/owner/login', [
    OwnerAuthController::class,
    'login'
])->name('owner.login.post');

Route::get('/owner/register', [
    OwnerAuthController::class,
    'showRegister'
])->name('owner.register');

Route::post('/owner/register', [
    OwnerAuthController::class,
    'register'
])->name('owner.register.submit');

Route::get('/owner/otp', [
    OwnerAuthController::class,
    'showOtp'
])->name('owner.otp');

Route::post('/owner/otp', [
    OwnerAuthController::class,
    'verifyOtp'
])->name('owner.otp.verify');


/*
|--------------------------------------------------------------------------
| OWNER FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get('/owner/forgot-password', [
    OwnerAuthController::class,
    'showForgotPassword'
])->name('owner.password.request');

Route::post('/owner/forgot-password', [
    OwnerAuthController::class,
    'sendResetLink'
])->name('owner.password.email');

Route::get('/owner/verify-reset-otp', [
    OwnerAuthController::class,
    'showResetOtp'
])->name('owner.password.otp');

Route::post('/owner/verify-reset-otp', [
    OwnerAuthController::class,
    'verifyResetOtp'
])->name('owner.password.otp.verify');

Route::get('/owner/reset-password/{token}', [
    OwnerAuthController::class,
    'showResetPassword'
])->name('owner.password.reset');

Route::post('/owner/reset-password', [
    OwnerAuthController::class,
    'resetPassword'
])->name('owner.password.update');


/*
|--------------------------------------------------------------------------
| OWNER LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/owner/logout', function () {
    session()->forget([
        'owner_id',
        'owner_name',
        'owner_email',
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

Route::get('/owner/listings', [
    OwnerController::class,
    'listings'
])->name('owner.listings');

Route::get('/owner/listings/create', [
    AccommodationController::class,
    'create'
])->name('owner.listings.create');

Route::post('/owner/listings/store', [
    AccommodationController::class,
    'store'
])->name('owner.listings.store');

Route::get('/owner/listings/{id}/edit', [
    OwnerController::class,
    'editListing'
])->name('owner.listings.edit');

Route::put('/owner/listings/{id}', [
    OwnerController::class,
    'updateListing'
])->name('owner.listings.update');

Route::delete('/owner/listings/{id}', [
    OwnerController::class,
    'deleteListing'
])->name('owner.listings.delete');


/*
|--------------------------------------------------------------------------
| OWNER TENANTS
|--------------------------------------------------------------------------
*/

Route::get('/owner/tenants', [
    OwnerController::class,
    'tenants'
])->name('owner.tenants');

Route::post('/owner/tenants', [
    OwnerController::class,
    'storeTenant'
])->name('owner.tenants.store');

Route::get('/owner/tenants/{id}/edit', [
    OwnerController::class,
    'editTenant'
])->name('owner.tenants.edit');

Route::put('/owner/tenants/{id}', [
    OwnerController::class,
    'updateTenant'
])->name('owner.tenants.update');

Route::delete('/owner/tenants/{id}', [
    OwnerController::class,
    'deleteTenant'
])->name('owner.tenants.delete');


/*
|--------------------------------------------------------------------------
| OWNER PAYMENTS
|--------------------------------------------------------------------------
*/

Route::get('/owner/payments', [
    PaymentController::class,
    'index'
])->name('owner.payments');

Route::post('/owner/payments', [
    PaymentController::class,
    'store'
])->name('owner.payments.store');

Route::get('/owner/payments/{id}/edit', [
    PaymentController::class,
    'edit'
])->name('owner.payments.edit');

Route::put('/owner/payments/{id}', [
    PaymentController::class,
    'update'
])->name('owner.payments.update');

Route::delete('/owner/payments/{id}', [
    PaymentController::class,
    'destroy'
])->name('owner.payments.delete');


/*
|--------------------------------------------------------------------------
| OWNER REPORTS
|--------------------------------------------------------------------------
*/

Route::get('/owner/reports', [
    OwnerController::class,
    'reports'
])->name('owner.reports');


/*
|--------------------------------------------------------------------------
| OWNER MESSAGES
|--------------------------------------------------------------------------
*/

Route::get('/owner/messages', [
    InquiryController::class,
    'ownerMessages'
])->name('owner.messages');

Route::post('/owner/messages/{id}/reply', [
    InquiryController::class,
    'reply'
])->name('owner.messages.reply');

Route::get('/session-test', function () {
    session(['session_test' => 'AccomFinder is working']);

    return response('Session test successful')
        ->withHeaders([
            'X-Session-Test' => session('session_test'),
        ]);
});
