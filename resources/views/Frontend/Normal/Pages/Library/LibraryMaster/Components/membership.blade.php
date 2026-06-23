<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-user-vcard-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Student Library Membership Engine</h6>
                <p class="text-xs text-muted mb-0">Provision digital access passes, track subscription timelines,
                    customize borrowing thresholds, and prepare configurations for card print</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-id-card-clip-line me-1 ripple-effect"></i> Provisioning Unit Active
        </span>
    </div>

    <div class="card-body p-24">
        <form id="studentMembershipForm" class="ajaxForm" data-url="{{ route('school.library.membership.save') }}"
            data-refresh="fetchMembershipRegistry" data-method="POST">
            @csrf

            <input type="hidden" name="id" id="membership_id">

            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-fingerprint-line me-1"></i> Core Student Reference Mapping</span>
            </div>

            <div class="row gy-4 mb-24">
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box match-highlight-zone">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Search
                            & Link Student Account <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-user-search-line addon-icon text-violet"></i>
                            <select name="student_id" id="student_id"
                                class="form-control custom-premium-input studentOptions" required
                                style="appearance: auto;">

                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Membership
                            Card Unique ID <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-vcard-fill addon-icon"></i>
                            <input type="text" name="membership_card_number" id="membership_card_number"
                                class="form-control custom-premium-input font-monospace" placeholder="LMEM-00001-2026"
                                required>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Barcode
                            Identifier</label>
                        <div class="inner-addon">
                            <i class="ri-barcode-line addon-icon"></i>
                            <input type="text" name="barcode_token" id="barcode_token"
                                class="form-control custom-premium-input font-monospace"
                                placeholder="Scan/Type card system barcode tracking sequence...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-calendar-event-line me-1"></i> Card Validation & Lifecycle Timelines</span>
            </div>

            <div class="row gy-4 mb-24">
                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Activation
                            Timestamp <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-check-line addon-icon"></i>
                            <input type="date" name="activation_date" id="activation_date"
                                class="form-control custom-premium-input" required value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Target
                            Expiry Timestamp <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-calendar-check-line addon-icon"></i>
                            <input type="date" name="expiry_date" id="expiry_date"
                                class="form-control custom-premium-input" required>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Max
                            Borrow Limit (Books)</label>
                        <div class="inner-addon">
                            <i class="ri-book-mark-line addon-icon"></i>
                            <input type="number" min="1" max="20" name="max_borrow_limit"
                                id="max_borrow_limit" class="form-control custom-premium-input" value="3">
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Borrow
                            Cycle (Days)</label>
                        <div class="inner-addon">
                            <i class="ri-time-line addon-icon"></i>
                            <input type="number" min="1" max="90" name="borrow_duration_days"
                                id="borrow_duration_days" class="form-control custom-premium-input" value="14">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                        class="ri-shield-user-line me-1"></i> Policy Enforcement, Retainers & State</span>
            </div>

            <div class="row gy-4 align-items-end">
                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Security
                            Deposit Retainer (If Applicable)</label>
                        <div class="inner-addon">
                            <i class="ri-money-dollar-box-line addon-icon"></i>
                            <input type="number" step="0.01" name="security_deposit" id="security_deposit"
                                class="form-control custom-premium-input" value="0.00">
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box h-100">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">Deposit
                            Refundable Matrix</label>
                        <div class="d-flex flex-wrap gap-12">
                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                <input type="radio" name="is_deposit_refundable" id="refundable_true"
                                    value="1" checked>
                                <span class="platform-tile active-status-tile py-8"><i
                                        class="ri-checkbox-circle-line me-1"></i>Yes, Refundable</span>
                            </label>
                            <label class="platform-tab-wrapper m-0 flex-grow-1">
                                <input type="radio" name="is_deposit_refundable" id="refundable_false"
                                    value="0">
                                <span class="platform-tile active-status-tile py-8"><i
                                        class="ri-close-circle-line me-1"></i>Non-Refundable</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Initial
                            Account State Token <span class="text-danger">*</span></label>
                        <div class="inner-addon">
                            <i class="ri-git-merge-line addon-icon"></i>
                            <select name="status" id="member_status" class="form-control custom-premium-input"
                                required style="appearance: auto;">
                                <option value="1" selected>Active & Provisioned</option>
                                <option value="0">Suspended / On Hold</option>
                                <option value="2">Expired / Awaiting Renewal</option>
                                <option value="3">Blacklisted System Profile</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-12">
                    <div class="premium-input-box">
                        <label
                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Internal
                            Administrative Remarks / Audit Annotations</label>
                        <div class="inner-addon">
                            <i class="ri-chat-quote-line addon-icon"></i>
                            <input type="text" name="admin_remarks" id="admin_remarks"
                                class="form-control custom-premium-input"
                                placeholder="Type custom account rules, special exceptions or verification annotations here...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetMembershipForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Reset Parameters
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit & Generate Account
                </button>
            </div>
        </form>
    </div>
</div>

<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Student Library Membership
                Registry Matrix</h6>
            <p class="text-xs text-muted mb-0">Live management terminal containing structural information, security
                holdings and printing queues</p>
        </div>

        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 280px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="membershipRegistrySearch"
                    class="form-control custom-premium-input registry-search-bar"
                    placeholder="Filter linked accounts data matrix...">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive scrollable-class-registry">
            <table class="table bordered-table align-middle mb-0 text-sm">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 60px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 240px;">Membership Card / Token</th>
                        <th scope="col" style="width: 240px;">Student Information Profile</th>
                        <th scope="col" style="width: 160px;">Lifecycle Duration</th>
                        <th scope="col" class="text-center" style="width: 130px;">Rules Threshold</th>
                        <th scope="col" class="text-center" style="width: 110px;">Security Dep.</th>
                        <th scope="col" class="text-center" style="width: 110px;">State</th>
                        <th scope="col" class="text-center" style="width: 140px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="membershipRegistryTableBody">

                </tbody>
            </table>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            generateLibraryMembershipNumber();
            fetchStudents();

            function fetchStudents() {

                fetchMasterData(
                    "{{ route('student.fetch') }}",
                    function(res) {




                        let rows = '<option value="">Select Student...</option>';

                        $.each(res.data, function(i, d) {

                            rows += `
                                <option value="${d.id}">
                                    ${d.first_name}  ${d.last_name}
                                </option>`;

                        });

                        $(".studentOptions").html(rows);

                    }
                );

            }


            // Execute registry fetch sequencing on load
            fetchMembershipRegistry();

            // Client Side Client Filtering Engine Algorithm
            $("#membershipRegistrySearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#membershipRegistryTableBody .membership-record-row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });


            // Form Reset Clear Executions
            $("#resetMembershipForm").on("click", function() {
                $("#membership_id").val("");
                $("#studentMembershipForm")[0].reset();
                $("#student_id").val("").trigger('change');
                $(".text-gradient-primary").first().text("Student Library Membership Engine");
            });
        });

        function fetchMembershipRegistry() {

            fetchMasterData(
                "{{ route('school.library.membership.fetch.with') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let statusBadge = '';

                            if (row.status == 1) {

                                statusBadge = `
                                    <span class="status-badge badge-completed">
                                        <span class="pulse-dot-green"></span>
                                        Active
                                    </span>`;

                            } else if (row.status == 0) {

                                statusBadge = `
                                <span class="badge bg-warning text-dark">
                                    Suspended
                                </span>`;

                            } else if (row.status == 2) {

                                statusBadge = `
                                <span class="badge bg-info">
                                    Expired
                                </span>`;

                            } else {

                                statusBadge = `
                                <span class="badge bg-danger">
                                    Blacklisted
                                </span>`;
                            }


                            let activation_date = formatDate(row.activation_date, 'short');
                            let expiry_date = formatDate(row.expiry_date, 'short');

                            html += `
                                <tr class="membership-record-row">

                                    <td class="text-center">
                                        ${index + 1}
                                    </td>

                                    <td>
                                        <div>
                                            <span class="fw-bold font-monospace d-block">
                                                ${row.membership_card_number ?? '-'}
                                            </span>

                                            <small class="text-muted">
                                                Barcode : ${row.barcode_token ?? '-'}
                                            </small>
                                        </div>
                                    </td>

                                    <td>

                                        <span class="fw-bold d-block">
                                            ${row.student?.first_name ?? ''} ${row.student?.last_name ?? ''}
                                        </span>

                                        <small class="text-muted">
                                            Adm No :
                                            ${row.student?.admission_no ?? '-'}
                                        </small>

                                    </td>

                                    <td>

                                        <span class="d-block">
                                            ${activation_date ?? ''}
                                        </span>

                                        <span class="d-block text-danger">
                                            ${expiry_date ?? '-'}
                                        </span>

                                    </td>

                                    <td class="text-center">

                                        <span class="d-block">
                                            ${row.max_borrow_limit} Books
                                        </span>

                                        <small>
                                            ${row.borrow_duration_days} Days
                                        </small>

                                    </td>

                                    <td class="text-center">
                                        ₹${row.security_deposit ?? 0}
                                    </td>

                                    <td class="text-center">
                                        ${statusBadge}
                                    </td>

                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2">

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-primary edit-membership-trigger"
                                                data-id="${row.id}">
                                                <i class="ri-edit-box-line"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-danger deleteMembership"
                                                data-id="${row.id}">
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
                                <td colspan="8" class="text-center py-4">
                                    No Records Found
                                </td>
                            </tr>
                        `;
                    }

                    $("#membershipRegistryTableBody").html(html);

                }
            );
        }

        $(document).on("click", ".edit-membership-trigger", function() {

            let id = $(this).data("id");

            getDataById(
                "{{ route('school.library.membership.get') }}",
                id,
                function(res) {

                    if (!res.status) {
                        return;
                    }

                    let row = res.data;


                    $("#membership_id").val(row.id);

                    $("#student_id")
                        .val(row.student_id)
                        .trigger('change');

                    $("#membership_card_number").val(row.membership_card_number);
                    $("#barcode_token").val(row.barcode_token);



                    $("#activation_date").val(
                        formatDateForInput(row.activation_date)
                    );

                    $("#expiry_date").val(
                        formatDateForInput(row.expiry_date)
                    );

                    $("#max_borrow_limit").val(row.max_borrow_limit);
                    $("#borrow_duration_days").val(row.borrow_duration_days);

                    $("#security_deposit").val(row.security_deposit);

                    $("#admin_remarks").val(row.admin_remarks);

                    $("#member_status").val(String(row.status));

                    if (row.is_deposit_refundable == 1) {

                        $("#refundable_true").prop("checked", true);

                    } else {

                        $("#refundable_false").prop("checked", true);

                    }

                    $("html, body").animate({
                        scrollTop: 0
                    }, 300);
                }
            );
        });

        function formatDateForInput(date) {

            if (!date) return '';

            return date.split('T')[0];
        }

        $("#resetMembershipForm").on("click", function() {

            $("#studentMembershipForm")[0].reset();

            $("#membership_id").val("");

            $("#student_id").val("").trigger("change");

            $("#refundable_true").prop("checked", true);

        });
    </script>
@endpush
