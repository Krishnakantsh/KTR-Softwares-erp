@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Enterprise School Provisioning Engine')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-file-code-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Notification Templates</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage master delivery alerts and bulk provisioning
                            arrays.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="toggleTemplateForm"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Add Template
                    </button>
                    <button type="button" id="uploaddBulkTemplates"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-download-cloud-2-line text-primary-600"></i> Open Bulk Upload
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Template</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">Title
                                    / Content</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Language</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="notificationTemplateTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="notificationTemplateFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card d-none">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 radius-10 border border-primary-100">
                        <i class="ri-file-code-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Create Notification Template</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure master delivery alerts, layout body payloads, and
                            variable system injection matrices.</p>
                    </div>
                </div>
                <button type="button" id="closeTemplateForm" class="btn btn-sm btn-danger-subtle px-16 py-8 radius-8">
                    <i class="ri-close-line"></i> Close
                </button>
            </div>

            <div class="card-body p-28">
                <form id="notificationTemplateForm" class="ajaxForm"
                    data-url="{{ route('superAdmin.notificationTemplate.save') }}" data-refresh="fetchNotificationTemplates"
                    data-method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="template_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Template Mapping Meta
                            </h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Admin Friendly Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-bookmark-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="name" name="name" placeholder="e.g., Student Attendance Alert"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Unique Template Key <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-key-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8 font-monospace text-xs"
                                            id="template_key" name="template_key" placeholder="e.g., attendance_marked"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Target Language Cluster
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-translate-2 text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            id="language" name="language">
                                            <option value="en" selected>English (en)</option>
                                            <option value="hi">Hindi (hi)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Payload Title & Data
                                Stream</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Push Notification Title <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-notification-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8" id="title"
                                            name="title" placeholder="e.g., Attendance Update: :student_name is Present"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Push Notification Body Payload (LongText) <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control custom-premium-input p-16 radius-8" id="content" name="content" rows="4"
                                        style="height: auto;"
                                        placeholder="Dear Parent, your ward :student_name has been marked present for today's session." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-32">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-warning-100 text-warning-700 font-xs fw-bold px-12 py-6 radius-6">03</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">System Directives &
                                Node Access</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-md-6 col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Core System Node Block
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-shield-user-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            id="is_system" name="is_system">
                                            <option value="0" selected>Regular Template (Mutable)</option>
                                            <option value="1">Core System Block (Protected Layer)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Execution State Status
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-pulse-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            id="is_active" name="is_active">
                                            <option value="1" selected>Active & Live Stream Operational</option>
                                            <option value="0">Deactivated / Standby Mode</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetTemplateForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset Engine
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Deploy Core Template
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="bulkTemplateCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card bulk-template-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 radius-10 border border-primary-100">
                        <i class="ri-file-code-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Bulk Template Provisioning</h5>
                        <p class="text-xs text-neutral-500 mb-0">Upload a secure JSON archive containing system
                            configuration arrays to map mass notification channels.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="downloadSampleJson"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 px-16 py-8 radius-8 fw-semibold">
                        <i class="ri-download-cloud-2-line text-primary-600"></i>
                        Download Schema Matrix
                    </button>
                    <button type="button" id="closeBulkTemplates"
                        class="btn btn-sm btn-danger-subtle px-16 py-8 radius-8">
                        <i class="ri-close-line"></i>
                        Close
                    </button>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="bulkTemplateForm" class="ajaxForm" enctype="multipart/form-data"
                    data-url="{{ route('superAdmin.notificationTemplate.bulkUpload') }}"
                    data-refresh="onBulkDeploymentComplete" data-method="POST" autocomplete="off">
                    @csrf

                    <div class="premium-upload-zone text-center p-40 border-dashed-custom radius-12 cursor-pointer transition-all mb-24"
                        id="jsonDropzone">
                        <input type="file" name="json_file" id="json_file_input" accept=".json" class="d-none">
                        <div class="upload-icon-pulse mb-16">
                            <i class="ri-folder-upload-fill text-gradient-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h6 class="text-md fw-bold text-neutral-800 mb-4" id="uploadZoneTitle">Drag & Drop Template JSON
                            file here</h6>
                        <p class="text-xs text-neutral-500 mb-12">Only verified structures conforming to system migration
                            fields are processed</p>
                        <button type="button"
                            class="btn btn-primary bg-primary-600 text-white px-20 py-10 text-xs radius-8 fw-semibold border-0 shadow-sm"
                            onclick="$('#json_file_input').click();">
                            Browse File System
                        </button>
                    </div>

                    <div id="fileMetricsPanel"
                        class="horizontal-premium-row-card border border-neutral-200 radius-12 p-20 mb-24 d-none">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success-50 border border-success-100 p-2 radius-8">
                                    <i class="ri-checkbox-circle-fill text-xl text-success-600"></i>
                                </div>
                                <div>
                                    <span class="text-xs fw-bold text-neutral-500 text-uppercase tracking-wider">Target
                                        Archive Parsed</span>
                                    <h6 class="text-sm fw-bold text-neutral-800 mb-0 mt-2" id="metaFileName">
                                        templates_payload.json</h6>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6"
                                    id="metaRecordCount">0 Entries Found</span>
                                <p class="text-xxs text-neutral-400 mt-4 mb-0" id="metaFileSize">0.00 KB</p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetUploadZone"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Clear Node
                        </button>
                        <button type="submit" disabled id="btnDeployBulk"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-rocket-2-line"></i> Inject Bulk Templates
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            fetchNotificationTemplates();

            $('#toggleTemplateForm').on('click', function() {
                $('#notificationTemplateFormCard').toggleClass('d-none');
                let opened = !$('#notificationTemplateFormCard').hasClass('d-none');
                $(this).html(opened ?
                    '<i class="ri-close-line"></i> Close Form' :
                    '<i class="ri-add-line text-primary-600"></i> Add Template');
                if (opened) {
                    $('html,body').animate({
                        scrollTop: $('#notificationTemplateFormCard').offset().top - 20
                    }, 500);
                }
            });

            $('#closeTemplateForm').on('click', function() {
                $('#notificationTemplateFormCard').addClass('d-none');
                $('#toggleTemplateForm').html('<i class="ri-add-line text-primary-600"></i> Add Template');
                resetTemplateForm();
            });

            $('#resetTemplateForm').on('click', resetTemplateForm);

            function resetTemplateForm() {
                $('#notificationTemplateForm')[0].reset();
                $('#template_id').val('');
                $('#is_system').val('0').change();
                $('#is_active').val('1').change();
            }


            $('#uploaddBulkTemplates').on('click', function() {
                $('#bulkTemplateCard').toggleClass('show');
                let opened = $('#bulkTemplateCard').hasClass('show');
                $(this).html(opened ?
                    '<i class="ri-close-line"></i> Close Bulk Upload' :
                    '<i class="ri-download-cloud-2-line"></i> Open Bulk Upload');
                $('html,body').animate({
                    scrollTop: $('#bulkTemplateCard').offset().top - 20
                }, 500);
            });


            $('#closeBulkTemplates').on('click', function() {
                $('#bulkTemplateCard').removeClass('show');
                $('#uploaddBulkTemplates')
                    .html('<i class="ri-download-cloud-2-line text-primary-600"></i> Open Bulk Upload')
                    .prop('disabled', false);
            });

            const dropzone = $('#jsonDropzone');
            const fileInput = $('#json_file_input');

            dropzone.on('dragover dragenter', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.addClass('dragover');
            });

            dropzone.on('dragleave drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.removeClass('dragover');
            });

            dropzone.on('drop', function(e) {
                let files = e.originalEvent.dataTransfer.files;
                if (files.length) {
                    fileInput[0].files = files;
                    handleFileStream(files[0]);
                }
            });

            fileInput.on('change', function() {
                if (this.files.length) handleFileStream(this.files[0]);
            });

            function handleFileStream(file) {
                if (file.type !== "application/json" && !file.name.endsWith('.json')) {
                    alert('Security Matrix Exception: Target asset must compile strictly as a JSON payload.');
                    return resetUploader();
                }
                let reader = new FileReader();
                reader.onload = function(e) {
                    try {
                        let parsedJson = JSON.parse(e.target.result);
                        let recordCount = Array.isArray(parsedJson) ? parsedJson.length : 1;

                        $('#metaFileName').text(file.name);
                        $('#metaFileSize').text((file.size / 1024).toFixed(2) + ' KB');
                        $('#metaRecordCount').text(recordCount + ' Payload Objects Verified');
                        $('#uploadZoneTitle').text("Asset linked successfully!");
                        $('#fileMetricsPanel').removeClass('d-none');
                        $('#btnDeployBulk').prop('disabled', false);
                    } catch (err) {
                        alert('Schema Diagnostics Failed: Invalid JSON context hierarchy.');
                        resetUploader();
                    }
                };
                reader.readAsText(file);
            }

            function resetUploader() {
                fileInput.val('');
                $('#uploadZoneTitle').text("Drag & Drop Template JSON file here");
                $('#fileMetricsPanel').addClass('d-none');
                $('#btnDeployBulk').prop('disabled', true);
            }

            $('#resetUploadZone').on('click', resetUploader);

            $('#downloadSampleJson').on('click', function() {
                const schemaSample = [{
                    "name": "Fee Collection Confirmation",
                    "template_key": "fee_received",
                    "language": "en",
                    "title": "Payment Cleared Successfully",
                    "content": "Dear Guardian, sum of :amount has been accounted via Receipt No: :receipt_no.",
                    "variables": ["student_name", "amount", "receipt_no"],
                    "description": "Triggered instantly on accounting ledger entry execution.",
                    "is_system": true,
                    "is_active": true
                }];
                let dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(
                    schemaSample, null, 4));
                let a = document.createElement('a');
                a.setAttribute("href", dataStr);
                a.setAttribute("download", "notification_matrix_blueprint.json");
                document.body.appendChild(a);
                a.click();
                a.remove();
            });


            $(document).on("click", ".edit-template-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('superAdmin.notificationTemplate.get') }}", id, function(res) {
                    if (!res.status) return;
                    let row = res.data;

                    $("#template_id").val(row.id);
                    $("#name").val(row.name);
                    $("#template_key").val(row.template_key);
                    $("#language").val(row.language).change();
                    $("#title").val(row.title);
                    $("#content").val(row.content);
                    $("#is_system").val(row.is_system == true ? 1 : 0).change();
                    $("#is_active").val(row.is_active == true ? 1 : 0).change();

                    $('#notificationTemplateFormCard').removeClass('d-none');
                    $('#toggleTemplateForm').html('<i class="ri-close-line"></i> Close Form');

                    $("html, body").animate({
                        scrollTop: $('#notificationTemplateFormCard').offset().top - 20
                    }, 300);
                });
            });


            $(document).on("click", ".status-template-trigger", function() {
                let id = $(this).data("id");
                let currentStatus = $(this).data("status");

                $.ajax({
                    url: "{{ route('superAdmin.notificationTemplate.status') }}",
                    method: "POST",
                    data: {
                        id: id,
                        _method: 'PUT',
                    },
                    success: function(res) {

                        showToast('success', res.message)
                        fetchNotificationTemplates()
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);

                    }

                });

            });


            function onBulkDeploymentComplete(res) {
                if (res.status) {
                    alert('Cluster Status: Array configurations successfully provisioned within scope.');
                    $('#bulkTemplateCard').removeClass('show');
                    $('#uploaddBulkTemplates').html(
                        '<i class="ri-download-cloud-2-line text-primary-600"></i> Open Bulk Upload');
                    $('#resetUploadZone').trigger('click');
                    fetchNotificationTemplates();
                }
            }


            function fetchNotificationTemplates() {
                fetchMasterData("{{ route('superAdmin.notificationTemplate.fetch') }}", function(res) {
                    let html = '';

                    if (res.status && res.data.length > 0) {
                        $.each(res.data, function(index, row) {

                            let sysBadge = row.is_system == 1 ?
                                `<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-8 py-2 radius-4 font-xxs">System</span>` :
                                '';

                            let statusBadge = row.is_active == 1 ?
                                `<span class="badge bg-success-100 text-success-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Active</span>` :
                                `<span class="badge bg-danger-100 text-danger-800 px-12 py-6 radius-20 font-xxs fw-bold uppercase tracking-wider">Inactive</span>`;

                            let toggleIcon = row.is_active == 1 ? 'ri-toggle-fill' :
                                'ri-toggle-line';
                            let toggleTitle = row.is_active == 1 ? 'Deactivate Template' :
                                'Activate Template';
                            let toggleBtnClass = row.is_active == 1 ?
                                'bg-warning-50 hover-bg-warning-100 border border-warning-200 text-warning-700' :
                                'bg-success-50 hover-bg-success-100 border border-success-200 text-success-700';

                            html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 radius-8 bg-neutral-100 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="ri-notification-line text-lg text-primary-600"></i>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-2">
                                                <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.name}</h6>
                                                ${sysBadge}
                                            </div>
                                            <span class="text-xs text-neutral-400 font-mono">${row.template_key}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-20 px-20">
                                    <div class="d-flex flex-column gap-1" style="max-width: 320px;">
                                        <span class="text-xs fw-semibold text-neutral-800">${row.title}</span>
                                        <span class="text-xxs text-neutral-500 text-truncate d-block">${row.content}</span>
                                    </div>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs">${row.language}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-template-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Modify Template">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon ${toggleBtnClass} p-8 px-10 radius-8 transition-all status-template-trigger"
                                            data-id="${row.id}" data-status="${row.is_active}" data-bs-toggle="tooltip" title="${toggleTitle}">
                                            <i class="${toggleIcon} text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-template-trigger"
                                            data-id="${row.id}" data-bs-toggle="tooltip" title="Delete Template">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                        });
                    } else {
                        html = `
                        <tr>
                            <td colspan="5" class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No notification templates found in this cluster.</span>
                            </td>
                        </tr>`;
                    }

                    $("#notificationTemplateTableBody").html(html);

                    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.map(function(el) {
                        return new bootstrap.Tooltip(el);
                    });
                });
            }


        });
    </script>
@endpush
