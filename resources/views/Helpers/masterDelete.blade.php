<style>
    .swal2-container {
        z-index: 999999 !important;
    }

    .swal2-popup {
        border-radius: 22px !important;
        padding: 24px !important;
        box-shadow: 0 25px 60px rgba(0, 0, 0, .25) !important;
    }

    .swal2-title {
        font-size: 22px !important;
        font-weight: 700 !important;
    }

    .swal2-html-container {
        font-size: 15px !important;
        color: #6b7280 !important;
    }

    .swal2-confirm {
        border-radius: 12px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
    }

    .swal2-cancel {
        border-radius: 12px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
    }
</style>

<script>
    /*
    |--------------------------------------------------------------------------
    | Master Delete Function
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Delete Role
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteRole", function() {
        let id = $(this).data('id');
        let route = "{{ route('delete_role') }}";
        masterDelete(id, route, [getRoles]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Permission
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deletePermission", function() {
        let id = $(this).data('id');
        let route = "{{ route('delete_permission') }}";
        masterDelete(id, route, [getPermissions]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Classes 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteClass", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.class.master.delete') }}";
        masterDelete(id, route, [getClassList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Subject Group
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteSubjectGroup", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.subject.group.delete') }}";
        masterDelete(id, route, [getSubjectGroupList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Subject
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteSubject", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.subject.delete') }}";
        masterDelete(id, route, [getSubjectList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Subject Link With Class
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteSubjectLink", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.subject.link.delete') }}";
        masterDelete(id, route, [getSubjectLinkList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Stream Master
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteStream", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.stream.master.delete') }}";
        masterDelete(id, route, [getStreamList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Transport Vehicle
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteTransportVehicle", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.transport.vehicle.delete') }}";
        masterDelete(id, route, [getTransportVehicleList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Transport Route
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteTransportRoute", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.transport.route.delete') }}";
        masterDelete(id, route, [getTransportRouteList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Transport Destination
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteTransportDestination", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.transport.destination.delete') }}";
        masterDelete(id, route, [getTransportDestinationList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Hostel
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteHostel", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.hostel.delete') }}";
        masterDelete(id, route, [getHostelList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Hostel Block
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteHostelBlock", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.hostel.block.delete') }}";
        masterDelete(id, route, [getHostelBlockList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Hostel Floor 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteHostelFloor", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.hostel.floor.delete') }}";
        masterDelete(id, route, [getHostelFloorList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Hostel Floor 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteRoomType", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.room.type.delete') }}";
        masterDelete(id, route, [getRoomTypeList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Room
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteRoomMaster", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.room.master.delete') }}";
        masterDelete(id, route, [getRoomMasterList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete House
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteHouse", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.house.delete') }}";
        masterDelete(id, route, [getHouseList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Concession By
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteConcessionBy", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.concession.by.delete') }}";
        masterDelete(id, route, [getConcessionByList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Concession Type
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteConcessionType", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.concession.type.delete') }}";
        masterDelete(id, route, [getConcessionTypeList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Template Type
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteTemplateType", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.template.type.delete') }}";
        masterDelete(id, route, [fetchTemplateType]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Template
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteTemplate", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.template.delete') }}";
        masterDelete(id, route, [fetchTemplate]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete meeting
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteMeeting", function() {
        let id = $(this).data('id');
        let route = "{{ route('student.online_classes.delete') }}";
        masterDelete(id, route, [fetchOnlineClasses]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete document category
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteDocumentCategory", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.document.category.delete') }}";
        masterDelete(id, route, [fetchDocumentCategories]);
    });


    /*
    |--------------------------------------------------------------------------
    | Delete library authors
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteLibraryAuthor", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.author.delete') }}";
        masterDelete(id, route, [fetchRegisteredAuthors]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete library publication
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteLibraryPublication", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.publication.delete') }}";
        masterDelete(id, route, [fetchRegisteredPublications]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete library fine setting
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteLibraryFine", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.fine.delete') }}";
        masterDelete(id, route, [fetchFinePolicies]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete library supplier
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteLibrarySupplier", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.supplier.delete') }}";
        masterDelete(id, route, [fetchRegisteredSuppliers]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete library category
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteLibraryCategory", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.category.delete') }}";
        masterDelete(id, route, [fetchRegisteredCategories]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete library book
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteLibraryBook", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.book.delete') }}";
        masterDelete(id, route, [fetchLibraryBooks]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete library membership
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteMembership", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.library.membership.delete') }}";
        masterDelete(id, route, [fetchMembershipRegistry]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete subscription plan 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-plan-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('superAdmin.subscriptionPlan.delete') }}";
        masterDelete(id, route, [fetchSubscriptionPlans]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Broadcast 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-broadcast-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('superAdmin.broadcast.delete') }}";
        masterDelete(id, route, [fetchBroadcastRegistry]);
    });


    /*
    |--------------------------------------------------------------------------
    | Delete Notification Template
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-template-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('superAdmin.notificationTemplate.delete') }}";
        masterDelete(id, route, [fetchNotificationTemplates]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Module
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-module-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('superAdmin.moduleMaster.delete') }}";
        masterDelete(id, route, [fetchModuleMasters]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Sub Module
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-sub-module-trigger", function() {

        let id = $(this).data('id');
        let route = "{{ route('superAdmin.subModuleMaster.delete') }}";
        masterDelete(id, route, [fetchSubModuleMasters]);
    });


    /*
    |--------------------------------------------------------------------------
    | Delete Fee Group
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-fee-group-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.feeGroup.delete') }}";
        masterDelete(id, route, [fetchFeeGroups]);
    });
    /*
    |--------------------------------------------------------------------------
    | Delete Complaint Type
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteComplaintType", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.complaintType.delete') }}";
        masterDelete(id, route, [getComplaintTypeList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Complaint 1
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteComplaint", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.complaint.delete') }}";
        masterDelete(id, route, []);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete calender event types 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-calendar-event-type-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.calendarEventType.delete') }}";
        masterDelete(id, route, [getCalendarEventTypeList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete calender event
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-calendar-event-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.calendarEvent.delete') }}";
        masterDelete(id, route, [getCalendarEventList]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete payroll branch
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-branch-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_branch.delete') }}";
        masterDelete(id, route, [fetchRegisteredBranches]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete payroll department
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-department-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_department.delete') }}";
        masterDelete(id, route, [fetchRegisteredDepartments]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete payroll allowance
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-allowance-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_allowance.delete') }}";
        masterDelete(id, route, [fetchRegisteredAllowances]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete employment type 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-employment-type-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_employment_type.delete') }}";
        masterDelete(id, route, [fetchEmploymentTypes]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete payroll shift 
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".delete-shift-trigger", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_shift.delete') }}";
        masterDelete(id, route, [fetchRegisteredShifts]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete payroll designation
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteDesignation", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_designation.delete') }}";
        masterDelete(id, route, [fetchRegisteredDesignations]);
    });

    /*
    |--------------------------------------------------------------------------
    | Delete staff registration
    |--------------------------------------------------------------------------
    */

    $(document).on('click', ".deleteEmployee", function() {
        let id = $(this).data('id');
        let route = "{{ route('school.payroll_employee.delete') }}";
        masterDelete(id, route, [fetchRegisteredEmployees]);
    });


    function masterDelete(id, route, refresh = null) {

        Swal.fire({

            icon: "warning",

            title: "Delete Record?",

            html: `
            <div style="font-size:15px">
                This action cannot be undone.
                <br>
                Are you sure you want to delete this record?
            </div>
        `,

            showCancelButton: true,

            confirmButtonText: `
            <i class="ri-delete-bin-6-line"></i>
            Yes, Delete
        `,

            cancelButtonText: `
            <i class="ri-close-line"></i>
            Cancel
        `,

            confirmButtonColor: "#dc2626",

            cancelButtonColor: "#6b7280",

            reverseButtons: true,

            focusCancel: true,

            allowOutsideClick: false,

            allowEscapeKey: true

        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({

                url: route,

                method: "POST",

                data: {

                    id: id,

                    _method: "DELETE"

                },

                success: function(res) {

                    if (Array.isArray(refresh)) {

                        refresh.forEach(fn => {

                            if (typeof fn === "function") {

                                fn();

                            }

                        });

                    } else if (typeof refresh === "function") {

                        refresh();

                    }

                    if (res.status) {

                        showToast('success', res.message);

                    } else {

                        showToast('error', res.message);

                    }

                },

                error: function(xhr) {

                    showToast('error', xhr.responseText);

                }

            });

        });

    }
</script>
