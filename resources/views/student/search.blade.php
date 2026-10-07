<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Search Accommodation | AccomFinder</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }


        body {
            background: #f5f7fb;
            color: #333;
        }


        /* =====================================================
           FIXED SIDEBAR
        ===================================================== */

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


        /* =====================================================
           LOGO
        ===================================================== */

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


        /* =====================================================
           MENU
        ===================================================== */

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


        /* =====================================================
           LOGOUT
        ===================================================== */

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


        /* =====================================================
           MAIN AREA
        ===================================================== */

        .main {
            margin-left: 250px;

            width: calc(100% - 250px);
            min-height: 100vh;

            background: #f5f7fb;
        }


        /* =====================================================
           FIXED TOP NAVBAR
        ===================================================== */

        .navbar {
            position: fixed;

            top: 0;
            right: 0;

            left: 250px;

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


        /* =====================================================
           PAGE CONTENT
        ===================================================== */

        .content {
            padding: 100px 30px 30px 30px;
        }


        .page-title {
            margin-bottom: 25px;
        }


        .page-title h1 {
            margin: 0 0 5px 0;

            color: #173b63;

            font-size: 44px;
            font-weight: 700;
        }


        .page-title p {
            margin: 0;

            color: #777;

            font-size: 21px;
        }


        /* =====================================================
           SEARCH BOX
        ===================================================== */

        .search-box {
            background: #ffffff;

            padding: 25px;

            border-radius: 12px;

            margin-bottom: 30px;

            border: 1px solid #e1e5ea;

            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.04);
        }


        .search-form {
            display: grid;

            grid-template-columns:
                2fr
                1fr
                1fr
                1fr
                190px;

            gap: 20px;

            align-items: end;
        }


        .form-group {
            width: 100%;
        }


        .form-group label {
            display: block;

            font-size: 16px;

            font-weight: 600;

            margin-bottom: 8px;

            color: #222;
        }


        .form-control,
        .form-select {
            width: 100%;

            height: 52px;

            padding: 0 15px;

            border: 1px solid #d5dbe1;

            border-radius: 8px;

            background: white;

            color: #333;

            font-size: 17px;

            outline: none;
        }


        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
        }


        .search-button {
            width: 100%;

            height: 52px;

            background: #1264e8;

            color: white;

            border: none;

            padding: 0 20px;

            border-radius: 8px;

            font-size: 18px;

            cursor: pointer;
        }


        .search-button:hover {
            background: #0b5ed7;
        }


        /* =====================================================
           RESULTS
        ===================================================== */

        .results-title {
            margin-bottom: 20px;

            color: #173b63;

            font-size: 28px;

            font-weight: 500;
        }


        .listings-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 25px;
        }


        /* =====================================================
           PROPERTY CARD
        ===================================================== */

        .property-card {
            background: #ffffff;

            border-radius: 10px;

            overflow: hidden;

            border: 1px solid #e1e5ea;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.06);

            height: 100%;
        }


        .property-image {
            width: 100%;

            height: 230px;

            object-fit: cover;

            display: block;
        }


        .default-image {
            width: 100%;
            height: 230px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #eaf0f8;

            font-size: 60px;
        }


        .property-body {
            padding: 20px;
        }


        /* =====================================================
           AVAILABILITY
        ===================================================== */

        .badge-available {
            display: inline-block;

            background: #1cc88a;

            color: white;

            padding: 6px 10px;

            border-radius: 5px;

            font-size: 13px;
        }


        .badge-occupied {
            display: inline-block;

            background: #e74a3b;

            color: white;

            padding: 6px 10px;

            border-radius: 5px;

            font-size: 13px;
        }


        /* =====================================================
           TITLE
        ===================================================== */

        .property-title {
            margin-top: 15px;

            margin-bottom: 8px;

            font-size: 20px;

            font-weight: 700;

            color: #173b63;
        }


        /* =====================================================
           LOCATION
        ===================================================== */

        .location {
            color: #666;

            font-size: 15px;

            margin-bottom: 12px;
        }


        /* =====================================================
           TYPE
        ===================================================== */

        .type-badge {
            display: inline-block;

            background: #6c757d;

            color: white;

            padding: 5px 9px;

            border-radius: 5px;

            font-size: 12px;

            margin-bottom: 12px;
        }


        /* =====================================================
           FEATURES
        ===================================================== */

        .features {
            margin-bottom: 10px;
        }


        .feature {
            display: inline-block;

            font-size: 14px;

            color: #666;

            margin-right: 15px;

            margin-bottom: 5px;
        }


        /* =====================================================
           AMENITIES
        ===================================================== */

        .amenity {
            display: inline-block;

            background: #0d6efd;

            color: white;

            padding: 5px 8px;

            border-radius: 5px;

            font-size: 12px;

            margin-right: 4px;

            margin-bottom: 4px;
        }


        .divider {
            border: 0;

            border-top: 1px solid #eee;

            margin: 15px 0;
        }


        /* =====================================================
           PRICE
        ===================================================== */

        .price-details {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 15px;
        }


        .price {
            color: #0d6efd;

            font-size: 24px;

            font-weight: bold;
        }


        .price-label {
            font-size: 12px;

            color: #777;

            margin-top: 2px;
        }


        /* =====================================================
           ACTIONS
        ===================================================== */

        .listing-actions {
            display: flex;

            align-items: center;

            gap: 8px;
        }


        .save-button {
            width: 44px;
            height: 42px;

            border: 1px solid #0d6efd;

            background: #ffffff;

            color: #0d6efd;

            border-radius: 6px;

            font-size: 23px;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            transition: 0.2s ease;
        }


        .save-button:hover {
            background: #0d6efd;

            color: #ffffff;
        }


        /* =====================================================
           VIEW DETAILS BUTTON
        ===================================================== */

        .details-button {
            display: inline-block;

            background: #0d6efd;

            color: white;

            border: none;

            text-decoration: none;

            padding: 10px 15px;

            border-radius: 6px;

            font-size: 14px;

            white-space: nowrap;

            cursor: pointer;
        }


        .details-button:hover {
            background: #0b5ed7;

            color: white;
        }


        /* =====================================================
           MESSAGES
        ===================================================== */

        .success-message {
            background: #d1e7dd;

            color: #0f5132;

            border: 1px solid #badbcc;

            padding: 12px 16px;

            border-radius: 8px;

            margin-bottom: 20px;

            font-size: 15px;
        }


        .error-message {
            background: #f8d7da;

            color: #842029;

            border: 1px solid #f5c2c7;

            padding: 12px 16px;

            border-radius: 8px;

            margin-bottom: 20px;

            font-size: 15px;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-box {
            background: #ffffff;

            border: 1px solid #e1e5ea;

            border-radius: 10px;

            padding: 60px 20px;

            text-align: center;

            color: #777;
        }


        .empty-box h4 {
            color: #173b63;

            margin-bottom: 8px;

            font-size: 24px;
        }


        .empty-box p {
            font-size: 16px;
        }


        /* =====================================================
           FLOATING DETAILS WINDOW
        ===================================================== */

        .details-modal {
            position: fixed;

            inset: 0;

            width: 100%;
            height: 100%;

            background: rgba(15, 23, 42, 0.60);

            display: none;

            align-items: center;

            justify-content: center;

            padding: 25px;

            z-index: 5000;

            backdrop-filter: blur(3px);
        }


        .details-modal.show {
            display: flex;
        }


        .details-window {
            position: relative;

            width: min(1100px, 94vw);

            height: min(850px, 92vh);

            background: #ffffff;

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.35);

            animation:
                detailsWindowOpen
                0.2s ease-out;
        }


        @keyframes detailsWindowOpen {

            from {
                opacity: 0;
                transform: translateY(20px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

        }


        /* =====================================================
           FLOATING WINDOW HEADER
        ===================================================== */

        .details-window-header {
            height: 58px;

            background: #ffffff;

            border-bottom: 1px solid #e1e5ea;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 18px 0 22px;

            position: relative;

            z-index: 10;
        }


        .details-window-title {
            color: #173b63;

            font-size: 17px;

            font-weight: 700;
        }


        .close-details {
            width: 38px;

            height: 38px;

            border: none;

            border-radius: 50%;

            background: #f1f5f9;

            color: #334155;

            font-size: 25px;

            line-height: 1;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            transition: 0.2s;
        }


        .close-details:hover {
            background: #fee2e2;

            color: #dc2626;
        }


        /* =====================================================
           DETAILS IFRAME
        ===================================================== */

        .details-frame {
            width: 100%;

            height: calc(100% - 58px);

            border: none;

            display: block;

            background: #f8fafc;
        }


        /* =====================================================
           LOADING
        ===================================================== */

        .details-loading {
            position: absolute;

            inset: 58px 0 0 0;

            background: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-direction: column;

            gap: 12px;

            color: #173b63;

            z-index: 5;
        }


        .loading-spinner {
            width: 38px;

            height: 38px;

            border: 4px solid #dbeafe;

            border-top-color: #2563eb;

            border-radius: 50%;

            animation: spin 0.8s linear infinite;
        }


        @keyframes spin {

            to {
                transform: rotate(360deg);
            }

        }


        .details-loading span {
            font-size: 14px;

            color: #64748b;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1200px) {

            .search-form {
                grid-template-columns:
                    2fr
                    1fr
                    1fr;
            }


            .listings-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 900px) {

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


            .search-form {
                grid-template-columns: 1fr 1fr;
            }


            .listings-grid {
                grid-template-columns: 1fr;
            }


            .details-modal {
                padding: 10px;
            }


            .details-window {
                width: 98vw;

                height: 95vh;
            }

        }


        @media (max-width: 700px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;
            }


            .logout {
                position: relative;

                left: auto;

                right: auto;

                bottom: auto;

                padding: 20px;
            }


            .main {
                margin-left: 0;

                width: 100%;
            }


            .navbar {
                position: relative;

                left: auto;

                right: auto;

                height: 70px;
            }


            .content {
                padding: 30px 20px;
            }


            .search-form {
                grid-template-columns: 1fr;
            }


            .page-title h1 {
                font-size: 32px;
            }


            .details-modal {
                padding: 0;
            }


            .details-window {
                width: 100vw;

                height: 100vh;

                border-radius: 0;
            }


            .details-window-header {
                height: 55px;
            }


            .details-frame {
                height: calc(100% - 55px);
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         SIDEBAR
    ========================================================= -->

    <div class="sidebar">


        <div class="logo">

            <h2>
                AccomFinder
            </h2>

            <p>
                Student Portal
            </p>

        </div>


        <div class="menu">


            <a href="{{ route('student.dashboard') }}">

                🏠 Dashboard

            </a>


            <a
                href="{{ route('student.search') }}"
                class="active"
            >

                🔍 Search

            </a>


            <a href="{{ route('student.saved') }}">

                ❤ Saved

            </a>


            <a href="{{ route('student.messages') }}">

                💬 Messages

            </a>


        </div>


        <div class="logout">

            <a href="{{ route('student.logout') }}">

                🚪 Logout

            </a>

        </div>


    </div>



    <!-- =========================================================
         MAIN
    ========================================================= -->

    <div class="main">


        <!-- TOP NAVBAR -->

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



        <!-- PAGE CONTENT -->

        <div class="content">


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="success-message">

                    {{ session('success') }}

                </div>

            @endif


            <!-- ERROR -->

            @if(session('error'))

                <div class="error-message">

                    {{ session('error') }}

                </div>

            @endif



            <!-- PAGE TITLE -->

            <div class="page-title">

                <h1>
                    Search Accommodation
                </h1>

                <p>
                    Find your perfect student home
                </p>

            </div>



            <!-- =================================================
                 SEARCH FORM
            ================================================= -->

            <div class="search-box">

                <form
                    method="GET"
                    action="{{ route('student.search') }}"
                    style="width:100%;"
                >

                    <div class="search-form">


                        <!-- SEARCH -->

                        <div class="form-group">

                            <label>
                                Search
                            </label>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Location or property title"
                                value="{{ request('search') }}"
                            >

                        </div>



                        <!-- PRICE -->

                        <div class="form-group">

                            <label>
                                Price
                            </label>

                            <select
                                name="price"
                                class="form-select"
                            >

                                <option value="">
                                    All Prices
                                </option>

                                <option
                                    value="Below 2000"
                                    {{ request('price') == 'Below 2000' ? 'selected' : '' }}
                                >
                                    Below ₱2,000
                                </option>

                                <option
                                    value="2000-5000"
                                    {{ request('price') == '2000-5000' ? 'selected' : '' }}
                                >
                                    ₱2,000 - ₱5,000
                                </option>

                                <option
                                    value="Above 5000"
                                    {{ request('price') == 'Above 5000' ? 'selected' : '' }}
                                >
                                    Above ₱5,000
                                </option>

                            </select>

                        </div>



                        <!-- TYPE -->

                        <div class="form-group">

                            <label>
                                Type
                            </label>

                            <select
                                name="type"
                                class="form-select"
                            >

                                <option value="">
                                    All Types
                                </option>

                                <option
                                    value="Apartment"
                                    {{ request('type') == 'Apartment' ? 'selected' : '' }}
                                >
                                    Apartment
                                </option>

                                <option
                                    value="Boarding House"
                                    {{ request('type') == 'Boarding House' ? 'selected' : '' }}
                                >
                                    Boarding House
                                </option>

                                <option
                                    value="House"
                                    {{ request('type') == 'House' ? 'selected' : '' }}
                                >
                                    House
                                </option>

                            </select>

                        </div>



                        <!-- AVAILABILITY -->

                        <div class="form-group">

                            <label>
                                Availability
                            </label>

                            <select
                                name="availability"
                                class="form-select"
                            >

                                <option value="">
                                    All
                                </option>

                                <option
                                    value="Available"
                                    {{ request('availability') == 'Available' ? 'selected' : '' }}
                                >
                                    Available
                                </option>

                                <option
                                    value="Occupied"
                                    {{ request('availability') == 'Occupied' ? 'selected' : '' }}
                                >
                                    Occupied
                                </option>

                            </select>

                        </div>



                        <!-- SEARCH BUTTON -->

                        <div class="form-group">

                            <button
                                type="submit"
                                class="search-button"
                            >

                                🔍 Search

                            </button>

                        </div>


                    </div>

                </form>

            </div>



            <!-- =================================================
                 RESULTS
            ================================================= -->

            <h2 class="results-title">

                Found {{ $listings->count() }} Properties

            </h2>



            @if($listings->count() > 0)


                <div class="listings-grid">


                    @foreach($listings as $listing)


                        <div class="property-card">


                            <!-- IMAGE -->

                            @if(!empty($listing->image))

                                <img
                                    src="{{ asset('storage/' . $listing->image) }}"
                                    class="property-image"
                                    alt="{{ $listing->name }}"
                                >

                            @else

                                <div class="default-image">

                                    🏠

                                </div>

                            @endif



                            <div class="property-body">


                                <!-- AVAILABILITY -->

                                @if($listing->status === 'Available')

                                    <span class="badge-available">

                                        Available

                                    </span>

                                @else

                                    <span class="badge-occupied">

                                        {{ $listing->status }}

                                    </span>

                                @endif



                                <!-- NAME -->

                                <h3 class="property-title">

                                    {{ $listing->name }}

                                </h3>



                                <!-- LOCATION -->

                                <p class="location">

                                    📍 {{ $listing->address }}

                                </p>



                                <!-- TYPE -->

                                @if($listing->type)

                                    <span class="type-badge">

                                        {{ $listing->type }}

                                    </span>

                                @endif



                                <!-- FEATURES -->

                                <div class="features">


                                    @if(isset($listing->bedrooms))

                                        <span class="feature">

                                            🛏 {{ $listing->bedrooms }}

                                        </span>

                                    @endif


                                    @if(isset($listing->bathrooms))

                                        <span class="feature">

                                            🚿 {{ $listing->bathrooms }}

                                        </span>

                                    @endif


                                    @if(isset($listing->capacity))

                                        <span class="feature">

                                            👤 {{ $listing->capacity }}

                                            {{ $listing->capacity == 1 ? 'person' : 'people' }}

                                        </span>

                                    @endif


                                </div>



                                <!-- AMENITIES -->

                                @php

                                    $amenities =
                                        $listing->amenities ?? [];

                                    if (is_string($amenities)) {

                                        $amenities =
                                            json_decode(
                                                $amenities,
                                                true
                                            ) ?? [];

                                    }

                                @endphp


                                @if(
                                    is_array($amenities)
                                    &&
                                    count($amenities) > 0
                                )

                                    <div>

                                        @foreach(
                                            array_slice(
                                                $amenities,
                                                0,
                                                3
                                            )
                                            as $amenity
                                        )

                                            <span class="amenity">

                                                {{ $amenity }}

                                            </span>

                                        @endforeach

                                    </div>

                                @endif



                                <hr class="divider">



                                <!-- PRICE + ACTIONS -->

                                <div class="price-details">


                                    <!-- PRICE -->

                                    <div>

                                        <div class="price">

                                            ₱{{ number_format($listing->price, 2) }}

                                        </div>

                                        <div class="price-label">

                                            per month

                                        </div>

                                    </div>



                                    <!-- ACTIONS -->

                                    <div class="listing-actions">


                                        <!-- SAVE -->

                                        <form
                                            action="{{ route('student.saved.store', $listing->id) }}"
                                            method="POST"
                                            style="margin:0;"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="save-button"
                                                title="Save Property"
                                            >

                                                ♡

                                            </button>

                                        </form>



                                        <!-- VIEW DETAILS -->

                                        <button
                                            type="button"
                                            class="details-button"
                                            onclick="openDetailsModal(
                                                '{{ route('student.accommodation.show', $listing->id) }}'
                                            )"
                                        >

                                            View Details

                                        </button>


                                    </div>


                                </div>


                            </div>


                        </div>


                    @endforeach


                </div>


            @else


                <!-- NO RESULTS -->

                <div class="empty-box">

                    <h4>
                        No accommodations found
                    </h4>

                    <p>
                        There are currently no accommodations matching your search.
                    </p>

                </div>


            @endif


        </div>


    </div>



    <!-- =========================================================
         FLOATING VIEW DETAILS WINDOW
    ========================================================= -->

    <div
        id="detailsModal"
        class="details-modal"
        onclick="closeDetailsFromBackground(event)"
    >


        <div
            class="details-window"
            onclick="event.stopPropagation()"
        >


            <!-- HEADER -->

            <div class="details-window-header">


                <div class="details-window-title">

                    Accommodation Details

                </div>


                <button
                    type="button"
                    class="close-details"
                    onclick="closeDetailsModal()"
                    title="Close"
                >

                    ×

                </button>


            </div>



            <!-- LOADING -->

            <div
                id="detailsLoading"
                class="details-loading"
            >

                <div class="loading-spinner"></div>

                <span>
                    Loading accommodation details...
                </span>

            </div>



            <!-- DETAILS PAGE -->

            <iframe
                id="detailsFrame"
                class="details-frame"
                src="about:blank"
                title="Accommodation Details"
            ></iframe>


        </div>

    </div>



    <!-- =========================================================
         FLOATING WINDOW JAVASCRIPT
    ========================================================= -->

    <script>

        function openDetailsModal(url) {

            const modal =
                document.getElementById(
                    'detailsModal'
                );

            const frame =
                document.getElementById(
                    'detailsFrame'
                );

            const loading =
                document.getElementById(
                    'detailsLoading'
                );


            /*
             * Show loading screen
             */

            loading.style.display =
                'flex';


            /*
             * Open modal
             */

            modal.classList.add(
                'show'
            );


            /*
             * Prevent background scrolling
             */

            document.body.style.overflow =
                'hidden';


            /*
             * Load existing accommodation
             * details page.
             */

            frame.src = url;


            /*
             * Hide loading after page loads.
             */

            frame.onload = function() {

                loading.style.display =
                    'none';

            };

        }



        function closeDetailsModal() {

            const modal =
                document.getElementById(
                    'detailsModal'
                );

            const frame =
                document.getElementById(
                    'detailsFrame'
                );

            const loading =
                document.getElementById(
                    'detailsLoading'
                );


            /*
             * Hide modal
             */

            modal.classList.remove(
                'show'
            );


            /*
             * Allow background scrolling
             */

            document.body.style.overflow =
                '';


            /*
             * Stop the page inside
             * the floating window.
             */

            frame.src =
                'about:blank';


            loading.style.display =
                'flex';

        }



        /*
         * Close when clicking the dark
         * background.
         */

        function closeDetailsFromBackground(
            event
        ) {

            if (
                event.target.id ===
                'detailsModal'
            ) {

                closeDetailsModal();

            }

        }



        /*
         * Close with ESC key.
         */

        document.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Escape'
                ) {

                    closeDetailsModal();

                }

            }
        );

    </script>


</body>

</html>
