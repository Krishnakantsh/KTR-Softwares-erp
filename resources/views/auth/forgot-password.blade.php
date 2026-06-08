<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | KTR ERP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Matching Premium Loader */
        .loader-wrapper {
            position: fixed;
            inset: 0;
            background: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeOut 1s ease 2.0s forwards;
        }
        .ktr-logo {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -2px;
            animation: pulse 1.5s infinite alternate;
        }
        @keyframes pulse { from { transform: scale(0.95); opacity: 0.8; } to { transform: scale(1.05); opacity: 1; } }
        @keyframes fadeOut { to { opacity: 0; visibility: hidden; } }
        @keyframes load { from { width: 0%; } to { width: 100%; } }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="loader-wrapper" id="loader">
        <div class="flex items-center space-x-3 mb-4">
            <img src="{{asset('while_logo.png')}}" style="height:80px; width:80px;" alt="Logo">
            <h1 class="ktr-logo">KTR ERP</h1>
        </div>
        <div class="w-48 h-1 bg-slate-800 rounded-full overflow-hidden">
            <div class="h-full bg-sky-500 w-full" style="animation: load 1.8s ease-in-out;"></div>
        </div>
        <p class="text-slate-400 mt-4 tracking-widest text-xs uppercase">Security Protocol Initialized</p>
    </div>

    <div class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-100 via-slate-50 to-indigo-100">
        
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200 relative">
            
            <div class="h-2 w-full bg-gradient-to-right bg-sky-500"></div>

            <div class="p-8 md:p-10">
                <div class="flex flex-col items-center mb-8">
                    <img src="{{asset('while_logo.png')}}" class="h-16 w-16 mb-2 grayscale" alt="Logo">
                    <h2 class="text-2xl font-bold text-slate-800">Forgot Password?</h2>
                    <p class="text-slate-500 text-center text-sm mt-2">Enter your email and we'll send you instructions to reset your password.</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Registered Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" required
                                   class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all placeholder:text-slate-400" 
                                   placeholder="name@company.com">
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-bold text-lg shadow-xl shadow-slate-200 transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                        <span>Send Reset Link</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                    <a href="/login" class="text-sm font-bold text-sky-600 hover:text-sky-700 flex items-center justify-center gap-2">
                        <i class="fas fa-chevron-left text-xs"></i>
                        Back to Login
                    </a>
                </div>
            </div>

            <div class="absolute -top-10 -right-10 w-32 h-32 bg-sky-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
        </div>
    </div>

</body>
</html>