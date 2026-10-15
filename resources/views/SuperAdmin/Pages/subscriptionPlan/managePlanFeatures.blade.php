@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Plan Features Provisioning Engine')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <!-- Section 01: Feature Deployment Engine Form -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card mb-32">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-12 radius-10 border border-primary-100">
                        <i class="ri-settings-5-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Provision Plan Feature</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure ecosystem functional capabilities, cross-module
                            hooks, and core accessibility matrices.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="planFeatureForm" class="ajaxForm" data-url="{{ route('superAdmin.planFeature.save') }}"
                    data-refresh="fetchPlanFeatures" data-method="POST" autocomplete="off">
                    @csrf

                    <input type="hidden" name="id" id="feature_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Feature Metadata &
                                Architectural Identity</h6>
                        </div>

                        <div class="row gy-4">
                            <!-- Feature Name -->
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Feature Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-keynote-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="name" name="name" placeholder="e.g., Advanced Automated Payroll"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Slug (Automated/Manual) -->
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        System Unique Slug <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-anchor-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="slug" name="slug" placeholder="e.g., advanced-automated-payroll"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Module Mapping -->
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Core Module Mapping
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-stack-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="module_name" name="module_name"
                                            placeholder="e.g., HRMS / Accounts / Academics">
                                    </div>
                                </div>
                            </div>

                            <!-- Initial Capability Status -->
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Initial Node Status
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-checkbox-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            name="status" id="status">
                                            <option value="1">Active / Available</option>
                                            <option value="0">Deactivated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Feature Scope Inclusions / Description -->
                            <div class="col-xl-8 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Feature Capabilities & Scope Details
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-chat-quote-line text-neutral-400 addon-icon position-absolute start-0 top-0 mt-16 ms-16"></i>
                                        <textarea class="form-control custom-premium-input ps-44 py-12 radius-8" id="description" name="description"
                                            rows="3"
                                            placeholder="Describe the comprehensive capabilities, parameters, and structural boundaries of this feature node..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <!-- Execution Controls -->
                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetFeatureForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset Engine
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                            id="btnSaveFeature">
                            <i class="ri-save-3-line"></i> Deploy Feature Node
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section 02: Active Features Ledger/Datatable -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-info-50 p-2 px-12 radius-10 border border-info-100">
                        <i class="ri-git-repository-line text-2xl text-info-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Active Provisioning Features
                            Registry</h5>
                        <p class="text-xs text-neutral-500 mb-0">Review system capabilities, unique hooks mapping, module
                            categorization, and capability ecosystem matrices.</p>
                    </div>
                </div>
         
            </div>

            <div class="card-body p-0  dataTable-wrapper">
                      <x-datatable--toolbar tableId="planFeatureTable" />
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle data-table " id="planFeatureTable" data-page-length='10'>
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Feature Context & Identity</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Module Architecture</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    System Key / Slug</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Execution Tools</th>
                            </tr>
                        </thead>
                        <tbody id="planFeatureTableBody">
                          
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            // Initializing List Data Load for Features Engine
            fetchPlanFeatures();

            // Dynamic Front-end Table Rows Filter Search
            $("#planFeatureSearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#planFeatureTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Auto-generate Slug from Feature Name organically
            $("#name").on("keyup", function() {
                let text = $(this).val();
                let slug = text.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // Remove invalid chars
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-'); // Remove duplicate hyphens
                $("#slug").val(slug);
            });
        });


        function fetchPlanFeatures() {

            fetchMasterData("{{ route('superAdmin.planFeature.fetch') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        // Fallback handling for missing values
                        let moduleMapping = row.module_name ? row.module_name : 'Unassigned Core';
                        let shortDescription = row.description ?
                            (row.description.length > 60 ? row.description.substring(0, 60) + '...' : row
                                .description) :
                            'No core capabilities description mapped.';

                        // Status Badge Generation
                        let statusBadge = row.status == 1 ?
                            `<span class="badge bg-success-100 text-success-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Active</span>` :
                            `<span class="badge bg-danger-100 text-danger-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Deactivated</span>`;

                        let blockToggleIcon = row.status == 1 ? 'ri-ban-line' : 'ri-checkbox-circle-line';
                        let blockToggleTitle = row.status == 1 ? 'Deactivate Feature Node' :
                            'Activate Feature Node';
                        let toggleBtnClass = row.status == 1 ?
                            'bg-warning-50 hover-bg-warning-100 border border-warning-200 text-warning-700' :
                            'bg-success-50 hover-bg-success-100 border border-success-200 text-success-700';

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 radius-8 bg-neutral-100 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="ri-settings-5-line text-lg text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm fw-bold mb-1 text-neutral-800">${row.name}</h6>
                                            <p class="text-xxs text-neutral-400 mb-0 max-w-300" title="${row.description || ''}">${shortDescription}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-purple-50 text-purple-700 border border-purple-100 px-8 py-4 radius-6 font-xxs d-flex align-items-center gap-1 w-fit-content">
                                        <i class="ri-stack-line"></i> ${moduleMapping}
                                    </span>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600 font-mono bg-neutral-50 px-8 py-4 border border-neutral-200 radius-4">${row.slug}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-feature-trigger" 
                                        data-id="${row.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modify Feature Context">
                                            <i class="ri-edit-line text-sm"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon ${toggleBtnClass} p-8 radius-8 transition-all status-feature-trigger"
                                                data-id="${row.id}" data-status="${row.status}" data-bs-toggle="tooltip" data-bs-placement="top" title="${blockToggleTitle}">
                                            <i class="${blockToggleIcon} text-sm"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-feature-trigger"
                                                data-id="${row.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Purge Feature Hook">
                                            <i class="ri-delete-bin-6-line text-sm"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = `
                    <tr>
                        <td colspan="5" class="py-40 text-center">
                            <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                            <span class="text-sm fw-medium text-neutral-500">No core functional features discovered in this cluster network.</span>
                        </td>
                    </tr>`;
                }

                if ($.fn.DataTable.isDataTable('#planFeatureTable')) {
                    $('#planFeatureTable').DataTable().destroy();
                }

                $("#planFeatureTableBody").html(html);

                let table = $('#planFeatureTable').DataTable({
                    pageLength: 10
                });

              

                // Refreshing Bootstrap tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el)
                });
            });
        }


        $(document).on("click", ".edit-feature-trigger", function() {
            let id = $(this).data("id");

            getDataById("{{ route('superAdmin.planFeature.get') }}", id, function(res) {
                if (!res.status) return;

                let row = res.data;
                let status = row.status == true ? 1 : 0;

                // Syncing records dynamically into form fields
                $("#feature_id").val(row.id);
                $("#name").val(row.name);
                $("#slug").val(row.slug);
                $("#module_name").val(row.module_name);
                $("#description").val(row.description);
                $("#status").val(status).change();

                // Smooth premium scroll to form view focus
                $("html, body").animate({
                    scrollTop: 0
                }, 300);
            });
        });


        $(document).on("click", ".status-feature-trigger", function() {
            let id = $(this).data("id");
            let currentStatus = $(this).data("status");
            let message = currentStatus == 1 ? "Deactivate this ecosystem feature node?" :
                "Re-activate this functional feature node?";

            if (confirm(message)) {
                // Feature availability toggle handler logic structure...
            }
        });


        $(document).on("click", ".delete-feature-trigger", function() {
            let id = $(this).data("id");
            if (confirm(
                    "Purge this functional plan feature from the matrix registry permanently? This cannot be undone."
                )) {
                // Soft deletes or permanent purge sequence pipeline execution...
            }
        });


        $("#resetFeatureForm").on("click", function() {
            $("#planFeatureForm")[0].reset();
            $("#feature_id").val("");
            $("#status").val("1").change();
        });
    </script>
@endpush
