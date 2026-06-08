@extends('Frontend/Authentication/main')

@section('content')
    <div x-data="{ tab: 'service' }">

        <div class="flex bg-slate-100 p-1 rounded-2xl mb-10">
            <button @click="tab = 'service'"
                :class="tab === 'service' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-code-branch"></i> <span class="hidden sm:inline">Service Provider</span>
            </button>
            <button @click="tab = 'institute'"
                :class="tab === 'institute' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-university"></i> <span class="hidden sm:inline">Institute</span>
            </button>
            <button @click="tab = 'guardian'"
                :class="tab === 'guardian' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-user-shield"></i> <span class="hidden sm:inline">Guardian</span>
            </button>
        </div>

        <div class="mb-8">
            <h3 class="text-2xl font-bold text-slate-800"
                x-text="tab === 'service' ? 'Partner Login' : (tab === 'institute' ? 'Institute Portal' : 'Parent Access')">
            </h3>
            <p class="text-slate-500 text-sm mt-1"
                x-text="tab === 'service' ? 'Access your developer & client management tools.' : (tab === 'institute' ? 'Manage your students and administrative tasks.' : 'Track your ward\'s academic progress.')">
            </p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email"  name="email"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all"
                        placeholder="name@company.com">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"    name="password"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between py-2">
                <label class="flex items-center text-sm text-slate-600">
                    <input type="checkbox" class="rounded border-slate-300 text-sky-600 mr-2" name="remember" > Remember me
                </label>
                <a href="{{ route('password.forgot') }}"
                    class="text-sm font-semibold text-sky-600 hover:text-sky-700">Forgot Password?</a>
            </div>

            <button type="submit"
                class="w-full py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold text-lg shadow-lg shadow-slate-200 transition-all active:scale-[0.98]">
                Login to Dashboard
            </button>
        </form>

    </div>
@endsection
