<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTR ERP | Enterprise Suite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Glassmorphism Effect for Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        /* Custom Character positioning to make it overlay nicely */
        .character-img {
            max-height: 280px;
            object-fit: contain;
            filter: drop-shadow(0px 10px 20px rgba(0, 0, 0, 0.3));
        }

        /* Existing Loader Styles */
        .loader-wrapper {
            position: fixed;
            inset: 0;
            background: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeOut 1s ease 2.5s forwards;
        }

        .ktr-logo {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -2px;
            animation: pulse 1s infinite alternate;
        }

        @keyframes pulse {
            from {
                transform: scale(0.95);
                opacity: 0.8;
            }

            to {
                transform: scale(1.05);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
</head>

<!-- Premium Background Image (Abstract Corporate Tech Style) -->

<body
    class="text-slate-900 bg-slate-900 min-h-screen relative flex items-center justify-center p-4 md:p-6 bg-cover bg-center bg-no-repeat"
    style="background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.8)), url('../assets/images/bg/login_bg.avif');">

    @include('Helpers.loader');

    <!-- Main Container -->
    <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-center relative my-auto">

        <!-- Glassmorphic Form Card Wrapper -->
        <div
            class="w-full glass-card rounded-[2.5rem] shadow-[0_25px_70px_-15px_rgba(0,0,0,0.4)] overflow-hidden flex flex-col md:flex-row transition-all duration-300">

            <!-- Left Panel (Dark Premium Content) -->
            <div
                class="md:w-5/12 bg-slate-950 p-8 md:p-10 text-white flex flex-col justify-between relative overflow-hidden min-h-[40px] md:min-h-[550px]">

                <!-- Background ambient glows -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-sky-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>

                <!-- Brand and Text -->
                <div class="z-10 relative">
                    <div class="flex items-center space-x-3 mb-2 justify-center md:justify-start">
                        <img src="{{ asset('while_logo.png') }}" class="h-16 w-16 md:h-12 md:w-12" alt="Logo"
                            onerror="this.src='https://cdn-icons-png.flaticon.com/512/6062/6062646.png'">
                        <span class="text-2xl md:text-2xl font-bold tracking-tight">KTR <span
                                class="text-sky-400">ERP</span></span>
                    </div>
                    <div class="hidden md:block mt-6">
                        <h2
                            class="text-2xl font-bold leading-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                            Manage everything in one place.</h2>
                        <p class="mt-3 text-slate-400 text-xs leading-relaxed">Secure, Scalable, and Smart solution for
                            modern businesses.</p>
                    </div>
                </div>

                <!-- Premium Welcome Cartoon Character (Overlaying beautifully at the bottom) -->
                <div
                    class="absolute bottom-0 right-0 left-0  justify-center md:justify-start md:left-6 z-20 pointer-events-none hidden md:flex">

                    <img src="https://illustrations.popsy.co/white/keynote-presentation.svg"
                        alt="Welcome Cartoon Character"
                        class="character-img opacity-95 md:opacity-100 transform md:scale-110 origin-bottom-left">
                </div>

                <!-- Social Proofing (Hidden on small screens to avoid clash with character) -->
                <div class="mt-auto z-10 hidden md:block pb-4">
                    <div class="flex -space-x-2">
                        <img class="w-7 h-7 rounded-full border-2 border-slate-950" src="https://i.pravatar.cc/100?u=1"
                            alt="User">
                        <img class="w-7 h-7 rounded-full border-2 border-slate-950" src="https://i.pravatar.cc/100?u=2"
                            alt="User">
                        <img class="w-7 h-7 rounded-full border-2 border-slate-950" src="https://i.pravatar.cc/100?u=3"
                            alt="User">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-2 font-medium"><i
                            class="fa-solid fa-circle-check text-emerald-400 mr-1"></i> Trusted by 500+ Institutions</p>
                </div>
            </div>

            <!-- Right Panel (Login Form Dynamic Content Area) -->
            <div class="md:w-7/12 p-8 md:p-12 bg-white/90 flex flex-col justify-center">
                @yield('content')
            </div>

        </div>
    </div>

</body>

</html>
