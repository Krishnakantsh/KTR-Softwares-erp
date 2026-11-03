@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Tenant Governance & Lifecycle Command')

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <x-tenant-search />

        <div id="tenantManagementWorkspace" class="d-block animate__animated animate__fadeIn mt-24">

            <div class="shadow-2 radius-16 bg-base border border-neutral-200 p-24 mb-24 d-none"
                id="currentActiveLeaseWrapper">
                <div class="d-flex align-items-center justify-content-between mb-16 border-bottom pb-12">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-emerald-50 text-emerald-600 p-10 radius-10 border border-emerald-100 animate-pulse">
                            <i class="ri-pulse-line text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-md fw-bold text-neutral-900 mb-2">Live Tenant Lease Framework Matrix</h5>
                            <p class="text-xs text-neutral-500 mb-0">Currently operational infrastructure node parameters
                                parsed inside system kernel mappings.</p>
                        </div>
                    </div>
                    <span class="badge uppercase font-monospace text-2xs px-12 py-6 radius-6"
                        id="live_status_badge">ACTIVE</span>
                </div>

                <div class="row gy-3">
                    <div class="col-xl-3 col-sm-6 border-end text-center">
                        <span class="text-2xs text-neutral-500 d-block uppercase tracking-wider mb-4">Current Active
                            Plan</span>
                        <span class="text-base fw-bold  text-black" id="live_plan_name">-</span>
                    </div>
                    <div class="col-xl-3 col-sm-6 border-end text-center">
                        <span class="text-2xs text-neutral-500 d-block uppercase tracking-wider mb-4">Billing
                            Configuration</span>
                        <span class="text-base fw-bold text-black" id="live_billing_cycle">-</span>
                    </div>
                    <div class="col-xl-3 col-sm-6 border-end text-center">
                        <span class="text-2xs text-neutral-500 d-block uppercase tracking-wider mb-4">Final Capital
                            Injected</span>
                        <span class="text-base fw-bold text-black" id="live_final_amount">₹0.00</span>
                    </div>
                    <div class="col-xl-3 col-sm-6 text-center">
                        <span class="text-2xs text-neutral-500 d-block uppercase tracking-wider mb-4">Node Absolute
                            Expiry</span>
                        <span class="text-base fw-bold text-black" id="live_end_date">-</span>
                    </div>
                </div>
            </div>

            <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-24 custom-premium-card">
                <div
                    class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                    <div class="d-flex align-items-center gap-3">
                        <div class="brand-pulse-container bg-primary-50 p-2 radius-10 border border-primary-100">
                            <i class="ri-git-commit-line text-2xl text-primary-600"></i>
                        </div>
                        <div>
                            <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Lease Lifecycle Command
                                Terminal</h5>
                            <p class="text-xs text-neutral-500 mb-0">Modify, extend, upgrade, or safely adjust node
                                capabilities parameters dynamically down the infrastructure layers.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-28">
                    <form id="leaseModificationForm" class="ajaxForm"
                        data-url="{{ route('superAdmin.tenant.processLeaseChange') }}" data-method="POST"
                        autocomplete="off">
                        @csrf
                        <input type="hidden" name="tenant_id" id="school_master_id">

                        <div class="form-segment mb-28">
                            <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                                <span
                                    class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                                <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Target Pipeline
                                    State Mappings</h6>
                            </div>

                            <div class="row gy-4">
                                <div class="col-xl-4 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                            Choose System Target Plan <span class="text-danger">*</span>
                                        </label>
                                        <div class="inner-addon position-relative">
                                            <i class="ri-vip-diamond-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                                style="z-index: 5;"></i>
                                            <select
                                                class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                                name="subscription_plan_id" id="showAllPlans" required disabled>
                                                <option value="">-- Search & Select Tenant First --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                            Billing Cycle Strategy <span class="text-danger">*</span>
                                        </label>
                                        <div class="inner-addon position-relative">
                                            <i class="ri-repeat-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                                style="z-index: 5;"></i>
                                            <select
                                                class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                                name="billing_cycle" id="billing_cycle" required disabled>
                                                <option value="monthly">Monthly Configuration</option>
                                                <option value="quarterly">Quarterly Configuration</option>
                                                <option value="half_yearly">Half-Yearly Configuration</option>
                                                <option value="yearly" selected>Yearly Log Strategy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                            Operation Mode Intent
                                        </label>
                                        <div class="inner-addon position-relative">
                                            <i class="ri-shield-flash-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                                style="z-index: 5;"></i>
                                            <select
                                                class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                                name="action_intent" id="action_intent" readonly
                                                style="background-color: #f8fafc; pointer-events: none;">
                                                <option value="created">Newly Started</option>
                                                <option value="renewed">RENEW CURRENT LEASE</option>
                                                <option value="upgraded">UPGRADE INFRASTRUCTURE NODE</option>
                                                <option value="downgraded">DOWNGRADE CAPABILITIES ARRAY</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-segment mb-32">
                            <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                                <span
                                    class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                                <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Auditing Ledger &
                                    Overrides</h6>
                            </div>

                            <div class="row gy-4">
                                <div class="col-xl-3 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Adjusted
                                            Premium Cost Base (₹)</label>
                                        <div class="inner-addon position-relative">
                                            <i
                                                class="ri-money-dollar-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                            <input type="number" step="0.01"
                                                class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                id="calculated_amount" name="amount" value="0.00">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">System
                                            Structural Discount (₹)</label>
                                        <div class="inner-addon position-relative">
                                            <i
                                                class="ri-percent-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                            <input type="number" step="0.01"
                                                class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                id="discount" name="discount" value="0.00">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-12">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Governance
                                            Ledger Remarks / Justification</label>
                                        <div class="inner-addon position-relative">
                                            <i
                                                class="ri-chat-history-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                            <input type="text"
                                                class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                name="remarks"
                                                placeholder="Provide audit trail authorization codes or migration notes..."
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="comparisonMatrixWrapper"
                            class="d-none mb-32 border radius-12 p-24 bg-slate-50/50 animate__animated animate__fadeIn">
                            <h6
                                class="text-sm fw-bold uppercase tracking-wider text-neutral-800 mb-16 d-flex align-items-center gap-2">
                                <i class="ri-scales-3-line text-lg text-primary-600"></i> Upgrades vs Downgrades Delta
                                Comparison Matrix
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white align-middle text-sm mb-0">
                                    <thead class="bg-light font-monospace text-xs text-neutral-600 uppercase">
                                        <tr>
                                            <th>Operational Metric Framework</th>
                                            <th class="text-center bg-slate-100">Live Active Plane Node</th>
                                            <th class="text-center bg-primary-50 text-primary-900" style="width: 40%;">
                                                Target Cluster Node Configuration</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-neutral-700">
                                        <tr>
                                            <td class="fw-medium">Assigned Plan Identifier</td>
                                            <td class="text-center text-muted" id="matrix_old_name">-</td>
                                            <td class="text-center fw-bold text-primary-700" id="matrix_new_name">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Maximum Permitted Students Matrix</td>
                                            <td class="text-center" id="matrix_old_students">-</td>
                                            <td class="text-center" id="matrix_new_students">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Maximum Administrative Accounts</td>
                                            <td class="text-center" id="matrix_old_users">-</td>
                                            <td class="text-center" id="matrix_new_users">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Multi-Branch Federation Infrastructure</td>
                                            <td class="text-center" id="matrix_old_branches">-</td>
                                            <td class="text-center" id="matrix_new_branches">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr class="border-neutral-200 mb-24">

                        <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                            <button type="reset"
                                class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                                <i class="ri-loop-left-line"></i> Flush Configurations
                            </button>
                            <button type="submit"
                                class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                                id="btnSubmitDeployment" disabled>
                                <i class="ri-shield-flash-line"></i> Deploy New Architectural Lease
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
    <script>
        let currentActiveSubscription = null;
        let allSystemPlansCache = [];

        const statusUiMap = {
            'active': 'bg-emerald-50 text-primary-600 border border-emerald-200',
            'trial': 'bg-blue-50 text-blue-700 border border-blue-200',
            'grace_period': 'bg-amber-50 text-amber-700 border border-amber-200',
            'expired': 'bg-rose-50 text-rose-700 border border-rose-200'
        };

        function formatKernelTimestamp(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = date.toLocaleString('en-US', {
                month: 'short'
            });
            const year = date.getFullYear();
            const time = date.toTimeString().split(' ')[0];
            return `${day} ${month} ${year} ${time}`;
        }

        function onTenantSelected(schoolId) {
            if (!schoolId) return;

            $('#school_master_id').val(schoolId);

            $.ajax({
                url: "{{ route('superAdmin.tenant.getLeaseManagementData') }}",
                method: "GET",
                data: {
                    tenant_id: schoolId
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        currentActiveSubscription = response.activeSubscription;
                        allSystemPlansCache = response.availablePlans;

                        if (currentActiveSubscription) {
                            $('#currentActiveLeaseWrapper').removeClass('d-none');

                            $('#live_plan_name').text(currentActiveSubscription.plan.name);
                            $('#live_billing_cycle').text(currentActiveSubscription.billing_cycle
                                .toUpperCase());
                            $('#live_final_amount').text('₹' + parseFloat(currentActiveSubscription
                                .final_amount).toLocaleString('en-IN', {
                                minimumFractionDigits: 2
                            }));
                            $('#live_end_date').text(formatKernelTimestamp(currentActiveSubscription.end_date));

                            let badgeCls = statusUiMap[currentActiveSubscription.status] ||
                                'bg-light text-dark';
                            $('#live_status_badge')
                                .attr('class', 'badge uppercase font-monospace text-2xs px-12 py-6 radius-6 ' +
                                    badgeCls)
                                .text(currentActiveSubscription.status);
                        } else {
                            $('#currentActiveLeaseWrapper').addClass('d-none');
                        }

                        let planOptions = '<option value="">-- Choose New Architecture Target Plan --</option>';
                        allSystemPlansCache.forEach(function(plan) {
                            planOptions +=
                                `<option value="${plan.id}">${plan.name} (${plan.code})</option>`;
                        });
                        $('#showAllPlans').html(planOptions).prop('disabled', false); // ✅ FIX
                        $('#billing_cycle').prop('disabled', false); // ✅ FIX
                        $('#btnSubmitDeployment').prop('disabled', false); // ✅ FIX

                        $('#comparisonMatrixWrapper').addClass('d-none');
                    }
                },
                error: function() {
                    showToast('error',
                        'Critical Error: Failed to pipeline secure tenant cluster configuration schemas.');
                }
            });
        }

        function calculateDeltaPricingStructure() {
            let planId = $('#showAllPlans').val();
            let cycle = $('#billing_cycle').val();

            if (!planId) return;

            let selectedPlan = allSystemPlansCache.find(p => p.id == planId);
            if (selectedPlan) {
                let key = cycle + '_price';
                let rawCost = parseFloat(selectedPlan[key]) || 0;
                $('#calculated_amount').val(rawCost.toFixed(2));
                renderDynamicComparisonDelta(selectedPlan);
            }
        }

        // function renderDynamicComparisonDelta(targetPlan) {
        //     $('#comparisonMatrixWrapper').removeClass('d-none');

        //     // ✅ FIX: plan.name, plan.max_students etc. nested hain
        //     let oldName = currentActiveSubscription ? currentActiveSubscription.plan.name : 'No Active Core Plan';
        //     let oldStudents = currentActiveSubscription ? currentActiveSubscription.plan.max_students : 0;
        //     let oldUsers = currentActiveSubscription ? currentActiveSubscription.plan.max_users : 0;
        //     let oldBranches = currentActiveSubscription ? currentActiveSubscription.plan.max_branches : 0;

        //     $('#matrix_old_name').text(oldName);
        //     $('#matrix_old_students').html(
        //         `<span class="badge bg-light text-dark px-10 py-4 radius-4">${oldStudents || 'UNLIMITED'}</span>`);
        //     $('#matrix_old_users').html(
        //         `<span class="badge bg-light text-dark px-10 py-4 radius-4">${oldUsers || 'UNLIMITED'}</span>`);
        //     $('#matrix_old_branches').html(
        //         `<span class="badge bg-light text-dark px-10 py-4 radius-4">${oldBranches || 'UNLIMITED'}</span>`);

        //     $('#matrix_new_name').text(targetPlan.name);

        //     let studentDiff = compareCapabilitiesDelta(oldStudents, targetPlan.max_students);
        //     $('#matrix_new_students').html(
        //         `<span class="badge bg-primary-100 text-primary-800 px-10 py-4 radius-4 me-8">${targetPlan.max_students || 'UNLIMITED'}</span> ${studentDiff}`
        //         );

        //     let userDiff = compareCapabilitiesDelta(oldUsers, targetPlan.max_users);
        //     $('#matrix_new_users').html(
        //         `<span class="badge bg-primary-100 text-primary-800 px-10 py-4 radius-4 me-8">${targetPlan.max_users || 'UNLIMITED'}</span> ${userDiff}`
        //         );

        //     let branchDiff = compareCapabilitiesDelta(oldBranches, targetPlan.max_branches);
        //     $('#matrix_new_branches').html(
        //         `<span class="badge bg-primary-100 text-primary-800 px-10 py-4 radius-4 me-8">${targetPlan.max_branches || 'UNLIMITED'}</span> ${branchDiff}`
        //         );

        //     determineIntentStateMachine(targetPlan);
        // }

        function renderDynamicComparisonDelta(targetPlan) {
            // ✅ FIX: agar tenant ka koi active subscription nahi hai, to comparison matrix
            // hide rakho aur seedha 'created' intent set kar do — koi delta dikhane ki zaroorat nahi
            if (!currentActiveSubscription) {
                $('#comparisonMatrixWrapper').addClass('d-none');
                $('#action_intent').val('created');
                return;
            }

            // if (!currentActiveSubscription) {
            //     $('#comparisonMatrixWrapper').addClass('d-none');
            //     $('#action_intent').val('created');
            //     return;
            // }

            $('#comparisonMatrixWrapper').removeClass('d-none');

            let oldName = currentActiveSubscription.plan.name;
            let oldStudents = currentActiveSubscription.plan.max_students;
            let oldUsers = currentActiveSubscription.plan.max_users;
            let oldBranches = currentActiveSubscription.plan.max_branches;

            $('#matrix_old_name').text(oldName);
            $('#matrix_old_students').html(
                `<span class="badge bg-light text-dark px-10 py-4 radius-4">${oldStudents || 'UNLIMITED'}</span>`);
            $('#matrix_old_users').html(
                `<span class="badge bg-light text-dark px-10 py-4 radius-4">${oldUsers || 'UNLIMITED'}</span>`);
            $('#matrix_old_branches').html(
                `<span class="badge bg-light text-dark px-10 py-4 radius-4">${oldBranches || 'UNLIMITED'}</span>`);

            $('#matrix_new_name').text(targetPlan.name);

            let studentDiff = compareCapabilitiesDelta(oldStudents, targetPlan.max_students);
            $('#matrix_new_students').html(
                `<span class="badge bg-primary-100 text-primary-800 px-10 py-4 radius-4 me-8">${targetPlan.max_students || 'UNLIMITED'}</span> ${studentDiff}`
            );

            let userDiff = compareCapabilitiesDelta(oldUsers, targetPlan.max_users);
            $('#matrix_new_users').html(
                `<span class="badge bg-primary-100 text-primary-800 px-10 py-4 radius-4 me-8">${targetPlan.max_users || 'UNLIMITED'}</span> ${userDiff}`
            );

            let branchDiff = compareCapabilitiesDelta(oldBranches, targetPlan.max_branches);
            $('#matrix_new_branches').html(
                `<span class="badge bg-primary-100 text-primary-800 px-10 py-4 radius-4 me-8">${targetPlan.max_branches || 'UNLIMITED'}</span> ${branchDiff}`
            );

            determineIntentStateMachine(targetPlan);
        }

        function compareCapabilitiesDelta(oldVal, newVal) {
            let oldMetric = oldVal === null || oldVal === 0 ? 9999999 : parseInt(oldVal);
            let newMetric = newVal === null || newVal === 0 ? 9999999 : parseInt(newVal);

            if (newMetric > oldMetric) {
                return `<small class="text-emerald-600 fw-bold font-2xs"><i class="ri-arrow-up-line"></i> UPGRADE DELTA</small>`;
            } else if (newMetric < oldMetric) {
                return `<small class="text-rose-600 fw-bold font-2xs"><i class="ri-arrow-down-line"></i> DOWNGRADE CAP</small>`;
            }
            return `<small class="text-muted font-2xs">EQUAL CAPACITY</small>`;
        }

        // function determineIntentStateMachine(targetPlan) {
        //     if (!currentActiveSubscription) {
        //         $('#action_intent').val('created');
        //         return;
        //     }

        //     if (currentActiveSubscription.subscription_plan_id == targetPlan.id) {
        //         $('#action_intent').val('renewed');
        //         return;
        //     }

        //     let oldPrice = parseFloat(currentActiveSubscription.amount) || 0;
        //     let currentCycleKey = $('#billing_cycle').val() + '_price';
        //     let newPrice = parseFloat(targetPlan[currentCycleKey]) || 0;

        //     if (newPrice >= oldPrice) {
        //         $('#action_intent').val('upgraded');
        //     } else {
        //         $('#action_intent').val('downgraded');
        //     }
        // }

        function determineIntentStateMachine(targetPlan) {
            if (!currentActiveSubscription) {
                $('#action_intent').val('created');
                return;
            }

            if (currentActiveSubscription.subscription_plan_id == targetPlan.id) {
                $('#action_intent').val('renewed');
                return;
            }

            let oldPrice = parseFloat(currentActiveSubscription.amount) || 0;
            let currentCycleKey = $('#billing_cycle').val() + '_price';
            let newPrice = parseFloat(targetPlan[currentCycleKey]) || 0;

            if (newPrice >= oldPrice) {
                $('#action_intent').val('upgraded');
            } else {
                $('#action_intent').val('downgraded');
            }
        }

        $('#showAllPlans, #billing_cycle').on('change', calculateDeltaPricingStructure);

        $(document).ready(function() {
            // $('#leaseModificationForm').on('submit', function(e) {
            //     e.preventDefault();
            //     let form = $(this);
            //     $.ajax({
            //         url: form.attr('data-url'),
            //         method: form.attr('data-method'),
            //         data: form.serialize(),
            //         success: function(res) {
            //             if (res.success) {
            //                 showToast('success', res.message);
            //                 onTenantSelected($('#school_master_id').val());
            //             } else {
            //                 showToast('error', res.message);
            //             }
            //         },
            //         error: function(xhr) {
            //             showToast('error', xhr.responseText ||
            //                 'Structural transaction pipeline exception error occurred.');
            //         }
            //     });
            // });
        });
    </script>
@endpush
