<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\Room;

class RoomController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET OWNER PROPERTY
    |--------------------------------------------------------------------------
    */

    private function getOwnerProperty($id)
    {
        $ownerId = session('owner_id');

        if (!$ownerId) {
            return null;
        }

        return Accommodation::where('id', $id)
            ->where('owner_id', $ownerId)
            ->firstOrFail();
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROPERTY AVAILABILITY
    |--------------------------------------------------------------------------
    */

    private function updatePropertyAvailability($property)
    {
        $hasAvailableRooms = $property->roomRecords()
            ->where('status', 'Available')
            ->exists();

        $property->update([
            'status' => $hasAvailableRooms
                ? 'Available'
                : 'Unavailable',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE ROOM PAGE
    |--------------------------------------------------------------------------
    */

    public function create($accommodation)
    {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $rooms = $property->roomRecords()
            ->latest()
            ->get();

        return view('owner.create-room', [
            'property' => $property,
            'rooms' => $rooms,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ROOM
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $accommodation)
    {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string|max:100',
            'status' => 'required|in:Available,Occupied',
        ]);

        $validated['accommodation_id'] = $property->id;
        $validated['amenities'] = $validated['amenities'] ?? [];

        Room::create($validated);

        $this->updatePropertyAvailability($property);

        return redirect()
            ->route('owner.listings.edit', $property->id)
            ->with('success', 'Room added successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ROOM
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $accommodation,
        $room
    ) {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $roomRecord = Room::where(
            'accommodation_id',
            $property->id
        )->findOrFail($room);

        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string|max:100',
            'status' => 'required|in:Available,Occupied',
        ]);

        $validated['amenities'] = $validated['amenities'] ?? [];

        $roomRecord->update($validated);

        $this->updatePropertyAvailability($property);

        return redirect()
            ->route('owner.listings.edit', $property->id)
            ->with('success', 'Room updated successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE ROOM
    |--------------------------------------------------------------------------
    */

    public function destroy($accommodation, $room)
    {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        $roomRecord = Room::where(
            'accommodation_id',
            $property->id
        )->findOrFail($room);

        $roomRecord->delete();

        $this->updatePropertyAvailability($property);

        return redirect()
            ->route('owner.listings.edit', $property->id)
            ->with('success', 'Room deleted successfully!');
    }
}
