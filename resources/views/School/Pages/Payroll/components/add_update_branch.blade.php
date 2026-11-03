<div class="modal fade" id="payrollBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="payrollBranchModalTitle">
                        Add Branch
                    </h6>
                    <small class="text-neutral-500 text-xs">Create or update payroll branch</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <form id="branchRegistrationForm" class="ajaxForm" data-url="{{ route('school.payroll_branch.save') }}"
                data-refresh="fetchRegisteredBranches" data-method="POST" autocomplete="off"
                enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="id" id="branch_id">

                <div class="modal-body p-28">


                    <!-- Basic Information -->
                    <div class="form-segment mb-28">


                        <div class="row gy-4">
                            <div class="col-xl-6 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Branch Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="branch_code" id="branch_code" placeholder="e.g. BR-001" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Branch Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-building-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="branch_name" id="branch_name" placeholder="e.g. Agra Main Campus"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Display Name
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-t-box-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="display_name" id="display_name"
                                            placeholder="Public facing display name...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Phone Number
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-phone-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="phone" id="phone" placeholder="e.g. 9876543210">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Email Address
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-mail-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="email"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="email" id="email" placeholder="branch@school.com">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <div class="premium-input-box position-relative d-flex gap-4 me-8">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 d-block">
                                Status
                            </label>

                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch">
                                    <input type="checkbox" role="switch" id="is_active" name="is_active" value="1"
                                        checked class="module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <button type="button" id="resetBranchForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Branch
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
