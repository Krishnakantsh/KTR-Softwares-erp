<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
    <div class="card-header border-bottom bg-base py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Student Personal Details</h6>
    </div>

    <div class="card-body p-20">
        
        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-16 pb-4 border-bottom">Identity & Demographics</h6>
        <div class="row gy-3 mb-24">
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Nationality</label>
                <input type="text" class="form-control fw-medium" name="nationality" value="Indian" placeholder="Enter Nationality" />
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Religion</label>
                <select name="religion" class="form-control form-select">
                    <option value="" selected disabled>Select Religion</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Islam">Islam</option>
                    <option value="Christianity">Christianity</option>
                    <option value="Sikhism">Sikhism</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Jainism">Jainism</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Category</label>
                <select name="category" class="form-control form-select">
                    <option value="" selected disabled>Select Category</option>
                    <option value="General">General</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="EWS">EWS</option>
                </select>
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Caste</label>
                <input type="text" class="form-control" name="caste" placeholder="e.g. Brahmin, Yadav, etc." />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Mother Tongue</label>
                <input type="text" class="form-control" name="mother_tongue" placeholder="e.g. Hindi, English" />
            </div>
            <div class="col-md-8 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Student Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="student.name@example.com" />
            </div>
        </div>

        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-16 pb-4 border-bottom">Government & Institutional Identifications</h6>
        <div class="row gy-3 mb-24">
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Aadhaar No.</label>
                <input type="text" class="form-control" name="aadhaar_no" maxlength="12" placeholder="12-digit Aadhaar Number" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">APAAR ID</label>
                <input type="text" class="form-control" name="apaar_id" placeholder="EduLocker / APAAR ID" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Family ID (Parivar Pehchan Patra)</label>
                <input type="text" class="form-control" name="family_id" placeholder="Enter Family ID" />
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Saral ID</label>
                <input type="text" class="form-control" name="saral_id" placeholder="Enter Saral ID" />
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">National Identity Card (NIC)</label>
                <input type="text" class="form-control" name="nic" placeholder="Enter NIC Number" />
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Passport No.</label>
                <input type="text" class="form-control text-uppercase" name="passport_no" placeholder="Enter Passport Number" />
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">BPL Card No.</label>
                <input type="text" class="form-control" name="bpl_card" placeholder="Below Poverty Line Card No." />
            </div>
        </div>

        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-16 pb-4 border-bottom">Health, Fitness & Financial Info</h6>
        <div class="row gy-3">
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Blood Group</label>
                <select name="blood_group" class="form-control form-select">
                    <option value="" selected disabled>Select Blood Group</option>
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
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Height</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="height" placeholder="e.g. 152" />
                    <span class="input-group-text bg-light text-xs text-secondary fw-semibold">cm</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Weight</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="weight" placeholder="e.g. 45" />
                    <span class="input-group-text bg-light text-xs text-secondary fw-semibold">kg</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Donation / Special Amount</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-sm fw-semibold text-primary-600">₹</span>
                    <input type="number" step="0.01" class="form-control fw-semibold text-success-600" name="donation_amount" value="0.00" placeholder="0.00" />
                </div>
            </div>
        </div>

    </div>
</div>