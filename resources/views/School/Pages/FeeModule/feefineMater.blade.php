@extends('School.Layout.main')

@section('title', 'KTR ERP : Fine Master')

@section('dynamic-content')
    <div class="dashboard-main-body py-24 px-16">

        <!-- Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-24 bg-white p-3 rounded-2xl flex-wrap gap-2">
            <h5 class="fw-bold text-neutral-800 mb-0">Fine Master</h5>
            <ul class="d-flex align-items-center gap-2 text-sm mb-0" style="list-style:none;">
                <li class="text-neutral-500"><i class="ri-home-4-line"></i></li>
                <li class="text-neutral-500">&middot; Fees</li>
                <li class="text-neutral-800 fw-semibold">&middot; Fine Master</li>
            </ul>
        </div>

        <!-- List of existing Fine Masters -->
        <div class="row mb-3" id="fineMasterList"></div>

        <!-- Floating "New" button -->
        <button type="button" id="newFineBtn"
            class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center position-fixed"
            style="width:56px;height:56px;bottom:32px;right:32px;z-index:1050;">
            <i class="ri-add-line text-2xl"></i>
        </button>

    </div>



    <!-- ============================================================ -->
    <!-- FINE MASTER MODAL                                              -->
    <!-- ============================================================ -->

    <div class="fine-modal-backdrop d-none" id="fineModalBackdrop">
        <div class="fine-modal-card">

            <div class="fine-modal-header">
                <h5 class="mb-0 fw-bold text-uppercase" id="fineModalTitle">Fine Master</h5>
                <button type="button" class="fine-modal-close" id="fineModalCloseBtn">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <div class="fine-modal-body">

                <div class="row gy-4 mb-20">

                    <div class="col-xl-3 col-md-6">
                        <div class="premium-input-box position-relative">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                Fine Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control custom-premium-input py-12 radius-8" id="fine_name"
                                placeholder="e.g., Tuition Late Fine">
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="premium-input-box position-relative">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                Fine Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-control custom-premium-input py-12 radius-8" id="fine_type">
                                <option value="1">Fixed</option>
                                <option value="2">Per Day</option>
                                <option value="3" selected>Monthly</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6" id="periodWrapper">
                        <div class="premium-input-box position-relative">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                Period <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="1" max="31"
                                class="form-control custom-premium-input py-12 radius-8" id="period_days"
                                placeholder="e.g., 15">
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="premium-input-box position-relative">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                Grace Days
                            </label>
                            <input type="number" min="0" class="form-control custom-premium-input py-12 radius-8"
                                id="grace_days" value="0">
                        </div>
                    </div>

                </div>

                <!-- SIMPLE MODE (Fixed / Per Day) -->
                <div id="simpleWrapper" class="d-none">

                    <div class="table-responsive mb-16">
                        <table class="table align-middle mb-0" id="simpleRulesTable">
                            <thead>
                                <tr class="text-xs uppercase text-neutral-600">
                                    <th class="text-start">From Day</th>
                                    <th class="text-start">To Day</th>
                                    <th class="text-start">Fine Amount</th>
                                    <th style="width:60px"></th>
                                </tr>
                            </thead>
                            <tbody id="simpleRulesBody"></tbody>
                        </table>
                    </div>

                    <button type="button" id="addSimpleRowBtn"
                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-16 py-10 radius-8 fw-semibold">
                        <i class="ri-add-line"></i> Add Row
                    </button>
                </div>

                <!-- MATRIX MODE (Monthly) -->
                <div id="matrixWrapper" class="d-none">

                    <div class="fine-matrix-shell">
                        <div class="table-responsive fine-matrix-scroll">
                            <table class="table align-middle text-center mb-0" id="fineMatrixTable">
                                <thead>
                                    <tr class="text-xs uppercase">
                                        <th style="min-width:60px">S.NO.</th>
                                        <th class="fee-head-col" style="min-width:110px">MONTH</th>
                                        <th style="min-width:70px">START</th>
                                        <th style="min-width:70px">END</th>
                                        <th style="min-width:88px">APR</th>
                                        <th style="min-width:88px">MAY</th>
                                        <th style="min-width:88px">JUN</th>
                                        <th style="min-width:88px">JUL</th>
                                        <th style="min-width:88px">AUG</th>
                                        <th style="min-width:88px">SEP</th>
                                        <th style="min-width:88px">OCT</th>
                                        <th style="min-width:88px">NOV</th>
                                        <th style="min-width:88px">DEC</th>
                                        <th style="min-width:88px">JAN</th>
                                        <th style="min-width:88px">FEB</th>
                                        <th style="min-width:88px">MAR</th>
                                    </tr>
                                </thead>
                                <tbody id="fineMatrixBody"></tbody>
                            </table>
                        </div>
                    </div>

                    <div id="noPeriodHint" class="text-center py-24">
                        <span class="text-sm fw-medium text-neutral-500">Enter a period to generate the fine
                            matrix rows.</span>
                    </div>

                </div>

            </div>

            <div class="fine-modal-footer">
                <button type="button" id="cancelFineBtn"
                    class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-24 py-12 radius-8 fw-semibold">
                    Cancel
                </button>
                <button type="button" id="saveFineBtn"
                    class="btn btn-primary bg-primary-600 text-white px-28 py-12 radius-8 fw-semibold border-0">
                    <span id="saveFineBtnLabel">Add</span>
                </button>
            </div>

        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* ============================================================ */
        /* Modal shell -- matches the screenshot's white rounded card    */
        /* ============================================================ */
        .fine-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(20, 22, 34, 0.55);
            z-index: 1060;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .fine-modal-card {
            background: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 1400px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 24px 60px rgba(16, 24, 40, 0.25);
            overflow: hidden;
        }

        .fine-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 32px;
            border-bottom: 1px solid #eef0f5;
        }

        .fine-modal-header h5 {
            letter-spacing: .04em;
            color: #23263a;
        }

        .fine-modal-close {
            background: none;
            border: none;
            font-size: 22px;
            color: #8a8fa3;
            line-height: 1;
            cursor: pointer;
        }

        .fine-modal-close:hover {
            color: #23263a;
        }

        .fine-modal-body {
            padding: 24px 32px;
            overflow-y: auto;
            flex: 1;
        }

        .fine-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 18px 32px;
            border-top: 1px solid #eef0f5;
        }

        /* ============================================================ */
        /* Matrix table                                                   */
        /* ============================================================ */
        .fine-matrix-shell {
            border: 1px solid #e9ecf1;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(16, 24, 40, 0.04);
        }

        .fine-matrix-scroll {
            max-height: 460px;
            overflow: auto;
        }

        #fineMatrixTable {
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        #fineMatrixTable thead th {
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

        #fineMatrixTable tbody tr:nth-child(even) {
            background-color: #fafbfd;
        }

        #fineMatrixTable tbody tr:hover {
            background-color: #f2f5ff;
        }

        #fineMatrixTable tbody td {
            padding: 8px;
            border-bottom: 1px solid #eef0f5;
            vertical-align: middle;
        }

        .cell-fine-amount {
            border-radius: 8px;
            border: 1px solid #c3caff;
            background-color: #f6f7ff;
            text-align: center;
            padding: 7px 4px;
            font-weight: 600;
            color: #23263a;
            width: 100%;
        }

        .cell-fine-amount:focus {
            border-color: #4a5bf6;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(74, 91, 246, 0.15);
            outline: none;
        }

        .simple-input {
            border-radius: 8px;
            border: 1px solid #dfe2ea;
            padding: 7px 10px;
            width: 100%;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {

            /*
            |--------------------------------------------------------------------------
            | Calendar reference (Apr -> Mar academic year order + standard day counts)
            |--------------------------------------------------------------------------
            */
            const MONTH_ORDER = ['4', '5', '6', '7', '8', '9', '10', '11', '12', '1', '2', '3'];

            const MONTH_META = {
                '4': {
                    label: 'April',
                    days: 30
                },
                '5': {
                    label: 'May',
                    days: 31
                },
                '6': {
                    label: 'June',
                    days: 30
                },
                '7': {
                    label: 'July',
                    days: 31
                },
                '8': {
                    label: 'August',
                    days: 31
                },
                '9': {
                    label: 'September',
                    days: 30
                },
                '10': {
                    label: 'October',
                    days: 31
                },
                '11': {
                    label: 'November',
                    days: 30
                },
                '12': {
                    label: 'December',
                    days: 31
                },
                '1': {
                    label: 'January',
                    days: 31
                },
                '2': {
                    label: 'February',
                    days: 28
                },
                '3': {
                    label: 'March',
                    days: 31
                },
            };

            let monthNameToId = {}; // 'april' -> transport_month id
            let currentFineId = null;
            let existingMatrix = {}; // rowKey -> { target_month_id: amount }

            fetchFineMasters();
            loadMonths();

            /*
            |--------------------------------------------------------------------------
            | Load month master (reused from transport_months) once
            |--------------------------------------------------------------------------
            */
            function loadMonths() {
                fetchMasterData("{{ route('school.transport_month.fetch') }}", function(res) {
                    monthNameToId = {};
                    (res.data || []).forEach(function(m) {
                        monthNameToId[m.month_name.toLowerCase()] = m.id;
                    });
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Row generation: split each month (Apr -> Mar) into `period`-day chunks.
            | First month skips the first `period` days (matches reference matrix:
            | Period=15 -> April 16-30, May 1-15/16-30/31-31, ...).
            |--------------------------------------------------------------------------
            */
            function generateRows(period) {

                const rows = [];

                MONTH_ORDER.forEach(function(monthKey, idx) {

                    const meta = MONTH_META[monthKey];
                    let start = (idx === 0) ? (period + 1) : 1;

                    while (start <= meta.days) {
                        const end = Math.min(start + period - 1, meta.days);

                        rows.push({
                            serial: idx + 1,
                            month_key: monthKey,
                            month_label: meta.label,
                            from_day: start,
                            to_day: end,
                        });

                        start = end + 1;
                    }
                });

                return rows;
            }

            function renderMatrix(period) {

                const $tbody = $('#fineMatrixBody').empty();
                period = parseInt(period);

                if (!period || period < 1) {
                    $('#noPeriodHint').removeClass('d-none');
                    $('#fineMatrixTable').addClass('d-none');
                    return;
                }

                $('#noPeriodHint').addClass('d-none');
                $('#fineMatrixTable').removeClass('d-none');

                const rows = generateRows(period);

                rows.forEach(function(row) {

                    const rowMonthId = monthNameToId[row.month_label.toLowerCase()] || '';
                    const rowKey = rowMonthId + '_' + row.from_day + '_' + row.to_day;
                    const savedCells = existingMatrix[rowKey] || {};

                    let cellsHtml = '';

                    MONTH_ORDER.forEach(function(targetKey) {

                        const targetMonthId = monthNameToId[MONTH_META[targetKey].label
                            .toLowerCase()] || '';
                        const savedVal = savedCells[targetMonthId];

                        cellsHtml += `
                            <td>
                                <input type="number" step="0.01" min="0"
                                    class="cell-fine-amount fine-cell-input"
                                    data-row-key="${rowKey}"
                                    data-row-month-id="${rowMonthId}"
                                    data-from-day="${row.from_day}"
                                    data-to-day="${row.to_day}"
                                    data-target-month-id="${targetMonthId}"
                                    value="${savedVal !== undefined ? savedVal : ''}">
                            </td>`;
                    });

                    const $row = $(`
                        <tr>
                            <td>${row.serial}</td>
                            <td class="text-start fw-semibold">${row.month_label}</td>
                            <td>${row.from_day}</td>
                            <td>${row.to_day}</td>
                            ${cellsHtml}
                        </tr>
                    `);

                    $tbody.append($row);
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Fine Type toggle: matrix (Monthly) vs simple rows (Fixed / Per Day)
            |--------------------------------------------------------------------------
            */
            $('#fine_type').on('change', function() {

                const type = $(this).val();

                if (type == 3) {
                    $('#periodWrapper').removeClass('d-none');
                    $('#matrixWrapper').removeClass('d-none');
                    $('#simpleWrapper').addClass('d-none');
                    renderMatrix($('#period_days').val());
                } else {
                    $('#periodWrapper').addClass('d-none');
                    $('#matrixWrapper').addClass('d-none');
                    $('#simpleWrapper').removeClass('d-none');
                }
            });

            $('#period_days').on('input', function() {
                renderMatrix($(this).val());
            });

            /*
            |--------------------------------------------------------------------------
            | Simple mode rows (Fixed / Per Day)
            |--------------------------------------------------------------------------
            */
            function addSimpleRow(fromDay = '', toDay = '', amount = '') {
                const $row = $(`
                    <tr>
                        <td><input type="number" min="0" class="simple-input simple-from" value="${fromDay}"></td>
                        <td><input type="number" min="0" class="simple-input simple-to" value="${toDay}"></td>
                        <td><input type="number" step="0.01" min="0" class="simple-input simple-amount" value="${amount}"></td>
                        <td>
                            <button type="button" class="btn btn-icon bg-danger-50 border border-danger-200 text-danger-700 p-4 px-8 radius-8 remove-simple-row">
                                <i class="ri-close-line"></i>
                            </button>
                        </td>
                    </tr>
                `);
                $('#simpleRulesBody').append($row);
            }

            $('#addSimpleRowBtn').on('click', function() {
                addSimpleRow();
            });

            $(document).on('click', '.remove-simple-row', function() {
                $(this).closest('tr').remove();
            });

            /*
            |--------------------------------------------------------------------------
            | List of existing Fine Masters
            |--------------------------------------------------------------------------
            */
            function fetchFineMasters() {
                fetchMasterData("{{ route('school.feeFineMaster.fetch.with') }}", function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {
                        $.each(res.data, function(i, f) {
                            const typeLabel = f.fine_type == 1 ? 'Fixed' : (f.fine_type == 2 ?
                                'Per Day' : 'Monthly');

                            html += `
                                <div class="col-xl-4 col-md-6 mb-3">
                                    <div class="card h-100 radius-16 border border-neutral-200 shadow-2 bg-base p-20 d-flex flex-column justify-content-between">
                                        <div class="d-flex justify-content-between align-items-start gap-12">
                                            <div>
                                                <span class="badge bg-primary-50 text-primary-600 text-xs fw-semibold px-10 py-4 radius-4 mb-8 d-inline-block">
                                                    ${typeLabel}
                                                </span>
                                                <h6 class="fw-bold text-neutral-800 mb-4">${f.fine_name}</h6>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end pt-16 mt-16 border-top border-neutral-200">
                                            <div>
                                                <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Grace Days</span>
                                                <span class="fw-semibold text-neutral-700 text-sm">${f.grace_days ?? 0}</span>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-icon bg-info-50 border border-info-200 text-info-700 p-6 px-10 radius-8 fine-list-item" data-id="${f.id}" title="Edit">
                                                    <i class="ri-edit-line text-lg"></i>
                                                </button>
                                                <button type="button" class="btn btn-icon bg-danger-50 border border-danger-200 text-danger-700 p-6 px-10 radius-8 delete-fine-btn" data-id="${f.id}" title="Delete">
                                                    <i class="ri-delete-bin-6-line text-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        });
                    } else {
                        html = `
                            <div class="col-xl-12">
                                <div class="py-40 text-center">
                                    <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                    <span class="text-sm fw-medium text-neutral-500">No fine masters found.</span>
                                </div>
                            </div>`;
                    }

                    $('#fineMasterList').html(html);
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Open / close modal
            |--------------------------------------------------------------------------
            */
            function resetForm() {
                currentFineId = null;
                existingMatrix = {};

                $('#fine_name').val('');
                $('#grace_days').val(0);
                $('#period_days').val('');
                $('#fine_type').val('3').trigger('change');
                $('#simpleRulesBody').empty();
                $('#fineMatrixBody').empty();
                $('#fineModalTitle').text('Fine Master');
                $('#saveFineBtnLabel').text('Add');
            }

            function openModal() {
                $('#fineModalBackdrop').removeClass('d-none');
                $('body').css('overflow', 'hidden');
            }

            function closeModal() {
                $('#fineModalBackdrop').addClass('d-none');
                $('body').css('overflow', '');
            }

            $('#newFineBtn').on('click', function() {
                resetForm();
                openModal();
            });

            $('#fineModalCloseBtn, #cancelFineBtn').on('click', function() {
                closeModal();
                resetForm();
            });


            $(document).on("click", ".fine-list-item", function() {
                let id = $(this).data("id");

                getDataById("{{ route('school.feeFineMaster.get.with', ':id') }}".replace(':id', id), id,
                    function(res) {
                        if (!res.status) {
                            showToast(res.message, 'error');
                            return;
                        }

                        const master = res.data.master;
                        existingMatrix = res.data.matrix || {};
                        const simpleRows = res.data.simple_rows || [];

                        currentFineId = master.id;

                        $('#fineModalTitle').text('Edit Fine Master');
                        $('#saveFineBtnLabel').text('Update');
                        $('#fine_name').val(master.fine_name);
                        $('#grace_days').val(master.grace_days ?? 0);
                        $('#fine_type').val(master.fine_type).trigger('change');

                        if (master.fine_type == 3) {
                            $('#period_days').val(master.period_days);
                            renderMatrix(master.period_days);
                        } else {

                            $('#simpleRulesBody').empty();
                            simpleRows.forEach(function(r) {
                                addSimpleRow(r.from_day, r.to_day, r.fine_amount);
                            });
                        }

                        openModal();
                    });
            });

          
            /*
            |--------------------------------------------------------------------------
            | Save
            |--------------------------------------------------------------------------
            */
            $('#saveFineBtn').on('click', function() {

                const fineType = $('#fine_type').val();

                if (!$('#fine_name').val().trim()) {
                    showToast('Please enter a fine name.', 'error');
                    return;
                }

                const payload = {
                    _token: "{{ csrf_token() }}",
                    id: currentFineId,
                    fine_name: $('#fine_name').val(),
                    fine_type: fineType,
                    grace_days: $('#grace_days').val() || 0,
                    status: 1,
                    period_days: fineType == 3 ? $('#period_days').val() : null,
                    rows: [],
                };

                if (fineType == 3) {

                    if (!$('#period_days').val()) {
                        showToast('Please enter a period.', 'error');
                        return;
                    }

                    const rowsMap = {};

                    $('.fine-cell-input').each(function() {

                        const val = $(this).val();
                        if (val === '' || val === null) return;

                        const rowKey = $(this).data('row-key');
                        const rowMonthId = $(this).data('row-month-id');
                        const fromDay = $(this).data('from-day');
                        const toDay = $(this).data('to-day');
                        const targetMonthId = $(this).data('target-month-id');

                        if (!rowMonthId || !targetMonthId) return;

                        if (!rowsMap[rowKey]) {
                            rowsMap[rowKey] = {
                                transport_month_id: rowMonthId,
                                from_day: fromDay,
                                to_day: toDay,
                                cells: [],
                            };
                        }

                        rowsMap[rowKey].cells.push({
                            target_month_id: targetMonthId,
                            fine_amount: val,
                        });
                    });

                    payload.rows = Object.values(rowsMap);

                    if (payload.rows.length === 0) {
                        showToast('Please fill at least one fine amount in the matrix.', 'error');
                        return;
                    }

                } else {

                    let valid = true;

                    $('#simpleRulesBody tr').each(function() {
                        const from = $(this).find('.simple-from').val();
                        const to = $(this).find('.simple-to').val();
                        const amt = $(this).find('.simple-amount').val();

                        if (from === '' || to === '' || amt === '') {
                            valid = false;
                            return;
                        }

                        payload.rows.push({
                            transport_month_id: null,
                            from_day: from,
                            to_day: to,
                            cells: [],
                            fine_amount: amt,
                        });
                    });

                    if (!valid || payload.rows.length === 0) {
                        showToast('Please fill all day ranges and amounts.', 'error');
                        return;
                    }
                }

                $.ajax({
                    url: "{{ route('school.feeFineMaster.save') }}",
                    type: "POST",
                    data: payload,
                    success: function(res) {

                        if (!res.status) {
                            showToast(res.message, 'error');
                            return;
                        }

                        showToast(res.message, 'success');
                        fetchFineMasters();
                        resetForm();
                        closeModal();
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Delete
            |--------------------------------------------------------------------------
            */
            $(document).on('click', '.delete-fine-btn', function() {

                if (!confirm('Delete this fine master? This cannot be undone.')) return;

                const id = $(this).data('id');

                $.ajax({
                    url: "{{ route('school.feeFineMaster.delete') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                        id: id,
                    },
                    success: function(res) {
                        showToast(res.message, 'success');
                        fetchFineMasters();
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

        });
    </script>
@endpush
