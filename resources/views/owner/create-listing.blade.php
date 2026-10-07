<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add New Listing | AccomFinder</title>

    <!-- BOOTSTRAP ICONS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >

    <!-- LEAFLET -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        crossorigin=""
    >

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
            overflow: hidden;
        }

        body {
            background: #f5f8fc;
            font-family: Arial, sans-serif;
            color: #132238;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 264px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #dce3eb;
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
            left: 0;
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
            position: fixed;
            left: 264px;
            top: 0;
            right: 0;
            bottom: 0;
            width: auto;
            height: 100vh;
            overflow: hidden;
        }

        .topbar {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            height: 74px;
            background: #ffffff;
            border-bottom: 1px solid #dce3eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
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
            position: absolute;
            left: 0;
            top: 74px;
            right: 0;
            bottom: 0;
            height: auto;
            margin: 0;
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 14px;
            color: #0d6efd;
            font-size: 15px;
            text-decoration: none;
        }

        .back-link:hover {
            color: #0b5ed7;
            text-decoration: underline;
        }

        /* =====================================================
           FORM CARD
        ===================================================== */

        .form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            margin-top: 30px;
            padding: 30px;
            width: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .form-title {
            margin: 0 0 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e1e6ec;
            font-size: 25px;
            font-weight: 600;
            color: #17395f;
        }

        .form-title i {
            color: #14945f;
            margin-right: 8px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row.four {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .field {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #203b62;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dce3eb;
            border-radius: 8px;
            font-size: 14px;
            color: #30435c;
            background: #ffffff;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #14945f;
            box-shadow: 0 0 0 3px rgba(20, 148, 95, 0.10);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5;
        }

        /* =====================================================
           ADDRESS
        ===================================================== */

        .address-status {
            display: none;
            margin-top: 8px;
            font-size: 13px;
            line-height: 1.4;
        }

        .complete-address {
            margin-top: 0;
        }

        .complete-address input {
            background: #f5f8fc;
            color: #53657b;
            cursor: not-allowed;
        }

        /* =====================================================
           AMENITIES
        ===================================================== */

        .amenities-section {
            margin-top: 25px;
            padding-top: 22px;
            border-top: 1px solid #e1e6ec;
        }

        .amenities-title {
            font-size: 16px;
            font-weight: 600;
            color: #17395f;
            margin-bottom: 14px;
        }

        .amenities-title i {
            color: #14945f;
            margin-right: 7px;
        }

        .amenity-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .amenity {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #53657b;
            font-size: 13px;
            cursor: pointer;
            transition: 0.2s;
        }

        .amenity:hover {
            background: #f5faf8;
            border-color: #bfe8d7;
        }

        .amenity input {
            width: auto;
            margin: 0;
            accent-color: #14945f;
        }

        /* =====================================================
           MAP
        ===================================================== */

        .map-section {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #e1e6ec;
        }

        .map-title {
            font-size: 18px;
            font-weight: 600;
            color: #17395f;
            margin-bottom: 5px;
        }

        .map-title i {
            color: #14945f;
            margin-right: 7px;
        }

        .map-help {
            margin: 0 0 14px;
            color: #66778c;
            font-size: 14px;
            line-height: 1.6;
        }

        #map {
            width: 100%;
            height: 450px;
            border: 1px solid #dce3eb;
            border-radius: 10px;
            overflow: hidden;
            background: #e5e5e5;
        }

        #map .leaflet-tile,
        #map .leaflet-marker-icon,
        #map .leaflet-marker-shadow {
            max-width: none !important;
            max-height: none !important;
        }

        #map img {
            max-width: none !important;
        }

        /* =====================================================
           NEARBY LANDMARKS
        ===================================================== */

        .landmarks-section {
            margin-top: 22px;
            padding: 20px;
            background: #f8fbfd;
            border: 1px solid #e1e8ef;
            border-radius: 12px;
        }

        .landmarks-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .landmarks-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #17395f;
        }

        .landmarks-title i {
            color: #14945f;
            margin-right: 7px;
        }

        .landmarks-help {
            margin: 0 0 15px;
            color: #66778c;
            font-size: 13px;
        }

        .landmark-loading {
            display: none;
            padding: 13px;
            color: #66778c;
            background: #ffffff;
            border: 1px solid #e1e8ef;
            border-radius: 8px;
            font-size: 13px;
        }

        .landmark-message {
            padding: 13px;
            color: #66778c;
            background: #ffffff;
            border: 1px solid #e1e8ef;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.5;
        }

        .landmark-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .landmark-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            transition: 0.2s;
        }

        .landmark-item:hover {
            border-color: #bfe8d7;
            box-shadow: 0 2px 7px rgba(0, 0, 0, 0.04);
        }

        .landmark-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #cdf8e6;
            color: #078e62;
            font-size: 18px;
        }

        .landmark-info {
            min-width: 0;
            flex: 1;
        }

        .landmark-name {
            font-size: 14px;
            font-weight: 600;
            color: #203b62;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .landmark-type {
            margin-top: 3px;
            color: #718096;
            font-size: 12px;
        }

        .landmark-distance {
            margin-top: 4px;
            color: #14945f;
            font-size: 12px;
            font-weight: 600;
        }

        /* =====================================================
           COORDINATES
        ===================================================== */

        .coordinates {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-top: 18px;
        }

        .coordinate-input {
            background: #f5f8fc;
            cursor: not-allowed;
        }

        /* =====================================================
           AVAILABLE
        ===================================================== */

        .available {
            margin-top: 20px;
            padding: 14px 15px;
            background: #f5faf8;
            border: 1px solid #dcefe7;
            border-radius: 9px;
        }

        .available label {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
            font-size: 14px;
            color: #30435c;
            cursor: pointer;
        }

        .available input {
            width: auto;
            margin: 0;
            accent-color: #14945f;
        }

        /* =====================================================
           BUTTONS
        ===================================================== */

        .buttons {
            display: flex;
            align-items: center;
            gap: 10px;
            border-top: 1px solid #e1e6ec;
            margin-top: 25px;
            padding-top: 22px;
        }

        .create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: #14945f;
            color: #ffffff;
            border: none;
            padding: 12px 22px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: 0.2s;
        }

        .create-btn:hover {
            background: #0d7e50;
        }

        .cancel-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 21px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            color: #53657b;
            background: #ffffff;
            text-decoration: none;
            font-size: 15px;
            transition: 0.2s;
        }

        .cancel-btn:hover {
            background: #f1f5f9;
            color: #30435c;
        }

        /* =====================================================
           ERROR
        ===================================================== */

        .error {
            color: #c73535;
            font-size: 13px;
            margin-bottom: 20px;
            background: #fff2f2;
            border: 1px solid #ffd1d1;
            padding: 13px 15px;
            border-radius: 9px;
            line-height: 1.6;
        }

        .map-warning {
            display: none;
            color: #c73535;
            font-size: 13px;
            margin-top: 9px;
            background: #fff2f2;
            border: 1px solid #ffd1d1;
            padding: 9px 12px;
            border-radius: 7px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .form-row.four {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .amenity-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .landmark-list {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 850px) {

            .sidebar {
                width: 220px;
            }

            .content {
                left: 220px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-row.four {
                grid-template-columns: 1fr;
            }

            .coordinates {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 600px) {

            .sidebar {
                display: none;
            }

            .content {
                left: 0;
            }

            .main {
                padding: 30px 18px 40px;
            }

            .page-header h1 {
                font-size: 30px;
            }

            .page-header p {
                font-size: 15px;
            }

            .form-card {
                padding: 20px;
            }

            .amenity-grid {
                grid-template-columns: 1fr;
            }

            #map {
                height: 350px;
            }

            .landmarks-section {
                padding: 15px;
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


        <a
            href="{{ route('owner.listings') }}"
            class="active"
        >

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

</div>


<!-- =========================================================
     CONTENT
========================================================= -->

<div class="content">


    <div class="topbar">

        <i class="bi bi-bell bell"></i>

        <div class="owner-name">
            {{ session('owner_name', 'Owner') }}
        </div>

    </div>


    <div class="main">


        <!-- PAGE HEADER -->

        <div class="page-header">

            <div>

                <a
                    href="{{ route('owner.listings') }}"
                    class="back-link"
                >

                    <i class="bi bi-arrow-left"></i>

                    Back to Listings

                </a>


                <h1>
                    Add New Listing
                </h1>


                <p>
                    Create a new accommodation listing
                </p>

            </div>

        </div>


        <!-- FORM CARD -->

        <div class="form-card">


            @if ($errors->any())

                <div class="error">

                    <strong>
                        Please fix the following:
                    </strong>

                    <br>

                    @foreach ($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <h4 class="form-title">

                <i class="bi bi-building-add"></i>

                Property Information

            </h4>


            <form
                action="{{ route('owner.listings.store') }}"
                method="POST"
                id="listingForm"
            >

                @csrf


                <!-- =================================================
                     PROPERTY TITLE + ADDRESS 1
                ================================================== -->

                <div class="form-row">

                    <div class="field">

                        <label>
                            Property Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Enter property name"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            Address 1
                        </label>

                        <input
                            type="text"
                            id="address1"
                            value="{{ old('address1') }}"
                            placeholder=""
                            autocomplete="street-address"
                            required
                        >

                    </div>

                </div>


                <!-- =================================================
                     ADDRESS 2 + COMPLETE ADDRESS
                ================================================== -->

                <div class="form-row">

                    <div class="field">

                        <label>
                            Address 2
                        </label>

                        <input
                            type="text"
                            id="address2"
                            value="{{ old('address2') }}"
                            placeholder=""
                            autocomplete="address-level2"
                            required
                        >

                        <div
                            id="addressStatus"
                            class="address-status"
                        ></div>

                    </div>


                    <div class="field complete-address">

                        <label>
                            Complete Address
                        </label>

                        <input
                            type="text"
                            id="locationDisplay"
                            value="{{ old('location') }}"
                            placeholder="Address 1 + Address 2"
                            readonly
                        >

                        <input
                            type="hidden"
                            name="location"
                            id="location"
                            value="{{ old('location') }}"
                        >

                    </div>

                </div>


                <!-- =================================================
                     PRICE + TYPE
                ================================================== -->

                <div class="form-row">

                    <div class="field">

                        <label>
                            Monthly Rent (₱)
                        </label>

                        <input
                            type="number"
                            name="price"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                            placeholder=""
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            Property Type
                        </label>

                        <select
                            name="type"
                            required
                        >

                            <option value="">
                                Select Property Type
                            </option>

                            <option
                                value="Studio"
                                {{ old('type') == 'Studio' ? 'selected' : '' }}
                            >
                                Studio
                            </option>

                            <option
                                value="Apartment"
                                {{ old('type') == 'Apartment' ? 'selected' : '' }}
                            >
                                Apartment
                            </option>

                            <option
                                value="Boarding House"
                                {{ old('type') == 'Boarding House' ? 'selected' : '' }}
                            >
                                Boarding House
                            </option>

                            <option
                                value="Dormitory"
                                {{ old('type') == 'Dormitory' ? 'selected' : '' }}
                            >
                                Dormitory
                            </option>

                            <option
                                value="Room"
                                {{ old('type') == 'Room' ? 'selected' : '' }}
                            >
                                Room
                            </option>

                        </select>

                    </div>

                </div>


                <!-- =================================================
                     ROOMS + CR + CAPACITY
                ================================================== -->

                <div class="form-row four">

                    <div class="field">

                        <label>
                            Rooms
                        </label>

                        <input
                            type="number"
                            name="bedrooms"
                            value="{{ old('bedrooms', 1) }}"
                            min="0"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            CR
                        </label>

                        <input
                            type="number"
                            name="bathrooms"
                            value="{{ old('bathrooms', 1) }}"
                            min="0"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            Capacity
                        </label>

                        <input
                            type="number"
                            name="capacity"
                            value="{{ old('capacity', 1) }}"
                            min="1"
                            placeholder=""
                            required
                        >

                    </div>

                </div>


                <!-- DESCRIPTION -->

                <div class="field">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        placeholder="Describe your property..."
                    >{{ old('description') }}</textarea>

                </div>

                <div class="amenities-section">
                    <div class="amenities-title">
                        <i class="bi bi-stars"></i>
                        Amenities
                    </div>


                    <div class="amenity-grid">
                        <label class="amenity">

                            <input
                                type="checkbox"
                                name="amenities[]"
                                value="WiFi"
                                {{ in_array('WiFi', old('amenities', [])) ? 'checked' : '' }}
                            >

                            WiFi

                        </label>

                        <label class="amenity">
                            <input
                                type="checkbox"
                                name="amenities[]"
                                value="Parking"
                                {{ in_array('Parking', old('amenities', [])) ? 'checked' : '' }}
                            >
                            Parking
                        </label>


                        <label class="amenity">

                            <input
                                type="checkbox"
                                name="amenities[]"
                                value="Furnished"
                                {{ in_array('Furnished', old('amenities', [])) ? 'checked' : '' }}
                            >

                            Furnished

                        </label>


                        <label class="amenity">

                            <input
                                type="checkbox"
                                name="amenities[]"
                                value="24/7 Security"
                                {{ in_array('24/7 Security', old('amenities', [])) ? 'checked' : '' }}
                            >

                            24/7 Security

                        </label>


                        <label class="amenity">

                            <input
                                type="checkbox"
                                name="amenities[]"
                                value="Shared Kitchen"
                                {{ in_array('Shared Kitchen', old('amenities', [])) ? 'checked' : '' }}
                            >

                            Shared Kitchen

                        </label>

                    </div>

                </div>


                <!-- =================================================
                     MAP
                ================================================== -->

                <div class="map-section">

                    <div class="map-title">

                        <i class="bi bi-geo-alt-fill"></i>

                        Property Location on Map

                    </div>


                    <p class="map-help">

                        Enter Address 1 and Address 2. The system will
                        automatically place the property pin on the map.
                        You can also click or drag the property pin to
                        adjust the exact location.

                        Nearby landmarks will appear below the map.

                    </p>

                    <div id="map"></div>
                    <div class="landmarks-section">

                        <div class="landmarks-header">
                            <h3 class="landmarks-title">
                                <i class="bi bi-pin-map-fill"></i>
                                Nearby Landmarks
                            </h3>
                        </div>

                        <p class="landmarks-help">
                            Nearby schools, hospitals, banks, stores,
                            restaurants, transport stops and other
                            places around the property.
                        </p>

                        <div
                            id="landmarkLoading"
                            class="landmark-loading"
                        >
                            <i class="bi bi-arrow-repeat"></i>
                            Searching for nearby landmarks...
                        </div>

                        <div
                            id="landmarkMessage"
                            class="landmark-message"
                        >
                            Pin the property on the map to see
                            nearby landmarks.
                        </div>


                        <div
                            id="landmarkList"
                            class="landmark-list"
                        ></div>
                    </div>

                    <div class="coordinates">
                        <div class="field">
                            <label>
                                Latitude
                            </label>

                            <input
                                type="text"
                                name="latitude"
                                id="latitude"
                                class="coordinate-input"
                                value="{{ old('latitude') }}"
                                readonly
                                required
                            >

                        </div>

                        <div class="field">

                            <label>
                                Longitude
                            </label>

                            <input
                                type="text"
                                name="longitude"
                                id="longitude"
                                class="coordinate-input"
                                value="{{ old('longitude') }}"
                                readonly
                                required
                            >

                        </div>

                    </div>


                    <div
                        id="mapWarning"
                        class="map-warning"
                    >

                        Please enter a complete address or select
                        a location on the map before creating the listing.

                    </div>

                </div>


                <!-- AVAILABLE -->

                <div class="available">

                    <label>

                        <input
                            type="checkbox"
                            name="available"
                            value="1"
                            {{ old('available', '1') ? 'checked' : '' }}
                        >

                        Mark this listing as available

                    </label>

                </div>


                <!-- BUTTONS -->

                <div class="buttons">

                    <button
                        type="submit"
                        class="create-btn"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Create Listing

                    </button>


                    <a
                        href="{{ route('owner.listings') }}"
                        class="cancel-btn"
                    >

                        <i class="bi bi-x-circle"></i>

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin=""
></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const defaultLatitude = 6.1164;
    const defaultLongitude = 125.1716;

    const address1Input =
        document.getElementById('address1');

    const address2Input =
        document.getElementById('address2');

    const locationInput =
        document.getElementById('location');

    const locationDisplay =
        document.getElementById('locationDisplay');

    const latitudeInput =
        document.getElementById('latitude');

    const longitudeInput =
        document.getElementById('longitude');

    const mapElement =
        document.getElementById('map');

    const mapWarning =
        document.getElementById('mapWarning');

    const addressStatus =
        document.getElementById('addressStatus');

    const landmarkLoading =
        document.getElementById('landmarkLoading');

    const landmarkMessage =
        document.getElementById('landmarkMessage');

    const landmarkList =
        document.getElementById('landmarkList');

    const map = L.map(mapElement, {

        center: [
            defaultLatitude,
            defaultLongitude
        ],

        zoom: 15,

        zoomControl: true,

        scrollWheelZoom: true

    });

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            minZoom: 3,
            attribution:
                '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);

    let marker = null;

    function getCompleteAddress() {

        const address1 =
            address1Input.value.trim();

        const address2 =
            address2Input.value.trim();


        if (!address1 && !address2) {
            return '';
        }

        if (!address1) {
            return address2;
        }

        if (!address2) {
            return address1;
        }

        return address1 + ', ' + address2;

    }


    function updateLocationInput() {

        const completeAddress =
            getCompleteAddress();

        locationInput.value =
            completeAddress;

        locationDisplay.value =
            completeAddress;

    }


    /* =====================================================
       REMOVE LOT / BLOCK BEFORE GEOCODING
    ===================================================== */

    function cleanStreetName(address) {

        return address

            .replace(
                /\bLot\s+[A-Za-z0-9-]+[,]?\s*/gi,
                ''
            )

            .replace(
                /\bBlock\s+[A-Za-z0-9-]+[,]?\s*/gi,
                ''
            )

            .replace(
                /\s*,\s*,/g,
                ','
            )

            .replace(
                /^\s*,\s*/,
                ''
            )

            .trim();

    }


    /* =====================================================
       ADDRESS STATUS
    ===================================================== */

    function showAddressStatus(
        message,
        color
    ) {

        addressStatus.style.display =
            'block';

        addressStatus.style.color =
            color;

        addressStatus.innerHTML =
            message;

    }

    function clearLandmarks() {

        landmarkList.innerHTML = '';

    }

    function getLandmarkIcon(tags) {

        const amenity =
            tags.amenity || '';

        const shop =
            tags.shop || '';

        const tourism =
            tags.tourism || '';

        const leisure =
            tags.leisure || '';

        const highway =
            tags.highway || '';

        if (
            amenity === 'school' ||
            tags.education
        ) {
            return 'bi-mortarboard-fill';
        }

        if (
            amenity === 'hospital' ||
            amenity === 'clinic' ||
            tags.healthcare
        ) {
            return 'bi-hospital-fill';
        }

        if (
            amenity === 'bank' ||
            amenity === 'atm'
        ) {
            return 'bi-bank2';
        }

        if (
            amenity === 'restaurant' ||
            amenity === 'cafe' ||
            amenity === 'fast_food'
        ) {
            return 'bi-cup-hot-fill';
        }

        if (
            amenity === 'place_of_worship'
        ) {
            return 'bi-building-fill';
        }

        if (
            highway === 'bus_stop' ||
            tags.public_transport
        ) {
            return 'bi-bus-front-fill';
        }

        if (shop) {
            return 'bi-shop';
        }

        if (
            tourism === 'hotel' ||
            tourism === 'guest_house'
        ) {
            return 'bi-buildings-fill';
        }

        if (
            leisure === 'park' ||
            leisure === 'playground'
        ) {
            return 'bi-tree-fill';
        }

        return 'bi-geo-alt-fill';

    }

    function getLandmarkType(tags) {

        const amenity =
            tags.amenity || '';

        const shop =
            tags.shop || '';

        const tourism =
            tags.tourism || '';

        const leisure =
            tags.leisure || '';

        const highway =
            tags.highway || '';


        if (amenity === 'school') {
            return 'School';
        }

        if (
            amenity === 'hospital' ||
            amenity === 'clinic' ||
            tags.healthcare
        ) {
            return 'Health Facility';
        }

        if (
            amenity === 'bank' ||
            amenity === 'atm'
        ) {
            return 'Bank / ATM';
        }

        if (
            amenity === 'restaurant' ||
            amenity === 'cafe' ||
            amenity === 'fast_food'
        ) {
            return 'Food / Restaurant';
        }

        if (
            amenity === 'place_of_worship'
        ) {
            return 'Place of Worship';
        }

        if (
            highway === 'bus_stop' ||
            tags.public_transport
        ) {
            return 'Transport';
        }

        if (shop) {
            return 'Shop';
        }

        if (tourism) {
            return 'Tourism / Accommodation';
        }

        if (leisure) {
            return 'Leisure / Recreation';
        }

        return 'Nearby Place';

    }

    function calculateDistance(
        latitude1,
        longitude1,
        latitude2,
        longitude2
    ) {

        const earthRadius = 6371000;

        const lat1 =
            latitude1 * Math.PI / 180;

        const lat2 =
            latitude2 * Math.PI / 180;

        const differenceLatitude =
            (latitude2 - latitude1)
            * Math.PI / 180;

        const differenceLongitude =
            (longitude2 - longitude1)
            * Math.PI / 180;

        const a =

            Math.sin(
                differenceLatitude / 2
            ) ** 2

            +

            Math.cos(lat1) *
            Math.cos(lat2) *

            Math.sin(
                differenceLongitude / 2
            ) ** 2;

        const c =
            2 *
            Math.atan2(
                Math.sqrt(a),
                Math.sqrt(1 - a)
            );

        return earthRadius * c;

    }


    function formatDistance(
        distance
    ) {

        if (distance < 1000) {

            return Math.round(distance) + ' m';

        }

        return (
            distance / 1000
        ).toFixed(1) + ' km';

    }

    function getElementCoordinates(
        element
    ) {

        if (
            typeof element.lat === 'number' &&
            typeof element.lon === 'number'
        ) {

            return {
                latitude: element.lat,
                longitude: element.lon
            };

        }

        if (
            element.center &&
            typeof element.center.lat === 'number' &&
            typeof element.center.lon === 'number'
        ) {

            return {
                latitude: element.center.lat,
                longitude: element.center.lon
            };

        }

        return null;

    }

    function displayLandmarks(
        landmarks,
        propertyLatitude,
        propertyLongitude
    ) {

        clearLandmarks();


        if (
            !landmarks ||
            landmarks.length === 0
        ) {

            landmarkMessage.style.display =
                'block';

            landmarkMessage.innerHTML =

                '<i class="bi bi-info-circle"></i> ' +

                'No mapped landmarks were found ' +

                'within 1 kilometer of this property.';

            return;

        }


        landmarkMessage.style.display =
            'none';


        const preparedLandmarks = [];


        landmarks.forEach(
            function (element) {

                const coordinates =
                    getElementCoordinates(
                        element
                    );


                if (!coordinates) {
                    return;
                }


                const tags =
                    element.tags || {};


                const name =
                    tags.name ||
                    'Unnamed place';


                const distance =
                    calculateDistance(

                        propertyLatitude,

                        propertyLongitude,

                        coordinates.latitude,

                        coordinates.longitude

                    );


                preparedLandmarks.push({

                    tags: tags,

                    name: name,

                    distance: distance

                });

            }
        );

        const uniqueLandmarks = [];

        const seenNames = new Set();


        preparedLandmarks

            .sort(
                function (a, b) {

                    return (
                        a.distance -
                        b.distance
                    );

                }
            )

            .forEach(
                function (item) {

                    const key =
                        item.name
                            .toLowerCase()
                            .trim();


                    if (
                        key === 'unnamed place'
                    ) {
                        return;
                    }


                    if (
                        seenNames.has(key)
                    ) {
                        return;
                    }


                    seenNames.add(key);

                    uniqueLandmarks.push(
                        item
                    );

                }
            );

        const finalLandmarks =
            uniqueLandmarks.slice(
                0,
                20
            );

        finalLandmarks.forEach(
            function (landmark) {

                const iconClass =
                    getLandmarkIcon(
                        landmark.tags
                    );


                const type =
                    getLandmarkType(
                        landmark.tags
                    );


                const item =
                    document.createElement(
                        'div'
                    );


                item.className =
                    'landmark-item';


                item.innerHTML =

                    '<div class="landmark-icon">' +

                        '<i class="bi ' +
                        iconClass +
                        '"></i>' +

                    '</div>' +

                    '<div class="landmark-info">' +

                        '<div class="landmark-name">' +

                            escapeHtml(
                                landmark.name
                            ) +

                        '</div>' +

                        '<div class="landmark-type">' +

                            escapeHtml(
                                type
                            ) +

                        '</div>' +

                        '<div class="landmark-distance">' +

                            '<i class="bi bi-signpost-2"></i> ' +

                            formatDistance(
                                landmark.distance
                            ) +

                        '</div>' +

                    '</div>';


                landmarkList.appendChild(
                    item
                );

            }
        );


        if (
            finalLandmarks.length === 0
        ) {

            landmarkMessage.style.display =
                'block';

            landmarkMessage.innerHTML =

                '<i class="bi bi-info-circle"></i> ' +

                'No named landmarks were found ' +

                'near this property.';

        }

    }

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent =
            text;

        return div.innerHTML;

    }

    async function searchNearbyLandmarks(
        latitude,
        longitude
    ) {

        landmarkLoading.style.display =
            'block';

        landmarkMessage.style.display =
            'none';

        landmarkList.innerHTML =
            '';

        const query = `
            [out:json][timeout:25];

            (
                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["amenity"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["shop"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["tourism"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["leisure"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["highway"="bus_stop"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["public_transport"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["healthcare"];

                nwr(
                    around:1000,
                    ${latitude},
                    ${longitude}
                )["name"]["education"];

            );

            out center tags;

        `;


        try {

            const response =
                await fetch(

                    'https://overpass-api.de/api/interpreter',

                    {

                        method: 'POST',

                        headers: {

                            'Content-Type':
                                'application/x-www-form-urlencoded; charset=UTF-8'

                        },

                        body:
                            'data=' +
                            encodeURIComponent(
                                query
                            )

                    }

                );


            if (!response.ok) {

                throw new Error(
                    'Nearby landmark request failed.'
                );

            }


            const data =
                await response.json();


            displayLandmarks(

                data.elements || [],

                latitude,

                longitude

            );


        } catch (error) {

            console.error(
                'Nearby landmarks error:',
                error
            );


            landmarkMessage.style.display =
                'block';


            landmarkMessage.innerHTML =

                '<i class="bi bi-exclamation-circle"></i> ' +

                'Nearby landmarks could not be loaded. ' +

                'You can still create the listing ' +

                'using the property pin.';

        }


        landmarkLoading.style.display =
            'none';

    }

    function setMarker(
        latitude,
        longitude,
        popupText = ''
    ) {

        latitude =
            parseFloat(latitude);

        longitude =
            parseFloat(longitude);


        if (
            isNaN(latitude) ||
            isNaN(longitude)
        ) {
            return;
        }

        latitudeInput.value =
            latitude.toFixed(7);

        longitudeInput.value =
            longitude.toFixed(7);

        if (
            marker !== null
        ) {

            map.removeLayer(
                marker
            );

        }

        marker = L.marker(

            [
                latitude,
                longitude
            ],

            {
                draggable: true
            }

        ).addTo(map);

        marker.bindPopup(

            popupText ||

            '<strong>Property Location</strong><br>' +
            'Latitude: ' +

            latitude.toFixed(7) +

            '<br>' +

            'Longitude: ' +

            longitude.toFixed(7)

        );
        map.setView(
            [
                latitude,
                longitude
            ],

            17

        );
        mapWarning.style.display =
            'none';

        searchNearbyLandmarks(
            latitude,
            longitude
        );

        marker.on(

            'dragend',

            function (event) {

                const position =
                    event.target.getLatLng();


                latitudeInput.value =
                    position.lat.toFixed(7);

                longitudeInput.value =
                    position.lng.toFixed(7);


                mapWarning.style.display =
                    'none';


                marker.bindPopup(

                    '<strong>Property Location</strong><br>' +

                    'Latitude: ' +

                    position.lat.toFixed(7) +

                    '<br>' +

                    'Longitude: ' +

                    position.lng.toFixed(7)

                );


                marker.openPopup();

                searchNearbyLandmarks(

                    position.lat,

                    position.lng

                );

            }

        );

    }

    function createSearchQueries() {

        const address1 =
            address1Input.value.trim();

        const address2 =
            address2Input.value.trim();


        const cleanAddress1 =
            cleanStreetName(
                address1
            );


        const queries = [];


        if (
            cleanAddress1 &&
            address2
        ) {

            queries.push(

                cleanAddress1 +
                ', ' +
                address2

            );

        }


        if (
            cleanAddress1
        ) {

            queries.push(

                cleanAddress1 +
                ', General Santos City, Philippines'

            );

        }


        if (
            address2
        ) {

            queries.push(
                address2
            );

        }


        const completeAddress =
            getCompleteAddress();


        if (
            completeAddress
        ) {

            queries.push(
                completeAddress
            );

        }


        return [
            ...new Set(queries)
        ];

    }

    function isGeneralSantosResult(
        result
    ) {

        const text = (

            result.display_name ||
            ''

        ).toLowerCase();


        return (

            text.includes(
                'general santos'
            )

            ||

            text.includes(
                'gensan'
            )

            ||

            text.includes(
                'lagao'
            )

        );

    }

    async function findAddress() {

        updateLocationInput();


        const completeAddress =
            getCompleteAddress();

        if (
            completeAddress.length < 5
        ) {
            return;
        }


        showAddressStatus(
            '<i class="bi bi-search"></i> ' +
            'Searching address...',
            '#66778c'

        );

        const queries =
            createSearchQueries();


        let bestResult =
            null;

        try {

            for (
                const query
                of queries
            ) {

                const url =

                    'https://nominatim.openstreetmap.org/search' +
                    '?format=jsonv2' +
                    '&addressdetails=1' +
                    '&limit=5' +
                    '&countrycodes=ph' +
                    '&q=' +

                    encodeURIComponent(
                        query
                    );


                const response =
                    await fetch(

                        url,

                        {
                            headers: {
                                'Accept':
                                    'application/json'
                            }
                        }

                    );


                if (
                    !response.ok
                ) {
                    continue;
                }

                const results =
                    await response.json();

                if (
                    !results ||
                    results.length === 0
                ) {
                    continue;
                }

                const localResult =
                    results.find(
                        function (result) {

                            return isGeneralSantosResult(
                                result
                            );
                        }
                    );


                bestResult =
                    localResult ||
                    results[0];


                if (
                    localResult
                ) {
                    break;
                }

            }


            if (
                !bestResult
            ) {

                showAddressStatus(
                    '<i class="bi bi-exclamation-circle"></i> ' +
                    'Address not found. Please enter a more complete address.',
                    '#c73535'

                );
                return;
            }

            const latitude =
                parseFloat(
                    bestResult.lat
                );

            const longitude =
                parseFloat(
                    bestResult.lon
                );


            if (
                isNaN(latitude) ||
                isNaN(longitude)
            ) {

                throw new Error(
                    'Invalid coordinates.'
                );

            }

            setMarker(

                latitude,

                longitude,

                '<strong>Property Location</strong><br>' +

                escapeHtml(
                    bestResult.display_name
                )

            );


            showAddressStatus(
                '<i class="bi bi-check-circle-fill"></i> ' +
                'Location found and pinned on the map. ' +
                'Nearby landmarks are shown below the map.',
                '#14945f'
            );


        } catch (error) {
            console.error(
                'Geocoding error:',
                error
            );


            showAddressStatus(
                '<i class="bi bi-exclamation-circle"></i> ' +
                'Unable to find the address. ' +
                'Please check the address and try again.',
                '#c73535'
            );
        }
    }

    function addressChanged() {
        updateLocationInput();
        clearTimeout(
            window.addressSearchTimer
        );


        window.addressSearchTimer =
            setTimeout(

                function () {

                    const address1 =
                        address1Input.value.trim();

                    const address2 =
                        address2Input.value.trim();
                    if (
                        address1 &&
                        address2
                    ) {

                        findAddress();
                    }
                },
                1000
            );
    }


    address1Input.addEventListener(
        'input',
        addressChanged
    );


    address2Input.addEventListener(
        'input',
        addressChanged
    );

    address1Input.addEventListener(
        'blur',
        function () {

            updateLocationInput();

            if (
                address1Input.value.trim() &&
                address2Input.value.trim()
            ) {

                findAddress();
            }
        }
    );


    address2Input.addEventListener(
        'blur',
        function () {

            updateLocationInput();

            if (
                address1Input.value.trim() &&
                address2Input.value.trim()
            ) {

                findAddress();

            }

        }
    );

    address1Input.addEventListener(
        'keydown',
        function (event) {
            if (
                event.key === 'Enter'
            ) {
                event.preventDefault();
                updateLocationInput();
                findAddress();

            }

        }
    );

    address2Input.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Enter'
            ) {
                event.preventDefault();
                updateLocationInput();
                findAddress();
            }
        }
    );

    map.on(
        'click',
        function (event) {

            const latitude =
                event.latlng.lat;

            const longitude =
                event.latlng.lng;


            setMarker(
                latitude,
                longitude
            );


            showAddressStatus(
                '<i class="bi bi-check-circle-fill"></i> ' +
                'Property location selected. ' +
                'Nearby landmarks are shown below the map.',
                '#14945f'
            );
        }
    );

    const oldLatitude =
        parseFloat(
            latitudeInput.value
        );

    const oldLongitude =
        parseFloat(
            longitudeInput.value
        );


    if (

        !isNaN(oldLatitude) &&
        !isNaN(oldLongitude) &&
        oldLatitude >= -90 &&
        oldLatitude <= 90 &&
        oldLongitude >= -180 &&
        oldLongitude <= 180

    ) {

        setMarker(
            oldLatitude,
            oldLongitude,
            '<strong>Property Location</strong><br>' +
            'Existing saved location'
        );
    }

    function fixMapSize() {
        map.invalidateSize(true);
    }

    setTimeout(
        fixMapSize,
        100
    );

    setTimeout(
        fixMapSize,
        500
    );

    setTimeout(
        fixMapSize,
        1000
    );

    window.addEventListener(
        'resize',
        fixMapSize
    );

    document
        .getElementById('listingForm')
        .addEventListener(
            'submit',
            function (event) {

                updateLocationInput();

                const location =
                    locationInput.value.trim();

                const latitude =
                    latitudeInput.value;

                const longitude =
                    longitudeInput.value;


                if (!location) {

                    event.preventDefault();


                    alert(
                        'Please enter Address 1 and Address 2 first.'
                    );


                    address1Input.focus();


                    return false;

                }


                if (
                    !latitude ||
                    !longitude
                ) {

                    event.preventDefault();


                    mapWarning.style.display =
                        'block';


                    alert(

                        'Please enter a complete address ' +

                        'or select the exact property location ' +

                        'on the map first.'

                    );


                    mapElement.scrollIntoView({

                        behavior: 'smooth',

                        block: 'center'

                    });


                    return false;

                }


                mapWarning.style.display =
                    'none';


                return true;

            }
        );

    updateLocationInput();
});

</script>


</body>
</html>
