@extends('SuperAdmin.Layout.main')

@section('title', "KTR ERP : Broadcast't List ")

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap justify-content-between align-items-center gap-3 dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon">
                        <i class="ri-broadcast-line text-2xl text-white"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Active Broadcast Registry</h5>
                        <p class="text-xs text-neutral-500 mb-0">Monitor cluster dispatches, micro-targeting audience states,
                            and scheduled system communications.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center flex-wrap gap-3">
                    <div class="position-relative">
                        <i
                            class="ri-search-line position-absolute start-0 top-50 translate-middle-y ms-12 text-neutral-400"></i>
                        <input type="text" id="broadcastRegistrySearch"
                            class="form-control custom-premium-input ps-36 py-8 radius-8 text-xs" style="width: 260px;"
                            placeholder="Search broadcast dispatches...">
                    </div>
                    <a href="{{ route('superAdmin.broadcast.index') }}"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-20 py-10 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-sm"></i> Deploy New Broadcast
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle text-nowrap">
                        <thead class="bg-neutral-50 text-neutral-600 font-xs fw-bold border-bottom border-neutral-200">
                            <tr>
                                <th class="text-center py-16 px-20" style="width: 60px;">#</th>
                                <th class="py-16 px-24">Broadcast Core Metadata</th>
                                <th class="py-16 px-24">Target Channels</th>
                                <th class="py-16 px-24">Audience Strategy</th>
                                <th class="py-16 px-24">UI Presentation</th>
                                <th class="text-center py-16 px-24">Status State</th>
                                <th class="text-center py-16 px-28" style="width: 140px;">Action Controllers</th>
                            </tr>
                        </thead>
                        <tbody id="broadcastRegistryTableBody">
                            <tr>
                                <td colspan="7" class="text-center py-5 text-neutral-400 font-xs fw-medium">
                                    <div class="spinner-border spinner-border-sm text-primary-600 me-2" role="status">
                                    </div>
                                    Syncing cluster master registries...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end border-0 shadow-2" tabindex="-1" id="broadcastDetailsSidebar"
        aria-labelledby="broadcastDetailsSidebarLabel" style="width: 480px; border-radius: 16px 0 0 16px;">
        <div class="offcanvas-header bg-neutral-50 border-bottom border-neutral-100 py-20 px-24">
            <div class="d-flex align-items-center gap-2">
                <i class="ri-article-line text-primary-600 text-xl"></i>
                <h6 class="offcanvas-title fw-bold text-neutral-900" id="broadcastDetailsSidebarLabel">Broadcast
                    Micro-Metadata</h6>
            </div>
            <button type="button" class="btn-close text-reset text-xs" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-24 bg-light-soft" id="detailsSidebarBody">
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            // Complete Live Broadcast Registry Pull Execution
            fetchBroadcastRegistry();

            // High-Efficiency Live Search Filter Logic
            $("#broadcastRegistrySearch").on("keyup", function() {
                let value = $(this).val().toLowerCase().trim();
                $("#broadcastRegistryTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Global Event Mapping for Dynamic Detailed Inspect Modal View
            $(document).on('click', '.view-broadcast-details', function() {
                let rowData = $(this).data('row');
                renderBroadcastOverlayPanel(rowData);
            });

            // Trigger Redirect Path Routing toward Dedicated Form Updates
            $(document).on('click', '.edit-broadcast-trigger', function() {
                let id = $(this).data('id');
                // Form page layout endpoint execution parsing target identity
                window.location.href = `{{ url('superadmin/broadcast/edit') }}/${id}`;
            });

            // Delete Command Signal Pipeline Triggers
            $(document).on('click', '.delete-broadcast-trigger', function() {
                let targetId = $(this).data('id');
                executeBroadcastNodeDrop(targetId, $(this).closest('tr'));
            });
        });

 
        function fetchBroadcastRegistry() {
            // Fallback placeholder endpoint verification path
            let targetUrl = "{{ route('superAdmin.broadcast.fetch') }}";

            fetchMasterData(targetUrl, function(res) {
                let html = '';

                if (res.status && res.data && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        // Error proof parsing safeguards mapping dynamic data fields safely
                        let titleStr = row.title ?? 'Untitled Dispatch';
                        let initials = titleStr.substring(0, 3).toUpperCase();
                        let routeSlug = row.slug ?? '-';
                        let priority = row.priority ?? 'normal';

                        // Priority Badge CSS Theme Resolution Map
                        let priorityBadgeMap = {
                            'low': 'bg-success-100 text-success-700',
                            'normal': 'bg-primary-100 text-primary-700',
                            'high': 'bg-warning-100 text-warning-700',
                            'critical': 'bg-danger-100 text-danger-700'
                        };
                        let pBadgeClass = priorityBadgeMap[priority] || 'bg-neutral-100 text-neutral-700';

                        // Parse channel ecosystems lists safely
                        let ecosystemHtml = '';
                        try {
                            let platforms = typeof row.platform === 'string' ? JSON.parse(row.platform) : (
                                row.platform ?? []);
                            if (Array.isArray(platforms) && platforms.length > 0) {
                                platforms.forEach(p => {
                                    ecosystemHtml +=
                                        `<span class="badge bg-slate-50 border border-neutral-200 text-neutral-700 font-xxs me-1 text-capitalize">${p}</span>`;
                                });
                            } else {
                                ecosystemHtml = '<span class="text-muted text-xs">-</span>';
                            }
                        } catch (e) {
                            ecosystemHtml = '<span class="text-muted text-xs">-</span>';
                        }

                        // Status Configuration System Badge Generator
                        let statusBadge = '';
                        if (row.status === 'active') {
                            statusBadge =
                                `<span class="badge bg-success-50 text-success-700 font-xxs radius-4 px-8 py-4 fw-semibold align-items-center gap-1 d-inline-flex"><span class="pulse-dot-green"></span>Production</span>`;
                        } else if (row.status === 'draft') {
                            statusBadge =
                                `<span class="badge bg-neutral-100 text-neutral-600 font-xxs radius-4 px-8 py-4 fw-semibold">Draft Vault</span>`;
                        } else {
                            statusBadge =
                                `<span class="badge bg-danger-50 text-danger-600 font-xxs radius-4 px-8 py-4 fw-semibold">Suspended</span>`;
                        }

                        // Base Object String Serialization for Data Injector Layers
                        let serializedData = JSON.stringify(row).replace(/"/g, '&quot;');

                        html += `
                    <tr class="book-record-row border-bottom border-neutral-100">
                        <td class="text-center font-xs fw-bold text-neutral-500 py-14 px-20">
                            ${index + 1}
                        </td>
                        <td class="py-14 px-24">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-matrix-icon bg-slate-50 border border-primary-200" style="width:38px; height:38px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                    <span class="fw-bold text-xxs text-primary-600 text-gradient-primary">${initials}</span>
                                </div>
                                <div>
                                    <span class="fw-bold text-neutral-800 d-block font-xs mb-2">${titleStr}</span>
                                    <small class="text-muted font-xxs d-block">Slug: <span class="text-neutral-500 fw-medium">${routeSlug}</span></small>
                                </div>
                            </div>
                        </td>
                        <td class="py-14 px-24">
                            <div class="d-flex flex-wrap gap-1">${ecosystemHtml}</div>
                        </td>
                        <td class="py-14 px-24">
                            <span class="badge ${pBadgeClass} font-xxs px-8 py-4 text-capitalize mb-2 d-inline-block">${priority}</span>
                            <small class="text-muted font-xxs d-block fw-medium">Audience: <span class="text-neutral-700 text-uppercase">${row.audience_type ?? 'all'}</span></small>
                        </td>
                        <td class="py-14 px-24">
                            <span class="text-xs text-neutral-800 fw-semibold text-capitalize d-block mb-2"><i class="ri-window-line text-neutral-400 me-4"></i>${row.display_type ?? 'Popup'}</span>
                            <small class="text-muted font-xxs d-block">Action: <span class="text-primary-600 fw-medium text-capitalize">${row.action_type ?? 'None'}</span></small>
                        </td>
                        <td class="text-center py-14 px-24">
                            ${statusBadge}
                        </td>
                        <td class="text-center py-14 px-28">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" data-row="${serializedData}" class="class-master-sidebar-btn edit role view-broadcast-details" title="View Detailed Parameters">
                                    <i class="ri-eye-line custom-btn-primary" style="color: #4f46e5 !important;"></i>
                                </button>
                                <button type="button" data-id="${row.id}" class="class-master-sidebar-btn edit role edit-broadcast-trigger" title="Edit Parameters">
                                    <i class="ri-edit-fill custom-btn-primary"></i>
                                </button>
                                <button type="button" data-id="${row.id}" class=" delete-broadcast-trigger" title="Terminate Dispatch">
                                    <i class="ri-delete-bin-fill custom-btn-red"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
                    });
                } else {
                    html = `
                <tr>
                    <td colspan="7" class="text-center py-48 text-neutral-400 font-xs fw-semibold">
                        <i class="ri-inbox-archive-line text-3xl text-neutral-300 d-block mb-8"></i>
                        No Active Broadcast Configurations Found.
                    </td>
                </tr>`;
                }

                $("#broadcastRegistryTableBody").html(html);
            });
        }

      
        function renderBroadcastOverlayPanel(data) {
            if (!data) return;

            // Fallback variables evaluation layers
            let desc = data.description ?? 'No narrative textual description cataloged for this asset instance.';
            let actionUrl = data.button_url ?? '-';
            let actionText = data.button_text ?? '-';
            let start = data.start_date ? `${data.start_date} ${data.start_time ?? ''}` : '-';
            let end = data.end_date ? `${data.end_date} ${data.end_time ?? ''}` : '-';

            let tenantListHtml = '';
            try {
                let tenants = typeof data.tenant_json === 'string' ? JSON.parse(data.tenant_json) : (data.tenant_json ??
            []);
                if (Array.isArray(tenants) && tenants.length > 0) {
                    tenants.forEach(t => {
                        tenantListHtml +=
                            `<span class="badge bg-primary-50 text-primary-700 font-xxs border border-primary-100 p-2 radius-4">Cluster ID Node: #${t}</span>`;
                    });
                } else {
                    tenantListHtml =
                        '<span class="text-neutral-500 font-xs fw-semibold">Universal targeting applied (All Nodes)</span>';
                }
            } catch (e) {
                tenantListHtml =
                    '<span class="text-neutral-500 font-xs fw-semibold">Universal targeting applied (All Nodes)</span>';
            }

            let bodyHtml = `
            <div class="mb-20 p-3 bg-base radius-12 border border-neutral-200">
                <small class="text-neutral-400 text-uppercase font-xxs fw-bold tracking-wider d-block mb-4">Broadcast Narrative</small>
                <p class="text-neutral-800 font-xs fw-semibold mb-0 style="line-height: 1.5;">${desc}</p>
            </div>

            <div class="row g-3 mb-20">
                <div class="col-6">
                    <div class="p-3 bg-base radius-12 border border-neutral-100">
                        <small class="text-neutral-400 font-xxs d-block text-uppercase fw-bold mb-4">Display Position</small>
                        <span class="text-neutral-800 text-capitalize font-xs fw-bold"><i class="ri-focus-2-line text-neutral-400 me-1"></i>${data.popup_position ?? 'Center'}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-base radius-12 border border-neutral-100">
                        <small class="text-neutral-400 font-xxs d-block text-uppercase fw-bold mb-4">Display Order Index</small>
                        <span class="text-neutral-800 font-xs fw-bold"><i class="ri-sort-asc text-neutral-400 me-1"></i>Priority Node #${data.display_order ?? '1'}</span>
                    </div>
                </div>
            </div>

            <div class="mb-20 p-3 bg-base radius-12 border border-neutral-100">
                <small class="text-neutral-400 text-uppercase font-xxs fw-bold tracking-wider d-block mb-8">Target Targeted Nodes Cluster</small>
                <div class="d-flex flex-wrap gap-2">${tenantListHtml}</div>
            </div>

            <div class="mb-20 p-3 bg-base radius-12 border border-neutral-100">
                <small class="text-neutral-400 text-uppercase font-xxs fw-bold tracking-wider d-block mb-8">Interaction Behavior Configurations</small>
                <div class="row g-2">
                    <div class="col-6 font-xxs fw-semibold text-neutral-600"><i class="${data.show_popup ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-neutral-300'} me-1"></i>Show Overlay Box</div>
                    <div class="col-6 font-xxs fw-semibold text-neutral-600"><i class="${data.show_notification ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-neutral-300'} me-1"></i>Inject Bell Feeds</div>
                    <div class="col-6 font-xxs fw-semibold text-neutral-600"><i class="${data.is_dismissible ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-neutral-300'} me-1"></i>Dismissible Panel</div>
                    <div class="col-6 font-xxs fw-semibold text-neutral-600"><i class="${data.requires_acknowledgement ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-neutral-300'} me-1"></i>Force Read Acknowledgement</div>
                </div>
            </div>

            <div class="mb-20 p-3 bg-base radius-12 border border-neutral-100">
                <small class="text-neutral-400 text-uppercase font-xxs fw-bold tracking-wider d-block mb-8">CTA Action Anchor Parameters</small>
                <div class="font-xs fw-bold text-neutral-800 mb-4">CTA Text: <span class="text-primary-600">${actionText}</span></div>
                <div class="font-xs fw-bold text-neutral-800 word-break" style="word-break: break-all;">Target URL: <span class="text-neutral-500 fw-medium">${actionUrl}</span></div>
            </div>

            <div class="p-3 bg-base radius-12 border border-neutral-100">
                <small class="text-neutral-400 text-uppercase font-xxs fw-bold tracking-wider d-block mb-8">Chronos Dynamic Scheduling Timespan</small>
                <div class="font-xs fw-bold text-neutral-700 mb-4"><i class="ri-play-circle-line text-success me-4"></i>Start Gateway: <span class="text-neutral-900 font-xs fw-semibold">${start}</span></div>
                <div class="font-xs fw-bold text-neutral-700"><i class="ri-stop-circle-line text-danger me-4"></i>End Termination: <span class="text-neutral-900 font-xs fw-semibold">${end}</span></div>
            </div>
        `;

            $("#detailsSidebarBody").html(bodyHtml);

            let myOffcanvas = new bootstrap.Offcanvas(document.getElementById('broadcastDetailsSidebar'));
            myOffcanvas.show();
        }




    </script>
@endpush
