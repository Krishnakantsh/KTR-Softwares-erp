{{-- @extends('apps/StudentApp/Layouts/app')

@section('title', 'KTR Student App')

@section('content')
    <div
        style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; background:linear-gradient(160deg, var(--primary) 0%, var(--secondary) 100%); color:#fff; text-align:center;">
        <div
            style="width:70px; height:70px; background:rgba(255,255,255,0.2); border-radius:20px; display:flex; align-items:center; justify-content:center; font-size:32px; font-weight:800; margin-bottom:16px;">
            KTR
        </div>
        <h1 style="font-size:26px; font-family:var(--font-display);">KTR Student</h1>
        <p style="font-size:13px; opacity:0.8; margin-top:4px;">Your school, beautifully organized</p>
    </div>
@endsection

@push('script')
    <script>
        // Auto redirect from Splash to Onboard screen
        setTimeout(() => {
            window.location.href = "{{ route('app.onboard') }}";
        }, 2000);
    </script>
@endpush --}}


@extends('apps.StudentApp.Layouts.app')

@section('title', 'KTR Student App')

@section('content')

    <div
        class="flex flex-col items-center justify-center h-full bg-gradient-to-br from-[var(--primary)] to-[var(--secondary)] text-white text-center">

        <div
            class="w-[70px] h-[70px] bg-white/20 rounded-[20px] flex items-center justify-center text-[32px] font-extrabold mb-4">
            KTR
        </div>

        <h1 class="text-[26px] font-bold">
            KTR Student
        </h1>

        <p class="text-[13px] opacity-80 mt-1">
            Your school, beautifully organized
        </p>

    </div>

@endsection

@push('script')
    <script>
        setTimeout(() => {
            window.location.href = "{{ route('app.onboard') }}";
        }, 2000);
    </script>
@endpush
