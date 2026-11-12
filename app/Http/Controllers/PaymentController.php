<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Tenant;

class PaymentController extends Controller
{
    // =========================================================
    // PAYMENT RECORDS AND MONTHLY RENT LEDGER
    // =========================================================

    public function index()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $today = Carbon::today();
        $currentMonth = $today->copy()->startOfMonth();

        $tenants = Tenant::where('owner_id', $ownerId)
            ->orderBy('name')
            ->get();

        $payments = Payment::with('tenant')
            ->where('owner_id', $ownerId)
            ->latest('payment_date')
            ->get();

        // Group successful payments by tenant and billing month.
        $paidByMonth = $payments
            ->where('status', 'Paid')
            ->filter(function ($payment) {
                return !empty($payment->billing_month);
            })
            ->groupBy(function ($payment) {
                return $payment->tenant_id . '|' .
                    Carbon::parse($payment->billing_month)->format('Y-m');
            })
            ->map(function ($monthPayments) {
                return (float) $monthPayments->sum('amount');
            });

        $ledger = collect();
        $tenantSummaries = collect();

        foreach ($tenants as $tenant) {

            if (!$tenant->start_date) {
                continue;
            }

            $startMonth = Carbon::parse($tenant->start_date)
                ->startOfMonth();

            // Do not generate future rent months.
            $lastMonth = $currentMonth->copy();

            // Stop generating rent after the lease end month.
            if ($tenant->end_date) {
                $leaseEndMonth = Carbon::parse($tenant->end_date)
                    ->startOfMonth();

                if ($leaseEndMonth->lt($lastMonth)) {
                    $lastMonth = $leaseEndMonth;
                }
            }

            if ($startMonth->gt($lastMonth)) {
                continue;
            }

            $dueDay = max(
                1,
                min(31, (int) ($tenant->due_day ?? 5))
            );

            $monthlyRent = (float) $tenant->monthly_rent;

            $tenantUnpaidMonths = 0;
            $tenantOverdueMonths = 0;
            $tenantOutstanding = 0;
            $unpaidMonthNames = [];

            $month = $startMonth->copy();

            while ($month->lte($lastMonth)) {

                $billingMonth = $month->copy()->startOfMonth();

                // Handle months with fewer than 31 days.
                $actualDueDay = min(
                    $dueDay,
                    $billingMonth->daysInMonth
                );

                $dueDate = $billingMonth->copy()
                    ->day($actualDueDay);

                $key = $tenant->id . '|' .
                    $billingMonth->format('Y-m');

                $amountPaid = (float) ($paidByMonth[$key] ?? 0);

                $balance = max(
                    0,
                    $monthlyRent - $amountPaid
                );

                if ($balance <= 0.009) {
                    $status = 'Paid';
                    $balance = 0;
                } elseif ($today->gt($dueDate)) {
                    $status = 'Overdue';
                } else {
                    $status = 'Pending';
                }

                $ledger->push([
                    'tenant' => $tenant,
                    'billing_month' => $billingMonth->copy(),
                    'due_date' => $dueDate,
                    'rent' => $monthlyRent,
                    'paid' => $amountPaid,
                    'balance' => $balance,
                    'status' => $status,
                ]);

                if ($balance > 0.009) {
                    $tenantUnpaidMonths++;
                    $tenantOutstanding += $balance;

                    $unpaidMonthNames[] = $billingMonth->format('M Y');

                    if ($status === 'Overdue') {
                        $tenantOverdueMonths++;
                    }
                }

                $month->addMonth();
            }

            $tenantSummaries->push([
                'tenant' => $tenant,
                'months_unpaid' => $tenantUnpaidMonths,
                'overdue_months' => $tenantOverdueMonths,
                'outstanding' => $tenantOutstanding,
                'unpaid_month_names' => $unpaidMonthNames,
            ]);
        }

        // Total money received from successful payments.
        $totalPayments = (float) Payment::where('owner_id', $ownerId)
            ->where('status', 'Paid')
            ->sum('amount');

        // Number of unpaid monthly rent entries.
        $pendingPayments = $ledger
            ->whereIn('status', ['Pending', 'Overdue'])
            ->count();

        // Money received during the current calendar month.
        $thisMonthPayments = (float) Payment::where('owner_id', $ownerId)
            ->where('status', 'Paid')
            ->whereMonth('payment_date', $today->month)
            ->whereYear('payment_date', $today->year)
            ->sum('amount');

        // Total outstanding rent across all generated months.
        $totalOutstanding = (float) $ledger->sum('balance');

        // Number of tenants who have at least one unpaid month.
        $tenantsWithUnpaidRent = $tenantSummaries
            ->where('months_unpaid', '>', 0)
            ->count();

        return view('owner.payments', compact(
            'tenants',
            'payments',
            'ledger',
            'tenantSummaries',
            'totalPayments',
            'pendingPayments',
            'thisMonthPayments',
            'totalOutstanding',
            'tenantsWithUnpaidRent'
        ));
    }

    // =========================================================
    // SAVE PAYMENT
    // =========================================================

    public function store(Request $request)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $validated = $request->validate([
            'tenant_id' => [
                'required',
                'integer',
                'exists:tenants,id',
            ],
            'billing_month' => [
                'required',
                'date',
            ],
            'amount' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'payment_date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:Paid,Pending',
            ],
        ]);

        $tenant = Tenant::where('id', $validated['tenant_id'])
            ->where('owner_id', $ownerId)
            ->first();

        if (!$tenant) {
            return back()
                ->withInput()
                ->with('error', 'The selected tenant does not belong to your account.');
        }

        Payment::create([
            'owner_id' => $ownerId,
            'tenant_id' => $tenant->id,
            'billing_month' => Carbon::parse(
                $validated['billing_month']
            )->startOfMonth()->toDateString(),
            'amount' => $validated['amount'],
            'payment_date' => $validated['payment_date'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('owner.payments')
            ->with('success', 'Payment saved successfully!');
    }

    // =========================================================
    // EDIT PAYMENT
    // =========================================================

    public function edit($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $payment = Payment::with('tenant')
            ->where('owner_id', $ownerId)
            ->findOrFail($id);

        $tenants = Tenant::where('owner_id', $ownerId)
            ->latest()
            ->get();

        return view('owner.payment-edit', compact(
            'payment',
            'tenants'
        ));
    }

    // =========================================================
    // UPDATE PAYMENT
    // =========================================================

    public function update(Request $request, $id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $payment = Payment::where('owner_id', $ownerId)
            ->findOrFail($id);

        $validated = $request->validate([
            'tenant_id' => [
                'required',
                'integer',
                'exists:tenants,id',
            ],
            'billing_month' => [
                'required',
                'date',
            ],
            'amount' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'payment_date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:Paid,Pending',
            ],
        ]);

        $tenant = Tenant::where('id', $validated['tenant_id'])
            ->where('owner_id', $ownerId)
            ->first();

        if (!$tenant) {
            return back()
                ->withInput()
                ->with('error', 'The selected tenant does not belong to your account.');
        }

        $payment->update([
            'tenant_id' => $tenant->id,
            'billing_month' => Carbon::parse(
                $validated['billing_month']
            )->startOfMonth()->toDateString(),
            'amount' => $validated['amount'],
            'payment_date' => $validated['payment_date'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('owner.payments')
            ->with('success', 'Payment updated successfully!');
    }

    // =========================================================
    // DELETE PAYMENT
    // =========================================================

    public function destroy($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $payment = Payment::where('owner_id', $ownerId)
            ->findOrFail($id);

        $payment->delete();

        return redirect()
            ->route('owner.payments')
            ->with('success', 'Payment deleted successfully!');
    }
}
