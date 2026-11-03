@extends('School.Layout.main')

@section('title', 'KTR ERP : Complaint Dashboard')

@section('dynamic-content')
    <div class="dashboard-main-body py-24 px-16">


        <div class="row gy-4">


            <div class="col-xxl-12">
                <div class="card">
                    <div
                        class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                        <div class="d-flex flex-column">

                            <h6 class="mb-2 fw-bold text-lg">Complaint Dashboard</h6>

                            <p class="text-secondary-light mb-0">

                                Welcome back 👋 Monitor complaints, resolutions and activities.

                            </p>


                        </div>
                    </div>
                    <div class="bg-base rounded-3 p-20">
                        <div class="row g-3">

                            <!-- Total Complaints -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-12">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-file-warning-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Total
                                                        Complaints</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0">154</h6>
                                            <p class="text-sm mb-0 mt-1">
                                                <span class="badge bg-success">+12%</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Open -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-13">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-warning-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-error-warning-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Open</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-warning">21</h6>
                                            <p class="text-sm mb-0 mt-1">Waiting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- In Progress -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-14">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-info flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-loader-4-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">In Progress</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-info">09</h6>
                                            <p class="text-sm mb-0 mt-1">Investigating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Resolved -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-15">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-success flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-checkbox-circle-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Resolved</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-success">104</h6>
                                            <p class="text-sm mb-0 mt-1">Completed</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Closed -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-10">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-dark flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-lock-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Closed</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0">20</h6>
                                            <p class="text-sm mb-0 mt-1">Archived</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Critical -->
                            <div class="col-xxl-2 col-sm-6">
                                <div class="card p-3 shadow-2 radius-8 h-100 border gradient-bg-end-11">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="mb-0 w-48-px h-48-px bg-danger flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <i class="ri-alarm-warning-line fs-3 text-white"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-medium text-primary-light text-md">Critical</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="fw-semibold mb-0 text-danger">04</h6>
                                            <p class="text-sm mb-0 mt-1">Immediate Action</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>


        <div class="mt-24">
            <div class="row gy-4">


                <!-- Recent Enrolled Courses Start -->
                <div class="col-xxl-8">
                    <div class="card radius-12 border-0">
                        <div
                            class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                            <h6 class="mb-2 fw-bold text-lg">Recent Enrolled Courses</h6>
                            <div class="dropdown">

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0 p-8 rounded-0 border-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-neutral-100 rounded-0">S. No.</th>
                                            <th scope="col" class="bg-neutral-100 rounded-0">Subject</th>
                                            <th scope="col" class="bg-neutral-100 rounded-0">Against</th>
                                            <th scope="col" class="bg-neutral-100 rounded-0">Raised By</th>
                                            <th scope="col" class="bg-neutral-100 rounded-0">Date</th>
                                        </tr>


                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#829776</td>
                                            <td>John Doe</td>
                                            <td>Scorm drawing course</td>

                                            <td>PayPal</td>
                                            <td>04 Feb, 2025</td>
                                        </tr>
                                        <tr>
                                            <td>#829776</td>
                                            <td>John Doe</td>
                                            <td>Scorm drawing course</td>

                                            <td>PayPal</td>
                                            <td>04 Feb, 2025</td>
                                        </tr>
                                        <tr>
                                            <td>#829776</td>
                                            <td>John Doe</td>
                                            <td>Scorm drawing course</td>

                                            <td>PayPal</td>
                                            <td>04 Feb, 2025</td>
                                        </tr>
                                        <tr>
                                            <td>#829776</td>
                                            <td>John Doe</td>
                                            <td>Scorm drawing course</td>

                                            <td>PayPal</td>
                                            <td>04 Feb, 2025</td>
                                        </tr>
                                        <tr>
                                            <td>#829776</td>
                                            <td>John Doe</td>
                                            <td>Scorm drawing course</td>

                                            <td>PayPal</td>
                                            <td>04 Feb, 2025</td>
                                        </tr>
                                        <tr>
                                            <td>#829776</td>
                                            <td>John Doe</td>
                                            <td>Scorm drawing course</td>

                                            <td>PayPal</td>
                                            <td>04 Feb, 2025</td>
                                        </tr>


                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recent Enrolled Courses End -->


                <!-- Quick Actions -->
                <div class="col-xxl-4">

                    @include('School.Pages.Complaints.components.complaint-quick-actions')
                    
                </div>

                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100">
                        <div class="card-header p-0">
                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between px-20 py-16 border-bottom border-neutral-200">
                                <h6 class="text-lg mb-0">Complaint Status</h6>

                            </div>


                        </div>
                        <div class="card-body">

                            <div id="complaintStatusChart"></div>

                        </div>

                    </div>
                </div>
                <div class="col-xxl-8 col-lg-6">
                    <div class="card border-0 ">
                        <div class="card-header p-0">
                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between px-20 py-16 border-bottom border-neutral-200">
                                <h6 class="text-lg mb-0">Monthly Complaint Trend</h6>

                            </div>


                        </div>

                        <div class="card-body">

                            <div id="monthlyComplaintChart"></div>

                        </div>

                    </div>
                </div>


                <div class="col-xxl-8 col-lg-6">
                    <div class="card border-0 ">
                        <div class="card-header p-0">
                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between px-20 py-16 border-bottom border-neutral-200">
                                <h6 class="text-lg mb-0">Priority Distribution</h6>

                            </div>


                        </div>

                        <div class="card-body">

                            <div id="priorityChart"></div>

                        </div>

                    </div>
                </div>


                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100">
                        <div class="card-header p-0">
                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between px-20 py-16 border-bottom border-neutral-200">
                                <h6 class="text-lg mb-0"> Complaint Type Wise</h6>
                            </div>
                        </div>
                        <div class="card-body">

                            <div id="complaintTypeChart"></div>

                        </div>

                    </div>
                </div>


            </div>
        </div>




    </div>
@endsection

@push('script')
    <script>
        $(function() {

            /*
            |--------------------------------------------------------------------------
            | Complaint Status Donut
            |--------------------------------------------------------------------------
            */

            var statusOptions = {

                series: [21, 9, 104, 20],

                chart: {
                    type: 'donut',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },

                labels: [
                    'Open',
                    'In Progress',
                    'Resolved',
                    'Closed'
                ],

                colors: [
                    '#f59e0b',
                    '#3b82f6',
                    '#22c55e',
                    '#6b7280'
                ],

                legend: {
                    position: 'bottom'
                },

                dataLabels: {
                    enabled: false
                },

                stroke: {
                    width: 0
                },

                plotOptions: {

                    pie: {

                        donut: {

                            size: '72%',

                            labels: {

                                show: true,

                                total: {

                                    show: true,

                                    label: 'Total',

                                    formatter: function() {

                                        return 154;

                                    }

                                }

                            }

                        }

                    }

                }

            };

            new ApexCharts(
                document.querySelector("#complaintStatusChart"),
                statusOptions
            ).render();




            /*
            |--------------------------------------------------------------------------
            | Monthly Complaint Trend
            |--------------------------------------------------------------------------
            */

            var monthlyOptions = {

                series: [{

                    name: 'Complaints',

                    data: [12, 18, 15, 25, 20, 32, 28, 36, 31, 24, 18, 27]

                }],

                chart: {

                    type: 'area',

                    height: 320,

                    toolbar: {

                        show: false

                    },

                    zoom: {

                        enabled: false

                    }

                },

                stroke: {

                    curve: 'smooth',

                    width: 4

                },

                fill: {

                    type: 'gradient',

                    gradient: {

                        shadeIntensity: 1,

                        opacityFrom: .45,

                        opacityTo: .05

                    }

                },

                colors: ['#4f46e5'],

                xaxis: {

                    categories: [
                        'Jan', 'Feb', 'Mar', 'Apr',
                        'May', 'Jun', 'Jul', 'Aug',
                        'Sep', 'Oct', 'Nov', 'Dec'
                    ]
                },

                dataLabels: {

                    enabled: false

                },

                grid: {

                    borderColor: '#f1f1f1'

                }

            };

            new ApexCharts(
                document.querySelector("#monthlyComplaintChart"),
                monthlyOptions
            ).render();



            /*
            |--------------------------------------------------------------------------
            | Complaint Type Pie
            |--------------------------------------------------------------------------
            */

            var typeOptions = {

                series: [42, 31, 18, 24, 12, 27],

                chart: {

                    type: 'pie',

                    height: 320

                },

                labels: [

                    'Behaviour',

                    'Fee',

                    'Transport',

                    'Discipline',

                    'Library',

                    'Hostel'

                ],

                legend: {

                    position: 'bottom'

                },

                colors: [

                    '#6366f1',

                    '#f59e0b',

                    '#10b981',

                    '#ef4444',

                    '#06b6d4',

                    '#8b5cf6'

                ],

                dataLabels: {

                    enabled: true

                }

            };

            new ApexCharts(

                document.querySelector("#complaintTypeChart"),

                typeOptions

            ).render();




            /*
            |--------------------------------------------------------------------------
            | Priority Distribution
            |--------------------------------------------------------------------------
            */

            var priorityOptions = {

                series: [{

                    name: 'Complaints',

                    data: [5, 18, 54, 77]

                }],

                chart: {

                    type: 'bar',

                    height: 320,

                    toolbar: {
                        show: false
                    }

                },

                plotOptions: {

                    bar: {

                        horizontal: true,

                        borderRadius: 8,

                        distributed: true

                    }

                },

                colors: [

                    '#ef4444',

                    '#f97316',

                    '#3b82f6',

                    '#22c55e'

                ],

                xaxis: {

                    categories: [

                        'Critical',

                        'High',

                        'Medium',

                        'Low'

                    ]

                },

                legend: {

                    show: false

                },

                dataLabels: {

                    enabled: true

                },

                grid: {

                    borderColor: '#f1f1f1'

                }

            };

            new ApexCharts(

                document.querySelector("#priorityChart"),

                priorityOptions

            ).render();

        });
    </script>
@endpush
