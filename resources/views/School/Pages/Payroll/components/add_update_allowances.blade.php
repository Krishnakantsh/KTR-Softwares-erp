<div class="modal fade" id="payrollAllowancesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="payrollAllowancesModalTitle">
                        Create Allowance
                    </h6>
                    <small class="text-neutral-500 text-xs">Select branch and configure allowance calculation
                        & statutory rules.</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <form id="allowanceRegistrationForm" class="ajaxForm"
                data-url="{{ route('school.payroll_allowance.save') }}" data-refresh="fetchRegisteredAllowances"
                data-method="POST" autocomplete="off" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="id" id="allowance_id">

                <div class="modal-body p-28">

                    <!-- Basic & Scope Information -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Branch <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-building-4-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select
                                            class="form-control custom-premium-input ps-44 py-12 radius-8 payroll_branch_id"
                                            id="branch_id" name="branch_id" required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Allowance Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="allowance_code" id="allowance_code" placeholder="e.g. HRA-001"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Allowance Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-price-tag-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="allowance_name" id="allowance_name"
                                            placeholder="e.g. House Rent Allowance" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Effect Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-exchange-funds-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="effect_type" name="effect_type" required>
                                            <option value="1" selected>Earning (+ Add to Salary)</option>
                                            <option value="2">Deduction (- Deduct from Salary)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Calculation Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-percent-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calculation_type" name="calculation_type" required>
                                            <option value="1" selected>Fixed Amount</option>
                                            <option value="2">Percentage Basis</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6" id="amount_wrapper">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Amount (₹) <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-money-dollar-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" step="0.01"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="default_amount" id="default_amount" placeholder="0.00" value="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 d-none" id="percentage_wrapper">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Default Percentage (%) <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-percent-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" step="0.0001"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="default_percentage" id="default_percentage"
                                            placeholder="e.g. 10.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 d-none" id="percentage_on_wrapper">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Percentage Applied On <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-funds-box-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="percentage_on" name="percentage_on">
                                            <option value="">Select Base</option>
                                            <option value="1">Basic Salary</option>
                                            <option value="2">Gross Salary</option>
                                            <option value="3">Basic + DA</option>
                                            <option value="4">Custom Formula</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statutory, Tax Rules & Logic -->
                    <div class="form-segment my-28 border border-dotted radius-12 p-12 ">


                        <div class="row gy-4 ">
                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-neutral-50 radius-8 border border-neutral-200 h-100">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="is_taxable">Taxable Allowance</label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch">
                                            <input type="checkbox" role="switch" id="is_taxable" name="is_taxable"
                                                value="1" checked class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-neutral-50 radius-8 border border-neutral-200 h-100">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="is_pf_applicable">PF Applicable</label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch">
                                            <input type="checkbox" role="switch" id="is_pf_applicable"
                                                name="is_pf_applicable" value="1" class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-neutral-50 radius-8 border border-neutral-200 h-100">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="is_esic_applicable">ESIC Applicable</label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch">
                                            <input type="checkbox" role="switch" id="is_esic_applicable"
                                                name="is_esic_applicable" value="1"
                                                class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="premium-input-box position-relative d-flex align-items-center justify-content-between p-12 bg-neutral-50 radius-8 border border-neutral-200 h-100">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block"
                                        for="is_prorated">Prorated Basis</label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <label class="switch">
                                            <input type="checkbox" role="switch" id="is_prorated"
                                                name="is_prorated" value="1" checked
                                                class="module-active-toggle">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="form-segment mb-28">
                        <div class="row gy-4">
                            <div class="col-xl-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Description
                                    </label>
                                    <textarea class="form-control custom-premium-input py-12 radius-8" name="description" id="allowance_description"
                                        rows="3" placeholder="Brief description about this allowance rule..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <div class="premium-input-box position-relative d-flex gap-4 me-8">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 d-block">
                                Overtime Applicable
                            </label>

                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch">
                                    <input type="checkbox" role="switch" id="is_overtime_applicable"
                                        name="is_overtime_applicable" value="1" checked
                                        class="module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="premium-input-box position-relative d-flex gap-4 me-8">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 d-block">
                                Status
                            </label>

                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch">
                                    <input type="checkbox" role="switch" id="allowance_status"
                                        name="allowance_status" value="1" checked class="module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>


                        <button type="button" id="resetAllowanceForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Allowance
                        </button>
                    </div>

                </div>

            </form>


        </div>
    </div>
</div>
