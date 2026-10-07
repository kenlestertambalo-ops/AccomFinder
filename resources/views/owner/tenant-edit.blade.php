<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Tenant - AccomFinder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fc;
            color: #173f70;
        }

        .container-box {
            max-width: 900px;
            margin: 70px auto;
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(40, 70, 100, 0.08);
        }

        h2 {
            color: #174574;
            margin-bottom: 30px;
        }

        label {
            color: #173f70;
            font-size: 17px;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            height: 55px;
            border: 1px solid #bfd0e5;
            border-radius: 10px;
            font-size: 16px;
        }

        .save-btn {
            background: #1769ff;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 28px;
            font-size: 17px;
            font-weight: 600;
        }

        .back-btn {
            background: white;
            color: #173f70;
            border: 1px solid #bfd0e5;
            border-radius: 10px;
            padding: 13px 28px;
            text-decoration: none;
            font-size: 17px;
        }
    </style>
</head>

<body>

<div class="container-box">

    <h2>Edit Tenant</h2>

    <form
        action="{{ route('owner.tenants.update', $tenant->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="row g-4">

            <!-- NAME -->
            <div class="col-md-6">

                <label>
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $tenant->name) }}"
                    required
                >

            </div>


            <!-- EMAIL -->
            <div class="col-md-6">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $tenant->email) }}"
                    required
                >

            </div>


            <!-- PHONE -->
            <div class="col-md-6">

                <label>
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone', $tenant->phone) }}"
                    required
                >

            </div>


            <!-- PROPERTY TYPE -->
            <div class="col-md-6">

                <label>
                    Property Type
                </label>

                <select
                    name="property_type"
                    class="form-select"
                    required
                >

                    <option value="Boarding House"
                        {{ old('property_type', $tenant->property_type) == 'Boarding House' ? 'selected' : '' }}>
                        Boarding House
                    </option>

                    <option value="Apartment"
                        {{ old('property_type', $tenant->property_type) == 'Apartment' ? 'selected' : '' }}>
                        Apartment
                    </option>

                    <option value="Dormitory"
                        {{ old('property_type', $tenant->property_type) == 'Dormitory' ? 'selected' : '' }}>
                        Dormitory
                    </option>

                    <option value="Room"
                        {{ old('property_type', $tenant->property_type) == 'Room' ? 'selected' : '' }}>
                        Room
                    </option>

                    <option value="Bedspace"
                        {{ old('property_type', $tenant->property_type) == 'Bedspace' ? 'selected' : '' }}>
                        Bedspace
                    </option>

                </select>

            </div>


            <!-- START DATE -->
            <div class="col-md-6">

                <label>
                    Move-in Date
                </label>

                <input
                    type="date"
                    name="start_date"
                    class="form-control"
                    value="{{ old('start_date', $tenant->start_date) }}"
                    required
                >

            </div>


            <!-- END DATE -->
            <div class="col-md-6">

                <label>
                    Lease End Date
                </label>

                <input
                    type="date"
                    name="end_date"
                    class="form-control"
                    value="{{ old('end_date', $tenant->end_date) }}"
                    required
                >

            </div>


            <!-- MONTHLY RENT -->
            <div class="col-md-6">

                <label>
                    Monthly Rent
                </label>

                <input
                    type="number"
                    name="monthly_rent"
                    class="form-control"
                    value="{{ old('monthly_rent', $tenant->monthly_rent) }}"
                    min="0"
                    step="0.01"
                    required
                >

            </div>


            <!-- STATUS -->
            <div class="col-md-6">

                <label>
                    Status
                </label>

                <select
                    name="status"
                    class="form-select"
                    required
                >

                    <option value="Active"
                        {{ old('status', $tenant->status) == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive"
                        {{ old('status', $tenant->status) == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

        </div>


        <div class="mt-4 d-flex gap-3">

            <a
                href="{{ route('owner.tenants') }}"
                class="back-btn"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="save-btn"
            >
                Save Changes
            </button>

        </div>

    </form>

</div>

</body>
</html>
