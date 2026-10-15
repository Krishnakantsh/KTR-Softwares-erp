@extends('School.Layout.main')

@section('title', 'KTR ERP : Session Settings')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">

        <!-- SESSION SETTINGS FORM CARD -->
        <div id="sessionSettingFormCard"
            class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-calendar-event-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Academic Session Settings</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure academic session dates, start month, and receipt
                            numbering.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="sessionSettingForm" class="ajaxForm" data-url="{{ route('school.sessionSetupForSchool') }}"
                    data-refresh="fetchSchoolSetting" data-method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="session_setting_id" value="">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Session Details</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Start Month <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-calendar-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="start_month" name="start_month">
                                            <option value="">Select Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Session Start <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-calendar-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="date" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="session_start" name="session_start">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Session End <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-calendar-check-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="date" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="session_end" name="session_end">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Starting Receipt No.
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-hashtag text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="starting_recept_no" name="starting_recept_no"
                                            placeholder="e.g., 2026-00001">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="button" id="resetSessionSettingForm"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Session Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SESSION MONTHS DRAGGABLE TABLE SECTION -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card">
            <div class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-drag-drop-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Session Months Order</h5>
                        <p class="text-xs text-neutral-500 mb-0">Drag and drop rows using the handle icon to reorder session
                            months.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="bg-neutral-50 border-bottom border-neutral-200 text-neutral-600">
                                <th class="py-16 px-20 text-center" style="width: 100px;"><i
                                        class="ri-drag-move-2-line"></i>
                                </th>
                                <th class="py-16 px-20">Month Name</th>
                                <th class="py-16 px-20 text-center">Sort Order</th>
                            </tr>
                        </thead>
                        <tbody id="sessionMonthsTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            fetchSessionMonths();
            fetchSchoolSetting();

            $('#resetSessionSettingForm').on('click', function() {
                fetchSchoolSetting(); // Re-fill original values on reset
            });

            $("#sessionMonthsTableBody").sortable({
                handle: ".drag-handle",
                cursor: "move",
                opacity: 0.7,
                update: function(event, ui) {
                    let order = [];
                    $("#sessionMonthsTableBody tr").each(function(index) {
                        order.push({
                            id: $(this).data("id"),
                            sort_order: index + 1
                        });
                    });

                    $.ajax({
                        url: "{{ route('school.sessionMonth.reorder') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            order: order
                        },
                        success: function(response) {
                            if (response.status) {
                                fetchSessionMonths();
                            }
                        }
                    });
                }
            });

        });

        function fetchSessionMonths() {
            fetchMasterData("{{ route('school.transport_month.fetch') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {
                        html += `
                            <tr data-id="${row.id}" class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-20 text-center cursor-grab drag-handle">
                                    <i class="ri-drag-move-2-line text-lg text-neutral-400"></i>
                                </td>
                                <td class="py-20 px-20">
                                    <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.month_name}</h6>
                                </td>
                                <td class="py-20 px-20 text-center">
                                    <span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-8 py-4 radius-6 font-xxs sort-order-val">${row.sort_order}</span>
                                </td>
                            </tr>`;
                    });
                } else {
                    html = `
                        <tr>
                            <td colspan="3" class="py-40 text-center">
                                <div class="text-neutral-400 mb-2"><i class="ri-database-line text-3xl"></i></div>
                                <span class="text-sm fw-medium text-neutral-500">No session months found.</span>
                            </td>
                        </tr>`;
                }

                $("#sessionMonthsTableBody").html(html);
            });
        }

        function fetchSchoolSetting() {
            fetchMasterData("{{ route('school.get') }}", function(res) {
                if (res.status && res.data) {
                    let data = res.data;

                    $('#session_setting_id').val(data.id ?? '');
                    $('#start_month').val(data.start_month ?? '');
                    $('#session_start').val(data.session_start ?? '');
                    $('#session_end').val(data.session_end ?? '');
                    $('#starting_recept_no').val(data.starting_recept_no ?? '');
                }
            });
        }
    </script>
@endpush
