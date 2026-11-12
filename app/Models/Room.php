<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'accommodation_id',
        'room_name',
        'price',
        'capacity',
        'bathrooms',
        'description',
        'amenities',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'amenities' => 'array',
    ];

    public function accommodation()
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }
}
