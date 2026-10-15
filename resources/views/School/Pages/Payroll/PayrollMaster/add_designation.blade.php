@extends('School.Layout.main')

@section('title', 'KTR ERP : Payroll Master')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-award-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Designation Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Register, catalog, and configure department-wise
                            designation hierarchy.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="DesignationDataTable" />
                    <x-model-open target="payrollDesignationModal" />
                </div>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"id="DesignationDataTable"
                        data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Designation Identity</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Department</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Branch</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Level</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Teaching</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="designationRegistryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('School.Pages.Payroll.components.add_update_designation')
@endsection

@push('script')
    <script>
        $(document).ready(async function() {

            await loadBranchDropdown();

            fetchRegisteredDesignations();

            function resetDesignationForm() {
                const form = $('#designationRegistrationForm')[0];

                if (form) {
                    form.reset();
                }

                $('#designation_id').val('');
                $('#status').prop('checked', true);
                $('#is_teaching_staff').prop('checked', false);
                $('.payroll_department_id').html(
                    '<option value="">Select Branch First</option>'
                );
                $('#payrollDesignationModalTitle').text('Add Designation');
            }

            $('[data-bs-target="#payrollDesignationModal"]').on('click', function() {
                resetDesignationForm();
                $('#payrollDesignationModalTitle').text('Add Designation');
            });

            $(document).on('click', '#resetDesignationForm', function() {
                resetDesignationForm();
            });

            $(document).on('change', '#branch_id', function() {
                const branchId = $(this).val();

                loadDepartmentDropdown(branchId);
            });

            $(document).on('click', '.edit-designation-trigger', function() {
                const id = $(this).data('id');

                if (!id) {
                    console.error('Designation ID not found');
                    return;
                }

                resetDesignationForm();

                $('#payrollDesignationModal').modal('show');
                $('#payrollDesignationModalTitle').text('Edit Designation');

                getDataById(
                    "{{ route('school.payroll_designation.get') }}",
                    id,
                    async function(res) {

                        if (!res.status || !res.data) {
                            console.error('Designation details not found', res);
                            return;
                        }

                        const row = res.data;

                        $('#designation_id').val(row.id);

                        await loadBranchDropdown();

                        $('#branch_id').val(
                            String(row.branch_id ?? '')
                        );

                        await loadDepartmentDropdown(
                            row.branch_id,
                            row.department_id
                        );

                        $('#designation_code').val(
                            row.designation_code ?? ''
                        );

                        $('#designation_name').val(
                            row.designation_name ?? ''
                        );

                        $('#hierarchy_level').val(
                            row.hierarchy_level ?? 1
                        );

                        $('#designation_description').val(
                            row.description ?? ''
                        );

                        $('#is_teaching_staff').prop(
                            'checked',
                            Number(row.is_teaching_staff) === 1
                        );

                        $('#status').prop(
                            'checked',
                            Number(row.status) === 1
                        );

                        $('#payrollDesignationModalTitle').text(
                            'Edit Designation'
                        );
                    }
                );
            });

            $('#payrollDesignationModal').on('hidden.bs.modal', function() {
                resetDesignationForm();
            });

        });

        function loadBranchDropdown() {
            return new Promise((resolve) => {

                fetchMasterData(
                    "{{ route('school.payroll_branch.fetch') }}",
                    function(res) {

                        let options = `
                    <option value="">Select Branch</option>
                `;

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

        function loadDepartmentDropdown(
            branchId,
            selectedDepartmentId = ''
        ) {
            return new Promise((resolve) => {

                if (!branchId) {
                    $('.payroll_department_id').html(
                        '<option value="">Select Branch First</option>'
                    );

                    resolve(null);
                    return;
                }

                fetchMasterData(
                    "{{ route('school.payroll_department.fetch') }}?branch_id=" + branchId,
                    function(res) {

                        let options = `
                    <option value="">Select Department</option>
                `;

                        if (res.status && res.data) {
                            $.each(res.data, function(index, row) {
                                options += `
                            <option value="${row.id}">
                                ${row.department_name}
                            </option>
                        `;
                            });
                        }

                        $('.payroll_department_id').html(options);

                        if (selectedDepartmentId) {
                            $('.payroll_department_id').val(
                                String(selectedDepartmentId)
                            );
                        }

                        resolve(res);
                    }
                );

            });
        }

        function fetchRegisteredDesignations() {

            fetchMasterData(
                "{{ route('school.payroll_designation.fetch.with') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.designation_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 2)
                                .toUpperCase();

                            let statusBadge = row.status == 1 ?
                                '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                                '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                            let teachingBadge = row.is_teaching_staff == 1 ?
                                '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Yes</span>' :
                                '<span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-10 py-4 radius-6 font-xxs">No</span>';

                            let departmentName = row.department?.department_name ?
                                row.department.department_name :
                                '<span class="text-neutral-400">—</span>';

                            let branchName = row.branch?.branch_name ?
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
                                                    ${row.designation_name}
                                                </h6>

                                                <small class="text-neutral-500 text-xs">
                                                    Code: ${row.designation_code}
                                                </small>
                                            </div>

                                        </div>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">
                                            ${departmentName}
                                        </span>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">
                                            ${branchName}
                                        </span>
                                    </td>

                                    <td class="py-20 px-20 text-center">
                                        <span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-8 py-4 radius-6 font-xxs">
                                            ${row.hierarchy_level}
                                        </span>
                                    </td>

                                    <td class="py-20 px-20 text-center">
                                        ${teachingBadge}
                                    </td>

                                    <td class="py-20 px-20 text-center">
                                        ${statusBadge}
                                    </td>

                                    <td class="py-20 px-28 text-end">

                                        <div class="d-flex align-items-center justify-content-end gap-2">

                                            <button
                                                type="button"
                                                class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-designation-trigger"
                                                data-id="${row.id}">

                                                <i class="ri-edit-line text-lg"></i>

                                            </button>

                                            <button
                                                type="button"
                                                class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-designation-trigger deleteDesignation"
                                                data-id="${row.id}">

                                                <i class="ri-delete-bin-6-line text-lg"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>
                            `;
                        });

                    }

                    if ($.fn.DataTable.isDataTable('#DesignationDataTable')) {
                        $('#DesignationDataTable')
                            .DataTable()
                            .destroy();
                    }
                    $('#designationRegistryTableBody').html(html);

                    $('#DesignationDataTable').DataTable({
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
