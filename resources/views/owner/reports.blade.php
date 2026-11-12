
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Reports | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

    <style>
        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body {
            background: #f5f8fc;
            font-family: Arial, sans-serif;
            color: #132238;
            overflow: hidden;
        }

        .sidebar {
            width: 264px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dce3eb;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
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
            letter-spacing: -1px;
        }

        .logo h2 span { color: #193e67; }

        .logo small {
            display: block;
            margin-top: -3px;
            color: #66758a;
            font-size: 14px;
            font-weight: 600;
        }

        .menu { padding: 38px 5px; }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            padding: 14px 26px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 16px;
            transition: .2s;
        }

        .menu a:hover {
            background: #eefaf5;
            color: #009b68;
        }

        .menu a.active {
            background: #cdf8e6;
            color: #078e62;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 18px;
        }

        .bottom {
            position: absolute;
            bottom: 22px;
            width: 100%;
            padding: 0 5px;
        }

        .bottom a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 21px;
            color: #30435c;
            text-decoration: none;
            font-size: 16px;
            border-radius: 11px;
        }

        .bottom a:hover {
            color: #dc3545;
            background: #fff5f5;
        }

        .content {
            margin-left: 264px;
            width: calc(100% - 264px);
            height: 100vh;
            overflow: hidden;
        }

        .topbar {
            width: calc(100% - 264px);
            height: 74px;
            background: #fff;
            border-bottom: 1px solid #dce3eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
            position: fixed;
            top: 0;
            right: 0;
            left: 264px;
            z-index: 900;
        }

        .bell {
            font-size: 23px;
            margin-right: 28px;
            color: #172334;
        }

        .owner-name {
            font-size: 16px;
            font-weight: 600;
            color: #172334;
        }

        .main {
            height: calc(100vh - 74px);
            margin-top: 74px;
            padding: 35px 24px 60px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 38px;
            font-weight: 500;
            color: #132238;
        }

        .page-header p {
            margin: 8px 0 0;
            color: #5d7089;
            font-size: 16px;
        }

        .download-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #14945f;
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .download-btn:hover { background: #0f7d50; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 24px;
            min-height: 180px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .icon-box {
            width: 58px;
            height: 58px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 18px;
        }

        .green { background: #d1fae5; color: #198754; }
        .blue { background: #dbeafe; color: #2563eb; }
        .orange { background: #ffedd5; color: #ea580c; }
        .purple { background: #f3e8ff; color: #9333ea; }
        .red { background: #fee2e2; color: #dc2626; }
        .teal { background: #ccfbf1; color: #0f766e; }

        .stat-card h2 {
            margin: 0 0 8px;
            font-size: 27px;
            font-weight: 600;
            color: #132238;
            overflow-wrap: anywhere;
        }

        .stat-card p {
            margin: 0;
            font-size: 15px;
            color: #66778c;
        }

        .report-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            margin-top: 30px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .section-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #17395f;
        }

        .section-header p {
            margin: 5px 0 0;
            color: #66778c;
            font-size: 13px;
        }

        .section-divider {
            border: 0;
            border-top: 1px solid #e1e6ec;
            margin: 20px 0 25px;
        }

        .chart-wrapper {
            width: 100%;
            height: 350px;
            position: relative;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .report-table th {
            background: #f8fafc;
            color: #17395f;
            font-size: 14px;
            font-weight: 600;
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            white-space: nowrap;
        }

        .report-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #edf1f5;
            color: #4c6078;
            font-size: 14px;
            vertical-align: middle;
        }

        .report-table tbody tr:hover { background: #f8fafc; }

        .status-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-paid { background: #d1fae5; color: #047857; }
        .status-pending { background: #ffedd5; color: #c2410c; }
        .status-overdue { background: #fee2e2; color: #b91c1c; }
        .status-active { background: #dbeafe; color: #1d4ed8; }

        .money-positive { color: #047857; font-weight: 600; }
        .money-negative { color: #dc2626; font-weight: 600; }

        .empty-row {
            text-align: center !important;
            padding: 28px !important;
            color: #94a3b8 !important;
        }

        .report-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .info-box {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
        }

        .info-box h3 {
            margin: 0 0 8px;
            font-size: 15px;
            font-weight: 600;
            color: #17395f;
        }

        .info-box p {
            margin: 0;
            font-size: 21px;
            font-weight: 600;
            color: #132238;
        }

        .info-box small {
            display: block;
            margin-top: 6px;
            color: #64748b;
        }

        /* MODALS */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 5000;
            padding: 20px;
        }

        .modal-overlay.show { display: flex; }

        .report-modal {
            width: 100%;
            max-width: 540px;
            max-height: 90vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .report-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .report-modal-header h2 {
            margin: 0;
            font-size: 22px;
            color: #17395f;
            font-weight: 600;
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border: none;
            background: #f1f5f9;
            color: #475569;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
        }

        .report-modal-body { padding: 22px 24px; }

        .modal-description {
            margin: 0 0 18px;
            color: #64748b;
            font-size: 14px;
        }

        .select-all,
        .report-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .select-all {
            background: #f8fafc;
            font-weight: 600;
        }

        .report-option:hover {
            background: #f8fafc;
            border-color: #b9e7d4;
        }

        .select-all input,
        .report-option input {
            width: 18px;
            height: 18px;
            accent-color: #14945f;
            cursor: pointer;
            flex-shrink: 0;
        }

        .report-option-content { flex: 1; }

        .report-option-title {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
        }

        .report-option-description {
            display: block;
            margin-top: 3px;
            font-size: 12px;
            color: #64748b;
        }

        .report-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 18px 24px;
            border-top: 1px solid #e5e7eb;
        }

        .cancel-btn {
            border: 1px solid #cbd5e1;
            background: #fff;
            color: #475569;
            border-radius: 9px;
            padding: 11px 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .generate-btn {
            border: none;
            background: #14945f;
            color: #fff;
            border-radius: 9px;
            padding: 11px 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .generate-btn:hover { background: #0f7d50; }

        .generate-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .modal-message {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #fff7ed;
            color: #c2410c;
            font-size: 13px;
        }

        /* PDF PREVIEW */
        .preview-modal {
            width: 100%;
            max-width: 1100px;
            height: 90vh;
            background: #fff;
            border-radius: 18px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
        }

        .preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid #e5e7eb;
            flex-shrink: 0;
        }

        .preview-header h2 {
            margin: 0;
            font-size: 21px;
            color: #17395f;
            font-weight: 600;
        }

        .preview-content {
            flex: 1;
            min-height: 0;
            padding: 12px;
            background: #e9eef4;
        }

        .preview-content iframe {
            width: 100%;
            height: 100%;
            border: 1px solid #dce3eb;
            border-radius: 8px;
            background: white;
        }

        .preview-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 15px 24px;
            border-top: 1px solid #e5e7eb;
            flex-shrink: 0;
        }

        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 800px) {
            .sidebar { width: 220px; }
            .content { margin-left: 220px; width: calc(100% - 220px); }
            .topbar { left: 220px; width: calc(100% - 220px); }
            .report-info { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            body { overflow: auto; }
            .sidebar { display: none; }
            .content { margin-left: 0; width: 100%; }
            .topbar { left: 0; width: 100%; }
            .main { padding: 30px 18px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .page-header h1 { font-size: 30px; }
            .download-btn { width: 100%; }
            .stats-grid { grid-template-columns: 1fr; }
            .report-section { padding: 18px; }
            .preview-modal { height: 95vh; }
        }
    </style>
</head>

<body>

<aside class="sidebar">
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

        <a href="{{ route('owner.tenants') }}">
            <span class="menu-icon"><i class="bi bi-people"></i></span>
            Tenants
        </a>

        <a href="{{ route('owner.payments') }}">
            <span class="menu-icon"><i class="bi bi-currency-dollar"></i></span>
            Payments
        </a>

        <a href="{{ route('owner.reports') }}" class="active">
            <span class="menu-icon"><i class="bi bi-bar-chart-line"></i></span>
            Reports
        </a>

        <a href="{{ route('owner.messages') }}">
            <span class="menu-icon"><i class="bi bi-chat-square"></i></span>
            Messages
        </a>
    </div>

    <div class="bottom">
        <a href="{{ route('owner.logout') }}">
            <span class="menu-icon"><i class="bi bi-box-arrow-right"></i></span>
            Logout
        </a>
    </div>
</aside>

<div class="content">

    <header class="topbar">
        <div class="bell">
            <i class="bi bi-bell"></i>
        </div>

        <div class="owner-name">
            {{ session('owner_name', 'Owner') }}
        </div>
    </header>

    <main class="main">

        <div class="page-header">
            <div>
                <h1>Owner Reports</h1>
                <p>Revenue, monthly rent, outstanding balances, and tenant reports</p>
            </div>

            <button type="button" id="downloadReportBtn" class="download-btn">
                <i class="bi bi-file-earmark-pdf"></i>
                Generate Report
            </button>
        </div>

        <!-- STATISTICS -->
        <div class="stats-grid">

            <div class="stat-card">
                <div class="icon-box green">
                    <i class="bi bi-buildings"></i>
                </div>
                <h2>{{ $totalListings }}</h2>
                <p>Total Listings</p>
            </div>

            <div class="stat-card">
                <div class="icon-box blue">
                    <i class="bi bi-people"></i>
                </div>
                <h2>{{ $totalTenants }}</h2>
                <p>Total Tenants</p>
            </div>

            <div class="stat-card">
                <div class="icon-box orange">
                    <i class="bi bi-credit-card"></i>
                </div>
                <h2>{{ $totalPayments }}</h2>
                <p>Payment Records</p>
            </div>

            <div class="stat-card">
                <div class="icon-box purple">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h2>₱{{ number_format($totalRevenue, 2) }}</h2>
                <p>Total Rent Collected</p>
            </div>

            <div class="stat-card">
                <div class="icon-box red">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h2>₱{{ number_format($totalOutstanding, 2) }}</h2>
                <p>Total Outstanding Rent</p>
            </div>

            <div class="stat-card">
                <div class="icon-box orange">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h2>{{ $overdueMonths }}</h2>
                <p>Overdue Rent Months</p>
            </div>

            <div class="stat-card">
                <div class="icon-box blue">
                    <i class="bi bi-person-exclamation"></i>
                </div>
                <h2>{{ $tenantsWithUnpaidRent }}</h2>
                <p>Tenants With Unpaid Rent</p>
            </div>

            <div class="stat-card">
                <div class="icon-box teal">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h2>{{ $pendingMonths }}</h2>
                <p>Unpaid or Partially Paid Months</p>
            </div>

        </div>

        <!-- REVENUE CHART -->
        <div class="report-section">
            <div class="section-header">
                <h2>Revenue Overview</h2>
                <p>Paid rent grouped by billing month for {{ $currentYear }}</p>
            </div>

            <hr class="section-divider">

            <div class="chart-wrapper">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- MONTHLY RENT STATUS -->
        <div class="report-section">
            <div class="section-header">
                <h2>Monthly Rent Status</h2>
                <p>Monthly rent obligations, payments, and remaining balances</p>
            </div>

            <hr class="section-divider">

            <div class="table-wrapper">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Tenant</th>
                            <th>Billing Month</th>
                            <th>Monthly Rent</th>
                            <th>Due Date</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ledger as $entry)
                            <tr>
                                <td>{{ $entry['tenant']->name }}</td>
                                <td>{{ $entry['billing_month']->format('F Y') }}</td>
                                <td>₱{{ number_format($entry['rent'], 2) }}</td>
                                <td>{{ $entry['due_date']->format('M d, Y') }}</td>
                                <td class="money-positive">₱{{ number_format($entry['paid'], 2) }}</td>
                                <td class="{{ $entry['balance'] > 0 ? 'money-negative' : 'money-positive' }}">
                                    ₱{{ number_format($entry['balance'], 2) }}
                                </td>
                                <td>
                                    @if($entry['status'] === 'Paid')
                                        <span class="status-badge status-paid">Paid</span>
                                    @elseif($entry['status'] === 'Overdue')
                                        <span class="status-badge status-overdue">Overdue</span>
                                    @else
                                        <span class="status-badge status-pending">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-row">No monthly rent records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- UNPAID RENT SUMMARY -->
        <div class="report-section">
            <div class="section-header">
                <h2>Unpaid Rent Summary</h2>
                <p>Tenants with outstanding monthly rent</p>
            </div>

            <hr class="section-divider">

            <div class="table-wrapper">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Tenant</th>
                            <th>Monthly Rent</th>
                            <th>Months Unpaid</th>
                            <th>Unpaid Months</th>
                            <th>Overdue Months</th>
                            <th>Outstanding Balance</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $hasUnpaidRecords = false; @endphp

                        @foreach($tenantSummaries as $summary)
                            @if($summary['unpaid_count'] > 0)
                                @php $hasUnpaidRecords = true; @endphp

                                <tr>
                                    <td>{{ $summary['tenant']->name }}</td>
                                    <td>₱{{ number_format($summary['monthly_rent'], 2) }}</td>
                                    <td>
                                        <span class="status-badge status-pending">
                                            {{ $summary['unpaid_count'] }}
                                        </span>
                                    </td>
                                    <td>{{ implode(', ', $summary['unpaid_months']) }}</td>
                                    <td>{{ $summary['overdue_count'] }}</td>
                                    <td class="money-negative">
                                        ₱{{ number_format($summary['outstanding'], 2) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @if(!$hasUnpaidRecords)
                            <tr>
                                <td colspan="6" class="empty-row">
                                    No outstanding rent balances.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LISTING INFORMATION -->
        <div class="report-section">
            <div class="section-header">
                <h2>Accommodation / Listing Information</h2>
            </div>

            <hr class="section-divider">

            <div class="table-wrapper">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reportListings as $listing)
                            <tr>
                                <td>{{ $listing->name }}</td>
                                <td>{{ $listing->address }}</td>
                                <td>{{ $listing->type ?? 'N/A' }}</td>
                                <td>₱{{ number_format($listing->price ?? 0, 2) }}</td>
                                <td>{{ $listing->capacity ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-active">
                                        {{ $listing->status ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-row">No accommodation listings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TENANT RECORDS -->
        <div class="report-section">
            <div class="section-header">
                <h2>Tenant Records</h2>
            </div>

            <hr class="section-divider">

            <div class="table-wrapper">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Accommodation</th>
                            <th>Monthly Rent</th>
                            <th>Due Day</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reportTenants as $tenant)
                            <tr>
                                <td>{{ $tenant->name }}</td>
                                <td>{{ $tenant->email ?? 'N/A' }}</td>
                                <td>{{ $tenant->phone ?? 'N/A' }}</td>
                                <td>{{ $tenant->accommodation->name ?? 'N/A' }}</td>
                                <td>₱{{ number_format($tenant->monthly_rent ?? 0, 2) }}</td>
                                <td>{{ $tenant->due_day ?? 5 }}</td>
                                <td>
                                    <span class="status-badge status-active">
                                        {{ $tenant->status ?? 'Active' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-row">No tenant records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAYMENT RECORDS -->
        <div class="report-section">
            <div class="section-header">
                <h2>Payment Records</h2>
                <p>Payment history with assigned billing months</p>
            </div>

            <hr class="section-divider">

            <div class="table-wrapper">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Tenant</th>
                            <th>Billing Month</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reportPayments as $payment)
                            <tr>
                                <td>{{ $payment->tenant->name ?? 'N/A' }}</td>
                                <td>
                                    {{ $payment->billing_month
                                        ? \Carbon\Carbon::parse($payment->billing_month)->format('F Y')
                                        : 'N/A' }}
                                </td>
                                <td>₱{{ number_format($payment->amount ?? 0, 2) }}</td>
                                <td>
                                    {{ $payment->payment_date
                                        ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y')
                                        : 'N/A' }}
                                </td>
                                <td>
                                    @if(strtolower(trim($payment->status ?? '')) === 'paid')
                                        <span class="status-badge status-paid">Paid</span>
                                    @elseif(strtolower(trim($payment->status ?? '')) === 'overdue')
                                        <span class="status-badge status-overdue">Overdue</span>
                                    @else
                                        <span class="status-badge status-pending">
                                            {{ ucfirst($payment->status ?? 'Pending') }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-row">No payment records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- REVENUE SUMMARY -->
        <div class="report-info">
            <div class="info-box">
                <h3>Weekly Revenue</h3>
                <p>₱{{ number_format($weeklyTotal, 2) }}</p>
                <small>Payments received this week</small>
            </div>

            <div class="info-box">
                <h3>Monthly Revenue</h3>
                <p>₱{{ number_format($monthlyTotal, 2) }}</p>
                <small>Paid rent assigned to {{ $currentYear }} billing months</small>
            </div>

            <div class="info-box">
                <h3>Yearly Revenue</h3>
                <p>₱{{ number_format($yearlyTotal, 2) }}</p>
                <small>Paid rent across all recorded years</small>
            </div>
        </div>

    </main>
</div>

<!-- REPORT SELECTION MODAL -->
<div id="reportModal" class="modal-overlay">
    <div class="report-modal">

        <div class="report-modal-header">
            <h2>Select Reports</h2>

            <button type="button" id="closeReportModal" class="modal-close">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="report-modal-body">

            <p class="modal-description">
                Select the report sections you want to include in your PDF preview.
            </p>

            <label class="select-all">
                <input type="checkbox" id="selectAllReports">
                <span>Select All Reports</span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="weekly">
                <span class="report-option-content">
                    <span class="report-option-title">Weekly Revenue Report</span>
                    <span class="report-option-description">Payments received this week</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="monthly">
                <span class="report-option-content">
                    <span class="report-option-title">Monthly Revenue Report</span>
                    <span class="report-option-description">Revenue by billing month</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="yearly">
                <span class="report-option-content">
                    <span class="report-option-title">Yearly Revenue Report</span>
                    <span class="report-option-description">Paid rent grouped by year</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="ledger">
                <span class="report-option-content">
                    <span class="report-option-title">Monthly Rent Status</span>
                    <span class="report-option-description">Rent due, payments, balances, and status</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="unpaid">
                <span class="report-option-content">
                    <span class="report-option-title">Unpaid Rent Summary</span>
                    <span class="report-option-description">Unpaid months and outstanding balances</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="listings">
                <span class="report-option-content">
                    <span class="report-option-title">Accommodation / Listing Information</span>
                    <span class="report-option-description">Your property records</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="tenants">
                <span class="report-option-content">
                    <span class="report-option-title">Tenant Records</span>
                    <span class="report-option-description">Tenant details and rent information</span>
                </span>
            </label>

            <label class="report-option">
                <input type="checkbox" class="report-checkbox" value="payments">
                <span class="report-option-content">
                    <span class="report-option-title">Payment Records</span>
                    <span class="report-option-description">Payment history with billing months</span>
                </span>
            </label>

            <div id="modalMessage" class="modal-message">
                Please select at least one report.
            </div>

        </div>

        <div class="report-modal-footer">
            <button type="button" id="cancelReport" class="cancel-btn">
                Cancel
            </button>

            <button type="button" id="generateReport" class="generate-btn">
                <i class="bi bi-eye"></i>
                Preview Report
            </button>
        </div>

    </div>
</div>

<!-- PDF PREVIEW MODAL -->
<div id="pdfPreviewModal" class="modal-overlay">

    <div class="preview-modal">

        <div class="preview-header">
            <h2>
                <i class="bi bi-file-earmark-pdf"></i>
                Report Preview
            </h2>

            <button type="button" id="closePdfPreview" class="modal-close">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="preview-content">
            <iframe
                id="pdfPreviewFrame"
                title="AccomFinder PDF Report Preview">
            </iframe>
        </div>

        <div class="preview-footer">
            <button type="button" id="backToReports" class="cancel-btn">
                Back
            </button>

            <button type="button" id="downloadPreviewPdf" class="generate-btn">
                <i class="bi bi-download"></i>
                Download PDF
            </button>
        </div>

    </div>

</div>

{{-- PREPARE PHP DATA SEPARATELY FROM JAVASCRIPT --}}
@php
    $reportListingsJson = $reportListings->map(function ($listing) {
        return [
            'name' => $listing->name,
            'address' => $listing->address,
            'type' => $listing->type ?? 'N/A',
            'price' => (float) $listing->price,
            'capacity' => $listing->capacity ?? 'N/A',
            'status' => $listing->status ?? 'N/A',
        ];
    })->values()->all();

    $reportTenantsJson = $reportTenants->map(function ($tenant) {
        return [
            'name' => $tenant->name,
            'email' => $tenant->email ?? 'N/A',
            'phone' => $tenant->phone ?? 'N/A',
            'accommodation' => $tenant->accommodation->name ?? 'N/A',
            'monthly_rent' => (float) $tenant->monthly_rent,
            'due_day' => $tenant->due_day ?? 5,
            'status' => $tenant->status ?? 'Active',
        ];
    })->values()->all();

    $reportPaymentsJson = $reportPayments->map(function ($payment) {
        return [
            'tenant' => $payment->tenant->name ?? 'N/A',
            'billing_month' => $payment->billing_month
                ? \Carbon\Carbon::parse($payment->billing_month)->format('F Y')
                : 'N/A',
            'amount' => (float) $payment->amount,
            'payment_date' => $payment->payment_date
                ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y')
                : 'N/A',
            'status' => $payment->status ?? 'Pending',
        ];
    })->values()->all();

    $ledgerJson = collect($ledger)->map(function ($entry) {
        return [
            'tenant' => $entry['tenant']->name,
            'billing_month' => $entry['billing_month']->format('F Y'),
            'rent' => (float) $entry['rent'],
            'due_date' => $entry['due_date']->format('M d, Y'),
            'paid' => (float) $entry['paid'],
            'balance' => (float) $entry['balance'],
            'status' => $entry['status'],
        ];
    })->values()->all();

    $unpaidJson = collect($tenantSummaries)
        ->filter(function ($summary) {
            return $summary['unpaid_count'] > 0;
        })
        ->map(function ($summary) {
            return [
                'tenant' => $summary['tenant']->name,
                'monthly_rent' => (float) $summary['monthly_rent'],
                'unpaid_count' => $summary['unpaid_count'],
                'unpaid_months' => implode(', ', $summary['unpaid_months']),
                'overdue_count' => $summary['overdue_count'],
                'outstanding' => (float) $summary['outstanding'],
            ];
        })->values()->all();
@endphp

<script>
    // DATA FROM LARAVEL
    const weeklyLabels = @json($weeklyLabels);
    const weeklyRevenue = @json($weeklyRevenue);

    const monthlyLabels = @json($monthlyLabels);
    const monthlyRevenue = @json($monthlyRevenue);

    const yearlyLabels = @json($yearlyLabels);
    const yearlyRevenue = @json($yearlyRevenue);

    const currentYear = @json($currentYear);
    const ownerName = @json(session('owner_name', 'Owner'));

    const weeklyTotal = @json($weeklyTotal);
    const monthlyTotal = @json($monthlyTotal);
    const yearlyTotal = @json($yearlyTotal);

    const totalRevenue = @json($totalRevenue);
    const totalOutstanding = @json($totalOutstanding);
    const tenantsWithUnpaidRent = @json($tenantsWithUnpaidRent);
    const overdueMonths = @json($overdueMonths);

    const reportListings = @json($reportListingsJson);
    const reportTenants = @json($reportTenantsJson);
    const reportPayments = @json($reportPaymentsJson);
    const ledgerData = @json($ledgerJson);
    const unpaidData = @json($unpaidJson);

    // REVENUE CHART
    const revenueCanvas = document.getElementById('revenueChart');

    if (revenueCanvas && typeof Chart !== 'undefined') {
        new Chart(revenueCanvas, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Paid Rent by Billing Month',
                    data: monthlyRevenue,
                    backgroundColor: '#14945f',
                    borderColor: '#0f7d50',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + Number(value).toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    // MODAL ELEMENTS
    const reportModal = document.getElementById('reportModal');
    const pdfPreviewModal = document.getElementById('pdfPreviewModal');

    const downloadReportBtn = document.getElementById('downloadReportBtn');
    const closeReportModal = document.getElementById('closeReportModal');
    const cancelReport = document.getElementById('cancelReport');

    const generateReport = document.getElementById('generateReport');
    const selectAllReports = document.getElementById('selectAllReports');
    const reportCheckboxes = document.querySelectorAll('.report-checkbox');
    const modalMessage = document.getElementById('modalMessage');

    const closePdfPreview = document.getElementById('closePdfPreview');
    const backToReports = document.getElementById('backToReports');
    const downloadPreviewPdf = document.getElementById('downloadPreviewPdf');
    const pdfPreviewFrame = document.getElementById('pdfPreviewFrame');

    let generatedPdfBlob = null;
    let generatedPdfUrl = null;

    // OPEN AND CLOSE REPORT MODAL
    function openReportModal() {
        reportModal.classList.add('show');
        modalMessage.style.display = 'none';
    }

    function closeReportWindow() {
        reportModal.classList.remove('show');
    }

    downloadReportBtn.addEventListener('click', openReportModal);
    closeReportModal.addEventListener('click', closeReportWindow);
    cancelReport.addEventListener('click', closeReportWindow);

    reportModal.addEventListener('click', function(event) {
        if (event.target === reportModal) {
            closeReportWindow();
        }
    });

    // SELECT ALL
    selectAllReports.addEventListener('change', function() {
        reportCheckboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllReports.checked;
        });
    });

    reportCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            selectAllReports.checked = Array.from(reportCheckboxes)
                .every(function(item) {
                    return item.checked;
                });
        });
    });

    // PDF HELPERS
    function money(value) {
        return 'PHP ' + Number(value || 0).toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function addSectionTitle(doc, title) {
        doc.addPage();

        doc.setFontSize(17);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(23, 57, 95);
        doc.text(title, 14, 20);

        doc.setDrawColor(220, 227, 235);
        doc.line(14, 25, 196, 25);

        doc.setTextColor(0, 0, 0);
    }

    function addPdfTable(doc, headers, rows) {
        const body = rows.length
            ? rows
            : [['No records found', ...Array(headers.length - 1).fill('')]];

        doc.autoTable({
            head: [headers],
            body: body,
            startY: 32,
            theme: 'grid',
            styles: {
                fontSize: 8,
                cellPadding: 3,
                overflow: 'linebreak'
            },
            headStyles: {
                fillColor: [20, 148, 95],
                textColor: [255, 255, 255]
            },
            margin: {
                left: 14,
                right: 14
            }
        });
    }

    // WEEKLY REVENUE REPORT
    function addWeeklyReport(doc) {
        addSectionTitle(doc, 'Weekly Revenue Report');

        const rows = weeklyLabels.map(function(label, index) {
            return [label, money(weeklyRevenue[index])];
        });

        rows.push(['TOTAL', money(weeklyTotal)]);

        addPdfTable(doc, ['Day', 'Collected Amount'], rows);
    }

    // MONTHLY REVENUE REPORT
    function addMonthlyReport(doc) {
        addSectionTitle(doc, 'Monthly Revenue Report - ' + currentYear);

        const rows = monthlyLabels.map(function(label, index) {
            return [label, money(monthlyRevenue[index])];
        });

        rows.push(['TOTAL', money(monthlyTotal)]);

        addPdfTable(doc, ['Billing Month', 'Paid Rent'], rows);
    }

    // YEARLY REVENUE REPORT
    function addYearlyReport(doc) {
        addSectionTitle(doc, 'Yearly Revenue Report');

        const rows = yearlyLabels.map(function(label, index) {
            return [String(label), money(yearlyRevenue[index])];
        });

        rows.push(['TOTAL', money(yearlyTotal)]);

        addPdfTable(doc, ['Year', 'Paid Rent'], rows);
    }

    // MONTHLY RENT LEDGER
    function addLedgerReport(doc) {
        addSectionTitle(doc, 'Monthly Rent Status');

        const rows = ledgerData.map(function(entry) {
            return [
                entry.tenant,
                entry.billing_month,
                money(entry.rent),
                entry.due_date,
                money(entry.paid),
                money(entry.balance),
                entry.status
            ];
        });

        addPdfTable(doc, [
            'Tenant',
            'Billing Month',
            'Rent',
            'Due Date',
            'Paid',
            'Balance',
            'Status'
        ], rows);
    }

    // UNPAID RENT REPORT
    function addUnpaidReport(doc) {
        addSectionTitle(doc, 'Unpaid Rent Summary');

        const rows = unpaidData.map(function(entry) {
            return [
                entry.tenant,
                money(entry.monthly_rent),
                String(entry.unpaid_count),
                entry.unpaid_months,
                String(entry.overdue_count),
                money(entry.outstanding)
            ];
        });

        addPdfTable(doc, [
            'Tenant',
            'Monthly Rent',
            'Unpaid Count',
            'Unpaid Months',
            'Overdue',
            'Balance'
        ], rows);
    }

    // LISTINGS REPORT
    function addListingsReport(doc) {
        addSectionTitle(doc, 'Accommodation / Listing Information');

        const rows = reportListings.map(function(listing) {
            return [
                listing.name || 'N/A',
                listing.address || 'N/A',
                listing.type || 'N/A',
                money(listing.price),
                String(listing.capacity ?? 'N/A'),
                listing.status || 'N/A'
            ];
        });

        addPdfTable(doc, [
            'Property',
            'Address',
            'Type',
            'Price',
            'Capacity',
            'Status'
        ], rows);
    }

    // TENANT REPORT
    function addTenantsReport(doc) {
        addSectionTitle(doc, 'Tenant Records');

        const rows = reportTenants.map(function(tenant) {
            return [
                tenant.name || 'N/A',
                tenant.email || 'N/A',
                tenant.phone || 'N/A',
                tenant.accommodation || 'N/A',
                money(tenant.monthly_rent),
                String(tenant.due_day),
                tenant.status || 'N/A'
            ];
        });

        addPdfTable(doc, [
            'Name',
            'Email',
            'Phone',
            'Accommodation',
            'Monthly Rent',
            'Due Day',
            'Status'
        ], rows);
    }

    // PAYMENT REPORT
    function addPaymentsReport(doc) {
        addSectionTitle(doc, 'Payment Records');

        const rows = reportPayments.map(function(payment) {
            return [
                payment.tenant,
                payment.billing_month,
                money(payment.amount),
                payment.payment_date,
                payment.status || 'Pending'
            ];
        });

        addPdfTable(doc, [
            'Tenant',
            'Billing Month',
            'Amount',
            'Payment Date',
            'Status'
        ], rows);
    }

    // REPORT FUNCTIONS
    const reportFunctions = {
        weekly: addWeeklyReport,
        monthly: addMonthlyReport,
        yearly: addYearlyReport,
        ledger: addLedgerReport,
        unpaid: addUnpaidReport,
        listings: addListingsReport,
        tenants: addTenantsReport,
        payments: addPaymentsReport
    };

    // CLOSE PDF PREVIEW
    function closePreviewModal() {
        pdfPreviewModal.classList.remove('show');
        pdfPreviewFrame.src = 'about:blank';

        if (generatedPdfUrl) {
            URL.revokeObjectURL(generatedPdfUrl);
            generatedPdfUrl = null;
        }

        generatedPdfBlob = null;
    }

    closePdfPreview.addEventListener('click', closePreviewModal);
    backToReports.addEventListener('click', closePreviewModal);

    pdfPreviewModal.addEventListener('click', function(event) {
        if (event.target === pdfPreviewModal) {
            closePreviewModal();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            if (pdfPreviewModal.classList.contains('show')) {
                closePreviewModal();
            } else if (reportModal.classList.contains('show')) {
                closeReportWindow();
            }
        }
    });

    // GENERATE PDF PREVIEW
    generateReport.addEventListener('click', function() {

        const selectedReports = Array.from(reportCheckboxes)
            .filter(function(checkbox) {
                return checkbox.checked;
            })
            .map(function(checkbox) {
                return checkbox.value;
            });

        if (selectedReports.length === 0) {
            modalMessage.textContent = 'Please select at least one report.';
            modalMessage.style.display = 'block';
            return;
        }

        if (!window.jspdf || !window.jspdf.jsPDF) {
            modalMessage.textContent =
                'PDF library failed to load. Check your internet connection.';

            modalMessage.style.display = 'block';
            return;
        }

        generateReport.disabled = true;
        generateReport.innerHTML =
            '<i class="bi bi-hourglass-split"></i> Generating Preview...';

        try {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            if (typeof doc.autoTable !== 'function') {
                throw new Error('PDF table library failed to load.');
            }

            // COVER AND SUMMARY
            doc.setFontSize(22);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(20, 148, 95);
            doc.text('AccomFinder Owner Report', 14, 24);

            doc.setTextColor(0, 0, 0);
            doc.setFontSize(11);
            doc.setFont('helvetica', 'normal');

            const ownerLines = doc.splitTextToSize(
                'Owner: ' + ownerName,
                180
            );

            doc.text(ownerLines, 14, 37);

            const generatedY = 37 + ownerLines.length * 5 + 4;

            doc.text(
                'Generated: ' + new Date().toLocaleDateString('en-PH'),
                14,
                generatedY
            );

            const overviewRows = [
                ['Total Listings', String(reportListings.length)],
                ['Total Tenants', String(reportTenants.length)],
                ['Payment Records', String(reportPayments.length)],
                ['Total Rent Collected', money(totalRevenue)],
                ['Total Outstanding Rent', money(totalOutstanding)],
                ['Tenants With Unpaid Rent', String(tenantsWithUnpaidRent)],
                ['Overdue Rent Months', String(overdueMonths)]
            ];

            doc.autoTable({
                head: [['Report Summary', 'Value']],
                body: overviewRows,
                startY: generatedY + 12,
                theme: 'grid',
                headStyles: {
                    fillColor: [20, 148, 95]
                },
                styles: {
                    fontSize: 10
                },
                margin: {
                    left: 14,
                    right: 14
                }
            });

            // ADD SELECTED SECTIONS
            selectedReports.forEach(function(report) {
                if (reportFunctions[report]) {
                    reportFunctions[report](doc);
                }
            });

            // FOOTER ON EVERY PAGE
            const pageCount = doc.internal.getNumberOfPages();

            for (let page = 1; page <= pageCount; page++) {
                doc.setPage(page);
                doc.setFontSize(9);
                doc.setTextColor(120, 120, 120);

                doc.text(
                    'AccomFinder | Page ' + page + ' of ' + pageCount,
                    14,
                    288
                );
            }

            // CREATE PDF BLOB
            generatedPdfBlob = doc.output('blob');

            if (generatedPdfUrl) {
                URL.revokeObjectURL(generatedPdfUrl);
            }

            generatedPdfUrl = URL.createObjectURL(generatedPdfBlob);

            // SHOW PREVIEW
            reportModal.classList.remove('show');
            pdfPreviewFrame.src = generatedPdfUrl;
            pdfPreviewModal.classList.add('show');

        } catch (error) {
            console.error(error);

            modalMessage.textContent =
                'Unable to generate PDF: ' + error.message;

            modalMessage.style.display = 'block';

        } finally {
            generateReport.disabled = false;

            generateReport.innerHTML =
                '<i class="bi bi-eye"></i> Preview Report';
        }
    });

    // DOWNLOAD THE PREVIEWED PDF
    downloadPreviewPdf.addEventListener('click', function() {

        if (!generatedPdfBlob) {
            alert('Please generate the report preview first.');
            return;
        }

        const downloadUrl = URL.createObjectURL(generatedPdfBlob);
        const link = document.createElement('a');

        link.href = downloadUrl;
        link.download = 'AccomFinder-Owner-Report.pdf';

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Close preview and release resources
        closePreviewModal();

        setTimeout(function() {
            URL.revokeObjectURL(downloadUrl);
        }, 1000);
    });

</script>

</body>
</html>
