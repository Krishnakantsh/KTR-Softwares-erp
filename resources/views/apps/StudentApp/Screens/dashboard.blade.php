@extends('apps.StudentApp.Layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="relative min-h-screen bg-[#F5F7FF] overflow-x-hidden pb-28">

        {{-- ================= HEADER ================= --}}

        <div class="bg-gradient-to-b from-[#6D3CFF] via-[#5B34E6] to-[#F5F7FF] rounded-b-[40px] pb-24">

            <div class="max-w-md mx-auto px-3 pt-[max(env(safe-area-inset-top),18px)]">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <img src="{{ asset($student?->student_photo) ?? 'https://i.pinimg.com/736x/43/30/bb/4330bb454180f4806479d71c4e86bd54.jpg' }} "
                            class="w-14 h-14 rounded-full border-2 border-white object-top object-cover">

                        <div>

                            <h3 class="text-white text-lg font-bold">
                                Hello, {{ $student?->first_name ?? 'KTR ERP' }} {{ $student?->last_name ?? '' }}
                            </h3>

                            <p class="text-purple-100 text-sm">

                                Good Morning, Keep Learning

                            </p>

                        </div>

                    </div>

                    <div class="relative">

                        <button
                            class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-xl border border-white/20 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032
                                                                        2.032 0 0118
                                                                        14.158V11a6.002
                                                                        6.002 0
                                                                        00-4-5.659V5a2
                                                                        2 0
                                                                        10-4
                                                                        0v.341C7.67
                                                                        6.165 6
                                                                        8.388 6
                                                                        11v3.159c0
                                                                        .538-.214
                                                                        1.055-.595
                                                                        1.436L4
                                                                        17h5m6
                                                                        0v1a3
                                                                        3 0
                                                                        11-6
                                                                        0v-1m6
                                                                        0H9" />

                            </svg>

                        </button>

                        <span
                            class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center">

                            5

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================= CONTENT ================= --}}

        <div class="max-w-md mx-auto px-3 -mt-20">

            {{-- ================= SCHOOL CARD ================= --}}

            <div class="rounded-[26px] bg-white shadow-xl border border-slate-100 p-3">

                <div class="flex items-start">

                    <img src="{{ asset('app/app_logo.png') }}" class="w-12">

                    <div class="ml-1 flex-1">

                        <h3 class="font-bold text-slate-800">

                            {{ currentSchool()->name ?? ' ' }}

                        </h3>

                        <p class="text-sm text-slate-500 mt-1">

                            Session : {{ activeSession()->name ?? now()->getYear }}

                        </p>

                        <p class="text-sm text-slate-500">

                            Class 10-A

                        </p>

                    </div>

                    <div>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- ================= HERO SLIDER ================= --}}

            <div
                class="mt-6 rounded-[30px] overflow-hidden bg-gradient-to-br from-[#26106D] via-[#4320C4] to-[#6A3CFF] relative shadow-2xl">

                <div class="absolute w-48 h-48 rounded-full bg-purple-400/20 blur-3xl -right-10 -top-10">
                </div>

                <div class="relative p-6">
                    <h2 class="text-white text-[24px] font-black leading-tight">

                        Excellence Today.

                    </h2>

                    <div class="flex items-center">

                        <div class="flex-1">



                            <p class="text-purple-100 mt-3 leading-6">

                                Learn today.

                                <br>

                                Lead tomorrow.

                            </p>

                            <button class="mt-6 h-10 px-5 rounded-full text-[14px] bg-white text-[#5B34E6] font-bold">

                                View Timetable

                            </button>

                        </div>


                    </div>
                    <img src="{{ asset('app/banner_trophy.png') }}" class="w-64 absolute -bottom-8 -right-14">

                </div>

                <div class="flex justify-center gap-2 pb-5">

                    <span class="w-8 h-2 rounded-full bg-white"></span>

                    <span class="w-2 h-2 rounded-full bg-white/40"></span>

                    <span class="w-2 h-2 rounded-full bg-white/40"></span>

                </div>

            </div>

        </div>


        {{-- ================= QUICK ACCESS ================= --}}

        <div class="mt-8 px-3">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-xl font-bold text-slate-800">
                    Quick Access
                </h2>

                <a href="{{ route('app.student.quick.actions') }}" class="text-sm font-semibold text-violet-600">
                    View All →
                </a>

            </div>

            <div class="grid grid-cols-4 gap-4">

                {{-- Attendance --}}
                <a href="{{ route('app.student.attendance') }}" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">

                            <img src="{{ asset('app/attendance.png') }}" class="w-7">

                        </div>

                        <p class="mt-2 text-[10px] font-semibold text-slate-700">
                            Attendance
                        </p>

                    </div>

                </a>

                {{-- Homework --}}
                <a href="" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center">

                            <img src="{{ asset('app/homework.png') }}" class="w-7">

                        </div>

                        <p class="mt-2  text-[10px] font-semibold text-slate-700">
                            Homework
                        </p>

                    </div>

                </a>

                {{-- Time Table --}}
                <a href="{{ route('app.student.timetable') }}" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">

                            <img src="{{ asset('app/timetable.png') }}" class="w-7">

                        </div>

                        <p class="mt-2  text-[10px] font-semibold text-slate-700">
                            Time Table
                        </p>

                    </div>

                </a>

                {{-- Exam --}}
                <a href="" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                            <img src="{{ asset('app/exam.png') }}" class="w-7">

                        </div>

                        <p class="mt-2  text-[10px] font-semibold text-slate-700">
                            Exams
                        </p>

                    </div>

                </a>

                {{-- Fee --}}
                <a href="" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center">

                            <img src="{{ asset('app/fee.png') }}" class="w-7">

                        </div>

                        <p class="mt-2  text-[10px] font-semibold text-slate-700">
                            Fees
                        </p>

                    </div>

                </a>

                {{-- Study Material --}}
                <a href="" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-cyan-100 flex items-center justify-center">

                            <img src="{{ asset('app/library.png') }}" class="w-7">

                        </div>

                        <p class="mt-2 text-[10px] font-semibold text-slate-700">
                            Study
                        </p>

                    </div>

                </a>

                {{-- Notice --}}
                <a href="" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">

                            <img src="{{ asset('app/notice.png') }}" class="w-7">

                        </div>

                        <p class="mt-2 text-[12px] font-semibold text-slate-700">
                            Notice
                        </p>

                    </div>

                </a>

                {{-- More --}}
                <a href="" class="group">

                    <div
                        class="h-24 rounded-3xl bg-white shadow-lg border border-slate-100 flex flex-col items-center justify-center transition duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

                        <div
                            class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-2xl font-bold">

                            ⋯

                        </div>

                        <p class="mt-2 text-[12px] font-semibold text-slate-700">
                            More
                        </p>

                    </div>

                </a>

            </div>

        </div>



        {{-- ================= TODAY SCHEDULE ================= --}}

        <div class="mt-8 px-3">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-xl font-bold text-slate-800">

                    Today's Schedule

                </h2>

                <span class="px-4 py-2 rounded-full bg-violet-100 text-violet-700 text-xs font-bold">

                    04 Aug 2026

                </span>

            </div>

            <div class="rounded-[28px] bg-white shadow-xl border border-slate-100 overflow-hidden">

                {{-- Period --}}

                <div class="flex items-center p-5 border-b">

                    <div
                        class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center font-bold text-violet-700">

                        1

                    </div>

                    <div class="ml-4 flex-1">

                        <h3 class="font-bold text-slate-800">

                            Mathematics

                        </h3>

                        <p class="text-sm text-slate-500">

                            Room No. 201

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold">

                            08:00

                        </p>

                        <p class="text-xs text-slate-500">

                            08:45

                        </p>

                    </div>

                </div>

                {{-- Period --}}

                <div class="flex items-center p-5 border-b">

                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-100 flex items-center justify-center font-bold text-cyan-700">

                        2

                    </div>

                    <div class="ml-4 flex-1">

                        <h3 class="font-bold text-slate-800">

                            Science

                        </h3>

                        <p class="text-sm text-slate-500">

                            Room No. 205

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold">

                            08:45

                        </p>

                        <p class="text-xs text-slate-500">

                            09:30

                        </p>

                    </div>

                </div>

                {{-- Period --}}

                <div class="flex items-center p-5">

                    <div
                        class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center font-bold text-pink-700">

                        3

                    </div>

                    <div class="ml-4 flex-1">

                        <h3 class="font-bold text-slate-800">

                            English

                        </h3>

                        <p class="text-sm text-slate-500">

                            Room No. 104

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold">

                            09:30

                        </p>

                        <p class="text-xs text-slate-500">

                            10:15

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================= HOMEWORK ================= --}}

        <div class="mt-8 px-3">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-xl font-bold text-slate-800">
                    Pending Homework
                </h2>

                <a href="" class="text-violet-600 font-semibold text-sm">

                    View All →

                </a>

            </div>

            <div class="space-y-4">

                {{-- Homework 1 --}}

                <div class="rounded-[26px] bg-white shadow-xl border border-slate-100 p-5">

                    <div class="flex">

                        <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">

                            <img src="{{ asset('app/homework.png') }}" class="w-7">

                        </div>

                        <div class="ml-4 flex-1">

                            <div class="flex justify-between">

                                <h3 class="font-bold text-slate-800">

                                    Mathematics

                                </h3>

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-bold">

                                    Today

                                </span>

                            </div>

                            <p class="text-sm text-slate-500 mt-2">

                                Chapter 8 Exercise 8.1

                            </p>

                            <p class="text-xs text-slate-400 mt-2">

                                Submitted : No

                            </p>

                        </div>

                    </div>

                </div>

                {{-- Homework 2 --}}

                <div class="rounded-[26px] bg-white shadow-xl border border-slate-100 p-5">

                    <div class="flex">

                        <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                            📖

                        </div>

                        <div class="ml-4 flex-1">

                            <div class="flex justify-between">

                                <h3 class="font-bold">

                                    English

                                </h3>

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">

                                    Tomorrow

                                </span>

                            </div>

                            <p class="text-sm text-slate-500 mt-2">

                                Read Chapter 5

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ================= FEE CARD ================= --}}

        <div class="mt-8 px-3">

            <div
                class="rounded-[30px] overflow-hidden bg-gradient-to-r from-red-500 via-pink-500 to-orange-400 shadow-2xl">

                <div class="p-6 text-white">

                    <div class="flex justify-between items-center">

                        <div>

                            <p class="text-red-100">

                                Pending Fee

                            </p>

                            <h2 class="text-4xl font-black mt-1">

                                ₹12,500

                            </h2>

                        </div>

                        <div class="text-6xl">

                            💳

                        </div>

                    </div>

                    <div class="flex justify-between items-center mt-6">

                        <div>

                            <p class="text-red-100 text-sm">

                                Due Date

                            </p>

                            <p class="font-bold">

                                10 Aug 2026

                            </p>

                        </div>

                        <button class="px-6 h-11 rounded-full bg-white text-red-600 font-bold">

                            Pay Now

                        </button>

                    </div>

                </div>

            </div>

        </div>



        {{-- ================= UPCOMING EXAMS ================= --}}

        <div class="mt-8 px-3">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-bold text-slate-800">

                    Upcoming Exams

                </h2>

                <a href="" class="text-violet-600 font-semibold text-sm">

                    View All →

                </a>

            </div>

            <div class="rounded-[28px] bg-white shadow-xl border border-slate-100 p-5">

                <div class="flex items-center">

                    <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center">

                        📝

                    </div>

                    <div class="ml-4 flex-1">

                        <h3 class="font-bold">

                            Science Test

                        </h3>

                        <p class="text-sm text-slate-500">

                            12 Aug 2026 • 09:00 AM

                        </p>

                    </div>

                    <span class="px-3 py-2 rounded-xl bg-violet-100 text-violet-700 text-xs font-bold">

                        8 Days

                    </span>

                </div>

            </div>

        </div>



        {{-- ================= NOTICE BOARD ================= --}}

        <div class="mt-8 px-3">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-bold">

                    Notice Board

                </h2>

                <a href="" class="text-violet-600 font-semibold text-sm">

                    View All →

                </a>

            </div>

            <div class="space-y-4">

                <div class="rounded-[24px] bg-white shadow-lg border border-slate-100 p-5">

                    <h3 class="font-bold">

                        Independence Day Celebration

                    </h3>

                    <p class="text-sm text-slate-500 mt-2">

                        All students must wear white uniform on 15 August.

                    </p>

                </div>

                <div class="rounded-[24px] bg-white shadow-lg border border-slate-100 p-5">

                    <h3 class="font-bold">

                        PTM Notice

                    </h3>

                    <p class="text-sm text-slate-500 mt-2">

                        Parent Teacher Meeting on 18 August.

                    </p>

                </div>

            </div>

        </div>



        {{-- ================= LATEST NEWS ================= --}}

        <div class="mt-8 px-3">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-bold">

                    Latest News

                </h2>

                <a href="" class="text-violet-600 font-semibold text-sm">

                    View All →

                </a>

            </div>

            <div class="rounded-[28px] bg-gradient-to-r from-[#4F46E5] to-[#7C3AED] p-6 text-white shadow-2xl">

                <h3 class="font-bold text-xl">

                    🎉 Annual Sports Meet

                </h3>

                <p class="mt-3 text-white/90 leading-7">

                    Registration has started for Annual Sports Competition.
                    Participate and win exciting prizes.

                </p>

                <button class="mt-5 px-6 h-11 rounded-full bg-white text-violet-700 font-bold">

                    Read More

                </button>

            </div>

        </div>


    </div>

@endsection
