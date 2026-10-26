<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STUDENT REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('student.register');
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT REGISTER
    |--------------------------------------------------------------------------
    |
    | The student account is NOT created yet.
    | We first send a 6-digit OTP to the student's email.
    |
    */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
                'unique:students,email',
            ],

            'phone' => 'required|string|max:255',

            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Please enter your email address.',

            'email.email' => 'Please enter a valid email address.',

            'email.regex' => 'Please enter an email with a valid domain, such as student@example.com or student@example.ph.',

            'email.unique' => 'This email address is already registered.',
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
            'pending_student' => [
                'name' => $request->name,
                'email' => strtolower(trim($request->email)),
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ],

            'student_otp' => Hash::make($otp),

            'student_otp_expires_at' => now()
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
                . "Thank you for registering on AccomFinder.\n\n"
                . "Your student verification code is:\n\n"
                . "{$otp}\n\n"
                . "This OTP will expire in 10 minutes.\n\n"
                . "If you did not request this registration, please ignore this email.\n\n"
                . "Thank you,\n"
                . "AccomFinder",
                function ($message) use ($request) {
                    $message
                        ->to(trim($request->email))
                        ->subject('AccomFinder Student Registration OTP');
                }
            );
        } catch (\Exception $e) {
            /*
            |--------------------------------------------------------------------------
            | REMOVE TEMPORARY DATA IF EMAIL FAILS
            |--------------------------------------------------------------------------
            */

            session()->forget([
                'pending_student',
                'student_otp',
                'student_otp_expires_at',
            ]);

            return back()
                ->withInput(
                    $request->except(
                        'password',
                        'password_confirmation'
                    )
                )
                ->with(
                    'error',
                    'We could not send the verification email. Please check your email settings and try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GO TO STUDENT OTP PAGE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student.otp')
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
        if (!session('pending_student')) {
            return redirect()
                ->route('student.register')
                ->with(
                    'error',
                    'Please register first.'
                );
        }

        return view('student.otp');
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
        | GET PENDING STUDENT
        |--------------------------------------------------------------------------
        */

        $pendingStudent = session('pending_student');

        if (!$pendingStudent) {
            return redirect()
                ->route('student.register')
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

        $expiresAt = session('student_otp_expires_at');

        if (!$expiresAt || now()->timestamp > $expiresAt) {
            session()->forget([
                'pending_student',
                'student_otp',
                'student_otp_expires_at',
            ]);

            return redirect()
                ->route('student.register')
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

        $storedOtp = session('student_otp');

        if (
            !$storedOtp ||
            !Hash::check($request->otp, $storedOtp)
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid verification code. Please try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE STUDENT ACCOUNT
        |--------------------------------------------------------------------------
        */

        Student::create([
            'name' => $pendingStudent['name'],
            'email' => $pendingStudent['email'],
            'phone' => $pendingStudent['phone'],
            'password' => $pendingStudent['password'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | REMOVE OTP DATA
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'pending_student',
            'student_otp',
            'student_otp_expires_at',
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO STUDENT LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student.login')
            ->with(
                'success',
                'Email verified! Your account has been created successfully. You can now log in.'
            );
    }
}
