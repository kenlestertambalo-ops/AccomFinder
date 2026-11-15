<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accommodation;
use App\Models\Tenant;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'accommodation_id',
        'room_name',
        'price',
        'capacity',
        'current_occupants',
        'bathrooms',
        'bathroom_type',
        'description',
        'amenities',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'current_occupants' => 'integer',
        'bathrooms' => 'integer',
        'amenities' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | ROOM BELONGS TO ACCOMMODATION
    |--------------------------------------------------------------------------
    */

    public function accommodation()
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ROOM HAS MANY TENANTS
    |--------------------------------------------------------------------------
    */

    public function tenants()
    {
        return $this->hasMany(
            Tenant::class,
            'room_id'
        );
    }
}
