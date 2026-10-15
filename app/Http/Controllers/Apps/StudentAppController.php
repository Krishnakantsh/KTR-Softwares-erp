<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;

class StudentAppController extends Controller
{
    // student app pages 

    public function dashboard()
    {
        // dd(getStudent());
        $student = getStudent();

        return view('apps/StudentApp/Screens/dashboard', compact('student'));
    }

    public function splash()
    {
        return view('apps/StudentApp/Screens/splash');
    }
    public function login()
    {
        return view('apps/StudentApp/Screens/login');
    }
    public function onboard()
    {
        return view('apps/StudentApp/Screens/onboard');
    }
    public function forgetPassword()
    {
        return view('apps/StudentApp/Screens/forgot_password');
    }
    public function otp()
    {
        return view('apps/StudentApp/Screens/otp');
    }
    public function biometricScreen()
    {
        return view('apps/StudentApp/Screens/biometric_screen');
    }
    public function quickActions()
    {
        return view('apps/StudentApp/Screens/quick_actions');
    }
    public function attendance()
    {
        return view('apps/StudentApp/Screens/attendance');
    }
    public function timetable()
    {
        return view('apps/StudentApp/Screens/timetable');
    }
    public function fees()
    {
        return view('apps/StudentApp/Screens/fees');
    }
    public function profile()
    {
        return view('apps/StudentApp/Screens/profile');
    }
    public function feeReceipt()
    {
        return view('apps/StudentApp/Screens/fee_receipt');
    }
    public function leave()
    {
        return view('apps/StudentApp/Screens/leave');
    }
}
