@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Sub Module Governance & Lifecycle Command')

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

        .sub-module-group-header {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--neutral-500);
            padding: 8px 4px;
            margin-top: 8px;
            border-bottom: 1px dashed var(--neutral-200);
        }
    </style>
@endpush

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <x-tenant-search />

        <input type="hidden" id="selected_school_id" value="">

        <form id="subModuleGovernanceForm" class="ajaxForm mt-32"
            data-url="{{ route('superAdmin.subModuleMasterMapping.save') }}" data-method="POST">
            @csrf
            <input type="hidden" name="school_id" id="form_school_id" value="">

            <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card d-none"
                id="subModuleGovernanceContainer">

                <div
                    class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="brand-pulse-container bg-purple-50 p-2 px-12 radius-10 border border-purple-100">
                            <i class="ri-stack-line text-2xl text-purple-600"></i>
                        </div>
                        <div>
                            <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Sub Module Governance
                                Matrix</h5>
                            <p class="text-xs text-neutral-500 mb-0">Selected tenant ke liye sub module access, report
                                visibility aur branding colors control karein.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">

                        <button type="button" id="activateAllSubModules"
                            class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                            <i class="ri-check-double-line text-success"></i>
                            Grant All
                        </button>

                        <button type="button" id="deactivateAllSubModules"
                            class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                            <i class="ri-forbid-line text-danger"></i>
                            Revoke All
                        </button>

                    </div>
                </div>

                <div class="card-body p-28 bg-neutral-50/50">
                    <div id="subModuleGridContainer">
                    </div>
                </div>

                <div class="card-footer border-top bg-base py-20 px-28 d-flex justify-content-end align-items-center gap-3">
                    <button type="submit"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-32 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                        id="btnSaveSubModuleMapping">
                        <i class="ri-shield-flash-line"></i> Synchronize Tenant Sub Modules
                    </button>
                </div>
            </div>

            <div class="text-center py-40 d-none" id="subModuleNoTenantState">
                <div class="text-neutral-400 mb-2"><i class="ri-building-4-line text-3xl"></i></div>
                <span class="text-sm fw-medium text-neutral-500">Kripya upar se ek tenant select karein sub module
                    matrix dekhne ke liye.</span>
            </div>
        </form>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $("#activateAllSubModules").on("click", function() {
                $(".sub-module-active-toggle").prop("checked", true);
            });
            $("#deactivateAllSubModules").on("click", function() {
                $(".sub-module-active-toggle").prop("checked", false);
            });
        });

        function onTenantSelected(schoolId) {
            $("#form_school_id").val(schoolId);
            $("#subModuleNoTenantState").addClass("d-none");
            $("#subModuleGovernanceContainer").removeClass("d-none");

            let shimmerHtml = '';
            for (let i = 0; i < 6; i++) {
                shimmerHtml += `
                    <div class="col-xl-4 col-md-6 d-inline-block px-2" style="width: 32%;">
                        <div class="p-20 radius-12 bg-base border border-neutral-200 shadow-sm mb-16" style="opacity: 0.6;">
                            <div class="bg-neutral-200 radius-4 placeholder mb-8 w-50 animate-pulse" style="height: 14px;"></div>
                            <div class="bg-neutral-200 radius-4 placeholder w-100 animate-pulse" style="height: 24px;"></div>
                        </div>
                    </div>`;
            }
            $("#subModuleGridContainer").html(`<div class="row g-4">${shimmerHtml}</div>`);

            $.ajax({
                url: "{{ route('superAdmin.subModuleMasterMapping.subModuleMapping') }}",
                method: "GET",
                data: {
                    id: schoolId
                },
                dataType: "json",
                success: function(res) {
                    if (res.status) {
                        renderSubModuleGrid(res.allSubModules, res.connectedSubModulesIds);
                    } else {
                        renderSubModuleEmptyState("Failed to fetch tenant sub module governance data.");
                    }
                },
                error: function() {
                    renderSubModuleEmptyState("Network orchestration break detected. Connection timed out.");
                }
            });
        }

        function renderSubModuleGrid(allSubModules, connectedSubModulesIds) {

        

            if (!allSubModules || allSubModules.length === 0) {
                renderSubModuleEmptyState("No sub modules found.");
                return;
            }

            // Group sub modules by parent module name for readability
            let grouped = {};

            $.each(allSubModules, function(index, sm) {
                let groupName = (sm.module && sm.module.module_name) ? sm.module.module_name : 'Unassigned';
                if (!grouped[groupName]) grouped[groupName] = [];
                grouped[groupName].push(sm);
            });

            let html = '';

            $.each(grouped, function(groupName, subModules) {

                html += `<div class="sub-module-group-header">${groupName}</div>`;
                html += `<div class="row g-4 mb-8">`;

                let selectedIds = connectedSubModulesIds || [];

                $.each(subModules, function(index, sm) {

                    let isChecked = selectedIds.includes(sm.id) ? 'checked' : '';


                    html += `
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="p-16 radius-12 bg-base module-toggle-card shadow-sm">

                                <div class="d-flex justify-content-between align-items-center mb-12">

                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light radius-10 d-flex align-items-center justify-content-center"
                                            style="width:40px;height:40px;">
                                            ${sm.sub_module_icon
                                                ? `<i class="${sm.sub_module_icon} fs-5 text-primary"></i>`
                                                : `<i class="ri-apps-2-line fs-5 text-primary"></i>`}
                                        </div>
                                        <h6 class="mb-0 text-neutral-800">${sm.sub_module_name}</h6>
                                    </div>

                                      <div class="form-check form-switch p-0 m-0">
                                   
                                        <label class="switch">
                                            <input type="checkbox"    id="sub_module_active_${sm.id}"
                                            name="submodules[]"
                                            value="${sm.id}" ${isChecked} class="sub-module-active-toggle" >
                                            <span class="slider"></span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>`;
                });

                html += `</div>`;
            });

            $("#subModuleGridContainer").html(html);
        }

        function renderSubModuleEmptyState(message) {
            let html = `
            <div class="col-12 py-40 text-center">
                <div class="text-danger-400 mb-2"><i class="ri-error-warning-line text-3xl"></i></div>
                <span class="text-sm fw-medium text-danger-500">${message}</span>
            </div>`;
            $("#subModuleGridContainer").html(html);
        }
    </script>
@endpush
