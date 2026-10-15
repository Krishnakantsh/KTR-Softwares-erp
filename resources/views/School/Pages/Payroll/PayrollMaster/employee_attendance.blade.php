@extends('School.Layout.main')

@section('title', 'KTR ERP : Staff Attendance')

@push('styles')
    <style>
        .attendance-radio-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .attendance-radio-group input[type="radio"] {
            display: none;
        }

        .attendance-radio-group label {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            color: #fff;
            opacity: 0.35;
            transform: scale(0.9);
            transition: all 0.15s ease-in-out;
            user-select: none;
        }

        .attendance-radio-group label[data-status="P"] {
            background-color: #16a34a;
        }

        .attendance-radio-group label[data-status="A"] {
            background-color: #dc2626;
        }

        .attendance-radio-group label[data-status="H"] {
            background-color: #f59e0b;
        }

        .attendance-radio-group label[data-status="L"] {
            background-color: #3b82f6;
        }

        .attendance-radio-group label[data-status="ML"] {
            background-color: #8b5cf6;
            font-size: 10px;
        }

        .attendance-radio-group input[type="radio"]:checked+label {
            opacity: 1;
            transform: scale(1.05);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.06), 0 2px 6px rgba(0, 0, 0, 0.25);
        }

        .attendance-radio-group label:hover {
            opacity: 0.75;
        }
    </style>
@endpush

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-user-follow-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Staff Attendance</h5>
                        <p class="text-xs text-neutral-500 mb-0">Mark and review day-wise staff attendance.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="StaffAttendanceDataTable" />
                    <x-model-open target="addStaffAttendanceModal" />
                </div>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"
                        id="StaffAttendanceDataTable" data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    S.No.</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Attendance Date</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    No. of Attendances</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="staffAttendanceRegistryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewStaffAttendanceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

                <div
                    class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                    <div>
                        <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0">
                            Present Staff List
                        </h6>
                        <small class="text-neutral-500 text-xs" id="viewStaffAttendanceSubtitle">
                            Attendance details for selected date.
                        </small>
                    </div>
                    <div>
                        <x-model-close />
                    </div>
                </div>

                <div class="modal-body p-28" style="max-height: 65vh; overflow-y: auto;">

                    <div id="viewStaffAttendanceLoader" class="text-center py-40 d-none">
                        <div class="spinner-border text-primary-600" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <div id="viewStaffAttendanceEmpty" class="text-center py-40 d-none">
                        <i class="ri-user-search-line text-4xl text-neutral-300"></i>
                        <p class="text-neutral-500 text-sm mt-8 mb-0">No staff marked present for this date.</p>
                    </div>

                    <ul class="list-group list-group-flush" id="presentStaffList"></ul>

                </div>

            </div>
        </div>
    </div>

    @include('School/Pages/Payroll/components/add_update_attendance')
@endsection



@push('script')
    <script>
        $(document).ready(function() {

            fetchRegisteredAttendance();
            loadDepartmentDropdownForAttendance();

            // ----------------------------------------------------
            // 1. DEPARTMENT DROPDOWN LOGIC & EVENT HANDLING
            // ----------------------------------------------------

            // Select / Deselect All Departments
            $(document).on('change', '#dept_all', function() {
                const isChecked = $(this).is(':checked');
                $('.dept-checkbox').prop('checked', isChecked);
                updateDropdownButtonText('dept');
            });

            // Individual Department Checkbox Toggle
            $(document).on('change', '.dept-checkbox', function() {
                const total = $('.dept-checkbox').length;
                const checked = $('.dept-checkbox:checked').length;
                $('#dept_all').prop('checked', total > 0 && total === checked);
                updateDropdownButtonText('dept');
            });

            // Trigger fetch Designations & Staff when Department Dropdown CLOSES
            $('#departmentDropdownMenu').on('hide.bs.dropdown', function() {
                const selectedDeptIds = getSelectedValues('dept');
                loadDesignationDropdownForAttendance(selectedDeptIds);
                loadStaffListForAttendance(selectedDeptIds, getSelectedValues('desig'));
            });

            // Search filter inside Department Dropdown
            $(document).on('keyup', '.department-search-input', function() {
                const query = $(this).val().toLowerCase();
                $('#departmentOptionsContainer .select-option-row').each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(query) > -1);
                });
            });


            // ----------------------------------------------------
            // 2. DESIGNATION DROPDOWN LOGIC & EVENT HANDLING
            // ----------------------------------------------------

            // Select / Deselect All Designations
            $(document).on('change', '#desig_all', function() {
                const isChecked = $(this).is(':checked');
                $('.desig-checkbox').prop('checked', isChecked);
                updateDropdownButtonText('desig');
            });

            // Individual Designation Checkbox Toggle
            $(document).on('change', '.desig-checkbox', function() {
                const total = $('.desig-checkbox').length;
                const checked = $('.desig-checkbox:checked').length;
                $('#desig_all').prop('checked', total > 0 && total === checked);
                updateDropdownButtonText('desig');
            });

            // Trigger fetch Staff when Designation Dropdown CLOSES
            $('#designationDropdownMenu').on('hide.bs.dropdown', function() {
                const selectedDeptIds = getSelectedValues('dept');
                const selectedDesigIds = getSelectedValues('desig');

                loadStaffListForAttendance(selectedDeptIds, selectedDesigIds);
            });

            // Search filter inside Designation Dropdown
            $(document).on('keyup', '.designation-search-input', function() {
                const query = $(this).val().toLowerCase();
                $('#designationOptionsContainer .select-option-row').each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(query) > -1);
                });
            });


            // ----------------------------------------------------
            // 3. HELPER FUNCTIONS FOR MULTI-SELECT UI
            // ----------------------------------------------------

            // Extract checked values as an Array
            function getSelectedValues(type) {
                let ids = [];
                $(`.${type}-checkbox:checked`).each(function() {
                    ids.push($(this).val());
                });
                return ids;
            }



            // Dynamically updates button header text based on selection
            function updateDropdownButtonText(type) {
                const total = $(`.${type}-checkbox`).length;
                const checkedBoxes = $(`.${type}-checkbox:checked`);
                const checkedCount = checkedBoxes.length;

                let btnText = '';
                const placeholder = type === 'dept' ? 'Select Department(s)...' : 'Select Designation(s)...';
                const targetTextElement = type === 'dept' ? '#departmentSelectedText' : '#designationSelectedText';

                if (checkedCount === 0) {
                    btnText = placeholder;
                    $(targetTextElement).addClass('text-muted');
                } else if ($(`#${type}_all`).is(':checked') || (total > 0 && checkedCount === total)) {
                    btnText = 'All Selected';
                    $(targetTextElement).removeClass('text-muted');
                } else if (checkedCount > 2) {
                    btnText = `${checkedCount} Selected`;
                    $(targetTextElement).removeClass('text-muted');
                } else {
                    let selectedNames = [];
                    checkedBoxes.each(function() {
                        selectedNames.push($(this).data('name'));
                    });
                    btnText = selectedNames.join(', ');
                    $(targetTextElement).removeClass('text-muted');
                }

                $(targetTextElement).text(btnText);
            }


            // ----------------------------------------------------
            // 4. FORM RESET & MISC EVENTS
            // ----------------------------------------------------

            function resetStaffAttendanceForm() {
                const form = $('#staffAttendanceForm')[0];
                if (form) form.reset();

                $('#departmentSelectedText').text('Select Department(s)...').addClass('text-muted');
                $('#designationSelectedText').text('Select Department First').addClass('text-muted');

                $('#departmentOptionsContainer input[type="checkbox"]').prop('checked', false);
                $('#designationOptionsContainer').html(`
                    <p class="text-neutral-400 text-xs text-center py-12 mb-0">
                        Select department(s) first.
                    </p>
                `);

                $('#designationDropdownBtn').prop('disabled', true);
                $('#attendanceStaffList').html('');
                $('#attendanceStaffPlaceholder').removeClass('d-none');
                $('#selectAllStaff').prop('checked', true);
            }

            $('[data-bs-target="#addStaffAttendanceModal"]').on('click', resetStaffAttendanceForm);
            $(document).on('click', '#resetStaffAttendanceForm', resetStaffAttendanceForm);
            $('#addStaffAttendanceModal').on('hidden.bs.modal', resetStaffAttendanceForm);

            // Sunday validation
            $(document).on('change', '#attendance_date', function() {
                const selectedDate = $(this).val();
                if (!selectedDate) return;

                const dayIndex = new Date(selectedDate + 'T00:00:00').getDay();
                if (dayIndex === 0) {
                    showToast('error', `Selected date is Sunday, you can't mark attendance`);
                    $(this).val('');
                }
            });

            // Select All switch: ON = sabko P set karo, OFF = sabko A set karo
            $(document).on('change', '#selectAllStaff', function() {
                const status = $(this).is(':checked') ? 'P' : 'A';
                $('.attendance-radio-group input[value="' + status + '"]').prop('checked', true);
            });

            // Agar koi manually kisi staff ka status badal de to Select All switch ko sync karo
            $(document).on('change', '.staff-attendance-radio', function() {
                const total = $('.attendance-radio-group').length;
                const allPresent = $('.attendance-radio-group input[value="P"]:checked').length;
                $('#selectAllStaff').prop('checked', total > 0 && total === allPresent);
            });



            // Row click view attendance details
            $(document).on('click', '.attendance-row-trigger', function(e) {
                if ($(e.target).closest('.delete-attendance-trigger').length) return;
                const date = $(this).data('date');
                const count = $(this).data('count');
                openViewAttendanceModal(date, count);
            });

        });


        // ----------------------------------------------------
        // 5. AJAX FETCHING DATA FUNCTIONS
        // ----------------------------------------------------

        function loadDepartmentDropdownForAttendance() {
            return new Promise((resolve) => {
                fetchMasterData(
                    "{{ route('school.payroll_department.fetch') }}",
                    function(res) {
                        let options = `
                            <div class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                <input type="checkbox" value="0" class="form-check-input select-checkbox-input" id="dept_all">
                                <label class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold" for="dept_all">All</label>
                            </div>
                        `;

                        if (res.status && res.data) {
                            $.each(res.data, function(index, row) {
                                options += `
                                    <div class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                        <input type="checkbox" name="department_id[]" value="${row.id}" data-name="${row.department_name}" class="form-check-input select-checkbox-input dept-checkbox" id="dept_${row.id}">
                                        <label class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold" for="dept_${row.id}">${row.department_name}</label>
                                    </div>
                                `;
                            });
                        }

                        $('#departmentOptionsContainer').html(options);
                        resolve(res);
                    }
                );
            });
        }


        function loadDesignationDropdownForAttendance(departmentIds) {
            return new Promise((resolve) => {

                if (!departmentIds || departmentIds.length === 0) {
                    $('#designationOptionsContainer').html(`
                        <p class="text-neutral-400 text-xs text-center py-12 mb-0">Select department(s) first.</p>
                    `);
                    $('#designationDropdownBtn').prop('disabled', true);
                    $('#designationSelectedText').text('Select Department First').addClass('text-muted');
                    resolve(null);
                    return;
                }

                $('#designationDropdownBtn').prop('disabled', false);

                fetchMasterData(
                    "{{ route('school.payroll_department.get_designations') }}",
                    function(res) {
                        let options = `
                            <div class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                <input type="checkbox" value="0" class="form-check-input select-checkbox-input" id="desig_all">
                                <label class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold" for="desig_all">All</label>
                            </div>
                        `;

                        if (res.status && res.data && res.data.length > 0) {
                            $.each(res.data, function(index, row) {
                                options += `
                                    <div class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                        <input type="checkbox" name="designation_id[]" value="${row.id}" data-name="${row.designation_name}" class="form-check-input select-checkbox-input desig-checkbox" id="desig_${row.id}">
                                        <label class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold" for="desig_${row.id}">${row.designation_name}</label>
                                    </div>
                                `;
                            });
                        } else {
                            options =
                                `<p class="text-neutral-400 text-xs text-center py-12 mb-0">No designations found.</p>`;
                        }

                        $('#designationOptionsContainer').html(options);
                        $('#designationSelectedText').text('Select Designation(s)...').addClass('text-muted');

                        resolve(res);
                    }, {
                        'department_id': departmentIds
                    }
                );

            });
        }

        function loadStaffListForAttendance(departmentIds, designationIds) {
            return new Promise((resolve) => {

                if (!departmentIds || departmentIds.length === 0) {
                    $('#attendanceStaffPlaceholder').removeClass('d-none');
                    resolve(null);
                    return;
                }

                const data = {
                    'department_id': departmentIds,
                    'designation_id': designationIds,
                    'attendance_date': $('#attendance_date').val()
                };

                fetchMasterData(
                    "{{ route('school.employee_attendance.fetch') }}",
                    function(res) {
                        let html = '';

                        console.log(res.data);

                        if (res.status && res.data.length > 0) {
                            $('#attendanceStaffPlaceholder').addClass('d-none');

                            $.each(res.data, function(index, row) {
                                const currentStatus = (row.has_attendance && row.attendance && row
                                        .attendance.status) ?
                                    row.attendance.status :
                                    'P';

                                const statuses = ['P', 'A', 'H', 'ML'];
                                const idPrefixMap = {
                                    P: 'p',
                                    A: 'a',
                                    H: 'h',
                                    ML: 'ml'
                                };

                                let radiosHtml = '';
                                statuses.forEach(function(st) {
                                    const prefix = idPrefixMap[st];
                                    const isChecked = (st === currentStatus) ? 'checked' : '';
                                    radiosHtml += `
                                            <input type="radio" class="staff-attendance-radio" name="attendance[${row.employee_id}]" id="${prefix}_${index}" value="${st}" ${isChecked}>
                                            <label for="${prefix}_${index}" data-status="${st}">${st}</label>
                                        `;
                                });

                                html += `
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-16 py-10 border-bottom border-neutral-100">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-matrix-icon">
                                                <span class="fw-bold text-sm text-primary-600">${index+1}</span>
                                            </div>
                                            <div>
                                                <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.name}</h6>
                                                <small class="text-neutral-500 text-xs">${row.designation_name ?? ''}</small>
                                            </div>
                                        </div>

                                        <div class="attendance-radio-group">
                                            ${radiosHtml}
                                        </div>
                                    </li>
                                `;
                            });
                        } else {
                            $('#attendanceStaffPlaceholder').removeClass('d-none').html(`
                        <i class="ri-team-line text-4xl text-neutral-300"></i>
                        <p class="text-neutral-500 text-sm mt-8 mb-0">No staff found for this selection.</p>
                    `);
                        }

                        $('#attendanceStaffList').html(html);
                        $('#selectAllStaff').prop('checked', true);

                        resolve(res);
                    },
                    data
                );

            });
        }

        function fetchRegisteredAttendance() {
            fetchMasterData(
                "{{ route('school.employee_attendance.registered_fetch') }}",
                function(res) {
                    let html = '';

                    if (res.status && res.data.length > 0) {
                        $.each(res.data, function(index, row) {
                            html += `
                                <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all attendance-row-trigger"
                                    style="cursor: pointer;"
                                    data-date="${row.attendance_date}"
                                    data-count="${row.present_count}">

                                    <td class="py-20 px-28">
                                        <span class="text-sm fw-semibold text-neutral-700">${index + 1}</span>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-sm fw-bold text-neutral-800">${row.attendance_date}</span>
                                    </td>

                                    <td class="py-20 px-20 text-center">
                                        <span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">
                                            ${row.present_count}
                                        </span>
                                    </td>

                                    <td class="py-20 px-28 text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <button
                                                type="button"
                                                class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-attendance-trigger deleteAttendance"
                                                data-id="${row.attendance_date}">
                                                <i class="ri-delete-bin-6-line text-lg"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            `;
                        });
                    }

                    if ($.fn.DataTable.isDataTable('#StaffAttendanceDataTable')) {
                        $('#StaffAttendanceDataTable').DataTable().destroy();
                    }

                    $('#staffAttendanceRegistryTableBody').html(html);

                    $('#StaffAttendanceDataTable').DataTable({
                        pageLength: 10,
                        language: {
                            emptyTable: "No Records Found"
                        }
                    });
                }
            );
        }

        function openViewAttendanceModal(date, count) {
            $('#viewStaffAttendanceModal').modal('show');
            $('#viewStaffAttendanceSubtitle').text(`Attendance on ${date} • ${count} attendance records available.`);
            $('#presentStaffList').html('');
            $('#viewStaffAttendanceEmpty').addClass('d-none');
            $('#viewStaffAttendanceLoader').removeClass('d-none');

            fetchMasterData(
                "{{ route('school.employee_attendance.showAttendantStaff') }}?attendance_date=" + date,
                function(res) {
                    $('#viewStaffAttendanceLoader').addClass('d-none');

                    if (!res.status || !res.data || res.data.length === 0) {
                        $('#viewStaffAttendanceEmpty').removeClass('d-none');
                        return;
                    }

                    let html = '';

                    $.each(res.data, function(index, row) {
                        let initials = row.employee_name
                            .split(' ')
                            .map(word => word.charAt(0))
                            .join('')
                            .substring(0, 2)
                            .toUpperCase();

                        let attendance_status = row.attendance_status == "P" ? 'Present' : (row
                            .attendance_status == "A" ? 'Absent' : (row.attendance_status == "H" ?
                                'Half Day' : 'Med. Leave'))

                        html += `
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-12 border-bottom border-neutral-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-matrix-icon">
                                        <span class="fw-bold text-sm text-primary-600">${initials}</span>
                                    </div>
                                    <div>
                                        <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.employee_name}</h6>
                                       
                                    </div>
                                </div>
                                <span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">
                                    ${attendance_status}
                                </span>
                            </li>
                        `;
                    });

                    $('#presentStaffList').html(html);
                }
            );
        }
    </script>
@endpush
