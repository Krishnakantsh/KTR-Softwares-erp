@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : User Setting Master')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-settings-4-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Filter Module Setting</h5>
                        <p class="text-xs text-neutral-500 mb-0">Create dynamic settings mapped to a module and
                            sub-module.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">

                    <button type="button" id="toggleSettingForm"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Add Setting
                    </button>
                </div>
            </div>

            <div class="card-body p-28">
                <div class="form-segment mb-28">


                    <div class="row gy-4">
                        <div class="col-xl-6 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Module <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <select class="form-select custom-premium-input ps-44 py-12 radius-8"
                                        id="filter_module_id" name="module_id" required>
                                        <option value="">-- Select Module --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Sub Module <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-apps-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <select class="form-select custom-premium-input ps-44 py-12 radius-8"
                                        id="filter_sub_module_id" name="module_id" required>
                                        <option value="">-- Select Sub Module --</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-settings-4-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">User Setting Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Create dynamic settings mapped to a module and
                            sub-module.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    S.No.</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Setting Title</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Setting Key</th>
                              
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Type</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    For Admin</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userSettingTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="userSettingFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card d-none">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-settings-4-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Create Setting</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select module &amp; sub-module, then configure the
                            setting type.</p>
                    </div>
                </div>
                <button type="button" id="closeSettingForm" class="btn btn-sm btn-danger-subtle px-16 py-8 radius-8">
                    <i class="ri-close-line"></i> Close
                </button>
            </div>

            <div class="card-body p-28">
                <form id="userSettingForm" class="ajaxForm" data-url="{{ route('superAdmin.userSettingMaster.save') }}"
                    data-refresh="fetchUserSettings" data-method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="setting_id" value="">

                    {{-- Segment 01: Module / Sub-Module --}}
                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Module Mapping
                            </h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-6 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Select Module <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select custom-premium-input py-12 radius-8" id="module_id"
                                        name="module_id" required>
                                        <option value="">Select Module</option>
                                    </select>
                                    <span class="text-danger font-xxs d-none" id="module_id_error">Please select
                                        module</span>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Select Sub-Module <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select custom-premium-input py-12 radius-8" id="sub_module_id"
                                        name="sub_module_id" required disabled>
                                        <option value="">Select Sub-Module</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Segment 02: Setting Details --}}
                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Setting Details
                            </h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Setting Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control custom-premium-input py-12 radius-8"
                                        id="setting_title" name="setting_title" placeholder="e.g., Gender" required>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Setting Key <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control custom-premium-input py-12 radius-8"
                                        id="setting_key" name="setting_key" placeholder="e.g., gender" required>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Setting Type <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select custom-premium-input py-12 radius-8" id="setting_type"
                                        name="setting_type" required>
                                        <option value="">Select Type</option>
                                        <option value="1">On/Off</option>
                                        <option value="2">Options</option>
                                        <option value="3">Options (Multiple)</option>
                                        <option value="4">Input</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Segment 03a: On/Off default --}}
                    <div class="form-segment mb-28 d-none" id="segment_on_off">
                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Setting
                                    </label>
                                    <select class="form-select custom-premium-input py-12 radius-8"
                                        id="default_setting_on_off" name="default_setting_on_off">
                                        <option value="0">Off</option>
                                        <option value="1">On</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Segment 03b: Input default --}}
                    <div class="form-segment mb-28 d-none" id="segment_input">
                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Value
                                    </label>
                                    <input type="text" class="form-control custom-premium-input py-12 radius-8"
                                        id="default_setting_input" name="default_setting_input"
                                        placeholder="Enter default value">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Segment 03c: Options / Options(Multiple) --}}
                    <div class="form-segment mb-28 d-none" id="segment_options">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-16 segment-indicator">
                            <div class="d-flex align-items-center gap-2">
                                <span
                                    class="badge bg-warning-100 text-warning-700 font-xs fw-bold px-12 py-6 radius-6">03</span>
                                <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Options</h6>
                            </div>
                            <button type="button" id="addOptionRow"
                                class="btn btn-icon bg-primary-50 hover-bg-primary-100 border border-primary-200 text-primary-700 p-6 px-10 radius-8">
                                <i class="ri-add-line text-lg"></i>
                            </button>
                        </div>

                        <div id="optionRowsWrapper" class="d-flex flex-column gap-3">
                            {{-- option rows injected here by JS --}}
                        </div>
                        <template id="optionRowTemplate">
                            <div class="option-row d-flex align-items-center gap-3">
                                <input type="checkbox" class="form-check-input option-is-default mt-0"
                                    title="Set as default">
                                <input type="text"
                                    class="form-control custom-premium-input py-12 radius-8 option-title"
                                    placeholder="Option Title">
                                <input type="text" class="form-control custom-premium-input py-12 radius-8 option-key"
                                    placeholder="Option Key">
                                <button type="button"
                                    class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 remove-option-row">
                                    <i class="ri-subtract-line text-lg"></i>
                                </button>
                            </div>
                        </template>
                        <input type="hidden" name="options" id="options_json">
                    </div>

                    {{-- Segment: Admin visibility --}}
                    <div class="form-segment mb-32 d-flex align-items-center">
                        {{-- <div class="form-check form-switch d-flex align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="in_admin_hand"
                                name="in_admin_hand" value="1">
                            <label class="form-check-label text-sm fw-semibold text-neutral-700" for="in_admin_hand">
                                Visible to Admin only
                            </label>
                        </div> --}}
                        <div class="form-check form-switch p-0 m-0 me-8">

                            <label class="switch ">
                                <input type="checkbox" id="in_admin_hand" name="in_admin_hand"
                                    value="1" class="module-active-toggle">
                                <span class="slider"></span>
                                   
                            </label>
                        </div>
                          Visible to Admin only
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetSettingForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Setting
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script>
        const SETTING_TYPE = {
            ON_OFF: '1',
            OPTIONS: '2',
            OPTIONS_MULTIPLE: '3',
            INPUT: '4'
        };

        $(document).ready(function() {

            fetchModulesDropdown();
            fetchUserSettings();

            $('#toggleSettingForm').on('click', function() {
                $('#userSettingFormCard').toggleClass('d-none');
                let opened = !$('#userSettingFormCard').hasClass('d-none');
                $(this).html(opened ?
                    '<i class="ri-close-line"></i> Close Form' :
                    '<i class="ri-add-line text-primary-600"></i> Add Setting');
                if (opened) {
                    $('html,body').animate({
                        scrollTop: $('#userSettingFormCard').offset().top - 20
                    }, 500);
                }
            });

            $('#closeSettingForm').on('click', function() {
                $('#userSettingFormCard').addClass('d-none');
                $('#toggleSettingForm').html('<i class="ri-add-line text-primary-600"></i> Add Setting');
                resetSettingForm();
            });

            $('#resetSettingForm').on('click', resetSettingForm);

            function resetSettingForm() {
                $('#userSettingForm')[0].reset();
                $('#setting_id').val('');
                $('#sub_module_id').html('<option value="">Select Sub-Module</option>').prop('disabled', true);
                $('#optionRowsWrapper').html('');
                hideAllTypeSegments();
            }

            // ---------- Module -> Sub-Module dependent dropdown (form) ----------
            $('#module_id').on('change', function() {
                let moduleId = $(this).val();
                loadSubModules(moduleId, '#sub_module_id');
            });

            // ---------- Module -> Sub-Module dependent dropdown (filter bar) ----------
            $('#filter_module_id').on('change', function() {
                let moduleId = $(this).val();
                if (!moduleId) {
                    $('#filter_sub_module_id').html('<option value="">All Sub Modules</option>').prop(
                        'disabled', true);
                } else {
                    loadSubModules(moduleId, '#filter_sub_module_id', true);
                }
                fetchUserSettings();
            });

            $('#filter_sub_module_id').on('change', fetchUserSettings);

            function loadSubModules(moduleId, targetSelector, isFilter = false) {
                let $target = $(targetSelector);
                let placeholder = isFilter ? 'All Sub Modules' : 'Select Sub-Module';

                if (!moduleId) {
                    $target.html(`<option value="">${placeholder}</option>`).prop('disabled', true);
                    return;
                }

                $target.prop('disabled', true).html('<option value="">Loading...</option>');

                $.get("{{ route('superAdmin.subModuleMaster.byModule') }}", {
                    module_id: moduleId
                }, function(res) {
                    let html = `<option value="">${placeholder}</option>`;
                    if (res.status && res.data.length > 0) {
                        $.each(res.data, function(i, row) {
                            html += `<option value="${row.id}">${row.sub_module_name}</option>`;
                        });
                    }
                    $target.html(html).prop('disabled', false);
                });
            }

            function fetchModulesDropdown() {
                $.get("{{ route('superAdmin.moduleMaster.fetch') }}", function(res) {
                    if (!res.status) return;
                    let html = '<option value="">Select Module</option>';
                    let filterHtml = '<option value="">All Modules</option>';
                    $.each(res.data, function(i, row) {
                        html += `<option value="${row.id}">${row.module_name}</option>`;
                        filterHtml += `<option value="${row.id}">${row.module_name}</option>`;
                    });
                    $('#module_id').html(html);
                    $('#filter_module_id').html(filterHtml);
                });
            }

            // ---------- Setting Type -> dynamic segments ----------
            $('#setting_type').on('change', function() {
                let type = $(this).val();
                hideAllTypeSegments();

                if (type === SETTING_TYPE.ON_OFF) {
                    $('#segment_on_off').removeClass('d-none');
                } else if (type === SETTING_TYPE.INPUT) {
                    $('#segment_input').removeClass('d-none');
                } else if (type === SETTING_TYPE.OPTIONS || type === SETTING_TYPE.OPTIONS_MULTIPLE) {
                    $('#segment_options').removeClass('d-none');
                    if ($('#optionRowsWrapper').children().length === 0) {
                        addOptionRow();
                        addOptionRow();
                    }
                }
            });

            function hideAllTypeSegments() {
                $('#segment_on_off, #segment_input, #segment_options').addClass('d-none');
            }

            // ---------- Option rows (add / remove) ----------
            $('#addOptionRow').on('click', () => addOptionRow());

            function addOptionRow(title = '', key = '', isDefault = false) {
                let $row = $($('#optionRowTemplate').html());
                $row.find('.option-title').val(title);
                $row.find('.option-key').val(key);
                $row.find('.option-is-default').prop('checked', isDefault);
                $('#optionRowsWrapper').append($row);
            }

            $(document).on('click', '.remove-option-row', function() {
                if ($('#optionRowsWrapper').children().length <= 1) return; 
                $(this).closest('.option-row').remove();
            });

            $(document).on('change', '.option-is-default', function() {
                let type = $('#setting_type').val();
                if (type === SETTING_TYPE.OPTIONS && $(this).is(':checked')) {
                    $('.option-is-default').not(this).prop('checked', false);
                }
            });

        
            $('#userSettingForm').on('submit', function() {
                let type = $('#setting_type').val();

                if (type === SETTING_TYPE.OPTIONS || type === SETTING_TYPE.OPTIONS_MULTIPLE) {
                    let options = [];
                    $('#optionRowsWrapper .option-row').each(function() {
                        options.push({
                            title: $(this).find('.option-title').val(),
                            key: $(this).find('.option-key').val(),
                            is_default: $(this).find('.option-is-default').is(':checked')
                        });
                    });
                    $('#options_json').val(JSON.stringify(options));
                } else {
                    $('#options_json').val('');
                }

                // normalize default_setting field name expected by backend
                if (type === SETTING_TYPE.ON_OFF) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'default_setting',
                        value: $('#default_setting_on_off').val()
                    }).appendTo(this);
                } else if (type === SETTING_TYPE.INPUT) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'default_setting',
                        value: $('#default_setting_input').val()
                    }).appendTo(this);
                }
            });

            // ---------- Edit ----------
            $(document).on('click', '.edit-setting-trigger', function() {
                let id = $(this).data('id');

                getDataById("{{ route('superAdmin.userSettingMaster.get') }}", id, function(res) {
                    if (!res.status) return;
                    let row = res.data;

                    $('#setting_id').val(row.id);
                    $('#setting_title').val(row.setting_title);
                    $('#setting_key').val(row.setting_key);
                    $('#module_id').val(row.module_id).trigger('change');
                    $('#in_admin_hand').prop('checked', row.in_admin_hand == 1);

                    // wait for sub-module list to load, then select
                    setTimeout(function() {
                        $('#sub_module_id').val(row.sub_module_id);
                    }, 400);

                    $('#setting_type').val(row.setting_type).trigger('change');

                    if (row.setting_type == SETTING_TYPE.ON_OFF) {
                        $('#default_setting_on_off').val(row.default_setting);
                    } else if (row.setting_type == SETTING_TYPE.INPUT) {
                        $('#default_setting_input').val(row.default_setting);
                    } else if (row.setting_type == SETTING_TYPE.OPTIONS || row.setting_type ==
                        SETTING_TYPE.OPTIONS_MULTIPLE) {
                        $('#optionRowsWrapper').html('');
                        let opts = typeof row.options === 'string' ? JSON.parse(row.options) : row
                            .options;
                        $.each(opts, function(i, opt) {
                            addOptionRow(opt.title, opt.key, !!opt.is_default);
                        });
                    }

                    $('#userSettingFormCard').removeClass('d-none');
                    $('#toggleSettingForm').html('<i class="ri-close-line"></i> Close Form');

                    $('html, body').animate({
                        scrollTop: $('#userSettingFormCard').offset().top - 20
                    }, 300);
                });
            });

        });

        function fetchUserSettings() {
            let params = {
                module_id: $('#filter_module_id').val(),
                sub_module_id: $('#filter_sub_module_id').val()
            };

            fetchMasterData("{{ route('superAdmin.userSettingMaster.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    let typeLabels = {
                        1: 'On/Off',
                        2: 'Options',
                        3: 'Options (Multi)',
                        4: 'Input'
                    };

                    $.each(res.data, function(index, row) {
                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">${index + 1}</td>
                                <td class="py-20 px-20">
                                    <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.setting_title}</h6>
                                </td>
                                <td class="py-20 px-20">
                                    <code class="text-xs">${row.setting_key}</code>
                                </td>
                                <td class="py-20 px-20 text-center">
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs">${typeLabels[row.setting_type] ?? '-'}</span>
                                </td>
                                <td class="py-20 px-20 text-center">
                                    ${row.in_admin_hand == 1
                                        ? '<i class="ri-checkbox-circle-fill text-success-600 text-lg"></i>'
                                        : '<i class="ri-close-circle-line text-neutral-300 text-lg"></i>'}
                                </td>
                                <td class="py-20 px-20 text-center">
                                    ${row.status == 1
                                        ? '<span class="badge bg-success-50 text-success-700 border border-success-100 px-8 py-4 radius-6 font-xxs">Active</span>'
                                        : '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-8 py-4 radius-6 font-xxs">Inactive</span>'}
                                </td>
                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-setting-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Edit Setting">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-setting-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Delete Setting">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                } else {
                    html = `
                        <tr>
                            <td colspan="8" class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No settings found.</span>
                            </td>
                        </tr>`;
                }

                $('#userSettingTableBody').html(html);

                var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el);
                });
            }, params);
        }
    </script>
@endpush
