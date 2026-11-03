@extends('apps.StudentApp.Layouts.app')

@section('title', 'OTP Verification')

@section('content')

    <div class="relative h-screen overflow-hidden bg-[#09051F]">

        <img src="{{ asset('app/app_bg.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-[#09051F]/60 backdrop-blur-sm"></div>

        <div class="relative z-20 h-full max-w-md mx-auto px-6 flex flex-col">



            <div class="pt-10">

                <a href="{{ route('app.login') }}"
                    class="w-8 h-8 rounded-full bg-white/10 backdrop-blur-xl border border-white/10 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                    </svg>

                </a>

            </div>



            {{-- Logo --}}

            <div class="text-center mt-6">

                <img src="{{ asset('app/app_logo.png') }}" class="w-20 mx-auto">

                <h2 class="text-3xl font-black text-white mt-5">

                    Verify OTP

                </h2>

                <p class="text-white/70 mt-2">

                    Enter the 6 digit code sent to your registered mobile number.

                </p>

            </div>

            {{-- Card --}}

            <div class="mt-10 rounded-[30px] bg-white/10 backdrop-blur-xl border border-white/10 p-6">

                <div class="flex justify-between gap-3">

                    <input maxlength="1"
                        class="otp h-16 w-14 rounded-2xl bg-white/10 border border-white/10 text-center text-2xl text-white outline-none">

                    <input maxlength="1"
                        class="otp h-16 w-14 rounded-2xl bg-white/10 border border-white/10 text-center text-2xl text-white outline-none">

                    <input maxlength="1"
                        class="otp h-16 w-14 rounded-2xl bg-white/10 border border-white/10 text-center text-2xl text-white outline-none">

                    <input maxlength="1"
                        class="otp h-16 w-14 rounded-2xl bg-white/10 border border-white/10 text-center text-2xl text-white outline-none">


                </div>

                <button
                    class="mt-8 w-full h-14 rounded-full bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold">

                    Verify OTP

                </button>

                <div class="mt-6 text-center">

                    <p class="text-white/60">

                        Didn't receive OTP?

                    </p>

                    <button class="mt-2 text-violet-300 font-semibold">

                        Resend OTP

                    </button>

                </div>

            </div>

            <div class="mt-auto pb-6 text-center">

                <p class="text-white/40">

                    Powered by KTR ERP

                </p>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        const inputs = document.querySelectorAll('.otp');

        inputs.forEach((input, index) => {

            input.addEventListener('input', () => {

                if (input.value.length == 1 && index < inputs.length - 1) {

                    inputs[index + 1].focus();

                }

            });

            input.addEventListener('keydown', (e) => {

                if (e.key === "Backspace" && input.value === "" && index > 0) {

                    inputs[index - 1].focus();

                }

            });

        });
    </script>
@endpush
