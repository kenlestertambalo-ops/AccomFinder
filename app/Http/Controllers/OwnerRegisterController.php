<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerRegisterController extends Controller
{
    /**
     * Show owner registration page
     */
    public function showRegister()
    {
        return view('owner.register');
    }


    /**
     * Save new owner account
     */
    public function register(Request $request)
    {
        // Validate registration form
        $request->validate([
            'name' => 'required|string|max:255',

            'company_name' => 'nullable|string|max:255',

            'email' => 'required|email|max:255|unique:owners,email',

            'phone' => 'required|string|max:30',

            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' =>
                'Please enter your full name.',

            'email.required' =>
                'Please enter your email.',

            'email.email' =>
                'Please enter a valid email address.',

            'email.unique' =>
                'This email is already registered.',

            'phone.required' =>
                'Please enter your phone number.',

            'password.required' =>
                'Please enter a password.',

            'password.min' =>
                'Password must be at least 8 characters.',

            'password.confirmed' =>
                'Passwords do not match.',
        ]);


        // Create owner account
        Owner::create([
            'name' => $request->name,

            'company_name' => $request->company_name,

            'email' => $request->email,

            'phone' => $request->phone,

            // Never save the password as plain text
            'password' => Hash::make($request->password),
        ]);


        // Return to owner login
        return redirect()
            ->route('owner.login')
            ->with(
                'success',
                'Owner account created successfully. You can now login.'
            );
    }
}
