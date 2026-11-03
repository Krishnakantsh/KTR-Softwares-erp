<div class="modal fade" id="calendarEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="calendarEventModalTitle">
                        Add Calendar Event
                    </h6>
                    <small class="text-neutral-500 text-xs">Create or update calendar event details</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="calendarEventForm" class="ajaxForm" data-url="{{ route('school.calendarEvent.save') }}"
                data-refresh="getCalendarEventList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="calendar_event_id" value="">

                <div class="modal-body p-28">
                    <div class="form-segment mb-20">
                        <div class="row gy-4">

                            <!-- Event Type -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Event Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_type_id" name="event_type_id" required>
                                            <option value="">Select Event Type</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Event Title <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-text text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_title" name="title"
                                            placeholder="e.g., Annual Sports Day" maxlength="255" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Slug
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-link text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_slug" name="slug"
                                            placeholder="Auto-generated from title" maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-6 col-lg-3">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Start Date <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-calendar-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="date"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_start_date" name="start_date" required>
                                    </div>
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6 col-lg-3">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        End Date
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-calendar-event-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="date"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_end_date" name="end_date">
                                    </div>
                                </div>
                            </div>

                            <!-- Start Time -->
                            <div class="col-md-6 col-lg-3 time-field">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Start Time
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-time-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="time"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_start_time" name="start_time">
                                    </div>
                                </div>
                            </div>

                            <!-- End Time -->
                            <div class="col-md-6 col-lg-3 time-field">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        End Time
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-time-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="time"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_end_time" name="end_time">
                                    </div>
                                </div>
                            </div>

                            <!-- Applicable To -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Applicable To
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-group-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_applicable_to" name="applicable_to">
                                            <option value="all">All</option>
                                            <option value="students">Students</option>
                                            <option value="staff">Staff</option>
                                            <option value="teachers">Teachers</option>
                                            <option value="parents">Parents</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Priority
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-flag-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_priority" name="priority">
                                            <option value="low">Low</option>
                                            <option value="normal" selected>Normal</option>
                                            <option value="high">High</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Status
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-checkbox-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_status" name="status">
                                            <option value="published" selected>Published</option>
                                            <option value="draft">Draft</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Location
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-map-pin-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_location" name="location"
                                            placeholder="e.g., School Auditorium">
                                    </div>
                                </div>
                            </div>

                            <!-- Color -->
                            <div class="col-md-6 col-lg-4">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Badge Color
                                    </label>
                                    <div class="inner-addon position-relative d-flex align-items-center gap-2">
                                        <i
                                            class="ri-palette-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="color"
                                            class="form-control custom-premium-input ps-44 py-8 radius-8"
                                            id="calendar_event_color" name="color" value="#4F46E5"
                                            style="max-width: 100%; height: 46px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Holiday Type -->
                            <div class="col-md-6 col-lg-4" id="holiday_type_wrapper">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Holiday Type
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-goblet-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_event_holiday_type" name="holiday_type">
                                            <option value="">Select Holiday Type</option>
                                            <option value="national">National</option>
                                            <option value="state">State</option>
                                            <option value="school">School</option>
                                            <option value="restricted">Restricted</option>
                                            <option value="vacation">Vacation</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Description
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-file-text-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <textarea class="form-control custom-premium-input ps-44 py-12 radius-8" id="calendar_event_description"
                                            name="description" rows="2" placeholder="Enter event details or instructions..."></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ================================
                        RECURRENCE SETTINGS SECTION
                    ================================ -->
                    <div id="recurrence_section"
                        class="border border-neutral-200 bg-neutral-50 radius-12 p-20 d-none">
                        <h6 class="text-sm fw-bold text-neutral-800 mb-16 d-flex align-items-center gap-2">
                            <i class="ri-repeat-2-line text-primary-600"></i> Recurrence Pattern Settings
                        </h6>

                        <div class="row gy-3">
                            <!-- Frequency -->
                            <div class="col-md-6 col-lg-3">
                                <label class="text-xs fw-semibold text-neutral-600 mb-6 d-block">Frequency</label>
                                <select class="form-control custom-premium-input radius-8" id="rec_frequency"
                                    name="frequency">
                                    <option value="daily">Daily</option>
                                    <option value="weekly" selected>Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>

                            <!-- Interval -->
                            <div class="col-md-6 col-lg-3">
                                <label class="text-xs fw-semibold text-neutral-600 mb-6 d-block">Interval (e.g. every 2
                                    weeks)</label>
                                <input type="number" min="1"
                                    class="form-control custom-premium-input radius-8" id="rec_interval"
                                    name="interval" value="1" placeholder="1">
                            </div>

                            <!-- Recurrence Ends On -->
                            <div class="col-md-6 col-lg-3">
                                <label class="text-xs fw-semibold text-neutral-600 mb-6 d-block">Repeat Until
                                    Date</label>
                                <input type="date" class="form-control custom-premium-input radius-8"
                                    id="rec_ends_on" name="ends_on">
                            </div>

                            <!-- Occurrences Count -->
                            <div class="col-md-6 col-lg-3">
                                <label class="text-xs fw-semibold text-neutral-600 mb-6 d-block">Max
                                    Occurrences</label>
                                <input type="number" min="1"
                                    class="form-control custom-premium-input radius-8" id="rec_occurrences"
                                    name="occurrences" placeholder="e.g. 10">
                            </div>

                            <!-- Days of Week (Weekly only) -->
                            <div class="col-12" id="weekly_days_wrapper">
                                <label class="text-xs fw-semibold text-neutral-600 mb-6 d-block">Repeat On Days</label>
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    @foreach (['monday' => 'Mon', 'tuesday' => 'Tue', 'wednesday' => 'Wed', 'thursday' => 'Thu', 'friday' => 'Fri', 'saturday' => 'Sat', 'sunday' => 'Sun'] as $val => $label)
                                        <div class="form-check me-2">
                                            <input class="form-check-input rec-day-checkbox" type="checkbox"
                                                name="days_of_week[]" value="{{ $val }}"
                                                id="day_{{ $val }}">
                                            <label class="form-check-label text-xs fw-medium text-neutral-700"
                                                for="day_{{ $val }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="border-neutral-200 my-0">

                <!-- Modal Footer -->
                <div
                    class="modal-footer border-0 p-24 d-flex justify-content-between align-items-center flex-wrap gap-3 execution-control-bar">

                    <!-- Toggles Group -->
                    <div class="d-flex align-items-center gap-4 flex-wrap me-auto">
                        <!-- Full Day Toggle -->
                        <div class="premium-input-box position-relative d-flex align-items-center gap-2">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                                Full Day
                            </label>
                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch mb-0">
                                    <input type="checkbox" role="switch" id="calendar_event_is_full_day"
                                        name="is_full_day" value="1" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <!-- Is Holiday Toggle -->
                        <div class="premium-input-box position-relative d-flex align-items-center gap-2">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                                Is Holiday
                            </label>
                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch mb-0">
                                    <input type="checkbox" role="switch" id="calendar_event_is_holiday"
                                        name="is_holiday" value="1">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <!-- Is Recurring Toggle -->
                        <div class="premium-input-box position-relative d-flex align-items-center gap-2">
                            <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                                Recurring
                            </label>
                            <div class="form-check form-switch p-0 m-0">
                                <label class="switch mb-0">
                                    <input type="checkbox" role="switch" id="calendar_event_is_recurring"
                                        name="is_recurring" value="1">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="button"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2"
                            data-bs-dismiss="modal">
                            <i class="ri-close-line"></i> Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-save-3-line"></i> Save Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            fetchCalendarEventTypes();

            let eventSlugManuallyEdited = false;

            $('#calendar_event_slug').on('input', function() {
                eventSlugManuallyEdited = true;
            });

            $('#calendar_event_title').on('input', function() {
                if (eventSlugManuallyEdited) return;
                const slug = $(this).val()
                    .toString()
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                $('#calendar_event_slug').val(slug);
            });

            /* Full Day toggle behavior */
            $('#calendar_event_is_full_day').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.time-field').addClass('d-none');
                    $('#calendar_event_start_time, #calendar_event_end_time').val('');
                } else {
                    $('.time-field').removeClass('d-none');
                }
            });

            /* Recurring Toggle Toggle behavior */
            $('#calendar_event_is_recurring').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#recurrence_section').removeClass('d-none');
                } else {
                    $('#recurrence_section').addClass('d-none');
                }
            });

            /* Frequency change behavior */
            $('#rec_frequency').on('change', function() {
                if ($(this).val() === 'weekly') {
                    $('#weekly_days_wrapper').removeClass('d-none');
                } else {
                    $('#weekly_days_wrapper').addClass('d-none');
                }
            });

            /* Reset Form When Modal Closes */
            $('#calendarEventModal').on('hidden.bs.modal', function() {
                $('#calendarEventForm')[0].reset();
                $('#calendar_event_id').val('');
                $('#calendarEventModalTitle').text('Add Calendar Event');
                $('#calendar_event_is_full_day').prop('checked', true).trigger('change');
                $('#calendar_event_is_holiday').prop('checked', false);
                $('#calendar_event_is_recurring').prop('checked', false).trigger('change');
                $('#calendar_event_color').val('#4F46E5');
                $('#calendar_event_priority').val('normal');
                $('#calendar_event_status').val('published');
                $('#calendar_event_applicable_to').val('all');
                $('.rec-day-checkbox').prop('checked', false);
                eventSlugManuallyEdited = false;
            });
        });
    </script>
@endpush
