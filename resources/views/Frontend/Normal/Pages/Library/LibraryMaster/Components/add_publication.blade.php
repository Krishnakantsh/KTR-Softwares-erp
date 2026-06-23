<!-- SECTION 1: TOP PANEL - PUBLICATION CREATION CONSOLE -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-book-open-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Publication Provisioning Engine</h6>
                <p class="text-xs text-muted mb-0">Register, catalog, and configure library publisher metadata seamlessly
                </p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-radar-line me-1 ripple-effect"></i> Catalog Core Active
        </span>
    </div>

    <div class="card-body p-24">
        <form id="publicationRegistrationForm" class="ajaxForm"
            data-url="{{ route('school.library.publication.save') }}" data-refresh="fetchRegisteredPublications"
            data-method="POST" autocomplete="off">
            @csrf

            <!-- Hidden Input for Editing Publication ID -->
            <input type="hidden" name="id" id="publication_id">

            <div class="row gy-4 align-items-end">

                <!-- Publication Name Input -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Publication Name <span class="text-danger">*</span>
                        </label>
                        <div class="inner-addon">
                            <i class="ri-bookmark-3-line addon-icon"></i>
                            <input type="text" name="publication_name" id="publication_name"
                                class="form-control custom-premium-input" placeholder="e.g. Oxford University Press"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Publication Description -->
                <div class="col-xl-5 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Description & Distribution Notes
                        </label>
                        <div class="inner-addon">
                            <i class="ri-file-text-line addon-icon"></i>
                            <input type="text" name="description" id="publication_description"
                                class="form-control custom-premium-input"
                                placeholder="Provide brief summary about the publication house...">
                        </div>
                    </div>
                </div>

                <!-- Account Status Configuration -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box h-100">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">
                            Catalog Distribution Status <span class="text-danger">*</span>
                        </label>
                        <div class="d-flex flex-wrap gap-12">
                            <label class="platform-tab-wrapper">
                                <input type="radio" name="status" id="status_active" value="1" checked>
                                <span class="platform-tile active-status-tile"><i
                                        class="ri-checkbox-circle-line me-2"></i>Active</span>
                            </label>
                            <label class="platform-tab-wrapper">
                                <input type="radio" name="status" id="status_inactive" value="0">
                                <span class="platform-tile inactive-status-tile"><i
                                        class="ri-close-circle-line me-2"></i>Archived</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Actions Panel -->
            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetPublicationForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Clear Configuration
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit Publication Profile
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SECTION 2: BOTTOM PANEL - REGISTERED PUBLICATION DATABASE GRID -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Verified Publication Registry
            </h6>
            <p class="text-xs text-muted mb-0">System indexing records and active profile state matrix</p>
        </div>

        <!-- Live Filter Query Entry -->
        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 260px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="publicationRegistrySearch"
                    class="form-control custom-premium-input registry-search-bar"
                    placeholder="Filter records instantly...">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive scrollable-class-registry">
            <table class="table bordered-table align-middle mb-0 text-sm">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 80px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 320px;">Publication Identity</th>
                        <th scope="col" class="text-center" style="width: 160px;">System Status</th>
                        <th scope="col" class="text-center" style="width: 140px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="publicationRegistryTableBody">
                    <!-- Dummy Premium Row 1 -->
                    <tr class="publication-record-row">
                        <td class="text-center fw-semibold text-muted">1</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-matrix-icon">
                                    <span class="fw-bold text-sm text-gradient-primary">OUP</span>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark-main d-block">Oxford University Press</span>
                                    <small class="text-muted text-xs">Slug: oxford-university-press</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="status-badge badge-completed">
                                <span class="pulse-dot-green"></span> Active Catalog
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-publication-trigger"
                                    data-id="1" data-name="Oxford University Press"
                                    data-desc="Global academic publishing branch of the University of Oxford."
                                    data-status="1" title="Modify Meta">
                                    <i class="ri-edit-box-line"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 delete-publication-trigger"
                                    data-id="1" title="Purge Record">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- HIGH-END BRAND SPECIFIC COMPONENT STYLING -->
@push('styles')
    <style>
        .max-w-450 {
            max-width: 450px;
        }

        .premium-generator-card {
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .text-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-pulse-icon {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
        }

        .avatar-matrix-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(124, 58, 237, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(124, 58, 237, 0.15);
        }

        .premium-input-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01);
            transition: all 0.3s ease;
        }

        .premium-input-box:focus-within {
            border-color: #7c3aed;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.08);
        }

        .inner-addon {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .inner-addon .addon-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #64748b;
            pointer-events: none;
            z-index: 10;
        }

        .premium-input-box:focus-within .addon-icon {
            color: #7c3aed;
        }

        .custom-premium-input {
            width: 100% !important;
            padding-left: 44px !important;
            padding-right: 14px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 600 !important;
            height: 44px;
            font-size: 0.9rem;
            color: #1e293b;
            background-color: #ffffff !important;
        }

        .registry-search-bar {
            height: 38px !important;
            font-size: 0.85rem !important;
            padding-left: 40px !important;
        }

        .backend-action-bar {
            border-top: 1px dashed #e2e8f0;
            padding-top: 24px;
            margin-top: 12px;
        }

        .btn-premium-action-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 28px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.25);
            transition: all 0.25s ease-in-out;
            display: inline-flex;
            align-items: center;
        }

        .btn-premium-action-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
            filter: brightness(1.05);
        }

        .btn-premium-action-secondary {
            background: #ffffff;
            color: #475569 !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 24px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-premium-action-secondary:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .platform-tab-wrapper {
            cursor: pointer;
            flex: 1;
            min-width: 100px;
            position: relative;
        }

        .platform-tab-wrapper input {
            position: absolute;
            opacity: 0;
        }

        .platform-tile {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 8px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            transition: all 0.2s ease;
            text-align: center;
        }

        .platform-tab-wrapper:hover .platform-tile {
            background: #f1f5f9;
        }

        .platform-tab-wrapper input:checked+.platform-tile.active-status-tile {
            border-color: #22c55e;
            color: #15803d;
            background: #dcfce7;
        }

        .platform-tab-wrapper input:checked+.platform-tile.inactive-status-tile {
            border-color: #ef4444;
            color: #b91c1c;
            background: #fee2e2;
        }

        .scrollable-class-registry {
            max-height: 480px;
            overflow-y: auto;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .pulse-dot-green {
            width: 6px;
            height: 6px;
            background: #2e7d32;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {

      
            // Live client-side searching filter
            $("#publicationRegistrySearch").on("keyup", function() {
                var query = $(this).val().toLowerCase();
                $("#publicationRegistryTableBody .publication-record-row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
                });
            });


            fetchRegisteredPublications();

            $("#publicationRegistrySearch").on("keyup", function() {

                let value = $(this).val().toLowerCase();

                $("#publicationRegistryTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });

            });

        });

        // fetch

        function fetchRegisteredPublications() {

            fetchMasterData(
                "{{ route('school.library.publication.fetch') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.publication_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 3)
                                .toUpperCase();

                            let statusBadge = row.status == 1 ?

                                `<span class="status-badge badge-completed">
                                <span class="pulse-dot-green"></span>
                                Active Catalog
                            </span>`

                                :

                                `<span class="status-badge badge-cancelled">
                                Archived
                            </span>`;

                            html += `
                            <tr class="publication-record-row">

                                <td class="text-center fw-semibold text-muted">
                                    ${index + 1}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="avatar-matrix-icon">
                                            <span class="fw-bold text-sm text-gradient-primary">
                                                ${initials}
                                            </span>
                                        </div>

                                        <div>
                                            <span class="fw-bold text-dark-main d-block">
                                                ${row.publication_name}
                                            </span>

                                            <small class="text-muted text-xs">
                                                ID: ${row.id}
                                            </small>
                                        </div>

                                    </div>
                                </td>

                                <td class="text-center">
                                    ${statusBadge}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-publication-trigger"
                                            data-id="${row.id}"
                                            title="Edit">

                                            <i class="ri-edit-box-line"></i>

                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 delete-publication-trigger deleteLibraryPublication"
                                            data-id="${row.id}"
                                            title="Delete">

                                            <i class="ri-delete-bin-6-line"></i>

                                        </button>

                                    </div>
                                </td>

                            </tr>
                        `;
                        });

                    } else {

                        html = `
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                No Records Found
                            </td>
                        </tr>
                    `;
                    }

                    $("#publicationRegistryTableBody").html(html);

                }
            );
        }

        // edit

        $(document).on("click", ".edit-publication-trigger", function() {

            let id = $(this).data("id");

            getDataById(
                "{{ route('school.library.publication.get') }}",
                id,
                function(res) {

                    if (!res.status) {
                        return;
                    }

                    let row = res.data;

   

                    $("#publication_id").val(row.id);
                    $("#publication_name").val(row.publication_name);
                  
                    $("#publication_description").val(row.description);
    
                    if (row.status == 1) {

                        $("#status_active").prop("checked", true);

                    } else {

                        $("#status_inactive").prop("checked", true);
                    }

                    $("html, body").animate({
                        scrollTop: 0
                    }, 300);

                }
            );

        });

        // reset

        $("#resetPublicationForm").on("click", function() {

            $("#publicationRegistrationForm")[0].reset();

            $("#publication_id").val("");

            $("#status_active").prop("checked", true);

            $(".text-gradient-primary")
                .text("Publication Provisioning Engine");

        });
    </script>
@endpush
