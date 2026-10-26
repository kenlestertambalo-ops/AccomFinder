
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Email | AccomFinder</title>

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

        .verify-card {
            width: 100%;
            max-width: 430px;
            padding: 35px;
            background: #fff;
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
            line-height: 1.7;
        }

        .otp-input {
            padding: 13px;
            text-align: center;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 8px;
            border-radius: 9px;
        }

        .otp-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
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

<div class="verify-card">

    <div class="icon-box">
        <i class="bi bi-envelope-check"></i>
    </div>

    <div class="text-center mb-4">
        <h2>Verify Your Email</h2>

        <p class="description mb-0">
            We've sent a six-digit verification code to your registered
            email address. Enter the code below to continue resetting
            your AccomFinder password.
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
        action="{{ route('student.password.otp.verify') }}"
        method="POST"
    >
        @csrf

        <div class="mb-4">
            <label for="otp" class="form-label fw-semibold">
                Six-Digit Verification Code
            </label>

            <input
                type="text"
                name="otp"
                id="otp"
                class="form-control otp-input @error('otp') is-invalid @enderror"
                placeholder="000000"
                inputmode="numeric"
                pattern="[0-9]{6}"
                minlength="6"
                maxlength="6"
                autocomplete="one-time-code"
                aria-describedby="otpHelp"
                required
                autofocus
            >

            <div id="otpHelp" class="form-text text-center mt-2">
                The code expires after 5 minutes.
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-shield-check me-2"></i>
            Verify Code
        </button>
    </form>

    <div class="text-center mt-4">
        <a
            href="{{ route('student.password.request') }}"
            class="back-link"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back to Forgot Password
        </a>
    </div>

</div>

<script>
    const otpInput = document.getElementById('otp');

    otpInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
    });
</script>

</body>
</html>
