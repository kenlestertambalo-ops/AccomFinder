<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          crossorigin="">

    <style>
        * {
            box-sizing: border-box;
        }

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
            padding: 35px 14px 50px;
            overflow-y: auto;
            overflow-x: hidden;
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

        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            margin-top: 30px;
            padding: 30px;
            width: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
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

        .form-label {
            font-weight: 600;
            color: #203b62;
            margin-bottom: 8px;
        }

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
            box-shadow: 0 0 0 .15rem rgba(20,148,95,.12);
        }

        .find-location-btn {
            min-width: 150px;
            border: none;
            border-radius: 8px;
            background: #14945f;
            color: #fff;
            font-weight: 600;
            padding: 12px 18px;
            cursor: pointer;
        }

        .find-location-btn:hover {
            background: #0d7e50;
        }

        .find-location-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

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

        .map-container {
            width: 100%;
            height: 400px;
            border: 1px solid #dce3eb;
            border-radius: 12px;
            overflow: hidden;
            background: #eef3f8;
            margin-top: 12px;
        }

        #editMap {
            width: 100%;
            height: 100%;
        }

        .map-help {
            margin-top: 9px;
            padding: 10px 12px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            color: #166534;
            font-size: 13px;
        }

        .coordinates-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 18px;
        }

        .coordinate-value {
            background: #f8fafc;
            font-size: 14px;
        }

        .update-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: #14945f;
            color: #fff;
            border: none;
            padding: 12px 22px;
            border-radius: 9px;
            font-size: 15px;
            cursor: pointer;
        }

        .update-btn:hover {
            background: #0d7e50;
            color: #fff;
        }

        .cancel-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #6c757d;
            color: #fff;
            padding: 12px 22px;
            border-radius: 9px;
            text-decoration: none;
            margin-left: 8px;
        }

        .cancel-btn:hover {
            background: #5c636a;
            color: #fff;
        }

        .room-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 18px;
            background: #fff;
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
                width: calc(100% - 220px);
            }

            .form-card {
                padding: 22px;
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
        }
    </style>
</head>

<body>

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

        <a href="{{ route('owner.listings') }}" class="active">
            <span class="menu-icon"><i class="bi bi-buildings"></i></span>
            Listings
        </a>

        <a href="{{ route('owner.tenants') }}">
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
            <span class="menu-icon"><i class="bi bi-box-arrow-left"></i></span>
            Logout
        </a>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <i class="bi bi-bell bell"></i>
        <span class="owner-name">
            {{ session('owner_name', 'Owner') }}
        </span>
    </div>

    <div class="main">

        <div class="page-header">
            <h1>Edit Listing</h1>
            <p>Update your property information</p>
        </div>

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

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Please correct the following:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PROPERTY INFORMATION --}}
        <div class="form-card">

            <h4 class="form-title">
                <i class="bi bi-pencil-square"></i>
                Property Information
            </h4>

            <form id="editListingForm"
                  action="{{ route('owner.listings.update', $listing->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Property Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $listing->name) }}"
                           required>
                </div>

                {{-- COMPLETE ADDRESS --}}
                <div class="mb-3">
                    <label class="form-label">Complete Address</label>
                    <input type="text"
                           id="completeAddress"
                           name="address"
                           class="form-control"
                           value="{{ old('address', $listing->address) }}"
                           placeholder="Street, Barangay, City, Province"
                           autocomplete="off"
                           required>
                </div>

                <div class="mb-3">
                    <button type="button"
                            id="findLocationBtn"
                            class="find-location-btn">
                        <i class="bi bi-geo-alt"></i>
                        Find Location
                    </button>

                    <div id="locationStatus" class="location-status"></div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Property Location on Map</label>

                    <div class="map-container">
                        <div id="editMap"></div>
                    </div>

                    <div class="map-help">
                        <i class="bi bi-info-circle"></i>
                        Enter the complete address to search for the location.
                        You can also click the map or drag the marker to manually
                        change the property location.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Property Type</label>

                    <select name="type" class="form-select" required>
                        <option value="Boarding House"
                            {{ old('type', $listing->type) == 'Boarding House' ? 'selected' : '' }}>
                            Boarding House
                        </option>

                        <option value="Apartment"
                            {{ old('type', $listing->type) == 'Apartment' ? 'selected' : '' }}>
                            Apartment
                        </option>

                        <option value="Dormitory"
                            {{ old('type', $listing->type) == 'Dormitory' ? 'selected' : '' }}>
                            Dormitory
                        </option>

                        <option value="Bedspace"
                            {{ old('type', $listing->type) == 'Bedspace' ? 'selected' : '' }}>
                            Bedspace
                        </option>
                    </select>
                </div>



                <div class="mb-3">
                    <label class="form-label">Availability Status</label>

                    <select name="status" class="form-select" required>
                        <option value="Available"
                            {{ old('status', $listing->status) == 'Available' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="Full"
                            {{ old('status', $listing->status) == 'Full' ? 'selected' : '' }}>
                            Full
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="5"
                              placeholder="Describe your property...">{{ old('description', $listing->description) }}</textarea>
                </div>

                <div class="coordinates-row">
                    <div>
                        <label class="form-label">Latitude</label>
                        <input type="text"
                               name="latitude"
                               id="latitude"
                               class="form-control coordinate-value"
                               value="{{ old('latitude', $listing->latitude) }}"
                               readonly>
                    </div>

                    <div>
                        <label class="form-label">Longitude</label>
                        <input type="text"
                               name="longitude"
                               id="longitude"
                               class="form-control coordinate-value"
                               value="{{ old('longitude', $listing->longitude) }}"
                               readonly>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                            id="updateListingBtn"
                            class="update-btn">
                        <i class="bi bi-check-circle"></i>
                        Update Listing
                    </button>

                    <a href="{{ route('owner.listings') }}"
                       class="cancel-btn">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </a>
                </div>

            </form>
        </div>
                {{-- ROOM MANAGEMENT --}}
        <div class="form-card">

            <h4 class="form-title">
                <i class="bi bi-door-open"></i>
                Room Management
            </h4>

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <p class="text-muted mb-0">
                    Manage the rooms under this property.
                </p>

                <a href="{{ route('owner.rooms.create', $listing->id) }}"
                   class="btn btn-success">
                    <i class="bi bi-plus-circle"></i>
                    Add Room
                </a>
            </div>

            @forelse($listing->roomRecords as $room)

                <div class="room-card">

                    <form action="{{ route('owner.rooms.update', [$listing->id, $room->id]) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Room Name</label>
                                <input type="text"
                                       name="room_name"
                                       class="form-control"
                                       value="{{ $room->room_name }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Monthly Price</label>
                                <input type="number"
                                       name="price"
                                       class="form-control"
                                       value="{{ $room->price }}"
                                       min="0"
                                       step="0.01"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Capacity</label>
                                <input type="number"
                                       name="capacity"
                                       class="form-control"
                                       value="{{ $room->capacity }}"
                                       min="1"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Bathrooms</label>
                                <input type="number"
                                       name="bathrooms"
                                       class="form-control"
                                       value="{{ $room->bathrooms }}"
                                       min="0"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>

                                <select name="status" class="form-select" required>
                                    <option value="Available"
                                        {{ $room->status == 'Available' ? 'selected' : '' }}>
                                        Available
                                    </option>

                                    <option value="Occupied"
                                        {{ $room->status == 'Occupied' ? 'selected' : '' }}>
                                        Occupied
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description</label>

                                <textarea name="description"
                                          class="form-control"
                                          rows="3">{{ $room->description }}</textarea>
                            </div>

                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Update Room
                            </button>
                        </div>

                    </form>

                    <form action="{{ route('owner.rooms.delete', [$listing->id, $room->id]) }}"
                          method="POST"
                          class="mt-2"
                          onsubmit="return confirm('Are you sure you want to delete this room?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            Delete Room
                        </button>

                    </form>

                </div>

            @empty

                <div class="alert alert-info">
                    No rooms have been added to this property yet.
                    Click Add Room to create your first room.
                </div>

            @endforelse

        </div>

    </div>
</div>

{{-- LEAFLET JAVASCRIPT --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        crossorigin=""></script>

<script>
    /*
    |--------------------------------------------------------------------------
    | EXISTING COORDINATES
    |--------------------------------------------------------------------------
    */

    let existingLatitude = parseFloat(
        @json(old('latitude', $listing->latitude))
    );

    let existingLongitude = parseFloat(
        @json(old('longitude', $listing->longitude))
    );

    const defaultLatitude = 6.1164;
    const defaultLongitude = 125.1716;

    if (
        !Number.isFinite(existingLatitude) ||
        !Number.isFinite(existingLongitude)
    ) {
        existingLatitude = defaultLatitude;
        existingLongitude = defaultLongitude;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE MAP
    |--------------------------------------------------------------------------
    */

    const editMap = L.map('editMap').setView(
        [existingLatitude, existingLongitude],
        16
    );

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(editMap);

    /*
    |--------------------------------------------------------------------------
    | PROPERTY MARKER
    |--------------------------------------------------------------------------
    */

    let propertyMarker = L.marker(
        [existingLatitude, existingLongitude],
        {
            draggable: true
        }
    ).addTo(editMap);

    propertyMarker.bindPopup(
        '<strong>Property Location</strong><br>' +
        'Drag this marker or change the complete address.'
    );

    /*
    |--------------------------------------------------------------------------
    | INPUT ELEMENTS
    |--------------------------------------------------------------------------
    */

    const addressInput =
        document.getElementById('completeAddress');

    const latitudeInput =
        document.getElementById('latitude');

    const longitudeInput =
        document.getElementById('longitude');

    const findLocationBtn =
        document.getElementById('findLocationBtn');

    const locationStatus =
        document.getElementById('locationStatus');

    /*
    |--------------------------------------------------------------------------
    | UPDATE COORDINATES
    |--------------------------------------------------------------------------
    */

    function updateCoordinateFields(latitude, longitude) {
        latitudeInput.value = Number(latitude).toFixed(7);
        longitudeInput.value = Number(longitude).toFixed(7);
    }

    /*
    |--------------------------------------------------------------------------
    | MOVE MARKER
    |--------------------------------------------------------------------------
    */

    function moveMarker(latitude, longitude, zoom = 17) {
        propertyMarker.setLatLng([
            latitude,
            longitude
        ]);

        editMap.setView([
            latitude,
            longitude
        ], zoom);

        updateCoordinateFields(
            latitude,
            longitude
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LOCATION STATUS
    |--------------------------------------------------------------------------
    */

    function showLocationStatus(message, type = '') {
        locationStatus.textContent = message;

        locationStatus.className =
            'location-status ' + type;
    }

    /*
    |--------------------------------------------------------------------------
    | GET COMPLETE ADDRESS
    |--------------------------------------------------------------------------
    */

    function getCompleteAddress() {
        return addressInput.value.trim();
    }

    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(text) {
        const div = document.createElement('div');

        div.textContent = text;

        return div.innerHTML;
    }
        /*
    |--------------------------------------------------------------------------
    | FIND LOCATION USING OPENSTREETMAP
    |--------------------------------------------------------------------------
    */

    async function findLocation() {

        const address = getCompleteAddress();

        if (!address) {
            showLocationStatus(
                'Please enter the complete address first.',
                'error'
            );

            addressInput.focus();
            return;
        }

        findLocationBtn.disabled = true;

        findLocationBtn.innerHTML =
            '<i class="bi bi-hourglass-split"></i> Finding...';

        showLocationStatus(
            'Searching for the property location...',
            'loading'
        );

        try {

            let searchAddress = address;

            if (
                !searchAddress.toLowerCase().includes('general santos')
            ) {
                searchAddress +=
                    ', General Santos City, Philippines';
            }

            const encodedAddress =
                encodeURIComponent(searchAddress);

            const response = await fetch(
                'https://nominatim.openstreetmap.org/search?' +
                'format=jsonv2' +
                '&limit=5' +
                '&countrycodes=ph' +
                '&q=' +
                encodedAddress
            );

            if (!response.ok) {
                throw new Error('Location search failed.');
            }

            const results = await response.json();

            if (!results || results.length === 0) {

                showLocationStatus(
                    'Location not found. Please enter a more specific address.',
                    'error'
                );

                return;
            }

            const result = results[0];

            const latitude = parseFloat(result.lat);
            const longitude = parseFloat(result.lon);

            if (
                !Number.isFinite(latitude) ||
                !Number.isFinite(longitude)
            ) {
                throw new Error('Invalid coordinates returned.');
            }

            moveMarker(
                latitude,
                longitude,
                17
            );

            propertyMarker
                .bindPopup(
                    '<strong>Property Location</strong><br>' +
                    escapeHtml(result.display_name)
                )
                .openPopup();

            showLocationStatus(
                'Location found! Map pin and coordinates updated.',
                'success'
            );

        } catch (error) {

            console.error('Geocoding error:', error);

            showLocationStatus(
                'Unable to find this location. Try again or manually select a location on the map.',
                'error'
            );

        } finally {

            findLocationBtn.disabled = false;

            findLocationBtn.innerHTML =
                '<i class="bi bi-geo-alt"></i> Find Location';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | AUTOMATIC ADDRESS SEARCH
    |--------------------------------------------------------------------------
    */

    let addressSearchTimer = null;

    function scheduleAddressSearch() {

        clearTimeout(addressSearchTimer);

        const address = getCompleteAddress();

        if (address.length < 5) {

            showLocationStatus(
                'Enter a more complete address to update the map.'
            );

            return;
        }

        addressSearchTimer = setTimeout(function () {
            findLocation();
        }, 1000);
    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE ADDRESS EVENTS
    |--------------------------------------------------------------------------
    */

    addressInput.addEventListener('input', function () {
        scheduleAddressSearch();
    });

    addressInput.addEventListener('blur', function () {

        const address = getCompleteAddress();

        if (address.length >= 5) {

            clearTimeout(addressSearchTimer);

            findLocation();
        }
    });

    addressInput.addEventListener('keydown', function (event) {

        if (event.key === 'Enter') {

            event.preventDefault();

            clearTimeout(addressSearchTimer);

            findLocation();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | FIND LOCATION BUTTON
    |--------------------------------------------------------------------------
    */

    findLocationBtn.addEventListener('click', function () {

        clearTimeout(addressSearchTimer);

        findLocation();
    });

    /*
    |--------------------------------------------------------------------------
    | CLICK MAP TO MOVE PIN
    |--------------------------------------------------------------------------
    */

    editMap.on('click', function (event) {

        const latitude = event.latlng.lat;
        const longitude = event.latlng.lng;

        moveMarker(
            latitude,
            longitude,
            17
        );

        propertyMarker
            .bindPopup(
                '<strong>Property Location</strong><br>' +
                'Pin manually selected.'
            )
            .openPopup();

        showLocationStatus(
            'Map pin moved. Latitude and longitude updated.',
            'success'
        );
    });

    /*
    |--------------------------------------------------------------------------
    | DRAG MARKER
    |--------------------------------------------------------------------------
    */

    propertyMarker.on('dragend', function () {

        const position = propertyMarker.getLatLng();

        updateCoordinateFields(
            position.lat,
            position.lng
        );

        editMap.setView([
            position.lat,
            position.lng
        ]);

        showLocationStatus(
            'Map pin moved. Latitude and longitude updated.',
            'success'
        );
    });

    /*
    |--------------------------------------------------------------------------
    | INITIAL COORDINATES
    |--------------------------------------------------------------------------
    */

    updateCoordinateFields(
        existingLatitude,
        existingLongitude
    );

    /*
    |--------------------------------------------------------------------------
    | MAP RESIZE FIX
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {
        editMap.invalidateSize();
    }, 300);

    /*
    |--------------------------------------------------------------------------
    | PROPERTY FORM SUBMISSION
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('editListingForm')
        .addEventListener('submit', function () {

            // Keep the complete address.
            addressInput.value = getCompleteAddress();

            // Get the latest marker position.
            const position = propertyMarker.getLatLng();

            // Save latest coordinates.
            updateCoordinateFields(
                position.lat,
                position.lng
            );

            // Disable update button.
            const updateButton =
                document.getElementById('updateListingBtn');

            updateButton.disabled = true;

            updateButton.innerHTML =
                '<i class="bi bi-hourglass-split"></i> Updating...';
        });

</script>

</body>
</html>
