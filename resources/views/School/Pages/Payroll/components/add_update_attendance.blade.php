<div class="modal fade" id="addStaffAttendanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0">
                        Mark Staff Attendance
                    </h6>
                    <small class="text-neutral-500 text-xs">
                        Select department(s) & designation(s), then mark present / absent staff.
                    </small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <form id="staffAttendanceForm" class="ajaxForm" data-url="{{ route('school.employee_attendance.save') }}"
                data-refresh="fetchRegisteredAttendance" data-method="POST" autocomplete="off">

                @csrf

                <div class="modal-body p-28">

                    <div class="row gy-4 mb-20">

                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Attendance Date <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-calendar-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="date" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="attendance_date" id="attendance_date" required>
                                </div>
                            </div>
                        </div>


                        {{-- DEPARTMENT --}}
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Department <span class="text-danger">*</span>
                                </label>
                                <div class="dropdown custom-premium-multiselect" id="departmentDropdownMenu">
                                    <button
                                        class="form-control custom-premium-input d-flex justify-content-between align-items-center text-start"
                                        type="button" id="departmentDropdownBtn" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" style="padding-left:14px !important;">
                                        <span class="selected-text text-muted font-xs" id="departmentSelectedText">
                                            Select Department(s)...
                                        </span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </button>
                                    <div class="dropdown-menu p-3 shadow-lg border-neutral-200"
                                        style="width: 100%; border-radius:12px; max-height: 280px; overflow-y:auto;">
                                        <input type="text"
                                            class="form-control form-control-sm mb-2 premium-search-box-input department-search-input"
                                            placeholder="Search department..."
                                            style="font-size: 13px; border-radius: 6px;">
                                        <div class="options-container" id="departmentOptionsContainer">
                                            <p class="text-neutral-400 text-xs text-center py-12 mb-0">Loading
                                                departments...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DESIGNATION --}}
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Designation
                                </label>
                                <div class="dropdown custom-premium-multiselect" id="designationDropdownMenu">
                                    <button
                                        class="form-control custom-premium-input d-flex justify-content-between align-items-center text-start"
                                        type="button" id="designationDropdownBtn" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" style="padding-left:14px !important;" disabled>
                                        <span class="selected-text text-muted font-xs" id="designationSelectedText">
                                            Select Department First
                                        </span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </button>
                                    <div class="dropdown-menu p-3 shadow-lg border-neutral-200"
                                        style="width: 100%; border-radius:12px; max-height: 280px; overflow-y:auto;">
                                        <input type="text"
                                            class="form-control form-control-sm mb-2 premium-search-box-input designation-search-input"
                                            placeholder="Search designation..."
                                            style="font-size: 13px; border-radius: 6px;">
                                        <div class="options-container" id="designationOptionsContainer">
                                            <p class="text-neutral-400 text-xs text-center py-12 mb-0">Select
                                                department(s) first.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-20">

                    <div class="d-flex justify-content-between align-items-center mb-12">
                        <h6 class="text-sm fw-bold text-neutral-700 mb-0">Staff List</h6>
                        <div class="d-flex align-items-center gap-2">
                            <label class="text-xs fw-semibold text-neutral-600 mb-0">Select All</label>
                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch">
                                    <input type="checkbox" role="switch" id="selectAllStaff" checked
                                        class="module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="attendanceStaffListWrapper" class="border border-neutral-200 radius-8 mb-3"
                        style="max-height: 320px; overflow-y: auto;">

                        <div id="attendanceStaffPlaceholder" class="text-center py-40">
                            <i class="ri-team-line text-4xl text-neutral-300"></i>
                            <p class="text-neutral-500 text-sm mt-8 mb-0">Select department & designation to load staff.
                            </p>
                        </div>

                        <ul class="list-group list-group-flush" id="attendanceStaffList"></ul>

                    </div>

                    <div class="modal-footer border-top border-neutral-200 px-28 py-16">
                        <button type="button" id="resetStaffAttendanceForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Attendance
                        </button>
                    </div>

                </div>


            </form>


        </div>
    </div>
</div>
