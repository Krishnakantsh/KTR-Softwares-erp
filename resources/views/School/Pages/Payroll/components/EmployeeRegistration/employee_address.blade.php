<div class="address-section-block current-address-block mb-24">
    <p class="text-xs fw-bold text-uppercase tracking-wider mb-12 section-tag address-section-title">
        <i class="ri-map-pin-line me-1"></i> Current Address
    </p>

    <div class="row gy-4 align-items-end">

        <div class="col-xl-6">
            <div class="premium-input-box">
                <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                    Address Line 1
                </label>
                <textarea name="current_address_line_1" id="current_address_line_1" rows="2"
                    class="form-control custom-premium-input" placeholder="House / Street / Locality"></textarea>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="premium-input-box">
                <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                    Address Line 2
                </label>
                <textarea name="current_address_line_2" id="current_address_line_2" rows="2"
                    class="form-control custom-premium-input" placeholder="Landmark / Additional address"></textarea>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="current_country" id="current_country" class="form-control custom-premium-input"
                value="India" placeholder="Country">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="current_state" id="current_state" class="form-control custom-premium-input"
                placeholder="State">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="current_district" id="current_district"
                class="form-control custom-premium-input" placeholder="District">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="current_city" id="current_city" class="form-control custom-premium-input"
                placeholder="City">
        </div>

        <div class="col-xl-6 col-md-6">
            <input type="text" name="current_area" id="current_area" class="form-control custom-premium-input"
                maxlength="150" placeholder="Area / Locality">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="current_pincode" id="current_pincode" class="form-control custom-premium-input"
                maxlength="10" placeholder="Pincode">
        </div>

    </div>
</div>

<div class="address-section-block permanent-address-block mb-16">
    <div class="d-flex justify-content-between align-items-center mb-12">
        <p class="text-xs fw-bold text-uppercase tracking-wider mb-0 section-tag address-section-title">
            <i class="ri-home-4-line me-1"></i> Permanent Address
        </p>

        <div class="premium-input-box position-relative d-flex align-items-center gap-2">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0" for="status">
                System Record Status
            </label>

            <div class="form-check form-switch p-0 m-0">
                <label class="switch mb-0">
                    <input type="checkbox" role="switch" id="same_as_permanent_address"
                        name="same_as_permanent_address" value="1" class="module-active-toggle">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </div>

    <div class="row gy-4 align-items-end">

        <div class="col-xl-6">
            <div class="premium-input-box">
                <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                    Address Line 1
                </label>
                <textarea name="permanent_address_line_1" id="permanent_address_line_1" rows="2"
                    class="form-control custom-premium-input" placeholder="House / Street / Locality"></textarea>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="premium-input-box">
                <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                    Address Line 2
                </label>
                <textarea name="permanent_address_line_2" id="permanent_address_line_2" rows="2"
                    class="form-control custom-premium-input" placeholder="Landmark / Additional address"></textarea>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="permanent_country" id="permanent_country"
                class="form-control custom-premium-input" value="India" placeholder="Country">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="permanent_state" id="permanent_state"
                class="form-control custom-premium-input" placeholder="State">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="permanent_district" id="permanent_district"
                class="form-control custom-premium-input" placeholder="District">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="permanent_city" id="permanent_city"
                class="form-control custom-premium-input" placeholder="City">
        </div>

        <div class="col-xl-6 col-md-6">
            <input type="text" name="permanent_area" id="permanent_area"
                class="form-control custom-premium-input" maxlength="150" placeholder="Area / Locality">
        </div>

        <div class="col-xl-3 col-md-6">
            <input type="text" name="permanent_pincode" id="permanent_pincode"
                class="form-control custom-premium-input" maxlength="10" placeholder="Pincode">
        </div>

    </div>
</div>
