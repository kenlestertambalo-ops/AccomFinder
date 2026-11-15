<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Accommodation;
use App\Models\Room;

class RoomController extends Controller
{
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

    public function create($accommodation)
    {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()->route('owner.login');
        }

        $rooms = $property->roomRecords()
            ->orderBy('room_name')
            ->get();

        return view('owner.create-room', compact(
            'property',
            'rooms'
        ));
    }

    public function store(Request $request, $accommodation)
    {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()->route('owner.login');
        }

        $validated = $this->validateRoom($request);

        Room::create([
            ...$validated,
            'accommodation_id' => $property->id,
        ]);

        $this->updatePropertyAvailability($property);

        return redirect()
            ->route('owner.rooms.create', $property->id)
            ->with('success', 'Room added successfully!');
    }

    public function update(
        Request $request,
        $accommodation,
        $room
    ) {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()->route('owner.login');
        }

        $roomRecord = Room::where(
            'accommodation_id',
            $property->id
        )->findOrFail($room);

        $validated = $this->validateRoom($request);

        $roomRecord->update($validated);

        $this->updatePropertyAvailability($property);

        return redirect()
            ->route('owner.rooms.create', $property->id)
            ->with('success', 'Room information updated!');
    }

    public function destroy($accommodation, $room)
    {
        $property = $this->getOwnerProperty($accommodation);

        if (!$property) {
            return redirect()->route('owner.login');
        }

        $roomRecord = Room::where(
            'accommodation_id',
            $property->id
        )->findOrFail($room);

        $roomRecord->delete();

        $this->updatePropertyAvailability($property);

        return redirect()
            ->route('owner.rooms.create', $property->id)
            ->with('success', 'Room deleted successfully!');
    }

    private function validateRoom(Request $request)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'current_occupants' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'bathroom_type' => 'required|in:Private,Shared',
            'description' => 'nullable|string|max:2000',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string|max:100',
            'status' => 'required|in:Available,Occupied,Maintenance',
        ]);

        if ($validated['current_occupants'] > $validated['capacity']) {
            throw ValidationException::withMessages([
                'current_occupants' =>
                    'Current occupants cannot exceed room capacity.',
            ]);
        }

        if ($validated['status'] === 'Available'
            && $validated['current_occupants'] >= $validated['capacity']) {
            throw ValidationException::withMessages([
                'status' =>
                    'A fully occupied room cannot be marked Available.',
            ]);
        }

        if ($validated['current_occupants'] >= $validated['capacity']
            && $validated['status'] === 'Available') {
            $validated['status'] = 'Occupied';
        }

        $validated['amenities'] = $validated['amenities'] ?? [];

        return $validated;
    }
}
