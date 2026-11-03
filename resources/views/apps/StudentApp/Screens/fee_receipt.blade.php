@extends('apps.StudentApp.Layouts.app')

@section('title', 'Fee Receipt')

@section('content')
<div class="relative min-h-screen bg-[#F5F7FF] overflow-x-hidden pb-8">

    {{-- ================= HEADER ================= --}}
    <div class="bg-gradient-to-b from-[#6D3CFF] via-[#5B34E6] to-[#F5F7FF] rounded-b-[40px] pb-20">
        <div class="max-w-md mx-auto px-5 pt-[max(env(safe-area-inset-top),18px)]">
            <div class="flex items-center">
                <a href="{{ url()->previous() }}"
                   class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-xl border border-white/20 flex items-center justify-center">
                    <i class="ri-arrow-left-s-line text-white text-2xl"></i>
                </a>
                <div class="ml-4">
                    <h2 class="text-2xl font-bold text-white">Fee Receipt</h2>
                    <p class="text-purple-100 text-sm">Digital payment receipt</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-md mx-auto px-5 -mt-10 space-y-6">

        {{-- ================= RECEIPT CARD ================= --}}
        <div class="rounded-[30px] bg-gradient-to-br from-violet-600 via-indigo-600 to-purple-700 text-white shadow-2xl overflow-hidden relative">
            
            {{-- Background Decorative Circles --}}
            <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>
            <div class="absolute -left-16 bottom-0 w-40 h-40 rounded-full bg-white/10"></div>

            <div class="relative p-6">
                {{-- Card Header --}}
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-violet-100 text-sm">Receipt No.</p>
                        <h2 class="font-bold text-xl mt-1">#RCT-2026-00125</h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center">
                        <i class="ri-file-paper-2-fill text-3xl"></i>
                    </div>
                </div>

                {{-- Amount & Status --}}
                <div class="grid grid-cols-2 gap-5 mt-8">
                    <div>
                        <p class="text-violet-200 text-xs">Amount Paid</p>
                        <h1 class="text-4xl font-extrabold mt-2">₹2,450</h1>
                    </div>
                    <div>
                        <p class="text-violet-200 text-xs">Status</p>
                        <div class="inline-flex items-center mt-3 px-4 py-2 rounded-full bg-green-500/20 text-sm">
                            <i class="ri-checkbox-circle-fill mr-2"></i>
                            Paid
                        </div>
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="grid grid-cols-2 gap-5 mt-8 text-sm">
                    <div>
                        <p class="text-violet-200">Payment Date</p>
                        <p class="font-semibold mt-1">10 Aug 2026</p>
                    </div>
                    <div>
                        <p class="text-violet-200">Mode</p>
                        <p class="font-semibold mt-1">Online UPI</p>
                    </div>
                    <div>
                        <p class="text-violet-200">Transaction ID</p>
                        <p class="font-semibold mt-1">TXN458963214</p>
                    </div>
                    <div>
                        <p class="text-violet-200">Collected By</p>
                        <p class="font-semibold mt-1">Accounts Office</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button class="h-14 rounded-2xl bg-white text-violet-700 font-bold flex items-center justify-center">
                        <i class="ri-download-2-line mr-2"></i>
                        Download
                    </button>
                    <button class="h-14 rounded-2xl bg-white/20 border border-white/20 font-bold flex items-center justify-center">
                        <i class="ri-share-forward-line mr-2"></i>
                        Share
                    </button>
                </div>
            </div>
        </div>

        {{-- ================= PAYMENT BREAKDOWN ================= --}}
        <div class="bg-white rounded-[30px] shadow-lg border border-slate-100 p-6">
            <div class="flex items-center mb-5">
                <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">
                    <i class="ri-wallet-3-line text-violet-600 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="font-bold text-lg">Payment Details</h3>
                    <p class="text-xs text-slate-500">Fee breakup</p>
                </div>
            </div>

            <div class="space-y-5">
                <div class="flex justify-between">
                    <span class="text-slate-600">Tuition Fee</span>
                    <b class="text-slate-800">₹1200</b>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Transport Fee</span>
                    <b class="text-slate-800">₹700</b>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Exam Fee</span>
                    <b class="text-slate-800">₹300</b>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Late Fine</span>
                    <b class="text-slate-800">₹250</b>
                </div>

                <hr class="border-slate-100">

                <div class="flex justify-between text-lg font-bold">
                    <span>Total Paid</span>
                    <span class="text-violet-700">₹2450</span>
                </div>
            </div>
        </div>

        {{-- ================= STUDENT INFORMATION ================= --}}
        <div class="bg-white rounded-[30px] shadow-lg border border-slate-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i class="ri-user-3-line text-2xl text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <h3 class="font-bold text-lg text-slate-800">Student Information</h3>
                    <p class="text-xs text-slate-500">Receipt belongs to</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-slate-500">Student Name</span>
                    <span class="font-semibold">Pravesh Sharma</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Admission No.</span>
                    <span class="font-semibold">A1025</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Class</span>
                    <span class="font-semibold">10 - A</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Session</span>
                    <span class="font-semibold">2026 - 27</span>
                </div>
            </div>
        </div>

        {{-- ================= SCHOOL INFORMATION ================= --}}
        <div class="bg-white rounded-[30px] shadow-lg border border-slate-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">
                    <i class="ri-school-line text-2xl text-violet-600"></i>
                </div>
                <div class="ml-3">
                    <h3 class="font-bold text-lg">School Information</h3>
                    <p class="text-xs text-slate-500">Payment receiver</p>
                </div>
            </div>

            <h4 class="font-bold text-slate-800">St. Paul's Senior Secondary School</h4>
            <p class="text-sm text-slate-500 mt-2 leading-6">
                Civil Lines, Mathura,<br>
                Uttar Pradesh - 281001
            </p>

            <div class="mt-5 flex items-center text-violet-600">
                <i class="ri-phone-line mr-2"></i>
                +91 9876543210
            </div>
            <div class="mt-2 flex items-center text-violet-600">
                <i class="ri-mail-line mr-2"></i>
                accounts@school.com
            </div>
        </div>

        {{-- ================= QR VERIFY ================= --}}
        <div class="bg-white rounded-[30px] shadow-lg border border-slate-100 p-6 text-center">
            <div class="w-36 h-36 mx-auto rounded-3xl bg-slate-100 flex items-center justify-center">
                <i class="ri-qr-code-line text-7xl text-slate-500"></i>
            </div>
            <h3 class="font-bold text-lg mt-5">Verify Receipt</h3>
            <p class="text-sm text-slate-500 mt-2">Scan QR Code to verify this receipt.</p>
        </div>

        {{-- ================= OFFICIAL STATUS ================= --}}
        <div class="rounded-[30px] bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-white shadow-xl">
            <div class="flex items-center">
                <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center">
                    <i class="ri-checkbox-circle-fill text-3xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-bold text-xl">Payment Successful</h3>
                    <p class="text-green-100 text-sm mt-1">Verified by School ERP</p>
                </div>
            </div>
        </div>

        {{-- ================= ACTION BUTTONS ================= --}}
        <div class="grid grid-cols-2 gap-4">
            <button class="h-14 rounded-2xl border-2 border-violet-600 text-violet-600 font-bold flex items-center justify-center">
                <i class="ri-printer-line mr-2"></i>
                Print
            </button>
            <button class="h-14 rounded-2xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold shadow-lg flex items-center justify-center">
                <i class="ri-share-forward-line mr-2"></i>
                Share
            </button>
        </div>

        {{-- ================= DOWNLOAD ================= --}}
        <button class="w-full h-16 rounded-[26px] bg-gradient-to-r from-violet-600 via-indigo-600 to-purple-700 text-white text-lg font-bold shadow-[0_15px_35px_rgba(109,60,255,.30)] active:scale-95 transition flex items-center justify-center">
            <i class="ri-download-cloud-2-line mr-2 text-xl"></i>
            Download PDF Receipt
        </button>

    </div>
</div>
@endsection