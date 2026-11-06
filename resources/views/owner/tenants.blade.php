
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Records | AccomFinder</title>

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
            font-family: Arial, Helvetica, sans-serif;
            color: #132238;
            overflow: hidden;
        }

        .sidebar {
            width: 264px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dce3eb;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
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
            margin: 0 0 8px;
            padding: 14px 26px;
            color: #30435c;
            text-decoration: none;
            border-radius: 11px;
            font-size: 16px;
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
            background: #fff;
            border-bottom: 1px solid #dce3eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 28px;
            position: fixed;
            left: 264px;
            top: 0;
            right: 0;
            z-index: 900;
        }

        .bell {
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
            padding: 35px 14px 50px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 5px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 38px;
            font-weight: 500;
            color: #132238;
        }

        .page-title p {
            margin: 8px 0 0;
            color: #5d7089;
            font-size: 17px;
        }

        .add-tenant-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #14945f;
            color: #fff;
            border: none;
            padding: 14px 22px;
            border-radius: 9px;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
        }

        .add-tenant-btn:hover {
            background: #0d7e50;
            color: #fff;
        }

        .alert {
            border-radius: 10px;
            margin-top: 25px;
            margin-bottom: 0;
        }

        .tenant-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            margin-top: 30px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
            overflow-x: auto;
        }

        .tenant-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        .tenant-table th {
            text-align: left;
            color: #17395f;
            font-size: 14px;
            font-weight: 600;
            padding: 15px 14px;
            background: #f8fafc;
            border-bottom: 1px solid #e1e6ec;
        }

        .tenant-table td {
            padding: 19px 14px;
            border-bottom: 1px solid #edf0f4;
            color: #66778c;
            font-size: 14px;
            vertical-align: middle;
        }

        .tenant-table tbody tr:last-child td { border-bottom: none; }
        .tenant-table tbody tr:hover { background: #fafcfb; }

        .tenant-name {
            color: #17395f;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .tenant-email {
            color: #718096;
            font-size: 13px;
        }

        .property-type {
            color: #273d58;
            font-weight: 500;
        }

        .rent {
            color: #14945f;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-active, .badge-inactive {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .badge-active {
            background: #d9f7e8;
            color: #168451;
        }

        .badge-inactive {
            background: #edf0f3;
            color: #687587;
        }

        .action-icons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-btn, .delete-btn {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: .2s;
        }

        .edit-btn {
            background: #eaf2ff;
            color: #1769ff;
        }

        .edit-btn:hover {
            background: #1769ff;
            color: #fff;
        }

        .delete-btn {
            background: #fff0f0;
            color: #e53935;
        }

        .delete-btn:hover {
            background: #e53935;
            color: #fff;
        }

        .action-icons i { font-size: 17px; }

        .empty-state {
            text-align: center;
            padding: 75px 20px !important;
        }

        .empty-state i {
            display: block;
            font-size: 55px;
            color: #b9c7d8;
            margin-bottom: 18px;
        }

        .empty-state h4 {
            color: #243b56;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #718096;
            margin-bottom: 0;
        }

        .modal-content {
            border: none;
            border-radius: 17px;
            overflow: hidden;
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-title {
            color: #17395f;
            font-size: 24px;
            font-weight: 600;
        }

        .modal-body { padding: 30px; }

        .modal-footer {
            padding: 20px 30px 25px;
            border-top: none;
        }

        .form-label {
            color: #17395f;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .required { color: #ef4444; }

        .form-control, .form-select {
            height: 52px;
            border: 1px solid #d6e0eb;
            border-radius: 9px;
            font-size: 15px;
            padding: 0 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #14945f;
            box-shadow: 0 0 0 3px rgba(20,148,95,.10);
        }

        .cancel-btn {
            background: #fff;
            border: 1px solid #d6e0eb;
            color: #30435c;
            border-radius: 9px;
            padding: 12px 22px;
            font-size: 15px;
        }

        .save-tenant-btn {
            background: #14945f;
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 12px 22px;
            font-size: 15px;
            font-weight: 500;
        }

        .save-tenant-btn:hover { background: #0d7e50; }

        @media (max-width: 900px) {
            .sidebar { width: 220px; }

            .content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar {
                left: 220px;
                width: calc(100% - 220px);
            }

            .main {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 650px) {
            .sidebar { display: none; }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                left: 0;
                width: 100%;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
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
        <i class="bi bi-bell bell"></i>
        <div class="owner-name">{{ session('owner_name', 'Owner') }}</div>
    </div>

    <div class="main">
        <div class="page-header">
            <div class="page-title">
                <h1>Tenant Records</h1>
                <p>View and manage your tenant information.</p>
            </div>

            <button
                type="button"
                class="add-tenant-btn"
                data-bs-toggle="modal"
                data-bs-target="#addTenantModal"
            >
                <i class="bi bi-plus-lg"></i>
                Add New Tenant
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
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

        <div class="tenant-card">
            <table class="tenant-table">
                <thead>
                    <tr>
                        <th>Tenant</th>
                        <th>Property Type</th>
                        <th>Move-in Date</th>
                        <th>End Date</th>
                        <th>Monthly Rent</th>
                        <th>Status</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tenants as $tenant)
                        <tr>
                            <td>
                                <div class="tenant-name">{{ $tenant->name }}</div>
                                <div class="tenant-email">{{ $tenant->email }}</div>
                            </td>

                            <td>
                                <span class="property-type">
                                    {{ $tenant->property_type ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                {{ $tenant->start_date
                                    ? \Carbon\Carbon::parse($tenant->start_date)->format('M d, Y')
                                    : 'N/A' }}
                            </td>

                            <td>
                                {{ $tenant->end_date
                                    ? \Carbon\Carbon::parse($tenant->end_date)->format('M d, Y')
                                    : 'N/A' }}
                            </td>

                            <td>
                                <span class="rent">
                                    ₱{{ number_format((float) $tenant->monthly_rent, 2) }}
                                </span>
                            </td>

                            <td>
                                @if($tenant->status === 'Active')
                                    <span class="badge-active">
                                        <i class="bi bi-check-circle-fill"></i> Active
                                    </span>
                                @else
                                    <span class="badge-inactive">
                                        <i class="bi bi-dash-circle-fill"></i>
                                        {{ $tenant->status }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div>
                                    <i class="bi bi-envelope me-1"></i>
                                    {{ $tenant->email }}
                                </div>
                                <div class="mt-1">
                                    <i class="bi bi-telephone me-1"></i>
                                    {{ $tenant->phone }}
                                </div>
                            </td>

                            <td>
                                <div class="action-icons">
                                    <button
                                        type="button"
                                        class="edit-btn"
                                        title="Edit Tenant"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTenantModal"
                                        data-id="{{ $tenant->id }}"
                                        data-name="{{ $tenant->name }}"
                                        data-email="{{ $tenant->email }}"
                                        data-phone="{{ $tenant->phone }}"
                                        data-property-type="{{ $tenant->property_type }}"
                                        data-start-date="{{ $tenant->start_date ? \Carbon\Carbon::parse($tenant->start_date)->format('Y-m-d') : '' }}"
                                        data-end-date="{{ $tenant->end_date ? \Carbon\Carbon::parse($tenant->end_date)->format('Y-m-d') : '' }}"
                                        data-monthly-rent="{{ $tenant->monthly_rent }}"
                                        data-status="{{ $tenant->status }}"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form
                                        action="{{ route('owner.tenants.delete', $tenant->id) }}"
                                        method="POST"
                                        style="display:inline; margin:0;"
                                        onsubmit="return confirm('Are you sure you want to delete this tenant?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn"
                                            title="Delete Tenant"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                <i class="bi bi-people"></i>
                                <h4>No Tenants Yet</h4>
                                <p>Add your first tenant to get started.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ADD TENANT MODAL -->
<div
    class="modal fade"
    id="addTenantModal"
    tabindex="-1"
    aria-labelledby="addTenantModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTenantModalLabel">Add New Tenant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('owner.tenants.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter tenant name" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email address" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="required">*</span></label>
                            <input type="text" name="phone" class="form-control" placeholder="09123456789" value="{{ old('phone') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Property Type <span class="required">*</span></label>
                            <select name="property_type" class="form-select" required>
                                <option value="">Select Property Type</option>
                                @foreach(['Boarding House', 'Apartment', 'Dormitory', 'Room', 'Bedspace'] as $type)
                                    <option value="{{ $type }}" {{ old('property_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Move-in Date <span class="required">*</span></label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End Date <span class="required">*</span></label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Monthly Rent <span class="required">*</span></label>
                            <input type="number" name="monthly_rent" class="form-control" placeholder="Enter monthly rent" value="{{ old('monthly_rent') }}" min="0" step="0.01" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="save-tenant-btn">
                        <i class="bi bi-plus-lg me-1"></i> Add Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT TENANT FLOATING MODAL -->
<div
    class="modal fade"
    id="editTenantModal"
    tabindex="-1"
    aria-labelledby="editTenantModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTenantModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Tenant
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editTenantForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Name <span class="required">*</span></label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="required">*</span></label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="required">*</span></label>
                            <input type="text" name="phone" id="edit_phone" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Property Type <span class="required">*</span></label>
                            <select name="property_type" id="edit_property_type" class="form-select" required>
                                <option value="">Select Property Type</option>
                                <option value="Boarding House">Boarding House</option>
                                <option value="Apartment">Apartment</option>
                                <option value="Dormitory">Dormitory</option>
                                <option value="Room">Room</option>
                                <option value="Bedspace">Bedspace</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Move-in Date <span class="required">*</span></label>
                            <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End Date <span class="required">*</span></label>
                            <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Monthly Rent <span class="required">*</span></label>
                            <input type="number" name="monthly_rent" id="edit_monthly_rent" class="form-control" min="0" step="0.01" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select name="status" id="edit_status" class="form-select" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="save-tenant-btn">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editTenantModal');
    const editForm = document.getElementById('editTenantForm');

    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const tenantId = button.getAttribute('data-id');

        document.getElementById('edit_name').value =
            button.getAttribute('data-name') || '';

        document.getElementById('edit_email').value =
            button.getAttribute('data-email') || '';

        document.getElementById('edit_phone').value =
            button.getAttribute('data-phone') || '';

        document.getElementById('edit_property_type').value =
            button.getAttribute('data-property-type') || '';

        document.getElementById('edit_start_date').value =
            button.getAttribute('data-start-date') || '';

        document.getElementById('edit_end_date').value =
            button.getAttribute('data-end-date') || '';

        document.getElementById('edit_monthly_rent').value =
            button.getAttribute('data-monthly-rent') || '';

        document.getElementById('edit_status').value =
            button.getAttribute('data-status') || 'Active';

        editForm.action =
            "{{ url('/owner/tenants') }}/" + encodeURIComponent(tenantId);
    });
});
</script>

</body>
</html>
