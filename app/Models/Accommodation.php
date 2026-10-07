<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $table = 'accommodations';

    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'price',
        'type',
        'bedrooms',
        'bathrooms',
        'size',
        'capacity',
        'description',
        'amenities',
        'status',
        'latitude',
        'longitude',
        'approval_status',
    ];

    protected $casts = [
        'amenities' => 'array',
        'price' => 'decimal:2',
        'size' => 'decimal:2',
        'capacity' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    /**
     * Accommodation belongs to an owner.
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    /**
     * Accommodation has many tenants.
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'accommodation_id');
    }

    /**
     * Accommodation has many inquiries.
     */
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'accommodation_id');
    }
}
