@extends('Frontend.Normal.Layout.main')

@section('title', 'G S PUBLIC SCHOOL - Homework Management Hub')

@section('dynamic-content')
    <div class="dashboard-main-body" style="background: #f8fafc; min-height: 100vh;">
        
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-100 mb-24">
            <div class="position-absolute top-0 end-0 p-0 pointer-events-none opacity-50" 
                style="background: radial-gradient(circle at 80% 20%, rgba(79, 70, 229, 0.1) 0%, transparent 50%); width: 500px; height: 100%; z-index: 1;">
            </div>
            <div class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center flex-wrap gap-4 position-relative" style="z-index: 2;">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-gradient shadow-primary">
                        <i class="ri-book-3-fill text-xl text-white"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-black mb-4 text-gradient-primary tracking-tight">Home Work</h5>
                        <p class="text-xs text-muted mb-0 fw-medium">Assign, track, and evaluate daily scholastic tasks across various academic cycles.</p>
                    </div>
                </div>
          
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-xl-7 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 d-flex flex-column overflow-hidden">
                    <div class="px-24 py-16 bg-base border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0">
                            <i class="ri-list-check-2 text-primary me-2"></i>Scholastic Task Ledger
                        </h6>
                       
                    </div>

                    <div class="p-16 bg-light-soft border-bottom d-flex gap-3 align-items-center">
                        <div class="position-relative flex-grow-1">
                            <i class="ri-search-2-line position-absolute top-50 start-0 translate-middle-y ms-12 text-muted text-sm"></i>
                            <input type="text" class="form-control form-control-sm ps-36 radius-10 text-xs bg-base border-neutral-200" placeholder="Filter by subject, title or teacher...">
                        </div>
                        <button class="btn btn-sm btn-white border radius-8 text-xxs fw-bold px-12"><i class="ri-filter-3-line me-1"></i> Advanced Filter</button>
                    </div>

                    <div class="table-responsive flex-grow-1 premium-table-scroll" style="max-height: 600px; overflow-y: auto;">
                        <table class="table hover-table vertical-middle mb-0 text-xs">
                            <thead class="bg-light text-uppercase tracking-wider sticky-top top-0 bg-base shadow-sm" style="z-index:3;">
                                <tr>
                                    <th class="py-14 ps-24 text-muted fw-bold">S.No.</th>
                                    <th class="py-14 text-muted fw-bold">Assign Date</th>
                                    <th class="py-14 text-muted fw-bold">Class-Section</th>
                                    <th class="py-14 text-muted fw-bold">Subject / Title</th>
                                    <th class="py-14 text-muted fw-bold">Issued By</th>
                                    <th class="py-14 pe-24 text-end fw-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-24 py-16 fw-bold text-muted">1</td>
                                    <td>
                                        <div class="fw-black text-dark-main font-monospace">2026-06-08</div>
                                        <span class="text-xxs text-primary bg-primary-50 px-4 radius-2">Active Task</span>
                                    </td>
                                    <td>
                                        <div class="fw-black text-dark-main">UKG - A</div>
                                    </td>
                                    <td>
                                        <div class="fw-black text-indigo mb-2">English</div>
                                        <div class="text-xs text-dark-main fw-semibold">Read chapter 1</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle-xs bg-neutral-900 text-white fw-bold">A</div>
                                            <span class="fw-bold text-dark-main">Admin</span>
                                        </div>
                                    </td>
                                    <td class="pe-24 text-end">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-icon-sm btn-light-soft text-primary shadow-sm"><i class="ri-eye-line"></i></button>
                                            <button class="btn btn-icon-sm btn-light-soft text-danger shadow-sm"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-24 py-16 fw-bold text-muted">2</td>
                                    <td>
                                        <div class="fw-black text-dark-main font-monospace">2026-06-09</div>
                                    </td>
                                    <td><div class="fw-black text-dark-main">V - B</div></td>
                                    <td>
                                        <div class="fw-black text-indigo mb-2">Mathematics</div>
                                        <div class="text-xs text-dark-main fw-semibold">Exercise 2.4 (Q1 to Q10)</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle-xs bg-success text-white fw-bold">P</div>
                                            <span class="fw-bold text-dark-main">Prashant Sir</span>
                                        </div>
                                    </td>
                                    <td class="pe-24 text-end">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-icon-sm btn-light-soft text-primary shadow-sm"><i class="ri-eye-line"></i></button>
                                            <button class="btn btn-icon-sm btn-light-soft text-danger shadow-sm"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 sticky-top-workspace" style="top: 24px;">
                    
                    <div class="px-24 py-20 bg-base border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                         
                            <h6 class="text-sm fw-black text-dark-main text-uppercase tracking-wider mb-0 ms-16">
                                <span>Add</span> HOME WORK
                            </h6>
                        </div>
                       
                    </div>

                    <form action="#" method="POST" id="homeworkForm" class="p-24">
                        <div class="row g-4 mb-20">
                            <div class="col-md-12">
                                <div class="input-box-wrapper">
                                    <label class="form-label-premium">Target Date <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="date" class="form-control form-control-premium font-monospace" value="2026-06-12">
                                        <i class="ri-calendar-2-line select-overlay-icon text-primary"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box-wrapper">
                                    <label class="form-label-premium">Class <span class="text-danger">*</span></label>
                                    <select class="form-select form-control-premium text-xs fw-bold">
                                        <option value="" disabled selected>-- Select Class --</option>
                                        <option value="UKG">UKG</option>
                                        <option value="Class 1">Class 1</option>
                                        <option value="Class 5">Class 5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box-wrapper">
                                    <label class="form-label-premium">Section <span class="text-danger">*</span></label>
                                    <select class="form-select form-control-premium text-xs fw-bold">
                                        <option value="" disabled selected>-- Select Section --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-box-wrapper">
                                    <label class="form-label-premium">Subject <span class="text-danger">*</span></label>
                                    <select class="form-select form-control-premium text-xs fw-bold">
                                        <option value="" disabled selected>-- Select Subject --</option>
                                        <option value="English">English</option>
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="Science">Science</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-box-wrapper">
                                    <label class="form-label-premium">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-premium" placeholder="e.g. Read chapter 1 or Geometry Worksheet">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-box-wrapper">
                                    <label class="form-label-premium">Description</label>
                                    <textarea class="form-control form-control-premium py-12" rows="3" placeholder="Provide detailed instructions or content details..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="p-20 radius-12 bg-light-soft border border-dashed-custom mb-24">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-browse-premium px-24 py-10 radius-8" onclick="$('#fileInp').click()">
                                    Browse
                                </button>
                                <input type="file" id="fileInp" class="d-none">
                                <div class="text-end">
                                    <p class="text-danger fw-bold mb-0" style="font-size: 10px;">
                                        Note: Image & PDF Files Only <span class="text-muted">(Max 2MB)</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-3 pt-16 border-top">
                            <button type="button" class="btn btn-outline-neutral radius-8 px-24 py-10 fw-bold" onclick="resetHomework()">Cancel</button>
                            <button type="submit" class="btn btn-indigo radius-8 px-28 py-10 fw-black shadow-primary">
                                <i class="ri-add-circle-line me-1"></i> Add Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <style>
        /* Premium Core Theming */
        .text-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand-pulse-gradient {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            width: 42px; height: 42px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px;
        }
        .shadow-primary { box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.3); }
        .shadow-2 { box-shadow: 0 4px 20px -2px rgba(0,0,0,0.06); }
        .radius-16 { border-radius: 16px !important; }
        
        /* Table Styling */
        .hover-table tbody tr:hover { background-color: rgba(79, 70, 229, 0.02) !important; }
        .avatar-circle-xs {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px;
        }
        .btn-icon-sm {
            width: 30px; height: 30px; padding: 0;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 8px; border: none;
        }

        /* Form Aesthetics Overlay */
        .form-label-premium {
            font-size: 11px; font-weight: 700; color: #475569;
            text-transform: uppercase; letter-spacing: 0.05em;
            margin-bottom: 8px; display: block;
        }
        .form-control-premium {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 12px 14px; font-size: 13px; font-weight: 600;
            transition: all 0.2s; background: #fff;
        }
        .form-control-premium:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3.5px rgba(79, 70, 229, 0.1) !important;
        }
        .select-overlay-icon {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); pointer-events: none;
            font-size: 14px; opacity: 0.6;
        }
        
        /* Action Buttons */
        .btn-browse-premium {
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white; border: none; font-weight: 800; font-size: 12px;
            text-transform: uppercase; letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-browse-premium:hover { opacity: 0.9; transform: scale(1.02); color: #fff; }
        .btn-indigo { background: #4f46e5; color: #fff; border: none; font-size: 13px; }
        .btn-indigo:hover { background: #4338ca; color: #fff; }

        .border-dashed-custom { border: 2px dashed #e2e8f0 !important; }
        .hover-danger:hover { color: #ef4444 !important; }
        
        @media (min-width: 1200px) {
            .sticky-top-workspace { position: sticky !important; }
        }
    </style>

    <script>
        function resetHomework() {
            document.getElementById('homeworkForm').reset();
        }
    </script>
@endpush