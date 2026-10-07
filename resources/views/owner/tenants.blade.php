<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tenant Records | AccomFinder</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

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

            font-family: Arial, Helvetica, sans-serif;

            color: #132238;

            overflow: hidden;
        }


        /* =====================================================
           SIDEBAR
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
        ===================================================== */

        .content {
            margin-left: 264px;

            width: calc(100% - 264px);

            height: 100vh;

            overflow: hidden;
        }


        /* =====================================================
           TOP BAR
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

            left: 264px;

            top: 0;

            right: 0;

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
        ===================================================== */

        .main {
            height: calc(100vh - 74px);

            margin-top: 74px;

            padding: 35px 14px 50px;

            overflow-y: auto;

            overflow-x: hidden;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding-bottom: 5px;
        }

        .page-title h1 {
            margin: 0;

            font-size: 38px;

            font-weight: 500;

            color: #132238;
        }

        .page-title p {
            margin: 8px 0 0;

            color: #5d7089;

            font-size: 17px;
        }


        /* =====================================================
           ADD TENANT BUTTON
        ===================================================== */

        .add-tenant-btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            background: #14945f;

            color: #ffffff;

            border: none;

            padding: 14px 22px;

            border-radius: 9px;

            font-size: 17px;

            font-weight: 500;

            cursor: pointer;

            transition: 0.2s;
        }

        .add-tenant-btn:hover {
            background: #0d7e50;

            color: #ffffff;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            border-radius: 10px;

            margin-top: 25px;

            margin-bottom: 0;
        }


        /* =====================================================
           TENANT CARD
        ===================================================== */

        .tenant-card {
            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            margin-top: 30px;

            padding: 25px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

            overflow-x: auto;
        }


        /* =====================================================
           TENANT TABLE
        ===================================================== */

        .tenant-table {
            width: 100%;

            border-collapse: collapse;

            min-width: 950px;
        }

        .tenant-table th {
            text-align: left;

            color: #17395f;

            font-size: 14px;

            font-weight: 600;

            padding: 15px 14px;

            background: #f8fafc;

            border-bottom: 1px solid #e1e6ec;
        }

        .tenant-table td {
            padding: 19px 14px;

            border-bottom: 1px solid #edf0f4;

            color: #66778c;

            font-size: 14px;

            vertical-align: middle;
        }

        .tenant-table tbody tr:last-child td {
            border-bottom: none;
        }

        .tenant-table tbody tr:hover {
            background: #fafcfb;
        }


        /* =====================================================
           TENANT NAME
        ===================================================== */

        .tenant-name {
            color: #17395f;

            font-weight: 600;

            margin-bottom: 4px;
        }

        .tenant-email {
            color: #718096;

            font-size: 13px;
        }


        /* =====================================================
           PROPERTY TYPE
        ===================================================== */

        .property-type {
            color: #273d58;

            font-weight: 500;
        }


        /* =====================================================
           RENT
        ===================================================== */

        .rent {
            color: #14945f;

            font-weight: 600;

            white-space: nowrap;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .badge-active {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            background: #d9f7e8;

            color: #168451;

            padding: 6px 12px;

            border-radius: 20px;

            font-weight: 600;

            font-size: 12px;
        }

        .badge-inactive {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            background: #edf0f3;

            color: #687587;

            padding: 6px 12px;

            border-radius: 20px;

            font-weight: 600;

            font-size: 12px;
        }


        /* =====================================================
           ACTIONS
        ===================================================== */

        .action-icons {
            display: flex;

            align-items: center;

            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            width: 38px;

            height: 38px;

            border-radius: 8px;

            display: flex;

            align-items: center;

            justify-content: center;

            text-decoration: none;

            cursor: pointer;

            border: none;

            transition: 0.2s;
        }

        .edit-btn {
            background: #eaf2ff;

            color: #1769ff;
        }

        .edit-btn:hover {
            background: #1769ff;

            color: #ffffff;
        }

        .delete-btn {
            background: #fff0f0;

            color: #e53935;
        }

        .delete-btn:hover {
            background: #e53935;

            color: #ffffff;
        }

        .action-icons i {
            font-size: 17px;
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-state {
            text-align: center;

            padding: 75px 20px !important;
        }

        .empty-state i {
            display: block;

            font-size: 55px;

            color: #b9c7d8;

            margin-bottom: 18px;
        }

        .empty-state h4 {
            color: #243b56;

            margin-bottom: 8px;
        }

        .empty-state p {
            color: #718096;

            margin-bottom: 0;
        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal-content {
            border: none;

            border-radius: 17px;

            overflow: hidden;
        }

        .modal-header {
            padding: 25px 30px;

            border-bottom: 1px solid #e2e8f0;
        }

        .modal-title {
            color: #17395f;

            font-size: 24px;

            font-weight: 600;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-footer {
            padding: 20px 30px 25px;

            border-top: none;
        }

        .form-label {
            color: #17395f;

            font-size: 15px;

            font-weight: 500;

            margin-bottom: 8px;
        }

        .required {
            color: #ef4444;
        }

        .form-control,
        .form-select {
            height: 52px;

            border: 1px solid #d6e0eb;

            border-radius: 9px;

            font-size: 15px;

            padding: 0 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #14945f;

            box-shadow: 0 0 0 3px rgba(20, 148, 95, 0.10);
        }

        .cancel-btn {
            background: #ffffff;

            border: 1px solid #d6e0eb;

            color: #30435c;

            border-radius: 9px;

            padding: 12px 22px;

            font-size: 15px;
        }

        .save-tenant-btn {
            background: #14945f;

            color: #ffffff;

            border: none;

            border-radius: 9px;

            padding: 12px 22px;

            font-size: 15px;

            font-weight: 500;
        }

        .save-tenant-btn:hover {
            background: #0d7e50;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

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

            .main {
                padding-left: 20px;

                padding-right: 20px;
            }

        }


        @media (max-width: 650px) {

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

            .page-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 20px;
            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     SIDEBAR
========================================================= -->

<div class="sidebar">


    <!-- LOGO -->

    <div class="logo">

        <h2>

            <span>Accom</span>Finder

        </h2>

        <small>
            Owner Portal
        </small>

    </div>


    <!-- MENU -->

    <div class="menu">


        <!-- DASHBOARD -->

        <a href="{{ route('owner.dashboard') }}">

            <span class="menu-icon">

                <i class="bi bi-house-door"></i>

            </span>

            Dashboard

        </a>


        <!-- LISTINGS -->

        <a href="{{ route('owner.listings') }}">

            <span class="menu-icon">

                <i class="bi bi-buildings"></i>

            </span>

            Listings

        </a>


        <!-- TENANTS -->

        <a
            href="{{ route('owner.tenants') }}"
            class="active"
        >

            <span class="menu-icon">

                <i class="bi bi-people"></i>

            </span>

            Tenants

        </a>


        <!-- PAYMENTS -->

        <a href="{{ route('owner.payments') }}">

            <span class="menu-icon">

                <i class="bi bi-cash-stack"></i>

            </span>

            Payments

        </a>


        <!-- REPORTS -->

        <a href="{{ route('owner.reports') }}">

            <span class="menu-icon">

                <i class="bi bi-bar-chart"></i>

            </span>

            Reports

        </a>


        <!-- MESSAGES -->

        <a href="{{ route('owner.messages') }}">

            <span class="menu-icon">

                <i class="bi bi-chat-dots"></i>

            </span>

            Messages

        </a>


    </div>


    <!-- LOGOUT -->

    <div class="bottom">

        <a href="{{ route('owner.logout') }}">

            <span class="menu-icon">

                <i class="bi bi-box-arrow-right"></i>

            </span>

            Logout

        </a>

    </div>


</div>


<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<div class="content">


    <!-- =====================================================
         TOP BAR
    ====================================================== -->

    <div class="topbar">

        <i class="bi bi-bell bell"></i>

        <div class="owner-name">

            {{ session('owner_name', 'Owner') }}

        </div>

    </div>


    <!-- =====================================================
         SCROLLABLE MAIN
    ====================================================== -->

    <div class="main">


        <!-- =================================================
             PAGE HEADER
        ================================================== -->

        <div class="page-header">


            <div class="page-title">

                <h1>
                    Tenant Records
                </h1>

                <p>
                    View and manage your tenant information.
                </p>

            </div>


            <button
                type="button"
                class="add-tenant-btn"
                data-bs-toggle="modal"
                data-bs-target="#addTenantModal"
            >

                <i class="bi bi-plus-lg"></i>

                Add New Tenant

            </button>


        </div>


        <!-- =================================================
             SUCCESS
        ================================================== -->

        @if(session('success'))

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        <!-- =================================================
             ERRORS
        ================================================== -->

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Please correct the following:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- =================================================
             TENANT TABLE
        ================================================== -->

        <div class="tenant-card">


            <table class="tenant-table">


                <thead>

                    <tr>

                        <th>
                            Tenant
                        </th>

                        <th>
                            Property Type
                        </th>

                        <th>
                            Lease Period
                        </th>

                        <th>
                            Monthly Rent
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Contact
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($tenants as $tenant)


                        <tr>


                            <!-- TENANT -->

                            <td>

                                <div class="tenant-name">

                                    {{ $tenant->name }}

                                </div>

                                <div class="tenant-email">

                                    {{ $tenant->email }}

                                </div>

                            </td>


                            <!-- PROPERTY TYPE -->

                            <td>

                                <span class="property-type">

                                    {{ $tenant->property_type ?? 'N/A' }}

                                </span>

                            </td>


                            <!-- LEASE PERIOD -->

                            <td>

                                <div>

                                    <strong>
                                        Start:
                                    </strong>

                                    {{ $tenant->start_date
                                        ? \Carbon\Carbon::parse($tenant->start_date)->format('M d, Y')
                                        : 'N/A'
                                    }}

                                </div>

                                <div class="mt-1">

                                    <strong>
                                        End:
                                    </strong>

                                    {{ $tenant->end_date
                                        ? \Carbon\Carbon::parse($tenant->end_date)->format('M d, Y')
                                        : 'N/A'
                                    }}

                                </div>

                            </td>


                            <!-- MONTHLY RENT -->

                            <td>

                                <span class="rent">

                                    ₱{{ number_format((float) $tenant->monthly_rent, 2) }}

                                </span>

                            </td>


                            <!-- STATUS -->

                            <td>


                                @if($tenant->status === 'Active')


                                    <span class="badge-active">

                                        <i class="bi bi-check-circle-fill"></i>

                                        Active

                                    </span>


                                @else


                                    <span class="badge-inactive">

                                        <i class="bi bi-dash-circle-fill"></i>

                                        {{ $tenant->status }}

                                    </span>


                                @endif


                            </td>


                            <!-- CONTACT -->

                            <td>

                                <div>

                                    <i class="bi bi-envelope me-1"></i>

                                    {{ $tenant->email }}

                                </div>

                                <div class="mt-1">

                                    <i class="bi bi-telephone me-1"></i>

                                    {{ $tenant->phone }}

                                </div>

                            </td>


                            <!-- ACTIONS -->

                            <td>


                                <div class="action-icons">


                                    <!-- EDIT -->

                                    <a
                                        href="{{ route('owner.tenants.edit', $tenant->id) }}"
                                        class="edit-btn"
                                        title="Edit Tenant"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <!-- DELETE -->

                                    <form
                                        action="{{ route('owner.tenants.delete', $tenant->id) }}"
                                        method="POST"
                                        style="display:inline; margin:0;"
                                        onsubmit="return confirm('Are you sure you want to delete this tenant?');"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="delete-btn"
                                            title="Delete Tenant"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>


                                    </form>


                                </div>


                            </td>


                        </tr>


                    @empty


                        <!-- EMPTY -->

                        <tr>

                            <td
                                colspan="7"
                                class="empty-state"
                            >

                                <i class="bi bi-people"></i>

                                <h4>
                                    No Tenants Yet
                                </h4>

                                <p>
                                    Add your first tenant to get started.
                                </p>

                            </td>

                        </tr>


                    @endforelse


                </tbody>


            </table>


        </div>


    </div>


</div>


<!-- =========================================================
     ADD TENANT MODAL
========================================================= -->

<div
    class="modal fade"
    id="addTenantModal"
    tabindex="-1"
    aria-labelledby="addTenantModalLabel"
    aria-hidden="true"
>


    <div class="modal-dialog modal-lg modal-dialog-centered">


        <div class="modal-content">


            <!-- HEADER -->

            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="addTenantModalLabel"
                >
                    Add New Tenant
                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <!-- FORM -->

            <form
                action="{{ route('owner.tenants.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">


                    <div class="row g-4">


                        <!-- NAME -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Name

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter tenant name"
                                value="{{ old('name') }}"
                                required
                            >

                        </div>


                        <!-- EMAIL -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Email

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter email address"
                                value="{{ old('email') }}"
                                required
                            >

                        </div>


                        <!-- PHONE -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Phone

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                placeholder="09123456789"
                                value="{{ old('phone') }}"
                                required
                            >

                        </div>


                        <!-- PROPERTY TYPE -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Property Type

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <select
                                name="property_type"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Property Type
                                </option>

                                <option
                                    value="Boarding House"
                                    {{ old('property_type') == 'Boarding House' ? 'selected' : '' }}
                                >
                                    Boarding House
                                </option>

                                <option
                                    value="Apartment"
                                    {{ old('property_type') == 'Apartment' ? 'selected' : '' }}
                                >
                                    Apartment
                                </option>

                                <option
                                    value="Dormitory"
                                    {{ old('property_type') == 'Dormitory' ? 'selected' : '' }}
                                >
                                    Dormitory
                                </option>

                                <option
                                    value="Room"
                                    {{ old('property_type') == 'Room' ? 'selected' : '' }}
                                >
                                    Room
                                </option>

                                <option
                                    value="Bedspace"
                                    {{ old('property_type') == 'Bedspace' ? 'selected' : '' }}
                                >
                                    Bedspace
                                </option>

                            </select>

                        </div>


                        <!-- MOVE-IN DATE -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Move-in Date

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="date"
                                name="start_date"
                                class="form-control"
                                value="{{ old('start_date') }}"
                                required
                            >

                        </div>


                        <!-- END DATE -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Lease End Date

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="date"
                                name="end_date"
                                class="form-control"
                                value="{{ old('end_date') }}"
                                required
                            >

                        </div>


                        <!-- MONTHLY RENT -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Monthly Rent

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="number"
                                name="monthly_rent"
                                class="form-control"
                                placeholder="Enter monthly rent"
                                value="{{ old('monthly_rent') }}"
                                min="0"
                                step="0.01"
                                required
                            >

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Status

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="Active"
                                    {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    {{ old('status') == 'Inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>


                    </div>


                </div>


                <!-- FOOTER -->

                <div class="modal-footer">


                    <button
                        type="button"
                        class="cancel-btn"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="save-tenant-btn"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Add Tenant

                    </button>


                </div>


            </form>


        </div>


    </div>


</div>


<!-- =========================================================
     BOOTSTRAP JS
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>
