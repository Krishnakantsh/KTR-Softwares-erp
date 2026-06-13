@extends('Frontend.Normal.Layout.main')

@section('title', 'G S PUBLIC SCHOOL - Academic Repository Engine')

@section('dynamic-content')
    <div class="dashboard-main-body" style="background: #f8fafc; min-height: 100vh;">
        
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-100 mb-24 position-relative">
            <div class="position-absolute top-0 end-0 p-0 pointer-events-none opacity-40" 
                style="background: radial-gradient(circle at 85% 25%, rgba(99, 102, 241, 0.1) 0%, transparent 60%); width: 550px; height: 100%; z-index: 1;">
            </div>
            <div class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center flex-wrap gap-4 position-relative" style="z-index: 2;">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-gradient shadow-indigo">
                        <i class="ri-archive-stack-fill text-xl text-white"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-black mb-4 text-gradient-indigo tracking-tight">Academic Resource & Repository System</h5>
                        <p class="text-xs text-muted mb-0 fw-medium">Upload and catalogue Previous Year Papers, Study Materials, Syllabi, and Recorded Sessions seamlessly.</p>
                    </div>
                </div>
                <div>
                    <span class="badge bg-indigo text-white font-monospace text-xs px-12 py-6 radius-4">Session: 2026-27</span>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-xl-7 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 d-flex flex-column overflow-hidden">
                    <div class="px-24 py-16 bg-base border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0">
                            <i class="ri-database-2-line text-indigo me-2"></i>Stored Materials Ledger
                        </h6>
                        <span class="badge bg-success-50 text-success-700 fw-bold text-xxs px-8 py-4 radius-4">Data Vault Active</span>
                    </div>

                    <div class="p-16 bg-light-soft border-bottom d-flex gap-3">
                        <div class="position-relative flex-grow-1">
                            <i class="ri-search-line position-absolute top-50 start-0 translate-middle-y ms-12 text-muted text-sm"></i>
                            <input type="text" class="form-control form-control-sm ps-36 radius-8 text-xs bg-base border-neutral-200" placeholder="Search archive by title, class, or paper code...">
                        </div>
                    </div>

                    <div class="table-responsive flex-grow-1 premium-table-scroll" style="max-height: 620px; overflow-y: auto;">
                        <table class="table hover-table vertical-middle mb-0 text-xs">
                            <thead class="bg-light text-uppercase tracking-wider sticky-top top-0 bg-base" style="z-index:3; border-bottom: 2px solid #e2e8f0;">
                                <tr>
                                    <th class="py-14 ps-20 text-muted fw-black">S.No.</th>
                                    <th class="py-14 text-muted fw-black">Resource Title</th>
                                    <th class="py-14 text-muted fw-black">Paper Name / Type</th>
                                    <th class="py-14 text-muted fw-black">Class</th>
                                    <th class="py-14 text-muted fw-black">Year / Schedule</th>
                                    <th class="py-14 pe-20 text-end text-muted fw-black">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-20 py-14 fw-bold text-muted">1</td>
                                    <td><div class="fw-black text-dark-main">v1</div></td>
                                    <td><span class="badge bg-primary-50 text-indigo fw-bold px-8 py-4 radius-4">vlcv</span></td>
                                    <td><div class="fw-bold text-muted">XI</div></td>
                                    <td class="font-monospace fw-bold text-dark-main">2025</td>
                                    <td class="pe-20 text-end">
                                        <div class="d-inline-flex gap-1">
                                            <button class="btn btn-icon-sm btn-light-soft text-primary"><i class="ri-download-cloud-2-line"></i></button>
                                            <button class="btn btn-icon-sm btn-light-soft text-danger"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-20 py-14 fw-bold text-muted">2</td>
                                    <td><div class="fw-black text-dark-main">demo225</div></td>
                                    <td><span class="badge bg-primary-50 text-indigo fw-bold px-8 py-4 radius-4">eng</span></td>
                                    <td><div class="fw-bold text-muted">XI</div></td>
                                    <td class="font-monospace fw-bold text-dark-main">2026</td>
                                    <td class="pe-20 text-end">
                                        <div class="d-inline-flex gap-1">
                                            <button class="btn btn-icon-sm btn-light-soft text-primary"><i class="ri-download-cloud-2-line"></i></button>
                                            <button class="btn btn-icon-sm btn-light-soft text-danger"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 sticky-top-workspace" style="top: 24px; z-index: 2;">
                    
                    <div class="px-24 py-16 bg-base border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0">
                            <i class="ri-upload-cloud-fill text-indigo me-2"></i>Asset Upload Engine
                        </h6>
                        <span class="text-xxs fw-bold text-indigo bg-primary-50 px-8 py-4 radius-4">V2 Interface</span>
                    </div>

                    <form action="#" method="POST" id="academicUploadForm" class="p-24 text-xs">
                        <div class="row g-3 mb-16">
                            
                            <div class="col-md-12">
                                <label class="form-label-premium">Resource Classification Type <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs" id="resourceType" onchange="handleFormTransformation()" required>
                                    <option value="Previous Year Paper">Previous Year Question Paper</option>
                                    <option value="Assignment">Assignment Form</option>
                                    <option value="Syllabus">Syllabus Guide</option>
                                    <option value="Study Material">Study Material Booklet</option>
                                    <option value="Teaching Video">Teaching Video Session</option>
                                    <option value="Time Table">Academic Time Table</option>
                                    <option value="Webinar">Webinar Stream Record</option>
                                </select>
                            </div>

                            <div class="col-md-6" id="dateWrapper">
                                <label class="form-label-premium">Date Token <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="date" class="form-control form-control-premium font-monospace text-xs" value="2026-06-12">
                                    <i class="ri-calendar-line select-overlay-icon text-indigo"></i>
                                </div>
                            </div>

                            <div class="col-md-6" id="classWrapper">
                                <label class="form-label-premium">Target Class <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="" disabled selected>Select explicit class</option>
                                    <option value="NURSERY">NURSERY</option>
                                    <option value="LKG">LKG</option>
                                    <option value="XI">Class XI</option>
                                    <option value="XII">Class XII</option>
                                </select>
                            </div>

                            <div class="col-md-6" id="divisionWrapper">
                                <label class="form-label-premium">Division / Section <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="" disabled selected>Select division</option>
                                    <option value="A">Division A</option>
                                    <option value="B">Division B</option>
                                </select>
                            </div>

                            <div class="col-md-6" id="subjectWrapper">
                                <label class="form-label-premium">Subject Categorization <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="" disabled selected>Select subject</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="English">English</option>
                                    <option value="Mathematics">Mathematics</option>
                                </select>
                            </div>

                            <div class="col-md-12" id="daysWrapper">
                                <label class="form-label-premium">Applicable Routine Days <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="M,W,F">Mon, Wed, Fri</option>
                                    <option value="T,Th,S">Tue, Thu, Sat</option>
                                    <option value="All">M,T,W,Th,F,S,Su</option>
                                </select>
                            </div>

                            <div class="col-md-6" id="paperNameWrapper">
                                <label class="form-label-premium">Paper Code / Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-premium text-xs" placeholder="e.g. eng-v1">
                            </div>

                            <div class="col-md-6" id="paperYearWrapper">
                                <label class="form-label-premium">Examination Year <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-premium font-monospace text-xs" value="2026">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label-premium">Asset Node Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-premium text-xs fw-semibold" placeholder="Enter concise asset title descriptor..." required>
                            </div>

                            <div class="col-md-12" id="descriptionWrapper">
                                <label class="form-label-premium">Detailed Description Context</label>
                                <textarea class="form-control form-control-premium text-xs py-10" rows="3" placeholder="Elaborate documentation instructions..."></textarea>
                            </div>

                            <div class="col-md-12" id="linkWrapper">
                                <label class="form-label-premium">Resource URL Streaming Link <span class="text-danger">*</span></label>
                                <input type="url" class="form-control form-control-premium text-xs font-monospace" placeholder="https://youtube.com/watch?v=...">
                            </div>
                        </div>

                        <div class="p-16 radius-12 bg-light-soft border border-neutral-200 mb-20" id="mediaUploadContainer">
                            <label class="form-label-premium mb-10 text-center text-muted">Attach Resource Payload Files</label>
                            <div class="d-flex flex-wrap gap-2 justify-content-center" id="uploadButtonsFlex">
                                <button type="button" id="btnImg" class="btn btn-xs btn-danger px-14 py-8 radius-6 d-flex align-items-center gap-1"><i class="ri-image-line"></i> Browse Img</button>
                                <button type="button" id="btnPdf" class="btn btn-xs btn-danger px-14 py-8 radius-6 d-flex align-items-center gap-1"><i class="ri-file-pdf-2-line"></i> Browse PDF</button>
                                <button type="button" id="btnDoc" class="btn btn-xs btn-danger px-14 py-8 radius-6 d-flex align-items-center gap-1"><i class="ri-word-wrap"></i> Browse Doc</button>
                                <button type="button" id="btnPpt" class="btn btn-xs btn-danger px-14 py-8 radius-6 d-flex align-items-center gap-1"><i class="ri-slideshow-line"></i> Browse PPT</button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-2 pt-14 border-top">
                            <button type="button" class="btn btn-sm btn-outline-neutral radius-8 px-16 py-8 fw-semibold" onclick="resetFormToDefaultState()">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-indigo radius-8 px-24 py-8 fw-bold tracking-wide shadow-indigo d-flex align-items-center gap-1">
                                <i class="ri-check-line text-sm"></i> Add Resource
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('push-scripts')
    <script>
        function handleFormTransformation() {
            var selectedVal = $('#resourceType').val();
            
            // Re-establish full control footprint visibility stack reset
            $('#dateWrapper, #classWrapper, #divisionWrapper, #subjectWrapper, #daysWrapper, #paperNameWrapper, #paperYearWrapper, #descriptionWrapper, #linkWrapper, #mediaUploadContainer').show();
            $('#btnImg, #btnPdf, #btnDoc, #btnPpt').show();

            // Strict matching rules algorithm optimized based on exact screenshot assets
            if (selectedVal === "Previous Year Paper") {
                $('#dateWrapper, #divisionWrapper, #subjectWrapper, #daysWrapper, #descriptionWrapper, #linkWrapper, #btnImg, #btnDoc, #btnPpt').hide();
            } 
            else if (selectedVal === "Assignment" || selectedVal === "Syllabus") {
                $('#paperNameWrapper, #paperYearWrapper, #linkWrapper, #btnDoc, #btnPpt').hide();
            } 
            else if (selectedVal === "Study Material") {
                $('#paperNameWrapper, #paperYearWrapper, #linkWrapper').hide(); 
            } 
            else if (selectedVal === "Teaching Video") {
                $('#paperNameWrapper, #paperYearWrapper, #mediaUploadContainer').hide();
            } 
            else if (selectedVal === "Time Table") {
                $('#dateWrapper, #subjectWrapper, #daysWrapper, #paperNameWrapper, #paperYearWrapper, #descriptionWrapper, #linkWrapper, #btnImg, #btnDoc, #btnPpt').hide();
            }
        }

        function resetFormToDefaultState() {
            document.getElementById('academicUploadForm').reset();
            handleFormTransformation();
        }

        // Run instantiation configuration loop instantly
        $(document).ready(function() {
            handleFormTransformation();
        });
    </script>
    
    <style>
        /* CSS Optimization Matrix Engine Parameters */
        .text-gradient-indigo {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand-pulse-gradient {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            width: 44px; height: 44px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px;
        }
        .shadow-indigo { box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.25); }
        .shadow-2 { box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05) !important; }
        .radius-16 { border-radius: 16px !important; }
        .radius-12 { border-radius: 12px !important; }
        .radius-6 { border-radius: 6px !important; }
        .bg-light-soft { background-color: #f8fafc !important; }
        
        .form-label-premium {
            font-size: 11px; font-weight: 700; color: #475569;
            text-transform: uppercase; letter-spacing: 0.05em;
            margin-bottom: 6px; display: block;
        }
        .form-control-premium {
            border: 1.5px solid #e2e8f0 !important;
            padding: 10px 14px; border-radius: 8px !important;
            color: #1e293b; font-weight: 600; transition: all 0.2s;
        }
        .form-control-premium:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12) !important;
        }
        .select-overlay-icon {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); pointer-events: none; opacity: 0.7;
        }
        .btn-indigo { background-color: #4f46e5; color: white; border: none; }
        .btn-indigo:hover { background-color: #4338ca; color: white; }

        .hover-table tbody tr:hover { background-color: rgba(79, 70, 229, 0.02) !important; }
        .btn-icon-sm {
            width: 28px; height: 28px; padding: 0; display: inline-flex;
            align-items: center; justify-content: center; border-radius: 6px; border: none;
        }
        .btn-light-soft { background-color: #f1f5f9; }
        .btn-light-soft:hover { background-color: #e2e8f0; }

        .btn-xs { padding: 6px 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; }

        .premium-table-scroll::-webkit-scrollbar { width: 5px; }
        .premium-table-scroll::-webkit-scrollbar-thumb { background: rgba(79, 70, 229, 0.15); border-radius: 10px; }
        
        @media (min-width: 1200px) {
            .sticky-top-workspace { position: sticky !important; }
        }
    </style>
@endpush