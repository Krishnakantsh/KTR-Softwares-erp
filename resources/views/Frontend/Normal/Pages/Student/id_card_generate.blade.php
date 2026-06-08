@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Student ID Card Generator')

@section('dynamic-content')
    <div class="dashboard-main-body">

        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">

            <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon"
                        style="background-color: var(--primary-600); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; id-radius: 8px;">
                        <i class="ri-id-card-line text-xl text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-lg fw-bold mb-0 text-gradient-primary">ID Card Generator</h6>
                        <p class="text-xs text-muted mb-0">Generate, customize, and bulk print student identification cards
                        </p>
                    </div>
                </div>
                <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
                    <i class="ri-printer-line me-1"></i> System Ready
                </span>
            </div>

            <div class="card-body p-24">
                <form id="idCardGeneratorForm" autocomplete="off">
                    @csrf

                    <div class="p-20 radius-12 bg-light-soft border border-dashed-custom mb-24">
                        <div class="row g-3 align-items-end">

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Class
                                        <span class="text-danger">*</span></label>
                                    <div class="inner-addon">
                                        <i class="ri-git-repository-line addon-icon"></i>
                                        <select class="form-control form-select custom-premium-select" name="class_id"
                                            id="classSelect">
                                            <option value="" disabled selected>Select Class</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Section
                                        <span class="text-danger">*</span></label>
                                    <div class="inner-addon">
                                        <i class="ri-team-line addon-icon"></i>
                                        <select class="form-control form-select custom-premium-select" name="section_id"
                                            id="sectionSelect">
                                            <option value="" disabled selected>Select Section</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Type
                                        <span class="text-danger">*</span></label>
                                    <div class="inner-addon">
                                        <i class="ri-layout-grid-line addon-icon"></i>
                                        <select class="form-control form-select custom-premium-select" name="card_type"
                                            id="cardTypeSelect">
                                            <option value="Horizontal" selected>Horizontal</option>
                                            <option value="Vertical">Vertical</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Format
                                        <span class="text-danger">*</span></label>
                                    <div class="inner-addon">
                                        <i class="ri-palette-line addon-icon"></i>
                                        <select class="form-control form-select custom-premium-select" name="format_id"
                                            id="formatSelect">
                                            <option value="" disabled selected>Format</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-12 d-flex align-items-center justify-content-xl-end gap-3 mt-md-16">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" id="multipleCheck" checked>
                                    <label class="form-check-label text-sm fw-medium text-primary-light mb-0"
                                        style="white-space: nowrap;" id="multipleCheckLabel">Multiple</label>
                                </div>
                                <button type="button"
                                    class="btn btn-danger px-24 py-10 fw-semibold radius-8 d-flex align-items-center gap-2"
                                    id="printIdCardsBtn">
                                    <i class="ri-printer-line"></i> Print
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="border radius-8 overflow-hidden bg-base">
                        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                            <table class="table bordered-table table-hover align-middle mb-0 text-sm">
                                <thead
                                    class="bg-base position-sticky top-0 z-3 border-bottom table-light text-uppercase tracking-wider text-xs">
                                    <tr>
                                        <th style="width: 50px;" class="text-center">
                                            <input type="checkbox" class="form-check-input" id="selectAllStudents" checked>
                                        </th>
                                        <th>S.No.</th>
                                        <th>Roll No.</th>
                                        <th>Adm. No.</th>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Father's Name</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsTableBody">
                                    <tr>
                                        <td colspan="8" class="text-center py-32 text-muted text-xs">
                                            <i class="ri-search-eye-line d-block text-xl mb-8"></i>
                                            Select Class and Section to load student ledger
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            fetchClassMasters();
            fetchFormatTemplates();

            // Toggle sabhi checkboxes ko ek sath toggle karne ke liye
            $(document).on('change', '#selectAllStudents', function() {
                $('.student-checkbox').prop('checked', this.checked);
            });

            // individual student checkbox change event
            $(document).on('change', '.student-checkbox', function() {
                if ($('.student-checkbox:checked').length == $('.student-checkbox').length) {
                    $('#selectAllStudents').prop('checked', true);
                } else {
                    $('#selectAllStudents').prop('checked', false);
                }
            });
        });

        // Backend API se Classes fetch karne ke liye
        function fetchClassMasters() {
            fetchMasterData("{{ route('school.class.master.fetch.with') }}", function(res) {
                let options = `<option value="" disabled selected>Select Class</option>`;
                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                $("#classSelect").html(options);
            });
        }

        // Class change hone par Section filter load karne ke liye
        $(document).on("change", "#classSelect", function() {
            let class_id = $(this).val();
            if (!class_id) return;

            getDataById("{{ route('school.common.get_class_devisions_by_class_id') }}", class_id, function(res) {
                let options = `<option value="" disabled selected>Select Section</option>`;
                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                $("#sectionSelect").html(options);
            });
        });

        // Section select hone par students data load karne ke liye event handler
        $(document).on("change", "#sectionSelect", function() {
            let class_id = $("#classSelect").val();
            let section_id = $(this).val();

            if (class_id && section_id) {
                loadStudentLedger(class_id, section_id);
            }
        });

        // ID Card Format Design Styles fetch karne ke liye
        function fetchFormatTemplates() {
            // Dummy implementation: Aap isko actual backend endpoint routes se replace kar sakte hain.
            let formats = [{
                    id: 1,
                    name: "Format 1 (Classic Blue)"
                },
                {
                    id: 2,
                    name: "Format 2 (Modern Red)"
                }
            ];
            let options = `<option value="" disabled selected>Format</option>`;
            $.each(formats, function(i, d) {
                options += `<option value="${d.id}">${d.name}</option>`;
            });
            $("#formatSelect").html(options);
        }

        // Students Table data load function
        function loadStudentLedger(classId, sectionId) {
            $("#studentsTableBody").html(
                `<tr><td colspan="8" class="text-center py-24"><div class="spinner-border spinner-border-sm text-primary"></div> Fetching Records...</td></tr>`
                );

            // Yahan actual system student fetch dynamic AJAX url setup karein
            $.ajax({
                url: "{{ route('school.common.get_students_based_class_section') }}",
                method: "GET",
                data: {
                    class_id: classId,
                    section_id: sectionId
                },
                success: function(res) {
                    let rows = "";

                    console.log("Fetched students from id generate ", res);
                    if (res.data && res.data.length > 0) {
                        $.each(res.data, function(index, student) {
                            rows += `
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input student-checkbox" value="${student.id}" checked>
                                    </td>
                                    <td>${index + 1}</td>
                                    <td>${student.roll_no ?? 'N/A'}</td>
                                    <td>${student.admission_no ?? 'N/A' }</td>
                                    <td>${student.sr_no ?? 'N/A'}</td>
                                    <td class="fw-medium text-dark-main">${student.first_name + ' '+ student.last_name}</td>
                                    <td>${student.class_master?.name ?? 'N/A'}</td>
                                    <td>${student.father_name ?? 'N/A'}</td>
                                </tr>
                            `;
                        });
                        $("#selectAllStudents").prop('checked', true);
                    } else {
                        rows =
                            `<tr><td colspan="8" class="text-center py-24 text-muted">No student records active for selected filters.</td></tr>`;
                    }
                    $("#studentsTableBody").html(rows);
                },
                error: function() {
                    $("#studentsTableBody").html(
                        `<tr><td colspan="8" class="text-center py-24 text-danger"><i class="ri-error-warning-line"></i> Failed to pull data.</td></tr>`
                        );
                }
            });
        }

        // Print functionality trigger action
        $(document).on("click", "#printIdCardsBtn", function() {
            let selectedStudents = [];
            $(".student-checkbox:checked").each(function() {
                selectedStudents.push($(this).val());
            });

            if (selectedStudents.length === 0) {
                alert("Please select at least one student to print ID cards.");
                return;
            }

            let format = $("#formatSelect").val();
            let type = $("#cardTypeSelect").val();

            if (!format) {
                alert("Please select an ID Card Template Format.");
                return;
            }

            // Print view redirect logic window open 
            console.log("Printing IDs for: ", selectedStudents, "Type: ", type, "Format: ", format);
            // window.open(`/school/id-cards/print?students=${selectedStudents.join(',')}&format=${format}&type=${type}`, '_blank');
        });
    </script>
@endpush
