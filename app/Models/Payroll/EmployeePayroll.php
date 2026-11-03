<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

/**
 * EmployeePayroll
 *
 * PURPOSE:
 * ----------
 * This is the main generated salary table.
 *
 * One employee can have only ONE payroll record for one calendar month.
 *
 * Example:
 *
 * Employee       : Rahul
 * Payroll Month  : August 2026
 * Period         : 01-Aug-2026 to 31-Aug-2026
 *
 * Salary is calculated from:
 *
 * Employee Salary Structure
 *          +
 * Attendance
 *          +
 * Paid Leave
 *          -
 * LOP
 *          +
 * Overtime
 *          +
 * Allowances
 *          +
 * Bonus / Incentive
 *          -
 * Deductions
 *          =
 * Net Salary
 *
 *
 * IMPORTANT:
 * ----------
 * This table stores the GENERATED salary snapshot.
 *
 * Suppose August salary is generated at ₹35,000.
 *
 * Later September me employee ka allowance change ho gaya.
 *
 * August payroll must remain ₹35,000.
 *
 * That's why earnings_snapshot, deductions_snapshot and salary_snapshot
 * are stored here.
 */
class EmployeePayroll extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Payroll Status
    |--------------------------------------------------------------------------
    */

    const STATUS_DRAFT = 1;
    const STATUS_GENERATED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_LOCKED = 4;
    const STATUS_PAID = 5;
    const STATUS_CANCELLED = 6;


    protected $fillable = [

        'school_id',
        'branch_id',

        'employee_id',

        'payroll_month',
        'payroll_year',

        'period_start',
        'period_end',

        'salary_structure_id',

        /*
        | Attendance
        */
        'total_days',
        'working_days',
        'present_days',
        'paid_leave_days',
        'absent_days',
        'lop_days',

        'lop_amount',

        /*
        | Earnings
        */
        'basic_salary',
        'total_allowances',
        'overtime_amount',

        'arrears',
        'bonus',
        'incentive',
        'other_earnings',

        'gross_earnings',

        /*
        | Deductions
        */
        'total_deductions',
        'loan_deduction',
        'advance_deduction',
        'other_deductions',

        /*
        | Final
        */
        'net_salary',
        'round_off',
        'payable_salary',

        /*
        | Snapshots
        */
        'earnings_snapshot',
        'deductions_snapshot',
        'salary_snapshot',

        /*
        | Status
        */
        'status',

        /*
        | Generation
        */
        'generated_at',
        'generated_by',

        /*
        | Approval
        */
        'approved_at',
        'approved_by',

        /*
        | Payment
        */
        'paid_at',
        'paid_by',

        'payment_reference',

        /*
        | Payslip
        */
        'payslip_number',
        'payslip_path',

        'remarks',
    ];


    protected $casts = [

        'payroll_month' => 'integer',
        'payroll_year' => 'integer',

        'period_start' => 'date',
        'period_end' => 'date',

        'salary_structure_id' => 'integer',

        /*
        | Attendance
        */
        'total_days' => 'decimal:2',
        'working_days' => 'decimal:2',
        'present_days' => 'decimal:2',
        'paid_leave_days' => 'decimal:2',
        'absent_days' => 'decimal:2',
        'lop_days' => 'decimal:2',

        'lop_amount' => 'decimal:2',

        /*
        | Earnings
        */
        'basic_salary' => 'decimal:2',
        'total_allowances' => 'decimal:2',
        'overtime_amount' => 'decimal:2',

        'arrears' => 'decimal:2',
        'bonus' => 'decimal:2',
        'incentive' => 'decimal:2',
        'other_earnings' => 'decimal:2',

        'gross_earnings' => 'decimal:2',

        /*
        | Deductions
        */
        'total_deductions' => 'decimal:2',
        'loan_deduction' => 'decimal:2',
        'advance_deduction' => 'decimal:2',
        'other_deductions' => 'decimal:2',

        /*
        | Final
        */
        'net_salary' => 'decimal:2',
        'round_off' => 'decimal:2',
        'payable_salary' => 'decimal:2',

        /*
        | JSON Snapshots
        */
        'earnings_snapshot' => 'array',
        'deductions_snapshot' => 'array',
        'salary_snapshot' => 'array',

        /*
        | Status
        */
        'status' => 'integer',

        /*
        | Dates
        */
        'generated_at' => 'datetime',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }

    public function school()
    {
        return $this->belongsTo(
            \App\Models\School::class
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class
        );
    }

    public function generatedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'generated_by'
        );
    }

    public function approvedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'approved_by'
        );
    }

    public function paidBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'paid_by'
        );
    }
}