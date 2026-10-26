<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STUDENT LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        $lockoutSeconds = 0;
        $lockedEmail = session('login_lockout_email');

        if ($lockedEmail) {
            $key = 'student-login:' . $lockedEmail;

            if (RateLimiter::tooManyAttempts($key, 5)) {
                $lockoutSeconds = RateLimiter::availableIn($key);
            }
        }

        return view('student.login', compact('lockoutSeconds'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = Str::lower(trim($request->email));
        $key = 'student-login:' . $email;

        $maxAttempts = 5;
        $lockoutSeconds = 300;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);

            $request->session()->put('login_lockout_email', $email);

            return back()
                ->withInput($request->only('email'))
                ->with('lockout_seconds', $seconds)
                ->withErrors([
                    'email' => 'Too many failed login attempts. Please wait until the countdown finishes.',
                ]);
        }

        $student = Student::where('email', $email)->first();

        if (
            !$student ||
            !Hash::check($request->password, $student->password)
        ) {
            RateLimiter::hit($key, $lockoutSeconds);

            $attempts = RateLimiter::attempts($key);

            if ($attempts >= $maxAttempts) {
                $seconds = RateLimiter::availableIn($key);

                $request->session()->put('login_lockout_email', $email);

                return back()
                    ->withInput($request->only('email'))
                    ->with('lockout_seconds', $seconds)
                    ->withErrors([
                        'email' => 'You have entered an incorrect email or password 5 times. Login is locked for 5 minutes.',
                    ]);
            }

            $remainingAttempts = $maxAttempts - $attempts;

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'The email or password is incorrect. '
                        . $remainingAttempts
                        . ' attempt(s) remaining before a 5-minute lockout.',
                ]);
        }

        RateLimiter::clear($key);

        $request->session()->forget('login_lockout_email');

        $request->session()->regenerate();

        $request->session()->put('student_id', $student->id);
        $request->session()->put('student_name', $student->name);
        $request->session()->put('student_email', $student->email);

        return redirect()->route('student.dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    // Display the forgot-password page.
    public function showForgotPassword()
    {
        return view('student.forgot-password');
    }

    // Send a six-digit OTP to the registered student email.
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = Str::lower(trim($request->email));

        $student = Student::where('email', $email)->first();

        if (!$student) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'No student account was found with that email address.',
                ]);
        }

        // Clear any previous password-reset verification.
        $request->session()->forget([
            'password_reset_email',
            'password_reset_otp',
            'password_reset_expires',
            'password_reset_attempts',
            'password_reset_verified',
            'password_reset_token',
        ]);

        $otp = (string) random_int(100000, 999999);

        $token = Str::random(64);

        $request->session()->put([
            'password_reset_email' => $email,
            'password_reset_otp' => Hash::make($otp),
            'password_reset_expires' => now()->addMinutes(5)->timestamp,
            'password_reset_attempts' => 0,
            'password_reset_verified' => false,
            'password_reset_token' => $token,
        ]);

        try {
            Mail::raw(
                "Hello {$student->name},\n\n"
                . "You requested to reset your AccomFinder password.\n\n"
                . "Your six-digit verification code is: {$otp}\n\n"
                . "This code expires in 5 minutes. Do not share it with anyone.\n"
                . "If you did not request this, you can ignore this email.",
                function ($message) use ($email) {
                    $message->to($email)
                        ->subject('AccomFinder Password Reset Verification');
                }
            );
        } catch (\Throwable $e) {
            report($e);

            $request->session()->forget([
                'password_reset_email',
                'password_reset_otp',
                'password_reset_expires',
                'password_reset_attempts',
                'password_reset_verified',
                'password_reset_token',
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Unable to send the verification email. Please check your mail configuration and try again.',
                ]);
        }

        return redirect()
            ->route('student.password.otp')
            ->with('success', 'A verification code has been sent to your registered email address.');
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFY PASSWORD RESET OTP
    |--------------------------------------------------------------------------
    */

    // Display the OTP verification page.
    public function showResetOtp()
    {
        if (!session('password_reset_email')) {
            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Please enter your email address first.',
                ]);
        }

        if (
            !session('password_reset_verified') &&
            now()->timestamp > (int) session('password_reset_expires', 0)
        ) {
            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Your verification code has expired. Please request a new one.',
                ]);
        }

        return view('student.verify-reset-otp');
    }

    // Check the OTP submitted by the student.
    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('password_reset_email');

        if (!$email) {
            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Your password reset session has expired. Please start again.',
                ]);
        }

        if (session('password_reset_verified')) {
            return redirect()->route('student.password.reset', [
                'token' => session('password_reset_token'),
            ]);
        }

        if (now()->timestamp > (int) session('password_reset_expires', 0)) {
            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Your verification code has expired. Please request a new one.',
                ]);
        }

        $attempts = (int) session('password_reset_attempts', 0);

        if ($attempts >= 5) {
            $request->session()->forget([
                'password_reset_email',
                'password_reset_otp',
                'password_reset_expires',
                'password_reset_attempts',
                'password_reset_verified',
                'password_reset_token',
            ]);

            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Too many incorrect verification attempts. Please request a new code.',
                ]);
        }

        $correctOtp = session('password_reset_otp');

        if (!$correctOtp || !Hash::check($request->otp, $correctOtp)) {
            $attempts++;

            $request->session()->put('password_reset_attempts', $attempts);

            if ($attempts >= 5) {
                $request->session()->forget([
                    'password_reset_email',
                    'password_reset_otp',
                    'password_reset_expires',
                    'password_reset_attempts',
                    'password_reset_verified',
                    'password_reset_token',
                ]);

                return redirect()
                    ->route('student.password.request')
                    ->withErrors([
                        'email' => 'Too many incorrect verification attempts. Please request a new code.',
                    ]);
            }

            return back()
                ->withErrors([
                    'otp' => 'The verification code is incorrect. '
                        . (5 - $attempts)
                        . ' attempt(s) remaining.',
                ]);
        }

        $request->session()->put('password_reset_verified', true);

        return redirect()->route('student.password.reset', [
            'token' => session('password_reset_token'),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    // Show the new-password form only after successful OTP verification.
    public function showResetPassword(Request $request, $token)
    {
        $savedToken = session('password_reset_token');

        if (
            !$savedToken ||
            !hash_equals($savedToken, (string) $token) ||
            !session('password_reset_verified') ||
            !session('password_reset_email')
        ) {
            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Please verify your email before resetting your password.',
                ]);
        }

        return view('student.reset-password', [
            'token' => $token,
        ]);
    }

    // Save the new password.
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $savedToken = session('password_reset_token');
        $email = session('password_reset_email');

        if (
            !$savedToken ||
            !hash_equals($savedToken, (string) $request->token) ||
            !session('password_reset_verified') ||
            !$email
        ) {
            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'Your password reset session is invalid. Please verify your email again.',
                ]);
        }

        $student = Student::where('email', $email)->first();

        if (!$student) {
            $request->session()->forget([
                'password_reset_email',
                'password_reset_otp',
                'password_reset_expires',
                'password_reset_attempts',
                'password_reset_verified',
                'password_reset_token',
            ]);

            return redirect()
                ->route('student.password.request')
                ->withErrors([
                    'email' => 'The student account could not be found.',
                ]);
        }

        $student->password = Hash::make($request->password);
        $student->save();

        // Remove the reset session after a successful password change.
        $request->session()->forget([
            'password_reset_email',
            'password_reset_otp',
            'password_reset_expires',
            'password_reset_attempts',
            'password_reset_verified',
            'password_reset_token',
        ]);

        // Clear the login lockout for this email.
        RateLimiter::clear('student-login:' . $email);

        return redirect()
            ->route('student.login')
            ->with('success', 'Your password has been reset successfully. You can now log in with your new password.');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        $request->session()->forget([
            'student_id',
            'student_name',
            'student_email',
            'login_lockout_email',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }
}
