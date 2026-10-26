
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef4fb;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .forgot-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            width: 65px;
            height: 65px;
            border-radius: 16px;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
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

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
            padding: 12px;
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

<div class="forgot-card">

    <div class="logo">
        <i class="bi bi-shield-lock"></i>
    </div>

    <div class="text-center mb-4">
        <h2>Forgot Password?</h2>

        <p class="description mb-0">
            Enter the email address registered to your AccomFinder
            student account. We'll send you a six-digit verification code.
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

    <form action="{{ route('student.password.email') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">
                Registered Email Address
            </label>

            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                placeholder="Enter your email address"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                autofocus
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-envelope me-2"></i>
            Send Verification Code
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('student.login') }}" class="back-link">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Login
        </a>
    </div>

</div>

</body>
</html>
