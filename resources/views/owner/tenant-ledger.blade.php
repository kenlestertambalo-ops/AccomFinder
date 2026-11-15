<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Ledger | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f5f8fc;
            font-family: Arial, Helvetica, sans-serif;
            color: #132238;
        }

        .sidebar {
            width: 264px;
            height: 100vh;
            background: white;
            border-right: 1px solid #dce3eb;
            position: fixed;
            left: 0;
            top: 0;
        }

        .logo {
            height: 138px;
            padding: 35px 26px 20px;
            border-bottom: 1px solid #dce3eb;
        }

        .logo h2 {
            margin: 0;
            font-size: 29px;
            font-weight: 700;
            color: #168d68;
        }

        .logo h2 span { color: #193e67; }

        .logo small {
            color: #66758a;
            font-size: 14px;
            font-weight: 600;
        }

        .menu { padding: 38px 5px; }

        .menu a, .bottom a {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            padding: 14px 26px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 16px;
        }

        .menu a:hover, .menu a.active {
            background: #cdf8e6;
            color: #078e62;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
        }

        .bottom {
            position: absolute;
            bottom: 22px;
            width: 100%;
        }

        .content {
            margin-left: 264px;
            min-height: 100vh;
        }

        .topbar {
            height: 74px;
            background: white;
            border-bottom: 1px solid #dce3eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .owner-name { font-weight: 600; }

        .main { padding: 35px 30px 50px; }

        .back-link {
            color: #14945f;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 34px;
            font-weight: 600;
            color: #17395f;
        }

        .page-title p {
            margin-top: 8px;
            color: #718096;
        }

        .tenant-info {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px 24px;
            margin-top: 25px;
        }

        .tenant-info h5 {
            color: #17395f;
            font-weight: 600;
        }

        .tenant-info p {
            color: #718096;
            margin: 7px 0;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 18px;
            margin-top: 24px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            padding: 21px;
        }

        .summary-card p {
            color: #718096;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .summary-card h3 {
            font-size: 25px;
            font-weight: 700;
            margin: 0;
        }

        .debit-color { color: #dc6b21; }
        .credit-color { color: #14945f; }
        .balance-color { color: #2563eb; }

        .ledger-container {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            margin-top: 28px;
            overflow: hidden;
        }

        .ledger-header {
            padding: 22px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .ledger-header h4 {
            margin: 0;
            color: #17395f;
            font-weight: 600;
        }

        .table-responsive { padding: 0 20px 20px; }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
            min-width: 750px;
        }

        .table thead th {
            background: #f3f7fb;
            color: #506176;
            font-size: 13px;
            font-weight: 700;
            padding: 15px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 16px 15px;
            color: #40536b;
            font-size: 14px;
        }

        .debit {
            color: #dc6b21 !important;
            font-weight: 600;
        }

        .credit {
            color: #14945f !important;
            font-weight: 600;
        }

        .running-balance {
            color: #17395f !important;
            font-weight: 700;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #718096;
        }

        .empty-state i {
            font-size: 42px;
            color: #b9c7d8;
        }

        .balance-box {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            margin-top: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .balance-box p {
            margin: 0 0 6px;
            color: #718096;
        }

        .balance-box h2 {
            margin: 0;
            color: #dc6b21;
            font-weight: 700;
        }

        .record-button {
            background: #14945f;
            border: none;
            color: white;
            padding: 11px 18px;
            border-radius: 9px;
            font-weight: 600;
        }

        .record-button:hover {
            background: #0d7e50;
        }

        @media(max-width: 850px) {
            .sidebar { width: 220px; }
            .content { margin-left: 220px; }
        }

        @media(max-width: 650px) {
            .sidebar { display: none; }
            .content { margin-left: 0; }
            .main { padding: 25px 18px; }
            .page-title h1 { font-size: 27px; }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <h2><span>Accom</span>Finder</h2>
        <small>Owner Portal</small>
    </div>

    <div class="menu">

        <a href="{{ route('owner.dashboard') }}">
            <span class="menu-icon"><i class="bi bi-house-door"></i></span>
            Dashboard
        </a>

        <a href="{{ route('owner.listings') }}">
            <span class="menu-icon"><i class="bi bi-buildings"></i></span>
            Listings
        </a>

        <a href="{{ route('owner.tenants') }}" class="active">
            <span class="menu-icon"><i class="bi bi-people"></i></span>
            Tenants
        </a>

        <a href="{{ route('owner.payments') }}">
            <span class="menu-icon"><i class="bi bi-cash-stack"></i></span>
            Payments
        </a>

        <a href="{{ route('owner.reports') }}">
            <span class="menu-icon"><i class="bi bi-bar-chart"></i></span>
            Reports
        </a>

        <a href="{{ route('owner.messages') }}">
            <span class="menu-icon"><i class="bi bi-chat-dots"></i></span>
            Messages
        </a>

    </div>

    <div class="bottom">
        <a href="{{ route('owner.logout') }}">
            <span class="menu-icon"><i class="bi bi-box-arrow-right"></i></span>
            Logout
        </a>
    </div>

</div>

<!-- MAIN CONTENT -->
<div class="content">

    <div class="topbar">
        <div class="owner-name">
            {{ session('owner_name', 'Owner') }}
        </div>
    </div>

    <div class="main">

        <!-- BACK TO TENANT SELECTION -->
        <a
            href="{{ route('owner.tenants.ledger.tenants', [
                'accommodation' => $tenant->accommodation_id,
                'room' => $tenant->room_id
            ]) }}"
            class="back-link"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Tenant Selection
        </a>

        <div class="page-title">
            <h1>
                <i class="bi bi-journal-text me-2"></i>
                Rental Ledger
            </h1>
            <p>Complete rental charges, payments, and outstanding balance.</p>
        </div>

        <!-- SUCCESS / ERROR MESSAGES -->
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- TENANT INFORMATION -->
        <div class="tenant-info">

            <h5>{{ $tenant->name }}</h5>

            <p>
                <i class="bi bi-building me-2"></i>
                Property: {{ $tenant->accommodation->name ?? 'N/A' }}
            </p>

            <p>
                <i class="bi bi-door-closed me-2"></i>
                Room: {{ $tenant->room->room_name ?? 'N/A' }}
            </p>

            <p>
                <i class="bi bi-envelope me-2"></i>
                {{ $tenant->email }}
            </p>

            <p>
                <i class="bi bi-currency-peso me-2"></i>
                Monthly Rental: ₱{{ number_format((float) $tenant->monthly_rent, 2) }}
            </p>

            <p>
                <i class="bi bi-calendar-event me-2"></i>
                Due Date: Every {{ $tenant->due_day ?? 5 }} of the month
            </p>

        </div>

        <!-- LEDGER SUMMARY -->
        <div class="summary-grid">

            <div class="summary-card">
                <p>Total Charges (Debit)</p>
                <h3 class="debit-color">
                    ₱{{ number_format($totalCharges ?? 0, 2) }}
                </h3>
            </div>

            <div class="summary-card">
                <p>Total Payments (Credit)</p>
                <h3 class="credit-color">
                    ₱{{ number_format($totalPaid ?? 0, 2) }}
                </h3>
            </div>

            <div class="summary-card">
                <p>Outstanding Balance</p>
                <h3 class="balance-color">
                    ₱{{ number_format($outstandingBalance ?? 0, 2) }}
                </h3>
            </div>

        </div>

        <!-- TRANSACTION HISTORY -->
        <div class="ledger-container">

            <div class="ledger-header">

                <h4>
                    <i class="bi bi-list-ul me-2"></i>
                    Transaction History
                </h4>

                <button
                    type="button"
                    class="record-button"
                    data-bs-toggle="modal"
                    data-bs-target="#recordPaymentModal"
                >
                    <i class="bi bi-plus-circle me-1"></i>
                    Record Payment
                </button>

            </div>

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                            <th class="text-end">Balance</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($ledger ?? [] as $entry)

                            <tr>

                                <td>
                                    {{ \Carbon\Carbon::parse($entry['date'])->format('M d, Y') }}
                                </td>

                                <td>
                                    {{ $entry['particulars'] }}
                                </td>

                                <td class="text-end debit">
                                    @if(($entry['debit'] ?? 0) > 0)
                                        ₱{{ number_format($entry['debit'], 2) }}
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-end credit">
                                    @if(($entry['credit'] ?? 0) > 0)
                                        ₱{{ number_format($entry['credit'], 2) }}
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-end running-balance">
                                    ₱{{ number_format($entry['balance'], 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-journal-x"></i>
                                        <h5 class="mt-3">No Transactions Yet</h5>
                                        <p>
                                            Rental charges and payments will appear here.
                                        </p>
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- OUTSTANDING BALANCE -->
        <div class="balance-box">

            <div>
                <p>Outstanding Balance</p>

                <h2>
                    ₱{{ number_format($outstandingBalance ?? 0, 2) }}
                </h2>
            </div>

            <div>
                @if(($outstandingBalance ?? 0) <= 0)
                    <span class="badge bg-success p-2">
                        <i class="bi bi-check-circle me-1"></i>
                        Fully Paid
                    </span>
                @else
                    <span class="badge bg-warning text-dark p-2">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Balance Due
                    </span>
                @endif
            </div>

        </div>

    </div>

</div>

<!-- RECORD PAYMENT MODAL -->
<div class="modal fade" id="recordPaymentModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="POST" action="{{ route('owner.payments.store') }}">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-cash-stack me-2"></i>
                        Record Tenant Payment
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>
                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="tenant_id"
                        value="{{ $tenant->id }}"
                    >

                    <div class="mb-3">
                        <label class="form-label">Tenant</label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $tenant->name }}"
                            readonly
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Billing Month</label>

                        <input
                            type="month"
                            name="billing_month"
                            class="form-control"
                            value="{{ now()->format('Y-m') }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount Received (₱)</label>

                        <input
                            type="number"
                            name="amount"
                            class="form-control"
                            min="0.01"
                            step="0.01"
                            placeholder="Enter amount received"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Date</label>

                        <input
                            type="date"
                            name="payment_date"
                            class="form-control"
                            value="{{ now()->format('Y-m-d') }}"
                            required
                        >
                    </div>

                    <input type="hidden" name="status" value="Paid">

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i>
                        Save Payment
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
