
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Login | AccomFinder</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #eef4fb;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #6c757d;
            font-size: 14px;
        }

        .login-card {
            width: 390px;
            max-width: 95%;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        }

        .icon-circle {
            width: 52px;
            height: 52px;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 22px;
        }

        .form-control,
        .password-toggle {
            height: 45px;
        }

        .btn-login {
            background: #2563eb;
            color: white;
            border: none;
            height: 45px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #1d4ed8;
            color: white;
        }

        .small-link {
            text-decoration: none;
            font-weight: 600;
        }

        .password-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 46px;
            cursor: pointer;
            background: #fff;
            color: #6c757d;
            border: 1px solid #dee2e6;
            border-left: 0;
        }

        .password-toggle:hover {
            color: #2563eb;
            background: #f8fafc;
        }

        .password-toggle:focus-visible {
            outline: 2px solid #2563eb;
            outline-offset: -2px;
            z-index: 3;
        }

        .forgot-link {
            text-decoration: none;
            color: #2563eb;
            font-size: 14px;
            font-weight: 600;
        }

        .forgot-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<a href="{{ url('/') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Back to Home
</a>

<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    <div class="card login-card">
        <div class="card-body p-4">

            <!-- HEADER -->
            <div class="text-center mb-4">
                <div class="icon-circle mb-3">
                    <i class="bi bi-envelope"></i>
                </div>

                <h4 class="fw-bold">Student Login</h4>

                <p class="text-muted small">
                    Access your accommodation search portal
                </p>
            </div>

            <!-- SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR MESSAGES -->
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- LOCKOUT COUNTDOWN -->
            @php
                $remainingSeconds = (int) (
                    session('lockout_seconds', $lockoutSeconds ?? 0)
                );
            @endphp

            <div
                id="lockoutBox"
                class="alert alert-warning text-center"
                style="{{ $remainingSeconds > 0 ? '' : 'display: none;' }}"
            >
                <i class="bi bi-clock-history me-1"></i>
                <strong>Login Temporarily Locked</strong>

                <p class="mb-1 mt-2">
                    Too many failed login attempts.
                </p>

                <div id="lockoutCountdown" class="fw-bold fs-3">
                    05:00
                </div>

                <small>Time remaining</small>
            </div>

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('student.login.post') }}" id="loginForm">
                @csrf

                <!-- EMAIL -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="student@email.com"
                            value="{{ old('email', session('login_lockout_email')) }}"
                            autocomplete="username"
                            required
                        >
                    </div>

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- PASSWORD WITH SHOW/HIDE EYE -->
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Show password"
                            aria-pressed="false"
                            title="Show password"
                        >
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>

                    @error('password')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- FORGOT PASSWORD LINK -->
                <div class="text-end mb-3">
                    <a
                        href="{{ route('student.password.request') }}"
                        class="forgot-link"
                    >
                        Forgot Password?
                    </a>
                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit" id="loginButton" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Sign In
                </button>
            </form>

            <!-- REGISTER LINK -->
            <div class="text-center mt-4">
                <small class="text-muted">Don't have an account?</small>
                <a href="{{ route('student.register') }}" class="small-link">Register</a>
            </div>

        </div>
    </div>
</div>

<script>
    // Show or hide password.
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';

        eyeIcon.classList.toggle('bi-eye', !isHidden);
        eyeIcon.classList.toggle('bi-eye-slash', isHidden);

        togglePassword.setAttribute(
            'aria-label',
            isHidden ? 'Hide password' : 'Show password'
        );

        togglePassword.setAttribute(
            'title',
            isHidden ? 'Hide password' : 'Show password'
        );

        togglePassword.setAttribute(
            'aria-pressed',
            isHidden ? 'true' : 'false'
        );
    });

    // Lockout countdown.
    document.addEventListener('DOMContentLoaded', function () {
        const countdown = document.getElementById('lockoutCountdown');
        const lockoutBox = document.getElementById('lockoutBox');
        const loginButton = document.getElementById('loginButton');
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');

        let remaining = {{ $remainingSeconds }};

        if (remaining > 0) {
            loginButton.disabled = true;
            emailInput.readOnly = true;
            passwordInput.disabled = true;
            togglePassword.disabled = true;

            function updateCountdown() {
                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;

                countdown.textContent =
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');

                if (remaining <= 0) {
                    lockoutBox.classList.remove('alert-warning');
                    lockoutBox.classList.add('alert-success');

                    lockoutBox.innerHTML =
                        '<strong>Lockout Finished</strong>' +
                        '<p class="mb-0 mt-2">You can try logging in again.</p>';

                    loginButton.disabled = false;
                    emailInput.readOnly = false;
                    passwordInput.disabled = false;
                    togglePassword.disabled = false;

                    return;
                }

                remaining--;
                setTimeout(updateCountdown, 1000);
            }

            updateCountdown();
        }

        loginForm.addEventListener('submit', function (event) {
            if (remaining > 0) {
                event.preventDefault();
            }
        });
    });
</script>

</body>
</html>
