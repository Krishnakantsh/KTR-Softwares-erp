<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function forgot_password(){
        return view('Frontend/Authentication/forgot-password');
    }
    public function reset_password(){
        return view('Frontend/Authentication/reset-password');
    }
}
