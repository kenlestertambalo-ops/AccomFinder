<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
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
        $lockoutSeconds = 0;
        $lockedEmail = session('owner_login_lockout_email');

        if ($lockedEmail) {
            $key = 'owner-login:' . $lockedEmail;

            if (RateLimiter::tooManyAttempts($key, 5)) {
                $lockoutSeconds = RateLimiter::availableIn($key);
            }
        }

        return view('owner.login', compact('lockoutSeconds'));
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

        $email = Str::lower(trim($request->email));
        $key = 'owner-login:' . $email;

        $maxAttempts = 5;
        $lockoutSeconds = 300;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);

            $request->session()->put(
                'owner_login_lockout_email',
                $email
            );

            return back()
                ->withInput($request->only('email'))
                ->with('lockout_seconds', $seconds)
                ->with(
                    'error',
                    'Too many failed login attempts. Please wait until the countdown finishes.'
                );
        }

        $owner = Owner::where('email', $email)->first();

        if (!$owner || !Hash::check($request->password, $owner->password)) {
            RateLimiter::hit($key, $lockoutSeconds);

            $attempts = RateLimiter::attempts($key);

            if ($attempts >= $maxAttempts) {
                $seconds = RateLimiter::availableIn($key);

                $request->session()->put(
                    'owner_login_lockout_email',
                    $email
                );

                return back()
                    ->withInput($request->only('email'))
                    ->with('lockout_seconds', $seconds)
                    ->with(
                        'error',
                        'You entered an incorrect email or password 5 times. Login is locked for 5 minutes.'
                    );
            }

            $remainingAttempts = $maxAttempts - $attempts;

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'Invalid email or password. '
                    . $remainingAttempts
                    . ' attempt(s) remaining before a 5-minute lockout.'
                );
        }

        RateLimiter::clear($key);

        $request->session()->forget('owner_login_lockout_email');

        $request->session()->regenerate();

        $request->session()->put('owner_id', $owner->id);
        $request->session()->put('owner_name', $owner->name);
        $request->session()->put('owner_email', $owner->email);

        return redirect()
            ->route('owner.dashboard')
            ->with('success', 'Welcome back, ' . $owner->name . '!');
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
                'unique:owners,email',
            ],

            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.regex' => 'Your email is invalid. Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
        ]);

        $email = Str::lower(trim($request->email));

        // Generate a six-digit registration OTP.
        $otp = str_pad(
            (string) random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );

        // Store registration information temporarily.
        session([
            'pending_owner' => [
                'name' => $request->name,
                'email' => $email,
                'password' => Hash::make($request->password),
            ],

            'owner_otp' => Hash::make($otp),

            'owner_otp_expires_at' => now()
                ->addMinutes(10)
                ->timestamp,
        ]);

        try {
            Mail::raw(
                "Hello {$request->name},\n\n"
                . "Thank you for registering as an owner on AccomFinder.\n\n"
                . "Your verification code is:\n\n"
                . "{$otp}\n\n"
                . "This OTP will expire in 10 minutes.\n\n"
                . "If you did not request this registration, please ignore this email.\n\n"
                . "Thank you,\nAccomFinder",
                function ($message) use ($email) {
                    $message
                        ->to($email)
                        ->subject('AccomFinder Owner Registration OTP');
                }
            );
        } catch (\Exception $e) {
            report($e);

            session()->forget([
                'pending_owner',
                'owner_otp',
                'owner_otp_expires_at',
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
            ->route('owner.otp')
            ->with(
                'success',
                'A 6-digit verification code has been sent to your email.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW REGISTRATION OTP PAGE
    |--------------------------------------------------------------------------
    */

    public function showOtp()
    {
        if (!session('pending_owner')) {
            return redirect()
                ->route('owner.register')
                ->with('error', 'Please register first.');
        }

        return view('owner.otp');
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY REGISTRATION OTP
    |--------------------------------------------------------------------------
    */

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $pendingOwner = session('pending_owner');

        if (!$pendingOwner) {
            return redirect()
                ->route('owner.register')
                ->with(
                    'error',
                    'Your registration session has expired. Please register again.'
                );
        }

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

        $storedOtp = session('owner_otp');

        if (!$storedOtp || !Hash::check($request->otp, $storedOtp)) {
            return back()
                ->withInput()
                ->with('error', 'Invalid verification code. Please try again.');
        }

        // Prevent duplicate registration if the email was registered meanwhile.
        if (Owner::where('email', $pendingOwner['email'])->exists()) {
            session()->forget([
                'pending_owner',
                'owner_otp',
                'owner_otp_expires_at',
            ]);

            return redirect()
                ->route('owner.register')
                ->with('error', 'This email is already registered. Please log in.');
        }

        $owner = Owner::create([
            'name' => $pendingOwner['name'],
            'email' => $pendingOwner['email'],
            'password' => $pendingOwner['password'],
        ]);

        $request->session()->regenerate();

        $request->session()->put('owner_id', $owner->id);
        $request->session()->put('owner_name', $owner->name);
        $request->session()->put('owner_email', $owner->email);

        $request->session()->forget([
            'pending_owner',
            'owner_otp',
            'owner_otp_expires_at',
            'owner_login_lockout_email',
        ]);

        return redirect()
            ->route('owner.dashboard')
            ->with(
                'success',
                'Email verified! Your owner account has been created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | OWNER FORGOT PASSWORD PAGE
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view('owner.forgot-password');
    }

    /*
    |--------------------------------------------------------------------------
    | SEND OWNER PASSWORD-RESET OTP
    |--------------------------------------------------------------------------
    */

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = Str::lower(trim($request->email));

        $owner = Owner::where('email', $email)->first();

        if (!$owner) {
            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'No owner account was found with that email address.'
                );
        }

        // Generate a separate OTP for password resetting.
        $otp = str_pad(
            (string) random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );

        // Generate a temporary reset token.
        $token = Str::random(64);

        // Keep owner password-reset data separate from registration OTP data.
        session([
            'owner_password_reset_email' => $email,
            'owner_password_reset_otp' => Hash::make($otp),
            'owner_password_reset_expires_at' => now()
                ->addMinutes(5)
                ->timestamp,
            'owner_password_reset_attempts' => 0,
            'owner_password_reset_token' => $token,
            'owner_password_reset_verified' => false,
        ]);

        try {
            Mail::raw(
                "Hello {$owner->name},\n\n"
                . "We received a request to reset your AccomFinder owner account password.\n\n"
                . "Your password-reset verification code is:\n\n"
                . "{$otp}\n\n"
                . "This code expires in 5 minutes. Do not share it with anyone.\n\n"
                . "If you did not request a password reset, you can ignore this email.\n\n"
                . "Thank you,\nAccomFinder",
                function ($message) use ($email) {
                    $message
                        ->to($email)
                        ->subject('AccomFinder Owner Password Reset OTP');
                }
            );
        } catch (\Exception $e) {
            report($e);

            $this->clearOwnerPasswordResetSession();

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'We could not send the verification email. Please check your email settings and try again.'
                );
        }

        return redirect()
            ->route('owner.password.otp')
            ->with(
                'success',
                'A password-reset verification code has been sent to your email.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW OWNER PASSWORD-RESET OTP PAGE
    |--------------------------------------------------------------------------
    */

    public function showResetOtp()
    {
        if (!session('owner_password_reset_email')) {
            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Please request a password-reset code first.');
        }

        $expiresAt = session('owner_password_reset_expires_at');

        if (!$expiresAt || now()->timestamp > $expiresAt) {
            $this->clearOwnerPasswordResetSession();

            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Your verification code has expired. Please request a new one.');
        }

        return view('owner.verify-reset-otp');
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY OWNER PASSWORD-RESET OTP
    |--------------------------------------------------------------------------
    */

    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('owner_password_reset_email');

        if (!$email) {
            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Please request a password-reset code first.');
        }

        $expiresAt = session('owner_password_reset_expires_at');

        if (!$expiresAt || now()->timestamp > $expiresAt) {
            $this->clearOwnerPasswordResetSession();

            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Your verification code has expired. Please request a new one.');
        }

        $attempts = (int) session('owner_password_reset_attempts', 0);

        if ($attempts >= 5) {
            $this->clearOwnerPasswordResetSession();

            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Too many incorrect OTP attempts. Please request a new code.');
        }

        $storedOtp = session('owner_password_reset_otp');

        if (!$storedOtp || !Hash::check($request->otp, $storedOtp)) {
            $attempts++;

            session([
                'owner_password_reset_attempts' => $attempts,
            ]);

            if ($attempts >= 5) {
                $this->clearOwnerPasswordResetSession();

                return redirect()
                    ->route('owner.password.request')
                    ->with('error', 'Too many incorrect OTP attempts. Please request a new code.');
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Incorrect verification code. '
                    . (5 - $attempts)
                    . ' attempt(s) remaining.'
                );
        }

        session([
            'owner_password_reset_verified' => true,
        ]);

        $token = session('owner_password_reset_token');

        return redirect()->route('owner.password.reset', [
            'token' => $token,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW OWNER RESET PASSWORD PAGE
    |--------------------------------------------------------------------------
    */

    public function showResetPassword($token)
    {
        if (
            !session('owner_password_reset_verified') ||
            !session('owner_password_reset_email') ||
            !session('owner_password_reset_token') ||
            !hash_equals(
                (string) session('owner_password_reset_token'),
                (string) $token
            )
        ) {
            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Please verify your email using the OTP first.');
        }

        $expiresAt = session('owner_password_reset_expires_at');

        if (!$expiresAt || now()->timestamp > $expiresAt) {
            $this->clearOwnerPasswordResetSession();

            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Your password-reset session has expired. Please request a new code.');
        }

        return view('owner.reset-password', [
            'token' => $token,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE OWNER NEW PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $sessionToken = session('owner_password_reset_token');

        if (
            !session('owner_password_reset_verified') ||
            !session('owner_password_reset_email') ||
            !$sessionToken ||
            !hash_equals(
                (string) $sessionToken,
                (string) $request->token
            )
        ) {
            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Your password-reset session is invalid. Please start again.');
        }

        $expiresAt = session('owner_password_reset_expires_at');

        if (!$expiresAt || now()->timestamp > $expiresAt) {
            $this->clearOwnerPasswordResetSession();

            return redirect()
                ->route('owner.password.request')
                ->with('error', 'Your password-reset session has expired. Please request a new code.');
        }

        $email = session('owner_password_reset_email');

        $owner = Owner::where('email', $email)->first();

        if (!$owner) {
            $this->clearOwnerPasswordResetSession();

            return redirect()
                ->route('owner.password.request')
                ->with('error', 'The owner account could not be found. Please try again.');
        }

        // Hash the new password before saving.
        $owner->password = Hash::make($request->password);
        $owner->save();

        // Clear any existing failed-login lockout for this owner.
        RateLimiter::clear('owner-login:' . $email);

        $this->clearOwnerPasswordResetSession();

        return redirect()
            ->route('owner.login')
            ->with(
                'success',
                'Your password has been reset successfully. You can now log in with your new password.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CLEAR OWNER PASSWORD-RESET SESSION
    |--------------------------------------------------------------------------
    */

    private function clearOwnerPasswordResetSession()
    {
        session()->forget([
            'owner_password_reset_email',
            'owner_password_reset_otp',
            'owner_password_reset_expires_at',
            'owner_password_reset_attempts',
            'owner_password_reset_token',
            'owner_password_reset_verified',
        ]);
    }
}
