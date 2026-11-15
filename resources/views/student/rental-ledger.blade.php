<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Rental Ledger | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        html, body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f5f7fb;
            color: #333;
        }

        /* SIDEBAR - SAME AS STUDENT DASHBOARD */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #ddd;
            z-index: 1000;
        }

        .logo {
            height: 145px;
            padding: 25px;
            border-bottom: 1px solid #eee;
        }

        .logo h2 {
            margin: 0;
            color: #2563eb;
            font-size: 30px;
            font-weight: 700;
        }

        .logo p {
            margin-top: 5px;
            color: gray;
            font-size: 16px;
        }

        .menu {
            padding: 20px;
        }

        .menu a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            transition: 0.2s ease;
        }

        .menu a:hover {
            background: #f1f5f9;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
        }

        /* LOGOUT */

        .logout {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        .logout a {
            display: block;
            padding: 12px 15px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        .logout a:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        /* MAIN AREA */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background: #f5f7fb;
        }

        /* TOP BAR - SAME AS STUDENT DASHBOARD */

        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            z-index: 900;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-info strong {
            font-size: 20px;
            color: #111;
            font-weight: 700;
        }

        .user-info span {
            margin-top: 3px;
            font-size: 17px;
            color: #111;
        }

        /* LEDGER CONTENT */

        .content {
            padding: 110px 40px 40px 40px;
        }

        .back-link {
            color: #159466;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .back-link:hover {
            color: #10734f;
        }

        .page-title {
            margin-bottom: 5px;
            color: #19324e;
            font-size: 32px;
            font-weight: 700;
        }

        .subtitle {
            color: #718096;
            margin-bottom: 25px;
            font-size: 16px;
        }

        /* READ ONLY NOTICE */

        .read-only-note {
            background: #eff6ff;
            color: #1e40af;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        /* SUMMARY CARDS */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            padding: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
        }

        .summary-card small {
            color: #718096;
            display: block;
            margin-bottom: 9px;
        }

        .summary-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: #19324e;
        }

        /* LEDGER TABLE */

        .ledger-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
        }

        .ledger-heading {
            padding: 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .ledger-heading h4 {
            font-weight: 700;
            margin: 0;
            color: #19324e;
        }

        .table-responsive {
            padding: 10px 20px 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background: #f5f8fc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table td,
        .table th {
            padding: 15px;
            vertical-align: middle;
        }

        .debit {
            color: #dc3545;
            font-weight: 600;
        }

        .credit {
            color: #159466;
            font-weight: 600;
        }

        .balance {
            font-weight: 700;
        }

        /* EMPTY STATE */

        .empty-card {
            background: white;
            padding: 55px 25px;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .empty-card h4 {
            margin-top: 15px;
            font-weight: 700;
        }

        .empty-card p {
            color: #718096;
        }

        /* RESPONSIVE - SAME BREAKPOINTS AS DASHBOARD */

        @media (max-width: 800px) {
            .sidebar {
                width: 220px;
            }

            .navbar {
                left: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .navbar {
                position: relative;
                left: 0;
                height: 70px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .content {
                padding: 30px 20px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .logout {
                position: relative;
                padding: 10px 0;
            }

            .table-responsive {
                padding: 10px;
            }

            .page-title {
                font-size: 27px;
            }

            .user-info strong {
                font-size: 17px;
            }

            .user-info span {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <h2>AccomFinder</h2>
            <p>Student Portal</p>
        </div>

        <div class="menu">

            <a href="{{ route('student.dashboard') }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('student.search') }}">
                🔍 Search
            </a>

            <a href="{{ route('student.saved') }}">
                ❤️ Saved
            </a>

            <a href="{{ route('student.messages') }}">
                💬 Messages
            </a>

            <a href="{{ route('student.rental-ledger') }}" class="active">
                🧾 My Rental Ledger
            </a>

        </div>

        <div class="logout">

            <a href="{{ route('student.logout') }}">
                🚪 Logout
            </a>

        </div>

    </div>

    <!-- MAIN AREA -->

    <div class="main">

        <!-- TOP BAR -->

        <div class="navbar">

            <div class="user">

                <div class="user-info">

                    <strong>
                        {{ session('student_name', 'Student') }}
                    </strong>

                    <span>
                        {{ session('student_email', 'Welcome') }}
                    </span>

                </div>

            </div>

        </div>

        <!-- LEDGER CONTENT -->

        <div class="content">

            <a href="{{ route('student.dashboard') }}" class="back-link">
                ← Back to Dashboard
            </a>

            <h1 class="page-title">
                My Rental Ledger
            </h1>

            <p class="subtitle">
                View your monthly rental charges, recorded payments, and outstanding balance.
            </p>

            @if(isset($ledgerError))

                <div class="alert alert-warning">
                    {{ $ledgerError }}
                </div>

            @elseif(!$tenant)

                <div class="empty-card">

                    <div class="empty-icon">🧾</div>

                    <h4>No Rental Ledger Assigned</h4>

                    <p>
                        Your property owner has not assigned your account to view a rental ledger yet.
                        Please contact your property owner for assistance.
                    </p>

                </div>

            @else

                <!-- READ ONLY NOTICE -->

                <div class="read-only-note">
                    🔒 This ledger is read-only. Only your property owner can record or update payments.
                </div>

                <!-- SUMMARY CARDS -->

                <div class="summary-grid">

                    <div class="summary-card">
                        <small>Total Rental Charges</small>
                        <h3>₱{{ number_format($totalCharges, 2) }}</h3>
                    </div>

                    <div class="summary-card">
                        <small>Total Payments</small>
                        <h3>₱{{ number_format($totalPaid, 2) }}</h3>
                    </div>

                    <div class="summary-card">
                        <small>Outstanding Balance</small>
                        <h3>₱{{ number_format($outstandingBalance, 2) }}</h3>
                    </div>

                </div>

                <!-- RENTAL TRANSACTION HISTORY -->

                <div class="ledger-card">

                    <div class="ledger-heading">

                        <h4>Rental Transaction History</h4>

                        <p class="text-muted mb-0 mt-2">
                            {{ $tenant->name }}

                            @if($tenant->accommodation)
                                | {{ $tenant->accommodation->name }}
                            @endif

                            @if($tenant->room)
                                | {{ $tenant->room->room_name }}
                            @endif
                        </p>

                    </div>

                    @if($ledger->count() > 0)

                        <div class="table-responsive">

                            <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($ledger as $entry)

                                        <tr>

                                            <td>
                                                {{ $entry['date']->format('M d, Y') }}
                                            </td>

                                            <td>
                                                {{ $entry['particulars'] }}
                                            </td>

                                            <td class="debit">
                                                @if($entry['debit'] > 0)
                                                    ₱{{ number_format($entry['debit'], 2) }}
                                                @else
                                                    —
                                                @endif
                                            </td>

                                            <td class="credit">
                                                @if($entry['credit'] > 0)
                                                    ₱{{ number_format($entry['credit'], 2) }}
                                                @else
                                                    —
                                                @endif
                                            </td>

                                            <td class="balance">
                                                ₱{{ number_format($entry['balance'], 2) }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="p-4 text-center text-muted">
                            No rental transactions are available yet.
                        </div>

                    @endif

                </div>

            @endif

        </div>

    </div>

</body>
</html>
