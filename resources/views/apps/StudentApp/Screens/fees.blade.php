@extends('apps.StudentApp.Layouts.app')

@section('title', 'Fee Details')

@section('content')
    <div class="relative min-h-screen bg-[#F5F7FF] overflow-x-hidden pb-4">

        {{-- ================= HEADER ================= --}}
        <div class="bg-gradient-to-b from-[#6D3CFF] via-[#5B34E6] to-[#F5F7FF] rounded-b-[40px] pb-20">
            <div class="max-w-md mx-auto px-5 pt-[max(env(safe-area-inset-top),18px)]">
                <div class="flex items-center">
                    <a href="{{ url()->previous() }}"
                        class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-xl border border-white/20 flex items-center justify-center">
                        <i class="ri-arrow-left-s-line text-white text-2xl"></i>
                    </a>

                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-white">Fee Details</h2>
                        <p class="text-purple-100 text-sm">Manage your school fee</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= CONTENT ================= --}}
        <div class="max-w-md mx-auto px-3 -mt-10">

            {{-- ================= OUTSTANDING CARD ================= --}}
            <div
                class="rounded-[30px] bg-gradient-to-r from-violet-600 via-indigo-600 to-purple-700 shadow-[0_20px_40px_rgba(109,60,255,.25)] overflow-hidden relative">

                {{-- decoration --}}
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>
                <div class="absolute -left-16 -bottom-16 w-40 h-40 rounded-full bg-white/10"></div>

                <div class="relative p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                                    <i class="ri-wallet-3-line text-xl text-white"></i>
                                </div>
                                <span class="text-violet-100 font-medium">Outstanding Fee</span>
                            </div>

                            <h2 class="text-4xl font-extrabold text-white mt-5">₹ 2,450</h2>

                            <div class="mt-4 flex items-center text-violet-100">
                                <i class="ri-time-line mr-2"></i>
                                Due on 10 Aug 2026
                            </div>
                        </div>
                    </div>

                    <button
                        class="h-10 px-4 absolute right-3 bottom-3 rounded-2xl bg-white text-violet-700 font-bold shadow-xl active:scale-95 transition">
                        <i class="ri-bank-card-line mr-2"></i>
                        Pay
                    </button>
                </div>
            </div>

            {{-- ================= FEE SUMMARY ================= --}}
            <div class="mt-6 bg-white rounded-[30px] shadow-lg border border-slate-100 p-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">
                        <i class="ri-file-list-3-line text-violet-600 text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="font-bold text-lg text-slate-800">Fee Summary</h3>
                        <p class="text-xs text-slate-500">Session 2026-27</p>
                    </div>
                </div>

                <div class="space-y-5">
                    {{-- Tuition Fee --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="ri-book-open-line text-blue-600"></i>
                            </div>
                            <span class="ml-3 font-medium text-slate-700">Tuition Fee</span>
                        </div>
                        <span class="font-bold text-slate-800">₹12,000</span>
                    </div>

                    {{-- Transport Fee --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                                <i class="ri-bus-2-line text-green-600"></i>
                            </div>
                            <span class="ml-3 font-medium text-slate-700">Transport Fee</span>
                        </div>
                        <span class="font-bold text-slate-800">₹6,000</span>
                    </div>

                    {{-- Examination Fee --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                                <i class="ri-file-paper-2-line text-orange-600"></i>
                            </div>
                            <span class="ml-3 font-medium text-slate-700">Examination Fee</span>
                        </div>
                        <span class="font-bold text-slate-800">₹1,500</span>
                    </div>

                    {{-- Library Fee --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-pink-100 flex items-center justify-center">
                                <i class="ri-book-shelf-line text-pink-600"></i>
                            </div>
                            <span class="ml-3 font-medium text-slate-700">Library Fee</span>
                        </div>
                        <span class="font-bold text-slate-800">₹500</span>
                    </div>

                    {{-- Late Fine --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                                <i class="ri-alarm-warning-line text-red-600"></i>
                            </div>
                            <span class="ml-3 font-medium text-slate-700">Late Fine</span>
                        </div>
                        <span class="font-bold text-red-600">₹100</span>
                    </div>
                </div>

                <div class="my-6 border-t border-dashed border-slate-200"></div>

                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800">Total Fee</h3>
                        <p class="text-xs text-slate-500">Including all charges</p>
                    </div>
                    <h2 class="text-3xl font-extrabold text-violet-700">₹20,100</h2>
                </div>
            </div>

            {{-- ================= PAYMENT HISTORY ================= --}}
            <div class="mt-6 bg-white rounded-[30px] border border-slate-100 shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">
                            <i class="ri-history-line text-2xl text-indigo-600"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="font-bold text-lg text-slate-800">Payment History</h3>
                            <p class="text-xs text-slate-500">Recent transactions</p>
                        </div>
                    </div>
                </div>

                {{-- Paid --}}
                <div class="rounded-2xl border border-slate-100 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                                <i class="ri-checkbox-circle-fill text-2xl text-green-600"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="font-bold text-slate-800">July 2026</h4>
                                <p class="text-xs text-slate-500">Receipt #1025</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <h4 class="font-bold">₹2,450</h4>
                            <span
                                class="inline-flex mt-1 px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-semibold">
                                Paid
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Paid --}}
                <div class="rounded-2xl border border-slate-100 p-4 mt-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                                <i class="ri-checkbox-circle-fill text-2xl text-green-600"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="font-bold">June 2026</h4>
                                <p class="text-xs text-slate-500">Receipt #1024</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <h4 class="font-bold">₹2,450</h4>
                            <span
                                class="inline-flex mt-1 px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-semibold">
                                Paid
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="rounded-2xl border border-slate-100 p-4 mt-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center">
                                <i class="ri-loader-4-line text-2xl text-orange-600"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="font-bold">May 2026</h4>
                                <p class="text-xs text-slate-500">Pending Payment</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <h4 class="font-bold">₹2,450</h4>
                            <span
                                class="inline-flex mt-1 px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-xs font-semibold">
                                Pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= RECEIPTS ================= --}}
            <div class="mt-6 bg-white rounded-[30px] border border-slate-100 shadow-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">
                        <i class="ri-file-pdf-2-line text-2xl text-red-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="font-bold text-lg">Fee Receipts</h3>
                        <p class="text-xs text-slate-500">Download receipts</p>
                    </div>
                </div>

                {{-- Receipt --}}
                <div class="flex items-center justify-between rounded-2xl border border-slate-100 p-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">
                            <i class="ri-file-pdf-2-fill text-red-600 text-2xl"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="font-bold">Receipt #1025</h4>
                            <p class="text-xs text-slate-500">10 July 2026</p>
                        </div>
                    </div>
                    <button class="w-11 h-11 rounded-xl bg-violet-100 flex items-center justify-center">
                        <i class="ri-download-2-line text-xl text-violet-600"></i>
                    </button>
                </div>

                {{-- Receipt --}}
                <div class="flex items-center justify-between rounded-2xl border border-slate-100 p-4 mt-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">
                            <i class="ri-file-pdf-2-fill text-red-600 text-2xl"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="font-bold">Receipt #1024</h4>
                            <p class="text-xs text-slate-500">12 June 2026</p>
                        </div>
                    </div>
                    <button class="w-11 h-11 rounded-xl bg-violet-100 flex items-center justify-center">
                        <i class="ri-download-2-line text-xl text-violet-600"></i>
                    </button>
                </div>
            </div>

            {{-- ================= QUICK STATS ================= --}}
            <div class="grid grid-cols-3 gap-3 mt-6">
                <div class="bg-green-100 rounded-3xl p-4 text-center">
                    <i class="ri-checkbox-circle-fill text-3xl text-green-600"></i>
                    <h3 class="font-bold text-lg mt-2">12</h3>
                    <p class="text-xs text-green-700">Paid</p>
                </div>

                <div class="bg-orange-100 rounded-3xl p-4 text-center">
                    <i class="ri-time-line text-3xl text-orange-600"></i>
                    <h3 class="font-bold text-lg mt-2">1</h3>
                    <p class="text-xs text-orange-700">Due</p>
                </div>

                <div class="bg-blue-100 rounded-3xl p-4 text-center">
                    <i class="ri-money-rupee-circle-line text-3xl text-blue-600"></i>
                    <h3 class="font-bold text-lg mt-2">₹20K</h3>
                    <p class="text-xs text-blue-700">Total</p>
                </div>
            </div>

            {{-- ================= BUTTON ================= --}}
            <button
                class="mt-6 w-full h-16 rounded-[24px] bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-lg font-bold shadow-xl active:scale-95 transition">
                <i class="ri-bar-chart-box-line mr-2"></i>
                View Complete Report
            </button>

        </div>
    </div>
@endsection
