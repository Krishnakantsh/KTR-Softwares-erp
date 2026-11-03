@extends('School.Layout.main')

@section('title', 'KTR ERP : Fee Collection')

@section('dynamic-content')

    @push('styles')
        <style>
            /* ============================================================
                                       Kept intentionally small — everything else below relies on
                                       the project's existing utility classes (radius-*, bg-*,
                                       text-*, gap-*, shadow-2, badge, etc.). Only the handful of
                                       things that genuinely can't be done with those are here.
                                       ============================================================ */

            .student-premium-card {
                background: linear-gradient(180deg, #ffffff 0%, #fbfbff 100%);
                position: relative;
            }

            .premium-hero-strip {
                height: 5px;
                background: linear-gradient(90deg, #4a5bf6 0%, #8b3dd6 50%, #4a5bf6 100%);
            }

            .student-photo-ring {
                border: 3px solid #fff;
                box-shadow: 0 0 0 3px #e6e9ff, 0 4px 12px rgba(74, 91, 246, 0.15);
            }

            .premium-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: .02em;
            }

            .premium-badge-blue {
                background: #eef1ff;
                color: #3d4bd6;
            }

            .premium-badge-purple {
                background: #f5eefe;
                color: #8b3dd6;
            }

            .premium-badge-grey {
                background: #f1f2f5;
                color: #6b7280;
            }

            .premium-badge-green {
                background: #e9fbf0;
                color: #16a34a;
            }

            .detail-label {
                display: block;
                font-size: 10.5px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .05em;
                color: #9ca3af;
                margin-bottom: 4px;
            }

            .detail-value {
                display: block;
                font-size: 13.5px;
                font-weight: 600;
                color: #1f2937;
            }

            .detail-icon-wrap {
                width: 34px;
                height: 34px;
                border-radius: 10px;
                background: #f5f6ff;
                color: #4a5bf6;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                flex-shrink: 0;
            }

            /* Selection state for month/head rows — pure CSS, no JS change
                                       needed, existing .month-checkbox / .head-checkbox markup
                                       drives this automatically. */
            .month-row:has(.month-checkbox:checked) {
                background: linear-gradient(90deg, #f5f7ff 0%, #ffffff 100%);
                box-shadow: inset 3px 0 0 #4a5bf6;
            }

            #headsTableBody tr:has(.head-checkbox:checked) {
                background-color: #f8f9ff;
            }

            .footer-summary-card {
                background: linear-gradient(180deg, #ffffff 0%, #fafbff 100%);
                border-top: 3px solid #4a5bf6;
            }

            .history-table thead th {
                position: sticky;
                top: 0;
                background: #f8f9ff;
                z-index: 2;
            }
        </style>
    @endpush

    <div class="dashboard-main-body py-24 px-16">

        <!-- Student Search Bar (untouched) -->
        <div class="row mb-12">
            <div class="col-xl-12 col-lg-12">
                @include('components.student-search')
            </div>
        </div>

        <!-- SECTION 1 : Student Info (left) + Collection Meta (right) -->
        <div class="row g-16 d-none mt-16" id="collectionTopWrapper">

            <!-- LEFT : Student Details (Premium) -->
            <div class="col-xl-7 col-lg-12 mb-3">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 overflow-hidden h-100 student-premium-card">

                    <div class="premium-hero-strip"></div>

                    <!-- Header strip: photo + name + badges -->
                    <div class="d-flex align-items-center gap-20 p-20 pb-16 border-bottom border-neutral-100 flex-wrap">

                        <div class="position-relative">
                            <img id="studentInfoPhoto" src="{{ asset('assets/images/_ (11).jpeg') }}"
                                class="rounded-circle student-photo-ring" style="width:72px;height:72px;object-fit:cover;"
                                alt="student">
                        </div>

                        <div class="flex-grow-1">
                            <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2" id="studentInfoSr">
                                Sr. No. : -
                            </span>
                            <h6 class="fw-bold text-neutral-900 mb-4 text-lg" id="studentInfoName">-</h6>

                            <div class="d-flex flex-wrap gap-8">
                                <span class="premium-badge premium-badge-blue" id="studentInfoFeeType">Fee Type : -</span>
                                <span class="premium-badge premium-badge-purple" id="studentInfoStuType">Stu Type : -</span>
                                <span class="premium-badge premium-badge-blue" id="studentInfoStudentType">Status : -</span>
                                <span class="premium-badge premium-badge-grey" id="studentInfoTransportStatus">Transport :
                                    -</span>
                            </div>
                        </div>

                        <div class="text-end">
                            <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-6">Total Due</span>
                            <span
                                class="badge bg-danger-50 text-danger-700 border border-danger-100 px-16 py-8 radius-10 fw-bold fs-5"
                                id="studentTotalDue">0</span>

                            {{-- <div class="mt-10">
                                <button type="button" id="viewHistoryBtn"
                                    class="btn btn-sm bg-primary-50 text-primary-700 border border-primary-100 hover-bg-primary-100 radius-8 px-14 py-8 fw-semibold d-inline-flex align-items-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#feeHistoryModal">
                                    <i class="ri-history-line"></i> Payment History
                                </button>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Detail grid -->
                    <div class="p-20 pt-16">
                        <div class="row g-16">

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-file-list-3-line"></i></div>
                                <div>
                                    <span class="detail-label">Adm. No.</span>
                                    <span class="detail-value" id="studentInfoAdm">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-graduation-cap-line"></i></div>
                                <div>
                                    <span class="detail-label">Class</span>
                                    <span class="detail-value" id="studentInfoClass">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-phone-line"></i></div>
                                <div>
                                    <span class="detail-label">Mob. No.</span>
                                    <span class="detail-value" id="studentInfoMobile">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-user-3-line"></i></div>
                                <div>
                                    <span class="detail-label">F. Name</span>
                                    <span class="detail-value" id="studentInfoFather">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-user-heart-line"></i></div>
                                <div>
                                    <span class="detail-label">M. Name</span>
                                    <span class="detail-value" id="studentInfoMother">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-bus-line"></i></div>
                                <div>
                                    <span class="detail-label">Veh. No.</span>
                                    <span class="detail-value" id="studentInfoVehicle">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-road-map-line"></i></div>
                                <div>
                                    <span class="detail-label">Route</span>
                                    <span class="detail-value" id="studentInfoRoute">-</span>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 d-flex align-items-center gap-10">
                                <div class="detail-icon-wrap"><i class="ri-map-pin-2-line"></i></div>
                                <div>
                                    <span class="detail-label">Stop</span>
                                    <span class="detail-value" id="studentInfoStop">-</span>
                                </div>
                            </div>

                            <div class="col-12 d-flex align-items-start gap-10">
                                <div class="detail-icon-wrap"><i class="ri-home-4-line"></i></div>
                                <div>
                                    <span class="detail-label">Address</span>
                                    <span class="detail-value" id="studentInfoAddress">-</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT : Collection Meta -->
            <div class="col-xl-5 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 overflow-hidden">

                    <div
                        class="card-header border-bottom bg-base py-16 px-20 d-flex justify-content-between align-items-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="detail-icon-wrap"><i class="ri-receipt-line"></i></div>
                            <h6 class="text-md fw-bold mb-0 text-neutral-900">Receipt Details</h6>
                        </div>
                        <div class="mt-10">
                            <button type="button" id="viewHistoryBtn"
                                class="btn btn-sm bg-primary-50 text-primary-700 border border-primary-100 hover-bg-primary-100 radius-8 px-14 py-8 fw-semibold d-inline-flex align-items-center gap-2"
                                data-bs-toggle="modal" data-bs-target="#feeHistoryModal">
                                <i class="ri-history-line"></i> Payment History
                            </button>


                      
                        </div>

                    </div>

                    <div class="p-20">
                        <div class="row gy-3">

                            <div class="col-6">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Receipt Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="receipt_date"
                                    class="form-control custom-premium-input py-10 radius-8">
                            </div>

                            <div class="col-6">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Payment Mode <span class="text-danger">*</span>
                                </label>
                                <select id="payment_mode" class="form-control custom-premium-input py-10 radius-8">
                                    <option value="1" selected>Cash</option>
                                    <option value="2">Cheque</option>
                                    <option value="3">Online</option>
                                    <option value="4">UPI</option>
                                    <option value="5">Card</option>
                                    <option value="6">Bank Transfer</option>
                                </select>
                            </div>

                            <div class="col-6" id="receiptNoWrap">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Receipt No.
                                </label>
                                <input type="text" id="receipt_no"
                                    class="form-control custom-premium-input py-10 radius-8">
                            </div>

                            <div class="col-6 d-none" id="transactionNoWrap">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Transaction No.
                                </label>
                                <input type="text" id="transaction_no"
                                    class="form-control custom-premium-input py-10 radius-8">
                            </div>

                            <div class="col-6 d-none" id="bankNameWrap">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Bank Name
                                </label>
                                <input type="text" id="bank_name"
                                    class="form-control custom-premium-input py-10 radius-8">
                            </div>

                            <div class="col-12">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Remarks
                                </label>
                                <input type="text" id="collection_remarks"
                                    class="form-control custom-premium-input py-10 radius-8"
                                    placeholder="Optional remarks">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2 : Months (left) + Heads (right) -->
        <div class="row g-16 d-none mt-16" id="collectionBottomWrapper">

            <!-- LEFT : Months Panel -->
            <div class="col-xl-4 col-lg-12 mb-3">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100">

                    <div
                        class="card-header border-bottom bg-base py-16 px-20 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="detail-icon-wrap"><i class="ri-calendar-2-line"></i></div>
                            <h6 class="text-md fw-bold mb-0 text-neutral-900">Months</h6>
                        </div>

                        <div class="form-check form-switch d-flex align-items-center gap-2 mb-0">
                            <label class="switch">
                                <input type="checkbox" role="switch" id="monthSelectAll" value="1"
                                    class="module-active-toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="card-body p-12" id="monthListBody" style="max-height:480px; overflow-y:auto;">
                        <!-- month rows injected by JS -->
                    </div>
                </div>
            </div>

            <!-- RIGHT : Heads Panel -->
            <div class="col-xl-8 col-lg-12">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100">

                    <div
                        class="card-header border-bottom bg-base py-16 px-20 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="detail-icon-wrap"><i class="ri-price-tag-3-line"></i></div>
                            <h6 class="text-md fw-bold mb-0 text-neutral-900">Fee Heads</h6>
                        </div>

                        <div class="form-check d-flex align-items-center gap-2 mb-0">
                            <label class="switch">
                                <input type="checkbox" role="switch" id="headSelectAll" value="1"
                                    class="module-active-toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height:480px; overflow-y:auto;">
                            <table class="table align-middle mb-0" id="headsTable">
                                <thead class="text-xs uppercase text-neutral-600"
                                    style="position:sticky; top:0; background:#f8f9ff; z-index:2;">
                                    <tr>
                                        <th style="width:40px;"><i class="ri-checkbox-line"></i></th>
                                        <th class="text-start">Fee Head</th>
                                        <th>Due Amount</th>
                                        <th>Concession</th>
                                        <th>Fine</th>
                                        <th style="width:140px;">Paying Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="headsTableBody">
                                    <tr id="headsEmptyRow">
                                        <td colspan="7" class="text-center text-xs text-neutral-500 py-24">
                                            Select month(s) from the left panel to see applicable fee heads.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECTION 3 : Totals + Save -->
        <div class="row g-16 d-none mt-16" id="collectionFooterWrapper">
            <div class="col-12">

                <div class="shadow-2 radius-16 bg-base border border-neutral-200 p-20 footer-summary-card">

                    <div class="row g-3 align-items-end">

                        <div class="col-lg-2 col-md-4">
                            <label class="form-label fw-semibold text-xs text-uppercase text-neutral-600">Grand
                                Total</label>
                            <input type="number" id="selectedTotal" class="form-control radius-8" readonly>
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <label
                                class="form-label fw-semibold text-xs text-uppercase text-neutral-600">Concession</label>
                            <input type="number" id="selectedConcession" class="form-control radius-8">
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <label class="form-label fw-semibold text-xs text-uppercase text-neutral-600">Fine</label>
                            <input type="number" id="selectedFine" class="form-control radius-8">
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <label class="form-label fw-semibold text-xs text-uppercase text-primary-700">Net
                                Payable</label>
                            <input type="number" id="selectedPayable"
                                class="form-control radius-8 fw-bold text-primary-700" readonly>
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <label class="form-label fw-semibold text-xs text-uppercase text-neutral-600">
                                Total Paid <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="totalPaid" class="form-control radius-8">
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <label class="form-label fw-semibold text-xs text-uppercase text-neutral-600">Due
                                Amount</label>
                            <input type="number" id="dueAmount" class="form-control radius-8" readonly>
                        </div>

                        <div class="col-lg-3 mt-3">
                            <label class="form-label fw-semibold text-xs text-uppercase text-neutral-600">Receipt
                                Remark</label>
                            <input type="text" id="receiptRemark" class="form-control radius-8">
                        </div>

                        <div class="col-lg-2 mt-3">
                            <button type="button" id="saveCollectionBtn"
                                class="btn btn-primary bg-primary-600 border-0 w-100 py-12 radius-8 fw-semibold d-flex align-items-center justify-content-center gap-2">
                                <i class="ri-checkbox-circle-line"></i>
                                Collect Fee
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- ================================================================
                     PAYMENT HISTORY MODAL
                     ================================================================ -->
    <div class="modal fade" id="feeHistoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content radius-16 border-0 shadow-2">

                <div class="modal-header border-bottom bg-base py-16 px-24">
                    <div class="d-flex align-items-center gap-3">
                        <div class="detail-icon-wrap"><i class="ri-history-line"></i></div>
                        <div>
                            <h6 class="fw-bold mb-0 text-neutral-900">Payment History</h6>
                            <span class="text-xs text-neutral-500" id="historyModalStudentName">-</span>
                        </div>
                    </div>

                
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="table-responsive" style="max-height:65vh; overflow-y:auto;">
                        <table class="table align-middle mb-0 history-table">
                            <thead class="text-xs uppercase text-neutral-600">
                                <tr>
                                    <th class="ps-24">Receipt No.</th>
                                    <th>Date</th>
                                    <th>Mode</th>
                                    <th>Amount</th>
                                    <th>Concession</th>
                                    <th>Fine</th>
                                    <th>Net Payable</th>
                                    <th>Status</th>
                                    <th class="text-end pe-24">Print</th>
                                </tr>
                            </thead>
                            <tbody id="feeHistoryTableBody">
                                <tr id="feeHistoryLoadingRow">
                                    <td colspan="9" class="text-center text-xs text-neutral-500 py-32">
                                        <i class="ri-loader-4-line ri-spin"></i> Loading transactions...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer border-top bg-base py-12 px-24">
                    <button type="button"
                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-20 py-10 radius-8 fw-semibold"
                        data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(function() {

            generateFeesReceipt();
            let currentStudentId = null;
            let ledgerRows = []; // flat list from student_fee_ledgers for this student/session
            // holds transport_month_id (as strings) — the school's own Transport
            // Month master (name + order), resolved server-side per ledger row.
            let selectedMonths = new Set();

            // fee_head_id -> { head_name, ledgerDetails: [{id, due, concession, fine, start_month}] }
            // Rebuilt every renderHeadsTable() call — used by recalcTotals() and
            // the Save handler to split a merged row's totals back across the
            // underlying ledger rows.
            let headGroupsCache = {};

            // Whether the user has manually typed into #totalPaid. While false,
            // #totalPaid auto-mirrors the computed Net Payable value. Once the
            // user edits it themselves, we stop overwriting it and instead
            // derive Due Amount = Net Payable - Total Paid.
            let isTotalPaidManual = false;

            initStudentSearch(function(selectedStudentId) {
                currentStudentId = selectedStudentId;
                loadStudentAndLedger(selectedStudentId);
            });

            $('#receipt_date').val(new Date().toISOString().slice(0, 10));

            $('#payment_mode').on('change', function() {
                const mode = $(this).val();
                $('#transactionNoWrap').toggleClass('d-none', !['2', '3', '4', '5', '6'].includes(mode));
                $('#bankNameWrap').toggleClass('d-none', !['2', '6'].includes(mode));
            });

            function loadStudentAndLedger(studentId) {

                $.ajax({
                    url: "{{ route('student.show.with') }}",
                    type: "GET",
                    data: {
                        id: studentId
                    },
                    success: function(response) {

                        let res = response.data;

                        $('#collectionTopWrapper, #collectionBottomWrapper, #collectionFooterWrapper')
                            .removeClass('d-none');

                        $('#studentInfoFather').text(res.father_name ? res.father_name : '-');
                        $('#studentInfoMother').text(res.mother_name ? res.mother_name : '-');

                        if (res.student_photo) {
                            $('#studentInfoPhoto').attr('src', '{{ asset('') }}' + res
                                .student_photo);
                        }
                        $('#studentInfoSr').text('Sr. No. : ' + (res.sr_no ?? '-'));
                        $('#studentInfoName').text(res.first_name + ' ' + res.last_name);
                        $('#historyModalStudentName').text((res.first_name + ' ' + res.last_name) +
                            ' — Adm No: ' + (res.admission_no ?? '-'));
                        $('#studentInfoAdm').text(res.admission_no ?? '-');
                        $('#studentInfoClass').text((res.class_master?.name || '-') + ' / ' + (res
                            .section?.name || '-'));
                        $('#studentInfoMobile').text(res.sms_whatsapp_no ?? '-');

                        $('#studentInfoAddress').text(res.contact_details?.permanent_address ?? '-');

                        $('#studentInfoFeeType').text('Fee Type : ' + (res.fee_type ?? '-'));
                        $('#studentInfoStudentType').text('Status : ' + (res.student_status ?? '-'));
                        $('#studentInfoStuType').text('Stu Type : ' + (res.student_type ?? '-'));

                        const isTransportActive = res.transport_status === 'Active' || res
                            .transport_status === 1;
                        $('#studentInfoTransportStatus')
                            .text('Transport : ' + (res.transport_status ?? 'Inactive'))
                            .removeClass('premium-badge-grey premium-badge-green premium-badge-red')
                            .addClass(isTransportActive ? 'premium-badge-green' : 'premium-badge-grey');

                        $('#studentInfoVehicle').text(res.vehicle_no ?? '0');
                        $('#studentInfoRoute').text(res.route_name ?? res.route ?? '0');
                        $('#studentInfoStop').text(res.stop_name ?? res.stop ?? '0');

                        loadStudentLedger(studentId);
                    }
                });
            }

            // Fetch this student's fee_ledger rows (pending/partial) -> gives us
            // start_month, head, due amount for every un-paid installment line.
            function loadStudentLedger(studentId) {

                $.ajax({
                    url: "{{ route('school.feeCollection.byStudent') }}",
                    type: "GET",
                    data: {
                        student_id: studentId
                    },
                    success: function(res) {

                        ledgerRows = res.data || [];
                        selectedMonths
                            .clear(); // renderMonthsPanel() will re-select the default (first) month

                        // fresh student/ledger load -> Total Paid should go back
                        // to auto-mirroring Net Payable until the user types in it again.
                        isTotalPaidManual = false;

                        renderMonthsPanel();
                        renderHeadsTable();
                        recalcTotals();

                        let totalDue = ledgerRows.reduce((sum, r) => sum + parseFloat(r
                            .balance_amount || 0), 0);
                        $('#studentTotalDue').text(totalDue.toFixed(2));
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            }

            /*
            |--------------------------------------------------------------------------
            | MONTHS PANEL (left) - calendar months (Apr, May, Jun ...) that
            | actually have pending dues for this student, in academic-year
            | order. First one is checked by default.
            |--------------------------------------------------------------------------
            */
            function renderMonthsPanel() {

                const $body = $('#monthListBody').empty();
                const monthMap = {}; // transport_month_id -> { name, order, due }

                ledgerRows.forEach(function(row) {
                    const monthId = row.transport_month_id;
                    if (monthId === null || monthId === undefined)
                        return; // no matching transport month found for this row's installment — skip from panel

                    if (!monthMap[monthId]) {
                        monthMap[monthId] = {
                            name: row.transport_month_name || ('Month #' + monthId),
                            order: row.transport_month_order ?? 0,
                            due: 0
                        };
                    }
                    monthMap[monthId].due += parseFloat(row.balance_amount || 0);
                });

                // Sort by the transport_months.order (school's own sequence)
                const presentMonthIds = Object.keys(monthMap)
                    .sort((a, b) => monthMap[a].order - monthMap[b].order);

                presentMonthIds.forEach(function(monthId, idx) {

                    const info = monthMap[monthId];
                    const isDefaultChecked = idx ===
                        0; // first pending month (by order), checked by default

                    if (isDefaultChecked) {
                        selectedMonths.add(String(monthId));
                    }

                    const $row = $(`
                        <div class="d-flex align-items-center justify-content-between px-8 py-10 radius-8 month-row"
                             data-month="${monthId}" style="cursor:pointer;">
                            <div class="form-check mb-0 d-flex align-items-center gap-2">

                                <label class="switch">
                                    <input type="checkbox" role="switch" data-month="${monthId}" ${isDefaultChecked ? 'checked' : ''}
                                        class="form-check-input month-checkbox">
                                    <span class="slider"></span>
                                </label>
                                <label class="form-check-label fw-semibold text-sm">${info.name}</label>

                            </div>
                            <span class="text-xs fw-semibold text-neutral-500">${info.due.toFixed(2)}</span>
                        </div>
                    `);

                    $body.append($row);
                });

                if (presentMonthIds.length === 0) {
                    $body.append(
                        '<div class="text-center text-xs text-neutral-500 py-24">No pending dues found.</div>');
                }

                $('#monthSelectAll').prop('checked', presentMonthIds.length > 0 && selectedMonths
                    .size === presentMonthIds.length);
            }

            $('#monthSelectAll').on('change', function() {
                const checked = $(this).is(':checked');
                $('.month-checkbox').prop('checked', checked).each(function() {
                    toggleMonthSelection($(this).data('month'), checked);
                });
                renderHeadsTable();
                recalcTotals();
            });

            $(document).on('change', '.month-checkbox', function() {
                toggleMonthSelection($(this).data('month'), $(this).is(':checked'));
                renderHeadsTable();
                recalcTotals();
            });

            $(document).on('click', '.month-row', function(e) {
                if ($(e.target).closest('label.switch').length) return;

                $(this).find('.month-checkbox')
                    .prop('checked', function(i, val) {
                        return !val;
                    })
                    .trigger('change');
            });

            function toggleMonthSelection(month, isChecked) {
                month = String(month);
                if (isChecked) selectedMonths.add(month);
                else selectedMonths.delete(month);
            }

            /*
            |--------------------------------------------------------------------------
            | HEADS PANEL (right) - one row PER FEE HEAD across all selected
            | months. Agar ek hi head 2+ selected months mein hai, uske due /
            | concession / fine sab ADD ho jaate hain ek hi row mein. Alag head
            | ho to alag row banti hai.
            |--------------------------------------------------------------------------
            */
            function renderHeadsTable() {

                const $tbody = $('#headsTableBody').empty();
                headGroupsCache = {};

                const visibleRows = ledgerRows.filter(r => selectedMonths.has(String(r.transport_month_id)));

                if (visibleRows.length === 0) {
                    $tbody.append(`
                        <tr id="headsEmptyRow">
                            <td colspan="7" class="text-center text-xs text-neutral-500 py-24">
                                Select month(s) from the left panel to see applicable fee heads.
                            </td>
                        </tr>`);
                    return;
                }

                visibleRows.forEach(function(row) {

                    const headId = row.fee_head_id;

                    if (!headGroupsCache[headId]) {
                        headGroupsCache[headId] = {
                            head_name: row.fee_head?.head_name || '-',
                            ledgerDetails: []
                        };
                    }

                    headGroupsCache[headId].ledgerDetails.push({
                        id: row.id,
                        due: parseFloat(row.balance_amount || 0),
                        concession: parseFloat(row.concession_amount || 0),
                        fine: parseFloat(row.fine_amount || 0),
                        transport_month_name: row.transport_month_name,
                    });
                });

                Object.keys(headGroupsCache).forEach(function(headId) {

                    const g = headGroupsCache[headId];

                    const totalDue = g.ledgerDetails.reduce((s, d) => s + d.due, 0);
                    const totalConcession = g.ledgerDetails.reduce((s, d) => s + d.concession, 0);
                    const totalFine = g.ledgerDetails.reduce((s, d) => s + d.fine, 0);

                    $tbody.append(`
                        <tr data-fee-head-id="${headId}">
                            <td>
                                <label class="switch">
                                   <input type="checkbox"
                                    role="switch"
                                    data-fee-head-id="${headId}"
                                    class="form-check-input head-checkbox"
                                    checked>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="text-start fw-semibold">${g.head_name}</td>
                            <td class="fw-semibold">${totalDue.toFixed(2)}</td>
                            <td>
                                <input type="number" step="0.01" min="0" max="${totalDue}"
                                    class="form-control form-control-sm concession-input" data-fee-head-id="${headId}"
                                    value="${totalConcession.toFixed(2)}" style="width:90px;" disabled>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0"
                                    class="form-control form-control-sm fine-input" data-fee-head-id="${headId}"
                                    value="${totalFine.toFixed(2)}" style="width:90px;" disabled>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" max="${totalDue}"
                                    class="form-control form-control-sm pay-input" data-fee-head-id="${headId}"
                                    value="${totalDue.toFixed(2)}" style="width:110px;" disabled>
                            </td>
                        </tr>
                    `);
                });

                $('#headSelectAll').prop(
                    'checked',
                    Object.keys(headGroupsCache).length > 0
                );

            }

            $('#headSelectAll').on('change', function() {
                const checked = $(this).is(':checked');
                $('.head-checkbox').prop('checked', checked).trigger('change');
            });

            $(document).on('change', '.head-checkbox', function() {
                const $row = $(this).closest('tr');
                const enable = $(this).is(':checked');
                $row.find('.concession-input, .fine-input, .pay-input').prop('disabled', !enable);
                recalcTotals();
            });

            $(document).on('input', '.pay-input, .concession-input, .fine-input', function() {
                recalcTotals();
            });

            function recalcTotals() {

                let total = 0,
                    concession = 0,
                    fine = 0,
                    payable = 0;

                $('.head-checkbox:checked').each(function() {
                    const $row = $(this).closest('tr');
                    const pay = parseFloat($row.find('.pay-input').val()) || 0;
                    const conc = parseFloat($row.find('.concession-input').val()) || 0;
                    const fin = parseFloat($row.find('.fine-input').val()) || 0;

                    total += pay;
                    concession += conc;
                    fine += fin;
                    payable += (pay - conc + fin);
                });

                $('#selectedTotal').val(total.toFixed(2));
                $('#selectedConcession').val(concession.toFixed(2));
                $('#selectedFine').val(fine.toFixed(2));
                $('#selectedPayable').val(payable.toFixed(2));

                // Total Paid mirrors Net Payable until the user manually edits it.
                if (!isTotalPaidManual) {
                    $('#totalPaid').val(payable.toFixed(2));
                }

                updateDueAmount(payable);
            }

            // Due Amount = Net Payable - Total Paid (never negative in display).
            function updateDueAmount(payable) {
                const totalPaid = parseFloat($('#totalPaid').val()) || 0;
                const due = payable - totalPaid;
                $('#dueAmount').val(due.toFixed(2));
            }

            // User manually typed into Total Paid — stop auto-syncing it with
            // Net Payable, and recompute Due Amount off the typed value.
            $('#totalPaid').on('input', function() {
                isTotalPaidManual = true;
                const payable = parseFloat($('#selectedPayable').val()) || 0;
                updateDueAmount(payable);
            });

            /*
            |--------------------------------------------------------------------------
            | Splits a merged row's total value back across its underlying
            | ledger rows, sequentially filling each one's own cap first
            | (e.g. oldest month's due gets filled before the next month's).
            | Any leftover (e.g. user typed more than the sum of caps) is
            | added onto the last item so the total always adds up exactly.
            |--------------------------------------------------------------------------
            */
            function splitAcrossLedgers(totalToAllocate, items) {

                let remaining = totalToAllocate;
                const result = [];

                items.forEach(function(item) {
                    const val = Math.max(Math.min(remaining, item.cap), 0);
                    remaining = parseFloat((remaining - val).toFixed(2));
                    result.push({
                        id: item.id,
                        value: parseFloat(val.toFixed(2))
                    });
                });

                if (remaining > 0.004 && result.length) {
                    result[result.length - 1].value = parseFloat(
                        (result[result.length - 1].value + remaining).toFixed(2)
                    );
                }

                return result;
            }

            /*
            |--------------------------------------------------------------------------
            | SAVE
            |--------------------------------------------------------------------------
            */
            $('#saveCollectionBtn').on('click', function() {

                if (!currentStudentId) {
                    showToast('Please select a student first.', 'error');
                    return;
                }

                const paymentMode = $('#payment_mode').val();
                if (!paymentMode) {
                    showToast('Please select a payment mode.', 'error');
                    return;
                }

                const details = [];

                $('.head-checkbox:checked').each(function() {

                    const headId = $(this).data('fee-head-id');
                    const $row = $(this).closest('tr');
                    const group = headGroupsCache[headId];

                    if (!group) return;

                    const payTotal = parseFloat($row.find('.pay-input').val()) || 0;
                    const concessionTotal = parseFloat($row.find('.concession-input').val()) || 0;
                    const fineTotal = parseFloat($row.find('.fine-input').val()) || 0;

                    const payAlloc = splitAcrossLedgers(
                        payTotal,
                        group.ledgerDetails.map(d => ({
                            id: d.id,
                            cap: d.due
                        }))
                    );
                    const concessionAlloc = splitAcrossLedgers(
                        concessionTotal,
                        group.ledgerDetails.map(d => ({
                            id: d.id,
                            cap: d.concession
                        }))
                    );
                    const fineAlloc = splitAcrossLedgers(
                        fineTotal,
                        group.ledgerDetails.map(d => ({
                            id: d.id,
                            cap: d.fine
                        }))
                    );

                    group.ledgerDetails.forEach(function(d, idx) {
                        details.push({
                            student_fee_ledger_id: d.id,
                            paid_amount: payAlloc[idx].value,
                            concession_amount: concessionAlloc[idx].value,
                            fine_amount: fineAlloc[idx].value,
                        });
                    });
                });

                if (details.length === 0) {
                    showToast('Please select at least one fee head to collect.', 'error');
                    return;
                }

                $.ajax({
                    url: "{{ route('school.feeCollection.save') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        student_id: currentStudentId,
                        receipt_date: $('#receipt_date').val(),
                        payment_mode: paymentMode,
                        transaction_no: $('#transaction_no').val(),
                        bank_name: $('#bank_name').val(),
                        remarks: $('#collection_remarks').val(),
                        details: details,
                    },
                    success: function(res) {
                        if (!res.status) {
                            showToast(res.message, 'error');
                            return;
                        }
                        showToast(res.message, 'success');
                        loadStudentLedger(currentStudentId);
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            function generateFeesReceipt() {

                $.ajax({
                    url: "{{ route('school.feeCollection.generateReceiptNo') }}",
                    method: 'GET',
                    success: function(res) {

                        if (res) {
                            $('#receipt_no').val(res);
                        }
                    }

                });
            }

            /*
            |--------------------------------------------------------------------------
            | PAYMENT HISTORY MODAL
            |--------------------------------------------------------------------------
            | All-time transactions for the currently selected student. Print
            | button is UI-only right now — actual receipt/PDF generation
            | comes in a later pass.
            |--------------------------------------------------------------------------
            */
            $('#viewHistoryBtn').on('click', function() {

                if (!currentStudentId) {
                    showToast('Please select a student first.', 'error');
                    return;
                }

                loadFeeHistory(currentStudentId);
            });

            function loadFeeHistory(studentId) {

                $('#feeHistoryTableBody').html(`
                    <tr id="feeHistoryLoadingRow">
                        <td colspan="9" class="text-center text-xs text-neutral-500 py-32">
                            <i class="ri-loader-4-line ri-spin"></i> Loading transactions...
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('school.feeCollection.history') }}",
                    type: "GET",
                    data: {
                        student_id: studentId
                    },
                    success: function(res) {
                        renderFeeHistoryTable(res.data || []);
                    },
                    error: function(xhr) {
                        $('#feeHistoryTableBody').html(`
                            <tr>
                                <td colspan="9" class="text-center text-xs text-danger-600 py-32">
                                    Could not load payment history.
                                </td>
                            </tr>
                        `);
                    }
                });
            }

            function renderFeeHistoryTable(rows) {

                const $tbody = $('#feeHistoryTableBody').empty();

                if (rows.length === 0) {
                    $tbody.append(`
                        <tr>
                            <td colspan="9" class="text-center text-xs text-neutral-500 py-32">
                                No transactions found for this student yet.
                            </td>
                        </tr>
                    `);
                    return;
                }

                const statusMap = {
                    1: '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>',
                    2: '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Cancelled</span>',
                    3: '<span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-10 py-4 radius-6 font-xxs">Refunded</span>',
                };

                rows.forEach(function(row) {
                    $tbody.append(`
                        <tr>
                            <td class="ps-24 fw-semibold">${row.receipt_no}</td>
                            <td>${row.receipt_date}</td>
                            <td>${row.payment_mode_label}</td>
                            <td>${parseFloat(row.total_amount).toFixed(2)}</td>
                            <td class="text-success-700">${parseFloat(row.total_concession).toFixed(2)}</td>
                            <td class="text-warning-700">${parseFloat(row.total_fine).toFixed(2)}</td>
                            <td class="fw-bold text-primary-700">${parseFloat(row.net_amount).toFixed(2)}</td>
                            <td>${statusMap[row.receipt_status] || '-'}</td>
                            <td class="text-end pe-24">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary radius-6 print-receipt-btn"
                                    data-collection-id="${row.id}" data-receipt-no="${row.receipt_no}"
                                    title="Print receipt">
                                    <i class="ri-printer-line"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }

            $(document).on('click', '.print-receipt-btn', function() {
                const receiptNo = $(this).data('receipt-no');
                showToast('Receipt printing for ' + receiptNo + ' will be available soon.', 'success');
                // TODO: wire up actual receipt/PDF generation here in the next pass.
            });

        });
    </script>
@endpush
