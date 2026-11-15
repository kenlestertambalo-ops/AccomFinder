<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Property | AccomFinder</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">

    <style>
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; }
        body { background: #f5f8fc; font-family: Arial, sans-serif; color: #132238; }

        .sidebar {
            position: fixed; left: 0; top: 0; bottom: 0; width: 264px;
            height: 100vh; background: #fff; border-right: 1px solid #dce3eb;
            z-index: 1000; overflow-y: auto; overflow-x: hidden;
        }
        .logo { height: 138px; padding: 35px 26px 20px; border-bottom: 1px solid #dce3eb; }
        .logo h2 { margin: 0; font-size: 29px; font-weight: 700; color: #168d68; letter-spacing: -1px; }
        .logo h2 span { color: #193e67; }
        .logo small { display: block; margin-top: -3px; color: #66758a; font-size: 14px; font-weight: 600; }
        .menu { padding: 38px 5px; }
        .menu a, .bottom a {
            display: flex; align-items: center; gap: 10px; padding: 14px 26px;
            color: #30435c; text-decoration: none; border-radius: 11px; font-size: 16px;
            transition: .2s;
        }
        .menu a { margin-bottom: 8px; }
        .menu a:hover { background: #eefaf5; color: #009b68; }
        .menu a.active { background: #cdf8e6; color: #078e62; }
        .menu-icon { width: 22px; text-align: center; font-size: 18px; }
        .bottom { position: absolute; left: 0; bottom: 22px; width: 100%; padding: 0 5px; }
        .bottom a { padding: 13px 21px; }
        .bottom a:hover { color: #dc3545; background: #fff5f5; }

        .content { position: fixed; left: 264px; top: 0; right: 0; bottom: 0; overflow: hidden; }
        .topbar {
            position: absolute; left: 0; top: 0; right: 0; height: 74px;
            background: #fff; border-bottom: 1px solid #dce3eb; display: flex;
            justify-content: flex-end; align-items: center; padding: 0 28px; z-index: 900;
        }
        .bell { font-size: 23px; margin-right: 28px; color: #172334; }
        .owner-name { font-size: 16px; font-weight: 600; color: #172334; }
        .main { position: absolute; left: 0; top: 74px; right: 0; bottom: 0; padding: 35px 14px 50px; overflow-y: auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; padding-bottom: 5px; }
        .page-header h1 { margin: 0; font-size: 38px; font-weight: 500; color: #132238; }
        .page-header p { margin: 8px 0 0; color: #5d7089; font-size: 17px; }
        .back-link { display: inline-flex; align-items: center; gap: 7px; margin-bottom: 14px; color: #0d6efd; font-size: 15px; text-decoration: none; }
        .back-link:hover { color: #0b5ed7; text-decoration: underline; }

        .form-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 17px; margin-top: 30px; padding: 30px; width: 100%; box-shadow: 0 2px 8px #0000000a; }
        .form-title { margin: 0 0 25px; padding-bottom: 20px; border-bottom: 1px solid #e1e6ec; font-size: 25px; font-weight: 600; color: #17395f; }
        .form-title i, .amenities-title i, .map-title i, .landmarks-title i { color: #14945f; margin-right: 8px; }
        .form-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; margin-bottom: 20px; }
        .form-row.four { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .field { width: 100%; min-width: 0; }
        label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #203b62; }
        input, select, textarea {
            width: 100%; padding: 12px 13px; border: 1px solid #dce3eb;
            border-radius: 8px; font-size: 14px; color: #30435c; background: #fff; outline: none;
        }
        input:focus, select:focus, textarea:focus { border-color: #14945f; box-shadow: 0 0 0 3px #14945f1a; }
        textarea { min-height: 120px; resize: vertical; line-height: 1.5; }

        .image-upload-section { margin: 24px 0; padding: 20px; background: #f8fbfd; border: 1px solid #e1e8ef; border-radius: 12px; }
        .image-upload-title { font-size: 18px; font-weight: 600; color: #17395f; margin-bottom: 12px; }
        .image-upload-title i { color: #14945f; margin-right: 7px; }
        .image-help { margin: 8px 0 0; color: #66778c; font-size: 13px; line-height: 1.5; }
        .image-input { background: #fff; }
        #imagePreviewContainer { display: none; margin-top: 15px; }
        #imagePreview { display: block; width: 100%; max-width: 400px; max-height: 260px; object-fit: cover; border-radius: 10px; border: 1px solid #dce3eb; }
        .remove-image-btn { display: none; margin-top: 10px; padding: 8px 12px; border: 1px solid #dc3545; border-radius: 7px; color: #dc3545; background: #fff; cursor: pointer; }

        .address-status { display: none; margin-top: 8px; font-size: 13px; line-height: 1.4; }
        #barangaySelect, #streetSelect { cursor: pointer; }
        #streetSelect:disabled { background: #f1f5f9; color: #94a3b8; cursor: not-allowed; }
        .amenities-section, .map-section { margin-top: 25px; padding-top: 22px; border-top: 1px solid #e1e6ec; }
        .amenities-title { font-size: 16px; font-weight: 600; color: #17395f; margin-bottom: 14px; }
        .amenity-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; }
        .amenity { display: flex; align-items: center; gap: 8px; padding: 11px 12px; border: 1px solid #e2e8f0; border-radius: 8px; color: #53657b; font-size: 13px; cursor: pointer; }
        .amenity:hover { background: #f5faf8; border-color: #bfe8d7; }
        .amenity input, .available input { width: auto; margin: 0; accent-color: #14945f; }

        .map-title { font-size: 18px; font-weight: 600; color: #17395f; margin-bottom: 5px; }
        .map-help { margin: 0 0 14px; color: #66778c; font-size: 14px; line-height: 1.6; }
        #map { width: 100%; height: 450px; border: 1px solid #dce3eb; border-radius: 10px; overflow: hidden; background: #e5e5e5; }
        #map .leaflet-tile, #map .leaflet-marker-icon, #map .leaflet-marker-shadow, #map img { max-width: none !important; max-height: none !important; }

        .landmarks-section { margin-top: 22px; padding: 20px; background: #f8fbfd; border: 1px solid #e1e8ef; border-radius: 12px; }
        .landmarks-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
        .landmarks-title { margin: 0; font-size: 18px; font-weight: 600; color: #17395f; }
        .landmarks-help { margin: 0 0 15px; color: #66778c; font-size: 13px; }
        .landmark-loading, .landmark-message { display: none; padding: 13px; color: #66778c; background: #fff; border: 1px solid #e1e8ef; border-radius: 8px; font-size: 13px; line-height: 1.5; }
        .landmark-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .landmark-item { display: flex; align-items: center; gap: 12px; padding: 12px; background: #fff; border: 1px solid #e2e8f0; border-radius: 9px; }
        .landmark-icon { width: 38px; height: 38px; min-width: 38px; display: flex; align-items: center; justify-content: center; border-radius: 9px; background: #cdf8e6; color: #078e62; font-size: 18px; }
        .landmark-info { min-width: 0; flex: 1; }
        .landmark-name { font-size: 14px; font-weight: 600; color: #203b62; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .landmark-type { margin-top: 3px; color: #718096; font-size: 12px; }
        .landmark-distance { margin-top: 4px; color: #14945f; font-size: 12px; font-weight: 600; }
        .coordinates { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; margin-top: 18px; }
        .coordinate-input { background: #f5f8fc; cursor: not-allowed; }

        .available { margin-top: 20px; padding: 14px 15px; background: #f5faf8; border: 1px solid #dcefe7; border-radius: 9px; }
        .available label { display: flex; align-items: center; gap: 9px; margin: 0; font-size: 14px; color: #30435c; cursor: pointer; }
        .buttons { display: flex; align-items: center; gap: 10px; border-top: 1px solid #e1e6ec; margin-top: 25px; padding-top: 22px; }
        .create-btn, .cancel-btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; border-radius: 9px; font-size: 15px; transition: .2s; }
        .create-btn { background: #14945f; color: #fff; border: none; padding: 12px 22px; cursor: pointer; font-weight: 500; }
        .create-btn:hover { background: #0d7e50; }
        .cancel-btn { padding: 11px 21px; border: 1px solid #cbd5e1; color: #53657b; background: #fff; text-decoration: none; }
        .cancel-btn:hover { background: #f1f5f9; color: #30435c; }
        .error { color: #c73535; font-size: 13px; margin-bottom: 20px; background: #fff2f2; border: 1px solid #ffd1d1; padding: 13px 15px; border-radius: 9px; line-height: 1.6; }
        .map-warning { display: none; color: #c73535; font-size: 13px; margin-top: 9px; background: #fff2f2; border: 1px solid #ffd1d1; padding: 9px 12px; border-radius: 7px; }

        @media (max-width: 1100px) {
            .form-row.four { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .amenity-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .landmark-list { grid-template-columns: 1fr; }
        }
        @media (max-width: 850px) {
            .sidebar { width: 220px; }
            .content { left: 220px; }
            .form-row, .form-row.four, .coordinates { grid-template-columns: 1fr; }
        }
        @media (max-width: 600px) {
            .sidebar { display: none; }
            .content { left: 0; }
            .main { padding: 30px 18px 40px; }
            .page-header h1 { font-size: 30px; }
            .page-header p { font-size: 15px; }
            .form-card { padding: 20px; }
            .amenity-grid { grid-template-columns: 1fr; }
            #map { height: 350px; }
            .landmarks-section, .image-upload-section { padding: 15px; }
            .buttons { flex-wrap: wrap; }
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
        <a href="{{ route('owner.dashboard') }}"><span class="menu-icon"><i class="bi bi-house-door"></i></span>Dashboard</a>
        <a href="{{ route('owner.listings') }}" class="active"><span class="menu-icon"><i class="bi bi-buildings"></i></span>Listings</a>
        <a href="{{ route('owner.tenants') }}"><span class="menu-icon"><i class="bi bi-people"></i></span>Tenants</a>
        <a href="{{ route('owner.payments') }}"><span class="menu-icon"><i class="bi bi-cash-stack"></i></span>Payments</a>
        <a href="{{ route('owner.reports') }}"><span class="menu-icon"><i class="bi bi-bar-chart"></i></span>Reports</a>
        <a href="{{ route('owner.messages') }}"><span class="menu-icon"><i class="bi bi-chat-dots"></i></span>Messages</a>
    </div>

    <div class="bottom">
        <a href="{{ route('owner.logout') }}"><span class="menu-icon"><i class="bi bi-box-arrow-right"></i></span>Logout</a>
    </div>
</div>

<div class="content">
    <div class="topbar">
        <i class="bi bi-bell bell"></i>
        <div class="owner-name">{{ session('owner_name', 'Owner') }}</div>
    </div>

    <div class="main">
        <div class="page-header">
            <div>
                <a href="{{ route('owner.listings') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i> Back to Listings
                </a>
                <h1>Create Property</h1>
                <p>Step 1 of 2: Create your property first, then add individual rooms.</p>
            </div>
        </div>

        <div class="form-card">
            @if ($errors->any())
                <div class="error">
                    <strong>Please fix the following:</strong><br>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <h4 class="form-title"><i class="bi bi-building-add"></i>Property Information</h4>

            <form action="{{ route('owner.listings.store') }}"
                  method="POST"
                  id="listingForm"
                  enctype="multipart/form-data">
                @csrf

                <div class="image-upload-section">
                    <div class="image-upload-title">
                        <i class="bi bi-image"></i> Property Image
                    </div>

                    <div class="field">
                        <label for="image">Upload a photo of your accommodation</label>
                        <input type="file" name="image" id="image" class="image-input"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                        <p class="image-help">
                            Accepted formats: JPG, JPEG, PNG, or WEBP. Maximum file size: 2 MB.
                            Choose a clear photo that shows your property.
                        </p>

                        @error('image')
                            <div style="color:#c73535; margin-top:8px; font-size:13px;">
                                {{ $message }}
                            </div>
                        @enderror

                        <div id="imagePreviewContainer">
                            <label>Image Preview</label>
                            <img id="imagePreview" src="" alt="Property image preview">
                            <button type="button" id="removeImageBtn" class="remove-image-btn">
                                <i class="bi bi-trash"></i> Remove Image
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="title">Property / Company Name</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               placeholder="Enter property or company name" required>
                    </div>

                    <div class="field">
                        <label for="barangaySelect">Barangay (General Santos City)</label>
                        <select id="barangaySelect" name="barangay_selection">
                            <option value="">Select Barangay</option>
                            @foreach ([
                                'Apopong', 'Baluan', 'Batomelong', 'Buayan', 'Bula',
                                'Calumpang', 'City Heights', 'Conel', 'Dadiangas East',
                                'Dadiangas North', 'Dadiangas South', 'Dadiangas West',
                                'Fatima', 'Katangawan', 'Labangal', 'Lagao', 'Ligaya',
                                'Mabuhay', 'Olympog', 'San Isidro', 'San Jose', 'Siguel',
                                'Sinawal', 'Tambler', 'Tinagacan', 'Upper Labay'
                            ] as $barangay)
                                <option value="{{ $barangay }}" {{ old('barangay_selection') == $barangay ? 'selected' : '' }}>
                                    {{ $barangay }}
                                </option>
                            @endforeach
                        </select>
                        <p class="image-help">Select the barangay where the property is located.</p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="streetSelect">Street</label>
                        <select id="streetSelect" name="street_selection" disabled>
                            <option value="">Select a barangay first</option>
                        </select>
                        <div id="streetStatus" class="address-status"></div>
                    </div>

                    <div class="field">
                        <label for="location">Complete Address</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                               placeholder="Select a barangay and street, or pin the exact location on the map"
                               autocomplete="street-address" required>
                        <div id="addressStatus" class="address-status"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="type">Property Type</label>
                        <select name="type" id="type" required>
                            <option value="">Select Property Type</option>
                            @foreach (['Studio', 'Apartment', 'Boarding House', 'Dormitory', 'Room'] as $propertyType)
                                <option value="{{ $propertyType }}" {{ old('type') == $propertyType ? 'selected' : '' }}>
                                    {{ $propertyType }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="image-help" style="margin-bottom:20px;">
                    Monthly rent, room capacity, bathrooms, and room amenities will be added in Step 2.
                </p>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                              placeholder="Describe your property...">{{ old('description') }}</textarea>
                </div>

                <div class="map-section">
                    <div class="map-title"><i class="bi bi-geo-alt-fill"></i>Property Location on Map</div>
                    <p class="map-help">
                        Navigate around the map and click the exact location of your property to place a pin.
                        You can drag the marker to adjust its exact position.
                        The latitude and longitude will automatically update.
                        Select a barangay and mapped street above, then click the map to place the exact pin.
                        Nearby landmarks will appear below the map.
                    </p>

                    <div id="map"></div>

                    <div class="landmarks-section">
                        <div class="landmarks-header">
                            <h3 class="landmarks-title"><i class="bi bi-pin-map-fill"></i>Nearby Landmarks</h3>
                        </div>
                        <p class="landmarks-help">
                            Nearby schools, hospitals, banks, stores, restaurants, transport stops and other places around the property.
                        </p>
                        <div id="landmarkLoading" class="landmark-loading">
                            <i class="bi bi-arrow-repeat"></i> Searching for nearby landmarks...
                        </div>
                        <div id="landmarkMessage" class="landmark-message" style="display:block;">
                            Pin the property on the map to see nearby landmarks.
                        </div>
                        <div id="landmarkList" class="landmark-list"></div>
                    </div>

                    <div class="coordinates">
                        <div class="field">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="coordinate-input"
                                   value="{{ old('latitude') }}" readonly required>
                        </div>
                        <div class="field">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="coordinate-input"
                                   value="{{ old('longitude') }}" readonly required>
                        </div>
                    </div>

                    <div id="mapWarning" class="map-warning">
                        Please select the exact property location on the map before saving the property.
                    </div>
                </div>

                <div class="buttons">
                    <button type="submit" class="create-btn">
                        <i class="bi bi-plus-lg"></i> Save Property &amp; Add Rooms
                    </button>
                    <a href="{{ route('owner.listings') }}" class="cancel-btn">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
/*
|--------------------------------------------------------------------------
| ACCOMFINDER LOCATION CONFIGURATION
|--------------------------------------------------------------------------
*/

const CITY_NAME = 'General Santos City';
const COUNTRY_NAME = 'Philippines';

const barangaySelect = document.getElementById('barangaySelect');
const streetSelect = document.getElementById('streetSelect');
const locationInput = document.getElementById('location');

const streetStatus = document.getElementById('streetStatus');
const addressStatus = document.getElementById('addressStatus');

const latitudeInput = document.getElementById('latitude');
const longitudeInput = document.getElementById('longitude');

const landmarkList = document.getElementById('landmarkList');
const landmarkLoading = document.getElementById('landmarkLoading');
const landmarkMessage = document.getElementById('landmarkMessage');

let selectedBarangay = '';
let selectedStreet = '';
let currentBarangayBoundary = null;
let currentMapMarker = null;
let map = null;

let reverseGeocodeRequest = 0;
let streetRequest = 0;
let landmarkRequest = 0;

/*
|--------------------------------------------------------------------------
| VERIFIED STREET CORRECTIONS
|--------------------------------------------------------------------------
|
| Only add streets here when their barangay assignment has been verified.
| Piña Street is explicitly assigned to Dadiangas North.
|
*/

const VERIFIED_STREETS = {
    'pina street': 'Dadiangas North',
    'piña street': 'Dadiangas North'
};

/*
|--------------------------------------------------------------------------
| TEXT NORMALIZATION
|--------------------------------------------------------------------------
*/

function normalizeText(value) {
    return String(value || '')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .replace(/\bstreet\b/g, 'street')
        .replace(/[.,]/g, ' ')
        .replace(/\s+/g, ' ')
        .trim();
}

function normalizeStreetName(value) {
    return normalizeText(value)
        .replace(/\b(st|street)\b/g, 'street')
        .trim();
}

/*
|--------------------------------------------------------------------------
| DISPLAY STATUS
|--------------------------------------------------------------------------
*/

function showStreetStatus(message, color = '#64748b') {
    streetStatus.style.display = 'block';
    streetStatus.style.color = color;
    streetStatus.textContent = message;
}

function showAddressStatus(message, color = '#159466') {
    addressStatus.style.display = 'block';
    addressStatus.style.color = color;
    addressStatus.textContent = message;
}

/*
|--------------------------------------------------------------------------
| BARANGAY BOUNDARY LOOKUP
|--------------------------------------------------------------------------
|
| Find an exact named administrative boundary.
| If a boundary cannot be verified, do not use nearby street results.
|
*/

async function findBarangayBoundary(barangay) {

    const query = encodeURIComponent(
        barangay + ', General Santos City, Philippines'
    );

    const url =
        'https://nominatim.openstreetmap.org/search' +
        '?format=jsonv2' +
        '&q=' + query +
        '&addressdetails=1' +
        '&polygon_geojson=1' +
        '&limit=10';

    const response = await fetch(url, {
        headers: {
            'Accept': 'application/json'
        }
    });

    if (!response.ok) {
        throw new Error('Unable to retrieve barangay boundary data.');
    }

    const results = await response.json();

    const expectedBarangay = normalizeText(barangay);

    const exactResult = results.find(result => {

        const address = result.address || {};

        const resultName = normalizeText(
            result.name || ''
        );

        const displayName = normalizeText(
            result.display_name || ''
        );

        const addressNames = [
            address.suburb,
            address.neighbourhood,
            address.city_district,
            address.quarter,
            address.village,
            address.town
        ]
            .filter(Boolean)
            .map(normalizeText);

        const exactName =
            resultName === expectedBarangay ||
            addressNames.includes(expectedBarangay);

        const mentionsBarangay =
            displayName.includes(expectedBarangay);

        const mentionsCity =
            displayName.includes(normalizeText(CITY_NAME));

        return (
            result.geojson &&
            ['Polygon', 'MultiPolygon'].includes(result.geojson.type) &&
            (exactName || mentionsBarangay) &&
            mentionsCity
        );
    });

    if (!exactResult) {
        return null;
    }

    return exactResult;
}

/*
|--------------------------------------------------------------------------
| CONVERT OSM OBJECT TO OVERPASS AREA ID
|--------------------------------------------------------------------------
*/

function getOverpassAreaId(result) {

    const osmId = Number(result.osm_id);

    if (!Number.isFinite(osmId)) {
        return null;
    }

    if (result.osm_type === 'relation') {
        return 3600000000 + osmId;
    }

    if (result.osm_type === 'way') {
        return 2400000000 + osmId;
    }

    return null;
}

/*
|--------------------------------------------------------------------------
| LOAD STREET NAMES INSIDE VERIFIED BARANGAY BOUNDARY
|--------------------------------------------------------------------------
*/

async function loadBarangayStreets(barangay) {

    const requestNumber = ++streetRequest;

    streetSelect.disabled = true;
    streetSelect.innerHTML = `
        <option value="">Loading mapped streets...</option>
    `;

    currentBarangayBoundary = null;

    showStreetStatus(
        'Looking for the official mapped boundary of ' + barangay + '...'
    );

    try {

        const boundary = await findBarangayBoundary(barangay);

        if (requestNumber !== streetRequest) {
            return;
        }

        if (!boundary) {

            streetSelect.innerHTML = `
                <option value="">Street data unavailable</option>
            `;

            showStreetStatus(
                'No exact barangay boundary was found in OpenStreetMap. ' +
                'Please use the map pin and manually confirm the address.',
                '#c73535'
            );

            return;
        }

        currentBarangayBoundary = boundary;

        const areaId = getOverpassAreaId(boundary);

        if (!areaId) {

            streetSelect.innerHTML = `
                <option value="">Street data unavailable</option>
            `;

            showStreetStatus(
                'The barangay boundary cannot be converted into a street search area.',
                '#c73535'
            );

            return;
        }

        showStreetStatus(
            'Barangay boundary found. Loading streets within ' + barangay + '...'
        );

        const overpassQuery = `
            [out:json][timeout:25];
            area(${areaId})->.barangayArea;
            way["highway"]["name"](area.barangayArea);
            out tags;
        `;

        const overpassResponse = await fetch(
            'https://overpass-api.de/api/interpreter',
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'data=' + encodeURIComponent(overpassQuery)
            }
        );

        if (!overpassResponse.ok) {
            throw new Error('Street data service is unavailable.');
        }

        const overpassData = await overpassResponse.json();

        if (requestNumber !== streetRequest) {
            return;
        }

        const streetNames = [
            ...new Set(
                (overpassData.elements || [])
                    .map(element => element.tags?.name)
                    .filter(name => name && name.trim())
            )
        ].sort((a, b) => a.localeCompare(b));

        streetSelect.innerHTML = `
            <option value="">Select Street</option>
        `;

        if (streetNames.length === 0) {

            streetSelect.innerHTML = `
                <option value="">No mapped streets found</option>
            `;

            showStreetStatus(
                'No named streets were found inside this mapped barangay boundary. ' +
                'You can still place the exact pin on the map.',
                '#c73535'
            );

            return;
        }

        streetNames.forEach(street => {

            const option = document.createElement('option');

            option.value = street;
            option.textContent = street;

            streetSelect.appendChild(option);
        });

        streetSelect.disabled = false;

        showStreetStatus(
            streetNames.length +
            ' mapped street names found inside ' +
            barangay + '.',
            '#159466'
        );

    } catch (error) {

        if (requestNumber !== streetRequest) {
            return;
        }

        console.error('Street loading error:', error);

        streetSelect.innerHTML = `
            <option value="">Street data unavailable</option>
        `;

        showStreetStatus(
            'Unable to load street data. Please use the map pin instead.',
            '#c73535'
        );
    }
}

/*
|--------------------------------------------------------------------------
| BUILD COMPLETE ADDRESS
|--------------------------------------------------------------------------
*/

function buildCompleteAddress() {

    const barangay = selectedBarangay;
    const street = selectedStreet;

    if (!barangay) {
        return '';
    }

    if (street && street.trim() !== '') {

        return (
            street +
            ', ' +
            barangay +
            ', ' +
            CITY_NAME +
            ', Philippines'
        );
    }

    return (
        barangay +
        ', ' +
        CITY_NAME +
        ', Philippines'
    );
}

/*
|--------------------------------------------------------------------------
| BARANGAY DROPDOWN CHANGE
|--------------------------------------------------------------------------
*/

barangaySelect.addEventListener('change', async function () {

    selectedBarangay = this.value;
    selectedStreet = '';

    streetSelect.innerHTML = `
        <option value="">Select a barangay first</option>
    `;

    streetSelect.disabled = true;

    if (!selectedBarangay) {
        return;
    }

    const address = buildCompleteAddress();

    locationInput.value = address;

    showAddressStatus(
        'Barangay selected. Choose a street or place the exact pin on the map.'
    );

    await loadBarangayStreets(selectedBarangay);
});

/*
|--------------------------------------------------------------------------
| STREET DROPDOWN CHANGE
|--------------------------------------------------------------------------
*/

streetSelect.addEventListener('change', function () {

    selectedStreet = this.value;

    if (!selectedStreet || !selectedBarangay) {
        return;
    }

    /*
     * Apply verified street-to-barangay correction.
     */

    const normalizedStreet = normalizeStreetName(selectedStreet);

    const verifiedBarangay = VERIFIED_STREETS[normalizedStreet];

    if (
        verifiedBarangay &&
        verifiedBarangay !== selectedBarangay
    ) {

        selectedBarangay = verifiedBarangay;

        barangaySelect.value = verifiedBarangay;

        showAddressStatus(
            'The selected street is assigned to ' +
            verifiedBarangay +
            '. Please confirm the location.',
            '#159466'
        );

        loadBarangayStreets(verifiedBarangay);

        return;
    }

    locationInput.value = buildCompleteAddress();

    showAddressStatus(
        'Address filled from the selected barangay and street. ' +
        'Please check the address before saving.'
    );
});

/*
|--------------------------------------------------------------------------
| VERIFY REVERSE-GEOCODED STREET AGAINST VERIFIED CORRECTIONS
|--------------------------------------------------------------------------
*/

function correctKnownBarangay(streetName, returnedBarangay) {

    const normalizedStreet = normalizeStreetName(streetName);

    const verifiedBarangay = VERIFIED_STREETS[normalizedStreet];

    if (verifiedBarangay) {
        return verifiedBarangay;
    }

    return returnedBarangay;
}

/*
|--------------------------------------------------------------------------
| REVERSE GEOCODING
|--------------------------------------------------------------------------
|
| The map marker coordinates are authoritative.
| Reverse geocoding provides a suggested address, not a guarantee.
|
*/

async function reverseGeocode(latitude, longitude) {

    const requestNumber = ++reverseGeocodeRequest;

    showAddressStatus(
        'Finding the mapped address for this pin...',
        '#64748b'
    );

    try {

        const url =
            'https://nominatim.openstreetmap.org/reverse' +
            '?format=jsonv2' +
            '&lat=' + encodeURIComponent(latitude) +
            '&lon=' + encodeURIComponent(longitude) +
            '&zoom=18' +
            '&addressdetails=1';

        const response = await fetch(url, {
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Reverse geocoding service unavailable.');
        }

        const data = await response.json();

        if (requestNumber !== reverseGeocodeRequest) {
            return;
        }

        const address = data.address || {};

        const road =
            address.road ||
            address.pedestrian ||
            address.residential ||
            address.footway ||
            address.path ||
            '';

        let barangay =
            address.suburb ||
            address.neighbourhood ||
            address.city_district ||
            address.quarter ||
            address.village ||
            '';

        const streetCorrection = road
            ? VERIFIED_STREETS[normalizeStreetName(road)]
            : null;

        if (streetCorrection) {
            barangay = streetCorrection;
        }

        /*
         * If a barangay was selected manually, do not silently
         * replace it with an unverified neighboring locality.
         */

        if (
            selectedBarangay &&
            currentBarangayBoundary &&
            !streetCorrection
        ) {
            barangay = selectedBarangay;
        }

        const city =
            address.city ||
            address.town ||
            address.municipality ||
            CITY_NAME;

        const parts = [];

        if (road) {
            parts.push(road);
        }

        if (barangay) {
            parts.push(barangay);
        }

        if (city) {
            parts.push(city);
        }

        parts.push(COUNTRY_NAME);

        const suggestedAddress = [...new Set(parts)].join(', ');

        if (suggestedAddress) {

            locationInput.value = suggestedAddress;

            if (streetCorrection) {

                selectedBarangay = streetCorrection;
                barangaySelect.value = streetCorrection;

                selectedStreet = road;

                showAddressStatus(
                    'Verified street correction applied: ' +
                    road + ' is assigned to ' +
                    streetCorrection + '. Please confirm before saving.'
                );

            } else {

                showAddressStatus(
                    'Address suggested from the map location. ' +
                    'Please verify the barangay and street before saving.'
                );
            }

        } else {

            showAddressStatus(
                'No mapped street address was returned. Please enter the address manually.',
                '#c73535'
            );
        }

    } catch (error) {

        if (requestNumber !== reverseGeocodeRequest) {
            return;
        }

        console.error('Reverse geocoding error:', error);

        showAddressStatus(
            'Could not automatically find the address. ' +
            'Please enter it manually.',
            '#c73535'
        );
    }
}

/*
|--------------------------------------------------------------------------
| IMAGE PREVIEW
|--------------------------------------------------------------------------
*/

const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const removeImageBtn = document.getElementById('removeImageBtn');

imageInput.addEventListener('change', function () {

    const file = this.files[0];

    if (!file) {
        return;
    }

    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    if (!allowedTypes.includes(file.type)) {

        alert('Please select a JPG, JPEG, PNG, or WEBP image.');

        this.value = '';

        return;
    }

    if (file.size > 2 * 1024 * 1024) {

        alert('The maximum image size is 2 MB.');

        this.value = '';

        return;
    }

    const reader = new FileReader();

    reader.onload = function (event) {

        imagePreview.src = event.target.result;

        imagePreviewContainer.style.display = 'block';

        removeImageBtn.style.display = 'inline-block';
    };

    reader.readAsDataURL(file);
});

removeImageBtn.addEventListener('click', function () {

    imageInput.value = '';

    imagePreview.src = '';

    imagePreviewContainer.style.display = 'none';

    removeImageBtn.style.display = 'none';
});
</script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script>
/*
|--------------------------------------------------------------------------
| MAP INITIALIZATION
|--------------------------------------------------------------------------
*/

const defaultLatitude = 6.1164;
const defaultLongitude = 125.1716;

map = L.map('map').setView(
    [defaultLatitude, defaultLongitude],
    15
);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

/*
|--------------------------------------------------------------------------
| MARKER ICON
|--------------------------------------------------------------------------
*/

const propertyIcon = L.icon({
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

/*
|--------------------------------------------------------------------------
| UPDATE COORDINATES
|--------------------------------------------------------------------------
*/

function updateCoordinates(lat, lng) {

    latitudeInput.value = Number(lat).toFixed(7);
    longitudeInput.value = Number(lng).toFixed(7);

    document.getElementById('mapWarning').style.display = 'none';

    reverseGeocode(lat, lng);

    loadNearbyLandmarks(lat, lng);
}

/*
|--------------------------------------------------------------------------
| PLACE OR MOVE PROPERTY MARKER
|--------------------------------------------------------------------------
*/

function placePropertyMarker(lat, lng) {

    if (currentMapMarker) {

        currentMapMarker.setLatLng([lat, lng]);

    } else {

        currentMapMarker = L.marker(
            [lat, lng],
            {
                icon: propertyIcon,
                draggable: true,
                autoPan: true
            }
        ).addTo(map);

        currentMapMarker.bindPopup(
            '<strong>Property Location</strong><br>Drag this marker to adjust the exact position.'
        );

        currentMapMarker.on('dragend', function () {

            const position = currentMapMarker.getLatLng();

            updateCoordinates(
                position.lat,
                position.lng
            );
        });
    }

    updateCoordinates(lat, lng);
}

/*
|--------------------------------------------------------------------------
| CLICK MAP TO PLACE PIN
|--------------------------------------------------------------------------
*/

map.on('click', function (event) {

    placePropertyMarker(
        event.latlng.lat,
        event.latlng.lng
    );
});

/*
|--------------------------------------------------------------------------
| LOAD SAVED / OLD COORDINATES
|--------------------------------------------------------------------------
*/

const oldLatitude = parseFloat(latitudeInput.value);
const oldLongitude = parseFloat(longitudeInput.value);

if (
    Number.isFinite(oldLatitude) &&
    Number.isFinite(oldLongitude) &&
    oldLatitude >= -90 &&
    oldLatitude <= 90 &&
    oldLongitude >= -180 &&
    oldLongitude <= 180
) {

    map.setView(
        [oldLatitude, oldLongitude],
        18
    );

    placePropertyMarker(
        oldLatitude,
        oldLongitude
    );
}

/*
|--------------------------------------------------------------------------
| LOAD NEARBY LANDMARKS
|--------------------------------------------------------------------------
|
| Uses OpenStreetMap Overpass.
| Distances are straight-line distances from the selected pin.
|
*/

function calculateDistance(lat1, lon1, lat2, lon2) {

    const earthRadius = 6371000;

    const toRadians = value => value * Math.PI / 180;

    const dLat = toRadians(lat2 - lat1);
    const dLon = toRadians(lon2 - lon1);

    const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(toRadians(lat1)) *
        Math.cos(toRadians(lat2)) *
        Math.sin(dLon / 2) ** 2;

    return earthRadius * 2 * Math.atan2(
        Math.sqrt(a),
        Math.sqrt(1 - a)
    );
}

function getLandmarkCategory(tags) {

    if (tags.amenity === 'school' || tags.amenity === 'university' || tags.amenity === 'college') {
        return { icon: 'bi-mortarboard', label: 'School / Education' };
    }

    if (tags.amenity === 'hospital' || tags.amenity === 'clinic' || tags.healthcare) {
        return { icon: 'bi-hospital', label: 'Healthcare' };
    }

    if (tags.amenity === 'bank' || tags.amenity === 'atm') {
        return { icon: 'bi-bank', label: 'Bank / ATM' };
    }

    if (tags.shop) {
        return { icon: 'bi-shop', label: 'Shop' };
    }

    if (tags.amenity === 'restaurant' || tags.amenity === 'cafe' || tags.amenity === 'fast_food') {
        return { icon: 'bi-cup-hot', label: 'Restaurant / Cafe' };
    }

    if (tags.amenity === 'bus_station' || tags.highway === 'bus_stop' || tags.public_transport) {
        return { icon: 'bi-bus-front', label: 'Transportation' };
    }

    if (tags.amenity === 'place_of_worship') {
        return { icon: 'bi-building', label: 'Place of Worship' };
    }

    if (tags.leisure || tags.landuse === 'recreation_ground') {
        return { icon: 'bi-tree', label: 'Park / Recreation' };
    }

    if (tags.amenity === 'police') {
        return { icon: 'bi-shield-check', label: 'Police Station' };
    }

    return { icon: 'bi-geo-alt', label: 'Nearby Place' };
}

async function loadNearbyLandmarks(latitude, longitude) {

    const requestNumber = ++landmarkRequest;

    landmarkList.innerHTML = '';

    landmarkMessage.style.display = 'none';
    landmarkLoading.style.display = 'block';

    const query = `
        [out:json][timeout:25];
        (
            node(around:1000,${latitude},${longitude})["name"]["amenity"];
            node(around:1000,${latitude},${longitude})["name"]["shop"];
            node(around:1000,${latitude},${longitude})["name"]["leisure"];
            way(around:1000,${latitude},${longitude})["name"]["amenity"];
            way(around:1000,${latitude},${longitude})["name"]["shop"];
            way(around:1000,${latitude},${longitude})["name"]["leisure"];
        );
        out center tags;
    `;

    try {

        const response = await fetch(
            'https://overpass-api.de/api/interpreter',
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'data=' + encodeURIComponent(query)
            }
        );

        if (!response.ok) {
            throw new Error('Unable to retrieve nearby landmarks.');
        }

        const data = await response.json();

        if (requestNumber !== landmarkRequest) {
            return;
        }

        const landmarks = (data.elements || [])
            .map(element => {

                const tags = element.tags || {};

                const lat = element.lat ?? element.center?.lat;
                const lng = element.lon ?? element.center?.lon;

                if (
                    !tags.name ||
                    !Number.isFinite(Number(lat)) ||
                    !Number.isFinite(Number(lng))
                ) {
                    return null;
                }

                const distance = calculateDistance(
                    latitude,
                    longitude,
                    Number(lat),
                    Number(lng)
                );

                return {
                    name: tags.name,
                    lat: Number(lat),
                    lng: Number(lng),
                    distance: distance,
                    category: getLandmarkCategory(tags)
                };
            })
            .filter(Boolean)
            .sort((a, b) => a.distance - b.distance);

        const uniqueLandmarks = [];
        const seen = new Set();

        landmarks.forEach(item => {

            const key = normalizeText(item.name);

            if (!seen.has(key)) {
                seen.add(key);
                uniqueLandmarks.push(item);
            }
        });

        landmarkLoading.style.display = 'none';

        if (uniqueLandmarks.length === 0) {

            landmarkMessage.textContent =
                'No mapped landmarks were found within 1 kilometer of this location.';

            landmarkMessage.style.display = 'block';

            return;
        }

        uniqueLandmarks.slice(0, 12).forEach(item => {

            const card = document.createElement('div');

            card.className = 'landmark-item';

            const icon = document.createElement('div');

            icon.className = 'landmark-icon';

            const iconElement = document.createElement('i');

            iconElement.className = 'bi ' + item.category.icon;

            icon.appendChild(iconElement);

            const info = document.createElement('div');

            info.className = 'landmark-info';

            const name = document.createElement('div');

            name.className = 'landmark-name';
            name.textContent = item.name;

            const category = document.createElement('div');

            category.className = 'landmark-type';
            category.textContent = item.category.label;

            const distance = document.createElement('div');

            distance.className = 'landmark-distance';

            distance.textContent =
                item.distance < 1000
                    ? Math.round(item.distance) + ' meters away'
                    : (item.distance / 1000).toFixed(2) + ' km away';

            info.appendChild(name);
            info.appendChild(category);
            info.appendChild(distance);

            card.appendChild(icon);
            card.appendChild(info);

            landmarkList.appendChild(card);
        });

    } catch (error) {

        if (requestNumber !== landmarkRequest) {
            return;
        }

        console.error('Nearby landmark error:', error);

        landmarkLoading.style.display = 'none';

        landmarkMessage.textContent =
            'Nearby landmarks could not be loaded. Your selected property pin and coordinates are still available.';

        landmarkMessage.style.display = 'block';
    }
}

/*
|--------------------------------------------------------------------------
| VALIDATE FORM BEFORE SUBMISSION
|--------------------------------------------------------------------------
*/

document.getElementById('listingForm').addEventListener('submit', function (event) {

    const latitude = parseFloat(latitudeInput.value);
    const longitude = parseFloat(longitudeInput.value);

    if (
        !Number.isFinite(latitude) ||
        !Number.isFinite(longitude) ||
        latitude < -90 ||
        latitude > 90 ||
        longitude < -180 ||
        longitude > 180
    ) {

        event.preventDefault();

        document.getElementById('mapWarning').style.display = 'block';

        alert('Please click the map to select the exact property location.');

        document.getElementById('map').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

        return;
    }

    if (!locationInput.value.trim()) {

        event.preventDefault();

        alert('Please enter the complete property address.');

        locationInput.focus();

        return;
    }

    if (!document.getElementById('title').value.trim()) {

        event.preventDefault();

        alert('Please enter the property name.');

        document.getElementById('title').focus();

        return;
    }

    if (!document.getElementById('type').value) {

        event.preventDefault();

        alert('Please select the property type.');

        document.getElementById('type').focus();

        return;
    }
});

/*
|--------------------------------------------------------------------------
| MAP SIZE FIX
|--------------------------------------------------------------------------
*/

setTimeout(function () {
    map.invalidateSize();
}, 300);

window.addEventListener('resize', function () {
    map.invalidateSize();
});

/*
|--------------------------------------------------------------------------
| INITIAL BARANGAY SELECTION
|--------------------------------------------------------------------------
*/

if (barangaySelect.value) {

    selectedBarangay = barangaySelect.value;

    loadBarangayStreets(selectedBarangay);
}

</script>

</body>
</html>
