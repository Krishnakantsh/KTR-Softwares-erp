@extends('apps.StudentApp.Layouts.app')

@section('title', 'KTR Student App')

@section('content')

    <div class="relative h-screen overflow-hidden bg-[#09051F]">

        {{-- Background --}}
        <img src="{{ asset('app/app_bg.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-b from-[#09051F]/10 via-transparent to-[#09051F]/70"></div>

        <div
            class="relative z-20 h-full max-w-md mx-auto px-6 flex flex-col justify-between pt-[max(env(safe-area-inset-top),20px)] pb-[max(env(safe-area-inset-bottom),20px)]">

            {{-- ================= LOGO ================= --}}
            <div class="text-center flex-shrink-0 mt-3">

                <img src="{{ asset('app/app_logo.png') }}" class="w-20 sm:w-20 mx-auto drop-shadow-2xl">

                <h1 class="mt-3 text-4xl sm:text-5xl font-black tracking-wider text-white">
                    KTR ERP
                </h1>

                <p class="mt-2 text-sm sm:text-base text-white/70">
                    Learn • Grow • Succeed
                </p>

            </div>

            {{-- ================= STUDENT ================= --}}
            <div class="flex-1 flex items-center justify-center py-2">

                <div class="relative w-full h-full max-h-[45vh]">

                    {{-- Attendance --}}
                    <div
                        class="absolute left-0 top-6 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-pink-500/20 backdrop-blur-xl border border-white/10 shadow-xl animate-bounce">

                        <img src="{{ asset('app/attendance.png') }}" class="p-2">

                    </div>

                    {{-- Homework --}}
                    <div
                        class="absolute right-1 top-2 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-500/20 backdrop-blur-xl border border-white/10 shadow-xl animate-pulse">

                        <img src="{{ asset('app/homework.png') }}" class="p-2">

                    </div>

                    {{-- Library --}}
                    <div
                        class="absolute left-8 bottom-28 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-cyan-500/20 backdrop-blur-xl border border-white/10 shadow-xl animate-bounce">

                        <img src="{{ asset('app/library.png') }}" class="p-2">

                    </div>

                    {{-- Exam --}}
                    <div
                        class="absolute right-2 bottom-28 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-orange-500/20 backdrop-blur-xl border border-white/10 shadow-xl animate-pulse">

                        <img src="{{ asset('app/exam.png') }}" class="p-2">

                    </div>

                    {{-- Result --}}
                    <div
                        class="absolute left-5 top-64 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-violet-500/20 backdrop-blur-xl border border-white/10 shadow-xl animate-pulse">

                        <img src="{{ asset('app/result.png') }}" class="p-2">

                    </div>

                    {{-- Platform --}}
                    {{-- <img src="{{ asset('app/platform.png') }}"
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-64 sm:w-72 md:w-80 z-10"> --}}

                    {{-- Student --}}
                    <img src="{{ asset('app/app_student.png') }}" fetchpriority="high" loading="eager" decoding="async"
                        class="absolute top-20 left-1/2 -translate-x-1/2 w-40 sm:w-80 md:w-50 lg:w-45 object-contain z-20 drop-shadow-[0_20px_45px_rgba(0,0,0,.6)]">

                </div>

            </div>

            {{-- ================= BOTTOM ================= --}}
            <div class="flex-shrink-0 z-40">

                {{-- <h2 class="text-center text-2xl sm:text-3xl font-bold text-white">
                Your Journey
            </h2> --}}

                <p class="mt-4 text-center text-sm sm:text-base text-white/70 leading-6">
                    Excellence Starts Here ✨
                </p>

                <a href="{{ route('app.login') }}"
                    class="mt-2 h-12 sm:h-14 rounded-full bg-gradient-to-r from-violet-600 via-purple-500 to-indigo-500 flex items-center justify-center font-bold text-base sm:text-lg text-white shadow-[0_10px_35px_rgba(124,58,237,.45)] active:scale-95 transition-all">

                    Get Started

                </a>

                <div class="flex justify-center gap-2 mt-5">

                    <span class="w-8 h-2 rounded-full bg-violet-500"></span>

                    <span class="w-2 h-2 rounded-full bg-white/30"></span>

                    <span class="w-2 h-2 rounded-full bg-white/30"></span>

                </div>

            </div>

        </div>

    </div>

@endsection
