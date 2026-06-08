@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Transport Destination Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Transport Destination Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage transport pickup destinations, stop timings, route sequence, distance and transport fees.
                </p>

            </div>

            <button type="button"
                class="transport-destination-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Destination

            </button>

        </div>

        <!-- Table Section -->
        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="TransportDestinationDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="TransportDestinationDataTable"
                            data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>
                                    <th>Route</th>
                                    <th>Destination</th>
                                    <th>Pickup Time</th>
                                    <th>Drop Time</th>
                                    <th>Stop Order</th>
                                    <th>Distance</th>
                                    <th>Transport Fee</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="transportDestinationTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="transport-destination-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Destination
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter destination and transport stop details
                </p>

            </div>

            <button type="button" class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="transportDestinationForm" class="ajaxForm d-flex flex-column h-100" enctype="multipart/form-data"
            data-url="{{ route('school.transport.destination.save') }}" data-refresh="getTransportDestinationList"
            data-method="POST">

            @csrf

            <input type="hidden" name="destination_id" id="destination_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Destination Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Destination Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage route destination and stop details
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Route -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Select Route <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" name="transport_route_id" id="transport_route_id">

                                <option value="">
                                    Select Route
                                </option>

                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}">
                                        {{ $route->route_name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- Destination Name -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Destination Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="destination_name" name="destination_name"
                                placeholder="Enter Destination Name">

                        </div>


                        <!-- Pickup Time -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Pickup Time
                            </label>

                            <input type="time" class="form-control" id="pickup_time" name="pickup_time">

                        </div>

                        <!-- Drop Time -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Drop Time
                            </label>

                            <input type="time" class="form-control" id="drop_time" name="drop_time">

                        </div>

                        <!-- Stop Order -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Stop Order
                            </label>

                            <input type="number" class="form-control" id="stop_order" name="stop_order"
                                placeholder="Enter Stop Sequence">

                        </div>

                        <!-- Distance -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Distance From School (KM)
                            </label>

                            <input type="number" step="0.01" class="form-control" id="distance_from_school"
                                name="distance_from_school" placeholder="Enter Distance">

                        </div>

                        <!-- Transport Fee -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Transport Fee
                            </label>

                            <input type="number" step="0.01" class="form-control" id="transport_fee"
                                name="transport_fee" placeholder="Enter Transport Fee">

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

                        <!-- Address -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Destination Address
                            </label>

                            <textarea class="form-control" rows="4" id="address" name="address"
                                placeholder="Enter full pickup/drop address..."></textarea>

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

                        Save Destination

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
                    | FETCH DESTINATION LIST
                    |--------------------------------------------------------------------------
                    */

        window.getTransportDestinationList = function() {

            $.ajax({

                url: "{{ route('school.transport.destination.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.route?.route_name || ''}</td>

                            <td>${d.destination_name || ''}</td>

                            <td>${d.pickup_time || '-'}</td>

                            <td>${d.drop_time || '-'}</td>

                            <td>${d.stop_order || 0}</td>

                            <td>${d.distance_from_school || 0} KM</td>

                            <td>₹ ${d.transport_fee || 0}</td>

                            <td>

                                ${
                                    d.status == 1
                                    ?
                                    `<span class="badge bg-success-focus text-success-main">
                                                    Active
                                                </span>`
                                    :
                                    `<span class="badge bg-danger-focus text-danger-main">
                                                    Inactive
                                                </span>`
                                }

                            </td>

                            <td>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="transport-destination-sidebar-btn edit">

                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteTransportDestination">

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

                    if ($.fn.DataTable.isDataTable('#TransportDestinationDataTable')) {

                        $('#TransportDestinationDataTable')
                            .DataTable()
                            .destroy();
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Append Rows
                    |--------------------------------------------------------------------------
                    */

                    $('#transportDestinationTableBody').html(rows);

                    /*
                    |--------------------------------------------------------------------------
                    | Initialize DataTable
                    |--------------------------------------------------------------------------
                    */

                    $('#TransportDestinationDataTable').DataTable({
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

            getTransportDestinationList();

        });

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.transport-destination-sidebar-btn', function() {

            let $btn = $(this);

            /*
            |--------------------------------------------------------------------------
            | ADD MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#transportDestinationForm')[0].reset();

                $('#destination_id').val('');

            }

            /*
            |--------------------------------------------------------------------------
            | EDIT MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.transport-destination-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET DESTINATION DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.transport.destination.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#destination_id').val(res.data.id);

                            $('#transport_route_id').val(res.data.transport_route_id);

                            $('#destination_name').val(res.data.destination_name);

                            $('#pickup_time').val(res.data.pickup_time);

                            $('#drop_time').val(res.data.drop_time);

                            $('#stop_order').val(res.data.stop_order);

                            $('#distance_from_school').val(res.data.distance_from_school);

                            $('#transport_fee').val(res.data.transport_fee);

                            $('#address').val(res.data.address);

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

            $('.transport-destination-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
