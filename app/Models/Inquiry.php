<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiries';

    protected $fillable = [
        'student_id',
        'accommodation_id',
        'owner_id',
        'tenant_id',
        'room_id',
        'message',
        'reply',
        'status',
        'inquiry_type',
        'visit_date',
        'visit_time',
        'visit_status',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
