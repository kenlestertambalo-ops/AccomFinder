<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function search()
    {
        return view('student.search');
    }

    public function saved()
    {
        return view('student.saved');
    }

    public function messages()
    {
        $inquiries = Inquiry::latest()->get();

        return view('student.messages', compact('inquiries'));
    }
}
