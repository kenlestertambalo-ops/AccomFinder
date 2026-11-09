<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentRegisterController extends Controller
{
    public function showRegister()
    {
        return view('student.register');
    }

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

        $otp = str_pad(
            random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );

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

        return redirect()
            ->route('student.otp')
            ->with(
                'success',
                'A 6-digit verification code has been sent to your email.'
            );
    }

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

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => [
                'required',
                'digits:6',
            ],
        ]);

        $pendingStudent = session('pending_student');

        if (!$pendingStudent) {
            return redirect()
                ->route('student.register')
                ->with(
                    'error',
                    'Your registration session has expired. Please register again.'
                );
        }

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
        | CREATE STUDENT ACCOUNT WITH AUTOMATIC STUDENT ID
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($pendingStudent) {

            $student = Student::create([
                'student_id' => 'PENDING-' . Str::uuid(),
                'name' => $pendingStudent['name'],
                'email' => $pendingStudent['email'],
                'phone' => $pendingStudent['phone'],
                'password' => $pendingStudent['password'],
            ]);

            $student->student_id = 'AF-'
                . now()->format('Y')
                . '-'
                . str_pad(
                    (string) $student->id,
                    5,
                    '0',
                    STR_PAD_LEFT
                );

            $student->save();
        });

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
