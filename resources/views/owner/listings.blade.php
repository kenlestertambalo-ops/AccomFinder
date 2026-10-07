<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Listings | AccomFinder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

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
           MAIN CONTENT
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
            width: 100%;

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

        .topbar .bell {
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
           SCROLLABLE MAIN AREA
        ===================================================== */

        .main {
            height: calc(100vh - 74px);

            margin-top: 74px;

            padding: 35px 14px 50px 14px;

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

            padding: 0 0 5px 0;
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
           ADD NEW LISTING BUTTON
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

            text-decoration: none;

            font-size: 17px;

            font-weight: 500;

            transition: 0.2s;
        }

        .add-btn:hover {
            background: #0d7e50;

            color: #ffffff;
        }


        /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

        .success-message {
            margin-top: 25px;

            padding: 14px 18px;

            background: #dff7e9;

            border: 1px solid #b7e8ca;

            color: #167344;

            border-radius: 10px;
        }


        /* =====================================================
           LISTINGS CONTAINER
        ===================================================== */

        .listings-container {
            margin-top: 30px;

            width: 100%;
        }


        /* =====================================================
           LISTINGS GRID
        ===================================================== */

        .listings-grid {
            display: grid;

            grid-template-columns: repeat(3, minmax(0, 1fr));

            gap: 24px;

            width: 100%;
        }


        /* =====================================================
           LISTING CARD
        ===================================================== */

        .listing-card {
            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            overflow: hidden;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

            transition: 0.2s;
        }

        .listing-card:hover {
            transform: translateY(-2px);

            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }


        /* =====================================================
           LISTING IMAGE
        ===================================================== */

        .listing-image {
            width: 100%;

            height: 190px;

            object-fit: cover;

            display: block;
        }

        .listing-image-placeholder {
            width: 100%;

            height: 190px;

            background: #edf2f7;

            display: flex;

            justify-content: center;

            align-items: center;

            color: #a7b2bf;

            font-size: 55px;
        }


        /* =====================================================
           LISTING BODY
        ===================================================== */

        .listing-body {
            padding: 22px;
        }

        .listing-title {
            margin: 0 0 8px;

            font-size: 21px;

            font-weight: 600;

            color: #17395f;
        }

        .listing-location {
            display: flex;

            align-items: flex-start;

            gap: 7px;

            color: #66778c;

            font-size: 14px;

            margin-bottom: 17px;
        }

        .listing-location i {
            color: #14945f;

            margin-top: 2px;
        }


        /* =====================================================
           PRICE
        ===================================================== */

        .listing-price {
            font-size: 23px;

            font-weight: 600;

            color: #14945f;

            margin-bottom: 16px;
        }

        .listing-price small {
            font-size: 13px;

            font-weight: 400;

            color: #718096;
        }


        /* =====================================================
           DETAILS
        ===================================================== */

        .listing-details {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 11px;

            padding: 15px 0;

            border-top: 1px solid #edf0f4;

            border-bottom: 1px solid #edf0f4;
        }

        .detail-item {
            display: flex;

            align-items: center;

            gap: 7px;

            color: #53657b;

            font-size: 13px;
        }

        .detail-item i {
            color: #1a8e68;

            font-size: 16px;

            min-width: 17px;
        }

        .detail-item strong {
            color: #273d58;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .listing-status {
            margin-top: 16px;
        }

        .status-available {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            background: #d9f7e8;

            color: #168451;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: 600;
        }

        .status-full {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            background: #fde2e2;

            color: #c73535;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: 600;
        }


        /* =====================================================
           ACTION BUTTONS
        ===================================================== */

        .listing-actions {
            display: flex;

            gap: 9px;

            margin-top: 18px;
        }

        .edit-btn {
            flex: 1;

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 6px;

            background: #0d6efd;

            color: #ffffff;

            padding: 10px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;
        }

        .edit-btn:hover {
            background: #0b5ed7;

            color: #ffffff;
        }

        .delete-btn {
            flex: 1;

            width: 100%;

            background: #dc3545;

            color: #ffffff;

            border: none;

            padding: 10px;

            border-radius: 8px;

            font-size: 14px;

            cursor: pointer;
        }

        .delete-btn:hover {
            background: #bb2d3b;
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-card {
            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            padding: 75px 30px;

            text-align: center;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .empty-icon {
            width: 75px;

            height: 75px;

            margin: 0 auto 20px;

            border-radius: 50%;

            background: #edf2f7;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #a7b2bf;

            font-size: 36px;
        }

        .empty-card h3 {
            margin: 0 0 8px;

            font-size: 22px;

            color: #243b56;
        }

        .empty-card p {
            margin: 0 0 24px;

            color: #718096;

            font-size: 15px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1250px) {

            .listings-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 850px) {

            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;

                width: calc(100% - 220px);
            }

            .topbar {
                left: 220px;
            }

            .listings-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                align-items: flex-start;

                gap: 20px;

                flex-direction: column;
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

        <a
            href="{{ route('owner.listings') }}"
            class="active"
        >

            <span class="menu-icon">
                <i class="bi bi-buildings"></i>
            </span>

            Listings

        </a>


        <!-- TENANTS -->

        <a href="{{ route('owner.tenants') }}">

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
     CONTENT
========================================================= -->

<div class="content">


    <!-- =====================================================
         FIXED TOP BAR
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

            <div>

                <h1>
                    Listings
                </h1>

                <p>
                    Add, edit, or remove your property listings
                </p>

            </div>


            <a
                href="{{ route('owner.listings.create') }}"
                class="add-btn"
            >

                <i class="bi bi-plus-lg"></i>

                Add New Listing

            </a>

        </div>


        <!-- =================================================
             SUCCESS MESSAGE
        ================================================== -->

        @if(session('success'))

            <div class="success-message">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        <!-- =================================================
             LISTINGS
        ================================================== -->

        <div class="listings-container">


            @if($listings->count() > 0)


                <div class="listings-grid">


                    @foreach($listings as $listing)


                        <!-- =================================
                             LISTING CARD
                        ================================== -->

                        <div class="listing-card">


                            <!-- IMAGE -->

                            @if(!empty($listing->image))

                                <img
                                    src="{{ asset('storage/' . $listing->image) }}"
                                    class="listing-image"
                                    alt="{{ $listing->name }}"
                                >

                            @else

                                <div class="listing-image-placeholder">

                                    <i class="bi bi-buildings"></i>

                                </div>

                            @endif


                            <!-- CARD BODY -->

                            <div class="listing-body">


                                <!-- PROPERTY NAME -->

                                <h3 class="listing-title">

                                    {{ $listing->name }}

                                </h3>


                                <!-- LOCATION -->

                                <div class="listing-location">

                                    <i class="bi bi-geo-alt-fill"></i>

                                    <span>
                                        {{ $listing->address }}
                                    </span>

                                </div>


                                <!-- PRICE -->

                                <div class="listing-price">

                                    ₱{{ number_format($listing->price, 2) }}

                                    <small>
                                        / month
                                    </small>

                                </div>


                                <!-- DETAILS -->

                                <div class="listing-details">


                                    <!-- TYPE -->

                                    <div class="detail-item">

                                        <i class="bi bi-house"></i>

                                        <span>

                                            <strong>
                                                Type:
                                            </strong>

                                            {{ $listing->type ?? 'N/A' }}

                                        </span>

                                    </div>


                                    <!-- ROOMS -->

                                    <div class="detail-item">

                                        <i class="bi bi-door-open"></i>

                                        <span>

                                            <strong>
                                                Rooms:
                                            </strong>

                                            {{ $listing->bedrooms ?? 0 }}

                                        </span>

                                    </div>


                                    <!-- CR -->

                                    <div class="detail-item">

                                        <i class="bi bi-droplet"></i>

                                        <span>

                                            <strong>
                                                CR:
                                            </strong>

                                            {{ $listing->bathrooms ?? 0 }}

                                        </span>

                                    </div>

                                    <!-- CAPACITY -->

                                    <div class="detail-item">

                                        <i class="bi bi-person"></i>

                                        <span>

                                            <strong>
                                                Capacity:
                                            </strong>

                                            {{ $listing->capacity ?? 1 }}

                                            {{ ($listing->capacity ?? 1) == 1 ? 'person' : 'people' }}

                                        </span>

                                    </div>


                                    <!-- AMENITIES -->

                                    <div class="detail-item">

                                        <i class="bi bi-stars"></i>

                                        <span>

                                            <strong>
                                                Amenities:
                                            </strong>

                                            @if(is_array($listing->amenities) && count($listing->amenities) > 0)

                                                {{ count($listing->amenities) }}

                                            @else

                                                0

                                            @endif

                                        </span>

                                    </div>


                                </div>


                                <!-- STATUS -->

                                <div class="listing-status">


                                    @if($listing->status == 'Available')


                                        <span class="status-available">

                                            <i class="bi bi-check-circle-fill"></i>

                                            Available

                                        </span>


                                    @else


                                        <span class="status-full">

                                            <i class="bi bi-x-circle-fill"></i>

                                            {{ $listing->status }}

                                        </span>


                                    @endif


                                </div>


                                <!-- ACTIONS -->

                                <div class="listing-actions">


                                    <!-- EDIT -->

                                    <a
                                        href="{{ route('owner.listings.edit', $listing->id) }}"
                                        class="edit-btn"
                                    >

                                        <i class="bi bi-pencil"></i>

                                        Edit

                                    </a>


                                    <!-- DELETE -->

                                    <form
                                        action="{{ route('owner.listings.delete', $listing->id) }}"
                                        method="POST"
                                        style="flex:1; margin:0;"
                                        onsubmit="return confirm('Are you sure you want to delete this listing?');"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="delete-btn"
                                        >

                                            <i class="bi bi-trash"></i>

                                            Delete

                                        </button>


                                    </form>


                                </div>


                            </div>


                        </div>


                    @endforeach


                </div>


            @else


                <!-- =================================================
                     EMPTY STATE
                ================================================== -->

                <div class="empty-card">


                    <div class="empty-icon">

                        <i class="bi bi-buildings"></i>

                    </div>


                    <h3>
                        No Listings Yet
                    </h3>


                    <p>
                        You have not created any accommodation listings yet.
                    </p>


                    <a
                        href="{{ route('owner.listings.create') }}"
                        class="add-btn"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Add New Listing

                    </a>


                </div>


            @endif


        </div>


    </div>


</div>


</body>

</html>
