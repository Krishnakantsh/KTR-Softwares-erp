<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-folder-shared-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Category Classification Engine</h6>
                <p class="text-xs text-muted mb-0">Structure, catalog, and index library genre and media categories</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-radar-line me-1 ripple-effect"></i> Taxonomy Active
        </span>
    </div>

    <div class="card-body p-24">
        <form id="categoryRegistrationForm" class="ajaxForm" data-url="{{ route('school.library.category.save') }}"
            data-refresh="fetchRegisteredCategories" data-method="POST" autocomplete="off">
            @csrf

            <input type="hidden" name="id" id="category_id">

            <div class="row gy-4 align-items-end">

                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Category / Genre Name <span class="text-danger">*</span>
                        </label>
                        <div class="inner-addon">
                            <i class="ri-grid-line addon-icon"></i>
                            <input type="text" name="category_name" id="category_name"
                                class="form-control custom-premium-input" placeholder="e.g. Sci-Fi, Academic Journal"
                                required>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Scope & Taxonomic Description
                        </label>
                        <div class="inner-addon">
                            <i class="ri-text-wrap addon-icon"></i>
                            <input type="text" name="description" id="category_description"
                                class="form-control custom-premium-input"
                                placeholder="Describe the classification scope or age group...">
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box h-100">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">
                            Taxonomy Matrix Status <span class="text-danger">*</span>
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

            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetCategoryForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Clear Configuration
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit Category Schema
                </button>
            </div>
        </form>
    </div>
</div>

<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Verified Category Matrix</h6>
            <p class="text-xs text-muted mb-0">System taxonomy indexing and active catalog node segments</p>
        </div>

        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 260px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="categoryRegistrySearch"
                    class="form-control custom-premium-input registry-search-bar"
                    placeholder="Filter taxonomy instantly...">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive scrollable-class-registry">
            <table class="table bordered-table align-middle mb-0 text-sm">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 80px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 320px;">Category Classification</th>
                        <th scope="col" class="text-center" style="width: 160px;">System Status</th>
                        <th scope="col" class="text-center" style="width: 140px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="categoryRegistryTableBody">

                </tbody>
            </table>
        </div>
    </div>
</div>

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

            fetchRegisteredCategories();

            $("#categoryRegistrySearch").on("keyup", function() {

                let value = $(this).val().toLowerCase();

                $("#categoryRegistryTableBody tr").filter(function() {

                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );

                });

            });

        });

        // fetch

        function fetchRegisteredCategories() {

            fetchMasterData(
                "{{ route('school.library.category.fetch') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.category_name
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
                            <tr class="category-record-row">

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
                                                ${row.category_name}
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
                                            class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-category-trigger"
                                            data-id="${row.id}"
                                            title="Edit">

                                            <i class="ri-edit-box-line"></i>

                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 deleteLibraryCategory"
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

                    $("#categoryRegistryTableBody").html(html);

                }
            );
        }

        // edit

        $(document).on("click", ".edit-category-trigger", function() {

            let id = $(this).data("id");

            getDataById(
                "{{ route('school.library.category.get') }}",
                id,
                function(res) {

                    if (!res.status) {
                        return;
                    }

                    let row = res.data;

                    $("#category_id").val(row.id);
                    $("#category_name").val(row.category_name);
                    $("#category_description").val(row.description);

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

        $("#resetCategoryForm").on("click", function() {

            $("#categoryRegistrationForm")[0].reset();

            $("#category_id").val("");

            $("#status_active").prop("checked", true);

        });
    </script>
@endpush
