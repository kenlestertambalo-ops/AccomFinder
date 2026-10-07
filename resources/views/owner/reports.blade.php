<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Owner Reports | AccomFinder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
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
            background: #ffffff;
            border-right: 1px solid #dce3eb;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
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

        .logo h2 span {
            color: #193e67;
        }

        .logo small {
            display: block;
            margin-top: -3px;
            color: #66758a;
            font-size: 14px;
            font-weight: 600;
        }

        .menu {
            padding: 38px 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 8px 0;
            padding: 14px 26px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 16px;
            transition: 0.2s;
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
            background: #ffffff;
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
            padding: 35px 14px 60px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-bottom: 5px;
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
            font-size: 17px;
        }

        .download-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #14945f;
            color: #ffffff;
            border: none;
            border-radius: 9px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            margin-left: 20px;
            transition: 0.2s;
        }

        .download-btn:hover {
            background: #0f7d50;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 25px;
            min-height: 185px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 18px;
        }

        .green {
            background: #d1fae5;
            color: #198754;
        }

        .blue {
            background: #dbeafe;
            color: #2563eb;
        }

        .orange {
            background: #ffedd5;
            color: #ea580c;
        }

        .purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        .stat-card h2 {
            margin: 0 0 8px;
            font-size: 28px;
            font-weight: 600;
            color: #132238;
        }

        .stat-card p {
            margin: 0;
            font-size: 15px;
            color: #66778c;
        }

        .report-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            margin-top: 30px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .section-header h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 600;
            color: #17395f;
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
            min-width: 700px;
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

        .report-table tbody tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-paid {
            background: #d1fae5;
            color: #047857;
        }

        .status-pending {
            background: #ffedd5;
            color: #c2410c;
        }

        .status-available {
            background: #d1fae5;
            color: #047857;
        }

        .status-active {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .report-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px;
        }

        .info-box h3 {
            margin: 0 0 7px;
            font-size: 15px;
            font-weight: 600;
            color: #17395f;
        }

        .info-box p {
            margin: 0;
            font-size: 14px;
            color: #66778c;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.48);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 5000;
            padding: 20px;
        }

        .modal-overlay.show {
            display: flex;
        }

        .report-modal {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: modalIn 0.2s ease;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(-15px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-header h2 {
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

        .modal-close:hover {
            background: #e2e8f0;
        }

        .modal-body {
            padding: 22px 24px;
        }

        .modal-description {
            margin: 0 0 18px;
            color: #64748b;
            font-size: 14px;
        }

        .select-all {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .report-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 9px;
            cursor: pointer;
            transition: 0.15s;
        }

        .report-option:hover {
            background: #f8fafc;
            border-color: #b9e7d4;
        }

        .report-option input,
        .select-all input {
            width: 18px;
            height: 18px;
            accent-color: #14945f;
            cursor: pointer;
        }

        .report-option-content {
            flex: 1;
        }

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

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 18px 24px;
            border-top: 1px solid #e5e7eb;
        }

        .cancel-btn {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            border-radius: 9px;
            padding: 11px 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background: #f8fafc;
        }

        .generate-btn {
            border: none;
            background: #14945f;
            color: #ffffff;
            border-radius: 9px;
            padding: 11px 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .generate-btn:hover {
            background: #0f7d50;
        }

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

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar {
                left: 220px;
                width: calc(100% - 220px);
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .report-info {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            body {
                overflow: auto;
            }

            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                left: 0;
                width: 100%;
            }

            .main {
                padding: 30px 18px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-header h1 {
                font-size: 30px;
            }

            .download-btn {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

@php
    $ownerId = session('owner_id');

    $reportListings = \App\Models\Accommodation::where(
        'owner_id',
        $ownerId
    )
    ->latest()
    ->get();

    $reportTenants = \App\Models\Tenant::where(
        'owner_id',
        $ownerId
    )
    ->with('accommodation')
    ->latest()
    ->get();

    $reportPayments = \App\Models\Payment::where(
        'owner_id',
        $ownerId
    )
    ->with('tenant')
    ->latest()
    ->get();

    $totalListings = $reportListings->count();

    $totalTenants = $reportTenants->count();

    $totalPayments = $reportPayments->count();

    $paidPayments = $reportPayments->filter(function ($payment) {
        return strtolower(trim($payment->status ?? '')) === 'paid';
    });

    $totalRevenue = $paidPayments->sum('amount');

    $pendingRevenue = $reportPayments
        ->filter(function ($payment) {
            return strtolower(trim($payment->status ?? '')) === 'pending';
        })
        ->sum('amount');

    $expectedRevenue = $totalRevenue + $pendingRevenue;

    $collectionRate = $expectedRevenue > 0
        ? ($totalRevenue / $expectedRevenue) * 100
        : 0;

    $currentWeekStart = \Carbon\Carbon::now()
        ->startOfWeek(\Carbon\Carbon::MONDAY);

    $weeklyLabels = [];
    $weeklyRevenue = [];

    for ($i = 0; $i < 7; $i++) {
        $date = $currentWeekStart->copy()->addDays($i);

        $weeklyLabels[] = $date->format('D');

        $weeklyRevenue[] = $paidPayments
            ->filter(function ($payment) use ($date) {
                if (!$payment->payment_date) {
                    return false;
                }

                return \Carbon\Carbon::parse(
                    $payment->payment_date
                )->isSameDay($date);
            })
            ->sum('amount');
    }

    $weeklyTotal = array_sum($weeklyRevenue);

    $currentYear = \Carbon\Carbon::now()->year;

    $monthlyLabels = [];
    $monthlyRevenue = [];

    for ($month = 1; $month <= 12; $month++) {
        $monthlyLabels[] = \Carbon\Carbon::create()
            ->month($month)
            ->format('M');

        $monthlyRevenue[] = $paidPayments
            ->filter(function ($payment) use ($month, $currentYear) {
                if (!$payment->payment_date) {
                    return false;
                }

                $date = \Carbon\Carbon::parse(
                    $payment->payment_date
                );

                return $date->year == $currentYear &&
                    $date->month == $month;
            })
            ->sum('amount');
    }

    $monthlyTotal = array_sum($monthlyRevenue);

    $yearlyData = [];

    foreach ($paidPayments as $payment) {
        if (!$payment->payment_date) {
            continue;
        }

        $year = \Carbon\Carbon::parse(
            $payment->payment_date
        )->year;

        if (!isset($yearlyData[$year])) {
            $yearlyData[$year] = 0;
        }

        $yearlyData[$year] += (float) $payment->amount;
    }

    if (empty($yearlyData)) {
        $yearlyData[$currentYear] = 0;
    }

    ksort($yearlyData);

    $yearlyLabels = array_keys($yearlyData);

    $yearlyRevenue = array_values($yearlyData);

    $yearlyTotal = array_sum($yearlyRevenue);
@endphp

<aside class="sidebar">

    <div class="logo">
        <h2>
            <span>Accom</span>Finder
        </h2>

        <small>
            Owner Portal
        </small>
    </div>

    <div class="menu">

        <a href="{{ route('owner.dashboard') }}">
            <span class="menu-icon">
                <i class="bi bi-house-door"></i>
            </span>
            Dashboard
        </a>

        <a href="{{ route('owner.listings') }}">
            <span class="menu-icon">
                <i class="bi bi-buildings"></i>
            </span>
            Listings
        </a>

        <a href="{{ route('owner.tenants') }}">
            <span class="menu-icon">
                <i class="bi bi-people"></i>
            </span>
            Tenants
        </a>

        <a href="{{ route('owner.payments') }}">
            <span class="menu-icon">
                <i class="bi bi-currency-dollar"></i>
            </span>
            Payments
        </a>

        <a
            href="{{ route('owner.reports') }}"
            class="active"
        >
            <span class="menu-icon">
                <i class="bi bi-bar-chart-line"></i>
            </span>
            Reports
        </a>

        <a href="{{ route('owner.messages') }}">
            <span class="menu-icon">
                <i class="bi bi-chat-square"></i>
            </span>
            Messages
        </a>

    </div>

    <div class="bottom">
        <a href="{{ route('owner.logout') }}">
            <span class="menu-icon">
                <i class="bi bi-box-arrow-right"></i>
            </span>
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
                <h1>
                    Owner Reports
                </h1>

                <p>
                    Weekly, monthly, and yearly revenue reports
                </p>
            </div>

            <button
                type="button"
                id="downloadReportBtn"
                class="download-btn"
            >
                <i class="bi bi-download"></i>
                Download Report
            </button>

        </div>

        <div class="stats-grid">

            <div class="stat-card">

                <div class="icon-box green">
                    <i class="bi bi-buildings"></i>
                </div>

                <h2>
                    {{ $totalListings }}
                </h2>

                <p>
                    Total Listings
                </p>

            </div>

            <div class="stat-card">

                <div class="icon-box blue">
                    <i class="bi bi-people"></i>
                </div>

                <h2>
                    {{ $totalTenants }}
                </h2>

                <p>
                    Total Tenants
                </p>

            </div>

            <div class="stat-card">

                <div class="icon-box orange">
                    <i class="bi bi-credit-card"></i>
                </div>

                <h2>
                    {{ $totalPayments }}
                </h2>

                <p>
                    Payment Records
                </p>

            </div>

            <div class="stat-card">

                <div class="icon-box purple">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <h2>
                    ₱{{ number_format($totalRevenue, 2) }}
                </h2>

                <p>
                    Total Revenue
                </p>

            </div>

        </div>

        <div class="report-section">

            <div class="section-header">

                <h2>
                    Revenue Overview
                </h2>

            </div>

            <hr class="section-divider">

            <div class="chart-wrapper">
                <canvas id="revenueChart"></canvas>
            </div>

        </div>

        <div class="report-section">

            <div class="section-header">
                <h2>
                    Accommodation / Listing Information
                </h2>
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

                                <td>
                                    {{ $listing->name }}
                                </td>

                                <td>
                                    {{ $listing->address }}
                                </td>

                                <td>
                                    {{ $listing->type }}
                                </td>

                                <td>
                                    ₱{{ number_format($listing->price, 2) }}
                                </td>

                                <td>
                                    {{ $listing->capacity ?? 0 }}
                                </td>

                                <td>

                                    <span class="status-badge status-available">
                                        {{ $listing->status }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-row"
                                >
                                    No accommodation listings found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="report-section">

            <div class="section-header">

                <h2>
                    Tenant Records
                </h2>

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
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($reportTenants as $tenant)

                            <tr>

                                <td>
                                    {{ $tenant->name }}
                                </td>

                                <td>
                                    {{ $tenant->email }}
                                </td>

                                <td>
                                    {{ $tenant->phone }}
                                </td>

                                <td>
                                    {{ $tenant->accommodation->name ?? 'N/A' }}
                                </td>

                                <td>
                                    ₱{{ number_format($tenant->monthly_rent ?? 0, 2) }}
                                </td>

                                <td>

                                    <span class="status-badge status-active">
                                        {{ $tenant->status ?? 'Active' }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-row"
                                >
                                    No tenant records found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="report-section">

            <div class="section-header">

                <h2>
                    Payment Records
                </h2>

            </div>

            <hr class="section-divider">

            <div class="table-wrapper">

                <table class="report-table">

                    <thead>

                        <tr>
                            <th>Tenant</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($reportPayments as $payment)

                            <tr>

                                <td>
                                    {{ $payment->tenant->name ?? 'N/A' }}
                                </td>

                                <td>
                                    ₱{{ number_format($payment->amount ?? 0, 2) }}
                                </td>

                                <td>
                                    {{ $payment->payment_date ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $payment->payment_method ?? 'N/A' }}
                                </td>

                                <td>

                                    @if(strtolower($payment->status ?? '') === 'paid')

                                        <span class="status-badge status-paid">
                                            Paid
                                        </span>

                                    @else

                                        <span class="status-badge status-pending">
                                            {{ ucfirst($payment->status ?? 'Pending') }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="empty-row"
                                >
                                    No payment records found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="report-info">

            <div class="info-box">

                <h3>
                    Weekly Revenue
                </h3>

                <p>
                    ₱{{ number_format($weeklyTotal, 2) }}
                </p>

            </div>

            <div class="info-box">

                <h3>
                    Monthly Revenue
                </h3>

                <p>
                    ₱{{ number_format($monthlyTotal, 2) }}
                </p>

            </div>

            <div class="info-box">

                <h3>
                    Yearly Revenue
                </h3>

                <p>
                    ₱{{ number_format($yearlyTotal, 2) }}
                </p>

            </div>

        </div>

    </main>

</div>

<div
    id="reportModal"
    class="modal-overlay"
>

    <div class="report-modal">

        <div class="modal-header">

            <h2>
                Download Report
            </h2>

            <button
                type="button"
                id="closeReportModal"
                class="modal-close"
            >
                <i class="bi bi-x"></i>
            </button>

        </div>

        <div class="modal-body">

            <p class="modal-description">
                Select the report sections you want to download.
            </p>

            <label class="select-all">

                <input
                    type="checkbox"
                    id="selectAllReports"
                >

                <span>
                    Select All Reports
                </span>

            </label>

            <label class="report-option">

                <input
                    type="checkbox"
                    class="report-checkbox"
                    value="weekly"
                >

                <span class="report-option-content">

                    <span class="report-option-title">
                        Weekly Revenue Report
                    </span>

                    <span class="report-option-description">
                        Revenue for the current week
                    </span>

                </span>

            </label>

            <label class="report-option">

                <input
                    type="checkbox"
                    class="report-checkbox"
                    value="monthly"
                >

                <span class="report-option-content">

                    <span class="report-option-title">
                        Monthly Revenue Report
                    </span>

                    <span class="report-option-description">
                        Revenue for each month of the current year
                    </span>

                </span>

            </label>

            <label class="report-option">

                <input
                    type="checkbox"
                    class="report-checkbox"
                    value="yearly"
                >

                <span class="report-option-content">

                    <span class="report-option-title">
                        Yearly Revenue Report
                    </span>

                    <span class="report-option-description">
                        Revenue grouped by year
                    </span>

                </span>

            </label>

            <label class="report-option">

                <input
                    type="checkbox"
                    class="report-checkbox"
                    value="listings"
                >

                <span class="report-option-content">

                    <span class="report-option-title">
                        Accommodation / Listing Information
                    </span>

                    <span class="report-option-description">
                        Your accommodation and property records
                    </span>

                </span>

            </label>

            <label class="report-option">

                <input
                    type="checkbox"
                    class="report-checkbox"
                    value="tenants"
                >

                <span class="report-option-content">

                    <span class="report-option-title">
                        Tenant Records
                    </span>

                    <span class="report-option-description">
                        Tenant information and accommodation records
                    </span>

                </span>

            </label>

            <label class="report-option">

                <input
                    type="checkbox"
                    class="report-checkbox"
                    value="payments"
                >

                <span class="report-option-content">

                    <span class="report-option-title">
                        Payment Records
                    </span>

                    <span class="report-option-description">
                        Payment amounts, dates, methods, and status
                    </span>

                </span>

            </label>

            <div
                id="modalMessage"
                class="modal-message"
            >
                Please select at least one report.
            </div>

        </div>

        <div class="modal-footer">

            <button
                type="button"
                id="cancelReport"
                class="cancel-btn"
            >
                Cancel
            </button>

            <button
                type="button"
                id="generateReport"
                class="generate-btn"
            >
                <i class="bi bi-download"></i>
                Download Selected
            </button>

        </div>

    </div>

</div>

<script>
    const weeklyLabels = @json($weeklyLabels);
    const weeklyRevenue = @json($weeklyRevenue);

    const monthlyLabels = @json($monthlyLabels);
    const monthlyRevenue = @json($monthlyRevenue);

    const yearlyLabels = @json($yearlyLabels);
    const yearlyRevenue = @json($yearlyRevenue);

    const revenueCanvas = document.getElementById('revenueChart');

    new Chart(revenueCanvas, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [
                {
                    label: 'Monthly Revenue',
                    data: monthlyRevenue,
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
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

    const reportModal = document.getElementById('reportModal');

    const downloadReportBtn = document.getElementById('downloadReportBtn');

    const closeReportModal = document.getElementById('closeReportModal');

    const cancelReport = document.getElementById('cancelReport');

    const generateReport = document.getElementById('generateReport');

    const selectAllReports = document.getElementById('selectAllReports');

    const reportCheckboxes = document.querySelectorAll('.report-checkbox');

    const modalMessage = document.getElementById('modalMessage');

    function openReportModal() {
        reportModal.classList.add('show');
        modalMessage.style.display = 'none';
    }

    function closeReportWindow() {
        reportModal.classList.remove('show');
    }

    downloadReportBtn.addEventListener(
        'click',
        openReportModal
    );

    closeReportModal.addEventListener(
        'click',
        closeReportWindow
    );

    cancelReport.addEventListener(
        'click',
        closeReportWindow
    );

    reportModal.addEventListener(
        'click',
        function(event) {
            if (event.target === reportModal) {
                closeReportWindow();
            }
        }
    );

    document.addEventListener(
        'keydown',
        function(event) {
            if (event.key === 'Escape') {
                closeReportWindow();
            }
        }
    );

    selectAllReports.addEventListener(
        'change',
        function() {

            reportCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllReports.checked;
            });

        }
    );

    reportCheckboxes.forEach(
        function(checkbox) {

            checkbox.addEventListener(
                'change',
                function() {

                    const allSelected =
                        Array.from(reportCheckboxes)
                            .every(function(item) {
                                return item.checked;
                            });

                    selectAllReports.checked = allSelected;

                }
            );

        }
    );

    function addTitle(doc, title, y) {
        doc.setFontSize(18);
        doc.setFont(undefined, 'bold');
        doc.text(title, 20, y);

        return y + 12;
    }

    function addLine(doc, text, y, size = 10) {
        doc.setFontSize(size);
        doc.setFont(undefined, 'normal');

        const lines = doc.splitTextToSize(
            String(text),
            170
        );

        doc.text(lines, 20, y);

        return y + (lines.length * 6);
    }

    function checkPage(doc, y) {
        if (y > 275) {
            doc.addPage();
            return 20;
        }

        return y;
    }

    function addWeeklyReport(doc, y) {
        y = checkPage(doc, y);

        y = addTitle(
            doc,
            'Weekly Revenue Report',
            y
        );

        y = addLine(
            doc,
            'Current week revenue by day',
            y
        );

        for (let i = 0; i < weeklyLabels.length; i++) {

            y = checkPage(doc, y);

            y = addLine(
                doc,
                weeklyLabels[i] +
                ': PHP ' +
                Number(
                    weeklyRevenue[i] || 0
                ).toLocaleString(
                    undefined,
                    {
                        minimumFractionDigits: 2
                    }
                ),
                y
            );

        }

        y = addLine(
            doc,
            'Weekly Total: PHP ' +
            Number(
                {{ $weeklyTotal }}
            ).toLocaleString(
                undefined,
                {
                    minimumFractionDigits: 2
                }
            ),
            y + 4
        );

        return y + 8;
    }

    function addMonthlyReport(doc, y) {
        y = checkPage(doc, y);

        y = addTitle(
            doc,
            'Monthly Revenue Report',
            y
        );

        y = addLine(
            doc,
            'Revenue for each month of {{ $currentYear }}',
            y
        );

        for (let i = 0; i < monthlyLabels.length; i++) {

            y = checkPage(doc, y);

            y = addLine(
                doc,
                monthlyLabels[i] +
                ': PHP ' +
                Number(
                    monthlyRevenue[i] || 0
                ).toLocaleString(
                    undefined,
                    {
                        minimumFractionDigits: 2
                    }
                ),
                y
            );

        }

        y = addLine(
            doc,
            'Monthly Total: PHP ' +
            Number(
                {{ $monthlyTotal }}
            ).toLocaleString(
                undefined,
                {
                    minimumFractionDigits: 2
                }
            ),
            y + 4
        );

        return y + 8;
    }

    function addYearlyReport(doc, y) {
        y = checkPage(doc, y);

        y = addTitle(
            doc,
            'Yearly Revenue Report',
            y
        );

        for (let i = 0; i < yearlyLabels.length; i++) {

            y = checkPage(doc, y);

            y = addLine(
                doc,
                yearlyLabels[i] +
                ': PHP ' +
                Number(
                    yearlyRevenue[i] || 0
                ).toLocaleString(
                    undefined,
                    {
                        minimumFractionDigits: 2
                    }
                ),
                y
            );

        }

        y = addLine(
            doc,
            'Yearly Total: PHP ' +
            Number(
                {{ $yearlyTotal }}
            ).toLocaleString(
                undefined,
                {
                    minimumFractionDigits: 2
                }
            ),
            y + 4
        );

        return y + 8;
    }

    function addListingsReport(doc, y) {
        y = checkPage(doc, y);

        y = addTitle(
            doc,
            'Accommodation / Listing Information',
            y
        );

        y = addLine(
            doc,
            'Total Listings: {{ $totalListings }}',
            y
        );

        y += 5;

        @foreach($reportListings as $listing)

            y = checkPage(doc, y);

            y = addLine(
                doc,
                'Property: {{ addslashes($listing->name ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Address: {{ addslashes($listing->address ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Type: {{ addslashes($listing->type ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Price: PHP {{ number_format($listing->price ?? 0, 2) }}',
                y
            );

            y = addLine(
                doc,
                'Capacity: {{ $listing->capacity ?? 0 }}',
                y
            );

            y = addLine(
                doc,
                'Status: {{ addslashes($listing->status ?? 'N/A') }}',
                y
            );

            y += 5;

        @endforeach

        return y + 8;
    }

    function addTenantsReport(doc, y) {
        y = checkPage(doc, y);

        y = addTitle(
            doc,
            'Tenant Records',
            y
        );

        y = addLine(
            doc,
            'Total Tenants: {{ $totalTenants }}',
            y
        );

        y += 5;

        @foreach($reportTenants as $tenant)

            y = checkPage(doc, y);

            y = addLine(
                doc,
                'Name: {{ addslashes($tenant->name ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Email: {{ addslashes($tenant->email ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Phone: {{ addslashes($tenant->phone ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Accommodation: {{ addslashes($tenant->accommodation->name ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Monthly Rent: PHP {{ number_format($tenant->monthly_rent ?? 0, 2) }}',
                y
            );

            y = addLine(
                doc,
                'Status: {{ addslashes($tenant->status ?? 'Active') }}',
                y
            );

            y += 5;

        @endforeach

        return y + 8;
    }

    function addPaymentsReport(doc, y) {
        y = checkPage(doc, y);

        y = addTitle(
            doc,
            'Payment Records',
            y
        );

        y = addLine(
            doc,
            'Total Payment Records: {{ $totalPayments }}',
            y
        );

        y = addLine(
            doc,
            'Total Paid Revenue: PHP {{ number_format($totalRevenue, 2) }}',
            y
        );

        y += 5;

        @foreach($reportPayments as $payment)

            y = checkPage(doc, y);

            y = addLine(
                doc,
                'Tenant: {{ addslashes($payment->tenant->name ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Amount: PHP {{ number_format($payment->amount ?? 0, 2) }}',
                y
            );

            y = addLine(
                doc,
                'Payment Date: {{ addslashes($payment->payment_date ?? 'N/A') }}',
                y
            );

            y = addLine(
                doc,
                'Status: {{ addslashes($payment->status ?? 'N/A') }}',
                y
            );

            y += 5;

        @endforeach

        return y + 8;
    }

    generateReport.addEventListener(
        'click',
        function() {

            const selectedReports =
                Array.from(reportCheckboxes)
                    .filter(function(checkbox) {
                        return checkbox.checked;
                    })
                    .map(function(checkbox) {
                        return checkbox.value;
                    });

            if (selectedReports.length === 0) {

                modalMessage.style.display = 'block';

                return;
            }

            modalMessage.style.display = 'none';

            generateReport.disabled = true;

            generateReport.innerHTML =
                '<i class="bi bi-hourglass-split"></i> Creating...';

            setTimeout(
                function() {

                    const {
                        jsPDF
                    } = window.jspdf;

                    const doc = new jsPDF();

                    let y = 20;

                    doc.setFontSize(22);
                    doc.setFont(undefined, 'bold');

                    doc.text(
                        'AccomFinder Owner Report',
                        20,
                        y
                    );

                    y += 10;

                    doc.setFontSize(10);
                    doc.setFont(undefined, 'normal');

                    doc.text(
                        'Owner: {{ addslashes(session('owner_name', 'Owner')) }}',
                        20,
                        y
                    );

                    y += 6;

                    doc.text(
                        'Generated: ' +
                        new Date().toLocaleDateString(),
                        20,
                        y
                    );

                    y += 15;

                    if (selectedReports.includes('weekly')) {
                        y = addWeeklyReport(doc, y);
                    }

                    if (selectedReports.includes('monthly')) {
                        y = addMonthlyReport(doc, y);
                    }

                    if (selectedReports.includes('yearly')) {
                        y = addYearlyReport(doc, y);
                    }

                    if (selectedReports.includes('listings')) {
                        y = addListingsReport(doc, y);
                    }

                    if (selectedReports.includes('tenants')) {
                        y = addTenantsReport(doc, y);
                    }

                    if (selectedReports.includes('payments')) {
                        y = addPaymentsReport(doc, y);
                    }

                    doc.save(
                        'AccomFinder-Selected-Report.pdf'
                    );

                    generateReport.disabled = false;

                    generateReport.innerHTML =
                        '<i class="bi bi-download"></i> Download Selected';

                    closeReportWindow();

                },
                300
            );
        }
    );
</script>

</body>
</html>
