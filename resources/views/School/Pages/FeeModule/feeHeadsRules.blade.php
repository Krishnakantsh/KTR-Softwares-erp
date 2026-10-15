@extends('School.Layout.main')

@section('title', 'KTR ERP : Fee Head Applicability')

@section('dynamic-content')

    <style>
        /* Radio/Checkbox hide tracking context */
        .applicability-pill-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .applicability-pill {
            cursor: pointer;
            user-select: none;
        }

        /* Jab Checkbox Checked Hoga Tab Inka Design Badlega */
        .applicability-pill-input:checked+.pill-label {
            background-color: #ff8c00 !important;
            /* Premium Orange */
            border-color: #ff8c00 !important;
            color: #ffffff !important;
            box-shadow: 0px 2px 6px rgba(255, 140, 0, 0.3);
        }

        /* Soft transition for realistic feeling */
        .pill-label {
            transition: all 0.2s ease-in-out;
        }
    </style>

    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-shield-check-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Fee Head Applicability</h5>
                        <p class="text-xs text-neutral-500 mb-0">Select a fee head, then define who it applies to —
                            gender, student type and fee type.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">

                <!-- Step 1: Select Fee Head -->
                <div class="form-segment mb-28">
                    <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                        <span class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                        <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Select Fee Head</h6>
                    </div>

                    <div class="row gy-4">
                        <div class="col-xl-12 col-md-12">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Fee Head <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        id="applicability_fee_head_id">
                                        <option value="">Select Fee Head</option>
                                        @foreach ($feeHeads as $head)
                                            <option value="{{ $head->id }}">{{ $head->head_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Applicability Rules (hidden until a head is selected) -->
                <form id="feeHeadApplicabilityForm" class="d-none">
                    <input type="hidden" id="fee_head_id" name="fee_head_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Applicability
                                Rules</h6>
                        </div>

                        <div class="row gy-4">
                            {{-- @foreach ($keyOptions as $key => $meta)
                                <div class="col-xl-4 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-12 d-block">
                                            {{ $meta['label'] }}
                                        </label>
                                        <div class="d-flex flex-wrap gap-2 applicability-pill-group"
                                            data-field="{{ $key }}">
                                            @foreach ($meta['values'] as $value => $label)
                                                <label class="applicability-pill">
                                                    <input type="checkbox" name="{{ $key }}[]"
                                                        value="{{ $value }}" class="d-none applicability-pill-input">
                                                    <span
                                                        class="d-inline-flex align-items-center px-16 py-8 radius-8 border border-neutral-300 text-xs fw-semibold text-neutral-600 bg-neutral-50 pill-label">
                                                        {{ $label }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}

                            @foreach ($keyOptions as $key => $meta)
                                <div class="col-xl-4 col-md-6">
                                    <div class="premium-input-box position-relative">
                                        <label
                                            class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-12 d-block">
                                            {{ $meta['label'] }}
                                        </label>
                                        <div class="d-flex flex-wrap gap-2 applicability-pill-group"
                                            data-field="{{ $key }}">
                                            @foreach ($meta['values'] as $value => $label)
                                                <label class="applicability-pill position-relative">
                                                    <!-- Checkbox & Span Adjacent rakhen -->
                                                    <input type="checkbox" name="{{ $key }}[]"
                                                        value="{{ $value }}" class="applicability-pill-input">
                                                    <span
                                                        class="d-inline-flex align-items-center px-16 py-8 radius-8 border border-neutral-300 text-xs fw-semibold text-neutral-600 bg-neutral-50 pill-label">
                                                        {{ $label }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <div class="premium-input-box position-relative d-flex gap-4 me-8">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 d-block">
                                Status
                            </label>
                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch">
                                    <input type="checkbox" role="switch" id="applicability_status" name="status"
                                        value="1" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <button type="button" id="resetApplicabilityForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="button" id="saveApplicabilityBtn"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Rules
                        </button>
                    </div>
                </form>

                <div id="selectHeadHint" class="text-center py-40">
                    <div class="text-neutral-400 mb-2"><i class="ri-arrow-up-line text-3xl"></i></div>
                    <span class="text-sm fw-medium text-neutral-500">Select a fee head above to configure its
                        applicability rules.</span>
                </div>
            </div>
        </div>



    </div>


@endsection





@push('script')
    {{-- <script>
        $(document).ready(function() {


            toggleFormVisibility(false);

            // toggle pill active state on click
            $(document).on('click', '.applicability-pill', function() {
                let checkbox = $(this).find('.applicability-pill-input');
                checkbox.prop('checked', !checkbox.prop('checked'));
            });

    
            $('#applicability_fee_head_id').on('change', function() {

                let feeHeadId = $(this).val();

                resetPills();

                if (!feeHeadId) {
                    toggleFormVisibility(false);
                    return;
                }

                $('#fee_head_id').val(feeHeadId);

                toggleFormVisibility(true);

                $.ajax({
                    url: "{{ route('school.feeHeadApplicability.getByHead') }}",
                    type: "GET",
                    data: {
                        fee_head_id: feeHeadId
                    },
                    success: function(res) {

                        resetPills();

                        if (!res.status) {
                            return;
                        }

                        if (res.data.selected) {

                            Object.keys(res.data.selected).forEach(function(key) {

                                res.data.selected[key].forEach(function(value) {

                                    $(`input[name="${key}[]"][value="${value}"]`)
                                        .prop('checked', true);

                                });

                            });

                        }

                        $('#applicability_status').prop(
                            'checked',
                            res.data.row_status == 1
                        );

                    }
                });

            });

            $('#resetApplicabilityForm').on('click', resetPills);

            $('#saveApplicabilityBtn').on('click', function() {
                let feeHeadId = $('#fee_head_id').val();

                if (!feeHeadId) {
                    alert('Please select a fee head first.');
                    return;
                }

                let payload = {
                    _token: "{{ csrf_token() }}",
                    fee_head_id: feeHeadId,
                    status: $('#applicability_status').is(':checked') ? 1 : 0,
                    gender: getCheckedValues('gender'),
                    student_type: getCheckedValues('student_type'),
                    fee_type: getCheckedValues('fee_type'),
                };

                $.ajax({
                    url: "{{ route('school.feeHeadApplicability.save') }}",
                    type: "POST",
                    data: payload,
                    success: function(res) {
                        showToast(res.message, 'success');
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);

                    }
                });
            });

            function getCheckedValues(field) {
                let values = [];
                $(`input[name="${field}[]"]:checked`).each(function() {
                    values.push($(this).val());
                });
                return values;
            }

            function resetPills() {
                $('.applicability-pill-input').prop('checked', false);
                $('#applicability_status').prop('checked', true);
            }

            function toggleFormVisibility(show) {
                if (show) {
                    $('#feeHeadApplicabilityForm').removeClass('d-none');
                    $('#selectHeadHint').addClass('d-none');
                } else {
                    $('#feeHeadApplicabilityForm').addClass('d-none');
                    $('#selectHeadHint').removeClass('d-none');
                    $('#fee_head_id').val('');
                    resetPills();
                }
            }
        });
    </script> --}}

    <script>
        $(function() {

            toggleFormVisibility(false);

            $('#applicability_fee_head_id').on('change', function() {

                const feeHeadId = $(this).val();
                resetPills();

                if (!feeHeadId) {
                    toggleFormVisibility(false);
                    return;
                }

                $('#fee_head_id').val(feeHeadId);
                toggleFormVisibility(true);

                $.ajax({
                    url: "{{ route('school.feeHeadApplicability.getByHead') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        fee_head_id: feeHeadId
                    },
                    success: function(res) {

                        resetPills();

                        if (!res.status) {
                            return;
                        }

                        // Selected values check mark lagane ka logic
                        if (res.data && res.data.selected) {
                            $.each(res.data.selected, function(key, values) {
                                values.forEach(function(value) {
                                    $('input[name="' + key + '[]"][value="' +
                                            value + '"]')
                                        .prop('checked', true);
                                });
                            });
                        }

                        $('#applicability_status').prop(
                            'checked',
                            !!res.data.row_status
                        );
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            $('#resetApplicabilityForm').on('click', function() {
                resetPills();
            });

            $('#saveApplicabilityBtn').on('click', function() {

                const feeHeadId = $('#fee_head_id').val();

                if (!feeHeadId) {
                    showToast('Please select a fee head first.', 'error');
                    return;
                }

                $.ajax({
                    url: "{{ route('school.feeHeadApplicability.save') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        fee_head_id: feeHeadId,
                        status: $('#applicability_status').is(':checked') ? 1 : 0,
                        gender: getCheckedValues('gender'),
                        student_type: getCheckedValues('student_type'),
                        fee_type: getCheckedValues('fee_type')
                    },
                    success: function(res) {
                        showToast(res.message, 'success');
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            function getCheckedValues(field) {
                let values = [];
                $('input[name="' + field + '[]"]:checked').each(function() {
                    values.push($(this).val());
                });
                return values;
            }

            function resetPills() {
                $('.applicability-pill-input').prop('checked', false);
                $('#applicability_status').prop('checked', true);
            }

            function toggleFormVisibility(show) {
                if (show) {
                    $('#feeHeadApplicabilityForm').removeClass('d-none');
                    $('#selectHeadHint').addClass('d-none');
                } else {
                    $('#feeHeadApplicabilityForm').addClass('d-none');
                    $('#selectHeadHint').removeClass('d-none');
                    $('#fee_head_id').val('');
                    resetPills();
                }
            }
        });
    </script>
@endpush
