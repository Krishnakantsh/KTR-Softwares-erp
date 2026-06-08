@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Vehicle Route Deployment')

@section('dynamic-content')

    <style>
        .active-toggle,
        .inactive-toggle {

            font-size: 42px;
            transition: all 0.5s ease-in-out;
            cursor: pointer;
        }

        /* ACTIVE */

        .active-toggle {

            color: #22c55e;

            transform: scale(1.05);
        }

        /* INACTIVE */

        .inactive-toggle {

            color: #9ca3af;

            opacity: 0.7;

            transform: scale(0.95);
        }
    </style>

    <div class="dashboard-main-body">

        <!-- Breadcrumb / Header -->
        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Vehicle Route Deployment
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Assign transport vehicles to routes, manage operational shifts, deployment dates and transport
                    scheduling.
                </p>

            </div>

            <button type="button"
                class="vehicle-deployment-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Deploy Vehicle

            </button>

        </div>

        <!-- Table Section -->
        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="VehicleDeploymentDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="VehicleDeploymentDataTable">

                            <thead>

                                <tr>

                                    <th>S.No.</th>
                                    <th>Vehicle</th>
                                    <th>Vehicle Number</th>
                                    <th>Assigned Route</th>
                                    <th>Shift</th>
                                    <th>Deployment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="vehicleDeploymentTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="vehicle-deployment-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Deploy</span> Vehicle
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Configure vehicle and route deployment details
                </p>

            </div>

            <button type="button" class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="vehicleDeploymentForm" class="ajaxForm d-flex flex-column h-100" enctype="multipart/form-data"
            data-url="{{ route('school.transport.assign.vehicle.save') }}" data-refresh="getVehicleDeploymentList"
            data-method="POST">

            @csrf

            <input type="hidden" name="deployment_id" id="deployment_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Deployment Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Deployment Configuration
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Assign vehicles to operational routes and schedules
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Vehicle -->

                        <div class="col-md-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Select Vehicle <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="transport_vehicle_id" id="transport_vehicle_id">

                                <option value="">Select Vehicle</option>

                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->vehicle_name }}
                                        ({{ $vehicle->vehicle_number }})
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- Route -->

                        <div class="col-md-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Assign Route <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="transport_route_id" id="transport_route_id">

                                <option value="">Select Route</option>

                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}">
                                        {{ $route->route_name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- Shift -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Operational Shift
                            </label>

                            <select class="form-select" name="shift" id="shift">

                                <option value="">Select Shift</option>

                                <option value="Morning">Morning Shift</option>

                                <option value="Evening">Evening Shift</option>

                            </select>

                        </div>

                        <!-- Deployment Date -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Deployment Date
                            </label>

                            <input type="date" class="form-control" id="assign_date" name="assign_date">

                        </div>

                        <!-- Status -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Deployment Status
                            </label>

                            <select class="form-select" name="status" id="status">

                                <option value="1">Active</option>

                                <option value="0">Inactive</option>

                            </select>

                        </div>

                        <!-- Remarks -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Deployment Remarks
                            </label>

                            <textarea class="form-control" rows="4" id="remarks" name="remarks"
                                placeholder="Write deployment remarks here..."></textarea>

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

                        Save Deployment

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
                | FETCH DEPLOYMENT LIST
                |--------------------------------------------------------------------------
                */

        window.getVehicleDeploymentList = function() {

            $.ajax({

                url: "{{ route('school.transport.assign.vehicle.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        let date = formatDate(d.assign_date || '');

                        rows += `

                    <tr>

                        <td>
                            ${index + 1}
                        </td>

                        <td>
                            ${d.vehicle?.vehicle_name || ''}
                        </td>

                        <td>
                            ${d.vehicle?.vehicle_number || ''}
                        </td>

                        <td>
                            ${d.route?.route_name || ''}
                        </td>

                        <td>

                            ${
                                d.shift == 'Morning'
                                ?
                                `<span class="badge bg-warning-focus text-warning-main">
                                                                        Morning
                                                                    </span>`
                                :
                                `<span class="badge bg-info-focus text-info-main">
                                                                        Evening
                                                                    </span>`
                            }

                        </td>

                        <td>
                            ${date}
                        </td>

                       <td>

                            <button
                                type="button"
                                data-id="${d.id}"
                                class="toggleVehicleDeploymentStatus border-0 bg-transparent p-0">

                                <i class="
                                    ${d.status == 1 ? 'ri-toggle-fill active-toggle' : 'ri-toggle-line inactive-toggle'}
                                "></i>

                            </button>
                        </td>

                        <td>
                          
                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="vehicle-deployment-sidebar-btn edit">

                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>


                            <button
                                type="button"
                                data-id="${d.id}"
                                class="deleteVehicleDeployment">

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

                    if ($.fn.DataTable.isDataTable('#VehicleDeploymentDataTable')) {

                        $('#VehicleDeploymentDataTable')
                            .DataTable()
                            .destroy();

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Append Rows
                    |--------------------------------------------------------------------------
                    */

                    $('#vehicleDeploymentTableBody').html(rows);

                    /*
                    |--------------------------------------------------------------------------
                    | Initialize DataTable
                    |--------------------------------------------------------------------------
                    */

                    $('#VehicleDeploymentDataTable').DataTable({
                        pageLength: 10
                    });

                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | DOCUMENT READY
        |--------------------------------------------------------------------------
        */

        $(document).ready(function() {

            getVehicleDeploymentList();

        });

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.vehicle-deployment-sidebar-btn', function() {

            let $btn = $(this);

            /*
            |--------------------------------------------------------------------------
            | ADD MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Deploy');

                $('#vehicleDeploymentForm')[0].reset();

                $('#deployment_id').val('');

            }

            /*
            |--------------------------------------------------------------------------
            | EDIT MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.vehicle-deployment-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET DEPLOYMENT DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.transport.assign.vehicle.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#deployment_id').val(res.data.id);

                            $('#transport_vehicle_id').val(res.data.transport_vehicle_id);

                            $('#transport_route_id').val(res.data.transport_route_id);

                            $('#shift').val(res.data.shift);

                            $('#assign_date').val(res.data.assign_date);

                            $('#remarks').val(res.data.remarks);

                            $('#status').val(res.data.status);

                        }

                    }

                });

            }

        });


        $(document).on('click', '.toggleVehicleDeploymentStatus', function() {

            let icon = $(this).find('i');

            let id = $(this).data('id');

            let route = "{{ route('school.transport.assign.vehicle.status') }}";


            masterToggleStatus(id, route, [getVehicleDeploymentList]);

            /*
            |--------------------------------------------------------------------------
            | Smooth Toggle Animation
            |--------------------------------------------------------------------------
            */

            if (icon.hasClass('active-toggle')) {

                icon
                    .removeClass('ri-toggle-fill active-toggle')
                    .addClass('ri-toggle-line inactive-toggle');

            } else {

                icon
                    .removeClass('ri-toggle-line inactive-toggle')
                    .addClass('ri-toggle-fill active-toggle');
            }

        });

        /*
        |--------------------------------------------------------------------------
        | CLOSE SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.close-my-sidebar, .overlay', function() {

            $('.vehicle-deployment-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
