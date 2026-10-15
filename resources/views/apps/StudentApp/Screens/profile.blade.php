@extends('apps.StudentApp.Layouts.app')

@section('title', 'Student Profile')

@section('content')

    <div class="relative min-h-screen bg-[#F5F7FF] overflow-x-hidden pb-8">

        {{-- ================= HEADER ================= --}}

        <div class="bg-gradient-to-b from-[#6D3CFF] via-[#5B34E6] to-[#F5F7FF] rounded-b-[40px] pb-24">

            <div class="max-w-md mx-auto px-3 pt-[max(env(safe-area-inset-top),18px)]">

                <div class="flex items-center justify-between">

                    <div class="flex items-center">

                        <a href="{{ url()->previous() }}"
                            class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-xl border border-white/20 flex items-center justify-center">

                            <i class="ri-arrow-left-s-line text-white text-2xl"></i>

                        </a>

                        <div class="ml-4">

                            <h2 class="text-2xl font-bold text-white">
                                My Profile
                            </h2>

                            <p class="text-purple-100 text-sm">
                                Student Information
                            </p>

                        </div>

                    </div>

                    <button
                        class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-xl border border-white/20 flex items-center justify-center">

                        <i class="ri-edit-2-line text-white text-xl"></i>

                    </button>

                </div>

            </div>

        </div>



        <div class="max-w-md mx-auto px-5 -mt-16">



            {{-- ================= PROFILE CARD ================= --}}

            <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 p-6">

                <div class="flex flex-col items-center">

                    <div class="relative">

                        <img src="https://i.pravatar.cc/250?img=12"
                            class="w-28 h-28 rounded-full object-cover border-[5px] border-violet-100 shadow-lg">

                        <div class="absolute bottom-1 right-1 w-7 h-7 rounded-full bg-green-500 border-4 border-white">
                        </div>

                    </div>

                    <h2 class="mt-5 text-2xl font-bold text-slate-800">

                        Pravesh Sharma

                    </h2>

                    <p class="text-slate-500 mt-1">

                        Class X • Section A

                    </p>

                    <p class="text-sm text-slate-400">

                        Admission No. : 2034025

                    </p>

                </div>



                {{-- Quick Info --}}

                <div class="grid grid-cols-3 gap-3 mt-7">

                    <div class="rounded-2xl bg-violet-50 p-4 text-center">

                        <i class="ri-calendar-check-line text-2xl text-violet-600"></i>

                        <h4 class="mt-2 font-bold text-slate-800">

                            92%

                        </h4>

                        <p class="text-[11px] text-slate-500">

                            Attendance

                        </p>

                    </div>

                    <div class="rounded-2xl bg-green-50 p-4 text-center">

                        <i class="ri-award-line text-2xl text-green-600"></i>

                        <h4 class="mt-2 font-bold text-slate-800">

                            A+

                        </h4>

                        <p class="text-[11px] text-slate-500">

                            Grade

                        </p>

                    </div>

                    <div class="rounded-2xl bg-orange-50 p-4 text-center">

                        <i class="ri-wallet-3-line text-2xl text-orange-600"></i>

                        <h4 class="mt-2 font-bold text-slate-800">

                            ₹2450

                        </h4>

                        <p class="text-[11px] text-slate-500">

                            Due Fee

                        </p>

                    </div>

                </div>

            </div>



            {{-- ================= MENU ================= --}}

            <div class="mt-6 space-y-4">



                {{-- Personal Information --}}

                <a href="#"
                    class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                    <div class="flex items-center">

                        <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">

                            <i class="ri-user-3-line text-violet-600 text-2xl"></i>

                        </div>

                        <div class="ml-4">

                            <h4 class="font-bold text-slate-800">

                                Personal Information

                            </h4>

                            <p class="text-xs text-slate-500">

                                Student basic details

                            </p>

                        </div>

                    </div>

                    <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

                </a>



                {{-- Academic Information --}}

                <a href="#"
                    class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                    <div class="flex items-center">

                        <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                            <i class="ri-graduation-cap-line text-blue-600 text-2xl"></i>

                        </div>

                        <div class="ml-4">

                            <h4 class="font-bold text-slate-800">

                                Academic Information

                            </h4>

                            <p class="text-xs text-slate-500">

                                Class & academic details

                            </p>

                        </div>

                    </div>

                    <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

                </a>



                {{-- Parents Information --}}

                <a href="#"
                    class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                    <div class="flex items-center">

                        <div class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center">

                            <i class="ri-parent-line text-pink-600 text-2xl"></i>

                        </div>

                        <div class="ml-4">

                            <h4 class="font-bold text-slate-800">

                                Parents Information

                            </h4>

                            <p class="text-xs text-slate-500">

                                Father & Mother details

                            </p>

                        </div>

                    </div>

                    <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

                </a>



                {{-- School Information --}}

                <a href="#"
                    class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                    <div class="flex items-center">

                        <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">

                            <i class="ri-school-line text-green-600 text-2xl"></i>

                        </div>

                        <div class="ml-4">

                            <h4 class="font-bold text-slate-800">

                                School Information

                            </h4>

                            <p class="text-xs text-slate-500">

                                School profile & details

                            </p>

                        </div>

                    </div>

                    <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

                </a>

            </div>

            {{-- Change Password --}}
            <a href="#"
                class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                <div class="flex items-center">

                    <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center">

                        <i class="ri-lock-password-line text-orange-600 text-2xl"></i>

                    </div>

                    <div class="ml-4">

                        <h4 class="font-bold text-slate-800">
                            Change Password
                        </h4>

                        <p class="text-xs text-slate-500">
                            Update your login password
                        </p>

                    </div>

                </div>

                <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

            </a>



            {{-- Contact Us --}}
            <a href="#"
                class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                <div class="flex items-center">

                    <div class="w-12 h-12 rounded-2xl bg-cyan-100 flex items-center justify-center">

                        <i class="ri-customer-service-2-line text-cyan-600 text-2xl"></i>

                    </div>

                    <div class="ml-4">

                        <h4 class="font-bold text-slate-800">
                            Contact Us
                        </h4>

                        <p class="text-xs text-slate-500">
                            School contact information
                        </p>

                    </div>

                </div>

                <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

            </a>



            {{-- Help & Support --}}
            <a href="#"
                class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                <div class="flex items-center">

                    <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">

                        <i class="ri-question-line text-yellow-600 text-2xl"></i>

                    </div>

                    <div class="ml-4">

                        <h4 class="font-bold text-slate-800">
                            Help & Support
                        </h4>

                        <p class="text-xs text-slate-500">
                            Need assistance?
                        </p>

                    </div>

                </div>

                <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

            </a>



            {{-- About App --}}
            <a href="#"
                class="flex items-center justify-between bg-white rounded-[26px] p-5 border border-slate-100 shadow-lg hover:shadow-xl transition">

                <div class="flex items-center">

                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">

                        <i class="ri-information-line text-indigo-600 text-2xl"></i>

                    </div>

                    <div class="ml-4">

                        <h4 class="font-bold text-slate-800">
                            About App
                        </h4>

                        <p class="text-xs text-slate-500">
                            Version & application details
                        </p>

                    </div>

                </div>

                <i class="ri-arrow-right-s-line text-2xl text-slate-400"></i>

            </a>

        </div>



        {{-- ================= APP VERSION ================= --}}

        <div
            class="mt-8 max-w-md mx-auto px-3 rounded-[30px] bg-gradient-to-r from-violet-600 via-indigo-600 to-purple-700 p-6 shadow-xl text-white">

            <div class="flex items-center">

                <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center">

                    <i class="ri-smartphone-line text-3xl"></i>

                </div>

                <div class="ml-4">

                    <h3 class="text-lg font-bold">

                        KTR Student App

                    </h3>

                    <p class="text-purple-100 text-sm">

                        Version 2.1.0

                    </p>

                </div>

            </div>

            <div class="mt-5 flex items-center justify-between">

                <span class="text-purple-100">

                    Last Updated

                </span>

                <span class="font-semibold">

                    05 Aug 2026

                </span>

            </div>

        </div>



        {{-- ================= LOGOUT ================= --}}

        <a href="{{ route('logout') }}"
            class="mt-8 w-full h-16 rounded-[28px] bg-gradient-to-r from-red-500 to-rose-600 text-white font-bold text-lg shadow-[0_15px_35px_rgba(239,68,68,.35)] active:scale-95 transition">

            <i class="ri-logout-circle-r-line mr-2 text-xl"></i>

            Logout

        </a>



    </div>

@endsection
