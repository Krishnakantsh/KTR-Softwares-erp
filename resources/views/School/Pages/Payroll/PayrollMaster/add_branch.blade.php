@extends('School.Layout.main')

@section('title', 'KTR ERP : Payroll Master')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-building-4-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Branch Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Register, catalog, and configure institutional branch
                            infrastructure.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
             
                      <x-datatable--toolbar tableId="branchRegistryDataTable" />
                    <x-model-open target="payrollBranchModal" />
                </div>

                
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                 <table
                        class="table bordered-table mb-0 data-table text-sm vertical-middle"id="branchRegistryDataTable"
                        data-page-length="10">

                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Branch Identity</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Display Name</th>
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
                        <tbody id="branchRegistryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('School.Pages.Payroll.components.add_update_branch')

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            fetchRegisteredBranches();

            function resetBranchForm() {

                const form = $('#branchRegistrationForm')[0];

                if (form) {
                    form.reset();
                }

                $('#branch_id').val('');

                $('#branch_code').val('');
                $('#branch_name').val('');
                $('#display_name').val('');
                $('#email').val('');
                $('#phone').val('');

                $('#is_active').prop('checked', true);

                $('#payrollBranchModalTitle').text('Add Branch');
            }

            $('[data-bs-target="#payrollBranchModal"]').on('click', function() {

                resetBranchForm();

                $('#payrollBranchModalTitle').text('Add Branch');
            });

            $(document).on('click', '.edit-branch-trigger', function() {

                let id = $(this).data('id');

                console.log('EDIT BRANCH ID:', id);

                if (!id) {
                    console.error('Branch ID not found');
                    return;
                }

                resetBranchForm();
                $('#payrollBranchModal').modal('show');
                $('#payrollBranchModalTitle').text('Edit Branch');
                getDataById(
                    "{{ route('school.payroll_branch.get') }}",
                    id,
                    function(res) {

                        console.log('EDIT BRANCH RESPONSE:', res);

                        if (!res.status || !res.data) {

                            console.error(
                                'Unable to fetch branch details',
                                res
                            );

                            return;
                        }

                        let row = res.data;

                        console.log('EDIT BRANCH DATA:', row);


                        // ==================================
                        // HIDDEN ID
                        // ==================================
                        $('#branch_id').val(row.id);


                        // ==================================
                        // BASIC INFORMATION
                        // ==================================
                        $('#branch_code').val(
                            row.branch_code ?? ''
                        );

                        $('#branch_name').val(
                            row.branch_name ?? ''
                        );

                        $('#display_name').val(
                            row.display_name ?? ''
                        );


                        // ==================================
                        // CONTACT INFORMATION
                        // ==================================
                        $('#email').val(
                            row.email ?? ''
                        );

                        $('#phone').val(
                            row.phone ?? ''
                        );


                        // ==================================
                        // STATUS
                        // ==================================
                        $('#is_active').prop(
                            'checked',
                            Number(row.is_active) === 1
                        );


                        // ==================================
                        // TITLE
                        // ==================================
                        $('#payrollBranchModalTitle')
                            .text('Edit Branch');

                    }
                );

            });

            $('#payrollBranchModal').on(
                'hidden.bs.modal',
                function() {
                    resetBranchForm();

                }
            );



        });

        function fetchRegisteredBranches() {

            fetchMasterData(
                "{{ route('school.payroll_branch.fetch') }}",
                function(res) {

                    let html = '';

                    if (
                        res.status &&
                        res.data &&
                        res.data.length > 0
                    ) {

                        $.each(res.data, function(index, row) {

                            let initials = row.branch_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 2)
                                .toUpperCase();


                            let statusBadge =
                                row.is_active == 1

                                ?
                                '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>'

                                :
                                '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';


                            let contactText = row.phone ?
                                row.phone :
                                (
                                    row.email ?
                                    row.email :
                                    '<span class="text-neutral-400">—</span>'
                                );


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
                                                    ${row.branch_name}
                                                </h6>

                                                <small class="text-neutral-500 text-xs">
                                                    Code: ${row.branch_code}
                                                </small>
                                            </div>

                                        </div>
                                    </td>


                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">
                                            ${row.display_name ?? '-'}
                                        </span>
                                    </td>


                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">
                                            ${contactText}
                                        </span>
                                    </td>


                                    <td class="py-20 px-20 text-center">
                                        ${statusBadge}
                                    </td>


                                    <td class="py-20 px-28 text-end">

                                        <div class="d-flex align-items-center justify-content-end gap-2">

                                            <button
                                                type="button"
                                                class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-branch-trigger"
                                                data-id="${row.id}"
                                                title="Edit Branch">

                                                <i class="ri-edit-line text-lg"></i>

                                            </button>


                                            <button
                                                type="button"
                                                class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-branch-trigger deleteBranch"
                                                data-id="${row.id}"
                                                title="Delete Branch">

                                                <i class="ri-delete-bin-6-line text-lg"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>
                            `;

                        });

                    }



                    if ($.fn.DataTable.isDataTable('#branchRegistryDataTable')) {
                        $('#branchRegistryDataTable')
                            .DataTable()
                            .destroy();
                    }
                    $('#branchRegistryTableBody').html(html);

                    $('#branchRegistryDataTable').DataTable({
                        pageLength: 10,
                        language: {
                            emptyTable: "No Records Found"
                        }
                    });

                }
            );

        }
    </script>
@endpush
