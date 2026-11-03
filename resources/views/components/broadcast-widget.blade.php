@if (isset($currentBroadcast))
    @php
        // Dynamic styling dictionary based on broadcast type
        $uiThemes = [
            'announcement' => [
                'bg' => 'linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%)',
                'border' => '#f97316',
                'shadow' => 'rgba(249, 115, 22, 0.2)',
                'avatar_bg' => '#ffedd5',
                'emoji' => '📢',
                'animation' => 'animate-bounce-slow',
            ],
            'broadcast' => [
                'bg' => 'linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%)',
                'border' => '#0284c7',
                'shadow' => 'rgba(2, 132, 199, 0.2)',
                'avatar_bg' => '#bae6fd',
                'emoji' => '📡',
                'animation' => 'animate-pulse-slow',
            ],
            'feature' => [
                'bg' => 'linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%)',
                'border' => '#9333ea',
                'shadow' => 'rgba(147, 51, 234, 0.2)',
                'avatar_bg' => '#f3e8ff',
                'emoji' => '✨',
                'animation' => 'animate-spin-slow',
            ],
            'module' => [
                'bg' => 'linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)',
                'border' => '#16a34a',
                'shadow' => 'rgba(22, 163, 74, 0.2)',
                'avatar_bg' => '#dcfce7',
                'emoji' => '📦',
                'animation' => 'animate-float',
            ],
            'bug_fix' => [
                'bg' => 'linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%)',
                'border' => '#db2777',
                'shadow' => 'rgba(219, 39, 119, 0.2)',
                'avatar_bg' => '#fce7f3',
                'emoji' => '🐛',
                'animation' => 'animate-wiggle',
            ],
            'maintenance' => [
                'bg' => 'linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%)',
                'border' => '#d97706',
                'shadow' => 'rgba(217, 119, 6, 0.2)',
                'avatar_bg' => '#fef3c7',
                'emoji' => '🔧',
                'animation' => 'animate-wrench',
            ],
            'security' => [
                'bg' => 'linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)',
                'border' => '#dc2626',
                'shadow' => 'rgba(220, 38, 38, 0.3)',
                'avatar_bg' => '#fee2e2',
                'emoji' => '🔒',
                'animation' => 'animate-heartbeat',
            ],
            'app_update' => [
                'bg' => 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)',
                'border' => '#2563eb',
                'shadow' => 'rgba(37, 99, 235, 0.2)',
                'avatar_bg' => '#dbeafe',
                'emoji' => '🚀',
                'animation' => 'animate-rocket',
            ],
            'subscription' => [
                'bg' => 'linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%)',
                'border' => '#7c3aed',
                'shadow' => 'rgba(124, 58, 237, 0.2)',
                'avatar_bg' => '#ede9fe',
                'emoji' => '💳',
                'animation' => 'animate-float',
            ],
            'payment' => [
                'bg' => 'linear-gradient(135deg, #f0fdf4 0%, #bbf7d0 100%)',
                'border' => '#15803d',
                'shadow' => 'rgba(21, 128, 61, 0.2)',
                'avatar_bg' => '#bbf7d0',
                'emoji' => '💰',
                'animation' => 'animate-bounce-slow',
            ],
            'holiday' => [
                'bg' => 'linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%)',
                'border' => '#0d9488',
                'shadow' => 'rgba(13, 148, 136, 0.2)',
                'avatar_bg' => '#ccfbf1',
                'emoji' => '🏖️',
                'animation' => 'animate-float',
            ],
            'news' => [
                'bg' => 'linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)',
                'border' => '#475569',
                'shadow' => 'rgba(71, 85, 105, 0.1)',
                'avatar_bg' => '#e2e8f0',
                'emoji' => '📰',
                'animation' => 'animate-pulse-slow',
            ],
            'offer' => [
                'bg' => 'linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%)',
                'border' => '#e11d48',
                'shadow' => 'rgba(225, 29, 72, 0.2)',
                'avatar_bg' => '#ffe4e6',
                'emoji' => '🎁',
                'animation' => 'animate-bounce-slow',
            ],
            'other' => [
                'bg' => 'linear-gradient(135deg, #fafaf9 0%, #f5f5f4 100%)',
                'border' => '#57534e',
                'shadow' => 'rgba(87, 83, 78, 0.1)',
                'avatar_bg' => '#e7e5e4',
                'emoji' => '☕',
                'animation' => 'animate-float',
            ],
        ];

        $currentTheme = $uiThemes[$currentBroadcast->type] ?? $uiThemes['other'];
    @endphp

    <style>
        /* Premium Micro-Animations for UI Feedback */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(36deg);
            }
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-8deg);
            }

            75% {
                transform: rotate(8deg);
            }
        }

        @keyframes heartbeat {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        @keyframes rocket {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-4px) translateX(4px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-bounce-slow {
            animation: float 2.5s ease-in-out infinite;
        }

        .animate-spin-slow {
            animation: spin-slow 4s linear infinite;
        }

        .animate-wiggle {
            animation: wiggle 0.5s ease-in-out infinite alternate;
        }

        .animate-heartbeat {
            animation: heartbeat 1.2s ease-in-out infinite;
        }

        .animate-rocket {
            animation: rocket 2s ease-in-out infinite;
        }

        .premium-card {
            border-radius: 24px !important;
            border: 3.5px solid {{ $currentTheme['border'] }} !important;
            background: {{ $currentTheme['bg'] }} !important;
            box-shadow: 0 20px 25px -5px {{ $currentTheme['shadow'] }}, 0 10px 10px -5px {{ $currentTheme['shadow'] }} !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .premium-card:hover {
            transform: translateY(-5px);
        }

        .cartoon-avatar {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: {{ $currentTheme['avatar_bg'] }};
            border: 3px solid {{ $currentTheme['border'] }};
            font-size: 2.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 -4px 0 rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.05);
        }



        .premium-card {
            border-radius: 20px !important;
            border: 3.5px solid {{ $currentTheme['border'] }} !important;
            background: {{ $currentTheme['bg'] }} !important;
            box-shadow: 0 15px 20px -5px {{ $currentTheme['shadow'] }} !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            min-height: 180px;
            height: auto;
        }

        .premium-card:hover {
            transform: translateY(-3px);
        }

        .cartoon-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: {{ $currentTheme['avatar_bg'] }};
            border: 3px solid {{ $currentTheme['border'] }};
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.1), 0 6px 12px rgba(0, 0, 0, 0.05);
        }
    </style>

    {{-- <div x-data="broadcastWidget('{{ $currentBroadcast->uuid }}', '{{ $currentBroadcast->repeat_type }}')" x-show="show" x-init="initWidget()" style="display: none; transition: all 0.3s ease;"
        class="card premium-card mb-4 position-relative overflow-hidden ">


        <div class="position-absolute top-0 start-0 end-0">

        </div>

        <div class="card-body p-16 md:p-28 ">
            <div class="d-flex align-items-center gap-4 flex-column flex-sm-row position-relative ">

                <div class="flex-shrink-0">
                    <div class="cartoon-avatar {{ $currentTheme['animation'] }}">
                        {{ $currentTheme['emoji'] }}
                    </div>
                </div>
                <div class="flex-grow-1 text-center text-sm-start min-w-0">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 flex-wrap mb-2">
                        <h4 class="fw-extrabold mb-0 text-dark" style="font-size: 1.35rem; letter-spacing: -0.025em;">
                            {{ $currentBroadcast->title }}
                        </h4>
                        <span class="badge text-uppercase font-bold"
                            style="font-size: 0.75rem; padding: 5px 12px; border-radius: 50px; background-color: {{ $currentTheme['border'] }}; color: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                            {{ str_replace('_', ' ', $currentBroadcast->type) }}
                        </span>
                    </div>

                    <p class="mb-0 fw-medium" style="font-size: 0.98rem; line-height: 1.6; color: #374151;">
                        {{ $currentBroadcast->description }}
                    </p>

                    @if ($currentBroadcast->button_text && $currentBroadcast->button_url)
                        <div class="mt-3">
                            <a href="{{ $currentBroadcast->button_url }}" @click="trackClick()" target="_blank"
                                class="btn rounded-pill d-inline-flex align-items-center gap-2 px-16 py-2.5 fw-bold transition-all"
                                style="font-size: 0.9rem; color: #fff; background-color: {{ $currentTheme['border'] }}; border: none; box-shadow: 0 6px 12px {{ $currentTheme['shadow'] }};">
                                <span>{{ $currentBroadcast->button_text }}</span>
                                <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>

                @if ($currentBroadcast->is_dismissible)
                    <div class="position-absolute top-0 end-0">
                        <button type="button" @click="dismissWidget()" class="btn-close shadow-none p-8 rounded-circle"
                            style="font-size: 0.9rem; background-color: rgba(0,0,0,0.06); border: 2px solid red;"
                            aria-label="Close"></button>
                    </div>
                @endif
            </div>

            @if ($currentBroadcast->requires_acknowledgement)
                <div class="mt-4 pt-3 d-flex align-items-center justify-content-between gap-3 flex-wrap"
                    style="border-top: 2px dashed {{ $currentTheme['border'] }}70;">
                    <span class="d-flex align-items-center gap-2 fw-bold" style="font-size: 0.88rem; color: #1f2937;">
                        <span class="animate-heartbeat">⚠️</span> This announcement requires your acknowledgment.
                    </span>
                    <button type="button" @click="acknowledgeWidget()"
                        class="btn btn-success btn-md px-4 py-2 fw-bold rounded-pill shadow-sm hover:scale-105 transition-all"
                        style="font-size: 0.85rem; background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); border: none;">
                        I Acknowledge & Agree
                    </button>
                </div>
            @endif
        </div>
    </div> --}}

    <div x-data="broadcastWidget('{{ $currentBroadcast->uuid }}', '{{ $currentBroadcast->repeat_type }}')" x-show="show" x-init="initWidget()" style="display: none; transition: all 0.3s ease;"
        class="card premium-card mb-4 position-relative overflow-hidden">

        <div class="card-body p-3 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center gap-3 position-relative flex-nowrap">

                {{-- Cartoon Avatar Column --}}
                <div class="flex-shrink-0">
                    <div class="cartoon-avatar {{ $currentTheme['animation'] }}">
                        {{ $currentTheme['emoji'] }}
                    </div>
                </div>

                {{-- Text Content Area --}}
                <div class="flex-grow-1 min-w-0">
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                        <h5 class="fw-extrabold mb-0 text-dark"
                            style="font-size: 1.15rem; letter-spacing: -0.01em; line-height: 1.2;">
                            {{ $currentBroadcast->title }}
                        </h5>
                        <span class="badge text-uppercase font-bold"
                            style="font-size: 0.65rem; padding: 3px 8px; border-radius: 50px; background-color: {{ $currentTheme['border'] }}; color: #fff;">
                            {{ str_replace('_', ' ', $currentBroadcast->type) }}
                        </span>
                    </div>

                    <p class="mb-0 fw-medium text-secondary"
                        style="font-size: 0.9rem; line-height: 1.4; color: #4b5563;">
                        {{ $currentBroadcast->description }}
                    </p>


                </div>

                {{-- Dismiss Button --}}
                @if ($currentBroadcast->is_dismissible)
                    <div class="align-self-start pt-1">
                        <button type="button" @click="dismissWidget()"
                            class="btn-close shadow-none p-1.5 rounded-circle"
                            style="font-size: 0.75rem; background-color: rgba(0,0,0,0.06);" aria-label="Close"></button>
                    </div>
                @endif
            </div>


            <div class="mt-12 pt-12 d-flex align-items-center justify-content-between gap-2 flex-wrap"
                style="border-top: 1.5px dashed {{ $currentTheme['border'] }}50;">

                @if ($currentBroadcast->button_text && $currentBroadcast->button_url)
                    <span class="d-flex align-items-center gap-1 fw-bold" style="font-size: 0.8rem; color: #1f2937;">
                      
                    </span>
                @endif

                @if ($currentBroadcast->button_text && $currentBroadcast->button_url)
                    <div class="mt-2">
                        <a href="{{ $currentBroadcast->button_url }}" @click="trackClick()" target="_blank"
                            class="btn rounded-pill d-inline-flex align-items-center gap-2 px-3 py-1 fw-bold transition-all "
                            style="font-size: 0.8rem; color: #fff; background-color: {{ $currentTheme['border'] }}; border: none; box-shadow: 0 4px 8px {{ $currentTheme['shadow'] }};">
                            <span>{{ $currentBroadcast->button_text }}</span>
                            <svg style="width: 12px; height: 12px;" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                @endif


                @if ($currentBroadcast->requires_acknowledgement)
                    <span class="d-flex align-items-center gap-1 fw-bold" style="font-size: 0.8rem; color: #1f2937;">
                        <span class="animate-heartbeat">⚠️</span> Acknowledgment Required.
                    </span>
                @endif

                @if ($currentBroadcast->requires_acknowledgement)
                    <button type="button" @click="acknowledgeWidget()"
                        class="btn btn-success btn-sm px-3 py-1 fw-bold rounded-pill"
                        style="font-size: 0.75rem; background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); border: none;">
                        I Agree
                    </button>
                @endif
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('alpine:init', () => {
            if (!Alpine.store('broadcastInitialized')) {
                Alpine.store('broadcastInitialized', true);
            } else {
                return;
            }

            Alpine.data('broadcastWidget', (uuid, repeatType) => ({
                show: false,
                uuid: uuid,
                repeatType: repeatType,

                initWidget() {
                    if (this.repeatType === 'every_login' && sessionStorage.getItem(
                            `broadcast_dismissed_${this.uuid}`)) {
                        this.show = false;
                        return;
                    }
                    this.show = true;
                    this.sendAction('seen');
                },

                trackClick() {
                    this.sendAction('click');
                },

                dismissWidget() {
                    this.show = false;
                    if (this.repeatType === 'every_login') {
                        sessionStorage.setItem(`broadcast_dismissed_${this.uuid}`, 'true');
                    }
                    this.sendAction('dismiss');
                },

                acknowledgeWidget() {
                    this.show = false;
                    this.sendAction('acknowledge');
                },

                async sendAction(actionType) {
                    try {
                        await fetch(`/broadcasts/${this.uuid}/action`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                action: actionType,
                                platform: 'web'
                            })
                        });
                    } catch (error) {
                        console.error("Broadcast tracking error:", error);
                    }
                }
            }));
        });
    </script>
@endif
