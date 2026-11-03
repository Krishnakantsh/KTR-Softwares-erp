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

    $(document).ready(function() {

        let table;

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
        getStreamList();


    });

    function formatDate(dateString, type = 'long') {

        if (!dateString) {
            return '-';
        }

        const date = new Date(dateString);

        const day = date.getDate();

        const month = date.toLocaleString('default', {
            month: type
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
