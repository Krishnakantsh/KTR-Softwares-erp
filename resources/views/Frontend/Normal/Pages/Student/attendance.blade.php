@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Student Attendance Console')

@section('dynamic-content')
    <div class="dashboard-main-body">

        <div class="row gy-4">

            <div class="col-xl-6 col-lg-12">
                <div class="d-flex flex-column gap-24">

                    <!-- Control Filter Registry -->
                    <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
                        <div
                            class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center dynamic-header">
                            <div class="d-flex align-items-center gap-3">
                                <div class="brand-pulse-icon btn btn-primary-600">
                                    <i class="ri-filter-3-line text-xl text-white"></i>
                                </div>
                                <div>
                                    <h6 class="text-lg fw-bold mb-0  text-primary-600">Control Filter Registry</h6>
                                    <p class="text-xs text-muted mb-0">Select academic criteria to pull rosters</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-24">
                            <form id="attendanceFilterForm" onsubmit="event.preventDefault();">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="premium-input-box" id="dateFieldContainer">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                                Attendance Date <span class="text-danger">*</span>
                                            </label>
                                            <div class="inner-addon">
                                                <i class="ri-calendar-todo-line text-primary-600 addon-icon"></i>
                                                <input type="date" class="form-control custom-premium-input"
                                                    name="attendance_date" id="filterDate" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="premium-input-box" id="classFieldContainer">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                                Target Class <span class="text-danger">*</span>
                                            </label>
                                            <div class="inner-addon">
                                                <i class="ri-git-repository-line text-primary-600 addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="class_id" id="filterClass" onchange="validateFilters()">

                                                </select>
                                            </div>
                                            <div class="text-danger font-medium mt-2 d-none" id="classError"
                                                style="font-size: 11px; letter-spacing: 0.3px;">
                                                <i class="ri-error-warning-line me-1"></i> Please Select Class !
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="premium-input-box" id="divisionFieldContainer">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                                Section <span class="text-danger">*</span>
                                            </label>
                                            <div class="inner-addon">
                                                <i class="ri-team-line text-primary-600 addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="section_id" id="filterDivision">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                                    <button type="button"
                                        class="btn  btn-primary-600 w-100 py-12 radius-8 fw-semibold"
                                        id="btnLoadStudents" onclick="loadStudentRoster()">
                                        <i class="ri-user-search-line me-2"></i> Load Student Roster
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- SCROLLABLE: Today's Summary Ledger -->
                    <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">

                        <div
                            class="card-header border-bottom bg-base py-12 px-24 d-flex justify-content-between align-items-center">
                            <!-- Left Side: Title -->
                            <h6 id="attendanceReportTitle"
                                class="text-sm fw-bold mb-0 text-dark-main text-uppercase tracking-wider">
                                Today's Summary Ledger
                            </h6>

                            <!-- Right Side: Compact Premium Date Picker -->
                            <div class="inner-addon" style="width: 160px;">
                                <i class="ri-calendar-todo-line text-primary-600 addon-icon"
                                    style="left: 10px; font-size: 16px;"></i>
                                <input type="date" class="form-control custom-premium-input py-4 pe-8"
                                    id="attendanceDate" value="{{ date('Y-m-d') }}"
                                    style="padding-left: 34px !important; height: 36px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive scrollable-ledger-body">
                                <table class="table bordered-table mb-0 text-sm">
                                    <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                                        <tr>
                                            <th scope="col" style="width: 60px;">S.No.</th>
                                            <th scope="col">Class</th>
                                            <th scope="col" class="text-center">Sec</th>
                                            <th scope="col" class="text-success text-center">Total</th>
                                            <th scope="col" class="text-success text-center">Present</th>
                                            <th scope="col" class="text-danger text-center">Absent</th>
                                            <th scope="col" class="text-success text-center">Leave</th>
                                            <th scope="col" class="text-success text-center">Holiday</th>
                                        </tr>
                                    </thead>
                                    <tbody id="markedLogsTableBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <!-- Roster Sheet Grid Container -->
                <div class="card h-100 radius-12 border-0 shadow-sm overflow-hidden d-none" id="attendanceSheetWrapper">
                    <div
                        class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-lg fw-bold mb-0 text-dark-main" id="dynamicSheetHeader">Roster Grid</h6>
                            <p class="text-xs text-muted mb-0">Check marking options for individual entity logs</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 bg-neutral-50 px-12 py-6 radius-8 border">
                            <span class="text-xs fw-bold text-muted">Bulk:</span>
                            <button type="button" class="btn btn-xs btn-outline-success py-2 px-8 font-medium radius-4"
                                onclick="bulkMark('P')">All P</button>
                            <button type="button" class="btn btn-xs btn-outline-danger py-2 px-8 font-medium radius-4"
                                onclick="bulkMark('AB')">All AB</button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <form id="attendanceSubmissionForm" class="d-flex flex-column h-100">

                            <!-- SCROLLABLE: Student Rows Container -->
                            <div class="table-responsive scrollable-roster-body">
                                <table class="table bordered-table align-middle mb-0" id="AttendanceDataTable">
                                    <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                                        <tr>
                                            <th scope="col" style="width: 50px;">S.No</th>
                                            <th scope="col">Student Details</th>
                                            <th scope="col" class="text-center" style="width: 70px;">P</th>
                                            <th scope="col" class="text-center" style="width: 70px;">AB</th>
                                            <th scope="col" class="text-center" style="width: 70px;">H</th>
                                            <th scope="col" class="text-center" style="width: 70px;">ML</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentRosterTableBody">
                                    </tbody>
                                </table>
                            </div>

                            <!-- Fixed Footer Actions -->
                            <div class="p-24 d-flex justify-content-end gap-3 border-top bg-base mt-auto">
                                <button type="button" class="btn btn-premium-secondary px-24 py-12 radius-8 fw-semibold"
                                    onclick="resetRoster()">
                                    <i class="ri-close-line me-2"></i> Cancel
                                </button>
                                <button type="button"
                                    class="btn  btn-primary-600 px-24 py-12 radius-8 fw-semibold"
                                    onclick="submitAttendanceSystem()">
                                    <i class="ri-checkbox-circle-line me-2"></i> Save Attendance Ledger
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="fallbackDisplay"
                    class="card h-100 radius-12 border-0 shadow-sm d-flex flex-column align-items-center justify-content-center text-center p-48 min-h-400 bg-base premium-generator-card">
                    <div class="brand-pulse-icon btn btn-primary-600 mb-16" style="width: 60px; height: 60px; border-radius: 50%;">
                        <i class="ri-user-received-2-line text-3xl text-white"></i>
                    </div>
                    <h6 class="fw-bold text-dark-main">Roster Sheet Awaiting Filters</h6>
                    <p class="text-neutral-500 max-w-360 text-sm">Please choose Class & Section from the left panel console
                        and tap 'Load Student Roster' to display marking sheet structure.</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        .min-h-400 {
            min-height: 440px;
        }

        .max-w-360 {
            max-w: 360px;
            margin: 0 auto;
        }

        /* --- NEW SCROLLABLE CONSTRAINTS --- */
        .scrollable-roster-body {
            max-height: 700px;
            overflow-y: auto;
        }

        .scrollable-ledger-body {
            max-height: 420px;
            overflow-y: auto;
        }

        /* Custom Premium Scrollbar Profile */
        .scrollable-roster-body::-webkit-scrollbar,
        .scrollable-ledger-body::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-roster-body::-webkit-scrollbar-track,
        .scrollable-ledger-body::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .scrollable-roster-body::-webkit-scrollbar-thumb,
        .scrollable-ledger-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .scrollable-roster-body::-webkit-scrollbar-thumb:hover,
        .scrollable-ledger-body::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .premium-generator-card {
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .text-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-pulse-icon {
    
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
        }

        .premium-input-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .premium-input-box:focus-within {
            border-color: #7c3aed;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.08);
        }

        .inner-addon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .addon-icon {
            position: absolute;
            left: 14px;
            z-index: 5;
            font-size: 18px;
            color: #64748b;
        }

        .premium-input-box:focus-within .addon-icon {
            color: #7c3aed;
        }

        .custom-premium-select,
        .custom-premium-input {
            padding-left: 42px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 600 !important;
            height: 44px;
            font-size: 0.9rem;
            color: #1e293b;
            background-color: #ffffff !important;
        }

        .premium-input-box.is-invalid-border {
            border-color: #ef4444 !important;
            background: #fffafb;
        }

        .backend-action-bar {
            border-top: 1px dashed #e2e8f0;
            padding-top: 24px;
            margin-top: 8px;
        }

        .btn-premium-secondary {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .btn-premium-secondary:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .btn-premium-primary {

            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
            transition: all 0.2s ease;
        }

        .btn-premium-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(124, 58, 237, 0.35);
            color: white;
        }

        /* --- PREMIUM CUSTOM RADIO BUTTONS STYLING --- */
        .att-radio-wrapper {
            display: block;
            position: relative;
            cursor: pointer;
            user-select: none;
            margin: 0 auto;
            width: 28px;
            height: 28px;
        }

        .att-radio-wrapper input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .att-checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 28px;
            width: 28px;
            background-color: #f1f5f9;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 11px;
            color: #64748b;
            transition: all 0.15s ease-in-out;
        }

        .att-radio-wrapper:hover input~.att-checkmark {
            background-color: #e2e8f0;
        }

        .radio-p input:checked~.att-checkmark {
            background-color: #dcfce7 !important;
            border-color: #22c55e !important;
            color: #15803d !important;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }

        .radio-ab input:checked~.att-checkmark {
            background-color: #fee2e2 !important;
            border-color: #ef4444 !important;
            color: #b91c1c !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }

        .radio-h input:checked~.att-checkmark {
            background-color: #fef9c3 !important;
            border-color: #eab308 !important;
            color: #a16207 !important;
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.2);
        }

        .radio-ml input:checked~.att-checkmark {
            background-color: #e0f2fe !important;
            border-color: #0ea5e9 !important;
            color: #0369a1 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        }
    </style>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            fetchMasterData("{{ route('school.class.master.fetch.with') }}", function(res) {

                let options = `<option value="">Select Class</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("select[name='class_id']").html(options);
            });


            loadAttendenceReport();

        });

        $(document).on("change", "select[name='class_id']", function() {

            let class_id = $(this).val();

            if (!class_id) {
                $("select[name='section_id']").html(`<option value="">Select Section</option>`);
                return;
            }

            getDataById("{{ route('school.common.get_class_devisions_by_class_id') }}", class_id, function(res) {

                let options = `<option value="">Select Section</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("select[name='section_id']").html(options);

            });

        });


        function validateFilters() {
            let classVal = $('#filterClass').val();
            if (!classVal) {
                $('#classFieldContainer').addClass('is-invalid-border');
                $('#classError').removeClass('d-none');
                return false;
            } else {
                $('#classFieldContainer').removeClass('is-invalid-border');
                $('#classError').addClass('d-none');
                return true;
            }
        }

        function loadStudentRoster() {

            if (!validateFilters()) {
                return;
            }

            let classId = $('#filterClass').val();
            let attendanceDate = $('#filterDate').val();
            let sectionId = $('#filterDivision').val();

            let classText = $('#filterClass option:selected').text();
            let divisionText = $('#filterDivision option:selected').text();

            $.ajax({
                url: "{{ route('student.attendance.fetch_students') }}",
                method: "GET",
                data: {
                    class_id: classId,
                    section_id: sectionId,
                    attendance_date: attendanceDate
                },
                success: function(res) {

                    let tbody = $('#studentRosterTableBody');

                    tbody.empty();

                    $('#dynamicSheetHeader').html(
                        `Class: ${classText} - ${divisionText}`
                    );

                    if (
                        !res.status ||
                        !res.data ||
                        res.data.length === 0
                    ) {

                        tbody.html(`
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    No Students Found
                                </td>
                            </tr>
                        `);

                        $('#fallbackDisplay').addClass('d-none');
                        $('#attendanceSheetWrapper').removeClass('d-none');

                        return;
                    }

                    $.each(res.data, function(index, student) {

                        let fullName =
                            `${student.first_name ?? ''} ${student.last_name ?? ''}`;

                        tbody.append(`
                            <tr>

                                <td class="fw-medium text-muted">
                                    ${index + 1}
                                </td>

                                <td>
                                    <div class="d-flex flex-column">

                                        <span class="fw-bold text-dark-main">
                                            ${fullName}
                                        </span>

                                        <span class="text-xs text-muted">
                                            Father :
                                            ${student.father_name ?? 'N/A'}
                                        </span>

                                        <span class="text-xs text-muted">
                                            Roll :
                                            ${student.roll_no ?? '-'}
                                        </span>

                                        <input type="hidden" class="student-id" value="${student.id}">
                                    </div>
                                </td>

                                <td class="text-center">
                                    <label class="att-radio-wrapper radio-p">
                                        <input
                                            type="radio"
                                            name="attendance[${student.id}]"
                                            value="P"
                                            ${student.attendance_status === 'P' ? 'checked' : ''}>
                                        <span class="att-checkmark">P</span>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <label class="att-radio-wrapper radio-ab">
                                        <input
                                            type="radio"
                                            name="attendance[${student.id}]"
                                            value="A"
                                            ${student.attendance_status === 'A' ? 'checked' : ''}>
                                        <span class="att-checkmark">A</span>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <label class="att-radio-wrapper radio-h">
                                        <input
                                            type="radio"
                                            name="attendance[${student.id}]"
                                            value="H"
                                            ${student.attendance_status === 'H' ? 'checked' : ''}>
                                        <span class="att-checkmark">H</span>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <label class="att-radio-wrapper radio-ml">
                                        <input
                                            type="radio"
                                            name="attendance[${student.id}]"
                                            value="L"
                                            ${student.attendance_status === 'L' ? 'checked' : ''}>
                                        <span class="att-checkmark">L</span>
                                    </label>
                                </td>

                            </tr>
                        `);
                    });

                    $('#fallbackDisplay').addClass('d-none');
                    $('#attendanceSheetWrapper').removeClass('d-none');
                }
            })


        }

        function bulkMark(type) {
            if (type === 'P') {
                $('.radio-p input[type="radio"]').prop('checked', true);
            } else if (type === 'AB') {
                $('.radio-ab input[type="radio"]').prop('checked', true);
            }
        }

        function resetRoster() {
            $('#attendanceSheetWrapper').addClass('d-none');
            $('#fallbackDisplay').removeClass('d-none');
            $('#attendanceFilterForm')[0].reset();
            $("select[name='section_id']").html(`<option value="">Select Section</option>`);
        }

        function submitAttendanceSystem() {

            let students = [];

            $('#studentRosterTableBody tr').each(function() {

                let studentId = $(this)
                    .find('.student-id')
                    .val();

                if (!studentId) {
                    return;
                }

                let status = $(this)
                    .find('input[type="radio"]:checked')
                    .val();

                students.push({
                    student_id: studentId,
                    status: status
                });
            });

            if (students.length === 0) {

                toastr.error(
                    "No student attendance found."
                );

                return;
            }

            let payload = {

                class_id: $('#filterClass').val(),

                section_id: $('#filterDivision').val(),

                attendance_date: $('#filterDate').val(),

                students: students,

                _token: "{{ csrf_token() }}"
            };

            $.ajax({

                url: "{{ route('student.attendance.save') }}",

                type: "POST",

                data: payload,

                success: function(res) {

                    if (res.status) {
                        showToast('success', res.message || "Attendance Marked ");
                        loadAttendenceReport();
                        resetRoster();

                    } else {

                        showToast('error', res.message || "Something went wrong !");
                    }
                },

                error: function(xhr) {
                    showToast('error', xhr.responseJSON?.message || "Something went wrong !");
                }
            });
        }

        $('#attendanceDate').on('change', function() {

            let selectedDate = $(this).val();

            $('#attendanceReportTitle').text(
                `Summary Ledger (${selectedDate})`
            );

            loadAttendenceReport(selectedDate);

        });

        // load student attendance data here 

        function loadAttendenceReport(date = null) {

            if (!date) {
                date = new Date().toISOString().split('T')[0];
            }

            $.ajax({
                url: "{{ route('student.attendance.get_attendence_data') }}",
                method: "GET",
                data: {
                    attendance_date: date
                },
                success: function(res) {

                    let resp = res.data;
                    let rows = '';

                    if (resp.length > 0) {

                        $.each(resp, function(i, d) {

                            rows +=
                                `
                            <tr>
                                <td>2</td>
                                <td class="fw-semibold">${d.class?.name || 'N/A'}</td>
                                <td class="text-center"><span
                                class="badge bg-neutral-100 text-neutral-800 border">${d.section?.name}</span></td>
                                <td class="text-center fw-bold text-primary">${d.total_students}</td>
                                <td class="text-center fw-bold text-success">${d.present_count}</td>
                                <td class="text-center fw-bold text-danger">${d.absent_count}</td>
                                <td class="text-center fw-bold text-danger">${d.leave_count}</td>
                                <td class="text-center fw-bold text-danger">${d.holiday_count}</td>
                            </tr>             
                        `
                        });

                    } else {
                        rows +=
                            `
                                <tr  >
                                    <td colspan="8" class="text-center fw-bold text-primary-600" >--- No Attendence Found --- </td>
                                </tr>             
                           `
                    }


                    $('#markedLogsTableBody').html(rows);

                }
            });

        }
    </script>
@endpush
