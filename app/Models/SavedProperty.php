<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedProperty extends Model
{
    use HasFactory;

    protected $table = 'saved_properties';

    protected $fillable = [
        'student_id',
        'accommodation_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Student
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accommodation
    |--------------------------------------------------------------------------
    */

    public function accommodation()
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }
}
