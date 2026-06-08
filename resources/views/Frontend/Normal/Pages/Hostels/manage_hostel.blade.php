@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Hostel Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Breadcrumb / Header -->
        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Hostel Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage hostel buildings, room capacity, wardens, accommodation details and student stay facilities.
                </p>

            </div>

            <button type="button"
                class="hostel-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Hostel

            </button>

        </div>

        <!-- Table Section -->
        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="HostelDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table"
                            id="HostelDataTable"
                            data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Hostel Name</th>

                                    <th>Hostel Code</th>

                                    <th>Warden</th>

                                    <th>Mobile</th>

                                    <th>Blocks</th>

                                    <th>Rooms</th>

                                    <th>Capacity</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="hostelTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="hostel-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div class="py-3">

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Hostel
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter hostel accommodation and warden details
                </p>

            </div>

            <button type="button"
                class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="hostelForm"
            class="ajaxForm d-flex flex-column h-100"
            enctype="multipart/form-data"
            data-url="{{ route('school.hostel.save') }}"
            data-refresh="getHostelList"
            data-method="POST">

            @csrf

            <input type="hidden" name="hostel_id" id="hostel_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Hostel Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Hostel Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Basic details of hostel accommodation
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Hostel Name -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Hostel Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                class="form-control"
                                id="hostel_name"
                                name="hostel_name"
                                placeholder="Enter Hostel Name">

                        </div>

                        <!-- Hostel Code -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Hostel Code
                            </label>

                            <input type="text"
                                class="form-control"
                                id="hostel_code"
                                name="hostel_code"
                                placeholder="Enter Hostel Code">

                        </div>

                        <!-- Total Blocks -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Total Blocks
                            </label>

                            <input type="number"
                                class="form-control"
                                id="total_blocks"
                                name="total_blocks"
                                placeholder="Enter Total Blocks">

                        </div>

                        <!-- Total Rooms -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Total Rooms
                            </label>

                            <input type="number"
                                class="form-control"
                                id="total_rooms"
                                name="total_rooms"
                                placeholder="Enter Total Rooms">

                        </div>

                        <!-- Capacity -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Student Capacity
                            </label>

                            <input type="number"
                                class="form-control"
                                id="capacity"
                                name="capacity"
                                placeholder="Enter Student Capacity">

                        </div>

                        <!-- Status -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Status
                            </label>

                            <select class="form-select"
                                name="status"
                                id="status">

                                <option value="1">Active</option>

                                <option value="0">Inactive</option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- Warden Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Warden Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage hostel warden contact details
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Warden Name -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Warden Name
                            </label>

                            <input type="text"
                                class="form-control"
                                id="warden_name"
                                name="warden_name"
                                placeholder="Enter Warden Name">

                        </div>

                        <!-- Warden Mobile -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Warden Mobile
                            </label>

                            <input type="text"
                                class="form-control"
                                id="warden_mobile"
                                name="warden_mobile"
                                placeholder="Enter Warden Mobile">

                        </div>

                    </div>

                </div>

                <!-- Address Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Hostel Address
                        </h6>

                    </div>

                    <div class="row g-3">

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Address
                            </label>

                            <textarea class="form-control"
                                rows="4"
                                id="address"
                                name="address"
                                placeholder="Enter Hostel Address"></textarea>

                        </div>

                    </div>

                </div>

                <!-- Buttons -->

                <div class="d-flex align-items-center justify-content-start gap-3 mb-24">

                    <button type="reset"
                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">

                        Cancel

                    </button>

                    <button type="submit"
                        class="btn btn-primary-600 border border-primary-600 text-md px-40 py-11 radius-8">

                        Save Hostel

                    </button>

                </div>

            </div>

        </form>

    </div>

    <!-- Sidebar End -->

@endsection

@push('script')

    <script>

        /*
        |--------------------------------------------------------------------------
        | FETCH HOSTEL LIST
        |--------------------------------------------------------------------------
        */

        window.getHostelList = function() {

            $.ajax({

                url: "{{ route('school.hostel.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        rows += `

                            <tr>

                                <td>${index + 1}</td>

                                <td>${d.hostel_name || ''}</td>

                                <td>${d.hostel_code || ''}</td>

                                <td>${d.warden_name || ''}</td>

                                <td>${d.warden_mobile || ''}</td>

                                <td>${d.total_blocks || 0}</td>

                                <td>${d.total_rooms || 0}</td>

                                <td>${d.capacity || 0}</td>

                                <td>
                                    ${d.status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>'
                                    }
                                </td>

                                <td>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="hostel-sidebar-btn edit">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="deleteHostel">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>

                                </td>

                            </tr>

                        `;

                    });

                    /*
                    |--------------------------------------------------------------------------
                    | DESTROY OLD DATATABLE
                    |--------------------------------------------------------------------------
                    */

                    if ($.fn.DataTable.isDataTable('#HostelDataTable')) {

                        $('#HostelDataTable')
                            .DataTable()
                            .destroy();
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | APPEND ROWS
                    |--------------------------------------------------------------------------
                    */

                    $('#hostelTableBody').html(rows);

                    /*
                    |--------------------------------------------------------------------------
                    | INITIALIZE DATATABLE
                    |--------------------------------------------------------------------------
                    */

                    $('#HostelDataTable').DataTable({
                        pageLength: 10
                    });

                },

                error: function(xhr) {

                    console.log("Error Message : Something went wrong");

                    console.log("System Message : ", xhr.responseText);

                }

            });

        };

        $(document).ready(function() {

            getHostelList();

        });

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.hostel-sidebar-btn', function() {

            let $btn = $(this);

            /*
            |--------------------------------------------------------------------------
            | ADD MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#hostelForm')[0].reset();

                $('#hostel_id').val('');

            }

            /*
            |--------------------------------------------------------------------------
            | EDIT MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.hostel-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET HOSTEL DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.hostel.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#hostel_id').val(res.data.id);

                            $('#hostel_name').val(res.data.hostel_name);

                            $('#hostel_code').val(res.data.hostel_code);

                            $('#warden_name').val(res.data.warden_name);

                            $('#warden_mobile').val(res.data.warden_mobile);

                            $('#address').val(res.data.address);

                            $('#total_blocks').val(res.data.total_blocks);

                            $('#total_rooms').val(res.data.total_rooms);

                            $('#capacity').val(res.data.capacity);

                            $('#status').val(res.data.status);

                        }

                    }

                });

            }

        });

        /*
        |--------------------------------------------------------------------------
        | CLOSE SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.close-my-sidebar, .overlay', function() {

            $('.hostel-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });

    </script>

@endpush