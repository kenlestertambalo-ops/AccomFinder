<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Management | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f5f8fc;
            font-family: Arial, Helvetica, sans-serif;
            color: #132238;
        }

        .sidebar {
            width: 264px;
            height: 100vh;
            background: white;
            border-right: 1px solid #dce3eb;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
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
        }

        .logo h2 span { color: #193e67; }

        .logo small {
            display: block;
            color: #66758a;
            font-size: 14px;
            font-weight: 600;
        }

        .menu { padding: 38px 5px; }

        .menu a, .bottom a {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            padding: 14px 26px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 16px;
        }

        .menu a:hover, .menu a.active {
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
        }

        .content {
            margin-left: 264px;
            min-height: 100vh;
        }

        .topbar {
            height: 74px;
            background: white;
            border-bottom: 1px solid #dce3eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .owner-name {
            font-size: 16px;
            font-weight: 600;
        }

        .main {
            padding: 35px 30px 50px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 36px;
            font-weight: 600;
        }

        .page-title p {
            margin-top: 8px;
            color: #718096;
            font-size: 16px;
        }

        .property-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 22px;
            margin-top: 30px;
        }

        .property-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,.035);
            transition: .2s;
        }

        .property-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0,0,0,.07);
        }

        .property-icon {
            width: 55px;
            height: 55px;
            border-radius: 13px;
            background: #e1f8ed;
            color: #14945f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 18px;
        }

        .property-card h4 {
            color: #17395f;
            font-size: 21px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .property-address {
            color: #718096;
            font-size: 14px;
            min-height: 40px;
        }

        .room-count {
            display: inline-block;
            background: #edf6ff;
            color: #1769a8;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin: 14px 0 20px;
        }

        .view-rooms {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            background: #14945f;
            color: white;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
        }

        .view-rooms:hover {
            background: #0d7e50;
            color: white;
        }

        .empty-state {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            text-align: center;
            padding: 65px 20px;
            margin-top: 30px;
        }

        .empty-state i {
            font-size: 55px;
            color: #b9c7d8;
        }

        .empty-state h4 {
            margin-top: 15px;
            color: #243b56;
        }

        .empty-state p { color: #718096; }

        @media(max-width: 850px) {
            .sidebar { width: 220px; }
            .content { margin-left: 220px; }
        }

        @media(max-width: 650px) {
            .sidebar { display: none; }
            .content { margin-left: 0; }
            .main { padding: 25px 18px; }
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

        <a href="{{ route('owner.listings') }}">
            <span class="menu-icon"><i class="bi bi-buildings"></i></span>
            Listings
        </a>

        <a href="{{ route('owner.tenants') }}" class="active">
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
            <span class="menu-icon"><i class="bi bi-box-arrow-right"></i></span>
            Logout
        </a>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <div class="owner-name">
            {{ session('owner_name', 'Owner') }}
        </div>
    </div>

    <div class="main">

        <div class="page-title">
            <h1>Tenant Management</h1>
            <p>Select a property to view and manage its rooms and tenants.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-4">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif

        @if($properties->count() > 0)

            <div class="property-grid">

                @foreach($properties as $property)

                    <div class="property-card">

                        <div class="property-icon">
                            <i class="bi bi-buildings"></i>
                        </div>

                        <h4>{{ $property->name }}</h4>

                        <div class="property-address">
                            <i class="bi bi-geo-alt me-1"></i>
                            {{ $property->address }}
                        </div>

                        <div class="room-count">
                            <i class="bi bi-door-open me-1"></i>
                            {{ $property->room_records_count }}
                            {{ $property->room_records_count == 1 ? 'Room' : 'Rooms' }}
                        </div>

                        <a
                            href="{{ route('owner.tenants.rooms', $property->id) }}"
                            class="view-rooms"
                        >
                            View Rooms
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">
                <i class="bi bi-buildings"></i>
                <h4>No Properties Found</h4>
                <p>Add a property listing before managing its tenants.</p>

                <a href="{{ route('owner.listings') }}" class="btn btn-success mt-3">
                    Go to Listings
                </a>
            </div>

        @endif

    </div>
</div>

</body>
</html>
