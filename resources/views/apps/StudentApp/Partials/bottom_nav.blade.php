{{-- ================= PREMIUM BOTTOM NAVIGATION ================= --}}

<nav class="fixed bottom-0 left-0 right-0 z-50">

    <div class="max-w-md mx-auto px-5 pb-[max(env(safe-area-inset-bottom),12px)]">

        <div
            class="h-20 rounded-[30px]
            bg-white/90
            backdrop-blur-3xl
            border border-white
            shadow-[0_-10px_35px_rgba(0,0,0,.08)]
            flex items-center justify-around">


            {{-- HOME --}}

            <a href="{{route('app.student.dashboard')}}" class="flex flex-col items-center">

                <div
                    class="w-12 h-12 rounded-2xl
                    bg-gradient-to-br from-violet-600 to-indigo-600
                    flex items-center justify-center
                    shadow-lg shadow-violet-300">

                    <i class="ri-home-5-fill text-white text-2xl"></i>

                </div>

                {{-- <span class="mt-1 text-[11px] font-bold text-violet-600">
                    Home
                </span> --}}

            </a>



            {{-- CLASSES --}}

            <a href="{{route('app.student.dashboard')}}" class="flex flex-col items-center">

                <div
                    class="w-11 h-11 rounded-2xl
                    flex items-center justify-center
                    bg-slate-100">

                    <i class="ri-book-open-line text-slate-500 text-2xl"></i>

                </div>

                {{-- <span class="mt-1 text-[11px] text-slate-500">
                    Classes
                </span> --}}

            </a>




            {{-- NOTIFICATION --}}

            <a href="{{route('app.student.dashboard')}}" class="relative flex flex-col items-center">

                <div
                    class="w-11 h-11 rounded-2xl
                    bg-slate-100
                    flex items-center justify-center">

                    <i class="ri-notification-3-line text-slate-500 text-2xl"></i>

                </div>


                <span
                    class="absolute top-0 right-1
                    w-5 h-5 rounded-full
                    bg-red-500
                    text-white
                    text-[10px]
                    flex items-center justify-center
                    font-bold
                    shadow-md">

                    5

                </span>


                {{-- <span class="mt-1 text-[11px] text-slate-500">
                    Alerts
                </span> --}}


            </a>




            {{-- PROFILE --}}

            <a href="{{route('app.student.profile')}}" class="flex flex-col items-center">


                <div
                    class="w-11 h-11 rounded-2xl
                    bg-gradient-to-br from-pink-500 to-violet-600
                    flex items-center justify-center
                    shadow-md">


                    <i class="ri-user-3-fill text-white text-2xl"></i>


                </div>


                {{-- <span class="mt-1 text-[11px] text-slate-500">
                    Profile
                </span> --}}


            </a>


        </div>

    </div>

</nav>



{{-- ================= FLOATING CHAT BUTTON ================= --}}

{{-- <a href="" class="fixed bottom-28 right-5 z-50">


    <div
        class="w-16 h-16 rounded-full
        bg-gradient-to-r
        from-violet-600
        to-indigo-600
        shadow-[0_15px_35px_rgba(124,58,237,.45)]
        flex items-center justify-center">


        <i class="ri-chat-3-fill text-white text-3xl"></i>


    </div>


</a> --}}
