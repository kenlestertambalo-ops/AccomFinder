<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Owner Payments | AccomFinder</title>

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- BOOTSTRAP ICONS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        /* =====================================================
           RESET
        ===================================================== */

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


        /* =====================================================
           SIDEBAR
           COPIED FROM OWNER DASHBOARD
        ===================================================== */

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


        /* =====================================================
           LOGO
        ===================================================== */

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


        /* =====================================================
           MENU
        ===================================================== */

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


        /* =====================================================
           LOGOUT
        ===================================================== */

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


        /* =====================================================
           CONTENT
           SAME AS DASHBOARD
        ===================================================== */

        .content {
            margin-left: 264px;

            width: calc(100% - 264px);

            height: 100vh;

            overflow: hidden;
        }


        /* =====================================================
           TOPBAR
           SAME AS DASHBOARD
        ===================================================== */

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


        /* =====================================================
           MAIN
           SAME AS DASHBOARD
        ===================================================== */

        .main {
            height: calc(100vh - 74px);

            margin-top: 74px;

            padding: 35px 14px 50px;

            overflow-y: auto;

            overflow-x: hidden;

            /* IMPORTANT:
               NO max-width
               NO margin:auto
            */
            width: 100%;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {
            width: 100%;

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 0;

            margin: 0;
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


        /* =====================================================
           MAKE PAYMENT BUTTON
        ===================================================== */

        .add-btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            background: #14945f;

            color: #ffffff;

            padding: 14px 22px;

            border-radius: 9px;

            border: none;

            text-decoration: none;

            font-size: 17px;

            font-weight: 500;

            cursor: pointer;

            transition: 0.2s;

            white-space: nowrap;
        }

        .add-btn:hover {
            background: #0d7e50;

            color: #ffffff;
        }


        /* =====================================================
           STATISTICS
           SAME CARD STYLE AS DASHBOARD
        ===================================================== */

        .stats-grid {
            width: 100%;

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 24px;

            margin-top: 30px;
        }

        .stat-card {
            width: 100%;

            min-width: 0;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            padding: 25px;

            min-height: 190px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.04);
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


        /* =====================================================
           PAYMENT TABLE
           SAME CARD STYLE AS DASHBOARD
        ===================================================== */

        .table-card {
            width: 100%;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            margin-top: 30px;

            padding: 25px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .table-header {
            display: flex;

            justify-content: space-between;

            align-items: center;
        }

        .table-header h3 {
            margin: 0;

            font-size: 25px;

            font-weight: 600;

            color: #17395f;
        }

        .table-wrapper {
            width: 100%;

            overflow-x: auto;

            margin-top: 20px;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 750px;
        }

        th {
            background: #f8fafc;

            padding: 14px 16px;

            text-align: left;

            font-size: 12px;

            font-weight: 600;

            color: #66778c;

            text-transform: uppercase;
        }

        td {
            padding: 16px;

            border-top: 1px solid #edf0f4;

            font-size: 14px;

            color: #53657b;
        }

        tbody tr:hover td {
            background: #fafcfe;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: 600;

            white-space: nowrap;
        }

        .status-paid {
            background: #d9f7e8;

            color: #168451;
        }

        .status-pending {
            background: #fff1c7;

            color: #c27600;
        }


        /* =====================================================
           ACTION BUTTONS
        ===================================================== */

        .action-buttons {
            display: flex;

            align-items: center;

            gap: 8px;

            white-space: nowrap;
        }

        .btn-edit {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            background: #0d6efd;

            color: #ffffff;

            border: none;

            padding: 8px 12px;

            border-radius: 8px;

            font-size: 13px;

            cursor: pointer;
        }

        .btn-edit:hover {
            background: #0b5ed7;
        }

        .btn-delete {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            background: #dc3545;

            color: #ffffff;

            border: none;

            padding: 8px 12px;

            border-radius: 8px;

            font-size: 13px;

            cursor: pointer;
        }

        .btn-delete:hover {
            background: #bb2d3b;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            text-align: center;

            padding: 45px 20px;

            color: #718096;
        }

        .empty i {
            display: block;

            font-size: 45px;

            margin-bottom: 12px;

            color: #a7b2bf;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            padding: 13px 16px;

            border-radius: 9px;

            margin-bottom: 20px;
        }

        .alert-success {
            background: #d9f7e8;

            color: #168451;

            border: 1px solid #bcefd3;
        }

        .alert-error {
            background: #fde2e2;

            color: #c73535;

            border: 1px solid #f7c5c5;
        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal {
            display: none;

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background: rgba(19, 34, 56, 0.45);

            z-index: 5000;

            align-items: center;

            justify-content: center;

            padding: 20px;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 100%;

            max-width: 560px;

            max-height: 90vh;

            overflow-y: auto;

            background: #ffffff;

            border-radius: 15px;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.20);
        }

        .modal-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 20px 24px;

            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h2 {
            margin: 0;

            font-size: 22px;

            color: #17395f;
        }

        .close {
            border: none;

            background: transparent;

            font-size: 28px;

            color: #718096;

            cursor: pointer;
        }

        .modal-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            font-size: 14px;

            font-weight: 600;

            color: #30435c;
        }

        .form-group input,
        .form-group select {
            width: 100%;

            padding: 11px 12px;

            border: 1px solid #dce3eb;

            border-radius: 8px;

            font-size: 14px;

            outline: none;

            background: #ffffff;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #14945f;

            box-shadow:
                0 0 0 3px rgba(20, 148, 95, 0.10);
        }

        .form-row {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 16px;
        }

        .modal-footer {
            display: flex;

            justify-content: flex-end;

            gap: 10px;

            padding: 18px 24px;

            border-top: 1px solid #e2e8f0;
        }

        .btn-cancel {
            background: #ffffff;

            color: #53657b;

            border: 1px solid #dce3eb;

            padding: 10px 17px;

            border-radius: 8px;

            cursor: pointer;
        }

        .btn-save {
            background: #14945f;

            color: #ffffff;

            border: none;

            padding: 10px 18px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: 600;
        }

        .btn-save:hover {
            background: #0d7e50;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 800px) {

            body {
                overflow: auto;
            }

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

        }


        @media (max-width: 600px) {

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
                padding: 25px 14px 40px;
            }

            .page-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         SIDEBAR
    ===================================================== -->

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


            <a
                href="{{ route('owner.payments') }}"
                class="active"
            >

                <span class="menu-icon">
                    <i class="bi bi-cash-stack"></i>
                </span>

                Payments

            </a>


            <a href="{{ route('owner.reports') }}">

                <span class="menu-icon">
                    <i class="bi bi-bar-chart"></i>
                </span>

                Reports

            </a>


            <a href="{{ route('owner.messages') }}">

                <span class="menu-icon">
                    <i class="bi bi-chat-dots"></i>
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



    <!-- =====================================================
         CONTENT
    ===================================================== -->

    <div class="content">


        <!-- TOPBAR -->

        <header class="topbar">

            <i class="bi bi-bell bell"></i>

            <div class="owner-name">

                {{ session('owner_name', 'Owner') }}

            </div>

        </header>



        <!-- MAIN -->

        <main class="main">


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="alert alert-success">

                    <i class="bi bi-check-circle"></i>

                    {{ session('success') }}

                </div>

            @endif


            <!-- ERROR -->

            @if(session('error'))

                <div class="alert alert-error">

                    <i class="bi bi-exclamation-circle"></i>

                    {{ session('error') }}

                </div>

            @endif


            <!-- VALIDATION -->

            @if($errors->any())

                <div class="alert alert-error">

                    <strong>
                        Please fix the following:
                    </strong>

                    <ul
                        style="
                            margin-top:8px;
                            padding-left:20px;
                        "
                    >

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <!-- =================================================
                 PAGE HEADER
            ================================================= -->

            <div class="page-header">


                <div>

                    <h1>
                        Payment Records
                    </h1>

                    <p>
                        Manage and record your tenant payments.
                    </p>

                </div>


                <button
                    type="button"
                    class="add-btn"
                    onclick="openPaymentModal()"
                >

                    <i class="bi bi-plus-lg"></i>

                    Make Payment

                </button>


            </div>



            <!-- =================================================
                 STATISTICS
            ================================================= -->

            <div class="stats-grid">


                <!-- TOTAL PAYMENTS -->

                <div class="stat-card">

                    <div class="icon-box green">

                        <i class="bi bi-cash-stack"></i>

                    </div>

                    <h2>
                        ₱{{ number_format((float)($totalPayments ?? 0), 2) }}
                    </h2>

                    <p>
                        Total Payments
                    </p>

                </div>


                <!-- PENDING PAYMENTS -->

                <div class="stat-card">

                    <div class="icon-box green">

                        <i class="bi bi-clock-history"></i>

                    </div>

                    <h2>
                        {{ $pendingPayments ?? 0 }}
                    </h2>

                    <p>
                        Pending Payments
                    </p>

                </div>


                <!-- THIS MONTH -->

                <div class="stat-card">

                    <div class="icon-box green">

                        <i class="bi bi-calendar-check"></i>

                    </div>

                    <h2>
                        ₱{{ number_format((float)($thisMonthPayments ?? 0), 2) }}
                    </h2>

                    <p>
                        This Month
                    </p>

                </div>


            </div>



            <!-- =================================================
                 RECENT PAYMENTS
            ================================================= -->

            <div class="table-card">


                <div class="table-header">

                    <h3>
                        Recent Payments
                    </h3>

                </div>


                <div class="table-wrapper">

                    <table>


                        <thead>

                            <tr>

                                <th>
                                    Tenant
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                    Payment Date
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse($payments as $payment)


                                <tr>


                                    <td>

                                        @if($payment->tenant)

                                            {{ $payment->tenant->name }}

                                        @else

                                            Unknown Tenant

                                        @endif

                                    </td>


                                    <td>

                                        ₱{{ number_format((float)$payment->amount, 2) }}

                                    </td>


                                    <td>

                                        @if($payment->payment_date)

                                            {{ $payment->payment_date->format('M d, Y') }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        @if($payment->status === 'Paid')

                                            <span class="status status-paid">

                                                <i class="bi bi-check-circle-fill"></i>

                                                Paid

                                            </span>

                                        @else

                                            <span class="status status-pending">

                                                <i class="bi bi-clock-fill"></i>

                                                Pending

                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <div class="action-buttons">


                                            <!-- EDIT -->

                                            <button
                                                type="button"
                                                class="btn-edit"
                                                onclick="openEditPaymentModal(
                                                    {{ $payment->id }},
                                                    '{{ $payment->tenant_id }}',
                                                    '{{ $payment->amount }}',
                                                    '{{ $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '' }}',
                                                    '{{ $payment->status }}'
                                                )"
                                            >

                                                <i class="bi bi-pencil"></i>

                                                Edit

                                            </button>


                                            <!-- DELETE -->

                                            <form
                                                action="{{ route('owner.payments.delete', $payment->id) }}"
                                                method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('Are you sure you want to delete this payment?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn-delete"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                    Delete

                                                </button>

                                            </form>


                                        </div>

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="5">

                                        <div class="empty">

                                            <i class="bi bi-credit-card"></i>

                                            No payment records yet.

                                        </div>

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>


                    </table>

                </div>


            </div>


        </main>


    </div>



    <!-- =====================================================
         MAKE PAYMENT MODAL
    ===================================================== -->

    <div
        class="modal"
        id="paymentModal"
    >

        <div class="modal-content">


            <div class="modal-header">

                <h2>
                    Make Payment
                </h2>

                <button
                    type="button"
                    class="close"
                    onclick="closePaymentModal()"
                >
                    &times;
                </button>

            </div>


            <form
                action="{{ route('owner.payments.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">


                    <div class="form-group">

                        <label for="tenant_id">
                            Tenant
                        </label>

                        <select
                            name="tenant_id"
                            id="tenant_id"
                            required
                        >

                            <option value="">
                                Select Tenant
                            </option>


                            @forelse($tenants as $tenant)

                                <option
                                    value="{{ $tenant->id }}"
                                    data-rent="{{ $tenant->monthly_rent }}"
                                >

                                    {{ $tenant->name }}

                                </option>

                            @empty

                                <option
                                    value=""
                                    disabled
                                >
                                    No tenants registered
                                </option>

                            @endforelse


                        </select>

                    </div>



                    <div class="form-group">

                        <label for="amount">
                            Amount
                        </label>

                        <input
                            type="number"
                            name="amount"
                            id="amount"
                            step="0.01"
                            min="0"
                            placeholder="Enter payment amount"
                            required
                        >

                    </div>



                    <div class="form-row">


                        <div class="form-group">

                            <label for="payment_date">
                                Payment Date
                            </label>

                            <input
                                type="date"
                                name="payment_date"
                                id="payment_date"
                                value="{{ date('Y-m-d') }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="status">
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                            >

                                <option value="">
                                    Select Status
                                </option>

                                <option value="Paid">
                                    Paid
                                </option>

                                <option value="Pending">
                                    Pending
                                </option>

                            </select>

                        </div>


                    </div>


                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="closePaymentModal()"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="btn-save"
                    >

                        <i class="bi bi-check-lg"></i>

                        Save Payment

                    </button>

                </div>


            </form>


        </div>

    </div>



    <!-- =====================================================
         EDIT PAYMENT MODAL
    ===================================================== -->

    <div
        class="modal"
        id="editPaymentModal"
    >

        <div class="modal-content">


            <div class="modal-header">

                <h2>
                    Edit Payment
                </h2>

                <button
                    type="button"
                    class="close"
                    onclick="closeEditPaymentModal()"
                >
                    &times;
                </button>

            </div>


            <form
                id="editPaymentForm"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="modal-body">


                    <div class="form-group">

                        <label for="edit_tenant_id">
                            Tenant
                        </label>

                        <select
                            name="tenant_id"
                            id="edit_tenant_id"
                            required
                        >

                            <option value="">
                                Select Tenant
                            </option>


                            @forelse($tenants as $tenant)

                                <option value="{{ $tenant->id }}">

                                    {{ $tenant->name }}

                                </option>

                            @empty

                                <option
                                    value=""
                                    disabled
                                >
                                    No tenants registered
                                </option>

                            @endforelse


                        </select>

                    </div>



                    <div class="form-group">

                        <label for="edit_amount">
                            Amount
                        </label>

                        <input
                            type="number"
                            name="amount"
                            id="edit_amount"
                            step="0.01"
                            min="0"
                            required
                        >

                    </div>



                    <div class="form-row">


                        <div class="form-group">

                            <label for="edit_payment_date">
                                Payment Date
                            </label>

                            <input
                                type="date"
                                name="payment_date"
                                id="edit_payment_date"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="edit_status">
                                Status
                            </label>

                            <select
                                name="status"
                                id="edit_status"
                                required
                            >

                                <option value="Paid">
                                    Paid
                                </option>

                                <option value="Pending">
                                    Pending
                                </option>

                            </select>

                        </div>


                    </div>


                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="closeEditPaymentModal()"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="btn-save"
                    >

                        <i class="bi bi-check-lg"></i>

                        Update Payment

                    </button>

                </div>


            </form>


        </div>

    </div>



    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

    <script>


        /* =====================================================
           MAKE PAYMENT
        ===================================================== */

        function openPaymentModal()
        {
            document
                .getElementById('paymentModal')
                .classList
                .add('show');
        }


        function closePaymentModal()
        {
            document
                .getElementById('paymentModal')
                .classList
                .remove('show');
        }



        /* =====================================================
           EDIT PAYMENT
        ===================================================== */

        function openEditPaymentModal(
            id,
            tenantId,
            amount,
            paymentDate,
            status
        )
        {

            const modal =
                document.getElementById('editPaymentModal');


            const form =
                document.getElementById('editPaymentForm');


            form.action =
                "{{ url('/owner/payments') }}/" + id;


            document.getElementById(
                'edit_tenant_id'
            ).value = tenantId;


            document.getElementById(
                'edit_amount'
            ).value = amount;


            document.getElementById(
                'edit_payment_date'
            ).value = paymentDate;


            document.getElementById(
                'edit_status'
            ).value = status;


            modal.classList.add('show');

        }


        function closeEditPaymentModal()
        {
            document
                .getElementById('editPaymentModal')
                .classList
                .remove('show');
        }



        /* =====================================================
           CLOSE MODAL WHEN CLICKING OUTSIDE
        ===================================================== */

        document
            .getElementById('paymentModal')
            .addEventListener(
                'click',
                function(event)
                {

                    if (event.target === this)
                    {
                        closePaymentModal();
                    }

                }
            );


        document
            .getElementById('editPaymentModal')
            .addEventListener(
                'click',
                function(event)
                {

                    if (event.target === this)
                    {
                        closeEditPaymentModal();
                    }

                }
            );



        /* =====================================================
           AUTOMATIC RENT AMOUNT
        ===================================================== */

        const tenantSelect =
            document.getElementById('tenant_id');


        const amountInput =
            document.getElementById('amount');


        if (tenantSelect)
        {

            tenantSelect.addEventListener(
                'change',
                function()
                {

                    const selectedOption =
                        this.options[this.selectedIndex];


                    const rent =
                        selectedOption.getAttribute(
                            'data-rent'
                        );


                    if (rent)
                    {
                        amountInput.value = rent;
                    }
                    else
                    {
                        amountInput.value = '';
                    }

                }
            );

        }


    </script>


</body>

</html>
