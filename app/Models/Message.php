<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'student_id',
        'owner_id',
        'sender_type',
        'message',
    ];

    public function inquiry()
    {
        return $this->belongsTo(
            Inquiry::class,
            'inquiry_id'
        );
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }

    public function owner()
    {
        return $this->belongsTo(
            Owner::class,
            'owner_id'
        );
    }
}
