@extends('apps.StudentApp.Layouts.app')

@section('title', 'Login')

@section('content')
    <div class="relative h-screen overflow-hidden bg-[#09051F]">

        {{-- Background --}}
        <img src="{{ asset('app/app_bg.png') }}" class="absolute inset-0 w-full h-screen object-cover">
        <div class="absolute inset-0 bg-[#09051F]/55 backdrop-blur-[2px]"></div>

        <div class="relative z-20 h-screen max-w-md mx-auto px-6 flex flex-col justify-between">

            {{-- Header --}}
            <div class="pt-5 absolute left-5">
                <a href="{{ route('app.onboard') }}"
                    class="w-8 h-8 rounded-full bg-white/10 backdrop-blur-xl border border-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            {{-- Top --}}
            <div class="text-center mt-6">
                <img src="{{ asset('app/app_logo.png') }}" class="w-16 mx-auto">
                <h2 class="text-2xl font-black text-white">Welcome Back</h2>
                <p class="text-white/70 mt-2 text-md">Login to continue your learning journey</p>
            </div>

            {{-- Login Card --}}
            <div class="mt-10 rounded-[32px] bg-white/10 backdrop-blur-2xl border border-white/10 shadow-2xl px-6 py-3">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="hidden" name="type" value="4">


                    {{-- Admission ID --}}
                    <div>
                        <label class="text-white/70 text-sm">Email/Phone</label>
                        <input type="text" name="login"
                            class="mt-2 w-full h-12 rounded-2xl bg-white/10 border border-white/10 px-5 text-white placeholder:text-gray-400 focus:border-violet-500 focus:ring-0"
                            placeholder="Enter Admission ID">
                    </div>

                    {{-- Password --}}
                    <div class="mt-5">
                        <label class="text-white/70 text-sm">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password"
                                class="mt-2 w-full h-12 rounded-2xl bg-white/10 border border-white/10 px-5 pr-14 text-white placeholder:text-gray-400 focus:border-violet-500"
                                placeholder="Enter Password">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-5 top-6 text-white/60">👁️</button>
                        </div>
                    </div>

                    {{-- Forgot Password --}}
                    <div class="text-right mt-3">
                        <a href="{{ route('app.student.forgot_password') }}" class="text-violet-300 text-sm">Forgot
                            Password?</a>
                    </div>

                    {{-- Login Button --}}
                    <button type="submit"
                        class="mt-6 w-full h-12 rounded-full bg-gradient-to-r from-violet-600 to-indigo-600 font-bold text-lg text-white flex items-center justify-center">Login</button>
                </form>
            </div>

            {{-- Divider --}}
            <div class="flex items-center my-2">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="px-4 text-white/50 text-sm">OR</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>

            <div class="flex items-center justify-center gap-4">
                {{-- OTP Login --}}
                <a href="{{ route('app.withotp') }}"
                    class="h-12 rounded-2xl w-1/2 border border-violet-500 bg-violet-500/10 hover:bg-violet-500/20 active:scale-[0.98] transition flex items-center justify-center gap-2 text-white font-semibold text-sm">
                    <i class="ri-shield-keyhole-line text-lg text-violet-400"></i>
                    <span>Login with OTP</span>
                </a>

                {{-- Biometric --}}
                <a href="{{route('app.biometric.screen')}}"
                    class="h-12 rounded-2xl w-1/2 border border-cyan-400 bg-cyan-500/10 hover:bg-cyan-500/20 active:scale-[0.98] transition flex items-center justify-center gap-2 text-white font-semibold text-sm">
                    <i class="ri-fingerprint-line text-lg text-cyan-400"></i>
                    <span>Biometric Login</span>
                </a>
            </div>

            {{-- Bottom --}}
            <div class="mt-5 pb-4 text-center">
                <p class="text-white/40 text-sm">Powered by KTR ERP</p>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        function togglePassword() {
            let p = document.getElementById('password');
            p.type = p.type === 'password' ? 'text' : 'password';
        }
    </script>
@endpush
