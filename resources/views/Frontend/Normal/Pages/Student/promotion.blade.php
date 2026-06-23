@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Student Promotion Panel')

@section('dynamic-content')
    <div class="dashboard-main-body">

        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon">
                        <i class="ri-user-shared-line text-xl text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Academic Promotion & Transfer Engine</h6>
                        <p class="text-xs text-muted mb-0">Promote outstanding batches to the next academic cycle with state
                            retention</p>
                    </div>
                </div>
                <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
                    <i class="ri-refresh-line me-1 ripple-effect"></i> Engine Active
                </span>
            </div>

            <div class="card-body p-24">
                <form id="studentPromotionForm" autocomplete="off">
                    @csrf

                    <div class="row g-4 align-items-stretch">

                        <div class="col-xl-5 col-lg-5">
                            <div class="p-20 radius-12 bg-light-soft border border-dashed-custom h-100">
                                <h6
                                    class="text-sm fw-bold text-primary-light mb-16 text-uppercase tracking-wider d-flex align-items-center gap-2">
                                    <i class="ri-logout-box-r-line text-danger"></i> Source Batch (Previous Session)
                                </h6>

                                <div class="row gy-3">
                                    <div class="col-12">
                                        <div class="premium-input-box">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Session
                                                <span class="text-danger">*</span></label>
                                            <div class="inner-addon">
                                                <i class="ri-calendar-line addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="source_session_id" id="sourceSessionSelect">

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="premium-input-box">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Class
                                                <span class="text-danger">*</span></label>
                                            <div class="inner-addon">
                                                <i class="ri-git-repository-line addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="source_class_id" id="sourceClassSelect">
                                                    <option value="" disabled selected>Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="premium-input-box">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Section
                                                <span class="text-danger">*</span></label>
                                            <div class="inner-addon">
                                                <i class="ri-team-line addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="source_section_id" id="sourceSectionSelect">
                                                    <option value="" disabled selected>Select Section</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-20 border radius-8 overflow-hidden bg-base">
                                    <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                                        <table class="table bordered-table table-sm align-middle mb-0 text-sm">
                                            <thead class="bg-base position-sticky top-0 z-3 border-bottom">
                                                <tr>
                                                    <th style="width: 40px;" class="text-center">
                                                        <input type="checkbox" class="form-check-input select-all-source"
                                                            id="selectAllSource">
                                                    </th>
                                                    <th>SR No.</th>
                                                    <th>Roll No.</th>
                                                    <th>Student Name</th>
                                                    <th>Father Name</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sourceStudentTableBody">
                                                <tr>
                                                    <td colspan="4" class="text-center py-24 text-muted text-xs">Select
                                                        filters to pull active student ledger</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="col-xl-1 col-lg-1 d-flex flex-column align-items-center justify-content-center gap-3 py-24">
                            <button type="button" class="btn-axis-action shift-right"
                                title="Push Selected to Target Class">
                                <i class="ri-arrow-right-double-line"></i> </button>

                            <button type="button" class="btn-axis-action shift-left" title="Pull Back to Source Ledger">
                                <i class="ri-arrow-left-double-line"></i> </button>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="p-20 radius-12 bg-light-soft border border-dashed-custom h-100">
                                <h6
                                    class="text-sm fw-bold text-primary-light mb-16 text-uppercase tracking-wider d-flex align-items-center gap-2">
                                    <i class="ri-login-box-r-line text-success"></i> Target Batch (Next Session)
                                </h6>

                                <div class="row gy-3">
                                    <div class="col-12">
                                        <div class="premium-input-box">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Action
                                                <span class="text-danger">*</span></label>
                                            <div class="inner-addon">
                                                <i class="ri-calendar-line addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="actionType" id="selectAction">
                                                    <option value="promotion" selected>Promotion</option>
                                                    <option value="demotion">Demotion</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="premium-input-box">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Promote
                                                To Class <span class="text-danger">*</span></label>
                                            <div class="inner-addon">
                                                <i class="ri-git-repository-line addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="target_class_id" id="targetClassSelect">
                                                    <option value="" disabled selected>Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="premium-input-box">
                                            <label
                                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Target
                                                Section/Stream <span class="text-danger">*</span></label>
                                            <div class="inner-addon">
                                                <i class="ri-team-line addon-icon"></i>
                                                <select class="form-control form-select custom-premium-select"
                                                    name="target_section_id" id="targetSectionSelect">
                                                    <option value="" disabled selected>Select Section</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-20 border radius-8 overflow-hidden bg-base">
                                    <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                                        <table class="table bordered-table table-sm align-middle mb-0 text-sm">
                                            <thead class="bg-base position-sticky top-0 z-3 border-bottom">
                                                <tr>
                                                    <th style="width: 40px;" class="text-center">
                                                        <input type="checkbox" class="form-check-input select-all-target"
                                                            id="selectAllTarget">
                                                    </th>
                                                    <th>SR No.</th>
                                                    <th>Student Name</th>
                                                    <th>Father Name</th>
                                                    <th class="text-center">Result Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="targetStudentTableBody">
                                                <tr>
                                                    <td colspan="4" class="text-center py-24 text-muted text-xs">Stage
                                                        records by routing source students</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center backend-action-bar flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2 text-xs text-muted">
                            <i class="ri-information-line text-primary"></i>
                            <span>Staged Queue: <strong class="text-dark-main" id="stagedCount">0</strong> students
                                prepared for batch transition execution.</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="btn btn-premium-action-secondary"
                                onclick="resetPromotionWorkspace()">
                                <i class="ri-refresh-line me-2"></i> Wipe Workspace
                            </button>
                            <button type="submit" class="btn btn-premium-action-primary">
                                <i class="ri-shield-check-line me-2"></i> Commit Structural Promotion
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <style>
        .newly-promoted-row {
            background: #e8fff1 !important;
            font-weight: 500;
            transition: all .3s ease;
        }

        .newly-promoted-row:hover {
            background: #d7ffe7 !important;
        }

        .newly-promoted-row td {
            background: #eafaf1 !important;
            border-top: 1px solid #b7efc5 !important;
            border-bottom: 1px solid #b7efc5 !important;
            transition: all .3s ease;
        }

        .newly-promoted-row:hover td {
            background: #d8f3dc !important;
        }

        .already-promoted-row {
            background: #fff3cd !important;
        }

        .already-promoted-row td {
            background: #fff3cd !important;
            color: #856404;
        }

        .already-promoted-row:hover td {
            background: #ffe69c !important;
        }
    </style>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            fetchClassMasters();
            fetchSessionList();
        });


        function resetPromotionWorkspace() {
            document.getElementById('studentPromotionForm').reset();
            document.getElementById('sourceStudentTableBody').innerHTML =
                '<tr><td colspan="4" class="text-center py-24 text-muted text-xs">Select filters to pull active student ledger</td></tr>';
            document.getElementById('targetStudentTableBody').innerHTML =
                '<tr><td colspan="4" class="text-center py-24 text-muted text-xs">Stage records by routing source students</td></tr>';
            document.getElementById('stagedCount').innerText = '0';
        }


        function fetchClassMasters() {
            fetchMasterData("{{ route('school.class.master.fetch.with') }}", function(res) {
                let options = `<option value="" disabled selected>Select Class</option>`;
                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                $("#sourceClassSelect").html(options);
                $("#targetClassSelect").html(options);
            });
        }

        $(document).on("change", "#sourceClassSelect", function() {
            let class_id = $(this).val();
            if (!class_id) return;

            getDataById("{{ route('school.common.get_class_devisions_by_class_id') }}", class_id,
                function(res) {
                    let options = `<option value="" disabled selected>Select Section</option>`;
                    $.each(res.data, function(i, d) {
                        options += `<option value="${d.id}">${d.name}</option>`;
                    });
                    $("#sourceSectionSelect").html(options);
                });
        });

        $(document).on("change", "#targetClassSelect", function() {
            let class_id = $(this).val();
            if (!class_id) return;

            getDataById("{{ route('school.common.get_class_devisions_by_class_id') }}", class_id,
                function(res) {
                    let options = `<option value="" disabled selected>Select Section</option>`;
                    $.each(res.data, function(i, d) {
                        options += `<option value="${d.id}">${d.name}</option>`;
                    });
                    $("#targetSectionSelect").html(options);
                });
        });

        function fetchSessionList() {

            $.ajax({
                url: "{{ route('school.sessions.fetch') }}",
                method: "GET",
                success: function(res) {

                    let resp = res.data;

                    let rows = "";

                    let activeSession = resp.find(x => x.is_active == 1);

                    let start = parseInt(activeSession.start_year) - 1;
                    let end = parseInt(activeSession.end_year) - 1;
                    let previousSessionId = false;



                    if (resp.length > 0) {

                        $.each(resp, function(index, d) {

                            let isPreviousSession =
                                parseInt(d.start_year) === start &&
                                parseInt(d.end_year) === end;

                            rows += `
                              

                                    <option value="${d.id}"
                                        data-start-year="${d.start_year}"
                                        data-end-year="${d.end_year}"
                                        ${isPreviousSession ? 'selected' : ''}>
                                        Session ${d.name}
                                    </option>
                            `;
                        });

                    } else {

                        rows = `<option value="">No Session Found</option>`;
                    }

                    $("#sourceSessionSelect").html(rows);
                }
            });
        }



        function fetchStudents(type) {

            let sessionSelect = $('#sourceSessionSelect');


            let classSelect = type === 'source' ?
                $('#sourceClassSelect') :
                $('#targetClassSelect');

            let sectionSelect = type === 'source' ?
                $('#sourceSectionSelect') :
                $('#targetSectionSelect');

            let session_id = sessionSelect.val();
            let class_id = classSelect.val();
            let section_id = sectionSelect.val();

            let selectedOption = sessionSelect.find(':selected');

            let start_year = selectedOption.data('start-year');
            let end_year = selectedOption.data('end-year');

            if (!class_id || !section_id) {
                return;
            }

            let requestData = {
                class_id,
                section_id,
                type
            };

            if (type === 'source') {

                requestData.session_id = session_id;

            } else {
                requestData.start_year = start_year;
                requestData.end_year = end_year;
            }

            $.ajax({
                url: "{{ route('school.student.getStudentsForPromotionAndDemotion') }}",
                type: "GET",
                data: requestData,
                success: function(res) {

                    console.log(res);

                    if (type === 'source') {
                        renderSourceStudents(res.data);
                    } else {
                        renderTargetStudents(res.data);
                    }
                }
            });
        }


        function renderSourceStudents(students) {

            let rows = '';

            if (!students || students.length === 0) {

                rows = `
                    <tr>
                            <td colspan="5" class="text-center py-24 text-muted text-xs">
                                No Students Found
                            </td>
                        </tr>
                    `;

                $("#sourceStudentTableBody").html(rows);
                return;
            }

            $.each(students, function(index, student) {

                let isPromoted = student.isPromoted;

                let fullName = `${student.first_name ?? ''} ${student.last_name ?? ''}`.trim();

                rows += `
                   
                            <tr data-student-id="${student.id}"
                                class="${isPromoted ? 'already-promoted-row' : ''}">
                            <td class="text-center">
                                <input type="checkbox"
                                class="form-check-input source-student-checkbox"
                                ${isPromoted ? 'disabled' : ''}>
                            </td>

                            <td>${student.sr_no ?? '-'}</td>

                            <td>${student.admission_no ?? '-'}</td>

                            <td>${fullName}</td>

                            <td>${student.father_name ?? '-'}</td>
                        </tr>
                    `;
            });

            $("#sourceStudentTableBody").html(rows);
        }


        function renderTargetStudents(students) {

            let rows = '';

            if (!students || students.length === 0) {

                rows = `
                    <tr>
                        <td colspan="5" class="text-center py-24 text-muted text-xs">
                            No Students Found
                        </td>
                    </tr>
                `;

                $("#targetStudentTableBody").html(rows);
                updateStagedCount();
                return;
            }

            $.each(students, function(index, student) {

                let fullName =
                    `${student.first_name ?? ''} ${student.last_name ?? ''}`.trim();

                rows += `
                    <tr data-student-id="${student.id}">
                        <td class="text-center">
                            <input type="checkbox"
                                class="form-check-input target-student-checkbox">
                        </td>

                        <td>${student.sr_no ?? '-'}</td>

                        <td>${fullName}</td>

                        <td>${student.father_name ?? '-'}</td>

                        <td class="text-center">
                            <span class="badge bg-success-subtle text-success">
                                Ready
                            </span>
                        </td>
                    </tr>
                `;
            });

            $("#targetStudentTableBody").html(rows);

            updateStagedCount();
        }


        $(document).on('change',
            '#sourceSessionSelect,#sourceClassSelect,#sourceSectionSelect',
            function() {

                if (
                    $('#sourceSessionSelect').val() &&
                    $('#sourceClassSelect').val() &&
                    $('#sourceSectionSelect').val()
                ) {
                    fetchStudents('source');
                }
            }
        );

        $(document).on('change',
            '#targetClassSelect,#targetSectionSelect',
            function() {

                if (

                    $('#targetClassSelect').val() &&
                    $('#targetSectionSelect').val()
                ) {
                    fetchStudents('target');
                }
            }
        );

        // $(document).on('change', '#selectAllSource', function() {

        //     $('.source-student-checkbox').prop(
        //         'checked',
        //         $(this).prop('checked')
        //     );
        // });

        $(document).on('change', '#selectAllSource', function() {

            let checked = $(this).is(':checked');

            $('.source-student-checkbox').each(function() {

                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', checked);
                }

            });

        });
        $(document).on('change', '#selectAllTarget', function() {

            $('.target-student-checkbox').prop(
                'checked',
                $(this).prop('checked')
            );
        });

        $(document).on('click', '.shift-right', function() {
            $('.newly-promoted-row')
                .removeClass('newly-promoted-row');

            $('#sourceStudentTableBody .source-student-checkbox:checked').each(
                function() {

                    let row = $(this).closest('tr');

                    row.find('.source-student-checkbox')
                        .removeClass('source-student-checkbox')
                        .addClass('target-student-checkbox')
                        .prop('checked', false);

                    let tds = row.find('td');

                    let newRow = `
                        <tr data-student-id="${row.data('student-id')}"
                            class="newly-promoted-row">

                            <td class="text-center">        
                                <input type="checkbox"
                                    class="form-check-input target-student-checkbox"
                                    checked>
                            </td>

                            <td>${tds.eq(1).text()}</td>
                            <td>${tds.eq(3).text()}</td>
                            <td>${tds.eq(4).text()}</td>

                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success">
                                    Ready
                                </span>
                            </td>
                        </tr>
                        `;

                    // $('#targetStudentTableBody').append(newRow);
                    $('#targetStudentTableBody').prepend(newRow);

                    row.remove();
                }
            );

            updateEmptyRows();
            updateStagedCount();
        });

        $(document).on('click', '.shift-left', function() {

            $('#targetStudentTableBody .target-student-checkbox:checked').each(
                function() {

                    let row = $(this).closest('tr');

                    row.find('.target-student-checkbox')
                        .removeClass('target-student-checkbox')
                        .addClass('source-student-checkbox')
                        .prop('checked', false);

                    let tds = row.find('td');

                    let newRow = `
                <tr data-student-id="${row.data('student-id')}">
                    <td class="text-center">${tds.eq(0).html()}</td>
                    <td>${tds.eq(1).text()}</td>
                    <td>-</td>
                    <td>${tds.eq(2).text()}</td>
                    <td>${tds.eq(3).text()}</td>
                </tr>
            `;

                    $('#sourceStudentTableBody').append(newRow);

                    row.remove();
                }
            );

            updateEmptyRows();
            updateStagedCount();
        });

        function updateEmptyRows() {

            if ($('#sourceStudentTableBody tr').length === 0) {

                $('#sourceStudentTableBody').html(`
                    <tr>
                        <td colspan="5"
                            class="text-center py-24 text-muted text-xs">
                            No Students Found
                        </td>
                    </tr>
                `);
            }

            if ($('#targetStudentTableBody tr').length === 0) {

                $('#targetStudentTableBody').html(`
                <tr>
                    <td colspan="5"
                        class="text-center py-24 text-muted text-xs">
                        Stage records by routing source students
                    </td>
                </tr>
            `);
            }
        }

        function updateStagedCount() {

            let count = $('#targetStudentTableBody tr[data-student-id]').length;

            $('#stagedCount').text(count);
        }

        $(document).on('submit', '#studentPromotionForm', function(e) {

            e.preventDefault();

            let studentIds = [];

            $('#targetStudentTableBody .target-student-checkbox:checked').each(function() {

                studentIds.push(
                    $(this).closest('tr').data('student-id')
                );

            });

            if (studentIds.length === 0) {

                showToast('error', 'Please select students');
                return;
            }

            $.ajax({
                url: "{{ route('school.student.promoteAndDemoteStudents') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    action_type: $('#selectAction').val(),
                    source_session_id: $('#sourceSessionSelect').val(),
                    source_class_id: $('#sourceClassSelect').val(),
                    source_section_id: $('#sourceSectionSelect').val(),
                    target_class_id: $('#targetClassSelect').val(),
                    target_section_id: $('#targetSectionSelect').val(),
                    student_ids: studentIds
                },
                success: function(res) {

                    showToast('success', res.message);
                    resetPromotionWorkspace();

                },
                error: handleAjaxError
            });

        });
    </script>
@endpush
