<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password | AccomFinder Owner</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #eef4fb;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
        }

        .reset-card {
            width: 100%;
            max-width: 440px;
            padding: 36px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.09);
        }

        .brand-icon {
            width: 66px;
            height: 66px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border-radius: 18px;
            background: #e8f7ee;
            color: #198754;
            font-size: 30px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            color: #172033;
        }

        .page-description {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .password-group {
            position: relative;
        }

        .password-group .form-control {
            min-height: 48px;
            border-radius: 10px;
            border-color: #dbe3ed;
            padding: 12px 48px 12px 14px;
        }

        .password-group .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.12);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            z-index: 5;
        }

        .toggle-password:hover {
            color: #198754;
        }

        .btn-submit {
            min-height: 48px;
            width: 100%;
            border: none;
            border-radius: 10px;
            background: #198754;
            color: white;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .btn-submit:hover {
            background: #157347;
            color: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 22px;
            color: #198754;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link:hover {
            color: #146c43;
            text-decoration: underline;
        }

        .security-note {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #edf0f4;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }

        @media (max-width: 480px) {
            .reset-card {
                padding: 26px 22px;
            }

            .page-title {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <main class="reset-card">

        <div class="brand-icon">
            <i class="bi bi-shield-lock"></i>
        </div>

        <h1 class="page-title">Create New Password</h1>

        <p class="page-description">
            Your email has been verified. Create a new password for your
            AccomFinder owner account.
        </p>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('owner.password.update') }}"
            method="POST"
        >
            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >

            <div class="mb-3">
                <label for="password" class="form-label">
                    New Password
                </label>

                <div class="password-group">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter new password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword('password', 'passwordEye')"
                        aria-label="Show or hide new password"
                    >
                        <i class="bi bi-eye" id="passwordEye"></i>
                    </button>
                </div>

                @error('password')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-text">
                    Use at least 8 characters.
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">
                    Confirm New Password
                </label>

                <div class="password-group">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Re-enter new password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword('password_confirmation', 'confirmPasswordEye')"
                        aria-label="Show or hide password confirmation"
                    >
                        <i class="bi bi-eye" id="confirmPasswordEye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="bi bi-check-circle me-2"></i>
                Reset Password
            </button>
        </form>

        <a href="{{ route('owner.login') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Owner Login
        </a>

        <div class="security-note">
            <i class="bi bi-shield-check me-1"></i>
            Keep your new password private and secure.
        </div>

    </main>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>

</body>
</html>
