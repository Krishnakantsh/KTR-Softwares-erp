<!-- meta tags and other links -->
<!doctype html>
<html lang="en" data-theme="light">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Modern Education Admin Dashboard for schools, colleges, universities, and eLearning platforms. Includes student and course management, attendance, exams, payments, analytics, and a fully responsive clean UI—ideal for LMS, coaching centers, and academic admin systems." />
    <meta name="keywords"
        content="Education Admin Dashboard, School Admin Panel, College Dashboard, University Dashboard, LMS Dashboard, eLearning Admin Template, Student Management System, Course Management, Education Template, Study Dashboard, Online Learning Dashboard, Academic Admin Panel, Bootstrap Dashboard, React Education Dashboard, Next.js Education Template" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>
        KTR ERP :- A complete software for school management
    </title>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/images/favicon.png" sizes="16x16" />
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/remixicon.css" />
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/bootstrap.min.css" />
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/apexcharts.css" />
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/dataTables.min.css" />
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/flatpickr.min.css" />
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/full-calendar.css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/calendar.css" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/custom.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        @media (max-width: 576px) {
            .btn-primary-600.radius-48 {
                transform: scale(0.85);
                transform-origin: left center;
            }
        }
    </style>


    @stack('styles')


    <style>
          .progress-bar {
            flex-direction: row;
          }
            #ktr-erp-loader-overlay {
      
        background-color: #0a0818;
            }
    </style>

</head>



<body>


    <div class="body-overlay"></div>

    <button type="button"
        class="theme-customization__button w-48-px h-48-px bg-primary-600 text-white rounded-circle d-flex justify-content-center align-items-center position-fixed end-0 bottom-0 mb-40 me-40 text-2xxl bg-hover-primary-700"
        aria-label="Theme Customization Button">
        <i class="ri-settings-3-line animate-spin"></i>
    </button>
    <div class="theme-customization-sidebar w-100 bg-base h-100vh overflow-y-auto position-fixed end-0 top-0">
        <div class="d-flex align-items-center gap-3 py-16 px-24 justify-content-between border-bottom">
            <div>
                <h6 class="text-sm dark:text-white">Theme Settings</h6>
                <p class="text-xs mb-0 text-neutral-500 dark:text-neutral-200">
                    Customize and preview instantly
                </p>
            </div>
            <button data-slot="button"
                class="theme-customization-sidebar__close text-neutral-900 bg-transparent text-hover-primary-600 d-flex text-xl">
                <i class="ri-close-fill"></i>
            </button>
        </div>

        <div class="d-flex flex-column gap-48 p-24 overflow-y-auto flex-grow-1">
            <div class="theme-setting-item">
                <h6 class="fw-medium text-primary-light text-md mb-3">Theme Mode</h6>
                <div class="d-grid grid-cols-3 gap-3 dark-light-mode">
                    <button type="button"
                        class="theme-btn theme-setting-item__btn d-flex align-items-center justify-content-center h-64-px rounded-3 text-xl active"
                        data-theme="light" aria-label="light">
                        <i class="ri-sun-line"></i>
                    </button>
                    <button type="button"
                        class="theme-btn theme-setting-item__btn d-flex align-items-center justify-content-center h-64-px rounded-3 text-xl"
                        data-theme="dark" aria-label="dark">
                        <i class="ri-moon-line"></i>
                    </button>
                    <button type="button"
                        class="theme-btn theme-setting-item__btn d-flex align-items-center justify-content-center h-64-px rounded-3 text-xl"
                        data-theme="system" aria-label="system">
                        <i class="ri-computer-line"></i>
                    </button>
                </div>
            </div>


            <div class="theme-setting-item">
                <h6 class="fw-medium text-primary-light text-md mb-3">
                    Color Schema
                </h6>
                <div class="d-grid grid-cols-3 gap-3">
                    <button type="button"
                        class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
                        data-color="base" aria-label="Base">
                        <span class="color-picker-btn__box h-40-px w-100 rounded-3"
                            style="background-color: #25a194"></span>
                        <span class="fw-medium mt-1" style="color: #25a194">Base</span>
                    </button>
                    <button type="button"
                        class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
                        data-color="red" aria-label="Red">
                        <span class="color-picker-btn__box h-40-px w-100 rounded-3"
                            style="background-color: #dc2626"></span>
                        <span class="fw-medium mt-1" style="color: #dc2626">Red</span>
                    </button>
                    <button type="button"
                        class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
                        data-color="blue" aria-label="Blue">
                        <span class="color-picker-btn__box h-40-px w-100 rounded-3"
                            style="background-color: #2563eb"></span>
                        <span class="fw-medium mt-1" style="color: #2563eb">Blue</span>
                    </button>
                    <button type="button"
                        class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
                        data-color="yellow" aria-label="Yellow">
                        <span class="color-picker-btn__box h-40-px w-100 rounded-3"
                            style="background-color: #ff9f29"></span>
                        <span class="fw-medium mt-1" style="color: #ff9f29">Yellow</span>
                    </button>
                    <button type="button"
                        class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
                        data-color="cyan" aria-label="Cyan">
                        <span class="color-picker-btn__box h-40-px w-100 rounded-3"
                            style="background-color: #00b8f2"></span>
                        <span class="fw-medium mt-1" style="color: #00b8f2">Cyan</span>
                    </button>
                    <button type="button"
                        class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
                        data-color="violet" aria-label="Violet">
                        <span class="color-picker-btn__box h-40-px w-100 rounded-3"
                            style="background-color: #7c3aed"></span>
                        <span class="fw-medium mt-1" style="color: #7c3aed">Violet</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- Theme Customization Structure End -->

    <div
        class="overlay bg-black bg-opacity-50 w-100 h-100 position-fixed z-9 visibility-hidden opacity-0 duration-300">
    </div>

    @include('Frontend/Normal/Layout/sidebaar')



    <main class="dashboard-main">

        <div class="navbar-header shadow-1">
            <div class="row align-items-center justify-content-between z-50">
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <button type="button" class="sidebar-mobile-toggle"
                            aria-label="Sidebar Mobile Toggler Button">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                        </button>
                        <form class="navbar-search fs-3 text-success">
                            <img src="{{ asset('assets') }}/images/thumbs/leave-request-img2.png" alt=""
                                class="user-image me-3" />
                            {{ Auth::user()->name ?? 'KTR ERP SOFTWARE' }}
                            <!-- <input type="text" class="bg-transparent" name="search" placeholder="Search"> -->
                            <!-- <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon> -->
                        </form>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-3">

                        <div class="h-40-px d-flex align-items-center session_special">
                            <small
                                class="btn btn-primary-600 radius-48 fw-bold d-inline-flex align-items-center gap-1 px-1 px-md-2 py-1">

                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:24px;height:24px;flex-shrink:0;">
                                    <i class="ri-calendar-check-line text-primary-600 fw-semibold small"></i>
                                </div>

                                <span class="fs-7 fs-md-6 pe-1 pe-md-4 me-0 me-md-2">
                                    {{ activeSession()->name ?? '2026-2027' }}
                                </span>

                            </small>

                        </div>




                        <button type="button"
                            class="w-40-px h-40-px bg-danger-100 rounded-circle d-flex justify-content-center align-items-center border border-danger-600 shadow-sm video-btn-hover"
                            aria-label="Play Video" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <iconify-icon icon="ph:play-circle-fill" class="text-danger-600 text-2xl"></iconify-icon>
                        </button>

                        <button type="button" data-theme-toggle
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            aria-label="Dark & Light Mode Button"></button>

                        <!-- Language dropdown end -->
                        <button
                            class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center position-relative"
                            type="button">
                            <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                            <span
                                class="w-8-px h-8-px bg-danger-600 position-absolute end-0 top-0 rounded-circle mt-2 me-2"></span>
                        </button>


                        <div class="dropdown">

                            <button
                                class="has-indicator w-45-px h-45-px bg-primary-50 rounded-circle d-flex justify-content-center align-items-center position-relative border border-primary-100 shadow-sm p-6"
                                type="button" data-bs-toggle="dropdown" aria-label="Settings Button">
                                <iconify-icon icon="solar:settings-bold-duotone"
                                    class="text-primary-600 text-2xl"></iconify-icon>

                            </button>

                            <!-- Dropdown -->
                            <div
                                class="dropdown-menu dropdown-menu-end to-top dropdown-menu-lg p-0 overflow-hidden border-0 shadow-lg radius-12 ">

                                <!-- Session Select -->
                                <div class="p-20 border-bottom">

                                    <label class="form-label fw-semibold text-dark mb-10">
                                        Select Session
                                    </label>

                                    <form action="{{ route('school.sessions.change') }}" method="POST"
                                        id="sessionForm">
                                        @csrf
                                        <select class="form-select radius-8 h-50-px" id="sessionSelect"
                                            name="session_id">
                                        </select>
                                    </form>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-10">

                                    <!-- Profile -->
                                    <a href="{{ route('school.update.details') }}"
                                        class="dropdown-item px-20 py-14 d-flex align-items-center gap-3 hover-bg-primary-50">

                                        <span
                                            class="w-42-px h-42-px rounded-circle bg-info-100 text-info-600 d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="solar:user-bold-duotone"
                                                class="text-xl"></iconify-icon>
                                        </span>

                                        <div>
                                            <h6 class="mb-1 text-md fw-semibold">Profile</h6>
                                            <p class="mb-0 text-sm text-secondary-light">
                                                Manage your account profile
                                            </p>
                                        </div>
                                    </a>

                                    <!-- Logout -->
                                    <a href="{{ route('logout') }}"
                                        class="dropdown-item px-20 py-14 d-flex align-items-center gap-3 hover-bg-danger-50">

                                        <span
                                            class="w-42-px h-42-px rounded-circle bg-danger-100 text-danger-600 d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="solar:logout-3-bold-duotone"
                                                class="text-xl"></iconify-icon>
                                        </span>

                                        <div>
                                            <h6 class="mb-1 text-md fw-semibold">Logout</h6>
                                            <p class="mb-0 text-sm text-secondary-light">
                                                Securely sign out account
                                            </p>
                                        </div>
                                    </a>


                                </div>
                            </div>
                        </div>

                        <button type="button"
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center border border-primary-600 "
                            aria-label="Refresh Page" onclick="window.location.reload();">
                            <iconify-icon icon="heroicons-outline:refresh"
                                class="text-primary-600 text-xl"></iconify-icon>
                        </button>


                        <!-- Notification dropdown end -->
                    </div>
                </div>
            </div>
        </div>


        <style>
            @media (max-width: 768px) {

                .navbar-header {
                    z-index: 999;
                }

                .navbar-header .row {
                    flex-wrap: nowrap;
                }

                /* Left Side */
                .navbar-header .col-auto:first-child {
                    flex: 0 0 auto;
                }

                /* Right Side */
                .navbar-header .col-auto:last-child {
                    flex: 1;
                    overflow-x: auto;
                }

                .navbar-header .col-auto:last-child .d-flex {
                    flex-wrap: nowrap !important;
                    justify-content: flex-end;
                    gap: 6px !important;
                }

                /* Session Button */
                .navbar-header .btn-primary-600.radius-48 {
                    padding: 2px 8px !important;
                    font-size: 11px !important;
                }

                .navbar-header .btn-primary-600.radius-48 div {
                    width: 22px !important;
                    height: 22px !important;
                }

                /* All round buttons */
                .navbar-header .w-40-px,
                .navbar-header .h-40-px {
                    width: 32px !important;
                    height: 32px !important;
                }

                .navbar-header .w-45-px,
                .navbar-header .h-45-px {
                    width: 34px !important;
                    height: 34px !important;
                }

                .navbar-header iconify-icon {
                    font-size: 16px !important;
                }

                .navbar-search {
                    display: none;
                }

                .session_special {
                    height: auto !important;
                }

                .navbar-header .btn-primary-600.radius-48 {
                    min-height: 34px !important;
                    padding: 4px 10px !important;
                    line-height: 1 !important;
                    white-space: nowrap !important;
                    display: flex !important;
                    align-items: center !important;
                }

                .navbar-header .btn-primary-600.radius-48 span {
                    white-space: nowrap !important;
                    font-size: 11px !important;
                    line-height: 1 !important;
                    padding-right: 0 !important;
                    margin-right: 0 !important;
                }

                .navbar-header .btn-primary-600.radius-48>div {
                    width: 22px !important;
                    height: 22px !important;
                    flex-shrink: 0;
                }

                .navbar-header .col-auto:last-child {
                    overflow: visible !important;
                }


                .dropdown-menu {
                    z-index: 99999 !important;
                }


            }
        </style>
