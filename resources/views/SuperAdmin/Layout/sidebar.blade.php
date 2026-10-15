    {{-- <aside class="sidebar">
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
                    <a href="{{ route('superAdmin.dashboard') }}">
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
                            <a href="{{ route('superAdmin.school.allSchools') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                All Schools
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.school.register.manageView') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Register
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.school.completeSchoolProcess') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Control School
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.school.planChanging') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Plan Changing
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Subscription Plan</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('superAdmin.subscriptionPlan.manageView') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Plans
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.planFeature.manageView') }}">

                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Manage Plan Features
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.planFeaturesMapping.manageView') }}">

                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Plan Features Mapping
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Manage Broadcast</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('superAdmin.broadcast.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Add Broadcast
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.broadcast.list') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                View Broadcasts
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superAdmin.broadcast.analysis.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Broadcast Analysis
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Manage Notification</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('superAdmin.notificationTemplate.index') }}">
                                <i class="ri-circle-fill circle-icon w-auto"></i>
                                Templates
                            </a>
                        </li>
                     
                    </ul>
                </li>


                <li>
                    <a href="{{ route('logout') }}" >
                        <i class="ri-shut-down-line"></i>
                        <span>Logout </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside> --}}


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

        <!-- Scrollable Menu Area -->
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li>
                    <a href="{{ route('superAdmin.dashboard') }}">
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
                        <li><a href="{{ route('superAdmin.school.allSchools') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> All Schools</a></li>
                        <li><a href="{{ route('superAdmin.school.register.manageView') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Register</a></li>
                        <li><a href="{{ route('superAdmin.school.completeSchoolProcess') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Control School</a></li>
                        <li><a href="{{ route('superAdmin.school.planChanging') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Plan Changing</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Subscription Plan</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('superAdmin.subscriptionPlan.manageView') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Manage Plans</a></li>
                        <li><a href="{{ route('superAdmin.planFeature.manageView') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Manage Plan Features</a></li>
                        <li><a href="{{ route('superAdmin.planFeaturesMapping.manageView') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Plan Features Mapping</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Module Master</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('superAdmin.moduleMaster.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i>Modules</a></li>
                        <li><a href="{{ route('superAdmin.moduleMasterMapping.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i>Assign Modules</a></li>
                     
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Sub Module Master</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('superAdmin.subModuleMaster.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i>Sub Modules</a></li>
                        <li><a href="{{ route('superAdmin.subModuleMasterMapping.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i>Assign Sub Modules</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Manage Broadcast</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('superAdmin.broadcast.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Add Broadcast</a></li>
                        <li><a href="{{ route('superAdmin.broadcast.list') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> View Broadcasts</a></li>
                        <li><a href="{{ route('superAdmin.broadcast.analysis.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Broadcast Analysis</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Module Settings</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('superAdmin.userSettingMaster.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i>Module Setting Master</a></li>
                        <li><a href="{{ route('superAdmin.userSettingValue.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Module Setting Value</a></li>
                    
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-graduation-cap-line"></i>
                        <span>Manage Notification</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('superAdmin.notificationTemplate.index') }}"><i
                                    class="ri-circle-fill circle-icon w-auto"></i> Templates</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Fixed Bottom Logout Area -->
        <div class="sidebar-bottom-area">
            <ul class="sidebar-menu">
                <li class="logout-item">
                    <a href="{{ route('logout') }}">
                        <i class="ri-shut-down-line"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>


    <style>
        .sidebar {
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar-menu-area {
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-menu-area::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu-area::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .sidebar-bottom-area {
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: auto;
        }

        .logout-item a {
            border: 2px solid #dc3545;
            color: #fff !important;
            background-color: rgba(220, 53, 69, 0.05);
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 16px;
            background-color: #dc3545 !important;
            box-shadow: inset -1px -1px 10px #fff;

        }

        .logout-item a:hover {
            color: #ffffff !important;

        }
    </style>
