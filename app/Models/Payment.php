<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'owner_id',
        'tenant_id',
        'amount',
        'payment_date',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];


    // =========================================================
    // TENANT
    // =========================================================

    public function tenant()
    {
        return $this->belongsTo(
            Tenant::class,
            'tenant_id'
        );
    }


    // =========================================================
    // OWNER
    // =========================================================

    public function owner()
    {
        return $this->belongsTo(
            Owner::class,
            'owner_id'
        );
    }
}
