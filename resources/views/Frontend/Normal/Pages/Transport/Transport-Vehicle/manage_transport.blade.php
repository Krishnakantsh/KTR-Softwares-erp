@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Transport Vehicle Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Breadcrumb / Header -->
        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div>
                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Transport Vehicle Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage school buses, vans, drivers, transport documents and vehicle details.
                </p>
            </div>

            <button type="button"
                class="transport-vehicle-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Vehicle
            </button>
        </div>

        <!-- Table Section -->
        <div class="mt-24">
            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="TransportVehicleDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="TransportVehicleDataTable"
                            data-page-length="10">

                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Vehicle</th>
                                    <th>Vehicle Number</th>
                                    <th>Type</th>
                                    <th>Driver</th>
                                    <th>Phone</th>
                                    <th>Seats</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="transportVehicleTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Sidebar Start -->


    <!-- Sidebar Start -->
    <div
        class="transport-vehicle-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->
        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>
                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Vehicle
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter vehicle and transport staff details
                </p>
            </div>

            <button type="button" class="close-my-sidebar text-danger-600 text-xl d-flex">
                <i class="ri-close-large-line"></i>
            </button>

        </div>

        <!-- Form -->

        <form id="transportVehicleForm" class="ajaxForm d-flex flex-column h-100" enctype="multipart/form-data"
            data-url="{{ route('school.transport.vehicle.save') }}" data-refresh="getTransportVehicleList"
            data-method="POST">
            @csrf

            <input type="hidden" name="vehicle_id" id="vehicle_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Vehicle Information -->
                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">
                        <h6 class="fw-semibold text-primary-light mb-1">
                            Vehicle Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Basic details of the transport vehicle
                        </p>
                    </div>

                    <div class="row g-3">

                        <!-- Vehicle Name -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Vehicle Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="vehicle_name" name="vehicle_name"
                                placeholder="Enter Vehicle Name">
                        </div>

                        <!-- Vehicle Number -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Vehicle Number <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"
                                placeholder="UP80 AB 1234">
                        </div>

                        <!-- Vehicle Type -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Vehicle Type
                            </label>

                            <select class="form-select" name="vehicle_type" id="vehicle_type">
                                <option value="">Select Vehicle Type</option>
                                <option value="Bus">Bus</option>
                                <option value="Mini Bus">Mini Bus</option>
                                <option value="Van">Van</option>
                                <option value="Auto">Auto</option>
                            </select>
                        </div>

                        <!-- Seat Capacity -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Seat Capacity
                            </label>

                            <input type="number" class="form-control" id="seat_capacity" name="seat_capacity"
                                placeholder="Enter Seat Capacity">
                        </div>

                    </div>

                </div>

                <!-- Driver Details -->
                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">
                        <h6 class="fw-semibold text-primary-light mb-1">
                            Driver & Conductor Details
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage transport staff information
                        </p>
                    </div>

                    <div class="row g-3">

                        <!-- Driver Name -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Driver Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="driver_name" name="driver_name"
                                placeholder="Enter Driver Name">
                        </div>

                        <!-- Driver Phone -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Driver Phone <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="driver_phone" name="driver_phone"
                                placeholder="Enter Driver Phone">
                        </div>

                        <!-- Conductor Name -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Conductor Name
                            </label>

                            <input type="text" class="form-control" id="conductor_name" name="conductor_name"
                                placeholder="Enter Conductor Name">
                        </div>

                        <!-- Conductor Phone -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Conductor Phone
                            </label>

                            <input type="text" class="form-control" id="conductor_phone" name="conductor_phone"
                                placeholder="Enter Conductor Phone">
                        </div>

                    </div>

                </div>

                <!-- Vehicle Documents -->
                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">
                        <h6 class="fw-semibold text-primary-light mb-1">
                            Vehicle Documents
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage insurance, pollution and fitness details
                        </p>
                    </div>

                    <div class="row g-3">

                        <!-- Insurance -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Insurance Number
                            </label>

                            <input type="text" class="form-control" id="insurance_number" name="insurance_number"
                                placeholder="Enter Insurance Number">
                        </div>

                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Insurance Expiry Date
                            </label>

                            <input type="date" class="form-control" id="insurance_expiry" name="insurance_expiry">
                        </div>

                        <!-- Pollution -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Pollution Certificate Number
                            </label>

                            <input type="text" class="form-control" id="pollution_number" name="pollution_number"
                                placeholder="Enter Pollution Number">
                        </div>

                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Pollution Expiry Date
                            </label>

                            <input type="date" class="form-control" id="pollution_expiry" name="pollution_expiry">
                        </div>

                        <!-- Fitness -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Fitness Certificate Number
                            </label>

                            <input type="text" class="form-control" id="fitness_certificate"
                                name="fitness_certificate" placeholder="Enter Fitness Certificate">
                        </div>

                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Fitness Expiry Date
                            </label>

                            <input type="date" class="form-control" id="fitness_expiry" name="fitness_expiry">
                        </div>

                        <!-- RC -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                RC Number
                            </label>

                            <input type="text" class="form-control" id="rc_number" name="rc_number"
                                placeholder="Enter RC Number">
                        </div>

                        <!-- Maintenance -->
                        <div class="col-md-6">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Monthly Maintenance Cost
                            </label>

                            <input type="number" step="0.01" class="form-control" id="monthly_maintenance_cost"
                                name="monthly_maintenance_cost" placeholder="Enter Maintenance Cost">
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

                        <!-- Notes -->
                        <div class="col-12">
                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Notes
                            </label>

                            <textarea class="form-control" rows="4" id="notes" name="notes"
                                placeholder="Write additional notes here..."></textarea>
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

                        Save Vehicle
                    </button>

                </div>

            </div>

        </form>

    </div>
    <!-- Sidebar End -->

@endsection

@push('script')
    <script>
        window.getTransportVehicleList = function() {

            $.ajax({

                url: "{{ route('school.transport.vehicle.fetch.with') }}",

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
                                        ${d.vehicle_name || '' }
                                    </td>

                                    <td>
                                        ${d.vehicle_number || '' }
                                    </td>

                                    <td>
                                          ${(d.vehicle_type || '').charAt(0).toUpperCase() + (d.vehicle_type || '').slice(1)}
                                    </td>

                                    <td>
                                        ${d.driver_name || '' }
                                    </td>

                                    <td>
                                        ${d.driver_phone || ''  }
                                    </td>

                                    <td>
                                        ${d.seat_capacity || ''  }
                                    </td>
                                    <td>
                                        ${d.status || '' }
                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            data-id="${d.id}"
                                            class="transport-vehicle-sidebar-btn edit role">

                                            <i class="ri-edit-fill custom-btn-primary"></i>

                                        </button>

                                        <button
                                            type="button"
                                            data-id="${d.id}"
                                            class="deleteTransportVehicle">

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

                    if ($.fn.DataTable.isDataTable('#TransportVehicleDataTable')) {

                        $('#TransportVehicleDataTable')
                            .DataTable()
                            .destroy();
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Append Rows
                    |--------------------------------------------------------------------------
                    */

                    $("#transportVehicleTableBody").html(rows);

                    /*
                    |--------------------------------------------------------------------------
                    | Initialize DataTable
                    |--------------------------------------------------------------------------
                    */

                    $('#TransportVehicleDataTable').DataTable({
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

            getTransportVehicleList();

        });


        /*
            |--------------------------------------------------------------------------
            | OPEN SIDEBAR
            |--------------------------------------------------------------------------
            */

        $(document).on('click', '.transport-vehicle-sidebar-btn', function() {

            let $btn = $(this);

            // Add Mode
            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#transportVehicleForm')[0].reset();

                $('#vehicle_id').val('');
            }

            // Edit Mode
            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');
            }

            $('.transport-vehicle-sidebar').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET VEHICLE DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.transport.vehicle.get') }}`,

                    method: "GET",

                    data: {
                        id: id,
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#vehicle_id').val(res.data.id);

                            $('#vehicle_name').val(res.data.vehicle_name);
                            $('#vehicle_number').val(res.data.vehicle_number);
                            $('#vehicle_type').val(res.data.vehicle_type);

                            $('#driver_name').val(res.data.driver_name);
                            $('#driver_phone').val(res.data.driver_phone);

                            $('#conductor_name').val(res.data.conductor_name);
                            $('#conductor_phone').val(res.data.conductor_phone);

                            $('#seat_capacity').val(res.data.seat_capacity);

                            $('#insurance_number').val(res.data.insurance_number);
                            $('#insurance_expiry').val(res.data.insurance_expiry);

                            $('#pollution_number').val(res.data.pollution_number);
                            $('#pollution_expiry').val(res.data.pollution_expiry);

                            $('#fitness_certificate').val(res.data.fitness_certificate);
                            $('#fitness_expiry').val(res.data.fitness_expiry);

                            $('#rc_number').val(res.data.rc_number);

                            $('#monthly_maintenance_cost').val(res.data.monthly_maintenance_cost);

                            $('#notes').val(res.data.notes);

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

            $('.transport-vehicle-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
