<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logOutController extends Controller
{
    public function logout(){
        Session::flush();
        Auth::logOut();

        return redirect()->route('login');
    }
}
