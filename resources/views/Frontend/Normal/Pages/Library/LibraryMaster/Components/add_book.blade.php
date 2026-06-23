<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-book-3-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Book Inventory Provisioning Engine</h6>
                <p class="text-xs text-muted mb-0">Catalog core assets, reference codes, physical tracking coordinates,
                    and inventory valuation</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-git-repository-line me-1 ripple-effect"></i> Inventory Core Active
        </span>
    </div>

    <div class="card-body p-24">



        <form id="bookRegistrationForm" class="ajaxForm" data-url="{{ route('school.library.book.save') }}"
            data-refresh="fetchLibraryBooks" data-method="POST" autocomplete="off">
            @csrf

            <!-- Hidden Input for Editing Book ID -->
            <input type="hidden" name="id" id="book_id">

            <!-- SUB-SECTION A: PRIMARY METADATA -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-git-commit-line me-1"></i> Core Classification & Identity</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Book Title -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Book
                            Title <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-heading addon-icon"></i>
                            <input type="text" name="book_name" id="book_name"
                                class="form-control custom-premium-input" placeholder="e.g. Introduction to Algorithms"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Sub Title -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Sub
                            Title</label>
                        <div class="inner-addon">
                            <i class="ri-text-spacing addon-icon"></i>
                            <input type="text" name="sub_title" id="sub_title"
                                class="form-control custom-premium-input" placeholder="e.g. A Modern Approach">
                        </div>
                    </div>
                </div>

                <!-- Category Dropdown -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Category
                            / Taxonomy <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-folder-open-line addon-icon"></i>
                            <select name="category_id" id="category_id"
                                class="form-control custom-premium-input categoryOptions" required
                                style="appearance: auto;">

                                <!-- Dynamic options loaded here -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Author Dropdown -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Author
                            Profile <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-user-star-line addon-icon"></i>
                            <select name="author_id" id="author_id"
                                class="form-control custom-premium-input authorOptions" required
                                style="appearance: auto;">

                                <!-- Dynamic options loaded here -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Publication Dropdown -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Publication
                            House <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-bank-line addon-icon"></i>
                            <select name="publication_id" id="publication_id"
                                class="form-control custom-premium-input publicationOptions" required
                                style="appearance: auto;">

                                <!-- Dynamic options loaded here -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Subject Reference -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Subject</label>
                        <div class="inner-addon">
                            <i class="ri-node-tree addon-icon"></i>
                            <input type="text" name="subject" id="subject"
                                class="form-control custom-premium-input" placeholder="e.g. Computer Science">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION B: SYSTEM CODES & TRACKING -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-qr-code-line me-1"></i> System Registration & System Tokens</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Book Code -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">System
                            Book Code <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-key-line addon-icon"></i>
                            <input type="text" name="book_code" id="book_code"
                                class="form-control custom-premium-input" placeholder="e.g. BK-9021" required>
                        </div>
                    </div>
                </div>

                <!-- Accession No -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Accession
                            Number <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-fingerprint-line addon-icon"></i>
                            <input type="text" name="accession_no" id="accession_no"
                                class="form-control custom-premium-input" placeholder="e.g. ACC-2026-04" required>
                        </div>
                    </div>
                </div>

                <!-- Barcode Reference -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Barcode
                            Token</label>
                        <div class="inner-addon">
                            <i class="ri-bar-code-line addon-icon"></i>
                            <input type="text" name="barcode" id="barcode"
                                class="form-control custom-premium-input" placeholder="Scan or type barcode...">
                        </div>
                    </div>
                </div>

                <!-- ISBN No -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">ISBN
                            Number</label>
                        <div class="inner-addon">
                            <i class="ri-scan-2-line addon-icon"></i>
                            <input type="text" name="isbn_no" id="isbn_no"
                                class="form-control custom-premium-input" placeholder="e.g. 978-3-16-148410-0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION C: LOGISTICAL BIBLIOGRAPHICS & WAREHOUSE -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-map-pin-5-line me-1"></i> Logistics & Physical Coordinates</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Edition -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Edition</label>
                        <div class="inner-addon">
                            <i class="ri-clockwise-2-line addon-icon"></i>
                            <input type="text" name="edition" id="edition"
                                class="form-control custom-premium-input" placeholder="e.g. 3rd Edition">
                        </div>
                    </div>
                </div>

                <!-- Volume -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Volume</label>
                        <div class="inner-addon">
                            <i class="ri-stack-line addon-icon"></i>
                            <input type="text" name="volume" id="volume"
                                class="form-control custom-premium-input" placeholder="e.g. Vol I">
                        </div>
                    </div>
                </div>

                <!-- Language -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Language</label>
                        <div class="inner-addon">
                            <i class="ri-translate-2 addon-icon"></i>
                            <input type="text" name="language" id="language"
                                class="form-control custom-premium-input" placeholder="e.g. English">
                        </div>
                    </div>
                </div>

                <!-- Rack No -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Coordinates</label>
                        <div class="inner-addon">
                            <i class="ri-grid-fill addon-icon"></i>
                            <input type="text" name="rack_no" id="rack_no"
                                class="form-control custom-premium-input" placeholder="e.g. Rack A">
                        </div>
                    </div>
                </div>

                <!-- Shelf No -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Shelf
                            Matrix No</label>
                        <div class="inner-addon">
                            <i class="ri-align-justify addon-icon"></i>
                            <input type="text" name="shelf_no" id="shelf_no"
                                class="form-control custom-premium-input" placeholder="e.g. Shelf 04">
                        </div>
                    </div>
                </div>

                <!-- Publication Year -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Pub
                            Year</label>
                        <div class="inner-addon">
                            <i class="ri-time-zone-line addon-icon"></i>
                            <input type="number" min="1000" max="2099" name="publication_year"
                                id="publication_year" class="form-control custom-premium-input" placeholder="YYYY">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION D: QUANTITY & STOCK MATRIX -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-equalizer-line me-1"></i> Stock Ledger, Metrics & Valuation</span>
            </div>

            <div class="row gy-4 align-items-end">
                <!-- Total Pages -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Page
                            Count</label>
                        <div class="inner-addon">
                            <i class="ri-pages-line addon-icon"></i>
                            <input type="number" name="pages" id="pages"
                                class="form-control custom-premium-input" placeholder="0">
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Total
                            Quantity</label>
                        <div class="inner-addon">
                            <i class="ri-add-box-line addon-icon"></i>
                            <input type="number" name="quantity" id="quantity"
                                class="form-control custom-premium-input" value="0">
                        </div>
                    </div>
                </div>

                <!-- Purchase Price -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Purchase
                            Price</label>
                        <div class="inner-addon">
                            <i class="ri-money-dollar-box-line addon-icon"></i>
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price"
                                class="form-control custom-premium-input" value="0.00">
                        </div>
                    </div>
                </div>

                <!-- Selling Price -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Selling
                            Price</label>
                        <div class="inner-addon">
                            <i class="ri-price-tag-3-line addon-icon"></i>
                            <input type="number" step="0.01" name="selling_price" id="selling_price"
                                class="form-control custom-premium-input" value="0.00">
                        </div>
                    </div>
                </div>

                <!-- Target Class Mapping -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Class
                            Scope</label>
                        <div class="inner-addon">
                            <i class="ri-graduation-cap-line addon-icon"></i>
                            <input type="text" name="class_name" id="class_name"
                                class="form-control custom-premium-input" placeholder="e.g. Class 10">
                        </div>
                    </div>
                </div>

                <!-- Status Check -->
                <div class="col-xl-4 col-md-4">
                    <div class="premium-input-box h-100">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">Catalog
                            State <span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap gap-12">
                            <label class="platform-tab-wrapper m-0 w-100">
                                <input type="radio" name="status" id="status_active" value="1" checked>
                                <span class="platform-tile active-status-tile py-8"><i
                                        class="ri-checkbox-circle-line me-2"></i>Active</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Description / Meta -->
                <div class="col-xl-12 col-12">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Bibliographic
                            Annotations / Description Summary</label>
                        <div class="inner-addon">
                            <i class="ri-file-text-line addon-icon"></i>
                            <input type="text" name="description" id="book_description"
                                class="form-control custom-premium-input"
                                placeholder="Brief summary of the textbook contents, keywords, indices...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Panel -->
            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetBookForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Clear Configuration
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit Asset Ledger
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SECTION 2: BOTTOM PANEL - REGISTERED BOOKS MANAGEMENT GRID -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Verified Asset Matrix Ledger
            </h6>
            <p class="text-xs text-muted mb-0">System analytical auditing table showing real-time distribution metrics
            </p>
        </div>

        <!-- Live Filter Query Entry -->
        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 280px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="bookRegistrySearch"
                    class="form-control custom-premium-input registry-search-bar"
                    placeholder="Filter inventory dynamic matrix...">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive scrollable-class-registry">
            <table class="table bordered-table align-middle mb-0 text-sm">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 60px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 280px;">Asset Details</th>
                        <th scope="col" style="width: 140px;">Sys Identifiers</th>
                        <th scope="col" style="width: 130px;">Coordinates</th>
                        <th scope="col" class="text-center" style="width: 240px;">Real-time Metrics Matrix</th>
                        <th scope="col" class="text-center" style="width: 110px;">Valuation</th>
                        <th scope="col" class="text-center" style="width: 100px;">State</th>
                        <th scope="col" class="text-center" style="width: 110px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="bookRegistryTableBody">
                 
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
    <style>
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
            padding: 12px;
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
            padding-left: 42px !important;
            padding-right: 14px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 600 !important;
            height: 42px;
            font-size: 0.88rem;
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

        .platform-tab-wrapper input:checked+.platform-tile.active-status-tile {
            border-color: #22c55e;
            color: #15803d;
            background: #dcfce7;
        }

        .scrollable-class-registry {
            max-height: 520px;
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

        .radius-4 {
            border-radius: 4px;
        }

        .bg-slate-100 {
            background-color: #f1f5f9;
        }

        .text-slate-700 {
            color: #334155;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #b91c1c;
        }

        .bg-neutral-100 {
            background: #f3f4f6;
        }

        .text-neutral-700 {
            color: #374151;
        }
    </style>
@endpush


@push('script')
    <script>
        $(document).ready(function() {

            loadMasters();

            fetchLibraryBooks();

            // search

            $("#bookRegistrySearch").on("keyup", function() {

                let value = $(this).val().toLowerCase();

                $("#bookRegistryTableBody tr").filter(function() {

                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );

                });

            });

        });

        // load masters

        function loadMasters() {

            fetchCategories();
            fetchAuthors();
            fetchPublications();

        }

        // fetch books

        function fetchLibraryBooks() {

            fetchMasterData(
                "{{ route('school.library.book.fetch') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.book_name ?
                                row.book_name.substring(0, 4).toUpperCase() :
                                'BOOK';

                            let statusBadge =
                                row.status == 1 ?
                                `<span class="status-badge badge-completed">
                                <span class="pulse-dot-green"></span>
                                Catalog
                            </span>` :
                                `<span class="status-badge badge-cancelled">
                                Inactive
                            </span>`;

                            html += `
                    <tr class="book-record-row">

                        <td class="text-center fw-semibold text-muted">
                            ${index + 1}
                        </td>

                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <div class="avatar-matrix-icon">
                                    <span class="fw-bold text-xs text-gradient-primary">
                                        ${initials}
                                    </span>
                                </div>

                                <div>

                                    <span class="fw-bold text-dark-main d-block">
                                        ${row.book_name ?? '-'}
                                    </span>

                                    <small class="text-muted text-xs d-block">
                                        ${row.edition ?? '-'}
                                        ${row.volume ? ' | ' + row.volume : ''}
                                    </small>

                                    <small class="text-primary-600 text-xs fw-semibold">
                                        Lang : ${row.language ?? '-'}
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="text-xs text-dark-main fw-bold d-block">
                                Code :
                                <span class="text-primary-600">
                                    ${row.book_code ?? '-'}
                                </span>
                            </span>

                            <span class="text-xs text-muted d-block">
                                Acc : ${row.accession_no ?? '-'}
                            </span>

                            <span class="text-xs text-muted d-block">
                                ISBN : ${row.isbn_no ?? '-'}
                            </span>

                        </td>

                        <td>

                            <span class="badge bg-slate-100 text-slate-700 d-block mb-1 text-start">
                                <i class="ri-grid-line me-1"></i>
                                ${row.rack_no ?? '-'}
                            </span>

                            <span class="badge bg-slate-100 text-slate-700 d-block text-start">
                                <i class="ri-list-check me-1"></i>
                                ${row.shelf_no ?? '-'}
                            </span>

                        </td>

                        <td>

                            <div class="row g-1 text-center">

                                <div class="col-4">
                                    <div class="p-2 bg-primary-50 radius-4">
                                        TTL
                                        <b class="d-block">
                                            ${row.quantity ?? 0}
                                        </b>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="p-2 bg-success-50 radius-4">
                                        AVL
                                        <b class="d-block">
                                            ${row.available_quantity ?? row.quantity ?? 0}
                                        </b>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="p-2 bg-info-50 radius-4">
                                        ISS
                                        <b class="d-block">
                                            ${row.issued_quantity ?? 0}
                                        </b>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-2 bg-danger-50 radius-4">
                                        DMG : ${row.damaged_quantity ?? 0}
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-2 bg-neutral-100 radius-4">
                                        LST : ${row.lost_quantity ?? 0}
                                    </div>
                                </div>

                            </div>

                        </td>

                        <td class="text-end">

                            <span class="text-xs text-muted d-block">
                                P : ₹${parseFloat(row.purchase_price ?? 0).toFixed(2)}
                            </span>

                            <span class="text-xs text-success d-block fw-bold">
                                S : ₹${parseFloat(row.selling_price ?? 0).toFixed(2)}
                            </span>

                        </td>

                        <td class="text-center">
                            ${statusBadge}
                        </td>

                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-primary edit-book-trigger"
                                    data-id="${row.id}">
                                    <i class="ri-edit-box-line"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-danger deleteLibraryBook"
                                    data-id="${row.id}">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>

                            </div>

                        </td>

                    </tr>`;
                        });

                    } else {

                        html = `
                <tr>
                    <td colspan="8" class="text-center py-5">
                        No Records Found
                    </td>
                </tr>`;
                    }

                    $("#bookRegistryTableBody").html(html);

                }
            );

        }

        // edit

        $(document).on("click", ".edit-book-trigger", function() {

            let id = $(this).data("id");

            getDataById(
                "{{ route('school.library.book.get') }}",
                id,
                function(res) {


                    if (!res.status) {
                        return;
                    }

                    let row = res.data;

                    $("#book_id").val(row.id);

                    $("#book_name").val(row.book_name ?? '');
                    $("#sub_title").val(row.sub_title ?? '');

                    setTimeout(() => {

                        $(".categoryOptions").val(row.category_id);
                        $(".authorOptions").val(row.author_id);
                        $(".publicationOptions").val(row.publication_id);

                    }, 500);


                    $("#subject").val(row.subject ?? '');

                    $("#book_code").val(row.book_code ?? '');
                    $("#accession_no").val(row.accession_no ?? '');
                    $("#barcode").val(row.barcode ?? '');
                    $("#isbn_no").val(row.isbn_no ?? '');

                    $("#edition").val(row.edition ?? '');
                    $("#volume").val(row.volume ?? '');
                    $("#language").val(row.language ?? '');

                    $("#rack_no").val(row.rack_no ?? '');
                    $("#shelf_no").val(row.shelf_no ?? '');

                    $("#publication_year").val(row.publication_year ?? '');
                    $("#pages").val(row.pages ?? '');

                    $("#quantity").val(row.quantity ?? 0);

                    $("#purchase_price").val(row.purchase_price ?? 0);
                    $("#selling_price").val(row.selling_price ?? 0);

                    $("#class_name").val(row.class_name ?? '');

                    $("#book_description").val(row.description ?? '');

                    $("input[name='status'][value='" + row.status + "']")
                        .prop("checked", true);

                    $("html, body").animate({
                        scrollTop: 0
                    }, 300);

                }
            );

        });


        // reset

        $("#resetBookForm").on("click", function() {

            $("#bookRegistrationForm")[0].reset();

            $("#book_id").val('');

            $("#category_id").val('');
            $("#author_id").val('');
            $("#publication_id").val('');

            $("input[name='status'][value='1']")
                .prop("checked", true);

        });

        // category

        function fetchCategories() {

            fetchMasterData(
                "{{ route('school.library.category.fetch') }}",
                function(res) {



                    let rows = '<option value="">Select Category...</option>';

                    $.each(res.data, function(i, d) {

                        rows += `
                        <option value="${d.id}">
                            ${d.category_name}
                        </option>`;

                    });



                    $(".categoryOptions").html(rows);

                }
            );

        }

        // author

        function fetchAuthors() {

            fetchMasterData(
                "{{ route('school.library.author.fetch') }}",
                function(res) {


                    let rows = '<option value="">Select Author...</option>';

                    $.each(res.data, function(i, d) {

                        rows += `
                    <option value="${d.id}">
                        ${d.author_name}
                    </option>`;

                    });

                    $(".authorOptions").html(rows);

                }
            );

        }

        // publication

        function fetchPublications() {

            fetchMasterData(
                "{{ route('school.library.publication.fetch') }}",
                function(res) {



                    let rows = '<option value="">Select Publication...</option>';

                    $.each(res.data, function(i, d) {

                        rows += `
                    <option value="${d.id}">
                        ${d.publication_name}
                    </option>`;

                    });

                    $(".publicationOptions").html(rows);

                }
            );

        }
    </script>
@endpush
