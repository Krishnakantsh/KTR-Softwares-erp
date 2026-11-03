<div class="modal fade" id="studentComplaintModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header border-bottom d-flex align-items-center justify-content-between  border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h4 class="modal-title fw-bold text-neutral-800 text-xl mb-0" id="studentComplaintModalTitle">
                        Add Student Complaint
                    </h4>
                    <small class="text-neutral-500 text-xs">Register a new complaint for a student</small>
                </div>
                <div class="d-flex align-items-center gap-12">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staffComplaintModal"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                        <i class="ri-save-3-line"></i> Raise Staff Complaint
                    </button>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="studentComplaintForm" class="ajaxForm" data-url="{{ route('school.complaint.save') }}"
                data-refresh="getStudentComplaintList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="complaint_id" value="">
                <input type="hidden" name="against_type" value="3">
                <input type="hidden" name="against_id" id="complaint_student_id" value="">

                <div class="modal-body p-28">
                    <div class="row gy-4 mb-24">
                        <div class="col-md-12">
                            @include('components.student-search-input')
                        </div>
                    </div>
                    
                    <!-- Selected Student Info Strip -->
                    <div class="row g-8 gap-16 d-none mb-24" id="complaintStudentInfoStrip">
                        <div class="col-md-12">
                            <div
                                class="shadow-1 radius-12 bg-neutral-50 border border-neutral-200 p-16 d-flex align-items-center gap-20 flex-wrap">

                                <img id="complaintStudentPhoto" src="{{ asset('assets/images/_ (11).jpeg') }}"
                                    class="rounded-circle" style="width:48px;height:48px;object-fit:cover;"
                                    alt="student">

                                <div>
                                    <span
                                        class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Student</span>
                                    <span class="fw-bold text-neutral-800" id="complaintStudentName">-</span>
                                </div>

                                <div>
                                    <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Adm
                                        No</span>
                                    <span class="fw-semibold text-neutral-700" id="complaintStudentAdm">-</span>
                                </div>

                                <div>
                                    <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Class
                                        / Section</span>
                                    <span class="fw-semibold text-neutral-700" id="complaintStudentClass">-</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

                            <!-- Complaint Type (dropdown, student search select hone ke baad load hoga) -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Complaint Type <span class="text-danger">*</span>
                                    </label>

                                    <div class="row g-2 d-flex align-items-center">
                                        <div class="col-10">
                                            <div class="inner-addon position-relative">
                                                <i
                                                    class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                                <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                                    name="complaint_type_id" id="complaint_type_select" required
                                                    disabled>
                                                    <option value="" selected disabled>Select student first
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-2 ps-16">
                                            <x-model-open target="complaintTypeModal" />
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Priority (type select hone par auto-fill hoga, but editable rahega) -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Priority
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-flag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            name="priority" id="complaint_priority">
                                            <option value="1">Low</option>
                                            <option value="2" selected>Medium</option>
                                            <option value="3">High</option>
                                            <option value="4">Critical</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Subject <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-chat-1-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="complaint_subject" name="subject"
                                            placeholder="Short subject of the complaint" maxlength="150" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Description <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-file-text-line text-neutral-400 addon-icon position-absolute start-0 top-16 ms-16"></i>
                                        <textarea class="form-control custom-premium-input ps-44 py-12 radius-8" id="complaint_desc" name="description"
                                            rows="4" placeholder="Describe the complaint in detail..." required></textarea>
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
                        <i class="ri-save-3-line"></i> Save Complaint
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(function() {

            // "Student" role ki complaint_for value aapke complaint-type-add form ke hisaab se 3 hai
            const STUDENT_ROLE_ID = 3;

            /*
            |--------------------------------------------------------------------------
            | 1. Student Search callback -> student info dikhana + complaint types load karna
            |--------------------------------------------------------------------------
            */
            initStudentSearch(function(selectedStudentId) {

                $('#complaint_student_id').val(selectedStudentId);

                $.ajax({
                    url: "{{ route('student.show.with') }}",
                    type: "GET",
                    data: {
                        id: selectedStudentId
                    },
                    success: function(response) {

                        let res = response.data;

                        $('#complaintStudentInfoStrip').removeClass('d-none');
                        $('#complaintStudentName').text(res.first_name + ' ' + res.last_name);
                        $('#complaintStudentAdm').text(res.admission_no);
                        $('#complaintStudentClass').text((res.class_master?.name || '-') +
                            ' / ' + (res
                                .section?.name || '-'));

                        if (res.student_photo) {
                            $('#complaintStudentPhoto').attr('src', '{{ asset('') }}' + res
                                .student_photo);
                        }
                    }
                });

                loadComplaintTypes();
            });

            /*
            |--------------------------------------------------------------------------
            | 2. Complaint Types dropdown -> "Complaint Type Add" form se saved types yahan aayenge
            |    (sirf complaint_for = Student wale, aur status = active wale dikhaye ja rahe hain)
            |--------------------------------------------------------------------------
            */
            function loadComplaintTypes() {

                $('#complaint_type_select').prop('disabled', true)
                    .html('<option value="" selected disabled>Loading...</option>');

                fetchMasterData("{{ route('school.complaintType.fetch') }}", function(res) {

                    let types = (res.data || []).filter(t => t.complaint_for == STUDENT_ROLE_ID && t
                        .status ==
                        1);

                    let options = '<option value="" selected disabled>Select Complaint Type</option>';
                    types.forEach(function(t) {
                        options +=
                            `<option value="${t.id}" data-priority="${t.default_priority}">${t.type_name}</option>`;
                    });

                    $('#complaint_type_select').html(options).prop('disabled', types.length === 0);
                });
            }

            // Type select hote hi uski default priority auto-fill ho jaayegi (user chahe to change kar sakta hai)
            $(document).on('change', '#complaint_type_select', function() {
                let priority = $(this).find(':selected').data('priority');
                if (priority) {
                    $('#complaint_priority').val(priority);
                }
            });

            /*
            |--------------------------------------------------------------------------
            | 3. Reset form jab modal close ho
            |--------------------------------------------------------------------------
            */
            $('#studentComplaintModal').on('hidden.bs.modal', function() {
                $('#studentComplaintForm')[0].reset();
                $('#complaint_id').val('');
                $('#complaint_student_id').val('');
                $('#studentComplaintModalTitle').text('Add Complaint');
                $('#complaint_status').prop('checked', true);
                $('#complaintStudentInfoStrip').addClass('d-none');
                $('#complaint_type_select').prop('disabled', true)
                    .html('<option value="" selected disabled>Select student first</option>');
            });

        });
    </script>
@endpush
