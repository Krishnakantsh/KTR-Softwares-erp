@extends('School.Layout.main')


@section('title', 'KTR ERP : Class Master ')

@section('dynamic-content')



    <div class="dashboard-main-body">

        <div class="mt-24">
            <div class="card h-100">

                <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">

                    <h6 class="text-xl fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Subject Link</h6>
                    <div class="d-flex gap-3 align-items-center">
                        <x-datatable--toolbar tableId="ClassLinkDataTable" />
                        <button type="button"
                            class="subject_link-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 add role">
                            <span class="d-flex text-md">
                                <i class="ri-add-large-line"></i>
                            </span>
                            Link Subject With
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 dataTable-wrapper">

                    <div class="p-3">
                        <table class="table bordered-table mb-0 data-table" id="ClassLinkDataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Class Name</th>
                                    <th scope="col">No. Of Subjects</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody id="classLinkTableBody">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="subject-link-sidebar bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">

        <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">
            <h5 class="text-lg mb-0 role_canvas_text"><span class="dynamic-text">Add</span> Subject Link</h5>
            <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">
                <i class="ri-close-large-line"></i>
            </button>
        </div>
        <div class="px-20 py-12 border-bottom d-none w-100" id="subjectSelectLinkCount">
            <div class="alert alert-primary mb-0">
                Selected Subjects :
                <strong id="selectedSubjectCount">0</strong>
            </div>
        </div>
        <form id="subjectLinkForm" class="ajaxForm" enctype="multipart/form-data"
            data-url="{{ route('school.subject.link.save') }}" data-refresh="getSubjectLinkList" data-method="POST">
            @csrf
            <div class="row g-3 p-3">
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
                <hr>
                @if (isset($classes) && $classes->count() > 0)
                    <div class="col-sm-12">
                        <div class="">
                            <label for="class_id" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Select
                                Class</label>
                            <select id="class_id" name="class_id" class="form-control form-select subject_link_class">

                                <option value="#" selected>--- Choose Class --- </option>

                                @foreach ($classes as $d)
                                    <option value="{{ $d->id }}">{{ $d->name ?? 'N/A' }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                @endif
                <div class="col-sm-12">
                    <div id="subjectGroupContainer" class="g-4"></div>
                </div>
            </div>
        </form>
    </div>
    <!-- Add sidebar end -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            getSubjectLinkList();

        });


        $(document).on('change', '.subject-checkbox', function() {

            let total = $('.subject-checkbox:checked').length;

            $('#selectedSubjectCount').text(total);

        });


        $(document).on('click', '.subject_link-sidebar-btn', function() {

            let $btn = $(this);

            // Text change
            if ($btn.hasClass('add')) {
                $('.dynamic-text').text('Add ');
                $('#subjectLinkForm')[0].reset();
                $('#class_id').val('');
            }

            if ($btn.hasClass('edit')) {
                $('.dynamic-text').text('Update');
            }

            $('.subject-link-sidebar').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            if (id) {
                $.ajax({
                    url: `{{ route('school.subject.link.get') }}`,
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
            $('.subject-link-sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });


        window.getSubjectLinkList = function() {
            $.ajax({

                url: "{{ route('school.subject.link.fetch.with') }}",
                method: "GET",

                success: function(res) {
                    let html = '';
                    $.each(res.data, function(index, d) {
                        html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${d.class?.name}</td>
                        <td>
                            <div class="h-40-px d-flex align-items-center">
                            <small
                                class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-2 px-2 py-1"
                                style="height: fit-content;">

                                <div class="bg-white text-primary-600 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; flex-shrink: 0;">
                                      ${d.total_subjects  || '0'}
                                </div>
                            </small>
                        </td>

                          <td>
                                <button type="button" data-id="${d.class_id}" class="subject_link-sidebar-btn edit role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>
                                </button>
                                <button type="button" data-id="${d.class_id}" class="deleteSubjectLink">
                                    <i class="ri-delete-bin-fill custom-btn-red"></i>
                                </button>
                            </td>
                    </tr>
                `;
                    });


                    if ($.fn.DataTable.isDataTable('#ClassLinkDataTable')) {

                        $('#ClassLinkDataTable')
                            .DataTable()
                            .destroy();
                    }

                       $('#classLinkTableBody').html(html);

                    $('#ClassLinkDataTable').DataTable({
                        pageLength: 10
                    });


               
                }
            });
        };
    </script>
@endpush
