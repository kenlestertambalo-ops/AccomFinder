<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';

    protected $fillable = [
        'owner_id',
        'student_id',
        'accommodation_id',
        'name',
        'email',
        'phone',
        'property_type',
        'start_date',
        'end_date',
        'monthly_rent',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'monthly_rent' => 'decimal:2',
    ];


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


    // =========================================================
    // STUDENT
    // =========================================================

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }


    // =========================================================
    // ACCOMMODATION
    // =========================================================

    public function accommodation()
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }
}
