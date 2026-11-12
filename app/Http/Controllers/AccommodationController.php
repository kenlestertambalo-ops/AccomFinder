<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\SavedProperty;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CREATE ACCOMMODATION
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (!session('owner_id')) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        return view('owner.create-listing');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ACCOMMODATION
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imagePath = $request->file('image')
            ->store('accommodations', 'public');

        try {

            $accommodation = Accommodation::create([
                'owner_id' => $ownerId,

                'name' => $validated['title'],
                'address' => $validated['location'],
                'type' => $validated['type'],

                'description' => $validated['description'] ?? null,

                // Room-specific information is stored in the rooms table.
                'price' => 0,
                'bedrooms' => 0,
                'bathrooms' => 0,
                'capacity' => 1,
                'amenities' => [],

                // Property becomes available after rooms are added.
                'status' => 'Unavailable',

                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],

                'image' => $imagePath,
            ]);

        } catch (\Throwable $e) {

            Storage::disk('public')->delete($imagePath);

            throw $e;
        }

        return redirect()
            ->route('owner.rooms.create', $accommodation->id)
            ->with(
                'success',
                'Property created successfully! You can now add rooms.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function studentDashboard()
    {
        $studentId = session('student_id');

        // Load available properties and their associated rooms.
        $approvedListings = Accommodation::where('status', 'Available')
            ->with('roomRecords')
            ->latest()
            ->get();

        // Count available properties.
        $availableListings = Accommodation::where('status', 'Available')
            ->count();

        // Count saved properties.
        $savedPropertiesCount = 0;

        if ($studentId) {
            $savedPropertiesCount = SavedProperty::where(
                'student_id',
                $studentId
            )->count();
        }

        // Count available property locations.
        $locations = Accommodation::where('status', 'Available')
            ->whereNotNull('address')
            ->where('address', '!=', '')
            ->distinct()
            ->count('address');

        return view(
            'student.dashboard',
            compact(
                'approvedListings',
                'availableListings',
                'savedPropertiesCount',
                'locations'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT ACCOMMODATION LISTINGS
    |--------------------------------------------------------------------------
    */

    public function studentListings()
    {
        $accommodations = Accommodation::where('status', 'Available')
            ->with('roomRecords')
            ->latest()
            ->get();

        return view(
            'student.search',
            compact('accommodations')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT ACCOMMODATION DETAILS
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        // Find the selected property and load its rooms.
        $accommodation = Accommodation::with('roomRecords')
            ->findOrFail($id);

        // Pass the room collection to the details Blade file.
        $rooms = $accommodation->roomRecords;

        return view(
            'student.accommodation-details',
            compact(
                'accommodation',
                'rooms'
            )
        );
    }
}
