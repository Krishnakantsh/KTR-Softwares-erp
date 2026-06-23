@extends('Frontend.Normal.Layout.main')


@section('title', 'KTR ERP : Class Master ')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light">Class Master </h1>

            </div>
            <button type="button"
                class="class-master-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add role">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Class
            </button>
        </div>

        <div class="mt-24">
            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="ClassDataTable" />

                    <div class="p-3">
                        <table class="table bordered-table mb-0 data-table" id="ClassDataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Class Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody id="classTableBody">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sectionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="sectionForm" class="ajaxForm" data-url="{{route('school.class.section.save')}}"
                    data-refresh="getClassList">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Manage Sections</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="class_id" id="modal_class_id">

                        <!-- Class Name -->
                        <div class="mb-3">
                            <label>Class Name</label>
                            <input type="text" id="modal_class_name" class="form-control" readonly>
                        </div>

                        <!-- No of Sections -->
                        <div class="mb-3">
                            <label>No. of Sections</label>
                            <input type="number" id="no_of_sections" class="form-control" min="1">
                        </div>

                        <!-- Dynamic Section Inputs -->
                        <div id="sectionInputs"></div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Sections</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Add sidebar start -->
    <div
        class="class-master-sidebar bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">
        <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">
            <h5 class="text-lg mb-0 role_canvas_text"><span class="dynamic-text">Add New</span> Class</h5>
            <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">
                <i class="ri-close-large-line"></i>
            </button>
        </div>
        <form id="classMasterForm" class="ajaxForm" enctype="multipart/form-data"
            data-url="{{ route('school.class.master.save') }}" data-refresh="getClassList" data-method="POST">
            @csrf
            <input type="hidden" name="class_id" id="class_id" value="" class="hidden">
            <div class="row g-3 p-3">
                <div class="col-sm-12">
                    <div class="">
                        <label for="name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Class
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Class Name">
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

    <!-- Add sidebar end -->
@endsection

@push('script')
    <script>
        $(document).on('click', '.class-master-sidebar-btn', function() {

            let $btn = $(this);

            // Text change
            if ($btn.hasClass('add')) {
                $('.dynamic-text').text('Add New');
                $('#classMasterForm')[0].reset();
                $('#class_id').val('');
            }

            if ($btn.hasClass('edit')) {
                $('.dynamic-text').text('Update');
            }

            $('.class-master-sidebar').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            if (id) {
                $.ajax({
                    url: `{{ route('school.class.master.get.with') }}`,
                    method: "GET",
                    data: {
                        id: id,
                    },
                    success: function(res) {
                        if (res.status) {
                            $('#name').val(res.data.name);
                            $('#class_id').val(res.data.id);
                        }
                    }
                });
            }

        });

        // Close sidebar
        $(document).on('click', '.close-my-sidebar, .overlay', function() {
            $('.class-master-sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });
    </script>
@endpush
