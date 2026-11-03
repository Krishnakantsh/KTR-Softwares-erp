@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Module Master')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-apps-2-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Module Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage system modules, display order and theme colors.
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <a href="#"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Add Sub Module
                    </a>
                    <button type="button" id="toggleModuleForm"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Add Module
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Module</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Order</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Colors</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="moduleMasterTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="moduleMasterFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card d-none">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-apps-2-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Create Module</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure module icon, name, display order and theme
                            colors.</p>
                    </div>
                </div>
                <button type="button" id="closeModuleForm" class="btn btn-sm btn-danger-subtle px-16 py-8 radius-8">
                    <i class="ri-close-line"></i> Close
                </button>
            </div>

            <div class="card-body p-28">
                <form id="moduleMasterForm" class="ajaxForm" data-url="{{ route('superAdmin.moduleMaster.save') }}"
                    data-refresh="fetchModuleMasters" data-method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="module_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Module Details</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Module Icon (Class) <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i id="moduleIconPreview"
                                            class="ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="module_icon" name="module_icon" placeholder="e.g., ri-book-open-line"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Module Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-bookmark-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="module_name" name="module_name" placeholder="e.g., Fee Management" required>
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
                                        <input type="number" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="module_order" name="module_order" placeholder="0" value="0"
                                            min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-32">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Theme Colors</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-md-6 col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Text Color
                                    </label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="color" class="form-control form-control-color radius-8"
                                            id="default_txt_color_picker" value="#212529"
                                            style="width: 48px; height: 44px; padding: 4px;">
                                        <input type="text" class="form-control custom-premium-input py-12 radius-8"
                                            id="default_txt_color" name="default_txt_color" placeholder="#212529">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Background Color
                                    </label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="color" class="form-control form-control-color radius-8"
                                            id="default_bg_color_picker" value="#f2f2f2"
                                            style="width: 48px; height: 44px; padding: 4px;">
                                        <input type="text" class="form-control custom-premium-input py-12 radius-8"
                                            id="default_bg_color" name="default_bg_color" placeholder="#f2f2f2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetModuleForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Module
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            fetchModuleMasters();

            $('#toggleModuleForm').on('click', function() {
                $('#moduleMasterFormCard').toggleClass('d-none');
                let opened = !$('#moduleMasterFormCard').hasClass('d-none');
                $(this).html(opened ?
                    '<i class="ri-close-line"></i> Close Form' :
                    '<i class="ri-add-line text-primary-600"></i> Add Module');
                if (opened) {
                    $('html,body').animate({
                        scrollTop: $('#moduleMasterFormCard').offset().top - 20
                    }, 500);
                }
            });

            $('#closeModuleForm').on('click', function() {
                $('#moduleMasterFormCard').addClass('d-none');
                $('#toggleModuleForm').html('<i class="ri-add-line text-primary-600"></i> Add Module');
                resetModuleForm();
            });

            $('#resetModuleForm').on('click', resetModuleForm);

            function resetModuleForm() {
                $('#moduleMasterForm')[0].reset();
                $('#module_id').val('');
                $('#module_order').val('0');
                $('#default_txt_color').val('');
                $('#default_bg_color').val('');
                $('#default_txt_color_picker').val('#212529');
                $('#default_bg_color_picker').val('#f2f2f2');
                $('#moduleIconPreview').attr('class',
                    'ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16'
                );
            }

            // live icon preview
            $('#module_icon').on('input', function() {
                let val = $(this).val().trim();
                $('#moduleIconPreview').attr('class',
                    (val ? val : 'ri-apps-2-line') +
                    ' text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16'
                );
            });

            // sync color pickers <-> text inputs
            $('#default_txt_color_picker').on('input', function() {
                $('#default_txt_color').val($(this).val());
            });
            $('#default_bg_color_picker').on('input', function() {
                $('#default_bg_color').val($(this).val());
            });
            $('#default_txt_color').on('change', function() {
                if (/^#[0-9A-Fa-f]{6}$/.test($(this).val())) {
                    $('#default_txt_color_picker').val($(this).val());
                }
            });
            $('#default_bg_color').on('change', function() {
                if (/^#[0-9A-Fa-f]{6}$/.test($(this).val())) {
                    $('#default_bg_color_picker').val($(this).val());
                }
            });


            $(document).on("click", ".edit-module-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('superAdmin.moduleMaster.get') }}", id, function(res) {
                    if (!res.status) return;
                    let row = res.data;

                    $("#module_id").val(row.id);
                    $("#module_icon").val(row.module_icon).trigger('input');
                    $("#module_name").val(row.module_name);
                    $("#module_order").val(row.module_order);
                    $("#default_txt_color").val(row.default_txt_color).trigger('change');
                    $("#default_bg_color").val(row.default_bg_color).trigger('change');

                    $('#moduleMasterFormCard').removeClass('d-none');
                    $('#toggleModuleForm').html('<i class="ri-close-line"></i> Close Form');

                    $("html, body").animate({
                        scrollTop: $('#moduleMasterFormCard').offset().top - 20
                    }, 300);
                });
            });




        });

        function fetchModuleMasters() {
            fetchMasterData("{{ route('superAdmin.moduleMaster.fetch') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        let txtColor = row.default_txt_color || '#212529';
                        let bgColor = row.default_bg_color || '#f2f2f2';

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 radius-8 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background:${bgColor};">
                                            <i class="${row.module_icon} text-lg" style="color:${txtColor};"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.module_name}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs">${row.module_order}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="radius-4 border border-neutral-200" title="Text Color" style="width:18px;height:18px;background:${txtColor};display:inline-block;"></span>
                                        <span class="radius-4 border border-neutral-200" title="Background Color" style="width:18px;height:18px;background:${bgColor};display:inline-block;"></span>
                                    </div>
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-module-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Edit Module">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-module-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Delete Module">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                } else {
                    html = `
                        <tr>
                            <td colspan="4" class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No modules found.</span>
                            </td>
                        </tr>`;
                }

                $("#moduleMasterTableBody").html(html);

                var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el);
                });
            });
        }
    </script>
@endpush
