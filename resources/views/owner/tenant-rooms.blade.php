
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Rooms | AccomFinder</title>

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
            z-index: 10;
        }

        .owner-name { font-weight: 600; }

        .main { padding: 35px 30px 50px; }

        .back-link {
            color: #14945f;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 36px;
            font-weight: 600;
        }

        .page-title p {
            margin-top: 8px;
            color: #718096;
        }

        .property-info {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px 24px;
            margin-top: 25px;
        }

        .property-info h5 {
            color: #17395f;
            font-weight: 600;
        }

        .property-info p {
            color: #718096;
            margin-bottom: 0;
        }

        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 22px;
            margin-top: 25px;
        }

        .room-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 3px 10px rgba(0,0,0,.035);
            transition: .2s;
        }

        .room-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0,0,0,.07);
        }

        .room-icon {
            width: 52px;
            height: 52px;
            border-radius: 13px;
            background: #e1f8ed;
            color: #14945f;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .room-card h4 {
            color: #17395f;
            font-weight: 600;
        }

        .room-detail {
            color: #718096;
            font-size: 14px;
            margin: 8px 0;
        }

        .room-status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 600;
            margin: 12px 0 18px;
        }

        .available {
            background: #d9f7e8;
            color: #168451;
        }

        .occupied {
            background: #fff0d8;
            color: #a56508;
        }

        .maintenance {
            background: #fee2e2;
            color: #b42318;
        }

        .room-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .view-tenants {
            display: block;
            width: 100%;
            text-align: center;
            padding: 12px;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            font-weight: 600;
            transition: .2s;
            background: #14945f;
        }

        .view-tenants:hover {
            background: #0d7e50;
            color: white;
        }

        .empty-state {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            text-align: center;
            padding: 65px 20px;
            margin-top: 25px;
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

<!-- SIDEBAR -->
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

<!-- MAIN CONTENT -->
<div class="content">

    <div class="topbar">
        <div class="owner-name">
            {{ session('owner_name', 'Owner') }}
        </div>
    </div>

    <div class="main">

        <a href="{{ route('owner.tenants') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Properties
        </a>

        <div class="page-title">
            <h1>{{ $property->name }} - Rooms</h1>
            <p>Select a room to view its tenants and assign ledger access.</p>
        </div>

        <div class="property-info">
            <h5>
                <i class="bi bi-geo-alt me-2"></i>
                {{ $property->address }}
            </h5>

            <p>Property Type: {{ $property->type ?? 'N/A' }}</p>
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

        @if($rooms->count() > 0)

            <div class="room-grid">

                @foreach($rooms as $room)

                    <div class="room-card">

                        <div class="room-icon">
                            <i class="bi bi-door-closed"></i>
                        </div>

                        <h4>{{ $room->room_name }}</h4>

                        <div class="room-detail">
                            <i class="bi bi-currency-peso me-1"></i>
                            Monthly Rent:
                            ₱{{ number_format((float) $room->price, 2) }}
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-people me-1"></i>
                            Occupants:
                            {{ $room->current_occupants ?? 0 }}
                            / {{ $room->capacity }}
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-person-check me-1"></i>
                            Registered Tenants:
                            {{ $room->tenants_count ?? 0 }}
                        </div>

                        @php
                            $statusClass = match(strtolower($room->status ?? '')) {
                                'available' => 'available',
                                'occupied' => 'occupied',
                                'maintenance' => 'maintenance',
                                default => 'occupied'
                            };
                        @endphp

                        <div>
                            <span class="room-status {{ $statusClass }}">
                                {{ $room->status }}
                            </span>
                        </div>

                        <div class="room-actions">

                            <!-- VIEW TENANTS ONLY -->
                            <a
                                href="{{ route('owner.tenants.room', [
                                    'accommodation' => $property->id,
                                    'room' => $room->id
                                ]) }}"
                                class="view-tenants"
                            >
                                <i class="bi bi-people me-1"></i>
                                View Tenants
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">
                <i class="bi bi-door-closed"></i>

                <h4>No Rooms Found</h4>

                <p>
                    This property does not have any rooms registered yet.
                </p>

                <a
                    href="{{ route('owner.rooms.create', $property->id) }}"
                    class="btn btn-success mt-3"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Add Rooms
                </a>
            </div>

        @endif

    </div>

</div>

</body>
</html>
