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

        <form id="moduleGovernanceForm" class="ajaxForm mt-32" data-url="{{ route('superAdmin.moduleMasterMapping.save') }}"
            data-method="POST">
            @csrf
            <input type="hidden" name="school_id" id="form_school_id" value="">

            <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card d-none"
                id="moduleGovernanceContainer">

                <div
                    class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="brand-pulse-container bg-purple-50 p-2 px-12 radius-10 border border-purple-100">
                            <i class="ri-apps-2-line text-2xl text-purple-600"></i>
                        </div>
                        <div>
                            <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Module Governance Matrix</h5>
                            <p class="text-xs text-neutral-500 mb-0">Selected tenant ke liye module access, status aur
                                branding colors control karein.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">

                        <button type="button" id="activateAllModules"
                            class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                            <i class="ri-check-double-line text-success"></i>
                            Grant All
                        </button>

                        <button type="button" id="deactivateAllModules"
                            class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                            <i class="ri-forbid-line text-danger"></i>
                            Revoke All
                        </button>

                    </div>
                </div>

                <div class="card-body p-28 bg-neutral-50/50">
                    <div class="row g-4" id="moduleGridContainer">
                    </div>
                </div>

                <div class="card-footer border-top bg-base py-20 px-28 d-flex justify-content-end align-items-center gap-3">
                    <button type="submit"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-32 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                        id="btnSaveModuleMapping">
                        <i class="ri-shield-flash-line"></i> Synchronize Tenant Modules
                    </button>
                </div>
            </div>

            <div class="text-center py-40 d-none" id="moduleNoTenantState">
                <div class="text-neutral-400 mb-2"><i class="ri-building-4-line text-3xl"></i></div>
                <span class="text-sm fw-medium text-neutral-500">Kripya upar se ek tenant select karein module matrix
                    dekhne ke liye.</span>
            </div>
        </form>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $("#activateAllModules").on("click", function() {
                $(".module-active-toggle").prop("checked", true);
            });
            $("#deactivateAllModules").on("click", function() {
                $(".module-active-toggle").prop("checked", false);
            });
        });

        function onTenantSelected(schoolId) {
            $("#form_school_id").val(schoolId);
            $("#moduleNoTenantState").addClass("d-none");
            $("#moduleGovernanceContainer").removeClass("d-none");

            let shimmerHtml = '';
            for (let i = 0; i < 6; i++) {
                shimmerHtml += `
                    <div class="col-xl-4 col-md-6">
                        <div class="p-20 radius-12 bg-base border border-neutral-200 shadow-sm" style="opacity: 0.6;">
                            <div class="bg-neutral-200 radius-4 placeholder mb-8 w-50 animate-pulse" style="height: 14px;"></div>
                            <div class="bg-neutral-200 radius-4 placeholder w-100 animate-pulse" style="height: 24px;"></div>
                        </div>
                    </div>`;
            }
            $("#moduleGridContainer").html(shimmerHtml);

            $.ajax({
                url: "{{ route('superAdmin.moduleMasterMapping.getModuleMapping') }}",
                method: "GET",
                data: {
                    id: schoolId
                },
                dataType: "json",
                success: function(res) {
                    if (res.status) {
                        renderModuleGrid(res.allModules, res.schoolModuleSettings);
                    } else {
                        renderModuleEmptyState("Failed to fetch tenant module governance data.");
                    }
                },
                error: function() {
                    renderModuleEmptyState("Network orchestration break detected. Connection timed out.");
                }
            });
        }



        function renderModuleGrid(allModules, connectedModulesIds) {

            let html = '';

            if (allModules && allModules.length > 0) {

                let selectedIds = connectedModulesIds || [];

                $.each(allModules, function(index, module) {

                    let isChecked = selectedIds.includes(module.id) ? 'checked' : '';

                    html += `
                        <div class="col-xl-4 col-md-6 col-12">
                            <label class="w-100 h-100 cursor-pointer m-0" for="module_chk_${module.id}">

                                <div class="p-16 radius-12 bg-base module-toggle-card shadow-sm d-flex justify-content-between align-items-center border-gray-300">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="bg-light radius-10 d-flex align-items-center justify-content-center"
                                            style="width:48px;height:48px;">
                                          ${module.module_icon ? `<i class="${module.module_icon} fs-5 text-primary"></i>` : `<i class="ri-apps-2-line fs-5 text-primary"></i>`}
                                        </div>

                                        <div>
                                            <h6 class="mb-1 text-neutral-800">
                                                ${module.module_name}
                                            </h6>
                                        </div>
                                    </div>
                                      <div class="form-check form-switch p-0 m-0">
                                   
                                        <label class="switch">
                                            <input type="checkbox"   id="module_chk_${module.id}"
                                            name="modules[]"
                                            value="${module.id}" ${isChecked} class="module-active-toggle" >
                                            <span class="slider"></span>
                                        </label>
                                    </div>

                                </div>

                            </label>
                        </div>`;
                });

            } else {
                html = `
                    <div class="col-12 text-center py-5">
                        <i class="ri-apps-line fs-1 text-muted"></i>
                        <h6 class="mt-3">No Modules Found</h6>
                    </div>`;
            }
            $("#moduleGridContainer").html(html);
        }

        function renderModuleEmptyState(message) {
            let html = `
            <div class="col-12 py-40 text-center">
                <div class="text-danger-400 mb-2"><i class="ri-error-warning-line text-3xl"></i></div>
                <span class="text-sm fw-medium text-danger-500">${message}</span>
            </div>`;
            $("#moduleGridContainer").html(html);
        }
    </script>
@endpush
