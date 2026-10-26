<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Owner Login | AccomFinder</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

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

        .back-link:hover {
            color: #16a34a;
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
            background: #dcfce7;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 22px;
        }

        .form-control {
            height: 45px;
        }

        /* PASSWORD VISIBILITY BUTTON */
        .password-toggle {
            height: 45px;
            min-width: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid #dee2e6;
            border-left: none;
            border-radius: 0 6px 6px 0;
            color: #6c757d;
            cursor: pointer;
            font-size: 18px;
        }

        .password-toggle:hover {
            color: #16a34a;
            background: #f0fdf4;
        }

        .password-toggle:focus-visible {
            outline: 2px solid #16a34a;
            outline-offset: -3px;
            z-index: 3;
        }

        .password-input {
            border-right: none;
        }

        .btn-login {
            background: #16a34a;
            color: #fff;
            height: 45px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #15803d;
            color: #fff;
        }

        .btn-login:disabled {
            background: #86c99b;
            cursor: not-allowed;
        }

        .small-link {
            text-decoration: none;
            font-weight: 600;
            color: #16a34a;
            margin-left: 5px;
        }

        .small-link:hover {
            color: #15803d;
            text-decoration: underline;
        }

        /* FORGOT PASSWORD LINK */
        .forgot-password-link {
            display: inline-block;
            margin-top: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            color: #16a34a;
        }

        .forgot-password-link:hover {
            color: #15803d;
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .success-message {
            background: #dcfce7;
            color: #15803d;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .lockout-timer {
            font-size: 36px;
            font-weight: 700;
            color: #b42318;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>

    <!-- BACK TO HOME -->
    <a href="{{ url('/') }}" class="back-link">
        <i class="bi bi-arrow-left"></i>
        Back to Home
    </a>

    <!-- LOGIN CONTAINER -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">

        <div class="card login-card">
            <div class="card-body p-4">

                <!-- HEADER -->
                <div class="text-center mb-4">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-building"></i>
                    </div>

                    <h4 class="fw-bold">Owner Login</h4>

                    <p class="text-muted small">
                        Manage your accommodation listings
                    </p>
                </div>

                <!-- SUCCESS MESSAGE -->
                @if (session('success'))
                    <div class="success-message" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- GENERAL ERROR MESSAGE -->
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- VALIDATION ERRORS -->
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
                        You have reached the maximum number of failed attempts.
                    </p>

                    <div id="lockoutCountdown" class="lockout-timer">
                        05:00
                    </div>

                    <small>Time remaining</small>

                    <p class="small mt-2 mb-0">
                        Please wait until the countdown finishes.
                    </p>
                </div>

                <!-- LOGIN FORM -->
                <form
                    action="{{ route('owner.login.post') }}"
                    method="POST"
                    id="ownerLoginForm"
                >
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="owner@email.com"
                                value="{{ old('email', session('owner_login_lockout_email')) }}"
                                autocomplete="username"
                                required
                            >
                        </div>

                        @error('email')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-2">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control password-input"
                                placeholder="********"
                                autocomplete="current-password"
                                required
                            >

                            <!-- SHOW/HIDE PASSWORD -->
                            <button
                                type="button"
                                id="togglePassword"
                                class="password-toggle"
                                aria-label="Show password"
                                aria-pressed="false"
                                title="Show password"
                            >
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>

                        @error('password')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- FORGOT PASSWORD -->
                    <div class="text-end mb-3">
                        <a
                            href="{{ route('owner.password.request') }}"
                            class="forgot-password-link"
                        >
                            Forgot Password?
                        </a>
                    </div>

                    <!-- LOGIN BUTTON -->
                    <button
                        type="submit"
                        id="loginButton"
                        class="btn btn-login w-100"
                    >
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Sign In
                    </button>
                </form>

                <!-- REGISTER -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Don't have an account?
                    </small>

                    <a href="{{ route('owner.register') }}" class="small-link">
                        Register
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- PASSWORD VISIBILITY AND COUNTDOWN SCRIPTS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countdown = document.getElementById('lockoutCountdown');
            const lockoutBox = document.getElementById('lockoutBox');
            const loginButton = document.getElementById('loginButton');
            const loginForm = document.getElementById('ownerLoginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            const togglePassword = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');

            let remaining = {{ $remainingSeconds }};

            // SHOW/HIDE PASSWORD
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

            // LOCKOUT COUNTDOWN
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
                            '<i class="bi bi-check-circle me-1"></i>' +
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

            // PREVENT SUBMISSION WHILE COUNTDOWN IS ACTIVE
            loginForm.addEventListener('submit', function (event) {
                if (remaining > 0) {
                    event.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
