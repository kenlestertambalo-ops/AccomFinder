<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard | AccomFinder</title>

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


        /* LOGO */

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


        /* MENU */

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


        /* LOGOUT */

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
           FIXED TOP BAR
        ===================================================== */

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
           DASHBOARD CONTENT
        ===================================================== */

        .content {
            padding: 110px 40px 40px 40px;
        }

        .welcome-title {
            margin-bottom: 5px;
            color: #000;
            font-size: 46px;
            font-weight: 700;
        }

        .welcome-text {
            margin-bottom: 30px;
            color: #777;
            font-size: 22px;
        }


        /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

        .success-message {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 16px;
        }


        /* =====================================================
           SEARCH BOX
        ===================================================== */

        .search-box {
            background: #ffffff;
            padding: 28px;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 20px;
            margin-bottom: 35px;
        }

        .search-input {
            flex: 1;
            height: 62px;
            padding: 0 18px;
            border: 1px solid #d0d0d0;
            border-radius: 10px;
            outline: none;
            font-size: 18px;
        }

        .search-input:focus {
            border-color: #2563eb;
        }

        .search-button {
            width: 140px;
            height: 62px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .search-button:hover {
            background: #1d4ed8;
        }


        /* =====================================================
           STAT CARDS
        ===================================================== */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 35px;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            min-height: 175px;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .card h2 {
            color: #2563eb;
            font-size: 32px;
            margin: 5px 0 8px 0;
        }

        .card p {
            color: #777;
            font-size: 18px;
        }


        /* =====================================================
           BOTTOM SECTION
        ===================================================== */

        .bottom {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .panel {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            min-height: 220px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .panel h3 {
            margin-bottom: 25px;
            font-size: 24px;
            color: #111;
        }


        /* =====================================================
           RECENT SEARCHES
        ===================================================== */

        .recent {
            list-style: none;
        }

        .recent li {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            color: #666;
            font-size: 16px;
        }

        .recent li:last-child {
            border-bottom: none;
        }


        /* =====================================================
           RECOMMENDED PROPERTY
        ===================================================== */

        .property {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .property:last-child {
            border-bottom: none;
        }

        .property img {
            width: 90px;
            height: 70px;
            border-radius: 8px;
            margin-right: 15px;
            object-fit: cover;
        }

        .property h4 {
            font-size: 17px;
            margin-bottom: 5px;
        }

        .property p {
            font-size: 14px;
            color: #777;
        }

        .price {
            color: #2563eb;
            font-weight: 600;
            margin-top: 5px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .bottom {
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

            .cards {
                grid-template-columns: 1fr 1fr;
            }

        }


        @media (max-width: 650px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .navbar {
                position: relative;
                left: 0;
                height: 70px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .content {
                padding: 30px 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .search-box {
                flex-direction: column;
            }

            .search-button {
                width: 100%;
            }

            .bottom {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         FIXED SIDEBAR
    ===================================================== -->

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

            <a
                href="{{ route('student.dashboard') }}"
                class="active"
            >
                🏠 Dashboard
            </a>


            <a href="{{ route('student.search') }}">
                🔍 Search
            </a>


            <a href="{{ route('student.saved') }}">
                ❤️ Saved
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


    <!-- =====================================================
         MAIN AREA
    ===================================================== -->

    <div class="main">


        <!-- =================================================
             FIXED TOP BAR
        ================================================= -->

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


        <!-- =================================================
             DASHBOARD CONTENT
        ================================================= -->

        <div class="content">


            <!-- WELCOME -->

            <h1 class="welcome-title">

            </h1>

            <p class="welcome-text">
                Find your perfect student accommodation.
            </p>


            <!-- SUCCESS MESSAGE -->

            @if(session('success'))

                <div class="success-message">
                    {{ session('success') }}
                </div>

            @endif


            <!-- =================================================
                 SEARCH
            ================================================= -->

            <div class="search-box">

                <input
                    type="text"
                    class="search-input"
                    placeholder="Search by location, type or price"
                    id="dashboardSearch"
                >

                <button
                    type="button"
                    class="search-button"
                    onclick="searchAccommodation()"
                >
                    Search
                </button>

            </div>


            <!-- =================================================
                 STAT CARDS
            ================================================= -->

            <div class="cards">


                <!-- AVAILABLE LISTINGS -->

                <div class="card">

                    <div class="card-icon">
                        🏠
                    </div>

                    <h2>
                        {{ $availableListings ?? 0 }}
                    </h2>

                    <p>
                        Available Listings
                    </p>

                </div>


                <!-- SAVED -->

                <div class="card">

                    <div class="card-icon">
                        ❤️
                    </div>

                    <h2>
    {{ $savedPropertiesCount ?? 0 }}
</h2>

                    <p>
                        Saved Properties
                    </p>

                </div>


                <!-- LOCATIONS -->

                <div class="card">

                    <div class="card-icon">
                        📍
                    </div>

                    <h2>
                        {{ $locations ?? 0 }}
                    </h2>

                    <p>
                        Locations
                    </p>

                </div>


                <!-- PRICE RANGE -->

                <div class="card">

                    <div class="card-icon">
                        💰
                    </div>

                    <h2 style="font-size: 25px;">

                        ₱{{ number_format($minPrice ?? 1500) }}

                        -

                        ₱{{ number_format($maxPrice ?? 4500) }}

                    </h2>

                    <p>
                        Price Range
                    </p>

                </div>


            </div>


            <!-- =================================================
                 BOTTOM PANELS
            ================================================= -->

            <div class="bottom">


                <!-- RECENT SEARCHES -->

                <div class="panel">

                    <h3>
                        Recent Searches
                    </h3>


                    @if(isset($recentSearches) && count($recentSearches) > 0)

                        <ul class="recent">

                            @foreach($recentSearches as $search)

                                <li>
                                    🔍 {{ $search }}
                                </li>

                            @endforeach

                        </ul>

                    @else

                        <p style="color:#777;">
                            No recent searches yet.
                        </p>

                    @endif

                </div>


                <!-- NEW / AVAILABLE LISTINGS -->

                <div class="panel">

                    <h3>
                        New Listings
                    </h3>


                    @if(isset($approvedListings) && count($approvedListings) > 0)

                        @foreach($approvedListings as $listing)

                            <div class="property">

                                <div
                                    style="
                                        width:90px;
                                        height:70px;
                                        border-radius:8px;
                                        background:#eaf0f8;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        margin-right:15px;
                                        font-size:30px;
                                        flex-shrink:0;
                                    "
                                >
                                    🏠
                                </div>


                                <div>

                                    <h4>
                                        {{ $listing->name }}
                                    </h4>

                                    <p>
                                        📍 {{ $listing->address }}
                                    </p>

                                    <div class="price">
                                        ₱{{ number_format($listing->price, 2) }}
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <p style="color:#777;">
                            No listings available yet.
                        </p>

                    @endif


                </div>


            </div>


        </div>


    </div>


    <!-- =====================================================
         SEARCH SCRIPT
    ===================================================== -->

    <script>

        function searchAccommodation() {

            const search =
                document.getElementById('dashboardSearch').value.trim();


            if (search === '') {

                window.location.href =
                    "{{ route('student.search') }}";

                return;

            }


            window.location.href =
                "{{ route('student.search') }}" +
                "?search=" +
                encodeURIComponent(search);

        }

    </script>


</body>

</html>
