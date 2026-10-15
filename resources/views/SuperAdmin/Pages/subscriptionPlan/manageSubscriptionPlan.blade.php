@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Subscription Plan Provisioning Engine')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card mb-32">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-12 radius-10 border border-primary-100">
                        <i class="ri-refund-2-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Provision Subscription Plan</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure enterprise pricing tiers, core threshold limits,
                            and multi-tenancy access matrix.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="subscriptionPlanForm" class="ajaxForm" data-url="{{ route('superAdmin.subscriptionPlan.save') }}" data-refresh="fetchSubscriptionPlans"
                    data-method="POST" autocomplete="off">
                    @csrf

                    <input type="hidden" name="id" id="plan_id" value="">

            

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Plan Metadata & Core
                                Identity</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Plan Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-medal-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="name" name="name" placeholder="e.g., Enterprise Premium Tier"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Unique Plan Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-code-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="code" name="code" placeholder="e.g., KTR-ENT-PRM" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Plan Architecture Type
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-git-merge-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            name="is_custom" id="is_custom">
                                            <option value="0">Standard Global Plan</option>
                                            <option value="1">Custom Tailored Variant</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Plan Features Description
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-chat-quote-line text-neutral-400 addon-icon position-absolute start-0 top-0 mt-16 ms-16"></i>
                                        <textarea class="form-control custom-premium-input ps-44 py-12 radius-8" id="description" name="description"
                                            rows="2" placeholder="Describe the inclusions and parameters of this operational pricing matrix..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Multi-Cycle Price
                                Matrix (INR)</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Monthly
                                        Price</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-money-dollar-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" step="0.01"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="monthly_price" name="monthly_price" value="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Quarterly
                                        Price</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-money-dollar-box-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" step="0.01"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="quarterly_price" name="quarterly_price" value="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Half-Yearly
                                        Price</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-bank-card-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" step="0.01"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="half_yearly_price" name="half_yearly_price" value="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Yearly
                                        Price</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-copper-coin-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" step="0.01"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="yearly_price" name="yearly_price" value="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-32">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span class="badge bg-purple-100 text-purple-700 font-xs fw-bold px-12 py-6 radius-6">03</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Node Constraints &
                                Sorting Matrix</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Trial
                                        Window (Days)</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-time-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8" id="trial_days"
                                            name="trial_days" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Max
                                        Student Cap</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-user-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="max_students" name="max_students" placeholder="∞ Unlimited">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Max
                                        Internal Users</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-team-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8" id="max_users"
                                            name="max_users" placeholder="∞ Unlimited">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Max
                                        Branches</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-git-branch-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="max_branches" name="max_branches" placeholder="∞ Unlimited">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Order
                                        Weightage</label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-sort-asc text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8" id="sort_order"
                                            name="sort_order" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Initial
                                        Node Status</label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-checkbox-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Blocked</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetPlanForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset Engine
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                            id="btnSavePlan">
                            <i class="ri-save-3-line"></i> Deploy Plan Matrix
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-info-50 p-2 px-12 radius-10 border border-info-100">
                        <i class="ri-git-repository-line text-2xl text-info-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Active Provisioning Plans</h5>
                        <p class="text-xs text-neutral-500 mb-0">Review global tier hierarchies, node limits, matrix
                            pricing architecture, and ecosystem parameters.</p>
                    </div>
                </div>
                <div class="position-relative" style="min-width: 260px;">
                    <i
                        class="ri-search-line position-absolute start-0 top-50 translate-middle-y ms-16 text-neutral-400"></i>
                    <input type="text" id="subscriptionPlanSearch" class="form-control radius-8 ps-40 py-8 text-sm"
                        placeholder="Search parameters...">
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">Plan
                                    Hierarchy & Code</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Matrix Pricing Tier</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">Node
                                    Parameters & Caps</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Execution Tools</th>
                            </tr>
                        </thead>
                        <tbody id="subscriptionPlanTableBody">
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

            // Initializing List Data Load
            fetchSubscriptionPlans();

            // Dynamic Front-end Table Rows Filter Search
            $("#subscriptionPlanSearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#subscriptionPlanTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        /*
        |--------------------------------------------------------------------------
        | FETCH SUBSCRIPTION PLANS DATA PIPELINE
        |--------------------------------------------------------------------------
        */
        function fetchSubscriptionPlans() {
            
            fetchMasterData("{{ route('superAdmin.subscriptionPlan.fetch') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        // Formatting price structures safely
                        let monthly = parseFloat(row.monthly_price || 0).toFixed(2);
                        let quarterly = parseFloat(row.quarterly_price || 0).toFixed(2);
                        let halfYearly = parseFloat(row.half_yearly_price || 0).toFixed(2);
                        let yearly = parseFloat(row.yearly_price || 0).toFixed(2);

                        // Checks and labels parameters
                        let customBadge = row.is_custom == 1 ?
                            `<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-8 py-2 radius-4 font-xxs">Custom</span>` :
                            '';

                        let trialLabel = row.trial_days > 0 ?
                            `<span class="text-xxs text-success-600 fw-semibold"><i class="ri-time-line"></i> ${row.trial_days} Days Free Trial</span>` :
                            '';

                        let statusBadge = row.status == 1 ?
                            `<span class="badge bg-success-100 text-success-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Active</span>` :
                            `<span class="badge bg-danger-100 text-danger-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Blocked</span>`;

                        let blockToggleIcon = row.status == 1 ? 'ri-ban-line' : 'ri-checkbox-circle-line';
                        let blockToggleTitle = row.status == 1 ? 'Restrict/Block Tier' :
                            'Activate/Unblock Tier';
                        let toggleBtnClass = row.status == 1 ?
                            'bg-warning-50 hover-bg-warning-100 border border-warning-200 text-warning-700' :
                            'bg-success-50 hover-bg-success-100 border border-success-200 text-success-700';

                        html += `
                        <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                            <td class="py-20 px-28">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="p-2 radius-8 bg-neutral-100 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="ri-medal-line text-lg ${row.is_custom == 1 ? 'text-warning-600' : 'text-primary-600'}"></i>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.name}</h6>
                                            ${customBadge}
                                        </div>
                                        <span class="text-xs text-neutral-400 font-mono">${row.code}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="py-20 px-20">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-xs text-neutral-700 fw-medium">
                                        <strong class="text-neutral-900">₹${monthly}</strong> /Mo
                                    </span>
                                    <span class="text-xxs text-neutral-500">
                                        Qtr: ₹${quarterly} | Mid: ₹${halfYearly} | Yr: ₹${yearly}
                                    </span>
                                    ${trialLabel}
                                </div>
                            </td>

                            <td class="py-20 px-20">
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-primary-50 text-primary-700 border border-primary-100 px-8 py-4 radius-6 font-xxs d-flex align-items-center gap-1">
                                        <i class="ri-user-2-line"></i> Students: ${row.max_students ?? '∞'}
                                    </span>
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs d-flex align-items-center gap-1">
                                        <i class="ri-team-line"></i> Users: ${row.max_users ?? '∞'}
                                    </span>
                                    <span class="badge bg-purple-50 text-purple-700 border border-purple-100 px-8 py-4 radius-6 font-xxs d-flex align-items-center gap-1">
                                        <i class="ri-git-branch-line"></i> Branches: ${row.max_branches ?? '∞'}
                                    </span>
                                </div>
                            </td>

                            <td class="py-20 px-20 text-center">
                                ${statusBadge}
                            </td>

                            <td class="py-20 px-28 text-end">
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    
                                    <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-plan-trigger" 
                                       data-id="${row.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modify Matrix Config">
                                        <i class="ri-edit-line text-sm"></i>
                                    </button>

                                    <button type="button" class="btn btn-icon ${toggleBtnClass ?? `bg-warning-50 hover-bg-warning-100 border border-warning-200 text-warning-700`} p-8  radius-8 transition-all status-plan-trigger"
                                            data-id="${row.id}" data-status="${row.status}" data-bs-toggle="tooltip" data-bs-placement="top" title="${blockToggleTitle}">
                                        <i class="${blockToggleIcon} text-sm"></i>
                                    </button>

                                    <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-plan-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Purge Node Matrix">
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
                            <span class="text-sm fw-medium text-neutral-500">No active operational plan matrix models discovered in this cluster environment.</span>
                        </td>
                    </tr>`;
                }

                $("#subscriptionPlanTableBody").html(html);

                // Refreshing Bootstrap tooltips on newly generated dynamic data elements
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el)
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | RETRIEVE PLAN PARAMETERS BY ID FOR EDIT MODE
        |--------------------------------------------------------------------------
        */
        $(document).on("click", ".edit-plan-trigger", function() {
            let id = $(this).data("id");

            getDataById("{{ route('superAdmin.subscriptionPlan.get') }}", id, function(res) {
                if (!res.status) return;

                let row = res.data;

                let status = row.status == true ? 1 : 0;
                let is_custom = row.is_custom == true ? 1 : 0;

                // Syncing records values inside form elements
                $("#plan_id").val(row.id);
                $("#name").val(row.name);
                $("#code").val(row.code);
                $("#is_custom").val(is_custom).change();
                $("#description").val(row.description);
                $("#monthly_price").val(row.monthly_price);
                $("#quarterly_price").val(row.quarterly_price);
                $("#half_yearly_price").val(row.half_yearly_price);
                $("#yearly_price").val(row.yearly_price);
                $("#trial_days").val(row.trial_days);
                $("#max_students").val(row.max_students || "");
                $("#max_users").val(row.max_users || "");
                $("#max_branches").val(row.max_branches || "");
                $("#sort_order").val(row.sort_order);
                $("#status").val(status).change();

                // Premium scroll to top animation frame focus
                $("html, body").animate({
                    scrollTop: 0
                }, 300);
            });
        });

        /*
        |--------------------------------------------------------------------------
        | STATUS TOGGLE ACTION PIPELINE
        |--------------------------------------------------------------------------
        */
        $(document).on("click", ".status-plan-trigger", function() {
            let id = $(this).data("id");
            let currentStatus = $(this).data("status");
            let message = currentStatus == 1 ? "Block this subscription tier?" :
                "Re-activate this subscription tier?";

            if (confirm(message)) {
                // Aapka dynamic toggle logic block (is-active/blocked update api link trace)
                // Ajax integration method execution goes here...
            }
        });

        /*
        |--------------------------------------------------------------------------
        | PURGE / DELETE DATA ACCESS PIPELINE
        |--------------------------------------------------------------------------
        */
        $(document).on("click", ".delete-plan-trigger", function() {
            let id = $(this).data("id");
            if (confirm("Purge this subscription plan structure permanently? This change cannot be reverted.")) {
                // Aapka dynamic deletion node function trace execution yaha add karein...
            }
        });

        /*
        |--------------------------------------------------------------------------
        | ENGINE FORM AND FIELDS RESET FUNCTION
        |--------------------------------------------------------------------------
        */
        $("#resetPlanForm").on("click", function() {
            $("#subscriptionPlanForm")[0].reset();
            $("#plan_id").val("");
            $("#is_custom").val("0").change();
            $("#status").val("1").change();
        });
    </script>
@endpush
