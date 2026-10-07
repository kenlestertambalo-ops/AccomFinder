<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Email Verification | AccomFinder</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {
            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #ecfff8,
                    #f5fffb
                );

            color: #173b63;
        }


        /* =========================
           BACK TO LOGIN
        ========================= */

        .back-login {
            position: absolute;

            top: 28px;
            left: 25px;

            text-decoration: none;

            color: #173b63;

            font-size: 16px;
        }


        .back-login:hover {
            color: #009f6b;
        }


        /* =========================
           OTP CONTAINER
        ========================= */

        .otp-container {
            width: 100%;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: flex-start;

            padding-top: 70px;

            padding-bottom: 30px;
        }


        /* =========================
           OTP CARD
        ========================= */

        .otp-card {
            width: 435px;

            background: white;

            border-radius: 15px;

            padding: 30px;

            box-shadow:
                0 5px 20px
                rgba(0, 0, 0, 0.08);
        }


        /* =========================
           ICON
        ========================= */

        .icon-circle {
            width: 62px;

            height: 62px;

            margin: 0 auto 18px;

            border-radius: 50%;

            background: #d1fae5;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 32px;

            color: #00a76f;
        }


        /* =========================
           TITLE
        ========================= */

        .title {
            text-align: center;

            margin-bottom: 25px;
        }


        .title h1 {
            font-size: 25px;

            color: #0d2f50;

            margin-bottom: 8px;
        }


        .title p {
            color: #52708e;

            font-size: 15px;

            line-height: 1.5;
        }


        /* =========================
           EMAIL DISPLAY
        ========================= */

        .email-box {
            background: #f5faf8;

            border: 1px solid #d7eee5;

            border-radius: 9px;

            padding: 13px;

            text-align: center;

            margin-bottom: 20px;

            color: #173b63;

            font-size: 14px;
        }


        .email-box strong {
            color: #00a76f;
        }


        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 17px;
        }


        .form-group label {
            display: block;

            margin-bottom: 7px;

            font-size: 14px;

            font-weight: 600;

            color: #173b63;
        }


        .otp-input {
            width: 100%;

            height: 55px;

            padding: 0 14px;

            border:
                1px solid #cbd8e5;

            border-radius: 9px;

            outline: none;

            font-size: 24px;

            font-weight: 600;

            letter-spacing: 8px;

            text-align: center;

            color: #173b63;

            background: #fff;
        }


        .otp-input:focus {
            border-color: #00a76f;

            box-shadow:
                0 0 0 2px
                rgba(0, 167, 111, 0.08);
        }


        .otp-input::placeholder {
            color: #b5c2cf;

            letter-spacing: 6px;
        }


        /* =========================
           ERROR MESSAGE
        ========================= */

        .error {
            color: #dc3545;

            font-size: 13px;

            margin-top: 5px;
        }


        /* =========================
           SUCCESS MESSAGE
        ========================= */

        .success {
            background: #ecfdf5;

            border:
                1px solid #a7f3d0;

            color: #047857;

            padding: 11px 13px;

            border-radius: 8px;

            font-size: 13px;

            margin-bottom: 17px;

            line-height: 1.4;
        }


        /* =========================
           ERROR ALERT
        ========================= */

        .alert-error {
            background: #fff5f5;

            border:
                1px solid #fecaca;

            color: #dc2626;

            padding: 11px 13px;

            border-radius: 8px;

            font-size: 13px;

            margin-bottom: 17px;

            line-height: 1.4;
        }


        /* =========================
           VERIFY BUTTON
        ========================= */

        .verify-button {
            width: 100%;

            height: 48px;

            border: none;

            border-radius: 8px;

            background: #00a76f;

            color: white;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            margin-top: 5px;
        }


        .verify-button:hover {
            background: #008f5e;
        }


        /* =========================
           INFORMATION
        ========================= */

        .otp-info {
            text-align: center;

            margin-top: 18px;

            color: #7890a7;

            font-size: 13px;

            line-height: 1.5;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 550px) {

            .otp-card {
                width: calc(100% - 30px);

                padding: 25px;
            }


            .back-login {
                position: relative;

                top: auto;

                left: auto;

                display: block;

                margin:
                    20px 0 0 20px;
            }


            .otp-container {
                padding-top: 20px;
            }

        }

    </style>

</head>


<body>


    <!-- =========================
         BACK TO LOGIN
    ========================= -->

    <a
        href="{{ route('owner.login') }}"
        class="back-login"
    >

        ← &nbsp;Back to Login

    </a>


    <!-- =========================
         OTP CONTAINER
    ========================= -->

    <div class="otp-container">


        <div class="otp-card">


            <!-- =========================
                 ICON
            ========================= -->

            <div class="icon-circle">

                ✉

            </div>


            <!-- =========================
                 TITLE
            ========================= -->

            <div class="title">

                <h1>
                    Verify Your Email
                </h1>

                <p>
                    We sent a 6-digit verification code
                    to your email address.
                </p>

            </div>


            <!-- =========================
                 EMAIL
            ========================= -->

            @if(session('pending_owner'))

                <div class="email-box">

                    Verification code sent to:

                    <br>

                    <strong>
                        {{ session('pending_owner.email') }}
                    </strong>

                </div>

            @endif


            <!-- =========================
                 SUCCESS MESSAGE
            ========================= -->

            @if(session('success'))

                <div class="success">

                    {{ session('success') }}

                </div>

            @endif


            <!-- =========================
                 ERROR MESSAGE
            ========================= -->

            @if(session('error'))

                <div class="alert-error">

                    {{ session('error') }}

                </div>

            @endif


            <!-- =========================
                 OTP FORM
            ========================= -->

            <form
                method="POST"
                action="{{ route('owner.otp.verify') }}"
            >

                @csrf


                <div class="form-group">

                    <label for="otp">
                        Verification Code
                    </label>


                    <input
                        type="text"
                        id="otp"
                        name="otp"
                        class="otp-input"
                        placeholder="000000"
                        maxlength="6"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        required
                    >


                    @error('otp')

                        <div class="error">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <!-- =========================
                     VERIFY BUTTON
                ========================= -->

                <button
                    type="submit"
                    class="verify-button"
                >

                    Verify Email

                </button>


            </form>


            <!-- =========================
                 INFORMATION
            ========================= -->

            <div class="otp-info">

                The verification code will expire
                after 10 minutes.

                <br>

                Please check your inbox and spam folder.

            </div>


        </div>


    </div>


    <script>

        const otpInput = document.getElementById('otp');

        otpInput.addEventListener('input', function () {

            this.value = this.value
                .replace(/\D/g, '')
                .slice(0, 6);

        });

    </script>


</body>

</html>
