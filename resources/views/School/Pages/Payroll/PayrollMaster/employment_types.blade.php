@extends('School.Layout.main')

@section('title', 'KTR ERP : Payroll - Manage Shift')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <!-- SECTION 1: EMPLOYMENT TYPES REGISTRY TABLE -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-user-star-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Employment Type Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Indexed staff employment definitions and status
                            rules.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="EmployeeTypeDataTable" />
                    <x-model-open target="payrollEmployeeTypeModal" />
                </div>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive scrollable-class-registry">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"id="EmployeeTypeDataTable"
                        data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28"
                                    style="width: 60px;">S.No.</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Employment Type Details</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Branch</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Description</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employmentTypeTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('School.Pages.Payroll.components.add_update_employee_type')
@endsection

@push('script')
    <script>
        $(document).ready(async function() {

            await loadBranchDropdown();

            fetchEmploymentTypes();

            function resetForm() {
                const form = $('#employmentTypeForm')[0];
                if (form) {
                    form.reset();
                }
                $("#employment_type_id").val("");
                $("#employment_type_status").prop("checked", true);
                $('#employmentTypeFormTitle').text('Add Employment Type');
            }

            // Reset + set title when Add button opens modal
            $('[data-bs-target="#payrollEmployeeTypeModal"]').on('click', function() {
                resetForm();
                $('#employmentTypeFormTitle').text('Add Employment Type');
            });

            // Form Reset Trigger
            $("#resetEmploymentTypeForm").on("click", resetForm);

            // Edit Trigger Ajax Mapping
            $(document).on("click", ".edit-employment-type-trigger", function() {
                let id = $(this).data("id");

                console.log('EDIT EMPLOYMENT TYPE ID:', id);

                if (!id) {
                    console.error('Employment Type ID not found');
                    return;
                }

                resetForm();
                $('#payrollEmployeeTypeModal').modal('show');
                $('#employmentTypeFormTitle').text('Edit Employment Type');

                getDataById("{{ route('school.payroll_employment_type.get') }}", id, async function(
                    res) {

                    console.log('EDIT EMPLOYMENT TYPE RESPONSE:', res);

                    if (!res.status || !res.data) {
                        console.error('Unable to fetch employment type details', res);
                        return;
                    }

                    let row = res.data;

                    $("#employment_type_id").val(row.id);

                    // Load branches first
                    await loadBranchDropdown();

                    let branchId = row.branch_id ? row.branch_id : '';
                    $(".payroll_branch_id").val(String(branchId));

                    $("#employment_type_code").val(row.employment_type_code ?? '');
                    $("#employment_type_name").val(row.employment_type_name ?? '');
                    $("#employment_type_description").val(row.description ?? '');
                    $("#employment_type_status").prop("checked", Number(row.status) === 1);

                    $('#employmentTypeFormTitle').text('Edit Employment Type');
                });
            });

            // Reset form when modal is closed
            $('#payrollEmployeeTypeModal').on('hidden.bs.modal', function() {
                resetForm();
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

        function fetchEmploymentTypes() {
            fetchMasterData("{{ route('school.payroll_employment_type.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {

                    $.each(res.data, function(index, row) {

                        let initials = row.employment_type_name ?
                            row.employment_type_name.split(' ').map(w => w.charAt(0)).join('').substring(0,
                                2).toUpperCase() :
                            'ET';

                        let statusBadge = row.status == 1 ?
                            '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                            '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                        let branchName = row.branch?.branch_name ?
                            row.branch.branch_name :
                            '<span class="text-neutral-400">—</span>';

                        let description = row.description ?
                            row.description :
                            '<span class="text-neutral-400">—</span>';

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28 text-center fw-semibold text-neutral-500">${index + 1}</td>

                                <td class="py-20 px-20">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-matrix-icon">
                                            <span class="fw-bold text-sm text-primary-600">${initials}</span>
                                        </div>
                                        <div>
                                            <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.employment_type_name}</h6>
                                            <small class="text-neutral-500 text-xs">Code: ${row.employment_type_code}</small>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600">${branchName}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600">${description}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-employment-type-trigger"
                                            data-id="${row.id}" title="Edit">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-employment-type-trigger deleteEmploymentType"
                                            data-id="${row.id}" title="Delete">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });

                }

                if ($.fn.DataTable.isDataTable('#EmployeeTypeDataTable')) {
                    $('#EmployeeTypeDataTable')
                        .DataTable()
                        .destroy();
                }
                $("#employmentTypeTableBody").html(html);

                $('#EmployeeTypeDataTable').DataTable({
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
            });
        }
    </script>
@endpush
