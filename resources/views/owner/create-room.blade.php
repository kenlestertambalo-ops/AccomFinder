
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rooms | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f8fc;
            font-family: Arial, sans-serif;
            color: #19304b;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dce3eb;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .logo {
            height: 126px;
            padding: 32px 24px;
            border-bottom: 1px solid #dce3eb;
        }

        .logo h2 {
            margin: 0;
            font-size: 27px;
            font-weight: 700;
            color: #14945f;
        }

        .logo h2 span {
            color: #193e67;
        }

        .logo small {
            display: block;
            color: #66758a;
            font-size: 13px;
            font-weight: 600;
        }

        .menu {
            padding: 35px 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            padding: 14px 24px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 15px;
            transition: .2s;
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
            gap: 12px;
            padding: 13px 21px;
            color: #30435c;
            text-decoration: none;
            font-size: 15px;
            border-radius: 11px;
        }

        .bottom a:hover {
            color: #dc3545;
            background: #fff5f5;
        }

        /* TOP NAVIGATION */
        .topbar {
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #dce3eb;
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 28px;
        }

        .bell {
            font-size: 22px;
            margin-right: 25px;
            color: #172334;
        }

        .owner-name {
            font-size: 15px;
            font-weight: 600;
            color: #172334;
        }

        /* MAIN CONTENT */
        .content {
            margin-left: 240px;
            margin-top: 70px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            padding: 30px;
        }

        .container-box {
    width: 100%;
    max-width: none;
    margin: 0;
    padding: 0 0 35px 0;
}

        .page-heading {
            margin-bottom: 20px;
        }

        .page-heading h2 {
            font-size: 30px;
            font-weight: 700;
            color: #19304b;
        }

        .card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,.05);
            margin-bottom: 22px;
        }

        .card-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #203b62;
        }

        .form-control,
        .form-select {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .btn-primary {
            background: #14945f;
            border-color: #14945f;
        }

        .btn-primary:hover {
            background: #0d7e50;
            border-color: #0d7e50;
        }

        .room-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 14px;
            background: #fff;
        }

        .room-price {
            color: #14945f;
            font-weight: 700;
            font-size: 20px;
        }

        .amenity-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .amenity-option {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        @media(max-width: 850px) {
            .sidebar {
                width: 210px;
            }

            .topbar {
                left: 210px;
            }

            .content {
                margin-left: 210px;
            }
        }

        @media(max-width: 600px) {
            .sidebar {
                display: none;
            }

            .topbar {
                left: 0;
            }

            .content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .card-body {
                padding: 18px;
            }

            .amenity-grid {
                grid-template-columns: repeat(2, 1fr);
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

        <a href="{{ route('owner.listings') }}" class="active">
            <span class="menu-icon"><i class="bi bi-buildings"></i></span>
            Listings
        </a>

        <a href="{{ route('owner.tenants') }}">
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
            <span class="menu-icon"><i class="bi bi-box-arrow-left"></i></span>
            Logout
        </a>
    </div>

</div>

<!-- TOP NAVIGATION -->
<div class="topbar">
    <i class="bi bi-bell bell"></i>

    <span class="owner-name">
        {{ session('owner_name', 'Owner') }}
    </span>
</div>

<!-- MAIN CONTENT -->
<div class="content">

    <div class="container-box">

        <a href="{{ route('owner.listings') }}"
           class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i>
            Back to Listings
        </a>

        <div class="page-heading">
            <h2>Add Rooms</h2>
            <p class="text-muted">
                Step 2 of 2: Add individual rooms to your property.
            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please correct the following:</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- PROPERTY INFORMATION -->
        <div class="card">
            <div class="card-body">

                <h4 class="fw-bold">{{ $property->name }}</h4>

                <p class="text-muted mb-2">
                    <i class="bi bi-geo-alt"></i>
                    {{ $property->address }}
                </p>

                <span class="badge bg-primary">
                    {{ $property->type }}
                </span>

                @if($property->image)
                    <div class="mt-3">
                        <img
                            src="{{ asset('storage/' . $property->image) }}"
                            alt="Property image"
                            style="width:100%;max-width:350px;height:190px;object-fit:cover;border-radius:10px;"
                        >
                    </div>
                @endif

            </div>
        </div>

        <!-- ADD ROOM FORM -->
        <div class="card">
            <div class="card-body">

                <h4 class="fw-bold mb-4">
                    <i class="bi bi-door-open"></i>
                    Room Information
                </h4>

                <form
                    method="POST"
                    action="{{ route('owner.rooms.store', $property->id) }}"
                >

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Room Name / Number
                        </label>

                        <input
                            type="text"
                            name="room_name"
                            class="form-control"
                            placeholder="Example: Room 1"
                            value="{{ old('room_name') }}"
                            required
                        >
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Monthly Rent (₱)
                            </label>

                            <input
                                type="number"
                                name="price"
                                class="form-control"
                                min="0"
                                step="0.01"
                                value="{{ old('price') }}"
                                placeholder="Example: 2500"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Capacity (Persons)
                            </label>

                            <input
                                type="number"
                                name="capacity"
                                class="form-control"
                                min="1"
                                value="{{ old('capacity', 1) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Number of CR / Bathrooms
                            </label>

                            <input
                                type="number"
                                name="bathrooms"
                                class="form-control"
                                min="0"
                                value="{{ old('bathrooms', 1) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Room Availability
                            </label>

                            <select name="status" class="form-select" required>

                                <option value="Available"
                                    {{ old('status', 'Available') == 'Available' ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="Occupied"
                                    {{ old('status') == 'Occupied' ? 'selected' : '' }}>
                                    Occupied
                                </option>

                            </select>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Room Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Describe this room..."
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label mb-3">
                            Room Amenities
                        </label>

                        @php
                            $amenitiesList = [
                                'WiFi',
                                'Air Conditioning',
                                'Electric Fan',
                                'Private CR',
                                'Shared CR',
                                'Bed',
                                'Cabinet',
                                'Study Table',
                                'Water Supply',
                                'Parking',
                            ];
                        @endphp

                        <div class="amenity-grid">

                            @foreach($amenitiesList as $amenity)

                                <label class="amenity-option">

                                    <input
                                        type="checkbox"
                                        name="amenities[]"
                                        value="{{ $amenity }}"
                                        {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}
                                    >

                                    {{ $amenity }}

                                </label>

                            @endforeach

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-plus-circle"></i>
                        Save Room
                    </button>

                    <a href="{{ route('owner.listings') }}"
                       class="btn btn-outline-secondary px-4">
                        Finish
                    </a>

                </form>

            </div>
        </div>

        <!-- EXISTING ROOMS -->
        <h4 class="fw-bold mb-3">
            Rooms Added to This Property
        </h4>

        @forelse($rooms as $room)

            <div class="room-card">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">

                    <div>

                        <h5 class="fw-bold mb-2">
                            <i class="bi bi-door-closed"></i>
                            {{ $room->room_name }}
                        </h5>

                        <div class="room-price">
                            ₱{{ number_format((float)$room->price, 2) }}

                            <small class="text-muted fs-6">
                                / month
                            </small>
                        </div>

                        <p class="text-muted mt-2 mb-1">
                            Capacity: {{ $room->capacity }} persons
                        </p>

                        <p class="text-muted mb-1">
                            CR / Bathrooms: {{ $room->bathrooms }}
                        </p>

                        <p class="mb-2">
                            {{ $room->description ?: 'No description provided.' }}
                        </p>

                        <div>
                            @foreach($room->amenities ?? [] as $amenity)

                                <span class="badge bg-light text-dark border mb-1">
                                    {{ $amenity }}
                                </span>

                            @endforeach
                        </div>

                    </div>

                    <div>
                        @if($room->status === 'Available')
                            <span class="badge bg-success">
                                Available
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Occupied
                            </span>
                        @endif
                    </div>

                </div>

            </div>

        @empty

            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                No rooms have been added yet. Use the form above to add your first room.
            </div>

        @endforelse

    </div>

</div>

</body>
</html>
