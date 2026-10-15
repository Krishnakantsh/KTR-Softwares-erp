@extends('School.Layout.main')

@section('title', 'KTR ERP : Fee Structure')

@section('dynamic-content')
    <div class="dashboard-main-body py-24 px-16">

        <!-- Top Header & New Button -->
        <div class="d-flex justify-content-between align-items-center mb-24">
            <div>
                <h5 class="fw-bold text-neutral-800 mb-4">Fee Structures</h5>
                <p class="text-sm text-neutral-500 mb-0">Manage and view all class fee structures</p>
            </div>
            <button type="button" id="newStructureBtn"
                class="btn btn-primary bg-primary-600 text-white radius-8 px-16 py-10 d-flex align-items-center gap-2 shadow-sm">
                <i class="ri-add-line text-lg"></i>
                <span class="fw-medium">New Structure</span>
            </button>
        </div>

        <div class="row  mb-3" id="structureList">


        </div>
        <div class="row g-8 gap-16 d-none" id="structureFormWrapper">
            <div class="col-xl-12">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">

                    <div class="card-header border-bottom bg-base py-20 px-28">
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900">Fee Structure</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select a class, then set amounts per fee head — cells open
                            based on each head's plan.</p>
                    </div>

                    <div class="card-body p-28">

                        <div class="row gy-4 mb-24">

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Structure Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="structure_name" name="structure_name" placeholder="e.g., TUI">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Class <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-folder-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="class_id" name="class_id" required>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Stream
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-folder-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="stream_id" name="stream_id" required>

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div id="gridWrapper" class="d-none mt-12">

                            <div class="fee-matrix-shell">
                                <div class="table-responsive fee-matrix-scroll">
                                    <table class="table align-middle text-center mb-0" id="matrixTable">
                                        <thead>
                                            <tr class="text-xs uppercase">
                                                <th class="text-start fee-head-col" style="min-width:180px">Fee Head</th>
                                                <th class="fee-plan-col" style="min-width:150px">Fee Type</th>
                                                @foreach ($months = ['4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar'] as $num => $label)
                                                    <th data-month="{{ $num }}" style="min-width:88px">
                                                        {{ strtoupper($label) }}</th>
                                                @endforeach
                                                <th class="fee-total-col" style="min-width:100px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="matrixTableBody"></tbody>
                                        <tfoot>
                                            <tr class="fee-grand-total-row">
                                                <td class="text-start" colspan="{{ 2 + count($months) }}">
                                                    <i class="ri-calculator-line me-2"></i>Grand Total
                                                </td>
                                                <td id="grandTotal">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-16">
                                <div class="d-flex align-items-center gap-3 text-xs text-neutral-500">
                                    <span class="legend-swatch legend-active"></span> Editable cell
                                    <span class="legend-swatch legend-locked ms-3"></span> Locked (no installment on this
                                    month)
                                </div>
                                <div class="d-flex gap-3">
                                    <button type="button" id="cancelBtn"
                                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-24 py-12 radius-8 fw-semibold">
                                        Cancel
                                    </button>
                                    <button type="button" id="saveStructureBtn"
                                        class="btn btn-primary bg-primary-600 text-white px-28 py-12 radius-8 fw-semibold border-0">
                                        <i class="ri-save-3-line"></i> Modify
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="selectClassHint" class="text-center py-40">
                            <span class="text-sm fw-medium text-neutral-500">Select a class to build its fee
                                structure.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /FORM WRAPPER -->

    </div>

@endsection

@push('styles')
    <style>
        /* ---------- Fee Matrix Card Shell ---------- */
        .fee-matrix-shell {
            border: 1px solid #e9ecf1;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(16, 24, 40, 0.04);
        }

        .fee-matrix-scroll {
            max-height: 520px;
            overflow: auto;
        }

        #matrixTable {
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        /* ---------- Header ---------- */
        #matrixTable thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background: linear-gradient(180deg, #f8f9ff 0%, #f1f3fb 100%);
            color: #4a4f66;
            font-weight: 700;
            letter-spacing: .04em;
            padding: 12px 10px;
            border-bottom: 2px solid #e3e6f0;
            white-space: nowrap;
        }

        #matrixTable thead th.fee-head-col {
            position: sticky;
            left: 0;
            z-index: 6;
            box-shadow: 2px 0 0 rgba(0, 0, 0, 0.03);
        }

        #matrixTable thead th.fee-plan-col {
            position: sticky;
            left: 180px;
            z-index: 6;
            background: #f1f3fb;
        }

        #matrixTable thead th.fee-total-col {
            background: #eef1ff;
            color: #3d4bd6;
        }

        /* ---------- Body rows ---------- */
        #matrixTable tbody tr {
            transition: background-color .15s ease;
        }

        #matrixTable tbody tr:nth-child(even) {
            background-color: #fafbfd;
        }

        #matrixTable tbody tr:hover {
            background-color: #f2f5ff;
        }

        #matrixTable tbody td {
            padding: 8px;
            border-bottom: 1px solid #eef0f5;
            vertical-align: middle;
        }

        #matrixTable tbody td.text-start {
            position: sticky;
            left: 0;
            background: inherit;
            z-index: 2;
            box-shadow: 2px 0 0 rgba(0, 0, 0, 0.02);
        }

        #matrixTable tbody td:nth-child(2) {
            position: sticky;
            left: 180px;
            background: inherit;
            z-index: 2;
        }

        .fee-row .row-plan {
            border-radius: 8px;
            border: 1px solid #dfe2ea;
            font-size: 12.5px;
            padding: 6px 8px;
            background-color: #fff;
        }

        .fee-row .row-plan:focus {
            border-color: #6f7bf7;
            box-shadow: 0 0 0 3px rgba(111, 123, 247, 0.15);
        }

        .row-optional {
            accent-color: #4a5bf6;
            cursor: pointer;
        }

        /* ---------- Amount cells ---------- */
        .cell-amount {
            border-radius: 8px;
            border: 1px solid #dfe2ea;
            text-align: center;
            padding: 7px 4px;
            font-weight: 600;
            color: #23263a;
            background-color: #fff;
        }

        .cell-amount:enabled {
            border-color: #c3caff;
            background-color: #f6f7ff;
        }

        .cell-amount:enabled:focus {
            border-color: #4a5bf6;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(74, 91, 246, 0.15);
            outline: none;
        }

        .cell-amount:disabled {
            background-color: #f5f5f7;
            border: 1px dashed #e2e2e8;
            color: #c7c9d4;
        }

        td[data-month] {
            transition: background-color .15s ease;
        }

        /* ---------- Totals ---------- */
        .row-total {
            display: inline-block;
            min-width: 64px;
            padding: 5px 10px;
            border-radius: 20px;
            background-color: #eef1ff;
            color: #3d4bd6;
            font-weight: 700;
            font-size: 12.5px;
        }

        .fee-grand-total-row td {

            color: #fff;
            font-size: 14px;
            font-weight: 700;
            padding: 14px 16px;
            border: none;
        }

        .fee-grand-total-row td:first-child {
            border-top-left-radius: 0;
        }

        #grandTotal {
            font-size: 16px;
        }

        /* ---------- Legend ---------- */
        .legend-swatch {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 4px;
            margin-right: 4px;
            vertical-align: middle;
        }

        .legend-active {
            background-color: #f6f7ff;
            border: 1px solid #c3caff;
        }

        .legend-locked {
            background-color: #f5f5f7;
            border: 1px dashed #e2e2e8;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            fetchFeeStructures();

            const MONTHS = @json(array_keys($months)); // ['4','5',...,'3'] in display order
            let installmentMasters = [];
            let feeHeads = [];
            let existingData = {};
            let currentSessionId = null;


            fetchMasterData("{{ route('school.stream.master.fetch.with') }}", function(res) {

                let options = `<option value="">Select Stream</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("#stream_id").html(options);
            });

            fetchMasterData("{{ route('school.class.master.fetch.with') }}", function(res) {

                let options = `<option value="">Select Class</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("#class_id").html(options);
            });

            function loadMatrix(classId, sessionId = null) {

                $.ajax({
                    url: "{{ route('school.feeStructure.matrix') }}",
                    type: "GET",
                    data: {
                        class_id: classId,
                        session_id: sessionId
                    },
                    success: function(res) {
                        if (!res.status) return;

                        feeHeads = res.data.fee_heads;
                        let structure_name = res.data.structure_name;
                        installmentMasters = res.data.installment_masters;
                        existingData = res.data.existing;
                        currentSessionId = res.data.session_id;
                        let stream_id = res.data.stream_id;

                        $('#class_id').val(classId);
                        $('#stream_id').val(stream_id);

                        $('#structure_name').val(structure_name);
                        $('#gridWrapper').removeClass('d-none');
                        $('#selectClassHint').addClass('d-none');

                        renderRows();
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            }

            function renderRows() {
                const $tbody = $('#matrixTableBody').empty();

                feeHeads.forEach(function(head) {

                    const saved = existingData[head.id] || null;

                    let optionsHtml = '<option value="">-- Select --</option>';
                    installmentMasters.forEach(function(m) {
                        const sel = saved && saved.fee_installment_master_id == m.id ? 'selected' :
                            '';
                        optionsHtml +=
                            `<option value="${m.id}" ${sel}>${m.installment_name}</option>`;
                    });

                    let cellsHtml = '';
                    MONTHS.forEach(function(m) {
                        cellsHtml += `<td data-month="${m}">
                        <input type="text" step="0.01" min="0"
                            class="form-control form-control-sm text-center cell-amount"
                            data-detail-id="" disabled>
                    </td>`;
                    });

                    const $row = $(`
                        <tr class="fee-row" data-fee-head-id="${head.id}">
                            <td class="text-start fw-semibold">
                                <label class="d-flex align-items-center gap-2 mb-0">
                                    <input type="checkbox" class="row-optional" ${saved && saved.is_optional ? 'checked' : ''}>
                                    ${head.head_name}
                                </label>
                            </td>
                            <td><select class="form-control form-control-sm row-plan">${optionsHtml}</select></td>
                            ${cellsHtml}
                            <td><span class="row-total">0</span></td>
                        </tr>
                    `);

                    $tbody.append($row);

                    if (saved && saved.fee_installment_master_id) {
                        applyPlan($row, saved.fee_installment_master_id, saved.cells);
                    }
                });

                recalcGrandTotal();
            }

            function applyPlan($row, masterId, prefill = {}) {

                // reset all cells first
                $row.find('.cell-amount').each(function() {
                    $(this).val('').prop('disabled', true).data('detail-id', '').closest('td').removeClass(
                        'bg-neutral-50');
                });

                const master = installmentMasters.find(m => m.id == masterId);
                if (!master) {
                    updateRowTotal($row);
                    return;
                }

                master.details.forEach(function(detail) {
                    if (!detail.start_month) return;

                    const $cell = $row.find(`td[data-month="${detail.start_month}"] .cell-amount`);
                    if (!$cell.length) return;

                    $cell.prop('disabled', false)
                        .data('detail-id', detail.id)
                        .closest('td').addClass('bg-neutral-50');

                    if (prefill && prefill[detail.id] !== undefined) {
                        $cell.val(prefill[detail.id]);
                    }
                });

                updateRowTotal($row);
            }

            $(document).on('change', '.row-plan', function() {
                const $row = $(this).closest('tr');
                applyPlan($row, $(this).val());
                recalcGrandTotal();
            });

            $(document).on('input', '.cell-amount', function() {
                updateRowTotal($(this).closest('tr'));
                recalcGrandTotal();
            });

            function updateRowTotal($row) {
                let total = 0;
                $row.find('.cell-amount:enabled').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });
                $row.find('.row-total').text(total.toFixed(2));
            }

            function recalcGrandTotal() {
                let grand = 0;
                $('.row-total').each(function() {
                    grand += parseFloat($(this).text()) || 0;
                });
                $('#grandTotal').text(grand.toFixed(2));
            }

            // Reset the form back to its initial/empty state
            function resetStructureForm() {
                $('#class_id').val('');
                $('#stream_id').val('');
                $('#structure_name').val('');
                $('#matrixTableBody').empty();
                $('#grandTotal').text('0');
                $('#gridWrapper').addClass('d-none');
                $('#selectClassHint').removeClass('d-none');

                feeHeads = [];
                installmentMasters = [];
                existingData = {};
                currentSessionId = null;
            }

            $('#class_id').on('change', function() {
                const classId = $(this).val();
                if (!classId) {
                    $('#gridWrapper').addClass('d-none');
                    $('#selectClassHint').removeClass('d-none');
                    return;
                }
                loadMatrix(classId);
            });

            // "New Structure" -> open blank form
            $('#newStructureBtn').on('click', function() {
                resetStructureForm();
                $('#structureFormWrapper').removeClass('d-none');

                // smooth scroll to the form so the user sees it
                $('html, body').animate({
                    scrollTop: $('#structureFormWrapper').offset().top - 20
                }, 300);
            });

            // Edit an existing structure card -> open form pre-filled
            $(document).on('click', '.structure-list-item', function() {
                $('#structureFormWrapper').removeClass('d-none');

                $('html, body').animate({
                    scrollTop: $('#structureFormWrapper').offset().top - 20
                }, 300);

                loadMatrix($(this).data('class-id'), $(this).data('session-id'));
            });

            // Cancel -> close the whole form panel
            $('#cancelBtn').on('click', function() {
                resetStructureForm();
                $('#structureFormWrapper').addClass('d-none');
            });

            $('#saveStructureBtn').on('click', function() {

                const classId = $('#class_id').val();
                if (!classId) {
                    showToast('Please select a class first.', 'error');
                    return;
                }

                const rows = [];

                $('.fee-row').each(function() {
                    const $row = $(this);
                    const planId = $row.find('.row-plan').val();
                    if (!planId) return;

                    const cells = [];
                    $row.find('.cell-amount:enabled').each(function() {
                        const val = $(this).val();
                        const detailId = $(this).data('detail-id');
                        if (val !== '' && detailId) {
                            cells.push({
                                fee_installment_detail_id: detailId,
                                amount: val
                            });
                        }
                    });

                    if (cells.length === 0) return;

                    rows.push({
                        fee_head_id: $row.data('fee-head-id'),
                        fee_installment_master_id: planId,
                        is_optional: $row.find('.row-optional').is(':checked') ? 1 : 0,
                        cells: cells,
                    });
                });

                if (rows.length === 0) {
                    showToast('Enter at least one fee amount.', 'error');
                    return;
                }

                $.ajax({
                    url: "{{ route('school.feeStructure.save') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        class_id: classId,
                        session_id: currentSessionId,
                        structure_name: $('#structure_name').val(),
                        stream_id: $('#stream_id').val(),
                        rows: rows,
                    },
                    success: function(res) {
                        showToast(res.message, 'success');

                        // refresh the cards list, then close the form
                        fetchFeeStructures();
                        resetStructureForm();
                        $('#structureFormWrapper').addClass('d-none');
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

        });



        function fetchFeeStructures() {
            fetchMasterData("{{ route('school.feeStructure.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, s) {

                        html += `
                          
                            <div class="col-xl-4 col-md-6 mb-3">
                                <div
                                    class="card h-100 radius-16 border border-neutral-200 shadow-2 bg-base transition-all hover-shadow-4 p-20 position-relative d-flex flex-column justify-content-between">

                                    <!-- Top Row: Class Name & Edit Button -->
                                    <div class="d-flex justify-content-between align-items-start gap-12">
                                        <div>
                                            <span
                                                class="badge bg-primary-50 text-primary-600 text-xs fw-semibold px-10 py-4 radius-4 mb-8 d-inline-block">
                                                Class Structure
                                            </span>
                                            <h6 class="fw-bold text-neutral-800 mb-4">
                                                ${s.structure_name}

                                            </h6>
                                        </div>


                                    </div>

                                    <!-- Bottom Row: Structure Name & Trash Button -->
                                    <div
                                        class="d-flex justify-content-between align-items-end pt-16 mt-16 border-top border-neutral-200">
                                        <div>
                                            <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Class
                                                Detail</span>
                                            <span class="fw-semibold text-neutral-700 text-sm">
                                                ${s.class?.name}
                                            </span>
                                        </div>


                                        <div>
                                            <!-- Top Right: Edit Button -->
                                            <button type="button"
                                                class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all structure-list-item"
                                                data-id="${s.id}" data-class-id="${s.class_id}"
                                                data-session-id="${s.session_id}" title="Edit Structure">
                                                <i class="ri-edit-line text-lg"></i>
                                            </button>


                                            <!-- Bottom Right: Delete Button -->
                                            <button type="button"
                                                class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-structure-btn"
                                                data-id="${s.id}" title="Delete Structure">
                                                <i class="ri-delete-bin-6-line text-lg"></i>
                                            </button>



                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            `;
                    });
                } else {
                    html = `
                        <div class="col-xl-12">
                            <div class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No fee structures found.</span>
                            </div>
                        </div>`;
                }

                $("#structureList").html(html);
            });
        }
    </script>
@endpush
