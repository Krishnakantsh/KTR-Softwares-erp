<!-- SECTION 1: TOP PANEL - TRANSACTIONAL CIRCULATION CONSOLE -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-exchange-funds-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Book Circulation & Issuance Engine</h6>
                <p class="text-xs text-muted mb-0">Authorize book issues, track timelines, manage memberships, and
                    compute fine structures dynamically</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-swap-box-line me-1 ripple-effect"></i> Circulation Counter Active
        </span>
    </div>

    <div class="card-body p-24">
        <form id="bookIssueForm" class="ajaxForm" data-url="{{ route('school.library.book_issue.save') }}" data-method="POST"
            autocomplete="off">
            @csrf

            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-user-shared-line me-1"></i> Membership & Asset Allocation</span>
            </div>

            <div class="row gy-4 mb-24">
                <div class="col-md-12">
                    <div class="row mb-24 gy-4">
                        <div class="col-md-6 mb-4">
                            <div class="row">
                                <!-- Book Selection (Half Width) -->
                                <div class="col-md-12 mb-16">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Select
                                            Inventory Book <span class="text-danger">*</span></label>
                                        <div class="inner-addon">
                                            <i class="ri-book-open-line addon-icon"></i>
                                            <select name="book_id" id="book_ids"
                                                class="form-control custom-premium-input" required
                                                style="appearance: auto;">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Member Type Switch -->
                                <div class="col-md-12 mb-16">
                                    <div class="premium-input-box h-100">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">Member
                                            Type Scope <span class="text-danger">*</span></label>
                                        <div class="d-flex flex-wrap gap-12">
                                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                                <input type="radio" name="member_type" id="member_student"
                                                    value="student" checked>
                                                <span class="platform-tile active-status-tile py-8"><i
                                                        class="ri-user-4-line me-2"></i>Academic Student</span>
                                            </label>
                                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                                <input type="radio" name="member_type" id="member_staff"
                                                    value="staff">
                                                <span class="platform-tile active-status-tile py-8"><i
                                                        class="ri-user-star-line me-2"></i>School Staff</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Member ID Selection -->
                                <div class="col-md-12 ">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Select
                                            Verified Member <span class="text-danger">*</span></label>
                                        <div class="inner-addon">
                                            <i class="ri-id-card-line addon-icon"></i>
                                            <select name="member_id" id="member_id"
                                                class="form-control custom-premium-input" required
                                                style="appearance: auto;">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="scanner-panel">
                                <div class="premium-input-box scan-active-zone mb-12">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block d-flex justify-content-between align-items-center">
                                        <span>Automated Barcode Scanner</span>
                                        <span
                                            class="badge bg-success-50 text-success-700 border border-success-200 text-xxs px-6 py-2 radius-4 laser-pulse"><i
                                                class="ri-radar-line"></i> Ready to Scan</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-barcode-box-line addon-icon text-violet"></i>
                                        <input type="text" id="barcodeReaderStream"
                                            class="form-control custom-premium-input barcode-pulse-input"
                                            placeholder="Focus cursor here & scan book barcode strip...">
                                        <button type="button" id="startScannerBtn" class="btn btn-scan-addon"
                                            title="Toggle Camera Reader">
                                            <i class="ri-camera-lens-line"></i>
                                        </button>
                                    </div>
                                </div>


                                <div id="reader"></div>
                                {{-- 
                                <div id="bookPreview" class="d-none mt-3">
                                    <img id="bookCover" src="" class="img-fluid rounded shadow-sm w-100">

                                    <div class="mt-2">
                                        <h6 id="bookTitle"></h6>
                                        <small id="bookAuthor"></small>
                                    </div>
                                </div> --}}

                            </div>
                        </div>

                    </div>
                </div>




            </div>

            <!-- SUB-SECTION B: CHRONO TIMELINES -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-calendar-todo-line me-1"></i> Timeline Logistics Matrix</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Issue Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Issue
                            Timestamp <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-check-line addon-icon"></i>
                            <input type="date" name="issue_date" id="issue_date"
                                class="form-control custom-premium-input" required value="{{ date('Y-m-day') }}">
                        </div>
                    </div>
                </div>

                <!-- Due Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Target
                            Due Date <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-warning-line addon-icon"></i>
                            <input type="date" name="due_date" id="due_date"
                                class="form-control custom-premium-input" required>
                        </div>
                    </div>
                </div>

                <!-- Return Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Actual
                            Return Date</label>
                        <div class="inner-addon">
                            <i class="ri-calendar-close-line addon-icon"></i>
                            <input type="date" name="return_date" id="return_date"
                                class="form-control custom-premium-input">
                        </div>
                    </div>
                </div>

                <!-- Issue Days Calculation -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Allocated/Total
                            Days</label>
                        <div class="inner-addon">
                            <i class="ri-time-line addon-icon"></i>
                            <input type="number" name="issue_days" id="issue_days"
                                class="form-control custom-premium-input" value="0" readonly
                                style="background: #f8fafc !important;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION C: FINES & AUDITING QUANTITIES -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-coins-line me-1"></i> Fiscal Penalty & Transaction Audit State</span>
            </div>

            <div class="row gy-4 mb-24 align-items-end">
                <!-- Base Fine Amount -->
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Base
                            Fine (Excl. Tax)</label>
                        <div class="inner-addon">
                            <i class="ri-money-dollar-circle-line addon-icon"></i>
                            <input type="number" step="0.01" name="fine_amount" id="fine_amount"
                                class="form-control custom-premium-input fine-calculator" value="0.00">
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">GST
                            Applied Amount</label>
                        <div class="inner-addon">
                            <i class="ri-percent-line addon-icon"></i>
                            <input type="number" step="0.01" name="gst_amount" id="gst_amount"
                                class="form-control custom-premium-input fine-calculator" value="0.00">
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Total
                            Penal Fine </label>
                        <div class="inner-addon">
                            <i class="ri-wallet-3-line addon-icon"></i>
                            <input type="number" step="0.01" name="total_fine_amount" id="total_fine_amount"
                                class="form-control custom-premium-input" value="0.00" readonly
                                style="background: #f0fdf4 !important; color: #166534 !important;">
                        </div>
                    </div>
                </div>


                <div class="col-xl-5 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Circulation
                            Lifecycle State <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-git-merge-line addon-icon"></i>
                            <select name="status" id="status" class="form-control custom-premium-input" required
                                style="appearance: auto;">
                                <option value="issued" selected>Issued (In-Hand)</option>
                                <option value="returned">Returned (Restocked)</option>
                                <option value="lost">Lost / Misplaced Asset</option>
                                <option value="damaged">Damaged / Written Off</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-xl-7 col-12">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Operational
                            Audit Remarks / Discrepancy Annotations</label>
                        <div class="inner-addon">
                            <i class="ri-chat-quote-line addon-icon"></i>
                            <input type="text" name="remarks" id="remarks"
                                class="form-control custom-premium-input"
                                placeholder="Type condition tracking notes, reason for late return or damage state details...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetCirculationForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Clear Configuration
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit Lifecycle Record
                </button>
            </div>
        </form>
    </div>
</div>



<div id="barcodeAssetDrawer" class="asset-sliding-drawer">
    <div class="drawer-overlay"></div>
    <div class="drawer-content-panel">

        <div class="drawer-header-panel d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="scan-success-badge-icon">
                    <i class="ri-checkbox-circle-fill text-xl text-emerald"></i>
                </div>
                <div>
                    <h5 class="text-md fw-bold mb-0 text-white">Barcode Asset Captured</h5>
                    <p class="text-xxs text-slate-300 mb-0 font-monospace" id="scannedIsbnLabel">
                        ISBN: <span id="drawerIsbnNo">9780262033848</span> | Code: <span
                            id="drawerBookCode">BC-1001</span>
                    </p>
                </div>
            </div>
            <button type="button" class="btn-close-drawer" id="closeScanDrawerBtn">
                <i class="ri-close-line"></i>
            </button>


        </div>

        <div class="drawer-body-panel">

            <div class="asset-main-info-card p-16 radius-12 mb-16 bg-slate-900 border border-slate-800">
                <div class="d-flex align-items-start justify-content-between mb-8">
                    <div>
                        <span class="badge bg-purple-500 text-white text-xxs px-8 py-2 radius-4 mb-8"
                            id="drawerBookCategory">Computer Science</span>
                        <span id="drawerAvailabilityStatus" class="badge bg-success-50 text-success-600">
                            Available
                        </span>
                        <h4 class="text-md fw-bold text-white mb-4" id="drawerBookTitle">Introduction to Algorithms
                        </h4>
                        <p class="text-xs text-slate-400 mb-0" id="drawerBookSubTitle">Extended Multi-core Edition</p>
                    </div>
                </div>

                <div class="row g-2 mt-8 border-top border-slate-800 pt-12">
                    <div class="col-6">
                        <small class="text-xxs text-slate-400 d-block">Accession No:</small>
                        <span class="text-xs text-white font-monospace fw-semibold"
                            id="drawerAccessionNo">ACC-8849</span>
                    </div>
                    <div class="col-6">
                        <small class="text-xxs text-slate-400 d-block">Barcode:</small>
                        <span class="text-xs text-white font-monospace fw-semibold"
                            id="drawerBarcode">BAR-99231</span>
                    </div>
                </div>
            </div>

            <div class="asset-meta-data-card p-16 radius-12 mb-16">
                <h6 class="text-xs fw-bold text-uppercase  text-white tracking-wider mb-12">
                    <i class="ri-information-line me-1"></i> Catalog Information
                </h6>

                <div class="meta-row mb-8">
                    <span class="meta-label">Author:</span>
                    <span class="meta-value text-slate-200" id="drawerBookAuthor">Thomas H. Cormen</span>
                </div>
                <div class="meta-row mb-8">
                    <span class="meta-label">Subject / Class:</span>
                    <span class="meta-value text-slate-200"><span id="drawerSubject">Algorithms</span> (<span
                            id="drawerClassName">B.Tech CS</span>)</span>
                </div>
                <div class="meta-row mb-8">
                    <span class="meta-label">Edition / Volume:</span>
                    <span class="meta-value text-slate-200">Ed: <span id="drawerEdition">4th</span> | Vol: <span
                            id="drawerVolume">Vol 1</span></span>
                </div>
                <div class="meta-row mb-8">
                    <span class="meta-label">Publisher & Year:</span>
                    <span class="meta-value text-slate-200"><span id="drawerPublication">MIT Press</span> (<span
                            id="drawerPubYear">2024</span>)</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Language / Pages:</span>
                    <span class="meta-value text-slate-200"><span id="drawerLanguage">English</span> / <span
                            id="drawerPages">1292</span> pgs</span>
                </div>
            </div>

            <div class="asset-meta-data-card p-16 radius-12 mb-16">
                <h6 class="text-xs fw-bold text-uppercase text-white tracking-wider mb-12">
                    <i class="ri-stack-line me-1"></i> Stock & Inventory Status
                </h6>

                <div class="row g-2 mb-12 text-center">
                    <div class="col-4">
                        <div class="p-8 bg-slate-900 radius-8 border border-slate-800">
                            <small class="text-xxs text-slate-400 d-block">Total Stock</small>
                            <span class="text-sm fw-bold text-white" id="drawerQtyTotal">10</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-8 bg-slate-900 radius-8 border border-slate-800">
                            <small class="text-xxs text-emerald d-block">Available</small>
                            <span class="text-sm fw-bold text-emerald" id="drawerQtyAvailable">8</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-8 bg-slate-900 radius-8 border border-slate-800">
                            <small class="text-xxs text-purple-400 d-block">Issued</small>
                            <span class="text-sm fw-bold text-purple-400" id="drawerQtyIssued">2</span>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-12 text-center">
                    <div class="col-6">
                        <div class="p-6 bg-slate-900 radius-8 border border-slate-800">
                            <small class="text-xxs text-danger d-block">Damaged: <span class="fw-bold text-white"
                                    id="drawerQtyDamaged">0</span></small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-6 bg-slate-900 radius-8 border border-slate-800">
                            <small class="text-xxs text-warning d-block">Lost: <span class="fw-bold text-white"
                                    id="drawerQtyLost">0</span></small>
                        </div>
                    </div>
                </div>

                <div class="meta-row">
                    <span class="meta-label">Location (Rack/Shelf):</span>
                    <span class="text-warning fw-semibold font-monospace" id="drawerBookLocation">
                        Rack: <span id="drawerRackNo">B-02</span> - Shelf: <span id="drawerShelfNo">04</span>
                    </span>
                </div>
            </div>

            <div class="asset-meta-data-card p-16 radius-12 mb-16">
                <h6 class="text-xs fw-bold text-uppercase text-slate-400 tracking-wider mb-12">
                    <i class="ri-money-dollar-circle-line me-1"></i> Commercial Valuation
                </h6>
                <div class="row">
                    <div class="col-6">
                        <span class="meta-label d-block text-xxs mb-2">Purchase Price:</span>
                        <span class="text-sm fw-bold text-slate-300 font-monospace"
                            id="drawerPurchasePrice">₹1,250.00</span>
                    </div>
                    <div class="col-6">
                        <span class="meta-label d-block text-xxs mb-2">Selling/Fine Value:</span>
                        <span class="text-sm fw-bold text-slate-300 font-monospace"
                            id="drawerSellingPrice">₹1,500.00</span>
                    </div>
                </div>
            </div>

            {{-- <div class="alert-verification-box p-12 radius-8 mb-24 bg-slate-900 border border-slate-800">
                <div class="d-flex gap-2">
                    <i class="ri-shield-check-line text-lg text-emerald"></i>
                    <div>
                        <span class="text-xs fw-bold text-slate-200 d-block">Automated Validation Check passed</span>
                        <small class="text-xxs text-slate-400">Asset holds no current locks, suspensions, or reservation discrepancies.</small>
                    </div>
                </div>
            </div> --}}

        </div>

        <div class="drawer-footer-panel">
            <button type="button" id="acceptScannedAssetTrigger" class="btn btn-drawer-accept-primary w-100">
                <i class="ri-check-double-line me-2"></i> Accept Details & Inject Asset
            </button>
        </div>
    </div>
</div>

<!-- HIGH-END UPDATED & NEW COMPONENT STYLING -->
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

    /* NEW: Barcode Specific Elements Styles */
    .scan-active-zone {
        border: 1px dashed #7c3aed;
        background: #fafafa;
    }

    .barcode-pulse-input {
        font-family: monospace !important;
        letter-spacing: 1px;
        color: #4f46e5 !important;
    }

    .btn-scan-addon {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        height: 30px;
        width: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #475569;
        transition: all 0.2s;
    }

    .btn-scan-addon:hover {
        background: #7c3aed;
        color: #fff;
        border-color: #7c3aed;
    }

    .laser-pulse {
        animation: scanLaserEffect 2s infinite ease-in-out;
    }

    @keyframes scanLaserEffect {

        0%,
        100% {
            opacity: 0.6;
        }

        50% {
            opacity: 1;
            transform: scale(1.02);
        }
    }

    .text-violet {
        color: #7c3aed !important;
    }

    /* NEW: Premium Right Side Sliding Drawer Panel Architecture CSS */
    .asset-sliding-drawer {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 9999;
        visibility: hidden;
        pointer-events: none;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .asset-sliding-drawer.drawer-open {
        visibility: visible;
        pointer-events: auto;
    }

    .drawer-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(4px);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .asset-sliding-drawer.drawer-open .drawer-overlay {
        opacity: 1;
    }

    .drawer-content-panel {
        position: absolute;
        top: 0;
        right: -420px;
        bottom: 0;
        width: 400px;
        background: #0f172a;
        box-shadow: -10px 0 40px rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        border-left: 1px solid #334155;
    }

    .asset-sliding-drawer.drawer-open .drawer-content-panel {
        right: 0;
    }

    .drawer-header-panel {
        padding: 20px 24px;
        border-bottom: 1px solid #1e293b;
        background: #1e293b;
    }

    .scan-success-badge-icon {
        width: 32px;
        height: 32px;
        background: rgba(16, 185, 129, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .text-emerald {
        color: #10b981 !important;
    }

    .btn-close-drawer {
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 22px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .btn-close-drawer:hover {
        color: #ffffff;
    }

    .drawer-body-panel {
        padding: 24px;
        flex-grow: 1;
        overflow-y: auto;
    }

    /* Book cover 3D glassmorphism reflection effects */
    .book-artwork-stage {
        position: relative;
        width: 140px;
        height: 200px;
        margin: 0 auto;
        perspective: 1000px;
    }

    .premium-book-cover-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 4px 6px 18px rgba(0, 0, 0, 0.4), 0 0 20px rgba(124, 58, 237, 0.15);
        transform: rotateY(-8deg);
        transition: transform 0.5s;
        z-index: 2;
        position: relative;
    }

    .book-artwork-stage:hover .premium-book-cover-img {
        transform: rotateY(0deg) scale(1.03);
    }

    .artwork-glow-backdrop {
        position: absolute;
        top: 10%;
        left: 10%;
        width: 80%;
        height: 80%;
        background: radial-gradient(circle, rgba(124, 58, 237, 0.4) 0%, rgba(0, 0, 0, 0) 70%);
        filter: blur(15px);
        z-index: 1;
        pointer-events: none;
    }

    .asset-meta-data-card {
        background: #1e293b;
        border: 1px solid #334155;
    }

    .meta-row {
        display: flex;
        border-bottom: 1px solid #334155;
        padding-bottom: 8px;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .meta-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .meta-label {
        color: #94a3b8;
        width: 110px;
        flex-shrink: 0;
        font-weight: 500;
    }

    .meta-value {
        color: #e2e8f0;
    }

    .drawer-footer-panel {
        padding: 20px 24px;
        background: #1e293b;
        border-top: 1px solid #334155;
    }

    .btn-drawer-accept-primary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        transition: all 0.2s ease;
    }

    .btn-drawer-accept-primary:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
    }

    /* Basic styles retaining balance */
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
        border-color: #7c3aed;
        color: #7c3aed;
        background: #f3e8ff;
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

    .badge-issued {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .pulse-dot-blue {
        width: 6px;
        height: 6px;
        background: #1d4ed8;
        border-radius: 50%;
        display: inline-block;
    }

    .radius-4 {
        border-radius: 4px;
    }

    .text-slate-700 {
        color: #334155;
    }

    .scanner-panel {
        height: 100%;
        min-height: 320px;
        border: 1px dashed #7c3aed;
        border-radius: 12px;
        padding: 15px;
        background: #fafafa;
    }

    #reader {
        height: 200px;
        border-radius: 20px;
        overflow: hidden;
    }

    #bookPreview img {
        height: 180px;
        object-fit: cover;
    }
</style>

@push('script')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        $(document).ready(function() {


            let scanner = null;
            let temporaryScannedAsset = null;
            let libraryBooks = [];

            $('#startScannerBtn').on('click', function() {

                if (scanner) {
                    return;
                }

                scanner = new Html5Qrcode("reader");

                scanner.start({
                        facingMode: "environment"
                    }, {
                        fps: 30,
                        qrbox: 250
                    },
                    function(decodedText) {

                        scanner.stop().then(() => {

                            console.log("Scanned text : ", decodedText);

                            executeBarcodeDataPipeline(decodedText);
                        });

                    }

                );

            });


            $(document).on('input', '.fine-calculator', function() {
                let fine = parseFloat($('#fine_amount').val()) || 0;
                let gst = parseFloat($('#gst_amount').val()) || 0;
                let total = fine + gst;
                $('#total_fine_amount').val(total.toFixed(2));
            });


            $('#issue_date, #due_date').on('change', function() {
                let start = new Date($('#issue_date').val());
                let end = new Date($('#due_date').val());
                if (start && end && end >= start) {
                    let diff = Math.floor((end - start) / (1000 * 60 * 60 * 24));
                    $('#issue_days').val(diff);
                } else {
                    $('#issue_days').val(0);
                }
            });

            // $("#barcodeReaderStream").on("change", function() {
            //     let barcodeVal = $(this).val().trim();
            //     if (barcodeVal.length > 4) {
            //         executeBarcodeDataPipeline(barcodeVal);
            //     }
            // });

            function executeBarcodeDataPipeline(barcode) {

                console.log("scanned text from  executeBarcodeDataPipeline method : ", barcode);

                $.ajax({

                    url: "{{ route('school.library.book.get_book_by_barcode_token') }}",
                    method: "POST",
                    data: {
                        'barcode_token': barcode,
                    },
                    success: function(res) {

                        console.log("apply data : ", res);

                        let resp = res.data[0];

                        if (res.status) {
                            openBookDrawer(resp);
                        }

                    }
                });

            }


            $("#closeScanDrawerBtn, .drawer-overlay").on("click", function() {
                $("#barcodeAssetDrawer").removeClass("drawer-open");
                $("#barcodeReaderStream").val("").focus();
            });

            // ACTION: Accept Details and Inject Asset Into Current Session Form
            $("#acceptScannedAssetTrigger").on("click", function() {

                if (temporaryScannedAsset) {

                    $("#book_ids")
                        .val(temporaryScannedAsset.id)
                        .trigger('change.select2');

                    $("#barcodeAssetDrawer").removeClass("drawer-open");

                }

            });


            // Form Resets Pipelining
            $("#resetCirculationForm").on("click", function() {
                $("#issue_id").val("");
                $("#bookIssueForm")[0].reset();
                $(".text-gradient-primary").text("Book Circulation & Issuance Engine");
            });

            fetchLibraryMembers();

            function fetchLibraryMembers() {

                fetchMasterData(
                    "{{ route('school.library.membership.fetch.with') }}",
                    function(res) {

                        let html = '';

                        if (res.status && res.data.length > 0) {

                            let data = res.data;



                            html += `
                               <option value="">Select Member Profile...</option>
                            `;



                            $.each(data, function(index, row) {

                                let activation_date = formatDate(row.expiry_date, 'short');

                                html += `
                                
                                   <option value="${row.id}" >${row.student?.first_name} ${row.student?.last_name}</option>
                            `;
                            });

                        } else {

                            html += `
                                 <option value="">No Records Found</option>
                        
                        `;
                        }

                        $("#member_id").html(html);

                    }
                );
            }
            fetchLibraryBooks();

            function fetchLibraryBooks() {

                fetchMasterData(
                    "{{ route('school.library.book.fetch.with') }}",
                    function(res) {

                        let html = '';

                        if (res.status && res.data.length > 0) {

                            let data = res.data;

                            libraryBooks = data;

                            html += `<option value="">Select Book Title...</option>`;

                            $.each(data, function(index, row) {

                                html += `
                                <option value="${row.id}">
                                    ${row.book_name}
                                </option>
                                `;

                            });

                        } else {

                            html += `
                                 <option value="">No Records Found</option>
                        
                        `;
                        }

                        $("#book_ids").html(html);

                    }
                );
            }



            function openBookDrawer(book) {

                temporaryScannedAsset = book;

                // header
                $("#drawerBookTitle").text(book.book_name || '');
                $("#drawerBookSubTitle").text(book.sub_title || book.description || '');
                $("#drawerBookCategory").text(book.category?.category_name || '');

                $("#drawerIsbnNo").text(book.isbn_no || '');
                $("#drawerBookCode").text(book.book_code || '');

                // basic
                $("#drawerAccessionNo").text(book.accession_no || '');
                $("#drawerBarcode").text(book.barcode || '');

                // catalog info
                $("#drawerBookAuthor").text(book.author?.author_name || '');
                $("#drawerSubject").text(book.subject || '');
                $("#drawerClassName").text(book.class_name || '');

                $("#drawerEdition").text(book.edition || '');
                $("#drawerVolume").text(book.volume || '');

                $("#drawerPublication").text(book.publication?.publication_name || '');
                $("#drawerPubYear").text(book.publication_year || '');

                $("#drawerLanguage").text(book.language || '');
                $("#drawerPages").text(book.pages || 0);

                // stock
                $("#drawerQtyTotal").text(book.quantity || 0);
                $("#drawerQtyAvailable").text(book.available_quantity || 0);
                $("#drawerQtyIssued").text(book.issued_quantity || 0);
                $("#drawerQtyDamaged").text(book.damaged_quantity || 0);
                $("#drawerQtyLost").text(book.lost_quantity || 0);

                // location
                $("#drawerRackNo").text(book.rack_no || '');
                $("#drawerShelfNo").text(book.shelf_no || '');

                // prices
                $("#drawerPurchasePrice").text(
                    "₹" + Number(book.purchase_price || 0).toFixed(2)
                );

                $("#drawerSellingPrice").text(
                    "₹" + Number(book.selling_price || 0).toFixed(2)
                );

                if (book.available_quantity > 0) {

                    $("#drawerAvailabilityStatus")
                        .removeClass()
                        .addClass("badge bg-success-50 text-success-600")
                        .text("Available");

                } else {

                    $("#drawerAvailabilityStatus")
                        .removeClass()
                        .addClass("badge bg-danger-50 text-danger-600")
                        .text("Out of Stock");

                }
                // open drawer
                $("#barcodeAssetDrawer").addClass("drawer-open");
            }




            $("#book_ids").on("change", function() {

                let id = $(this).val();

                if (id == '')
                    return;

                let book = libraryBooks.find(x => x.id == id);

                if (book) {
                    openBookDrawer(book);
                }

            });
        });
    </script>
@endpush
