<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedProperty;
use App\Models\Accommodation;

class SavedPropertyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW SAVED PROPERTIES
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please login first.');
        }

        $savedProperties = SavedProperty::with('accommodation')
            ->where('student_id', $studentId)
            ->latest()
            ->get()
            ->map(function ($saved) {
                return $saved->accommodation;
            })
            ->filter();

        return view(
            'student.saved',
            compact('savedProperties')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE PROPERTY
    |--------------------------------------------------------------------------
    */

    public function store($id)
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please login first.');
        }

        $accommodation = Accommodation::findOrFail($id);

        SavedProperty::firstOrCreate([
            'student_id' => $studentId,
            'accommodation_id' => $accommodation->id,
        ]);

        return redirect()
            ->route('student.saved')
            ->with('success', 'Accommodation saved successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | REMOVE SAVED PROPERTY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please login first.');
        }

        SavedProperty::where('student_id', $studentId)
            ->where('accommodation_id', $id)
            ->delete();

        return redirect()
            ->route('student.saved')
            ->with('success', 'Accommodation removed from saved.');
    }
}
