<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTR ERP | Enterprise Suite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: #f8fafc;
        }

        /* --- Dynamic Aurora Background --- */
        .aurora-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            background: radial-gradient(circle at 50% 50%, #eff6ff 0%, #ffffff 100%);
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.4) 0%, rgba(129, 140, 248, 0.2) 50%, transparent 70%);
            filter: blur(60px);
            border-radius: 50%;
            z-index: 1;
            mix-blend-mode: multiply;
            animation: move 20s infinite alternate;
        }

        .blob-1 {
            top: -100px;
            right: -100px;
            animation-duration: 15s;
            background: rgba(56, 189, 248, 0.4);
        }

        .blob-2 {
            bottom: -150px;
            left: -100px;
            animation-duration: 25s;
            animation-delay: -5s;
            background: rgba(129, 140, 248, 0.3);
        }

        .blob-3 {
            top: 40%;
            left: 10%;
            animation-duration: 20s;
            animation-delay: -2s;
            width: 300px;
            height: 300px;
        }

        @keyframes move {
            0% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(100px, -50px) scale(1.2);
            }

            66% {
                transform: translate(-50px, 100px) scale(0.8);
            }

            100% {
                transform: translate(0, 0) scale(1);
            }
        }

        /* --- Form Card & UI Fixes --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 10;
        }

        /* Existing Loader */
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

<body class="text-slate-900">

     {{-- @include('Frontend/Normal/Admin_Pages/loader'); --}}

    {{-- <div class="loader-wrapper" id="loader">
        <div class="flex items-center space-x-3 mb-4">
            <img src="{{ asset('while_logo.png') }}" class="h-20 w-20" alt="">
            <h1 class="ktr-logo">KTR ERP</h1>
        </div>
        <div class="w-48 h-1 bg-slate-800 rounded-full overflow-hidden">
            <div class="h-full bg-sky-500 w-full" style="animation: load 2s ease-in-out;"></div>
        </div>
    </div> --}}

    <div class="aurora-container">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div class="min-h-screen relative flex items-center justify-center p-4 md:p-6">

        <div
            class="w-full max-w-4xl glass-card rounded-[2.5rem] shadow-[0_20px_70px_-15px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col md:flex-row border border-slate-200">

            <div
                class="md:w-1/3 bg-slate-900 p-8 md:p-10 text-white flex flex-col justify-between relative overflow-hidden transition-all duration-500">
                <div class="z-10">
                    <div class="flex items-center space-x-3 mb-0 md:mb-8 justify-center md:justify-start">
                        <img src="{{ asset('while_logo.png') }}" class="h-10 w-10 md:h-16 md:w-16" alt="Logo">
                        <span class="text-xl md:text-2xl font-bold tracking-tight">KTR <span
                                class="text-sky-400">ERP</span></span>
                    </div>
                    <div class="hidden md:block mt-8">
                        <h2 class="text-2xl font-bold leading-tight">Manage everything in one place.</h2>
                        <p class="mt-4 text-slate-400 text-xs">Secure, Scalable, and Smart solution for modern
                            businesses.</p>
                    </div>
                </div>

                <div class="mt-10 z-10 hidden md:block">
                    <div class="flex -space-x-2">
                        <img class="w-8 h-8 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?u=1"
                            alt="">
                        <img class="w-8 h-8 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?u=2"
                            alt="">
                    </div>
                    <p class="text-[10px] text-slate-500 mt-2">Trusted by 500+ Institutions</p>
                </div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-sky-500/20 rounded-full blur-2xl"></div>
            </div>

            <div class="md:w-2/3 p-8 md:p-14 bg-white/80">
                @yield('content')
            </div>

        </div>
    </div>

</body>

</html>
