<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden mt-24">
    <div class="card-header border-bottom bg-base py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Student Documents Repository</h6>
    </div>

    <div class="card-body p-20">
        <div class="p-20 radius-12 mb-32" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
            <h6 class="text-sm fw-bold text-uppercase text-primary mb-16">Upload New Document</h6>

            <div class="row gy-3 align-items-end">
                <div class="col-md-4">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Select Document Type <span
                            class="text-danger">*</span></label>
                    <select id="doc_type_selector" class="form-control form-select">
                        <option value="" selected disabled>-- Choose Document --</option>
                        <option value="front_aadhar" data-label="Front Aadhar Card">Std Aadhar - Front</option>
                        <option value="back_aadhar" data-label="Back Aadhar Card">Std Aadhar - Back</option>
                        <option value="cc" data-label="CC">Character Certificate (CC)</option>
                        <option value="tc" data-label="TC">Transfer Certificate (TC)</option>
                        <option value="birth_certificate" data-label="Birth Certificate">Birth Certificate (BC)</option>
                        <option value="father_front_aadhar" data-label="Father's Front Aadhar">Father's Aadhar - Front
                        </option>
                        <option value="father_back_aadhar" data-label="Father's Back Aadhar">Father's Aadhar - Back
                        </option>
                        <option value="mother_front_aadhar" data-label="Mother's Front Aadhar">Mother's Aadhar - Front
                        </option>
                        <option value="mother_back_aadhar" data-label="Mother's Back Aadhar">Mother's Aadhar - Back
                        </option>
                        <option value="father_marksheet" data-label="Father's Marksheet">Father's Marksheet</option>
                        <option value="mother_marksheet" data-label="Mother's Marksheet">Mother's Marksheet</option>
                        <option value="registration_form" data-label="Registration Form">Registration Form</option>
                        <option value="other_document" data-label="Other Document">Other Document</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Choose File <span
                            class="text-danger">*</span></label>
                    <input type="file" id="doc_file_input" class="form-control" accept="image/*,application/pdf" />
                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-primary w-100 fw-semibold radius-8 py-10"
                        onclick="addDocumentRow()">
                        <i class="bi bi-cloud-arrow-up-fill me-2"></i> Attach Document
                    </button>
                </div>

                <div class="col-12 mt-12">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Document Specific Remark / Note</label>
                    <input type="text" id="doc_remark_input" class="form-control"
                        placeholder="e.g. Verified original copy, Digilocker verified, etc." />
                </div>
            </div>
        </div>

        <div id="hidden_payload_container" class="d-none"></div>

        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-16 pb-4 border-bottom">Uploaded Digital
            Documents Gallery</h6>

        <div class="row g-4" id="documents_gallery_grid">
        </div>

        <div class="row mt-32 border-top pt-20">
            <div class="col-12">
                <label class="text-sm fw-semibold text-primary-light mb-8">General Office Remarks (Overall Documents
                    Verification Summary)</label>
                <textarea class="form-control" name="general_remark" rows="2"
                    placeholder="Write internal general office verification status notes here..."></textarea>
            </div>
        </div>

    </div>
</div>


<style>
    .doc-preview-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .doc-preview-card:hover {
        transform: translateY(-2px);
    }

    .doc-image-box {
        height: 140px;
        background: #d6ebff;
        /* Light bluish placeholder background */
        background-image: linear-gradient(45deg, #e0f2fe 25%, #f0f9ff 25%, #f0f9ff 50%, #e0f2fe 50%, #e0f2fe 75%, #f0f9ff 75%, #f0f9ff 100%);
        background-size: 20px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .doc-action-bar {
        background: #ea4335;
        /* Premium flat Red matching your UI image */
        padding: 8px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .doc-title {
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 0;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .doc-meta-badge {
        background: #24292f;
        color: #fff;
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 11px;
        display: flex;
        align-items: center;
    }

    .doc-remark-tag {
        background: #f1f5f9;
        font-size: 11px;
        color: #475569;
        padding: 6px 12px;
        border-top: 1px solid #e2e8f0;
        font-style: italic;
    }
</style>


@push('script')
    <script>
        let count = parseInt(localStorage.getItem('documentRowId'));

        let docRowCounter = count === 0 ? 0 : count + 1;

        // let docRowCounter = (parseInt(localStorage.getItem('documentRowId')) || 0) + 1;

        function escapeHtml(text) {
            return $('<div>').text(text).html();
        }

        function addDocumentRow(documentId = '') {

            const selector = document.getElementById('doc_type_selector');
            const fileInput = document.getElementById('doc_file_input');
            const remarkInput = document.getElementById('doc_remark_input');

            const selectedVal = selector.value;

            if (!selectedVal) {
                showToast('error', 'Please select document type');
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Duplicate Check
            |--------------------------------------------------------------------------
            */
            if (
                document.querySelector(
                    `[data-doc-type="${selectedVal}"]`
                )
            ) {
                showToast('error', 'This document type already added');
                return;
            }

            if (!fileInput.files.length) {
                showToast('error', 'Please choose document file');
                return;
            }

            const file = fileInput.files[0];

            const allowedTypes = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp',
                'application/pdf'
            ];

            if (!allowedTypes.includes(file.type)) {
                showToast('error', 'Only JPG, PNG, WEBP and PDF files are allowed');
                return;
            }

            const maxSize = 5 * 1024 * 1024;

            if (file.size > maxSize) {
                showToast('error', 'Maximum file size is 5 MB');
                return;
            }

            const selectedOption = selector.options[selector.selectedIndex];

            const docLabel = selectedOption.dataset.label;

            const remarkText = remarkInput.value.trim() || '';

            const safeRemark = escapeHtml(remarkText);

            const rowId = docRowCounter;

            /*
            |--------------------------------------------------------------------------
            | Hidden Payload
            |--------------------------------------------------------------------------
            */
            const payloadContainer =
                document.getElementById('hidden_payload_container');

            const payloadWrapper = document.createElement('div');

            payloadWrapper.id = `payload_item_${rowId}`;
            payloadWrapper.dataset.docType = selectedVal;

            payloadWrapper.innerHTML = `
            <input type="hidden"
                   name="documents[${rowId}][id]"
                   value="${documentId}">

            <input type="hidden"
                   name="documents[${rowId}][doc_type]"
                   value="${selectedVal}">

            <input type="hidden"
                   name="documents[${rowId}][document_remark]"
                   value="${remarkText}">
        `;

            const hiddenFileInput = document.createElement('input');

            hiddenFileInput.type = 'file';
            hiddenFileInput.name = `documents[${rowId}][file_blob]`;
            hiddenFileInput.style.display = 'none';

            const dt = new DataTransfer();

            dt.items.add(file);

            hiddenFileInput.files = dt.files;

            payloadWrapper.appendChild(hiddenFileInput);

            payloadContainer.appendChild(payloadWrapper);

            /*
            |--------------------------------------------------------------------------
            | Gallery Card
            |--------------------------------------------------------------------------
            */
            const gridContainer =
                document.getElementById('documents_gallery_grid');

            const cardCol = document.createElement('div');

            cardCol.className = 'col-xl-3 col-lg-4 col-md-6';
            cardCol.id = `gallery_card_${rowId}`;
            cardCol.dataset.docType = selectedVal;

            cardCol.innerHTML = `
            <div class="doc-preview-card">

                <div class="doc-image-box">

                    ${
                        file.type.startsWith('image/')
                        ? `
                                                    <img
                                                        id="img_preview_${rowId}"
                                                        src=""
                                                        alt=""
                                                        style="
                                                            width:100%;
                                                            height:100%;
                                                            object-fit:cover;
                                                            position:absolute;
                                                            top:0;
                                                            left:0;
                                                            border-bottom:1px solid #e2e8f0;
                                                        ">
                                                  `
                        : `
                                                    <i class="bi bi-file-earmark-pdf-fill text-danger"
                                                       style="font-size:48px;">
                                                    </i>
                                                  `
                    }

                </div>

                <div class="doc-action-bar">

                    <p class="doc-title">
                        <i class="bi bi-cloud-check-fill me-1"></i>
                        ${docLabel}
                    </p>

                    <button
                        type="button"
                        class="doc-meta-badge border-0"
                        onclick="removeUploadedDocument(${rowId}, '${selectedVal}')">

                        <i class="bi bi-trash-fill text-danger"></i>
                    </button>

                </div>

                <div class="doc-remark-tag text-truncate">
                    <strong>Note:</strong>
                    ${safeRemark || 'No individual remark'}
                </div>

            </div>
        `;

            gridContainer.appendChild(cardCol);

            /*
            |--------------------------------------------------------------------------
            | Image Preview
            |--------------------------------------------------------------------------
            */
            if (file.type.startsWith('image/')) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    const img =
                        document.getElementById(
                            `img_preview_${rowId}`
                        );

                    if (img) {
                        img.src = e.target.result;
                    }
                };

                reader.readAsDataURL(file);
            }

            /*
            |--------------------------------------------------------------------------
            | Disable Selected Option
            |--------------------------------------------------------------------------
            */
            selectedOption.disabled = true;

            /*
            |--------------------------------------------------------------------------
            | Reset Fields
            |--------------------------------------------------------------------------
            */
            selector.value = '';
            fileInput.value = '';
            remarkInput.value = '';



            localStorage.setItem('documentRowId', docRowCounter++);
        }

        function removeUploadedDocument(rowId, docType) {

            if (!confirm('Are you sure you want to remove this document?')) {
                return;
            }

            const payloadItem =
                document.getElementById(`payload_item_${rowId}`);

            const galleryCard =
                document.getElementById(`gallery_card_${rowId}`);

            if (payloadItem) {
                payloadItem.remove();
            }

            if (galleryCard) {
                galleryCard.remove();
            }

            $('#doc_type_selector option[value="' + docType + '"]')
                .prop('disabled', false);

            showToast('success', 'Document removed successfully');
        }
    </script>
@endpush
