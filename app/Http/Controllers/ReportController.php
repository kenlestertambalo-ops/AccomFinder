<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Tenant;
use App\Models\Payment;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()->route('owner.login');
        }

        // OWNER LISTINGS
        $reportListings = Accommodation::where('owner_id', $ownerId)
            ->latest()
            ->get();

        // OWNER TENANTS
        $reportTenants = Tenant::where('owner_id', $ownerId)
            ->with('accommodation')
            ->latest()
            ->get();

        // OWNER PAYMENTS
        $reportPayments = Payment::where('owner_id', $ownerId)
            ->with('tenant')
            ->latest()
            ->get();

        // BASIC TOTALS
        $totalListings = $reportListings->count();
        $totalTenants = $reportTenants->count();
        $totalPayments = $reportPayments->count();

        $paidPayments = $reportPayments->filter(function ($payment) {
            return strtolower(trim($payment->status ?? '')) === 'paid';
        });

        $totalRevenue = (float) $paidPayments->sum('amount');

        $pendingRevenue = (float) $reportPayments
            ->filter(function ($payment) {
                return strtolower(trim($payment->status ?? '')) === 'pending';
            })
            ->sum('amount');

        $expectedRevenue = $totalRevenue + $pendingRevenue;

        $collectionRate = $expectedRevenue > 0
            ? ($totalRevenue / $expectedRevenue) * 100
            : 0;

        // WEEKLY REVENUE
        $currentWeekStart = now()->startOfWeek(Carbon::MONDAY);

        $weeklyLabels = [];
        $weeklyRevenue = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $currentWeekStart->copy()->addDays($i);

            $weeklyLabels[] = $date->format('D');

            $weeklyRevenue[] = (float) $paidPayments
                ->filter(function ($payment) use ($date) {
                    return $payment->payment_date
                        && Carbon::parse($payment->payment_date)
                            ->isSameDay($date);
                })
                ->sum('amount');
        }

        $weeklyTotal = array_sum($weeklyRevenue);

        // MONTHLY REVENUE BY BILLING MONTH
        $currentYear = now()->year;

        $monthlyLabels = [];
        $monthlyRevenue = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyLabels[] = Carbon::create($currentYear, $month, 1)
                ->format('M');

            $monthlyRevenue[] = (float) $paidPayments
                ->filter(function ($payment) use ($month, $currentYear) {
                    $date = $payment->billing_month
                        ? Carbon::parse($payment->billing_month)
                        : ($payment->payment_date
                            ? Carbon::parse($payment->payment_date)
                            : null);

                    return $date
                        && $date->year == $currentYear
                        && $date->month == $month;
                })
                ->sum('amount');
        }

        $monthlyTotal = array_sum($monthlyRevenue);

        // YEARLY REVENUE
        $yearlyData = [];

        foreach ($paidPayments as $payment) {
            $date = $payment->billing_month
                ? Carbon::parse($payment->billing_month)
                : ($payment->payment_date
                    ? Carbon::parse($payment->payment_date)
                    : null);

            if (!$date) {
                continue;
            }

            $year = $date->year;

            $yearlyData[$year] = ($yearlyData[$year] ?? 0)
                + (float) $payment->amount;
        }

        if (empty($yearlyData)) {
            $yearlyData[$currentYear] = 0;
        }

        ksort($yearlyData);

        $yearlyLabels = array_keys($yearlyData);
        $yearlyRevenue = array_values($yearlyData);
        $yearlyTotal = array_sum($yearlyRevenue);

        // GROUP PAID PAYMENTS BY TENANT AND BILLING MONTH
        $paymentsByTenantMonth = $paidPayments->groupBy(function ($payment) {
            $month = $payment->billing_month
                ? Carbon::parse($payment->billing_month)->format('Y-m')
                : ($payment->payment_date
                    ? Carbon::parse($payment->payment_date)->format('Y-m')
                    : 'unknown');

            return $payment->tenant_id . '|' . $month;
        });

        // MONTHLY RENT LEDGER
        $ledger = [];
        $tenantSummaries = [];

        $totalOutstanding = 0;
        $tenantsWithUnpaidRent = 0;
        $pendingMonths = 0;
        $overdueMonths = 0;

        foreach ($reportTenants as $tenant) {

            if (!$tenant->start_date || !$tenant->monthly_rent) {
                continue;
            }

            $start = Carbon::parse($tenant->start_date)->startOfMonth();
            $end = now()->startOfMonth();

            if ($tenant->end_date) {
                $endDate = Carbon::parse($tenant->end_date)->startOfMonth();

                if ($endDate->lt($end)) {
                    $end = $endDate;
                }
            }

            if ($start->gt($end)) {
                continue;
            }

            $unpaidMonths = [];
            $tenantOutstanding = 0;
            $tenantOverdueMonths = 0;

            for (
                $month = $start->copy();
                $month->lte($end);
                $month->addMonth()
            ) {
                $monthKey = $month->format('Y-m');
                $groupKey = $tenant->id . '|' . $monthKey;

                $rent = (float) $tenant->monthly_rent;

                $paid = (float) $paymentsByTenantMonth
                    ->get($groupKey, collect())
                    ->sum('amount');

                $balance = max(0, $rent - $paid);

                $dueDay = max(
                    1,
                    min(31, (int) ($tenant->due_day ?? 5))
                );

                $dueDate = $month->copy()->day(
                    min($dueDay, $month->daysInMonth)
                );

                if ($balance <= 0.009) {
                    $status = 'Paid';
                } elseif (now()->startOfDay()->gt($dueDate)) {
                    $status = 'Overdue';
                } else {
                    $status = 'Pending';
                }

                if ($balance > 0.009) {
                    $unpaidMonths[] = $month->format('F Y');

                    $tenantOutstanding += $balance;
                    $pendingMonths++;

                    if ($status === 'Overdue') {
                        $tenantOverdueMonths++;
                        $overdueMonths++;
                    }
                }

                $ledger[] = [
                    'tenant' => $tenant,
                    'billing_month' => $month->copy(),
                    'rent' => $rent,
                    'paid' => $paid,
                    'balance' => $balance,
                    'due_date' => $dueDate,
                    'status' => $status,
                ];
            }

            if ($tenantOutstanding > 0) {
                $tenantsWithUnpaidRent++;
            }

            $totalOutstanding += $tenantOutstanding;

            $tenantSummaries[] = [
                'tenant' => $tenant,
                'monthly_rent' => (float) $tenant->monthly_rent,
                'unpaid_months' => $unpaidMonths,
                'unpaid_count' => count($unpaidMonths),
                'overdue_count' => $tenantOverdueMonths,
                'outstanding' => $tenantOutstanding,
            ];
        }

        // SEND ALL DATA TO REPORTS BLADE
        return view('owner.reports', compact(
            'reportListings',
            'reportTenants',
            'reportPayments',

            'totalListings',
            'totalTenants',
            'totalPayments',

            'totalRevenue',
            'pendingRevenue',
            'expectedRevenue',
            'collectionRate',

            'currentYear',

            'weeklyLabels',
            'weeklyRevenue',
            'weeklyTotal',

            'monthlyLabels',
            'monthlyRevenue',
            'monthlyTotal',

            'yearlyLabels',
            'yearlyRevenue',
            'yearlyTotal',

            'ledger',
            'tenantSummaries',

            'totalOutstanding',
            'tenantsWithUnpaidRent',
            'pendingMonths',
            'overdueMonths'
        ));
    }
}
