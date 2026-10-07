<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Listing | AccomFinder</title>


    <!-- =====================================================
         BOOTSTRAP
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <!-- =====================================================
         LEAFLET MAP
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIINfQ3m9Z9YvYv5Z5x4H7c0W7ZKj4N1J8="
        crossorigin=""
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
           SIDEBAR MENU
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
           SCROLLABLE MAIN
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
           FORM CARD
        ===================================================== */

        .form-card {

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            margin-top: 30px;

            padding: 30px;

            width: 100%;

            max-width: 100%;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.04);
        }


        /* =====================================================
           FORM TITLE
        ===================================================== */

        .form-title {

            margin: 0;

            font-size: 25px;

            font-weight: 600;

            color: #17395f;

            padding-bottom: 20px;

            border-bottom: 1px solid #e1e6ec;

            margin-bottom: 25px;
        }


        .form-title i {

            color: #14945f;

            margin-right: 8px;
        }


        /* =====================================================
           FORM LABEL
        ===================================================== */

        .form-label {

            font-weight: 600;

            color: #203b62;

            margin-bottom: 8px;
        }


        /* =====================================================
           FORM CONTROLS
        ===================================================== */

        .form-control,
        .form-select {

            padding: 12px;

            border-radius: 8px;

            border: 1px solid #dce3eb;

            color: #30435c;
        }


        .form-control:focus,
        .form-select:focus {

            border-color: #14945f;

            box-shadow:
                0 0 0 0.15rem
                rgba(20, 148, 95, 0.12);
        }


        /* =====================================================
           LOCATION SEARCH AREA
        ===================================================== */

        .location-row {

            display: flex;

            gap: 10px;

            align-items: stretch;
        }


        .location-row .form-control {

            flex: 1;
        }


        .find-location-btn {

            min-width: 150px;

            border: none;

            border-radius: 8px;

            background: #14945f;

            color: #ffffff;

            font-weight: 600;

            padding: 12px 18px;

            cursor: pointer;

            transition: 0.2s;
        }


        .find-location-btn:hover {

            background: #0d7e50;
        }


        .find-location-btn:disabled {

            background: #94a3b8;

            cursor: not-allowed;
        }


        /* =====================================================
           LOCATION STATUS
        ====================================================== */

        .location-status {

            margin-top: 8px;

            font-size: 13px;

            color: #64748b;

            min-height: 20px;
        }


        .location-status.success {

            color: #078e62;

            font-weight: 600;
        }


        .location-status.error {

            color: #dc3545;

            font-weight: 600;
        }


        .location-status.loading {

            color: #2563eb;

            font-weight: 600;
        }


        /* =====================================================
           MAP CARD
        ===================================================== */

        .map-container {

            width: 100%;

            height: 400px;

            border: 1px solid #dce3eb;

            border-radius: 12px;

            overflow: hidden;

            background: #eef3f8;

            margin-top: 12px;

            position: relative;
        }


        #editMap {

            width: 100%;

            height: 100%;
        }


        /* =====================================================
           MAP HELP
        ===================================================== */

        .map-help {

            margin-top: 9px;

            padding: 10px 12px;

            background: #f0fdf4;

            border: 1px solid #bbf7d0;

            border-radius: 8px;

            color: #166534;

            font-size: 13px;
        }


        .map-help i {

            margin-right: 5px;
        }


        /* =====================================================
           COORDINATE ROW
        ===================================================== */

        .coordinates-row {

            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 20px;

            margin-top: 18px;
        }


        .coordinate-value {

            background: #f8fafc;

            font-size: 14px;
        }


        /* =====================================================
           UPDATE BUTTON
        ===================================================== */

        .update-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            background: #14945f;

            color: #ffffff;

            border: none;

            padding: 12px 22px;

            border-radius: 9px;

            font-size: 15px;

            font-weight: 500;

            cursor: pointer;

            transition: 0.2s;
        }


        .update-btn:hover {

            background: #0d7e50;

            color: #ffffff;
        }


        .update-btn:disabled {

            background: #94a3b8;

            cursor: not-allowed;
        }


        /* =====================================================
           CANCEL BUTTON
        ===================================================== */

        .cancel-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            background: #6c757d;

            color: #ffffff;

            padding: 12px 22px;

            border-radius: 9px;

            text-decoration: none;

            margin-left: 8px;

            font-size: 15px;

            transition: 0.2s;
        }


        .cancel-btn:hover {

            background: #5c636a;

            color: #ffffff;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

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

                width: calc(100% - 220px);
            }


            .form-card {

                padding: 22px;
            }


            .location-row {

                flex-direction: column;
            }


            .find-location-btn {

                min-height: 46px;
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


            .coordinates-row {

                grid-template-columns: 1fr;

                gap: 12px;
            }


            .map-container {

                height: 350px;
            }


            .cancel-btn {

                margin-left: 5px;
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
                <i class="bi bi-box-arrow-left"></i>
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
         TOPBAR
    ====================================================== -->

    <div class="topbar">

        <i class="bi bi-bell bell"></i>

        <span class="owner-name">

            {{ session('owner_name', 'Owner') }}

        </span>

    </div>



    <!-- =====================================================
         MAIN
    ====================================================== -->

    <div class="main">


        <!-- =================================================
             PAGE HEADER
        ================================================== -->

        <div class="page-header">

            <div>

                <h1>
                    Edit Listing
                </h1>

                <p>
                    Update your property information
                </p>

            </div>

        </div>



        <!-- =================================================
             SUCCESS MESSAGE
        ================================================== -->

        @if(session('success'))

            <div class="alert alert-success mt-3">

                {{ session('success') }}

            </div>

        @endif



        <!-- =================================================
             ERROR MESSAGE
        ================================================== -->

        @if(session('error'))

            <div class="alert alert-danger mt-3">

                {{ session('error') }}

            </div>

        @endif



        <!-- =================================================
             VALIDATION ERRORS
        ================================================== -->

        @if($errors->any())

            <div class="alert alert-danger mt-3">

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
             FORM CARD
        ================================================== -->

        <div class="form-card">


            <h4 class="form-title">

                <i class="bi bi-pencil-square"></i>

                Property Information

            </h4>



            <form
                id="editListingForm"
                action="{{ route('owner.listings.update', $listing->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')



                <!-- =================================================
                     PROPERTY NAME
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Property Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $listing->name) }}"
                        required
                    >

                </div>



                <!-- =================================================
                     ADDRESS 1
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Address 1
                    </label>

                    <input
                        type="text"
                        id="address1"
                        class="form-control"
                        value="{{ old('address1', $listing->address) }}"
                        placeholder="House/Building No., Street, Barangay"
                        autocomplete="off"
                        required
                    >

                </div>



                <!-- =================================================
                     ADDRESS 2
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Address 2
                    </label>

                    <input
                        type="text"
                        id="address2"
                        class="form-control"
                        value="{{ old('address2') }}"
                        placeholder="City, Province"
                        autocomplete="off"
                    >

                </div>



                <!-- =================================================
                     COMBINED ADDRESS
                ================================================== -->

                <input
                    type="hidden"
                    name="address"
                    id="address"
                    value="{{ old('address', $listing->address) }}"
                >



                <!-- =================================================
                     FIND LOCATION
                ================================================== -->

                <div class="location-row">

                    <button
                        type="button"
                        id="findLocationBtn"
                        class="find-location-btn"
                    >

                        <i class="bi bi-geo-alt"></i>

                        Find Location

                    </button>

                </div>


                <div
                    id="locationStatus"
                    class="location-status"
                ></div>



                <!-- =================================================
                     MAP
                ================================================== -->

                <div class="mb-4">

                    <label class="form-label">

                        Property Location on Map

                    </label>


                    <div class="map-container">

                        <div id="editMap"></div>

                    </div>


                    <div class="map-help">

                        <i class="bi bi-info-circle"></i>

                        Change Address 1 or Address 2 to automatically
                        update the location. You can also click the map
                        or drag the marker to manually change the property
                        location.

                    </div>

                </div>



                <!-- =================================================
                     PROPERTY TYPE
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Property Type
                    </label>

                    <select
                        name="type"
                        class="form-select"
                        required
                    >

                        <option
                            value="Boarding House"
                            {{ old('type', $listing->type) == 'Boarding House' ? 'selected' : '' }}
                        >
                            Boarding House
                        </option>

                        <option
                            value="Apartment"
                            {{ old('type', $listing->type) == 'Apartment' ? 'selected' : '' }}
                        >
                            Apartment
                        </option>

                        <option
                            value="Dormitory"
                            {{ old('type', $listing->type) == 'Dormitory' ? 'selected' : '' }}
                        >
                            Dormitory
                        </option>

                        <option
                            value="Bedspace"
                            {{ old('type', $listing->type) == 'Bedspace' ? 'selected' : '' }}
                        >
                            Bedspace
                        </option>

                    </select>

                </div>



                <!-- =================================================
                     PRICE
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Monthly Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ old('price', $listing->price) }}"
                        min="0"
                        step="0.01"
                        required
                    >

                </div>



                <!-- =================================================
                     STATUS
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Availability Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required
                    >

                        <option
                            value="Available"
                            {{ old('status', $listing->status) == 'Available' ? 'selected' : '' }}
                        >
                            Available
                        </option>

                        <option
                            value="Full"
                            {{ old('status', $listing->status) == 'Full' ? 'selected' : '' }}
                        >
                            Full
                        </option>

                    </select>

                </div>



                <!-- =================================================
                     DESCRIPTION
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="5"
                        placeholder="Describe your property..."
                    >{{ old('description', $listing->description) }}</textarea>

                </div>



                <!-- =================================================
                     COORDINATES
                ================================================== -->

                <div class="coordinates-row">

                    <div>

                        <label class="form-label">
                            Latitude
                        </label>

                        <input
                            type="text"
                            name="latitude"
                            id="latitude"
                            class="form-control coordinate-value"
                            value="{{ old('latitude', $listing->latitude) }}"
                            readonly
                        >

                    </div>


                    <div>

                        <label class="form-label">
                            Longitude
                        </label>

                        <input
                            type="text"
                            name="longitude"
                            id="longitude"
                            class="form-control coordinate-value"
                            value="{{ old('longitude', $listing->longitude) }}"
                            readonly
                        >

                    </div>

                </div>



                <!-- =================================================
                     BUTTONS
                ================================================== -->

                <div class="mt-4">

                    <button
                        type="submit"
                        id="updateListingBtn"
                        class="update-btn"
                    >

                        <i class="bi bi-check-circle"></i>

                        Update Listing

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



<!-- =========================================================
     LEAFLET JAVASCRIPT
========================================================= -->

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""
></script>



<script>

    /*
     * =========================================================
     * EXISTING COORDINATES
     * =========================================================
     */

    let existingLatitude =
        parseFloat(
            @json(
                old(
                    'latitude',
                    $listing->latitude
                )
            )
        );


    let existingLongitude =
        parseFloat(
            @json(
                old(
                    'longitude',
                    $listing->longitude
                )
            )
        );


    /*
     * General Santos City fallback.
     */

    const defaultLatitude = 6.1164;

    const defaultLongitude = 125.1716;


    /*
     * Make sure coordinates are numbers.
     */

    if (
        !Number.isFinite(existingLatitude) ||
        !Number.isFinite(existingLongitude)
    ) {

        existingLatitude =
            defaultLatitude;

        existingLongitude =
            defaultLongitude;

    }



    /*
     * =========================================================
     * CREATE MAP
     * =========================================================
     */

    const editMap =
        L.map(
            'editMap'
        ).setView(
            [
                existingLatitude,
                existingLongitude
            ],
            16
        );



    /*
     * OpenStreetMap tiles.
     */

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {

            maxZoom: 19,

            attribution:
                '&copy; OpenStreetMap contributors'

        }
    ).addTo(
        editMap
    );



    /*
     * =========================================================
     * CREATE PROPERTY MARKER
     * =========================================================
     */

    let propertyMarker =
        L.marker(
            [
                existingLatitude,
                existingLongitude
            ],
            {
                draggable: true
            }
        ).addTo(
            editMap
        );



    /*
     * Marker popup.
     */

    propertyMarker.bindPopup(
        '<strong>Property Location</strong><br>' +
        'Drag this marker or change the address.'
    );



    /*
     * =========================================================
     * INPUT ELEMENTS
     * =========================================================
     */

    const address1Input =
        document.getElementById(
            'address1'
        );


    const address2Input =
        document.getElementById(
            'address2'
        );


    const addressInput =
        document.getElementById(
            'address'
        );


    const latitudeInput =
        document.getElementById(
            'latitude'
        );


    const longitudeInput =
        document.getElementById(
            'longitude'
        );


    const findLocationBtn =
        document.getElementById(
            'findLocationBtn'
        );


    const locationStatus =
        document.getElementById(
            'locationStatus'
        );



    /*
     * =========================================================
     * UPDATE COORDINATE INPUTS
     * =========================================================
     */

    function updateCoordinateFields(
        latitude,
        longitude
    ) {

        latitudeInput.value =
            Number(latitude).toFixed(7);


        longitudeInput.value =
            Number(longitude).toFixed(7);

    }



    /*
     * =========================================================
     * MOVE MARKER
     * =========================================================
     */

    function moveMarker(
        latitude,
        longitude,
        zoom = 17
    ) {

        propertyMarker.setLatLng(
            [
                latitude,
                longitude
            ]
        );


        editMap.setView(
            [
                latitude,
                longitude
            ],
            zoom
        );


        updateCoordinateFields(
            latitude,
            longitude
        );

    }



    /*
     * =========================================================
     * LOCATION STATUS
     * =========================================================
     */

    function showLocationStatus(
        message,
        type = ''
    ) {

        locationStatus.textContent =
            message;


        locationStatus.className =
            'location-status ' +
            type;

    }



    /*
     * =========================================================
     * COMBINE ADDRESS 1 + ADDRESS 2
     * =========================================================
     *
     * The database still uses one "address" column.
     *
     * Address 1 + Address 2 are combined into that
     * hidden address field.
     *
     * Example:
     *
     * Address 1:
     * Purok 2, Mabuhay
     *
     * Address 2:
     * General Santos City, Philippines
     *
     * Database address:
     * Purok 2, Mabuhay, General Santos City, Philippines
     *
     * =========================================================
     */

    function getCompleteAddress() {

        const address1 =
            address1Input.value.trim();


        const address2 =
            address2Input.value.trim();


        const parts = [];


        if (address1) {

            parts.push(
                address1
            );

        }


        if (address2) {

            parts.push(
                address2
            );

        }


        const completeAddress =
            parts.join(', ');


        addressInput.value =
            completeAddress;


        return completeAddress;

    }



    /*
     * =========================================================
     * GEOCODING
     * =========================================================
     *
     * Uses OpenStreetMap Nominatim to convert the
     * address into latitude and longitude.
     *
     * =========================================================
     */

    async function findLocation() {

        const address =
            getCompleteAddress();


        if (!address) {

            showLocationStatus(
                'Please enter a location first.',
                'error'
            );


            address1Input.focus();

            return;

        }



        /*
         * Disable button while searching.
         */

        findLocationBtn.disabled =
            true;


        findLocationBtn.innerHTML =
            '<i class="bi bi-hourglass-split"></i> Finding...';


        showLocationStatus(
            'Searching for the new location...',
            'loading'
        );



        try {

            /*
             * Add General Santos City and Philippines
             * to improve local search accuracy.
             */

            let searchAddress =
                address;


            if (
                !searchAddress
                    .toLowerCase()
                    .includes('general santos')
            ) {

                searchAddress +=
                    ', General Santos City, Philippines';

            }



            /*
             * Encode address.
             */

            const encodedAddress =
                encodeURIComponent(
                    searchAddress
                );



            /*
             * Nominatim request.
             */

            const response =
                await fetch(
                    'https://nominatim.openstreetmap.org/search?' +
                    'format=jsonv2' +
                    '&limit=5' +
                    '&countrycodes=ph' +
                    '&q=' +
                    encodedAddress
                );


            if (!response.ok) {

                throw new Error(
                    'Location search failed.'
                );

            }


            const results =
                await response.json();


            if (
                !results ||
                results.length === 0
            ) {

                showLocationStatus(
                    'Location not found. Try adding a street, barangay, or city.',
                    'error'
                );

                return;

            }



            /*
             * Use first matching result.
             */

            const result =
                results[0];


            const latitude =
                parseFloat(
                    result.lat
                );


            const longitude =
                parseFloat(
                    result.lon
                );


            if (
                !Number.isFinite(latitude) ||
                !Number.isFinite(longitude)
            ) {

                throw new Error(
                    'Invalid coordinates returned.'
                );

            }



            /*
             * Move marker.
             */

            moveMarker(
                latitude,
                longitude,
                17
            );



            /*
             * Popup.
             */

            propertyMarker
                .bindPopup(
                    '<strong>Property Location</strong><br>' +
                    escapeHtml(
                        result.display_name
                    )
                )
                .openPopup();



            /*
             * Show success.
             */

            showLocationStatus(
                'Location found and map pin updated.',
                'success'
            );


        } catch (error) {

            console.error(
                'Geocoding error:',
                error
            );


            showLocationStatus(
                'Unable to find this location. Please try again or click the map to place the pin.',
                'error'
            );


        } finally {

            /*
             * Enable button again.
             */

            findLocationBtn.disabled =
                false;


            findLocationBtn.innerHTML =
                '<i class="bi bi-geo-alt"></i> Find Location';

        }

    }



    /*
     * =========================================================
     * ESCAPE HTML
     * =========================================================
     */

    function escapeHtml(
        text
    ) {

        const div =
            document.createElement(
                'div'
            );


        div.textContent =
            text;


        return div.innerHTML;

    }



    /*
     * =========================================================
     * FIND LOCATION BUTTON
     * =========================================================
     */

    findLocationBtn.addEventListener(
        'click',
        function () {

            clearTimeout(
                addressSearchTimer
            );


            findLocation();

        }
    );



    /*
     * =========================================================
     * AUTOMATIC ADDRESS SEARCH
     * =========================================================
     *
     * Both Address 1 and Address 2 are monitored.
     *
     * When the user stops typing for one second,
     * the location is automatically searched.
     *
     * =========================================================
     */

    let addressSearchTimer =
        null;



    function scheduleAddressSearch() {

        clearTimeout(
            addressSearchTimer
        );


        const address =
            getCompleteAddress();


        if (
            address.length < 5
        ) {

            showLocationStatus(
                'Enter more of the location to update the map.'
            );

            return;

        }


        addressSearchTimer =
            setTimeout(
                function () {

                    findLocation();

                },
                1000
            );

    }



    /*
     * Address 1 input.
     */

    address1Input.addEventListener(
        'input',
        function () {

            scheduleAddressSearch();

        }
    );



    /*
     * Address 2 input.
     */

    address2Input.addEventListener(
        'input',
        function () {

            scheduleAddressSearch();

        }
    );



    /*
     * Address 1 blur.
     */

    address1Input.addEventListener(
        'blur',
        function () {

            const address =
                getCompleteAddress();


            if (
                address.length >= 5
            ) {

                findLocation();

            }

        }
    );



    /*
     * Address 2 blur.
     */

    address2Input.addEventListener(
        'blur',
        function () {

            const address =
                getCompleteAddress();


            if (
                address.length >= 5
            ) {

                findLocation();

            }

        }
    );



    /*
     * =========================================================
     * ENTER KEY - ADDRESS 1
     * =========================================================
     */

    address1Input.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Enter'
            ) {

                event.preventDefault();


                clearTimeout(
                    addressSearchTimer
                );


                findLocation();

            }

        }
    );



    /*
     * =========================================================
     * ENTER KEY - ADDRESS 2
     * =========================================================
     */

    address2Input.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Enter'
            ) {

                event.preventDefault();


                clearTimeout(
                    addressSearchTimer
                );


                findLocation();

            }

        }
    );



    /*
     * =========================================================
     * CLICK MAP TO MOVE PIN
     * =========================================================
     */

    editMap.on(
        'click',
        function (event) {

            const latitude =
                event.latlng.lat;


            const longitude =
                event.latlng.lng;



            /*
             * Move marker.
             */

            moveMarker(
                latitude,
                longitude,
                17
            );



            /*
             * Show popup.
             */

            propertyMarker
                .bindPopup(
                    '<strong>Property Location</strong><br>' +
                    'Pin manually selected.'
                )
                .openPopup();



            /*
             * Update status.
             */

            showLocationStatus(
                'Map pin moved. Latitude and longitude updated.',
                'success'
            );

        }
    );



    /*
     * =========================================================
     * DRAG MARKER
     * =========================================================
     */

    propertyMarker.on(
        'dragend',
        function () {

            const position =
                propertyMarker.getLatLng();


            updateCoordinateFields(
                position.lat,
                position.lng
            );


            editMap.setView(
                [
                    position.lat,
                    position.lng
                ]
            );


            showLocationStatus(
                'Map pin moved. Latitude and longitude updated.',
                'success'
            );

        }
    );



    /*
     * =========================================================
     * INITIAL COORDINATES
     * =========================================================
     */

    updateCoordinateFields(
        existingLatitude,
        existingLongitude
    );



    /*
     * =========================================================
     * INITIAL ADDRESS
     * =========================================================
     *
     * Keep the existing database address in Address 1.
     * Address 2 can be added/edited by the owner.
     *
     * =========================================================
     */

    getCompleteAddress();



    /*
     * =========================================================
     * MAP RESIZE FIX
     * =========================================================
     */

    setTimeout(
        function () {

            editMap.invalidateSize();

        },
        300
    );

    document
        .getElementById(
            'editListingForm'
        )
        .addEventListener(
            'submit',
            function () {


                /*
                 * Combine addresses.
                 */

                getCompleteAddress();



                /*
                 * Get latest marker position.
                 */

                const position =
                    propertyMarker.getLatLng();



                /*
                 * Save coordinates.
                 */

                updateCoordinateFields(
                    position.lat,
                    position.lng
                );



                /*
                 * Disable update button.
                 */

                const updateButton =
                    document.getElementById(
                        'updateListingBtn'
                    );


                updateButton.disabled =
                    true;


                updateButton.innerHTML =
                    '<i class="bi bi-hourglass-split"></i> Updating...';

            }
        );

</script>



</body>

</html>
