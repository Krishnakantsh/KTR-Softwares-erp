@extends('apps.StudentApp.Layouts.app')

@section('title', 'Leave Request')

@section('content')

    <div class="relative min-h-screen bg-[#F5F7FF] pb-32 overflow-x-hidden">


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
                            Leave Request
                        </h2>

                        <p class="text-purple-100 text-sm">
                            Manage your leave applications
                        </p>

                    </div>


                </div>


            </div>

        </div>




        <div class="max-w-md mx-auto px-5 -mt-10">



            {{-- ================= LEAVE LIST ================= --}}


            <div class="space-y-4">


                {{-- Card --}}

                <div class="bg-white rounded-[28px] p-5 shadow-lg border border-slate-100">


                    <div class="flex justify-between items-start">


                        <div class="flex gap-3">


                            <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">

                                <i class="ri-calendar-event-line text-yellow-600 text-2xl"></i>

                            </div>
                            <div>

                                <h4 class="font-bold text-slate-800">
                                    Medical Leave
                                </h4>

                                <p class="text-xs text-slate-500">
                                    12 Aug 2026 - 14 Aug 2026
                                </p>
                            </div>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-bold">
                            Approved
                        </span>
                    </div>

                    <p class="mt-4 text-sm text-slate-500">

                        Fever and doctor consultation.

                    </p>
                </div>

                <div class="bg-white rounded-[28px] p-5 shadow-lg border border-slate-100">


                    <div class="flex justify-between">


                        <div class="flex gap-3">


                            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">

                                <i class="ri-time-line text-red-600 text-2xl"></i>

                            </div>


                            <div>

                                <h4 class="font-bold">
                                    Casual Leave
                                </h4>

                                <p class="text-xs text-slate-500">
                                    20 Aug 2026
                                </p>

                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full h-fit bg-orange-100 text-orange-600 text-xs font-bold">
                            Pending
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= ADD BUTTON ================= --}}

        <div class="fixed bottom-24 left-0 right-0 z-40 mb-2">


            <div class="max-w-md mx-auto px-5">


                <button onclick="openLeaveModal()"
                    class="w-full h-12 rounded-[25px]
                    bg-gradient-to-r from-violet-600 to-indigo-600
                    text-white font-bold text-md
                    shadow-xl flex items-center justify-center gap-3">


                    <i class="ri-add-circle-line text-2xl"></i>

                    Add Leave Request


                </button>


            </div>


        </div>

        {{-- ================= BOTTOM SHEET ================= --}}


        <div id="leaveModal" class="fixed inset-0 z-[100] hidden">


            {{-- Overlay --}}

            <div onclick="closeLeaveModal()" class="absolute inset-0 bg-black/40 backdrop-blur-sm">
            </div>



            {{-- Sheet --}}

            <div
                class="absolute bottom-0 left-0 right-0
                    bg-white
                    rounded-t-[35px]
                    h-[90%]
                    max-w-md mx-auto
                    p-6
                    overflow-y-auto">


                <div class="flex justify-center mb-5">

                    <div class="w-14 h-1.5 rounded-full bg-slate-300"></div>

                </div>




                <div class="flex items-center justify-between mb-12">

                    <h2 class="text-xl font-bold text-slate-800">
                        Add Leave Request
                    </h2>


                    <button onclick="closeLeaveModal()">

                        <i class="ri-close-line text-2xl text-slate-500"></i>

                    </button>


                </div>




                {{-- Leave Type --}}

                <label class="text-sm font-semibold text-slate-700">
                    Leave Type
                </label>


                <div class="relative mt-2">


                    <select class="w-full h-14 rounded-2xl bg-slate-50 border border-slate-200 px-4 appearance-none">

                        <option>
                            Select Leave Type
                        </option>

                        <option>
                            Casual Leave
                        </option>

                        <option>
                            Medical Leave
                        </option>

                        <option>
                            Emergency Leave
                        </option>

                    </select>


                    <i class="ri-arrow-down-s-line absolute right-4 top-4 text-xl text-slate-400"></i>


                </div>





                {{-- Dates --}}

                <div class="grid grid-cols-2 gap-4 mt-5">


                    <div>

                        <label class="text-sm font-semibold">
                            From Date
                        </label>

                        <div class="relative mt-2">

                            <input type="date" class="w-full h-14 rounded-2xl bg-slate-50 border border-slate-200 px-4">


                        </div>


                    </div>



                    <div>

                        <label class="text-sm font-semibold">
                            To Date
                        </label>


                        <input type="date" class="mt-2 w-full h-14 rounded-2xl bg-slate-50 border border-slate-200 px-4">


                    </div>


                </div>





                {{-- Reason --}}

                <div class="mt-5">


                    <label class="text-sm font-semibold">
                        Reason
                    </label>


                    <textarea rows="4" placeholder="Write reason for leave..."
                        class="mt-2 w-full rounded-2xl bg-slate-50 border border-slate-200 p-4 resize-none"></textarea>


                </div>






                {{-- Attachment --}}


                <div class="mt-5">


                    <label class="text-sm font-semibold">
                        Attachment (Optional)
                    </label>


                    <div
                        class="mt-2 h-28 rounded-3xl border-2 border-dashed border-slate-200
                            flex flex-col items-center justify-center">


                        <i class="ri-upload-cloud-2-line text-3xl text-violet-600"></i>


                        <p class="text-sm text-slate-500 mt-2">
                            Upload document
                        </p>


                        <input type="file" class="absolute opacity-0 w-full h-28">


                    </div>


                </div>

                <button
                    class="mt-8 w-full h-16 rounded-[25px]
                    bg-gradient-to-r from-violet-600 to-indigo-600
                    text-white font-bold text-lg">


                    Submit Request


                </button>





            </div>



        </div>





        <script>
            function openLeaveModal() {

                document.getElementById('leaveModal')
                    .classList.remove('hidden');

            }



            function closeLeaveModal() {

                document.getElementById('leaveModal')
                    .classList.add('hidden');

            }
        </script>



    @endsection
