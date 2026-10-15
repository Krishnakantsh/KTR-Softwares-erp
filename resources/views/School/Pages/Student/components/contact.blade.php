<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Student Contact Details</h6>
    </div>

    <div class="card-body p-20">
        <div class="row gy-4">

            <!-- LEFT COLUMN: Present Address -->
            <div class="col-xl-6 col-lg-6">
                <div class="p-20 radius-12 border bg-base h-100" style="border: 1px solid #e2e8f0; background: #f8fafc;">
                    <h6 class="text-sm fw-bold text-uppercase text-primary mb-16 pb-8 border-bottom">Present Address</h6>

                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Address Line</label>
                            <textarea class="form-control" name="present_address" id="present_address" rows="3"
                                placeholder="Enter current residential address..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">City</label>
                            <input type="text" class="form-control" name="present_city" id="present_city"
                                placeholder="e.g. Mumbai" />
                        </div>
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Postal / PIN Code</label>
                            <input type="text" class="form-control" name="present_postal_code"
                                id="present_postal_code" placeholder="e.g. 400001" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Permanent Address -->
            <div class="col-xl-6 col-lg-6">
                <div class="p-20 radius-12 border bg-base h-100" style="border: 1px solid #e2e8f0;">
                    <div class="d-flex justify-content-between align-items-center mb-16 pb-8 border-bottom">
                        <h6 class="text-sm fw-bold text-uppercase text-primary mb-0">Permanent Address</h6>

                        <!-- Premium Same as Present Toggle -->
                        <div class="d-flex align-items-center gap-2">
                            <label class="switch-sm switch">
                                <input type="checkbox" id="same_as_present" onchange="syncAddresses()">
                                <span class="slider"></span>
                            </label>
                            <label class="text-xs fw-semibold text-muted cursor-pointer mb-0" for="same_as_present">Same
                                as Present</label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Address Line</label>
                            <textarea class="form-control" name="permanent_address" id="permanent_address" rows="3"
                                placeholder="Enter permanent address..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">City</label>
                            <input type="text" class="form-control" name="permanent_city" id="permanent_city"
                                placeholder="e.g. Mumbai" />
                        </div>
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">Postal / PIN Code</label>
                            <input type="text" class="form-control" name="permanent_postal_code"
                                id="permanent_postal_code" placeholder="e.g. 400001" />
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Regional & Birth Details Section -->
        <h6 class="text-sm fw-bold text-uppercase text-secondary-light mt-32 mb-16 border-bottom pb-8">Regional & Birth
            Information</h6>
        <div class="row gy-3">
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Birth Place</label>
                <input type="text" class="form-control" name="birth_place" placeholder="City/Town of birth" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Tehsil</label>
                <input type="text" class="form-control" name="tehsil" placeholder="Enter Tehsil" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">District</label>
                <input type="text" class="form-control" name="district" placeholder="Enter District" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Police Station</label>
                <input type="text" class="form-control" name="police_station" placeholder="Nearest Police Station" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Post Office</label>
                <input type="text" class="form-control" name="post_office" placeholder="Local Post Office Name" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Country</label>
                <input type="text" class="form-control fw-medium bg-light" name="country" value="India" readonly
                    style="cursor: not-allowed; opacity: 0.8;" />
            </div>
        </div>

        <!-- Emergency / Contact Person Section -->
        <h6 class="text-sm fw-bold text-uppercase text-secondary-light mt-32 mb-16 border-bottom pb-8">Emergency /
            Contact Person Details</h6>
        <div class="row gy-3">
            <div class="col-md-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Contact Person Phone</label>
                <input type="text" class="form-control" name="contact_person_phone"
                    placeholder="Emergency contact number" />
            </div>
            <div class="col-md-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Contact Person Email</label>
                <input type="email" class="form-control" name="contact_person_email"
                    placeholder="example@domain.com" />
            </div>
            <div class="col-12">
                <label class="text-sm fw-semibold text-primary-light mb-8">Contact Person Address</label>
                <textarea class="form-control" name="contact_person_address" rows="2"
                    placeholder="Full address of the contact person..."></textarea>
            </div>
        </div>

    </div>
</div>

<style>
    /* Small Toggle for Same As Present */
    .switch-sm {
        width: 46px !important;
        height: 24px !important;
    }

    .switch-sm .slider:before {
        width: 18px !important;
        height: 18px !important;
        left: 3px !important;
        bottom: 2px !important;
    }

    .switch input:checked+.switch-sm .slider:before {
        transform: translateX(20px) !important;
    }
</style>


@push('script')
    <script>
        function syncAddresses() {
            const isChecked = document.getElementById('same_as_present').checked;

            const presentAddress = document.getElementById('present_address');
            const presentCity = document.getElementById('present_city');
            const presentPostal = document.getElementById('present_postal_code');

            const permanentAddress = document.getElementById('permanent_address');
            const permanentCity = document.getElementById('permanent_city');
            const permanentPostal = document.getElementById('permanent_postal_code');

            if (isChecked) {
                permanentAddress.value = presentAddress.value;
                permanentCity.value = presentCity.value;
                permanentPostal.value = presentPostal.value;

                // Dynamic sync input behavior lock
                permanentAddress.setAttribute('readonly', true);
                permanentCity.setAttribute('readonly', true);
                permanentPostal.setAttribute('readonly', true);
            } else {
                permanentAddress.removeAttribute('readonly');
                permanentCity.removeAttribute('readonly');
                permanentPostal.removeAttribute('readonly');
            }
        }

        // Live update permanent fields if toggled on and user types in present fields
        $(document).on('input', '#present_address, #present_city, #present_postal_code', function() {
            if ($('#same_as_present').is(':checked')) {
                syncAddresses();
            }
        });
    </script>
@endpush
