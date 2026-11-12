
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Statement of Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .statement-container {
            max-width: 1000px;
            margin: 35px auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,.08);
        }

        .statement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #222;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 18px;
            height: 100%;
        }

        .summary-card small {
            color: #6b7280;
        }

        .summary-card h4 {
            margin-top: 8px;
            font-weight: bold;
        }

        .section-title {
            font-size: 17px;
            font-weight: bold;
            margin: 25px 0 12px;
        }

        .table th {
            background: #f1f3f5;
            white-space: nowrap;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .paid {
            background: #d1fae5;
            color: #065f46;
        }

        .partial {
            background: #fef3c7;
            color: #92400e;
        }

        .unpaid, .overdue {
            background: #fee2e2;
            color: #991b1b;
        }

        .upcoming {
            background: #dbeafe;
            color: #1e40af;
        }

        @media print {
            body {
                background: white;
            }

            .statement-container {
                margin: 0;
                max-width: 100%;
                box-shadow: none;
                border-radius: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

<div class="statement-container">

    <div class="statement-header">
        <div>
            <h3 class="fw-bold mb-1">STATEMENT OF ACCOUNT</h3>
            <p class="text-muted mb-0">Tenant Rental Account</p>
        </div>

        <div class="text-end">
            <h4 class="fw-bold">AccomFinder</h4>
            <small>General Santos City</small>
        </div>
    </div>

    <div class="no-print d-flex justify-content-between mb-4">
        <a href="{{ route('owner.tenants') }}" class="btn btn-outline-secondary">
            Back to Tenants
        </a>

        <button onclick="window.print()" class="btn btn-primary">
            Print / Save as PDF
        </button>
    </div>

    <h5 class="section-title">Tenant Information</h5>

    <div class="row g-3">
        <div class="col-md-6">
            <strong>Tenant Name:</strong>
            {{ $tenant->name }}
        </div>

        <div class="col-md-6">
            <strong>Email:</strong>
            {{ $tenant->email ?? 'N/A' }}
        </div>

        <div class="col-md-6">
            <strong>Phone:</strong>
            {{ $tenant->phone ?? 'N/A' }}
        </div>

        <div class="col-md-6">
            <strong>Property:</strong>
            {{ optional($tenant->accommodation)->name ?? 'N/A' }}
        </div>

        <div class="col-md-6">
            <strong>Move-in Date:</strong>
            {{ $tenant->start_date ? \Carbon\Carbon::parse($tenant->start_date)->format('F d, Y') : 'N/A' }}
        </div>

        <div class="col-md-6">
            <strong>End Date:</strong>
            {{ $tenant->end_date ? \Carbon\Carbon::parse($tenant->end_date)->format('F d, Y') : 'N/A' }}
        </div>

        <div class="col-md-6">
            <strong>Monthly Rent:</strong>
            ₱{{ number_format((float) $tenant->monthly_rent, 2) }}
        </div>

        <div class="col-md-6">
            <strong>Monthly Due Day:</strong>
            {{ $tenant->due_day ?? 'N/A' }}
        </div>
    </div>

    <h5 class="section-title">Account Summary</h5>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="summary-card">
                <small>Total Rental Charges</small>
                <h4>₱{{ number_format($totalCharges, 2) }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary-card">
                <small>Total Payments</small>
                <h4 class="text-success">₱{{ number_format($totalPaid, 2) }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary-card">
                <small>Remaining Balance</small>
                <h4 class="text-danger">₱{{ number_format($totalBalance, 2) }}</h4>
            </div>
        </div>
    </div>

    <h5 class="section-title">Monthly Rental Ledger</h5>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Billing Month</th>
                    <th>Due Date</th>
                    <th>Rental Charge</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($ledger as $item)
                    @php
                        $statusClass = match($item['status']) {
                            'Paid' => 'paid',
                            'Partial' => 'partial',
                            'Overdue' => 'overdue',
                            'Upcoming' => 'upcoming',
                            default => 'unpaid',
                        };
                    @endphp

                    <tr>
                        <td>{{ $item['month'] ?? 'N/A' }}</td>
<td>{{ $item['due_date'] ?? 'N/A' }}</td>
<td>₱{{ number_format((float)($item['charge'] ?? 0), 2) }}</td>
<td>₱{{ number_format((float)($item['paid'] ?? 0), 2) }}</td>
<td>₱{{ number_format((float)($item['balance'] ?? 0), 2) }}</td>
                            <span class="status {{ $statusClass }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No rental ledger records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr class="fw-bold">
                    <td colspan="2">TOTAL</td>
                    <td>₱{{ number_format($totalCharges, 2) }}</td>
                    <td>₱{{ number_format($totalPaid, 2) }}</td>
                    <td>₱{{ number_format($totalBalance, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <h5 class="section-title">Payment History</h5>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Payment Date</th>
                    <th>Billing Month</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tenant->payments->sortByDesc('payment_date') as $payment)
                    <tr>
                        <td>
                            {{ $payment->payment_date
                                ? \Carbon\Carbon::parse($payment->payment_date)->format('F d, Y')
                                : 'N/A' }}
                        </td>

                        <td>
                            {{ $payment->billing_month
                                ? \Carbon\Carbon::parse($payment->billing_month)->format('F Y')
                                : 'N/A' }}
                        </td>

                        <td>₱{{ number_format((float) $payment->amount, 2) }}</td>

                        <td>{{ $payment->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No payment records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 text-center text-muted">
        <small>This statement is generated from the rental and payment records stored in AccomFinder.</small>
    </div>

</div>

</body>
</html>
