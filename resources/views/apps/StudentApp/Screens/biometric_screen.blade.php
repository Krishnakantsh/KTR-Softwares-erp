@extends('apps.StudentApp.Layouts.app')

@section('title', 'Biometric Login')

@section('content')
    <style>
        /* Laser Scan Line Animation */
        @keyframes scan {
            0% { top: 0%; opacity: 0.2; }
            50% { opacity: 1; }
            100% { top: 100%; opacity: 0.2; }
        }
        .scan-line {
            animation: scan 1.8s infinite ease-in-out;
        }
    </style>

    <div class="relative min-h-[100dvh] h-[100dvh] w-full overflow-y-auto bg-[#09051F] select-none">

        {{-- Background --}}
        <img src="{{ asset('app/app_bg.png') }}" class="fixed inset-0 w-full h-full object-cover z-0 pointer-events-none">
        <div class="fixed inset-0 bg-[#09051F]/60 backdrop-blur-sm z-0 pointer-events-none"></div>

        <div class="relative z-20 min-h-[100dvh] max-w-md mx-auto px-6 py-5 flex flex-col justify-between">

            {{-- Back Button --}}
            <div class="pt-2">
                <a href="{{ route('app.login') }}"
                    class="w-9 h-9 rounded-full bg-white/10 backdrop-blur-xl border border-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            {{-- Center Touch Scanner Area --}}
            <div class="text-center my-auto flex flex-col items-center justify-center">

                <h2 class="text-3xl font-black text-white">Biometric Login</h2>
                <p class="text-white/70 mt-2 text-sm px-6">
                    Touch the fingerprint icon below to scan and login
                </p>

                {{-- Interactive Fingerprint Touch Icon --}}
                <div class="relative my-8">
                    {{-- Outer Glow Rings --}}
                    <div id="pulseBg" class="absolute -inset-4 rounded-full bg-cyan-500/20 blur-xl opacity-60 transition-all duration-500"></div>

                    {{-- Main Clickable Touch Scanner --}}
                    <button type="button" id="scanBtn" onclick="startBiometricAuth()"
                        class="relative w-36 h-36 rounded-full bg-gradient-to-b from-cyan-500/20 to-violet-600/30 border-2 border-cyan-400/50 backdrop-blur-2xl flex items-center justify-center shadow-2xl shadow-cyan-500/20 active:scale-95 transition-all overflow-hidden group focus:outline-none">
                        
                        {{-- Laser Scan Line (Shown while scanning) --}}
                        <div id="laserLine" class="hidden absolute left-0 right-0 h-1 bg-gradient-to-r from-transparent via-cyan-400 to-transparent shadow-[0_0_15px_#22d3ee] scan-line z-20"></div>

                        {{-- Fingerprint Icon --}}
                        <i id="fpIcon" class="ri-fingerprint-line text-7xl text-cyan-300 transition-all duration-300 group-hover:scale-105"></i>
                    </button>
                </div>

                {{-- Live Status Indicator --}}
                <div id="statusMessage" class="text-sm font-medium text-cyan-300 bg-cyan-500/10 border border-cyan-500/20 rounded-full py-2 px-6 backdrop-blur-md transition-all">
                     Touch icon to scan
                </div>

            </div>

            {{-- Bottom Option --}}
            <div class="pb-4 text-center">
                <a href="{{ route('app.login') }}" class="text-white/60 hover:text-white text-sm transition">
                    Login with Password instead
                </a>
                <p class="text-white/40 text-xs mt-6">Powered by KTR ERP</p>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        async function startBiometricAuth() {
            const statusMsg = document.getElementById('statusMessage');
            const laserLine = document.getElementById('laserLine');
            const fpIcon = document.getElementById('fpIcon');
            const pulseBg = document.getElementById('pulseBg');

            // 1. Capacitor Native Biometric Plugin access karein
            const NativeBiometric = window.Capacitor?.Plugins?.NativeBiometric;

            if (!NativeBiometric) {
                statusMsg.innerText = "⚠️ Capacitor Biometric plugin not loaded";
                statusMsg.className = "text-sm font-medium text-amber-400 bg-amber-500/10 border border-amber-500/20 rounded-full py-2 px-6";
                return;
            }

            // Start Animation
            statusMsg.innerText = "Scanning... Place finger on device sensor";
            statusMsg.className = "text-sm font-medium text-cyan-300 bg-cyan-500/20 border border-cyan-400/40 rounded-full py-2 px-6 animate-pulse";
            laserLine.classList.remove('hidden');
            fpIcon.classList.add('text-cyan-100', 'scale-110');
            pulseBg.classList.add('bg-cyan-400/40', 'blur-2xl');

            try {
                // 2. Check if biometric is available
                const result = await NativeBiometric.isAvailable();

                if (result.isAvailable) {
                    // 3. Trigger Native System Dialog
                    await NativeBiometric.verifyIdentity({
                        reason: "Log in to Student App",
                        title: "Biometric Verification",
                        subtitle: "Touch fingerprint sensor or look at camera",
                        description: "Confirm your identity to continue",
                    });

                    // Success UI State
                    laserLine.classList.add('hidden');
                    fpIcon.className = "ri-checkbox-circle-fill text-7xl text-emerald-400 transition-all scale-110";
                    pulseBg.className = "absolute -inset-4 rounded-full bg-emerald-500/30 blur-2xl";

                    statusMsg.innerText = "✓ Verification Successful! Redirecting...";
                    statusMsg.className = "text-sm font-medium text-emerald-300 bg-emerald-500/20 border border-emerald-400/40 rounded-full py-2 px-6";

                    // Redirect to dashboard
                    setTimeout(() => {
                        window.location.href = "{{ route('app.onboard') }}";
                    }, 1000);

                } else {
                    throw new Error("Biometric sensor not available");
                }

            } catch (error) {
                // Reset UI on Failure/Cancellation
                laserLine.classList.add('hidden');
                fpIcon.className = "ri-fingerprint-line text-7xl text-red-400";
                pulseBg.className = "absolute -inset-4 rounded-full bg-red-500/20 blur-xl";

                statusMsg.innerText = "❌ Verification Failed. Touch again";
                statusMsg.className = "text-sm font-medium text-red-400 bg-red-500/10 border border-red-500/20 rounded-full py-2 px-6";
                console.log("Biometric Error:", error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                startBiometricAuth();
            }, 500);
        });
    </script>
@endpush