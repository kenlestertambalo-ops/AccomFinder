<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#eef4fb;
            min-height:100vh;
            font-family:'Segoe UI',sans-serif;
        }

        .back-link{
            position:absolute;
            top:20px;
            left:20px;
            text-decoration:none;
            color:#6c757d;
            font-size:14px;
        }

        .login-card{
            width:390px;
            border:none;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,.12);
        }

        .icon-circle{
            width:52px;
            height:52px;
            background:#dbeafe;
            color:#2563eb;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            font-size:22px;
        }

        .form-control{
            height:45px;
        }

        .btn-login{
            background:#2563eb;
            color:white;
            border:none;
            height:45px;
            border-radius:8px;
            font-weight:600;
        }

        .btn-login:hover{
            background:#1d4ed8;
            color:white;
        }

        .small-link{
            text-decoration:none;
            font-weight:600;
        }
    </style>

</head>

<body>


<a href="{{ url('/') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Back to Home
</a>


<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card login-card">

        <div class="card-body p-4">


            <div class="text-center mb-4">

                <div class="icon-circle mb-3">
                    <i class="bi bi-envelope"></i>
                </div>

                <h4 class="fw-bold">
                    Student Login
                </h4>

                <p class="text-muted small">
                    Access your accommodation search portal
                </p>

            </div>



            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('student.login.post') }}">

                @csrf


                <!-- Email -->
                <div class="mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>


                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="student@email.com"
                            required
                        >

                    </div>

                </div>



                <!-- Password -->
                <div class="mb-4">

                    <label class="form-label">
                        Password
                    </label>


                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>


                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="********"
                            required
                        >

                    </div>

                </div>



                <button type="submit" class="btn btn-login w-100">
                    Sign In
                </button>


            </form>




            <div class="text-center mt-4">

                <small class="text-muted">
                    Don't have an account?
                </small>


                <a href="{{ route('student.register') }}" class="small-link">
                    Register
                </a>


            </div>


        </div>

    </div>

</div>


</body>
</html>
