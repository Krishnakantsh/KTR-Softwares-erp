@extends('Frontend.Normal.Layout.main')


@section('title', 'KTR ERP : Class Master ')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light">Manage Subject </h1>
            </div>
            <button type="button" class="subject-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add role">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Subject
            </button>
        </div>
        <div class="mt-24">
            <div class="card h-100">

                <div class="card-body p-0 dataTable-wrapper">

                    <x-datatable--toolbar tableId="subjectDataTable" />

                    <div class="p-3">
                        <table class="table bordered-table mb-0 data-table" id="subjectDataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Group Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody id="subjectTableBody">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add sidebar start -->
    <div
        class="subject-sidebar bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">
        <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">
            <h5 class="text-lg mb-0 role_canvas_text"><span class="dynamic-text">Add New</span>Subject</h5>
            <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">
                <i class="ri-close-large-line"></i>
            </button>
        </div>
        <form id="subjectForm" class="ajaxForm" enctype="multipart/form-data" data-url="{{ route('school.subject.save') }}"
            data-refresh="getSubjectList" data-method="POST">
            @csrf
            <input type="hidden" name="subject_id" id="subject_id" value="" class="hidden">
            <div class="row g-3 p-3">
                @if (isset($subjectGroups)  && $subjectGroups->count() > 0 )

                    <div class="col-sm-12">
                        <div class="">
                            <label for="subject_group_id"
                                class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Subject
                                Group</label>
                            <select id="subject_group_id" name="subject_group_id" class="form-control form-select">
                           
                                    <option value="#" selected>--- Choose Subject Group --- </option>
                                    @foreach ($subjectGroups as $d)
                                        <option value="{{ $d->id }}">{{ $d->name ?? 'N/A' }}</option>
                                    @endforeach
                                
                            </select>
                        </div>
                    </div>
                @else
                    <div class="h-40-px d-flex align-items-center">
                        <a href="{{ route('school.subject.group.index') }}" class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1"
                            style="height: fit-content;">

                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px; flex-shrink: 0;">
                                {{-- <i class="ri-calendar-check-line text-primary-600 fw-semibold"></i> --}}
                                <i class="ri-arrow-left-line text-primary-600"></i>
                            </div>

                            <span class="pe-4 me-2">Add Subject Group</span>

                        </a>
                    </div>
                    <hr>


                @endif
                <div class="col-sm-12">
                    <div class="">
                        <label for="name" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Subject
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Subject Name">
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
        $(document).on('click', '.subject-sidebar-btn', function() {

            let $btn = $(this);

            // Text change
            if ($btn.hasClass('add')) {
                $('.dynamic-text').text('Add New');
                $('#subjectForm')[0].reset();
                $('#subject_id').val('');
            }

            if ($btn.hasClass('edit')) {
                $('.dynamic-text').text('Update');
            }

            $('.subject-sidebar').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            if (id) {
                $.ajax({
                    url: `{{ route('school.subject.get') }}`,
                    method: "GET",
                    data: {
                        id: id,
                    },
                    success: function(res) {
                        if (res.status) {
                            $('#name').val(res.data.name);
                            $('#subject_id').val(res.data.id);
                        }
                    }
                });
            }

        });

        $(document).on('click', '.close-my-sidebar, .overlay', function() {
            $('.subject-sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });
    </script>
@endpush
