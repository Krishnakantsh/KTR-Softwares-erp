<!-- SECTION 1: TOP PANEL - TRANSACTIONAL CIRCULATION CONSOLE -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-exchange-funds-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Book Circulation & Issuance Engine</h6>
                <p class="text-xs text-muted mb-0">Authorize book issues, track timelines, manage memberships, and compute fine structures dynamically</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-swap-box-line me-1 ripple-effect"></i> Circulation Counter Active
        </span>
    </div>

    <div class="card-body p-24">
        <form id="bookIssueForm" class="ajaxForm" data-refresh="fetchCirculationLedger" data-method="POST" autocomplete="off">
            @csrf

            <!-- Hidden Input for Editing/Updating Circulation Link -->
            <input type="hidden" name="issue_id" id="issue_id">

            <!-- SUB-SECTION A: MEMBER & ASSET TARGETING -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i class="ri-user-shared-line me-1"></i> Membership & Asset Allocation</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Book Selection -->
                <div class="col-xl-12 col-md-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Select Inventory Book <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-book-open-line addon-icon"></i>
                            <select name="book_id" id="book_id" class="form-control custom-premium-input" required style="appearance: auto;">
                                <option value="">Select Book via Title / Code...</option>
                                <!-- Dynamic dynamic loading -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Member Type Switch -->
                <div class="col-xl-6 col-md-12">
                    <div class="premium-input-box h-100">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">Member Type Scope <span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap gap-12">
                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                <input type="radio" name="member_type" id="member_student" value="student" checked>
                                <span class="platform-tile active-status-tile py-8"><i class="ri-user-4-line me-2"></i>Academic Student</span>
                            </label>
                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                <input type="radio" name="member_type" id="member_staff" value="staff">
                                <span class="platform-tile active-status-tile py-8"><i class="ri-user-star-line me-2"></i>School Staff</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Member ID Selection (Dynamic based on student/staff selection) -->
                <div class="col-xl-6 col-md-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Select Verified Member <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-id-card-line addon-icon"></i>
                            <select name="member_id" id="member_id" class="form-control custom-premium-input" required style="appearance: auto;">
                                <option value="">Select Member Profile...</option>
                                <!-- Population via Ajax dependent on Type -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION B: CHRONO TIMELINES -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i class="ri-calendar-todo-line me-1"></i> Timeline Logistics Matrix</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Issue Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Issue Timestamp <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-check-line addon-icon"></i>
                            <input type="date" name="issue_date" id="issue_date" class="form-control custom-premium-input" required value="{{ date('Y-m-day') }}">
                        </div>
                    </div>
                </div>

                <!-- Due Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Target Due Date <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-warning-line addon-icon"></i>
                            <input type="date" name="due_date" id="due_date" class="form-control custom-premium-input" required>
                        </div>
                    </div>
                </div>

                <!-- Return Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Actual Return Date</label>
                        <div class="inner-addon">
                            <i class="ri-calendar-close-line addon-icon"></i>
                            <input type="date" name="return_date" id="return_date" class="form-control custom-premium-input">
                        </div>
                    </div>
                </div>

                <!-- Issue Days Calculation -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Allocated/Total Days</label>
                        <div class="inner-addon">
                            <i class="ri-time-line addon-icon"></i>
                            <input type="number" name="issue_days" id="issue_days" class="form-control custom-premium-input" value="0" readonly style="background: #f8fafc !important;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION C: FINES & AUDITING QUANTITIES -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i class="ri-coins-line me-1"></i> Fiscal Penalty & Transaction Audit State</span>
            </div>

            <div class="row gy-4 mb-24 align-items-end">
                <!-- Base Fine Amount -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Base Fine (Excl. Tax)</label>
                        <div class="inner-addon">
                            <i class="ri-money-dollar-circle-line addon-icon"></i>
                            <input type="number" step="0.01" name="fine_amount" id="fine_amount" class="form-control custom-premium-input fine-calculator" value="0.00">
                        </div>
                    </div>
                </div>

                <!-- GST Amount -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">GST Applied Amount</label>
                        <div class="inner-addon">
                            <i class="ri-percent-line addon-icon"></i>
                            <input type="number" step="0.01" name="gst_amount" id="gst_amount" class="form-control custom-premium-input fine-calculator" value="0.00">
                        </div>
                    </div>
                </div>

                <!-- Total Fine Amount -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Total Penal Fine (Inc. Taxes)</label>
                        <div class="inner-addon">
                            <i class="ri-wallet-3-line addon-icon"></i>
                            <input type="number" step="0.01" name="total_fine_amount" id="total_fine_amount" class="form-control custom-premium-input" value="0.00" readonly style="background: #f0fdf4 !important; color: #166534 !important;">
                        </div>
                    </div>
                </div>

                <!-- Status Select -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Circulation Lifecycle State <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-git-merge-line addon-icon"></i>
                            <select name="status" id="status" class="form-control custom-premium-input" required style="appearance: auto;">
                                <option value="issued" selected>Issued (In-Hand)</option>
                                <option value="returned">Returned (Restocked)</option>
                                <option value="lost">Lost / Misplaced Asset</option>
                                <option value="damaged">Damaged / Written Off</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Remarks -->
                <div class="col-xl-12 col-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Operational Audit Remarks / Discrepancy Annotations</label>
                        <div class="inner-addon">
                            <i class="ri-chat-quote-line addon-icon"></i>
                            <input type="text" name="remarks" id="remarks" class="form-control custom-premium-input" placeholder="Type condition tracking notes, reason for late return or damage state details...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Panel -->
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

<!-- SECTION 2: BOTTOM PANEL - CIRCULATION LEDGER MATRIX -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Asset Circulation Real-time Matrix</h6>
            <p class="text-xs text-muted mb-0">Live monitoring ledger showing active handovers, delinquency indices, and dynamic fine settlements</p>
        </div>

        <!-- Live Filter Query Entry -->
        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 280px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="circulationRegistrySearch" class="form-control custom-premium-input registry-search-bar" placeholder="Filter active handovers matrix...">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive scrollable-class-registry">
            <table class="table bordered-table align-middle mb-0 text-sm">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 60px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 220px;">Book Asset</th>
                        <th scope="col" style="width: 200px;">Beneficiary Profile</th>
                        <th scope="col" style="width: 150px;">Timeline Specs</th>
                        <th scope="col" class="text-center" style="width: 120px;">Days Counter</th>
                        <th scope="col" class="text-center" style="width: 140px;">Fiscal Penalties</th>
                        <th scope="col" class="text-center" style="width: 120px;">Lifecycle State</th>
                        <th scope="col" class="text-center" style="width: 110px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="circulationRegistryTableBody">
                    <!-- Dummy Matrix Row 1 -->
                    <tr class="circulation-record-row">
                        <td class="text-center fw-semibold text-muted">1</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-matrix-icon">
                                    <span class="fw-bold text-xs text-gradient-primary">BOOK</span>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark-main d-block">Introduction to Algorithms</span>
                                    <small class="text-muted text-xs d-block">Asset ID Mapping: #14</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-dark-main d-block">Rahul Sharma</span>
                            <span class="badge bg-primary-50 text-primary-700 px-6 py-2 radius-4 text-xs font-monospace mt-2"><i class="ri-user-line me-1"></i>student</span>
                            <small class="text-muted d-block mt-2">ID Ref: #2091</small>
                        </td>
                        <td>
                            <span class="text-xs d-block text-muted">Issued: <b class="text-dark-main">2026-06-01</b></span>
                            <span class="text-xs d-block text-muted">Target Due: <b class="text-danger">2026-06-15</b></span>
                            <span class="text-xs d-block text-muted">Returned: <b class="text-success">--</b></span>
                        </td>
                        <td class="text-center font-monospace fw-semibold text-slate-700">
                            14 Days
                        </td>
                        <td class="text-center font-monospace">
                            <span class="text-xs text-muted d-block">Base: ₹0.00</span>
                            <span class="text-xs text-muted d-block">Tax: ₹0.00</span>
                            <span class="text-sm text-dark-main fw-bold d-block">Total: ₹0.00</span>
                        </td>
                        <td class="text-center">
                            <span class="status-badge badge-issued"><span class="pulse-dot-blue"></span> Issued</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-circulation-trigger"
                                    data-id="1" data-book="14" data-membertype="student" data-memberid="2091"
                                    data-issue="2026-06-01" data-due="2026-06-15" data-return="" data-days="14"
                                    data-fine="0.00" data-gst="0.00" data-totalfine="0.00" data-status="issued"
                                    data-remarks="Standard allocation sequence applied." title="Modify Transaction">
                                    <i class="ri-edit-box-line"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 delete-circulation-trigger" data-id="1" title="Purge Record">
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
<style>
    .premium-generator-card { border: 1px solid #e2e8f0; background: #ffffff; }
    .text-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .brand-pulse-icon {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        width: 38px; height: 38px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
    }
    .avatar-matrix-icon {
        width: 36px; height: 36px; border-radius: 8px;
        background: rgba(124, 58, 237, 0.08);
        display: flex; align-items: center; justify-content: center;
        border: 1px solid rgba(124, 58, 237, 0.15);
    }
    .premium-input-box {
        background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px;
        padding: 12px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01); transition: all 0.3s ease;
    }
    .premium-input-box:focus-within {
        border-color: #7c3aed; box-shadow: 0 4px 12px rgba(124, 58, 237, 0.08);
    }
    .inner-addon { position: relative; display: flex; align-items: center; width: 100%; }
    .inner-addon .addon-icon {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        font-size: 18px; color: #64748b; pointer-events: none; z-index: 10;
    }
    .premium-input-box:focus-within .addon-icon { color: #7c3aed; }
    .custom-premium-input {
        width: 100% !important; padding-left: 42px !important; padding-right: 14px !important;
        border-radius: 8px !important; border: 1px solid #cbd5e1 !important;
        font-weight: 600 !important; height: 42px; font-size: 0.88rem; color: #1e293b; background-color: #ffffff !important;
    }
    .registry-search-bar { height: 38px !important; font-size: 0.85rem !important; padding-left: 40px !important; }
    .backend-action-bar { border-top: 1px dashed #e2e8f0; padding-top: 24px; margin-top: 12px; }
    .btn-premium-action-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #ffffff !important; font-weight: 600; font-size: 0.9rem; padding: 12px 28px;
        border-radius: 8px; border: none; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.25);
        transition: all 0.25s ease-in-out; display: inline-flex; align-items: center;
    }
    .btn-premium-action-primary:hover {
        transform: translateY(-1px); box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4); filter: brightness(1.05);
    }
    .btn-premium-action-secondary {
        background: #ffffff; color: #475569 !important; font-weight: 600; font-size: 0.9rem;
        padding: 12px 24px; border-radius: 8px; border: 1px solid #cbd5e1;
        transition: all 0.2s ease; display: inline-flex; align-items: center;
    }
    .btn-premium-action-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
    .platform-tab-wrapper { cursor: pointer; position: relative; }
    .platform-tab-wrapper input { position: absolute; opacity: 0; }
    .platform-tile {
        display: flex; align-items: center; justify-content: center; padding: 10px 14px;
        border-radius: 8px; background: #f8fafc; border: 2px solid #e2e8f0;
        font-size: 0.85rem; font-weight: 700; color: #64748b; transition: all 0.2s ease; text-align: center;
    }
    .platform-tab-wrapper input:checked+.platform-tile.active-status-tile { border-color: #7c3aed; color: #7c3aed; background: #f3e8ff; }
    .scrollable-class-registry { max-height: 520px; overflow-y: auto; }
    .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; }
    
    /* Lifecycle badges color spec */
    .badge-issued { background: #eff6ff; color: #1d4ed8; }
    .pulse-dot-blue { width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; display: inline-block; }
    .radius-4 { border-radius: 4px; }
    .text-slate-700 { color: #334155; }
</style>

@push('script')
    <script>
        $(document).ready(function() {
            // Live Search Client Side Engine
            $("#circulationRegistrySearch").on("keyup", function() {
                var query = $(this).val().toLowerCase();
                $("#circulationRegistryTableBody .circulation-record-row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
                });
            });

            // Auto Calculator Logic for Penal Fines
            $(document).on('input', '.fine-calculator', function() {
                let fine = parseFloat($('#fine_amount').val()) || 0;
                let gst = parseFloat($('#gst_amount').val()) || 0;
                let total = fine + gst;
                $('#total_fine_amount').val(total.toFixed(2));
            });

            // Chrono days tracker automations between dates
            $('#issue_date, #due_date').on('change', function() {
                let start = new Date($('#issue_date').val());
                let end = new Date($('#due_date').val());
                if(start && end && end >= start) {
                    let diff = Math.floor((end - start) / (1000 * 60 * 60 * 24));
                    $('#issue_days').val(diff);
                } else {
                    $('#issue_days').val(0);
                }
            });

            // Interactive Update Routing Pipeline (Edit Link Trigger)
            $(document).on("click", ".edit-circulation-trigger", function() {
                let id = $(this).data("id");
                
                $("#issue_id").val(id);
                $("#book_id").val($(this).data("book"));
                $("#member_id").val($(this).data("memberid"));
                $("#issue_date").val($(this).data("issue"));
                $("#due_date").val($(this).data("due"));
                $("#return_date").val($(this).data("return"));
                $("#issue_days").val($(this).data("days"));
                $("#fine_amount").val($(this).data("fine"));
                $("#gst_amount").val($(this).data("gst"));
                $("#total_fine_amount").val($(this).data("totalfine"));
                $("#status").val($(this).data("status"));
                $("#remarks").val($(this).data("remarks"));

                let type = $(this).data("membertype");
                if (type === "student") {
                    $("#member_student").prop("checked", true);
                } else {
                    $("#member_staff").prop("checked", true);
                }

                $(".text-gradient-primary").text("Modify Processing Ledger Transaction");
                $("html, body").animate({ scrollTop: 0 }, "fast");
            });

            // Form Resets Pipelining
            $("#resetCirculationForm").on("click", function() {
                $("#issue_id").val("");
                $("#bookIssueForm")[0].reset();
                $(".text-gradient-primary").text("Book Circulation & Issuance Engine");
            });
        });
    </script>
@endpush