@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Tenant Governance & Lifecycle Command')

@push('style')
    <style>
        .module-toggle-card {
            transition: all 0.25s ease-in-out;
            border: 1px solid var(--neutral-200);
        }

        .module-toggle-card:hover {
            border-color: var(--primary-300);
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.05);
        }

        .color-swatch-input {
            width: 34px;
            height: 34px;
            padding: 2px;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-switch .form-check-input {
            width: 38px;
            height: 20px;
            cursor: pointer;
        }
    </style>
@endpush

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <x-tenant-search />

        <input type="hidden" id="selected_school_id" value="">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-settings-4-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Filter Module Setting</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select module &amp; sub-module to configure settings
                            for the selected school.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <div class="form-segment mb-0">
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
                                        id="filter_sub_module_id" name="sub_module_id" required disabled>
                                        <option value="">-- Select Sub Module --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16" id="noSchoolWarning">
                        <span
                            class="badge bg-warning-50 text-warning-700 border border-warning-100 px-12 py-8 radius-8 font-xs">
                            <i class="ri-error-warning-line"></i> Pehle search karke ek school select karein.
                        </span>
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
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">School Setting Values</h5>
                        <p class="text-xs text-neutral-500 mb-0" id="selectedSchoolLabel">Configure settings for the
                            selected school.</p>
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
                                    Setting</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Type</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Current Value</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Source</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userSettingTableBody">
                            <tr>
                                <td colspan="7" class="py-40 text-center">
                                    <div class="text-neutral-400 mb-2"><i class="ri-information-line text-3xl"></i>
                                    </div>
                                    <span class="text-sm fw-medium text-neutral-500">Pehle school, module &amp;
                                        sub-module select karein.</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Configure Setting Modal --}}
    <div class="modal fade" id="configureSettingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16">
                <div class="modal-header border-bottom">
                    <div>
                        <h6 class="mb-2 fw-bold" id="configureSettingTitle">Configure Setting</h6>
                        <p class="text-xs text-neutral-500 mb-0" id="configureSettingKey"></p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-24">
                    <input type="hidden" id="cfg_setting_id">
                    <div id="configureSettingBody">
                        {{-- dynamic input injected here --}}
                    </div>
                    <div class="mt-16">
                        <span class="badge bg-neutral-100 text-neutral-600 font-xxs px-8 py-4 radius-6"
                            id="configureSettingSource"></span>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button"
                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-20 py-10 radius-8"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveConfigureSetting"
                        class="btn btn-primary bg-primary-600 text-white px-20 py-10 radius-8">
                        <i class="ri-save-3-line"></i> Save for this School
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        const SETTING_TYPE = {
            ON_OFF: 1,
            OPTIONS: 2,
            OPTIONS_MULTIPLE: 3,
            INPUT: 4
        };

        let CURRENT_SETTINGS_CACHE = {};

        $(document).ready(function() {

            fetchModulesDropdown();
            toggleNoSchoolWarning();

            // ---------- Module -> Sub-Module dependent dropdown ----------
            $('#filter_module_id').on('change', function() {
                let moduleId = $(this).val();
                if (!moduleId) {
                    $('#filter_sub_module_id').html('<option value="">All Sub Modules</option>').prop(
                        'disabled', true);
                } else {
                    loadSubModules(moduleId, '#filter_sub_module_id');
                }
                resetTable();
            });

            $('#filter_sub_module_id').on('change', fetchUserSettings);

            function loadSubModules(moduleId, targetSelector) {
                let $target = $(targetSelector);

                $target.prop('disabled', true).html('<option value="">Loading...</option>');

                $.get("{{ route('superAdmin.subModuleMaster.byModule') }}", {
                    module_id: moduleId
                }, function(res) {
                    let html = '<option value="">-- Select Sub Module --</option>';
                    if (res.status && res.data.length > 0) {
                        $.each(res.data, function(i, row) {
                            html += `<option value="${row.id}">${row.sub_module_name}</option>`;
                        });
                    }
                    $target.html(html).prop('disabled', false);
                });
            }

            function toggleNoSchoolWarning() {
                let schoolId = $('#selected_school_id').val();
                $('#noSchoolWarning').toggleClass('d-none', !!schoolId);
            }

            function resetTable(message) {
                message = message || 'Pehle school, module & sub-module select karein.';
                $('#userSettingTableBody').html(`
                    <tr>
                        <td colspan="7" class="py-40 text-center">
                            <div class="text-neutral-400 mb-2"><i class="ri-information-line text-3xl"></i></div>
                            <span class="text-sm fw-medium text-neutral-500">${message}</span>
                        </td>
                    </tr>`);
            }

            function fetchUserSettings() {
                let schoolId = $('#selected_school_id').val();
                let moduleId = $('#filter_module_id').val();
                let subModuleId = $('#filter_sub_module_id').val();

                if (!schoolId) {
                    resetTable('Pehle search karke ek school select karein.');
                    return;
                }
                if (!moduleId || !subModuleId) {
                    resetTable('Module & sub-module select karein.');
                    return;
                }

                $.get("{{ route('superAdmin.userSettingValue.fetchWithSchool') }}", {
                    school_id: schoolId,
                    module_id: moduleId,
                    sub_module_id: subModuleId
                }, function(res) {
                    CURRENT_SETTINGS_CACHE = {};
                    let html = '';

                    if (res.status && res.data.length > 0) {
                        let typeLabels = {
                            1: 'On/Off',
                            2: 'Options',
                            3: 'Options (Multi)',
                            4: 'Input'
                        };

                        $.each(res.data, function(index, row) {
                            CURRENT_SETTINGS_CACHE[row.id] = row;

                            let displayValue = formatDisplayValue(row);

                            html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">${index + 1}</td>
                                <td class="py-20 px-20">
                                    <h6 class="text-sm fw-bold mb-2 text-neutral-800">${row.setting_title}</h6>
                                    <code class="text-xs">${row.setting_key}</code>
                                </td>
                                <td class="py-20 px-20 text-center">
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs">${typeLabels[row.setting_type] ?? '-'}</span>
                                </td>
                                <td class="py-20 px-20">
                                    <span class="text-sm fw-semibold text-neutral-800">${displayValue}</span>
                                </td>
                                <td class="py-20 px-20 text-center">
                                    ${row.is_overridden
                                        ? '<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-8 py-4 radius-6 font-xxs">Custom</span>'
                                        : '<span class="badge bg-neutral-100 text-neutral-600 border border-neutral-200 px-8 py-4 radius-6 font-xxs">Default</span>'}
                                </td>
                                <td class="py-20 px-20 text-center">
                                    ${row.status == 1
                                        ? '<span class="badge bg-success-50 text-success-700 border border-success-100 px-8 py-4 radius-6 font-xxs">Active</span>'
                                        : '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-8 py-4 radius-6 font-xxs">Inactive</span>'}
                                </td>
                                <td class="py-20 px-28 text-end">
                                    <button type="button" class="btn btn-icon bg-primary-50 hover-bg-primary-100 border border-primary-200 text-primary-700 p-6 px-10 radius-8 transition-all configure-setting-trigger"
                                        data-id="${row.id}" data-bs-toggle="tooltip" title="Configure for this school">
                                        <i class="ri-tools-line text-lg"></i>
                                    </button>
                                </td>
                            </tr>`;
                        });
                    } else {
                        resetTable('No settings found for this module & sub-module.');
                        return;
                    }

                    $('#userSettingTableBody').html(html);

                    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.map(function(el) {
                        return new bootstrap.Tooltip(el);
                    });
                });
            }

            function parseOptions(options) {
                if (!options) return [];
                return typeof options === 'string' ? JSON.parse(options) : options;
            }

            function formatDisplayValue(row) {
                let type = parseInt(row.setting_type);

                if (type === SETTING_TYPE.ON_OFF) {
                    return row.resolved_value == '1' ? 'On' : 'Off';
                }

                if (type === SETTING_TYPE.INPUT) {
                    return row.resolved_value ?? '-';
                }

                let opts = parseOptions(row.options);

                if (type === SETTING_TYPE.OPTIONS) {
                    let match = opts.find(o => o.key === row.resolved_value);
                    return match ? match.title : (row.resolved_value ?? '-');
                }

                if (type === SETTING_TYPE.OPTIONS_MULTIPLE) {
                    let selectedKeys = [];
                    try {
                        selectedKeys = JSON.parse(row.resolved_value || '[]');
                    } catch (e) {
                        selectedKeys = [];
                    }
                    let titles = opts.filter(o => selectedKeys.includes(o.key)).map(o => o.title);
                    return titles.length ? titles.join(', ') : '-';
                }

                return row.resolved_value ?? '-';
            }

            // ---------- Configure modal ----------
            $(document).on('click', '.configure-setting-trigger', function() {
                let id = $(this).data('id');
                let row = CURRENT_SETTINGS_CACHE[id];
                if (!row) return;
                openConfigureModal(row);
            });

            function openConfigureModal(row) {
                $('#cfg_setting_id').val(row.id);
                $('#configureSettingTitle').text(row.setting_title);
                $('#configureSettingKey').text(row.setting_key);
                $('#configureSettingSource').text(row.is_overridden ?
                    'Currently: Custom value set for this school' :
                    'Currently: Using default value');

                let type = parseInt(row.setting_type);
                let body = '';

                if (type === SETTING_TYPE.ON_OFF) {
                    let checked = row.resolved_value == '1' ? 'checked' : '';
                    body = `
                        <label class="switch">
                            <input type="checkbox" id="cfg_value_onoff" class="module-active-toggle" ${checked}>
                            <span class="slider"></span>
                        </label>
                        <span class="text-sm fw-semibold ms-8">Enable this setting</span>`;
                } else if (type === SETTING_TYPE.INPUT) {
                    body =
                        `
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Value</label>
                        <input type="text" class="form-control custom-premium-input py-12 radius-8" id="cfg_value_input" value="${row.resolved_value ?? ''}">`;
                } else if (type === SETTING_TYPE.OPTIONS) {
                    let opts = parseOptions(row.options);
                    body =
                        `<label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Select Option</label>
                        <select class="form-select custom-premium-input py-12 radius-8" id="cfg_value_select">`;
                    $.each(opts, function(i, opt) {
                        let sel = opt.key === row.resolved_value ? 'selected' : '';
                        body += `<option value="${opt.key}" ${sel}>${opt.title}</option>`;
                    });
                    body += `</select>`;
                } else if (type === SETTING_TYPE.OPTIONS_MULTIPLE) {
                    let opts = parseOptions(row.options);
                    let selectedKeys = [];
                    try {
                        selectedKeys = JSON.parse(row.resolved_value || '[]');
                    } catch (e) {
                        selectedKeys = [];
                    }

                    body =
                        `<label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-12 d-block">Select Options</label>
                        <div class="d-flex flex-column gap-2">`;
                    $.each(opts, function(i, opt) {
                        let checked = selectedKeys.includes(opt.key) ? 'checked' : '';
                        body += `
                            <div class="form-check">
                                <input class="form-check-input cfg-value-multi" type="checkbox" value="${opt.key}" id="cfg_multi_${i}" ${checked}>
                                <label class="form-check-label text-sm" for="cfg_multi_${i}">${opt.title}</label>
                            </div>`;
                    });
                    body += `</div>`;
                }

                $('#configureSettingBody').html(body);
                $('#configureSettingModal').data('setting-type', type);
                $('#configureSettingModal').modal('show');
            }

            $('#saveConfigureSetting').on('click', function() {
                let id = $('#cfg_setting_id').val();
                let type = $('#configureSettingModal').data('setting-type');
                let schoolId = $('#selected_school_id').val();
                let value;

                if (type === SETTING_TYPE.ON_OFF) {
                    value = $('#cfg_value_onoff').is(':checked') ? '1' : '0';
                } else if (type === SETTING_TYPE.INPUT) {
                    value = $('#cfg_value_input').val();
                } else if (type === SETTING_TYPE.OPTIONS) {
                    value = $('#cfg_value_select').val();
                } else if (type === SETTING_TYPE.OPTIONS_MULTIPLE) {
                    value = [];
                    $('.cfg-value-multi:checked').each(function() {
                        value.push($(this).val());
                    });
                }

                let $btn = $(this);
                $btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('superAdmin.userSettingValue.save') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_setting_master_id: id,
                        school_id: schoolId,
                        value: value
                    },
                    success: function(res) {
                        $btn.prop('disabled', false);
                        if (res.status) {
                            $('#configureSettingModal').modal('hide');
                            fetchUserSettings();
                        } else {
                            alert(res.message ?? 'Something went wrong');
                        }
                    },
                    error: function() {
                        $btn.prop('disabled', false);
                        alert('Save failed, please try again.');
                    }
                });
            });

            // ---------- exposed globally for tenant-search component ----------
            window.onTenantSelected = function(schoolId, schoolName) {
                $('#selected_school_id').val(schoolId);
                toggleNoSchoolWarning();

                if (schoolName) {
                    $('#selectedSchoolLabel').text('Configuring settings for: ' + schoolName);
                }

                fetchUserSettings();
            };
        });

        function fetchModulesDropdown() {
            $.get("{{ route('superAdmin.moduleMaster.fetch') }}", function(res) {
                if (!res.status) return;
                let filterHtml = '<option value="">-- Select Module --</option>';
                $.each(res.data, function(i, row) {
                    filterHtml += `<option value="${row.id}">${row.module_name}</option>`;
                });
                $('#filter_module_id').html(filterHtml);
            });
        }
    </script>
@endpush
