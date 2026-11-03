<div class="premium-input-box position-relative student-search-wrapper">
    <!-- Hidden input to store selected student ID -->
    <input type="hidden" id="student_id" name="student_id">

    <!-- Label -->
    <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
        Search Student <span class="text-danger">*</span>
    </label>

    <!-- Input Wrapper -->
    <div class="inner-addon position-relative">
        <!-- Search Icon -->
        <i
            class="ri-search-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>

        <!-- Search Input Field -->
        <input type="text" class="form-control custom-premium-input ps-44 pe-40 py-12 radius-8" id="studentLiveSearch"
            placeholder="Search by name, SR no, roll no..." autocomplete="off">

        <!-- Clear Button -->
        <button type="button" class="search-clear-btn position-absolute end-0 top-50 me-16 translate-middle-y " id="clearSearchBtn" style="display: none;">
            <i class="ri-close-circle-fill"></i>
        </button>
    </div>

    <!-- Live Search Result Dropdown Container -->
    <div class="search-results-dropdown shadow-lg rounded-3 mt-2 p-16" id="searchResultsContainer"></div>
</div>

@push('styles')
    <style>
        /* Component Specific Styling */
        .student-search-wrapper {
            position: relative;
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

        .student-photo img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

    </style>
@endpush

@push('script')
    <script>
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

            // 3. Hide Dropdown on Outside Click
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.student-search-wrapper').length) {
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
                                <a href="javascript:void(0)" class="student-item d-flex gap-8" data-id="${student.student_id}">
                                    <div class="student-photo">
                                        <img src="${photo}" alt="${student.student_name}">
                                    </div>
                                    <div class="student-details d-flex">
                                        <div class="student-name">${student.student_name}</div>
                                        <div class="student-meta">
                                            <span><b>SR:</b> ${student.sr_no ?? 'N/A'}</span>
                                            <span><b>ADM:</b> ${student.admission_no ?? 'N/A'}</span>
                                             <span><b>Father:</b> ${student.father_name ?? 'N/A'}</span>
                                        </div>
                                    </div>
                                </a>
                            `;
                        });
                    } else {
                        html = `<div class="p-16 text-center text-muted text-sm">No student found</div>`;
                    }

                    $('#searchResultsContainer').html(html).fadeIn(200);
                } else {
                    $('#searchResultsContainer').hide();
                }
            });

            // 5. Select Item Event
            $(document).on('click', '.student-item', function() {
                let studentId = $(this).data('id');
                let selectedName = $(this).find('.student-name').text().trim();

                $('#student_id').val(studentId);
                $('#studentLiveSearch').val(selectedName);
                $('#searchResultsContainer').hide();

                if (typeof onSelectCallback === 'function') {
                    onSelectCallback(studentId);
                }
            });
        }

        // Initialize script on document load
        $(document).ready(function() {
            initStudentSearch(function(selectedId) {
                console.log("Selected Student ID:", selectedId);
            });
        });
    </script>
@endpush
