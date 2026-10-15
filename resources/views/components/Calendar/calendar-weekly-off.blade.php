{{-- ================================ CALENDAR WEEKLY OFF ADD/EDIT FORM MODAL ================================ --}}

<div class="modal fade" id="calendarWeeklyOffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="calendarWeeklyOffModalTitle">
                        Add Weekly Off Rule
                    </h6>
                    <small class="text-neutral-500 text-xs">Configure recurring weekend and off-day rules</small>
                </div>
                <div>
                    <x-model-close />
                </div>
            </div>

            <!-- Form -->
            <form id="calendarWeeklyOffForm" class="ajaxForm" data-url="{{ route('school.calendarWeeklyOff.save') }}"
                data-refresh="getCalendarWeeklyOffList" data-method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="calendar_weekly_off_id" value="">

                <div class="modal-body p-28">
                    <div class="form-segment mb-28">
                        <div class="row gy-4">

                            <!-- Day of Week -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Day Of Week <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-calendar-check-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-select custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_weekly_off_day" name="day_of_week" required>
                                            <option value="">Select Day</option>
                                            <option value="sunday">Sunday</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Applicable To -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Applicable To <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-user-shared-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-select custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_weekly_off_applicable_to" name="applicable_to" required>
                                            <option value="all">All (Students & Staff)</option>
                                            <option value="students">Students Only</option>
                                            <option value="teachers">Teachers Only</option>
                                            <option value="staff">Staff Only</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Off Type -->
                            <div class="col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Off Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-repeat-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <select class="form-select custom-premium-input ps-44 py-12 radius-8"
                                            id="calendar_weekly_off_type" name="off_type" required>
                                            <option value="weekly">Every Week (All Weeks)</option>
                                            <option value="alternate">Alternate / Specific Weeks</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Specific Weeks Selection (Show/Hide via JS) -->
                            <div class="col-md-12 d-none" id="weeksSelectionContainer">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Select Off Weeks <span class="text-danger">*</span>
                                </label>
                                <div
                                    class="d-flex flex-wrap gap-3 p-16 bg-neutral-50 radius-8 border border-neutral-200">
                                    @foreach ([1 => '1st Week', 2 => '2nd Week', 3 => '3rd Week', 4 => '4th Week', 5 => '5th Week'] as $num => $label)
                                        <div class="form-check me-3">
                                            <input class="form-check-input week-checkbox" type="checkbox" name="weeks[]"
                                                value="{{ $num }}" id="week_{{ $num }}">
                                            <label class="form-check-label text-xs fw-medium text-neutral-700"
                                                for="week_{{ $num }}">
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
                <div class="modal-footer border-0 p-24 d-flex justify-content-end align-items-center gap-3">

                    <!-- Status Toggle Switch -->
                    <div class="premium-input-box position-relative d-flex align-items-center gap-2 me-auto">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                            Status
                        </label>
                        <div class="form-check form-switch p-0 m-0">
                            <label class="switch mb-0">
                                <input type="checkbox" role="switch" id="calendar_weekly_off_is_active"
                                    name="is_active" value="1" checked class="module-active-toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <button type="button"
                        class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line"></i> Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                        <i class="ri-save-3-line"></i> Save Weekly Off
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function() {
            // Toggle Weeks Container based on Off Type
            function toggleWeeksContainer() {
                let type = $('#calendar_weekly_off_type').val();
                if (type === 'alternate' || type === 'custom') {
                    $('#weeksSelectionContainer').removeClass('d-none');
                } else {
                    $('#weeksSelectionContainer').addClass('d-none');
                    $('.week-checkbox').prop('checked', false);
                }
            }

            $('#calendar_weekly_off_type').on('change', toggleWeeksContainer);

            /* Reset Form When Modal Closes */
            $('#calendarWeeklyOffModal').on('hidden.bs.modal', function() {
                $('#calendarWeeklyOffForm')[0].reset();
                $('#calendar_weekly_off_id').val('');
                $('#calendarWeeklyOffModalTitle').text('Add Weekly Off Rule');
                $('#calendar_weekly_off_is_active').prop('checked', true);
                $('.week-checkbox').prop('checked', false);
                toggleWeeksContainer();
            });

            window.toggleWeeksContainer = toggleWeeksContainer;
        })();
    </script>
@endpush
