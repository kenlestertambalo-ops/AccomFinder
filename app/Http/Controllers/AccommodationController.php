<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\SavedProperty;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    public function create()
    {
        if (!session('owner_id')) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        return view('owner.create-listing');
    }

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
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:100',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string|max:100',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imagePath = $request->file('image')
            ->store('accommodations', 'public');

        try {
            Accommodation::create([
                'owner_id' => $ownerId,
                'name' => $validated['title'],
                'address' => $validated['location'],
                'price' => $validated['price'],
                'type' => $validated['type'],
                'bedrooms' => $validated['bedrooms'],
                'bathrooms' => $validated['bathrooms'],
                'capacity' => $validated['capacity'],
                'description' => $validated['description'] ?? null,
                'amenities' => $validated['amenities'] ?? [],
                'status' => $request->boolean('available')
                    ? 'Available'
                    : 'Unavailable',
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'image' => $imagePath,
            ]);
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($imagePath);

            throw $e;
        }

        return redirect()
            ->route('owner.listings')
            ->with(
                'success',
                'New listing created successfully and is now visible to students!'
            );
    }

    public function studentDashboard()
    {
        $studentId = session('student_id');

        $approvedListings = Accommodation::where('status', 'Available')
            ->latest()
            ->get();

        $availableListings = Accommodation::where('status', 'Available')
            ->count();

        $savedPropertiesCount = 0;

        if ($studentId) {
            $savedPropertiesCount = SavedProperty::where(
                'student_id',
                $studentId
            )->count();
        }

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

    public function studentListings()
    {
        $accommodations = Accommodation::where('status', 'Available')
            ->latest()
            ->get();

        return view('student.search', compact('accommodations'));
    }

    public function show($id)
    {
        $accommodation = Accommodation::findOrFail($id);

        return view(
            'student.accommodation-details',
            compact('accommodation')
        );
    }
}
