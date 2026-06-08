@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Hostel Floor Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Header -->

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Hostel Floor Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage hostel floors, room distribution, accommodation levels and floor details.
                </p>

            </div>

            <button type="button"
                class="hostel-floor-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Hostel Floor

            </button>

        </div>

        <!-- Table Section -->

        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="HostelFloorDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table"
                            id="HostelFloorDataTable"
                            data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Hostel</th>

                                    <th>Block</th>

                                    <th>Floor Name</th>

                                    <th>Floor Number</th>

                                    <th>Total Rooms</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="hostelFloorTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="hostel-floor-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Hostel Floor
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter hostel floor and room details
                </p>

            </div>

            <button type="button"
                class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="hostelFloorForm"
            class="ajaxForm d-flex flex-column h-100"
            enctype="multipart/form-data"
            data-url="{{ route('school.hostel.floor.save') }}"
            data-refresh="getHostelFloorList"
            data-method="POST">

            @csrf

            <input type="hidden"
                name="floor_id"
                id="hostel_floor_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Floor Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Floor Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage floor structure and accommodation setup
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Hostel -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Select Hostel <span class="text-danger">*</span>
                            </label>

                            <select class="form-select"
                                name="hostel_id"
                                id="hostel_id">

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
                                Select Block <span class="text-danger">*</span>
                            </label>

                            <select class="form-select"
                                name="hostel_block_id"
                                id="hostel_block_id">

                                <option value="">
                                    Select Block
                                </option>

                            </select>

                        </div>

                        <!-- Floor Name -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Floor Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                class="form-control"
                                id="floor_name"
                                name="floor_name"
                                placeholder="Enter Floor Name">

                        </div>

                        <!-- Floor Number -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Floor Number
                            </label>

                            <input type="number"
                                class="form-control"
                                id="floor_number"
                                name="floor_number"
                                placeholder="Enter Floor Number">

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

                <!-- Additional Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Additional Information
                        </h6>

                    </div>

                    <div class="row g-3">

                        <!-- Remarks -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Remarks
                            </label>

                            <textarea class="form-control"
                                rows="4"
                                id="remarks"
                                name="remarks"
                                placeholder="Write remarks here..."></textarea>

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

                        Save Hostel Floor

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
        | FETCH HOSTEL FLOOR LIST
        |--------------------------------------------------------------------------
        */

        window.getHostelFloorList = function() {

            $.ajax({

                url: "{{ route('school.hostel.floor.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        rows += `

                            <tr>

                                <td>${index + 1}</td>

                                <td>${d.hostel?.hostel_name || ''}</td>

                                <td>${d.hostel_block?.block_name || ''}</td>

                                <td>${d.floor_name || ''}</td>

                                <td>${d.floor_number || ''}</td>

                                <td>${d.total_rooms || ''}</td>

                                <td>
                                    ${d.status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>'
                                    }
                                </td>

                                <td>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="hostel-floor-sidebar-btn edit">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="deleteHostelFloor">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>

                                </td>

                            </tr>

                        `;

                    });

                    if ($.fn.DataTable.isDataTable('#HostelFloorDataTable')) {

                        $('#HostelFloorDataTable')
                            .DataTable()
                            .destroy();

                    }

                    $('#hostelFloorTableBody').html(rows);

                    $('#HostelFloorDataTable').DataTable({
                        pageLength: 10
                    });

                }

            });

        };

        $(document).ready(function() {

            getHostelFloorList();

        });

        /*
        |--------------------------------------------------------------------------
        | GET BLOCKS BY HOSTEL
        |--------------------------------------------------------------------------
        */

        $(document).on('change', '#hostel_id', function() {

            let hostelId = $(this).val();

            $('#hostel_block_id').html(`
                <option value="">
                    Select Block
                </option>
            `);

            if (hostelId) {

                $.ajax({

                    url: "{{ route('school.hostel.block.by.hostel') }}",

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

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.hostel-floor-sidebar-btn', function() {

            let $btn = $(this);

            // Add Mode

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#hostelFloorForm')[0].reset();

                $('#hostel_floor_id').val('');

            }

            // Edit Mode

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.hostel-floor-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET FLOOR DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.hostel.floor.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#hostel_floor_id').val(res.data.id);

                            $('#hostel_id').val(res.data.hostel_id).trigger('change');

                            setTimeout(() => {

                                $('#hostel_block_id').val(res.data.hostel_block_id);

                            }, 500);

                            $('#floor_name').val(res.data.floor_name);

                            $('#floor_number').val(res.data.floor_number);

                            $('#total_rooms').val(res.data.total_rooms);

                            $('#remarks').val(res.data.remarks);

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

            $('.hostel-floor-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });

    </script>

@endpush