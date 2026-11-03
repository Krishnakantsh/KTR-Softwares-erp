@extends('School.Layout.main')

@section('title', 'KTR ERP : Fee Concession')

@section('dynamic-content')

    @php
        $concessionMonths = [
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Aug',
            '9' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
        ];
    @endphp

    <div class="dashboard-main-body py-24 px-16">

        <div id="concessionFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-discount-percent-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Fee Concession</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select student, then fill concession amount in the
                            relevant fee head / month cells.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">

                {{-- Hidden field actually submitted; component below sets it via callback --}}
                <input type="hidden" id="student_id" value="">

                <div class="row gy-4 mb-24">

                    <div class="col-xl-12 col-md-12">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                            Student <span class="text-danger">*</span>
                        </label>
                        @include('components.student-search')
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                            Concession Type <span class="text-danger">*</span>
                        </label>
                        <select class="form-control custom-premium-input py-12 radius-8" id="concession_type_id">
                        </select>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                            Concession By <span class="text-danger">*</span>
                        </label>
                        <select class="form-control custom-premium-input py-12 radius-8" id="concession_by_id">
                        </select>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                            Mode
                        </label>
                        <div class="d-flex gap-3 pt-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="concession_mode" id="mode_amount"
                                    value="1" checked>
                                <label class="form-check-label" for="mode_amount">Amount</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="concession_mode" id="mode_percent"
                                    value="2">
                                <label class="form-check-label" for="mode_percent">Percentage</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-end">
                        <div class="form-check form-switch p-0 m-0">
                            <label class="switch">
                                <input type="checkbox" role="switch" id="status" value="1" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 ms-8 mb-0">
                            Status
                        </label>
                    </div>

                    <div class="col-xl-12">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                            Description
                        </label>
                        <input type="text" class="form-control custom-premium-input py-12 radius-8" id="description"
                            placeholder="Reason / remarks">
                    </div>
                </div>

                <hr class="border-neutral-200 my-16">

                {{-- ============= MATRIX (Fee Head x Month) ============= --}}
                <div id="concessionMatrixWrapper" class="d-none">

                    <div class="fee-matrix-shell">
                        <div class="table-responsive fee-matrix-scroll">
                            <table class="table align-middle text-center mb-0" id="concessionMatrixTable">
                                <thead>
                                    <tr class="text-xs uppercase text-neutral-600">
                                        <th class="text-start fee-head-col" style="min-width:180px">Fee Head</th>
                                        @foreach ($concessionMonths as $num => $label)
                                            <th data-month="{{ $num }}" style="min-width:110px">
                                                {{ strtoupper($label) }}</th>
                                        @endforeach
                                        <th class="fee-total-col" style="min-width:100px">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="concessionMatrixBody"></tbody>
                                <tfoot>
                                    <tr class="fee-grand-total-row">
                                        <td class="text-start" colspan="{{ 1 + count($concessionMonths) }}">
                                            <i class="ri-calculator-line me-2"></i>Total Concession
                                        </td>
                                        <td id="concessionGrandTotal">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 text-xs text-neutral-500 mt-16">
                        <span class="legend-swatch legend-active"></span> Fee assigned (top = actual amount, bottom =
                        enter concession here)
                        <span class="legend-swatch legend-locked ms-3"></span> Not assigned this month
                    </div>
                </div>

                <div id="concessionNoAssignmentHint" class="text-center py-40 d-none">
                    <span class="text-sm fw-medium text-neutral-500">
                        This student has no fee assigned yet for the active session. Assign a fee structure first.
                    </span>
                </div>

                <div id="concessionSelectStudentHint" class="text-center py-40">
                    <span class="text-sm fw-medium text-neutral-500">Select a student to see their fee matrix.</span>
                </div>

                <div class="d-flex justify-content-end align-items-center gap-3 mt-24">
                    <button type="button" id="resetConcessionForm"
                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold d-flex align-items-center gap-2">
                        <i class="ri-loop-left-line"></i> Reset
                    </button>
                    <button type="button" id="saveConcessionBtn"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm d-flex align-items-center gap-2">
                        <i class="ri-save-3-line"></i> Save Concession
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Same shell pattern as Fee Structure / Fee Assignment matrix pages */
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

        #concessionMatrixTable {
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        #concessionMatrixTable thead th {
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

        #concessionMatrixTable thead th.fee-head-col {
            position: sticky;
            left: 0;
            z-index: 6;
            box-shadow: 2px 0 0 rgba(0, 0, 0, 0.03);
        }

        #concessionMatrixTable thead th.fee-total-col {
            background: #eef1ff;
            color: #3d4bd6;
        }

        #concessionMatrixTable tbody tr:nth-child(even) {
            background-color: #fafbfd;
        }

        #concessionMatrixTable tbody tr:hover {
            background-color: #f2f5ff;
        }

        #concessionMatrixTable tbody td {
            padding: 8px;
            border-bottom: 1px solid #eef0f5;
            vertical-align: middle;
        }

        #concessionMatrixTable tbody td.text-start {
            position: sticky;
            left: 0;
            background: inherit;
            z-index: 2;
            box-shadow: 2px 0 0 rgba(0, 0, 0, 0.02);
        }

        /* Cell: actual amount on top, editable concession input below */
        .cell-actual-amount {
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .cell-editable-wrap {
            position: relative;
        }

        .cell-amount-inline {
            border-radius: 8px;
            border: 1px solid #c3caff;
            background-color: #f6f7ff;
            text-align: center;
            padding: 6px 4px;
            font-weight: 600;
            color: #23263a;
            width: 100%;
        }

        .cell-amount-inline:focus {
            border-color: #4a5bf6;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(74, 91, 246, 0.15);
            outline: none;
        }

        .cell-amount-inline:disabled {
            background-color: #f5f5f7;
            border: 1px dashed #e2e2e8;
            color: #c7c9d4;
        }

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
            background-color: #a9aff5;
            color: white;
            font-size: 14px;
            font-weight: 700;
            padding: 14px 16px;
            border: none;
        }

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
        $(document).ready(function() {

            const MONTHS = @json(array_keys($concessionMonths));

            let currentStudentId = null;
            let currentDetails = []; // flattened student_fee_assignment_details (id, fee_head_id, fee_head_name, start_month, amount)
            let currentConcessions = []; // existing concession rows for this student (any type)

            fetchConcessionTypes();
            fetchConcessionBies();

            /*
            |--------------------------------------------------------------------------
            | Student Search (same pattern as Student Fee Assignment page)
            |--------------------------------------------------------------------------
            */
            initStudentSearch(function(selectedStudentId) {
                $('#student_id').val(selectedStudentId);
                currentStudentId = selectedStudentId;

                if (!selectedStudentId) {
                    showSelectStudentHint();
                    return;
                }

                loadMatrixForStudent(selectedStudentId);
            });

            $('#resetConcessionForm').on('click', resetConcessionForm);

            function resetConcessionForm() {
                $('#student_id').val('');
                $('#concession_type_id').val('');
                $('#concession_by_id').val('');
                $('#mode_amount').prop('checked', true);
                $('#description').val('');
                $('#status').prop('checked', true);

                currentStudentId = null;
                currentDetails = [];
                currentConcessions = [];

                showSelectStudentHint();

                if (typeof clearStudentSearch === 'function') {
                    clearStudentSearch();
                }
            }

            function showSelectStudentHint() {
                $('#concessionMatrixWrapper').addClass('d-none');
                $('#concessionNoAssignmentHint').addClass('d-none');
                $('#concessionSelectStudentHint').removeClass('d-none');
            }

            /*
            |--------------------------------------------------------------------------
            | Load matrix data (assignment details + existing concessions)
            |--------------------------------------------------------------------------
            */
            function loadMatrixForStudent(studentId) {

                $.get("{{ route('school.feeConcession.assignmentDetails') }}", {
                    student_id: studentId
                }, function(res) {

                    if (!res.status) return;

                    currentDetails = res.data.details || [];
                    currentConcessions = res.data.concessions || [];

                    if (currentDetails.length === 0) {
                        $('#concessionMatrixWrapper').addClass('d-none');
                        $('#concessionSelectStudentHint').addClass('d-none');
                        $('#concessionNoAssignmentHint').removeClass('d-none');
                        return;
                    }

                    $('#concessionSelectStudentHint').addClass('d-none');
                    $('#concessionNoAssignmentHint').addClass('d-none');
                    $('#concessionMatrixWrapper').removeClass('d-none');

                    renderConcessionMatrix();
                    prefillExistingConcession();
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Auto-prefill shared fields (Concession Type / By / Mode / Description /
            | Status) + cell values, agar is student ke liye concession pehle se
            | set hai (kisi bhi concession type ke liye). Agar abhi tak kuch set
            | nahi hai, to form apne default / blank state mein hi rahega.
            |--------------------------------------------------------------------------
            */
            function prefillExistingConcession() {

                if (currentConcessions.length > 0) {

                    const first = currentConcessions[0];

                    $('#concession_type_id').val(first.concession_type_id);
                    $('#concession_by_id').val(first.concession_by_id);
                    $(`input[name=concession_mode][value=${first.concession_mode}]`).prop('checked', true);
                    $('#description').val(first.description || '');
                    $('#status').prop('checked', first.status == 1);

                } else {

                    $('#concession_type_id').val('');
                    $('#concession_by_id').val('');
                    $('#mode_amount').prop('checked', true);
                    $('#description').val('');
                    $('#status').prop('checked', true);
                }

                refreshConcessionInputs();
            }

            /*
            |--------------------------------------------------------------------------
            | Render matrix: group details by fee_head, place under month column.
            | Each active cell = actual amount (top) + editable concession input (bottom).
            |--------------------------------------------------------------------------
            */
            function renderConcessionMatrix() {

                const $tbody = $('#concessionMatrixBody').empty();
                const groups = {};
                const order = [];

                currentDetails.forEach(function(detail) {

                    const headId = detail.fee_head_id;

                    if (!groups[headId]) {
                        groups[headId] = {
                            head_name: detail.fee_head_name,
                            cells: {}
                        };
                        order.push(headId);
                    }

                    if (detail.start_month !== null && detail.start_month !== undefined) {
                        groups[headId].cells[String(detail.start_month)] = detail;
                    }
                });

                order.forEach(function(headId) {

                    const g = groups[headId];
                    let cellsHtml = '';

                    MONTHS.forEach(function(m) {

                        const detail = g.cells[m];

                        if (detail) {
                            cellsHtml += `
                                <td data-month="${m}">
                                    <div class="cell-editable-wrap">
                                        <div class="cell-actual-amount">₹${detail.amount}</div>
                                        <input type="number" step="0.01" min="0"
                                            class="cell-amount-inline concession-input"
                                            data-detail-id="${detail.id}" placeholder="0">
                                    </div>
                                </td>`;
                        } else {
                            cellsHtml += `
                                <td data-month="${m}">
                                    <input type="text" class="cell-amount-inline" disabled value="">
                                </td>`;
                        }
                    });

                    const $row = $(`
                        <tr class="fee-row" data-fee-head-id="${headId}">
                            <td class="text-start fw-semibold">${g.head_name}</td>
                            ${cellsHtml}
                            <td><span class="row-total">0</span></td>
                        </tr>
                    `);

                    $tbody.append($row);
                    updateRowTotal($row);
                });

                recalcGrandTotal();
                refreshConcessionInputs();
            }

            // Re-fill the concession inputs to match the CURRENTLY selected
            // Concession Type — a detail can have different concession values
            // per concession type (unique per session+student+detail+type).
            // Jis cell ke liye concession pehle se set hai, uski value yahan
            // dikh jaayegi; jiske liye nahi bana, wo khaali (blank) rahega.
            function refreshConcessionInputs() {

                const typeId = $('#concession_type_id').val();

                $('.concession-input').each(function() {

                    const detailId = $(this).data('detail-id');
                    let match = null;

                    if (typeId) {
                        match = currentConcessions.find(c =>
                            c.student_fee_assignment_detail_id == detailId &&
                            c.concession_type_id == typeId
                        );
                    }

                    $(this).val(match ? match.concession_value : '');
                });

                $('.fee-row').each(function() {
                    updateRowTotal($(this));
                });
                recalcGrandTotal();
            }

            $('#concession_type_id').on('change', refreshConcessionInputs);

            $(document).on('input', '.concession-input', function() {
                updateRowTotal($(this).closest('tr'));
                recalcGrandTotal();
            });

            function updateRowTotal($row) {
                let total = 0;
                $row.find('.concession-input').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });
                $row.find('.row-total').text(total.toFixed(2));
            }

            function recalcGrandTotal() {
                let grand = 0;
                $('.concession-input').each(function() {
                    grand += parseFloat($(this).val()) || 0;
                });
                $('#concessionGrandTotal').text(grand.toFixed(2));
            }

            /*
            |--------------------------------------------------------------------------
            | Save (bulk) — collects every filled cell + shared fields, posts once
            |--------------------------------------------------------------------------
            */
            $('#saveConcessionBtn').on('click', function() {

                if (!currentStudentId) {
                    showToast('Please select a student.', 'error');
                    return;
                }

                const typeId = $('#concession_type_id').val();
                const byId = $('#concession_by_id').val();

                if (!typeId) {
                    showToast('Please select a concession type.', 'error');
                    return;
                }
                if (!byId) {
                    showToast('Please select who is giving the concession.', 'error');
                    return;
                }

                const cells = [];

                $('.concession-input').each(function() {
                    const val = $(this).val();
                    if (val !== '' && parseFloat(val) >= 0) {
                        cells.push({
                            detail_id: $(this).data('detail-id'),
                            value: val,
                        });
                    }
                });

                if (cells.length === 0) {
                    showToast('Enter concession amount in at least one cell.', 'error');
                    return;
                }

                $.ajax({
                    url: "{{ route('school.feeConcession.save') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        student_id: currentStudentId,
                        concession_type_id: typeId,
                        concession_by_id: byId,
                        concession_mode: $('input[name=concession_mode]:checked').val(),
                        description: $('#description').val(),
                        status: $('#status').is(':checked') ? 1 : 0,
                        cells: cells,
                    },
                    success: function(res) {
                        if (!res.status) {
                            showToast(res.message, 'error');
                            return;
                        }
                        showToast(res.message, 'success');
                        loadMatrixForStudent(currentStudentId); // refresh with saved values
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });
        });

        function fetchConcessionTypes() {
            fetchMasterData("{{ route('school.concession.type.fetch') }}", function(res) {
                let html = '<option value="">-- Select --</option>';
                if (res.status) {
                    $.each(res.data, function(i, row) {
                        html += `<option value="${row.id}">${row.name}</option>`;
                    });
                }
                $('#concession_type_id').html(html);
            });
        }

        function fetchConcessionBies() {
            fetchMasterData("{{ route('school.concession.by.fetch') }}", function(res) {
                let html = '<option value="">-- Select --</option>';
                if (res.status) {
                    $.each(res.data, function(i, row) {
                        html += `<option value="${row.id}">${row.name}</option>`;
                    });
                }
                $('#concession_by_id').html(html);
            });
        }
    </script>
@endpush