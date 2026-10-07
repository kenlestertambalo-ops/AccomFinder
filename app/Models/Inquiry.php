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
        'message',
        'reply',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | STUDENT
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACCOMMODATION
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
    | OWNER
    |--------------------------------------------------------------------------
    */

    public function owner()
    {
        return $this->belongsTo(
            Owner::class,
            'owner_id'
        );
    }
}
