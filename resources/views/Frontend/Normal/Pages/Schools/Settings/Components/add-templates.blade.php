<div class="dashboard-main-body">

    <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <div>
            <h1 class="fw-semibold mb-4 h6 text-primary-light">Manage SMS Template</h1>
        </div>


        <div class="d-flex align-items-center justify-center gap-4">

            <!-- Template Type -->
            <button type="button"
                class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1"
                data-bs-toggle="modal" data-bs-target="#templateTypeModal" style="height: fit-content;">

                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 32px; height: 32px; flex-shrink: 0;">
                    <i class="ri-add-line text-primary-600"></i>
                </div>

                <span class="pe-4 me-2">Template Type</span>
            </button>

            <!-- SMS Template -->
            <button type="button"
                class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1"
                data-bs-toggle="modal" data-bs-target="#smsTemplateModal" style="height: fit-content;">

                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 32px; height: 32px; flex-shrink: 0;">
                    <i class="ri-add-line text-primary-600"></i>
                </div>

                <span class="pe-4 me-2">SMS Template</span>
            </button>

        </div>
    </div>

    <!-- SMS Template Table -->
    <div class="mt-24">
        <div class="card h-100">

            <div class="card-body p-0 dataTable-wrapper">

                <x-datatable--toolbar tableId="smsTemplateTable" />

                <div class="p-3">
                    <table class="table bordered-table mb-0 data-table" id="smsTemplateTable" data-page-length='10'>

                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Template ID</th>
                                <th>Template Title</th>
                                <th>Template Type</th>
                                <th>Sender ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="smsTemplateTableBody">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="templateTypeModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-md modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-primary-600 px-4 py-3 border-0">

                <div class="px-16">
                    <h6 class="modal-title text-white fw-medium mb-1">
                        Add Template Type
                        </h5>

                </div>


                <button type="button" class="btn-close btn-close-white premium-close-btn" data-bs-dismiss="modal">

                    <i class="ri-close-line"></i>

                </button>
            </div>

            <!-- Body -->
            <form id="templateTypeForm" class="ajaxForm px-16" data-url="{{ route('school.template.type.save') }}"
                data-refresh="fetchTemplateType" data-method="POST">

                @csrf

                <input type="hidden" name="id" id="template_type_id">

                <div class="modal-body p-4">

                    <div class="mb-20">

                        <label class="form-label fw-semibold text-primary-light">
                            Template Type Name
                        </label>

                        <input type="text" class="form-control radius-12" name="name" id="template_type_name"
                            placeholder="Enter Template Type Name">

                    </div>

                    <div class="mb-20">

                        <label class="form-label fw-semibold text-primary-light">
                            Status
                        </label>

                        <select name="status" class="form-control form-select radius-12">
                            <option value="1" selected>
                                Active
                            </option>
                            <option value="0">
                                Inactive
                            </option>
                        </select>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 pt-0 px-4 pb-4">



                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-light radius-48 fw-bold d-inline-flex align-items-center border gap-2 px-2 py-1">

                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="ri-close-line "></i>
                        </div>

                        <span class="pe-4 me-2"> Cancel</span>
                    </button>


                    <button type="submit"
                        class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="ri-check-line text-primary-600"></i>
                        </div>

                        <span class="pe-4 me-2">Save</span>
                    </button>


                </div>

            </form>

            <!-- ========================================================= -->
            <!-- TEMPLATE TYPE LIST -->
            <!-- ========================================================= -->

            <div class="border-top px-4 py-3 bg-light">

                <h6 class="fw-bold mb-3">
                    Template Type List
                </h6>

                <div class="table-responsive">

                    <table class="table bordered-table mb-0">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody id="templateTypeTableBody">

                        </tbody>

                    </table>

                </div>

            </div>


        </div>
    </div>
</div>


<!-- ========================================================= -->
<!-- SMS TEMPLATE MODAL -->
<!-- ========================================================= -->

<div class="modal fade" id="smsTemplateModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-primary-600 px-4 py-3 border-0">

                <div class="px-16">
                    <h5 class="modal-title text-white fw-bold mb-1">
                        Add SMS Template
                    </h5>

                </div>

                <button type="button" class="btn-close btn-close-white premium-close-btn" data-bs-dismiss="modal">

                    <i class="ri-close-line"></i>

                </button>


            </div>

            <!-- FORM -->
            <form id="smsTemplateForm" class="ajaxForm px-16 pt-16" enctype="multipart/form-data"
                data-url="{{ route('school.template.save') }}" data-refresh="fetchTemplate" data-method="POST">

                @csrf

                <input type="hidden" name="id" id="sms_template_id">

                <div class="modal-body p-4">

                    <div class="row g-4">

                        <!-- Template ID -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_id"
                                placeholder="Enter Template ID">
                        </div>

                        <!-- Template Title -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_title"
                                placeholder="Enter Template Title">
                        </div>

                        <!-- Template Type -->
                        <div class="col-md-6">


                            <select name="template_typeId" id="template_typeId"
                                class="form-control form-select radius-12">




                            </select>
                        </div>
                        <div class="col-md-6">


                            <select name="template_language" class="form-control form-select radius-12">
                                <option value="en" selected>English</option>
                                <option value="hi">Hindi</option>

                            </select>
                        </div>

                        <!-- Company -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_company"
                                placeholder="Enter Company Name">
                        </div>

                        <!-- Sender ID -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_senderId"
                                placeholder="Enter Sender ID">
                        </div>

                        <!-- Status -->
                        <div class="col-md-12">


                            <select name="status" class="form-control form-select radius-12">
                                <option value="temporary" selected>Temporary</option>
                                <option value="permanent">Permanent</option>

                            </select>
                        </div>

                        <!-- SMS -->
                        <div class="col-12">

                            <textarea class="form-control radius-12" rows="6" name="sms" placeholder="Enter SMS Template"></textarea>
                        </div>

                    </div>

                </div>


                <!-- Footer -->
                <div class="modal-footer border-0 pt-16 px-4 pb-4 ">

                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-light radius-48 fw-bold d-inline-flex align-items-center border gap-2 px-2 py-1">

                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="ri-close-line "></i>
                        </div>

                        <span class="pe-4 me-2"> Cancel</span>
                    </button>


                    <button type="submit"
                        class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="ri-check-line text-primary-600"></i>
                        </div>

                        <span class="pe-4 me-2">Save</span>
                    </button>


                </div>
            </form>

        </div>
    </div>
</div>
@push('script')
    <script>
        // =========================================================
        // FETCH SMS TEMPLATE
        // =========================================================

        window.fetchTemplate = function() {

            $.ajax({

                url: "{{ route('school.template.fetch.with') }}",
                method: "GET",

                success: function(res) {

                    console.log("Fetched Template ", res);

                    let rows = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(i, d) {

                            rows += `
                            <tr>

                                <td>${i + 1}</td>

                                <td>
                                    ${d.template_id ?? '-'}
                                </td>

                                <td>
                                    ${d.template_title ?? '-'}
                                </td>

                                <td>
                                    ${d.template_type?.name ?? '-'}
                                </td>

                                <td>
                                    ${d.template_senderId ?? '-'}
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        ${d.status}
                                    </span>
                                </td>

                                <td class="d-flex align-items-center gap-2">

                                 



                                    <button
                                        type="button"
                                        data-id="${d.id}"
                                        class="editTemplate">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button
                                        type="button"
                                        data-id="${d.id}"
                                        class="deleteTemplate">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>

                                </td>

                            </tr>
                        `;
                        });

                    } else {

                        rows = `
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No Template Found
                            </td>
                        </tr>
                    `;
                    }

                    $('#smsTemplateTableBody').html(rows);
                }
            });
        };



        // =========================================================
        // FETCH TEMPLATE TYPES
        // =========================================================

        window.fetchTemplateType = function() {

            $.ajax({

                url: "{{ route('school.template.type.fetch') }}",
                method: "GET",

                success: function(res) {

                    let options = '';
                    let rows = '';

                    if (res.status && res.data.length > 0) {

                        options += `
                        <option value="">
                            --- Choose Template Type ---
                        </option>
                    `;

                        $.each(res.data, function(i, d) {

                            // select option
                            options += `
                            <option value="${d.id}">
                                ${d.name}
                            </option>
                        `;

                            // list
                            rows += `
                            <tr>

                                <td>
                                    ${d.name}
                                </td>

                                <td>
                                    <button
                                        type="button"
                                        data-id="${d.id}"
                                        class="editTemplateType">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button
                                        type="button"
                                        data-id="${d.id}"
                                        class="deleteTemplateType">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>


                                </td>

                            </tr>
                        `;
                        });

                    } else {

                        options += `
                        <option value="">
                            No Template Type Found
                        </option>
                    `;

                        rows += `
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                No Template Type Found
                            </td>
                        </tr>
                    `;
                    }

                    $('#template_typeId').html(options);

                    $('#templateTypeTableBody').html(rows);
                }
            });
        };



        // =========================================================
        // EDIT TEMPLATE
        // =========================================================

        $(document).on('click', '.editTemplate', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.template.get.with') }}",
                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    let d = res.data;

                    $('#sms_template_id').val(d.id);

                    $('input[name="template_id"]').val(d.template_id);

                    $('input[name="template_title"]').val(d.template_title);

                    $('#template_typeId').val(d.templateType?.id);

                    $('select[name="template_language"]').val(d.template_language);

                    $('input[name="template_company"]').val(d.template_company);

                    $('input[name="template_senderId"]').val(d.template_senderId);

                    $('select[name="status"]').val(d.status);

                    $('textarea[name="sms"]').val(d.sms);

                    $('#smsTemplateModal').modal('show');

                }
            });

        });



        // =========================================================
        // EDIT TEMPLATE TYPE
        // =========================================================

        $(document).on('click', '.editTemplateType', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.template.type.get') }}",
                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    let d = res.data;

                    $('#template_type_id').val(d.id);

                    $('#template_type_name').val(d.name);

                    $('select[name="status"]').val(d.status);

                    $('#templateTypeModal').modal('show');

                }
            });

        });



 



        // =========================================================
        // DELETE TEMPLATE TYPE
        // =========================================================

        // $(document).on('click', '.deleteTemplateType', function() {

        //     let id = $(this).data('id');

        //     let route = "{{ route('school.template.type.delete') }}";

        //     masterDelete(id, route, [fetchTemplateType]);

        // });



        // =========================================================
        // RESET FORM WHEN MODAL CLOSE
        // =========================================================

        $('#smsTemplateModal').on('hidden.bs.modal', function() {

            $('#smsTemplateForm')[0].reset();

            $('#sms_template_id').val('');

        });

        $('#templateTypeModal').on('hidden.bs.modal', function() {

            $('#templateTypeForm')[0].reset();

            $('#template_type_id').val('');

        });



        // =========================================================
        // INIT
        // =========================================================

        $(document).ready(function() {

            fetchTemplate();

            fetchTemplateType();

        });
    </script>
@endpush
