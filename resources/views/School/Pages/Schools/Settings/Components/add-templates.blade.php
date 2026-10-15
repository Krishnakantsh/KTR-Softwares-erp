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
