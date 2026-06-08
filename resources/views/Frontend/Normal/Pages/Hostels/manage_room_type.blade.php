@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Room Type Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Header -->

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Room Type Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage hostel room categories, bed capacity, facilities and accommodation fees.
                </p>

            </div>

            <button type="button"
                class="room-type-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Room Type

            </button>

        </div>

        <!-- Table Section -->

        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="RoomTypeDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table"
                            id="RoomTypeDataTable"
                            data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Room Type</th>

                                    <th>Bed Count</th>

                                    <th>Fees</th>

                                    <th>Facilities</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="roomTypeTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="room-type-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Room Type
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter room category and accommodation details
                </p>

            </div>

            <button type="button"
                class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="roomTypeForm"
            class="ajaxForm d-flex flex-column h-100"
            enctype="multipart/form-data"
            data-url="{{ route('school.room.type.save') }}"
            data-refresh="getRoomTypeList"
            data-method="POST">

            @csrf

            <input type="hidden"
                name="room_type_id"
                id="room_type_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Room Type Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Room Type Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage room sharing type, beds and fee structure
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Room Type -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Room Type <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                class="form-control"
                                id="room_type"
                                name="room_type"
                                placeholder="Single Sharing / Double Sharing">

                        </div>

                        <!-- Bed Count -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Bed Count
                            </label>

                            <input type="number"
                                class="form-control"
                                id="bed_count"
                                name="bed_count"
                                placeholder="Enter Bed Count">

                        </div>

                        <!-- Fees -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Room Fees
                            </label>

                            <input type="number"
                                step="0.01"
                                class="form-control"
                                id="fees"
                                name="fees"
                                placeholder="Enter Room Fees">

                        </div>

                        <!-- Status -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Status
                            </label>

                            <select class="form-select"
                                name="status"
                                id="status">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- Facilities Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Room Facilities
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Add facilities and amenities available in this room type
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Facilities -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Facilities
                            </label>

                            <textarea class="form-control"
                                rows="5"
                                id="facilities"
                                name="facilities"
                                placeholder="WiFi, Attached Bathroom, Study Table, AC, Fan etc."></textarea>

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

                        Save Room Type

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection

@push('script')

    <script>

        /*
        |--------------------------------------------------------------------------
        | FETCH ROOM TYPE LIST
        |--------------------------------------------------------------------------
        */

        window.getRoomTypeList = function() {

            $.ajax({

                url: "{{ route('school.room.type.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        rows += `

                            <tr>

                                <td>${index + 1}</td>

                                <td>${d.room_type || ''}</td>

                                <td>${d.bed_count || 0}</td>

                                <td>₹ ${d.fees || 0}</td>

                                <td>${d.facilities || ''}</td>

                                <td>
                                    ${d.status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>'
                                    }
                                </td>

                                <td>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="room-type-sidebar-btn edit">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="deleteRoomType">

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

                    if ($.fn.DataTable.isDataTable('#RoomTypeDataTable')) {

                        $('#RoomTypeDataTable')
                            .DataTable()
                            .destroy();

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | APPEND ROWS
                    |--------------------------------------------------------------------------
                    */

                    $('#roomTypeTableBody').html(rows);

                    /*
                    |--------------------------------------------------------------------------
                    | INITIALIZE DATATABLE
                    |--------------------------------------------------------------------------
                    */

                    $('#RoomTypeDataTable').DataTable({
                        pageLength: 10
                    });

                }

            });

        };

        $(document).ready(function() {

            getRoomTypeList();

        });

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.room-type-sidebar-btn', function() {

            let $btn = $(this);

            // Add Mode

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#roomTypeForm')[0].reset();

                $('#room_type_id').val('');

            }

            // Edit Mode

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.room-type-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET ROOM TYPE DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.room.type.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#room_type_id').val(res.data.id);

                            $('#room_type').val(res.data.room_type);

                            $('#bed_count').val(res.data.bed_count);

                            $('#fees').val(res.data.fees);

                            $('#facilities').val(res.data.facilities);

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

            $('.room-type-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });

    </script>

@endpush