@extends('School.Layout.main')

@section('title', 'KTR ERP : Calendar Weekly Off Master')

@section('dynamic-content')
    <div class="dashboard-main-body py-24 px-16">

        <!-- Table Card Section -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <!-- Card Header -->
            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-calendar-check-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Calendar Weekly Offs</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure regular weekly off days and alternate weekend
                            rules.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="CalendarWeeklyOffDataTable" />
                    <x-model-open target="calendarWeeklyOffModal" />
                </div>
            </div>

            <!-- Card Body / Data Table -->
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"
                        id="CalendarWeeklyOffDataTable" data-page-length="10">

                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">Day
                                </th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Applies To</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">Off
                                    Type</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Specific Weeks</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="calendarWeeklyOffTableBody">
                            <!-- Dynamic Content Loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('Calendar.calendar-weekly-off')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Fetch List on Load
            getCalendarWeeklyOffList();

            // Handle Edit Click
            $(document).on("click", ".edit-calendar-weekly-off-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('school.calendarWeeklyOff.get', ':id') }}".replace(':id', id), id,
                    function(res) {
                        if (!res.status) return;
                        let row = res.data;

                        $("#calendar_weekly_off_id").val(row.id);
                        $("#calendar_weekly_off_day").val(row.day_of_week);
                        $("#calendar_weekly_off_applicable_to").val(row.applicable_to);
                        $("#calendar_weekly_off_type").val(row.off_type);

                        // Reset & Check Weeks Checkboxes
                        $('.week-checkbox').prop('checked', false);
                        if (row.weeks && Array.isArray(row.weeks)) {
                            $.each(row.weeks, function(i, val) {
                                $(`#week_${val}`).prop('checked', true);
                            });
                        }

                        // Toggle visibility
                        window.toggleWeeksContainer();

                        $("#calendar_weekly_off_is_active").prop('checked', row.is_active == 1 || row
                            .is_active == true);

                        $('#calendarWeeklyOffModalTitle').text('Edit Weekly Off Rule');
                        $('#calendarWeeklyOffModal').modal('show');
                    });
            });

            // Handle Delete Click
            $(document).on("click", ".delete-calendar-weekly-off-trigger", function() {
                let id = $(this).data("id");
                if (confirm("Are you sure you want to delete this weekly off rule?")) {
                    deleteMasterData("{{ route('school.calendarWeeklyOff.delete', ':id') }}".replace(':id',
                        id), function() {
                        getCalendarWeeklyOffList();
                    });
                }
            });
        });

        // Fetch List Function
        function getCalendarWeeklyOffList() {
            fetchMasterData("{{ route('school.calendarWeeklyOff.fetch') }}", function(res) {
                let html = '';

                if (res.status && res.data && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        let statusBadge = (row.is_active == 1 || row.is_active == true) ?
                            '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                            '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                        let dayFormatted = row.day_of_week.charAt(0).toUpperCase() + row.day_of_week.slice(
                            1);

                        let applicableBadge =
                            `<span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-8 py-4 radius-6 font-xxs text-capitalize">${row.applicable_to}</span>`;

                        let offTypeBadge = row.off_type === 'weekly' ?
                            '<span class="badge bg-primary-50 text-primary-700 border border-primary-100 px-8 py-4 radius-6 font-xxs">Every Week</span>' :
                            '<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-8 py-4 radius-6 font-xxs">Specific Weeks</span>';

                        let weeksText = '-';
                        if (row.weeks && Array.isArray(row.weeks) && row.weeks.length > 0) {
                            weeksText = row.weeks.map(w => w + (w == 1 ? 'st' : w == 2 ? 'nd' : w == 3 ?
                                'rd' : 'th')).join(', ') + ' Week';
                        } else if (row.off_type === 'weekly') {
                            weeksText = 'All Weeks';
                        }

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <h6 class="text-sm fw-bold mb-0 text-neutral-800">${dayFormatted}</h6>
                                </td>

                                <td class="py-20 px-20">
                                    ${applicableBadge}
                                </td>

                                <td class="py-20 px-20">
                                    ${offTypeBadge}
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600 fw-medium">${weeksText}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-calendar-weekly-off-trigger"
                                            data-id="${row.id}">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-calendar-weekly-off-trigger"
                                            data-id="${row.id}">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                }
                if ($.fn.DataTable.isDataTable('#CalendarWeeklyOffDataTable')) {
                    $('#CalendarWeeklyOffDataTable')
                        .DataTable()
                        .destroy();
                }
                $("#calendarWeeklyOffTableBody").html(html);

                $('#CalendarEventTypeDataTable').DataTable({
                    pageLength: 10,
                    language: {
                        emptyTable: "No Records Found"
                    }
                });


            });
        }
    </script>
@endpush
