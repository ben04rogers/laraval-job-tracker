<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Only users not logged in can view register page
    public function __construct() {
        $this->middleware(["guest"]);
    }
    
    public function index() {
        return view("auth.register");
    }
    
    public function store(Request $request) {
        // validate
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);

        // Creates a user in the databse
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Sign in
        auth()->attempt($request->only("email", "password"));

        return redirect()->route('home');
    }
}
