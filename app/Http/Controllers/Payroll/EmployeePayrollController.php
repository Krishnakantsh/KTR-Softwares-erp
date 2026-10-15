<?php


namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;


class EmployeePayrollController extends Controller
{
    public function index()
    {
        return view('School.Pages.Payroll.PayrollMaster.main');
    }
}
