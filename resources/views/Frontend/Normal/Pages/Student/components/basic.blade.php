<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
    <div class="card-header border-bottom bg-base py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0">Student Basic Information</h6>
    </div>

    <div class="card-body p-20">
        <div class="row gy-4">
            <div class="col-xl-3 col-lg-4">
                <div class="profile-upload-wrapper p-20 radius-12 border bg-base h-100 d-flex flex-column align-items-center justify-content-center"
                    style="border: 2px dashed #cbd5e1; background: #f8fafc;">
                    <label class="text-xs fw-bold text-uppercase text-secondary-light mb-12 d-block">Student
                        Photograph</label>

                    <div class="avatar-preview-box position-relative overflow-hidden mb-12 shadow-sm"
                        style="width: 140px; height: 140px; border-radius: 50%; border: 4px solid #ffffff; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                        <img id="student_photo_preview" src="{{ asset('assets/images/_ (11).jpeg') }}"
                            style="width: 100%; height: 100%; object-fit: cover;" alt="Student Avatar">
                    </div>

                    <div class="upload-btn-wrapper position-relative w-100 mb-12">
                        <input type="file" name="student_photo" id="student_photo"
                            class="form-control opacity-0 position-absolute w-100 h-100 top-0 start-0"
                            style="cursor: pointer; z-index: 5;" onchange="previewStudentPhoto(this)">
                        <button type="button"
                            class="btn btn-sm btn-primary-50 text-primary-600 fw-semibold w-100 radius-8 border-primary-100">
                            <i class="bi bi-camera me-2"></i> Browse Photo
                        </button>
                    </div>

                    <div class="w-100 border-top pt-12 text-start">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="text-xs text-muted fw-medium">Status:</span>
                            <span
                                class="badge bg-success-100 text-success-600 px-12 py-2 radius-4 fw-semibold text-xs">Studying</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-12">Sr. No. <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control sr_no" name="sr_no" placeholder="Enter Sr. No."
                            required />
                    </div>
                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-12">Admission No. <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control admission_no" name="admission_no"
                            placeholder="Enter Admission No." required />
                    </div>

                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-12">Enroll No.</label>
                        <input type="text" class="form-control enroll_no" name="enroll_no"
                            placeholder="Enter Enroll No." />
                    </div>
                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-12">Permanent Edu. No.</label>
                        <input type="text" class="form-control" name="permanent_edu_no" placeholder="PEN Number" />
                    </div>

                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-4">Class <span
                                class="text-danger">*</span></label>
                        <select name="class_id" class="form-control form-select" required>
                            <option value="" selected disabled>Select Class</option>
                            @if (isset($classes))
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-sm fw-semibold text-primary-light mb-4">Section <span
                                class="text-danger">*</span></label>
                        <select name="section_id" class="form-control form-select" required>
                            <option value="" selected disabled>Select Section</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="row gy-3 mt-12">

            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Admission Date</label>
                <input type="date" class="form-control" name="admission_date" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Date of Birth <span
                        class="text-danger">*</span></label>
                <input type="date" class="form-control text-danger fw-medium" name="dob" required />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Fee Type</label>
                <select name="fee_type" class="form-control form-select">
                    <option value="Day Scholar">Day Scholar</option>
                    <option value="RTE">RTE</option>
                    <option value="Free">Free</option>

                </select>
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Student Type</label>
                <select name="student_type" class="form-control form-select">
                    <option value="New" selected>New</option>
                    <option value="Old">Old</option>
                </select>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="d-flex justify-content-between align-items-center mb-8">
                    <label class="text-sm fw-semibold text-primary-light mb-0">Stream</label>
                    {{-- <a href="javascript:void(0)" class="text-xs fw-bold text-primary-600">+ Add Stream</a> --}}
                </div>
                <select name="stream_id" class="form-control form-select">
                    <option value="">None</option>
                </select>
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Gender <span
                        class="text-danger">*</span></label>
                <select name="gender" class="form-control form-select" required>
                    <option value="" selected disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Roll No.</label>
                <input type="text" class="form-control" name="roll_no" placeholder="Roll Number" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Comp No.</label>
                <input type="text" class="form-control" name="comp_no" placeholder="Computer Number" />
            </div>

            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">First Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control fw-semibold" style="color: #e84118 !important;"
                    name="first_name" placeholder="First Name" required />
            </div>
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">Last Name</label>
                <input type="text" class="form-control fw-semibold" style="color: #e84118 !important;"
                    name="last_name" placeholder="Last Name" />
            </div>
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">Contact Person Name</label>
                <input type="text" class="form-control" name="contact_person_name"
                    placeholder="Emergency Contact Name" />
            </div>

            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">SMS/WhatsApp No. <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" name="sms_whatsapp_no"
                    placeholder="Primary notification number" required />
            </div>
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">Father Mobile No.</label>
                <input type="text" class="form-control" name="father_mobile" placeholder="Father's phone" />
            </div>
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">Mother Mobile No.</label>
                <input type="text" class="form-control" name="mother_mobile" placeholder="Mother's phone" />
            </div>

            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">Father Name</label>
                <input type="text" class="form-control" name="father_name" placeholder="Father's full name" />
            </div>
            <div class="col-md-4">
                <label class="text-sm fw-semibold text-primary-light mb-8">Mother Name</label>
                <input type="text" class="form-control" name="mother_name" placeholder="Mother's full name" />
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between align-items-center mb-8">
                    <label class="text-sm fw-semibold text-primary-light mb-0">House</label>
                    {{-- <a href="javascript:void(0)" class="text-xs fw-bold text-primary-600">+ Add House</a> --}}
                </div>
                <select name="house_id" class="form-control form-select">
                    <option value="">Select House</option>
                </select>
            </div>

            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Student Status</label>
                <select name="student_status" class="form-control form-select">
                    <option value="studying" selected>Studying</option>
                    <option value="tc">TC Issued Mark</option>
                    <option value="resticate">Resticate</option>
                    <option value="drop">Drop</option>
                    <option value="repeater">Repeater</option>
                </select>
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">TC No.</label>
                <input type="text" class="form-control" name="tc_no" placeholder="System generated TC" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Manual TC No.</label>
                <input type="text" class="form-control" name="manual_tc_no" placeholder="Book TC Number" />
            </div>
            <div class="col-md-4 col-sm-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Reason (If leaving)</label>
                <input type="text" class="form-control" name="reason" placeholder="Reason for TC" />
            </div>

            <div class="col-12">
                <label class="text-sm fw-semibold text-primary-light mb-8">Comments / Remarks</label>
                <textarea class="form-control" name="comment" rows="2"
                    placeholder="Write internal office notes or description here..."></textarea>
            </div>

            <div class="col-12 border-top pt-20 mt-12">
                <div class="d-flex flex-wrap gap-40">

                    <div class="d-flex align-items-center gap-3">
                        <label class="switch">
                            <input type="checkbox" name="is_ews" id="is_ews" value="1">
                            <span class="slider"></span>
                        </label>
                        <label class="text-sm fw-semibold text-primary-light cursor-pointer mb-0" for="is_ews">EWS
                            Student</label>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <label class="switch">
                            <input type="checkbox" name="is_study_material" id="is_study_material" value="1">
                            <span class="slider"></span>
                        </label>
                        <label class="text-sm fw-semibold text-primary-light cursor-pointer mb-0"
                            for="is_study_material">Study Material Issued</label>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <label class="switch">
                            <input type="checkbox" name="is_physically_challenged" id="is_physically_challenged"
                                value="1">
                            <span class="slider"></span>
                        </label>
                        <label class="text-sm fw-semibold text-primary-light cursor-pointer mb-0"
                            for="is_physically_challenged">Physically Challenged</label>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* 👑 MATCHED PREMIUM TOGGLE BUTTON STYLING */
    .switch {
        position: relative;
        display: inline-block;
        width: 56px;
        height: 32px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        inset: 0;
        cursor: pointer;
        background: #e2e8f0;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .slider:before {
        position: absolute;
        content: "";
        width: 24px;
        height: 24px;
        left: 3px;
        bottom: 3px;
        background: #ffffff;
        border-radius: 50%;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }

    .switch:hover .slider {
        border-color: #cbd5e1;
        background: #cbd5e1;
    }

    .switch input:checked+.slider {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border-color: transparent;
        box-shadow: 0 6px 16px rgba(124, 58, 237, 0.35);
    }

    .switch input:checked+.slider:before {
        transform: translateX(24px);
        box-shadow: -2px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

@push('script')
    <script>
        function previewStudentPhoto(input) {
            const preview = document.getElementById('student_photo_preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function() {

            // fetch stream
            fetchMasterData("{{ route('school.stream.master.fetch.with') }}", function(res) {

                let options = `<option value="">Select Stream</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("select[name='stream_id']").html(options);
            });
            // fetch classes 
            fetchMasterData("{{ route('school.class.master.fetch.with') }}", function(res) {

                let options = `<option value="">Select Class</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("select[name='class_id']").html(options);
            });
            // fetch all houses
            fetchMasterData("{{ route('school.house.fetch') }}", function(res) {

                let options = `<option value="">Select House</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("select[name='house_id']").html(options);
            });

        });

        $(document).on("change", "select[name='class_id']", function() {

            let class_id = $(this).val();

            if (!class_id) {
                $("select[name='section_id']").html(`<option value="">Select Section</option>`);
                return;
            }

            getDataById("{{ route('school.common.get_class_devisions_by_class_id') }}", class_id, function(res) {

                let options = `<option value="">Select Section</option>`;

                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });

                $("select[name='section_id']").html(options);

            });

        });
    </script>
@endpush
