<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LogoutController extends Controller
{
    //
    
    use AuthenticatesUsers {
        logout as performLogout;
    }
    public function logoutUser(Request $request)
    {
        $this->performLogout($request);
        return redirect('home/dashboard');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logoutUser');
    }
}
