@extends('School.Authentication.main')

@section('content')
    <div x-data="{
        tab: 'service',
        get typeValue() {
            const maps = { 'service': 1, 'institute': 2, 'staff': 3, 'student': 4 };
            return maps[this.tab] || 1;
        }
    }">


        <div class="flex flex-wrap sm:flex-nowrap bg-slate-100 p-1 rounded-2xl mb-10 gap-1 sm:gap-0">
            <button @click="tab = 'service'"
                :class="tab === 'service' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-code-branch"></i> <span class="hidden sm:inline">KTR ERP</span>
            </button>
            <button @click="tab = 'institute'"
                :class="tab === 'institute' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-university"></i> <span class="hidden sm:inline">Institute</span>
            </button>

            <button @click="tab = 'staff'"
                :class="tab === 'staff' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-user-tie"></i> <span class="hidden sm:inline">Staff</span>
            </button>
            <button @click="tab = 'student'"
                :class="tab === 'student' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'"
                class="flex-1 py-3 px-2 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-user-shield"></i> <span class="hidden sm:inline">Student</span>
            </button>
        </div>


        <div class="mb-8">
            <h3 class="text-2xl font-bold text-slate-800"
                x-text="tab === 'service' ? 'Partner Login' : (tab === 'institute' ? 'Institute Portal' : (tab === 'staff' ? 'Staff Portal' : 'Student Access'))">
            </h3>

        </div>


        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <input type="hidden" name="type" :value="typeValue">
            <input type="hidden" name="software" value="ERP">

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="text" name="login" required
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
                    <input type="password" name="password" required
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between py-2">
                <label class="flex items-center text-sm text-slate-600">
                    <input type="checkbox" class="rounded border-slate-300 text-sky-600 mr-2" name="remember"> Remember me
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


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: "{{ session('warning') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: "{{ session('info') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif
@endsection
