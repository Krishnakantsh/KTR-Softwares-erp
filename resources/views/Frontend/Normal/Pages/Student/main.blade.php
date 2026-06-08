@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Student Management')

@section('dynamic-content')

  
    <div class="dashboard-main-body py-4">

        <div class="card premium-card">

            <form method="POST" class="ajaxForm" data-url="{{ route('student.registration.save') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="row g-0 h-100">

                    <div class="col-lg-3 col-md-4 h-100">
                        <div class="vertical-tabs-sidebar">
                            <!-- NEW: Student Registration Banner -->
                            <div class="student-reg-banner mb-3 text-center">
                                <div class="banner-overlay"></div>
                                <div class="banner-content">
                                    <i class="bi bi-mortarboard-fill banner-icon"></i>
                                    <h5>Student Registration</h5>
                                    {{-- <span
                                        class="badge bg-light text-dark px-3 py-2 rounded-pill shadow-sm">Registration</span> --}}
                                </div>
                            </div>
                            <!-- Banner End -->

                            <div class="nav flex-column nav-pills" id="studentTabs" role="tablist"
                                aria-orientation="vertical">

                                <button class="premium-nav-link active" data-bs-toggle="tab" data-bs-target="#basic"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-person-badge main-icon"></i> Basic Info
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-geo-alt main-icon"></i> Contact
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#personal"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-person-vcard main-icon"></i> Personal
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#education"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-mortarboard main-icon"></i> Education
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#parents"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-people main-icon"></i> Parents
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#documents"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-file-earmark-pdf main-icon"></i> Documents
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#bank" type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-bank main-icon"></i> Bank
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#transport"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-bus-front main-icon"></i> Transport
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#hostel"
                                    type="button">
                                    <span class="nav-link-content">
                                        <i class="bi bi-building main-icon"></i> Hostel
                                    </span>
                                    <i class="bi bi-chevron-right arrow-icon"></i>
                                </button>

                                <hr>


                                <a href="javascript:void(0)" class="premium-nav-link premium-nav-config"
                                    data-bs-toggle="modal" data-bs-target="#housesModal">
                                    <span class="nav-link-content">
                                        <div class="config-icon-wrapper">
                                            <i class="bi bi-house-gear-fill config-main-icon"></i>
                                        </div>
                                        <span class="config-text-wrapper">
                                            House System
                                            {{-- <span class="config-sub-text">Configure student houses</span> --}}
                                        </span>
                                    </span>
                                    <i class="bi bi-sliders arrow-icon-config"></i>
                                </a>

                                <a href="javascript:void(0)" class="premium-nav-link premium-nav-config"
                                    data-bs-toggle="modal" data-bs-target="#streamModal">
                                    <span class="nav-link-content">
                                        <div class="config-icon-wrapper">
                                            <i class="bi bi-mortarboard-fill config-main-icon"></i>
                                        </div>
                                        <span class="config-text-wrapper">
                                            Academic Streams
                                            {{-- <span class="config-sub-text">Manage branches & majors</span> --}}
                                        </span>
                                    </span>
                                    <i class="bi bi-sliders arrow-icon-config"></i>
                                </a>

                                <a href="{{ route('school.class.master.index') }}"
                                    class="premium-nav-link premium-nav-config">
                                    <span class="nav-link-content">
                                        <div class="config-icon-wrapper">
                                            <i class="bi bi-calendar3-event config-main-icon"></i>
                                        </div>
                                        <span class="config-text-wrapper">
                                            Class & Sections
                                            {{-- <span class="config-sub-text">Setup grades allocation</span> --}}
                                        </span>
                                    </span>
                                    <i class="bi bi-sliders arrow-icon-config"></i>
                                </a>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 h-100">
                        <div class="content-pane-wrapper">

                            <div class="sticky-top-action-bar d-flex justify-content-between align-items-center z-20">

                                <div class="premium-search-wrapper">
                                    <i class="bi bi-search premium-search-icon"></i>
                                    <input type="hidden" name="student_id" id="student_id">
                                    <input type="text" class="form-control premium-search-input"
                                        id="studentLiveSearch"
                                        placeholder="Search student record by name, sr no, enroll no, adm no">

                                    <div class="search-results-dropdown" id="searchResultsContainer">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-premium-save">
                                    <i class="bi bi-check2-circle me-2"></i> Save Student
                                </button>

                            </div>

                            <div class="w-100 flex-grow-1 form-components-holder">
                                <div class="tab-content" id="studentTabsContent">

                                    <div class="tab-pane fade show active" id="basic">
                                        @include('Frontend.Normal.Pages.Student.components.basic')
                                    </div>

                                    <div class="tab-pane fade" id="contact">
                                        @include('Frontend.Normal.Pages.Student.components.contact')
                                    </div>

                                    <div class="tab-pane fade" id="personal">
                                        @include('Frontend.Normal.Pages.Student.components.personal')
                                    </div>

                                    <div class="tab-pane fade" id="education">
                                        @include('Frontend.Normal.Pages.Student.components.education')
                                    </div>

                                    <div class="tab-pane fade" id="parents">
                                        @include('Frontend.Normal.Pages.Student.components.parents')
                                    </div>

                                    <div class="tab-pane fade" id="documents">
                                        @include('Frontend.Normal.Pages.Student.components.documents')
                                    </div>

                                    <div class="tab-pane fade" id="bank">
                                        @include('Frontend.Normal.Pages.Student.components.bank')
                                    </div>

                                    <div class="tab-pane fade" id="transport">
                                        @include('Frontend.Normal.Pages.Student.components.transport')
                                    </div>

                                    <div class="tab-pane fade" id="hostel">
                                        @include('Frontend.Normal.Pages.Student.components.hostel')
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            localStorage.setItem('documentRowId', 0);

            generateAdmNo();
            generateSrNo();
            generateEnrollNo();
            loadStudents();


            $('#studentLiveSearch').on('input', function() {
                let value = $(this).val().trim();
                if (value.length > 1) {
                    $('#searchResultsContainer').fadeIn(200);
                } else {
                    $('#searchResultsContainer').fadeOut(150);
                }
            });

            // Close dropdown when clicked outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.premium-search-wrapper').length) {
                    $('#searchResultsContainer').fadeOut(150);
                }
            });

            // fetch all routes here 

            let students = [];

            function loadStudents() {

                $.ajax({
                    url: "{{ route('school.common.search_student') }}",
                    type: "GET",
                    success: function(response) {
                        students = response;
                    }
                });
            }


            $('#studentLiveSearch').on('keyup', function() {

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
                                <a href="javascript:void(0)"
                                    class="student-item-premium student-item"
                                    data-id="${student.student_id}">

                                    <div class="student-photo">
                                        <img src="${photo}" alt="${student.student_name}">
                                    </div>

                                    <div class="student-details">

                                        <div class="student-name">
                                            ${student.student_name}
                                        </div>

                                        <div class="student-meta">
                                            <span><b>SR:</b> ${student.sr_no}</span>
                                            <span><b>ADM:</b> ${student.admission_no}</span>
                                        </div>

                                        <div class="student-meta">
                                            <span><b>Father:</b> ${student.father_name}</span>
                                        </div>

                                        <div class="student-meta">
                                            <span><b>Mobile:</b> ${student.sms_whatsapp_no}</span>
                                        </div>

                                    </div>

                                </a>
                                `;
                        });

                    } else {

                        html = `
                                <div class="no-result">
                                    No student found
                                </div>
                            `;
                    }

                    $('#searchResultsContainer')
                        .html(html)
                        .fadeIn(200);

                } else {

                    $('#searchResultsContainer').hide();
                }
            });


            $(document).on('click', '.student-item', function() {

                let studentId = $(this).data('id');

                $('#student_id').val(studentId);

                loadStudent(studentId);

                $('#searchResultsContainer').hide();

                $('#studentLiveSearch').val(
                    $(this).text()
                );

            });



            async function loadStudent(studentId) {

                $.ajax({

                    url: "{{ route('student.show.with') }}",

                    method: "GET",

                    data: {
                        id: studentId
                    },

                    success: async function(response) {

                        let res = response.data;

                        setFormValues(res);

                        if (res.contact_detail) {

                            setFormValues(
                                res.contact_detail
                            );
                        }

                        if (res.personal_detail) {

                            setFormValues(
                                res.personal_detail
                            );
                        }

                        if (res.transport) {

                            $('#is_Transport_apply')
                                .prop('checked', true);

                            toggleTransportPanel(
                                document.getElementById('is_Transport_apply')
                            );

                            $('#route_id')
                                .val(res.transport.route_id);

                            await routeChanged(
                                res.transport.route_id
                            );

                            $('#vehicle_id')
                                .val(res.transport.vehicle_id);

                            $('#destination_id')
                                .val(res.transport.destination_id);

                            updateLiveMap();
                        }


                        if (res.hostel) {

                            $('#is_Hostel_apply')
                                .prop('checked', true);

                            toggleHostelPanel(
                                document.getElementById('is_Hostel_apply')
                            );

                            $('#hostel_id')
                                .val(res.hostel.hostel_id);

                            await hostelChanged(
                                res.hostel.hostel_id
                            );

                            $('#block_id')
                                .val(res.hostel.block_id);

                            await blockChanged(
                                res.hostel.block_id
                            );

                            $('#floor_id')
                                .val(res.hostel.floor_id);

                            await floorChanged(
                                res.hostel.floor_id
                            );

                            $('#room_id')
                                .val(res.hostel.room_id);

                            roomChanged(
                                res.hostel.room_id
                            );

                            updateLiveHostelMap();
                        }



                        if (res.bank_detail) {

                            setFormValues(
                                res.bank_detail
                            );

                            $('#confirm_account_no')
                                .val(
                                    res.bank_detail.account_no
                                );
                        }

                        if (res.class_id) {

                            $('select[name="class_id"]')
                                .val(res.class_id);

                            await loadSections(
                                res.class_id,
                                res.section_id
                            );
                        }

                        if (res.documents?.length) {
                            loadExistingDocuments(res.documents);
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | STREAM
                        |--------------------------------------------------------------------------
                        */

                        $('select[name="stream_id"]')
                            .val(res.stream_id)
                            .trigger('change');

                        /*
                        |--------------------------------------------------------------------------
                        | HOUSE
                        |--------------------------------------------------------------------------
                        */

                        $('select[name="house_id"]')
                            .val(res.house_id)
                            .trigger('change');

                        /*
                        |--------------------------------------------------------------------------
                        | PHOTO
                        |--------------------------------------------------------------------------
                        */

                        if (res.student_photo) {
                            loadStudentPhoto(res.student_photo);
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | PARENTS
                        |--------------------------------------------------------------------------
                        */

                        if (res.parents?.length) {

                            let father = res.parents.find(
                                p => p.parent_type === 'father'
                            );

                            let mother = res.parents.find(
                                p => p.parent_type === 'mother'
                            );

                            if (father) {

                                $('[name="father_name"]')
                                    .val(father.name);

                                $('[name="father_mobile"]')
                                    .val(father.phone);
                            }

                            if (mother) {

                                $('[name="mother_name"]')
                                    .val(mother.name);

                                $('[name="mother_mobile"]')
                                    .val(mother.phone);
                            }
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | CHECKBOXES
                        |--------------------------------------------------------------------------
                        */

                        $('#is_ews')
                            .prop('checked', res.is_ews);

                        $('#is_study_material')
                            .prop(
                                'checked',
                                res.is_study_material
                            );

                        $('#is_physically_challenged')
                            .prop(
                                'checked',
                                res.is_physically_challenged
                            );

                        verifyAccountNumberMatch();
                    }

                });

            }



            function setFormValues(data, prefix = '') {

                $.each(data, function(key, value) {



                    const ignoreFields = [
                        'id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'session_id'
                    ];

                    if (ignoreFields.includes(key)) {
                        return true;
                    }

                    let fieldName = prefix ? `${prefix}.${key}` : key;

                    // console.log(fieldName);

                    if (Array.isArray(value)) {

                        // pehli row already hai

                        if (key == 'education') {

                            for (let i = 1; i < value.length; i++) {
                                addEducationRow();

                            }
                        }

                        if (key == 'parents') {

                            for (let i = 1; i < value.length; i++) {
                                addParentRow();

                            }
                        }

                        value.forEach((item, index) => {


                            $.each(item, function(k, v) {
                                let arrayField = $(`[name="${key}[${index}][${k}]"]`);
                                arrayField.val(v);

                            });



                        });

                        return;
                    }

                    if (value !== null && typeof value === 'object' && !Array.isArray(value)) {

                        setFormValues(value, fieldName);

                    } else {

                        let selector = `[name="${key}"]`;

                        let $field = $(selector);

                        if (!$field.length) {
                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Checkbox
                        |--------------------------------------------------------------------------
                        */
                        if ($field.attr('type') === 'checkbox') {

                            $field.prop(
                                'checked',
                                value == 1 ||
                                value === true ||
                                value === '1'
                            );

                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Select
                        |--------------------------------------------------------------------------
                        */
                        if ($field.is('select')) {

                            $field.val(value).trigger('change');

                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Date
                        |--------------------------------------------------------------------------
                        */
                        if (
                            $field.attr('type') === 'date' &&
                            value
                        ) {

                            $field.val(
                                value.substring(0, 10)
                            );

                            return;
                        }

                        if ($field.attr('type') === 'file') {
                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Input/Textarea
                        |--------------------------------------------------------------------------
                        */
                        $field.val(value);
                    }

                });

            }

            function loadStudentPhoto(path) {

                if (!path) return;

                $('#student_photo_preview').attr(
                    'src',
                    `{{ asset('') }}${path}`
                );
            }


            async function loadSections(classId, selectedSectionId = null) {

                return new Promise((resolve) => {

                    getDataById(
                        "{{ route('school.common.get_class_devisions_by_class_id') }}",
                        classId,
                        function(res) {

                            let options =
                                `<option value="">Select Section</option>`;

                            $.each(res.data, function(i, d) {

                                options += `
                        <option value="${d.id}">
                            ${d.name}
                        </option>
                    `;
                            });

                            $('select[name="section_id"]')
                                .html(options);

                            if (selectedSectionId) {

                                $('select[name="section_id"]')
                                    .val(selectedSectionId)
                                    .trigger('change');
                            }

                            resolve();
                        }
                    );

                });

            }


            function loadExistingDocuments(documents) {

                if (!documents?.length) return;

                let rowId = parseInt(localStorage.getItem('documentRowId'));

                documents.forEach((doc, index) => {

                    console.log("Row id : ", rowId);

                    const docLabel = $('#doc_type_selector option[value="' + doc.document_name + '"]')
                        .data('label') || doc.document_name;

                    /*
                    |--------------------------------------------------------------------------
                    | Hidden Payload
                    |--------------------------------------------------------------------------
                    */

                    $('#hidden_payload_container').append(`
                        <div id="payload_item_${rowId}" data-doc-type="${doc.document_name}">
                            
                            <input type="hidden"
                                name="documents[${index}][id]"
                                value="${doc.id}">

                            <input type="hidden"
                                name="documents[${index}][doc_type]"
                                value="${doc.document_name}">

                            <input type="hidden"
                                name="documents[${index}][existing_file]"
                                value="${doc.document_file}">
                        </div>
                    `);

                    /*
                    |--------------------------------------------------------------------------
                    | Preview Card
                    |--------------------------------------------------------------------------
                    */


                    let fileUrl = `{{ asset('') }}${doc.document_file}`;

                    $('#documents_gallery_grid').append(`
                        <div class="col-xl-3 col-lg-4 col-md-6"
                            id="gallery_card_${rowId}"
                            data-doc-type="${doc.document_name}">
                            
                            <div class="doc-preview-card">

                                <div class="doc-image-box">

                                    <img
                                        src="${fileUrl}"
                                        style="
                                            width:100%;
                                            height:100%;
                                            object-fit:cover;
                                        ">

                                </div>

                                <div class="doc-action-bar">

                                    <p class="doc-title">
                                        ${docLabel}
                                    </p>

                                    <button
                                        type="button"
                                        class="doc-meta-badge border-0"
                                        onclick="removeUploadedDocument(${rowId}, '${doc.document_name}')">

                                        <i class="bi bi-trash-fill text-danger"></i>

                                    </button>

                                </div>

                            </div>

                        </div>
                    `);

                    /*
                    |--------------------------------------------------------------------------
                    | Disable Option
                    |--------------------------------------------------------------------------
                    */

                    $('#doc_type_selector option[value="' + doc.document_name + '"]')
                        .prop('disabled', true);

                    localStorage.setItem('documentRowId', rowId++);

                });

            }

        });
    </script>
@endpush
