<!-- SECTION 1: TOP PANEL - TRANSACTIONAL CIRCULATION CONSOLE -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <!-- MASTER CONSOLE HEADER -->
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-exchange-funds-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary" id="circulation_console_title">Book Circulation Management Engine</h6>
                <p class="text-xs text-muted mb-0">Process high-speed allocations, reverse book returns, authorize timeline extensions, and collect penal fines.</p>
            </div>
        </div>
        
        <!-- HIGH-END WORKFLOW SWITCH NAVIGATION -->
        <div class="d-flex bg-slate-100 p-4 radius-10 border border-slate-200 shadow-inner">
            <button type="button" class="btn btn-sm px-16 py-8 radius-8 workflow-nav-btn active-workflow" data-mode="issue">
                <i class="ri-book-mark-line me-1"></i> New Issue
            </button>
            <button type="button" class="btn btn-sm px-16 py-8 radius-8 workflow-nav-btn" data-mode="return">
                <i class="ri-arrow-go-back-line me-1"></i> Return Processing
            </button>
            <button type="button" class="btn btn-sm px-16 py-8 radius-8 workflow-nav-btn" data-mode="renew">
                <i class="ri-refresh-line me-1"></i> Renew Extension
            </button>
        </div>
    </div>

    <div class="card-body p-24">
        <form id="bookCirculationMasterForm" class="ajaxForm" data-refresh="fetchCirculationLedger" data-method="POST" autocomplete="off">
            @csrf

            <!-- SYSTEM STATE REGULATORS -->
            <input type="hidden" name="issue_id" id="issue_id">
            <input type="hidden" name="transaction_mode" id="transaction_mode" value="issue">

            <!-- METADATA INFORMATION STRIP -->
            <div id="workflow_strip" class="alert alert-primary d-flex align-items-center gap-12 border-0 radius-10 mb-24 py-12 px-16 transition-all">
                <i class="ri-checkbox-circle-fill text-lg"></i>
                <div class="text-xs fw-semibold" id="workflow_strip_msg">Standard distribution engine active. Fill asset parameters below to authorize book allocation.</div>
            </div>

            <!-- SUB-SECTION A: BENEFIARY & ASSET ROUTING -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i class="ri-user-shared-line me-1"></i> Target Asset & Membership Profiling</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Book Selector -->
                <div class="col-xl-12 col-md-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Inventory Book Identity <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-book-open-line addon-icon"></i>
                            <select name="book_id" id="book_id" class="form-control custom-premium-input" required style="appearance: auto;">
                                <option value="">Select Target Book Profile via Title / Barcode Code...</option>
                                <!-- Async data target populator -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Membership Classification -->
                <div class="col-xl-6 col-md-12">
                    <div class="premium-input-box h-100">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">Scope Group <span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap gap-12">
                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                <input type="radio" name="member_type" id="member_student" value="student" checked>
                                <span class="platform-tile active-status-tile py-8"><i class="ri-user-4-line me-2"></i>Academic Student</span>
                            </label>
                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                <input type="radio" name="member_type" id="member_staff" value="staff">
                                <span class="platform-tile active-status-tile py-8"><i class="ri-user-star-line me-2"></i>Institutional Staff</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Verified Member Select -->
                <div class="col-xl-6 col-md-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Select Verified Target Beneficiary <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-id-card-line addon-icon"></i>
                            <select name="member_id" id="member_id" class="form-control custom-premium-input" required style="appearance: auto;">
                                <option value="">Select Beneficiary Identifier...</option>
                                <!-- Populated dynamically -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION B: LOGISTICS & TEMPORAL HORIZONS -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i class="ri-calendar-todo-line me-1"></i> Operational Logistics & Chrono Timelines</span>
            </div>

            <div class="row gy-4 mb-24">
                <!-- Issue/Origin Timestamp -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block" id="lbl_issue_date">Allocation Timestamp</label>
                        <div class="inner-addon">
                            <i class="ri-calendar-check-line addon-icon"></i>
                            <input type="date" name="issue_date" id="issue_date" class="form-control custom-premium-input" required value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <!-- Target Expiry/Due Date -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box" id="wrapper_due_date">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block" id="lbl_due_date">Target Due Date <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-warning-line addon-icon"></i>
                            <input type="date" name="due_date" id="due_date" class="form-control custom-premium-input" required>
                        </div>
                    </div>
                </div>

                <!-- Reverse Return Date Entry -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box opacity-50" id="wrapper_return_date" style="background: #f8fafc;">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-slate-500 mb-8 d-block" id="lbl_return_date">Actual Return Check-in</label>
                        <div class="inner-addon">
                            <i class="ri-calendar-close-line addon-icon"></i>
                            <input type="date" name="return_date" id="return_date" class="form-control custom-premium-input" disabled>
                        </div>
                    </div>
                </div>

                <!-- Quantum Computation Counter (Days Tracker) -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block" id="lbl_days_counter">Allocated Scope Tenure</label>
                        <div class="inner-addon">
                            <i class="ri-time-line addon-icon"></i>
                            <input type="number" name="issue_days" id="issue_days" class="form-control custom-premium-input font-monospace" value="0" readonly style="background: #f1f5f9 !important;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION C: PENAL OVERDUE STRUCTURES -->
            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i class="ri-coins-line me-1"></i> Financial Penalty Ledger & Discrepancy Auditing</span>
            </div>

            <div class="row gy-4 mb-24 align-items-end">
                <!-- Base Fine Amount -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Base Fine Quantum (Net)</label>
                        <div class="inner-addon">
                            <i class="ri-money-dollar-circle-line addon-icon"></i>
                            <input type="number" step="0.01" name="fine_amount" id="fine_amount" class="form-control custom-premium-input fine-calculator" value="0.00">
                        </div>
                    </div>
                </div>

                <!-- GST Amount -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Assessed Regulatory GST</label>
                        <div class="inner-addon">
                            <i class="ri-percent-line addon-icon"></i>
                            <input type="number" step="0.01" name="gst_amount" id="gst_amount" class="form-control custom-premium-input fine-calculator" value="0.00">
                        </div>
                    </div>
                </div>

                <!-- Total Fine Amount -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Aggregate Total fine (Gross)</label>
                        <div class="inner-addon">
                            <i class="ri-wallet-3-line addon-icon"></i>
                            <input type="number" step="0.01" name="total_fine_amount" id="total_fine_amount" class="form-control custom-premium-input fw-bold" value="0.00" readonly style="background: #f8fafc !important;">
                        </div>
                    </div>
                </div>

                <!-- Status Lifecycle State -->
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Lifecycle Asset State <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-git-merge-line addon-icon"></i>
                            <select name="status" id="status" class="form-control custom-premium-input" required style="appearance: auto;">
                                <option value="issued" selected>Issued (Out-of-Store)</option>
                                <option value="returned">Returned (Restocked Audit Passed)</option>
                                <option value="lost">Lost / Structural Asset Void</option>
                                <option value="damaged">Damaged / Marked for Maintenance</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Custom Remarks -->
                <div class="col-xl-12 col-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Logistics Discrepancy & Condition Remarks</label>
                        <div class="inner-addon">
                            <i class="ri-chat-quote-line addon-icon"></i>
                            <input type="text" name="remarks" id="remarks" class="form-control custom-premium-input" placeholder="Append transaction conditions, physical evaluation flags, or processing context details...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- EXECUTION DASHBOARD FOOTER -->
            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetMasterCirculationForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Reset State
                </button>
                <button type="submit" class="btn btn-premium-action-primary" id="master_submit_btn">
                    <i class="ri-save-3-line me-2"></i> Commit Distribution Record
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SECTION 2: BOTTOM PANEL - MATRIX VIEW -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Asset Circulation Registry Ledger</h6>
            <p class="text-xs text-muted mb-0">Live transaction grid displaying historical logs, operational deadlines, and execution hooks.</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 280px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="circulationRegistrySearch" class="form-control custom-premium-input registry-search-bar" placeholder="Query registry parameters...">
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
                        <th scope="col" class="text-center" style="width: 120px;">Status</th>
                        <th scope="col" class="text-center" style="width: 200px;">Operations Gateway</th>
                    </tr>
                </thead>
                <tbody id="circulationRegistryTableBody">
                    <tr class="circulation-record-row">
                        <td class="text-center fw-semibold text-muted">1</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-matrix-icon"><span class="fw-bold text-xs text-gradient-primary">BOOK</span></div>
                                <div>
                                    <span class="fw-bold text-dark-main d-block">Introduction to Algorithms</span>
                                    <small class="text-muted text-xs d-block">Asset ID: #14</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-dark-main d-block">Rahul Sharma</span>
                            <span class="badge bg-primary-50 text-primary-700 px-6 py-2 radius-4 text-xs font-monospace mt-2">student</span>
                            <small class="text-muted d-block mt-2">ID: #2091</small>
                        </td>
                        <td>
                            <span class="text-xs d-block text-muted">Issued: <b class="text-dark-main">2026-06-01</b></span>
                            <span class="text-xs d-block text-muted">Target Due: <b class="text-danger">2026-06-15</b></span>
                        </td>
                        <td class="text-center font-monospace fw-semibold text-slate-700">14 Days</td>
                        <td class="text-center font-monospace text-xs">Total: ₹0.00</td>
                        <td class="text-center"><span class="status-badge badge-issued"><span class="pulse-dot-blue"></span> Issued</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-xs btn-success d-inline-flex align-items-center gap-1 inline-return-trigger"
                                    data-id="1" data-book="14" data-membertype="student" data-memberid="2091" data-issue="2026-06-01" data-due="2026-06-15">
                                    <i class="ri-arrow-go-back-line"></i> Return
                                </button>
                                <button type="button" class="btn btn-xs btn-warning text-dark d-inline-flex align-items-center gap-1 inline-renew-trigger"
                                    data-id="1" data-book="14" data-membertype="student" data-memberid="2091" data-issue="2026-06-01" data-due="2026-06-15">
                                    <i class="ri-refresh-line"></i> Renew
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-primary py-4 px-8 master-edit-trigger"
                                    data-id="1" data-book="14" data-membertype="student" data-memberid="2091" data-issue="2026-06-01" data-due="2026-06-15" data-return="" data-days="14" data-fine="0.00" data-gst="0.00" data-totalfine="0.00" data-status="issued" data-remarks="Standard allocation sequence applied.">
                                    <i class="ri-edit-box-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-slate-100 { background-color: #f1f5f9; }
    .border-slate-200 { border-color: #e2e8f0; }
    .shadow-inner { box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); }
    .radius-10 { border-radius: 10px; }
    .workflow-nav-btn { background: transparent; border: none; font-weight: 700; color: #64748b; font-size: 0.825rem; transition: all 0.2s; }
    .workflow-nav-btn:hover { color: #1e293b; background: rgba(0,0,0,0.03); }
    .workflow-nav-btn.active-workflow { background: #ffffff !important; color: #7c3aed !important; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .btn-xs { padding: 4px 8px; font-size: 11px; font-weight: 700; border-radius: 6px; border: none; }
    .btn-success { background-color: #10b981; color: white; }
    .btn-warning { background-color: #f59e0b; color: white; }
</style>

@push('script')
    <script>
        $(document).ready(function() {
            // Live Data Search Filters
            $("#circulationRegistrySearch").on("keyup", function() {
                var val = $(this).val().toLowerCase();
                $("#circulationRegistryTableBody .circulation-record-row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
                });
            });

            // Math Matrix Engine for Fine Structures
            $(document).on('input', '.fine-calculator', function() {
                let fine = parseFloat($('#fine_amount').val()) || 0;
                let gst = parseFloat($('#gst_amount').val()) || 0;
                $('#total_fine_amount').val((fine + gst).toFixed(2));
            });

            // Master Chrono Timeline Calculator Engine
            function runTemporalCalculations() {
                let mode = $("#transaction_mode").val();
                let issueDate = new Date($('#issue_date').val());
                let dueDate = new Date($('#due_date').val());

                if (mode === "return" && $('#return_date').val()) {
                    let returnDate = new Date($('#return_date').val());
                    // Compute Overdue logic: if return date exceeds standard target due date
                    if (returnDate > dueDate) {
                        let delay = Math.floor((returnDate - dueDate) / (1000 * 60 * 60 * 24));
                        $('#issue_days').val(delay);
                    } else {
                        $('#issue_days').val(0); // On time response
                    }
                } else {
                    if (issueDate && dueDate && dueDate >= issueDate) {
                        let allocatedBlock = Math.floor((dueDate - issueDate) / (1000 * 60 * 60 * 24));
                        $('#issue_days').val(allocatedBlock);
                    } else {
                        $('#issue_days').val(0);
                    }
                }
            }

            $('#issue_date, #due_date, #return_date').on('change', runTemporalCalculations);

            // ============================================
            // TAB EVENT ROUTING PIPELINE (UI TRANSFORMER)
            // ============================================
            $(".workflow-nav-btn").on("click", function() {
                let mode = $(this).data("mode");
                switchWorkflowContext(mode);
            });

            function switchWorkflowContext(mode) {
                $(".workflow-nav-btn").removeClass("active-workflow");
                $(`.workflow-nav-btn[data-mode="${mode}"]`).addClass("active-workflow");
                $("#transaction_mode").val(mode);

                // Re-initialize default styles
                $("#wrapper_return_date").addClass("opacity-50").css("background", "#f8fafc").find("input").prop("disabled", true).prop("required", false);
                $("#wrapper_due_date").removeClass("opacity-50").css("background", "#ffffff").find("input").prop("readonly", false);
                $("#issue_date").prop("readonly", false);
                
                $("#lbl_issue_date").text("Allocation Timestamp");
                $("#lbl_due_date").html("Target Due Date <span class='text-danger'>*</span>");
                $("#lbl_days_counter").text("Allocated Scope Tenure");
                
                $("#workflow_strip").removeClass("alert-primary alert-success alert-warning");
                $("#master_submit_btn").removeClass("btn-success btn-warning text-dark");

                if (mode === "issue") {
                    $("#workflow_strip").addClass("alert-primary");
                    $("#workflow_strip_msg").html("<strong>New Issue Mode:</strong> Standard distribution pipeline. Process initial resource distribution.");
                    $("#master_submit_btn").html('<i class="ri-save-3-line me-2"></i> Commit Distribution Record');
                    $("#status").val("issued");
                } 
                else if (mode === "return") {
                    $("#workflow_strip").addClass("alert-success");
                    $("#workflow_strip_msg").html("<strong>Return Mode Active:</strong> Asset check-in validation sequence. Overdue calculations will unlock automatically.");
                    $("#master_submit_btn").html('<i class="ri-arrow-go-back-line me-2"></i> Confirm Return & Restock').addClass("btn-success");
                    
                    // Unlock and mandate Return Inputs
                    $("#wrapper_return_date").removeClass("opacity-50").css("background", "#ffffff").find("input").prop("disabled", false).prop("required", true);
                    let today = new Date().toISOString().split('T')[0];
                    if(!$("#return_date").val()) $("#return_date").val(today);
                    
                    $("#lbl_days_counter").text("Calculated Delayed Days");
                    $("#status").val("returned");
                } 
                else if (mode === "renew") {
                    $("#workflow_strip").addClass("alert-warning");
                    $("#workflow_strip_msg").html("<strong>Renew Extension Mode:</strong> Setup extension blocks. Original allocation values locked, target due dates expanded.");
                    $("#master_submit_btn").html('<i class="ri-refresh-line me-2"></i> Authorize Extended Tenure').addClass("btn-warning text-dark");
                    
                    $("#lbl_issue_date").text("Current Expiry Block");
                    $("#lbl_due_date").html("New Extended Horizon <span class='text-danger'>*</span>");
                    $("#lbl_days_counter").text("Added Extension Horizon");
                    $("#status").val("issued");
                }
                runTemporalCalculations();
            }

            // ============================================
            // ROW ACTION CONTROLLERS (MAPPED TO WORKFLOW PANELS)
            // ============================================
            
            // Inline Return Command Row Action
            $(document).on("click", ".inline-return-trigger", function() {
                prepareFormRowData($(this));
                switchWorkflowContext("return");
                
                // Prefill actual dynamic dates safely
                let today = new Date().toISOString().split('T')[0];
                $("#return_date").val(today);
                runTemporalCalculations();
                scrollToTopConsole();
            });

            // Inline Renew Command Row Action
            $(document).on("click", ".inline-renew-trigger", function() {
                prepareFormRowData($(this));
                switchWorkflowContext("renew");

                // Shift original timeline: Next tenure window is benchmarked on old due date
                let baseDueVal = $(this).data("due");
                $("#issue_date").val(baseDueVal).prop("readonly", true);

                // Add pre-calculated 14 days renewal margin buffer recommendation
                let futureHorizon = new Date(baseDueVal);
                futureHorizon.setDate(futureHorizon.getDate() + 14);
                $("#due_date").val(futureHorizon.toISOString().split('T')[0]);

                runTemporalCalculations();
                scrollToTopConsole();
            });

            // General Full Row Editor Model
            $(document).on("click", ".master-edit-trigger", function() {
                prepareFormRowData($(this));
                switchWorkflowContext("issue"); // Defaults to standard editing wrapper
                
                $("#return_date").val($(this).data("return"));
                $("#fine_amount").val($(this).data("fine"));
                $("#gst_amount").val($(this).data("gst"));
                $("#total_fine_amount").val($(this).data("totalfine"));
                $("#status").val($(this).data("status"));
                $("#remarks").val($(this).data("remarks"));
                $("#issue_days").val($(this).data("days"));
                scrollToTopConsole();
            });

            function prepareFormRowData(element) {
                $("#bookCirculationMasterForm")[0].reset();
                $("#issue_id").val(element.data("id"));
                $("#book_id").val(element.data("book"));
                $("#member_id").val(element.data("memberid"));
                $("#issue_date").val(element.data("issue"));
                $("#due_date").val(element.data("due"));

                if (element.data("membertype") === "student") {
                    $("#member_student").prop("checked", true);
                } else {
                    $("#member_staff").prop("checked", true);
                }
            }

            function scrollToTopConsole() {
                $("html, body").animate({ scrollTop: $("#circulation_console_title").offset().top - 100 }, "fast");
            }

            $("#resetMasterCirculationForm").on("click", function() {
                $("#bookCirculationMasterForm")[0].reset();
                $("#issue_id").val("");
                switchWorkflowContext("issue");
            });
        });
    </script>
@endpush