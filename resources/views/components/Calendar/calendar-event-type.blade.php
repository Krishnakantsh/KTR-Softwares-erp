  {{-- ================================
        CALENDAR EVENT TYPE ADD/EDIT FORM MODAL
    ================================ --}}
  <div class="modal fade" id="calendarEventTypeModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

              <!-- Modal Header -->
              <div
                  class="modal-header border-bottom justify-content-between border-neutral-200 bg-neutral-50 px-24 py-16">
                  <div>
                      <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0" id="calendarEventTypeModalTitle">
                          Add Event Type
                      </h6>
                      <small class="text-neutral-500 text-xs">Create or update calendar event type details</small>
                  </div>
                  <div>
                      <x-model-close />
                  </div>
              </div>

              <!-- Form -->
              <form id="calendarEventTypeForm" class="ajaxForm" data-url="{{ route('school.calendarEventType.save') }}"
                  data-refresh="getCalendarEventTypeList" data-method="POST" autocomplete="off">
                  @csrf
                  <input type="hidden" name="id" id="calendar_event_type_id" value="">

                  <div class="modal-body p-28">
                      <div class="form-segment mb-28">
                          <div class="row gy-4">

                              <!-- Name -->
                              <div class="col-md-6">
                                  <div class="premium-input-box position-relative">
                                      <label
                                          class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                          Event Type Name <span class="text-danger">*</span>
                                      </label>
                                      <div class="inner-addon position-relative">
                                          <i
                                              class="ri-price-tag-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                          <input type="text"
                                              class="form-control custom-premium-input ps-44 py-12 radius-8"
                                              id="calendar_event_type_name" name="name"
                                              placeholder="e.g., Exam, Holiday, Meeting" maxlength="100" required>
                                      </div>
                                  </div>
                              </div>

                              <!-- Slug -->
                              <div class="col-md-6">
                                  <div class="premium-input-box position-relative">
                                      <label
                                          class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                          Slug <span class="text-danger">*</span>
                                      </label>
                                      <div class="inner-addon position-relative">
                                          <i
                                              class="ri-link text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                          <input type="text"
                                              class="form-control custom-premium-input ps-44 py-12 radius-8"
                                              id="calendar_event_type_slug" name="slug"
                                              placeholder="Auto-generated from name,
                                          editable."
                                              maxlength="100" required>
                                      </div>

                                  </div>
                              </div>

                              <!-- Color -->
                              <div class="col-md-6">
                                  <div class="premium-input-box position-relative">
                                      <label
                                          class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                          Color
                                      </label>
                                      <div class="inner-addon position-relative d-flex align-items-center gap-2">
                                          <i
                                              class="ri-palette-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                          <input type="color"
                                              class="form-control custom-premium-input ps-44 py-8 radius-8"
                                              id="calendar_event_type_color" name="color" value="#4F46E5"
                                              style="max-width: 100%; height: 46px;">
                                      </div>
                                  </div>
                              </div>

                              <!-- Icon -->
                              <div class="col-md-6">
                                  <div class="premium-input-box position-relative">
                                      <label
                                          class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                          Icon Class (RemixIcon)
                                      </label>
                                      <div class="inner-addon position-relative">
                                          <i
                                              class="ri-shapes-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                          <input type="text"
                                              class="form-control custom-premium-input ps-44 py-12 radius-8"
                                              id="calendar_event_type_icon" name="icon"
                                              placeholder="e.g., ri-calendar-event-line">
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
                                          <input type="text"
                                              class="form-control custom-premium-input ps-44 py-12 radius-8"
                                              id="calendar_event_type_description" name="description"
                                              placeholder="Enter short description...">
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>

                  <hr class="border-neutral-200 my-0">

                  <!-- Modal Footer -->
                  <div
                      class="modal-footer border-0 p-24 d-flex justify-content-end align-items-center gap-3 execution-control-bar">

                      <!-- Is Holiday Toggle -->
                      <div class="premium-input-box position-relative d-flex align-items-center gap-2 me-auto">
                          <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                              Is Holiday
                          </label>
                          <div class="form-check form-switch p-0 m-0">
                              <label class="switch mb-0">
                                  <input type="checkbox" role="switch" id="calendar_event_type_is_holiday"
                                      name="is_holiday" value="1">
                                  <span class="slider"></span>
                              </label>
                          </div>
                      </div>

                      <!-- Status Toggle Switch -->
                      <div class="premium-input-box position-relative d-flex align-items-center gap-2">
                          <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0 d-block">
                              Status
                          </label>
                          <div class="form-check form-switch p-0 m-0">
                              <label class="switch mb-0">
                                  <input type="checkbox" role="switch" id="calendar_event_type_is_active"
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
                          <i class="ri-save-3-line"></i> Save Event Type
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>


  @push('script')
      <script>
       
          (function() {
              let slugManuallyEdited = false;

              $('#calendar_event_type_slug').on('input', function() {
                  slugManuallyEdited = true;
              });

              $('#calendar_event_type_name').on('input', function() {
                  if (slugManuallyEdited) return;
                  const slug = $(this).val()
                      .toString()
                      .trim()
                      .toLowerCase()
                      .replace(/[^a-z0-9]+/g, '-')
                      .replace(/(^-|-$)/g, '');
                  $('#calendar_event_type_slug').val(slug);
              });

              /* Reset Form When Modal Closes */
              $('#calendarEventTypeModal').on('hidden.bs.modal', function() {
                  $('#calendarEventTypeForm')[0].reset();
                  $('#calendar_event_type_id').val('');
                  $('#calendarEventTypeModalTitle').text('Add Event Type');
                  $('#calendar_event_type_is_active').prop('checked', true);
                  $('#calendar_event_type_color').val('#4F46E5');
                  slugManuallyEdited = false;
              });
          })();
      </script>
  @endpush
