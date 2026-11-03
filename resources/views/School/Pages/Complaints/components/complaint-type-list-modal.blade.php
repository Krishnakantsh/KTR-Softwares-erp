{{-- ================================
    COMPLAINT TYPE LIST MODAL
================================ --}}
<div class="modal fade" id="complaintTypeListModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 radius-12 overflow-hidden shadow-lg">

            <!-- Modal Header -->
            <div
                class="modal-header d-flex justify-content-between border-bottom border-neutral-200 bg-neutral-50 px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-neutral-800 text-md mb-0">
                        Complaint Types List
                    </h6>
                    <small class="text-neutral-500 text-xs">View and manage all registered complaint types</small>
                </div>
                <div>

                    <x-model-open target="complaintTypeModal" />

                    <x-model-close />
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-24">
                <!-- Action Header -->
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-0">
                        All Records
                    </h6>
                    
                </div>

                <!-- Table Container -->
                <div class="table-responsive border border-neutral-200 radius-8">
                    <table class="table align-middle mb-0">
                        <thead class="bg-neutral-100 border-bottom border-neutral-200">
                            <tr>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">#
                                </th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Type Name</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    For</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Priority</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16">
                                    Status</th>
                                <th class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 py-12 px-16 text-end"
                                    width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="complaintTypeTableBody" class="divide-y divide-neutral-200">
                            <!-- Dynamic Rows -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-top border-neutral-200 bg-neutral-50 px-24 py-14 justify-content-end">
                <button type="button"
                    class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-20 py-10 radius-8 fw-semibold text-xs transition-all"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        /* Fetch List Function */
        window.getComplaintTypeList = function() {
            $.ajax({
                url: "{{ route('school.complaintType.fetch') }}",
                method: "GET",
                success: function(res) {
                    let rows = '';

                    if (res.data && res.data.length > 0) {
                        $.each(res.data, function(index, d) {
                            let complaintForMap = {
                                1: '<span class="badge bg-neutral-200 text-neutral-800 text-xs px-10 py-4 radius-4 fw-semibold">Admin</span>',
                                2: '<span class="badge bg-warning-100 text-warning-700 text-xs px-10 py-4 radius-4 fw-semibold">Staff</span>',
                                3: '<span class="badge bg-primary-100 text-primary-700 text-xs px-10 py-4 radius-4 fw-semibold">Student</span>'
                            };

                            let priorityMap = {
                                1: '<span class="badge bg-neutral-200 text-neutral-700 text-xs px-10 py-4 radius-4 fw-semibold">Low</span>',
                                2: '<span class="badge bg-info-100 text-info-700 text-xs px-10 py-4 radius-4 fw-semibold">Medium</span>',
                                3: '<span class="badge bg-warning-100 text-warning-800 text-xs px-10 py-4 radius-4 fw-semibold">High</span>',
                                4: '<span class="badge bg-danger-100 text-danger-700 text-xs px-10 py-4 radius-4 fw-semibold">Critical</span>'
                            };

                            rows += `
                            <tr>
                                <td class="py-12 px-16 text-sm text-neutral-600">${index + 1}</td>
                                <td class="py-12 px-16">
                                    <span class="fw-bold text-neutral-800 text-sm d-block">${d.type_name ?? ''}</span>
                                    ${d.description ? `<small class="text-neutral-500 text-xs d-block mt-2">${d.description}</small>` : ''}
                                </td>
                                <td class="py-12 px-16">${complaintForMap[d.complaint_for] ?? '-'}</td>
                                <td class="py-12 px-16">${priorityMap[d.default_priority] ?? '-'}</td>
                                <td class="py-12 px-16">
                                    ${d.status == 1
                                        ? '<span class="badge bg-success-100 text-success-700 text-xs px-10 py-4 radius-4 fw-semibold">Active</span>'
                                        : '<span class="badge bg-danger-100 text-danger-700 text-xs px-10 py-4 radius-4 fw-semibold">Inactive</span>'
                                    }
                                </td>
                                <td class="py-12 px-16 text-end">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <button type="button" data-id="${d.id}" class="editComplaintType btn btn-sm bg-neutral-100 text-neutral-700 hover-bg-primary-600 hover-text-white p-6 radius-6 transition-all border-0" title="Edit">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                        <button type="button" data-id="${d.id}" class="deleteComplaintType btn btn-sm bg-danger-100 text-danger-600 hover-bg-danger-600 hover-text-white p-6 radius-6 transition-all border-0" title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        });
                    } else {
                        rows = `
                        <tr>
                            <td colspan="6" class="text-center text-neutral-400 py-32 text-sm">
                                <i class="ri-inbox-line text-neutral-300 fs-1 mb-8 d-block"></i>
                                No Complaint Types found.
                            </td>
                        </tr>`;
                    }

                    $('#complaintTypeTableBody').html(rows);
                }
            });
        }

        /* Edit Function */
        $(document).on('click', '.editComplaintType', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('school.complaintType.get') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status) {
                        $('#complaint_type_id').val(res.data.id);
                        $('#complaint_for').val(res.data.complaint_for);
                        $('#complaint_type_name').val(res.data.type_name);
                        $('#complaint_default_priority').val(res.data.default_priority);
                        $('#complaint_description').val(res.data.description);

                        // Toggle status switch according to status value (1 or 0)
                        $('#complaint_status').prop('checked', res.data.status == 1);

                        $('#complaintTypeModalTitle').text('Edit Complaint Type');
                        $('#complaintTypeListModal').modal('hide');
                        $('#complaintTypeModal').modal('show');
                    }
                }
            });
        });



        /* Open Add Modal from List Modal */
        $(document).on('click', '#openAddComplaintTypeBtn', function() {
            $('#complaintTypeForm')[0].reset();
            $('#complaint_type_id').val('');
            $('#complaint_status').prop('checked', true);
            $('#complaintTypeModalTitle').text('Add Complaint Type');
            $('#complaintTypeModal').modal('show');
        });

        /* Initial Load */
        $(document).ready(function() {
            getComplaintTypeList();
        });
    </script>
@endpush
