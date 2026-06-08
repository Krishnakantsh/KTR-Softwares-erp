@extends('Frontend.Normal.Layout.main')


@section('title', 'KTR ERP : Permissions Manage')

@section('dynamic-content')



    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light"> Manage Permissions </h1>

            </div>
            <a href="{{ route('manage_permissions') }}"
                class="my-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 ">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Permission
            </a>
        </div>

        <form class="mt-24 ajaxForm" id="assignPermissionsToRoleForm" data-url="{{route('assign_permission')}}"   data-method="POST" >
            <div class="row gy-3">


                <div class="col-xl-12">
                    <div class="shadow-1 radius-12 bg-base h-100 ">
                        <div
                            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                            <h6 class="text-lg fw-semibold mb-0">Assign Permissions</h6>
                        </div>
                        <div class="card-body p-20">
                            <div class="row gy-3 align-items-end">
                                <div class="col-sm-12">
                                    <div class="">
                                        <label for="role_name"
                                            class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Search Role
                                            <span class="text-danger-600">*</span>
                                        </label>

                                        <div class="position-relative">
                                            <input type="text" class="form-control mb-1" id="role_name" name="role_name"
                                                placeholder="Enter Role Name" />

                                            <div id="permission_suggestions" class="list-group position-absolute w-100"
                                                style="z-index: 999; display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-12" id="permissions_card">
                    <div class="shadow-1 radius-12 bg-base h-100 ">
                        <div
                            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                            <h6 class="text-lg fw-semibold mb-0">Permissions</h6>
                        </div>

                        <div class="card-body p-20">
                            <div class="row gy-3 align-items-end" id="allPermissions">

                            </div>
                        </div>
                        <div class="card-footer p-20">

                            <button type="submit"
                                class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8">
                                Save Changes
                            </button>
                        </div>


                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('#permissions_card').hide();

            $('#role_name').on('keyup', function() {
                let query = $(this).val();

                if (query.length < 1) {
                    $('#permission_suggestions').hide();
                    return;
                }

                $.ajax({
                    url: "{{ route('search.roles') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(res) {

                        let html = '';

                        if (res.length > 0) {
                            res.forEach(role => {
                                html += `<a href="#" class="list-group-item list-group-item-action role-item" data-name="${role.name}">
                                            ${role.name}
                                        </a>`;
                            });
                        } else {
                            html = `<div class="list-group-item">No roles found</div>`;
                        }

                        $('#permission_suggestions').html(html).show();
                    }
                });
            });

            // Click pe input fill ho jaye
            $(document).on('click', '.role-item', function(e) {
                e.preventDefault();

                let name = $(this).data('name');

                $('#role_name').val(name);
                $('#permission_suggestions').hide();


                // fetch all permissions from permission

                $('#permissions_card').show();

                $.ajax({
                    url: "{{ route('getRoleWithPermissions') }}",
                    method: "GET",
                    data: {
                        'role_name': name,
                    },
                    success: function(res) {
                        console.log("Fetched Permissions : ", res);


                        let permissions = res.permissions;
                        let hasPermissions = res.hasPermissions;

                        let rows = "";

                        $.each(permissions, function(index, data) {

                            let isChecked = false;

                            if (Array.isArray(hasPermissions)) {
                                isChecked = hasPermissions.includes(data.name);
                            }

                            rows +=
                                `
                                   <div class="col-md-4 mb-3">
                                        <div class="form-check checked-primary d-flex align-items-center gap-2">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                id="${data.name}" value="${data.name}" ${isChecked ? 'checked' : ''} />
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                                for="${data.name}">
                                                    ${data.name || 'N/A'}
                                            </label>
                                        </div>
                                    </div>
                                `
                        });

                        $('#allPermissions').html(rows);
                    }
                })
            });

            // Outside click pe hide
            $(document).click(function(e) {
                if (!$(e.target).closest('#role_name, #permission_suggestions').length) {
                    $('#permission_suggestions').hide();
                }
            });

        });
    </script>
@endpush
