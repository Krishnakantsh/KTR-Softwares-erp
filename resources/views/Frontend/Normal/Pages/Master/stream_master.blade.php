@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Stream Master')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">

            <div>
                <h1 class="fw-semibold mb-4 h6 text-primary-light">
                    Stream Master
                </h1>
            </div>

            <button type="button"
                class="stream-master-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add role">

                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>

                Add Stream

            </button>

        </div>

        <div class="mt-24">

            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="StreamDataTable" />

                    <div class="p-3">

                        <table class="table bordered-table mb-0 data-table" id="StreamDataTable" data-page-length='10'>

                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Stream Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="streamTableBody">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Sidebar Start -->

    <div
        class="stream-master-sidebar bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">

        <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">

            <h5 class="text-lg mb-0">

                <span class="dynamic-text">
                    Add New
                </span>

                Stream

            </h5>

            <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">

                <i class="ri-close-large-line"></i>

            </button>

        </div>

        <form id="streamMasterForm" class="ajaxForm" enctype="multipart/form-data"
            data-url="{{ route('school.stream.master.save') }}" data-refresh="getStreamList" data-method="POST">

            @csrf

            <input type="hidden" name="stream_id" id="stream_id" value="" class="hidden">

            <div class="row g-3 p-3">

                <div class="col-sm-12">

                    <div>

                        <label for="name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">

                            Stream Name

                        </label>

                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Stream Name">

                    </div>

                </div>

                <div class="col-12">

                    <div class="d-flex align-items-center justify-content-start gap-3 mt-8">

                        <button type="reset"
                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8">

                            Cancel

                        </button>

                        <button type="submit"
                            class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8 max-w-156-px w-100">

                            Save

                        </button>

                    </div>

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
        | OPEN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.stream-master-sidebar-btn', function() {

            let $btn = $(this);

            /*
            |--------------------------------------------------------------------------
            | ADD MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('add')) {

                $('.dynamic-text').text('Add New');

                $('#streamMasterForm')[0].reset();

                $('#stream_id').val('');
            }

            /*
            |--------------------------------------------------------------------------
            | EDIT MODE
            |--------------------------------------------------------------------------
            */

            if ($btn.hasClass('edit')) {

                $('.dynamic-text').text('Update');
            }

            $('.stream-master-sidebar').addClass('active');

            $('.overlay').addClass('active');

            let id = $btn.data('id');

            /*
            |--------------------------------------------------------------------------
            | FETCH STREAM DATA
            |--------------------------------------------------------------------------
            */

            if (id) {

                $.ajax({

                    url: `{{ route('school.stream.master.get') }}`,

                    method: "GET",

                    data: {
                        id: id,
                    },

                    success: function(res) {

                        if (res.status) {

                            $('#name').val(res.data.name);

                            $('#stream_id').val(res.data.id);
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

            $('.stream-master-sidebar').removeClass('active');

            $('.overlay').removeClass('active');

        });
    </script>
@endpush
