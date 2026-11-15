
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; }

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

        .logo h2 span { color: #193e67; }

        .logo small {
            display: block;
            color: #66758a;
            font-size: 13px;
            font-weight: 600;
        }

        .menu { padding: 35px 5px; }

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

        .menu a:hover,
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

        /* TOP BAR */
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
            padding-bottom: 40px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h2 {
            font-size: 30px;
            font-weight: 700;
            color: #19304b;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: #718096;
            margin-bottom: 0;
        }

        /* ADD ROOM BUTTON AREA */
        .add-room-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .add-room-area h4 {
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .add-room-area p {
            color: #718096;
            margin: 0;
        }

        .add-room-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: #14945f;
            color: white;
            border: none;
            border-radius: 9px;
            padding: 13px 20px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: .2s;
        }

        .add-room-btn:hover {
            background: #0d7e50;
            color: white;
        }

        /* ROOM FORM - HIDDEN INITIALLY */
        #roomFormSection {
            display: none;
            margin-bottom: 28px;
        }

        .form-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,.05);
        }

        .form-card-body { padding: 25px; }

        .form-label {
            font-weight: 600;
            color: #203b62;
        }

        .form-control,
        .form-select {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .save-btn {
            background: #14945f;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 11px 20px;
            font-weight: 600;
        }

        .save-btn:hover { background: #0d7e50; }

        /* AMENITIES */
        .amenity-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .add-amenity-button {
            width: 34px;
            height: 34px;
            border: none;
            border-radius: 50%;
            background: #14945f;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .amenity-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px 20px;
        }

        .amenity-option {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .custom-amenity-input {
            display: none;
            margin-top: 18px;
            padding: 15px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
        }

        .custom-amenity {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remove-amenity {
            border: none;
            background: transparent;
            color: #dc3545;
            font-size: 18px;
            cursor: pointer;
        }

        /* ROOM TILES */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .room-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 3px 10px rgba(0,0,0,.04);
            transition: .2s;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .room-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0,0,0,.08);
        }

        .room-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .room-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #e1f8ed;
            color: #14945f;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 23px;
        }

        .room-card h5 {
            font-size: 19px;
            font-weight: 700;
            color: #17395f;
            margin-bottom: 12px;
        }

        .room-price {
            color: #14945f;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .room-price small {
            color: #718096;
            font-size: 12px;
            font-weight: 400;
        }

        .room-detail {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .room-detail i {
            color: #14945f;
            font-size: 15px;
            flex-shrink: 0;
        }

        .room-status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 11px;
            font-size: 11px;
            font-weight: 700;
        }

        .available { background: #d9f7e8; color: #168451; }
        .occupied { background: #fff0d8; color: #a56508; }
        .maintenance { background: #fee2e2; color: #b42318; }

        .room-amenities {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        .amenity-badge {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 5px 8px;
            font-size: 11px;
        }

        .empty-rooms {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 50px 20px;
            text-align: center;
            color: #718096;
            margin-top: 20px;
        }

        .empty-rooms i {
            font-size: 45px;
            color: #b9c7d8;
        }

        @media(max-width: 850px) {
            .sidebar { width: 210px; }
            .topbar { left: 210px; }
            .content { margin-left: 210px; }

            .room-grid {
                grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            }
        }

        @media(max-width: 600px) {
            .sidebar { display: none; }
            .topbar { left: 0; }

            .content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .amenity-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .room-grid { grid-template-columns: 1fr; }
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

<!-- TOP BAR -->
<div class="topbar">
    <i class="bi bi-bell me-4"></i>
    <span class="owner-name">
        {{ session('owner_name', 'Owner') }}
    </span>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="container-box">

        <a href="{{ route('owner.listings') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i>
            Back to Listings
        </a>

        <div class="page-heading">
            <h2>Manage Rooms</h2>
            <p>Manage the rooms registered under this property.</p>
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

        <!-- ADD ROOM BUTTON -->
        <div class="add-room-area">
            <div>
                <h4>Property Rooms</h4>
                <p>
                    {{ $rooms->count() }} room(s) registered under this property.
                </p>
            </div>

            <button
                type="button"
                class="add-room-btn"
                id="toggleRoomForm"
                onclick="toggleRoomForm()"
            >
                <i class="bi bi-plus-circle"></i>
                Add New Room
            </button>
        </div>

        <!-- ROOM FORM: HIDDEN UNTIL BUTTON CLICK -->
        <div id="roomFormSection">

            <div class="form-card">
                <div class="form-card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">
                            <i class="bi bi-door-open"></i>
                            Add New Room
                        </h4>

                        <button
                            type="button"
                            class="btn-close"
                            onclick="toggleRoomForm()"
                            aria-label="Close"
                        ></button>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('owner.rooms.store', $property->id) }}"
                    >
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Room Name / Number</label>
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
                                <label class="form-label">Monthly Rent (₱)</label>
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
                                <label class="form-label">Capacity (Persons)</label>
                                <input
                                    type="number"
                                    name="capacity"
                                    id="capacity"
                                    class="form-control"
                                    min="1"
                                    value="{{ old('capacity', 1) }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Current Occupants</label>
                                <input
                                    type="number"
                                    name="current_occupants"
                                    id="current_occupants"
                                    class="form-control"
                                    min="0"
                                    value="{{ old('current_occupants', 0) }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Number of CR / Bathrooms</label>
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
                                <label class="form-label">Bathroom Type</label>
                                <select name="bathroom_type" class="form-select" required>
                                    <option value="">Select Bathroom Type</option>
                                    <option value="Private"
                                        {{ old('bathroom_type') == 'Private' ? 'selected' : '' }}>
                                        Private Bathroom
                                    </option>
                                    <option value="Shared"
                                        {{ old('bathroom_type') == 'Shared' ? 'selected' : '' }}>
                                        Shared Bathroom
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Room Availability</label>
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
                            <label class="form-label">Room Description</label>
                            <textarea
                                name="description"
                                class="form-control"
                                rows="3"
                                placeholder="Describe this room..."
                            >{{ old('description') }}</textarea>
                        </div>

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

                            $selectedAmenities = old('amenities', []);

                            if (!is_array($selectedAmenities)) {
                                $selectedAmenities = [];
                            }

                            $customAmenities = array_filter(
                                $selectedAmenities,
                                function ($amenity) use ($amenitiesList) {
                                    return !in_array($amenity, $amenitiesList);
                                }
                            );
                        @endphp

                        <div class="mb-4">

                            <div class="amenity-heading">
                                <label class="form-label">Room Amenities</label>

                                <button
                                    type="button"
                                    class="add-amenity-button"
                                    onclick="toggleAmenityInput()"
                                >
                                    +
                                </button>
                            </div>

                            <div class="amenity-grid" id="amenityGrid">

                                @foreach($amenitiesList as $amenity)
                                    <label class="amenity-option">
                                        <input
                                            type="checkbox"
                                            name="amenities[]"
                                            value="{{ $amenity }}"
                                            {{ in_array($amenity, $selectedAmenities) ? 'checked' : '' }}
                                        >
                                        {{ $amenity }}
                                    </label>
                                @endforeach

                                @foreach($customAmenities as $amenity)
                                    <label class="amenity-option custom-amenity">
                                        <input
                                            type="checkbox"
                                            name="amenities[]"
                                            value="{{ $amenity }}"
                                            checked
                                        >

                                        <span>{{ $amenity }}</span>

                                        <button
                                            type="button"
                                            class="remove-amenity"
                                            onclick="removeAmenity(this)"
                                        >
                                            &times;
                                        </button>
                                    </label>
                                @endforeach

                            </div>

                            <div class="custom-amenity-input" id="amenityInputArea">
                                <label class="form-label">Add Custom Amenity</label>

                                <div class="input-group">
                                    <input
                                        type="text"
                                        id="customAmenityInput"
                                        class="form-control"
                                        placeholder="Enter amenity name"
                                        maxlength="50"
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-success"
                                        onclick="addCustomAmenity()"
                                    >
                                        Add
                                    </button>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="save-btn">
                            <i class="bi bi-check-circle me-1"></i>
                            Save Room
                        </button>

                        <button
                            type="button"
                            class="btn btn-outline-secondary ms-2"
                            onclick="toggleRoomForm()"
                        >
                            Cancel
                        </button>

                    </form>

                </div>
            </div>
        </div>

        <!-- EXISTING ROOM TILES -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4">
            <div>
                <h4 class="fw-bold mb-1">Rooms Added to This Property</h4>
                <p class="text-muted mb-0">
                    Select and review the rooms registered under this property.
                </p>
            </div>

            <span class="badge bg-success fs-6">
                {{ $rooms->count() }} Room(s)
            </span>
        </div>

        @if($rooms->count() > 0)

            <div class="room-grid">

                @foreach($rooms as $room)

                    @php
                        $roomAmenities = is_array($room->amenities)
                            ? $room->amenities
                            : (json_decode($room->amenities ?? '[]', true) ?: []);

                        $status = strtolower($room->status ?? 'available');

                        $statusClass = match($status) {
                            'available' => 'available',
                            'occupied' => 'occupied',
                            'maintenance' => 'maintenance',
                            default => 'occupied'
                        };
                    @endphp

                    <div class="room-card">

                        <div class="room-top">
                            <div class="room-icon">
                                <i class="bi bi-door-closed"></i>
                            </div>

                            <span class="room-status {{ $statusClass }}">
                                {{ ucfirst($room->status ?? 'Available') }}
                            </span>
                        </div>

                        <h5>{{ $room->room_name }}</h5>

                        <div class="room-price">
                            ₱{{ number_format((float)$room->price, 2) }}
                            <small>/ month</small>
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-people"></i>
                            <span>Capacity: {{ $room->capacity ?? 0 }} persons</span>
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-person-check"></i>
                            <span>Current Occupants: {{ $room->current_occupants ?? 0 }}</span>
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-droplet"></i>
                            <span>Bathrooms: {{ $room->bathrooms ?? 0 }}</span>
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-house-check"></i>
                            <span>Bathroom Type: {{ $room->bathroom_type ?? 'Not specified' }}</span>
                        </div>

                        <div class="room-detail">
                            <i class="bi bi-card-text"></i>
                            <span>{{ $room->description ?: 'No description provided.' }}</span>
                        </div>

                        <div class="mt-2">
                            <strong class="small">Amenities</strong>

                            <div class="room-amenities">
                                @forelse($roomAmenities as $amenity)
                                    <span class="amenity-badge">
                                        {{ $amenity }}
                                    </span>
                                @empty
                                    <span class="text-muted small">
                                        No amenities added
                                    </span>
                                @endforelse
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-rooms">
                <i class="bi bi-door-closed"></i>
                <h5 class="fw-bold mt-3">No Rooms Added Yet</h5>
                <p class="mb-0">
                    Click the Add New Room button above to create your first room.
                </p>
            </div>

        @endif

    </div>
</div>

<script>
    /* OPEN/CLOSE ROOM FORM */
    function toggleRoomForm() {
        const section = document.getElementById('roomFormSection');
        const button = document.getElementById('toggleRoomForm');

        const isHidden = window.getComputedStyle(section).display === 'none';

        section.style.display = isHidden ? 'block' : 'none';

        button.innerHTML = isHidden
            ? '<i class="bi bi-x-circle"></i> Close Room Form'
            : '<i class="bi bi-plus-circle"></i> Add New Room';

        if (isHidden) {
            section.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    /* AMENITIES FORM */
    function toggleAmenityInput() {
        const area = document.getElementById('amenityInputArea');
        const isHidden = window.getComputedStyle(area).display === 'none';

        area.style.display = isHidden ? 'block' : 'none';

        if (isHidden) {
            document.getElementById('customAmenityInput').focus();
        }
    }

    function addCustomAmenity() {
        const input = document.getElementById('customAmenityInput');
        const grid = document.getElementById('amenityGrid');
        const amenityName = input.value.trim();

        if (!amenityName) {
            alert('Please enter an amenity name.');
            input.focus();
            return;
        }

        const existing = Array.from(
            grid.querySelectorAll('input[name="amenities[]"]')
        );

        if (existing.some(item =>
            item.value.toLowerCase() === amenityName.toLowerCase()
        )) {
            alert('This amenity already exists.');
            input.focus();
            return;
        }

        const label = document.createElement('label');
        label.className = 'amenity-option custom-amenity';

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'amenities[]';
        checkbox.value = amenityName;
        checkbox.checked = true;

        const text = document.createElement('span');
        text.textContent = amenityName;

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'remove-amenity';
        removeButton.innerHTML = '&times;';
        removeButton.onclick = function() {
            removeAmenity(removeButton);
        };

        label.appendChild(checkbox);
        label.appendChild(text);
        label.appendChild(removeButton);

        grid.appendChild(label);

        input.value = '';
        input.focus();
    }

    function removeAmenity(button) {
        const label = button.closest('.amenity-option');

        if (label) {
            label.remove();
        }
    }

    document.getElementById('customAmenityInput')
        .addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addCustomAmenity();
            }
        });

    /* VALIDATE ROOM OCCUPANCY */
    const capacityInput = document.getElementById('capacity');
    const occupantsInput = document.getElementById('current_occupants');

    function validateOccupants() {
        const capacity = parseInt(capacityInput.value, 10);
        const occupants = parseInt(occupantsInput.value, 10);

        occupantsInput.setCustomValidity('');

        if (occupants < 0) {
            occupantsInput.setCustomValidity(
                'Current occupants cannot be negative.'
            );
        } else if (capacity > 0 && occupants > capacity) {
            occupantsInput.setCustomValidity(
                'Current occupants cannot exceed room capacity.'
            );
        }
    }

    capacityInput.addEventListener('input', validateOccupants);
    occupantsInput.addEventListener('input', validateOccupants);

    /* REOPEN FORM IF VALIDATION FAILED */
    @if($errors->any())
        document.getElementById('roomFormSection').style.display = 'block';
        document.getElementById('toggleRoomForm').innerHTML =
            '<i class="bi bi-x-circle"></i> Close Room Form';
    @endif
</script>

</body>
</html>
