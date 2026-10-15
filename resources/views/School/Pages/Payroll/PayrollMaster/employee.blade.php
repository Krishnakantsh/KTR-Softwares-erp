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
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Employee Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage employee personal, family, contact and
                            address information.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="EmployeeDataTable" />
                    <x-model-open target="payrollEmployeeModal" />
                </div>
            </div>


            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle" id="EmployeeDataTable"
                        data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Employee</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Contact</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Current Address</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Gender</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeRegistryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    @include('School.Pages.Payroll.components.add_update_employee')
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            fetchRegisteredEmployees();

            function resetEmployeeForm() {
                const form = $('#employeeRegistrationForm')[0];

                if (form) {
                    form.reset();
                }

                $('#employee_id').val('');
                $('#current_country').val('India');
                $('#permanent_country').val('India');
                $('#marital_status').val('1');
                $('#status').prop('checked', true);
                $('#profile_photo_preview').html('');
                $('#payrollEmployeeModalTitle').text('Add Employee');

                $('#staff_documents_gallery_grid').html('');
                $('#staff_doc_type_selector option').prop('disabled', false);
                $('#staff_hidden_payload_container').html('');
            }

            $('[data-bs-target="#payrollEmployeeModal"]').on('click', function() {
                resetEmployeeForm();
                $('#payrollEmployeeModalTitle').text('Add Employee');
            });

            $(document).on('click', '#resetEmployeeForm', function() {
                resetEmployeeForm();
            });


            $(document).on('click', '.edit-employee-trigger', function() {
                const id = $(this).data('id');

                if (!id) {
                    console.error('Employee ID not found');
                    return;
                }

                resetEmployeeForm();

                $('#payrollEmployeeModal').modal('show');
                $('#payrollEmployeeModalTitle').text('Edit Employee');

                getDataById(
                    "{{ route('school.payroll_employee.get.with') }}",
                    id,
                    function(res) {
                        if (!res.status || !res.data) {
                            console.error('Employee details not found', res);
                            return;
                        }

                        const row = res.data;

                        // Basic
                        $('#employee_id').val(row.id);
                        $('#first_name').val(row.first_name);
                        $('#middle_name').val(row.middle_name);
                        $('#last_name').val(row.last_name);
                        $('#display_name').val(row.display_name);
                        $('#gender').val(row.gender);
                        // $('#date_of_birth').val(row.date_of_birth);
                        $('#date_of_birth').val(toInputDate(row.date_of_birth));
                        $('#blood_group').val(row.blood_group);

                        // Family
                        $('#father_name').val(row.father_name);
                        $('#mother_name').val(row.mother_name);
                        $('#marital_status').val(row.marital_status);
                        $('#spouse_name').val(row.spouse_name);

                        // Contact
                        $('#personal_email').val(row.personal_email);
                        $('#personal_mobile').val(row.personal_mobile);
                        $('#alternate_mobile').val(row.alternate_mobile);

                        // Emergency
                        $('#emergency_contact_name').val(row.emergency_contact_name);
                        $('#emergency_contact_relation').val(row.emergency_contact_relation);
                        $('#emergency_contact_mobile').val(row.emergency_contact_mobile);

                        // Current Address
                        $('#current_address_line_1').val(row.current_address_line_1);
                        $('#current_address_line_2').val(row.current_address_line_2);
                        $('#current_country').val(row.current_country || 'India');
                        $('#current_state').val(row.current_state);
                        $('#current_district').val(row.current_district);
                        $('#current_city').val(row.current_city);
                        $('#current_area').val(row.current_area);
                        $('#current_pincode').val(row.current_pincode);

                        // Permanent Address
                        $('#permanent_address_line_1').val(row.permanent_address_line_1);
                        $('#permanent_address_line_2').val(row.permanent_address_line_2);
                        $('#permanent_country').val(row.permanent_country || 'India');
                        $('#permanent_state').val(row.permanent_state);
                        $('#permanent_district').val(row.permanent_district);
                        $('#permanent_city').val(row.permanent_city);
                        $('#permanent_area').val(row.permanent_area);
                        $('#permanent_pincode').val(row.permanent_pincode);

                        $('#same_as_permanent_address').prop('checked', row.same_as_permanent_address ==
                            1);

                        // Profile
                        $('#notes').val(row.notes);
                        $('#status').prop('checked', row.status == 1);

                        $('#profile_photo_preview').html('');

                        if (row.profile_photo) {
                            $('#profile_photo_preview').html(`
                                <a href="{{ asset('') }}${row.profile_photo}" target="_blank" class="text-primary">
                                    <i class="ri-image-line me-1"></i> View Current Profile Photo
                                </a>
                            `);
                        }

                        $('#payrollEmployeeModalTitle').text('Edit Employee');


                        // Employment Details (staff_employment_details is an array)
                        const emp = (row.staff_employment_details && row.staff_employment_details
                                .length) ?
                            row.staff_employment_details[0] : {};

                        function toInputDate(val) {
                            return val ? val.substring(0, 10) : '';
                        }

                        $('#employment_id').val(emp.id || '');
                        $('#employment_branch_id').val(emp.branch_id);
                        $('#employment_department_id').val(emp.department_id);
                        $('#employment_designation_id').val(emp.designation_id);
                        $('#employment_type_id').val(emp.employment_type_id);
                        $('#employment_employee_code').val(emp.employee_code);
                        $('#employment_employee_number').val(emp.employee_number);
                        $('#biometric_id').val(emp.biometric_id);
                        $('#attendance_device_user_id').val(emp.attendance_device_user_id);
                        $('#rfid_card_number').val(emp.rfid_card_number);
                        $('#joining_date').val(toInputDate(emp.joining_date));
                        $('#probation_start_date').val(toInputDate(emp.probation_start_date));
                        $('#probation_end_date').val(toInputDate(emp.probation_end_date));
                        $('#confirmation_date').val(toInputDate(emp.confirmation_date));
                        $('#employment_status').val(emp.employment_status || '1');
                        $('#leaving_date').val(toInputDate(emp.leaving_date));
                        $('#leaving_reason').val(emp.leaving_reason || '');
                        $('#attendance_mode').val(emp.attendance_mode || '1');
                        $('#is_attendance_required').prop('checked', emp.is_attendance_required == 1);
                        $('#is_payroll_applicable').prop('checked', emp.is_payroll_applicable == 1);
                        $('#remarks').val(emp.remarks);
                        $('#leaving_remarks').val(emp.leaving_remarks);

                        renderEmployeeDocuments(row.staff_documents);
                    }
                );
            });

            $('#payrollEmployeeModal').on('hidden.bs.modal', function() {
                resetEmployeeForm();
            });

        });

        function fetchRegisteredEmployees() {

            fetchMasterData(
                "{{ route('school.payroll_employee.fetch') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let fullName = [row.first_name, row.middle_name, row.last_name]
                                .filter(Boolean)
                                .join(' ');

                            let initials = fullName ?
                                fullName.split(' ').map(name => name.charAt(0)).join('').substring(0, 2)
                                .toUpperCase() :
                                'EMP';

                            let genderMap = {
                                1: 'Male',
                                2: 'Female',
                                3: 'Other'
                            };

                            let gender = genderMap[row.gender] || 'N/A';

                            let statusBadge = row.status == 1 ?
                                '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                                '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                            let contactText = row.personal_mobile ?
                                row.personal_mobile :
                                (row.personal_email ? row.personal_email :
                                    '<span class="text-neutral-400">—</span>');

                            let address = [row.current_city, row.current_district, row.current_state]
                                .filter(Boolean)
                                .join(', ') || '<span class="text-neutral-400">—</span>';

                            html += `
                                <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                    <td class="py-20 px-28">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-matrix-icon">
                                                <span class="fw-bold text-sm text-primary-600">${initials}</span>
                                            </div>
                                            <div>
                                                <h6 class="text-sm fw-bold mb-0 text-neutral-800">${fullName || 'N/A'}</h6>
                                                <small class="text-neutral-500 text-xs">Employee ID: ${row.id}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600 d-block">${contactText}</span>
                                        <small class="text-neutral-400 text-xs">${row.personal_email || 'No email'}</small>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600">${address}</span>
                                    </td>

                                    <td class="py-20 px-20">
                                        <span class="text-xs text-neutral-600 fw-semibold">${gender}</span>
                                        <small class="text-neutral-400 d-block text-xs">${row.blood_group || 'N/A'}</small>
                                    </td>

                                    <td class="py-20 px-20 text-center">
                                        ${statusBadge}
                                    </td>

                                    <td class="py-20 px-28 text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-employee-trigger"
                                                data-id="${row.id}">
                                                <i class="ri-edit-line text-lg"></i>
                                            </button>

                                            <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-employee-trigger deleteEmployee"
                                                data-id="${row.id}">
                                                <i class="ri-delete-bin-6-line text-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });

                    } else {

                        html = `
                            <tr>
                                <td colspan="6" class="py-40 text-center">
                                    <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                    <span class="text-sm fw-medium text-neutral-500">No Employee Records Found</span>
                                </td>
                            </tr>
                        `;
                    }

                    $('#employeeRegistryTableBody').html(html);

                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.map(function(el) {
                        return new bootstrap.Tooltip(el);
                    });
                }
            );
        }
    </script>
@endpush
