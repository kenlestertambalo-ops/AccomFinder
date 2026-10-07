<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Saved Properties | AccomFinder</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

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
        }

        body {
            background: #f5f7fb;
            color: #333;
        }

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
            transition: .2s;
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

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background: #f5f7fb;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 70px;
            background: #ffffff;
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
            align-items: flex-start;
        }

        .user-info strong {
            font-size: 20px;
            color: #111;
        }

        .user-info span {
            margin-top: 3px;
            font-size: 17px;
            color: #111;
        }

        .content {
            padding: 110px 40px 40px;
        }

        .page-title {
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 44px;
            color: #111;
            margin-bottom: 5px;
        }

        .page-title p {
            color: #777;
            font-size: 21px;
        }

        .saved-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .property-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e1e5ea;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .07);
        }

        .property-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .no-image {
            width: 100%;
            height: 220px;
            background: #eaf0f8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }

        .property-body {
            padding: 20px;
        }

        .property-title {
            color: #173b63;
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .location {
            color: #666;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .availability {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .available {
            background: #1cc88a;
        }

        .unavailable {
            background: #e74a3b;
        }

        .price {
            color: #2563eb;
            font-size: 23px;
            font-weight: 700;
            margin-top: 10px;
        }

        .price-label {
            color: #777;
            font-size: 12px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .details-button {
            display: inline-block;
            padding: 9px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .details-button:hover {
            background: #1d4ed8;
        }

        .remove-button {
            background: none;
            border: none;
            color: #e74a3b;
            cursor: pointer;
            font-size: 14px;
        }

        .empty-box {
            background: white;
            border-radius: 12px;
            border: 1px solid #e1e5ea;
            padding: 70px 30px;
            text-align: center;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .05);
        }

        .empty-box .heart {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .empty-box h2 {
            color: #173b63;
            margin-bottom: 10px;
        }

        .empty-box p {
            color: #777;
            margin-bottom: 20px;
        }

        .search-button {
            display: inline-block;
            padding: 11px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .search-button:hover {
            background: #1d4ed8;
            color: white;
        }

        .details-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .60);
            z-index: 3000;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .details-overlay.show {
            display: flex;
        }

        .details-window {
            width: min(1100px, 96vw);
            max-height: 92vh;
            background: #f8fafc;
            border-radius: 16px;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .30);
            position: relative;
            animation: detailsOpen .2s ease-out;
        }

        @keyframes detailsOpen {
            from {
                opacity: 0;
                transform: scale(.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .details-header {
            position: sticky;
            top: 0;
            background: white;
            border-bottom: 1px solid #eee;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 50;
        }

        .details-header h2 {
            color: #173b63;
            font-size: 24px;
        }

        .close-details {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            background: #f1f5f9;
            color: #333;
            font-size: 24px;
            cursor: pointer;
        }

        .close-details:hover {
            background: #e2e8f0;
        }

        .details-content {
            padding: 25px;
        }

        .details-main-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .details-card {
            background: white;
            border-radius: 10px;
            border: 1px solid #dbe3ec;
            padding: 20px;
        }

        .details-title {
            font-size: 28px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .details-address {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .details-price {
            color: #0f766e;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .details-status {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: bold;
        }

        .details-info-row {
            margin-top: 15px;
        }

        .details-info-item {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .details-info-item strong {
            color: #1e293b;
        }

        .details-amenity {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .map-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: bold;
        }

        .property-map {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            border: 1px solid #dbe3ec;
        }

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

        .owner-card {
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

        .inquiry-card {
            background: white;
            border: 1px solid #dbe3ec;
            border-radius: 10px;
            padding: 18px;
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
            box-shadow: 0 0 0 2px rgba(37, 99, 235, .1);
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

        body.modal-open {
            overflow: hidden;
        }

        @media (max-width: 1100px) {
            .saved-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .details-main-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 800px) {
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
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .navbar {
                position: relative;
                left: 0;
            }

            .content {
                padding: 30px 20px;
            }

            .saved-grid {
                grid-template-columns: 1fr;
            }

            .details-overlay {
                padding: 10px;
            }

            .details-content {
                padding: 15px;
            }

            .details-window {
                max-height: 95vh;
            }

            .property-map {
                height: 300px;
            }

            .landmark-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="logo">
            <h2>AccomFinder</h2>
            <p>Student Portal</p>
        </div>

        <div class="menu">

            <a href="{{ route('student.dashboard') }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('student.search') }}">
                🔍 Search
            </a>

            <a
                href="{{ route('student.saved') }}"
                class="active"
            >
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

    <div class="main">

        <div class="navbar">

            <div class="user-info">

                <strong>
                    {{ session('student_name', 'Student') }}
                </strong>

                <span>
                    {{ session('student_email', 'Welcome') }}
                </span>

            </div>

        </div>

        <div class="content">

            <div class="page-title">

                <h1>
                    Saved Properties
                </h1>

                <p>
                    Your saved accommodation listings
                </p>

            </div>

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

            @if(isset($savedProperties) && count($savedProperties) > 0)

                <div class="saved-grid">

                    @foreach($savedProperties as $listing)

                        <div class="property-card">

                            @if(!empty($listing->image))

                                <img
                                    src="{{ asset('storage/' . $listing->image) }}"
                                    class="property-image"
                                    alt="{{ $listing->name }}"
                                >

                            @else

                                <div class="no-image">
                                    🏠
                                </div>

                            @endif

                            <div class="property-body">

                                @if(strtolower($listing->status ?? '') === 'available')

                                    <span class="availability available">
                                        Available
                                    </span>

                                @else

                                    <span class="availability unavailable">
                                        {{ $listing->status ?? 'Unavailable' }}
                                    </span>

                                @endif

                                <h3 class="property-title">
                                    {{ $listing->name }}
                                </h3>

                                <p class="location">
                                    📍 {{ $listing->address }}
                                </p>

                                @if(!empty($listing->type))

                                    <p style="color:#666; font-size:14px;">
                                        Type:
                                        {{ $listing->type }}
                                    </p>

                                @endif

                                <div class="price">
                                    ₱{{ number_format($listing->price, 2) }}
                                </div>

                                <div class="price-label">
                                    per month
                                </div>

                                <div class="card-footer">

                                    <button
                                        type="button"
                                        class="details-button"
                                        onclick="openDetails({{ $listing->id }})"
                                    >
                                        View Details
                                    </button>

                                    <form
                                        action="{{ route('student.saved.remove', $listing->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="remove-button"
                                        >
                                            ❤ Remove
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div
                            class="details-overlay"
                            id="details-{{ $listing->id }}"
                            onclick="closeDetailsOutside(event, {{ $listing->id }})"
                        >

                            <div
                                class="details-window"
                                onclick="event.stopPropagation()"
                            >

                                <div class="details-header">

                                    <h2>
                                        Accommodation Details
                                    </h2>

                                    <button
                                        type="button"
                                        class="close-details"
                                        onclick="closeDetails({{ $listing->id }})"
                                    >
                                        ×
                                    </button>

                                </div>

                                <div class="details-content">

                                    <div class="details-main-layout">

                                        <div class="details-card">

                                            <h1 class="details-title">
                                                {{ $listing->name }}
                                            </h1>

                                            <p class="details-address">
                                                📍 {{ $listing->address }}
                                            </p>

                                            <div class="details-price">
                                                ₱{{ number_format($listing->price, 2) }}
                                            </div>

                                            <span class="details-status">
                                                {{ $listing->status ?? 'Available' }}
                                            </span>

                                            <hr>

                                            <div class="row details-info-row">

                                                <div class="col-md-6">

                                                    <div class="details-info-item">
                                                        <strong>
                                                            Property Type:
                                                        </strong>

                                                        {{ $listing->type ?? 'Not specified' }}
                                                    </div>

                                                    <div class="details-info-item">
                                                        <strong>
                                                            Bedrooms:
                                                        </strong>

                                                        {{ $listing->bedrooms ?? 'Not specified' }}
                                                    </div>

                                                    <div class="details-info-item">
                                                        <strong>
                                                            Bathrooms:
                                                        </strong>

                                                        {{ $listing->bathrooms ?? 'Not specified' }}
                                                    </div>

                                                    <div class="details-info-item">
                                                        <strong>
                                                            Capacity:
                                                        </strong>

                                                        {{ $listing->capacity ?? 'Not specified' }}
                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="details-info-item">
                                                        <strong>
                                                            Description:
                                                        </strong>

                                                        {{ $listing->description ?? 'No description available.' }}
                                                    </div>

                                                </div>

                                            </div>

                                            @if($listing->amenities)

                                                <hr>

                                                <h5>
                                                    Amenities
                                                </h5>

                                                @php
                                                    $amenities = is_array($listing->amenities)
                                                        ? $listing->amenities
                                                        : json_decode($listing->amenities, true);
                                                @endphp

                                                @if($amenities)

                                                    @foreach($amenities as $amenity)

                                                        <span class="badge bg-primary details-amenity">
                                                            {{ $amenity }}
                                                        </span>

                                                    @endforeach

                                                @endif

                                            @endif

                                            <div class="map-title">
                                                Location Map
                                            </div>

                                            <div
                                                id="map-{{ $listing->id }}"
                                                class="property-map"
                                            ></div>

                                            <div class="landmarks-section">

                                                <h3 class="landmarks-title">
                                                    <i class="bi bi-pin-map-fill"></i>
                                                    Nearby Landmarks
                                                </h3>

                                                <p class="landmarks-help">
                                                    Find schools, malls, banks, and convenience stores within 1 kilometer of this property.
                                                </p>

                                                <div
                                                    id="landmarkLoading-{{ $listing->id }}"
                                                    class="landmark-loading"
                                                >
                                                    <i class="bi bi-arrow-repeat"></i>
                                                    Finding nearby places...
                                                </div>

                                                <div
                                                    id="landmarkMessage-{{ $listing->id }}"
                                                    class="landmark-message"
                                                >
                                                    Searching for nearby places...
                                                </div>

                                                <div
                                                    id="schoolCategory-{{ $listing->id }}"
                                                    class="landmark-category"
                                                    style="display:none;"
                                                >

                                                    <div class="category-title">
                                                        <i class="bi bi-mortarboard-fill"></i>
                                                        Schools & Universities
                                                    </div>

                                                    <div
                                                        id="schoolList-{{ $listing->id }}"
                                                        class="landmark-list"
                                                    ></div>

                                                </div>

                                                <div
                                                    id="mallCategory-{{ $listing->id }}"
                                                    class="landmark-category"
                                                    style="display:none;"
                                                >

                                                    <div class="category-title">
                                                        <i class="bi bi-bag-fill"></i>
                                                        Malls & Shopping
                                                    </div>

                                                    <div
                                                        id="mallList-{{ $listing->id }}"
                                                        class="landmark-list"
                                                    ></div>

                                                </div>

                                                <div
                                                    id="bankCategory-{{ $listing->id }}"
                                                    class="landmark-category"
                                                    style="display:none;"
                                                >

                                                    <div class="category-title">
                                                        <i class="bi bi-bank2"></i>
                                                        Banks & ATMs
                                                    </div>

                                                    <div
                                                        id="bankList-{{ $listing->id }}"
                                                        class="landmark-list"
                                                    ></div>

                                                </div>

                                                <div
                                                    id="convenienceCategory-{{ $listing->id }}"
                                                    class="landmark-category"
                                                    style="display:none;"
                                                >

                                                    <div class="category-title">
                                                        <i class="bi bi-shop"></i>
                                                        Convenience Stores
                                                    </div>

                                                    <div
                                                        id="convenienceList-{{ $listing->id }}"
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
                                                            @if($listing->owner)
                                                                {{ $listing->owner->name }}
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
                                                    action="{{ route('student.inquiry.store', $listing->id) }}"
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

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-box">

                    <div class="heart">
                        ❤
                    </div>

                    <h2>
                        No Saved Properties
                    </h2>

                    <p>
                        You haven't saved any accommodations yet.
                    </p>

                    <a
                        href="{{ route('student.search') }}"
                        class="search-button"
                    >
                        🔍 Search Accommodations
                    </a>

                </div>

            @endif

        </div>

    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const savedMaps = {};

        const savedLandmarksLoaded = {};

        function openDetails(id) {
            const modal = document.getElementById('details-' + id);

            if (!modal) {
                return;
            }

            modal.classList.add('show');

            document.body.classList.add('modal-open');

            setTimeout(function() {
                initializeSavedMap(id);
            }, 150);
        }

        function closeDetails(id) {
            const modal = document.getElementById('details-' + id);

            if (modal) {
                modal.classList.remove('show');
            }

            document.body.classList.remove('modal-open');
        }

        function closeDetailsOutside(event, id) {
            if (event.target === event.currentTarget) {
                closeDetails(id);
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document
                    .querySelectorAll('.details-overlay.show')
                    .forEach(function(modal) {
                        modal.classList.remove('show');
                    });

                document.body.classList.remove('modal-open');
            }
        });

        function escapeHtml(text) {
            const div = document.createElement('div');

            div.textContent = text;

            return div.innerHTML;
        }

        function calculateDistance(
            latitude1,
            longitude1,
            latitude2,
            longitude2
        ) {
            const earthRadius = 6371000;

            const lat1 = latitude1 * Math.PI / 180;
            const lat2 = latitude2 * Math.PI / 180;

            const differenceLatitude =
                (latitude2 - latitude1) * Math.PI / 180;

            const differenceLongitude =
                (longitude2 - longitude1) * Math.PI / 180;

            const a =
                Math.sin(differenceLatitude / 2) ** 2 +
                Math.cos(lat1) *
                Math.cos(lat2) *
                Math.sin(differenceLongitude / 2) ** 2;

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

            return (distance / 1000).toFixed(1) + ' km';
        }

        function getCoordinates(element) {
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

        function getLandmarkCategory(tags) {
            const amenity = tags.amenity || '';
            const shop = tags.shop || '';
            const education = tags.education || '';

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

            if (shop === 'mall') {
                return 'mall';
            }

            if (
                amenity === 'bank' ||
                amenity === 'atm'
            ) {
                return 'bank';
            }

            if (shop === 'convenience') {
                return 'convenience';
            }

            return null;
        }

        function getCategoryInfo(category, id) {
            if (category === 'school') {
                return {
                    listId: 'schoolList-' + id,
                    categoryId: 'schoolCategory-' + id,
                    icon: 'bi-mortarboard-fill',
                    type: 'School / University'
                };
            }

            if (category === 'mall') {
                return {
                    listId: 'mallList-' + id,
                    categoryId: 'mallCategory-' + id,
                    icon: 'bi-bag-fill',
                    type: 'Mall / Shopping'
                };
            }

            if (category === 'bank') {
                return {
                    listId: 'bankList-' + id,
                    categoryId: 'bankCategory-' + id,
                    icon: 'bi-bank2',
                    type: 'Bank / ATM'
                };
            }

            if (category === 'convenience') {
                return {
                    listId: 'convenienceList-' + id,
                    categoryId: 'convenienceCategory-' + id,
                    icon: 'bi-shop',
                    type: 'Convenience Store'
                };
            }

            return null;
        }

        function createLandmarkItem(
            landmark,
            category,
            id
        ) {
            const info = getCategoryInfo(category, id);

            const item = document.createElement('div');

            item.className = 'landmark-item';

            item.innerHTML =
                '<div class="landmark-icon">' +
                    '<i class="bi ' +
                    info.icon +
                    '"></i>' +
                '</div>' +
                '<div class="landmark-info">' +
                    '<div class="landmark-name">' +
                        escapeHtml(landmark.name) +
                    '</div>' +
                    '<div class="landmark-type">' +
                        escapeHtml(info.type) +
                    '</div>' +
                    '<div class="landmark-distance">' +
                        '<i class="bi bi-signpost-2"></i> ' +
                        formatDistance(landmark.distance) +
                    '</div>' +
                '</div>';

            return item;
        }

        function displayCategory(
            category,
            landmarks,
            id
        ) {
            const info = getCategoryInfo(category, id);

            const categoryElement =
                document.getElementById(info.categoryId);

            const list =
                document.getElementById(info.listId);

            if (!categoryElement || !list) {
                return;
            }

            list.innerHTML = '';

            categoryElement.style.display = 'block';

            if (
                !landmarks ||
                landmarks.length === 0
            ) {
                const empty =
                    document.createElement('div');

                empty.className =
                    'category-empty';

                empty.innerHTML =
                    '<i class="bi bi-info-circle"></i> ' +
                    'No mapped places found within 1 km.';

                list.appendChild(empty);

                return;
            }

            landmarks.sort(function(a, b) {
                return a.distance - b.distance;
            });

            const seen = new Set();

            const unique = [];

            landmarks.forEach(function(landmark) {
                const key =
                    landmark.name
                        .toLowerCase()
                        .trim();

                if (seen.has(key)) {
                    return;
                }

                seen.add(key);

                unique.push(landmark);
            });

            unique
                .slice(0, 5)
                .forEach(function(landmark) {

                    const item =
                        createLandmarkItem(
                            landmark,
                            category,
                            id
                        );

                    list.appendChild(item);
                });
        }

        async function searchNearbyLandmarks(
            id,
            latitude,
            longitude
        ) {
            if (savedLandmarksLoaded[id]) {
                return;
            }

            savedLandmarksLoaded[id] = true;

            const loading =
                document.getElementById(
                    'landmarkLoading-' + id
                );

            const message =
                document.getElementById(
                    'landmarkMessage-' + id
                );

            if (!loading || !message) {
                return;
            }

            loading.style.display = 'block';

            message.style.display = 'none';

            const query = `
                [out:json][timeout:25];
                (
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

                    nwr(
                        around:1000,
                        ${latitude},
                        ${longitude}
                    )["name"]["shop"="mall"];

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
                                encodeURIComponent(query)
                        }
                    );

                if (!response.ok) {
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

                elements.forEach(function(element) {

                    const coordinates =
                        getCoordinates(element);

                    if (!coordinates) {
                        return;
                    }

                    const tags =
                        element.tags || {};

                    const name =
                        tags.name || '';

                    if (!name) {
                        return;
                    }

                    const category =
                        getLandmarkCategory(tags);

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
                        name: name,
                        distance: distance,
                        tags: tags
                    });
                });

                displayCategory(
                    'school',
                    categories.school,
                    id
                );

                displayCategory(
                    'mall',
                    categories.mall,
                    id
                );

                displayCategory(
                    'bank',
                    categories.bank,
                    id
                );

                displayCategory(
                    'convenience',
                    categories.convenience,
                    id
                );

                const totalResults =
                    categories.school.length +
                    categories.mall.length +
                    categories.bank.length +
                    categories.convenience.length;

                if (totalResults === 0) {

                    message.style.display = 'block';

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

                message.style.display = 'block';

                message.innerHTML =
                    '<i class="bi bi-exclamation-circle"></i> ' +
                    'Nearby landmarks could not be loaded. ' +
                    'Please try again later.';
            }

            loading.style.display = 'none';
        }

        function initializeSavedMap(id) {
            if (savedMaps[id]) {
                savedMaps[id].invalidateSize(true);
                return;
            }

            const latitudeElement =
                document.querySelector(
                    '#details-' + id +
                    ' [data-latitude]'
                );

            const longitudeElement =
                document.querySelector(
                    '#details-' + id +
                    ' [data-longitude]'
                );

            if (!latitudeElement || !longitudeElement) {
                return;
            }

            const latitude =
                parseFloat(
                    latitudeElement.dataset.latitude
                );

            const longitude =
                parseFloat(
                    longitudeElement.dataset.longitude
                );

            if (
                isNaN(latitude) ||
                isNaN(longitude)
            ) {
                return;
            }

            const map =
                L.map(
                    'map-' + id
                ).setView(
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
                L.marker([
                    latitude,
                    longitude
                ]).addTo(map);

            const propertyName =
                latitudeElement.dataset.name || 'Property';

            const propertyAddress =
                latitudeElement.dataset.address || '';

            propertyMarker.bindPopup(
                '<strong>' +
                escapeHtml(propertyName) +
                '</strong><br>' +
                escapeHtml(propertyAddress)
            ).openPopup();

            savedMaps[id] = map;

            setTimeout(function() {
                map.invalidateSize(true);
            }, 300);

            searchNearbyLandmarks(
                id,
                latitude,
                longitude
            );
        }
    </script>

    @if(isset($savedProperties) && count($savedProperties) > 0)

        @foreach($savedProperties as $listing)

            <div
                id="saved-location-data-{{ $listing->id }}"
                data-latitude="{{ $listing->latitude }}"
                data-longitude="{{ $listing->longitude }}"
                style="display:none;"
            ></div>

        @endforeach

    @endif

    <script>
        @if(isset($savedProperties) && count($savedProperties) > 0)

            @foreach($savedProperties as $listing)

                const savedLocation{{ $listing->id }} =
                    document.getElementById(
                        'saved-location-data-{{ $listing->id }}'
                    );

                if (savedLocation{{ $listing->id }}) {

                    const modalContent{{ $listing->id }} =
                        document.querySelector(
                            '#details-{{ $listing->id }} .details-card'
                        );

                    if (modalContent{{ $listing->id }}) {

                        const mapElement{{ $listing->id }} =
                            document.getElementById(
                                'map-{{ $listing->id }}'
                            );

                        if (mapElement{{ $listing->id }}) {

                            mapElement{{ $listing->id }}.dataset.latitude =
                                savedLocation{{ $listing->id }}.dataset.latitude;

                            mapElement{{ $listing->id }}.dataset.longitude =
                                savedLocation{{ $listing->id }}.dataset.longitude;
                        }
                    }
                }

            @endforeach

        @endif
    </script>

    @if(isset($savedProperties) && count($savedProperties) > 0)

        @foreach($savedProperties as $listing)

            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const mapElement =
                        document.getElementById(
                            'map-{{ $listing->id }}'
                        );

                    if (!mapElement) {
                        return;
                    }

                    mapElement.dataset.latitude =
                        "{{ $listing->latitude ?? 6.1164 }}";

                    mapElement.dataset.longitude =
                        "{{ $listing->longitude ?? 125.1716 }}";

                    mapElement.dataset.name =
                        @json($listing->name);

                    mapElement.dataset.address =
                        @json($listing->address);

                    const originalOpenDetails =
                        window.openDetails;

                    if (!window.savedOpenDetailsReady) {

                        window.savedOpenDetailsReady = true;

                        window.openDetails =
                            function(id) {

                                const modal =
                                    document.getElementById(
                                        'details-' + id
                                    );

                                if (!modal) {
                                    return;
                                }

                                modal.classList.add('show');

                                document.body.classList.add(
                                    'modal-open'
                                );

                                setTimeout(function() {

                                    const mapBox =
                                        document.getElementById(
                                            'map-' + id
                                        );

                                    if (!mapBox) {
                                        return;
                                    }

                                    const latitude =
                                        parseFloat(
                                            mapBox.dataset.latitude
                                        );

                                    const longitude =
                                        parseFloat(
                                            mapBox.dataset.longitude
                                        );

                                    if (
                                        isNaN(latitude) ||
                                        isNaN(longitude)
                                    ) {
                                        return;
                                    }

                                    if (
                                        window.savedMaps &&
                                        window.savedMaps[id]
                                    ) {
                                        window.savedMaps[id]
                                            .invalidateSize(true);

                                        return;
                                    }

                                    const map =
                                        L.map(
                                            'map-' + id
                                        ).setView(
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

                                    const marker =
                                        L.marker([
                                            latitude,
                                            longitude
                                        ]).addTo(map);

                                    marker.bindPopup(
                                        '<strong>' +
                                        escapeHtml(
                                            mapBox.dataset.name
                                        ) +
                                        '</strong><br>' +
                                        escapeHtml(
                                            mapBox.dataset.address
                                        )
                                    ).openPopup();

                                    window.savedMaps =
                                        window.savedMaps || {};

                                    window.savedMaps[id] =
                                        map;

                                    setTimeout(function() {
                                        map.invalidateSize(true);
                                    }, 300);

                                    searchNearbyLandmarks(
                                        id,
                                        latitude,
                                        longitude
                                    );

                                }, 200);
                            };
                    }

                });
            </script>

        @endforeach

    @endif

</body>

</html>
