@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Hostel Block Management')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <!-- Header -->

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>

                <h1 class="fw-semibold mb-2 h5 text-primary-light">
                    Hostel Block Management
                </h1>

                <p class="mb-0 text-secondary-light text-sm">
                    Manage hostel blocks, floors, student capacity and accommodation sections.
                </p>

            </div>

            <button type="button" class="hostel-block-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Hostel Block

            </button>

        </div>

        <!-- Table -->

        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="HostelBlockDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="HostelBlockDataTable" data-page-length="10">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Hostel</th>

                                    <th>Block Name</th>

                                    <th>Block Code</th>

                                    <th>Total Floors</th>

                                    <th>Capacity</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="hostelBlockTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar -->

    <div
        class="hostel-block-sidebar bg-white position-fixed end-0 top-0 vh-100 z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0 d-flex flex-column">

        <!-- Sidebar Header -->

        <div class="px-20 py-14 border-bottom d-flex align-items-center justify-content-between">

            <div>

                <h5 class="text-lg mb-1">
                    <span class="dynamic-text">Add New</span> Hostel Block
                </h5>

                <p class="mb-0 text-sm text-secondary-light">
                    Enter hostel block and accommodation details
                </p>

            </div>

            <button type="button" class="close-my-sidebar text-danger-600 text-xl d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <!-- Form -->

        <form id="hostelBlockForm" class="ajaxForm d-flex flex-column h-100" enctype="multipart/form-data"
            data-url="{{ route('school.hostel.block.save') }}" data-refresh="getHostelBlockList" data-method="POST">

            @csrf

            <input type="hidden" name="block_id" id="hostel_block_id">

            <div class="p-20 pb-48 overflow-y-auto flex-grow-1">

                <!-- Block Information -->

                <div class="mb-24">

                    <div class="border-bottom pb-2 mb-16">

                        <h6 class="fw-semibold text-primary-light mb-1">
                            Block Information
                        </h6>

                        <p class="text-sm text-secondary-light mb-0">
                            Basic details of hostel block and building structure
                        </p>

                    </div>

                    <div class="row g-3">

                        <!-- Hostel -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Select Hostel <span class="text-danger">*</span>
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

                        <!-- Block Name -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Block Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="block_name" name="block_name"
                                placeholder="Enter Block Name">

                        </div>

                        <!-- Block Code -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Block Code
                            </label>

                            <input type="text" class="form-control" id="block_code" name="block_code"
                                placeholder="Enter Block Code">

                        </div>

                        <!-- Total Floors -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Total Floors
                            </label>

                            <input type="number" class="form-control" id="total_floors" name="total_floors"
                                placeholder="Enter Total Floors">

                        </div>

                        <!-- Capacity -->

                        <div class="col-md-6">

                            <label class="text-sm fw-semibold text-primary-light mb-8">
                                Student Capacity
                            </label>

                            <input type="number" class="form-control" id="capacity" name="capacity"
                                placeholder="Enter Student Capacity">

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

                <!-- Additional Details -->

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

                        Save Hostel Block

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
            | FETCH HOSTEL BLOCK LIST
            |--------------------------------------------------------------------------
            */

        window.getHostelBlockList = function() {

            $.ajax({

                url: "{{ route('school.hostel.block.fetch.with') }}",

                method: "GET",

                success: function(res) {

                    let rows = "";

                    $.each(res.data, function(index, d) {

                        rows += `

                            <tr>

                                <td>${index + 1}</td>

                                <td>${d.hostel?.hostel_name || ''}</td>

                                <td>${d.block_name || ''}</td>

                                <td>${d.block_code || ''}</td>

                                <td>${d.total_floors || 0}</td>

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
                                        class="hostel-block-sidebar-btn edit">

                                        <i class="ri-edit-fill custom-btn-primary"></i>

                                    </button>

                                    <button type="button"
                                        data-id="${d.id}"
                                        class="deleteHostelBlock">

                                        <i class="ri-delete-bin-fill custom-btn-red"></i>

                                    </button>

                                </td>

                            </tr>

                        `;

                    });

                    if ($.fn.DataTable.isDataTable('#HostelBlockDataTable')) {

                        $('#HostelBlockDataTable')
                            .DataTable()
                            .destroy();

                    }

                    $('#hostelBlockTableBody').html(rows);

                    $('#HostelBlockDataTable').DataTable({
                        pageLength: 10
                    });

                }

            });

        };

        $(document).ready(function() {

            getHostelBlockList();
            generateSrNo();
            generateEnrollNo();
            generateAdmNo();

        });

        /*
        |--------------------------------------------------------------------------
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.hostel-block-sidebar-btn', function() {

            let $btn = $(this);

            // Add Mode

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#hostelBlockForm')[0].reset();

                $('#hostel_block_id').val('');

            }

            // Edit Mode

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');

            }

            $('.hostel-block-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | GET BLOCK DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.hostel.block.get') }}`,

                    method: "GET",

                    data: {
                        id: id
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#hostel_block_id').val(res.data.id);

                            $('#hostel_id').val(res.data.hostel_id);

                            $('#block_name').val(res.data.block_name);

                            $('#block_code').val(res.data.block_code);

                            $('#total_floors').val(res.data.total_floors);

                            $('#capacity').val(res.data.capacity);

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

            $('.hostel-block-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
