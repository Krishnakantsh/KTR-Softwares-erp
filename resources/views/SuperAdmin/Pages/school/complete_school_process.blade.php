@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Tenant Governance & Lifecycle Command')

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <x-tenant-search />

        <div id="tenantManagementWorkspace" class="d-block animate__animated animate__fadeIn">
            <div class="row gy-4">

                <div class="col-xl-8 col-lg-7">

                    <div class="premium-generator-card p-24 shadow-sm bg-white radius-16 mb-24 d-none"
                        id="currentPlanSection">
                        <div class="d-flex align-items-center justify-content-between mb-16 border-bottom pb-12">
                            <div class="d-flex align-items-center gap-2">
                                <div class="brand-pulse-icon">
                                    <i class="ri-vip-diamond-line text-white text-lg"></i>
                                </div>
                                <div>
                                    <h5 class="text-md fw-bold text-slate-800 mb-0">Active Lease & Engine Specifications
                                    </h5>
                                    <p class="text-2xs text-slate-400 mb-0">Live billing cycles configurations and
                                        multi-tenant parameters.</p>
                                </div>
                            </div>
                            <span class="badge bg-slate-50 text-primary-600 border border-slate-200 font-monospace text-2xs px-10 py-6 radius-6"
                                id="current_status_badge">Active</span>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-3 col-6 border-end-md text-center-sm">
                                <span class="text-2xs text-slate-400 d-block uppercase tracking-wider mb-4">Billing
                                    Cycle</span>
                                <span class="text-sm fw-bold text-slate-700" id="current_billing_cycle">-</span>
                            </div>
                            <div class="col-sm-3 col-6 border-end-md text-center-sm">
                                <span class="text-2xs text-slate-400 d-block uppercase tracking-wider mb-4">Final Premium
                                    Amount</span>
                                <span class="text-sm fw-bold text-slate-800" id="current_final_amount">₹0.00</span>
                            </div>
                            <div class="col-sm-3 col-6 border-end-md text-center-sm">
                                <span class="text-2xs text-slate-400 d-block uppercase tracking-wider mb-4">Provisioned
                                    Date</span>
                                <span class="text-sm fw-bold text-slate-600" id="current_start_date">-</span>
                            </div>
                            <div class="col-sm-3 col-6 text-center-sm">
                                <span class="text-2xs text-slate-400 d-block uppercase tracking-wider mb-4">Valid Until
                                    Lease</span>
                                <span class="text-sm fw-bold text-slate-600" id="current_end_date">-</span>
                            </div>
                        </div>
                    </div>

                    <div class="premium-lifecycle-workspace p-24 shadow-sm bg-white mb-16">
                        <div class="d-flex align-items-center justify-content-between mb-24 border-bottom pb-16">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary-50 text-primary-600 p-8 radius-8 border border-primary-100">
                                    <i class="ri-git-merge-line text-lg"></i>
                                </div>
                                <div>
                                    <h5 class="text-md fw-bold text-slate-800 mb-0">Tenant Lifecycle & Provisioning Engine
                                    </h5>
                                    <p class="text-2xs text-slate-400 mb-0">Cryptographic milestone records and
                                        infrastructure lifecycle states.</p>
                                </div>
                            </div>
                            <span
                                class="badge bg-slate-50 text-primary-600 border border-slate-200 font-monospace text-2xs px-10 py-6 radius-6">v2.4-Pipeline</span>
                        </div>

                        <div class="pipeline-track-container" id="historyTimelineContainer">

                            <div class="text-center py-40" id="timelinePlaceholder">
                                <i class="ri-folder-open-line text-slate-300 display-4 d-block mb-12"></i>
                                <p class="text-sm text-slate-400 mb-0">Please search and select a tenant cluster to parse
                                    lifecycle history timeline graphs.</p>
                            </div>

                        </div>
                    </div>

                </div>
          

                <div class="col-xl-4 col-lg-5">
                    <div class="shadow-2 radius-16 bg-base border border-neutral-200 p-24 mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 border-bottom pb-12">
                            <i class="ri-shield-keyhole-line text-xl text-primary-600"></i>
                            <h5 class="text-md fw-bold text-neutral-800 mb-0">System Access Security</h5>
                        </div>
                        <p class="text-xs text-neutral-500 mb-16">Instantly control tenant network permissions. Restricting
                            traffic blocks all system users, portal gateways, and API handshakes.</p>

                        <div
                            class="bg-neutral-50 border border-neutral-200 radius-12 p-16 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-sm fw-bold text-neutral-800 d-block">Global Active Traffic</span>
                                <span class="text-2xs text-muted">Toggle off to drop incoming server routes</span>
                            </div>
                            <div class="form-check form-switch p-0 m-0">
                                <input type="hidden" name="school_id" id="school_id">
                                <label class="switch">
                                    <input type="checkbox" name="is_ews" id="is_ews" value="1" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection




@push('script')
    <script>
        const statusUiMap = {
            'active': {
                badge: 'bg-emerald-50 text-primary-600 border border-emerald-200',
                halo: 'halo-success',
                icon: 'ri-checkbox-circle-line'
            },
            'trial': {
                badge: 'bg-blue-50 text-blue-600 border border-blue-200',
                halo: 'halo-initialized',
                icon: 'ri-rocket-2-line'
            },
            'grace_period': {
                badge: 'bg-amber-50 text-amber-600 border border-amber-200',
                halo: 'halo-scheduled',
                icon: 'ri-time-line'
            },
            'expired': {
                badge: 'bg-rose-50 text-rose-600 border border-rose-200',
                halo: 'halo-scheduled',
                icon: 'ri-error-warning-line'
            },
            'cancelled': {
                badge: 'bg-slate-100 text-slate-600 border border-slate-300',
                halo: 'halo-scheduled',
                icon: 'ri-close-circle-line'
            },
            'suspended': {
                badge: 'bg-neutral-800 text-white',
                halo: 'halo-scheduled',
                icon: 'ri-lock-password-line'
            }
        };

        const actionUiMap = {
            'created': {
                text: 'SaaS Infrastructure Initialized',
                halo: 'halo-initialized',
                icon: 'ri-rocket-2-line',
                textClass: 'text-slate-700'
            },
            'trial_started': {
                text: 'Sandbox Node Activated',
                halo: 'halo-initialized',
                icon: 'ri-shield-user-line',
                textClass: 'text-info-700'
            },
            'renewed': {
                text: 'Plan Renewed & Provisioned',
                halo: 'halo-success',
                icon: 'ri-checkbox-circle-line',
                textClass: 'text-emerald-700'
            },
            'upgraded': {
                text: 'Engine Upgraded Successfully',
                halo: 'halo-success',
                icon: 'ri-arrow-up-circle-line',
                textClass: 'text-primary-700'
            },
            'expired': {
                text: 'Cluster Lease Expired',
                halo: 'halo-scheduled',
                icon: 'ri-error-warning-line',
                textClass: 'text-danger-600'
            }
        };

        function onTenantSelected(schoolId) {
            if (!schoolId) return;

            document.getElementById('school_id').value = schoolId;
            document.getElementById('is_ews').removeAttribute('disabled');


            $.ajax({
                url: "{{ route('superAdmin.school.getSubscriptionData') }}",
                method: "GET",
                data: {
                    tenant_id: schoolId
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {

                        if (response.currentPlan) {
                            let plan = response.currentPlan;
                            $('#currentPlanSection').removeClass('d-none');
                            $('#current_billing_cycle').text(plan.billing_cycle);
                            $('#current_final_amount').text('₹' + parseFloat(plan.final_amount).toLocaleString(
                                'en-IN', {
                                    minimumFractionDigits: 2
                                }));
                            $('#current_start_date').text(plan.start_date_formatted);
                            $('#current_end_date').text(plan.end_date_formatted);

                            let stateUi = statusUiMap[plan.status] || {
                                badge: 'bg-light text-dark',
                                halo: 'halo-scheduled',
                                icon: 'ri-radio-button-line'
                            };
                            $('#current_status_badge').attr('class',
                                'badge text-uppercase font-monospace text-2xs px-10 py-6 radius-6 ' +
                                stateUi.badge).text(plan.status);


                            document.getElementById('is_ews').checked = (plan.status === 'active' || plan
                                .status === 'trial');
                        } else {
                            $('#currentPlanSection').addClass('d-none');
                        }

                        let htmlTimeline = '';
                        if (response.history && response.history.length > 0) {
                            response.history.forEach(function(item) {
                                let actUi = actionUiMap[item.action] || {
                                    text: item.action.toUpperCase(),
                                    halo: 'halo-scheduled',
                                    icon: 'ri-history-line',
                                    textClass: 'text-slate-700'
                                };

                                htmlTimeline += `
                                <div class="pipeline-step-node mb-20">
                                    <div class="pipeline-status-halo ${actUi.halo}">
                                        <i class="${actUi.icon}"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <span class="text-xs fw-bold ${actUi.textClass} uppercase tracking-wider d-flex align-items-center gap-2">
                                            ${actUi.text}
                                        </span>
                                        <span class="badge bg-light text-primary-600 font-monospace text-2xs border px-8 py-4 radius-4">${item.created_date_formatted}</span>
                                    </div>
                                    <p class="text-sm text-slate-500 mb-0">${item.remarks ? item.remarks : 'System automated structure transaction ledger generated verified hash mapping parameters.'}</p>
                                    
                                    <div class="pipeline-log-terminal d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ri-terminal-box-line text-slate-400 font-md"></i>
                                            <span class="font-monospace text-2xs text-slate-400">
                                                system_log // <span class="terminal-accent-text">TXN_HSH_${item.id}</span> // value: ₹${parseFloat(item.amount).toFixed(2)}
                                            </span>
                                        </div>
                                    </div>
                                </div>`;
                            });
                            $('#historyTimelineContainer').html(htmlTimeline);
                        } else {
                            $('#historyTimelineContainer').html(`
                                <div class="text-center py-40">
                                    <i class="ri-database-2-line text-slate-300 display-4 d-block mb-12"></i>
                                    <p class="text-sm text-slate-400 mb-0">No past milestone transaction ledgers verified found on this tenant nodes.</p>
                                </div>`);
                        }
                    }
                },
                error: function(xhr) {
                    showToast('error', 'Failed to trace pipeline subscription streams matrix parameters.');
                }
            });
        }

        document.getElementById('is_ews').addEventListener('change', function() {
            let schoolId = document.getElementById('school_id').value;
            let status = this.checked ? 1 : 0;

            if (!schoolId) {
                showToast('success', 'Please select atleast one record');
                this.checked = !this.checked;
                return;
            }

            $.ajax({
                url: "{{ route('superAdmin.school.toggleStatus') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    school_id: schoolId,
                    is_active: status
                },
                success: function(response) {
                    showToast('success', response.message);
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText);
                    document.getElementById('is_ews').checked = !status;
                }
            });
        });
    </script>
@endpush

