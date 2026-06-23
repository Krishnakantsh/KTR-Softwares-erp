<style>
    .bg-slate-50\/50 {
        background-color: rgba(248, 250, 252, 0.5);
    }

    .bg-slate-50 {
        background-color: #f8fafc;
    }

    .text-warning-700 {
        color: #b45309;
    }

    .text-danger-600 {
        color: #dc2626;
    }

    .text-success-600 {
        color: #16a34a;
    }

    .focus-within-glow:focus-within {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15) !important;
    }

    .profile-glow-accent::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, #7c3aed, #4f46e5);
    }

    .horizontal-premium-row-card {
        background-color: #ffffff;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s ease;
    }

    .horizontal-premium-row-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04) !important;
    }

    /* Overdue Aggressive Styling Override */
    .horizontal-premium-row-card.card-state-overdue {
        border-color: rgba(239, 68, 68, 0.35) !important;
        background: linear-gradient(180deg, #ffffff 0%, #fef2f2 100%) !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.03) !important;
    }

    .btn-premium-return-action,
    .btn-premium-renew-action {
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-premium-return-action {
        background-color: #ecfdf5;
        color: #065f46;
    }

    .btn-premium-return-action:hover {
        background-color: #10b981;
        color: #ffffff;
    }

    .btn-premium-return-action.active-control {
        background-color: #10b981 !important;
        color: #ffffff !important;
    }

    .btn-premium-renew-action {
        background-color: #fffbeb;
        color: #92400e;
    }

    .btn-premium-renew-action:hover {
        background-color: #f59e0b;
        color: #ffffff;
    }

    .btn-premium-renew-action.active-control {
        background-color: #f59e0b !important;
        color: #ffffff !important;
    }

    .premium-inline-input {
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .premium-inline-input:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .blob-bg-shape {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 140px;
        height: 140px;
        background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 43% 57% 41% 59% / 57% 45% 55% 43%;
    }

    .animate-spin-slow {
        animation: spin-slow 12s linear infinite;
    }

    @keyframes spin-slow {
        from {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        to {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    .pulse-dot-red {
        width: 6px;
        height: 6px;
        background-color: #ef4444;
        border-radius: 50%;
        animation: pulse-fx 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse-fx {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: .4;
            transform: scale(1.2);
        }
    }

    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid #e2e8f0 !important;
        }
    }

    @media (max-width: 576px) {
        .text-center-sm {
            text-align: center !important;
        }
    }

    .premium-search-box-wrapper.rounded-pill {
        border-radius: 50px !important;
        padding-left: 12px !important;
    }

    .premium-icon-glow-ring {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #ffffff;
        position: relative;
        border: 1px solid rgba(226, 232, 240, 0.8);
        z-index: 1;
        overflow: hidden;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(124, 58, 237, 0.04);
    }

    .premium-icon-glow-ring::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        padding: 3px;
        background: conic-gradient(#7c3aed, #3b82f6, #10b981, #f59e0b, #ef4444, #7c3aed);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        animation: premium-smooth-spin 4s linear infinite;
        opacity: 0.8;
    }

    @keyframes premium-smooth-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .search-mascot-wrapper {
        min-width: 90px;
        height: 70px;
        justify-content: flex-end;
    }

    .mascot-character {
        width: 50px;
        height: 45px;
        background: linear-gradient(135deg, #a78bfa, #7c3aed);
        border-radius: 25px 25px 10px 10px;
        position: relative;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
        animation: mascot-bounce 3s ease-in-out infinite;
    }

    .mascot-eyes {
        position: absolute;
        top: 14px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
    }

    .mascot-pupil {
        width: 10px;
        height: 14px;
        background: #ffffff;
        border-radius: 50%;
        position: relative;
    }

    .mascot-pupil::after {
        content: '';
        position: absolute;
        width: 5px;
        height: 5px;
        background: #1e1b4b;
        border-radius: 50%;
        top: 3px;
        left: 2px;
        animation: mascot-look 4s ease-in-out infinite;
    }

    .mascot-bubble {
        position: absolute;
        top: -16px;
        background: #1e293b;
        color: #ffffff;
        font-size: 10px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 6px;
        white-space: nowrap;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        animation: bubble-pulse 3s ease-in-out infinite;
    }

    .mascot-bubble::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 4px 4px 0;
        border-style: solid;
        border-color: #1e293b transparent;
    }

    @keyframes mascot-bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    @keyframes mascot-look {

        0%,
        100% {
            transform: translate(0, 0);
        }

        25% {
            transform: translate(2px, 1px);
        }

        75% {
            transform: translate(-2px, 1px);
        }
    }

    @keyframes bubble-pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .premium-empty-state-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%) !important;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.04), 0 0 0 1px rgba(124, 58, 237, 0.02) !important;
        border-color: #e2e8f0 !important;
    }

    .premium-core-glow {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
        border: 2px solid #ffffff;
        box-shadow: inset 0 4px 10px rgba(0, 0, 0, 0.03), 0 10px 25px -5px rgba(124, 58, 237, 0.1) !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-empty-state-card:hover .premium-core-glow {
        transform: scale(1.03);
        box-shadow: inset 0 4px 10px rgba(124, 58, 237, 0.05), 0 15px 30px -5px rgba(124, 58, 237, 0.2) !important;
    }

    .premium-icon-neon {
        background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all 0.4s ease;
    }

    .premium-empty-state-card:hover .premium-icon-neon {
        background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .radar-pulse-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        border: 1px solid rgba(124, 58, 237, 0.2);
        pointer-events: none;
        z-index: 1;
    }

    .pulse-1 {
        width: 140px;
        height: 140px;
        animation: radar-wave 3s linear infinite;
    }

    .pulse-2 {
        width: 140px;
        height: 140px;
        animation: radar-wave 3s linear infinite 1s;
    }

    .pulse-3 {
        width: 140px;
        height: 140px;
        animation: radar-wave 3s linear infinite 2s;
    }

    @keyframes radar-wave {
        0% {
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 1;
        }

        100% {
            transform: translate(-50%, -50%) scale(1.6);
            opacity: 0;
            border-color: rgba(79, 70, 229, 0);
        }
    }

    .laser-scanner-line {
        position: absolute;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #7c3aed, transparent);
        top: 0;
        left: 0;
        z-index: 3;
        opacity: 0.7;
        animation: laser-move 2.5s ease-in-out infinite;
    }

    @keyframes laser-move {

        0%,
        100% {
            top: 15%;
            opacity: 0.3;
        }

        50% {
            top: 85%;
            opacity: 0.9;
        }
    }

    .tech-particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background-color: #c084fc;
        border-radius: 50%;
        z-index: 2;
        opacity: 0.6;
    }

    .tech-particle.p-1 {
        top: 10%;
        left: 80%;
        animation: float-particle-1 4s ease-in-out infinite;
    }

    .tech-particle.p-2 {
        bottom: 15%;
        left: 10%;
        animation: float-particle-2 4s ease-in-out infinite;
    }

    @keyframes float-particle-1 {

        0%,
        100% {
            transform: translateY(0) scale(1);
            opacity: 0.4;
        }

        50% {
            transform: translateY(-12px) scale(1.2);
            opacity: 0.8;
        }
    }

    @keyframes float-particle-2 {

        0%,
        100% {
            transform: translateY(0) scale(1);
            opacity: 0.5;
        }

        50% {
            transform: translateY(10px) scale(0.8);
            opacity: 0.8;
        }
    }

    .tech-corner-line {
        position: absolute;
        width: 16px;
        height: 16px;
        border-color: #cbd5e1;
        border-style: solid;
        opacity: 0.5;
    }

    .tech-corner-line.top-left {
        top: 12px;
        left: 12px;
        border-width: 2px 0 0 2px;
        border-top-left-radius: 4px;
    }

    .tech-corner-line.top-right {
        top: 12px;
        right: 12px;
        border-width: 2px 2px 0 0;
        border-top-right-radius: 4px;
    }

    .live-status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: #94a3b8;
        border-radius: 50%;
        position: relative;
        vertical-align: middle;
    }

    .premium-empty-state-card .live-status-dot {
        background-color: #7c3aed;
    }

    .premium-empty-state-card .live-status-dot::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        border: 2px solid #7c3aed;
        animation: status-pulse 1.5s linear infinite;
    }

    @keyframes status-pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(1.8);
            opacity: 0;
        }
    }

    .premium-tech-title {
        transition: color 0.3s ease;
    }

    .standard-instruction-text {
        line-height: 1.6;
        font-weight: 400;
    }

    /* Dropdown UI Adjustments */
    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-top: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        z-index: 999;
        max-height: 320px;
        overflow-y: auto;
        display: none;
    }

    .student-item-premium {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        text-decoration: none !important;
        color: inherit !important;
        transition: background 0.2s ease;
    }

    .student-item-premium:hover {
        background: #f8fafc;
    }

    .student-photo img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }

    .student-details {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .student-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 14px;
    }

    .student-meta {
        font-size: 11px;
        color: #64748b;
        display: flex;
        gap: 8px;
    }

    .no-result {
        padding: 16px;
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
    }

    .horizontal-premium-row-card.card-state-overdue {
        border-color: rgba(239, 68, 68, .35) !important;
        background: linear-gradient(180deg, #fff 0%, #fef2f2 100%) !important;
    }


</style>

<div class="circulation-engine-wrapper">

    <div class="shadow-1 radius-12 bg-base border border-slate-200 mb-24">
        <div class="card-header border-bottom bg-base py-20 px-24">
            <div class="d-flex align-items-center gap-3">
                <div class="brand-pulse-icon bg-primary-100 text-primary-600 p-10 radius-10">
                    <i class="ri-user-search-line text-xl"></i>
                </div>
                <div>
                    <h5 class="text-lg fw-bold mb-0 text-dark-main">Beneficiary Credentials Verification</h5>
                    <p class="text-xs text-muted mb-0">Query global institutional parameters via Student ID or
                        Matriculation Name.</p>
                </div>
            </div>
        </div>

        <div class="card-body p-24 bg-slate-50/50">
            <div class="row align-items-center">
                <div class="col-lg-11 col-12 mx-auto">
                    <div class="d-flex align-items-center gap-4 flex-md-row flex-column">

                        <div
                            class="premium-search-box-wrapper position-relative p-3 bg-base border border-slate-300 shadow-sm transition-all focus-within-glow flex-grow-1 w-100 rounded-pill overflow-visible">
                            <div class="d-flex align-items-center gap-3">
                                <div class="premium-icon-glow-ring d-flex align-items-center justify-content-center">
                                    <i class="ri-search-2-line text-muted text-lg"></i>
                                </div>
                                <input type="hidden" name="id" id="library_student_id">

                                <input type="text" id="studentLiveSearchForLibrary"
                                    class="form-control border-0 bg-transparent font-monospace text-md py-10 w-100"
                                    placeholder="Search student record by name, sr no, enroll no, adm no"
                                    autocomplete="off" style="box-shadow: none !important;">

                                <button type="button" id="trigger_search_clear"
                                    class="btn btn-sm btn-slate-100 p-8 radius-8 border-0 text-muted d-none">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>

                            <div class="search-results-dropdown" id="searchResultsContainerForLibrary"></div>
                        </div>

                        <div
                            class="search-mascot-wrapper d-none d-md-flex flex-column align-items-center position-relative">
                            <div class="mascot-bubble">Search Here!</div>
                            <div class="mascot-character">
                                <div class="mascot-eyes">
                                    <div class="mascot-pupil"></div>
                                    <div class="mascot-pupil"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="engine_empty_placeholder"
        class="shadow-1 radius-12 bg-base border border-slate-200 p-48 text-center transition-all mb-24 premium-empty-state-card position-relative overflow-hidden">

        <div class="tech-corner-line top-left"></div>
        <div class="tech-corner-line top-right"></div>

        <div class="graphical-illustration-container mb-24 position-relative d-inline-block">
            <div class="blob-bg-shape animate-spin-slow"></div>
            <div class="radar-pulse-ring pulse-1"></div>
            <div class="radar-pulse-ring pulse-2"></div>
            <div class="radar-pulse-ring pulse-3"></div>

            <div class="tech-particle p-1"></div>
            <div class="tech-particle p-2"></div>

            <div class="illustration-core bg-slate-100 text-slate-400 radius-circle d-flex align-items-center justify-content-center shadow-inner mx-auto premium-core-glow"
                style="width: 120px; height: 120px; position:relative; z-index:2;">
                <i class="ri-git-repository-line premium-icon-neon" style="font-size: 54px;"></i>
                <div class="laser-scanner-line"></div>
            </div>
        </div>

        <h5 class="fw-bold text-dark-main mb-8 position-relative z-3 premium-tech-title">
            <span class="live-status-dot me-16"></span> <span id="loader_headline_text">System Ready</span>
        </h5>
        <p id="loader_sub_text"
            class="text-muted text-sm mx-auto max-w-md position-relative z-3 standard-instruction-text"
            style="max-width: 460px;">
            Provide a verified beneficiary identifier sequence in the control module above to load the asset ledger,
            tracking parameters, and fiscal compliance utilities.
        </p>
    </div>

    <div id="engine_active_workspace" class="transition-all" style="display: none; opacity: 0;">

        <div
            class="shadow-1 radius-12 bg-base overflow-hidden border border-slate-200 mb-24 position-relative profile-glow-accent">
            <div class="card-body p-24">
                <div class="row align-items-center gy-4">
                    <div class="col-md-5 col-12 border-end-md border-slate-200">
                        <div class="d-flex align-items-center gap-4">
                            <div id="session_avatar"
                                class="avatar-large-matrix bg-gradient-primary text-white d-flex align-items-center justify-content-center radius-12 fw-bold shadow"
                                style="width: 64px; height: 64px; font-size: 24px; flex-shrink: 0; background: linear-gradient(135deg, #7c3aed, #4f46e5);">
                                RS
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <h4 class="text-xl fw-bold text-dark-main mb-0" id="session_student_name">Rahul
                                        Sharma</h4>
                                    <span
                                        class="badge bg-primary-100 text-primary-800 border border-primary-200 px-8 py-4 radius-6 text-xs fw-semibold">Academic
                                        Student</span>
                                </div>
                                <span class="text-xs font-monospace text-muted d-block">UID PERMANENT RECORD: <b
                                        class="text-dark-main" id="session_student_id">#2091</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-12 ps-lg-4">
                        <div class="row g-3 text-center text-md-start">
                            <div class="col-sm-4 col-6">
                                <span class="text-xs text-muted d-block mb-4"><i class="ri-bank-line me-4"></i>Class /
                                    Section</span>
                                <span class="fw-bold text-dark-main text-sm" id="session_dept">N/A</span>
                            </div>
                            <div class="col-sm-4 col-6">
                                <span class="text-xs text-muted d-block mb-4"><i
                                        class="ri-book-open-line me-4"></i>Active Allocation</span>
                                <span id="session_holdings_badge"
                                    class="badge bg-warning-50 text-warning-800 border border-warning-200 px-8 py-4 radius-6 font-monospace fw-bold">2
                                    Books Out</span>
                            </div>
                            <div class="col-sm-4 col-12">
                                <span class="text-xs text-muted d-block mb-4"><i
                                        class="ri-shield-user-line me-4"></i>Standing Status</span>
                                <span id="session_status_badge"
                                    class="badge bg-success-50 text-success-800 border border-success-200 px-8 py-4 radius-6 fw-bold">Good
                                    Standing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-16 d-flex align-items-center justify-content-between">
            <span class="text-xs fw-bold text-uppercase tracking-wider text-primary"><i
                    class="ri-bookmark-3-line me-1"></i> Active Resource Circulation Chronicles</span>
            <span id="record_stack_badge"
                class="badge bg-base border border-slate-300 text-slate-700 px-10 py-6 radius-8 text-xs font-monospace">Records
                Stack: 2</span>
        </div>

        <div id="historical_cards_container"></div>

    </div>
</div>

<div id="template_repository" style="display:none;">

    <div id="template_return_block">
        <form class="execution-injected-form" data-mode="return">
            <div class="bg-slate-50 radius-10 p-20 border border-slate-200">
                <div class="d-flex align-items-center justify-content-between mb-16 flex-wrap gap-2">
                    <span class="text-xs fw-bold text-success text-uppercase tracking-wider"><i
                            class="ri-checkbox-circle-line me-2"></i>Return Processing Gateway Active</span>
                    <span class="text-xs text-muted">Asset Configuration Module</span>
                </div>
                <div class="row g-4 align-items-end">
                    <div class="col-xl-3 col-md-6 col-12">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">Check-In
                            Date</label>
                        <input type="date" class="form-control premium-inline-input calc-trigger-date" required>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">Overdue
                            Frame</label>
                        <input type="text"
                            class="form-control premium-inline-input font-monospace field-days-count text-center fw-bold"
                            readonly style="background: #e2e8f0 !important;">
                    </div>
                    <div class="col-xl-3 col-md-3 col-6">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">Calculated
                            Penalty</label>
                        <input type="text"
                            class="form-control premium-inline-input font-monospace field-penalty-quantum fw-bold text-danger"
                            readonly style="background: #e2e8f0 !important;">
                    </div>
                    <div class="col-xl-4 col-md-12 col-12">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">Condition
                            Remarks</label>
                        <input type="text" class="form-control premium-inline-input field-remarks1"
                            placeholder="Mark scratches or annotations...">
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-20 border-top border-slate-200/60 pt-16">
                    <button type="button"
                        class="btn btn-sm btn-outline-secondary px-16 py-8 radius-8 trigger-drawer-close">Collapse</button>
                    <button type="submit"
                        class="btn btn-sm btn-success px-20 py-8 radius-8 fw-bold border-0 text-white"><i
                            class="ri-checkbox-circle-fill me-1"></i> Confirm Return & Restock</button>
                </div>
            </div>
        </form>
    </div>

    <div id="template_renew_block">
        <form class="execution-injected-form" data-mode="renew">
            <div class="bg-slate-50 radius-10 p-20 border border-slate-200">
                <div class="d-flex align-items-center justify-content-between mb-16 flex-wrap gap-2">
                    <span class="text-xs fw-bold text-warning-700 text-uppercase tracking-wider"><i
                            class="ri-refresh-line me-2"></i>Extension Authorization Core Active</span>
                    <span class="text-xs text-muted">Temporal Horizons Configurator</span>
                </div>
                <div class="row g-4 align-items-end">
                    <div class="col-xl-4 col-md-6 col-12">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">New Extended Due
                            Date</label>
                        <input type="date" class="form-control premium-inline-input calc-trigger-date" required>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">Extension
                            Scope</label>
                        <input type="text"
                            class="form-control premium-inline-input font-monospace field-days-count text-center fw-bold"
                            readonly style="background: #e2e8f0 !important;">
                    </div>
                    <div class="col-xl-5 col-md-12 col-12">
                        <label class="text-xs fw-bold text-primary-light mb-8 d-block text-uppercase">Authorization
                            Notes</label>
                        <input type="text" class="form-control premium-inline-input field-remarks2"
                            placeholder="Specify programmatic extension rationale...">
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-20 border-top border-slate-200/60 pt-16">
                    <button type="button"
                        class="btn btn-sm btn-outline-secondary px-16 py-8 radius-8 trigger-drawer-close">Collapse</button>
                    <button type="submit"
                        class="btn btn-sm btn-warning px-20 py-8 radius-8 fw-bold border-0 text-dark"><i
                            class="ri-time-fill me-1"></i> Authorize Extended Tenure</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadStudents();
            let member_id = null;

            if (typeof $ === 'undefined') {
                console.error("Critical Error: jQuery framework is not active on this page.");
                return;
            }

            let students = [];
            let activeStudentCache = null;

            $('#studentLiveSearchForLibrary').on('input', function() {
                let value = $(this).val().trim();
                if (value.length > 1) {
                    $('#searchResultsContainerForLibrary').fadeIn(200);
                } else {
                    $('#searchResultsContainerForLibrary').fadeOut(150);
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.premium-search-box-wrapper').length) {
                    $('#searchResultsContainerForLibrary').fadeOut(150);
                }
            });

            function loadStudents() {
                $.ajax({
                    url: "{{ route('school.common.search_student') }}",
                    type: "GET",
                    success: function(response) {
                        students = response;
                        console.log("Library Page loaded students : ", students);
                    }
                });
            }

            $('#studentLiveSearchForLibrary').on('keyup', function() {
                let keyword = $(this).val().toLowerCase().trim();
                let html = '';

                if (keyword.length > 2) {
                    let filtered = students.filter(student =>
                        (student.search_query || '').toLowerCase().includes(keyword)
                    );

                    if (filtered.length > 0) {
                        filtered.forEach(student => {
                            let photo = student.student_photo ? '{{ asset('') }}' + student
                                .student_photo : '{{ asset('assets/images/_ (11).jpeg') }}';
                            html += `
                            <a href="javascript:void(0)" class="student-item-premium student-item" data-id="${student.student_id}">
                                <div class="student-photo"><img src="${photo}" alt="${student.student_name}"></div>
                                <div class="student-details">
                                    <div class="student-name">${student.student_name}</div>
                                    <div class="student-meta">
                                        <span><b>SR:</b> ${student.sr_no}</span>
                                        <span><b>ADM:</b> ${student.admission_no}</span>
                                    </div>
                                    <div class="student-meta"><span><b>Father:</b> ${student.father_name}</span></div>
                                    <div class="student-meta"><span><b>Mobile:</b> ${student.sms_whatsapp_no}</span></div>
                                </div>
                            </a>`;
                        });
                    } else {
                        html = `<div class="no-result">No student found</div>`;
                    }
                    $('#searchResultsContainerForLibrary').html(html).fadeIn(200);
                } else {
                    $('#searchResultsContainerForLibrary').hide();
                }
            });

            $(document).on('click', '.student-item', function() {
                let studentId = $(this).data('id');
                $('#library_student_id').val(studentId);
                $('#searchResultsContainerForLibrary').hide();
                $('#studentLiveSearchForLibrary').val($(this).find('.student-name').text().trim());

                $("#engine_active_workspace").hide().css("opacity", "0");
                $("#engine_empty_placeholder").removeClass('d-none').show();
                $("#loader_headline_text").text("Details Initializing...");
                $("#loader_sub_text").text(
                    "Accessing global database records. Fetching comprehensive asset allocation ledgers and active balance constraints."
                );

                loadStudent(studentId);
            });

            async function loadStudent(studentId) {
                $.ajax({
                    url: "{{ route('school.common.getLibraryMemberWithBooksHistrory') }}",
                    method: "GET",
                    data: {
                        id: studentId
                    },
                    success: function(response) {

                        let resp = response.data;
                        let res = resp.original.data;

                        console.log(" founded studebt data : ", res);

                        let student = res.student || {};
                        let history = res.library_book_borrow_history || [];

                        member_id = res.id;

                        activeStudentCache = {
                            id: res.id,

                            name: `${student.first_name ?? ''} ${student.last_name ?? ''}`
                                .trim(),
                            dept: `${student.class_master?.name ?? ''} - ${student.section?.name ?? ''}`
                                .trim(),

                            avatar: student.first_name ?
                                student.first_name.substring(0, 2).toUpperCase() : "NA",

                            status: res.student_status,

                            statusClass: res.is_active == true ?
                                'bg-success-50 text-success-800 border border-success-200' :
                                'bg-danger-50 text-danger-800 border border-danger-200',

                            activeHoldings: `${history.length} Books Out`,

                            books: history.map(item => {

                                let dueDate = item.due_date ?
                                    item.due_date.substring(0, 10) :
                                    '';

                                let returnDate = item.return_date ?
                                    item.return_date.substring(0, 10) :
                                    null;

                                let today = new Date();
                                let due = new Date(dueDate);

                                let state = 'issued';
                                if (item.status === 'returned') {
                                    state = 'returned';
                                } else if (due < today) {
                                    state = 'overdue';
                                }

                                return {
                                    id: item.id,

                                    title: item.book?.book_name || 'N/A',

                                    barcode: item.book?.barcode_no ||
                                        item.book?.barcode ||
                                        'N/A',

                                    issue: item.issue_date ?
                                        item.issue_date.substring(0, 10) : '-',

                                    due: dueDate,

                                    state: state,

                                    renew_count: item.renew_count || 0,

                                    fine_amount: item.total_fine_amount || 0,

                                    original: item
                                };
                            })
                        };

                        console.log("Prepared UI Data", activeStudentCache);

                        setTimeout(function() {

                            $("#engine_empty_placeholder").hide();

                            renderStudentWorkspace(
                                activeStudentCache,
                                student.sr_no || studentId
                            );

                        }, 1000);
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            }

            function renderStudentWorkspace(studentData, uid) {

                let books = studentData.books || [];

                $("#session_student_name").text(studentData.name || "-");

                $("#session_avatar").text(
                    studentData.avatar ||
                    ((studentData.name || "NA").substring(0, 2).toUpperCase())
                );

                $("#session_student_id").text(uid || "-");

                $("#session_dept").text(studentData.dept || "-");

                $("#session_holdings_badge").text(studentData.activeHoldings);

                $("#session_status_badge")
                    .removeClass()
                    .addClass(
                        "badge px-8 py-4 radius-6 fw-bold " +
                        studentData.statusClass
                    )
                    .text(studentData.status);

                $("#record_stack_badge").text(`Records Stack : ${books.length}`);

                let cardsHTML = '';

                books.forEach(function(book) {

                    let badge = `
                        <span class="badge bg-success">Issued</span>
                    `;

                    if (book.state === "returned") {
                        badge = `<span class="badge bg-primary">Returned</span>`;
                    }

                    if (book.state === "overdue") {
                        badge = `<span class="badge bg-danger">Overdue</span>`;
                    }

                    cardsHTML += `
                   <div class="horizontal-premium-row-card radius-12 bg-base border border-slate-200 p-24 mb-16 shadow-sm
                        ${book.state === 'overdue' ? 'card-state-overdue' : ''}"
                        data-record-id="${book.id}"
                        data-due-date="${book.due}">

                        <div class="row align-items-center">

                            <div class="col-md-4">
                                <p>${book.title}</p>

                                <small class="text-muted">
                                    Barcode : ${book.barcode}
                                </small>
                            </div>

                            <div class="col-md-2">
                                <small>Issue Date</small>
                                <div>${book.issue}</div>
                            </div>

                            <div class="col-md-2">
                                <small>Due Date</small>
                                <div>${book.due}</div>
                            </div>

                            <div class="col-md-2">
                                ${badge}
                            </div>

                            <div class="col-md-2 text-end d-flex gap-3 pe-4">

                          ${book.state !== 'returned' ? `

                            <button class="btn-premium-return-action trigger-mode-return">
                                Return
                            </button>

                            ${
                            book.state === 'overdue'
                            ?
                            `<button class="btn-premium-renew-action" disabled
                            style="opacity:.5;cursor:not-allowed;">
                                Renew
                            </button>`
                            :
                            `<button class="btn-premium-renew-action trigger-mode-renew">
                                Renew
                            </button>`
                            }

                            ` : ''}

                            </div>

                        </div>

                        <div class="console-injection-drawer d-none mt-20"></div>

                    </div>
                    `;
                });

                $("#historical_cards_container").html(cardsHTML);

                $("#engine_active_workspace")
                    .show()
                    .css("opacity", "1");
            }


            $(document).on("click", ".trigger-mode-return", function(e) {
                e.preventDefault();
                handleDrawerDeployment($(this).closest(".horizontal-premium-row-card"), "return", $(this));
            });

            $(document).on("click", ".trigger-mode-renew", function(e) {
                e.preventDefault();
                handleDrawerDeployment($(this).closest(".horizontal-premium-row-card"), "renew", $(this));
            });

            function handleDrawerDeployment(cardElement, mode, controlButton) {
                let drawer = cardElement.find(".console-injection-drawer");

                if (!drawer.hasClass("d-none") && controlButton.hasClass("active-control")) {
                    drawer.slideUp(200, function() {
                        $(this).addClass("d-none").empty();
                        controlButton.removeClass("active-control");
                    });
                    return;
                }

                cardElement.find(".btn-premium-return-action, .btn-premium-renew-action").removeClass(
                    "active-control");
                controlButton.addClass("active-control");

                let blueprint = (mode === "return") ? $("#template_return_block").html() : $(
                    "#template_renew_block").html();
                drawer.hide().html(blueprint).removeClass("d-none");

                let targetDueDateStr = cardElement.data("due-date");
                let todayStr = new Date().toISOString().split('T')[0];

                if (mode === "return") {
                    drawer.find(".calc-trigger-date").val(todayStr);
                    computeInlineChronoMetrics(targetDueDateStr, todayStr, "return", drawer);
                } else {
                    let offsetDate = new Date(targetDueDateStr);
                    offsetDate.setDate(offsetDate.getDate() + 14);
                    let extendedHorizonStr = offsetDate.toISOString().split('T')[0];
                    drawer.find(".calc-trigger-date").val(extendedHorizonStr);
                    computeInlineChronoMetrics(targetDueDateStr, extendedHorizonStr, "renew", drawer);
                }

                drawer.slideDown(250);

                drawer.find(".calc-trigger-date").on("change", function() {
                    computeInlineChronoMetrics(targetDueDateStr, $(this).val(), mode, drawer);
                });
            }

            function computeInlineChronoMetrics(dueDateStr, inputDateStr, mode, drawerContext) {
                let targetDue = new Date(dueDateStr);
                let activeActionDate = new Date(inputDateStr);
                targetDue.setHours(0, 0, 0, 0);
                activeActionDate.setHours(0, 0, 0, 0);

                if (mode === "return") {
                    if (activeActionDate > targetDue) {
                        let deltaDays = Math.ceil(Math.abs(activeActionDate - targetDue) / (1000 * 60 * 60 * 24));
                        drawerContext.find(".field-days-count").val(`${deltaDays} Days Overdue`);
                        drawerContext.find(".field-penalty-quantum").val(`₹${(deltaDays * 10).toFixed(2)}`);
                    } else {
                        drawerContext.find(".field-days-count").val("0 Days");
                        drawerContext.find(".field-penalty-quantum").val("₹0.00");
                    }
                } else if (mode === "renew") {
                    if (activeActionDate > targetDue) {
                        let deltaDays = Math.ceil(Math.abs(activeActionDate - targetDue) / (1000 * 60 * 60 * 24));
                        drawerContext.find(".field-days-count").val(`+${deltaDays} Days Extension`);
                    } else {
                        drawerContext.find(".field-days-count").val("0 Days Added");
                    }
                }
            }

            $(document).on("click", ".trigger-drawer-close", function() {
                let card = $(this).closest(".horizontal-premium-row-card");
                card.find(".console-injection-drawer").slideUp(200, function() {
                    $(this).addClass("d-none").empty();
                    card.find(".btn-premium-return-action, .btn-premium-renew-action").removeClass(
                        "active-control");
                });
            });



            $(document).on("submit", ".execution-injected-form", function(e) {
                e.preventDefault();

                let $form = $(this);
                let card = $form.closest(".horizontal-premium-row-card");
                let historyRecordId = card.data("record-id");
                let currentMode = $form.data("mode");
                let studentId = $('#library_student_id').val();
                member_id = member_id;


                let actionDate = $form.find(".calc-trigger-date").val();
                let fineAmount = $form.find(".field-penalty-quantum").val() || "₹0.00";

                let numericFine = fineAmount.replace(/[^0-9.]/g, '');

                if (!studentId || !historyRecordId) {
                    alert("Error: Student ID or Book Issue Record configuration is missing.");
                    return;
                }

                let remark = "";

                if (currentMode === "return") {
                    remark = $form.find(".field-remarks1").val();
                } else if (currentMode === "renew") {
                    remark = $form.find(".field-remarks2").val();
                }

                let targetUrl = "";
                let submissionPayload = {
                    student_id: studentId,
                    remark: remark,
                    member_id: member_id,
                    history_id: historyRecordId,
                    action_date: actionDate
                };

                if (currentMode === "return") {

                    targetUrl = "{{ route('school.library.book_issue.return_book') }}";
                    submissionPayload.fine_amount = numericFine;
                } else if (currentMode === "renew") {
                    targetUrl = "{{ route('school.library.book_issue.renew_book') }}";
                } else {
                    console.error("Unknown submission strategy protocol context.");
                    return;
                }


                let submitBtn = $form.find("button[type='submit']");
                let originalBtnText = submitBtn.text();
                submitBtn.prop("disabled", true).text("Processing...");

                $.ajax({
                    url: targetUrl,
                    method: "POST",
                    data: $.extend({}, submissionPayload, {
                        _token: "{{ csrf_token() }}"
                    }),
                    success: function(response) {
                        if (response.success) {

                            if (activeStudentCache && activeStudentCache.books) {
                                let targetBookObj = activeStudentCache.books.find(b => b.id ==
                                    historyRecordId);
                                if (targetBookObj) {
                                    if (currentMode === "renew") {
                                        targetBookObj.renew_count = (targetBookObj
                                            .renew_count || 0) + 1;
                                        targetBookObj.due = actionDate;


                                        let today = new Date();
                                        today.setHours(0, 0, 0, 0);
                                        let complexDueDate = new Date(actionDate);
                                        complexDueDate.setHours(0, 0, 0, 0);

                                        targetBookObj.state = (complexDueDate < today) ?
                                            "overdue" : "issued";
                                    } else if (currentMode === "return") {
                                        targetBookObj.state = "returned";
                                    }
                                }
                            }

                            alert(
                            `${currentMode.toUpperCase()} Action performed successfully!`);


                            renderStudentWorkspace(activeStudentCache, studentId);
                        } else {
                            alert("Operation failed: " + (response.message ||
                                "Unknown Application Server Exception"));
                            submitBtn.prop("disabled", false).text(originalBtnText);
                        }
                    },
                    error: function(xhr) {
                        submitBtn.prop("disabled", false).text(originalBtnText);
                        if (typeof handleAjaxError === "function") {
                            handleAjaxError(xhr);
                        } else {
                            alert("Critical Connection Failure. Code " + xhr.status +
                                ": Request could not be processed.");
                        }
                    }
                });
            });
        });
    </script>
@endpush
