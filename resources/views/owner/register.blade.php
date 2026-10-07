<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Owner Registration | AccomFinder</title>


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
           REGISTER CONTAINER
        ========================= */

        .register-container {
            width: 100%;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: flex-start;

            padding-top: 25px;

            padding-bottom: 30px;
        }


        /* =========================
           REGISTER CARD
        ========================= */

        .register-card {
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

            margin-bottom: 32px;
        }


        .title h1 {
            font-size: 25px;

            color: #0d2f50;

            margin-bottom: 8px;
        }


        .title p {
            color: #52708e;

            font-size: 15px;
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


        .input-wrapper {
            position: relative;
        }


        .input-icon {
            position: absolute;

            left: 14px;

            top: 50%;

            transform: translateY(-50%);

            color: #8da4bd;

            font-size: 18px;

            pointer-events: none;
        }


        .form-control {
            width: 100%;

            height: 49px;

            padding:
                0 14px 0 40px;

            border:
                1px solid #cbd8e5;

            border-radius: 9px;

            outline: none;

            font-size: 15px;

            color: #333;

            background: #fff;
        }


        .form-control:focus {
            border-color: #00a76f;

            box-shadow:
                0 0 0 2px
                rgba(0, 167, 111, 0.08);
        }


        .form-control::placeholder {
            color: #9aaabd;
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
           CREATE ACCOUNT BUTTON
        ========================= */

        .create-button {
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


        .create-button:hover {
            background: #008f5e;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 550px) {

            .register-card {
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

            .register-container {
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
         REGISTRATION CONTAINER
    ========================= -->

    <div class="register-container">


        <div class="register-card">


            <!-- ICON -->

            <div class="icon-circle">

                🏢

            </div>


            <!-- TITLE -->

            <div class="title">

                <h1>
                    Owner Registration
                </h1>

                <p>
                    Register as a property owner
                </p>

            </div>


            <!-- FORM -->

            <form
                method="POST"
                action="{{ route('owner.register.submit') }}"
            >

                @csrf


                <!-- FULL NAME -->

                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            ♙
                        </span>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="John Smith"
                            value="{{ old('name') }}"
                            required
                        >

                    </div>


                    @error('name')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- COMPANY NAME -->

                <div class="form-group">

                    <label for="company_name">
                        Company Name (Optional)
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🏢
                        </span>

                        <input
                            type="text"
                            id="company_name"
                            name="company_name"
                            class="form-control"
                            placeholder="Property Management Co."
                            value="{{ old('company_name') }}"
                        >

                    </div>


                    @error('company_name')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- EMAIL -->

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="owner@email.com"
                            value="{{ old('email') }}"
                            required
                        >

                    </div>


                    @error('email')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- PHONE NUMBER -->

                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            ☎
                        </span>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            class="form-control"
                            placeholder="+1 234 567 8900"
                            value="{{ old('phone') }}"
                            required
                        >

                    </div>


                    @error('phone')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >

                    </div>


                    @error('password')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- CONFIRM PASSWORD -->

                <div class="form-group">

                    <label for="password_confirmation">
                        Confirm Password
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >

                    </div>

                </div>


                <!-- CREATE ACCOUNT -->

                <button
                    type="submit"
                    class="create-button"
                >

                    Create Account

                </button>


            </form>


        </div>


    </div>


</body>

</html>
