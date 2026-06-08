@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Room Master Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Header -->

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Room Master Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage hostel rooms, bed allocation, occupancy status and accommodation facilities.
                </p>

            </div>

            <button type="button" class="room-master-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Room

            </button>

        </div>

        <!-- Table Section -->

        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="RoomMasterDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="RoomMasterDataTable" data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Hostel</th>

                                    <th>Block</th>

                                    <th>Floor</th>

                                    <th>Room No.</th>

                                    <th>Room Type</th>

                                    <th>Total Beds</th>

                                    <th>Occupied</th>

                                    <th>Available</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="roomMasterTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="room-master-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-700-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Room
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter room allocation and accommodation details
                </p>

            </div>

            <button type="button" class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="roomMasterForm" class="ajaxForm d-flex flex-column h-100" enctype="multipart/form-data"
            data-url="{{ route('school.room.master.save') }}" data-refresh="getRoomMasterList" data-method="POST">

            @csrf

            <input type="hidden" name="room_master_id" id="room_master_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Location Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Room Location Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Select hostel, block and floor details
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Hostel -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Hostel <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="hostel_id" id="hostel_id">

                                <option value="">
                                    Select Hostel
                                </option>

                                @foreach ($hostels as $hostel)
                                    <option value="{{ $hostel->id }}">
                                        {{ $hostel->hostel_name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- Block -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Hostel Block <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="hostel_block_id" id="hostel_block_id">

                                <option value="">
                                    Select Block
                                </option>

                            </select>

                        </div>

                        <!-- Floor -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Hostel Floor <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="hostel_floor_id" id="hostel_floor_id">

                                <option value="">
                                    Select Floor
                                </option>

                            </select>

                        </div>

                        <!-- Room Type -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Room Type <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="room_type_id" id="room_type_id">

                                <option value="">
                                    Select Room Type
                                </option>

                                @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}">
                                        {{ $roomType->room_type }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                <!-- Room Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Room Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage room number, bed allocation and occupancy
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Room Number -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Room Number <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="room_number" name="room_number"
                                placeholder="Enter Room Number">

                        </div>

                        <!-- Total Beds -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Total Beds
                            </label>

                            <input type="number" class="form-control" id="total_beds" name="total_beds"
                                placeholder="Enter Total Beds">

                        </div>

                        <!-- Occupied Beds -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Occupied Beds
                            </label>

                            <input type="number" class="form-control" id="occupied_beds" name="occupied_beds"
                                placeholder="Enter Occupied Beds">

                        </div>

                        <!-- Available Beds -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Available Beds
                            </label>

                            <input type="number" class="form-control" id="available_beds" name="available_beds"
                                placeholder="Enter Available Beds">

                        </div>

                        <!-- Status -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Status
                            </label>

                            <select class="form-select" name="status" id="status">

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

                <!-- Additional Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Additional Information
                        </h6>

                    </div>

                    <div class="row g-3">

                        <!-- Facilities -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Facilities
                            </label>

                            <textarea class="form-control" rows="4" id="facilities" name="facilities"
                                placeholder="WiFi, Study Table, Attached Bathroom, Fan etc."></textarea>

                        </div>

                        <!-- Remarks -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Remarks
                            </label>

                            <textarea class="form-control" rows="4" id="remarks" name="remarks" placeholder="Write remarks here..."></textarea>

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

                        Save Room

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection

@push('script')
    <script>

        window.getRoomMasterList = function() {

            $.ajax({

                url: "{{ route('school.room.master.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        rows += `

                            <tr>

                                <td>${index + 1}</td>

                                <td>${d.hostel?.hostel_name || ''}</td>

                                <td>${d.block?.block_name || ''}</td>

                                <td>${d.floor?.floor_name || ''}</td>

                                <td>${d.room_number || ''}</td>

                                <td>${d.room_type?.room_type || ''}</td>

                                <td>${d.total_beds || 0}</td>

                                <td>${d.occupied_beds || 0}</td>

                                <td>${d.available_beds || 0}</td>

                                <td>
                                    ${d.status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>'
                                    }
                                </td>

                                <td>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="room-master-sidebar-btn edit">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="deleteRoomMaster">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>

                                </td>

                            </tr>

                        `;

                    });

                    if ($.fn.DataTable.isDataTable('#RoomMasterDataTable')) {

                        $('#RoomMasterDataTable')
                            .DataTable()
                            .destroy();

                    }

                    $('#roomMasterTableBody').html(rows);

                    $('#RoomMasterDataTable').DataTable({
                        pageLength: 10
                    });

                }

            });

        };

        $(document).ready(function() {
            getRoomMasterList();
        });


        $(document).on('change', '#hostel_id', function() {

            let hostelId = $(this).val();

            $('#hostel_block_id').html(`
                <option value="">
                    Select Block
                </option>
            `);

            if (hostelId) {

                $.ajax({

                    url: "{{ route('school.common.get_blocks_by_hostel_id') }}",

                    method: "GET",

                    data: {
                        id: hostelId
                    },

                    success: function(res) {

                        let options = `
                            <option value="">
                                Select Block
                            </option>
                        `;

                        $.each(res.data, function(index, d) {

                            options += `
                                <option value="${d.id}">
                                    ${d.block_name}
                                </option>
                            `;

                        });

                        $('#hostel_block_id').html(options);

                    }

                });

            }

        });

 

        $(document).on('change', '#hostel_block_id', function() {

            let blockId = $(this).val();

            $('#hostel_floor_id').html(`
                <option value="">
                    Select Floor
                </option>
            `);

            if (blockId) {

                $.ajax({

                    url: "{{ route('school.common.get_floors_by_block_id') }}",

                    method: "GET",

                    data: {
                        id: blockId
                    },

                    success: function(res) {

                        let options = `
                            <option value="">
                                Select Floor
                            </option>
                        `;

                        $.each(res.data, function(index, d) {

                            options += `
                                <option value="${d.id}">
                                    ${d.floor_name}
                                </option>
                            `;

                        });

                        $('#hostel_floor_id').html(options);

                    }

                });

            }

        });



        $(document).on('keyup change', '#total_beds, #occupied_beds', function() {

            let totalBeds = parseInt($('#total_beds').val()) || 0;

            let occupiedBeds = parseInt($('#occupied_beds').val()) || 0;

            let availableBeds = totalBeds - occupiedBeds;

            $('#available_beds').val(
                availableBeds >= 0 ? availableBeds : 0
            );

        });



        $(document).on('click', '.room-master-sidebar-btn', function() {

            let $btn = $(this);

            // Add Mode

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#roomMasterForm')[0].reset();

                $('#room_master_id').val('');

            }

            // Edit Mode

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.room-master-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET ROOM DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.room.master.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#room_master_id').val(res.data.id);

                            $('#hostel_id').val(res.data.hostel_id).trigger('change');

                            setTimeout(() => {

                                $('#hostel_block_id')
                                    .val(res.data.hostel_block_id)
                                    .trigger('change');

                            }, 500);

                            setTimeout(() => {

                                $('#hostel_floor_id')
                                    .val(res.data.hostel_floor_id);

                            }, 1000);

                            $('#room_type_id').val(res.data.room_type_id);

                            $('#room_number').val(res.data.room_number);

                            $('#total_beds').val(res.data.total_beds);

                            $('#occupied_beds').val(res.data.occupied_beds);

                            $('#available_beds').val(res.data.available_beds);

                            $('#facilities').val(res.data.facilities);

                            $('#remarks').val(res.data.remarks);

                            $('#status').val(res.data.status);

                        }

                    }

                });

            }

        });



        $(document).on('click', '.close-my-sidebar, .overlay', function() {

            $('.room-master-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
