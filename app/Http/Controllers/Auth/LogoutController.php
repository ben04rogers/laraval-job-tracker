<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function store() {
        auth()->logout();

        Session::flash('message', 'Successfully logged out'); 

        return redirect()->route("home");
    }
}
