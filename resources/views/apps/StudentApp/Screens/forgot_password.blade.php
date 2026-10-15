@extends('apps.StudentApp.Layouts.app')

@section('title', 'Forgot Password')

@section('content')

    <div class="relative h-screen overflow-hidden bg-[#09051F]">

        <img src="{{ asset('app/app_bg.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-[#09051F]/60 backdrop-blur-sm"></div>

        <div class="relative z-20 h-full max-w-md mx-auto px-6 flex flex-col">

            {{-- Back --}}

            <div class="pt-10">

                <a href="{{ route('app.login') }}"
                    class="w-8 h-8 rounded-full bg-white/10 backdrop-blur-xl border border-white/10 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                    </svg>

                </a>

            </div>


            {{-- Header --}}

            <div class="text-center mt-8">

                <img src="{{ asset('app/app_logo.png') }}" class="w-20 mx-auto">

                <h2 class="text-3xl font-black text-white mt-5">

                    Forgot Password

                </h2>

                <p class="text-white/70 mt-2">

                    Enter your Admission ID to receive an OTP.

                </p>

            </div>

            {{-- Card --}}

            <div class="mt-10 rounded-[30px] bg-white/10 backdrop-blur-xl border border-white/10 p-6">

                <label class="text-white/70">

                    Admission ID

                </label>

                <input type="text"
                    class="mt-2 w-full h-14 rounded-2xl bg-white/10 border border-white/10 px-5 text-white placeholder:text-gray-400"
                    placeholder="Enter Admission ID">

                <button
                    class="mt-8 w-full h-14 rounded-full bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold">

                    Send OTP

                </button>

            </div>

            <div class="mt-auto pb-6 text-center">

                <a href="{{ route('app.login') }}" class="text-violet-300 font-semibold">

                    Back to Login

                </a>

            </div>

        </div>

    </div>

@endsection
