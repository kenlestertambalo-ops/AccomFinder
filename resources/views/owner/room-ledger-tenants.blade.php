<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Rental Ledger | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

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

        .logo h2 span {
            color: #193e67;
        }

        .logo small {
            color: #66758a;
            font-size: 14px;
            font-weight: 600;
        }

        .menu {
            padding: 38px 5px;
        }

        .menu a,
        .bottom a {
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

        .menu a:hover,
        .menu a.active {
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

        .owner-name {
            font-weight: 600;
        }

        .main {
            padding: 35px 30px 50px;
        }

        .back-link {
            color: #14945f;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 34px;
            font-weight: 600;
            color: #17395f;
        }

        .page-title p {
            margin-top: 8px;
            color: #718096;
        }

        .room-info {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px 24px;
            margin-top: 25px;
        }

        .room-info h5 {
            color: #17395f;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .room-info p {
            color: #718096;
            margin-bottom: 5px;
        }

        .section-heading {
            margin-top: 32px;
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .section-heading h4 {
            margin: 0;
            color: #17395f;
            font-weight: 600;
        }

        .tenant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 22px;
        }

        .tenant-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 3px 10px rgba(0,0,0,.035);
            transition: .2s;
        }

        .tenant-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0,0,0,.07);
        }

        .tenant-icon {
            width: 55px;
            height: 55px;
            background: #e1f8ed;
            color: #14945f;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 17px;
        }

        .tenant-card h5 {
            color: #17395f;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .tenant-detail {
            color: #718096;
            font-size: 14px;
            margin: 9px 0;
        }

        .tenant-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin: 12px 0 18px;
        }

        .status-active {
            background: #d9f7e8;
            color: #168451;
        }

        .status-inactive {
            background: #fee2e2;
            color: #b42318;
        }

        .ledger-button {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: center;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            font-weight: 600;
            transition: .2s;
        }

        .ledger-button:hover {
            background: #1d4ed8;
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

        .empty-state p {
            color: #718096;
        }

        @media(max-width: 850px) {
            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
            }
        }

        @media(max-width: 650px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
            }

            .main {
                padding: 25px 18px;
            }

            .page-title h1 {
                font-size: 27px;
            }
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

        <!-- BACK BUTTON -->
        <a
            href="{{ route('owner.tenants.rooms', $property->id) }}"
            class="back-link"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Rooms
        </a>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h1>
                <i class="bi bi-journal-text me-2"></i>
                Room Rental Ledger
            </h1>

            <p>
                Select a tenant to view their individual rental ledger.
            </p>
        </div>

        <!-- ROOM INFORMATION -->
        <div class="room-info">

            <h5>
                <i class="bi bi-door-closed me-2"></i>
                {{ $roomRecord->room_name }}
            </h5>

            <p>
                <i class="bi bi-building me-2"></i>
                Property: {{ $property->name }}
            </p>

            <p>
                <i class="bi bi-geo-alt me-2"></i>
                {{ $property->address }}
            </p>

            <p>
                <i class="bi bi-currency-peso me-2"></i>
                Room Monthly Rent: ₱{{ number_format((float) $roomRecord->price, 2) }}
            </p>

            <p>
                <i class="bi bi-people me-2"></i>
                Occupants:
                {{ $roomRecord->current_occupants ?? 0 }}
                / {{ $roomRecord->capacity }}
            </p>

        </div>

        <!-- TENANT LIST -->
        <div class="section-heading">

            <h4>
                Tenants in this Room
            </h4>

            <span class="badge bg-primary">
                {{ $tenants->count() }} Tenant(s)
            </span>

        </div>

        @if($tenants->count() > 0)

            <div class="tenant-grid">

                @foreach($tenants as $tenant)

                    <div class="tenant-card">

                        <div class="tenant-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>

                        <h5>{{ $tenant->name }}</h5>

                        <div class="tenant-detail">
                            <i class="bi bi-envelope me-1"></i>
                            {{ $tenant->email }}
                        </div>

                        <div class="tenant-detail">
                            <i class="bi bi-telephone me-1"></i>
                            {{ $tenant->phone }}
                        </div>

                        <div class="tenant-detail">
                            <i class="bi bi-currency-peso me-1"></i>
                            Monthly Rent:
                            ₱{{ number_format((float) $tenant->monthly_rent, 2) }}
                        </div>

                        <div class="tenant-detail">
                            <i class="bi bi-calendar-event me-1"></i>
                            Due Day: {{ $tenant->due_day ?? 5 }} of every month
                        </div>

                        <div>

                            @if(strtolower($tenant->status) === 'active')

                                <span class="tenant-status status-active">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Active
                                </span>

                            @else

                                <span class="tenant-status status-inactive">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Inactive
                                </span>

                            @endif

                        </div>

                        <!-- OPEN INDIVIDUAL LEDGER -->
                        <a
                            href="{{ route('owner.tenants.ledger.show', $tenant->id) }}"
                            class="ledger-button"
                        >
                            <i class="bi bi-journal-text me-1"></i>
                            View {{ $tenant->name }}'s Ledger
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">

                <i class="bi bi-people"></i>

                <h4>No Tenants Found</h4>

                <p>
                    There are currently no tenants assigned to this room.
                </p>

                <a
                    href="{{ route('owner.tenants.room', [
                        'accommodation' => $property->id,
                        'room' => $roomRecord->id
                    ]) }}"
                    class="btn btn-success mt-3"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Manage Room Tenants
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>
