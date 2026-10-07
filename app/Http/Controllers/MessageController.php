<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Inquiry;

class MessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OWNER REPLIES TO STUDENT
    |--------------------------------------------------------------------------
    */

    public function ownerReply(Request $request, $inquiryId)
    {
        // Get logged-in owner
        $ownerId = session('owner_id');

        // Check owner login
        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with('error', 'Please login as an owner first.');
        }

        // Validate message
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Find inquiry belonging to this owner
        $inquiry = Inquiry::where('id', $inquiryId)
            ->where('owner_id', $ownerId)
            ->firstOrFail();

        // Save owner's message
        Message::create([
            'inquiry_id' => $inquiry->id,
            'student_id' => $inquiry->student_id,
            'owner_id' => $ownerId,
            'sender_type' => 'owner',
            'message' => $request->message,
        ]);

        // Mark inquiry as replied
        $inquiry->update([
            'status' => 'Replied',
        ]);

        // Return to owner messages
        return redirect()
            ->route('owner.messages')
            ->with('success', 'Reply sent successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT REPLIES TO OWNER
    |--------------------------------------------------------------------------
    */

    public function studentReply(Request $request, $inquiryId)
    {
        // Get logged-in student
        $studentId = session('student_id');

        // Check student login
        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please login as a student first.');
        }

        // Validate message
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Find inquiry belonging to this student
        $inquiry = Inquiry::where('id', $inquiryId)
            ->where('student_id', $studentId)
            ->firstOrFail();

        // Save student's message
        Message::create([
            'inquiry_id' => $inquiry->id,
            'student_id' => $studentId,
            'owner_id' => $inquiry->owner_id,
            'sender_type' => 'student',
            'message' => $request->message,
        ]);

        // Mark as unread for owner
        $inquiry->update([
            'status' => 'Unread',
        ]);

        // Return to student messages
        return redirect()
            ->route('student.messages')
            ->with('success', 'Message sent successfully!');
    }
}
