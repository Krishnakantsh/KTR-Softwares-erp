@extends('School.Layout.main')

@section('title', 'KTR ERP : Fee Installments')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="row gy-4">

            <!-- LEFT: Existing plans list -->
            <div class="col-xl-3">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100">
                    <div
                        class="card-header border-bottom bg-base py-16 px-20 d-flex justify-content-between align-items-center">
                        <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Installment Plans</h6>
                        <button type="button" id="newPlanBtn"
                            class="btn btn-sm btn-primary bg-primary-600 text-white radius-6 px-12 py-6">
                            <i class="ri-add-line"></i> New
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-unstyled mb-0" id="planList">
                            @foreach ($installments as $plan)
                                <li class="plan-list-item px-20 py-14 border-bottom d-flex justify-content-between align-items-center"
                                    style="cursor:pointer" data-id="{{ $plan->id }}">
                                    <div>
                                        <div class="fw-semibold text-neutral-800">{{ $plan->installment_name }}</div>
                                        <div class="text-xs text-neutral-500">{{ $plan->details->count() }} installment(s)
                                        </div>
                                    </div>
                                    <span
                                        class="badge {{ $plan->status ? 'bg-success-100 text-success-700' : 'bg-danger-100 text-danger-700' }} px-10 py-4 radius-6 text-xs">
                                        {{ $plan->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Create / Edit form -->
            <div class="col-xl-9">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">

                    <div class="card-header border-bottom bg-base py-20 px-28">
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900">Installment Plan Details</h5>
                        <p class="text-xs text-neutral-500 mb-0">Define the plan and each installment's schedule.</p>
                    </div>

                    <div class="card-body p-28">
                        <form id="installmentForm">
                            <input type="hidden" id="master_id" name="id" value="">

                            <div class="row gy-4 mb-24">






                                <div class="col-xl-6 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                            Plan Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="inner-addon position-relative">
                                            <i
                                                class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                            <input type="text"
                                                class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                id="installment_name" name="installment_name"
                                                placeholder="e.g. Quarterly Plan" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                            Code
                                        </label>
                                        <div class="inner-addon position-relative">
                                            <i
                                                class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                            <input type="text"
                                                class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                id="installment_code" name="installment_code" placeholder="e.g. QTR"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3 d-flex align-items-end">
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch">
                                            <input type="checkbox" role="switch" id="master_status" name="status"
                                                value="1" checked>
                                            <span class="slider"></span>
                                        </label>
                                        <span class="ms-2 text-xs fw-semibold text-neutral-600">Active</span>
                                    </div>
                                </div> --}}
                                 <div class="col-xl-12 col-md-12">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                            Description
                                        </label>
                                        <div class="inner-addon position-relative">
                                            <i
                                                class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                            <input type="text"
                                                class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                id="description" name="description" placeholder="e.g., TUI">
                                        </div>
                                    </div>
                            </div>

                    </div>

                    <hr class="border-neutral-200 mb-20">

                    <div class="d-flex justify-content-between align-items-center mb-16">
                        <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Installments</h6>
                        <button type="button" id="addRowBtn"
                            class="btn btn-sm border border-primary-300 text-primary-600 radius-6 px-12 py-6">
                            <i class="ri-add-line"></i> Add Installment
                        </button>
                    </div>

                    <div class="table-responsive mb-24">
                        <table class="table align-middle" id="detailsTable">
                            <thead>
                                <tr class="text-xs uppercase text-neutral-500">
                                    <th style="width:22%">Name</th>
                                    <th style="width:8%">Order</th>
                                    <th style="width:16%">Start Month</th>
                                    <th style="width:16%">End Month</th>
                                    <th style="width:12%">Due Day</th>
                                    <th style="width:14%">Fine After (days)</th>
                                    <th style="width:6%">Active</th>
                                    <th style="width:6%"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <div class="premium-input-box position-relative d-flex gap-4 me-8">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600  d-block">
                                Status
                            </label>

                            <div class="form-check form-switch p-0 m-0">

                                <label class="switch">
                                    <input type="checkbox" role="switch" id="master_status" name="status" value="1"
                                        for="status" class="module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>

                        </div>
                        <button type="button" id="resetFormBtn"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 px-24 py-12 radius-8 fw-semibold">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="button" id="savePlanBtn"
                            class="btn btn-primary bg-primary-600 text-white px-28 py-12 radius-8 fw-semibold border-0">
                            <i class="ri-save-3-line"></i> Save Plan
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <template id="rowTemplate">
        <tr class="detail-row">
            <input type="hidden" class="row-id" value="">
            <td><input type="text" class="form-control custom-premium-input py-8 radius-6 row-name"
                    placeholder="e.g. Term 1"></td>
            <td><input type="number" min="0" class="form-control custom-premium-input py-8 radius-6 row-order"
                    value="0"></td>
            <td>
                <select class="form-control custom-premium-input py-8 radius-6 row-start-month">
                    <option value="">--</option>
                    @foreach ($months as $num => $name)
                        <option value="{{ $num }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control custom-premium-input py-8 radius-6 row-end-month">
                    <option value="">--</option>
                    @foreach ($months as $num => $name)
                        <option value="{{ $num }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" min="1" max="31"
                    class="form-control custom-premium-input py-8 radius-6 row-due-day"></td>
            <td><input type="number" min="0"
                    class="form-control custom-premium-input py-8 radius-6 row-fine-days" value="0"></td>
            <td class="text-center">
                <input type="checkbox" class="row-status" checked>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm text-danger remove-row-btn"><i
                        class="ri-delete-bin-line"></i></button>
            </td>
        </tr>
    </template>

@endsection

@push('script')
    <script>
        $(function() {

            function addRow(data = {}) {
                const $tpl = $($('#rowTemplate').html());

                $tpl.find('.row-id').val(data.id ?? '');
                $tpl.find('.row-name').val(data.installment_name ?? '');
                $tpl.find('.row-order').val(data.installment_order ?? $('#detailsTable tbody tr').length);
                $tpl.find('.row-start-month').val(data.start_month ?? '');
                $tpl.find('.row-end-month').val(data.end_month ?? '');
                $tpl.find('.row-due-day').val(data.due_day ?? '');
                $tpl.find('.row-fine-days').val(data.fine_after_days ?? 0);
                $tpl.find('.row-status').prop('checked', data.status === undefined ? true : !!data.status);

                $('#detailsTable tbody').append($tpl);
            }

            function resetForm() {
                $('#master_id').val('');
                $('#installment_name').val('');
                $('#installment_code').val('');
                $('#description').val('');
                $('#master_status').prop('checked', true);
                $('#detailsTable tbody').empty();
                $('.plan-list-item').removeClass('bg-primary-50');
                addRow();
            }


            function loadPlan(id) {
                getDataById(
                    "{{ route('school.feeInstallment.get') }}",
                    id,
                    function(res) {

                        if (!res.status) return;

                        const plan = res.data;

                        $('#master_id').val(plan.id);
                        $('#installment_name').val(plan.installment_name);
                        $('#installment_code').val(plan.installment_code);
                        $('#description').val(plan.description);
                        $('#master_status').prop('checked', !!plan.status);

                        $('#detailsTable tbody').empty();
                        plan.details.forEach(row => addRow(row));

                        $('.plan-list-item').removeClass('bg-primary-50');
                        $(`.plan-list-item[data-id="${id}"]`).addClass('bg-primary-50');

                    }
                );
            }

            $(document).on('click', '.plan-list-item', function() {
                loadPlan($(this).data('id'));
            });

            $('#newPlanBtn, #resetFormBtn').on('click', resetForm);

            $('#addRowBtn').on('click', function() {
                addRow();
            });

            $(document).on('click', '.remove-row-btn', function() {
                if ($('#detailsTable tbody tr').length <= 1) {
                    showToast('At least one installment row is required.', 'error');
                    return;
                }
                $(this).closest('tr').remove();
            });

            $('#savePlanBtn').on('click', function() {

                const name = $('#installment_name').val().trim();

                if (!name) {
                    showToast('Plan name is required.', 'error');
                    return;
                }

                const details = [];
                let valid = true;

                $('#detailsTable tbody tr').each(function() {
                    const $row = $(this);
                    const rowName = $row.find('.row-name').val().trim();

                    if (!rowName) {
                        valid = false;
                        return false;
                    }

                    details.push({
                        id: $row.find('.row-id').val() || null,
                        installment_name: rowName,
                        installment_order: $row.find('.row-order').val() || 0,
                        start_month: $row.find('.row-start-month').val() || null,
                        end_month: $row.find('.row-end-month').val() || null,
                        due_day: $row.find('.row-due-day').val() || null,
                        fine_after_days: $row.find('.row-fine-days').val() || 0,
                        status: $row.find('.row-status').is(':checked') ? 1 : 0,
                    });
                });

                if (!valid) {
                    showToast('Each installment row needs a name.', 'error');
                    return;
                }

                if (details.length === 0) {
                    showToast('Add at least one installment row.', 'error');
                    return;
                }

                $.ajax({
                    url: "{{ route('school.feeInstallment.save') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#master_id').val(),
                        installment_name: name,
                        installment_code: $('#installment_code').val(),
                        description: $('#description').val(),
                        status: $('#master_status').is(':checked') ? 1 : 0,
                        details: details,
                    },
                    success: function(res) {
                        showToast(res.message, 'success');
                        setTimeout(() => location.reload(), 800);
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            // start with one empty row
            addRow();
        });
    </script>
@endpush
