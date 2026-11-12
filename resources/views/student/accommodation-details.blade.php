
@php
    $rooms = $accommodation->roomRecords ?? collect();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $accommodation->name }} | AccomFinder</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #333;
        }

        /* LEFT SIDEBAR */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #ddd;
            z-index: 1000;
        }

        .logo {
            height: 145px;
            padding: 25px;
            border-bottom: 1px solid #eee;
        }

        .logo h2 {
            color: #2563eb;
            font-size: 30px;
            font-weight: 700;
        }

        .logo p {
            margin-top: 5px;
            color: gray;
            font-size: 16px;
        }

        .menu {
            padding: 20px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 15px;
            margin-bottom: 10px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            transition: .2s;
        }

        .menu a i {
            font-size: 18px;
        }

        .menu a:hover {
            background: #f1f5f9;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .logout {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        .logout a {
            display: flex;
            align-items: center;
            gap: 8px;
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

        /* MAIN CONTENT */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* TOP NAVBAR */

        .navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            height: 70px;
            background: white;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            z-index: 900;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            text-align: right;
        }

        .user-info strong {
            font-size: 18px;
            color: #111;
        }

        .user-info span {
            margin-top: 3px;
            font-size: 14px;
            color: #666;
        }

        /* PAGE CONTENT */

        .content {
            padding: 100px 30px 30px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            margin-bottom: 5px;
            color: #173b63;
            font-size: 32px;
            font-weight: 700;
        }

        .page-heading p {
            color: #777;
            font-size: 15px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* DETAILS LAYOUT */

        .details-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.8fr) minmax(280px, .8fr);
            gap: 22px;
            align-items: start;
        }

        .main-card,
        .side-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,.03);
        }

        /* PROPERTY INFORMATION */

        .property-title {
            font-size: 27px;
            font-weight: 700;
            color: #173b63;
            margin-bottom: 10px;
        }

        .property-address {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .property-status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .available {
            background: #dcfce7;
            color: #15803d;
        }

        .occupied {
            background: #fee2e2;
            color: #b91c1c;
        }

        .property-information {
            border-top: 1px solid #e2e8f0;
            margin-top: 18px;
            padding-top: 18px;
        }

        .property-description {
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
        }

        /* ROOMS SECTION */

        .rooms-section {
            margin-top: 30px;
        }

        .rooms-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 18px;
        }

        .rooms-heading h2 {
            font-size: 21px;
            color: #173b63;
        }

        .room-count {
            background: #eff6ff;
            color: #2563eb;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .room-card {
            border: 1px solid #dce3ed;
            border-radius: 12px;
            padding: 18px;
            background: white;
            transition: .2s ease;
            min-width: 0;
        }

        .room-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 16px rgba(0,0,0,.07);
        }

        .room-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
        }

        .room-name {
            font-size: 17px;
            font-weight: 700;
            color: #173b63;
        }

        .room-status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .room-price {
            font-size: 22px;
            color: #07866f;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .room-price small {
            color: #64748b;
            font-size: 12px;
            font-weight: 400;
        }

        .room-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            font-size: 13px;
            color: #475569;
        }

        .room-details p {
            line-height: 1.5;
        }

        .room-description,
        .room-amenities {
            margin-top: 13px;
            font-size: 13px;
            line-height: 1.6;
            color: #475569;
            overflow-wrap: anywhere;
        }

        .empty-rooms {
            grid-column: 1 / -1;
            text-align: center;
            padding: 35px 15px;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            color: #64748b;
            background: #f8fafc;
        }

        /* MAP */

        .section-title {
            font-size: 19px;
            color: #173b63;
            margin: 30px 0 15px;
        }

        #map {
            width: 100%;
            height: 320px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        /* OWNER CARD */

        .side-title {
            font-size: 17px;
            color: #173b63;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .owner-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .owner-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d1fae5;
            color: #059669;
            font-weight: 700;
            font-size: 18px;
        }

        .owner-name {
            font-weight: 700;
            font-size: 14px;
        }

        .owner-label {
            color: #64748b;
            font-size: 12px;
            margin-top: 4px;
        }

        /* INQUIRY FORM */

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        textarea {
            width: 100%;
            min-height: 120px;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            resize: vertical;
        }

        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .send-button {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 7px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .send-button:hover {
            background: #1d4ed8;
        }

        .alert {
            padding: 12px;
            border-radius: 7px;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* RESPONSIVE */

        @media(max-width: 1100px) {
            .details-layout {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 900px) {
            .rooms-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 700px) {
            .sidebar {
                width: 75px;
            }

            .logo {
                padding: 20px 5px;
                height: 90px;
                text-align: center;
            }

            .logo h2 {
                font-size: 12px;
                overflow-wrap: anywhere;
            }

            .logo p {
                display: none;
            }

            .menu {
                padding: 15px 8px;
            }

            .menu a {
                justify-content: center;
                padding: 13px 5px;
                font-size: 0;
            }

            .menu a i {
                font-size: 21px;
            }

            .logout {
                left: 8px;
                right: 8px;
            }

            .logout a {
                justify-content: center;
                font-size: 0;
            }

            .logout a i {
                font-size: 21px;
            }

            .main {
                margin-left: 75px;
                width: calc(100% - 75px);
            }

            .navbar {
                left: 75px;
                padding: 0 12px;
            }

            .content {
                padding: 95px 12px 20px;
            }

            .room-details {
                grid-template-columns: 1fr;
            }

            .main-card,
            .side-card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- LEFT SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            <h2>AccomFinder</h2>
            <p>Student Portal</p>
        </div>

        <nav class="menu">

            <a href="{{ route('student.dashboard') }}">
                <i class="bi bi-house-door-fill"></i>
                Dashboard
            </a>

            <a href="{{ route('student.search') }}" class="active">
                <i class="bi bi-search"></i>
                Search
            </a>

            <a href="{{ route('student.saved') }}">
                <i class="bi bi-heart-fill"></i>
                Saved
            </a>

            <a href="{{ route('student.messages') }}">
                <i class="bi bi-chat-square-dots-fill"></i>
                Messages
            </a>

        </nav>

        <div class="logout">
            <a href="{{ route('student.logout') }}">
                <i class="bi bi-box-arrow-left"></i>
                Logout
            </a>
        </div>

    </aside>

    <!-- MAIN CONTENT -->

    <div class="main">

        <!-- TOP NAVBAR -->

        <header class="navbar">

            <div class="user-info">
                <strong>
                    {{ session('student_name', 'Student') }}
                </strong>

                <span>
                    {{ session('student_email', 'Welcome') }}
                </span>
            </div>

        </header>

        <main class="content">

            <a href="{{ route('student.search') }}" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Back to Search
            </a>

            <div class="page-heading">
                <h1>Accommodation Details</h1>
                <p>View property information and available rooms.</p>
            </div>

            <div class="details-layout">

                <!-- LEFT COLUMN -->

                <div>

                    <div class="main-card">

                        <!-- PROPERTY INFORMATION -->

                        <h2 class="property-title">
                            {{ $accommodation->name }}
                        </h2>

                        <div class="property-address">
                            <i class="bi bi-geo-alt-fill"></i>
                            {{ $accommodation->address }}
                        </div>

                        <span class="property-status
                            {{ strtolower($accommodation->status ?? '') === 'available' ? 'available' : 'occupied' }}">
                            {{ $accommodation->status ?? 'Unavailable' }}
                        </span>

                        <!-- PROPERTY DESCRIPTION ONLY -->

                        <div class="property-information">
                            <div class="property-description">
                                <strong>Description:</strong><br>
                                {{ $accommodation->description ?: 'No description available.' }}
                            </div>
                        </div>

                        <!-- ROOM TILES -->

                        <section class="rooms-section">

                            <div class="rooms-heading">

                                <h2>
                                    <i class="bi bi-door-open"></i>
                                    Rooms
                                </h2>

                                <span class="room-count">
                                    {{ $rooms->count() }} Rooms
                                </span>

                            </div>

                            <div class="rooms-grid">

                                @forelse($rooms as $room)

                                    <div class="room-card">

                                        <div class="room-header">

                                            <h3 class="room-name">
                                                {{ $room->room_name ?? 'Room' }}
                                            </h3>

                                            <span class="room-status
                                                {{ strtolower($room->status ?? '') === 'available' ? 'available' : 'occupied' }}">
                                                {{ $room->status ?? 'Unavailable' }}
                                            </span>

                                        </div>

                                        <div class="room-price">
                                            ₱{{ number_format((float) $room->price, 2) }}
                                            <small>/ month</small>
                                        </div>

                                        <div class="room-details">

                                            <p>
                                                <i class="bi bi-people"></i>
                                                <strong>Capacity:</strong>
                                                {{ $room->capacity ?? 1 }} person(s)
                                            </p>

                                            <p>
                                                <i class="bi bi-droplet"></i>
                                                <strong>Bathrooms:</strong>
                                                {{ $room->bathrooms ?? 0 }}
                                            </p>

                                        </div>

                                        @if($room->description)

                                            <div class="room-description">
                                                <strong>Description:</strong><br>
                                                {{ $room->description }}
                                            </div>

                                        @endif

                                        <div class="room-amenities">

                                            <strong>
                                                <i class="bi bi-check-circle"></i>
                                                Amenities:
                                            </strong>

                                            @if(is_array($room->amenities))
                                                {{ implode(', ', $room->amenities) ?: 'None' }}
                                            @elseif(is_string($room->amenities))
                                                {{ $room->amenities ?: 'None' }}
                                            @else
                                                None
                                            @endif

                                        </div>

                                    </div>

                                @empty

                                    <div class="empty-rooms">
                                        <i class="bi bi-door-closed"
                                           style="font-size: 30px;"></i>

                                        <p>
                                            No rooms have been added to this property yet.
                                        </p>
                                    </div>

                                @endforelse

                            </div>

                        </section>

                        <!-- LOCATION MAP -->

                        <h2 class="section-title">
                            <i class="bi bi-geo-alt"></i>
                            Location Map
                        </h2>

                        @if($accommodation->latitude !== null && $accommodation->longitude !== null)

                            <div id="map"></div>

                        @else

                            <div class="empty-rooms">
                                <i class="bi bi-map"></i>
                                <p>Location coordinates are not available.</p>
                            </div>

                        @endif

                    </div>

                </div>

                <!-- RIGHT COLUMN -->

                <div>

                    <!-- PROPERTY OWNER -->

                    <div class="side-card">

                        <h3 class="side-title">
                            Property Owner
                        </h3>

                        <div class="owner-profile">

                            <div class="owner-avatar">
                                O
                            </div>

                            <div>
                                <div class="owner-name">
                                    Owner
                                </div>

                                <div class="owner-label">
                                    Property Owner
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- SEND INQUIRY -->

                    <div class="side-card">

                        <h3 class="side-title">
                            Send Inquiry
                        </h3>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-error">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())

                            <div class="alert alert-error">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>

                        @endif

                        <form
                            action="{{ route('student.inquiry.store', $accommodation->id) }}"
                            method="POST"
                        >

                            @csrf

                            <label for="message" class="form-label">
                                Message
                            </label>

                            <textarea
                                name="message"
                                id="message"
                                placeholder="Hi, I'm interested in this property..."
                                required>{{ old('message') }}</textarea>

                            <button type="submit" class="send-button">
                                <i class="bi bi-send-fill"></i>
                                Send Inquiry
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </main>

    </div>

    <!-- MAP SCRIPT -->

    @if($accommodation->latitude !== null && $accommodation->longitude !== null)

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const latitude = Number(@json($accommodation->latitude));
                const longitude = Number(@json($accommodation->longitude));

                if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) {
                    return;
                }

                const map = L.map('map').setView(
                    [latitude, longitude],
                    17
                );

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(map);

                L.marker([latitude, longitude])
                    .addTo(map)
                    .bindPopup(
                        @json($accommodation->name . ' - ' . $accommodation->address)
                    )
                    .openPopup();

            });
        </script>

    @endif

</body>
</html>
