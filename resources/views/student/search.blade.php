<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Search Accommodation | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

        /* SIDEBAR */

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
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
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
            display: block;
            padding: 12px 15px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

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

        /* CONTENT */

        .content {
            padding: 100px 30px 30px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin-bottom: 5px;
            color: #173b63;
            font-size: 36px;
        }

        .page-title p {
            color: #777;
            font-size: 16px;
        }

        /* SEARCH */

        .search-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid #e1e5ea;
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 145px;
            gap: 15px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #d5dbe1;
            border-radius: 7px;
            background: white;
            font-size: 13px;
        }

        .search-button {
            width: 100%;
            height: 42px;
            background: #1264e8;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        /* RESULTS */

        .results-title {
            margin-bottom: 18px;
            color: #173b63;
            font-size: 21px;
            font-weight: 500;
        }

        .listings-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            align-items: start;
        }

        .property-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e1e5ea;
            box-shadow: 0 2px 5px rgba(0,0,0,.06);
            min-width: 0;
        }

        .property-image,
        .default-image {
            width: 100%;
            height: 190px;
        }

        .property-image {
            object-fit: cover;
            display: block;
        }

        .default-image {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaf0f8;
            font-size: 55px;
        }

        .property-body {
            padding: 15px;
        }

        .badge-available,
        .badge-occupied {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            font-size: 11px;
        }

        .badge-available {
            background: #1cc88a;
            color: white;
        }

        .badge-occupied {
            background: #e74a3b;
            color: white;
        }

        .property-title {
            margin-top: 12px;
            margin-bottom: 7px;
            font-size: 17px;
            color: #173b63;
        }

        .location {
            color: #666;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .property-type {
            display: inline-block;
            background: #eef2ff;
            color: #3156a6;
            padding: 5px 9px;
            border-radius: 5px;
            font-size: 11px;
        }

        /* ACTIONS */

        .listing-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
        }

        .save-button {
            width: 42px;
            height: 40px;
            border: 1px solid #0d6efd;
            background: white;
            color: #0d6efd;
            border-radius: 6px;
            font-size: 21px;
            cursor: pointer;
        }

        .save-button:hover {
            background: #eff6ff;
        }

        .details-button {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            padding: 11px;
            border-radius: 6px;
            font-size: 13px;
        }

        .details-button:hover {
            background: #0b5ed7;
            color: white;
        }

        /* ALERTS */

        .success-message,
        .error-message {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: #d1e7dd;
            color: #0f5132;
        }

        .error-message {
            background: #f8d7da;
            color: #842029;
        }

        .empty-box {
            background: white;
            border: 1px solid #e1e5ea;
            border-radius: 10px;
            padding: 50px 20px;
            text-align: center;
            color: #777;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .search-form {
                grid-template-columns: 2fr 1fr 1fr;
            }

            .listings-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .listings-grid {
                grid-template-columns: 1fr;
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
            }

            .content {
                padding: 25px 15px;
            }

            .search-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <h2>AccomFinder</h2>
            <p>Student Portal</p>
        </div>

        <div class="menu">

            <a href="{{ route('student.dashboard') }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('student.search') }}" class="active">
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

    <!-- MAIN -->

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

            <div class="page-title">
                <h1>Search Accommodation</h1>
                <p>Find your perfect student home</p>
            </div>

            <!-- SEARCH FORM -->

            <div class="search-box">

                <form method="GET" action="{{ route('student.search') }}">

                    <div class="search-form">

                        <div class="form-group">
                            <label>Search</label>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Location or property title"
                                value="{{ request('search') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label>Price</label>

                            <select name="price" class="form-select">
                                <option value="">All Prices</option>

                                <option value="Below 2000"
                                    {{ request('price') == 'Below 2000' ? 'selected' : '' }}>
                                    Below ₱2,000
                                </option>

                                <option value="2000-5000"
                                    {{ request('price') == '2000-5000' ? 'selected' : '' }}>
                                    ₱2,000 - ₱5,000
                                </option>

                                <option value="Above 5000"
                                    {{ request('price') == 'Above 5000' ? 'selected' : '' }}>
                                    Above ₱5,000
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Type</label>

                            <select name="type" class="form-select">
                                <option value="">All Types</option>

                                <option value="Apartment"
                                    {{ request('type') == 'Apartment' ? 'selected' : '' }}>
                                    Apartment
                                </option>

                                <option value="Boarding House"
                                    {{ request('type') == 'Boarding House' ? 'selected' : '' }}>
                                    Boarding House
                                </option>

                                <option value="House"
                                    {{ request('type') == 'House' ? 'selected' : '' }}>
                                    House
                                </option>

                                <option value="Dormitory"
                                    {{ request('type') == 'Dormitory' ? 'selected' : '' }}>
                                    Dormitory
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Availability</label>

                            <select name="availability" class="form-select">
                                <option value="">All</option>

                                <option value="Available"
                                    {{ request('availability') == 'Available' ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="Occupied"
                                    {{ request('availability') == 'Occupied' ? 'selected' : '' }}>
                                    Occupied
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="search-button">
                                🔍 Search
                            </button>
                        </div>

                    </div>

                </form>

            </div>

            <!-- RESULTS -->

            <h2 class="results-title">
                Found {{ $listings->count() }} Properties
            </h2>

            @if($listings->count() > 0)

                <div class="listings-grid">

                    @foreach($listings as $listing)

                        <div class="property-card">

                            <!-- PROPERTY IMAGE -->

                            @if($listing->image)

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

                                <!-- PROPERTY STATUS -->

                                @if($listing->status === 'Available')

                                    <span class="badge-available">
                                        Available
                                    </span>

                                @else

                                    <span class="badge-occupied">
                                        {{ $listing->status ?? 'Unavailable' }}
                                    </span>

                                @endif

                                <!-- PROPERTY NAME -->

                                <h3 class="property-title">
                                    {{ $listing->name }}
                                </h3>

                                <!-- LOCATION -->

                                <p class="location">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    {{ $listing->address }}
                                </p>

                                <!-- PROPERTY TYPE -->

                                @if($listing->type)

                                    <span class="property-type">
                                        {{ $listing->type }}
                                    </span>

                                @endif

                                <!-- ACTION BUTTONS -->

                                <div class="listing-actions">

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
                                            <i class="bi bi-heart"></i>
                                        </button>

                                    </form>

                                    <a
                                        href="{{ route('student.accommodation.show', $listing->id) }}"
                                        class="details-button"
                                    >
                                        <i class="bi bi-eye"></i>
                                        View Details
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-box">
                    <h4>No accommodations found</h4>

                    <p>
                        There are currently no accommodations matching your search.
                    </p>
                </div>

            @endif

        </div>

    </div>

</body>
</html>
