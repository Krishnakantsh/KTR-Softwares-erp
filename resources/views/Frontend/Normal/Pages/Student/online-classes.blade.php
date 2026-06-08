@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Live Virtual Classroom Panel')

@section('dynamic-content')
    <div class="dashboard-main-body">

        <!-- SECTION 1: TOP PANEL - CREATION CONSOLE -->
        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon">
                        <i class="ri-video-add-line text-xl text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Online Class Creation Engine</h6>
                        <p class="text-xs text-muted mb-0">Provision and broadcast real-time virtual lectures seamlessly</p>
                    </div>
                </div>
                <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
                    <i class="ri-radar-line me-1 ripple-effect"></i> Server Sandbox Live
                </span>
            </div>

            <div class="card-body p-24">
                <form id="onlineClassForm" class="ajaxForm" enctype="multipart/form-data"
                    data-url="{{ route('student.online_classes.save') }}" data-refresh="fetchOnlineClasses"
                    data-method="POST" autocomplete="off">
                    @csrf
                    <div class="row gy-4">

                        <!-- Title Field -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Lecture
                                    Title <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-text-spacing addon-icon"></i>
                                    <input type="text" name="title" class="form-control custom-premium-input"
                                        placeholder="e.g. Advanced Calculus & Matrix Theory">
                                </div>
                            </div>
                        </div>

                        <!-- Target Class -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Target
                                    Class <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-git-repository-line addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="class_id"
                                        id="classSelect">
                                        <option value="" disabled selected>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section/Stream -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Section
                                    <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-team-line addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="section_id"
                                        id="sectionSelect">
                                        <option value="" disabled selected>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Section/Stream -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Stream <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-team-line addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="stream_id"
                                        id="sectionSelect">
                                        <option value="" disabled selected>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Subject Link -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Allocated
                                    Subject <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-book-open-line addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="subject_id"
                                        id="subjectSelect">
                                        <option value="" disabled selected>Select Subject</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Subject Link -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Current Status <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-book-open-line addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select" name="status"
                                        id="subjectSelect">
                                        <option value="scheduled" selected>Scheduled</option>
                                        <option value="ongoing">Ongoing</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Virtual Platform Trigger Custom Checkboxes -->
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box h-100">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">Streaming
                                    Platform <span class="text-danger">*</span></label>
                                <div class="d-flex flex-wrap gap-12">
                                    <label class="platform-tab-wrapper">
                                        <input type="radio" name="platform" value="google_meet" checked>
                                        <span class="platform-tile meet"><i class="ri-google-fill me-2"></i>Meet</span>
                                    </label>
                                    <label class="platform-tab-wrapper">
                                        <input type="radio" name="platform" value="zoom">
                                        <span class="platform-tile zoom"><i class="ri-video-chat-fill me-2"></i>Zoom</span>
                                    </label>
                                    <label class="platform-tab-wrapper">
                                        <input type="radio" name="platform" value="microsoft_teams">
                                        <span class="platform-tile teams"><i
                                                class="ri-microsoft-fill me-2"></i>Teams</span>
                                    </label>
                                    <label class="platform-tab-wrapper">
                                        <input type="radio" name="platform" value="other">
                                        <span class="platform-tile other"><i class="ri-link-m me-2"></i>Other</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Meeting Link -->
                        <div class="col-xl-5 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Meeting
                                    Broadcast URL</label>
                                <div class="inner-addon">
                                    <i class="ri-external-link-line addon-icon"></i>
                                    <input type="url" name="meeting_link" class="form-control custom-premium-input"
                                        placeholder="https://meet.google.com/abc-defg-hij">
                                </div>
                            </div>
                        </div>

                        <!-- Duration in Minutes -->
                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Duration
                                    (Minutes)</label>
                                <div class="inner-addon">
                                    <i class="ri-time-flash-line addon-icon"></i>
                                    <input type="number" name="duration" class="form-control custom-premium-input"
                                        placeholder="e.g. 45" min="5">
                                </div>
                            </div>
                        </div>

                        <!-- Meeting Credentials Block -->
                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Meeting
                                    ID (Optional)</label>
                                <div class="inner-addon">
                                    <i class="ri-keynote-line addon-icon"></i>
                                    <input type="text" name="meeting_id" class="form-control custom-premium-input"
                                        placeholder="ID Number">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Security
                                    Token/Password</label>
                                <div class="inner-addon">
                                    <i class="ri-lock-password-line addon-icon"></i>
                                    <input type="text" name="password" class="form-control custom-premium-input"
                                        placeholder="Passcode">
                                </div>
                            </div>
                        </div>

                        <!-- Date & Time Row -->
                        <div class="col-xl-3 col-md-4">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Execution
                                    Date <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-calendar-event-line addon-icon"></i>
                                    <input type="date" name="held_date" class="form-control custom-premium-input"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Start
                                    Time Timestamp <span class="text-danger">*</span></label>
                                <div class="inner-addon">
                                    <i class="ri-alarm-line addon-icon"></i>
                                    <input type="time" name="held_time" class="form-control custom-premium-input"
                                        value="09:00">
                                </div>
                            </div>
                        </div>

                        <!-- Description Box -->
                        <div class="col-12">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Lecture
                                    Outline & Instructions for Students</label>
                                <textarea name="description" class="form-control custom-premium-textarea" rows="2"
                                    placeholder="Provide assignment deadlines, prerequisites, or session overview objectives..."></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- Actions Panel -->
                    <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                        <button type="button" class="btn btn-premium-action-secondary" onclick="resetClassForm()">
                            <i class="ri-refresh-line me-2"></i> Clear Form
                        </button>
                        <button type="submit" class="btn btn-premium-action-primary" onclick="dispatchClassCreation()">
                            <i class="ri-broadcast-line me-2"></i> Dispatch Virtual Broadcast
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SECTION 2: BOTTOM PANEL - HISTORICAL & SCHEDULED REGISTRY -->
        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Live & Scheduled
                        Classroom Registry</h6>
                    <p class="text-xs text-muted mb-0">Real-time status metrics and administration endpoints</p>
                </div>

                <!-- Quick Search Filter Profile -->
                <div class="d-flex gap-3 align-items-center">
                    <div class="inner-addon" style="width: 240px;">
                        <i class="ri-search-2-line addon-icon"></i>
                        <input type="text" id="registrySearch"
                            class="form-control custom-premium-input registry-search-bar"
                            placeholder="Search lectures...">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive scrollable-class-registry">
                    <table class="table bordered-table align-middle mb-0 text-sm">
                        <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                            <tr>
                                <th scope="col" style="width: 60px;" class="text-center">S.No.</th>
                                <th scope="col">Class & Subject Info</th>
                                <th scope="col">Lecture Description Title</th>
                                <th scope="col" class="text-center">Gateway Platform</th>
                                <th scope="col">Schedule & Core Timeline</th>
                                <th scope="col" class="text-center">Manage Status</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center" style="width: 140px;">Operations</th>
                            </tr>
                        </thead>
                        <tbody id="classRegistryTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- FIXED & PREMIUM STYLING PATTERNS -->
    <style>
        .max-w-280 {
            max-width: 280px;
        }

        .premium-generator-card {
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .text-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-pulse-icon {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
        }

        /* --- THE LOGICAL FIXED ALIGNMENT SCHEMA FOR INPUTS & ICONS --- */
        .premium-input-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01);
            transition: all 0.3s ease;
        }

        .premium-input-box:focus-within {
            border-color: #7c3aed;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.08);
        }

        /* Absolute Inner Wrapper System */
        .inner-addon {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        /* Perfect Center Placement Blueprint */
        .inner-addon .addon-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #64748b;
            pointer-events: none;
            z-index: 10;
            transition: color 0.2s ease;
        }

        .premium-input-box:focus-within .addon-icon {
            color: #7c3aed;
        }

        /* Input Controls Left Padding Spacing Override */
        .custom-premium-input,
        .custom-premium-select {
            width: 100% !important;
            padding-left: 44px !important;
            padding-right: 14px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 600 !important;
            height: 44px;
            font-size: 0.9rem;
            color: #1e293b;
            background-color: #ffffff !important;
            display: block;
        }

        .custom-premium-select {
            appearance: none;
            -webkit-appearance: none;
        }

        .custom-premium-textarea {
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 500;
            font-size: 0.9rem;
            color: #1e293b;
            padding: 12px;
            width: 100%;
        }

        /* Dedicated Search Field Scale Modifier */
        .registry-search-bar {
            height: 38px !important;
            font-size: 0.85rem !important;
            padding-left: 40px !important;
        }

        .backend-action-bar {
            border-top: 1px dashed #e2e8f0;
            padding-top: 24px;
            margin-top: 12px;
        }

        /* --- MODERN PREMIUM ACTION BUTTON SYSTEM --- */
        .btn-premium-action-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 28px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.25);
            transition: all 0.25s ease-in-out;
            display: inline-flex;
            align-items: center;
        }

        .btn-premium-action-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
            filter: brightness(1.05);
        }

        .btn-premium-action-primary:active {
            transform: translateY(1px);
        }

        .btn-premium-action-secondary {
            background: #ffffff;
            color: #475569 !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 24px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-premium-action-secondary:hover {
            background: #f8fafc;
            color: #1e293b !important;
            border-color: #94a3b8;
        }

        /* Platform Selection Custom Design Tiles */
        .platform-tab-wrapper {
            cursor: pointer;
            flex: 1;
            min-width: 90px;
        }

        .platform-tab-wrapper input {
            position: absolute;
            opacity: 0;
        }

        .platform-tile {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 8px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            font-size: 0.82rem;
            font-weight: 700;
            color: #64748b;
            transition: all 0.2s ease;
            text-align: center;
        }

        .platform-tab-wrapper:hover .platform-tile {
            background: #f1f5f9;
        }

        .platform-tab-wrapper input:checked+.platform-tile.meet {
            border-color: #22c55e;
            color: #15803d;
            background: #dcfce7;
        }

        .platform-tab-wrapper input:checked+.platform-tile.zoom {
            border-color: #3b82f6;
            color: #1d4ed8;
            background: #dbeafe;
        }

        .platform-tab-wrapper input:checked+.platform-tile.teams {
            border-color: #6366f1;
            color: #4338ca;
            background: #e0e7ff;
        }

        .platform-tab-wrapper input:checked+.platform-tile.other {
            border-color: #0ea5e9;
            color: #0369a1;
            background: #e0f2fe;
        }

        /* Table Components Matrix */
        .scrollable-class-registry {
            max-height: 450px;
            overflow-y: auto;
        }

        .scrollable-class-registry::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-class-registry::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .scrollable-class-registry::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .platform-indicator {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
        }

        .badge-meet {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-zoom {
            background: #e3f2fd;
            color: #1565c0;
        }

        .badge-teams {
            background: #e8eaf6;
            color: #283593;
        }

        .badge-other {
            background: #e0f7fa;
            color: #00838f;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-scheduled {
            background: #fff3e0;
            color: #ef6c00;
        }

        .badge-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-cancelled {
            background: #ffebee;
            color: #c62828;
        }

        .badge-ongoing {
            background: #e1f5fe;
            color: #0277bd;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .pulse-dot {
            width: 6px;
            height: 6px;
            background: #0288d1;
            border-radius: 50%;
            display: inline-block;
            animation: pulse-animation 1.4s infinite;
        }

        @keyframes pulse-animation {
            0% {
                transform: scale(0.9);
                opacity: 1;
                box-shadow: 0 0 0 0 rgba(2, 136, 209, 0.7);
            }

            70% {
                transform: scale(1);
                opacity: 0.5;
                box-shadow: 0 0 0 6px rgba(2, 136, 209, 0);
            }

            100% {
                transform: scale(0.9);
                opacity: 1;
                box-shadow: 0 0 0 0 rgba(2, 136, 209, 0);
            }
        }
    </style>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Master dynamic dropdown components load triggers
            fetchClassMasters();
            fetchOnlineClasses();
        });

        function fetchClassMasters() {
            fetchMasterData("{{ route('school.class.master.fetch.with') }}", function(res) {
                let options = `<option value="" disabled selected>Select Class</option>`;
                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                $("#classSelect").html(options);
            });
        }

        // fetch stream
        fetchMasterData("{{ route('school.stream.master.fetch.with') }}", function(res) {
            let options = `<option value="">Select Stream</option>`;
            $.each(res.data, function(i, d) {
                options += `<option value="${d.id}">${d.name}</option>`;
            });
            $("select[name='stream_id']").html(options);
        });

        $(document).on("change", "#classSelect", function() {
            let class_id = $(this).val();
            if (!class_id) return;

            getDataById("{{ route('school.common.get_class_devisions_by_class_id') }}", class_id, function(res) {
                let options = `<option value="" disabled selected>Select Section</option>`;
                $.each(res.data, function(i, d) {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                $("#sectionSelect").html(options);
            });
        });


        window.fetchOnlineClasses = function() {
            fetchMasterData("{{ route('student.online_classes.fetch.with') }}", function(res) {
                let rows = '';

                $.each(res.data, function(index, d) {
                    let statusBadge = '';
                    let actionButtons = '';
                    let platformBadge = '';

                    const formattedDate = d.held_date ?
                        new Intl.DateTimeFormat('en-GB', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        }).format(new Date(d.held_date)) :
                        '-';

                    switch (d.platform) {
                        case 'google_meet':
                            platformBadge = `
                                <span class="platform-indicator badge-meet">
                                    <i class="ri-google-fill me-1"></i> Google Meet
                                </span>`;
                            break;

                        case 'zoom':
                            platformBadge = `
                                <span class="platform-indicator badge-zoom">
                                    <i class="ri-video-chat-fill me-1"></i> Zoom
                                </span>`;
                            break;

                        case 'microsoft_teams':
                            platformBadge = `
                                <span class="platform-indicator badge-teams">
                                    <i class="ri-microsoft-fill me-1"></i> MS Teams
                                </span>`;
                            break;

                        default:
                            platformBadge = `
                                <span class="badge bg-secondary">
                                    Other
                                </span>`;
                    }

                    switch (d.status) {
                        case 'scheduled':
                            statusBadge = `
                                <span class="status-badge badge-scheduled">
                                    Scheduled
                                </span>`;

                            actionButtons = `
                                <a href="${d.meeting_link ?? '#'}"
                                   target="_blank"
                                   class="btn btn-xs btn-outline-primary radius-6 py-4 px-8"
                                   title="Join Class">
                                    <i class="ri-external-link-line"></i>
                                </a>

                            `;
                            break;

                        case 'ongoing':
                            statusBadge = `
                                <span class="status-badge badge-ongoing">
                                    <span class="pulse-dot"></span>
                                    Ongoing
                                </span>`;

                            actionButtons = `
                                <a href="${d.meeting_link ?? '#'}"
                                   target="_blank"
                                   class="btn btn-xs text-xs btn-success d-flex radius-6 py-4 px-12">
                                    <i class="ri-play-circle-line me-2"></i>
                                    Connect
                                </a>
                            `;
                            break;

                        case 'completed':
                            statusBadge = `
                                <span class="status-badge badge-completed">
                                    Completed
                                </span>`;

                            actionButtons = `
                                <button class="btn btn-xs btn-outline-secondary radius-6 py-4 px-8" disabled>
                                    <i class="ri-check-line"></i>
                                </button>
                            
                            `;
                            break;

                        case 'cancelled':
                            statusBadge = `
                                <span class="status-badge badge-cancelled">
                                    Cancelled
                                </span>`;

                            actionButtons = `
                                <button class="btn btn-xs btn-outline-danger radius-6 py-4 px-8" disabled>
                                    <i class="ri-close-line"></i>
                                </button>
                                     <button
                                    type="button"
                                    class="btn btn-xs btn-outline-danger radius-6 py-4 px-8 deleteMeeting"  
                                    data-id="${d.id}"
                                    title="Cancel Class">
                                
                                      <i class="ri-delete-bin-fill"></i>
                                </button>
                            `;
                            break;
                    }

                    rows += `
                        <tr>
                            <td class="text-center fw-medium text-muted">${index + 1}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark-main">
                                        ${d.class?.name ?? '-'} - ${d.section?.name ?? '-'}
                                    </span>
                                    <span class="text-xs text-primary-600 fw-semibold">
                                        ${d.subject?.name ?? '-'}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="max-w-280">
                                    <h6 class="text-sm fw-bold text-dark-main mb-2">${d.title ?? '-'}</h6>
                                    <p class="text-xs text-muted text-truncate mb-0">${d.description ?? '-'}</p>
                                </div>
                            </td>
                            <td class="text-center">${platformBadge}</td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-xs fw-semibold text-dark-main">
                                        <i class="ri-calendar-check-line text-primary-500 me-1"></i>${formattedDate ?? '-'}
                                    </span>
                                    <span class="text-xs text-muted">
                                        <i class="ri-time-line me-1"></i>${d.held_time ?? '-'}
                                        <b class="text-dark-light">(${d.duration ?? 0} Mins)</b>
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">  
                                <div class="inner-addon">
                                    <i class="ri-book-open-line addon-icon"></i>
                                    <select class="form-control form-select custom-premium-select classListStatus" name="status"
                                       data-id="${d.id}" >
                                        <option value="scheduled" ${ d.status == 'scheduled' ? 'selected' :''} >Scheduled</option>
                                        <option value="ongoing" ${ d.status == 'ongoing' ? 'selected' :''} >Ongoing</option>
                                        <option value="completed" ${ d.status == 'completed' ? 'selected' :''} >Completed</option>
                                        <option value="cancelled" ${ d.status == 'cancelled' ? 'selected' :''} >Cancelled</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center">${statusBadge}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    ${actionButtons}
                                </div>
                            </td>
                        </tr>
                    `;
                });

                if (!rows) {
                    rows = `
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No Online Classes Found
                            </td>
                        </tr>
                    `;
                }

                $('#classRegistryTableBody').html(rows);
            });
        };


        $(document).on("change", ".classListStatus", function(e) {
            e.preventDefault();
            let meetingId = $(this).data("id");
            let status = $(this).val();
            let rowElement = $(this).closest("tr");

            let word = '';

            let message = '';

            switch (status) {

                case 'scheduled':
                    message = 'restore this cancelled online class';
                    break;

                case 'ongoing':
                    message = ' start this scheduled online class';
                    break;

                case 'completed':
                    message = 'end this ongoing online class';
                    break;

                case 'cancelled':
                    message = ' cancel this scheduled online class';
                    break;
            }

            if (confirm(`Are you absolutely sure you want to ${message}?`)) {

                // Action


                let originalBtnHtml = $(this).html();
                $(this).html(
                    `<div class="spinner-border spinner-border-sm text-danger" role="status" style="width: 12px; height: 12px;"></div>`
                ).attr("disabled", true);

                $.ajax({

                    url: "{{ route('student.online_classes.status') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "PUT",
                        status: status,
                        'id': meetingId
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === true || res.success === true) {

                            fetchOnlineClasses();


                            if (typeof alertClassSuccess !== "undefined") {

                                showToast('success', "Class cancelled successfully");
                            } else {

                                showToast('success', "Lecture state updated to: Cancelled");
                            }
                        } else {
                            showToast('error',
                                "Something went wrong while processing deployment purge.");


                            rowElement.find(".cancelMeeting").html(originalBtnHtml).attr("disabled",
                                false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(" Purge Request Error:", xhr.responseText);

                        showToast('error',
                            "Server interaction error. Unable to cancel meeting module.");

                        rowElement.find(".cancelMeeting").html(originalBtnHtml).attr("disabled", false);
                    }
                });
            }
        });




        $("#registrySearch").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#classRegistryTableBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endpush
