
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Saved Properties | AccomFinder</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: white;
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
            transition: .2s;
        }

        .menu a:hover {
            background: #f1f5f9;
        }

        .menu a.active {
            background: #173b82;
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
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
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
            font-size: 20px;
            color: #111;
        }

        .user-info span {
            margin-top: 3px;
            font-size: 16px;
            color: #555;
        }

        .content {
            padding: 110px 40px 40px;
        }

        .page-title {
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 40px;
            color: #111;
            margin-bottom: 5px;
        }

        .page-title p {
            color: #777;
            font-size: 19px;
        }

        .saved-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
        }

        .property-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e1e5ea;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .07);
            transition: .2s;
        }

        .property-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .10);
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
            margin: 12px 0 8px;
        }

        .location {
            color: #666;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .availability {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 15px;
            font-size: 13px;
        }

        .available {
            background: #dcfce7;
            color: #15803d;
        }

        .unavailable {
            background: #fee2e2;
            color: #b91c1c;
        }

        .price {
            color: #2563eb;
            font-size: 23px;
            font-weight: 700;
            margin-top: 12px;
        }

        .price-label {
            color: #777;
            font-size: 12px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .details-button {
            display: inline-block;
            padding: 10px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: .2s;
        }

        .details-button:hover {
            background: #1d4ed8;
            color: white;
        }

        .remove-button {
            background: none;
            border: none;
            color: #e74a3b;
            cursor: pointer;
            font-size: 14px;
        }

        .remove-button:hover {
            color: #b91c1c;
        }

        .empty-box {
            background: white;
            border-radius: 12px;
            border: 1px solid #e1e5ea;
            padding: 70px 30px;
            text-align: center;
        }

        .empty-box .heart {
            font-size: 60px;
            color: #e74a3b;
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

        .success-message,
        .error-message {
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
        }

        @media(max-width: 1100px) {
            .saved-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 750px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                width: calc(100% - 190px);
            }

            .navbar {
                left: 190px;
            }

            .content {
                padding: 100px 15px 30px;
            }

            .saved-grid {
                grid-template-columns: 1fr;
            }

            .page-title h1 {
                font-size: 30px;
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

            <a href="{{ route('student.search') }}">
                🔍 Search
            </a>

            <a href="{{ route('student.saved') }}" class="active">
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

    <!-- MAIN CONTENT -->
    <div class="main">

        <!-- NAVBAR -->
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

        <!-- PAGE CONTENT -->
        <div class="content">

            <div class="page-title">

                <h1>Saved Properties</h1>

                <p>Your saved accommodation listings</p>

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
                                        Type: {{ $listing->type }}
                                    </p>
                                @endif

                                <div class="price">
                                    ₱{{ number_format($listing->price, 2) }}
                                </div>

                                <div class="price-label">
                                    per month
                                </div>

                                <div class="card-footer">

                                    <!-- NORMAL PAGE NAVIGATION: NO MODAL -->
                                    <a
                                        href="{{ route('student.accommodation.show', $listing->id) }}"
                                        class="details-button"
                                    >
                                        View Details
                                    </a>

                                    <!-- REMOVE FROM SAVED -->
                                    <form
                                        action="{{ route('student.saved.remove', $listing->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="remove-button"
                                            onclick="return confirm('Are you sure you want to remove this property from your saved list?')"
                                        >
                                            ❤ Remove
                                        </button>

                                    </form>

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

                    <h2>No Saved Properties</h2>

                    <p>You haven't saved any accommodations yet.</p>

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

</body>
</html>
