<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tenants | AccomFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f5f8fc;
            font-family: Arial, sans-serif;
            color: #18304b;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
        }

        .logo {
            padding: 30px 25px;
            height: 135px;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo h2 {
            color: #159466;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .logo h2 span { color: #193e67; }

        .logo small {
            color: #718096;
            font-weight: 600;
        }

        .menu { padding: 30px 8px; }

        .menu a, .bottom a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            margin-bottom: 8px;
            color: #40536a;
            text-decoration: none;
            border-radius: 10px;
        }

        .menu a:hover, .menu a.active {
            background: #d9f7e9;
            color: #10885b;
        }

        .bottom {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 8px;
        }

        .content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 30px;
        }

        .main { padding: 32px; }

        .back-link {
            display: inline-block;
            color: #159466;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-heading h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .subtitle {
            color: #718096;
            margin-top: 8px;
        }

        .room-info {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            margin-top: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 20px;
        }

        .info-label {
            color: #718096;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .info-value {
            font-weight: 700;
            color: #193e67;
            font-size: 17px;
        }

        .capacity-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            margin-top: 20px;
        }

        .capacity-heading {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .capacity-heading strong { color: #193e67; }

        .capacity-bar {
            height: 12px;
            width: 100%;
            background: #e9eef5;
            border-radius: 20px;
            overflow: hidden;
        }

        .capacity-fill {
            height: 100%;
            border-radius: 20px;
            transition: width .3s ease;
        }

        .tenant-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            margin-top: 25px;
            overflow: hidden;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .section-heading h4 {
            font-size: 19px;
            font-weight: 700;
            margin: 0;
        }

        .btn-add {
            background: #159466;
            color: white;
            border: 0;
            padding: 11px 17px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-add:hover {
            background: #0d7951;
            color: white;
        }

        .btn-add:disabled {
            background: #aab6c2;
            cursor: not-allowed;
        }

        .table-responsive { padding: 10px 20px 20px; }

        .table th {
            background: #f5f8fc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            white-space: nowrap;
            padding: 15px;
        }

        .table td {
            padding: 16px 15px;
            vertical-align: middle;
        }

        .tenant-name {
            font-weight: 700;
            color: #193e67;
        }

        .tenant-email {
            font-size: 12px;
            color: #718096;
        }

        .status-badge {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-active {
            background: #d9f7e8;
            color: #168451;
        }

        .status-inactive {
            background: #fee2e2;
            color: #b42318;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .action-buttons a,
        .action-buttons button {
            border: 0;
            border-radius: 7px;
            padding: 7px 10px;
            font-size: 13px;
            text-decoration: none;
        }

        .btn-edit { background: #fff2d8; color: #9a6500; }
        .btn-delete { background: #fee2e2; color: #b42318; }

        .btn-ledger-assign {
            background: #e8f2ff;
            color: #1769a8;
            border: 0;
            border-radius: 7px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-ledger-assign:hover {
            background: #d7eaff;
            color: #12588f;
        }

        .btn-view-ledger {
            display: inline-block;
            background: #159466;
            color: white;
            border-radius: 7px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-view-ledger:hover {
            background: #0d7951;
            color: white;
        }

        .ledger-assigned {
            display: inline-block;
            background: #d9f7e8;
            color: #168451;
            border-radius: 20px;
            padding: 7px 10px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            margin-bottom: 6px;
        }

        .ledger-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            border-radius: 10px;
            padding: 14px 16px;
            margin: 18px 22px 0;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 48px;
            color: #b7c5d6;
        }

        .empty-state h5 {
            margin-top: 15px;
            font-weight: 700;
        }

        .empty-state p { color: #718096; }

        .modal-content {
            border: 0;
            border-radius: 15px;
        }

        .modal-header {
            background: #f5f8fc;
            border-radius: 15px 15px 0 0;
        }

        .form-label {
            font-weight: 600;
            color: #40536a;
            font-size: 14px;
        }

        .form-control, .form-select {
            padding: 11px;
            border-radius: 8px;
        }

        @media(max-width: 850px) {
            .sidebar { width: 215px; }
            .content { margin-left: 215px; }
            .main { padding: 22px; }
        }

        @media(max-width: 650px) {
            .sidebar { display: none; }
            .content { margin-left: 0; }
            .main { padding: 18px; }
        }
    </style>
</head>

<body>

@php
    $capacity = max(1, (int) $roomRecord->capacity);
    $activeTenantCount = $tenants->where('status', 'Active')->count();
    $occupants = (int) ($roomRecord->current_occupants ?? $activeTenantCount);
    $occupants = min($occupants, $capacity);
    $occupancyPercentage = min(100, ($occupants / $capacity) * 100);
    $isFull = $occupants >= $capacity;
    $isMaintenance = strtolower($roomRecord->status ?? '') === 'maintenance';
    $cannotAddTenant = $isFull || $isMaintenance;
    $progressColor = $isFull ? '#dc3545' : '#159466';
@endphp

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">
        <h2><span>Accom</span>Finder</h2>
        <small>Owner Portal</small>
    </div>

    <div class="menu">
        <a href="{{ route('owner.dashboard') }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>

        <a href="{{ route('owner.listings') }}">
            <i class="bi bi-buildings"></i> Listings
        </a>

        <a href="{{ route('owner.tenants') }}" class="active">
            <i class="bi bi-people"></i> Tenants
        </a>

        <a href="{{ route('owner.payments') }}">
            <i class="bi bi-cash-stack"></i> Payments
        </a>

        <a href="{{ route('owner.reports') }}">
            <i class="bi bi-bar-chart"></i> Reports
        </a>

        <a href="{{ route('owner.messages') }}">
            <i class="bi bi-chat-dots"></i> Messages
        </a>
    </div>

    <div class="bottom">
        <a href="{{ route('owner.logout') }}">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="content">

    <div class="topbar">
        <strong>{{ session('owner_name', 'Owner') }}</strong>
    </div>

    <main class="main">

        <a href="{{ route('owner.tenants.rooms', $property->id) }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Rooms
        </a>

        <div class="page-heading">
            <div>
                <h1>{{ $roomRecord->room_name }}</h1>
                <p class="subtitle">Manage tenants assigned to this room.</p>
            </div>

            <button
                type="button"
                class="btn-add"
                data-bs-toggle="modal"
                data-bs-target="#addTenantModal"
                {{ $cannotAddTenant ? 'disabled' : '' }}
            >
                <i class="bi bi-plus-lg me-1"></i> Add Tenant
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Please check the following:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ROOM INFORMATION -->
        <div class="room-info">
            <div>
                <div class="info-label">Property</div>
                <div class="info-value">{{ $property->name }}</div>
            </div>

            <div>
                <div class="info-label">Room</div>
                <div class="info-value">{{ $roomRecord->room_name }}</div>
            </div>

            <div>
                <div class="info-label">Monthly Rent</div>
                <div class="info-value">
                    ₱{{ number_format((float) $roomRecord->price, 2) }}
                </div>
            </div>

            <div>
                <div class="info-label">Room Capacity</div>
                <div class="info-value">
                    {{ $occupants }} / {{ $capacity }}
                </div>
            </div>

            <div>
                <div class="info-label">Room Status</div>
                <div class="info-value">{{ $roomRecord->status }}</div>
            </div>
        </div>

        <!-- OCCUPANCY PROGRESS -->
        <div class="capacity-section">
            <div class="capacity-heading">
                <strong>
                    <i class="bi bi-people me-2"></i>
                    Room Occupancy
                </strong>

                <span>{{ $occupants }} of {{ $capacity }} occupants</span>
            </div>

            <div class="capacity-bar">
                <div
                    class="capacity-fill"
                    style="width: {{ $occupancyPercentage }}%; background: {{ $progressColor }};"
                ></div>
            </div>

            <div class="mt-3">
                @if($isMaintenance)
                    <span class="badge bg-secondary">
                        This room is under maintenance.
                    </span>
                @elseif($isFull)
                    <span class="badge bg-danger">
                        Room is full. No additional active tenants can be assigned.
                    </span>
                @else
                    <span class="badge bg-success">
                        {{ $capacity - $occupants }} available space(s) remaining.
                    </span>
                @endif
            </div>
        </div>

        <!-- TENANT TABLE -->
        <section class="tenant-section">

            <div class="section-heading">
                <h4>
                    <i class="bi bi-people me-2"></i>
                    Room Tenants ({{ $tenants->count() }})
                </h4>

                <button
                    type="button"
                    class="btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#addTenantModal"
                    {{ $cannotAddTenant ? 'disabled' : '' }}
                >
                    <i class="bi bi-plus-lg me-1"></i> Add Tenant
                </button>
            </div>

            @if($assignedLedgerTenant)
                <div class="ledger-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>{{ $assignedLedgerTenant->name }}</strong>
                    is the only tenant currently assigned to view this room's rental ledger.
                    Assigning another tenant will replace this assignment.
                </div>
            @else
                <div class="ledger-info">
                    <i class="bi bi-info-circle me-2"></i>
                    No tenant has been assigned to view this room's ledger yet.
                    Choose one active tenant below.
                </div>
            @endif

            @if($tenants->count() > 0)

                <div class="table-responsive">
                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Tenant</th>
                                <th>Phone</th>
                                <th>Monthly Rent</th>
                                <th>Due Day</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Ledger Access</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tenants as $tenant)
                                <tr>
                                    <td>
                                        <div class="tenant-name">
                                            {{ $tenant->name }}
                                        </div>
                                        <div class="tenant-email">
                                            {{ $tenant->email }}
                                        </div>
                                    </td>

                                    <td>{{ $tenant->phone }}</td>

                                    <td>
                                        ₱{{ number_format((float) $tenant->monthly_rent, 2) }}
                                    </td>

                                    <td>{{ $tenant->due_day }}</td>

                                    <td>
                                        {{ $tenant->start_date
                                            ? \Carbon\Carbon::parse($tenant->start_date)->format('M d, Y')
                                            : '—' }}
                                    </td>

                                    <td>
                                        {{ $tenant->end_date
                                            ? \Carbon\Carbon::parse($tenant->end_date)->format('M d, Y')
                                            : 'Ongoing' }}
                                    </td>

                                    <td>
                                        @if(strtolower($tenant->status) === 'active')
                                            <span class="status-badge status-active">
                                                Active
                                            </span>
                                        @else
                                            <span class="status-badge status-inactive">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- LEDGER ASSIGNMENT -->
                                    <td>
                                        @if(
                                            $assignedLedgerTenant &&
                                            (int) $assignedLedgerTenant->id === (int) $tenant->id
                                        )
                                            <div>
                                                <span class="ledger-assigned">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Assigned
                                                </span>
                                            </div>

                                            <a
                                                href="{{ route('owner.tenants.ledger.show', $tenant->id) }}"
                                                class="btn-view-ledger"
                                            >
                                                <i class="bi bi-receipt me-1"></i>
                                                View Ledger
                                            </a>

                                        @elseif(strtolower($tenant->status) === 'active')

                                            <form
                                                action="{{ route('owner.tenants.ledger.assign', [
                                                    'accommodation' => $property->id,
                                                    'room' => $roomRecord->id
                                                ]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Assign this tenant as the only tenant allowed to view this room ledger? This will replace the current assignment.');"
                                            >
                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="tenant_id"
                                                    value="{{ $tenant->id }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn-ledger-assign"
                                                >
                                                    <i class="bi bi-person-check me-1"></i>
                                                    Assign Ledger
                                                </button>
                                            </form>

                                        @else
                                            <span class="text-muted small">
                                                Inactive tenant
                                            </span>
                                        @endif
                                    </td>

                                    <!-- TENANT ACTIONS -->
                                    <td>
                                        <div class="action-buttons">

                                            <a
                                                href="{{ route('owner.tenants.edit', $tenant->id) }}"
                                                class="btn-edit"
                                                title="Edit Tenant"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form
                                                action="{{ route('owner.tenants.delete', $tenant->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this tenant?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn-delete"
                                                    title="Delete Tenant"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else

                <div class="empty-state">
                    <i class="bi bi-person-plus"></i>

                    <h5>No Tenants Assigned Yet</h5>

                    <p>
                        Add a tenant to this room to begin managing their rental records.
                    </p>

                    <button
                        type="button"
                        class="btn-add"
                        data-bs-toggle="modal"
                        data-bs-target="#addTenantModal"
                        {{ $cannotAddTenant ? 'disabled' : '' }}
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Add First Tenant
                    </button>
                </div>

            @endif

        </section>

    </main>
</div>

<!-- ADD TENANT MODAL -->
<div class="modal fade" id="addTenantModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-plus me-2"></i>
                    Add New Tenant
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>
            </div>

            <form action="{{ route('owner.tenants.store') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="accommodation_id"
                    value="{{ $property->id }}"
                >

                <input
                    type="hidden"
                    name="room_id"
                    value="{{ $roomRecord->id }}"
                >

                <div class="modal-body">

                    <div class="alert alert-info">
                        <strong>Selected Property:</strong>
                        {{ $property->name }}
                        <br>

                        <strong>Selected Room:</strong>
                        {{ $roomRecord->room_name }}
                        <br>

                        <strong>Available Spaces:</strong>
                        {{ max(0, $capacity - $occupants) }}
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name *</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Enter tenant's full name"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Address *</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="Enter email address"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number *</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                                placeholder="Enter phone number"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Property Type *</label>
                            <input
                                type="text"
                                name="property_type"
                                class="form-control"
                                value="{{ old('property_type', $property->type ?? '') }}"
                                placeholder="e.g. Boarding House"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start Date *</label>
                            <input
                                type="date"
                                name="start_date"
                                class="form-control"
                                value="{{ old('start_date') }}"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input
                                type="date"
                                name="end_date"
                                class="form-control"
                                value="{{ old('end_date') }}"
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Monthly Rent (₱) *</label>
                            <input
                                type="number"
                                name="monthly_rent"
                                class="form-control"
                                value="{{ old('monthly_rent', $roomRecord->price) }}"
                                min="0"
                                step="0.01"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Payment Due Day *</label>

                            <select name="due_day" class="form-select" required>
                                @for($day = 1; $day <= 31; $day++)
                                    <option
                                        value="{{ $day }}"
                                        {{ old('due_day', 5) == $day ? 'selected' : '' }}
                                    >
                                        Every {{ $day }}{{ $day == 1 ? 'st' : ($day == 2 ? 'nd' : ($day == 3 ? 'rd' : 'th')) }} day
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tenant Status *</label>

                            <select name="status" class="form-select" required>
                                <option
                                    value="Active"
                                    {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    {{ old('status') == 'Inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <small class="text-muted d-block mt-3">
                        Fields marked with * are required.
                    </small>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success"
                        {{ $cannotAddTenant ? 'disabled' : '' }}
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Save Tenant
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('addTenantModal');

        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    });
</script>
@endif

</body>
</html>
