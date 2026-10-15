<div class="modal fade" id="payrollShiftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="payrollShiftModalTitle">
                        Create Shift
                    </h6>

                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <form id="shiftRegistrationForm" class="ajaxForm" data-url="{{ route('school.payroll_shift.save') }}"
                data-refresh="fetchRegisteredShifts" data-method="POST" autocomplete="off"
                enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="id" id="shift_id">

                <div class="modal-body p-28">
                    <!-- Basic Information -->
                    <div class="form-segment mb-28">
                        <div class="row gy-4 align-items-end mb-8">

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Branch <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-building-4-line addon-icon"></i>
                                        <select
                                            class="form-control custom-premium-input ps-44 py-12 radius-8 payroll_branch_id"
                                            id="branch_id" name="branch_id" required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Shift Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-hashtag addon-icon"></i>
                                        <input type="text" name="shift_code" id="shift_code"
                                            class="form-control custom-premium-input" placeholder="e.g. MORNING-01"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Shift Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-history-line addon-icon"></i>
                                        <input type="text" name="shift_name" id="shift_name"
                                            class="form-control custom-premium-input"
                                            placeholder="e.g. General Morning Shift" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-light radius-8 border">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="is_overnight">
                                        Overnight Shift (Cross Midnight)
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch mb-0">
                                            <input type="checkbox" role="switch" id="is_overnight" name="is_overnight"
                                                value="1" class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row gy-4 align-items-end mb-8">

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Start Time <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-time-line addon-icon"></i>
                                        <input type="time" name="start_time" id="start_time"
                                            class="form-control custom-premium-input calculate-hours" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        End Time <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-time-line addon-icon"></i>
                                        <input type="time" name="end_time" id="end_time"
                                            class="form-control custom-premium-input calculate-hours" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Working Hours (hrs)
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-timer-flash-line addon-icon"></i>
                                        <input type="number" step="0.01" name="working_hours" id="working_hours"
                                            class="form-control custom-premium-input bg-light" placeholder="0.00"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-light radius-8 border">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="has_break">
                                        Include Break Time
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch mb-0">
                                            <input type="checkbox" role="switch" id="has_break" name="has_break"
                                                value="1" class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row gy-4 align-items-end mb-8 d-none" id="break_fields_wrapper">

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Break Start Time
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-rest-time-line addon-icon"></i>
                                        <input type="time" name="break_start_time" id="break_start_time"
                                            class="form-control custom-premium-input calculate-hours">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Break End Time
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-rest-time-line addon-icon"></i>
                                        <input type="time" name="break_end_time" id="break_end_time"
                                            class="form-control custom-premium-input calculate-hours">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Break Duration (hrs)
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-cup-line addon-icon"></i>
                                        <input type="number" step="0.01" name="break_hours" id="break_hours"
                                            class="form-control custom-premium-input bg-light" placeholder="0.00"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row gy-4 align-items-end mb-8">

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Late Grace (Mins)
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-timer-line addon-icon"></i>
                                        <input type="number" name="late_grace_minutes" id="late_grace_minutes"
                                            class="form-control custom-premium-input" placeholder="e.g. 15"
                                            value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Early Out Grace (Mins)
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-timer-line addon-icon"></i>
                                        <input type="number" name="early_grace_minutes" id="early_grace_minutes"
                                            class="form-control custom-premium-input" placeholder="e.g. 10"
                                            value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Half Day After (Mins)
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-time-zone-line addon-icon"></i>
                                        <input type="number" name="half_day_after_minutes"
                                            id="half_day_after_minutes" class="form-control custom-premium-input"
                                            placeholder="e.g. 120">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Overtime Valid After (Mins)
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-add-alarm-line addon-icon"></i>
                                        <input type="number" name="overtime_after_minutes"
                                            id="overtime_after_minutes" class="form-control custom-premium-input"
                                            placeholder="e.g. 30" value="0">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row gy-4 align-items-center mb-8 mt-4">

                            <div class="col-xl-4 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-light radius-8 border">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="late_mark_enabled">
                                        Enable Late Marking
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch mb-0">
                                            <input type="checkbox" role="switch" id="late_mark_enabled"
                                                name="late_mark_enabled" value="1" checked
                                                class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-light radius-8 border">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="early_out_enabled">
                                        Enable Early-Out Marking
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch mb-0">
                                            <input type="checkbox" role="switch" id="early_out_enabled"
                                                name="early_out_enabled" value="1" checked
                                                class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-light radius-8 border">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="overtime_allowed">
                                        Allow Overtime Calculation
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch mb-0">
                                            <input type="checkbox" role="switch" id="overtime_allowed"
                                                name="overtime_allowed" value="1" class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="row gy-4 align-items-end mb-8">
                            <div class="col-xl-12">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                        Description
                                    </label>
                                    <textarea name="description" id="shift_description" rows="3" class="form-control custom-premium-input"
                                        placeholder="Brief details or remarks regarding shift schedule..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                            <div class="premium-input-box position-relative d-flex align-items-center gap-2 me-auto">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                    for="shift_status">
                                    Status
                                </label>
                                <div class="form-check form-switch p-0 m-0">
                                    <label class="switch mb-0">
                                        <input type="checkbox" role="switch" id="shift_status" name="status"
                                            value="1" checked class="module-active-toggle">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <button type="button" id="resetShiftForm" class="btn btn-premium-action-secondary">
                                <i class="ri-refresh-line me-2"></i> Clear Configuration
                            </button>
                            <button type="submit" class="btn btn-premium-action-primary">
                                <i class="ri-save-3-line me-2"></i> Commit Shift Setup
                            </button>
                        </div>


                    </div>
                </div>
        </div>

        </form>


    </div>
</div>
</div>
