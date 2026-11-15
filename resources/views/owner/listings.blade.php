<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Listings | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body {
            background: #f5f8fc;
            font-family: Arial, sans-serif;
            color: #132238;
            overflow: hidden;
        }

        .sidebar {
            width: 264px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #dce3eb;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
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
            letter-spacing: -1px;
        }

        .logo h2 span { color: #193e67; }

        .logo small {
            display: block;
            margin-top: -3px;
            color: #66758a;
            font-size: 14px;
            font-weight: 600;
        }

        .menu { padding: 38px 5px; }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            padding: 14px 26px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 16px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #eefaf5;
            color: #009b68;
        }

        .menu a.active {
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
            padding: 0 5px;
        }

        .bottom a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 21px;
            color: #30435c;
            text-decoration: none;
            font-size: 16px;
            border-radius: 11px;
        }

        .bottom a:hover {
            color: #dc3545;
            background: #fff5f5;
        }

        .content {
            margin-left: 264px;
            width: calc(100% - 264px);
            height: 100vh;
            overflow: hidden;
        }

        .topbar {
            width: calc(100% - 264px);
            height: 74px;
            background: #ffffff;
            border-bottom: 1px solid #dce3eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
            position: fixed;
            top: 0;
            right: 0;
            z-index: 900;
        }

        .topbar .bell {
            font-size: 23px;
            margin-right: 28px;
            color: #172334;
        }

        .owner-name {
            font-size: 16px;
            font-weight: 600;
            color: #172334;
        }

        .main {
            height: calc(100vh - 74px);
            margin-top: 74px;
            padding: 35px 24px 50px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 38px;
            font-weight: 500;
            color: #132238;
        }

        .page-header p {
            margin: 8px 0 0;
            color: #5d7089;
            font-size: 17px;
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #14945f;
            color: #ffffff;
            padding: 14px 22px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #0d7e50;
            color: #ffffff;
        }

        .success-message {
            margin-top: 25px;
            padding: 14px 18px;
            background: #dff7e9;
            border: 1px solid #b7e8ca;
            color: #167344;
            border-radius: 10px;
        }

        .error-message {
            margin-top: 20px;
            padding: 14px 18px;
            background: #fde8e8;
            border: 1px solid #f5bcbc;
            color: #b42318;
            border-radius: 10px;
        }

        .listings-container {
            margin-top: 30px;
            width: 100%;
        }

        .listings-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            width: 100%;
        }

        .listing-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: 0.2s;
        }

        .listing-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .listing-image,
        .listing-image-placeholder {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .listing-image-placeholder {
            background: #edf2f7;
            color: #a7b2bf;
            font-size: 55px;
        }

        .listing-body { padding: 22px; }

        .listing-title {
            margin: 0 0 8px;
            font-size: 21px;
            font-weight: 600;
            color: #17395f;
        }

        .listing-location {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            color: #66778c;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .listing-location i {
            color: #14945f;
            margin-top: 2px;
        }

        /* ROOM SUMMARY */
        .room-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 7px;
            margin: 16px 0;
        }

        .room-stat {
            background: #f5f8fc;
            border: 1px solid #e7edf4;
            border-radius: 9px;
            padding: 10px 5px;
            text-align: center;
        }

        .room-stat strong {
            display: block;
            font-size: 19px;
            color: #17395f;
        }

        .room-stat span {
            display: block;
            font-size: 11px;
            color: #718096;
            margin-top: 3px;
        }

        .room-stat.available strong { color: #168451; }
        .room-stat.occupied strong { color: #dc3545; }

        .listing-status { margin-top: 14px; }

        .status-available,
        .status-full {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-available {
            background: #d9f7e8;
            color: #168451;
        }

        .status-full {
            background: #fde2e2;
            color: #c73535;
        }

        .manage-rooms-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            width: 100%;
            background: #14945f;
            color: #ffffff;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-top: 18px;
            transition: 0.2s;
        }

        .manage-rooms-btn:hover {
            background: #0d7e50;
            color: #ffffff;
        }

        .listing-actions {
            display: flex;
            gap: 9px;
            margin-top: 10px;
        }

        .edit-btn {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            background: #0d6efd;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .edit-btn:hover {
            background: #0b5ed7;
            color: #ffffff;
        }

        .delete-btn {
            flex: 1;
            width: 100%;
            background: #dc3545;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        .delete-btn:hover { background: #bb2d3b; }

        .empty-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 75px 30px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .empty-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #edf2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #a7b2bf;
            font-size: 36px;
        }

        .empty-card h3 {
            margin: 0 0 8px;
            font-size: 22px;
            color: #243b56;
        }

        .empty-card p {
            margin: 0 0 24px;
            color: #718096;
            font-size: 15px;
        }

        @media (max-width: 1250px) {
            .listings-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 850px) {
            .sidebar { width: 220px; }

            .content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar { width: calc(100% - 220px); }

            .listings-grid { grid-template-columns: 1fr; }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 600px) {
            .sidebar { width: 70px; }

            .logo {
                padding: 25px 5px;
                height: 100px;
            }

            .logo h2 {
                font-size: 13px;
                letter-spacing: 0;
            }

            .logo small { font-size: 10px; }

            .menu a,
            .bottom a {
                justify-content: center;
                padding: 13px 5px;
                font-size: 0;
            }

            .menu-icon { font-size: 20px; }

            .content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .topbar { width: calc(100% - 70px); }

            .main { padding: 25px 12px; }

            .page-header h1 { font-size: 30px; }
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
                <span class="menu-icon">
                    <i class="bi bi-house-door"></i>
                </span>
                Dashboard
            </a>

            <a href="{{ route('owner.listings') }}" class="active">
                <span class="menu-icon">
                    <i class="bi bi-buildings"></i>
                </span>
                Listings
            </a>

            <a href="{{ route('owner.tenants') }}">
                <span class="menu-icon">
                    <i class="bi bi-people"></i>
                </span>
                Tenants
            </a>

            <a href="{{ route('owner.payments') }}">
                <span class="menu-icon">
                    <i class="bi bi-cash-stack"></i>
                </span>
                Payments
            </a>

            <a href="{{ route('owner.reports') }}">
                <span class="menu-icon">
                    <i class="bi bi-bar-chart"></i>
                </span>
                Reports
            </a>

            <a href="{{ route('owner.messages') }}">
                <span class="menu-icon">
                    <i class="bi bi-chat-dots"></i>
                </span>
                Messages
            </a>

        </div>

        <div class="bottom">
            <a href="{{ route('owner.logout') }}">
                <span class="menu-icon">
                    <i class="bi bi-box-arrow-right"></i>
                </span>
                Logout
            </a>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- TOP BAR -->
        <div class="topbar">
            <i class="bi bi-bell bell"></i>

            <div class="owner-name">
                {{ session('owner_name', 'Owner') }}
            </div>
        </div>

        <!-- MAIN -->
        <div class="main">

            <!-- PAGE HEADER -->
            <div class="page-header">

                <div>
                    <h1>Listings</h1>

                    <p>
                        Manage your properties and monitor their rooms.
                    </p>
                </div>

                <a href="{{ route('owner.listings.create') }}" class="add-btn">
                    <i class="bi bi-plus-lg"></i>
                    Add New Listing
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="success-message">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <strong>Please check the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- LISTINGS -->
            <div class="listings-container">

                @if($listings->count() > 0)

                    <div class="listings-grid">

                        @foreach($listings as $listing)

                            @php
                                /*
                                 * Count rooms by their current status.
                                 * Occupancy status is synchronized in OwnerController.
                                 */
                                $totalRooms = $listing->roomRecords->count();

                                $availableRooms = $listing->roomRecords
                                    ->where('status', 'Available')
                                    ->count();

                                $occupiedRooms = $listing->roomRecords
                                    ->where('status', 'Occupied')
                                    ->count();

                                $maintenanceRooms = $listing->roomRecords
                                    ->where('status', 'Maintenance')
                                    ->count();
                            @endphp

                            <div class="listing-card">

                                <!-- PROPERTY IMAGE -->
                                @if(!empty($listing->image))

                                    <img
                                        src="{{ asset('storage/' . $listing->image) }}"
                                        class="listing-image"
                                        alt="{{ $listing->name }}"
                                    >

                                @else

                                    <div class="listing-image-placeholder">
                                        <i class="bi bi-buildings"></i>
                                    </div>

                                @endif

                                <!-- CARD BODY -->
                                <div class="listing-body">

                                    <!-- PROPERTY NAME -->
                                    <h3 class="listing-title">
                                        {{ $listing->name }}
                                    </h3>

                                    <!-- LOCATION -->
                                    <div class="listing-location">
                                        <i class="bi bi-geo-alt-fill"></i>

                                        <span>
                                            {{ $listing->address }}
                                        </span>
                                    </div>

                                    <!-- ROOM SUMMARY -->
                                    <div class="room-summary">

                                        <div class="room-stat">
                                            <strong>{{ $totalRooms }}</strong>
                                            <span>Total Rooms</span>
                                        </div>

                                        <div class="room-stat available">
                                            <strong>{{ $availableRooms }}</strong>
                                            <span>Available</span>
                                        </div>

                                        <div class="room-stat occupied">
                                            <strong>{{ $occupiedRooms }}</strong>
                                            <span>Occupied</span>
                                        </div>

                                    </div>

                                    <!-- MAINTENANCE COUNT -->
                                    @if($maintenanceRooms > 0)
                                        <div class="small text-warning mb-2">
                                            <i class="bi bi-tools"></i>
                                            {{ $maintenanceRooms }}
                                            room(s) under maintenance
                                        </div>
                                    @endif

                                    <!-- PROPERTY STATUS -->
                                    <div class="listing-status">

                                        @if($listing->status == 'Available')

                                            <span class="status-available">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Available
                                            </span>

                                        @else

                                            <span class="status-full">
                                                <i class="bi bi-x-circle-fill"></i>
                                                {{ $listing->status }}
                                            </span>

                                        @endif

                                    </div>

                                    <!-- MANAGE ROOMS -->
                                    <a
                                        href="{{ route('owner.rooms.create', $listing->id) }}"
                                        class="manage-rooms-btn"
                                    >
                                        <i class="bi bi-door-open"></i>
                                        Manage Rooms
                                    </a>

                                    <!-- EDIT AND DELETE -->
                                    <div class="listing-actions">

                                        <!-- EDIT PROPERTY -->
                                        <a
                                            href="{{ route('owner.listings.edit', $listing->id) }}"
                                            class="edit-btn"
                                        >
                                            <i class="bi bi-pencil"></i>
                                            Edit Property
                                        </a>

                                        <!-- DELETE PROPERTY -->
                                        <form
                                            action="{{ route('owner.listings.delete', $listing->id) }}"
                                            method="POST"
                                            style="flex:1; margin:0;"
                                            onsubmit="return confirm('Are you sure you want to delete this listing and its associated rooms?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-btn"
                                            >
                                                <i class="bi bi-trash"></i>
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <!-- EMPTY STATE -->
                    <div class="empty-card">

                        <div class="empty-icon">
                            <i class="bi bi-buildings"></i>
                        </div>

                        <h3>No Listings Yet</h3>

                        <p>
                            You have not created any accommodation listings yet.
                        </p>

                        <a
                            href="{{ route('owner.listings.create') }}"
                            class="add-btn"
                        >
                            <i class="bi bi-plus-lg"></i>
                            Add New Listing
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</body>
</html>
