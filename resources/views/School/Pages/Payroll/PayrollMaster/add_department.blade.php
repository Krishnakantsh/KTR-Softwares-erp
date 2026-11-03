@extends('School.Layout.main')

@section('title', 'KTR ERP : Payroll Master')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-git-branch-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Department Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Register, catalog, and configure branch-wise
                            department infrastructure.</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="DepartmentDataTable" />
                    <x-model-open target="payrollDepartmentModal" />
                </div>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle" id="DepartmentDataTable"
                        data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Department Identity</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Branch</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Contact</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="departmentRegistryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('School.Pages.Payroll.components.add_update_department')
@endsection
@push('script')
    <script>
        $(document).ready(async function() {

            await loadBranchDropdown();

            fetchRegisteredDepartments();

            function resetDepartmentForm() {
                const form = $('#departmentRegistrationForm')[0];

                if (form) {
                    form.reset();
                }

                $('#department_id').val('');
                $('.payroll_branch_id').val('');
                $('#department_code').val('');
                $('#department_name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#department_description').val('');
                $('#status').prop('checked', true);
                $('#payrollDepartmentModalTitle').text('Add Department');
            }

            $('[data-bs-target="#payrollDepartmentModal"]').on('click', function() {
                resetDepartmentForm();
                $('#payrollDepartmentModalTitle').text('Add Department');
            });

            $(document).on('click', '#resetDepartmentForm', function() {
                resetDepartmentForm();
            });

            $(document).on('click', '.edit-department-trigger', function() {
                const id = $(this).data('id');

                if (!id) {
                    console.error('Department ID not found');
                    return;
                }

                resetDepartmentForm();

                $('#payrollDepartmentModal').modal('show');
                $('#payrollDepartmentModalTitle').text('Edit Department');

                getDataById(
                    "{{ route('school.payroll_department.get') }}",
                    id,
                    async function(res) {
                        if (!res.status || !res.data) {
                            console.error('Department details not found', res);
                            return;
                        }

                        const row = res.data;

                        $('#department_id').val(row.id);

                        await loadBranchDropdown();

                        $('.payroll_branch_id').val(
                            String(row.branch_id ?? '')
                        );

                        $('#department_code').val(
                            row.department_code ?? ''
                        );

                        $('#department_name').val(
                            row.department_name ?? ''
                        );

                        $('#email').val(
                            row.email ?? ''
                        );

                        $('#phone').val(
                            row.phone ?? ''
                        );

                        $('#department_description').val(
                            row.description ?? ''
                        );

                        $('#status').prop(
                            'checked',
                            Number(row.status) === 1
                        );

                        $('#payrollDepartmentModalTitle').text(
                            'Edit Department'
                        );
                    }
                );
            });

            $('#payrollDepartmentModal').on('hidden.bs.modal', function() {
                resetDepartmentForm();
            });

        });

        function loadBranchDropdown() {
            return new Promise((resolve) => {
                fetchMasterData("{{ route('school.payroll_branch.fetch') }}", function(res) {
                    let options = `<option value="">Select Branch</option>`;

                    if (res.status && res.data) {
                        $.each(res.data, function(index, row) {
                            options += `<option value="${row.id}">${row.branch_name}</option>`;
                        });
                    }

                    $(".payroll_branch_id").html(options);

                    resolve(res);
                });
            });
        }

        function fetchRegisteredDepartments() {

            fetchMasterData(
                "{{ route('school.payroll_department.fetch.with') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.department_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 2)
                                .toUpperCase();

                            let statusBadge = row.status == 1 ?
                                '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                                '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                            let contactText = row.phone ?
                                row.phone :
                                (row.email ? row.email : '<span class="text-neutral-400">—</span>');

                            let branchName = row.branch?.branch_name ?
                                row.branch?.branch_name :
                                '<span class="text-neutral-400">—</span>';

                            html += `
                                <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                    <td class="py-20 px-28">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-matrix-icon">
                                                <span class="fw-bold text-sm text-primary-600">${initials}</span>
                                            </div>
                                            <div>
                                                <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.department_name}</h6>
                                                <small class="text-neutral-500 text-xs">Code: ${row.department_code}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">${branchName}</span>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">${contactText}</span>
                                    </td>

                                    <td class="py-20 px-20 text-center">
                                        ${statusBadge}
                                    </td>

                                    <td class="py-20 px-28 text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-department-trigger"
                                                data-id="${row.id}">
                                                <i class="ri-edit-line text-lg"></i>
                                            </button>

                                            <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-department-trigger deleteDepartment"
                                                data-id="${row.id}">
                                                <i class="ri-delete-bin-6-line text-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });

                    }


                    if ($.fn.DataTable.isDataTable('#DepartmentDataTable')) {
                        $('#DepartmentDataTable')
                            .DataTable()
                            .destroy();
                    }
                    $("#departmentRegistryTableBody").html(html);

                    $('#DepartmentDataTable').DataTable({
                        pageLength: 10,
                        language: {
                            emptyTable: "No Records Found"
                        }
                    });



                    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.map(function(el) {
                        return new bootstrap.Tooltip(el);
                    });
                }
            );
        }
    </script>
@endpush
