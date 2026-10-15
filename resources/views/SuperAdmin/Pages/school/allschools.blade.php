@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Enterprise School Provisioning Engine')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-building-2-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Registered Schools</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage tenant provisioning and subscription
                            lifecycle records.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('superAdmin.school.register.manageView') }}"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Register School
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    School</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Username</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Password</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Database</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Current Plan</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Validity</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Registered On</th>
                            </tr>
                        </thead>
                        <tbody id="schoolsTableBody"></tbody>
                    </table>
                </div>
            </div>

            <div
                class="card-footer bg-base border-top border-neutral-200 py-16 px-28 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="text-xs text-neutral-500" id="schoolsPaginationInfo">Showing 0 results</span>
                <div id="schoolsPagination"></div>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            let currentPage = 1;
            let lastPage = 1;

            fetchSchools(currentPage);

            function fetchSchools(page = 1) {
                $.ajax({
                    url: "{{ route('superAdmin.school.fetchAllTenants') }}",
                    method: "GET",
                    data: {
                        page: page
                    },
                    success: function(res) {
                        if (!res.status) return;

                        renderSchoolTable(res.data.data || []);
                        renderPagination(res.data);

                        currentPage = res.data.current_page;
                        lastPage = res.data.last_page;
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            }

            const subStatusColorMap = {
                trial: 'bg-info-50 text-info-700 border-info-100',
                active: 'bg-success-50 text-success-700 border-success-100',
                grace_period: 'bg-warning-50 text-warning-700 border-warning-100',
                expired: 'bg-danger-50 text-danger-700 border-danger-100',
                cancelled: 'bg-neutral-100 text-neutral-600 border-neutral-200',
                suspended: 'bg-danger-50 text-danger-700 border-danger-100',
            };

            function renderPlanBlock(sub) {
                if (!sub) {
                    return `<span class="text-xxs text-neutral-400">No subscription record</span>`;
                }

                let colorClass = subStatusColorMap[sub.status] ||
                    'bg-neutral-100 text-neutral-600 border-neutral-200';

                return `
                    <div class="d-flex flex-column gap-1">
                        <span class="text-xs fw-semibold text-neutral-800">${sub.plan_name}</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge ${colorClass} border px-8 py-2 radius-4 font-xxs text-capitalize">${sub.status}</span>
                            <span class="text-xxs text-neutral-500 text-capitalize">${(sub.billing_cycle ?? '').replace('_',' ')}</span>
                        </div>
                        <span class="text-xxs text-neutral-600 fw-semibold">₹${Math.round(Number(sub.final_amount)).toLocaleString('en-IN')}</span>
                    </div>`;
            }

            function renderValidityBlock(sub) {
                if (!sub || !sub.end_date) {
                    return `<span class="text-xxs text-neutral-400">-</span>`;
                }

                let days = Math.round(sub.days_remaining);
                let daysLabel = '';

                if (days === null) {
                    daysLabel = '';
                } else if (days > 0) {
                    daysLabel =
                        `<span class="badge bg-success-50 text-success-700 border border-success-100 px-8 py-2 radius-4 font-xxs">${days} days left</span>`;
                } else if (days === 0) {
                    daysLabel =
                        `<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-8 py-2 radius-4 font-xxs">Expires today</span>`;
                } else {
                    daysLabel =
                        `<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-8 py-2 radius-4 font-xxs">Expired ${Math.abs(days)} days ago</span>`;
                }

                return `
                    <div class="d-flex flex-column gap-1">
                        <span class="text-xs text-neutral-700">${sub.start_date} &rarr; ${sub.end_date}</span>
                        ${daysLabel}
                    </div>`;
            }

            function renderSchoolTable(rows) {
                let html = '';

                if (rows.length > 0) {
                    $.each(rows, function(index, row) {

                        let statusBadge = row.is_active == 1 ?
                            `<span class="badge bg-success-100 text-success-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Active</span>` :
                            `<span class="badge bg-danger-100 text-danger-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Inactive</span>`;

                        let sub = row.current_subscription;

                        html += `
                        <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                            <td class="py-20 px-28">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="p-2 radius-8 bg-neutral-100 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="ri-building-2-line text-lg text-primary-600"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.name}</h6>
                                        <span class="text-xs text-neutral-400 font-mono">${row.username}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="py-20 px-20">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-xs text-neutral-700">${row.email ?? '-'}</span>
                                    <span class="text-xxs text-neutral-500">${row.phone ?? '-'}</span>
                                </div>
                            </td>
                            <td class="py-20 px-20">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-xs text-neutral-700">${row.password ?? '-'}</span>
                                 
                                </div>
                            </td>

                            <td class="py-20 px-20">
                                <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs font-mono">${row.db_name}</span>
                            </td>

                            <td class="py-20 px-20">
                                ${renderPlanBlock(sub)}
                            </td>

                            <td class="py-20 px-20">
                                ${renderValidityBlock(sub)}
                            </td>

                            <td class="py-20 px-20 text-center">
                                ${statusBadge}
                            </td>

                            <td class="py-20 px-28 text-end">
                                <span class="text-xs text-neutral-600">${formatDate(row.created_at)}</span>
                            </td>
                        </tr>`;
                    });
                } else {
                    html = `
                    <tr>
                        <td colspan="7" class="py-40 text-center">
                            <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                            <span class="text-sm fw-medium text-neutral-500">No schools registered yet.</span>
                        </td>
                    </tr>`;
                }

                $("#schoolsTableBody").html(html);
            }

            function formatDate(dateStr) {
                if (!dateStr) return '-';
                let d = new Date(dateStr);
                return d.toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }

            function renderPagination(meta) {
                let from = meta.from ?? 0;
                let to = meta.to ?? 0;
                let total = meta.total ?? 0;

                $('#schoolsPaginationInfo').text(`Showing ${from} - ${to} of ${total} results`);

                let html = '';

                if (meta.last_page > 1) {
                    html += `<ul class="pagination pagination-sm mb-0">`;

                    html += `<li class="page-item ${meta.current_page === 1 ? 'disabled' : ''}">
                                <a class="page-link" href="#" data-page="${meta.current_page - 1}">Prev</a>
                              </li>`;

                    for (let i = 1; i <= meta.last_page; i++) {
                        html += `<li class="page-item ${meta.current_page === i ? 'active' : ''}">
                                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                                  </li>`;
                    }

                    html += `<li class="page-item ${meta.current_page === meta.last_page ? 'disabled' : ''}">
                                <a class="page-link" href="#" data-page="${meta.current_page + 1}">Next</a>
                              </li>`;

                    html += `</ul>`;
                }

                $('#schoolsPagination').html(html);
            }

            $(document).on('click', '#schoolsPagination .page-link', function(e) {
                e.preventDefault();
                let page = parseInt($(this).data('page'));
                if (isNaN(page) || page < 1 || page > lastPage || page === currentPage) return;
                fetchSchools(page);
            });

        });
    </script>
@endpush
