<div class="row gy-4 align-items-end mb-16">

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                First Name <span class="text-danger">*</span>
            </label>
            <div class="inner-addon">
                <i class="ri-user-line addon-icon"></i>
                <input type="text" name="first_name" id="first_name" class="form-control custom-premium-input"
                    placeholder="Enter first name" maxlength="100" required>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Middle Name
            </label>
            <div class="inner-addon">
                <i class="ri-user-line addon-icon"></i>
                <input type="text" name="middle_name" id="middle_name" class="form-control custom-premium-input"
                    placeholder="Enter middle name" maxlength="100">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Last Name
            </label>
            <div class="inner-addon">
                <i class="ri-user-line addon-icon"></i>
                <input type="text" name="last_name" id="last_name" class="form-control custom-premium-input"
                    placeholder="Enter last name" maxlength="100">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Display Name
            </label>
            <div class="inner-addon">
                <i class="ri-id-card-line addon-icon"></i>
                <input type="text" name="display_name" id="display_name" class="form-control custom-premium-input"
                    placeholder="Name displayed in system" maxlength="200">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Gender
            </label>
            <div class="inner-addon">
                <i class="ri-genderless-line addon-icon"></i>
                <select class="form-control custom-premium-input ps-44 py-12 radius-8" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Date of Birth
            </label>
            <div class="inner-addon">
                <i class="ri-calendar-line addon-icon"></i>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control custom-premium-input">
            </div>
        </div>
    </div>

    <!-- BLOOD GROUP: now a select dropdown -->
    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Blood Group
            </label>
            <div class="inner-addon">
                <i class="ri-drop-line addon-icon"></i>
                <select class="form-control custom-premium-input ps-44 py-12 radius-8" name="blood_group"
                    id="blood_group">
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Profile Photo
            </label>
            <input type="file" name="profile_photo" id="profile_photo" class="form-control custom-premium-input py-8"
                accept=".jpg,.jpeg,.png,.webp">
            <div id="profile_photo_preview" class="mt-8 text-xs"></div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Father Name
            </label>
            <div class="inner-addon">
                <i class="ri-parent-line addon-icon"></i>
                <input type="text" name="father_name" id="father_name" class="form-control custom-premium-input"
                    maxlength="200" placeholder="Father name">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Mother Name
            </label>
            <div class="inner-addon">
                <i class="ri-parent-line addon-icon"></i>
                <input type="text" name="mother_name" id="mother_name" class="form-control custom-premium-input"
                    maxlength="200" placeholder="Mother name">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Marital Status
            </label>
            <div class="inner-addon">
                <i class="ri-heart-3-line addon-icon"></i>
                <select class="form-control custom-premium-input ps-44 py-12 radius-8" name="marital_status"
                    id="marital_status">
                    <option value="1">Single</option>
                    <option value="2">Married</option>
                    <option value="3">Divorced</option>
                    <option value="4">Widowed</option>
                    <option value="5">Separated</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Spouse Name
            </label>
            <div class="inner-addon">
                <i class="ri-user-heart-line addon-icon"></i>
                <input type="text" name="spouse_name" id="spouse_name" class="form-control custom-premium-input"
                    maxlength="200" placeholder="Spouse name">
            </div>
        </div>
    </div>

</div>

<div class="row gy-4 align-items-end mb-16">

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Personal Email
            </label>
            <div class="inner-addon">
                <i class="ri-mail-line addon-icon"></i>
                <input type="email" name="personal_email" id="personal_email"
                    class="form-control custom-premium-input" placeholder="employee@example.com">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Personal Mobile
            </label>
            <div class="inner-addon">
                <i class="ri-phone-line addon-icon"></i>
                <input type="text" name="personal_mobile" id="personal_mobile"
                    class="form-control custom-premium-input" maxlength="20" placeholder="Mobile number">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Alternate Mobile
            </label>
            <div class="inner-addon">
                <i class="ri-phone-line addon-icon"></i>
                <input type="text" name="alternate_mobile" id="alternate_mobile"
                    class="form-control custom-premium-input" maxlength="20" placeholder="Alternate number">
            </div>
        </div>
    </div>

</div>

<div class="row gy-4 align-items-end mb-16">

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Contact Name
            </label>
            <div class="inner-addon">
                <i class="ri-user-warning-line addon-icon"></i>
                <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                    class="form-control custom-premium-input" maxlength="200" placeholder="Emergency contact">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Relation
            </label>
            <div class="inner-addon">
                <i class="ri-links-line addon-icon"></i>
                <input type="text" name="emergency_contact_relation" id="emergency_contact_relation"
                    class="form-control custom-premium-input" maxlength="100" placeholder="e.g. Father, Brother">
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="premium-input-box">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                Mobile Number
            </label>
            <div class="inner-addon">
                <i class="ri-phone-line addon-icon"></i>
                <input type="text" name="emergency_contact_mobile" id="emergency_contact_mobile"
                    class="form-control custom-premium-input" maxlength="20" placeholder="Emergency mobile">
            </div>
        </div>
    </div>

</div>
