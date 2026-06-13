@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Elite Student Portfolio Core')

@section('dynamic-content')
    <div class="dashboard-main-body" style="background: #f8fafc; min-height: 100vh;">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-100 mb-24 position-relative">
            <div class="position-absolute top-0 end-0 p-0 pointer-events-none opacity-50" 
                style="background: radial-gradient(circle at 80% 20%, rgba(79, 70, 229, 0.12) 0%, transparent 60%); width: 600px; height: 100%; z-index: 1;">
            </div>

            <div class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center flex-wrap gap-4 position-relative" style="z-index: 2;">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-gradient shadow-primary">
                        <i class="ri-user-star-fill text-xl text-white animate-pulse"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-4 text-gradient-primary tracking-tight">Student Portfolio</h5>
                        <p class="text-xs text-muted mb-0 fw-medium">Universal scholastic telemetry, behavioral tracks, and real-time ledger accounting</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-success-50 text-success-700 border border-success-200 px-16 py-8 fw-bold radius-30 d-flex align-items-center gap-2">
                        <span class="pulse-green-dot"></span> System Live: Node-Alpha
                    </span>
                </div>
            </div>

            <div class="card-body p-24 bg-gradient-light border-top">
                <div class="premium-input-box mb-0 position-relative">
                    <label class="text-xs fw-bold text-uppercase tracking-widest text-primary mb-8 d-block">Search Core Student Vault</label>
                    <div class="inner-addon position-relative">
                        <i class="ri-search-eye-line addon-icon-premium position-absolute top-50 translate-middle-y ms-20 text-primary"></i>
                        <input type="text" class="form-control radius-12 py-12 ps-52 bg-base border-2 border-neutral-200 focus-premium text-sm fw-semibold shadow-inner-sm" 
                            id="portfolioStudentSearch"  placeholder="Query registration, sr.no. , admission no. , names, or micro-indices...">
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-24">
            <div class="col-xl-3 col-lg-6">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100 d-flex flex-column hover-lift">
                    <div class="px-24 py-12 text-white fw-bold text-xs text-uppercase tracking-wider d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #4f46e5, #3b82f6);">
                        <span><i class="ri-fingerprint-line me-2"></i>Identity Profile</span>
                        <span class="badge bg-white-20 text-white border-0 radius-4 text-xxs">ID: 89423</span>
                    </div>
                    <div class="p-24 flex-grow-1 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center gap-4 mb-16">
                            <div class="avatar-glow radius-16 p-6 border-2 border-primary-100 bg-base" style="width: 80px; height: 80px; min-width: 80px;">
                                <img src="https://i.pinimg.com/736x/ab/22/b7/ab22b78b4e2ea7e6c6afdb81210208c0.jpg" id="studentAvatar" class="w-100 h-100 object-fit-cover radius-12" alt="Avatar Vector">
                            </div>
                            <div>
                                <h6 class="text-md fw-black mb-4 text-dark-main text-black text-uppercase tracking-tight" id="studentName">Aarav Sharma</h6>
                                <p class="text-xs text-muted mb-4 fw-semibold">Class : <span class="text-primary" id="studentClass">XII - A (Science)</span></p>
                                <span class="badge bg-success-50 text-success-700 border border-success-200 px-8 py-4 radius-6 fw-bold text-xxs">Active Ledger</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap pt-12 border-top border-neutral-100">
                            <span class="badge bg-warning-50 text-warning-700 border border-warning-200 radius-30 text-xxs px-10 py-6 fw-bold"><i class="ri-bus-fill me-1"></i>Route #4B</span>
                            <span class="badge bg-purple-50 text-purple-700 border border-purple-200 radius-30 text-xxs px-10 py-6 fw-bold"><i class="ri-hotel-bed-fill me-1"></i>A-Block</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100 d-flex flex-column hover-lift">
                    <div class="px-24 py-12 text-white fw-bold text-xs text-uppercase tracking-wider d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #ef4444, #f97316);">
                        <span><i class="ri-medal-line me-2"></i>Scholastic Standing</span>
                        <span class="badge bg-white-20 text-white border-0 radius-4 text-xxs">CGPA: 9.4</span>
                    </div>
                    <div class="p-24 flex-grow-1 d-flex flex-column justify-content-center text-center">
                        <p class="text-xs text-muted mb-12 fw-medium">Term-1 Comprehensive Examination Metrics</p>
                        <button type="button" class="btn btn-premium-gradient-red shadow-sm w-100 py-12 radius-12 text-xs fw-bold tracking-wider text-uppercase border-0" onclick="triggerResultModal()">
                            <i class="ri-pulse-line me-2 text-md"></i> Stream Live Report Card
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100 d-flex flex-column hover-lift">
                    <div class="px-24 py-12 text-white fw-bold text-xs text-uppercase tracking-wider d-flex align-items-center" style="background: linear-gradient(135deg, #eab308, #ca8a04);">
                        <i class="ri-bus-wifi-line me-2"></i>Logistics & Fleet Info
                    </div>
                    <div class="p-20 flex-grow-1 d-flex flex-column justify-content-center">
                        <div class="bg-light-soft radius-12 p-12 border border-neutral-100">
                            <div class="d-flex justify-content-between border-bottom pb-6 mb-6 text-xs"><span class="text-muted fw-semibold">Vehicle Fleet</span><span class="fw-black text-dark-main" id="transVehicle">Bus-Alpha-24</span></div>
                            <div class="d-flex justify-content-between border-bottom pb-6 mb-6 text-xs"><span class="text-muted fw-semibold">Registration No</span><span class="badge bg-neutral-900 text-white font-monospace text-xxs radius-4" id="transVehicleNo">DL-3C-AG-9081</span></div>
                            <div class="d-flex justify-content-between text-xs"><span class="text-muted fw-semibold">Terminal Stop</span><span class="fw-bold text-primary" id="transDestination">Preet Vihar Hub</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 h-100 d-flex flex-column hover-lift">
                    <div class="px-24 py-12 text-white fw-bold text-xs text-uppercase tracking-wider d-flex align-items-center" style="background: linear-gradient(135deg, #ec4899, #db2777);">
                        <i class="ri-community-line me-2"></i>Residential Estate Registry
                    </div>
                    <div class="p-20 flex-grow-1 d-flex flex-column justify-content-center">
                        <div class="bg-light-soft radius-12 p-12 border border-neutral-100">
                            <div class="d-flex justify-content-between border-bottom pb-6 mb-6 text-xs"><span class="text-muted fw-semibold">Hostel Base</span><span class="fw-black text-dark-main" id="hostelName">Apex Tech Dorm</span></div>
                            <div class="d-flex justify-content-between border-bottom pb-6 mb-6 text-xs"><span class="text-muted fw-semibold">Block Allocation</span><span class="fw-bold text-dark-main" id="hostelBlockFloor">Wing-B, Floor 3</span></div>
                            <div class="d-flex justify-content-between text-xs"><span class="text-muted fw-semibold">Room Token</span><span class="fw-black text-danger" id="hostelRoom">Room #304-B</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shadow-2 radius-16 bg-base p-24 mb-24 border border-neutral-200 position-relative overflow-hidden">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between text-xs mb-10">
                        <span class="text-dark-main fw-bold text-uppercase tracking-wider"><i class="ri-calendar-todo-fill text-primary me-2"></i>Attendance Vector</span>
                        <span class="badge bg-primary-50 text-primary-700 fw-black px-10 py-4 radius-30" id="attendanceProgressText">92.4% Verified</span>
                    </div>
                    <div class="progress shadow-none radius-12" style="height: 14px; background-color: #f1f5f9;">
                        <div class="progress-bar radius-12 progress-bar-striped progress-bar-animated" role="progressbar" style="width: 92.4%; background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);" id="attendanceProgressBar"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between text-xs mb-10">
                        <span class="text-dark-main fw-bold text-uppercase tracking-wider"><i class="ri-shield-flash-fill text-success me-2"></i>Financial Liquidation Track</span>
                        <span class="badge bg-success-50 text-success-700 fw-black px-10 py-4 radius-30" id="feesProgressText">85% Cleared</span>
                    </div>
                    <div class="progress shadow-none radius-12" style="height: 14px; background-color: #f1f5f9;">
                        <div class="progress-bar radius-12 progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%; background: linear-gradient(90deg, #10b981 0%, #22c55e 100%);" id="feesProgressBar"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shadow-2 radius-16 bg-base p-24 mb-24 border border-neutral-200">
            <div class="row g-4">
                <div class="col-xl-6 border-end-premium">
                    <h6 class="text-xs fw-black text-primary text-uppercase tracking-widest mb-20 d-flex align-items-center gap-2">
                        <i class="ri-group-line text-base"></i> Primary Parental Framework
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-16 radius-12 bg-light-soft border border-neutral-200 d-flex align-items-center gap-3 combo-card">
                                <div class="avatar-circle-sm bg-primary text-white"><i class="ri-parent-fill text-lg"></i></div>
                                <div>
                                    <h6 class="text-xs fw-black text-dark-main mb-2" id="fatherName">Dr. Ramesh Sharma</h6>
                                    <p class="text-xxs text-muted mb-0 fw-semibold">Father / Legal Sponsor</p>
                                    <p class="text-xxs text-primary font-monospace mt-2 fw-bold" id="fatherContact">+91 98765 43210</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-16 radius-12 bg-light-soft border border-neutral-200 d-flex align-items-center gap-3 combo-card">
                                <div class="avatar-circle-sm bg-pink text-white"><i class="ri-woman-fill text-lg"></i></div>
                                <div>
                                    <h6 class="text-xs fw-black text-dark-main mb-2" id="motherName">Mrs. Sunita Sharma</h6>
                                    <p class="text-xxs text-muted mb-0 fw-semibold">Mother / Guardian</p>
                                    <p class="text-xxs text-primary font-monospace mt-2 fw-bold" id="motherContact">+91 98765 43211</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <h6 class="text-xs fw-black text-success text-uppercase tracking-widest mb-20 d-flex align-items-center gap-2">
                        <i class="ri-shield-cross-line text-base"></i> Auxiliary Security Escalation
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-16 radius-12 bg-light-soft border border-neutral-200 d-flex align-items-center gap-3 combo-card">
                                <div class="avatar-circle-sm bg-success text-white"><i class="ri-user-protect-line text-lg"></i></div>
                                <div>
                                    <h6 class="text-xs fw-black text-dark-main mb-2" id="guardian1Name">Mr. Alok Verma</h6>
                                    <p class="text-xxs text-muted mb-0 fw-semibold">Emergency Escalation</p>
                                    <p class="text-xxs text-success font-monospace mt-2 fw-bold" id="guardian1Contact">+91 94111 22233</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-16 radius-12 bg-light-soft border border-neutral-200 d-flex align-items-center gap-3 combo-card">
                                <div class="avatar-circle-sm bg-neutral-700 text-white"><i class="ri-user-shared-line text-lg"></i></div>
                                <div>
                                    <h6 class="text-xs fw-black text-dark-main mb-2" id="guardian2Name">N/A</h6>
                                    <p class="text-xxs text-muted mb-0 fw-semibold">Secondary Backup Contact</p>
                                    <p class="text-xxs text-muted mt-2 font-monospace" id="guardian2Contact">No Record Linked</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-24">
            <div class="col-xl-7">
                <div class="shadow-2 radius-16 bg-base p-24 border border-neutral-200 h-100 position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center mb-20 flex-wrap gap-2 border-bottom pb-16">
                        <h6 class="text-sm fw-black text-dark-main mb-0 d-flex align-items-center gap-2"><i class="ri-pie-chart-3-line text-primary"></i>Ledger Deficit & Realization Vector</h6>
                        <span class="badge bg-neutral-900 text-white font-monospace text-xs px-12 py-4 radius-4">FY: 2026-27</span>
                    </div>
                    
                    <div class="row align-items-center g-4 py-12">
                        <div class="col-sm-5 text-center">
                            <div class="position-relative d-inline-block">
                                <svg width="150" height="150" viewBox="0 0 36 36" class="circular-chart-premium">
                                    <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle progress-green" stroke-dasharray="85, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div class="chart-inner-content position-absolute top-50 start-50 translate-middle text-center">
                                    <h4 class="text-lg fw-black text-dark-main mb-0">85%</h4>
                                    <span style="font-size: 9px;" class="text-muted fw-bold text-uppercase tracking-wider">Paid</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="p-16 radius-12 bg-light-soft border border-neutral-100 shadow-inner-sm">
                                <div class="d-flex align-items-center justify-content-between mb-10 text-xs">
                                    <span class="d-flex align-items-center gap-2 fw-medium text-muted"><span class="indicator-dot bg-neutral-500"></span>Gross Composite Fee</span>
                                    <span class="fw-black text-dark-main font-monospace">₹1,20,000.00</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-10 text-xs">
                                    <span class="d-flex align-items-center gap-2 fw-medium text-muted"><span class="indicator-dot bg-success"></span>Realized Component</span>
                                    <span class="fw-black text-success font-monospace">₹1,02,000.00</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between text-xs pt-10 border-top border-dashed">
                                    <span class="d-flex align-items-center gap-2 fw-bold text-danger"><span class="indicator-dot bg-danger animate-pulse"></span>Outstanding Escrow</span>
                                    <span class="fw-black text-danger font-monospace bg-danger-50 px-8 py-2 radius-4">₹18,000.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="shadow-2 radius-16 bg-base p-24 border border-neutral-200 h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-16 border-bottom pb-10">
                        <h6 class="text-sm fw-black text-dark-main mb-0 d-flex align-items-center gap-2">
                            <i class="ri-notification-3-line text-warning"></i>Active Reminders Pipeline
                        </h6>
                        <span class="badge bg-danger-50 text-danger-700 text-xxs fw-bold px-8 py-4 radius-30">5 Critical</span>
                    </div>
                    
                    <div class="premium-scroll-box flex-grow-1" style="max-height: 200px; overflow-y: auto; padding-right: 4px;">
                        <div class="d-flex flex-column gap-3">
                            <div class="p-12 radius-12 bg-danger-50 border border-danger-100 d-flex gap-3 align-items-start">
                                <i class="ri-alert-fill text-base text-danger mt-2"></i>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between text-xxs fw-bold text-danger-800 mb-2"><span>Q3 Installment Overdue</span><span class="font-monospace text-muted">Today</span></div>
                                    <p class="text-xxs text-danger-600 mb-0">Balance outstanding of ₹18,000.00 needs clearance.</p>
                                </div>
                            </div>
                            <div class="p-12 radius-12 bg-warning-50 border border-warning-100 d-flex gap-3 align-items-start">
                                <i class="ri-error-warning-fill text-base text-warning mt-2"></i>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between text-xxs fw-bold text-warning-800 mb-2"><span>Biometric Check missing</span><span class="font-monospace text-muted">Yesterday</span></div>
                                    <p class="text-xxs text-warning-600 mb-0">Evening shift checkout logs missing on 11th June.</p>
                                </div>
                            </div>
                            <div class="p-12 radius-12 bg-primary-50 border border-primary-100 d-flex gap-3 align-items-start">
                                <i class="ri-information-fill text-base text-primary mt-2"></i>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between text-xxs fw-bold text-primary-800 mb-2"><span>Lab File Submission</span><span class="font-monospace text-muted">08 June</span></div>
                                    <p class="text-xxs text-primary-600 mb-0">Submit Physics Practical logbook before Friday.</p>
                                </div>
                            </div>
                            <div class="p-12 radius-12 bg-neutral-50 border border-neutral-200 d-flex gap-3 align-items-start">
                                <i class="ri-notification-fill text-base text-neutral-600 mt-2"></i>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between text-xxs fw-bold text-neutral-800 mb-2"><span>Vaccination Drive Update</span><span class="font-monospace text-muted">05 June</span></div>
                                    <p class="text-xxs text-neutral-600 mb-0">Health desk checking standard consent tokens.</p>
                                </div>
                            </div>
                            <div class="p-12 radius-12 bg-purple-50 border border-purple-100 d-flex gap-3 align-items-start">
                                <i class="ri-award-fill text-base text-purple-700 mt-2"></i>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between text-xxs fw-bold text-purple-800 mb-2"><span>Annual Tech Fest Reg</span><span class="font-monospace text-muted">02 June</span></div>
                                    <p class="text-xxs text-purple-600 mb-0">Slot verification finalized under core science team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-24">
            
            <div class="col-xl-4 col-lg-6">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 overflow-hidden d-flex flex-column">
                    <div class="px-24 py-16 bg-base border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0"><i class="ri-book-read-fill text-primary me-2"></i>Homework Logs</h6>
                        <span class="badge bg-primary-50 text-indigo fw-bold text-xxs px-8 py-4 radius-4">5 Logs Linked</span>
                    </div>
                    
                    <div class="p-20 d-flex flex-column gap-3 flex-grow-1 bg-light-soft premium-scroll-box" style="max-height: 290px; overflow-y: auto;">
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-primary">Advanced Physics</span><span class="text-muted fw-medium font-monospace">Due: 15 June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-6">Quantum Mechanics Matrix & Equation Proofs</h6>
                            <span class="badge bg-warning-50 text-warning-700 text-xxs font-semibold px-6 py-2 radius-4">Pending Review</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-success">Organic Chemistry</span><span class="text-muted fw-medium font-monospace">Due: 10 June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-6">Hydrocarbon Ring Compositions Lab Log</h6>
                            <span class="badge bg-success-50 text-success-700 text-xxs font-semibold px-6 py-2 radius-4">Evaluated: A+</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-danger">Pure Mathematics</span><span class="text-muted fw-medium font-monospace">Due: 08 June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-6">Vector Calculus Integration & Surfaces Theorem</h6>
                            <span class="badge bg-danger-50 text-danger-700 text-xxs font-semibold px-6 py-2 radius-4">Incomplete / Lapsed</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-purple-700">Computer Science</span><span class="text-muted fw-medium font-monospace">Due: 04 June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-6">Inheritance & Polymorphism Tree Structure</h6>
                            <span class="badge bg-success-50 text-success-700 text-xxs font-semibold px-6 py-2 radius-4">Evaluated: O (Outstanding)</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-neutral-600">English Core</span><span class="text-muted fw-medium font-monospace">Due: 01 June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-6">Editorial Analysis on Contemporary Literature</h6>
                            <span class="badge bg-neutral-100 text-neutral-800 text-xxs font-semibold px-6 py-2 radius-4">Checked</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 overflow-hidden d-flex flex-column">
                    <div class="px-24 py-16 bg-base border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0"><i class="ri-git-commit-fill text-success me-2"></i>Security Gatepass</h6>
                        <span class="badge bg-success-50 text-success-700 fw-bold text-xxs px-8 py-4 radius-4">5 Logs Found</span>
                    </div>
                    
                    <div class="p-20 d-flex flex-column gap-3 flex-grow-1 bg-light-soft premium-scroll-box" style="max-height: 290px; overflow-y: auto;">
                        <div class="bg-base p-12 radius-12 border border-neutral-200 d-flex align-items-start gap-3">
                            <div class="bg-success-50 p-8 border radius-8"><i class="ri-user-shared-fill text-md text-success"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between text-xxs mb-4"><span class="fw-bold text-dark-main">Visitor: Dr. Ramesh Sharma</span><span class="text-muted font-monospace">12-June</span></div>
                                <p class="text-xxs text-muted mb-6">Relation: Father • Out: 11:30 AM | In: 02:00 PM</p>
                                <div class="d-flex justify-content-between align-items-center"><span class="badge bg-neutral-900 text-white font-monospace px-6 py-2 text-xxs radius-4">Token #GP-988</span><span class="text-xxs fw-bold text-success"><i class="ri-checkbox-circle-fill me-1"></i>Authorized</span></div>
                            </div>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 d-flex align-items-start gap-3">
                            <div class="bg-warning-50 p-8 border radius-8"><i class="ri-user-shared-fill text-md text-warning"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between text-xxs mb-4"><span class="fw-bold text-dark-main">Visitor: Courier Delivery Desk</span><span class="text-muted font-monospace">10-June</span></div>
                                <p class="text-xxs text-muted mb-6">Relation: Parcel Delivery • Registered Gate Entry Only</p>
                                <div class="d-flex justify-content-between align-items-center"><span class="badge bg-neutral-100 text-neutral-800 font-monospace px-6 py-2 text-xxs radius-4">Token #GP-941</span><span class="text-xxs fw-bold text-warning"><i class="ri-indeterminate-circle-fill me-1"></i>Gate Check</span></div>
                            </div>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 d-flex align-items-start gap-3">
                            <div class="bg-success-50 p-8 border radius-8"><i class="ri-user-shared-fill text-md text-success"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between text-xxs mb-4"><span class="fw-bold text-dark-main">Visitor: Mrs. Sunita Sharma</span><span class="text-muted font-monospace">05-June</span></div>
                                <p class="text-xxs text-muted mb-6">Relation: Mother • Out: 01:10 PM | In: 03:30 PM</p>
                                <div class="d-flex justify-content-between align-items-center"><span class="badge bg-neutral-900 text-white font-monospace px-6 py-2 text-xxs radius-4">Token #GP-892</span><span class="text-xxs fw-bold text-success"><i class="ri-checkbox-circle-fill me-1"></i>Authorized</span></div>
                            </div>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 d-flex align-items-start gap-3">
                            <div class="bg-danger-50 p-8 border radius-8"><i class="ri-user-unfollow-fill text-md text-danger"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between text-xxs mb-4"><span class="fw-bold text-dark-main">Visitor: Local Guardian Request</span><span class="text-muted font-monospace">28-May</span></div>
                                <p class="text-xxs text-muted mb-6">Relation: Relative • Entry Blocked via Admin Override</p>
                                <div class="d-flex justify-content-between align-items-center"><span class="badge bg-danger-50 text-danger-700 font-monospace px-6 py-2 text-xxs radius-4">Token #GP-811</span><span class="text-xxs fw-bold text-danger"><i class="ri-close-circle-fill me-1"></i>Rejected</span></div>
                            </div>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 d-flex align-items-start gap-3">
                            <div class="bg-success-50 p-8 border radius-8"><i class="ri-user-shared-fill text-md text-success"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between text-xxs mb-4"><span class="fw-bold text-dark-main">Visitor: Dr. Ramesh Sharma</span><span class="text-muted font-monospace">15-May</span></div>
                                <p class="text-xxs text-muted mb-6">Relation: Father • Out: 09:00 AM | In: 11:00 AM</p>
                                <div class="d-flex justify-content-between align-items-center"><span class="badge bg-neutral-900 text-white font-monospace px-6 py-2 text-xxs radius-4">Token #GP-703</span><span class="text-xxs fw-bold text-success"><i class="ri-checkbox-circle-fill me-1"></i>Authorized</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 overflow-hidden d-flex flex-column">
                    <div class="px-24 py-16 bg-base border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0"><i class="ri-shield-user-fill text-danger me-2"></i>Behavior & Discipline Flags</h6>
                        <span class="badge bg-warning-50 text-warning-700 fw-bold text-xxs px-8 py-4 radius-4">5 Activity Flags</span>
                    </div>
                    
                    <div class="p-20 d-flex flex-column gap-3 flex-grow-1 bg-light-soft premium-scroll-box" style="max-height: 290px; overflow-y: auto;">
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-danger"><i class="ri-error-warning-line me-1"></i>Classroom Disruption</span><span class="text-muted fw-bold font-monospace">11-June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-4">Unapproved smart device utilization in Science Lab block.</h6>
                            <p class="text-xxs text-muted mb-6">By Authority: Prof. H.K. Verma</p>
                            <span class="badge bg-danger-50 text-danger-700 text-xxs font-semibold px-6 py-2 radius-4">Action Taken: Warning Issued</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-success"><i class="ri-award-line me-1"></i>Scholastic Merit Citation</span><span class="text-muted fw-bold font-monospace">05-June</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-4">Represented KTR Core Tech Node at Regional Science Exhibition.</h6>
                            <p class="text-xxs text-muted mb-6">By Authority: Principal Secretariat</p>
                            <span class="badge bg-success-50 text-success-700 text-xxs font-semibold px-6 py-2 radius-4">Action Taken: Appreciated</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-warning"><i class="ri-time-line me-1"></i>Late Arrival Track</span><span class="text-muted fw-bold font-monospace">29-May</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-4">Late check-in past terminal morning buzzer protocol (25 Mins).</h6>
                            <p class="text-xxs text-muted mb-6">By Authority: Security Desk Gate-01</p>
                            <span class="badge bg-warning-50 text-warning-700 text-xxs font-semibold px-6 py-2 radius-4">Action Taken: Parent Alert Out</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-neutral-700"><i class="ri-bookmark-line me-1"></i>Library Protocol Flag</span><span class="text-muted fw-bold font-monospace">15-May</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-4">Delayed return allocation for reference journal volume 3B.</h6>
                            <p class="text-xxs text-muted mb-6">By Authority: Chief Librarian Desk</p>
                            <span class="badge bg-neutral-100 text-neutral-800 text-xxs font-semibold px-6 py-2 radius-4">Action Taken: Fine Cleared</span>
                        </div>
                        <div class="bg-base p-12 radius-12 border border-neutral-200 hover-shadow">
                            <div class="d-flex justify-content-between text-xxs mb-6"><span class="fw-bold text-success"><i class="ri-heart-pulse-line me-1"></i>Peer Support Citation</span><span class="text-muted fw-bold font-monospace">02-May</span></div>
                            <h6 class="text-xs fw-bold text-dark-main mb-4">Volunteered configuration support for sports event database matrix.</h6>
                            <p class="text-xxs text-muted mb-6">By Authority: Sports Dean Council</p>
                            <span class="badge bg-success-50 text-success-700 text-xxs font-semibold px-6 py-2 radius-4">Action Taken: Logged</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            console.log("Elite Premium Portfolio Hub Matrix Compiled UI Asset Injection Active.");
        });

        function triggerResultModal() {
            alert("Redirecting securely to Core Examination Evaluation Database Server Node...");
        }
    </script>
    
    <style>
        /* Premium Layout Variables & Aesthetic Overrides */
        .text-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand-pulse-gradient {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }
        .shadow-primary {
            box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.3);
        }
        .shadow-2 {
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.06), 0 2px 8px -1px rgba(15, 23, 42, 0.04) !important;
        }
        .radius-16 { border-radius: 16px !important; }
        .bg-gradient-light { background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); }
        .focus-premium:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15) !important;
        }
        .addon-icon-premium {
            font-size: 1.25rem;
            left: 4px;
        }
        .hover-lift {
            transition: transform 0.22s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.22s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -4px rgba(15, 23, 42, 0.1) !important;
        }
        .btn-premium-gradient-red {
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
            transition: opacity 0.2s;
        }
        .btn-premium-gradient-red:hover {
            opacity: 0.95;
            color: white;
        }
        .pulse-green-dot {
            width: 8px;
            height: 8px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
            animation: pulse-dot-key 1.6s infinite;
        }
        @keyframes pulse-dot-key {
            0% { transform: scale(0.9); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.5; }
            100% { transform: scale(0.9); opacity: 1; }
        }
        
        /* CSS SVG Circle Graph Engine Style */
        .circular-chart-premium {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            max-height: 250px;
        }
        .circle-bg {
            fill: none;
            stroke: #f1f5f9;
            stroke-width: 3.2;
        }
        .circle {
            fill: none;
            stroke-width: 3.2;
            stroke-linecap: round;
        }
        .progress-green { stroke: #10b981; }
        .indicator-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        .combo-card {
            transition: background-color 0.2s;
        }
        .combo-card:hover {
            background-color: #f1f5f9 !important;
        }
        .avatar-circle-sm {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bg-pink { background-color: #ec4899; }
        
        /* Modern Scrollbar Engineering Custom Properties */
        .premium-scroll-box::-webkit-scrollbar {
            width: 5px;
        }
        .premium-scroll-box::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 10px;
        }
        .premium-scroll-box::-webkit-scrollbar-thumb {
            background: rgba(79, 70, 229, 0.15);
            border-radius: 10px;
            transition: background 0.2s;
        }
        .premium-scroll-box::-webkit-scrollbar-thumb:hover {
            background: rgba(79, 70, 229, 0.3);
        }

        @media (min-width: 1200px) {
            .border-end-premium {
                border-right: 1px dashed #cbd5e1 !important;
            }
        }
    </style>
@endpush