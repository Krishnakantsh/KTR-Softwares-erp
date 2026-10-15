@extends('apps.StudentApp.Layouts.app')

@section('title', 'Attendance')

@section('content')


    <div class="relative min-h-screen bg-[#F5F7FF] overflow-x-hidden pb-28">


        {{-- ================= HEADER ================= --}}

        <div class="bg-gradient-to-b from-[#6D3CFF] via-[#5B34E6] to-[#F5F7FF] rounded-b-[40px] pb-20">


            <div class="max-w-md mx-auto px-5 pt-[max(env(safe-area-inset-top),18px)]">


                <div class="flex items-center">


                    <a href="{{ url()->previous() }}"
                        class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-xl flex items-center justify-center">

                        <i class="ri-arrow-left-s-line text-white text-2xl"></i>

                    </a>


                    <div class="ml-4">

                        <h2 class="text-2xl font-bold text-white">
                            Attendance
                        </h2>

                        <p class="text-purple-100 text-sm">
                            Your attendance overview
                        </p>

                    </div>


                </div>


            </div>


        </div>




        <div class="max-w-md mx-auto px-5 -mt-10">



            {{-- ================= CALENDAR ================= --}}

            <div class="bg-white rounded-[30px] shadow-xl border border-slate-100 p-5">


                <div class="flex items-center justify-between mb-5">


                    <button class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">

                        <i class="ri-arrow-left-s-line text-slate-600"></i>

                    </button>



                    <div class="text-center">

                        <h3 class="font-bold text-slate-800 text-lg">
                            August 2026
                        </h3>

                        <p class="text-xs text-slate-500">
                            Monthly Attendance
                        </p>

                    </div>



                    <button class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">

                        <i class="ri-arrow-right-s-line text-slate-600"></i>

                    </button>


                </div>




                {{-- Calendar placeholder --}}

                <div class="grid grid-cols-7 gap-2 text-center text-xs">


                    @foreach (['S', 'M', 'T', 'W', 'T', 'F', 'S'] as $day)
                        <span class="text-slate-400 font-semibold">
                            {{ $day }}
                        </span>
                    @endforeach



                    @for ($i = 1; $i <= 30; $i++)
                        <div
                            class="h-9 rounded-xl flex items-center justify-center text-sm @if ($i % 5 == 0) bg-green-100 text-green-600
                            @elseif($i % 7 == 0)
                                bg-red-100 text-red-600
                            @else
                                bg-slate-50 text-slate-600 @endif
                            ">

                            {{ $i }}

                        </div>
                    @endfor


                </div>


            </div>





            {{-- ================= ATTENDANCE SUMMARY ================= --}}


            <div class="mt-6 bg-white rounded-[30px] shadow-xl border border-slate-100 p-5">


                <div class="flex items-center justify-between">



                    {{-- Circular Chart --}}

                    <div class="relative w-36 h-36">


                        <svg class="w-full h-full rotate-[-90deg]">


                            <circle cx="72" cy="72" r="60" stroke="#EDE9FE" stroke-width="12"
                                fill="none" />


                            <circle cx="72" cy="72" r="60" stroke="#7C3AED" stroke-width="12" fill="none"
                                stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="60" />


                        </svg>



                        <div class="absolute inset-0 flex flex-col items-center justify-center">


                            <h2 class="text-3xl font-bold text-slate-800">
                                92%
                            </h2>

                            <span class="text-xs text-slate-500">
                                Attendance
                            </span>


                        </div>


                    </div>





                    {{-- Stats --}}

                    <div class="space-y-3">


                        <div class="flex items-center gap-3">


                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">

                                <i class="ri-check-double-line text-green-600 text-xl"></i>

                            </div>


                            <div>

                                <p class="text-xs text-slate-500">
                                    Present
                                </p>

                                <h4 class="font-bold text-slate-800">
                                    185 Days
                                </h4>

                            </div>


                        </div>





                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">

                                <i class="ri-close-circle-line text-red-600 text-xl"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-500">
                                    Absent
                                </p>

                                <h4 class="font-bold text-slate-800">
                                    8 Days
                                </h4>

                            </div>


                        </div>





                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center">

                                <i class="ri-calendar-close-line text-yellow-600 text-xl"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-500">
                                    Leave
                                </p>

                                <h4 class="font-bold text-slate-800">
                                    5 Days
                                </h4>

                            </div>


                        </div>





                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                                <i class="ri-sun-line text-blue-600 text-xl"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-500">
                                    Holiday
                                </p>

                                <h4 class="font-bold text-slate-800">
                                    12 Days
                                </h4>

                            </div>


                        </div>



                    </div>



                </div>


            </div>





            {{-- ================= REPORT BUTTON ================= --}}

            <button
                class="mt-6 w-full h-16 rounded-[25px]
                bg-gradient-to-r from-violet-600 to-indigo-600
                text-white font-bold text-lg
                shadow-xl
                flex items-center justify-center gap-3">


                <i class="ri-file-chart-line text-2xl"></i>


                View Attendance Report


            </button>




        </div>


    </div>


@endsection
