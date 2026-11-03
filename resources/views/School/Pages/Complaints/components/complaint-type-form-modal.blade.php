{{-- ================================
    COMPLAINT TYPE ADD/EDIT FORM MODAL
================================ --}}
<div class="modal fade" id="complaintTypeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="complaintTypeModalTitle">
                        Add Complaint Type
                    </h6>
                    <small class="text-neutral-500 text-xs">Create or update complaint type details</small>
                </div>
                <div>

                    <x-model-open  target="complaintTypeListModal"    icon="ri-eye-line" />

                    <x-model-close/>
                </div>
            </div>

            <!-- Form -->
            <form id="complaintTypeForm" class="ajaxForm" data-url="{{ route('school.complaintType.save') }}"
                data-refresh="getComplaintTypeList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="complaint_type_id" value="">

                <div class="modal-body p-28">

                    <!-- Form Segment Header -->
                    <div class="form-segment mb-28">


                        <div class="row gy-4">
                            <!-- Complaint For -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Complaint For <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-user-star-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="complaint_for" id="complaint_for" required>
                                            <option value="" selected disabled>Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Staff</option>
                                            <option value="3">Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Type Name -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Type Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="complaint_type_name" name="type_name"
                                            placeholder="e.g., Infrastructure, Academics" maxlength="100" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Default Priority -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Priority
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-flag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="default_priority" id="complaint_default_priority">
                                            <option value="1">Low</option>
                                            <option value="2" selected>Medium</option>
                                            <option value="3">High</option>
                                            <option value="4">Critical</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Description (Full Width) -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Description
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-file-text-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="complaint_description" name="description"
                                            placeholder="Enter short description...">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <hr class="border-neutral-200 my-0">

                <!-- Footer / Execution Control Bar -->
                <div
                    class="modal-footer border-0 p-24 d-flex justify-content-end align-items-center gap-3 execution-control-bar">

                    <!-- Status Toggle Switch -->
                    <div class="premium-input-box position-relative d-flex align-items-center gap-2 me-auto">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                            Status
                        </label>
                        <div class="form-check form-switch p-0 m-0">
                            <label class="switch mb-0">
                                <input type="checkbox" role="switch" id="complaint_status" name="status"
                                    value="1" checked class="module-active-toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <button type="button"
                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line"></i> Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                        <i class="ri-save-3-line"></i> Save Complaint Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        /* Reset Form When Modal Closes */
        $('#complaintTypeModal').on('hidden.bs.modal', function() {
            $('#complaintTypeForm')[0].reset();
            $('#complaint_type_id').val('');
            $('#complaintTypeModalTitle').text('Add Complaint Type');
            $('#complaint_status').prop('checked', true);
        });
    </script>
@endpush
