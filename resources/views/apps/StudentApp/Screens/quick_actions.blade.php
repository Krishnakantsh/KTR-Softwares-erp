@extends('apps.StudentApp.Layouts.app')

@section('title', 'More Modules')

@section('content')

    <div class="relative min-h-screen bg-[#F5F7FF] overflow-x-hidden pb-24">

    
        {{-- ================= PREMIUM HEADER ================= --}}

        <div class="bg-gradient-to-b from-[#6D3CFF] via-[#5B34E6] to-[#F5F7FF] rounded-b-[40px] pb-20">

            <div class="max-w-md mx-auto px-5 pt-[max(env(safe-area-inset-top),18px)]">

                <div class="flex items-center">

                    <a href="{{ url()->previous() }}"
                        class="w-11 h-11 rounded-2xl bg-white/15 backdrop-blur-xl border border-white/20 flex items-center justify-center">

                        <i class="ri-arrow-left-s-line text-2xl text-white"></i>

                    </a>


                    <div class="ml-4">

                        <h2 class="text-2xl font-bold text-white">
                            More Modules
                        </h2>

                        <p class="text-purple-100 text-sm">
                            Explore all available services
                        </p>

                    </div>


                </div>


                {{-- Search --}}

                <div class="relative mt-6">


                    <div class="absolute inset-0 bg-white/20 backdrop-blur-xl rounded-2xl">
                    </div>


                    <i
                        class="ri-search-line absolute left-5 top-1/2 
            -translate-y-1/2 text-white/80 text-xl z-10"></i>


                    <input type="text" placeholder="Search Module..."
                        class="relative z-10 w-full h-14 rounded-2xl 
                bg-white/20 backdrop-blur-xl 
                border border-white/20
                pl-14 pr-5
                text-white
                placeholder:text-white/70
                focus:outline-none">


                </div>


            </div>

        </div>



        {{-- ================= CONTENT ================= --}}

        <div class="max-w-md mx-auto px-5 py-5">

            {{-- ================= ACADEMIC ================= --}}

            <div class="flex items-center mb-5">

                <div class="w-11 h-11 rounded-2xl bg-violet-100 flex items-center justify-center">

                    <i class="ri-graduation-cap-line text-violet-700 text-xl"></i>

                </div>

                <div class="ml-3">

                    <h3 class="font-bold text-lg text-slate-800">

                        Academic

                    </h3>

                    <p class="text-xs text-slate-500">

                        Daily academic activities

                    </p>

                </div>

            </div>



          <div class="grid grid-cols-2 gap-3">

                {{-- Attendance --}}

                <a href="{{route('app.student.attendance')}}" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                            <i class="ri-calendar-check-line text-2xl text-green-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Attendance

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Daily attendance report

                        </p>

                    </div>

                </a>



                {{-- Homework --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">

                            <i class="ri-book-open-line text-2xl text-orange-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Homework

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Pending & submitted work

                        </p>

                    </div>

                </a>

                {{-- Exams --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                            <i class="ri-file-list-3-line text-2xl text-blue-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Exams

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Exam schedule & details

                        </p>

                    </div>

                </a>



                {{-- Results --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                            <i class="ri-award-line text-2xl text-yellow-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Results

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Academic performance

                        </p>

                    </div>

                </a>

                {{-- Time Table --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center">

                            <i class="ri-time-line text-2xl text-violet-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Time Table

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Daily class schedule

                        </p>

                    </div>

                </a>






                {{-- Study Material --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                            <i class="ri-book-2-line text-2xl text-cyan-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Study Material

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Notes & PDF files

                        </p>

                    </div>

                </a>



                {{-- Assignment --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center">

                            <i class="ri-file-copy-2-line text-2xl text-pink-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Assignments

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Class assignments

                        </p>

                    </div>

                </a>



                {{-- Syllabus --}}

                <a href="#" class="group">

                    <div
                        class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                        <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">

                            <i class="ri-folder-chart-line text-2xl text-indigo-600"></i>

                        </div>

                        <h4 class="mt-4 font-bold text-slate-800">

                            Syllabus

                        </h4>

                        <p class="text-xs text-slate-500 mt-1">

                            Complete syllabus

                        </p>

                    </div>

                </a>

            </div>




            {{-- ================= SCHOOL SERVICES ================= --}}

            <div class="mt-10">

                <div class="flex items-center mb-5">

                    <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center">
                        <i class="ri-school-line text-xl text-blue-600"></i>
                    </div>

                    <div class="ml-3">

                        <h3 class="text-lg font-bold text-slate-800">
                            School Services
                        </h3>

                        <p class="text-xs text-slate-500">
                            School related modules
                        </p>

                    </div>

                </div>


               <div class="grid grid-cols-2 gap-3">

                    {{-- Fee Details --}}
                    <a href="{{route('app.student.fees')}}" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">

                                <i class="ri-wallet-3-line text-2xl text-emerald-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold text-slate-800">
                                Fee Details
                            </h4>

                            <p class="mt-1 text-xs text-slate-500">
                                View fee status
                            </p>

                        </div>

                    </a>



                    {{-- Fee Receipt --}}

                    <a href="{{route('app.student.fee_receipt')}}" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                                <i class="ri-receipt-line text-2xl text-green-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">
                                Fee Receipt
                            </h4>

                            <p class="mt-1 text-xs text-slate-500">
                                Download receipts
                            </p>

                        </div>

                    </a>



                    {{-- Leave Request --}}

                    <a href="{{route('app.student.leave')}}" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                                <i class="ri-mail-open-line text-2xl text-yellow-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">

                                Leave Request

                            </h4>

                            <p class="mt-1 text-xs text-slate-500">

                                Apply leave

                            </p>

                        </div>

                    </a>



                    {{-- Gate Pass --}}

                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                                <i class="ri-door-open-line text-2xl text-cyan-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">

                                Gate Pass

                            </h4>

                            <p class="mt-1 text-xs text-slate-500">

                                Exit permissions

                            </p>

                        </div>

                    </a>



                    {{-- Complaint --}}

                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                                <i class="ri-customer-service-2-line text-2xl text-red-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">

                                Complaint

                            </h4>

                            <p class="mt-1 text-xs text-slate-500">

                                Raise complaint

                            </p>

                        </div>

                    </a>



                    {{-- Notice Board --}}

                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center">

                                <i class="ri-notification-3-line text-2xl text-violet-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">

                                Notice Board

                            </h4>

                            <p class="mt-1 text-xs text-slate-500">

                                School notices

                            </p>

                        </div>

                    </a>



                    {{-- News --}}

                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center">

                                <i class="ri-newspaper-line text-2xl text-pink-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">

                                News

                            </h4>

                            <p class="mt-1 text-xs text-slate-500">

                                Latest updates

                            </p>

                        </div>

                    </a>



                    {{-- Events --}}

                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white border border-slate-100 shadow-lg p-4 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">

                                <i class="ri-calendar-event-line text-2xl text-orange-600"></i>

                            </div>

                            <h4 class="mt-4 font-bold">

                                Events

                            </h4>

                            <p class="mt-1 text-xs text-slate-500">

                                School events

                            </p>

                        </div>

                    </a>

                </div>

            </div>



            {{-- ================= COMMUNICATION ================= --}}

            <div class="mt-10">

                <div class="flex items-center mb-5">

                    <div class="w-11 h-11 rounded-2xl bg-purple-100 flex items-center justify-center">

                        <i class="ri-message-3-line text-xl text-purple-600"></i>

                    </div>

                    <div class="ml-3">

                        <h3 class="text-lg font-bold text-slate-800">

                            Communication

                        </h3>

                        <p class="text-xs text-slate-500">

                            Stay connected

                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-2 gap-3">

                    {{-- SMS --}}
                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white shadow-lg border border-slate-100 p-5 transition hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                                <i class="ri-message-2-line text-blue-600 text-2xl"></i>

                            </div>

                            <h4 class="mt-4 font-bold">SMS</h4>

                            <p class="mt-1 text-xs text-slate-500">
                                School messages
                            </p>

                        </div>

                    </a>

                    {{-- Circular --}}
                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white shadow-lg border border-slate-100 p-5 transition hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">

                                <i class="ri-mail-send-line text-indigo-600 text-2xl"></i>

                            </div>

                            <h4 class="mt-4 font-bold">Circular</h4>

                            <p class="mt-1 text-xs text-slate-500">
                                Official circulars
                            </p>

                        </div>

                    </a>

                    {{-- Notifications --}}
                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white shadow-lg border border-slate-100 p-5 transition hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                                <i class="ri-notification-4-line text-red-600 text-2xl"></i>

                            </div>

                            <h4 class="mt-4 font-bold">Notifications</h4>

                            <p class="mt-1 text-xs text-slate-500">
                                Alerts & reminders
                            </p>

                        </div>

                    </a>

                    {{-- Chat --}}
                    <a href="#" class="group">

                        <div
                            class="rounded-[22px] bg-white shadow-lg border border-slate-100 p-5 transition hover:-translate-y-1 hover:shadow-2xl">

                            <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center">

                                <i class="ri-chat-3-line text-teal-600 text-2xl"></i>

                            </div>

                            <h4 class="mt-4 font-bold">Chat</h4>

                            <p class="mt-1 text-xs text-slate-500">
                                communication
                            </p>

                        </div>

                    </a>

                </div>

            </div>

            {{-- ================= SERVICES ================= --}}

            <div class="mt-10">

                <div class="flex items-center mb-5">

                    <div class="w-11 h-11 rounded-2xl bg-cyan-100 flex items-center justify-center">
                        <i class="ri-service-line text-cyan-600 text-xl"></i>
                    </div>

                    <div class="ml-3">

                        <h3 class="text-lg font-bold text-slate-800">
                            Services
                        </h3>

                        <p class="text-xs text-slate-500">
                            School facilities & resources
                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-2 gap-4">

                    {{-- Library --}}
                    <a href="#" class="group">
                        <div
                            class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">
                                <i class="ri-book-shelf-line text-2xl text-indigo-600"></i>
                            </div>
                            <h4 class="mt-4 font-bold">Library</h4>
                            <p class="mt-1 text-xs text-slate-500">Books & issued books</p>
                        </div>
                    </a>

                    {{-- Transport --}}
                    <a href="#" class="group">
                        <div
                            class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                                <i class="ri-bus-2-line text-2xl text-blue-600"></i>
                            </div>
                            <h4 class="mt-4 font-bold">Transport</h4>
                            <p class="mt-1 text-xs text-slate-500">Bus tracking & route</p>
                        </div>
                    </a>

                    {{-- Hostel --}}
                    <a href="#" class="group">
                        <div
                            class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">
                                <i class="ri-hotel-bed-line text-2xl text-orange-600"></i>
                            </div>
                            <h4 class="mt-4 font-bold">Hostel</h4>
                            <p class="mt-1 text-xs text-slate-500">Hostel information</p>
                        </div>
                    </a>

                    {{-- Calendar --}}
                    <a href="#" class="group">
                        <div
                            class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center">
                                <i class="ri-calendar-event-line text-2xl text-pink-600"></i>
                            </div>
                            <h4 class="mt-4 font-bold">Calendar</h4>
                            <p class="mt-1 text-xs text-slate-500">Academic calendar</p>
                        </div>
                    </a>

                    {{-- Holiday --}}
                    <a href="#" class="group">
                        <div
                            class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                                <i class="ri-calendar-close-line text-2xl text-green-600"></i>
                            </div>
                            <h4 class="mt-4 font-bold">Holiday</h4>
                            <p class="mt-1 text-xs text-slate-500">Holiday list</p>
                        </div>
                    </a>

                    {{-- Downloads --}}
                    <a href="#" class="group">
                        <div
                            class="rounded-[22px] bg-white p-5 shadow-lg border border-slate-100 transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center">
                                <i class="ri-download-cloud-2-line text-2xl text-violet-600"></i>
                            </div>
                            <h4 class="mt-4 font-bold">Downloads</h4>
                            <p class="mt-1 text-xs text-slate-500">PDF & documents</p>
                        </div>
                    </a>

                </div>

            </div>



            {{-- ================= ACCOUNT ================= --}}

            <div class="mt-10">

                <div class="flex items-center mb-5">

                    <div class="w-11 h-11 rounded-2xl bg-violet-100 flex items-center justify-center">
                        <i class="ri-user-settings-line text-violet-600 text-xl"></i>
                    </div>

                    <div class="ml-3">

                        <h3 class="text-lg font-bold text-slate-800">
                            Account & Settings
                        </h3>

                        <p class="text-xs text-slate-500">
                            Manage your account
                        </p>

                    </div>

                </div>

                <div class="space-y-4">

                    {{-- Profile --}}
                    <a href="{{route('app.student.profile')}}"
                        class="flex items-center bg-white rounded-3xl shadow-lg border border-slate-100 p-5 hover:shadow-xl">

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                            <i class="ri-user-3-line text-2xl text-blue-600"></i>
                        </div>

                        <div class="ml-4 flex-1">
                            <h4 class="font-bold">My Profile</h4>
                            <p class="text-xs text-slate-500">Student information</p>
                        </div>

                        <i class="ri-arrow-right-s-line text-xl text-slate-400"></i>

                    </a>

                    {{-- ID Card --}}
                    <a href="#"
                        class="flex items-center bg-white rounded-3xl shadow-lg border border-slate-100 p-5 hover:shadow-xl">

                        <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">
                            <i class="ri-id-card-line text-2xl text-cyan-600"></i>
                        </div>

                        <div class="ml-4 flex-1">
                            <h4 class="font-bold">Student ID Card</h4>
                            <p class="text-xs text-slate-500">Digital identity card</p>
                        </div>

                        <i class="ri-arrow-right-s-line text-xl text-slate-400"></i>

                    </a>

                    {{-- Settings --}}
                    <a href="#"
                        class="flex items-center bg-white rounded-3xl shadow-lg border border-slate-100 p-5 hover:shadow-xl">

                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                            <i class="ri-settings-3-line text-2xl text-slate-700"></i>
                        </div>

                        <div class="ml-4 flex-1">
                            <h4 class="font-bold">Settings</h4>
                            <p class="text-xs text-slate-500">App preferences</p>
                        </div>

                        <i class="ri-arrow-right-s-line text-xl text-slate-400"></i>

                    </a>

                    {{-- Help --}}
                    <a href="#"
                        class="flex items-center bg-white rounded-3xl shadow-lg border border-slate-100 p-5 hover:shadow-xl">

                        <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                            <i class="ri-question-line text-2xl text-yellow-600"></i>
                        </div>

                        <div class="ml-4 flex-1">
                            <h4 class="font-bold">Help & Support</h4>
                            <p class="text-xs text-slate-500">Need assistance?</p>
                        </div>

                        <i class="ri-arrow-right-s-line text-xl text-slate-400"></i>

                    </a>

                    {{-- About --}}
                    <a href="#"
                        class="flex items-center bg-white rounded-3xl shadow-lg border border-slate-100 p-5 hover:shadow-xl">

                        <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">
                            <i class="ri-information-line text-2xl text-indigo-600"></i>
                        </div>

                        <div class="ml-4 flex-1">
                            <h4 class="font-bold">About App</h4>
                            <p class="text-xs text-slate-500">Version & information</p>
                        </div>

                        <i class="ri-arrow-right-s-line text-xl text-slate-400"></i>

                    </a>

                </div>

            </div>



            {{-- ================= LOGOUT ================= --}}

            <div class="mt-10">

                <button
                    class="w-full h-16 rounded-3xl bg-gradient-to-r from-red-500 to-rose-600 text-white font-bold text-lg shadow-xl active:scale-95 transition">

                    <i class="ri-logout-circle-r-line mr-2 text-xl"></i>

                    Logout

                </button>

            </div>

        </div>

    </div>

@endsection
