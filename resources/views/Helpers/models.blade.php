{{-- ================================ HOUSES MANAGEMENT MODAL ================================ --}}

<div class="modal fade" id="housesModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="houseModalTitle">
                        Houses Management
                    </h6>
                    <small class="text-neutral-500 text-xs">Create and manage houses</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="houseForm" class="ajaxForm" data-url="{{ route('school.house.save') }}" data-refresh="getHouseList"
                data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="house_id" value="">

                <div class="modal-body p-28">

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

                            <!-- House Name -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        House Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-home-4-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="house_name" name="name" placeholder="e.g., Red House, Blue House"
                                            maxlength="100" required>
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
                                <input type="checkbox" role="switch" id="house_status" name="status" value="1"
                                    checked class="module-active-toggle">
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
                        <i class="ri-save-3-line"></i> Save House
                    </button>
                </div>
            </form>

            {{-- LIST --}}
            <div class="border-top border-neutral-200 bg-neutral-50 px-24 py-20">

                <h6 class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-16">
                    Houses List
                </h6>

                <div class="table-responsive border border-neutral-200 radius-8 bg-white">
                    <table class="table align-middle mb-0">
                        <thead class="bg-neutral-100 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">#
                                </th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    House Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Status</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16 text-end"
                                    width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="houseTableBody" class="divide-y divide-neutral-200">
                            <!-- Dynamic Rows -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ================================ STREAM MANAGEMENT MODAL ================================ --}}

<div class="modal fade" id="streamModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="streamModalTitle">
                        Stream Management
                    </h6>
                    <small class="text-neutral-500 text-xs">Create and manage streams</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="streamForm" class="ajaxForm" data-url="{{ route('school.stream.master.save') }}"
                data-refresh="getStreamList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="stream_id" id="stream_id" value="">

                <input type="hidden" name="status" id="stream_status_value" value="1">

                <div class="modal-body p-28">

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

                            <!-- Stream Name -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Stream Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-git-branch-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="stream_name" name="name"
                                            placeholder="e.g., Science, Commerce, Arts" maxlength="100" required>
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
                                <input type="checkbox" role="switch" id="stream_status" value="1" checked
                                    class="module-active-toggle">
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
                        <i class="ri-save-3-line"></i> Save Stream
                    </button>
                </div>
            </form>

            {{-- LIST --}}
            <div class="border-top border-neutral-200 bg-neutral-50 px-24 py-20">

                <h6 class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-16">
                    Stream List
                </h6>

                <div class="table-responsive border border-neutral-200 radius-8 bg-white">
                    <table class="table align-middle mb-0">
                        <thead class="bg-neutral-100 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    #</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Stream Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Status</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16 text-end"
                                    width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="streamTableBody" class="divide-y divide-neutral-200">
                            <!-- Dynamic Rows -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ================================ CONCESSION BY MODAL ================================ --}}

<div class="modal fade" id="concessionByModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="concessionByModalTitle">
                        Concession By
                    </h6>
                    <small class="text-neutral-500 text-xs">Create and manage concession authorities</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="concessionByForm" class="ajaxForm" data-url="{{ route('school.concession.by.save') }}"
                data-refresh="getConcessionByList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="concession_by_id" value="">


                <input type="hidden" name="status" id="consession_by_status_value" value="1">

                <div class="modal-body p-28">

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

                            <!-- Name -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-user-settings-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="concession_by_name" name="name"
                                            placeholder="e.g., Principal, Trust, Management" maxlength="100" required>
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
                                <input type="checkbox" role="switch" id="concession_by_status" value="1"
                                    checked class="module-active-toggle">
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
                        <i class="ri-save-3-line"></i> Save
                    </button>
                </div>
            </form>

            {{-- LIST --}}
            <div class="border-top border-neutral-200 bg-neutral-50 px-24 py-20">

                <h6 class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-16">
                    Concession By List
                </h6>

                <div class="table-responsive border border-neutral-200 radius-8 bg-white">
                    <table class="table align-middle mb-0">
                        <thead class="bg-neutral-100 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    #</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Status</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16 text-end"
                                    width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="concessionByTableBody" class="divide-y divide-neutral-200">
                            <!-- Dynamic Rows -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ================================ CONCESSION TYPE MODAL ================================ --}}

<div class="modal fade" id="concessionTypeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="concessionTypeModalTitle">
                        Concession Type
                    </h6>
                    <small class="text-neutral-500 text-xs">Create and manage concession types</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="concessionTypeForm" class="ajaxForm" data-url="{{ route('school.concession.type.save') }}"
                data-refresh="getConcessionTypeList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="concession_type_id" value="">

                <div class="modal-body p-28">

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

                            <!-- Concession Type Name -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Concession Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-price-tag-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="concession_type_name" name="name"
                                            placeholder="e.g., Sibling, Merit, Staff Ward" maxlength="100" required>
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
                                <input type="checkbox" role="switch" id="concession_type_status" name="status"
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
                        <i class="ri-save-3-line"></i> Save
                    </button>
                </div>
            </form>

            {{-- LIST --}}
            <div class="border-top border-neutral-200 bg-neutral-50 px-24 py-20">

                <h6 class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-16">
                    Concession Type List
                </h6>

                <div class="table-responsive border border-neutral-200 radius-8 bg-white">
                    <table class="table align-middle mb-0">
                        <thead class="bg-neutral-100 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    #</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Status</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16 text-end"
                                    width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="concessionTypeTableBody" class="divide-y divide-neutral-200">
                            <!-- Dynamic Rows -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ================================ Single Event Detail Modal ================================ --}}
<div class="modal fade" id="calendarEventShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 radius-16 overflow-hidden shadow-lg">

            <!-- Modal Header with Dynamic Primary Accent -->
            <div
                class="modal-header border-bottom border-neutral-200 bg-neutral-50 px-24 py-16 justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-10 radius-10 bg-primary-50 border border-primary-100 d-flex align-items-center justify-content-center"
                        id="eventModalIconContainer">
                        <i class="ri-calendar-event-fill text-xl text-primary-600" id="eventModalIcon"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="eventModalTitle">Event
                            Details</h6>
                        <small class="text-neutral-500 text-xs" id="eventModalCategory">General Event</small>
                    </div>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-24">

                <!-- Date Banner Card -->
                <div
                    class="p-16 radius-12 bg-neutral-50 border border-neutral-200 mb-20 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ri-time-line text-2xl text-primary-600"></i>
                        <div>
                            <span class="text-xs fw-bold text-uppercase tracking-wider text-neutral-500 d-block">Event
                                Schedule</span>
                            <span id="eventModalDate" class="text-sm fw-semibold text-neutral-800">August 15,
                                2026</span>
                        </div>
                    </div>
                    <div id="eventModalPriorityBadge">
                        <span
                            class="badge bg-danger-50 text-danger-600 border border-danger-100 px-12 py-6 radius-8 font-xs fw-semibold">High
                            Priority</span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="row gy-3 mb-20">
                    <!-- Location -->
                    <div class="col-12">
                        <div
                            class="p-12 radius-10 border border-neutral-200/80 bg-base d-flex align-items-start gap-3">
                            <i class="ri-map-pin-2-line text-lg text-neutral-400 mt-2"></i>
                            <div>
                                <span
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-500 d-block">Location</span>
                                <span id="eventModalLocation" class="text-sm fw-medium text-neutral-700">Main
                                    Auditorium</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="p-16 radius-12 border border-neutral-200 bg-base">
                    <span class="text-xs fw-bold text-uppercase tracking-wider text-neutral-500 d-block mb-8">
                        <i class="ri-file-text-line text-neutral-400 me-1"></i> Description
                    </span>
                    <p id="eventModalDescription" class="text-xs text-neutral-600 lh-lg mb-0">
                        No description provided.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- ================================ TEMPLATE TYPE MODAL ================================ --}}
<div class="modal fade" id="templateTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="templateTypeModalTitle">
                        Add Template Type
                    </h6>
                    <small class="text-neutral-500 text-xs">Create and manage template types</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="templateTypeForm" class="ajaxForm" data-url="{{ route('school.template.type.save') }}"
                data-refresh="fetchTemplateType" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="template_type_id" value="">


                <input type="hidden" name="status" id="sms_template_type_status_value" value="1">

                <div class="modal-body p-28">

                    <!-- Form Segment -->
                    <div class="form-segment mb-28">

                        <div class="row gy-4">

                            <!-- Template Type Name -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Template Type Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-file-list-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="template_type_name" name="name"
                                            placeholder="Enter template type name" maxlength="100" required>
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
                                <input type="checkbox" role="switch" id="template_type_status" value="1"
                                    checked class="module-active-toggle">
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
                        <i class="ri-save-3-line"></i> Save
                    </button>
                </div>
            </form>

            {{-- LIST --}}
            <div class="border-top border-neutral-200 bg-neutral-50 px-24 py-20">

                <h6 class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-16">
                    Template Type List
                </h6>

                <div class="table-responsive border border-neutral-200 radius-8 bg-white">
                    <table class="table align-middle mb-0">
                        <thead class="bg-neutral-100 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    #</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Status</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16 text-end"
                                    width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="templateTypeTableBody" class="divide-y divide-neutral-200">
                            <!-- Dynamic Rows -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- SMS TEMPLATE MODAL -->
<!-- ========================================================= -->

<div class="modal fade" id="smsTemplateModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Header -->
            {{-- <div class="modal-header bg-primary-600 px-4 py-3 border-0"> --}}

                <div class="modal-header border-bottom border-neutral-200 bg-neutral-50 px-24 py-16 justify-content-between align-items-center">
                <div class="px-16">
                    <h5 class="modal-title  fw-bold mb-1">
                        Add SMS Template
                    </h5>

                </div>

                {{-- <button type="button" class="btn-close btn-close-white premium-close-btn" data-bs-dismiss="modal">

                    <i class="ri-close-line"></i>

                </button> --}}

                <div>
                    <x-model-close />
                </div>

            </div>

            <!-- FORM -->
            <form id="smsTemplateForm" class="ajaxForm px-16 pt-16" enctype="multipart/form-data"
                data-url="{{ route('school.template.save') }}" data-refresh="fetchTemplate" data-method="POST">

                @csrf

                <input type="hidden" name="id" id="sms_template_id">

                <div class="modal-body p-4">

                    <div class="row g-4">

                        <!-- Template ID -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_id"
                                placeholder="Enter Template ID">
                        </div>

                        <!-- Template Title -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_title"
                                placeholder="Enter Template Title">
                        </div>

                        <!-- Template Type -->
                        <div class="col-md-6">


                            <select name="template_typeId" id="template_typeId"
                                class="form-control form-select radius-12">




                            </select>
                        </div>
                        <div class="col-md-6">


                            <select name="template_language" class="form-control form-select radius-12">
                                <option value="en" selected>English</option>
                                <option value="hi">Hindi</option>

                            </select>
                        </div>

                        <!-- Company -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_company"
                                placeholder="Enter Company Name">
                        </div>

                        <!-- Sender ID -->
                        <div class="col-md-6">


                            <input type="text" class="form-control radius-12" name="template_senderId"
                                placeholder="Enter Sender ID">
                        </div>

                        <!-- Status -->
                        <div class="col-md-12">


                            <select name="status" class="form-control form-select radius-12">
                                <option value="temporary" selected>Temporary</option>
                                <option value="permanent">Permanent</option>

                            </select>
                        </div>

                        <!-- SMS -->
                        <div class="col-12">

                            <textarea class="form-control radius-12" rows="6" name="sms" placeholder="Enter SMS Template"></textarea>
                        </div>

                    </div>

                </div>


                <!-- Footer -->
                <div class="modal-footer border-0 pt-16 px-4 pb-4 ">

                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-light radius-48 fw-bold d-inline-flex align-items-center border gap-2 px-2 py-1">

                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="ri-close-line "></i>
                        </div>

                        <span class="pe-4 me-2"> Cancel</span>
                    </button>


                    <button type="submit"
                        class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="ri-check-line text-primary-600"></i>
                        </div>

                        <span class="pe-4 me-2">Save</span>
                    </button>


                </div>
            </form>

        </div>
    </div>
</div>

{{-- ================================ Multiple Events (on same day) Modal ================================ --}}
<div class="modal fade" id="dayEventsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 radius-16 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header border-bottom border-neutral-200 bg-neutral-50 px-24 py-16 justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div
                        class="p-10 radius-10 bg-primary-50 border border-primary-100 d-flex align-items-center justify-content-center">
                        <i class="ri-calendar-todo-fill text-xl text-primary-600"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="dayEventsModalLabel">Events
                            on Selected Day</h6>
                        <small class="text-neutral-500 text-xs" id="dayEventsModalSubLabel">Multiple schedule
                            items</small>
                    </div>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Modal Body (Dynamic Items Container) -->
            <div class="modal-body p-24 max-h-450-px overflow-y-auto" id="dayEventsModalBody">
                <!-- Example Dynamic Rendered Event Card Item -->
                <div
                    class="event-card-item p-16 radius-12 border border-neutral-200 bg-base mb-12 hover-shadow-sm transition-all position-relative overflow-hidden">
                    <div class="position-absolute start-0 top-0 bottom-0 bg-primary-600" style="width: 4px;"></div>
                    <div class="d-flex align-items-center justify-content-between mb-8 ps-8">
                        <h6 class="text-sm fw-bold text-neutral-800 mb-0">Annual Sports Meet</h6>
                        <span
                            class="badge bg-warning-50 text-warning-700 border border-warning-100 px-8 py-4 radius-6 font-xxs">Holiday</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 ps-8 text-xs text-neutral-500">
                        <span><i class="ri-time-line me-1"></i> 09:00 AM - 02:00 PM</span>
                        <span>•</span>
                        <span><i class="ri-map-pin-2-line me-1"></i> Sports Ground</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Calendar Planning Modal Include --}}
@include('Calendar/calendar-event-type')

{{-- Calendar Planning Modal Include --}}
@include('Calendar/calendar-event')

{{-- Complaint Type Form Modal Include --}}
@include('School.Pages.Complaints.components.complaint-type-form-modal')

{{-- Complaint Type List Modal Include --}}
@include('School.Pages.Complaints.components.complaint-type-list-modal')

{{-- Student Complaint Modal Include --}}
@include('School.Pages.Complaints.components.student-complaint-form')

{{-- Staff Complaint Modal Include --}}
@include('School.Pages.Complaints.components.staff-complaint-form')

{{-- =============== ================ STYLE ================ ================ --}}

<style>
    .premium-input {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: none !important;
    }

    .premium-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, .08) !important;
    }
</style>

@push('script')
    <script>


        window.getHouseList = function() {

            $.ajax({

                url: "{{ route('school.house.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td class="text-end" >

                            
                                   <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editHouse  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteHouse">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#houseTableBody').html(rows);

                }

            });

        }

        window.getStreamList = function() {

            $.ajax({

                url: "{{ route('school.stream.master.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td class="text-end">


                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editStream  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteStream">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#streamTableBody').html(rows);

                }

            });

        }

        window.getConcessionByList = function() {

            $.ajax({

                url: "{{ route('school.concession.by.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td>

                              
                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editConcessionBy  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteConcessionBy">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#concessionByTableBody').html(rows);

                }

            });

        }

        window.getConcessionTypeList = function() {

            $.ajax({

                url: "{{ route('school.concession.type.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td>                                          
                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editConcessionType  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteConcessionType">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#concessionTypeTableBody').html(rows);

                }

            });

        }

        $(document).on('click', '.editHouse', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.house.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#house_id').val(res.data.id);

                        $('#house_name').val(res.data.name);

                        $('#house_slug').val(res.data.slug);

                        $('#house_status').prop('checked', res.data.status == 1);

                        $('#housesModal').modal('show');

                    }

                }

            });

        });

        $(document).on('click', '.editStream', function() {
            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.stream.master.get') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status) {
                        $('#stream_id').val(res.data.id);
                        $('#stream_name').val(res.data.name);
                        $('#stream_status').prop('checked', res.data.status == 1);
                        $('#stream_status_value').val(res.data.status);
                        $('#streamModal').modal('show');
                    }

                }

            });

        });

        $(document).on('change', '#stream_status', function() {
            $('#stream_status_value').val(this.checked ? 1 : 0);
        });

        $(document).on('change', '#concession_by_status', function() {
            $('#consession_by_status_value').val(this.checked ? 1 : 0);
        });

        $(document).on('change', '#template_type_status', function() {
            $('#sms_template_type_status_value').val(this.checked ? 1 : 0);
        });

        $(document).on('click', '.editConcessionBy', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.concession.by.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#concession_by_id').val(res.data.id);

                        $('#concession_by_name').val(res.data.name);

                        $('#concession_by_slug').val(res.data.slug);

                        $('#concessionByModal').modal('show');

                        $('#concession_by_status').prop('checked', res.data.status == 1);
                        $('#consession_by_status_value').val(res.data.status);

                    }

                }

            });

        });

        window.fetchTemplateType = function() {

            $.ajax({

                url: "{{ route('school.template.type.fetch') }}",
                method: "GET",

                success: function(res) {

                    let options = '';
                    let rows = '';

                    if (res.status && res.data.length > 0) {

                        options += `
                        <option value="">
                            --- Choose Template Type ---
                        </option>
                    `;

                        $.each(res.data, function(i, d) {

                            // select option
                            options += `
                            <option value="${d.id}">
                                ${d.name}
                            </option>
                        `;

                            // list
                            rows += `
                            <tr>
                                     <td>${i + 1}</td>

                                <td>
                                    ${d.name}
                                </td>
                                 <td>
                                    ${d.status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>'
                                    }
                                </td>
                                <td>
                                    <button
                                        type="button"
                                        data-id="${d.id}"
                                        class="editTemplateType">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button
                                        type="button"
                                        data-id="${d.id}"
                                        class="deleteTemplateType">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>


                                </td>

                            </tr>
                        `;
                        });

                    } else {

                        options += `
                        <option value="">
                            No Template Type Found
                        </option>
                    `;

                        rows += `
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                No Template Type Found
                            </td>
                        </tr>
                    `;
                    }

                    $('#template_typeId').html(options);

                    $('#templateTypeTableBody').html(rows);
                }
            });
        };

        $(document).on('click', '.editTemplateType', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.template.type.get') }}",
                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    let d = res.data;

                    $('#template_type_id').val(d.id);

                    $('#template_type_name').val(d.name);

                    // $('select[name="status"]').val(d.status);

                    $('#template_type_status').prop('checked', res.data.status == 1);
                    $('#sms_template_type_status_value').val(res.data.status);


                    $('#templateTypeModal').modal('show');

                }
            });

        });

        $(document).on('click', '.editConcessionType', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.concession.type.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#concession_type_id').val(res.data.id);

                        $('#concession_type_name').val(res.data.name);

                        $('#concession_type_slug').val(res.data.slug);

                        $('#concessionTypeModal').modal('show');

                    }

                }

            });

        });

        $('#housesModal').on('hidden.bs.modal', function() {

            $('#houseForm')[0].reset();

            $('#house_id').val('');

        });

        $('#streamModal').on('hidden.bs.modal', function() {

            $('#streamForm')[0].reset();

            $('#stream_id').val('');

        });

        $('#concessionByModal').on('hidden.bs.modal', function() {

            $('#concessionByForm')[0].reset();

            $('#concession_by_id').val('');

        });

        $('#concessionTypeModal').on('hidden.bs.modal', function() {

            $('#concessionTypeForm')[0].reset();

            $('#concession_type_id').val('');

        });

        $(document).ready(function() {

            getHouseList();

            getStreamList();

            getConcessionByList();

            getConcessionTypeList();

            fetchTemplateType();

        });
    </script>
@endpush
