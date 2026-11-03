    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div class="">
            <div class="sidebar-logo d-flex align-items-center justify-content-between">
                <a href="index-2.html" class="">
                    <img src="{{ asset('assets') }}/images/logo.png" alt="site logo" class="light-logo" />
                    <img src="{{ asset('assets') }}/images/logo-light.png" alt="site logo" class="dark-logo" />
                    <img src="{{ asset('assets') }}/images/logo-icon.png" alt="site logo" class="logo-icon" />
                </a>
                <button type="button" class="text-xxl d-xl-flex d-none line-height-1 sidebar-toggle text-neutral-500"
                    aria-label="Collapse Sidebar">
                    <i class="ri-contract-left-line"></i>
                </button>
            </div>
        </div>


        <!-- User Info end -->
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="ri-home-4-line"></i>
                        <span>Dashboard </span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>School</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.update.details') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Update Details
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.setting') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Setting and Permission
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-list-view"></i>
                        <span>Class Master</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.class.master.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Class Master
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.subject.group.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Subject Group
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.subject.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Subjects
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.subject.link.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Subject Link
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.stream.master.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Stream Master
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Transport</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.transport.vehicle.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Transport Vehicle
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.transport.route.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Transport Route
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.transport.destination.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Transport Destination
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.transport.assign.vehicle.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Transport Asign Vehicle
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Hostels</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.hostel.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Hostel
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.hostel.block.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Block
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.hostel.floor.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Floor
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.room.type.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Room Type
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.room.master.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Rooms
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('student.registration.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Registration
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('student.assign_roll_no') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Assign Roll/Feebook No
                            </a>
                        </li>
                        <li>

                            <a href="{{ route('student.attendance.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Attendance
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('student.online_classes.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Online Classes
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.student.promoteAndDemoteStudentsView') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Promotion
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.student.viewTcBcAndCc') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add TC BC CC Formats
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.student.portfolio') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Student Portfolio
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-user-follow-line"></i>
                        <span>Study Material</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.student.addAndUpdateStudyMaterial') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Study Material
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.student.addAndUpdateHomework') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Homework
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.student.addAndUpdatePreviousYearPapers') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Previous Year Papers
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-book-2-line"></i>
                        <span>Library</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'addAuthor']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Authors
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'addPublication']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Publication
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'addCategory']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Category
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'addFineTab']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fine Setup
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'addSupplier']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Supplier
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'addBook']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Books
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'issueBook']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Issue Books
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'returnBook']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Return Book
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('school.library.libraryAdvancedSearch', ['tab' => 'libraryMembership']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Library Membership
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('library_card.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                testing
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-calendar-schedule-line"></i>
                        <span>Calendar Planning</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.calendarEventType.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Event Types
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.calendarEvent.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.calendarWeeklyOff.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Weekly Off
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-money-dollar-circle-line"></i>
                        <span>Fees Collection</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.updateMonthOrderAndSetting') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Month Order Update
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeGroup.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fees Group
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeHead.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fee Heads
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeHeadApplicability.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fees Head Availability
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeInstallment.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fees Installment
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeConcession.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fee Concession
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeFineMaster.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fine Master
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeStructure.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Fees Structure
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('school.studentFeeAssignment.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Individual Fees Structure
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.feeCollection.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Collect Fee
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-calendar-check-line"></i>
                        <span>Attendance</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="student-attendance.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Student Attendance
                            </a>
                        </li>
                        <li>
                            <a href="teacher-attendance.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Teacher Attendance
                            </a>
                        </li>
                        <li>
                            <a href="employee-attendance.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Employee Attendance
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-file-edit-line"></i>
                        <span>Examinations</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="exam.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Exam
                            </a>
                        </li>
                        <li>
                            <a href="exam-schedule.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Exam Schedule
                            </a>
                        </li>
                        <li>
                            <a href="exam-result.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Exam Result
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-calendar-check-line"></i>
                        <span>Complaints</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.complaint.dashboard') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Complaints Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.complaint.index', ['type' => 'student']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Student Complaints
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.complaint.index', ['type' => 'staff']) }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Staff Complaints
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.complaint.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Complaint's Report
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-time-line"></i>
                        <span>Payroll</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('school.payroll_branch.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Branch
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.payroll_department.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Department
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.payroll_designation.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Designation
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.payroll_allowance.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Allowances
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.payroll_shift.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Shift
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.payroll_employment_type.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Employee Type
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.payroll_employee.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Employee
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('school.employee_attendance.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Employee Attendance
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="certificate.html">
                        <i class="ri-home-4-line"></i>
                        <span>Certificate </span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-book-2-line"></i>
                        <span>Library</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="books-list.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Books List
                            </a>
                        </li>
                        <li>
                            <a href="members-list.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Members List
                            </a>
                        </li>
                        <li>
                            <a href="member-details.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Members Details
                            </a>
                        </li>
                        <li>
                            <a href="issue-return.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Issue Return
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-money-dollar-circle-line"></i>
                        <span>Accounts</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="income-head.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Income Head
                            </a>
                        </li>
                        <li>
                            <a href="income-list.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Income List
                            </a>
                        </li>
                        <li>
                            <a href="expense-head.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Expense Head
                            </a>
                        </li>
                        <li>
                            <a href="expense-list.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Expense List
                            </a>
                        </li>
                        <li>
                            <a href="transaction.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Transaction
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-user-settings-line"></i>
                        <span>HRM</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="employee-list.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Employee List
                            </a>
                        </li>
                        <li>
                            <a href="employee-details.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Employee Details
                            </a>
                        </li>
                        <li>
                            <a href="add-new-employee.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add New Employee
                            </a>
                        </li>
                        <li>
                            <a href="payroll.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Payroll
                            </a>
                        </li>
                        <li>
                            <a href="designation.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Designation
                            </a>
                        </li>

                        <li>
                            <a href="department.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Department
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="notice-board.html">
                        <i class="ri-booklet-line"></i>
                        <span>Notice Board </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('total.testingPage') }}">
                        <i class="ri-booklet-line"></i>
                        <span>Testing System</span>
                    </a>
                </li>
                <li>
                    <a href="event.html">
                        <i class="ri-calendar-event-line"></i>
                        <span>Event </span>
                    </a>
                </li>
                <li>
                    <a href="message.html">
                        <i class="ri-message-2-line"></i>
                        <span>Message </span>
                    </a>
                </li>
                <li>
                    <a href="our_plans">
                        <i class="ri-price-tag-3-line"></i>
                        <span>Subscription Plan </span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-shield-check-line"></i>
                        <span>Roles</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('manage_roles') }}"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Create Role</a>
                        </li>
                        <li>
                            <a href="{{ route('assignRoleToModel') }}"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Assign Role</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-shield-check-line"></i>
                        <span>Permissions</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('manage_permissions') }}"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Create Permission</a>
                        </li>
                        <li>
                            <a href="{{ route('assign_permission.view') }}"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Assign Permission</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-shield-check-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="login.html"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Login</a>
                        </li>
                        <li>
                            <a href="register.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Register</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-user-settings-line"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="general.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                General
                            </a>
                        </li>
                        <li>
                            <a href="notification.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Notification
                            </a>
                        </li>
                        <li>
                            <a href="currencies.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Currencies
                            </a>
                        </li>
                        <li>
                            <a href="languages.html">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Languages
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="active-page">
                    <a href="{{ route('logout') }}" class="active-page">
                        <i class="ri-shut-down-line"></i>
                        <span>Logout </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
