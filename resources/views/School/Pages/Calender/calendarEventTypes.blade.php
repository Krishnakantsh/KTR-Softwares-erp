@extends('School.Layout.main')

@section('title', 'KTR ERP : Calendar Event Type Master')

@section('dynamic-content')
    <div class="dashboard-main-body py-24 px-16">

        <!-- Table Card Section -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <!-- Card Header -->
            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex flex-wrap gap-3 justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 px-10 radius-10 border border-primary-100">
                        <i class="ri-calendar-event-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Calendar Event Types</h5>
                        <p class="text-xs text-neutral-500 mb-0">Manage event categories for school calendar (e.g., Exam,
                            Holiday, Meeting).</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="CalendarEventTypeDataTable" />
                    <x-model-open target="calendarEventTypeModal" />
                </div>
            </div>

            <!-- Card Body / Data Table -->
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table
                        class="table bordered-table mb-0 data-table text-sm vertical-middle"id="CalendarEventTypeDataTable"
                        data-page-length="10">

                        <thead class="bg-neutral-50 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28">
                                    Name
                                </th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Slug
                                </th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20">
                                    Color
                                    & Icon</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Is Holiday</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-20 text-center">
                                    Status</th>
                                <th
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-16 px-28 text-end">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="calendarEventTypeTableBody">
                            <!-- Dynamic Content Loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    @include('Calendar/calendar-event-type')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Fetch List on Load
            getCalendarEventTypeList();

            // Handle Edit Click
            $(document).on("click", ".edit-calendar-event-type-trigger", function() {
                let id = $(this).data("id");

                getDataById("{{ route('school.calendarEventType.get', ':id') }}".replace(':id', id), id,
                    function(res) {
                        if (!res.status) return;
                        let row = res.data;

                        $("#calendar_event_type_id").val(row.id);
                        $("#calendar_event_type_name").val(row.name);
                        $("#calendar_event_type_slug").val(row.slug);
                        $("#calendar_event_type_color").val(row.color || '#4F46E5');
                        $("#calendar_event_type_icon").val(row.icon || '');
                        $("#calendar_event_type_description").val(row.description || '');

                        $("#calendar_event_type_is_holiday").prop('checked', row.is_holiday == 1 || row
                            .is_holiday == true);
                        $("#calendar_event_type_is_active").prop('checked', row.is_active == 1 || row
                            .is_active == true);

                        $('#calendarEventTypeModalTitle').text('Edit Event Type');
                        slugManuallyEdited = true;

                        $('#calendarEventTypeModal').modal('show');
                    });
            });
        });

        // Fetch List Function
        function getCalendarEventTypeList() {
            fetchMasterData("{{ route('school.calendarEventType.fetch') }}", function(res) {
                let html = '';

                if (res.status && res.data && res.data.length > 0) {
                    $.each(res.data, function(index, row) {

                        let statusBadge = (row.is_active == 1 || row.is_active == true) ?
                            '<span class="badge bg-success-50 text-success-700 border border-success-100 px-10 py-4 radius-6 font-xxs">Active</span>' :
                            '<span class="badge bg-danger-50 text-danger-700 border border-danger-100 px-10 py-4 radius-6 font-xxs">Inactive</span>';

                        let holidayBadge = (row.is_holiday == 1 || row.is_holiday == true) ?
                            '<span class="badge bg-warning-50 text-warning-700 border border-warning-100 px-10 py-4 radius-6 font-xxs">Yes</span>' :
                            '<span class="badge bg-neutral-100 text-neutral-600 border border-neutral-200 px-10 py-4 radius-6 font-xxs">No</span>';

                        let colorBox = row.color ?
                            `<span class="d-inline-block radius-4 me-1" style="width: 14px; height: 14px; background-color: ${row.color}; vertical-align: middle;"></span>` :
                            '';

                        let iconClass = row.icon ? `<i class="${row.icon} text-lg me-1"></i>` : '';

                        html += `
                            <tr class="border-bottom border-neutral-100 hover-bg-neutral-50/50 transition-all">
                                <td class="py-20 px-28">
                                    <h6 class="text-sm fw-bold mb-0 text-neutral-800">${row.name}</h6>
                                    ${row.description ? `<p class="text-xs text-neutral-400 mb-0">${row.description}</p>` : ''}
                                </td>

                                <td class="py-20 px-20">
                                    <span class="badge bg-neutral-100 text-neutral-700 border border-neutral-200 px-8 py-4 radius-6 font-xxs">${row.slug}</span>
                                </td>

                                <td class="py-20 px-20">
                                    <div class="d-flex align-items-center gap-2">
                                        ${colorBox}
                                        ${iconClass}
                                        <span class="text-xs text-neutral-600">${row.color || '-'}</span>
                                    </div>
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${holidayBadge}
                                </td>

                                <td class="py-20 px-20 text-center">
                                    ${statusBadge}
                                </td>

                                <td class="py-20 px-28 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class="btn btn-icon bg-info-50 hover-bg-info-100 border border-info-200 text-info-700 p-6 px-10 radius-8 transition-all edit-calendar-event-type-trigger"
                                            data-id="${row.id}">
                                            <i class="ri-edit-line text-lg"></i>
                                        </button>

                                        <button type="button" class="btn btn-icon bg-danger-50 hover-bg-danger-100 border border-danger-200 text-danger-700 p-6 px-10 radius-8 transition-all delete-calendar-event-type-trigger"
                                            data-id="${row.id}">
                                            <i class="ri-delete-bin-6-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });
                }




                if ($.fn.DataTable.isDataTable('#CalendarEventTypeDataTable')) {
                    $('#CalendarEventTypeDataTable')
                        .DataTable()
                        .destroy();
                }
                $("#calendarEventTypeTableBody").html(html);

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
