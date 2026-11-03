@extends('School.Layout.main')

@section('title', 'KTR ERP : Calendar Events Master')

@section('dynamic-content')
    <div class="dashboard-main-body py-24 px-16">

        <!-- Table Card Section -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <!-- Card Header -->
            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-calendar-event-fill text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Calendar Events</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage school calendar events, holidays, examinations, and
                            schedules.</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="CalendarEventDataTable" />
                    <x-model-open target="calendarEventModal" />
                </div>
            </div>

            <!-- Card Body / Data Table -->
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"id="CalendarEventDataTable"
                        data-page-length="10">
                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">Event
                                    Info</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">Type
                                </th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">Date
                                    & Time</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Applicable To</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Priority</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="calendarEventTableBody">
                            <!-- Dynamic Content Loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('Calendar.calendar-event')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Initial Fetching
            getCalendarEventList();

            // Handle Edit Event Click
            $(document).on("click", ".edit-calendar-event-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('school.calendarEvent.get', ':id') }}".replace(':id', id), id,
                    function(res) {
                        if (!res.status) return;
                        let row = res.data;

                        $("#calendar_event_id").val(row.id);
                        $("#calendar_event_type_id").val(row.event_type_id);
                        $("#calendar_event_title").val(row.title);
                        $("#calendar_event_slug").val(row.slug);
                        $("#calendar_event_start_date").val(row.start_date);
                        $("#calendar_event_end_date").val(row.end_date || '');
                        $("#calendar_event_start_time").val(row.start_time || '');
                        $("#calendar_event_end_time").val(row.end_time || '');
                        $("#calendar_event_applicable_to").val(row.applicable_to || 'all');
                        $("#calendar_event_priority").val(row.priority || 'normal');
                        $("#calendar_event_status").val(row.status || 'published');
                        $("#calendar_event_location").val(row.location || '');
                        $("#calendar_event_color").val(row.color || '#4F46E5');
                        $("#calendar_event_holiday_type").val(row.holiday_type || '');
                        $("#calendar_event_description").val(row.description || '');

                        $("#calendar_event_is_full_day").prop('checked', row.is_full_day == 1 || row
                            .is_full_day == true).trigger('change');
                        $("#calendar_event_is_holiday").prop('checked', row.is_holiday == 1 || row
                            .is_holiday == true);
                        $("#calendar_event_is_recurring").prop('checked', row.is_recurring == 1 || row
                            .is_recurring == true);

                        $('#calendarEventModalTitle').text('Edit Calendar Event');

                        $('#calendarEventModal').modal('show');
                    });
            });
        });

        // Fetch Event List Function
        function getCalendarEventList() {
            fetchMasterData("{{ route('school.calendarEvent.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        // Status Badge
                        let statusBadge = '';
                        if (row.status === 'published') {
                            statusBadge =
                                '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Published</span>';
                        } else if (row.status === 'draft') {
                            statusBadge =
                                '<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-10 py-4 radius-6 font-xxs">Draft</span>';
                        } else {
                            statusBadge =
                                '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Cancelled</span>';
                        }

                        // Priority Badge
                        let priorityClass = row.priority === 'critical' ?
                            'bg-danger-50 text-danger-700 border-danger-100' :
                            row.priority === 'high' ? 'bg-warning-50 text-warning-700 border-warning-100' :
                            'bg-info-50 text-info-700 border-info-100';

                        let priorityBadge =
                            `<span class="badge ${priorityClass} border px-8 py-4 radius-6 font-xxs text-capitalize">${row.priority}</span>`;

                        // Dates logic
                        let datesDisplay = formatDate(row.start_date, 'short');
                        if (row.end_date && row.end_date !== row.start_date) {
                            datesDisplay += ` to ${formatDate(row.end_date, 'short')}`;
                        }

                        let timeDisplay = (row.is_full_day == 1 || row.is_full_day == true) ?
                            '<span class="badge bg-neutral-100 text-neutral-600 border border-neutral-200 px-8 py-2 radius-4 font-xxs">Full Day</span>' :
                            `<span class="text-xs text-neutral-500"><i class="ri-time-line"></i> ${row.start_time || ''} - ${row.end_time || ''}</span>`;

                        let colorBox = row.color ?
                            `<span class="d-inline-block radius-circle me-1" style="width: 10px; height: 10px; background-color: ${row.color};"></span>` :
                            '';

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <div class="d-flex align-items-center gap-2">
                                        ${colorBox}
                                        <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.title}</h6>
                                    </div>
                                    ${row.location ? `<p class="text-xs text-neutral-400 mb-0"><i class="ri-map-pin-line"></i> ${row.location}</p>` : ''}
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-primary-50 text-primary-700 border border-primary-100 px-10 py-4 radius-6 font-xxs">${row.event_type ? row.event_type.name : '-'}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <div class="text-xs fw-semibold text-neutral-700">${datesDisplay}</div>
                                    <div>${timeDisplay}</div>
                                </td>

                                <td class="py-20 px-20">
                                    <span class="text-xs text-neutral-600 text-capitalize">${row.applicable_to || 'All'}</span>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${priorityBadge}
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-calendar-event-trigger"
                                            data-id="${row.id}">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-calendar-event-trigger"
                                            data-id="${row.id}">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                }

                if ($.fn.DataTable.isDataTable('#CalendarEventDataTable')) {
                    $('#CalendarEventDataTable')
                        .DataTable()
                        .destroy();
                }

                $("#calendarEventTableBody").html(html);

                $('#CalendarEventDataTable').DataTable({
                    pageLength: 10,
                    language: {
                        emptyTable: "No Records Found"
                    }
                });


            });
        }
    </script>
@endpush
