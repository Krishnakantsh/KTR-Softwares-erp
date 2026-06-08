@extends('Frontend.Normal.Layout.main')


@section('title', 'KTR ERP : Class Master ')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light">Manage Subject Group </h1>
            </div>
            <button type="button"
                class="subject-group-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add role">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Subject Group
            </button>
        </div>

        <div class="mt-24">
            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="subjectGroupDataTable" />

                    <div class="p-3">
                        <table class="table bordered-table mb-0 data-table" id="subjectGroupDataTable"
                            data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Group Name</th>
                                    <th scope="col">Related Subjects</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody id="subjectGroupTableBody">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add sidebar start -->
    <div
        class="subject-group-sidebar bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">
        <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">
            <h5 class="text-lg mb-0 role_canvas_text"><span class="dynamic-text">Add New</span>Subject Group</h5>
            <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">
                <i class="ri-close-large-line"></i>
            </button>
        </div>
        <form id="subjectGroupForm" class="ajaxForm" enctype="multipart/form-data"
            data-url="{{ route('school.subject.group.save') }}" data-refresh="getSubjectGroupList" data-method="POST">
            @csrf
            <input type="hidden" name="group_id" id="group_id" value="" class="hidden">
            <div class="row g-3 p-3">
                <div class="col-sm-12">
                    <div class="">
                        <label for="name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Subject
                            Group
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Group Name">
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
        $(document).on('click', '.subject-group-sidebar-btn', function() {

            let $btn = $(this);

            // Text change
            if ($btn.hasClass('add')) {
                $('.dynamic-text').text('Add New');
                $('#subjectGroupForm')[0].reset();
                $('#group_id').val('');
            }

            if ($btn.hasClass('edit')) {
                $('.dynamic-text').text('Update');
            }

            $('.subject-group-sidebar').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            if (id) {
                $.ajax({
                    url: `{{ route('school.subject.group.get') }}`,
                    method: "GET",
                    data: {
                        id: id,
                    },
                    success: function(res) {
                        if (res.status) {
                            $('#name').val(res.data.name);
                            $('#group_id').val(res.data.id);
                        }
                    }
                });
            }

        });

        $(document).on('click', '.close-my-sidebar, .overlay', function() {
            $('.subject-group-sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });
    </script>
@endpush
