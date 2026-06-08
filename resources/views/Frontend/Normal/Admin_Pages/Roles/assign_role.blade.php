@extends('Frontend.Normal.Layout.main')


@section('title', 'KTR ERP : Permissions Manage')

@section('dynamic-content')



    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light">Assign Roles </h1>

            </div>
            <a href="{{ route('manage_roles') }}" class="my-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 ">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Role
            </a>
        </div>

        <form class="mt-24 ajaxForm" id="assignRolesToUserForm"  data-url="{{ route('assignRole') }}"
            data-method="POST"          >
            @csrf
            <div class="row gy-3">


                <div class="col-xl-12">
                    <div class="shadow-1 radius-12 bg-base h-100 ">
                        <div
                            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                            <h6 class="text-lg fw-semibold mb-0">Assign Role</h6>
                        </div>
                        <div class="card-body p-20">
                            <div class="row gy-3 align-items-end">
                                <div class="col-sm-12">
                                    <div class="">
                                        <label for="user_name"
                                            class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Search User
                                            <span class="text-danger-600">*</span>
                                        </label>

                                        <div class="position-relative">
                                            <input type="text" class="form-control mb-1" id="user_name" name="user_name"
                                                placeholder="Enter user Name" />

                                            <div id="role_suggestions" class="list-group position-absolute w-100"
                                                style="z-index: 999; display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-12" id="roles_card">
                    <div class="shadow-1 radius-12 bg-base h-100 ">
                        <div
                            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                            <h6 class="text-lg fw-semibold mb-0">Available Roles</h6>
                        </div>

                        <div class="card-body p-20">
                            <div class="row gy-3 align-items-end" id="allRoles">

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

            $('#roles_card').hide();

            $('#user_name').on('keyup', function() {
                let query = $(this).val();

                if (query.length < 1) {
                    $('#role_suggestions').hide();
                    return;
                }

                $.ajax({
                    url: "{{ route('search.users') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(res) {

                        let html = '';

                        if (res.length > 0) {
                            res.forEach(user => {
                                html += `<a href="#" class="list-group-item list-group-item-action role-item" data-name="${user.name}">
                                            ${user.name}
                                        </a>`;
                            });
                        } else {
                            html = `<div class="list-group-item">No user found</div>`;
                        }

                        $('#role_suggestions').html(html).show();
                    }
                });
            });

            // Click pe input fill ho jaye
            $(document).on('click', '.role-item', function(e) {
                e.preventDefault();

                let name = $(this).data('name');

                $('#user_name').val(name);
                $('#role_suggestions').hide();


                // fetch all permissions from permission

                $('#roles_card').show();

                $.ajax({
                    url: "{{ route('getRoles') }}",
                    method: "GET",
                    data: {
                        'user_name': name,
                    },
                    success: function(res) {

                        let roles = res.roles;
                        let hasRoles = res.hasRoles;

                        let rows = "";

                        $.each(roles, function(index, data) {

                            let isChecked = false;

                            if (Array.isArray(hasRoles)) {
                                isChecked = hasRoles.includes(data.name);
                            }

                            rows +=
                                `
                                   <div class="col-md-4 mb-3">
                                        <div class="form-check checked-primary d-flex align-items-center gap-2">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                id="${data.name}" value="${data.name}" ${isChecked ? 'checked' : ''} />
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                                for="${data.name}">
                                                    ${data.name || 'N/A'}
                                            </label>
                                        </div>
                                    </div>
                                `
                        });

                        $('#allRoles').html(rows);
                    }
                })
            });

            // Outside click pe hide
            $(document).click(function(e) {
                if (!$(e.target).closest('#user_name, #role_suggestions').length) {
                    $('#role_suggestions').hide();
                }
            });

        });
    </script>
@endpush
