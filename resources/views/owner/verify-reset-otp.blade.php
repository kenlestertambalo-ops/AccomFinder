<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify OTP | AccomFinder Owner</title>

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

        .otp-card {
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
            margin-bottom: 26px;
        }

        .email-icon {
            color: #198754;
            margin-right: 5px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .otp-input {
            min-height: 58px;
            border-radius: 10px;
            border: 1px solid #dbe3ed;
            text-align: center;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 10px;
            padding-left: 20px;
        }

        .otp-input:focus {
            border-color: #198754;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.12);
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
            .otp-card {
                padding: 26px 22px;
            }

            .page-title {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <main class="otp-card">

        <div class="brand-icon">
            <i class="bi bi-envelope-check"></i>
        </div>

        <h1 class="page-title">Verify Your Email</h1>

        <p class="page-description">
            We've sent a six-digit password-reset code to your registered
            owner email address. Enter the code below to continue.
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
            action="{{ route('owner.password.otp.verify') }}"
            method="POST"
        >
            @csrf

            <div class="mb-4">
                <label for="otp" class="form-label">
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
                    value="{{ old('otp') }}"
                    required
                    autofocus
                >

                <div id="otpHelp" class="form-text mt-2">
                    <i class="bi bi-clock me-1"></i>
                    Your verification code expires in 5 minutes.
                </div>

                @error('otp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="bi bi-shield-check me-2"></i>
                Verify Code
            </button>
        </form>

        <a
            href="{{ route('owner.password.request') }}"
            class="back-link"
        >
            <i class="bi bi-arrow-left"></i>
            Request a New Code
        </a>

        <div class="security-note">
            <i class="bi bi-shield-lock me-1"></i>
            Never share your verification code with anyone.
        </div>

    </main>

    <script>
        const otpInput = document.getElementById('otp');

        otpInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });
    </script>

</body>
</html>

