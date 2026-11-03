@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Sub Module Master')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-stack-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Sub Module Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage sub modules under each parent module, order,
                            permissions and tutorial links.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="toggleSubModuleForm"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Add Sub Module
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Sub Module</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Module</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    URL</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Order</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Dashboard</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="subModuleMasterTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="subModuleMasterFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card d-none">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-stack-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Create Sub Module</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select parent module and configure sub module
                            details.</p>
                    </div>
                </div>
                <button type="button" id="closeSubModuleForm" class="btn btn-sm btn-danger-subtle px-16 py-8 radius-8">
                    <i class="ri-close-line"></i> Close
                </button>
            </div>

            <div class="card-body p-28">
                <form id="subModuleMasterForm" class="ajaxForm" data-url="{{ route('superAdmin.subModuleMaster.save') }}"
                    data-refresh="fetchSubModuleMasters" data-method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="sub_module_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Sub Module Details
                            </h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Module <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-select custom-premium-input ps-44 py-12 radius-8" id="module_id"
                                            name="module_id" required>
                                            <option value="">-- Select Module --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Sub Module Icon (Class) <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i id="subModuleIconPreview"
                                            class="ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="sub_module_icon" name="sub_module_icon"
                                            placeholder="e.g., ri-file-list-line" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Sub Module Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-bookmark-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="sub_module_name" name="sub_module_name" placeholder="e.g., Fee Collection"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Sub Module URL <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-links-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="sub_module_url" name="sub_module_url" placeholder="e.g., fee-collection"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Sub Module Short Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-price-tag-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="submodule_sortname" name="submodule_sortname" placeholder="e.g., FC"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Display Order
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-sort-asc text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="sub_module_order" name="sub_module_order" placeholder="0" value="0"
                                            min="0">
                                    </div>
                                </div>
                            </div>
                            {{-- 
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Show on Dashboard
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-dashboard-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-select custom-premium-input ps-44 py-12 radius-8"
                                            id="dashboard_permission" name="dashboard_permission">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}



                        </div>
                    </div>

                    <div class="form-segment mb-32">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Tutorial Videos
                                (Optional)</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-md-6 col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        English Video URL
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-play-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="eng_video_url" name="eng_video_url"
                                            placeholder="https://youtube.com/...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Hindi Video URL
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-play-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="hin_video_url" name="hin_video_url"
                                            placeholder="https://youtube.com/...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    {{-- <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetSubModuleForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Sub Module
                        </button>
                    </div> --}}

                    <div class="d-flex justify-content-between align-items-center gap-3 execution-control-bar flex-wrap">

                        <div class="d-flex align-items-center gap-8">
                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch">
                                    <input type="checkbox" id="dashboard_permission" value="1"
                                        class="sub-module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <span class="text-sm fw-semibold text-neutral-700">Show on Dashboard</span>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="button" id="resetSubModuleForm"
                                class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                                <i class="ri-loop-left-line"></i> Reset
                            </button>
                            <button type="submit"
                                class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                                <i class="ri-save-3-line"></i> Save Sub Module
                            </button>
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

            fetchModulesDropdown();
            fetchSubModuleMasters();

            $('#toggleSubModuleForm').on('click', function() {
                $('#subModuleMasterFormCard').toggleClass('d-none');
                let opened = !$('#subModuleMasterFormCard').hasClass('d-none');
                $(this).html(opened ?
                    '<i class="ri-close-line"></i> Close Form' :
                    '<i class="ri-add-line text-primary-600"></i> Add Sub Module');
                if (opened) {
                    $('html,body').animate({
                        scrollTop: $('#subModuleMasterFormCard').offset().top - 20
                    }, 500);
                }
            });

            $('#closeSubModuleForm').on('click', function() {
                $('#subModuleMasterFormCard').addClass('d-none');
                $('#toggleSubModuleForm').html(
                    '<i class="ri-add-line text-primary-600"></i> Add Sub Module');
                resetSubModuleForm();
            });

            $('#resetSubModuleForm').on('click', resetSubModuleForm);

            function resetSubModuleForm() {
                $('#subModuleMasterForm')[0].reset();
                $('#sub_module_id').val('');
                $('#sub_module_order').val('0');
                // $('#dashboard_permission').val('0');
                $('#dashboard_permission').prop('checked', false);
                $('#module_id').val('');
                $('#subModuleIconPreview').attr('class',
                    'ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16'
                );
            }

            // live icon preview
            $('#sub_module_icon').on('input', function() {
                let val = $(this).val().trim();
                $('#subModuleIconPreview').attr('class',
                    (val ? val : 'ri-apps-2-line') +
                    ' text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16'
                );
            });

            // Populate module dropdown via AJAX
            function fetchModulesDropdown() {
                $.ajax({
                    url: "{{ route('superAdmin.moduleMaster.fetch') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        let options = '<option value="">-- Select Module --</option>';
                        if (res.status && res.data.length > 0) {
                            $.each(res.data, function(index, row) {
                                options +=
                                    `<option value="${row.id}">${row.module_name}</option>`;
                            });
                        }
                        $('#module_id').html(options);
                    },
                    error: function() {
                        $('#module_id').html('<option value="">-- Failed to load modules --</option>');
                    }
                });
            }

            $(document).on("click", ".edit-sub-module-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('superAdmin.subModuleMaster.get') }}", id, function(res) {
                    if (!res.status) return;
                    let row = res.data;

                    $("#sub_module_id").val(row.id);
                    $("#module_id").val(row.module_id);
                    $("#sub_module_icon").val(row.sub_module_icon).trigger('input');
                    $("#sub_module_name").val(row.sub_module_name);
                    $("#sub_module_url").val(row.sub_module_url);
                    $("#submodule_sortname").val(row.submodule_sortname);
                    $("#sub_module_order").val(row.sub_module_order);
                    // $("#dashboard_permission").val(row.dashboard_permission);
                    $("#dashboard_permission").prop('checked', parseInt(row
                        .dashboard_permission) === 1);
                    $("#eng_video_url").val(row.eng_video_url);
                    $("#hin_video_url").val(row.hin_video_url);

                    $('#subModuleMasterFormCard').removeClass('d-none');
                    $('#toggleSubModuleForm').html('<i class="ri-close-line"></i> Close Form');

                    $("html, body").animate({
                        scrollTop: $('#subModuleMasterFormCard').offset().top - 20
                    }, 300);
                });
            });


            $('#subModuleMasterForm').on('submit', function() {
                $(this).find('input[name="dashboard_permission"]')
            .remove();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'dashboard_permission',
                    value: $('#dashboard_permission').is(':checked') ? '1' : '0'
                }).appendTo(this);
            });


        });

        function fetchSubModuleMasters() {
            fetchMasterData("{{ route('superAdmin.subModuleMaster.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        let permBadge = row.dashboard_permission == true ?
                            `<span class="badge bg-success-50 text-success-700 border border-success-100 px-8 py-4 radius-6 font-xxs">Yes</span>` :
                            `<span class="badge bg-neutral-100 text-neutral-600 border border-neutral-200 px-8 py-4 radius-6 font-xxs">No</span>`;

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 radius-8 d-flex align-items-center justify-content-center bg-primary-50" style="width: 40px; height: 40px;">
                                            <i class="${row.sub_module_icon} text-lg text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.sub_module_name}</h6>
                                            <span class="text-xxs text-neutral-500">${row.submodule_sortname ?? ''}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs fw-medium text-neutral-700">${row.module.module_name ?? '-'}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600">${row.sub_module_url}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs">${row.sub_module_order}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${permBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-sub-module-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Edit Sub Module">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-sub-module-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Delete Sub Module">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                } else {
                    html = `
                        <tr>
                            <td colspan="6" class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No sub modules found.</span>
                            </td>
                        </tr>`;
                }

                $("#subModuleMasterTableBody").html(html);

                var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el);
                });
            });
        }
    </script>
@endpush
