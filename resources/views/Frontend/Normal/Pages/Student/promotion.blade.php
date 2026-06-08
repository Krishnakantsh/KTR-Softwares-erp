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
                <form id="studentPromotionForm" class="ajaxForm" data-url="#" data-method="POST" autocomplete="off">
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


    <script>
        function resetPromotionWorkspace() {
            document.getElementById('studentPromotionForm').reset();
            document.getElementById('sourceStudentTableBody').innerHTML =
                '<tr><td colspan="4" class="text-center py-24 text-muted text-xs">Select filters to pull active student ledger</td></tr>';
            document.getElementById('targetStudentTableBody').innerHTML =
                '<tr><td colspan="4" class="text-center py-24 text-muted text-xs">Stage records by routing source students</td></tr>';
            document.getElementById('stagedCount').innerText = '0';
        }
    </script>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            fetchClassMasters();
            fetchSessionList();
        });

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
    </script>
@endpush
