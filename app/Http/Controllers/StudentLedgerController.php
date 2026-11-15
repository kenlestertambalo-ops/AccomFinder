<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class StudentLedgerController extends Controller
{
    public function index(Request $request)
    {
        $studentId = $request->session()->get('student_id');
        $studentEmail = $request->session()->get('student_email');

        // Make sure the student is logged in.
        if (!$studentId || !$studentEmail) {
            return redirect()->route('student.login')
                ->with('error', 'Please log in to view your rental ledger.');
        }

        // Check whether the student_id column exists.
        $hasStudentIdColumn = Schema::hasColumn('tenants', 'student_id');

        // Find the tenant assigned by the owner to view the ledger.
        $tenantQuery = Tenant::query()
            ->where('tenants.status', 'Active')
            ->where(function ($query) use (
                $studentId,
                $studentEmail,
                $hasStudentIdColumn
            ) {
                if ($hasStudentIdColumn) {
                    $query->where('tenants.student_id', $studentId)
                        ->orWhereRaw(
                            'LOWER(tenants.email) = ?',
                            [strtolower(trim($studentEmail))]
                        );
                } else {
                    $query->whereRaw(
                        'LOWER(tenants.email) = ?',
                        [strtolower(trim($studentEmail))]
                    );
                }
            })
            ->whereHas('room', function ($query) {
                $query->whereColumn(
                    'rooms.ledger_tenant_id',
                    'tenants.id'
                );
            })
            ->with([
                'room',
                'accommodation',
                'payments',
            ]);

        $tenant = $tenantQuery->first();

        // No ledger has been assigned to this student.
        if (!$tenant) {
            return view('student.rental-ledger', [
                'tenant' => null,
                'ledger' => collect(),
                'totalCharges' => 0,
                'totalPaid' => 0,
                'outstandingBalance' => 0,
            ]);
        }

        // Make sure the rental start date exists.
        if (!$tenant->start_date) {
            return view('student.rental-ledger', [
                'tenant' => $tenant,
                'ledger' => collect(),
                'totalCharges' => 0,
                'totalPaid' => 0,
                'outstandingBalance' => 0,
                'ledgerError' => 'Your rental start date has not been recorded.',
            ]);
        }

        // Determine the rental period.
        $start = Carbon::parse($tenant->start_date)->startOfMonth();

        $end = $tenant->end_date
            ? Carbon::parse($tenant->end_date)->startOfMonth()
            : now()->startOfMonth();

        // Prevent an invalid rental period.
        if ($end->lt($start)) {
            return view('student.rental-ledger', [
                'tenant' => $tenant,
                'ledger' => collect(),
                'totalCharges' => 0,
                'totalPaid' => 0,
                'outstandingBalance' => 0,
                'ledgerError' => 'The rental end date cannot be earlier than the start date.',
            ]);
        }

        $monthlyRent = (float) $tenant->monthly_rent;

        $dueDay = max(
            1,
            min(31, (int) ($tenant->due_day ?? 5))
        );

        $transactions = collect();

        /*
         * Generate monthly rent charges.
         */
        for (
            $month = $start->copy();
            $month->lte($end);
            $month->addMonth()
        ) {
            $chargeDate = $month->copy()->day(
                min($dueDay, $month->daysInMonth)
            );

            $transactions->push([
                'date' => $chargeDate->copy(),
                'particulars' => $month->format('F Y') . ' Rent',
                'debit' => $monthlyRent,
                'credit' => 0,
                'sort_order' => 0,
            ]);
        }

        /*
         * Add confirmed payments only.
         */
        foreach ($tenant->payments as $payment) {
            if (strtolower(trim($payment->status ?? '')) !== 'paid') {
                continue;
            }

            $paymentDate = $payment->payment_date
                ? Carbon::parse($payment->payment_date)
                : Carbon::parse($payment->created_at);

            $transactions->push([
                'date' => $paymentDate->copy(),
                'particulars' => 'Rent Payment',
                'debit' => 0,
                'credit' => (float) $payment->amount,
                'sort_order' => 1,
            ]);
        }

        /*
         * Sort transactions by date.
         * Rent charges appear before payments on the same date.
         */
        $transactions = $transactions->sort(
            function ($a, $b) {
                $comparison = $a['date']->timestamp
                    <=> $b['date']->timestamp;

                if ($comparison !== 0) {
                    return $comparison;
                }

                return $a['sort_order'] <=> $b['sort_order'];
            }
        )->values();

        /*
         * Calculate the running balance.
         */
        $runningBalance = 0;

        $ledger = $transactions->map(
            function ($transaction) use (&$runningBalance) {
                $runningBalance += $transaction['debit'];
                $runningBalance -= $transaction['credit'];

                return [
                    'date' => $transaction['date'],
                    'particulars' => $transaction['particulars'],
                    'debit' => $transaction['debit'],
                    'credit' => $transaction['credit'],
                    'balance' => $runningBalance,
                ];
            }
        );

        /*
         * Calculate ledger totals.
         */
        $totalCharges = (float) $transactions->sum('debit');

        $totalPaid = (float) $transactions->sum('credit');

        $outstandingBalance = max(0, $runningBalance);

        return view('student.rental-ledger', compact(
            'tenant',
            'ledger',
            'totalCharges',
            'totalPaid',
            'outstandingBalance'
        ));
    }
}
