<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'price',
        'type',
        'bedrooms',
        'bathrooms',
        'capacity',
        'size',
        'description',
        'amenities',
        'status',
        'approval_status',
        'latitude',
        'longitude',
        'image',
    ];

    protected $casts = [
        'amenities' => 'array',
        'price' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];
}
