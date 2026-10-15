
<div class="student-search-hero-card mb-16 position-relative">
    <!-- Decorative Blended Background Shapes -->
    <div class="hero-bg-circle circle-1"></div>
    <div class="hero-bg-circle circle-2"></div>

    <div class="row align-items-center g-4 position-relative z-1">
        <!-- Left Side: Content & Search Bar -->
        <div class="col-lg-8 col-xl-8">
            <div class="search-hero-content p-24 p-md-32">
                <span
                    class="badge bg-primary-100 text-primary-700 font-semibold px-12 py-6 radius-8 text-xs mb-12 d-inline-flex align-items-center gap-1">
                    <i class="ri-sparkling-fill text-primary-600"></i> Quick Student Search
                </span>
                <h4 class="fw-bold text-neutral-900 mb-8">Find Student & Manage Records</h4>
                <p class="text-sm text-neutral-600 mb-20">Type name, admission number, SR number or enrollment number to
                    quick load student data.</p>

                <!-- Search Input Box Wrapper -->
                <div class="premium-search-wrapper position-relative">
                    <i class="bi bi-search premium-search-icon"></i>
                    <input type="hidden" id="student_id" name="student_id">
                    <input type="text" class="form-control premium-search-input" id="studentLiveSearch"
                        placeholder="Search student by name, sr no, enroll no, adm no..." autocomplete="off">

                    <button type="button" class="search-clear-btn" id="clearSearchBtn" style="display: none;">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>

                    <!-- Search Dropdown Container -->
                    <div class="search-results-dropdown shadow-lg" id="searchResultsContainer"></div>
                </div>
            </div>
        </div>


        <div class="col-lg-5 col-xl-4 d-none d-lg-block text-center pe-32">
            <div class="search-hero-illustration">
                <svg class="floating-illustration" width="220" height="180" viewBox="0 0 280 220" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="20" y="30" width="240" height="160" rx="20" fill="white" fill-opacity="0.7"
                        stroke="white" stroke-width="2" />

                    <circle cx="90" cy="110" r="38" fill="#4A5BF6" fill-opacity="0.15" />
                    <circle cx="90" cy="98" r="16" fill="#4A5BF6" />
                    <path d="M68 132C68 120 78 116 90 116C102 116 112 120 112 132" fill="#4A5BF6" />

                    <rect x="145" y="85" width="85" height="10" rx="5" fill="#4A5BF6" />
                    <rect x="145" y="105" width="60" height="8" rx="4" fill="#94A3B8" />
                    <rect x="145" y="121" width="40" height="8" rx="4" fill="#CBD5E1" />

                    <g class="pulse-badge">
                        <circle cx="215" cy="55" r="18" fill="#22C55E" />
                        <path d="M209 55L213 59L221 51" stroke="white" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>

                    <g class="search-badge">
                        <circle cx="50" cy="60" r="22" fill="#6366F1" />
                        <circle cx="48" cy="58" r="8" stroke="white" stroke-width="2.5" />
                        <path d="M54 64L60 70" stroke="white" stroke-width="2.5" stroke-linecap="round" />
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* Custom Premium Search Hero Banner */
        .student-search-hero-card {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8eeff 50%, #e0e8ff 100%);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 30px rgba(74, 91, 246, 0.08);
        }

        /* Background Blended Glow Circles */
        .hero-bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.6;
            pointer-events: none;
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            background: #c3d2ff;
            top: -50px;
            left: -50px;
        }

        .circle-2 {
            width: 250px;
            height: 250px;
            background: #e0d5ff;
            bottom: -80px;
            right: 15%;
        }

        /* Input Bar Custom Styling */
        .premium-search-wrapper {
            max-width: 600px;
        }

        .premium-search-input {
            height: 52px;
            padding-left: 48px !important;
            padding-right: 40px !important;
            border-radius: 14px !important;
            border: 1px solid #d0d7de !important;
            background-color: #ffffff !important;
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
            transition: all 0.25s ease-in-out;
        }

        .premium-search-input:focus {
            border-color: #4a5bf6 !important;
            box-shadow: 0 6px 20px rgba(74, 91, 246, 0.18) !important;
            outline: none;
        }

        .premium-search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #4a5bf6;
            z-index: 5;
        }

        .search-clear-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #9ca3af;
            font-size: 18px;
            cursor: pointer;
            z-index: 5;
            transition: color 0.2s;
        }

        .search-clear-btn:hover {
            color: #ef4444;
        }

        /* Floating Cartoon Illustration Animation & Blend */
        .search-hero-illustration {
            position: relative;
            padding-right: 20px;
        }

        .floating-illustration {
            max-height: 190px;
            object-fit: contain;
            /* Soft blend with background */
            filter: drop-shadow(0 12px 20px rgba(74, 91, 246, 0.15));
            animation: floatAnim 4s ease-in-out infinite;
        }

        @keyframes floatAnim {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Dropdown Custom Styling */
        .search-results-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            max-height: 320px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        /**
         * Reusable Student Search Module
         */
        let globalStudentsList = [];

        function initStudentSearch(onSelectCallback) {
            // 1. Fetch Students List
            $.ajax({
                url: "{{ route('school.common.search_student') }}",
                type: "GET",
                success: function(response) {
                    globalStudentsList = response;
                }
            });

            // 2. Input Toggle & Clear Button
            $('#studentLiveSearch').on('input', function() {
                let value = $(this).val().trim();
                if (value.length > 0) {
                    $('#clearSearchBtn').show();
                } else {
                    $('#clearSearchBtn').hide();
                }

                if (value.length > 1) {
                    $('#searchResultsContainer').fadeIn(200);
                } else {
                    $('#searchResultsContainer').fadeOut(150);
                }
            });

            // Clear Button Click Event
            $('#clearSearchBtn').on('click', function() {
                $('#studentLiveSearch').val('').focus();
                $('#student_id').val('');
                $(this).hide();
                $('#searchResultsContainer').fadeOut(150);
            });

            // 3. Hide on Outside Click
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.student-search-hero-card').length) {
                    $('#searchResultsContainer').fadeOut(150);
                }
            });

            // 4. Live Search Filtering
            $('#studentLiveSearch').on('keyup', function() {
                let keyword = $(this).val().toLowerCase().trim();
                let html = '';

                if (keyword.length > 2) {
                    let filtered = globalStudentsList.filter(student =>
                        (student.search_query || '').toLowerCase().includes(keyword)
                    );

                    if (filtered.length > 0) {
                        filtered.forEach(student => {
                            let photo = student.student_photo ? '/' + student.student_photo :
                                '/assets/images/_ (11).jpeg';

                            html += `
                        <a href="javascript:void(0)" class="student-item-premium student-item" data-id="${student.student_id}">
                            <div class="student-photo">
                                <img src="${photo}" alt="${student.student_name}">
                            </div>
                            <div class="student-details">
                                <div class="student-name">${student.student_name}</div>
                                <div class="student-meta">
                                    <span><b>SR:</b> ${student.sr_no}</span>
                                    <span><b>ADM:</b> ${student.admission_no}</span>
                                </div>
                                <div class="student-meta">
                                    <span><b>Father:</b> ${student.father_name}</span>
                                </div>
                            </div>
                        </a>
                    `;
                        });
                    } else {
                        html = `<div class="p-16 text-center text-neutral-500 text-sm">No student found</div>`;
                    }

                    $('#searchResultsContainer').html(html).fadeIn(200);
                } else {
                    $('#searchResultsContainer').hide();
                }
            });

            // 5. Select Item
            $(document).on('click', '.student-item', function() {
                let studentId = $(this).data('id');

                $('#student_id').val(studentId);
                $('#studentLiveSearch').val($(this).find('.student-name').text().trim());
                $('#searchResultsContainer').hide();

                if (typeof onSelectCallback === 'function') {
                    onSelectCallback(studentId);
                }
            });
        }
    </script>
@endpush
