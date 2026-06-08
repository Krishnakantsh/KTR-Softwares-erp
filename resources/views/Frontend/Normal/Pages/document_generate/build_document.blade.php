@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Document & Template Manager')

@section('dynamic-content')
    <div class="dashboard-main-body">

        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon"
                        style="background-color: var(--primary-600); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <i class="ri-file-settings-line text-xl text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Document & Template Studio</h6>
                        <p class="text-xs text-muted mb-0">Manage system-wide document categories and design dynamic print
                            templates</p>
                    </div>
                </div>
                <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
                    <i class="ri-checkbox-circle-line me-1"></i> Template Engine Active
                </span>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow-1 radius-12 bg-base mb-24 border-0">
                    <div class="card-body p-24">
                        <h6 class="text-md fw-bold mb-16 text-dark-main d-flex align-items-center gap-2">
                            <i class="ri-folder-add-line text-primary"></i> Create New Category
                        </h6>
                        <form id="documentCategoryForm" autocomplete="off">
                            @csrf

                            <input type="hidden" name="document_category_id" id="document_category_id">
                            <div class="premium-input-box mb-16">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Category
                                    Name <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-folder-open-line addon-icon"></i>
                                    <input type="text" class="form-control" name="name" id="categoryName"
                                        placeholder="e.g., Transfer Certificate, Character Cert" required>
                                </div>
                            </div>

                            <div class="premium-input-box mb-16">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Description</label>
                                <textarea class="form-control" name="description" rows="3"
                                    placeholder="Brief details about this document category..."></textarea>
                            </div>

                            <div class="mb-20">
                                <label class="premium-switch-box">
                                    <input type="checkbox" class="premium-switch-input" name="status" id="catStatus"
                                        checked value="1">
                                    <span class="premium-switch-slider"></span>
                                    <span class="premium-switch-label">Active / Enable Category</span>
                                </label>
                            </div>

                            <button type="submit"
                                class="btn btn-primary-600 w-100 py-12 fw-semibold radius-8 d-flex align-items-center justify-content-center gap-2"
                                id="saveCategoryBtn">
                                <i class="ri-save-line"></i> Save Category
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-1 radius-12 bg-base border-0">
                    <div class="card-body p-24">
                        <h6 class="text-md fw-bold mb-16 text-dark-main">Existing Categories</h6>
                        <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                            <table class="table bordered-table table-hover align-middle mb-0 text-sm">
                                <thead
                                    class="bg-base position-sticky top-0 z-3 border-bottom table-light text-uppercase tracking-wider text-xs">
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="categoryTableBody">
                                    <tr>
                                        <td colspan="3" class="text-center py-24 text-muted text-xs">
                                            <div class="spinner-border spinner-border-sm text-primary me-2"></div> Loading
                                            Categories...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card shadow-1 radius-12 bg-base border-0">
                    <div class="card-body p-24">
                        <h6 class="text-md fw-bold mb-20 text-dark-main d-flex align-items-center gap-2">
                            <i class="ri-article-line text-primary"></i> Document Template Configuration
                        </h6>

                        <form id="documentTemplateForm" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="document_template_id" id="document_template_id">

                            <div class="row g-3 mb-20">
                                <div class="col-md-6">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Select
                                            Category <span class="text-danger">*</span></label>
                                        <div class="inner-addon">
                                            <i class="ri-folder-shield-2-line addon-icon"></i>
                                            <select class="form-control form-select" name="document_category_id"
                                                id="templateCategorySelect" required>
                                                <option value="" disabled selected>Choose Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Template
                                            Name <span class="text-danger">*</span></label>
                                        <div class="inner-addon">
                                            <i class="ri-edit-box-line addon-icon"></i>
                                            <input type="text" class="form-control" name="template_name"
                                                placeholder="e.g., Official Bonafide Certificate" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Template
                                            Code</label>
                                        <div class="inner-addon">
                                            <i class="ri-code-line addon-icon"></i>
                                            <input type="text" class="form-control" name="template_code"
                                                placeholder="e.g., TFR-2026-V1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Short
                                            Description</label>
                                        <div class="inner-addon">
                                            <i class="ri-text-snippet addon-icon"></i>
                                            <input type="text" class="form-control" name="description"
                                                placeholder="Optional details for identification...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-20" style="border-top: 1px dashed #e3e6ef;">

                            <h6 class="text-xs fw-bold text-uppercase tracking-wider text-primary mb-16"><i
                                    class="ri-shape-2-line"></i> Page Canvas Settings</h6>
                            <div class="row g-3 mb-24">
                                <div class="col-md-6 col-sm-6">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Orientation</label>
                                        <div class="inner-addon">
                                            <i class="ri-clockwise-2-line addon-icon"></i>
                                            <select class="form-control form-select" name="orientation"
                                                id="orientationSelect">
                                                <option value="portrait" selected>Portrait</option>
                                                <option value="landscape">Landscape</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Page
                                            Size</label>
                                        <div class="inner-addon">
                                            <i class="ri-focus-3-line addon-icon"></i>
                                            <select class="form-control form-select" name="page_size"
                                                id="pageSizeSelect">
                                                <option value="A4" selected>A4 Size</option>
                                                <option value="A5">A5 Size</option>
                                                <option value="A6">A6 Size</option>
                                                <option value="LETTER">Letter</option>
                                                <option value="LEGAL">Legal</option>
                                                <option value="ID_CARD">ID Card</option>
                                                <option value="CUSTOM">Custom Dimensions</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 custom-dims d-none">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Width
                                            (mm)</label>
                                        <div class="inner-addon">
                                            <i class="ri-arrow-left-right-line addon-icon"></i>
                                            <input type="number" step="0.01" class="form-control" name="width"
                                                placeholder="Width in mm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 custom-dims d-none">
                                    <div class="premium-input-box">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Height
                                            (mm)</label>
                                        <div class="inner-addon">
                                            <i class="ri-arrow-up-down-line addon-icon"></i>
                                            <input type="number" step="0.01" class="form-control" name="height"
                                                placeholder="Height in mm">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-xs fw-bold text-uppercase tracking-wider text-primary mb-16"><i
                                    class="ri-image-add-line"></i> Graphical Layout Brand Assets</h6>
                            <div class="row g-3 mb-24">
                                <div class="col-md-6">
                                    <label class="text-xs fw-bold text-primary-light mb-6 d-block">Header Graphics Branding
                                        Image</label>
                                    <input type="file" class="form-control form-control-sm radius-8 py-6"
                                        name="header_image" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-xs fw-bold text-primary-light mb-6 d-block">Footer Graphics Branding
                                        Image</label>
                                    <input type="file" class="form-control form-control-sm radius-8 py-6"
                                        name="footer_image" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-xs fw-bold text-primary-light mb-6 d-block">Background Branding
                                        Engine Graphic</label>
                                    <input type="file" class="form-control form-control-sm radius-8 py-6"
                                        name="background_image" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-xs fw-bold text-primary-light mb-6 d-block">Security Center Digital
                                        Watermark</label>
                                    <input type="file" class="form-control form-control-sm radius-8 py-6"
                                        name="watermark_image" accept="image/*">
                                </div>
                            </div>

                            <div class="p-20 radius-12 bg-light-soft border border-dashed-custom mb-24">
                                <div class="d-flex flex-wrap gap-4 align-items-center">
                                    <label class="premium-switch-box">
                                        <input type="checkbox" class="premium-switch-input" name="show_header"
                                            id="showHeaderSwitch" checked value="1">
                                        <span class="premium-switch-slider"></span>
                                        <span class="premium-switch-label">Show Header</span>
                                    </label>

                                    <label class="premium-switch-box">
                                        <input type="checkbox" class="premium-switch-input" name="show_footer"
                                            id="showFooterSwitch" checked value="1">
                                        <span class="premium-switch-slider"></span>
                                        <span class="premium-switch-label">Show Footer</span>
                                    </label>

                                    <label class="premium-switch-box">
                                        <input type="checkbox" class="premium-switch-input" name="show_page_number"
                                            id="showPageNumSwitch" value="1">
                                        <span class="premium-switch-slider"></span>
                                        <span class="premium-switch-label">Enable Page Numbers</span>
                                    </label>

                                    <label class="premium-switch-box">
                                        <input type="checkbox" class="premium-switch-input" name="is_default"
                                            id="isDefaultSwitch" value="1">
                                        <span class="premium-switch-slider switch-warning"></span>
                                        <span class="premium-switch-label text-warning-main fw-semibold"><i
                                                class="ri-star-line me-1"></i>Set Default Template</span>
                                    </label>
                                </div>
                            </div>

                            <div class="accordion premium-accordion mb-24" id="codeEditorAccordion">
                                <div class="accordion-item radius-12 border overflow-hidden">
                                    <h2 class="accordion-header">
                                        <button
                                            class="accordion-button collapse-btn fw-bold collapsed bg-light-soft text-dark-main"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#htmlCollapse">
                                            <i class="ri-html5-line text-orange me-2 text-lg"></i> Template HTML Canvas
                                            Layout Content
                                        </button>
                                    </h2>
                                    <div id="htmlCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#codeEditorAccordion">
                                        <div class="accordion-body p-12 bg-base">
                                            <div class="alert alert-info text-xs mb-12 radius-8">
                                                <i class="ri-information-line"></i> Use tokens like
                                                <code>[student_name]</code>, <code>[roll_no]</code>, or
                                                <code>[father_name]</code> for dynamic runtime string replacements.
                                            </div>
                                            <textarea class="form-control font-monospace text-xs" name="html_content" rows="12"
                                                placeholder="<div class='certificate-box'>&#10;   <h2>BONAFIDE CERTIFICATE</h2>&#10;   <p>This is to certify that [student_name]...</p>&#10;</div>"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item radius-12 border overflow-hidden mt-12">
                                    <h2 class="accordion-header">
                                        <button
                                            class="accordion-button collapse-btn fw-bold collapsed bg-light-soft text-dark-main"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#cssCollapse">
                                            <i class="ri-css3-line text-primary me-2 text-lg"></i> Template Styling Sheet
                                            (CSS Styles)
                                        </button>
                                    </h2>
                                    <div id="cssCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#codeEditorAccordion">
                                        <div class="accordion-body p-12 bg-base">
                                            <textarea class="form-control font-monospace text-xs" name="css_content" rows="8"
                                                placeholder=".certificate-box { padding: 20px; border: 5px double #000; text-align: center; }"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item radius-12 border overflow-hidden mt-12">
                                    <h2 class="accordion-header">
                                        <button
                                            class="accordion-button collapse-btn fw-bold collapsed bg-light-soft text-dark-main"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#jsCollapse">
                                            <i class="ri-javascript-line text-warning me-2 text-lg"></i> Template Logic
                                            Runtime (JS Scripts)
                                        </button>
                                    </h2>
                                    <div id="jsCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#codeEditorAccordion">
                                        <div class="accordion-body p-12 bg-base">
                                            <textarea class="form-control font-monospace text-xs" name="js_content" rows="5"
                                                placeholder="// Custom script expressions initialization runtime logic..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-end gap-3 border-top pt-20">
                                <button type="reset"
                                    class="btn btn-light border px-24 py-10 fw-semibold radius-8 text-muted">
                                    Reset Canvas
                                </button>
                                <button type="submit"
                                    class="btn btn-primary-600 px-32 py-12 fw-semibold radius-8 d-flex align-items-center gap-2"
                                    id="saveTemplateBtn">
                                    <i class="ri-file-cloud-line"></i> Deploy Master Template
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection



@push('script')
    <script>
        $(document).ready(function() {

            fetchDocumentCategories();


            $(document).on('change', '#pageSizeSelect', function() {
                if ($(this).val() === 'CUSTOM') {
                    $('.custom-dims').removeClass('d-none');
                } else {
                    $('.custom-dims').addClass('d-none').find('input').val('');
                }
            });


            $(document).on('submit', '#documentCategoryForm', function(e) {
                e.preventDefault();
                let categoryName = $("#categoryName").val().trim();

                if (!categoryName) {
                    alert("Please insert a valid Category Name");
                    return;
                }

                let formData = new FormData(this);

                // let formData = $("#documentCategoryForm").serialize();

                $("#saveCategoryBtn").prop('disabled', true).html(
                    `<div class="spinner-border spinner-border-sm"></div> Saving...`);

                $.ajax({
                    url: "{{ route('school.document.category.save') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res) {
                        showToast('success', 'Category successfully setup.');

                        $("#documentCategoryForm")[0].reset();
                        $('#document_category_id').val('');
                        $('#catStatus').prop('checked', true);

                        $('#saveCategoryBtn').html(
                            '<i class="ri-save-line"></i> Save Category'
                        );

                        fetchDocumentCategories();
                    },
                    error: function() {
                        showToast('error', 'Error registering the target Category blueprint..');

                    },
                    complete: function() {
                        $("#saveCategoryBtn").prop('disabled', false).html(
                            `<i class="ri-save-line"></i> Save Category`);
                    }
                });
            });

            $(document).on('submit', '#documentTemplateForm', function(e) {
                e.preventDefault();
                let form = $('#documentTemplateForm')[0];
                let formData = new FormData(form);

                let category = $("#templateCategorySelect").val();
                let name = $("input[name='template_name']").val();

                if (!category || !name) {
                    alert("Category Selector and Template Master Name are mandatory parameters.");
                    return;
                }

                $("#saveTemplateBtn").prop('disabled', true).html(
                    `<div class="spinner-border spinner-border-sm"></div> Spawning Document...`);

                $.ajax({
                    url: "{{ route('school.document.template.save') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                           showToast('success', 'Premium template blueprint deployed successfully into ERP clusters');
                      
                        $('#documentTemplateForm')[0].reset();
                        $('.custom-dims').addClass('d-none');
                    },
                    error: function() {
                                  showToast('error', 'Failure to update template payload structures.');
                       
                    },
                    complete: function() {
                        $("#saveTemplateBtn").prop('disabled', false).html(
                            `<i class="ri-file-cloud-line"></i> Deploy Master Template`);
                    }
                });
            });
        });

        function fetchDocumentCategories() {
            $.ajax({
                url: "{{ route('school.document.category.fetch') }}",
                method: "GET",
                success: function(res) {
                    let tableRows = "";
                    let selectOptions = `<option value="" disabled selected>Choose Category</option>`;

                    if (res.data && res.data.length > 0) {
                        $.each(res.data, function(i, category) {
                            let statusBadge = category.status ?
                                `<span class="badge bg-success-50 text-success-600 border border-success-200 px-8 py-4 radius-4">Active</span>` :
                                `<span class="badge bg-danger-50 text-danger-600 border border-danger-200 px-8 py-4 radius-4">Inactive</span>`;

                            tableRows += `
                                <tr>
                                    <td class="fw-medium text-dark-main">${category.name}</td>
                                    <td class="text-center">${statusBadge}</td>
                                    <td class="text-center">
                                   

                                          <button type="button" data-id="${category.id}" class="editDocumentCategory role">
                                                <i class="ri-edit-fill custom-btn-primary"></i>
                                            </button>
                                            <button type="button" data-id="${category.id}" class="deleteDocumentCategory">
                                                <i class="ri-delete-bin-fill custom-btn-red"></i>
                                            </button>
                                    </td>

                                </tr>
                            `;

                            selectOptions += `<option value="${category.id}">${category.name}</option>`;
                        });
                    } else {
                        tableRows =
                            `<tr><td colspan="3" class="text-center py-20 text-muted text-xs">No document categories parsed.</td></tr>`;
                    }

                    $("#categoryTableBody").html(tableRows);
                    $("#templateCategorySelect").html(selectOptions);
                },
                error: function() {
                    $("#categoryTableBody").html(
                        `<tr><td colspan="3" class="text-center py-20 text-danger text-xs">Data synchronization engine timed out.</td></tr>`
                    );
                }
            });
        }


        $(document).on('click', '.editDocumentCategory', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            getDataById("{{ route('school.document.category.get') }}", id, function(res) {
                $('#document_category_id').val(res.data.id);
                $('#categoryName').val(res.data.name);
                $('textarea[name="description"]').val(
                    res.data.description ?? ''
                );
                $('#catStatus').prop(
                    'checked',
                    Number(res.data.status) === 1
                );
                $('#saveCategoryBtn').html(
                    '<i class="ri-save-line"></i> Update Category'
                );
                $('html, body').animate({
                    scrollTop: $('#documentCategoryForm').offset().top - 100
                }, 300);

            });
        });
    </script>
@endpush
