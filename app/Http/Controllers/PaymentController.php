<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Tenant;

class PaymentController extends Controller
{
    // =========================================================
    // PAYMENT RECORDS PAGE
    // =========================================================

    public function index()
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        // Get only tenants belonging to the logged-in owner
        $tenants = Tenant::where('owner_id', $ownerId)
            ->latest()
            ->get();

        // Get only payments belonging to the logged-in owner
        $payments = Payment::with('tenant')
            ->where('owner_id', $ownerId)
            ->latest()
            ->get();

        // Total payments
        $totalPayments = Payment::where(
            'owner_id',
            $ownerId
        )->sum('amount');

        // Pending payments
        $pendingPayments = Payment::where(
            'owner_id',
            $ownerId
        )->where(
            'status',
            'Pending'
        )->count();

        // This month's payments
        $thisMonthPayments = Payment::where(
            'owner_id',
            $ownerId
        )
        ->whereMonth(
            'payment_date',
            now()->month
        )
        ->whereYear(
            'payment_date',
            now()->year
        )
        ->sum('amount');

        return view(
            'owner.payments',
            compact(
                'tenants',
                'payments',
                'totalPayments',
                'pendingPayments',
                'thisMonthPayments'
            )
        );
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

        // Validate payment information
        $request->validate([
            'tenant_id' => [
                'required',
                'integer',
                'exists:tenants,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'string',
                'in:Paid,Pending',
            ],
        ]);


        // Make sure the selected tenant belongs
        // to the logged-in owner
        $tenant = Tenant::where(
            'id',
            $request->tenant_id
        )
        ->where(
            'owner_id',
            $ownerId
        )
        ->first();


        if (!$tenant) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'The selected tenant does not belong to your account.'
                );
        }


        // Create payment
        Payment::create([
            'owner_id' => $ownerId,
            'tenant_id' => $tenant->id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'status' => $request->status,
        ]);


        // Return to Payment Records
        return redirect()
            ->route('owner.payments')
            ->with(
                'success',
                'Payment saved successfully!'
            );
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


        // Only allow this owner to edit their own payment
        $payment = Payment::with('tenant')
            ->where('owner_id', $ownerId)
            ->findOrFail($id);


        // Get only this owner's tenants
        $tenants = Tenant::where('owner_id', $ownerId)
            ->latest()
            ->get();


        return view(
            'owner.payment-edit',
            compact(
                'payment',
                'tenants'
            )
        );
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


        // Only allow this owner to update their own payment
        $payment = Payment::where(
            'owner_id',
            $ownerId
        )->findOrFail($id);


        // Validate updated information
        $request->validate([
            'tenant_id' => [
                'required',
                'integer',
                'exists:tenants,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'string',
                'in:Paid,Pending',
            ],
        ]);


        // Make sure selected tenant belongs
        // to the logged-in owner
        $tenant = Tenant::where(
            'id',
            $request->tenant_id
        )
        ->where(
            'owner_id',
            $ownerId
        )
        ->first();


        if (!$tenant) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'The selected tenant does not belong to your account.'
                );
        }


        // Update payment
        $payment->update([
            'tenant_id' => $tenant->id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'status' => $request->status,
        ]);


        // Return to payment records
        return redirect()
            ->route('owner.payments')
            ->with(
                'success',
                'Payment updated successfully!'
            );
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


        // Only allow this owner to delete their own payment
        $payment = Payment::where(
            'owner_id',
            $ownerId
        )->findOrFail($id);


        // Delete payment
        $payment->delete();


        // Return to payment records
        return redirect()
            ->route('owner.payments')
            ->with(
                'success',
                'Payment deleted successfully!'
            );
    }
}
