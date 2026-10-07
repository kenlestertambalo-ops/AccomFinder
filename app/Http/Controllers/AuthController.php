<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW STUDENT LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('student.login');
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | FIND STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Student::where(
            'email',
            $request->email
        )->first();


        /*
        |--------------------------------------------------------------------------
        | CHECK STUDENT
        |--------------------------------------------------------------------------
        */

        if (!$student) {

            return back()
                ->withInput(
                    $request->only('email')
                )
                ->withErrors([
                    'email' => 'The email or password is incorrect.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK PASSWORD
        |--------------------------------------------------------------------------
        */

        if (!Hash::check(
            $request->password,
            $student->password
        )) {

            return back()
                ->withInput(
                    $request->only('email')
                )
                ->withErrors([
                    'email' => 'The email or password is incorrect.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE LOGIN SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        $request->session()->put(
            'student_id',
            $student->id
        );

        $request->session()->put(
            'student_name',
            $student->name
        );

        $request->session()->put(
            'student_email',
            $student->email
        );

        // Make sure the session is saved
        $request->session()->save();


        /*
        |--------------------------------------------------------------------------
        | GO TO STUDENT DASHBOARD
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student.dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        $request->session()->forget([
            'student_id',
            'student_name',
            'student_email',
        ]);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('student.login');
    }
}
