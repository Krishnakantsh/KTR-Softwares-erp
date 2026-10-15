<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden mt-16">

    <div class="card-body p-20">

        <div class="p-20 radius-12 mb-32" style="background: #f8fafc; border: 1px dashed #cbd5e1;">

            <h6 class="text-sm fw-bold text-uppercase text-primary mb-16">Upload Employee Document</h6>

            <div class="row gy-3 align-items-end">

                <div class="col-md-4">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Document Type <span
                            class="text-danger">*</span></label>
                    <select id="staff_doc_type_selector" class="form-control form-select">
                        <option value="" selected disabled>-- Choose Document --</option>
                        <option value="1" data-label="Aadhaar">Aadhaar Card</option>
                        <option value="2" data-label="PAN">PAN Card</option>
                        <option value="3" data-label="Signature">Signature</option>
                        <option value="4" data-label="Driving License">Driving License</option>
                        <option value="5" data-label="Voter ID">Voter ID</option>
                        <option value="6" data-label="Tenth Marksheet">Tenth Marksheet</option>
                        <option value="7" data-label="Twelfth Marksheet">Twelfth Marksheet</option>
                        <option value="8" data-label="Graduation Marksheet">Graduation Marksheet</option>
                        <option value="9" data-label="Post-Graduation Marksheet">Post-Graduation Marksheet</option>
                        <option value="10" data-label="Contract / Agreement">Contract / Agreement</option>
                        <option value="11" data-label="Medical Certificate">Medical Certificate</option>
                        <option value="12" data-label="Address Proof">Address Proof</option>
                        <option value="13" data-label="Other">Other Document</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Choose File <span
                            class="text-danger">*</span></label>
                    <input type="file" id="staff_doc_file_input" class="form-control"
                        accept="image/*,application/pdf" />
                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-primary w-100 fw-semibold radius-8 py-10"
                        onclick="addStaffDocumentRow()">
                        <i class="bi bi-cloud-arrow-up-fill me-2"></i> Attach Document
                    </button>
                </div>

                <div class="col-md-4 mt-12">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Document Number</label>
                    <input type="text" id="staff_doc_number_input" class="form-control"
                        placeholder="e.g. Aadhaar / PAN / Certificate No." />
                </div>

                <div class="col-xl-4 col-md-6">

                    <div class="premium-input-box">

                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                            Mark as Primary
                        </label>

                        <div class="d-flex align-items-center gap-2">

                            <label class="switch mb-0">

                                <input type="checkbox" role="switch" id="staff_doc_is_primary_input" value="1"
                                    class="module-active-toggle">

                                <span class="slider"></span>

                            </label>

                            <span class="text-sm text-neutral-600">
                                Primary document of this type
                            </span>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-12">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Document Remark / Note</label>
                    <input type="text" id="staff_doc_remark_input" class="form-control"
                        placeholder="e.g. Original verified, Self-attested copy, etc." />
                </div>
            </div>
        </div>

        <div id="staff_hidden_payload_container" class="d-none"></div>

        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-16 pb-4 border-bottom">
            Uploaded Employee Documents
        </h6>

        <div class="row g-4" id="staff_documents_gallery_grid"></div>

        <div class="row mt-32 border-top pt-20">
            <div class="col-12">
                <label class="text-sm fw-semibold text-primary-light mb-8">
                    Overall Documents Verification Remark
                </label>
                <textarea class="form-control" name="documents_general_remark" rows="2"
                    placeholder="Write internal document verification status notes here..."></textarea>
            </div>
        </div>

    </div>
</div>


<style>
    .staff-doc-preview-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .staff-doc-preview-card:hover {
        transform: translateY(-2px);
    }

    .staff-doc-image-box {
        height: 140px;
        background: #d6ebff;
        background-image: linear-gradient(45deg, #e0f2fe 25%, #f0f9ff 25%, #f0f9ff 50%, #e0f2fe 50%, #e0f2fe 75%, #f0f9ff 75%, #f0f9ff 100%);
        background-size: 20px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .staff-doc-action-bar {
        background: #ea4335;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .staff-doc-title {
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 0;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .staff-doc-meta-badge {
        background: #24292f;
        color: #fff;
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 11px;
        display: flex;
        align-items: center;
    }

    .staff-doc-remark-tag {
        background: #f1f5f9;
        font-size: 11px;
        color: #475569;
        padding: 6px 12px;
        border-top: 1px solid #e2e8f0;
        font-style: italic;
    }

    .staff-doc-extra-info {
        font-size: 11px;
        color: #64748b;
        padding: 4px 12px;
        border-top: 1px dashed #e2e8f0;
    }

    .staff-doc-primary-flag {
        background: #16a34a;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 2;
    }
</style>


@push('script')
    <script>
        let staffDocCount = parseInt(localStorage.getItem('staffDocumentRowId'));

        let staffDocRowCounter = (isNaN(staffDocCount) || staffDocCount === 0) ? 0 : staffDocCount + 1;

        function escapeHtmlStaff(text) {
            return $('<div>').text(text).html();
        }

        function addStaffDocumentRow(documentId = '') {

            const selector = document.getElementById('staff_doc_type_selector');
            const fileInput = document.getElementById('staff_doc_file_input');
            const remarkInput = document.getElementById('staff_doc_remark_input');
            const numberInput = document.getElementById('staff_doc_number_input');
            const isPrimaryInput = document.getElementById('staff_doc_is_primary_input');

            const selectedVal = selector.value;

            if (!selectedVal) {
                showToast('error', 'Please select document type');
                return;
            }


            if (
                document.querySelector(
                    `#staff_documents_gallery_grid [data-doc-type="${selectedVal}"]`
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
            const numberText = numberInput.value.trim() || '';
            const isPrimaryVal = isPrimaryInput.checked ? 1 : 0;

            const safeRemark = escapeHtmlStaff(remarkText);

            const rowId = staffDocRowCounter;

            /*
            |--------------------------------------------------------------------------
            | Hidden Payload (mapped to employee_documents table columns)
            |--------------------------------------------------------------------------
            */
            const payloadContainer =
                document.getElementById('staff_hidden_payload_container');

            const payloadWrapper = document.createElement('div');

            payloadWrapper.id = `staff_payload_item_${rowId}`;
            payloadWrapper.dataset.docType = selectedVal;

            payloadWrapper.innerHTML = `
            <input type="hidden" name="documents[${rowId}][id]" value="${documentId}">
            <input type="hidden" name="documents[${rowId}][document_type]" value="${selectedVal}">
            <input type="hidden" name="documents[${rowId}][document_name]" value="${escapeHtmlStaff(docLabel)}">
            <input type="hidden" name="documents[${rowId}][document_number]" value="${escapeHtmlStaff(numberText)}">
            <input type="hidden" name="documents[${rowId}][is_primary]" value="${isPrimaryVal}">
            <input type="hidden" name="documents[${rowId}][remarks]" value="${remarkText}">
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
                document.getElementById('staff_documents_gallery_grid');

            const cardCol = document.createElement('div');

            cardCol.className = 'col-xl-3 col-lg-4 col-md-6';
            cardCol.id = `staff_gallery_card_${rowId}`;
            cardCol.dataset.docType = selectedVal;

            const extraInfoParts = [];

            if (numberText) extraInfoParts.push(`No: ${escapeHtmlStaff(numberText)}`);


            cardCol.innerHTML = `
                <div class="staff-doc-preview-card position-relative">

                    ${isPrimaryVal ? `<span class="staff-doc-primary-flag">PRIMARY</span>` : ''}

                    <div class="staff-doc-image-box">
                        ${
                            file.type.startsWith('image/')
                            ? `<img id="staff_img_preview_${rowId}" src="" alt=""
                                                                                style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;border-bottom:1px solid #e2e8f0;">`
                            : `<i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:48px;"></i>`
                        }
                    </div>

                    <div class="staff-doc-action-bar">
                        <p class="staff-doc-title">
                            <i class="bi bi-cloud-check-fill me-1"></i>
                            ${docLabel}
                        </p>

                        <button type="button" class="staff-doc-meta-badge border-0"
                            onclick="removeStaffUploadedDocument(${rowId}, '${selectedVal}')">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </button>
                    </div>

                    ${
                        extraInfoParts.length
                        ? `<div class="staff-doc-extra-info text-truncate">${extraInfoParts.join(' &nbsp;|&nbsp; ')}</div>`
                        : ''
                    }

                    <div class="staff-doc-remark-tag text-truncate">
                        <strong>Note:</strong>
                        ${safeRemark || 'No individual remark'}
                    </div>

                </div>
            `;

            gridContainer.appendChild(cardCol);

            if (file.type.startsWith('image/')) {

                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById(`staff_img_preview_${rowId}`);
                    if (img) img.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }


            selectedOption.disabled = true;

            selector.value = '';
            fileInput.value = '';
            remarkInput.value = '';
            numberInput.value = '';
            isPrimaryInput.checked = false;

            localStorage.setItem('staffDocumentRowId', staffDocRowCounter++);
        }

        function removeStaffUploadedDocument(rowId, docType) {

            if (!confirm('Are you sure you want to remove this document?')) {
                return;
            }

            const payloadItem = document.getElementById(`staff_payload_item_${rowId}`);
            const galleryCard = document.getElementById(`staff_gallery_card_${rowId}`);

            if (payloadItem) payloadItem.remove();
            if (galleryCard) galleryCard.remove();

            $('#staff_doc_type_selector option[value="' + docType + '"]')
                .prop('disabled', false);

            showToast('success', 'Document removed successfully');
        }
    </script>
@endpush
