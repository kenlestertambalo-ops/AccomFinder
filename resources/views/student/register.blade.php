<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration | AccomFinder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

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
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #2563eb;
        }

        .register-card {
            width: 400px;
            max-width: 100%;
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
            justify-content: center;
            align-items: center;
            margin: auto;
            font-size: 22px;
        }

        .form-control {
            height: 45px;
        }

        .input-group-text {
            background: #fff;
        }

        .password-toggle {
            background: #fff;
            border: 1px solid #dee2e6;
            border-left: none;
            color: #6c757d;
            padding: 0 13px;
            cursor: pointer;
            border-radius: 0 6px 6px 0;
        }

        .password-toggle:hover {
            color: #2563eb;
        }

        .password-toggle:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, .2);
            z-index: 3;
        }

        .password-input {
            border-right: none;
        }

        .btn-register {
            background: #2563eb;
            color: #fff;
            border: none;
            height: 45px;
            font-weight: 600;
        }

        .btn-register:hover {
            background: #1d4ed8;
            color: white;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #dc2626;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <!-- Back to Login -->
    <a href="{{ route('student.login') }}" class="back-link">
        <i class="bi bi-arrow-left"></i>
        Back to Login
    </a>

    <!-- Registration Container -->
    <div class="container d-flex justify-content-center align-items-center py-5">

        <div class="card register-card">

            <div class="card-body p-4">

                <!-- Title -->
                <div class="text-center mb-4">

                    <div class="icon-circle mb-3">
                        <i class="bi bi-person"></i>
                    </div>

                    <h4 class="fw-bold">
                        Student Registration
                    </h4>

                    <p class="text-muted small">
                        Create your student account
                    </p>

                </div>

                <!-- Error Message -->
                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="alert-error">

                        <strong>Please fix the following:</strong>

                        <ul class="mb-0 mt-2 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <!-- Registration Form -->
                <form
                    method="POST"
                    action="{{ route('student.register.submit') }}"
                >
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-3">

                        <label class="form-label" for="name">
                            Full Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="John Doe"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                required
                            >

                        </div>

                        @error('name')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Email -->
                    <div class="mb-3">

                        <label class="form-label" for="email">
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
                                placeholder="student@email.com"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                            >

                        </div>

                        @error('email')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">

                        <label class="form-label" for="phone">
                            Phone Number
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-telephone"></i>
                            </span>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="09123456789"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                required
                            >

                        </div>

                        @error('phone')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Password -->
                    <div class="mb-3">

                        <label class="form-label" for="password">
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
                                autocomplete="new-password"
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
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">

                        <label class="form-label" for="password_confirmation">
                            Confirm Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control password-input"
                                placeholder="********"
                                autocomplete="new-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                id="toggleConfirmPassword"
                                aria-label="Show confirm password"
                                aria-pressed="false"
                                title="Show confirm password"
                            >
                                <i class="bi bi-eye" id="confirmEyeIcon"></i>
                            </button>

                        </div>

                        @error('password_confirmation')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Create Account -->
                    <button
                        type="submit"
                        class="btn btn-register w-100"
                    >
                        Create Account
                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- Password Visibility Script -->
    <script>
        function setupPasswordToggle(inputId, buttonId, iconId, label) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(buttonId);
            const eyeIcon = document.getElementById(iconId);

            toggleButton.addEventListener('click', function () {
                const isPasswordHidden = passwordInput.type === 'password';

                passwordInput.type = isPasswordHidden ? 'text' : 'password';

                eyeIcon.classList.toggle('bi-eye', !isPasswordHidden);
                eyeIcon.classList.toggle('bi-eye-slash', isPasswordHidden);

                toggleButton.setAttribute(
                    'aria-label',
                    isPasswordHidden ? 'Hide ' + label : 'Show ' + label
                );

                toggleButton.setAttribute(
                    'title',
                    isPasswordHidden ? 'Hide ' + label : 'Show ' + label
                );

                toggleButton.setAttribute(
                    'aria-pressed',
                    isPasswordHidden ? 'true' : 'false'
                );
            });
        }

        setupPasswordToggle(
            'password',
            'togglePassword',
            'eyeIcon',
            'password'
        );

        setupPasswordToggle(
            'password_confirmation',
            'toggleConfirmPassword',
            'confirmEyeIcon',
            'confirm password'
        );
    </script>

</body>
</html>

