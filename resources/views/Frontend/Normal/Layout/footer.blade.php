<footer class="d-footer">
    <div class="">
        <p class="mb-0 text-center"> &copy; <span class="current-year"></span> Made With ❤️ by KTR Soft Tech.</p>
    </div>
</footer>
</main>

<!-- Add sidebar start -->
<div
    class="my-sidebar bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">
    <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">
        <h5 class="text-lg mb-0 role_canvas_text"><span class="dynamic-text">Add New</span> Role</h5>
        <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">
            <i class="ri-close-large-line"></i>
        </button>
    </div>


    <form id="roleForm" class="d-flex flex-column p-20 ajaxForm" data-url="{{ route('add_role') }}"
        data-refresh="getRoles" data-method="POST">
        @csrf
        <input type="hidden" name="role_id" id="role_id" value="" class="hidden">
        <div class="row g-3">
            <div class="col-sm-12">
                <div class="">
                    <label for="roleName" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Role Name
                    </label>
                    <input type="text" class="form-control" id="roleName" name="role_name"
                        placeholder="Enter Role Name">
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-center justify-content-start gap-3 mt-8">
                    <button type="reset"
                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8">
                        Cancel
                    </button>
                    <button type="submit"
                        class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8 max-w-156-px w-100">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Add sidebar end -->

<!-- Add sidebar start -->
<div
    class="my-sidebar-permission bg-white position-fixed end-0 top-0 h-100vh overflow-y-auto z-99 max-w-500-px w-100 translate-x-full duration-300 active-translate-0">
    <div class="px-20 py-12 border-bottom d-flex align-items-center justify-content-between gap-20">
        <h5 class="text-lg mb-0 role_canvas_text"><span class="dynamic-text">Add New</span> Permission</h5>
        <button type="button" class="close-my-sidebar text-danger-600 text-lg d-flex">
            <i class="ri-close-large-line"></i>
        </button>
    </div>
    <form id="permissionForm" class="d-flex flex-column p-20 ajaxForm" data-url="{{ route('addPermissions') }}"
        data-refresh="getPermissions" data-method="POST">
        @csrf
        <input type="hidden" name="permission_id" id="permission_id" value="" class="hidden">
        <div class="row g-3">
            <div class="col-sm-12">
                <div class="">
                    <label for="roleName" class="text-sm fw-semibold text-primary-light d-inline-block mb-8">Permission
                        Name
                    </label>
                    <input type="text" class="form-control" id="permissionName" name="permission_name"
                        placeholder="Enter Permission Name">
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-center justify-content-start gap-3 mt-8">
                    <button type="reset"
                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8">
                        Cancel
                    </button>
                    <button type="submit"
                        class="btn btn-primary-600 border border-primary-600 text-md px-28 py-12 radius-8 max-w-156-px w-100">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Add sidebar end -->




<!-- Modal Delete Event start -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog modal-dialog-centered max-w-340-px">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-body pt-32 px-36 pb-24 text-center">
                <span class="mb-16 fs-1 line-height-1 text-danger">
                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                </span>
                <h6 class="text-lg fw-semibold text-primary-light mb-0">Are your sure you want to Suspend this teacher
                </h6>
                <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                    <button type="reset"
                        class="flex-grow-1 border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-24 py-11 radius-8"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button"
                        class="flex-grow-1 btn btn-primary-600 border border-primary-600 text-md px-16 py-12 radius-8">
                        Yes, Suspend
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete Event end -->


{{--  model for play youtube video  --}}

<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg"
            style="border-radius: 24px; overflow: hidden; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">

            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close bg-white rounded-circle p-2 shadow-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="ratio ratio-16x9 shadow-sm"
                    style="border-radius: 16px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                    <iframe src="https://www.youtube.com/embed/NiXyVMLH5GE?si=xHbBdn8F5f97l_bW"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>

                <div class="mt-4 px-4">

                    <p class="text-neutral-500 small  my-3 mt-4  d-flex align-items-center gap-2">
                        <iconify-icon icon="ph:info-bold"></iconify-icon>
                        Learn how to navigate the modern dashboard and emergency link features.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- jQuery library js -->
<script src="{{ asset('assets') }}/js/lib/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js -->
<script src="{{ asset('assets') }}/js/lib/bootstrap.bundle.min.js"></script>
<!-- Apex Chart js -->
<script src="{{ asset('assets') }}/js/lib/apexcharts.min.js"></script>
<!-- Iconify Font js -->
<script src="{{ asset('assets') }}/js/lib/iconify-icon.min.js"></script>
<!-- Data Table js -->
<script src="{{ asset('assets') }}/js/lib/dataTables.min.js"></script>

<!-- jQuery UI js -->
<script src="{{ asset('assets') }}/js/lib/jquery-ui.min.js"></script>

<!-- main js -->
<script src="{{ asset('assets') }}/js/app.js"></script>


{{--  script for open youtube video  --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videoModal = document.getElementById('videoModal');
        const iframe = videoModal.querySelector('iframe');
        const originalSrc = iframe.src;
        videoModal.addEventListener('hidden.bs.modal', function() {
            iframe.src = '';
            iframe.src = originalSrc;
        });
    });
</script>

<script>

    // Master Toggle Status Function

    function masterToggleStatus(id, route, refresh = null) {

        $.ajax({
            url: route,
            method: "POST",
            data: {
                id: id,
                _method: "PUT",
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
            },
            error: function(xhr) {
                console.log("Error Message From Backend :", res.responseText ||
                    "Something went wrong ");
            }

        });
    }
</script>


<script>
    // ============================ Revenue Statistics Chart start ===============================
    var options = {
        series: [{
                name: "Total Fee",
                data: [25, 35, 50, 60, 26, 20, 40, 20, 50, 16, 10, 40],
            },
            {
                name: "Collected Fee",
                data: [15, 16, 24, 30, 20, 15, 20, 10, 25, 10, 6, 20],
            },
        ],
        chart: {
            type: "bar",
            height: 250,
            stacked: true,
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: true,
            },
        },
        colors: ["#25A194", "#FF7A2C"],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                shape: "pyramid",
            },
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "June",
                "July",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return "$" + value + "k";
                },
                style: {
                    fontSize: "14px",
                },
            },
        },
        legend: {
            show: false,
        },
        fill: {
            opacity: 1,
        },
    };

    var chart = new ApexCharts(
        document.querySelector("#revenueStatistic"),
        options,
    );
    chart.render();
    // ============================ Revenue Statistics Chart End ===============================

    // ===================== Income Vs Expense Start ===============================
    function createChartThree(chartId, color1, color2) {
        var options = {
            series: [{
                    name: "Income",
                    data: [48, 35, 55, 32, 48, 30, 15, 50, 57],
                },
                {
                    name: "Expense",
                    data: [12, 20, 15, 26, 22, 60, 40, 32, 25],
                },
            ],
            legend: {
                show: false,
            },
            chart: {
                type: "area",
                width: "100%",
                height: 260,
                toolbar: {
                    show: false,
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "stepline",
                width: 2,
                colors: [color1, color2],
                lineCap: "round",
            },
            grid: {
                show: true,
                borderColor: "#D1D5DB",
                strokeDashArray: 1,
                position: "back",
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
                yaxis: {
                    lines: {
                        show: true,
                    },
                },
                row: {
                    colors: undefined,
                    opacity: 0.2,
                },
                column: {
                    colors: undefined,
                    opacity: 0.2,
                },
                padding: {
                    top: -20,
                    right: 0,
                    bottom: -10,
                    left: 0,
                },
            },
            colors: [color1, color2],
            markers: {
                colors: [color1, color2],
                strokeWidth: 1,
                size: 0,
                hover: {
                    size: 10,
                },
            },
            xaxis: {
                labels: {
                    show: false,
                },
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                tooltip: {
                    enabled: false,
                },
                labels: {
                    formatter: function(value) {
                        return value;
                    },
                    style: {
                        fontSize: "14px",
                    },
                },
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return "$" + value + "k";
                    },
                    style: {
                        fontSize: "14px",
                    },
                },
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "light",
                    type: "vertical",
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 100],
                },
            },
        };

        var chart = new ApexCharts(
            document.querySelector(`#${chartId}`),
            options,
        );
        chart.render();
    }

    createChartThree("incomeExpense", "#16a34a", "#FF9F29");
    // ===================== Income Vs Expense End ===============================

    // ================================ New Admissions Chart Start ================================
    var options = {
        series: [40, 87, 87, 30],
        colors: ["#0A51CE", "#25A194", "#FF7A2C", "#009F5E"],
        labels: ["Health", "Business", "Lifestyle", "Entertainment"],
        legend: {
            show: false,
        },
        chart: {
            type: "donut",
            height: 270,
            sparkline: {
                enabled: true, // Remove whitespace
            },
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
            },
        },
        stroke: {
            width: 2,
        },
        dataLabels: {
            enabled: false,
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200,
                },
                legend: {
                    position: "bottom",
                },
            },
        }, ],
    };

    var chart = new ApexCharts(
        document.querySelector("#newAdmissions"),
        options,
    );
    chart.render();
    // ================================ New Admissions Chart End ================================

    // ================================ Animated Radial Progress Bar Start ================================
    $("svg.radial-progress").each(function(index, value) {
        $(this).find($("circle.complete")).removeAttr("style");
    });

    // Activate progress animation on scroll
    $(window)
        .scroll(function() {
            $("svg.radial-progress").each(function(index, value) {
                // Trigger when the element is fully in the viewport
                if (
                    $(window).scrollTop() >=
                    $(this).offset().top - $(window).height() &&
                    $(window).scrollTop() <= $(this).offset().top + $(this).height()
                ) {
                    // Get percentage of progress
                    const percent = $(value).data("percentage");
                    // Get radius of the svg's circle.complete
                    const radius = $(this).find($("circle.complete")).attr("r");
                    // Get circumference (2πr)
                    const circumference = 2 * Math.PI * radius;
                    // Get stroke-dashoffset value based on the percentage of the circumference
                    const strokeDashOffset =
                        circumference - (percent * circumference) / 100;
                    // Transition progress for 1.25 seconds
                    $(this)
                        .find($("circle.complete"))
                        .animate({
                            "stroke-dashoffset": strokeDashOffset
                        }, 1250);
                }
            });
        })
        .trigger("scroll");
    // ================================ Animated Radial Progress Bar End ================================

    // ============================= Calendar Js Start =================================
    let display = document.querySelector(".display");
    let days = document.querySelector(".days");
    let previous = document.querySelector(".left");
    let next = document.querySelector(".right");

    let date = new Date();

    let year = date.getFullYear();
    let month = date.getMonth();

    function displayCalendar() {
        const firstDay = new Date(year, month, 1);

        const lastDay = new Date(year, month + 1, 0);

        const firstDayIndex = firstDay.getDay(); //4

        const numberOfDays = lastDay.getDate(); //31

        let formattedDate = date.toLocaleString("en-US", {
            month: "long",
            year: "numeric",
        });

        display.innerHTML = `${formattedDate}`;

        for (let x = 1; x <= firstDayIndex; x++) {
            const div = document.createElement("div");
            div.innerHTML += "";

            days.appendChild(div);
        }

        for (let i = 1; i <= numberOfDays; i++) {
            let div = document.createElement("div");
            let currentDate = new Date(year, month, i);

            div.dataset.date = currentDate.toDateString();

            div.innerHTML += i;
            days.appendChild(div);
            if (
                currentDate.getFullYear() === new Date().getFullYear() &&
                currentDate.getMonth() === new Date().getMonth() &&
                currentDate.getDate() === new Date().getDate()
            ) {
                div.classList.add("current-date");
            }
        }
    }

    // Call the function to display the calendar
    displayCalendar();

    previous.addEventListener("click", () => {
        days.innerHTML = "";

        if (month < 0) {
            month = 11;
            year = year - 1;
        }
        month = month - 1;
        date.setMonth(month);
        displayCalendar();
    });

    next.addEventListener("click", () => {
        days.innerHTML = "";

        if (month > 11) {
            month = 0;
            year = year + 1;
        }

        month = month + 1;
        date.setMonth(month);

        displayCalendar();
    });
    // ============================= Calendar Js End =================================
</script>

@include('Frontend/Normal/Admin_Pages/helper')
@include('Frontend/Normal/Admin_Pages/master')
@include('Frontend/Normal/Admin_Pages/models')

<script>
    $(document).on('click', '.my-sidebar-btn', function() {

        let $btn = $(this);

        // Text Change
        if ($btn.hasClass('add')) {
            $('.dynamic-text').text('Add New');
        }

        if ($btn.hasClass('edit')) {
            $('.dynamic-text').text('Update');
        }

        // Role Sidebar
        if ($btn.hasClass('role')) {
            $('.my-sidebar').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            $.ajax({
                url: "{{ route('getRoleById') }}",
                method: "GET",
                data: {
                    role_id: id
                },
                success: function(res) {
                    $('#roleName').val(res.data?.name);
                    $('#role_id').val(res.data?.id);
                }
            });
        }

        // Permission Sidebar
        if ($btn.hasClass('permission')) {
            $('.my-sidebar-permission').addClass('active');
            $('.overlay').addClass('active');

            let id = $btn.data('id');

            $.ajax({
                url: "{{ route('getpermissionById') }}",
                method: "GET",
                data: {
                    permission_id: id
                },
                success: function(res) {
                    $('#permissionName').val(res.data?.name);
                    $('#permission_id').val(res.data?.id);
                }
            });
        }

    });

    // ✅ Close Sidebar (ONLY ONCE BIND)
    $(document).on('click', '.close-my-sidebar, .overlay', function() {
        $('.my-sidebar').removeClass('active');

        $('.my-sidebar-permission').removeClass('active');
        $('.overlay').removeClass('active');
    });
</script>

<script>
    $(document).on('input', '.dt-search-input', function() {

        let wrapper = $(this).closest('.datatable-toolbar');
        let tableId = wrapper.data('table');

        let table = $('#' + tableId).DataTable();
        table.search(this.value).draw();
    });

    $(document).on('change', '.dt-length', function() {

        let wrapper = $(this).closest('.datatable-toolbar');
        let tableId = wrapper.data('table');

        let table = $('#' + tableId).DataTable();
        table.page.len($(this).val()).draw();
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };

    function showToast(type, message) {
        if (type === 'success') {
            toastr.success(message);
        } else if (type === 'error') {
            toastr.error(message);
        } else if (type === 'warning') {
            toastr.warning(message);
        } else {
            toastr.info(message);
        }
    }
</script>


@stack('script')

</body>


</html>
