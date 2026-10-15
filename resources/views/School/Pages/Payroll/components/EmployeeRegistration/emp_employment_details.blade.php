<div class="row gy-4 align-items-end mb-24">

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Branch
            </label>

            {{-- <span class="text-danger">*</span> --}}

            <div class="inner-addon">
                <i class="ri-building-2-line addon-icon"></i>

                <select name="branch_id" id="employment_branch_id"
                    class="form-control custom-premium-input ps-44 py-12 radius-8">
                    <option value="">Select Branch</option>
                </select>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Department
            </label>

            <div class="inner-addon">
                <i class="ri-organization-chart-line addon-icon"></i>

                <select name="department_id" id="employment_department_id"
                    class="form-control custom-premium-input ps-44 py-12 radius-8">
                    <option value="">Select Department</option>
                </select>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Designation
            </label>

            <div class="inner-addon">
                <i class="ri-user-star-line addon-icon"></i>

                <select name="designation_id" id="employment_designation_id"
                    class="form-control custom-premium-input ps-44 py-12 radius-8">
                    <option value="">Select Designation</option>
                </select>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Employment Type
            </label>

            <div class="inner-addon">
                <i class="ri-briefcase-4-line addon-icon"></i>

                <select name="employment_type_id" id="employment_type_id"
                    class="form-control custom-premium-input ps-44 py-12 radius-8">
                    <option value="">Select Employment Type</option>
                </select>
            </div>
        </div>
    </div>



    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Employee Code
            </label>

            <div class="inner-addon">
                <i class="ri-barcode-line addon-icon"></i>

                <input type="text" name="employee_code" id="employment_employee_code"
                    class="form-control custom-premium-input" placeholder="Enter employee code" maxlength="50">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Employee Number
            </label>

            <div class="inner-addon">
                <i class="ri-id-card-line addon-icon"></i>

                <input type="text" name="employee_number" id="employment_employee_number"
                    class="form-control custom-premium-input" placeholder="Enter employee number" maxlength="50">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Biometric ID
            </label>

            <div class="inner-addon">
                <i class="ri-fingerprint-line addon-icon"></i>

                <input type="text" name="biometric_id" id="biometric_id" class="form-control custom-premium-input"
                    placeholder="Biometric ID" maxlength="100">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Attendance Device User ID
            </label>

            <div class="inner-addon">
                <i class="ri-device-line addon-icon"></i>

                <input type="text" name="attendance_device_user_id" id="attendance_device_user_id"
                    class="form-control custom-premium-input" placeholder="Device user ID" maxlength="100">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                RFID Card Number
            </label>

            <div class="inner-addon">
                <i class="ri-bank-card-line addon-icon"></i>

                <input type="text" name="rfid_card_number" id="rfid_card_number"
                    class="form-control custom-premium-input" placeholder="RFID card number" maxlength="100">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Joining Date
            </label>

            <div class="inner-addon">
                <i class="ri-calendar-check-line addon-icon"></i>

                <input type="date" name="joining_date" id="joining_date" class="form-control custom-premium-input">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Probation Start Date
            </label>

            <div class="inner-addon">
                <i class="ri-calendar-line addon-icon"></i>

                <input type="date" name="probation_start_date" id="probation_start_date"
                    class="form-control custom-premium-input">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Probation End Date
            </label>

            <div class="inner-addon">
                <i class="ri-calendar-close-line addon-icon"></i>

                <input type="date" name="probation_end_date" id="probation_end_date"
                    class="form-control custom-premium-input">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Confirmation Date
            </label>

            <div class="inner-addon">
                <i class="ri-calendar-check-2-line addon-icon"></i>

                <input type="date" name="confirmation_date" id="confirmation_date"
                    class="form-control custom-premium-input">
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Employment Status
            </label>

            <div class="inner-addon">
                <i class="ri-user-settings-line addon-icon"></i>

                <select name="employment_status" id="employment_status"
                    class="form-control custom-premium-input ps-44 py-12 radius-8">

                    <option value="1">Active</option>
                    <option value="2">On Probation</option>
                    <option value="3">Notice Period</option>
                    <option value="4">Suspended</option>
                    <option value="5">Resigned</option>
                    <option value="6">Terminated</option>
                    <option value="7">Retired</option>
                    <option value="8">Left</option>

                </select>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Leaving Date
            </label>

            <div class="inner-addon">
                <i class="ri-calendar-close-line addon-icon"></i>

                <input type="date" name="leaving_date" id="leaving_date"
                    class="form-control custom-premium-input">
            </div>
        </div>
    </div>


    <div class="row gy-4 align-items-end">

        <div class="col-xl-6 col-md-6">
            <div class="premium-input-box">
                <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                    Leaving Reason
                </label>

                <div class="inner-addon">
                    <i class="ri-question-line addon-icon"></i>

                    <select name="leaving_reason" id="leaving_reason"
                        class="form-control custom-premium-input ps-44 py-12 radius-8">

                        <option value="">Select Reason</option>
                        <option value="1">Resignation</option>
                        <option value="2">Termination</option>
                        <option value="3">Retirement</option>
                        <option value="4">Contract End</option>
                        <option value="5">Transfer</option>
                        <option value="6">Other</option>

                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6">
            <div class="premium-input-box">

                <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                    Attendance Mode
                </label>

                <div class="inner-addon">

                    <i class="ri-fingerprint-line addon-icon"></i>

                    <select name="attendance_mode" id="attendance_mode"
                        class="form-control custom-premium-input ps-44 py-12 radius-8">

                        <option value="1">Manual</option>
                        <option value="2">Biometric</option>
                        <option value="3">RFID</option>
                        <option value="4">Face Recognition</option>
                        <option value="5">Mobile</option>
                        <option value="6">Multiple</option>

                    </select>

                </div>

            </div>
        </div>


    </div>

</div>

<div class="address-section-block mb-24">

    <p class="text-xs fw-bold text-uppercase tracking-wider mb-12 section-tag address-section-title">
        <i class="ri-fingerprint-line me-1"></i>
        Attendance Configuration
    </p>

    <div class="row gy-4 align-items-end">



        <div class="col-xl-6 col-md-6">

            <div class="premium-input-box">

                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                    Attendance Required
                </label>

                <div class="d-flex align-items-center gap-2">

                    <label class="switch mb-0">

                        <input type="checkbox" role="switch" id="is_attendance_required"
                            name="is_attendance_required" value="1" checked class="module-active-toggle">

                        <span class="slider"></span>

                    </label>

                    <span class="text-sm text-neutral-600">
                        Employee attendance is required
                    </span>

                </div>

            </div>

        </div>


        <div class="col-xl-6 col-md-6">

            <div class="premium-input-box">

                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                    Payroll Applicable
                </label>

                <div class="d-flex align-items-center gap-2">

                    <label class="switch mb-0">

                        <input type="checkbox" role="switch" id="is_payroll_applicable"
                            name="is_payroll_applicable" value="1" checked class="module-active-toggle">

                        <span class="slider"></span>

                    </label>

                    <span class="text-sm text-neutral-600">
                        Include employee in payroll
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row gy-4 mb-24">

    <div class="col-xl-6 col-md-6">

        <div class="premium-input-box">

            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Remarks
            </label>

            <textarea name="remarks" id="remarks" rows="1" class="form-control custom-premium-input"
                placeholder="Enter additional employment remarks"></textarea>

        </div>

    </div>

    <div class="col-xl-6 col-md-6">
        <div class="premium-input-box">

            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Leaving Remarks
            </label>

            <textarea name="leaving_remarks" id="leaving_remarks" rows="1" class="form-control custom-premium-input"
                placeholder="Enter leaving remarks"></textarea>

        </div>
    </div>

</div>
