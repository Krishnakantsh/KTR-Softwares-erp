@extends('School.Layout.main')

@section('title', 'KTR ERP : Student Fee Assignment')

@section('dynamic-content')

    @php
        $assignMonths = [
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


        <!-- Student Search Bar -->
        <div class="row mb-12">
            <div class="col-xl-12 col-lg-12">
                {{-- Component include yahan karenge --}}
                @include('components.student-search')
            </div>
        </div>

        <!-- Selected Student Info Strip -->
        <div class="row g-8 gap-16 d-none" id="studentInfoStrip">
            <div class="col-xl-12">
                <div
                    class="shadow-2 radius-16 bg-base border border-neutral-200 p-20 d-flex align-items-center gap-24 flex-wrap">

                    <img id="studentInfoPhoto" src="{{ asset('assets/images/_ (11).jpeg') }}" class="rounded-circle"
                        style="width:64px;height:64px;object-fit:cover;" alt="student">

                    <div>
                        <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Student</span>
                        <span class="fw-bold text-neutral-800" id="studentInfoName">-</span>
                    </div>

                    <div>
                        <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Adm No</span>
                        <span class="fw-semibold text-neutral-700" id="studentInfoAdm">-</span>
                    </div>

                    <div>
                        <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Class / Section</span>
                        <span class="fw-semibold text-neutral-700" id="studentInfoClass">-</span>
                    </div>

                    <div>
                        <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Father</span>
                        <span class="fw-semibold text-neutral-700" id="studentInfoFather">-</span>
                    </div>

                    <div class="ms-auto">
                        <span class="badge text-xs fw-semibold px-10 py-4 radius-4" id="assignmentStatusBadge">-</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP A: No assignment yet -> pick a structure -->
        <div class="row g-8 gap-16 d-none mt-16" id="pickStructureWrapper">
            <div class="col-xl-12">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">

                    <div class="card-header border-bottom bg-base py-20 px-28">
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900" id="pickStructureTitle">Assign Fee Structure</h5>
                        <p class="text-xs text-neutral-500 mb-0">Only structures matching this student's class are shown.
                        </p>
                    </div>

                    <div class="card-body p-28">

                        <div class="row gy-4 mb-24">

                            <div class="col-xl-6 col-md-8">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Fee Structure <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control custom-premium-input py-12 radius-8" id="fee_structure_id">
                                        <option value="">-- Select Structure --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-8">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Remarks
                                    </label>
                                    <input type="text" class="form-control custom-premium-input py-12 radius-8"
                                        id="remarks" placeholder="Optional remarks">
                                </div>
                            </div>

                        </div>

                        <div id="noStructureHint" class="text-center py-24 d-none">
                            <span class="text-sm fw-medium text-neutral-500">
                                No fee structure found for this student's class. Please create one first.
                            </span>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" id="assignBtn"
                                class="btn btn-primary bg-primary-600 text-white px-28 py-12 radius-8 fw-semibold border-0">
                                <i class="ri-checkbox-circle-line"></i> <span id="assignBtnLabel">Assign Fee
                                    Structure</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- STEP B: Already assigned -> show as a matrix (Fee Head rows x Month columns) -->
        <div class="row g-8 gap-16 d-none mt-16" id="assignmentViewWrapper">
            <div class="col-xl-12">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">

                    <div
                        class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="text-xl fw-bold mb-2 text-neutral-900" id="assignedStructureName">-</h5>
                            <p class="text-xs text-neutral-500 mb-0">
                                Assigned on <span id="assignedDate">-</span>
                                <span id="assignedRemarksWrap" class="d-none"> &middot; Remarks: <span
                                        id="assignedRemarks"></span></span>
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" id="reAssignToggleBtn"
                                class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-16 py-10 radius-8 fw-semibold">
                                <i class="ri-repeat-line"></i> Change Structure
                            </button>
                            <button type="button" id="deleteAssignmentBtn"
                                class="btn bg-danger-50 border border-danger-200 text-danger-700 px-16 py-10 radius-8 fw-semibold">
                                <i class="ri-delete-bin-6-line"></i> Delete Assignment
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-28">

                        <div class="fee-matrix-shell">
                            <div class="table-responsive fee-matrix-scroll">
                                <table class="table align-middle text-center mb-0" id="assignmentDetailsTable">
                                    <thead>
                                        <tr class="text-xs uppercase text-neutral-600">
                                            <th class="text-start fee-head-col" style="min-width:180px">Fee Head</th>
                                            <th class="fee-flag-col" style="min-width:80px">Optional</th>
                                            <th class="fee-flag-col" style="min-width:90px">Concession</th>
                                            <th class="fee-flag-col" style="min-width:70px">Fine</th>
                                            @foreach ($assignMonths as $num => $label)
                                                <th data-month="{{ $num }}" style="min-width:100px">
                                                    {{ strtoupper($label) }}</th>
                                            @endforeach
                                            <th class="fee-total-col" style="min-width:100px">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="assignmentDetailsBody"></tbody>
                                    <tfoot>
                                        <tr class="fee-grand-total-row">
                                            <td class="text-start" colspan="{{ 4 + count($assignMonths) }}">
                                                <i class="ri-calculator-line me-2"></i>Grand Total
                                            </td>
                                            <td id="assignmentGrandTotal">0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 text-xs text-neutral-500 mt-16">
                            <span class="legend-swatch legend-active"></span> Assigned month (editable amount)
                            <span class="legend-swatch legend-locked ms-3"></span> Not part of this head's plan
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        /* ---------- Matrix shell (same pattern as Fee Structure page) ---------- */
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

        #assignmentDetailsTable {
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        #assignmentDetailsTable thead th {
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

        #assignmentDetailsTable thead th.fee-head-col {
            position: sticky;
            left: 0;
            z-index: 6;
            box-shadow: 2px 0 0 rgba(0, 0, 0, 0.03);
        }

        #assignmentDetailsTable thead th.fee-total-col {
            background: #eef1ff;
            color: #3d4bd6;
        }

        #assignmentDetailsTable tbody tr:nth-child(even) {
            background-color: #fafbfd;
        }

        #assignmentDetailsTable tbody tr:hover {
            background-color: #f2f5ff;
        }

        #assignmentDetailsTable tbody td {
            padding: 8px;
            border-bottom: 1px solid #eef0f5;
            vertical-align: middle;
        }

        #assignmentDetailsTable tbody td.text-start {
            position: sticky;
            left: 0;
            background: inherit;
            z-index: 2;
            box-shadow: 2px 0 0 rgba(0, 0, 0, 0.02);
        }

        /* ---------- Amount cell + inline remove button ---------- */
        .cell-editable-wrap {
            position: relative;
        }

        .cell-amount-inline {
            border-radius: 8px;
            border: 1px solid #c3caff;
            background-color: #f6f7ff;
            text-align: center;
            padding: 7px 4px;
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

        .cell-remove-btn {
            position: absolute;
            top: -7px;
            right: -6px;
            width: 18px;
            height: 18px;
            line-height: 16px;
            border-radius: 50%;
            border: 1px solid #f3b4b4;
            background: #fff0f0;
            color: #d64545;
            font-size: 11px;
            padding: 0;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .cell-editable-wrap:hover .cell-remove-btn {
            display: flex;
        }

        /* ---------- Row / grand total ---------- */
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

        .flag-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .flag-yes {
            background-color: #16a34a;
        }

        .flag-no {
            background-color: #d1d5db;
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
        $(function() {

            let students = [];
            let currentStudentId = null;
            let currentStudentClassId = null;
            let currentAssignmentId = null;
            let allStructures = [];
            let isReassignMode = false;

            // Month keys in display order (Apr -> Mar), same convention as Fee Structure matrix
            const MONTHS = @json(array_keys($assignMonths));

            // Search Initializer call karein aur callback pass karein
            initStudentSearch(function(selectedStudentId) {
                currentStudentId = selectedStudentId;
                loadStudentAndAssignment(selectedStudentId);
            });

            function loadStudentAndAssignment(studentId) {

                $.ajax({
                    url: "{{ route('student.show.with') }}",
                    type: "GET",
                    data: {
                        id: studentId
                    },
                    success: function(response) {

                        let res = response.data;

                        currentStudentClassId = res.class_id;

                        $('#studentInfoStrip').removeClass('d-none');
                        $('#studentInfoName').text(res.first_name + ' ' + res.last_name);
                        $('#studentInfoAdm').text(res.admission_no);
                        $('#studentInfoClass').text((res.class_master?.name || '-') + ' / ' + (res
                            .section
                            ?.name || '-'));

                        let father = (res.parents || []).find(p => p.parent_type === 'father');
                        $('#studentInfoFather').text(father ? father.name : '-');

                        if (res.student_photo) {
                            $('#studentInfoPhoto').attr('src', '{{ asset('') }}' + res
                                .student_photo);
                        }

                        // Check if this student already has a fee assignment for the active session
                        $.ajax({
                            url: "{{ route('school.studentFeeAssignment.byStudent') }}",
                            type: "GET",
                            data: {
                                student_id: studentId
                            },
                            success: function(assignRes) {

                                if (assignRes.status && assignRes.data) {
                                    currentAssignmentId = assignRes.data.id;
                                    showAssignmentView(assignRes.data);
                                } else {
                                    currentAssignmentId = null;
                                    showPickStructureView();
                                }
                            },
                            error: function() {
                                currentAssignmentId = null;
                                showPickStructureView();
                            }
                        });
                    }
                });
            }

            /*
            |--------------------------------------------------------------------------
            | 3. STRUCTURE PICKER (for new assignment / re-assignment)
            |--------------------------------------------------------------------------
            */

            function loadStructuresForClass(classId) {

                fetchMasterData("{{ route('school.feeStructure.fetch.with') }}", function(res) {

                    allStructures = (res.data || []).filter(s => s.class_id == classId);

                    let options = '<option value="">-- Select Structure --</option>';
                    allStructures.forEach(function(s) {
                        options += `<option value="${s.id}">${s.structure_name}</option>`;
                    });

                    $('#fee_structure_id').html(options);

                    if (allStructures.length === 0) {
                        $('#noStructureHint').removeClass('d-none');
                        $('#assignBtn').prop('disabled', true);
                    } else {
                        $('#noStructureHint').addClass('d-none');
                        $('#assignBtn').prop('disabled', false);
                    }
                });
            }

            function showPickStructureView() {

                isReassignMode = false;

                $('#assignmentStatusBadge').text('Not Assigned')
                    .removeClass('bg-primary-50 text-primary-600')
                    .addClass('bg-danger-50 text-danger-700');

                $('#pickStructureTitle').text('Assign Fee Structure');
                $('#assignBtnLabel').text('Assign Fee Structure');
                $('#remarks').val('');
                $('#fee_structure_id').val('');

                $('#assignmentViewWrapper').addClass('d-none');
                $('#pickStructureWrapper').removeClass('d-none');

                loadStructuresForClass(currentStudentClassId);
            }

            $('#assignBtn').on('click', function() {

                const structureId = $('#fee_structure_id').val();

                if (!structureId) {
                    showToast('Please select a fee structure.', 'error');
                    return;
                }

                const url = isReassignMode ?
                    "{{ route('school.studentFeeAssignment.reAssign') }}" :
                    "{{ route('school.studentFeeAssignment.assign') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        student_id: currentStudentId,
                        fee_structure_id: structureId,
                        remarks: $('#remarks').val(),
                    },
                    success: function(res) {

                        if (!res.status) {
                            showToast(res.message, 'error');
                            return;
                        }

                        showToast(res.message, 'success');
                        currentAssignmentId = res.assignment_id;
                        loadAssignmentDetail(currentAssignmentId);
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            $('#reAssignToggleBtn').on('click', function() {
                isReassignMode = true;

                $('#assignmentViewWrapper').addClass('d-none');
                $('#pickStructureWrapper').removeClass('d-none');
                $('#pickStructureTitle').text('Change Fee Structure (Re-assign)');
                $('#assignBtnLabel').text('Re-assign Fee Structure');

                loadStructuresForClass(currentStudentClassId);
            });

            /*
            |--------------------------------------------------------------------------
            | 4. ASSIGNMENT VIEW (matrix) - Fee Head rows x Month columns
            |--------------------------------------------------------------------------
            */

            function loadAssignmentDetail(assignmentId) {

                $.ajax({
                    url: "{{ url('fee-assignment/show') }}/" + assignmentId,
                    type: "GET",
                    success: function(res) {
                        if (res.status) {
                            showAssignmentView(res.data);
                        }
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            }

            function showAssignmentView(assignment) {

                $('#assignmentStatusBadge').text('Assigned')
                    .removeClass('bg-danger-50 text-danger-700')
                    .addClass('bg-primary-50 text-primary-600');

                $('#pickStructureWrapper').addClass('d-none');
                $('#assignmentViewWrapper').removeClass('d-none');

                $('#assignedStructureName').text(assignment.fee_structure?.structure_name || 'Fee Structure');

                $('#assignedDate').text(formatDate(assignment.assigned_date));

                if (assignment.remarks) {
                    $('#assignedRemarksWrap').removeClass('d-none');
                    $('#assignedRemarks').text(assignment.remarks);
                } else {
                    $('#assignedRemarksWrap').addClass('d-none');
                }

                renderAssignmentMatrix(assignment.details || []);
            }

            // Group flat detail rows into one row per Fee Head, placed under their month column.
            // NOTE: expects each detail to carry a month indicator (detail.installment.start_month).
            // If your API doesn't send this yet, add it to the fee-assignment show/byStudent response.
            function renderAssignmentMatrix(details) {

                const $tbody = $('#assignmentDetailsBody').empty();
                const groups = {};
                const order = [];

                details.forEach(function(detail) {

                    const headId = detail.fee_head?.id ?? detail.fee_head_id ?? ('head_' + detail.id);

                    if (!groups[headId]) {
                        groups[headId] = {
                            head_name: detail.fee_head?.head_name || '-',
                            is_optional: !!detail.is_optional,
                            allow_concession: !!detail.allow_concession,
                            allow_fine: !!detail.allow_fine,
                            cells: {}
                        };
                        order.push(headId);
                    }

                    const month = detail.installment?.start_month ?? detail.start_month ?? null;

                    if (month !== null && month !== undefined) {
                        groups[headId].cells[String(month)] = detail;
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
                                        <input type="number" step="0.01" min="0"
                                            class="cell-amount-inline detail-amount-input"
                                            data-detail-id="${detail.id}" value="${detail.amount}">
                                        <button type="button" class="cell-remove-btn remove-head-btn"
                                            data-detail-id="${detail.id}" title="Remove this month">
                                            <i class="ri-close-line"></i>
                                        </button>
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
                            <td><span class="flag-dot ${g.is_optional ? 'flag-yes' : 'flag-no'}"></span></td>
                            <td><span class="flag-dot ${g.allow_concession ? 'flag-yes' : 'flag-no'}"></span></td>
                            <td><span class="flag-dot ${g.allow_fine ? 'flag-yes' : 'flag-no'}"></span></td>
                            ${cellsHtml}
                            <td><span class="row-total">0</span></td>
                        </tr>
                    `);

                    $tbody.append($row);
                    updateAssignmentRowTotal($row);
                });

                recalcAssignmentGrandTotal();
            }

            function updateAssignmentRowTotal($row) {
                let total = 0;
                $row.find('.detail-amount-input').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });
                $row.find('.row-total').text(total.toFixed(2));
            }

            function recalcAssignmentGrandTotal() {
                let grand = 0;
                $('.detail-amount-input').each(function() {
                    grand += parseFloat($(this).val()) || 0;
                });
                $('#assignmentGrandTotal').text(grand.toFixed(2));
            }

            // Update a single line item's amount (behaviour unchanged - same endpoint/flow as before)
            $(document).on('change', '.detail-amount-input', function() {

                const $row = $(this).closest('tr');
                const detailId = $(this).data('detail-id');
                const amount = $(this).val();

                $.ajax({
                    url: "{{ route('school.studentFeeAssignment.updateAmount') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        detail_id: detailId,
                        amount: amount,
                    },
                    success: function(res) {
                        showToast(res.message, 'success');
                        updateAssignmentRowTotal($row);
                        recalcAssignmentGrandTotal();
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            // Remove a single fee head/month from the assignment (behaviour unchanged, now per-cell)
            $(document).on('click', '.remove-head-btn', function() {

                if (!confirm('Remove this fee head from the assignment?')) return;

                const $td = $(this).closest('td');
                const $row = $(this).closest('tr');
                const detailId = $(this).data('detail-id');

                $.ajax({
                    url: "{{ route('school.studentFeeAssignment.removeHead') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        detail_id: detailId,
                    },
                    success: function(res) {
                        showToast(res.message, 'success');
                        $td.html(
                            '<input type="text" class="cell-amount-inline" disabled value="">'
                        );
                        updateAssignmentRowTotal($row);
                        recalcAssignmentGrandTotal();
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            // Delete the whole assignment
            $('#deleteAssignmentBtn').on('click', function() {

                if (!confirm('Delete this student\'s entire fee assignment? This cannot be undone.'))
                    return;

                $.ajax({
                    url: "{{ route('school.studentFeeAssignment.destroy') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                        assignment_id: currentAssignmentId,
                    },
                    success: function(res) {
                        showToast(res.message, 'success');
                        currentAssignmentId = null;
                        showPickStructureView();
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

        });
    </script>
@endpush
