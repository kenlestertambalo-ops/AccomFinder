
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password | AccomFinder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #eef4fb;
            font-family: Arial, sans-serif;
        }

        .reset-card {
            width: 100%;
            max-width: 430px;
            padding: 35px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .icon-box {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 16px;
            font-size: 30px;
        }

        h2 {
            font-size: 25px;
            font-weight: 700;
            color: #1e293b;
        }

        .description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 9px;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            font-size: 18px;
        }

        .btn-primary {
            padding: 12px;
            background: #2563eb;
            border-color: #2563eb;
            border-radius: 9px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        .back-link {
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="reset-card">

    <div class="icon-box">
        <i class="bi bi-shield-lock"></i>
    </div>

    <div class="text-center mb-4">
        <h2>Create New Password</h2>

        <p class="description mb-0">
            Your email has been verified. Create a new password
            for your AccomFinder student account.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
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
        action="{{ route('student.password.update') }}"
        method="POST"
    >
        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">
                New Password
            </label>

            <div class="password-wrapper">
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
                    onclick="togglePassword('password', 'eyePassword')"
                    aria-label="Show or hide new password"
                >
                    <i class="bi bi-eye" id="eyePassword"></i>
                </button>
            </div>

            <div class="form-text">
                Use at least 8 characters.
            </div>
        </div>

        <div class="mb-4">
            <label
                for="password_confirmation"
                class="form-label fw-semibold"
            >
                Confirm New Password
            </label>

            <div class="password-wrapper">
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
                    onclick="togglePassword('password_confirmation', 'eyeConfirmation')"
                    aria-label="Show or hide password confirmation"
                >
                    <i class="bi bi-eye" id="eyeConfirmation"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-check-circle me-2"></i>
            Reset Password
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('student.login') }}" class="back-link">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Login
        </a>
    </div>

</div>

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
