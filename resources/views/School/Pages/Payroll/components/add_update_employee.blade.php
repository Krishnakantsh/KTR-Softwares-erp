<div class="modal fade" id="payrollEmployeeModal" tabindex="-1" aria-labelledby="payrollEmployeeModalTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">

        <div class="modal-content radius-16 overflow-hidden">
            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="payrollBranchModalTitle">
                        Employee Registration
                    </h6>
                    <small class="text-neutral-500 text-xs"> Manage employee personal, family, contact and address
                        information</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <div class="modal-body p-24">
                <form id="employeeRegistrationForm" class="ajaxForm"
                    data-url="{{ route('school.payroll_employee.save') }}" data-refresh="fetchRegisteredEmployees"
                    data-method="POST" enctype="multipart/form-data" autocomplete="off">

                    @csrf
                    <input type="hidden" name="id" id="employee_id">
                    <input type="hidden" name="employment_id" id="employment_id">



                    <ul class="nav nav-tabs mb-24" id="employeeModalTabs" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="employee-details-tab" data-bs-toggle="tab"
                                data-bs-target="#employeeDetailsTabPane" type="button" role="tab"
                                aria-controls="employeeDetailsTabPane" aria-selected="true">

                                <i class="ri-user-line me-1"></i>
                                Basic Information

                            </button>
                        </li>


                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="employment-details-tab" data-bs-toggle="tab"
                                data-bs-target="#employmentDetailTabPane" type="button" role="tab"
                                aria-controls="employmentDetailTabPane" aria-selected="false">
                                <i class="ri-briefcase-line me-1"></i>
                                Employment Details
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="employment-address-tab" data-bs-toggle="tab"
                                data-bs-target="#employmentAddressTabPane" type="button" role="tab"
                                aria-controls="employmentAddressTabPane" aria-selected="false">
                                <i class="ri-briefcase-line me-1"></i>
                                Employment Address
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="employment-documents-tab" data-bs-toggle="tab"
                                data-bs-target="#employmentDocumentsTabPane" type="button" role="tab"
                                aria-controls="employmentDocumentsTabPane" aria-selected="false">
                                <i class="ri-briefcase-line me-1"></i>
                                Documents
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="employeeModalTabsContent">


                        <div class="tab-pane fade show active" id="employeeDetailsTabPane" role="tabpanel"
                            aria-labelledby="employee-details-tab">

                            @include('School.Pages.Payroll.components.EmployeeRegistration.emp_basic_registration')

                        </div>



                        <div class="tab-pane fade" id="employmentDetailTabPane" role="tabpanel"
                            aria-labelledby="employment-details-tab">

                            @include('School.Pages.Payroll.components.EmployeeRegistration.emp_employment_details')
                        </div>
                        <div class="tab-pane fade" id="employmentAddressTabPane" role="tabpanel"
                            aria-labelledby="employment-address-tab">
                            @include('School/Pages/Payroll/components/EmployeeRegistration/employee_address')
                        </div>
                        <div class="tab-pane fade" id="employmentDocumentsTabPane" role="tabpanel"
                            aria-labelledby="employment-documents-tab">

                            @include('School/Pages/Payroll/components/EmployeeRegistration/emp_documents')
                        </div>
                    </div>

                    <div
                        class="modal-footer border-top bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0">System
                                Record Status</label>
                            <label class="switch mb-0">
                                <input type="checkbox" role="switch" id="status" name="status" value="1"
                                    checked class="module-active-toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" id="resetEmployeeForm" class="btn btn-premium-action-secondary">
                                <i class="ri-refresh-line me-2"></i> Clear
                            </button>
                            <button type="submit" class="btn btn-premium-action-primary">
                                <i class="ri-save-3-line me-2"></i> Save Employee
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<style>
    .address-section-block {
        border-radius: 12px;
        padding: 16px;
        border: 1px solid transparent;
    }

    .address-section-title {
        color: inherit;
    }

    .current-address-block {
        background-color: #eaf4ff;
        border-color: #a9d3ff;
    }

    .current-address-block .address-section-title {
        color: #1467c9;
    }

    .permanent-address-block {
        background-color: #fff4e6;
        border-color: #ffcf8f;
    }

    .permanent-address-block .address-section-title {
        color: #b5670a;
    }
</style>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            loadDropdowns();

            const sameAsCurrentCheckbox = document.getElementById('same_as_permanent_address');

            const addressFieldMap = {
                current_address_line_1: 'permanent_address_line_1',
                current_address_line_2: 'permanent_address_line_2',
                current_country: 'permanent_country',
                current_state: 'permanent_state',
                current_district: 'permanent_district',
                current_city: 'permanent_city',
                current_area: 'permanent_area',
                current_pincode: 'permanent_pincode',
            };

            function copyCurrentToPermanent() {
                Object.entries(addressFieldMap).forEach(([currentId, permanentId]) => {
                    const currentEl = document.getElementById(currentId);
                    const permanentEl = document.getElementById(permanentId);
                    if (currentEl && permanentEl) {
                        permanentEl.value = currentEl.value;
                    }
                });
            }

            function togglePermanentFieldsReadonly(readonly) {
                Object.values(addressFieldMap).forEach((permanentId) => {
                    const el = document.getElementById(permanentId);
                    if (!el) return;
                    if (readonly) {
                        el.setAttribute('readonly', 'readonly');
                    } else {
                        el.removeAttribute('readonly');
                    }
                });
            }

            if (sameAsCurrentCheckbox) {
                sameAsCurrentCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        copyCurrentToPermanent();
                        togglePermanentFieldsReadonly(true);
                    } else {
                        togglePermanentFieldsReadonly(false);
                    }
                });
                Object.keys(addressFieldMap).forEach((currentId) => {
                    const el = document.getElementById(currentId);
                    if (el) {
                        el.addEventListener('input', function() {
                            if (sameAsCurrentCheckbox.checked) {
                                copyCurrentToPermanent();
                            }
                        });
                    }
                });
            }




            function loadDropdowns() {


                // resetEmployeeForm();

                $('#payrollEmployeeModalTitle').text('Add Employee');

                fetchDropdownOptions(
                    "{{ route('school.payroll_branch.fetch') }}",
                    'employment_branch_id', {
                        textKey: 'branch_name',
                        placeholder: 'Select Branch'
                    }
                );

                fetchDropdownOptions(
                    "{{ route('school.payroll_department.fetch') }}",
                    'employment_department_id', {
                        textKey: 'department_name',
                        placeholder: 'Select Department'
                    }
                );

                fetchDropdownOptions(
                    "{{ route('school.payroll_designation.fetch') }}",
                    'employment_designation_id', {
                        textKey: 'designation_name',
                        placeholder: 'Select Designation'
                    }
                );

                fetchDropdownOptions(
                    "{{ route('school.payroll_employment_type.fetch') }}",
                    'employment_type_id', {
                        textKey: 'employment_type_name',
                        placeholder: 'Select Employment Type'
                    }
                );
            };


            function fetchDropdownOptions(routeUrl, selectId, options = {}) {

                const {
                    valueKey = 'id',
                        textKey = 'name',
                        placeholder = 'Select',
                        selectedValue = null
                } = options;

                fetchMasterData(routeUrl, function(res) {

                    const $select = $('#' + selectId);
                    let html = `<option value="">${placeholder}</option>`;

                    if (res.status && res.data && res.data.length > 0) {
                        $.each(res.data, function(index, row) {
                            html += `<option value="${row[valueKey]}">${row[textKey]}</option>`;
                        });
                    }

                    $select.html(html);

                    if (selectedValue) {
                        $select.val(selectedValue);
                    }
                });
            }
        });

        // window.renderEmployeeDocuments = function(documents) {

        //     const container = $('#staff_documents_gallery_grid');

        //     if (!container.length) {
        //         return;
        //     }

        //     let html = '';

        //     // reset disabled options har baar
        //     $('#staff_doc_type_selector option').prop('disabled', false);

        //     if (!documents || !documents.length) {

        //         html = `
    //     <div class="text-center py-24 text-neutral-400 w-100">
    //         <i class="ri-file-list-3-line text-3xl d-block mb-2"></i>
    //         <span class="text-sm">No documents uploaded</span>
    //     </div>
    // `;

        //     } else {

        //         documents.forEach(function(doc) {

        //             const fileUrl = `{{ asset('') }}${doc.file_path}`;
        //             const isImage = (doc.mime_type || '').startsWith('image/');

        //             html += `
    //         <div class="col-xl-3 col-lg-4 col-md-6" data-doc-type="${doc.document_type}">
    //             <div class="staff-doc-preview-card position-relative">

    //                 ${doc.is_primary ? `<span class="staff-doc-primary-flag">PRIMARY</span>` : ''}

    //                 <div class="staff-doc-image-box">
    //                     ${isImage
    //                         ? `<img src="${fileUrl}" style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;">`
    //                         : `<i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:48px;"></i>`
    //                     }
    //                 </div>

    //                 <div class="staff-doc-action-bar">
    //                     <p class="staff-doc-title">${doc.document_name || 'Document'}</p>
    //                     <a href="${fileUrl}" target="_blank" class="staff-doc-meta-badge text-white text-decoration-none">
    //                         <i class="ri-eye-line"></i>
    //                     </a>
    //                 </div>

    //                 ${doc.document_number ? `<div class="staff-doc-extra-info">No: ${doc.document_number}</div>` : ''}

    //                 <div class="staff-doc-remark-tag text-truncate">
    //                     <strong>Note:</strong> ${doc.remarks || doc.verification_remarks || 'No remark'}
    //                 </div>

    //             </div>
    //         </div>
    //     `;

        //             // is document type ka dropdown option disable kar do taaki duplicate add na ho
        //             $(`#staff_doc_type_selector option[value="${doc.document_type}"]`).prop('disabled', true);
        //         });
        //     }

        //     container.html(html);
        // }


        window.renderEmployeeDocuments = function(documents) {

            const container = $('#staff_documents_gallery_grid');

            if (!container.length) {
                return;
            }

            let html = '';

            // reset disabled options har baar
            $('#staff_doc_type_selector option').prop('disabled', false);

            if (!documents || !documents.length) {

                html = `
            <div class="text-center py-24 text-neutral-400 w-100">
                <i class="ri-file-list-3-line text-3xl d-block mb-2"></i>
                <span class="text-sm">No documents uploaded</span>
            </div>
        `;

            } else {

                documents.forEach(function(doc) {

                    const fileUrl = `{{ asset('') }}${doc.file_path}`;
                    const isImage = (doc.mime_type || '').startsWith('image/');
                    const cardId = `existing_doc_card_${doc.id}`;

                    html += `
                <div class="col-xl-3 col-lg-4 col-md-6"
                     id="${cardId}"
                     data-doc-type="${doc.document_type}"
                     data-existing-id="${doc.id}">
                    <div class="staff-doc-preview-card position-relative">

                        ${doc.is_primary ? `<span class="staff-doc-primary-flag">PRIMARY</span>` : ''}

                        <div class="staff-doc-image-box">
                            ${isImage
                                ? `<img src="${fileUrl}" style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;">`
                                : `<i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:48px;"></i>`
                            }
                        </div>

                        <div class="staff-doc-action-bar">
                            <p class="staff-doc-title">${doc.document_name || 'Document'}</p>

                            <div class="d-flex align-items-center gap-1">
                                <a href="${fileUrl}" target="_blank"
                                   class="staff-doc-meta-badge text-white text-decoration-none"
                                   title="View Document">
                                    <i class="ri-eye-line"></i>
                                </a>

                                <button type="button"
                                    class="staff-doc-meta-badge border-0"
                                    title="Remove / Replace Document"
                                    onclick="removeExistingStaffDocument(${doc.id}, '${doc.document_type}', '${cardId}')">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </button>
                            </div>
                        </div>

                        ${doc.document_number ? `<div class="staff-doc-extra-info">No: ${doc.document_number}</div>` : ''}

                        <div class="staff-doc-remark-tag text-truncate">
                            <strong>Note:</strong> ${doc.remarks || doc.verification_remarks || 'No remark'}
                        </div>

                    </div>
                </div>
            `;

                    // is document type ka dropdown option disable kar do taaki duplicate add na ho
                    $(`#staff_doc_type_selector option[value="${doc.document_type}"]`).prop('disabled', true);
                });
            }

            container.html(html);
        }

        function removeExistingStaffDocument(docId, docType, cardId) {

            if (!confirm('Are you sure you want to remove this document? You can upload a new one after removing.')) {
                return;
            }

            // Card hata do UI se
            $('#' + cardId).remove();

            // Dropdown ka option wapas enable kar do taaki naya upload ho sake
            $('#staff_doc_type_selector option[value="' + docType + '"]').prop('disabled', false);

            // Backend ko batane ke liye hidden input add karo — is document ko delete mark karo
            const payloadContainer = document.getElementById('staff_hidden_payload_container');

            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'deleted_documents[]';
            deleteInput.value = docId;
            deleteInput.id = `deleted_doc_${docId}`;

            payloadContainer.appendChild(deleteInput);

            showToast('success', 'Document marked for removal. You can now upload a replacement.');
        }
    </script>
@endpush
