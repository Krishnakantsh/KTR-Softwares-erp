@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Student ID / Roll No Generator')

@section('dynamic-content')
    <div class="dashboard-main-body">


        <!-- Premium Filter Block (Upgraded to Transport Panel UI Style) -->
        <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden mt-8 premium-generator-card">
            <div
                class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center dynamic-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon">
                        <i class="ri-settings-4-line text-xl text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Assign Roll No / Feebook No.</h6>
                        <p class="text-xs text-muted mb-0">Set rules and patterns to auto-build sequence numbers</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-24">
                <form id="filterForm" onsubmit="event.preventDefault();">
                    <div class="row gy-4 mb-24">

                        <!-- 1. Type Option -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box" id="typeFieldContainer">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    1. Sequence Type <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-fingerprint-line text-primary-600 addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" id="filterType">
                                        <option value="Roll No" selected>Roll No</option>
                                        <option value="Exam Roll No">Exam Roll No</option>
                                        <option value="FeeBook No">FeeBook No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Class Option -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box" id="classFieldContainer">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    2. Target Class <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-git-repository-line text-primary-600 addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="class_id"
                                        id="filterClass" onchange="validateClassSelect()">

                                    </select>
                                </div>
                                <div class="text-danger font-medium mt-2 d-none" id="classError"
                                    style="font-size: 11px; letter-spacing: 0.3px;">
                                    <i class="ri-error-warning-line me-1"></i> Please Select Class !
                                </div>
                            </div>
                        </div>

                        <!-- 3. Division Option -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box" id="divisionFieldContainer">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    3. Division / Section <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-team-line text-primary-600 addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="section_id"
                                        id="filterDivision">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Prefix No -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    4. Prefix Modifier
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-text-spacing text-primary-600 addon-icon"></i>
                                    <input type="text" class="form-control custom-premium-input" id="prefixNo"
                                        placeholder="e.g. 2026-">
                                </div>
                            </div>
                        </div>

                        <!-- 5. Suffix No -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    5. Suffix Modifier
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-text-wrap text-primary-600 addon-icon"></i>
                                    <input type="text" class="form-control custom-premium-input" id="suffixNo"
                                        placeholder="e.g. -A">
                                </div>
                            </div>
                        </div>

                        <!-- 6. Start No -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    6. Sequence Start Seed <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-number-1 text-primary-600 addon-icon"></i>
                                    <input type="number" class="form-control custom-premium-input" id="startNo"
                                        value="1" min="1">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Action Control Panel -->
                    <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                        <button type="button" class="btn btn-premium-secondary px-24 py-12 radius-8 fw-semibold"
                            id="btnGenerate" onclick="generateStudentList()">
                            <i class="ri-refresh-line me-2"></i> Generate List
                        </button>
                        <button type="button" class="btn btn-premium-primary px-24 py-12 radius-8 fw-semibold"
                            id="btnSave" disabled>
                            <i class="ri-save-3-line me-2"></i> Save System Records
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Student Data Display Table -->
        <div class="mt-24 d-none" id="studentTableWrapper">
            <div class="card h-100 radius-12 border-0 shadow-sm">
                <div class="card-body p-0 dataTable-wrapper">
                    <div class="p-3">
                        <table class="table bordered-table mb-0" id="RollNoDataTable">
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col" id="dynamicTableHeader">Roll No</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Session</th>
                                    <th scope="col">Adm N.</th>
                                    <th scope="col">Father Name</th>
                                </tr>
                            </thead>
                            <tbody id="studentListTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


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

        //  fetch student when class and section is selected 


        let allStudents = [];

        $(document).on("change", "select[name='section_id']", function() {

            let class_id = $("#filterClass").val();
            let section_id = $(this).val();
            let typeValue = $('#filterType').val();


            if (!class_id && !section_id) {
                showToast('error', 'Please select valid class and section');
                return;
            }

            console.log("Class_id : ", class_id);
            console.log("section_id : ", section_id);


            fetchMasterData("{{ route('school.common.get_students_based_class_section') }}", showStudents, {
                'class_id': class_id,
                'section_id': section_id
            });


            function showStudents(res) {

                console.log('students : ', res);

                let data = res.data;
                allStudents = data;

                if (data.length > 0) {

                    let rows = '';
                    let autoNo = '';

                    $.each(data, function(i, d) {

                        let fieldData = '';

                        if (typeValue === 'Roll No') {
                            fieldData = d.roll_no;
                        } else if (typeValue === 'Exam Roll No') {
                            fieldData = d.exam_rollno;
                        } else {
                            fieldData = d.feebook_no;
                        }

                        rows += `
                                <tr id="tr-row-${i}" data-student-id="${d.id}">
                                    <td>${i + 1}</td>
                                    <td>
                                        <input type="text" 
                                            name="generated_nos[]" 
                                            class="table-inline-input val-check-input" 
                                            value="${fieldData}" 
                                            data-student-id="${d.id}"
                                            data-target-tr="tr-row-${i}" 
                                            oninput="verifyDuplicateValues()">
                                    </td>
                                    <td class="fw-medium">${d.first_name + " "+ d.last_name }</td>
                                    <td><span class="badge bg-neutral-100 text-neutral-600 border">${d.class_master?.name || 'N/A'}</span></td>
                                     <td>${d.section?.name || 'N/A'}</td>
                                    <td><span class="text-secondary-light fw-semibold">${d.admission_no}</span></td>
                                    <td>${d.father_name || 'N/A'}</td>
                                </tr>
                            `;

                    });

                    $('#studentListTableBody').html(rows);
                    $('#studentTableWrapper').removeClass('d-none');
                    $('#btnSave').removeAttr('disabled');

                }

            }

        });

        function validateClassSelect() {
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

        function generateStudentList() {
            if (!validateClassSelect()) return;

            let typeValue = $('#filterType').val();
            let classValue = $('#filterClass').val();
            let prefix = $('#prefixNo').val() || "";
            let suffix = $('#suffixNo').val() || "";
            let startNo = parseInt($('#startNo').val()) || 1;

            $('#dynamicTableHeader').text(typeValue);

            let tbody = $('#studentListTableBody');
            tbody.empty();

            console.log("All students from students : ", allStudents);

            allStudents.forEach((student, index) => {
                let autoNo = `${prefix}${startNo + index}${suffix}`;

                let row = `
                    <tr id="tr-row-${index}"  data-student-id="${student.id}" >
                        <td>${index + 1}</td>
                        <td>
                            <input type="text" 
                                name="generated_nos[]" 
                                class="table-inline-input val-check-input" 
                                value="${autoNo}" 
                                data-student-id="${student.id}"
                                data-target-tr="tr-row-${index}" 
                                oninput="verifyDuplicateValues()">
                        </td>
                        <td class="fw-medium">${student.first_name + ' '+ student.last_name}</td>
                        <td><span class="badge bg-neutral-100 text-neutral-600 border">${student.class_master?.name || 'N/A'}</span></td>
                        <td>${student.section.name}</td>
                        <td><span class="text-secondary-light fw-semibold">${student.admission_no || 'N/A'}</span></td>
                        <td>${student.father_name || 'N/A'}</td>
                    </tr>
                `;
                tbody.append(row);
            });

            $('#studentTableWrapper').removeClass('d-none');
            $('#btnSave').removeAttr('disabled');
        }

        function verifyDuplicateValues() {
            let inputs = $('.val-check-input');
            let itemMap = {};
            let hasDuplicate = false;

            inputs.each(function() {
                let trId = $(this).data('target-tr');
                $(`#${trId}`).removeClass('duplicate-tr-alert');
                $(this).removeClass('duplicate-input-alert');

                let currentVal = $(this).val() ? $(this).val().trim() : "";
                if (currentVal !== "") {
                    if (!itemMap[currentVal]) {
                        itemMap[currentVal] = [];
                    }
                    itemMap[currentVal].push($(this));
                }
            });

            for (let val in itemMap) {
                if (itemMap[val].length > 1) {
                    hasDuplicate = true;
                    itemMap[val].forEach(function($el) {
                        let rowId = $el.data('target-tr');
                        $(`#${rowId}`).addClass('duplicate-tr-alert');
                        $el.addClass('duplicate-input-alert');
                    });
                }
            }

            $('#btnSave').prop('disabled', hasDuplicate);
        }


        $('#filterType').on('change', function() {

            let typeValue = $(this).val();

            $('#dynamicTableHeader').text(typeValue);

            // Agar table loaded hai tabhi update karo
            if (allStudents.length === 0) {
                return;
            }

            $('#studentListTableBody tr').each(function(index) {

                let student = allStudents[index];

                let fieldData = '';

                if (typeValue === 'Roll No') {
                    fieldData = student.roll_no || '';
                } else if (typeValue === 'Exam Roll No') {
                    fieldData = student.exam_rollno || '';
                } else {
                    fieldData = student.feebook_no || '';
                }

                $(this)
                    .find('input[name="generated_nos[]"]')
                    .val(fieldData);

            });

            verifyDuplicateValues();

        });

        $('#btnSave').on('click', function() {

            if ($('.duplicate-input-alert').length > 0) {
                showToast('error', 'Duplicate values found');
                return;
            }

            let studentsData = [];

            $('#studentListTableBody tr').each(function() {

                studentsData.push({
                    student_id: $(this).data('student-id'),
                    generated_no: $(this).find('input[name="generated_nos[]"]').val()
                });

            });

            let payload = {
                type: $('#filterType').val(),
                students: studentsData
            };

            console.log(payload);

            $.ajax({
                url: "{{ route('school.common.save_assign_roll_no') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(payload)
                },
                success: function(res) {

                    showToast(
                        'success',
                        `${$('#filterType').val().toUpperCase()} assigned successfully`
                    );

                },
                error: function(xhr) {

                    showToast('error', 'Something went wrong');

                }
            });

        });
    </script>
@endpush
