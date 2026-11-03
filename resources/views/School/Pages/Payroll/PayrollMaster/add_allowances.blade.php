@extends('School.Layout.main')

@section('title', 'KTR ERP : Payroll Master')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-coins-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Allowance Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure salary allowances, calculation types, tax
                            rules, and statutory applicabilities.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                        <x-datatable--toolbar tableId="AllowancesDataTable" />
                        <x-model-open target="payrollAllowancesModal" />
                </div>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"id="AllowancesDataTable"
                        data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Allowance Identity</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Branch</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Type</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Calculation</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Statutory Rules</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="allowanceRegistryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


    @include('School.Pages.Payroll.components.add_update_allowances')

@endsection

@push('script')
    <script>
        $(document).ready(async function() {

            await loadBranchDropdown();
            fetchRegisteredAllowances();

            function resetAllowanceForm() {
                const form = $('#allowanceRegistrationForm')[0];

                if (form) {
                    form.reset();
                }

                $('#allowance_id').val('');
                $('#allowance_status').prop('checked', true);
                $('#is_taxable').prop('checked', true);
                $('#is_prorated').prop('checked', true);
                $('#is_pf_applicable, #is_esic_applicable, #is_overtime_applicable').prop('checked', false);
                $('.payroll_branch_id').val('');
                $('#calculation_type').val('1');
                toggleCalculationFields(1);
                $('#allowanceFormTitle').text('Create Allowance');
            }

            $('[data-bs-target="#payrollAllowancesModal"]').on('click', function() {
                resetAllowanceForm();
                $('#allowanceFormTitle').text('Add Allowance');
                $('#payrollAllowancesModal').modal('show');
            });

            $(document).on('click', '#resetAllowanceForm', function() {
                resetAllowanceForm();
            });

            $(document).on('change', '#calculation_type', function() {
                toggleCalculationFields($(this).val());
            });



            $(document).on('click', '.edit-allowance-trigger', function() {
                const id = $(this).data('id');

                if (!id) {
                    console.error('Allowance ID not found');
                    return;
                }

                resetAllowanceForm();

                $('#payrollAllowancesModal').modal('show');
                $('#allowanceFormTitle').text('Edit Allowance');

                getDataById(
                    "{{ route('school.payroll_allowance.get') }}",
                    id,
                    async function(res) {

                        if (!res.status || !res.data) {
                            console.error('Allowance details not found', res);
                            return;
                        }

                        const row = res.data;

                        $('#allowance_id').val(row.id);

                        await loadBranchDropdown();

                        $('.payroll_branch_id').val(
                            String(row.branch_id ?? '')
                        );

                        $('#allowance_code').val(row.allowance_code ?? '');
                        $('#allowance_name').val(row.allowance_name ?? '');
                        $('#effect_type').val(row.effect_type ?? '');

                        $('#calculation_type').val(
                            row.calculation_type ?? 1
                        );

                        toggleCalculationFields(
                            row.calculation_type ?? 1
                        );

                        $('#default_amount').val(row.default_amount ?? '');
                        $('#default_percentage').val(row.default_percentage ?? '');
                        $('#percentage_on').val(row.percentage_on ?? '');
                        $('#allowance_description').val(row.description ?? '');

                        $('#is_taxable').prop(
                            'checked',
                            Number(row.is_taxable) === 1
                        );

                        $('#is_pf_applicable').prop(
                            'checked',
                            Number(row.is_pf_applicable) === 1
                        );

                        $('#is_esic_applicable').prop(
                            'checked',
                            Number(row.is_esic_applicable) === 1
                        );

                        $('#is_prorated').prop(
                            'checked',
                            Number(row.is_prorated) === 1
                        );

                        $('#is_overtime_applicable').prop(
                            'checked',
                            Number(row.is_overtime_applicable) === 1
                        );

                        $('#allowance_status').prop(
                            'checked',
                            Number(row.status) === 1
                        );

                        $('#allowanceFormTitle').text('Edit Allowance');
                    }
                );
            });

            $('#payrollAllowancesModal').on('hidden.bs.modal', function() {
                resetAllowanceForm();
            });

        });

        function loadBranchDropdown() {
            return new Promise((resolve) => {
                fetchMasterData(
                    "{{ route('school.payroll_branch.fetch') }}",
                    function(res) {

                        let options = '<option value="">Select Branch</option>';

                        if (res.status && res.data) {
                            $.each(res.data, function(index, row) {
                                options += `
                            <option value="${row.id}">
                                ${row.branch_name}
                            </option>
                        `;
                            });
                        }

                        $('.payroll_branch_id').html(options);
                        resolve(res);
                    }
                );
            });
        }

        function toggleCalculationFields(type) {
            if (parseInt(type) === 2) {
                $('#amount_wrapper').addClass('d-none');
                $('#percentage_wrapper, #percentage_on_wrapper')
                    .removeClass('d-none');
            } else {
                $('#amount_wrapper').removeClass('d-none');
                $('#percentage_wrapper, #percentage_on_wrapper')
                    .addClass('d-none');
            }
        }

        function fetchRegisteredAllowances() {

            fetchMasterData(
                "{{ route('school.payroll_allowance.fetch.with') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            const initials = row.allowance_name ?
                                row.allowance_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 2)
                                .toUpperCase() :
                                'AL';

                            const effectTypeBadge = row.effect_type == 1 ?
                                `
                            <span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">
                                Earning
                            </span>
                        ` :
                                `
                            <span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">
                                Deduction
                            </span>
                        `;

                            let calcTypeDetail = '';

                            if (row.calculation_type == 1) {
                                calcTypeDetail = `
                            <span class="fw-bold text-neutral-800">
                                ₹${parseFloat(row.default_amount || 0).toFixed(2)}
                            </span>
                            <br>
                            <small class="text-neutral-500 text-xs">
                                (Fixed)
                            </small>
                        `;
                            } else {
                                const percentageBaseMap = {
                                    1: 'Basic',
                                    2: 'Gross',
                                    3: 'Basic+DA',
                                    4: 'Custom'
                                };

                                const base =
                                    percentageBaseMap[row.percentage_on] || 'N/A';

                                calcTypeDetail = `
                            <span class="fw-bold text-neutral-800">
                                ${parseFloat(row.default_percentage || 0)}%
                            </span>
                            <br>
                            <small class="text-neutral-500 text-xs">
                                on ${base}
                            </small>
                        `;
                            }

                            const statutoryBadges = `
                        <span class="badge ${
                            row.is_taxable
                                ? 'bg-info-50 text-info-700 border border-info-100'
                                : 'bg-neutral-100 text-neutral-500 border border-neutral-200'
                        } px-8 py-4 radius-6 font-xxs me-1">
                            Tax
                        </span>

                        <span class="badge ${
                            row.is_pf_applicable
                                ? 'bg-primary-50 text-primary-700 border border-primary-100'
                                : 'bg-neutral-100 text-neutral-500 border border-neutral-200'
                        } px-8 py-4 radius-6 font-xxs me-1">
                            PF
                        </span>

                        <span class="badge ${
                            row.is_esic_applicable
                                ? 'bg-warning-50 text-warning-700 border border-warning-100'
                                : 'bg-neutral-100 text-neutral-500 border border-neutral-200'
                        } px-8 py-4 radius-6 font-xxs">
                            ESIC
                        </span>
                    `;

                            const statusBadge = row.status == 1 ?
                                `
                            <span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">
                                Active
                            </span>
                        ` :
                                `
                            <span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">
                                Inactive
                            </span>
                        `;

                            const branchName = row.branch?.branch_name ?
                                row.branch.branch_name :
                                '<span class="text-neutral-400">—</span>';

                            html += `
                        <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">

                            <td class="py-20 px-28">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-matrix-icon">
                                        <span class="fw-bold text-sm text-primary-600">
                                            ${initials}
                                        </span>
                                    </div>

                                    <div>
                                        <h6 class="text-sm fw-bold mb-0 text-neutral-800">
                                            ${row.allowance_name}
                                        </h6>
                                        <small class="text-neutral-500 text-xs">
                                            Code: ${row.allowance_code}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <td class="py-20 px-20">
                                <span class="text-xs text-neutral-600">
                                    ${branchName}
                                </span>
                            </td>

                            <td class="py-20 px-20 text-center">
                                ${effectTypeBadge}
                            </td>

                            <td class="py-20 px-20 text-center">
                                ${calcTypeDetail}
                            </td>

                            <td class="py-20 px-20 text-center">
                                ${statutoryBadges}
                            </td>

                            <td class="py-20 px-20 text-center">
                                ${statusBadge}
                            </td>

                            <td class="py-20 px-28 text-end">
                                <div class="d-flex align-items-center justify-content-end gap-2">

                                    <button
                                        type="button"
                                        class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-allowance-trigger"
                                        data-id="${row.id}">
                                        <i class="ri-edit-line text-lg"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-allowance-trigger deleteAllowance"
                                        data-id="${row.id}">
                                        <i class="ri-delete-bin-6-line text-lg"></i>
                                    </button>

                                </div>
                            </td>

                        </tr>
                    `;
                        });

                    }

                    if ($.fn.DataTable.isDataTable('#AllowancesDataTable')) {
                        $('#AllowancesDataTable')
                            .DataTable()
                            .destroy();
                    }
                    $('#allowanceRegistryTableBody').html(html);

                    $('#AllowancesDataTable').DataTable({
                        pageLength: 10,
                        language: {
                            emptyTable: "No Records Found"
                        }
                    });

                    const tooltipTriggerList = [].slice.call(
                        document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    );

                    tooltipTriggerList.map(function(el) {
                        return new bootstrap.Tooltip(el);
                    });
                }
            );
        }
    </script>
@endpush
