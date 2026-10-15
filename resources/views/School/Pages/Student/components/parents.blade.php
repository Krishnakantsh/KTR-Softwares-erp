<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Parent / Guardian Information</h6>
        <button type="button" class="btn btn-sm btn-primary-50 text-primary-600 fw-bold radius-8"
            onclick="addParentRow()">
            <i class="bi bi-plus-lg me-1"></i> Add Parent / Guardian
        </button>
    </div>

    <div class="card-body p-20" id="parents_dynamic_container">

        <!-- DEFAULT ROW 0: FATHER (Strictly Primary & Un-deletable) -->
        <div class="parent-block p-20 radius-12 border bg-base mb-24 position-relative" id="parent_block_0"
            style="border: 1px solid #cbd5e1 !important;">
            <input type="hidden" name="parents[0][id]" value="">
            <div class="d-flex justify-content-between align-items-center mb-16 pb-8 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <span
                        class="badge bg-primary-100 text-primary-600 px-16 py-6 radius-4 fw-bold text-sm text-uppercase">Primary
                        Relation</span>
                    <h6 class="text-sm fw-bold text-uppercase text-primary mb-0">Father Details</h6>
                    <input type="hidden" name="parents[0][parent_type]" value="father">
                </div>

                <!-- Alive Status Switch -->
                <div class="d-flex align-items-center gap-2">
                    <label class="text-xs fw-semibold text-primary-light mb-0">Is Alive?</label>
                    <label class="switch switch-sm">
                        <input type="hidden" name="parents[0][is_alive]" value="0">

                        <input type="checkbox" name="parents[0][is_alive]" value="1" checked
                            onchange="toggleAliveStatus(this,0)">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <!-- Parent Body Data -->
            <div class="parent-fields-wrapper" id="fields_wrapper_0">
                <!-- Row 1: Basic Info -->
                <div class="row gy-3 mb-24">

                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Full Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control fw-semibold" name="parents[0][name]"
                            placeholder="Enter Father's Name" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Phone Number</label>
                        <input type="text" class="form-control" name="parents[0][phone]"
                            placeholder="Mobile Number" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Email Address</label>
                        <input type="email" class="form-control" name="parents[0][email]"
                            placeholder="parent@example.com" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Date of Birth</label>
                        <input type="date" class="form-control" name="parents[0][dob]" />
                    </div>
                </div>

                <!-- Row 2: Government IDs & Income -->
                <div class="row gy-3 mb-24">
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Aadhaar No.</label>
                        <input type="text" class="form-control" name="parents[0][aadhaar_no]" maxlength="12"
                            placeholder="12-digit Aadhaar" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">PAN No.</label>
                        <input type="text" class="form-control text-uppercase" name="parents[0][pan_no]"
                            placeholder="ABCDE1234F" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Samagra ID</label>
                        <input type="text" class="form-control" name="parents[0][samagra_id]"
                            placeholder="Enter Samagra ID" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">BPL Card No.</label>
                        <input type="text" class="form-control" name="parents[0][bpl_card]"
                            placeholder="BPL Card ID (If applicable)" />
                    </div>
                </div>

                <!-- Row 3: Professional Info & Toggles -->
                <div class="row gy-3 mb-24">
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Qualification</label>
                        <input type="text" class="form-control" name="parents[0][qualification]"
                            placeholder="e.g. Graduate, Post Graduate" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Occupation</label>
                        <input type="text" class="form-control" name="parents[0][occupation]"
                            placeholder="e.g. Business, Govt Job" />
                    </div>
                    <div class="col-md-3">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Annual Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-sm fw-semibold text-primary-600">₹</span>
                            <input type="number" step="0.01" class="form-control fw-medium"
                                name="parents[0][annual_income]" value="0.00" />
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center gap-4 mt-24">
                        <div class="d-flex align-items-center gap-2">
                            <label class="switch switch-sm">
                                <input type="hidden" name="parents[0][is_in_service]" value="0">

                                <input type="checkbox" name="parents[0][is_in_service]" value="1" checked
                                    onchange="toggleServiceDetails(this,0)">

                                <span class="slider"></span>
                            </label>
                            <label class="text-sm fw-semibold text-primary-light cursor-pointer mb-0">In
                                Government/Private Service</label>
                        </div>
                    </div>
                </div>

                <!-- Conditionally Visible Section 1: Service Details -->
                <div class="row gy-3 mb-24 d-none" id="service_details_0">
                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Department Name</label>
                        <input type="text" class="form-control" name="parents[0][department]"
                            placeholder="e.g. Railways, Education Dept" />
                    </div>
                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-8">Designation</label>
                        <input type="text" class="form-control" name="parents[0][designation]"
                            placeholder="e.g. Senior Clerk, Manager" />
                    </div>
                </div>

                <!-- Row 4: Addresses & Corporate Details -->
                <div class="row gy-4">
                    <div class="col-xl-6 col-lg-6">
                        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-12 border-bottom pb-4">
                            Residential Address</h6>
                        <textarea class="form-control" name="parents[0][address]" rows="3"
                            placeholder="Full residential address of parent..."></textarea>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="d-flex justify-content-between align-items-center mb-12 border-bottom pb-4">
                            <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-0">Business / Office
                                Details</h6>
                            <span class="text-xs text-muted">Fill if running a firm/shop</span>
                        </div>
                        <div class="row gy-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm mb-2"
                                    name="parents[0][company_name]" placeholder="Company/Shop Name" />
                                <input type="text" class="form-control form-control-sm mb-2"
                                    name="parents[0][office_phone]" placeholder="Office Phone" />
                                <input type="text" class="form-control form-control-sm"
                                    name="parents[0][office_email]" placeholder="Office Email" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm mb-2"
                                    name="parents[0][office_website]" placeholder="Website (URL)" />
                                <textarea class="form-control form-control-sm" name="parents[0][office_address]" rows="2"
                                    placeholder="Office/Factory Address" style="height: 68px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-12">
                        <input type="text" class="form-control form-control-sm mb-2"
                            name="parents[0][business_detail]"
                            placeholder="Additional brief description about business operations..." />
                        <textarea class="form-control" name="parents[0][remark]" rows="1"
                            placeholder="Internal remarks regarding this parent..."></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





@push('script')
    <script>
        let parentRowIdx = $('#parents_dynamic_container .parent-block').length;

        function addParentRow() {

            const motherExists = $('input[name$="[parent_type]"], select[name$="[parent_type]"]')
                .filter(function() {
                    return $(this).val() === 'mother';
                }).length;

            if (motherExists) {
                showToast("error", "Mother already added");
                // alert('Mother already added');
                return;
            }
            const container = document.getElementById('parents_dynamic_container');

            const newBlock = document.createElement('div');
            newBlock.className = 'parent-block p-20 radius-12 border bg-base mb-24 position-relative';
            newBlock.id = `parent_block_${parentRowIdx}`;
            newBlock.style.border = '1px solid #cbd5e1';
            newBlock.style.animation = 'fadeIn 0.3s ease-in-out';

            newBlock.innerHTML = `

                <input type="hidden" name="parents[${parentRowIdx}][id]" value="">

                <div class="d-flex justify-content-between align-items-center mb-16 pb-8 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <select name="parents[${parentRowIdx}][parent_type]" class="form-control form-select form-select-sm fw-bold text-uppercase text-primary" style="width: 140px;" required>
                            <option value="mother">Mother</option>
                            <option value="guardian">Guardian</option>
                        </select>
                    </div>
                    
                    <div class="d-flex align-items-center gap-4">
                        <!-- Alive Status -->
                        <div class="d-flex align-items-center gap-2">
                            <label class="text-xs fw-semibold text-primary-light mb-0">Is Alive?</label>
                            <label class="switch switch-sm">
                                <input type="hidden"
                                    name="parents[${parentRowIdx}][is_alive]"
                                    value="0">
                                    <input type="checkbox"
                                            name="parents[${parentRowIdx}][is_alive]"
                                            value="1"
                                            checked
                                            onchange="toggleAliveStatus(this, ${parentRowIdx})">
                             
                                    <span class="slider"></span>
                            </label>
                        </div>
                        <!-- Remove Button -->
                        <button type="button" class="btn btn-sm btn-outline-danger radius-8 px-12 py-4 text-xs fw-bold" onclick="removeParentRow(${parentRowIdx})">
                            <i class="bi bi-trash3 me-1"></i> Remove
                        </button>
                    </div>
                </div>

                <div class="parent-fields-wrapper" id="fields_wrapper_${parentRowIdx}">
                    <div class="row gy-3 mb-24">
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control fw-semibold" name="parents[${parentRowIdx}][name]" placeholder="Enter Name" required />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Phone Number</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][phone]" placeholder="Mobile Number" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Email Address</label>
                            <input type="email" class="form-control" name="parents[${parentRowIdx}][email]" placeholder="parent@example.com" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Date of Birth</label>
                            <input type="date" class="form-control" name="parents[${parentRowIdx}][dob]" />
                        </div>
                    </div>

                    <div class="row gy-3 mb-24">
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Aadhaar No.</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][aadhaar_no]" maxlength="12" placeholder="12-digit Aadhaar" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">PAN No.</label>
                            <input type="text" class="form-control text-uppercase" name="parents[${parentRowIdx}][pan_no]" placeholder="ABCDE1234F" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Samagra ID</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][samagra_id]" placeholder="Enter Samagra ID" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">BPL Card No.</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][bpl_card]" placeholder="BPL Card ID" />
                        </div>
                    </div>

                    <div class="row gy-3 mb-24">
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Qualification</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][qualification]" placeholder="Qualification" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Occupation</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][occupation]" placeholder="Occupation" />
                        </div>
                        <div class="col-md-3">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Annual Income</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-sm fw-semibold text-primary-600">₹</span>
                                <input type="number" step="0.01" class="form-control fw-medium" name="parents[${parentRowIdx}][annual_income]" value="0.00" />
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center gap-4 mt-24">
                            <div class="d-flex align-items-center gap-2">
                                <label class="switch switch-sm">
                                    <input type="hidden"
                                        name="parents[${parentRowIdx}][is_in_service]"
                                        value="0">

                                    <input type="checkbox"
                                        name="parents[${parentRowIdx}][is_in_service]"
                                        value="1"
                                        onchange="toggleServiceDetails(this, ${parentRowIdx})">
                                                                
                                    <span class="slider"></span>
                                </label>
                                <label class="text-sm fw-semibold text-primary-light cursor-pointer mb-0">In Service</label>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-3 mb-24 d-none" id="service_details_${parentRowIdx}">
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Department Name</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][department]" placeholder="Department Name" />
                        </div>
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Designation</label>
                            <input type="text" class="form-control" name="parents[${parentRowIdx}][designation]" placeholder="Designation" />
                        </div>
                    </div>

                    <div class="row gy-4">
                        <div class="col-xl-6 col-lg-6">
                            <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-12 border-bottom pb-4">Residential Address</h6>
                            <textarea class="form-control" name="parents[${parentRowIdx}][address]" rows="3" placeholder="Full residential address..."></textarea>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-12 border-bottom pb-4">Business / Office Details</h6>
                            <div class="row gy-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm mb-2" name="parents[${parentRowIdx}][company_name]" placeholder="Company Name" />
                                    <input type="text" class="form-control form-control-sm mb-2" name="parents[${parentRowIdx}][office_phone]" placeholder="Office Phone" />
                                    <input type="text" class="form-control form-control-sm" name="parents[${parentRowIdx}][office_email]" placeholder="Office Email" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm mb-2" name="parents[${parentRowIdx}][office_website]" placeholder="Website" />
                                    <textarea class="form-control form-control-sm" name="parents[${parentRowIdx}][office_address]" rows="2" placeholder="Office Address" style="height: 68px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-12">
                            <input type="text" class="form-control form-control-sm mb-2" name="parents[${parentRowIdx}][business_detail]" placeholder="Business operations details..." />
                            <textarea class="form-control" name="parents[${parentRowIdx}][remark]" rows="1" placeholder="Remarks..."></textarea>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(newBlock);
            parentRowIdx++;
        }

        function removeParentRow(idx) {
            const block = document.getElementById(`parent_block_${idx}`);
            if (block) {
                block.style.opacity = '0';
                setTimeout(() => {
                    block.remove();
                }, 200);
            }
        }

        function toggleServiceDetails(checkbox, idx) {
            const serviceDiv = document.getElementById(`service_details_${idx}`);
            if (checkbox.checked) {
                serviceDiv.classList.remove('d-none');
            } else {
                serviceDiv.classList.add('d-none');
            }
        }

        function toggleAliveStatus(checkbox, idx) {

            const fieldsWrapper = document.getElementById(`fields_wrapper_${idx}`);

            if (!fieldsWrapper) {
                return;
            }

            fieldsWrapper.style.opacity = checkbox.checked ? '1' : '0.4';

            $(fieldsWrapper)
                .find('input:not([name$="[is_alive]"]), textarea, select')
                .prop('disabled', !checkbox.checked);
        }
    </script>
@endpush
