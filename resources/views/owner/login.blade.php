<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

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


        /* =========================
           BACK TO HOME
        ========================= */

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


        /* =========================
           LOGIN CARD
        ========================= */

        .login-card {

            width: 390px;

            border: none;

            border-radius: 15px;

            box-shadow:
                0 10px 30px
                rgba(0, 0, 0, .12);

        }


        /* =========================
           ICON
        ========================= */

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


        /* =========================
           INPUT
        ========================= */

        .form-control {

            height: 45px;

        }


        /* =========================
           LOGIN BUTTON
        ========================= */

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


        /* =========================
           REGISTER LINK
        ========================= */

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


        /* =========================
           ERROR
        ========================= */

        .error-message {

            color: #dc3545;

            font-size: 13px;

            margin-top: 5px;

        }


        /* =========================
           SUCCESS
        ========================= */

        .success-message {

            background: #dcfce7;

            color: #15803d;

            border-radius: 8px;

            padding: 10px 12px;

            margin-bottom: 15px;

            font-size: 14px;

        }

    </style>

</head>


<body>


    <!-- =========================
         BACK TO HOME
    ========================= -->

    <a
        href="{{ url('/') }}"
        class="back-link"
    >

        <i class="bi bi-arrow-left"></i>

        Back to Home

    </a>


    <!-- =========================
         LOGIN CONTAINER
    ========================= -->

    <div
        class="container d-flex justify-content-center align-items-center vh-100"
    >


        <div class="card login-card">


            <div class="card-body p-4">


                <!-- =========================
                     HEADER
                ========================= -->

                <div class="text-center mb-4">


                    <div class="icon-circle mb-3">

                        <i class="bi bi-building"></i>

                    </div>


                    <h4 class="fw-bold">

                        Owner Login

                    </h4>


                    <p class="text-muted small">

                        Manage your accommodation listings

                    </p>


                </div>


                <!-- =========================
                     SUCCESS MESSAGE
                ========================= -->

                @if(session('success'))

                    <div class="success-message">

                        {{ session('success') }}

                    </div>

                @endif


                <!-- =========================
                     LOGIN FORM
                ========================= -->

                <form
                    action="{{ route('owner.login.post') }}"
                    method="POST"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div class="mb-3">


                        <label
                            for="email"
                            class="form-label"
                        >

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
                                value="{{ old('email') }}"
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

                    <div class="mb-4">


                        <label
                            for="password"
                            class="form-label"
                        >

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
                                class="form-control"
                                placeholder="********"
                                required
                            >


                        </div>


                        @error('password')

                            <div class="error-message">

                                {{ $message }}

                            </div>

                        @enderror


                    </div>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="btn btn-login w-100"
                    >

                        Sign In

                    </button>


                </form>


                <!-- =========================
                     REGISTER
                ========================= -->

                <div class="text-center mt-4">


                    <small class="text-muted">

                        Don't have an account?

                    </small>


                    <a
                        href="{{ route('owner.register') }}"
                        class="small-link"
                    >

                        Register

                    </a>


                </div>


            </div>

        </div>


    </div>


</body>

</html>
