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

body{
    background:#eef4fb;
    min-height:100vh;
    font-family:'Segoe UI',sans-serif;
}

.back-link{
    position:absolute;
    top:20px;
    left:20px;
    color:#6c757d;
    text-decoration:none;
    font-size:14px;
}

.back-link:hover{
    color:#2563eb;
}

.register-card{
    width:400px;
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
    justify-content:center;
    align-items:center;
    margin:auto;
    font-size:22px;
}

.form-control{
    height:45px;
}

.input-group-text{
    background:#fff;
}

.btn-register{
    background:#2563eb;
    color:#fff;
    border:none;
    height:45px;
    font-weight:600;
}

.btn-register:hover{
    background:#1d4ed8;
    color:white;
}

.alert-error{
    background:#fff1f2;
    border:1px solid #fecdd3;
    color:#dc2626;
    border-radius:8px;
    padding:10px 12px;
    font-size:13px;
    margin-bottom:15px;
}

.field-error{
    color:#dc2626;
    font-size:12px;
    margin-top:5px;
}

</style>

</head>


<body>


<!-- =========================
     BACK TO LOGIN
========================= -->

<a
    href="{{ route('student.login') }}"
    class="back-link"
>

    <i class="bi bi-arrow-left"></i>

    Back to Login

</a>


<!-- =========================
     REGISTER CONTAINER
========================= -->

<div class="container d-flex justify-content-center align-items-center py-5">


    <div class="card register-card">


        <div class="card-body p-4">


            <!-- =========================
                 TITLE
            ========================= -->

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


            <!-- =========================
                 ERROR MESSAGE
            ========================= -->

            @if(session('error'))

                <div class="alert-error">

                    {{ session('error') }}

                </div>

            @endif


            <!-- =========================
                 VALIDATION ERRORS
            ========================= -->

            @if($errors->any())

                <div class="alert-error">

                    <strong>
                        Please fix the following:
                    </strong>

                    <ul class="mb-0 mt-2 ps-3">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- =========================
                 REGISTER FORM
            ========================= -->

            <form
                method="POST"
                action="{{ route('student.register.submit') }}"
            >

                @csrf


                <!-- =========================
                     STUDENT ID
                ========================= -->

                <div class="mb-3">

                    <label class="form-label">
                        ID Number
                    </label>


                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-person"></i>

                        </span>


                        <input
                            type="text"
                            name="student_id"
                            class="form-control"
                            placeholder="****-**-****"
                            value="{{ old('student_id') }}"
                            required
                        >

                    </div>


                    @error('student_id')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- =========================
                     FULL NAME
                ========================= -->

                <div class="mb-3">

                    <label class="form-label">
                        Full Name
                    </label>


                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-person"></i>

                        </span>


                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="John Doe"
                            value="{{ old('name') }}"
                            required
                        >

                    </div>


                    @error('name')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- =========================
                     EMAIL
                ========================= -->

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
                            value="{{ old('email') }}"
                            required
                        >

                    </div>


                    @error('email')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- =========================
                     PHONE
                ========================= -->

                <div class="mb-3">

                    <label class="form-label">
                        Phone Number
                    </label>


                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-telephone"></i>

                        </span>


                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            placeholder="09123456789"
                            value="{{ old('phone') }}"
                            required
                        >

                    </div>


                    @error('phone')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- =========================
                     PASSWORD
                ========================= -->

                <div class="mb-3">

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


                    @error('password')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- =========================
                     CONFIRM PASSWORD
                ========================= -->

                <div class="mb-4">

                    <label class="form-label">
                        Confirm Password
                    </label>


                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-lock"></i>

                        </span>


                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="********"
                            required
                        >

                    </div>

                </div>


                <!-- =========================
                     CREATE ACCOUNT
                ========================= -->

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


</body>

</html>
