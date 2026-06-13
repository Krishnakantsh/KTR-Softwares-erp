@extends('Frontend.Normal.Layout.main')

@section('title', 'G S PUBLIC SCHOOL - Study Material Master Node')

@section('dynamic-content')
    <div class="dashboard-main-body" style="background: #f8fafc; min-height: 100vh;">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-100 mb-24 position-relative">
            <div class="position-absolute top-0 end-0 p-0 pointer-events-none opacity-50"
                style="background: radial-gradient(circle at 80% 20%, rgba(79, 70, 229, 0.08) 0%, transparent 50%); width: 500px; height: 100%; z-index: 1;">
            </div>
            <div class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center flex-wrap gap-4 position-relative"
                style="z-index: 2;">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-gradient shadow-primary">
                        <i class="ri-folder-shared-fill text-xl text-white"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-black mb-4 text-gradient-primary tracking-tight">Study Material</h5>
                        <p class="text-xs text-muted mb-0 fw-medium">Manage comprehensive academic distributions, sync
                            lesson syllabi, assignments, and external learning resources.</p>
                    </div>
                </div>
              
            </div>
        </div>

        <div class="row g-4">

            <div class="col-xl-7 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 h-100 d-flex flex-column overflow-hidden">
                    <div class="px-24 py-16 bg-base border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0">
                            <i class="ri-table-line text-primary me-2"></i>Active Repository Records
                        </h6>
                  
                    </div>

                    <div class="p-16 bg-light-soft border-bottom d-flex gap-3">
                        <div class="position-relative flex-grow-1">
                            <i
                                class="ri-search-line position-absolute top-50 start-0 translate-middle-y ms-12 text-muted text-sm"></i>
                            <input type="text" class="form-control form-control-sm ps-36 radius-8 text-xs bg-base"
                                placeholder="Search by title, subject or type...">
                        </div>
                        <select class="form-select form-select-sm radius-8 text-xs bg-base w-auto"
                            style="min-width: 130px;">
                            <option value="">All Categories</option>
                            <option value="Assignment">Assignment</option>
                            <option value="Syllabus">Syllabus</option>
                            <option value="Study Material">Study Material</option>
                            <option value="Teaching Video">Teaching Video</option>
                            <option value="Time Table">Time Table</option>
                            <option value="Webinar">Webinar</option>
                        </select>
                    </div>

                    <div class="table-responsive flex-grow-1 premium-table-scroll"
                        style="max-height: 560px; overflow-y: auto;">
                        <table class="table hover-table vertical-middle mb-0 text-xs">
                            <thead class="bg-light text-uppercase tracking-wider sticky-top top-0 bg-base"
                                style="z-index:3; border-bottom: 2px solid #e2e8f0;">
                                <tr>
                                    <th class="py-12 ps-20 text-muted fw-bold">Classification / Type</th>
                                    <th class="py-12 text-muted fw-bold">Academic Targeting</th>
                                    <th class="py-12 text-muted fw-bold">Core Title / Content Details</th>
                                    <th class="py-12 text-muted fw-bold">Attached assets</th>
                                    <th class="py-12 pe-20 text-end fw-bold">System Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-20 py-14">
                                        <span
                                            class="badge bg-primary-50 text-indigo border border-primary-200 px-8 py-4 radius-6 fw-bold tracking-wide">Assignment</span>
                                        <div class="text-xxs text-muted mt-4 font-monospace">12 June 2026</div>
                                    </td>
                                    <td>
                                        <div class="fw-black text-dark-main">NURSERY - A</div>
                                        <div class="text-xxs text-muted mt-2 fw-medium">Subject: Hindi</div>
                                        <div class="text-xxs text-primary font-monospace mt-2"><i
                                                class="ri-calendar-event-line me-1"></i>M,T,W,Th,F,S,Su</div>
                                    </td>
                                    <td>
                                        <h6 class="text-xs fw-bold text-dark-main mb-4">Shabd Rachna Exercise 04</h6>
                                        <p class="text-xxs text-muted mb-0 truncate-text">Trace and learn 3 letter basic
                                            characters with illustrations.</p>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            <span
                                                class="text-xxs text-danger fw-bold d-inline-flex align-items-center gap-1"><i
                                                    class="ri-file-pdf-fill text-sm"></i> worksheet_v1.pdf</span>
                                            <span
                                                class="text-xxs text-success fw-bold d-inline-flex align-items-center gap-1"><i
                                                    class="ri-image-fill text-sm"></i> cover_sample.jpg</span>
                                        </div>
                                    </td>
                                    <td class="pe-20 text-end">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-sm btn-icon btn-light-soft text-primary radius-8"
                                                title="Edit Entry"><i class="ri-edit-2-line"></i></button>
                                            <button class="btn btn-sm btn-icon btn-light-soft text-danger radius-8"
                                                title="Purge Record"><i class="ri-delete-bin-6-line"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-20 py-14">
                                        <span
                                            class="badge bg-purple-50 text-purple-700 border border-purple-200 px-8 py-4 radius-6 fw-bold tracking-wide">Teaching
                                            Video</span>
                                        <div class="text-xxs text-muted mt-4 font-monospace">11 June 2026</div>
                                    </td>
                                    <td>
                                        <div class="fw-black text-dark-main">CLASS V - B</div>
                                        <div class="text-xxs text-muted mt-2 fw-medium">Subject: Mathematics</div>
                                        <div class="text-xxs text-primary font-monospace mt-2"><i
                                                class="ri-calendar-event-line me-1"></i>M,W,F</div>
                                    </td>
                                    <td>
                                        <h6 class="text-xs fw-bold text-dark-main mb-4">Geometric Fraction Vectors
                                            Visualized</h6>
                                        <p class="text-xxs text-muted mb-0 truncate-text">Animated video session resolving
                                            real-world fraction operations.</p>
                                    </td>
                                    <td>
                                        <a href="https://youtube.com" target="_blank"
                                            class="text-xxs text-primary fw-bold d-inline-flex align-items-center gap-1"><i
                                                class="ri-youtube-fill text-sm text-danger"></i> Watch Stream Link</a>
                                    </td>
                                    <td class="pe-20 text-end">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-sm btn-icon btn-light-soft text-primary radius-8"><i
                                                    class="ri-edit-2-line"></i></button>
                                            <button class="btn btn-sm btn-icon btn-light-soft text-danger radius-8"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-20 py-14">
                                        <span
                                            class="badge bg-warning-50 text-warning-700 border border-warning-200 px-8 py-4 radius-6 fw-bold tracking-wide">Syllabus</span>
                                        <div class="text-xxs text-muted mt-4 font-monospace">10 June 2026</div>
                                    </td>
                                    <td>
                                        <div class="fw-black text-dark-main">NURSERY - A</div>
                                        <div class="text-xxs text-muted mt-2 fw-medium">Subject: English</div>
                                        <div class="text-xxs text-primary font-monospace mt-2"><i
                                                class="ri-calendar-event-line me-1"></i>All Days</div>
                                    </td>
                                    <td>
                                        <h6 class="text-xs fw-bold text-dark-main mb-4">Term-1 Rhymes & Alphabet Matrix</h6>
                                        <p class="text-xxs text-muted mb-0 truncate-text">Detailed timeline framework
                                            mapping course contents from June to September.</p>
                                    </td>
                                    <td>
                                        <span class="text-xxs text-danger fw-bold d-inline-flex align-items-center gap-1"><i
                                                class="ri-file-pdf-fill text-sm"></i> term1_syllabus.pdf</span>
                                    </td>
                                    <td class="pe-20 text-end">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-sm btn-icon btn-light-soft text-primary radius-8"><i
                                                    class="ri-edit-2-line"></i></button>
                                            <button class="btn btn-sm btn-icon btn-light-soft text-danger radius-8"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-bottom border-neutral-100">
                                    <td class="ps-20 py-14">
                                        <span
                                            class="badge bg-neutral-900 text-white px-8 py-4 radius-6 fw-bold tracking-wide">Time
                                            Table</span>
                                        <div class="text-xxs text-muted mt-4 font-monospace">09 June 2026</div>
                                    </td>
                                    <td>
                                        <div class="fw-black text-dark-main">CLASS IX - C</div>
                                        <div class="text-xxs text-muted mt-2 fw-medium">Subject: General Science</div>
                                        <div class="text-xxs text-muted mt-2">N/A</div>
                                    </td>
                                    <td>
                                        <h6 class="text-xs fw-bold text-dark-main mb-4">Weekly Laboratory Practical
                                            Schedule Matrix</h6>
                                        <p class="text-xxs text-muted mb-0 truncate-text">Lab session shifts assigned for
                                            physics and chemistry configurations.</p>
                                    </td>
                                    <td>
                                        <span
                                            class="text-xxs text-danger fw-bold d-inline-flex align-items-center gap-1"><i
                                                class="ri-file-pdf-fill text-sm"></i> master_timetable.pdf</span>
                                    </td>
                                    <td class="pe-20 text-end">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-sm btn-icon btn-light-soft text-primary radius-8"><i
                                                    class="ri-edit-2-line"></i></button>
                                            <button class="btn btn-sm btn-icon btn-light-soft text-danger radius-8"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-16 border-top bg-light-soft d-flex justify-content-between align-items-center text-xxs">
                        <span class="text-muted fw-medium">Showing 1 to 4 of 24 distributed items</span>
                        <div class="d-inline-flex gap-1">
                            <button class="btn btn-xs btn-outline-neutral radius-4 px-8 py-2 font-monospace" disabled><i
                                    class="ri-arrow-left-s-line"></i></button>
                            <button class="btn btn-xs btn-neutral radius-4 px-8 py-2 font-monospace active">1</button>
                            <button class="btn btn-xs btn-outline-neutral radius-4 px-8 py-2 font-monospace">2</button>
                            <button class="btn btn-xs btn-outline-neutral radius-4 px-8 py-2 font-monospace"><i
                                    class="ri-arrow-right-s-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-12">
                <div class="shadow-2 radius-16 bg-base border border-neutral-200 sticky-top-workspace"
                    style="top: 24px; z-index: 2;">
                    <div class="px-24 py-16 bg-base border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="text-xs fw-black text-dark-main text-uppercase tracking-widest mb-0">
                            <i class="ri-add-box-line text-success me-2"></i>Configure Distribution Entry
                        </h6>
                     
                    </div>

                    <form action="#" method="POST" id="studyMaterialForm" class="p-24 text-xs">
                        <div class="mb-16 input-box-wrapper">
                            <label class="form-label-premium"><span class="text-primary-600 fw-bold">
                                    Type</span> <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <select class="form-select form-control-premium text-xs fw-bold" id="materialType"
                                    required onchange="handleTypeEvaluation()">
                                    <option value="" disabled selected>-- Select Asset Classification --</option>
                                    <option value="Assignment">Assignment</option>
                                    <option value="Syllabus">Syllabus</option>
                                    <option value="Study Material">Study Material</option>
                                    <option value="Teaching Video">Teaching Video</option>
                                    <option value="Time Table">Time Table</option>
                                    <option value="Webinar">Webinar</option>
                                </select>
                                <i class="ri-folder-open-line select-overlay-icon text-primary"></i>
                            </div>
                        </div>

                        <div class="row g-3 mb-16">
                            <div class="col-md-6 cond-element shadow-block" id="block-date">
                                <label class="form-label-premium">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-premium font-monospace text-xs"
                                    value="2026-06-12">
                            </div>
                            <div class="col-md-6 cond-element" id="block-class">
                                <label class="form-label-premium">Class <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="">Select Class</option>
                                    <option value="Nursery">Nursery</option>
                                    <option value="Class 1">Class I</option>
                                    <option value="Class 5">Class V</option>
                                    <option value="Class 9">Class IX</option>
                                </select>
                            </div>
                        
                            <div class="col-md-4 cond-element" id="block-division">
                                <label class="form-label-premium">Division <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="">Select</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                            <div class="col-md-4 cond-element" id="block-subject">
                                <label class="form-label-premium">Subject <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="">Select</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="English">English</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="General Science">General Science</option>
                                </select>
                            </div>
                            <div class="col-md-4 cond-element" id="block-days">
                                <label class="form-label-premium">Days <span class="text-danger">*</span></label>
                                <select class="form-select form-control-premium text-xs">
                                    <option value="">Select</option>
                                    <option value="Mon-Fri">M,T,W,Th,F</option>
                                    <option value="All Days">M,T,W,Th,F,S,Su</option>
                                    <option value="Custom Alternate">M,W,F</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-16 input-box-wrapper cond-element" id="block-title">
                            <label class="form-label-premium">Resource Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-premium text-xs fw-semibold"
                                placeholder="Enter explicit metadata or distribution header token...">
                        </div>

                        <div class="mb-16 input-box-wrapper cond-element" id="block-description">
                            <label class="form-label-premium">Brief Content Summary / Instructions</label>
                            <textarea class="form-control form-control-premium text-xs py-10" rows="3"
                                placeholder="Provide strategic details, contextual assignments mapping rules or notes..."></textarea>
                        </div>

                        <div class="mb-20 input-box-wrapper cond-element d-none" id="block-link">
                            <label class="form-label-premium">Dynamic URL Stream Link <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="url"
                                    class="form-control form-control-premium text-xs text-primary font-monospace ps-36"
                                    placeholder="https://studio.youtube.com/embed/ref-code-token">
                                <i
                                    class="ri-global-line position-absolute top-50 start-0 translate-middle-y ms-14 text-muted text-sm"></i>
                            </div>
                        </div>

                        <div class="p-16 radius-12 bg-light-soft border border-neutral-200 mb-24 cond-element d-none"
                            id="block-file-actions">
                            <span class="text-uppercase tracking-widest text-muted fw-bold mb-12 d-block"
                                style="font-size: 10px;">Asset Document Provisioning Matrix</span>

                            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-start">
                                <div class="file-uploader-btn d-none" id="btn-browse-img">
                                    <input type="file" id="fileImg" class="d-none" accept="image/*">
                                    <button type="button"
                                        class="btn btn-xs btn-danger font-monospace px-12 py-8 radius-6 fw-bold d-flex align-items-center gap-1"
                                        onclick="$('#fileImg').click();">
                                        <i class="ri-image-add-line text-sm"></i> Browse Img
                                    </button>
                                </div>
                                <div class="file-uploader-btn d-none" id="btn-browse-pdf">
                                    <input type="file" id="filePdf" class="d-none" accept=".pdf">
                                    <button type="button"
                                        class="btn btn-xs btn-danger font-monospace px-12 py-8 radius-6 fw-bold d-flex align-items-center gap-1"
                                        onclick="$('#filePdf').click();">
                                        <i class="ri-file-pdf-line text-sm"></i> Browse PDF
                                    </button>
                                </div>
                                <div class="file-uploader-btn d-none" id="btn-browse-doc">
                                    <input type="file" id="fileDoc" class="d-none" accept=".doc,.docx">
                                    <button type="button"
                                        class="btn btn-xs btn-danger font-monospace px-12 py-8 radius-6 fw-bold d-flex align-items-center gap-1"
                                        onclick="$('#fileDoc').click();">
                                        <i class="ri-file-word-line text-sm"></i> Browse Doc
                                    </button>
                                </div>
                                <div class="file-uploader-btn d-none" id="btn-browse-ppt">
                                    <input type="file" id="filePpt" class="d-none" accept=".ppt,.pptx">
                                    <button type="button"
                                        class="btn btn-xs btn-danger font-monospace px-12 py-8 radius-6 fw-bold d-flex align-items-center gap-1"
                                        onclick="$('#filePpt').click();">
                                        <i class="ri-ppt-line text-sm"></i> Browse PPT
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-2 pt-14 border-top">
                            <button type="button" class="btn btn-sm btn-outline-neutral radius-8 px-16 py-8 fw-semibold"
                                onclick="resetAestheticForm()">Cancel</button>
                            <button type="submit"
                                class="btn btn-sm btn-indigo radius-8 px-20 py-8 fw-bold tracking-wide shadow-primary d-flex align-items-center gap-1">
                                <i class="ri-checkbox-circle-line"></i> Add Asset Node
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            console.log("Study Material Conditional Master Grid Active.");
            // Initializing evaluation trigger state
            handleTypeEvaluation();
        });

        function handleTypeEvaluation() {
            var selectedType = $('#materialType').val();

            // Sabhi specialized blocks aur multi-uploaders buttons ko hide karke override set karein
            $('.cond-element').removeClass('d-none');
            $('.file-uploader-btn').addClass('d-none');
            $('#block-file-actions').addClass('d-none');
            $('#block-link').addClass('d-none');

            if (!selectedType) {
                // Agar kuch selected nahi h to baaki forms hide rahegi secondary clarity ke liye
                return;
            }

            // Conditioning core algorithm switch according to provided reference snapshots
            switch (selectedType) {
                case 'Assignment':
                case 'Syllabus':
                    $('#block-file-actions').removeClass('d-none');
                    $('#btn-browse-img').removeClass('d-none');
                    $('#btn-browse-pdf').removeClass('d-none');
                    break;

                case 'Study Material':
                    $('#block-file-actions').removeClass('d-none');
                    $('#btn-browse-img').removeClass('d-none');
                    $('#btn-browse-pdf').removeClass('d-none');
                    $('#btn-browse-doc').removeClass('d-none');
                    $('#btn-browse-ppt').removeClass('d-none');
                    break;

                case 'Teaching Video':
                case 'Webinar':
                    $('#block-link').removeClass('d-none');
                    break;

                case 'Time Table':
                    // Time table configuration layout drops Date, Division & Description inputs to sync exact profile
                    $('#block-date').addClass('d-none');
                    $('#block-days').addClass('d-none');
                    $('#block-subject').addClass('d-none');
                    $('#block-description').addClass('d-none');

                    $('#block-file-actions').removeClass('d-none');
                    $('#btn-browse-pdf').removeClass('d-none');
                    break;
            }
        }

        function resetAestheticForm() {
            document.getElementById('studyMaterialForm').reset();
            handleTypeEvaluation();
        }
    </script>

    <style>
        /* Premium Global Variables & Aesthetic Framework Rules */
        .text-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-pulse-gradient {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .shadow-primary {
            box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.25);
        }

        .shadow-2 {
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 8px -1px rgba(15, 23, 42, 0.03) !important;
        }

        .radius-16 {
            border-radius: 16px !important;
        }

        .radius-12 {
            border-radius: 12px !important;
        }

        .radius-8 {
            border-radius: 8px !important;
        }

        .bg-light-soft {
            background-color: #f8fafc !important;
        }

        /* Premium Core Form Elements Override */
        .form-label-premium {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            text-uppercase: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
            display: block;
        }

        .form-control-premium {
            border: 1.5px solid #e2e8f0 !important;
            padding: 10px 14px;
            border-radius: 8px !important;
            color: #1e293b;
            font-weight: 500;
            transition: all 0.2s ease;
            background-color: #ffffff;
        }

        .form-control-premium:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12) !important;
            background-color: #fff;
        }

        .select-overlay-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 14px;
            opacity: 0.7;
        }

        select.form-control-premium {
            appearance: none;
            padding-right: 36px;
        }

        .btn-indigo {
            background-color: #4f46e5;
            color: white;
            transition: background 0.2s;
        }

        .btn-indigo:hover {
            background-color: #4338ca;
            color: white;
        }

        /* Table Optimization Framework UI */
        .hover-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .hover-table tbody tr:hover {
            background-color: rgba(79, 70, 229, 0.02) !important;
        }

        .truncate-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #64748b;
        }

        .btn-icon {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .btn-light-soft {
            background-color: #f1f5f9;
            border: none;
        }

        .btn-light-soft:hover {
            background-color: #e2e8f0;
        }

        /* Scroll Engine Override Control Setup */
        .premium-table-scroll::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .premium-table-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 10px;
        }

        .premium-table-scroll::-webkit-scrollbar-thumb {
            background: rgba(79, 70, 229, 0.15);
            border-radius: 10px;
        }

        .premium-table-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(79, 70, 229, 0.3);
        }

        /* Responsive Floating Systems Tracker Control */
        @media (min-width: 1200px) {
            .sticky-top-workspace {
                position: sticky !important;
            }
        }

        .pulse-green-dot {
            width: 6px;
            height: 6px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-block;
            animation: pulse-dot-key 1.8s infinite;
        }

        @keyframes pulse-dot-key {
            0% {
                transform: scale(0.9);
                opacity: 1;
            }

            50% {
                transform: scale(1.3);
                opacity: 0.4;
            }

            100% {
                transform: scale(0.9);
                opacity: 1;
            }
        }
    </style>
@endpush
