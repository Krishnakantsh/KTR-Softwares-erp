<div class="modal fade" id="staffComplaintModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">


            <div
                class="modal-header border-bottom d-flex align-items-center justify-content-between  border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h4 class="modal-title fw-bold text-neutral-800 text-xl mb-0" id="studentComplaintModalTitle">
                        Add Staff Complaint
                    </h4>
                    <small class="text-neutral-500 text-xs">Register a new complaint for a student</small>
                </div>
                <div class="d-flex align-items-center gap-12">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#studentComplaintModal"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                        <i class="ri-save-3-line"></i> Raise Staff Complaint
                    </button>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="staffComplaintForm" class="ajaxForm" data-url="#" data-refresh="getStaffComplaintList"
                data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="complaint_id" value="">

                <input type="hidden" name="against_type" value="2">

                <div class="modal-body p-28">

                    <!-- Staff Select Dropdown -->
                    <div class="row gy-4 mb-24">
                        <div class="col-md-12">
                            <div class="premium-input-box position-relative">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Select Staff <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-user-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="against_id" id="complaint_staff_id">
                                        <option value="" selected disabled>Select Staff Member</option>
                                        {{-- Staff List Dynamic Loop Se Load Ho Skte Hain --}}
                                        @if (isset($staffs))
                                            @foreach ($staffs as $staff)
                                                <option value="{{ $staff->id }}">{{ $staff->first_name }}
                                                    {{ $staff->last_name }} ({{ $staff->employee_id ?? 'N/A' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Staff Info Strip -->
                    <div class="row g-8 gap-16 d-none mb-24" id="complaintStaffInfoStrip">
                        <div class="col-md-12">
                            <div
                                class="shadow-1 radius-12 bg-neutral-50 border border-neutral-200 p-16 d-flex align-items-center gap-20 flex-wrap">

                                <img id="complaintStaffPhoto" src="{{ asset('assets/images/_ (11).jpeg') }}"
                                    class="rounded-circle" style="width:48px;height:48px;object-fit:cover;"
                                    alt="staff">

                                <div>
                                    <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Staff
                                        Member</span>
                                    <span class="fw-bold text-neutral-800" id="complaintStaffName">-</span>
                                </div>

                                <div>
                                    <span class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Emp
                                        Code / ID</span>
                                    <span class="fw-semibold text-neutral-700" id="complaintStaffEmpId">-</span>
                                </div>

                                <div>
                                    <span
                                        class="text-xs text-neutral-500 d-block uppercase tracking-wider mb-2">Department
                                        / Designation</span>
                                    <span class="fw-semibold text-neutral-700" id="complaintStaffDesignation">-</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

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
                                                    <option value="" selected disabled>Select staff first
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

                            <!-- Priority -->
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

            // Staff Role ID (e.g., Staff complaint types ke liye role_id = 2 ya aapka jo ho)
            const STAFF_ROLE_ID = 2;

            /*
            |--------------------------------------------------------------------------
            | 1. Staff Select Change Event -> Staff info strip show karo & Types load karo
            |--------------------------------------------------------------------------
            */
            $('#complaint_staff_id').on('change', function() {
                let selectedStaffId = $(this).val();

                if (selectedStaffId) {
                    // Staff details Fetch karna via AJAX
                    $.ajax({
                        url: "#", // Aapka Staff fetch route
                        type: "GET",
                        data: {
                            id: selectedStaffId
                        },
                        success: function(response) {
                            let res = response.data;

                            $('#complaintStaffInfoStrip').removeClass('d-none');
                            $('#complaintStaffName').text((res.first_name || '') + ' ' + (res
                                .last_name || ''));
                            $('#complaintStaffEmpId').text(res.employee_id || '-');
                            $('#complaintStaffDesignation').text((res.department?.name || '-') +
                                ' / ' + (res.designation?.name || '-'));

                            if (res.photo) {
                                $('#complaintStaffPhoto').attr('src', '{{ asset('') }}' +
                                    res.photo);
                            }
                        }
                    });

                    // Load Staff Specific Complaint Types
                    loadComplaintTypes();
                } else {
                    $('#complaintStaffInfoStrip').addClass('d-none');
                    $('#complaint_type_select').prop('disabled', true).html(
                        '<option value="" selected disabled>Select staff first</option>');
                }
            });

            /*
            |--------------------------------------------------------------------------
            | 2. Load Staff Complaint Types Dropdown
            |--------------------------------------------------------------------------
            */
            function loadComplaintTypes() {
                $('#complaint_type_select').prop('disabled', true)
                    .html('<option value="" selected disabled>Loading...</option>');

                // Apne route path ke according isko update karein
                fetchMasterData("#", function(res) {
                    let types = (res.data || []).filter(t => t.complaint_for == STAFF_ROLE_ID && t.status ==
                        1);

                    let options = '<option value="" selected disabled>Select Complaint Type</option>';
                    types.forEach(function(t) {
                        options +=
                            `<option value="${t.id}" data-priority="${t.default_priority}">${t.type_name}</option>`;
                    });

                    $('#complaint_type_select').html(options).prop('disabled', types.length === 0);
                });
            }

            // Complaint Type select hone par priority auto-fill karne ke liye
            $(document).on('change', '#complaint_type_select', function() {
                let priority = $(this).find(':selected').data('priority');
                if (priority) {
                    $('#complaint_priority').val(priority);
                }
            });

            /*
            |--------------------------------------------------------------------------
            | 3. Reset form on modal close
            |--------------------------------------------------------------------------
            */
            $('#staffComplaintModal').on('hidden.bs.modal', function() {
                $('#staffComplaintForm')[0].reset();
                $('#complaint_id').val('');
                $('#staffComplaintModalTitle').text('Add Staff Complaint');
                $('#complaint_status').prop('checked', true);
                $('#complaintStaffInfoStrip').addClass('d-none');
                $('#complaint_type_select').prop('disabled', true)
                    .html('<option value="" selected disabled>Select staff first</option>');
            });

        });
    </script>
@endpush
