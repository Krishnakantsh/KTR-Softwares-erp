@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Transport Route Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Breadcrumb / Header -->
        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Transport Route Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage school transport routes, pickup points, travel distance and route timings.
                </p>

            </div>

            <button type="button"
                class="transport-route-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Route

            </button>

        </div>

        <!-- Table Section -->
        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="TransportRouteDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="TransportRouteDataTable"
                            data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>
                                    <th>Route Name</th>
                                    <th>Route Code</th>
                                    <th>Start Point</th>
                                    <th>End Point</th>
                                    <th>Distance (KM)</th>
                                    <th>Estimated Time</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="transportRouteTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="transport-route-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Route
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter transport route details
                </p>

            </div>

            <button type="button" class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="transportRouteForm" class="ajaxForm d-flex flex-column h-100" enctype="multipart/form-data"
            data-url="{{ route('school.transport.route.save') }}" data-refresh="getTransportRouteList" data-method="POST">

            @csrf

            <input type="hidden" name="route_id" id="route_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Route Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Route Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Manage transport route details
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Route Name -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Route Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="route_name" name="route_name"
                                placeholder="Enter Route Name">

                        </div>

                        <!-- Route Code -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Route Code
                            </label>

                            <input type="text" class="form-control" id="route_code" name="route_code"
                                placeholder="Enter Route Code">

                        </div>

                        <!-- Start Point -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Start Point <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="start_point" name="start_point"
                                placeholder="Enter Start Point">

                        </div>

                        <!-- End Point -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                End Point <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="end_point" name="end_point"
                                placeholder="Enter End Point">

                        </div>

                        <!-- Distance -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Total Distance (KM)
                            </label>

                            <input type="number" step="0.01" class="form-control" id="total_distance"
                                name="total_distance" placeholder="Enter Total Distance">

                        </div>

                        <!-- Estimated Time -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Estimated Time (Minutes)
                            </label>

                            <input type="number" class="form-control" id="estimated_time" name="estimated_time"
                                placeholder="Enter Estimated Time">

                        </div>

                        <!-- Status -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Status
                            </label>

                            <select class="form-select" name="status" id="status">

                                <option value="1">Active</option>
                                <option value="0">Inactive</option>

                            </select>

                        </div>

                        <!-- Description -->

                        <div class="col-12">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Route Description
                            </label>

                            <textarea class="form-control" rows="4" id="route_description" name="route_description"
                                placeholder="Write route description here..."></textarea>

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

                        Save Route

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
            | FETCH ROUTE LIST
            |--------------------------------------------------------------------------
            */

        window.getTransportRouteList = function() {

            $.ajax({

                url: "{{ route('school.transport.route.fetch.with') }}",

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
                                ${d.route_name || ''}
                            </td>

                            <td>
                                ${d.route_code || ''}
                            </td>

                            <td>
                                ${d.start_point || ''}
                            </td>

                            <td>
                                ${d.end_point || ''}
                            </td>

                            <td>
                                ${d.total_distance || ''}
                            </td>

                            <td>
                                ${d.estimated_time || ''} Min
                            </td>

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
                                    class="transport-route-sidebar-btn edit">

                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteTransportRoute">

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

                    if ($.fn.DataTable.isDataTable('#TransportRouteDataTable')) {

                        $('#TransportRouteDataTable')
                            .DataTable()
                            .destroy();
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Append Rows
                    |--------------------------------------------------------------------------
                    */

                    $('#transportRouteTableBody').html(rows);

                    /*
                    |--------------------------------------------------------------------------
                    | Initialize DataTable
                    |--------------------------------------------------------------------------
                    */

                    $('#TransportRouteDataTable').DataTable({
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

            getTransportRouteList();

        });

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.transport-route-sidebar-btn', function() {

            let $btn = $(this);

            /*
            |--------------------------------------------------------------------------
            | ADD MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#transportRouteForm')[0].reset();

                $('#route_id').val('');

            }

            /*
            |--------------------------------------------------------------------------
            | EDIT MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.transport-route-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET ROUTE DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.transport.route.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#route_id').val(res.data.id);

                            $('#route_name').val(res.data.route_name);

                            $('#route_code').val(res.data.route_code);

                            $('#start_point').val(res.data.start_point);

                            $('#end_point').val(res.data.end_point);

                            $('#total_distance').val(res.data.total_distance);

                            $('#estimated_time').val(res.data.estimated_time);

                            $('#route_description').val(res.data.route_description);

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

            $('.transport-route-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
