@extends('School.Layout.main')

@section('title', 'KTR ERP : Payroll - Manage Shift')

@section('dynamic-content')

    <div class="dashboard-main-body py-24 px-16">



        <div class="shadow-1 radius-12 bg-base premium-generator-card pb-96 mb-16 ">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Verified Shift Schedules
                        Registry</h6>
                    <p class="text-xs text-muted mb-0">System indexed work shifts, timing limits, and attendance rules</p>
                </div>


                <div class="d-flex align-items-center gap-2">
                    <x-datatable--toolbar tableId="ShiftDataTable" />
                    <x-model-open target="payrollShiftModal" />
                </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive scrollable-class-registry">
                    <table class="table bordered-table mb-0 data-table text-sm vertical-middle"id="ShiftDataTable"
                        data-page-length="10">
                        <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                            <tr>
                                <th scope="col" style="width: 60px;" class="text-center">S.No.</th>
                                <th scope="col" style="width: 200px;">Shift Details</th>
                                <th scope="col" style="width: 120px;">Branch</th>
                                <th scope="col" class="text-center" style="width: 160px;">Shift Timing</th>
                                <th scope="col" class="text-center" style="width: 120px;">Total Work Hrs</th>
                                <th scope="col" class="text-center" style="width: 160px;">Grace & Overtime</th>
                                <th scope="col" class="text-center" style="width: 100px;">Status</th>
                                <th scope="col" class="text-center" style="width: 110px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="shiftRegistryTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('School.Pages.Payroll.components.add_update_shift')
@endsection
@push('script')
    <script>
        $(document).ready(async function() {

            await loadBranchDropdown();
            fetchRegisteredShifts();

            function resetShiftForm() {
                const form = $('#shiftRegistrationForm')[0];
                if (form) {
                    form.reset();
                }

                $('#shift_id').val('');
                $('#shift_status, #late_mark_enabled, #early_out_enabled').prop('checked', true);
                $('#is_overnight, #has_break, #overtime_allowed').prop('checked', false);
                $('#break_fields_wrapper').addClass('d-none');
                $('#working_hours, #break_hours').val('0.00');

                $('#payrollShiftModalTitle').text('Add Shift');
            }

            $('[data-bs-target="#payrollShiftModal"]').on('click', function() {
                resetShiftForm();
                $('#payrollShiftModalTitle').text('Add Shift');
            });

            // Toggle Break Fields
            $(document).on('change', '#has_break', function() {
                if ($(this).is(':checked')) {
                    $("#break_fields_wrapper").removeClass('d-none');
                } else {
                    $("#break_fields_wrapper").addClass('d-none');
                    $("#break_start_time, #break_end_time").val('');
                    $("#break_hours").val('0.00');
                    calculateHours();
                }
            });

            // Auto Calculate Hours on time changes
            $(document).on('change input', '.calculate-hours, #is_overnight', function() {
                calculateHours();
            });

            // Form Reset Trigger
            $("#resetShiftForm").on("click", function() {
                resetShiftForm();
            });

            // Edit Trigger Ajax Mapping
            $(document).on("click", ".edit-shift-trigger", function() {
                let id = $(this).data("id");

                console.log('EDIT SHIFT ID:', id);

                if (!id) {
                    console.error('Shift ID not found');
                    return;
                }

                resetShiftForm();
                $('#payrollShiftModal').modal('show');
                $('#payrollShiftModalTitle').text('Edit Shift');

                getDataById("{{ route('school.payroll_shift.get') }}", id, async function(res) {

                    console.log('EDIT SHIFT RESPONSE:', res);

                    if (!res.status || !res.data) {
                        console.error('Unable to fetch shift details', res);
                        return;
                    }

                    let row = res.data;

                    $("#shift_id").val(row.id);

                    await loadBranchDropdown();
                    $(".payroll_branch_id").val(String(row.branch_id ?? ""));

                    $("#shift_code").val(row.shift_code ?? '');
                    $("#shift_name").val(row.shift_name ?? '');

                    $("#start_time").val(row.start_time ?? '');
                    $("#end_time").val(row.end_time ?? '');

                    $("#is_overnight").prop("checked", Number(row.is_overnight) === 1);
                    $("#has_break").prop("checked", Number(row.has_break) === 1);

                    if (Number(row.has_break) === 1) {
                        $("#break_fields_wrapper").removeClass('d-none');
                        $("#break_start_time").val(row.break_start_time ?? '');
                        $("#break_end_time").val(row.break_end_time ?? '');
                    } else {
                        $("#break_fields_wrapper").addClass('d-none');
                        $("#break_start_time, #break_end_time").val('');
                    }

                    $("#working_hours").val(row.working_hours ?? '0.00');
                    $("#break_hours").val(row.break_hours ?? '0.00');

                    $("#late_grace_minutes").val(row.late_grace_minutes ?? '');
                    $("#early_grace_minutes").val(row.early_grace_minutes ?? '');
                    $("#half_day_after_minutes").val(row.half_day_after_minutes ?? '');
                    $("#overtime_after_minutes").val(row.overtime_after_minutes ?? '');

                    $("#late_mark_enabled").prop("checked", Number(row
                        .late_mark_enabled) === 1);
                    $("#early_out_enabled").prop("checked", Number(row
                        .early_out_enabled) === 1);
                    $("#overtime_allowed").prop("checked", Number(row.overtime_allowed) ===
                        1);

                    $("#shift_status").prop("checked", Number(row.status) === 1);
                    $("#shift_description").val(row.description ?? '');

                    $('#payrollShiftModalTitle').text('Edit Shift');
                });
            });

            // Reset form when modal is closed
            $('#payrollShiftModal').on('hidden.bs.modal', function() {
                resetShiftForm();
            });

        });

        // Time format utility (12-Hour conversion)
        function format12Hour(timeString) {
            if (!timeString) return '--:--';
            let [hours, minutes] = timeString.split(':');
            hours = parseInt(hours);
            let ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes.substr(0, 2);
            return `${hours}:${minutes} ${ampm}`;
        }

        // Live Calculate Shift & Break Working Hours
        function calculateHours() {
            let startTime = $("#start_time").val();
            let endTime = $("#end_time").val();
            let isOvernight = $("#is_overnight").is(':checked');

            let breakStart = $("#break_start_time").val();
            let breakEnd = $("#break_end_time").val();
            let hasBreak = $("#has_break").is(':checked');

            let totalShiftHrs = 0;
            let totalBreakHrs = 0;

            if (startTime && endTime) {
                let start = new Date(`2026-01-01T${startTime}:00`);
                let end = new Date(`2026-01-01T${endTime}:00`);

                if (isOvernight || end <= start) {
                    end.setDate(end.getDate() + 1);
                }

                let diffMs = end - start;
                totalShiftHrs = diffMs / (1000 * 60 * 60);
            }

            if (hasBreak && breakStart && breakEnd) {
                let bStart = new Date(`2026-01-01T${breakStart}:00`);
                let bEnd = new Date(`2026-01-01T${breakEnd}:00`);

                if (bEnd <= bStart) {
                    bEnd.setDate(bEnd.getDate() + 1);
                }

                let bDiffMs = bEnd - bStart;
                totalBreakHrs = bDiffMs / (1000 * 60 * 60);
            }

            let netWorkingHrs = Math.max(0, totalShiftHrs - totalBreakHrs);

            $("#break_hours").val(totalBreakHrs.toFixed(2));
            $("#working_hours").val(netWorkingHrs.toFixed(2));
        }

        function loadBranchDropdown() {
            return new Promise((resolve) => {
                fetchMasterData("{{ route('school.payroll_branch.fetch') }}", function(res) {
                    let options = `<option value="">Select Branch</option>`;
                    if (res.status && res.data) {
                        $.each(res.data, function(index, row) {
                            options += `<option value="${row.id}">${row.branch_name}</option>`;
                        });
                    }
                    $(".payroll_branch_id").html(options);
                    resolve(res);
                });
            });
        }

        function fetchRegisteredShifts() {
            fetchMasterData("{{ route('school.payroll_shift.fetch.with') }}", function(res) {
                let html = '';

                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, row) {
                        let initials = row.shift_name ?
                            row.shift_name.split(' ').map(w => w.charAt(0)).join('').substring(0, 2)
                            .toUpperCase() :
                            'SH';

                        let overnightTag = row.is_overnight ?
                            `<span class="badge bg-warning-50 text-warning-600 border border-warning-200 px-6 py-2 radius-4 text-xs mt-1 d-inline-block">Overnight</span>` :
                            '';

                        let timingDisplay = `
                            <span class="fw-semibold text-dark-main">${format12Hour(row.start_time)} - ${format12Hour(row.end_time)}</span>
                            ${overnightTag}
                        `;

                        let hoursDisplay = `
                            <span class="fw-bold text-gradient-primary">${parseFloat(row.working_hours).toFixed(2)} hrs</span>
                            ${row.has_break ? `<small class="text-muted d-block">(Break: ${parseFloat(row.break_hours).toFixed(2)} hrs)</small>` : ''}
                        `;

                        let rulesDisplay = `
                            <span class="badge bg-light text-muted border px-6 py-2 radius-4 mb-1" title="Late Grace">Late: ${row.late_grace_minutes}m</span>
                            <span class="badge bg-light text-muted border px-6 py-2 radius-4 mb-1" title="Early Grace">Early: ${row.early_grace_minutes}m</span>
                            ${row.overtime_allowed ? `<span class="badge bg-success-50 text-success-600 border-success-200 px-6 py-2 radius-4" title="OT Allowed">OT > ${row.overtime_after_minutes}m</span>` : ''}
                        `;

                        let statusBadge = row.status == 1 ?
                            `<span class="status-badge badge-completed"><span class="pulse-dot-green"></span> Active</span>` :
                            `<span class="status-badge badge-cancelled">Inactive</span>`;

                        let branchName = row.branch?.branch_name ? row.branch.branch_name :
                            '<span class="text-muted">—</span>';

                        html += `
                            <tr class="shift-record-row">
                                <td class="text-center fw-semibold text-muted">${index + 1}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-matrix-icon">
                                            <span class="fw-bold text-sm text-gradient-primary">${initials}</span>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark-main d-block">${row.shift_name}</span>
                                            <small class="text-muted text-xs">Code: ${row.shift_code}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm">${branchName}</td>
                                <td class="text-center">${timingDisplay}</td>
                                <td class="text-center">${hoursDisplay}</td>
                                <td class="text-center">${rulesDisplay}</td>
                                <td class="text-center">${statusBadge}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-shift-trigger" data-id="${row.id}" title="Edit">
                                            <i class="ri-edit-box-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 delete-shift-trigger deleteShift" data-id="${row.id}" title="Delete">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                }




                if ($.fn.DataTable.isDataTable('#ShiftDataTable')) {
                    $('#ShiftDataTable')
                        .DataTable()
                        .destroy();
                }
                $("#shiftRegistryTableBody").html(html);

                $('#ShiftDataTable').DataTable({
                    pageLength: 10,
                    language: {
                        emptyTable: "No Records Found"
                    }
                });

            });
        }
    </script>
@endpush
