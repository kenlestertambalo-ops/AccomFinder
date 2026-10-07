<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Owner;

class OwnerAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OWNER LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('owner.login');
    }


    /*
    |--------------------------------------------------------------------------
    | OWNER LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $owner = Owner::where(
            'email',
            $request->email
        )->first();


        /*
        |--------------------------------------------------------------------------
        | CHECK OWNER
        |--------------------------------------------------------------------------
        */

        if (!$owner) {

            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Invalid email or password.');
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK PASSWORD
        |--------------------------------------------------------------------------
        */

        if (!Hash::check($request->password, $owner->password)) {

            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Invalid email or password.');
        }


        /*
        |--------------------------------------------------------------------------
        | SAVE OWNER SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'owner_id' => $owner->id,
            'owner_name' => $owner->name,
            'owner_email' => $owner->email,
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO OWNER DASHBOARD
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('owner.dashboard')
            ->with(
                'success',
                'Welcome back, ' . $owner->name . '!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | OWNER REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('owner.register');
    }


    /*
    |--------------------------------------------------------------------------
    | OWNER REGISTER
    |--------------------------------------------------------------------------
    |
    | This does NOT create the account yet.
    | It generates an OTP and sends it to the owner's email.
    |
    */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:owners,email'
            ],

            'password' => 'required|string|min:6|confirmed',
        ]);


        /*
        |--------------------------------------------------------------------------
        | GENERATE 6-DIGIT OTP
        |--------------------------------------------------------------------------
        */

        $otp = str_pad(
            random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );


        /*
        |--------------------------------------------------------------------------
        | SAVE REGISTRATION DATA TEMPORARILY
        |--------------------------------------------------------------------------
        */

        session([
            'pending_owner' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ],

            'owner_otp' => Hash::make($otp),

            'owner_otp_expires_at' => now()
                ->addMinutes(10)
                ->timestamp,
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEND OTP EMAIL
        |--------------------------------------------------------------------------
        */

        try {

            Mail::raw(
                "Hello {$request->name},\n\n"
                . "Thank you for registering as an owner on AccomFinder.\n\n"
                . "Your verification code is:\n\n"
                . "{$otp}\n\n"
                . "This OTP will expire in 10 minutes.\n\n"
                . "If you did not request this registration, please ignore this email.\n\n"
                . "Thank you,\n"
                . "AccomFinder",
                function ($message) use ($request) {

                    $message
                        ->to($request->email)
                        ->subject('AccomFinder Owner Registration OTP');
                }
            );

        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | REMOVE TEMPORARY DATA IF EMAIL FAILS
            |--------------------------------------------------------------------------
            */

            session()->forget([
                'pending_owner',
                'owner_otp',
                'owner_otp_expires_at',
            ]);


            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with(
                    'error',
                    'We could not send the verification email. Please check your email settings and try again.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GO TO OTP PAGE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('owner.otp')
            ->with(
                'success',
                'A 6-digit verification code has been sent to your email.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW OTP PAGE
    |--------------------------------------------------------------------------
    */

    public function showOtp()
    {
        if (!session('pending_owner')) {

            return redirect()
                ->route('owner.register')
                ->with(
                    'error',
                    'Please register first.'
                );
        }


        return view('owner.otp');
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFY OTP
    |--------------------------------------------------------------------------
    */

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => [
                'required',
                'digits:6',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK REGISTRATION DATA
        |--------------------------------------------------------------------------
        */

        $pendingOwner = session('pending_owner');

        if (!$pendingOwner) {

            return redirect()
                ->route('owner.register')
                ->with(
                    'error',
                    'Your registration session has expired. Please register again.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK OTP EXPIRATION
        |--------------------------------------------------------------------------
        */

        $expiresAt = session('owner_otp_expires_at');

        if (!$expiresAt || now()->timestamp > $expiresAt) {

            session()->forget([
                'pending_owner',
                'owner_otp',
                'owner_otp_expires_at',
            ]);

            return redirect()
                ->route('owner.register')
                ->with(
                    'error',
                    'Your OTP has expired. Please register again.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK OTP
        |--------------------------------------------------------------------------
        */

        $storedOtp = session('owner_otp');

        if (!$storedOtp || !Hash::check($request->otp, $storedOtp)) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid verification code. Please try again.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE OWNER ACCOUNT
        |--------------------------------------------------------------------------
        */

        $owner = Owner::create([
            'name' => $pendingOwner['name'],
            'email' => $pendingOwner['email'],
            'password' => $pendingOwner['password'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SAVE OWNER LOGIN SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'owner_id' => $owner->id,
            'owner_name' => $owner->name,
            'owner_email' => $owner->email,
        ]);


        /*
        |--------------------------------------------------------------------------
        | REMOVE OTP DATA
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'pending_owner',
            'owner_otp',
            'owner_otp_expires_at',
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO OWNER DASHBOARD
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('owner.dashboard')
            ->with(
                'success',
                'Email verified! Your owner account has been created successfully.'
            );
    }
}
