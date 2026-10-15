@extends('School.Layout.main')

@section('title', 'KTR ERP : Fee Head Master')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-price-tag-2-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Fee Head Master</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage fee heads under each fee group (e.g., Tuition,
                            Transport, Library).</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="toggleFeeHeadForm"
                        class="btn btn-sm border border-dashed-custom bg-slate-50 text-neutral-600 hover-bg-neutral-100 px-16 py-8 radius-8 fw-semibold d-flex align-items-center gap-2 text-xs">
                        <i class="ri-add-line text-primary-600"></i> Add Fee Head
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-premium-table mb-0 vertical-middle">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Head Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Fee Group</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Code</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Order</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="feeHeadTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="feeHeadFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card d-none">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-price-tag-2-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Create Fee Head</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select fee group and configure head name, code and
                            order.</p>
                    </div>
                </div>
                <x-close-btn id="closeFeeHeadForm" />

            </div>

            <div class="card-body p-28">
                <form id="feeHeadForm" class="ajaxForm" data-url="{{ route('school.feeHead.save') }}"
                    data-refresh="fetchFeeHeads" data-method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="fee_head_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Fee Head Details
                            </h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Fee Group <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-folder-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="fee_group_id" name="fee_group_id" required>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Head Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="head_name" name="head_name" placeholder="e.g., Tuition Fee" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Head Code
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="head_code" name="head_code" placeholder="e.g., TUI">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Display Order
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-sort-asc text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="number" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="display_order" name="display_order" placeholder="0" value="0"
                                            min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Description
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="description" name="description" placeholder="e.g., TUI">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <div class="premium-input-box position-relative d-flex gap-4 me-8">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600  d-block">
                                Status
                            </label>

                            <div class="form-check form-switch p-0 m-0">

                                <label class="switch">
                                    <input type="checkbox" role="switch" id="status" name="status" value="1"
                                        for="status" class="module-active-toggle">
                                    <span class="slider"></span>
                                </label>
                            </div>

                        </div>
                        <button type="button" id="resetFeeHeadForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Fee Head
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            fetchFeeHeads();
            fetchFeeGroups();

            $('#toggleFeeHeadForm').on('click', function() {
                $('#feeHeadFormCard').toggleClass('d-none');
                let opened = !$('#feeHeadFormCard').hasClass('d-none');
                $(this).html(opened ?
                    '<i class="ri-close-line"></i> Close Form' :
                    '<i class="ri-add-line text-primary-600"></i> Add Fee Head');
                if (opened) {
                    $('html,body').animate({
                        scrollTop: $('#feeHeadFormCard').offset().top - 20
                    }, 500);
                }
            });

            $('#closeFeeHeadForm').on('click', function() {
                $('#feeHeadFormCard').addClass('d-none');
                $('#toggleFeeHeadForm').html('<i class="ri-add-line text-primary-600"></i> Add Fee Head');
                resetFeeHeadForm();
            });

            $('#resetFeeHeadForm').on('click', resetFeeHeadForm);

            function resetFeeHeadForm() {
                $('#feeHeadForm')[0].reset();
                $('#fee_head_id').val('');
                $('#status').prop('checked', true);
            }

            $(document).on("click", ".edit-fee-head-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('school.feeHead.get', ':id') }}".replace(':id', id), id,
                    function(res) {
                        if (!res.status) return;
                        let row = res.data;

                        $("#fee_head_id").val(row.id);
                        $("#fee_group_id").val(row.fee_group_id);
                        $("#head_name").val(row.head_name);
                        $("#head_code").val(row.head_code);
                        $("#display_order").val(row.display_order);
                        $("#description").val(row.description);
                        $("#status").prop('checked', row.status == 1);

                        $('#feeHeadFormCard').removeClass('d-none');
                        $('#toggleFeeHeadForm').html('<i class="ri-close-line"></i> Close Form');

                        $("html, body").animate({
                            scrollTop: $('#feeHeadFormCard').offset().top - 20
                        }, 300);
                    });
            });


        });

        function fetchFeeHeads() {
            fetchMasterData("{{ route('school.feeHead.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        let statusBadge = row.status == 1 ?
                            '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                            '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.head_name}</h6>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600">${row.group ? row.group.group_name : '-'}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-info-50 text-info-700 border border-info-100 px-8 py-4 radius-6 font-xxs">${row.head_code ?? '-'}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-8 py-4 radius-6 font-xxs">${row.display_order}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-fee-head-trigger"
                                            data-id="${row.id}" >
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-fee-head-trigger"
                                            data-id="${row.id}" >
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                } else {
                    html = `
                        <tr>
                            <td colspan="6" class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No fee heads found.</span>
                            </td>
                        </tr>`;
                }

                $("#feeHeadTableBody").html(html);

                var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el);
                });
            });
        }

        function fetchFeeGroups() {
            fetchMasterData("{{ route('school.feeGroup.fetch') }}", function(res) {
                let html = '';

                console.log("Fee Group : ", res);

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {
                        html += `
                            <option value="${row.id }"> ${row.group_name }</option>
                        `;
                    });
                } else {
                    html = `
                      
                         <option value="">No fee group found.</option>
                        
                        `;
                }

                $("#fee_group_id").html(html);

            });
        }
    </script>
@endpush
