<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccomFinder</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(to bottom, #f7f9fc, #eef9f5);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .portal-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: 0.3s;
            height: 100%;
        }

        .portal-card:hover {
            transform: translateY(-5px);
        }

        .owner-card {
            border: 2px solid #8be0b0;
        }

        .icon-circle {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .student-icon {
            background: #e7f0ff;
            color: #3b82f6;
        }

        .owner-icon {
            background: #dff7e8;
            color: #10b981;
        }

        .portal-link {
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .student-link {
            color: #3b82f6;
        }

        .owner-link {
            color: #10b981;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            AccomFinder
        </h1>

        <p class="text-muted">
            Student Accommodation Finder & Management System
        </p>

    </div>


    <div class="row justify-content-center g-4">


        <!-- =====================================================
             STUDENT PORTAL
        ====================================================== -->

        <div class="col-md-4 col-lg-3">

            <div class="card portal-card p-4">

                <div class="icon-circle student-icon">

                    <i class="bi bi-person fs-4"></i>

                </div>

                <h5 class="fw-semibold">
                    Student Portal
                </h5>

                <p class="text-muted small">
                    Find your perfect accommodation, search listings,
                    and manage inquiries.
                </p>

                <a
                    href="{{ route('student.login') }}"
                    class="portal-link student-link"
                >
                    Enter Portal →
                </a>

            </div>

        </div>


        <!-- =====================================================
             OWNER PORTAL
        ====================================================== -->

        <div class="col-md-4 col-lg-3">

            <div class="card portal-card owner-card p-4">

                <div class="icon-circle owner-icon">

                    <i class="bi bi-building fs-4"></i>

                </div>

                <h5 class="fw-semibold">
                    Owner Portal
                </h5>

                <p class="text-muted small">
                    Manage your properties, tenants,
                    and track payments efficiently.
                </p>

                <a
                    href="{{ route('owner.login') }}"
                    class="portal-link owner-link"
                >
                    Enter Portal →
                </a>

            </div>

        </div>


    </div>

</div>

</body>
</html>
