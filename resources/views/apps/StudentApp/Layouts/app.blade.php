<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KTR Student App')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets') }}/css/remixicon.css" />


    {{-- <script src="https://cdn.tailwindcss.com"></script>  --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/png" href="{{ asset('assets') }}/images/favicon.png" sizes="16x16" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/apexcharts.css" />
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/dataTables.min.css" />
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/flatpickr.min.css" />
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/full-calendar.css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/lib/calendar.css" />
   

</head>

<body>
    <div class="stage">

        <div class="phone">
            <div class="screen-root">

                {{-- 1. REUSABLE SIDEBAR DRAWER --}}
                {{-- @include('apps/StudentApp/Partials/sidebar') --}}

                {{-- 2. DYNAMIC PAGE CONTENT --}}
                <main class="view">
                    @yield('content')
                </main>

                {{-- 3. REUSABLE BOTTOM NAVIGATION --}}
                @unless (in_array(Route::currentRouteName(), [
                        'app.student.fees',
                        'app.student.profile',
                        'app.onboard',
                        'app.biometric.screen',
                        'app.login',
                        'app.withotp',
                        'app.student.fee_receipt',
                    ]))
                    @include('apps/StudentApp/Partials/bottom_nav')
                @endunless

            </div>
        </div>
    </div>

    <!-- jQuery (AJAX forms, toastr, sweetalert sab isi pe depend karte hain) -->
    <script src="{{ asset('assets') }}/js/lib/jquery-3.7.1.min.js"></script>

    <!-- Apex Chart JS -->
    <script src="{{ asset('assets') }}/js/lib/apexcharts.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        function showToast(type, message) {
            if (type === 'success') toastr.success(message);
            else if (type === 'error') toastr.error(message);
            else if (type === 'warning') toastr.warning(message);
            else toastr.info(message);
        }
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>

    
    @stack('script')
</body>

</html>
