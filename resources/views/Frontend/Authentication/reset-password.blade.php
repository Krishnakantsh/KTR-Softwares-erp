@extends('Frontend/Authentication/main')

@section('content')
    <div x-data="{ tab: 'service' }">


        <div class="mb-10 text-center md:text-left">
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">
                New <span class="text-sky-500">Password</span>
            </h2>
            <p class="text-slate-500 text-lg leading-relaxed max-w-md hidden md:block">
                Apna naya aur mazboot password set karein taaki aapka account secure rahe.
            </p>
        </div>



        <form action="#" method="POST" class="space-y-5">

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">New Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all"
                        placeholder="••••••••">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all"
                        placeholder="••••••••">
                </div>
            </div>



            <div class="pt-2">
                <button type="submit"
                    class="w-full py-5 bg-slate-900 hover:bg-sky-600 text-white rounded-3xl font-bold text-xl shadow-2xl shadow-sky-200 transition-all transform active:scale-[0.98] flex items-center justify-center gap-4">
                    <span>Send Reset Link</span>
                    <i class="fas fa-paper-plane text-sm"></i>
                </button>
            </div>
        </form>


        <div class="mt-12 text-center md:text-left">
            <a href="{{ route('login') }}"
                class="group text-base font-bold text-slate-500 hover:text-sky-600 inline-flex items-center gap-3 transition-all">
                <div
                    class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-sky-50 transition-all">
                    <i class="fas fa-arrow-left text-xs"></i>
                </div>
                Back to Login
            </a>
        </div>

    </div>
@endsection
