<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $accommodation->name }} | AccomFinder
    </title>


    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >


    <!-- Leaflet -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >


    <style>

        body {
            background: #f8fafc;
            font-family: Arial, sans-serif;
            color: #1e293b;
        }


        .page {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }


        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #2563eb;
            font-size: 14px;
        }


        /* =====================================================
           MAIN LAYOUT
        ===================================================== */

        .main-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }


        /* =====================================================
           DETAILS CARD
        ===================================================== */

        .details-card {
            background: white;
            border-radius: 10px;
            border: 1px solid #dbe3ec;
            padding: 20px;
        }


        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }


        .location {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }


        .price {
            color: #0f766e;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }


        .status {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: bold;
        }


        .info-row {
            margin-top: 15px;
        }


        .info-item {
            margin-bottom: 12px;
            font-size: 14px;
        }


        /* =====================================================
           AMENITIES
        ===================================================== */

        .amenity {
            margin-right: 5px;
            margin-bottom: 5px;
        }


        /* =====================================================
           MAP
        ===================================================== */

        .map-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: bold;
        }


        #map {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            border: 1px solid #dbe3ec;
        }


        /* =====================================================
           NEARBY LANDMARKS
        ===================================================== */

        .landmarks-section {
            margin-top: 18px;
            padding: 18px;
            background: #f8fbfd;
            border: 1px solid #dbe3ec;
            border-radius: 9px;
        }


        .landmarks-title {
            margin: 0 0 5px;
            font-size: 18px;
            font-weight: bold;
            color: #17395f;
        }


        .landmarks-title i {
            color: #14945f;
            margin-right: 6px;
        }


        .landmarks-help {
            margin: 0 0 15px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }


        .landmark-loading {
            display: none;
            padding: 12px;
            background: white;
            border: 1px solid #dbe3ec;
            border-radius: 7px;
            color: #64748b;
            font-size: 13px;
        }


        .landmark-message {
            padding: 12px;
            background: white;
            border: 1px solid #dbe3ec;
            border-radius: 7px;
            color: #64748b;
            font-size: 13px;
        }


        /* =====================================================
           LANDMARK CATEGORY
        ===================================================== */

        .landmark-category {
            margin-top: 18px;
        }


        .landmark-category:first-child {
            margin-top: 0;
        }


        .category-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: #17395f;
            font-size: 15px;
            font-weight: bold;
        }


        .category-title i {
            color: #14945f;
            font-size: 17px;
        }


        .landmark-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }


        .landmark-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px;
        }


        .landmark-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dcfce7;
            color: #059669;
            border-radius: 8px;
            font-size: 16px;
        }


        .landmark-info {
            min-width: 0;
        }


        .landmark-name {
            font-size: 13px;
            font-weight: bold;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .landmark-type {
            color: #64748b;
            font-size: 11px;
            margin-top: 2px;
        }


        .landmark-distance {
            color: #059669;
            font-size: 11px;
            font-weight: bold;
            margin-top: 3px;
        }

        .category-empty {
            padding: 9px 10px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #94a3b8;
            font-size: 12px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }


        .owner-card,
        .inquiry-card {
            background: white;
            border: 1px solid #dbe3ec;
            border-radius: 10px;
            padding: 18px;
        }


        .card-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 12px;
        }


        .owner-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }


        .owner-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #d1fae5;
            color: #059669;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }


        .owner-name {
            font-weight: bold;
            font-size: 14px;
        }


        .owner-type {
            color: #64748b;
            font-size: 12px;
        }

        .inquiry-label {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }


        .inquiry-textarea {
            width: 100%;
            height: 110px;
            resize: vertical;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px;
            font-size: 13px;
        }


        .inquiry-textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow:
                0 0 0 2px
                rgba(37, 99, 235, 0.1);
        }


        .send-btn {
            width: 100%;
            background: #2563eb;
            border: none;
            color: white;
            padding: 9px;
            border-radius: 5px;
            font-size: 13px;
            margin-top: 10px;
            cursor: pointer;
        }


        .send-btn:hover {
            background: #1d4ed8;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }


        .error-message {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        @media (max-width: 768px) {

            .page {
                margin: 10px auto;
                padding: 10px;
            }


            .main-layout {
                grid-template-columns: 1fr;
            }


            #map {
                height: 350px;
            }
            .landmark-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>


<body>
<div class="page">

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <div class="main-layout">

        <div class="details-card">

            <h1 class="title">
                {{ $accommodation->name }}
            </h1>

            <p class="location">
                📍 {{ $accommodation->address }}
            </p>

            <div class="price">

                ₱{{ number_format($accommodation->price, 2) }}

            </div>

            <span class="status">
                {{ $accommodation->status }}
            </span>
            <hr>

            <div class="row info-row">
                <div class="col-md-6">
                    <div class="info-item">

                        <strong>
                            Property Type:
                        </strong>

                        {{ $accommodation->type ?? 'Not specified' }}

                    </div>


                    <div class="info-item">

                        <strong>
                            Bedrooms:
                        </strong>

                        {{ $accommodation->bedrooms ?? 'Not specified' }}

                    </div>


                    <div class="info-item">

                        <strong>
                            Bathrooms:
                        </strong>

                        {{ $accommodation->bathrooms ?? 'Not specified' }}

                    </div>


                    <div class="info-item">

                        <strong>
                            Capacity:
                        </strong>

                        {{ $accommodation->capacity ?? 'Not specified' }}

                    </div>


                </div>


                <div class="col-md-6">


                    <div class="info-item">

                        <strong>
                            Description:
                        </strong>

                        {{ $accommodation->description ?? 'No description available.' }}

                    </div>
                </div>
            </div>

            @if($accommodation->amenities)

                <hr>

                <h5>
                    Amenities
                </h5>


                @php

                    $amenities = is_array($accommodation->amenities)
                        ? $accommodation->amenities
                        : json_decode($accommodation->amenities, true);

                @endphp


                @if($amenities)

                    @foreach($amenities as $amenity)

                        <span class="badge bg-primary amenity">

                            {{ $amenity }}

                        </span>

                    @endforeach

                @endif

            @endif

            <div class="map-title">

                Location Map

            </div>


            <div id="map"></div>

            <div class="landmarks-section">


                <h3 class="landmarks-title">

                    <i class="bi bi-pin-map-fill"></i>

                    Nearby Landmarks

                </h3>


                <p class="landmarks-help">

                    Find schools, malls, banks, and convenience
                    stores within 1 kilometer of this property.

                </p>

                <div
                    id="landmarkLoading"
                    class="landmark-loading"
                >

                    <i class="bi bi-arrow-repeat"></i>

                    Finding nearby places...

                </div>

                <div
                    id="landmarkMessage"
                    class="landmark-message"
                >

                    Searching for nearby places...

                </div>

                <div
                    id="schoolCategory"
                    class="landmark-category"
                    style="display:none;"
                >

                    <div class="category-title">

                        <i class="bi bi-mortarboard-fill"></i>

                        Schools & Universities

                    </div>


                    <div
                        id="schoolList"
                        class="landmark-list"
                    ></div>

                </div>
                <div
                    id="mallCategory"
                    class="landmark-category"
                    style="display:none;"
                >

                    <div class="category-title">

                        <i class="bi bi-bag-fill"></i>

                        Malls & Shopping

                    </div>


                    <div
                        id="mallList"
                        class="landmark-list"
                    ></div>

                </div>
                <div
                    id="bankCategory"
                    class="landmark-category"
                    style="display:none;"
                >

                    <div class="category-title">

                        <i class="bi bi-bank2"></i>

                        Banks & ATMs

                    </div>


                    <div
                        id="bankList"
                        class="landmark-list"
                    ></div>

                </div>
                <div
                    id="convenienceCategory"
                    class="landmark-category"
                    style="display:none;"
                >

                    <div class="category-title">

                        <i class="bi bi-shop"></i>

                        Convenience Stores

                    </div>


                    <div
                        id="convenienceList"
                        class="landmark-list"
                    ></div>
                </div>
            </div>
        </div>

        <div class="right-column">

            <div class="owner-card">


                <div class="card-title">

                    Property Owner

                </div>


                <div class="owner-box">


                    <div class="owner-icon">

                        O

                    </div>


                    <div>


                        <div class="owner-name">

                            @if($accommodation->owner)

                                {{ $accommodation->owner->name }}

                            @else

                                Owner

                            @endif

                        </div>


                        <div class="owner-type">

                            Property Owner

                        </div>
                    </div>
                </div>
            </div>

            <div class="inquiry-card">


                <div class="card-title">

                    Send Inquiry

                </div>


                <form
                    action="{{ route('student.inquiry.store', $accommodation->id) }}"
                    method="POST"
                >

                    @csrf


                    <div class="inquiry-label">

                        Message

                    </div>


                    <textarea
                        name="message"
                        class="inquiry-textarea"
                        placeholder="Hi, I'm interested in this property..."
                        required
                    ></textarea>


                    <button
                        type="submit"
                        class="send-btn"
                    >

                        ✈ Send Inquiry

                    </button>


                </form>

            </div>
        </div>
    </div>
</div>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
></script>


<script>

const latitude =
    {{ $accommodation->latitude ?? 6.1164 }};

const longitude =
    {{ $accommodation->longitude ?? 125.1716 }};

const map =
    L.map('map').setView(

        [
            latitude,
            longitude
        ],

        17

    );

L.tileLayer(

    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',

    {

        maxZoom: 19,

        attribution:
            '&copy; OpenStreetMap contributors'

    }

).addTo(map);

const propertyMarker =
    L.marker(

        [
            latitude,
            longitude
        ]

    ).addTo(map);

propertyMarker.bindPopup(

    `<strong>
        {{ $accommodation->name }}
    </strong>

    <br>

    {{ $accommodation->address }}`

).openPopup();

function escapeHtml(text) {

    const div =
        document.createElement('div');

    div.textContent =
        text;

    return div.innerHTML;

}

function calculateDistance(

    latitude1,
    longitude1,
    latitude2,
    longitude2

) {

    const earthRadius =
        6371000;


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

function formatDistance(distance) {

    if (distance < 1000) {

        return Math.round(distance) + ' m';

    }


    return (
        distance / 1000
    ).toFixed(1) + ' km';

}

function getCoordinates(element) {

    if (

        typeof element.lat === 'number' &&

        typeof element.lon === 'number'

    ) {

        return {

            latitude:
                element.lat,

            longitude:
                element.lon

        };

    }


    if (

        element.center &&

        typeof element.center.lat === 'number' &&

        typeof element.center.lon === 'number'

    ) {

        return {

            latitude:
                element.center.lat,

            longitude:
                element.center.lon

        };

    }


    return null;

}

function getLandmarkCategory(tags) {

    const amenity =
        tags.amenity || '';

    const shop =
        tags.shop || '';

    const education =
        tags.education || '';

    if (

        amenity === 'school' ||

        amenity === 'college' ||

        amenity === 'university' ||

        education === 'school' ||

        education === 'university' ||

        education === 'college'

    ) {

        return 'school';

    }

    if (

        shop === 'mall'

    ) {

        return 'mall';

    }

    if (

        amenity === 'bank' ||

        amenity === 'atm'

    ) {

        return 'bank';

    }

    if (

        shop === 'convenience'

    ) {

        return 'convenience';

    }


    return null;

}

function getCategoryInfo(category) {

    if (category === 'school') {

        return {

            listId: 'schoolList',

            categoryId: 'schoolCategory',

            icon: 'bi-mortarboard-fill',

            type: 'School / University'

        };

    }


    if (category === 'mall') {

        return {

            listId: 'mallList',

            categoryId: 'mallCategory',

            icon: 'bi-bag-fill',

            type: 'Mall / Shopping'

        };

    }


    if (category === 'bank') {

        return {

            listId: 'bankList',

            categoryId: 'bankCategory',

            icon: 'bi-bank2',

            type: 'Bank / ATM'

        };

    }


    if (category === 'convenience') {

        return {

            listId: 'convenienceList',

            categoryId: 'convenienceCategory',

            icon: 'bi-shop',

            type: 'Convenience Store'

        };

    }


    return null;

}

function createLandmarkItem(landmark, category) {

    const info =
        getCategoryInfo(category);


    const item =
        document.createElement('div');


    item.className =
        'landmark-item';


    item.innerHTML =

        '<div class="landmark-icon">' +

            '<i class="bi ' +
            info.icon +
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
                    info.type
                ) +

            '</div>' +

            '<div class="landmark-distance">' +

                '<i class="bi bi-signpost-2"></i> ' +

                formatDistance(
                    landmark.distance
                ) +

            '</div>' +

        '</div>';


    return item;

}

function displayCategory(
    category,
    landmarks
) {

    const info =
        getCategoryInfo(category);


    const categoryElement =
        document.getElementById(
            info.categoryId
        );


    const list =
        document.getElementById(
            info.listId
        );


    list.innerHTML =
        '';

    if (
        !landmarks ||
        landmarks.length === 0
    ) {

        categoryElement.style.display =
            'block';


        const empty =
            document.createElement('div');


        empty.className =
            'category-empty';


        empty.innerHTML =
            '<i class="bi bi-info-circle"></i> ' +
            'No mapped places found within 1 km.';


        list.appendChild(
            empty
        );


        return;

    }

    categoryElement.style.display =
        'block';

    landmarks.sort(

        function(a, b) {

            return (
                a.distance -
                b.distance
            );

        }

    );

    const seen =
        new Set();


    const unique =
        [];


    landmarks.forEach(

        function(landmark) {

            const key =
                landmark.name
                    .toLowerCase()
                    .trim();


            if (
                seen.has(key)
            ) {

                return;

            }


            seen.add(key);

            unique.push(
                landmark
            );

        }

    );

    unique
        .slice(0, 5)
        .forEach(

            function(landmark) {

                const item =
                    createLandmarkItem(
                        landmark,
                        category
                    );


                list.appendChild(
                    item
                );

            }

        );

}

async function searchNearbyLandmarks() {


    const loading =
        document.getElementById(
            'landmarkLoading'
        );


    const message =
        document.getElementById(
            'landmarkMessage'
        );


    loading.style.display =
        'block';


    message.style.display =
        'none';

    const query = `

        [out:json][timeout:25];

        (

            /* SCHOOLS */

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["amenity"="school"];

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["amenity"="college"];

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["amenity"="university"];

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["education"];


            /* MALLS */

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["shop"="mall"];


            /* BANKS */

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["amenity"="bank"];

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["amenity"="atm"];


            /* CONVENIENCE STORES */

            nwr(
                around:1000,
                ${latitude},
                ${longitude}
            )["name"]["shop"="convenience"];

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


        if (
            !response.ok
        ) {

            throw new Error(
                'Landmark request failed.'
            );

        }


        const data =
            await response.json();


        const elements =
            data.elements || [];

        const categories = {

            school: [],

            mall: [],

            bank: [],

            convenience: []

        };

        elements.forEach(

            function(element) {


                const coordinates =
                    getCoordinates(
                        element
                    );


                if (!coordinates) {

                    return;

                }


                const tags =
                    element.tags || {};


                const name =
                    tags.name ||
                    '';


                if (!name) {

                    return;

                }


                const category =
                    getLandmarkCategory(
                        tags
                    );


                if (!category) {

                    return;

                }


                const distance =
                    calculateDistance(

                        latitude,

                        longitude,

                        coordinates.latitude,

                        coordinates.longitude

                    );


                categories[category].push({

                    name:
                        name,

                    distance:
                        distance,

                    tags:
                        tags

                });

            }

        );


        /*
        |--------------------------------------------------------------------------
        | DISPLAY FOUR CATEGORIES
        |--------------------------------------------------------------------------
        */

        displayCategory(
            'school',
            categories.school
        );


        displayCategory(
            'mall',
            categories.mall
        );


        displayCategory(
            'bank',
            categories.bank
        );


        displayCategory(
            'convenience',
            categories.convenience
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK IF ANY RESULT EXISTS
        |--------------------------------------------------------------------------
        */

        const totalResults =

            categories.school.length +

            categories.mall.length +

            categories.bank.length +

            categories.convenience.length;


        if (
            totalResults === 0
        ) {

            message.style.display =
                'block';


            message.innerHTML =

                '<i class="bi bi-info-circle"></i> ' +

                'No mapped schools, malls, banks, ' +

                'or convenience stores were found ' +

                'within 1 kilometer of this property.';

        }


    } catch (error) {


        console.error(
            'Nearby landmarks error:',
            error
        );


        message.style.display =
            'block';


        message.innerHTML =

            '<i class="bi bi-exclamation-circle"></i> ' +

            'Nearby landmarks could not be loaded. ' +

            'Please try again later.';

    }


    loading.style.display =
        'none';

}


/* =========================================================
   FIX MAP SIZE
========================================================= */

setTimeout(

    function() {

        map.invalidateSize();

    },

    300

);

searchNearbyLandmarks();
</script>
</body>
</html>
