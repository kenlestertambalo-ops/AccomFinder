<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Accommodation;
use App\Models\Message;

class InquiryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STUDENT SENDS INITIAL INQUIRY
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $id)
    {
        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please login as a student first.');
        }

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $accommodation = Accommodation::find($id);

        if (!$accommodation) {
            return back()->with(
                'error',
                'The accommodation could not be found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE INQUIRY
        |--------------------------------------------------------------------------
        */

        $inquiry = new Inquiry();

        $inquiry->student_id = $studentId;
        $inquiry->accommodation_id = $accommodation->id;
        $inquiry->owner_id = $accommodation->owner_id;
        $inquiry->message = $request->message;
        $inquiry->status = 'Unread';

        $inquiry->save();

        /*
        |--------------------------------------------------------------------------
        | SAVE INITIAL MESSAGE
        |--------------------------------------------------------------------------
        */

        Message::create([
            'inquiry_id' => $inquiry->id,
            'student_id' => $studentId,
            'owner_id' => $accommodation->owner_id,
            'sender_type' => 'student',
            'message' => $request->message,
        ]);

        return back()->with(
            'success',
            'Inquiry sent successfully!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | OWNER MESSAGES
    |--------------------------------------------------------------------------
    */

    public function ownerMessages()
    {
        /*
        |--------------------------------------------------------------------------
        | GET LOGGED-IN OWNER
        |--------------------------------------------------------------------------
        */

        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GET OWNER INQUIRIES
        |--------------------------------------------------------------------------
        */

        $inquiries = Inquiry::with([
            'student',
            'accommodation'
        ])
        ->where('owner_id', $ownerId)
        ->latest()
        ->get();

        /*
        |--------------------------------------------------------------------------
        | GET ALL CONVERSATION MESSAGES
        |--------------------------------------------------------------------------
        */

        $messages = Message::where('owner_id', $ownerId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('inquiry_id');

        return view(
            'owner.messages',
            compact('inquiries', 'messages')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | OWNER REPLIES TO STUDENT
    |--------------------------------------------------------------------------
    */

    public function reply(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | GET LOGGED-IN OWNER
        |--------------------------------------------------------------------------
        */

        $ownerId = session('owner_id');

        if (!$ownerId) {
            return redirect()
                ->route('owner.login')
                ->with(
                    'error',
                    'Please login as an owner first.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE REPLY
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        /*
        |--------------------------------------------------------------------------
        | FIND INQUIRY BELONGING TO THIS OWNER
        |--------------------------------------------------------------------------
        */

        $inquiry = Inquiry::where('id', $id)
            ->where('owner_id', $ownerId)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | SAVE OWNER MESSAGE
        |--------------------------------------------------------------------------
        */

        Message::create([
            'inquiry_id' => $inquiry->id,
            'student_id' => $inquiry->student_id,
            'owner_id' => $ownerId,
            'sender_type' => 'owner',
            'message' => $request->reply,
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE INQUIRY STATUS
        |--------------------------------------------------------------------------
        */

        $inquiry->status = 'Replied';
        $inquiry->save();

        return redirect()
            ->route('owner.messages')
            ->with(
                'success',
                'Reply sent successfully!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT MESSAGES
    |--------------------------------------------------------------------------
    */

    public function studentMessages()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with(
                    'error',
                    'Please login as a student first.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GET STUDENT INQUIRIES
        |--------------------------------------------------------------------------
        */

        $inquiries = Inquiry::with([
            'student',
            'accommodation',
            'owner'
        ])
        ->where('student_id', $studentId)
        ->latest()
        ->get();

        /*
        |--------------------------------------------------------------------------
        | GET ALL CONVERSATION MESSAGES
        |--------------------------------------------------------------------------
        */

        $messages = Message::where('student_id', $studentId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('inquiry_id');

        return view(
            'student.messages',
            compact('inquiries', 'messages')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT REPLIES TO OWNER
    |--------------------------------------------------------------------------
    */

    public function studentReply(Request $request, $id)
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()
                ->route('student.login')
                ->with(
                    'error',
                    'Please login as a student first.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE MESSAGE
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        /*
        |--------------------------------------------------------------------------
        | FIND STUDENT'S INQUIRY
        |--------------------------------------------------------------------------
        */

        $inquiry = Inquiry::where('id', $id)
            ->where('student_id', $studentId)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | SAVE STUDENT MESSAGE
        |--------------------------------------------------------------------------
        */

        Message::create([
            'inquiry_id' => $inquiry->id,
            'student_id' => $studentId,
            'owner_id' => $inquiry->owner_id,
            'sender_type' => 'student',
            'message' => $request->message,
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $inquiry->status = 'Unread';
        $inquiry->save();

        return redirect()
            ->route('student.messages')
            ->with(
                'success',
                'Reply sent successfully!'
            );
    }
}
