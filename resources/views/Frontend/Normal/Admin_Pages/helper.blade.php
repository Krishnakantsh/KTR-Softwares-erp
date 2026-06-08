<script>


    window.getRoles = function() {
        $.ajax({
            url: "{{ route('get_roles') }}",
            method: "GET",
            success: function(res) {

                let rows = "";

                $.each(res.data, function(index, d) {
                    rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${d.name}</td>
                        <td>
                            <button type="button" data-id="${d.id}" class="my-sidebar-btn edit role">
                                <i class="ri-edit-fill custom-btn-primary"></i>
                            </button>
                            <button type="button" data-id="${d.id}" class="deleteRole">
                                <i class="ri-delete-bin-fill custom-btn-red"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });

                if ($.fn.DataTable.isDataTable('#RoleDataTable')) {
                    $('#RoleDataTable').DataTable().destroy();
                }

                $("#roleTableBody").html(rows);

                let table = $('#RoleDataTable').DataTable({
                    pageLength: 10
                });
            }
        });
    };

    window.getPermissions = function() {
        $.ajax({
            url: "{{ route('get_permissions') }}",
            method: "GET",
            success: function(res) {

                let rows = "";

                $.each(res.data, function(index, d) {
                    rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${d.name}</td>
                        <td>
                            <button type="button" data-id="${d.id}" class="my-sidebar-btn edit permission">
                                <i class="ri-edit-fill custom-btn-primary"></i>
                            </button>
                            <button type="button" data-id="${d.id}" class="deletePermission">
                                <i class="ri-delete-bin-fill custom-btn-red"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });

                if ($.fn.DataTable.isDataTable('#PermissionDataTable')) {
                    $('#PermissionDataTable').DataTable().destroy();
                }

                $("#permissionTableBody").html(rows);

                let table = $('#PermissionDataTable').DataTable({
                    pageLength: 10
                });
            }
        });
    };


    window.getStreamList = function() {
        $.ajax({

            url: "{{ route('school.stream.master.fetch.with') }}",

            method: "GET",

            success: function(res) {


                let rows = "";

                $.each(res.data, function(index, d) {

                    rows += `

                    <tr>

                        <td>
                            ${index + 1}
                        </td>

                        <td>
                            ${d.name}
                        </td>

                        <td>

                            <button
                                type="button"
                                data-id="${d.id}"
                                class="stream-master-sidebar-btn edit role">

                                <i class="ri-edit-fill custom-btn-primary"></i>

                            </button>

                            <button
                                type="button"
                                data-id="${d.id}"
                                class="deleteStream">

                                <i class="ri-delete-bin-fill custom-btn-red"></i>

                            </button>

                        </td>

                    </tr>

                `;
                });

                /*
                |--------------------------------------------------------------------------
                | Destroy Old DataTable
                |--------------------------------------------------------------------------
                */

                if ($.fn.DataTable.isDataTable('#StreamDataTable')) {

                    $('#StreamDataTable')
                        .DataTable()
                        .destroy();
                }

                /*
                |--------------------------------------------------------------------------
                | Append Rows
                |--------------------------------------------------------------------------
                */

                $("#streamTableBody").html(rows);

                /*
                |--------------------------------------------------------------------------
                | Initialize DataTable
                |--------------------------------------------------------------------------
                */

                $('#StreamDataTable').DataTable({
                    pageLength: 10
                });

            },

            error: function(xhr) {

                console.log("Error Message : Something went wrong");

                console.log("System Message : ", xhr.responseText);
            }

        });
    };


    window.getClassList = function() {
        $.ajax({
            url: "{{ route('school.class.master.fetch.with') }}",
            method: "GET",
            success: function(res) {
                let rows = "";

                $.each(res.data, function(index, d) {

                    rows += `
                        <tr class="class-row" data-id="${d.id}" data-name="${d.name}" >
                            <td>${index + 1}</td>
                            <td>${d.name}</td>
                            <td>
                                <button type="button" data-id="${d.id}" class="class-master-sidebar-btn edit role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>
                                </button>
                                <button type="button" data-id="${d.id}" class="deleteClass">
                                    <i class="ri-delete-bin-fill custom-btn-red"></i>
                                </button>
                            </td>
                        </tr>
                `;
                });

                if ($.fn.DataTable.isDataTable('#ClassDataTable')) {
                    $('#ClassDataTable').DataTable().destroy();
                }

                $("#classTableBody").html(rows);

                let table = $('#ClassDataTable').DataTable({
                    pageLength: 10
                });
            }
        });
    };

    window.getSessionList = function() {
        $.ajax({
            url: "{{ route('school.sessions.fetch') }}",
            method: "GET",
            success: function(res) {

                let rows = "";

                $.each(res.data, function(index, d) {



                    if (res.data.length > 0) {

                        rows += `
                            <option value="${d.id}"  ${d.is_active ? 'selected' : ''} >
                                    Session ${d.name}
                            </option>
                        `;

                    } else {
                        rows += `<option value="">No Session Found</option>`
                    }
                });

                $("#sessionSelect").html(rows);

            }
        });
    };

    window.getSubjectGroupList = function() {
        $.ajax({

            url: "{{ route('school.subject.group.fetch.with') }}",
            method: "GET",

            success: function(res) {



                let html = '';

                $.each(res.data, function(index, d) {

                    html += `
                    <tr>
                        <td>${index + 1}</td>

                        <td>${d.name}</td>

                        <td>
                          
                             <div class="h-40-px d-flex align-items-center">
                            <small
                                class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1"
                                style="height: fit-content;">

                                <div class="bg-white text-primary-600 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; flex-shrink: 0;">
                                     ${d.subjects_count || 0}
                                </div>

                                <span class="pe-4 me-2">Subjects</span>

                            </small>
                        </div>
                        </td>

                          <td>
                                <button type="button" data-id="${d.id}" class="subject-group-sidebar-btn edit role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>
                                </button>
                                <button type="button" data-id="${d.id}" class="deleteSubjectGroup">
                                    <i class="ri-delete-bin-fill custom-btn-red"></i>
                                </button>
                            </td>
                    </tr>
                `;
                });

                $('#subjectGroupTableBody').html(html);
            }
        });
    };

    window.getSubjectList = function() {
        $.ajax({

            url: "{{ route('school.subject.fetch.with') }}",
            method: "GET",

            success: function(res) {



                let html = '';

                $.each(res.data, function(index, d) {

                    html += `
                    <tr>
                        <td>${index + 1}</td>

                        <td>${d.name}</td>

                        <td>
                            ${d.group?.name  || 'N/A'}
                        </td>

                          <td>
                                <button type="button" data-id="${d.id}" class="subject-sidebar-btn edit role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>
                                </button>
                                <button type="button" data-id="${d.id}" class="deleteSubject">
                                    <i class="ri-delete-bin-fill custom-btn-red"></i>
                                </button>
                            </td>
                    </tr>
                `;
                });

                $('#subjectTableBody').html(html);
            }
        });
    };

    window.getSubjectLinkList = function() {
        $.ajax({

            url: "{{ route('school.subject.link.fetch.with') }}",
            method: "GET",

            success: function(res) {



                let html = '';

                $.each(res.data, function(index, d) {


                    html += `
                    <tr>
                        <td>${index + 1}</td>

                        <td>${d.class?.name}</td>

                        <td>
                           

                                <div class="h-40-px d-flex align-items-center">
                            <small
                                class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1"
                                style="height: fit-content;">

                                <div class="bg-white text-primary-600 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; flex-shrink: 0;">
                                      ${d.total_subjects  || '0'}
                                </div>

                        

                            </small>
                        </td>

                          <td>
                                <button type="button" data-id="${d.class_id}" class="subject_link-sidebar-btn edit role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>
                                </button>
                                <button type="button" data-id="${d.class_id}" class="deleteSubjectLink">
                                    <i class="ri-delete-bin-fill custom-btn-red"></i>
                                </button>
                            </td>
                    </tr>
                `;
                });

                $('#classLinkTableBody').html(html);
            }
        });
    };



    $(document).ready(function() {

        let table;
        /*
        |--------------------------------------------------------------------------
        | CSRF setup
        |--------------------------------------------------------------------------
        */

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        /*
        |--------------------------------------------------------------------------
        | Delete Role
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteRole", function() {
            let id = $(this).data('id');
            let route = "{{ route('delete_role') }}";
            masterDelete(id, route, [getRoles]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Permission
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deletePermission", function() {
            let id = $(this).data('id');
            let route = "{{ route('delete_permission') }}";
            masterDelete(id, route, [getPermissions]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Classes 
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteClass", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.class.master.delete') }}";
            masterDelete(id, route, [getClassList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Subject Group
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteSubjectGroup", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.subject.group.delete') }}";
            masterDelete(id, route, [getSubjectGroupList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Subject
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteSubject", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.subject.delete') }}";
            masterDelete(id, route, [getSubjectList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Subject Link With Class
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteSubjectLink", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.subject.link.delete') }}";
            masterDelete(id, route, [getSubjectLinkList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Stream Master
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteStream", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.stream.master.delete') }}";
            masterDelete(id, route, [getStreamList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Transport Vehicle
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteTransportVehicle", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.transport.vehicle.delete') }}";
            masterDelete(id, route, [getTransportVehicleList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Transport Route
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteTransportRoute", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.transport.route.delete') }}";
            masterDelete(id, route, [getTransportRouteList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Transport Destination
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteTransportDestination", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.transport.destination.delete') }}";
            masterDelete(id, route, [getTransportDestinationList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Hostel
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteHostel", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.hostel.delete') }}";
            masterDelete(id, route, [getHostelList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Hostel Block
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteHostelBlock", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.hostel.block.delete') }}";
            masterDelete(id, route, [getHostelBlockList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Hostel Floor 
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteHostelFloor", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.hostel.floor.delete') }}";
            masterDelete(id, route, [getHostelFloorList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Hostel Floor 
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteRoomType", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.room.type.delete') }}";
            masterDelete(id, route, [getRoomTypeList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Room
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteRoomMaster", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.room.master.delete') }}";
            masterDelete(id, route, [getRoomMasterList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete House
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteHouse", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.house.delete') }}";
            masterDelete(id, route, [getHouseList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Concession By
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteConcessionBy", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.concession.by.delete') }}";
            masterDelete(id, route, [getConcessionByList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Concession Type
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteConcessionType", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.concession.type.delete') }}";
            masterDelete(id, route, [getConcessionTypeList]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Template Type
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteTemplateType", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.template.type.delete') }}";
            masterDelete(id, route, [fetchTemplateType]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete Template
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteTemplate", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.template.delete') }}";
            masterDelete(id, route, [fetchTemplate]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete meeting
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteMeeting", function() {
            let id = $(this).data('id');
            let route = "{{ route('student.online_classes.delete') }}";
            masterDelete(id, route, [fetchOnlineClasses]);
        });

        /*
        |--------------------------------------------------------------------------
        | Delete document category
        |--------------------------------------------------------------------------
        */

        $(document).on('click', ".deleteDocumentCategory", function() {
            let id = $(this).data('id');
            let route = "{{ route('school.document.category.delete') }}";
            masterDelete(id, route, [fetchDocumentCategories]);
        });

        /*
        |--------------------------------------------------------------------------
        | Master form submission concept
        |--------------------------------------------------------------------------
        */

        $(document).on('submit', '.ajaxForm', function(e) {
            e.preventDefault();

            let form = this;
            let url = $(form).data('url');
            let refresh = $(form).attr('data-refresh');

            let method = $(form).data('method') || 'POST';


            submitAjaxForm({
                form: form,
                url: url,
                method: method,
                refresh: refresh
            });
        });


        function submitAjaxForm({
            form,
            url,
            method = "POST",
            refresh,
            resetForm = true
        }) {

            let formData = new FormData(form);


            $(form).find('.is-invalid').removeClass('is-invalid');
            $(form).find('.invalid-feedback').remove();

            $.ajax({
                url: url,
                method: method,
                contentType: false,
                processData: false,
                data: formData,

                beforeSend: function() {
                    $(form).find('button[type="submit"]').prop('disabled', true);
                },


                success: function(res) {


                    if (refresh) {
                        if (Array.isArray(refresh)) {
                            refresh.forEach(fn => {
                                if (typeof fn === "string" && typeof window[fn] ===
                                    "function") {
                                    window[fn]();
                                } else if (typeof fn === "function") {
                                    fn();
                                }
                            });
                        } else {
                            if (typeof refresh === "string" && typeof window[refresh] ===
                                "function") {
                                window[refresh]();
                            } else if (typeof refresh === "function") {
                                refresh();
                            }
                        }
                    }

                    showToast('success', res.message || 'Success');

                    if (resetForm) form.reset();

                    $('.my-sidebar').removeClass('active');
                    $('.subject-sidebar').removeClass('active');
                    $('.hostel-sidebar').removeClass('active');
                    $('.room-type-sidebar').removeClass('active');
                    $('.hostel-floor-sidebar').removeClass('active');
                    $('.hostel-block-sidebar').removeClass('active');
                    $('.subject-group-sidebar').removeClass('active');
                    $('.my-sidebar-permission').removeClass('active');
                    $('.subject-link-sidebar').removeClass('active');
                    $('.class-master-sidebar').removeClass('active');
                    $('.stream-master-sidebar').removeClass('active');
                    $('.transport-destination-sidebar').removeClass('active');
                    $('.transport-route-sidebar').removeClass('active');
                    $('.transport-vehicle-sidebar').removeClass('active');
                    $('.overlay').removeClass('active');
                },
                error: function(xhr) {

                    let status = xhr.status;

                    if (status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(field, messages) {
                            let input = $(form).find(`[name="${field}"]`);

                            input.addClass('is-invalid');
                            input.after(
                                `<div class="invalid-feedback">${messages[0]}</div>`
                            );
                        });

                        showToast('error', 'Please fix validation errors');
                    } else if (status === 401) {
                        showToast('error', 'Session expired. Login again');
                        setTimeout(() => window.location.href = "/login", 1500);
                    } else if (status === 403) {
                        showToast('error', 'Access denied');
                    } else if (status === 404) {
                        showToast('error', 'Route not found');
                    } else if (status === 419) {
                        showToast('error', 'Page expired. Reloading...');
                        setTimeout(() => location.reload(), 1500);
                    } else if (status === 500) {
                        showToast('error', 'Server error');
                        console.error(xhr.responseText);
                    } else {
                        let msg = xhr.responseJSON?.message || "Something went wrong";
                        showToast('error', msg);
                    }
                },

                complete: function() {
                    $(form).find('button[type="submit"]').prop('disabled', false);
                }
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Master Delete Function
        |--------------------------------------------------------------------------
        */

        function masterDelete(id, route, refresh = null) {

            $.ajax({
                url: route,
                method: "POST",
                data: {
                    id: id,
                    _method: "DELETE",
                },
                success: function(res) {

                    if (Array.isArray(refresh)) {
                        refresh.forEach(fn => {
                            if (typeof fn === "function") {
                                fn();
                            }
                        });
                    } else if (typeof refresh === "function") {
                        refresh();
                    }
                    if (res.status) {
                        showToast('success', res.message || 'Success');

                    } else {
                        showToast('error', res.message || 'Something went wrong');
                    }

                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Something wentt wrong');
                    console.log("Error Message From Backend :", xhr.responseText ||
                        "Something went wrong ");
                }

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Fetch all linked subjects when class changes
        |--------------------------------------------------------------------------
        */

        $(document).on('change', '.subject_link_class', function(e) {

            e.preventDefault();



            let class_id = $(this).val();

            if (!class_id) return;

            $.ajax({

                url: "{{ route('school.subject.group.with_subjects') }}",

                method: "GET",

                data: {
                    id: class_id
                },

                success: function(res) {

                    let container = $('#subjectGroupContainer');

                    container.html('');

                    /*
                    |--------------------------------------------------------------------------
                    | Already linked subject ids
                    |--------------------------------------------------------------------------
                    */

                    let linkedSubjects = res.hasSubjectsLink || [];

                    /*
                    |--------------------------------------------------------------------------
                    | No groups found
                    |--------------------------------------------------------------------------
                    */

                    if (!res.data.length) {

                        container.html(`
                            <div class="alert alert-warning">
                                No Subject Groups Found
                            </div>
                        `);

                        $('#subjectSelectLinkCount').addClass('d-none');

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Group Loop
                    |--------------------------------------------------------------------------
                    */

                    $.each(res.data, function(index, group) {

                        let subjectsHtml = '';

                        /*
                        |--------------------------------------------------------------------------
                        | Subject Loop
                        |--------------------------------------------------------------------------
                        */

                        $.each(group.subjects, function(i, subject) {


                            let checked = linkedSubjects.includes(subject
                                    .id) ?
                                'checked' :
                                '';

                            subjectsHtml += `

                            <div class="col-md-12">

                                <label class="subject-card w-100">

                                    <input
                                        type="checkbox"
                                        name="subjects[]"
                                        value="${subject.id}"
                                        class="d-none subject-checkbox"
                                        ${checked}
                                    >

                                    <div class="subject-item overflow-auto">

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="subject-check-icon">
                                                <i class="ri-check-line"></i>
                                            </div>

                                            <div>

                                                <p class="mb-0">
                                                    ${subject.name}
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </label>

                            </div>
                        `;
                        });

                        /*
                        |--------------------------------------------------------------------------
                        | Group Card
                        |--------------------------------------------------------------------------
                        */

                        container.append(`

                            <div class="card border-0 shadow-sm my-4">

                                <div class="card-header bg-primary-50 border-0">

                                    <div class="d-flex align-items-center justify-content-between">

                                        <div>

                                            <p class="mb-0 text-primary-700 fw-bold">
                                                ${group.name}
                                            </p>

                                            <small class="text-muted">
                                                ${group.subjects.length} Subjects
                                            </small>

                                        </div>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-light select-all-group"
                                        >
                                            Select All
                                        </button>

                                    </div>

                                </div>

                                <div class="card-body">

                                    <div class="row g-3">

                                        ${subjectsHtml}

                                    </div>

                                </div>

                            </div>

                        `);

                    });

                    /*
                    |--------------------------------------------------------------------------
                    | Selected Count
                    |--------------------------------------------------------------------------
                    */

                    $('.subject-checkbox').each(function() {

                        let item = $(this).closest('.subject-card');

                        if ($(this).prop('checked')) {

                            item.addClass('active-subject');

                        } else {

                            item.removeClass('active-subject');
                        }

                    });

                    let total = $('.subject-checkbox:checked').length;

                    if (total > 0) {

                        $('#subjectSelectLinkCount')
                            .removeClass('d-none');

                        $('#selectedSubjectCount')
                            .text(total);

                    } else {

                        $('#subjectSelectLinkCount')
                            .addClass('d-none');
                    }

                },

                error: function(xhr) {

                    console.log("Error Message : Something went wrong");

                    console.log("System Message : ", xhr.responseText);

                }
            });
        });

        /*
        |--------------------------------------------------------------------------
        | Select All Per Group
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.select-all-group', function() {

            let card = $(this).closest('.card');

            let checkboxes = card.find('.subject-checkbox');

            let allChecked = true;

            checkboxes.each(function() {

                if (!$(this).prop('checked')) {

                    allChecked = false;
                }
            });

            checkboxes.prop('checked', !allChecked).trigger('change');

        });

        /*
        |--------------------------------------------------------------------------
        | Active Checkbox UI
        |--------------------------------------------------------------------------
        */

        $(document).on('change', '.subject-checkbox', function() {

            let item = $(this).closest('.subject-card');
            let total = $('.subject-checkbox:checked').length;

            if ($(this).prop('checked')) {

                item.addClass('active-subject');

            } else {
                item.removeClass('active-subject');
            }


            if (total > 0) {

                $('#subjectSelectLinkCount')
                    .removeClass('d-none');

                $('#selectedSubjectCount')
                    .text(total);

            } else {

                $('#subjectSelectLinkCount')
                    .addClass('d-none');
            }

        }).trigger('change');


        /*
        |--------------------------------------------------------------------------
        | add section on click class row
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.class-row', function(e) {

            // button click ignore
            if ($(e.target).closest('button').length) return;

            let id = $(this).data('id');
            let name = $(this).data('name');

            // modal values set first
            $('#modal_class_id').val(id);
            $('#modal_class_name').val(name);

            // modal open
            $('#sectionModal').modal('show');

            $.ajax({
                url: "{{ route('school.class.master.get') }}",
                method: "GET",
                data: {
                    id: id
                },

                success: function(res) {

                    let sections = res.data.class_sections || [];

                    let container = $('#sectionInputs');

                    // clear old data
                    container.html('');

                    // existing section count set
                    $('#no_of_sections').val(sections.length);

                    // if already sections exist
                    if (sections.length > 0) {

                        $.each(sections, function(index, d) {

                            container.append(`
                            <div class="mb-2">
                                <label>Section ${index + 1}</label>
                                <input 
                                    type="text" 
                                    name="sections[]" 
                                    class="form-control"
                                    value="${d.name ?? ''}">
                            </div>
                       `);

                        });

                    }

                },

                error: function(xhr) {

                    console.log("Error : ", xhr.responseText);

                }
            });

        });


        /*
        |--------------------------------------------------------------------------
        | dynamic section generated
        |--------------------------------------------------------------------------
        */

        $(document).on('input', '#no_of_sections', function() {

            let count = parseInt($(this).val());

            let container = $('#sectionInputs');

            container.html('');

            if (!count || count <= 0) return;

            let letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

            for (let i = 0; i < count; i++) {

                let value = letters[i] || `Sec-${i+1}`;

                container.append(`
                    <div class="mb-2">
                        <label>Section ${i + 1}</label>
                        <input 
                            type="text" 
                            name="sections[]" 
                            class="form-control"
                            value="${value}">
                    </div>
                `);
            }

        });


        /*
        |--------------------------------------------------------------------------
        | All Function's Calls
        |--------------------------------------------------------------------------
        */

        getRoles();
        getPermissions();
        getClassList();
        getSessionList();
        getSubjectGroupList();
        getSubjectList();
        getSubjectLinkList();
        getStreamList();


    });

    function formatDate(dateString) {

        if (!dateString) {
            return '-';
        }

        const date = new Date(dateString);

        const day = date.getDate();

        const month = date.toLocaleString('default', {
            month: 'long'
        });

        const year = date.getFullYear();

        return `${day} ${month}, ${year}`;
    }
</script>

<script>
    document.getElementById('sessionSelect').addEventListener('change', function() {
        document.getElementById('sessionForm').submit();
    });
</script>
