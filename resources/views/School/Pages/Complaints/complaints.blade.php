@extends('School.Layout.main')

@section('title', 'KTR ERP : Complaint Dashboard')

@section('dynamic-content')

    @php
        $urlType = request('type', 'student');
    @endphp

    <div class="dashboard-main-body py-24 px-16">

        <div class="row gy-4">

            <!-- Section 1: Dashboard Overview Header & Stats -->
            <div class="col-xxl-12">
                <div class="card">
                    <div
                        class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                        <div class="d-flex flex-column">
                            <h6 class="mb-2 fw-bold text-lg">Complaint Dashboard</h6>
                            <p class="text-secondary-light mb-0">
                                Welcome back 👋 Monitor complaints, resolutions and activities.
                            </p>
                        </div>
                    </div>

                    <!-- Stats Bar -->
                    <div class="bg-base rounded-3 p-20">
                        <div class="row g-3">
                            <!-- Total Complaints -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-12">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-file-warning-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Total
                                                        Complaints</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0">154</h6>
                                            <p class="text-sm mb-0 mt-1"><span class="badge bg-success">+12%</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Open -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-13">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-warning-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-error-warning-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Open</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-warning">21</h6>
                                            <p class="text-sm mb-0 mt-1">Waiting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- In Progress -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-14">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-info flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-loader-4-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">In Progress</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-info">09</h6>
                                            <p class="text-sm mb-0 mt-1">Investigating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Resolved -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-15">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-success flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-checkbox-circle-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Resolved</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-success">104</h6>
                                            <p class="text-sm mb-0 mt-1">Completed</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Closed -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-10">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-dark flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-lock-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Closed</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0">20</h6>
                                            <p class="text-sm mb-0 mt-1">Archived</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Critical -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-11">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-danger flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-alarm-warning-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Critical</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-danger">04</h6>
                                            <p class="text-sm mb-0 mt-1">Immediate Action</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Quick Actions -->
            <div class="col-xxl-12">
                <div class="card h-100">
                    <div
                        class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                        <h6 class="mb-2 fw-bold text-lg">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-2">
                                <div class="border rounded-3 p-12">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#complaintTypeListModal"
                                        class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center w-100">
                                        <i class="ri-price-tag-3-line me-1"></i> Complaint Types
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="border rounded-3 p-12">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#complaintTypeModal"
                                        class="btn btn-primary-600 d-flex align-items-center gap-6 px-16 flex-grow-1 justify-content-center w-100">
                                        <i class="ri-add-circle-line me-1"></i> Complaint Type
                                    </button>
                                </div>
                            </div>
                            @if ($urlType === 'student')
                                <div class="col-sm-2">
                                    <div class="border rounded-3 p-12">
                                        <a href="{{ route('school.complaint.index', ['type' => 'staff']) }}"
                                            class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center w-100">
                                            Staff Complaints
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-2">
                                    <div class="border rounded-3 p-12">
                                        <a href="{{ route('school.complaint.index', ['type' => 'student']) }}"
                                            class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center w-100">
                                            Student Complaints
                                        </a>
                                    </div>
                                </div>
                            @endIf

                            <div class="col-sm-3">
                                <div class="border rounded-3 p-12">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#staffComplaintModal"
                                        class="btn btn-primary-600 d-flex align-items-center gap-6 px-16 flex-grow-1 justify-content-center w-100">
                                        <i class="ri-add-circle-line me-1"></i> Raise Staff Complaint
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded-3 p-12">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#studentComplaintModal"
                                        class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center w-100">
                                        <i class="ri-add-circle-line me-1"></i> Raise Student Complaint
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xxl-12">
                <div class="card radius-12 border-0 shadow-sm">

                    <!-- Tabs Navigation Header -->
                    <div class="card-header  border-bottom border-neutral-200 px-24 py-16">
                        <ul class="nav nav-pills custom-pills gap-12" id="complaintTabs" role="tablist">
                            @if ($urlType === 'staff')
                                <!-- Staff Tabs -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active px-20 py-10 radius-8 fw-semibold text-sm"
                                        id="against-staff-tab" data-bs-toggle="tab" data-bs-target="#against-staff"
                                        type="button" role="tab">
                                        <i class="ri-user-unfollow-line me-1"></i> Complaint Against Staff
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-20 py-10 radius-8 fw-semibold text-sm" id="by-staff-tab"
                                        data-bs-toggle="tab" data-bs-target="#by-staff" type="button" role="tab">
                                        <i class="ri-user-shared-line me-1"></i> Complaints By Staff
                                    </button>
                                </li>
                            @else
                                <!-- Student Tabs -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active px-20 py-10 radius-8 fw-semibold text-sm"
                                        id="against-student-tab" data-bs-toggle="tab" data-bs-target="#against-student"
                                        type="button" role="tab">
                                        <i class="ri-user-voice-line me-1"></i> Complaint Against Student
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-20 py-10 radius-8 fw-semibold text-sm" id="by-student-tab"
                                        data-bs-toggle="tab" data-bs-target="#by-student" type="button" role="tab">
                                        <i class="ri-file-user-line me-1"></i> Complaints By Students
                                    </button>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Tab Contents -->
                    <div class="card-body p-24">
                        <div class="tab-content" id="complaintTabsContent">

                            @if ($urlType === 'staff')
                                <!-- Tab 1: Complaint Against Staff -->
                                {{-- <div class="tab-pane fade show active" id="against-staff" role="tabpanel">
                                    <div class="row gy-4">
                                        <!-- Sample Card Item -->
                                        <div class="col-xl-4 col-md-6">
                                            <div
                                                class="card radius-12 border border-neutral-200 hover-shadow-md transition-all h-100">
                                                <div class="card-body p-20 d-flex flex-column justify-content-between">
                                                    <div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-12">
                                                            <span
                                                                class="badge bg-danger-100 text-danger-600 font-semibold px-10 py-4 radius-6 text-xs">High
                                                                Priority</span>
                                                            <span
                                                                class="badge bg-warning-100 text-warning-600 font-semibold px-10 py-4 radius-6 text-xs">Open</span>
                                                        </div>
                                                        <h6 class="fw-bold text-neutral-800 text-md mb-8">Unprofessional
                                                            Behavior</h6>
                                                        <p class="text-xs text-neutral-500 mb-16 line-clamp-2">Late
                                                            response to parent queries and missing syllabus logs for section
                                                            A.</p>

                                                        <div
                                                            class="border-top border-neutral-100 pt-12 d-flex align-items-center justify-content-between text-xs">
                                                            <div>
                                                                <span class="text-neutral-400 d-block">Staff Target</span>
                                                                <strong class="text-neutral-700">Mr. R.K. Verma
                                                                    (Maths)</strong>
                                                            </div>
                                                            <div class="text-end">
                                                                <span class="text-neutral-400 d-block">Date</span>
                                                                <strong class="text-neutral-700">01 Aug 2026</strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="pt-16 mt-16 border-top border-neutral-100 d-flex align-items-center justify-content-between">
                                                        <span class="text-xs text-neutral-400"><i
                                                                class="ri-chat-3-line"></i> 3 messages</span>
                                                        <button type="button"
                                                            class="btn btn-primary-50 text-primary-600 hover-bg-primary-600 hover-text-white btn-sm px-16 py-6 radius-8 text-xs fw-semibold transition-all open-conversation-btn"
                                                            data-id="101">
                                                            View Conversation <i class="ri-arrow-right-line ms-1"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 2: Complaints By Staff -->
                                <div class="tab-pane fade" id="by-staff" role="tabpanel">
                                    <div class="row gy-4">
                                        <div class="col-12 text-center py-32 text-neutral-400">
                                            No complaints raised by staff yet.
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="tab-pane fade show active" id="against-staff" role="tabpanel">
                                    <div class="row gy-4" id="against-staff-list">
                                        <!-- JS se fill hoga -->
                                    </div>
                                </div>

                                <!-- Tab 2: Complaints By Staff -->
                                <div class="tab-pane fade" id="by-staff" role="tabpanel">
                                    <div class="row gy-4" id="by-staff-list"></div>
                                </div>
                            @else
                                <!-- Tab 3: Complaint Against Student -->
                                {{-- <div class="tab-pane fade show active" id="against-student" role="tabpanel">
                                    <div class="row gy-4">
                                        <div class="col-xl-4 col-md-6">
                                            <div
                                                class="card radius-12 border border-neutral-200 hover-shadow-md transition-all h-100">
                                                <div class="card-body p-20 d-flex flex-column justify-content-between">
                                                    <div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-12">
                                                            <span
                                                                class="badge bg-warning-100 text-warning-700 font-semibold px-10 py-4 radius-6 text-xs">Medium
                                                                Priority</span>
                                                            <span
                                                                class="badge bg-info-100 text-info-600 font-semibold px-10 py-4 radius-6 text-xs">In
                                                                Progress</span>
                                                        </div>
                                                        <h6 class="fw-bold text-neutral-800 text-md mb-8">Incomplete
                                                            Homework Issue</h6>
                                                        <p class="text-xs text-neutral-500 mb-16 line-clamp-2">Student has
                                                            consistently missed homework submission for physics class.</p>

                                                        <div
                                                            class="border-top border-neutral-100 pt-12 d-flex align-items-center justify-content-between text-xs">
                                                            <div>
                                                                <span class="text-neutral-400 d-block">Student
                                                                    Target</span>
                                                                <strong class="text-neutral-700">Rahul Sharma (10th
                                                                    A)</strong>
                                                            </div>
                                                            <div class="text-end">
                                                                <span class="text-neutral-400 d-block">Date</span>
                                                                <strong class="text-neutral-700">30 Jul 2026</strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="pt-16 mt-16 border-top border-neutral-100 d-flex align-items-center justify-content-between">
                                                        <span class="text-xs text-neutral-400"><i
                                                                class="ri-chat-3-line"></i> 5 messages</span>
                                                        <button type="button"
                                                            class="btn btn-primary-50 text-primary-600 hover-bg-primary-600 hover-text-white btn-sm px-16 py-6 radius-8 text-xs fw-semibold transition-all open-conversation-btn"
                                                            data-id="102">
                                                            View Conversation <i class="ri-arrow-right-line ms-1"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Tab 3: Complaint Against Student -->
                                <div class="tab-pane fade show active" id="against-student" role="tabpanel">
                                    <div class="row gy-4" id="against-student-list"></div>
                                </div>

                                <!-- Tab 4: Complaints By Students -->
                                <div class="tab-pane fade" id="by-student" role="tabpanel">
                                    <div class="row gy-4" id="by-student-list"></div>
                                </div>

                                <!-- Tab 4: Complaints By Students -->
                                <div class="tab-pane fade" id="by-student" role="tabpanel">
                                    <div class="row gy-4">
                                        <div class="col-12 text-center py-32 text-neutral-400">
                                            No complaints raised by students yet.
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Include Conversation Modal Component -->

    @include('School.Pages.Complaints.components.complaint-conversation-model')

@endsection

@push('styles')
    <style>
        .custom-pills .nav-link {
            background-color: #f1f5f9;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .custom-pills .nav-link.active {
            background-color: #4a5bf6 !important;
            color: #ffffff !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {

            fetchComplaintsList();

            function getPriorityBadge(priority) {
                switch (parseInt(priority)) {
                    case 1:
                        return '<span class="badge bg-success-100 text-success-600 font-semibold px-10 py-4 radius-6 text-xs">Low Priority</span>';
                    case 2:
                        return '<span class="badge bg-warning-100 text-warning-700 font-semibold px-10 py-4 radius-6 text-xs">Medium Priority</span>';
                    case 3:
                        return '<span class="badge bg-danger-100 text-danger-600 font-semibold px-10 py-4 radius-6 text-xs">High Priority</span>';
                    default:
                        return '<span class="badge bg-secondary-100 text-secondary-600 font-semibold px-10 py-4 radius-6 text-xs">N/A</span>';
                }
            }

            function getStatusBadge(status) {
                switch (parseInt(status)) {
                    case 1:
                        return '<span class="badge bg-warning-100 text-warning-600 font-semibold px-10 py-4 radius-6 text-xs">Open</span>';
                    case 2:
                        return '<span class="badge bg-info-100 text-info-600 font-semibold px-10 py-4 radius-6 text-xs">In Progress</span>';
                    case 3:
                        return '<span class="badge bg-success-100 text-success-600 font-semibold px-10 py-4 radius-6 text-xs">Resolved</span>';
                    case 4:
                        return '<span class="badge bg-dark-100 text-dark-600 font-semibold px-10 py-4 radius-6 text-xs">Closed</span>';
                    default:
                        return '<span class="badge bg-secondary-100 text-secondary-600 font-semibold px-10 py-4 radius-6 text-xs">Unknown</span>';
                }
            }

            function formatDate(dateStr) {
                let d = new Date(dateStr);
                return d.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }



            // Function to render complaints in 2-card per row grid format
            function renderStudentComplaints(complaints, targetContainerId) {
                let html = '';

                if (!complaints || complaints.length === 0) {
                    html = `
                    <div class="col-12 text-center py-32 text-neutral-400">
                        <i class="ri-inbox-archive-line fs-1 d-block mb-2 text-neutral-300"></i>
                        No complaints available.
                    </div>`;
                    $(`#${targetContainerId}`).html(html);
                    return;
                }

                complaints.forEach(function(item) {
                    let student = item.person_details || {};
                    let complaintType = item.complaint_type ? item.complaint_type.type_name : 'General';

                    // Priority Badge Logic
                    let priorityBadge = '';
                    if (item.priority == 2) {
                        priorityBadge = `<span class="badge bg-warning-50 text-warning-600 border border-warning-200 font-medium px-10 py-4 radius-6 text-xs d-flex align-items-center gap-1">
                                <span class="w-6-px h-6-px rounded-circle bg-warning-500"></span> Medium Priority
                             </span>`;
                    } else if (item.priority == 3) {
                        priorityBadge = `<span class="badge bg-danger-50 text-danger-600 border border-danger-200 font-medium px-10 py-4 radius-6 text-xs d-flex align-items-center gap-1">
                                <span class="w-6-px h-6-px rounded-circle bg-danger-500"></span> High Priority
                             </span>`;
                    } else {
                        priorityBadge = `<span class="badge bg-info-50 text-info-600 border border-info-200 font-medium px-10 py-4 radius-6 text-xs d-flex align-items-center gap-1">
                                <span class="w-6-px h-6-px rounded-circle bg-info-500"></span> Normal
                             </span>`;
                    }

                    // Student Photo Logic (Fallback Name Initial Image agar photo missing ho)
                    let studentName = `${student.first_name || ''} ${student.last_name || ''}`.trim() ||
                        'N/A';
                    let studentPhoto = '';
                    if (student.student_photo) {
                        studentPhoto =
                            `<img src="/${student.student_photo}" alt="${studentName}" class="w-48-px h-48-px rounded-circle object-fit-cover ring-2 ring-primary-100 flex-shrink-0">`;
                    } else {
                        let firstLetter = student.first_name ? student.first_name.charAt(0).toUpperCase() :
                            'S';
                        studentPhoto = `<div class="w-48-px h-48-px rounded-circle bg-primary-50 text-primary-600 fw-bold d-flex align-items-center justify-content-center text-md flex-shrink-0">
                                ${firstLetter}
                            </div>`;
                    }

                    // Class and Section Info
                    let className = student.class_master ? student.class_master.name : 'N/A';
                    let sectionName = student.section ? student.section.name : '';
                    let classDetails = `${className} ${sectionName ? '(' + sectionName + ')' : ''}`;

                    // Date Format
                    let createdDate = item.created_at ? new Date(item.created_at).toLocaleDateString(
                        'en-GB', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        }) : '';

                    // Card HTML Structure (col-md-6 for 2 cards per row)
                    html += `
                    <div class="col-xl-6 col-md-6">
                        <div class="card radius-12 border border-neutral-200 shadow-sm hover-shadow-md transition-all h-100 p-16">
                            <!-- Top Header: Complaint No & Priority -->
                            <div class="d-flex align-items-center justify-content-between pb-12 border-bottom border-neutral-100 mb-12">
                                <span class="badge bg-neutral-100 text-neutral-700 fw-bold text-xs px-10 py-4 radius-4">
                                    ${item.complaint_no}
                                </span>
                                ${priorityBadge}
                            </div>

                            <!-- Student Info Box -->
                            <div class="d-flex align-items-center gap-3 bg-neutral-50 p-12 radius-8 border border-neutral-100 mb-12">
                                ${studentPhoto}
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="text-sm fw-bold text-neutral-800 mb-1 text-truncate">${studentName}</h6>
                                    <div class="d-flex align-items-center gap-2 flex-wrap text-xs text-neutral-500">
                                        <span>Class: <strong class="text-neutral-700">${classDetails}</strong></span>
                                        <span>•</span>
                                        <span>Roll: <strong class="text-neutral-700">${student.roll_no || 'N/A'}</strong></span>
                                    </div>
                                    <div class="text-xs text-neutral-400 mt-1">
                                        Adm No: <span class="fw-medium text-neutral-600">${student.admission_no || 'N/A'}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Complaint Subject & Type -->
                            <div class="mb-12">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <h6 class="text-sm fw-bold text-neutral-800 mb-0">${item.subject}</h6>
                                    <span class="badge bg-primary-50 text-primary-600 text-xs radius-4 px-8 py-2">
                                        ${complaintType}
                                    </span>
                                </div>
                                <p class="text-xs text-neutral-500 line-clamp-2 mb-0">
                                    ${item.description || 'No description provided.'}
                                </p>
                            </div>

                            <!-- Card Footer: Date & Conversation Button -->
                            <div class="pt-12 border-top border-neutral-100 d-flex align-items-center justify-content-between text-xs mt-auto">
                                <span class="text-neutral-400 d-flex align-items-center gap-1">
                                    <i class="ri-time-line"></i> ${createdDate}
                                </span>
                         
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <button type="button" data-id="${item.id}"
                                            class="editComplaint btn  btn-primary-50 text-primary-600 hover-bg-primary-600 hover-text-white  px-12 py-6  radius-6 transition-all border-0"
                                            title="Edit">
                                            <i class="ri-pencil-line"></i>
                                        </button>

                                        <button type="button" data-id="${item.id}"
                                            class="deleteComplaint btn btn-danger-100 text-danger-600 hover-bg-danger-600 hover-text-white  px-12 py-6  radius-6 transition-all border-0"
                                            title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>

                                        <button type="button"
                                            class="btn btn-primary-50 text-primary-600 hover-bg-primary-600 hover-text-white btn-sm px-12 py-8 radius-8 text-xs fw-semibold transition-all open-conversation-btn"
                                            data-id="${item.id}">
                                            View Conversation <i class="ri-arrow-right-line ms-1"></i>
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                `;
                });

                $(`#${targetContainerId}`).html(html);
            }

            function fetchComplaintsList() {
                fetchMasterData("{{ route('school.complaint.fetch.with') }}", function(res) {
                    // if (res.status && res.data.length > 0) {
                    //     renderComplaints(res.data);

                    //     fetchComplaintsList
                    // } 
                    if (res.status && res.data) {

                        // Tab 3: Complaints Against Student container me 2-card view render karo
                        renderStudentComplaints(res.data, 'against-student-list');

                        // Tab 4: Complaints By Student me render karne ke liye:
                        renderStudentComplaints(res.data_by_student, 'by-student-list');

                    } else {
                        $('#against-staff-list, #by-staff-list, #against-student-list, #by-student-list')
                            .html(
                                '<div class="col-12 text-center py-32 text-neutral-400">No complaints found.</div>'
                            );
                    }
                });
            }


            /*
            |--------------------------------------------------------------------------
            | Edit Complaint -> against_type ke hisaab se sahi modal khole with data
            |--------------------------------------------------------------------------
            */
            $(document).on('click', '.editComplaint', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('school.complaint.get.with') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (!res.status || !res.data) return;

                        let d = res.data;

                        if (d.against_type == 3) {
                            openStudentComplaintEdit(d);
                        } else if (d.against_type == 2) {
                            openStaffComplaintEdit(d);
                        }
                    }
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Student Complaint Edit -> Populate + Open studentComplaintModal
            |--------------------------------------------------------------------------
            */
            function openStudentComplaintEdit(d) {
                let $modal = $('#studentComplaintModal');

                $('#studentComplaintModalTitle').text('Edit Student Complaint');

                $modal.find('#complaint_id').val(d.id);
                $modal.find('#complaint_student_id').val(d.against_id);

                // Student info strip (person_details already aa raha hai showWith se)
                let student = d.person_details || {};
                $('#complaintStudentInfoStrip').removeClass('d-none');
                $('#complaintStudentName').text(`${student.first_name || ''} ${student.last_name || ''}`.trim() ||
                    'N/A');
                $('#complaintStudentAdm').text(student.admission_no || '-');
                $('#complaintStudentClass').text(
                    (student.class_master ? student.class_master.name : '-') + ' / ' +
                    (student.section ? student.section.name : '-')
                );
                if (student.student_photo) {
                    $('#complaintStudentPhoto').attr('src', '/' + student.student_photo);
                }

                // Complaint Types load karo (Student = complaint_for 3), aur saved type select kar do
                let $typeSelect = $modal.find('#complaint_type_select');
                $typeSelect.prop('disabled', true).html('<option value="" selected disabled>Loading...</option>');

                fetchMasterData("{{ route('school.complaintType.fetch') }}", function(res) {
                    let types = (res.data || []).filter(t => t.complaint_for == 3 && t.status == 1);

                    let options = '<option value="" selected disabled>Select Complaint Type</option>';
                    types.forEach(function(t) {
                        let isSelected = (t.id == d.complaint_type_id) ? 'selected' : '';
                        options +=
                            `<option value="${t.id}" data-priority="${t.default_priority}" ${isSelected}>${t.type_name}</option>`;
                    });

                    $typeSelect.html(options).prop('disabled', types.length === 0);
                });

                $modal.find('#complaint_priority').val(d.priority);
                $modal.find('#complaint_subject').val(d.subject);
                $modal.find('#complaint_desc').val(d.description);
                $modal.find('#complaint_status').prop('checked', d.status_flag == 1);

                $modal.modal('show');
            }

            /*
            |--------------------------------------------------------------------------
            | Staff Complaint Edit -> Populate + Open staffComplaintModal
            |--------------------------------------------------------------------------
            */
            function openStaffComplaintEdit(d) {
                let $modal = $('#staffComplaintModal');

                $('#staffComplaintModalTitle').text('Edit Staff Complaint');

                $modal.find('#complaint_id').val(d.id);
                $modal.find('#complaint_staff_id').val(d.against_id);

                // NOTE: Staff detail fetch route abhi "#" (placeholder) hai staffComplaintModal me,
                // isliye info strip abhi auto-fill nahi ho payega jab tak wo backend route ban na jaye.

                let $typeSelect = $modal.find('#complaint_type_select');
                $typeSelect.prop('disabled', true).html('<option value="" selected disabled>Loading...</option>');

                fetchMasterData("{{ route('school.complaintType.fetch') }}", function(res) {
                    let types = (res.data || []).filter(t => t.complaint_for == 2 && t.status == 1);

                    let options = '<option value="" selected disabled>Select Complaint Type</option>';
                    types.forEach(function(t) {
                        let isSelected = (t.id == d.complaint_type_id) ? 'selected' : '';
                        options +=
                            `<option value="${t.id}" data-priority="${t.default_priority}" ${isSelected}>${t.type_name}</option>`;
                    });

                    $typeSelect.html(options).prop('disabled', types.length === 0);
                });

                $modal.find('#complaint_priority').val(d.priority);
                $modal.find('#complaint_subject').val(d.subject);
                $modal.find('#complaint_desc').val(d.description);
                $modal.find('#complaint_status').prop('checked', d.status_flag == 1);

                $modal.modal('show');
            }



        });
    </script>
@endpush
