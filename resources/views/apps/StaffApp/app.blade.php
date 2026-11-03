<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTR Student App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #818CF8;
            --secondary: #7C3AED;
            --accent: #06B6D4;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --gold: #F4C542;
            --bg-lav: #F2F1FC;
            --bg-blue: #EEF6FF;
            --ink: #1E1B2E;
            --ink-soft: #6B6580;
            --ink-faint: #9C97AE;
            --glass: rgba(255, 255, 255, 0.62);
            --glass-border: rgba(255, 255, 255, 0.85);
            --radius-lg: 26px;
            --radius-md: 20px;
            --radius-sm: 14px;
            --shadow-soft: 0 10px 30px -10px rgba(79, 70, 229, 0.18), 0 2px 8px -2px rgba(30, 27, 46, 0.06);
            --shadow-pop: 0 20px 45px -12px rgba(79, 70, 229, 0.30);
            --font-display: 'Poppins', 'SF Pro Display', sans-serif;
            --font-body: 'Inter', 'SF Pro Text', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-tap-highlight-color: transparent;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: var(--font-body);
            background:
                radial-gradient(1200px 600px at 15% -10%, #E9E4FF 0%, transparent 60%),
                radial-gradient(1000px 700px at 110% 10%, #DFF3FF 0%, transparent 55%),
                linear-gradient(180deg, #F7F6FC 0%, #F2F1FC 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
            color: var(--ink);
        }

        .stage {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .stage-label {
            font-family: var(--font-body);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--ink-faint);
        }

        /* ---------- PHONE FRAME ---------- */
        .phone {
            position: relative;
            width: 390px;
            height: 844px;
            background: #08070F;
            border-radius: 56px;
            padding: 14px;
            box-shadow: 0 40px 90px -20px rgba(30, 27, 60, 0.45), 0 10px 30px -10px rgba(30, 27, 60, 0.3), inset 0 0 0 2px rgba(255, 255, 255, 0.06);
        }

        .phone::before {
            content: '';
            position: absolute;
            top: 14px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 28px;
            background: #08070F;
            border-radius: 0 0 20px 20px;
            z-index: 50;
        }

        .screen-root {
            position: relative;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, #FBFAFF 0%, var(--bg-lav) 55%, var(--bg-blue) 100%);
            border-radius: 42px;
            overflow: hidden;
        }

        .view {
            position: absolute;
            inset: 0;
            display: none;
            flex-direction: column;
            animation: viewIn .45s cubic-bezier(.22, 1, .36, 1);
        }

        .view.active {
            display: flex;
        }

        @keyframes viewIn {
            from {
                opacity: 0;
                transform: translateY(14px) scale(.99);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .status-bar {
            height: 48px;
            flex: 0 0 auto;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 0 28px 6px;
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .scroll {
            flex: 1;
            overflow-y: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            padding-bottom: 110px;
        }

        .scroll::-webkit-scrollbar {
            display: none;
        }

        /* ---------- GLASS CARD ---------- */
        .card {
            background: var(--glass);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
        }

        .card-sm {
            border-radius: var(--radius-md);
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: var(--font-display);
            color: var(--ink);
            font-weight: 700;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink-faint);
        }

        /* ---------- BOTTOM NAV ---------- */
        .bottom-nav {
            position: absolute;
            left: 16px;
            right: 16px;
            bottom: 18px;
            z-index: 40;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 12px 10px;
            border-radius: 28px;
            background: rgba(30, 27, 46, 0.88);
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px -12px rgba(30, 27, 46, 0.5);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: rgba(255, 255, 255, 0.5);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 16px;
            transition: all .25s ease;
            font-family: var(--font-body);
            font-size: 10px;
            font-weight: 600;
        }

        .nav-item svg {
            width: 22px;
            height: 22px;
            transition: all .25s ease;
        }

        .nav-item.active {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 8px 20px -6px rgba(79, 70, 229, 0.7);
        }

        .nav-item.active svg {
            transform: translateY(-1px);
        }

        /* ---------- FAB ---------- */
        .fab {
            position: absolute;
            right: 20px;
            bottom: 96px;
            z-index: 41;
            width: 56px;
            height: 56px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            box-shadow: 0 14px 30px -8px rgba(6, 182, 212, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floaty 3s ease-in-out infinite;
        }

        @keyframes floaty {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        ::selection {
            background: var(--primary-light);
            color: #fff;
        }

        /* ---------- SPLASH ---------- */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: .5;
        }

        .b1 {
            width: 220px;
            height: 220px;
            background: #F4C542;
            top: -60px;
            left: -60px;
            animation: driftA 8s ease-in-out infinite;
        }

        .b2 {
            width: 260px;
            height: 260px;
            background: #06B6D4;
            bottom: -80px;
            right: -70px;
            animation: driftB 9s ease-in-out infinite;
        }

        .b3 {
            width: 160px;
            height: 160px;
            background: #fff;
            top: 40%;
            right: -40px;
            animation: driftA 7s ease-in-out infinite reverse;
        }

        @keyframes driftA {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(18px, -14px);
            }
        }

        @keyframes driftB {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-16px, 16px);
            }
        }

        @keyframes logoPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.06);
            }
        }

        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.35);
        }

        .dot.on {
            width: 20px;
            background: #fff;
        }

        /* ---------- FORM ---------- */
        .input-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: #fff;
            border: 1.5px solid #E8E5F7;
            border-radius: 16px;
            padding: 12px 16px;
        }

        .input-field input {
            border: none;
            outline: none;
            font-family: var(--font-body);
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            background: none;
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            font-family: var(--font-body);
            font-weight: 700;
            font-size: 15px;
            box-shadow: var(--shadow-pop);
            cursor: pointer;
        }

        .btn-ghost {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px;
            border-radius: 16px;
            border: 1.5px solid #E8E5F7;
            background: #fff;
            color: var(--ink);
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
        }

        /* ---------- APP SHELL ---------- */
        #view-app {
            background: none;
        }

        .tab {
            position: absolute;
            inset: 0;
            display: none;
            flex-direction: column;
        }

        .tab.active {
            display: flex;
        }

        .icon-btn {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1.5px solid #E8E5F7;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .badge-dot {
            position: absolute;
            top: 7px;
            right: 8px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--danger);
            border: 1.5px solid #fff;
        }

        .tab-header {
            padding: 8px 18px 6px;
        }

        .tab-sub {
            font-size: 12px;
            color: var(--ink-soft);
            font-weight: 500;
            margin-top: 2px;
        }

        .link-sm {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            cursor: pointer;
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-lg);
            padding: 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: var(--shadow-pop);
            margin-top: 2px;
        }

        .hero-mesh {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 85% 15%, rgba(244, 197, 66, 0.35), transparent 55%), radial-gradient(circle at 10% 90%, rgba(6, 182, 212, 0.35), transparent 50%);
        }

        .hero-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 7px 11px;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
        }

        .stat-card {
            border-radius: var(--radius-md);
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        .stat-icon {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 10px;
        }

        .qa {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .qa-ico {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            box-shadow: 0 8px 16px -6px rgba(79, 70, 229, 0.4);
        }

        .qa span {
            font-size: 10px;
            font-weight: 600;
            color: var(--ink-soft);
            text-align: center;
        }

        .class-card {
            flex: 0 0 150px;
            background: #fff;
            border: 1.5px solid #EDEAF7;
            border-radius: var(--radius-md);
            padding: 14px;
        }

        .cc-title {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 14px;
            margin-top: 6px;
        }

        .cc-sub {
            font-size: 11px;
            color: var(--ink-soft);
            margin-top: 4px;
            font-weight: 500;
        }

        .cc-teacher {
            font-size: 11px;
            color: var(--primary);
            margin-top: 8px;
            font-weight: 700;
        }

        .list-card {
            background: #fff;
            border: 1.5px solid #EDEAF7;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .hw-row,
        .menu-row,
        .lb-row,
        .subj-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            border-bottom: 1px solid #F3F1FA;
            cursor: pointer;
        }

        .hw-row:last-child,
        .menu-row:last-child,
        .lb-row:last-child,
        .subj-row:last-child {
            border-bottom: none;
        }

        .hw-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex: 0 0 auto;
        }

        .hw-t {
            font-weight: 600;
            font-size: 13px;
        }

        .hw-s {
            font-size: 11px;
            color: var(--ink-soft);
            margin-top: 2px;
        }

        .notice-card {
            background: linear-gradient(135deg, #EEF6FF, #F0EEFF);
            border: 1.5px solid #DCE6FF;
            border-radius: var(--radius-md);
            padding: 16px;
        }

        .notice-tag {
            display: inline-block;
            background: var(--primary);
            color: #fff;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: .06em;
            padding: 4px 9px;
            border-radius: 8px;
        }

        .lb-rank {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 11.5px;
            color: #fff;
        }

        .day-chip {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1.5px solid #EDEAF7;
            border-radius: 14px;
            padding: 10px 0;
            font-size: 11px;
            font-weight: 700;
            color: var(--ink-soft);
        }

        .day-chip span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .day-chip.present span {
            background: var(--success);
        }

        .day-chip.leave span {
            background: var(--warning);
        }

        .day-chip.future span {
            background: #DAD6EC;
        }

        .day-pill {
            flex: 0 0 auto;
            padding: 9px 16px;
            border-radius: 14px;
            background: #fff;
            border: 1.5px solid #EDEAF7;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--ink-soft);
        }

        .day-pill.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-color: transparent;
        }

        .bar-track {
            flex: 2;
            height: 8px;
            border-radius: 5px;
            background: #F0EEF9;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 5px;
        }

        .bar-pct {
            width: 34px;
            text-align: right;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--ink-soft);
        }

        .tt-row {
            display: flex;
            gap: 12px;
            padding: 0 18px;
            margin-bottom: 12px;
        }

        .tt-time {
            flex: 0 0 44px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--ink-faint);
            padding-top: 14px;
        }

        .tt-card {
            flex: 1;
            background: #fff;
            border: 1.5px solid #EDEAF7;
            border-left: 4px solid;
            border-radius: var(--radius-sm);
            padding: 12px 14px;
        }

        .tt-card.active-now {
            background: linear-gradient(135deg, #EAFBF3, #fff);
            box-shadow: var(--shadow-soft);
        }

        .tt-subj {
            font-weight: 700;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tt-meta {
            font-size: 11.5px;
            color: var(--ink-soft);
            margin-top: 3px;
            font-weight: 500;
        }

        .live-tag {
            background: var(--success);
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 6px;
            letter-spacing: .05em;
        }

        .menu-ico {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex: 0 0 auto;
        }

        .toggle {
            width: 38px;
            height: 22px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            position: relative;
            flex: 0 0 auto;
        }

        .toggle::after {
            content: '';
            position: absolute;
            top: 2px;
            right: 2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
        }
    </style>
</head>

<body>
    <div class="stage">
        <div class="stage-label">KTR Student App — Prototype</div>
        <div class="phone">
            <div class="screen-root" id="screenRoot">
                <!-- SCREENS INSERTED BELOW -->

                <!-- ============ SPLASH ============ -->
                <div class="view active" id="view-splash"
                    style="align-items:center; justify-content:center; background:linear-gradient(160deg,#4F46E5 0%, #6D3FE0 45%, #7C3AED 100%); position:relative; overflow:hidden;">
                    <div class="blob b1"></div>
                    <div class="blob b2"></div>
                    <div class="blob b3"></div>
                    <div
                        style="position:relative; z-index:2; display:flex; flex-direction:column; align-items:center; gap:18px;">
                        <div
                            style="width:92px; height:92px; border-radius:28px; background:rgba(255,255,255,0.16); border:1px solid rgba(255,255,255,0.35); display:flex; align-items:center; justify-content:center; backdrop-filter:blur(6px); animation:logoPulse 2.4s ease-in-out infinite;">
                            <svg width="46" height="46" viewBox="0 0 24 24" fill="none">
                                <path d="M12 3L2 8L12 13L22 8L12 3Z" stroke="#fff" stroke-width="1.6"
                                    stroke-linejoin="round" />
                                <path d="M6 10.5V16C6 16 8.5 18 12 18C15.5 18 18 16 18 16V10.5" stroke="#fff"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M22 8V14" stroke="#F4C542" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div style="text-align:center;">
                            <div
                                style="font-family:var(--font-display); font-weight:800; font-size:28px; color:#fff; letter-spacing:-0.02em;">
                                KTR Student</div>
                            <div
                                style="font-family:var(--font-body); font-weight:500; font-size:13px; color:rgba(255,255,255,0.75); margin-top:4px; letter-spacing:.02em;">
                                Your school, beautifully organized</div>
                        </div>
                    </div>
                    <div style="position:absolute; bottom:56px; display:flex; gap:8px;">
                        <span class="dot on"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <button onclick="goto('view-onboard')" style="position:absolute; bottom:0; opacity:0;">next</button>
                </div>

                <!-- ============ ONBOARDING ============ -->
                <div class="view" id="view-onboard" style="justify-content:space-between; padding:0 0 28px;">
                    <div
                        style="flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:32px;">
                        <div
                            style="width:100%; aspect-ratio:1.1; border-radius:32px; background:linear-gradient(135deg,#EDEBFF,#DFF3FF); display:flex; align-items:center; justify-content:center; margin-bottom:32px; position:relative; overflow:hidden;">
                            <svg width="150" height="150" viewBox="0 0 200 200" fill="none">
                                <circle cx="100" cy="100" r="86" fill="url(#og1)" opacity="0.5" />
                                <rect x="55" y="70" width="90" height="70" rx="10" fill="#fff"
                                    stroke="#4F46E5" stroke-width="2.5" />
                                <path d="M55 88H145" stroke="#4F46E5" stroke-width="2.5" />
                                <circle cx="70" cy="79" r="3" fill="#EF4444" />
                                <circle cx="80" cy="79" r="3" fill="#F59E0B" />
                                <circle cx="90" cy="79" r="3" fill="#10B981" />
                                <rect x="66" y="98" width="34" height="8" rx="4" fill="#7C3AED" />
                                <rect x="66" y="112" width="52" height="8" rx="4" fill="#06B6D4" />
                                <rect x="66" y="126" width="24" height="8" rx="4" fill="#F4C542" />
                                <circle cx="128" cy="118" r="16" fill="#10B981" />
                                <path d="M121 118l5 5 10-11" stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <defs>
                                    <linearGradient id="og1" x1="0" y1="0" x2="200"
                                        y2="200">
                                        <stop stop-color="#7C3AED" />
                                        <stop offset="1" stop-color="#06B6D4" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <h2 style="font-size:23px; text-align:center; margin-bottom:10px;">Everything school,<br />in
                            one premium app</h2>
                        <p
                            style="text-align:center; color:var(--ink-soft); font-size:14px; line-height:1.5; max-width:280px;">
                            Attendance, homework, fees, results and more — tracked beautifully, updated in real time.
                        </p>
                    </div>
                    <div style="padding:0 28px;">
                        <button class="btn-primary" onclick="goto('view-login')">Get Started</button>
                        <button onclick="goto('view-login')"
                            style="width:100%; background:none; border:none; text-align:center; padding:14px; font-family:var(--font-body); font-weight:600; font-size:13px; color:var(--ink-soft);">I
                            already have an account</button>
                    </div>
                </div>

                <!-- ============ LOGIN ============ -->
                <div class="view" id="view-login" style="padding:0 26px; justify-content:center;">
                    <div style="margin-bottom:34px;">
                        <div
                            style="width:52px; height:52px; border-radius:16px; background:linear-gradient(135deg,var(--primary),var(--secondary)); display:flex; align-items:center; justify-content:center; margin-bottom:20px; box-shadow:var(--shadow-pop);">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                                <path d="M12 3L2 8L12 13L22 8L12 3Z" stroke="#fff" stroke-width="1.8"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h1 style="font-size:26px; margin-bottom:6px;">Welcome back 👋</h1>
                        <p style="color:var(--ink-soft); font-size:14px;">Login to continue to Kalasalingam Techno
                            Residential School</p>
                    </div>
                    <div style="display:flex; flex-direction:column; gap:14px;">
                        <div class="input-field"><span class="eyebrow">STUDENT ID</span><input type="text"
                                placeholder="KTR2026S1042" value="KTR2026S1042"></div>
                        <div class="input-field"><span class="eyebrow">PASSWORD</span><input type="password"
                                placeholder="••••••••" value="••••••••"></div>
                        <div style="display:flex; justify-content:flex-end;"><span
                                style="font-size:12.5px; font-weight:600; color:var(--primary);">Forgot
                                Password?</span></div>
                        <button class="btn-primary" onclick="loginSequence()">Login</button>
                        <div style="display:flex; align-items:center; gap:10px; margin:6px 0;">
                            <div style="flex:1; height:1px; background:#E4E1F5;"></div><span
                                style="font-size:11px; color:var(--ink-faint); font-weight:600;">OR</span>
                            <div style="flex:1; height:1px; background:#E4E1F5;"></div>
                        </div>
                        <div style="display:flex; gap:12px;">
                            <button class="btn-ghost" onclick="loginSequence()"><svg width="18" height="18"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect x="3" y="4" width="18" height="16" rx="4" stroke="#4F46E5"
                                        stroke-width="1.7" />
                                    <path d="M8 2v4M16 2v4M3 10h18" stroke="#4F46E5" stroke-width="1.7"
                                        stroke-linecap="round" />
                                </svg> OTP</button>
                            <button class="btn-ghost" onclick="loginSequence()"><svg width="18" height="18"
                                    viewBox="0 0 24 24" fill="none">
                                    <path d="M12 15a3 3 0 003-3V7a3 3 0 10-6 0v5a3 3 0 003 3z" stroke="#4F46E5"
                                        stroke-width="1.7" />
                                    <path d="M6 11v1a6 6 0 0012 0v-1M12 18v3" stroke="#4F46E5" stroke-width="1.7"
                                        stroke-linecap="round" />
                                </svg> Face ID</button>
                        </div>
                    </div>
                </div>

                <!-- ============ MAIN APP ============ -->
                <div class="view" id="view-app">

                    <!-- ---- DASHBOARD TAB ---- -->
                    <div class="tab active" id="tab-dashboard">
                        <div class="status-bar"><span>9:41</span><span
                                style="display:flex; gap:5px; align-items:center;"><svg width="16" height="12"
                                    viewBox="0 0 16 12" fill="none">
                                    <rect x="0" y="7" width="3" height="5" rx="1" fill="#1E1B2E" />
                                    <rect x="4.5" y="4" width="3" height="8" rx="1"
                                        fill="#1E1B2E" />
                                    <rect x="9" y="1.5" width="3" height="10.5" rx="1"
                                        fill="#1E1B2E" />
                                </svg></span></div>
                        <div class="scroll" style="padding:0 18px;">

                            <!-- Top bar -->
                            <div
                                style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div
                                        style="width:40px; height:40px; border-radius:12px; background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; font-family:var(--font-display); font-size:15px;">
                                        KT</div>
                                    <div>
                                        <div
                                            style="font-size:10.5px; font-weight:700; color:var(--ink-faint); letter-spacing:.05em;">
                                            KTR SCHOOL · SESSION 2026-27</div>
                                        <div style="font-size:13px; font-weight:700;">Grade 10 — Section B</div>
                                    </div>
                                </div>
                                <div style="display:flex; gap:8px;">
                                    <button class="icon-btn"><svg width="18" height="18" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9" stroke="#1E1B2E"
                                                stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.7 21a2 2 0 01-3.4 0" stroke="#1E1B2E" stroke-width="1.7"
                                                stroke-linecap="round" />
                                        </svg><span class="badge-dot"></span></button>
                                </div>
                            </div>

                            <!-- HERO -->
                            <div class="hero-card">
                                <div class="hero-mesh"></div>
                                <div
                                    style="position:relative; z-index:2; display:flex; justify-content:space-between; align-items:flex-start;">
                                    <div>
                                        <div style="font-size:12px; font-weight:600; color:rgba(255,255,255,0.75);">
                                            Good Morning ☀️</div>
                                        <div
                                            style="font-family:var(--font-display); font-weight:700; font-size:21px; color:#fff; margin-top:2px;">
                                            Aarav Sharma</div>
                                        <div style="font-size:11.5px; color:rgba(255,255,255,0.65); margin-top:6px;">
                                            Mon, 03 Aug 2026 · 28°C Sunny</div>
                                    </div>
                                    <div
                                        style="width:52px; height:52px; border-radius:16px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-weight:800; color:#fff;">
                                        AS</div>
                                </div>
                                <div style="position:relative; z-index:2; display:flex; gap:10px; margin-top:18px;">
                                    <div class="hero-pill"><svg width="14" height="14" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M9 12l2 2 4-4" stroke="#fff" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <circle cx="12" cy="12" r="9" stroke="#fff"
                                                stroke-width="1.6" />
                                        </svg>96% Attendance</div>
                                    <div class="hero-pill"><svg width="14" height="14" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M12 7v5l3 3" stroke="#fff" stroke-width="1.8"
                                                stroke-linecap="round" />
                                            <circle cx="12" cy="12" r="9" stroke="#fff"
                                                stroke-width="1.6" />
                                        </svg>Physics · 10:20</div>
                                </div>
                            </div>

                            <!-- QUICK STATS -->
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:16px;">
                                <div class="stat-card" style="background:linear-gradient(135deg,#FFF7E0,#FFEFC7);">
                                    <div class="stat-icon"
                                        style="background:linear-gradient(135deg,#F4C542,#F59E0B);"><svg
                                            width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M12 2l2.4 6.6L21 9l-5 4.4L17.4 21 12 17.3 6.6 21 8 13.4 3 9l6.6-.4L12 2z"
                                                fill="#fff" />
                                        </svg></div>
                                    <div
                                        style="font-family:var(--font-display); font-weight:800; font-size:19px; margin-top:10px;">
                                        1,240</div>
                                    <div style="font-size:11px; color:var(--ink-soft); font-weight:600;">Reward Points
                                    </div>
                                </div>
                                <div class="stat-card" style="background:linear-gradient(135deg,#FFE9EA,#FFD9DB);">
                                    <div class="stat-icon"
                                        style="background:linear-gradient(135deg,#EF4444,#F59E0B);"><svg
                                            width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 2C8 6 6 9.5 6 13a6 6 0 0012 0c0-3.5-2-7-6-11z"
                                                fill="#fff" />
                                        </svg></div>
                                    <div
                                        style="font-family:var(--font-display); font-weight:800; font-size:19px; margin-top:10px;">
                                        ₹12,500</div>
                                    <div style="font-size:11px; color:var(--ink-soft); font-weight:600;">Fee Due · 15
                                        Aug</div>
                                </div>
                            </div>

                            <!-- QUICK ACTIONS -->
                            <div class="section-head">
                                <h3 style="font-size:15px;">Quick Actions</h3>
                            </div>
                            <div
                                style="display:grid; grid-template-columns:repeat(4,1fr); gap:10px 8px; margin-bottom:6px;">
                                <div class="qa" onclick="switchTab('attendance')">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);">✓
                                    </div><span>Attendance</span>
                                </div>
                                <div class="qa" onclick="switchTab('timetable')">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#06B6D4,#4F46E5);">📚
                                    </div><span>Timetable</span>
                                </div>
                                <div class="qa" onclick="switchTab('fees')">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#F4C542,#F59E0B);">₹
                                    </div><span>Fees</span>
                                </div>
                                <div class="qa">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#10B981,#06B6D4);">📝
                                    </div><span>Homework</span>
                                </div>
                                <div class="qa">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#EF4444,#F59E0B);">🚌
                                    </div><span>Transport</span>
                                </div>
                                <div class="qa">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#7C3AED,#06B6D4);">📊
                                    </div><span>Results</span>
                                </div>
                                <div class="qa">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#F59E0B,#EF4444);">🏆
                                    </div><span>Awards</span>
                                </div>
                                <div class="qa" onclick="switchTab('profile')">
                                    <div class="qa-ico" style="background:linear-gradient(135deg,#4F46E5,#06B6D4);">🪪
                                    </div><span>ID Card</span>
                                </div>
                            </div>

                            <!-- TODAY'S CLASSES -->
                            <div class="section-head">
                                <h3 style="font-size:15px;">Today's Classes</h3><span class="link-sm"
                                    onclick="switchTab('timetable')">See all</span>
                            </div>
                            <div
                                style="display:flex; gap:10px; overflow-x:auto; padding-bottom:6px; margin:0 -18px; padding-left:18px; padding-right:18px;">
                                <div class="class-card"
                                    style="background:linear-gradient(150deg,#EEF6FF,#E4EEFF); border-color:#CFE0FF;">
                                    <span class="eyebrow" style="color:#4F46E5;">NOW</span>
                                    <div class="cc-title">Physics</div>
                                    <div class="cc-sub">10:20 – 11:05 · Rm 204</div>
                                    <div class="cc-teacher">Mrs. Iyer</div>
                                </div>
                                <div class="class-card"><span class="eyebrow">NEXT</span>
                                    <div class="cc-title">Mathematics</div>
                                    <div class="cc-sub">11:10 – 11:55 · Rm 204</div>
                                    <div class="cc-teacher">Mr. Rao</div>
                                </div>
                                <div class="class-card"><span class="eyebrow">3:15 PM</span>
                                    <div class="cc-title">Computer Sci</div>
                                    <div class="cc-sub">Lab 2</div>
                                    <div class="cc-teacher">Ms. Fernandes</div>
                                </div>
                            </div>

                            <!-- HOMEWORK -->
                            <div class="section-head">
                                <h3 style="font-size:15px;">Homework Due</h3><span class="link-sm">3 pending</span>
                            </div>
                            <div class="list-card">
                                <div class="hw-row">
                                    <div class="hw-dot" style="background:#EF4444;"></div>
                                    <div style="flex:1;">
                                        <div class="hw-t">Chemistry — Ch.4 Numericals</div>
                                        <div class="hw-s">Due tomorrow · Mrs. Nair</div>
                                    </div><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="hw-row">
                                    <div class="hw-dot" style="background:#F59E0B;"></div>
                                    <div style="flex:1;">
                                        <div class="hw-t">English — Essay Draft</div>
                                        <div class="hw-s">Due in 3 days · Mr. Verma</div>
                                    </div><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="hw-row">
                                    <div class="hw-dot" style="background:#10B981;"></div>
                                    <div style="flex:1;">
                                        <div class="hw-t">Robotics — Circuit Diagram</div>
                                        <div class="hw-s">Due in 5 days · Mr. Das</div>
                                    </div><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>

                            <!-- NOTICE BOARD -->
                            <div class="section-head">
                                <h3 style="font-size:15px;">Notice Board</h3>
                            </div>
                            <div class="notice-card">
                                <div class="notice-tag">ANNOUNCEMENT</div>
                                <div style="font-weight:700; font-size:14px; margin:8px 0 4px;">Annual Science
                                    Exhibition — 22 Aug</div>
                                <div style="font-size:12.5px; color:var(--ink-soft); line-height:1.5;">All grade 9–10
                                    students must submit project abstracts by 10 Aug. Robotics club demo slots open now.
                                </div>
                            </div>

                            <!-- LEADERBOARD -->
                            <div class="section-head">
                                <h3 style="font-size:15px;">House Leaderboard</h3>
                            </div>
                            <div class="list-card" style="margin-bottom:20px;">
                                <div class="lb-row"><span class="lb-rank" style="background:#F4C542;">1</span><span
                                        style="flex:1; font-weight:700; font-size:13px;">🔥 Phoenix House</span><span
                                        style="font-weight:800; color:var(--primary); font-size:13px;">3,420</span>
                                </div>
                                <div class="lb-row"><span class="lb-rank" style="background:#D6D3E8;">2</span><span
                                        style="flex:1; font-weight:700; font-size:13px;">🌊 Titan House</span><span
                                        style="font-weight:800; color:var(--primary); font-size:13px;">3,180</span>
                                </div>
                                <div class="lb-row"><span class="lb-rank" style="background:#E8C79E;">3</span><span
                                        style="flex:1; font-weight:700; font-size:13px;">🌿 Falcon House</span><span
                                        style="font-weight:800; color:var(--primary); font-size:13px;">2,960</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ---- ATTENDANCE TAB ---- -->
                    <div class="tab" id="tab-attendance">
                        <div class="status-bar"><span>9:41</span><span></span></div>
                        <div class="tab-header">
                            <h2 style="font-size:19px;">Attendance</h2>
                            <p class="tab-sub">Monthly overview</p>
                        </div>
                        <div class="scroll" style="padding:0 18px;">
                            <div class="hero-card"
                                style="background:linear-gradient(135deg,#4F46E5,#7C3AED); padding:22px; display:flex; align-items:center; gap:20px;">
                                <svg width="92" height="92" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="42" stroke="rgba(255,255,255,0.25)"
                                        stroke-width="9" fill="none" />
                                    <circle cx="50" cy="50" r="42" stroke="#F4C542" stroke-width="9"
                                        fill="none" stroke-linecap="round" stroke-dasharray="264"
                                        stroke-dashoffset="26" transform="rotate(-90 50 50)" />
                                </svg>
                                <div>
                                    <div
                                        style="font-family:var(--font-display); font-weight:800; font-size:26px; color:#fff;">
                                        96%</div>
                                    <div style="font-size:12px; color:rgba(255,255,255,0.75); font-weight:600;">Present
                                        · Aug 2026</div>
                                    <div style="font-size:11px; color:rgba(255,255,255,0.6); margin-top:4px;">2 Leaves
                                        · 0 Absent</div>
                                </div>
                            </div>
                            <div class="section-head">
                                <h3 style="font-size:15px;">This Week</h3>
                            </div>
                            <div style="display:flex; gap:7px; margin-bottom:18px;">
                                <div class="day-chip present">M<span></span></div>
                                <div class="day-chip present">T<span></span></div>
                                <div class="day-chip present">W<span></span></div>
                                <div class="day-chip leave">T<span></span></div>
                                <div class="day-chip present">F<span></span></div>
                                <div class="day-chip future">S<span></span></div>
                                <div class="day-chip future">S<span></span></div>
                            </div>
                            <div class="section-head">
                                <h3 style="font-size:15px;">Subject-wise</h3>
                            </div>
                            <div class="list-card" style="margin-bottom:20px;">
                                <div class="subj-row"><span
                                        style="flex:1; font-weight:600; font-size:13px;">Physics</span>
                                    <div class="bar-track">
                                        <div class="bar-fill"
                                            style="width:98%; background:linear-gradient(90deg,#4F46E5,#7C3AED);">
                                        </div>
                                    </div><span class="bar-pct">98%</span>
                                </div>
                                <div class="subj-row"><span
                                        style="flex:1; font-weight:600; font-size:13px;">Mathematics</span>
                                    <div class="bar-track">
                                        <div class="bar-fill"
                                            style="width:94%; background:linear-gradient(90deg,#06B6D4,#4F46E5);">
                                        </div>
                                    </div><span class="bar-pct">94%</span>
                                </div>
                                <div class="subj-row"><span
                                        style="flex:1; font-weight:600; font-size:13px;">Chemistry</span>
                                    <div class="bar-track">
                                        <div class="bar-fill"
                                            style="width:90%; background:linear-gradient(90deg,#10B981,#06B6D4);">
                                        </div>
                                    </div><span class="bar-pct">90%</span>
                                </div>
                                <div class="subj-row"><span
                                        style="flex:1; font-weight:600; font-size:13px;">English</span>
                                    <div class="bar-track">
                                        <div class="bar-fill"
                                            style="width:99%; background:linear-gradient(90deg,#F4C542,#F59E0B);">
                                        </div>
                                    </div><span class="bar-pct">99%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ---- TIMETABLE TAB ---- -->
                    <div class="tab" id="tab-timetable">
                        <div class="status-bar"><span>9:41</span><span></span></div>
                        <div class="tab-header">
                            <h2 style="font-size:19px;">Timetable</h2>
                            <p class="tab-sub">Monday, 03 August</p>
                        </div>
                        <div class="scroll" style="padding:0 18px;">
                            <div style="display:flex; gap:8px; margin-bottom:16px; overflow-x:auto;">
                                <div class="day-pill active">Mon</div>
                                <div class="day-pill">Tue</div>
                                <div class="day-pill">Wed</div>
                                <div class="day-pill">Thu</div>
                                <div class="day-pill">Fri</div>
                            </div>
                            <div class="tt-row">
                                <div class="tt-time">8:30</div>
                                <div class="tt-card" style="border-left-color:#4F46E5;">
                                    <div class="tt-subj">Physics</div>
                                    <div class="tt-meta">Mrs. Iyer · Room 204</div>
                                </div>
                            </div>
                            <div class="tt-row">
                                <div class="tt-time">9:25</div>
                                <div class="tt-card" style="border-left-color:#06B6D4;">
                                    <div class="tt-subj">Mathematics</div>
                                    <div class="tt-meta">Mr. Rao · Room 204</div>
                                </div>
                            </div>
                            <div class="tt-row">
                                <div class="tt-time">10:20</div>
                                <div class="tt-card active-now" style="border-left-color:#10B981;">
                                    <div class="tt-subj">Chemistry <span class="live-tag">LIVE</span></div>
                                    <div class="tt-meta">Mrs. Nair · Lab 1</div>
                                </div>
                            </div>
                            <div class="tt-row">
                                <div class="tt-time">11:15</div>
                                <div class="tt-card" style="border-left-color:#F4C542;">
                                    <div class="tt-subj">English</div>
                                    <div class="tt-meta">Mr. Verma · Room 204</div>
                                </div>
                            </div>
                            <div class="tt-row">
                                <div class="tt-time">1:00</div>
                                <div class="tt-card" style="border-left-color:#EF4444;">
                                    <div class="tt-subj">Lunch Break</div>
                                    <div class="tt-meta">Cafeteria</div>
                                </div>
                            </div>
                            <div class="tt-row" style="margin-bottom:20px;">
                                <div class="tt-time">2:00</div>
                                <div class="tt-card" style="border-left-color:#7C3AED;">
                                    <div class="tt-subj">Computer Science</div>
                                    <div class="tt-meta">Ms. Fernandes · Lab 2</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ---- FEES TAB ---- -->
                    <div class="tab" id="tab-fees">
                        <div class="status-bar"><span>9:41</span><span></span></div>
                        <div class="tab-header">
                            <h2 style="font-size:19px;">Fees</h2>
                            <p class="tab-sub">Term II · 2026-27</p>
                        </div>
                        <div class="scroll" style="padding:0 18px;">
                            <div class="hero-card"
                                style="background:linear-gradient(135deg,#1E1B2E,#4F46E5); padding:22px;">
                                <div style="font-size:12px; color:rgba(255,255,255,0.7); font-weight:600;">Amount Due
                                </div>
                                <div
                                    style="font-family:var(--font-display); font-weight:800; font-size:30px; color:#fff; margin:4px 0 14px;">
                                    ₹12,500</div>
                                <button
                                    style="width:100%; padding:13px; border:none; border-radius:14px; background:linear-gradient(135deg,#F4C542,#F59E0B); font-weight:700; font-size:13.5px; color:#1E1B2E;">Pay
                                    Now — Due 15 Aug</button>
                            </div>
                            <div class="section-head">
                                <h3 style="font-size:15px;">Payment Progress</h3>
                            </div>
                            <div class="list-card">
                                <div class="subj-row"><span style="flex:1; font-weight:600; font-size:13px;">Total
                                        Paid</span>
                                    <div class="bar-track">
                                        <div class="bar-fill"
                                            style="width:71%; background:linear-gradient(90deg,#10B981,#06B6D4);">
                                        </div>
                                    </div><span class="bar-pct">71%</span>
                                </div>
                            </div>
                            <div class="section-head">
                                <h3 style="font-size:15px;">Transaction History</h3>
                            </div>
                            <div class="list-card" style="margin-bottom:20px;">
                                <div class="hw-row">
                                    <div class="hw-dot" style="background:#10B981;"></div>
                                    <div style="flex:1;">
                                        <div class="hw-t">Term I Fee Paid</div>
                                        <div class="hw-s">12 Apr 2026 · UPI</div>
                                    </div><span
                                        style="font-weight:700; font-size:12.5px; color:var(--success);">₹18,000</span>
                                </div>
                                <div class="hw-row">
                                    <div class="hw-dot" style="background:#10B981;"></div>
                                    <div style="flex:1;">
                                        <div class="hw-t">Transport Fee Paid</div>
                                        <div class="hw-s">03 Jun 2026 · Card</div>
                                    </div><span
                                        style="font-weight:700; font-size:12.5px; color:var(--success);">₹6,000</span>
                                </div>
                                <div class="hw-row">
                                    <div class="hw-dot" style="background:#F59E0B;"></div>
                                    <div style="flex:1;">
                                        <div class="hw-t">Term II Fee — Pending</div>
                                        <div class="hw-s">Due 15 Aug 2026</div>
                                    </div><span
                                        style="font-weight:700; font-size:12.5px; color:var(--warning);">₹12,500</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ---- PROFILE TAB ---- -->
                    <div class="tab" id="tab-profile">
                        <div class="status-bar"><span>9:41</span><span></span></div>
                        <div class="scroll" style="padding:0 18px;">
                            <div style="display:flex; flex-direction:column; align-items:center; padding:22px 0 10px;">
                                <div
                                    style="width:84px; height:84px; border-radius:24px; background:linear-gradient(135deg,var(--primary),var(--secondary)); display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-weight:800; font-size:26px; color:#fff; box-shadow:var(--shadow-pop); margin-bottom:12px;">
                                    AS</div>
                                <div style="font-family:var(--font-display); font-weight:700; font-size:18px;">Aarav
                                    Sharma</div>
                                <div style="font-size:12.5px; color:var(--ink-soft); margin-top:2px;">Grade 10-B · Roll
                                    No. 14 · KTR2026S1042</div>
                            </div>
                            <div class="card"
                                style="padding:16px; margin-bottom:16px; display:flex; justify-content:space-between; text-align:center;">
                                <div>
                                    <div
                                        style="font-family:var(--font-display); font-weight:800; font-size:16px; color:var(--primary);">
                                        96%</div>
                                    <div style="font-size:10.5px; color:var(--ink-soft); font-weight:600;">Attendance
                                    </div>
                                </div>
                                <div>
                                    <div
                                        style="font-family:var(--font-display); font-weight:800; font-size:16px; color:var(--secondary);">
                                        A+</div>
                                    <div style="font-size:10.5px; color:var(--ink-soft); font-weight:600;">Grade</div>
                                </div>
                                <div>
                                    <div
                                        style="font-family:var(--font-display); font-weight:800; font-size:16px; color:var(--gold);">
                                        12</div>
                                    <div style="font-size:10.5px; color:var(--ink-soft); font-weight:600;">Badges</div>
                                </div>
                            </div>
                            <div class="section-head" style="margin-top:0;">
                                <h3 style="font-size:15px;">Account</h3>
                            </div>
                            <div class="list-card" style="margin-bottom:20px;">
                                <div class="menu-row"><span class="menu-ico"
                                        style="background:#EEF6FF;">🪪</span><span
                                        style="flex:1; font-weight:600; font-size:13px;">Digital ID Card</span><svg
                                        width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                                <div class="menu-row"><span class="menu-ico"
                                        style="background:#F0EEFF;">👪</span><span
                                        style="flex:1; font-weight:600; font-size:13px;">Guardian Details</span><svg
                                        width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                                <div class="menu-row"><span class="menu-ico"
                                        style="background:#FFF7E0;">🌙</span><span
                                        style="flex:1; font-weight:600; font-size:13px;">Dark Mode</span>
                                    <div class="toggle"></div>
                                </div>
                                <div class="menu-row"><span class="menu-ico"
                                        style="background:#FFE9EA;">🔔</span><span
                                        style="flex:1; font-weight:600; font-size:13px;">Notifications</span><svg
                                        width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                                <div class="menu-row"><span class="menu-ico"
                                        style="background:#E9FCF3;">💬</span><span
                                        style="flex:1; font-weight:600; font-size:13px;">Help Center</span><svg
                                        width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 6l6 6-6 6" stroke="#B8B4CC" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                                <div class="menu-row" onclick="goto('view-splash')"><span class="menu-ico"
                                        style="background:#FFE9EA;">🚪</span><span
                                        style="flex:1; font-weight:600; font-size:13px; color:var(--danger);">Log
                                        Out</span></div>
                            </div>
                        </div>
                    </div>

                    <button class="fab"><svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.4" stroke-linecap="round" />
                        </svg></button>

                    <div class="bottom-nav">
                        <button class="nav-item active" id="nav-dashboard" onclick="switchTab('dashboard')"><svg
                                viewBox="0 0 24 24" fill="none">
                                <path d="M4 11.5L12 4l8 7.5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 10v9h12v-9" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Home</button>
                        <button class="nav-item" id="nav-attendance" onclick="switchTab('attendance')"><svg
                                viewBox="0 0 24 24" fill="none">
                                <rect x="4" y="5" width="16" height="15" rx="3" stroke="currentColor"
                                    stroke-width="1.8" />
                                <path d="M8 3v4M16 3v4M4 10h16" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <path d="M9 14.5l2 2 4-4.5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Attendance</button>
                        <button class="nav-item" id="nav-timetable" onclick="switchTab('timetable')"><svg
                                viewBox="0 0 24 24" fill="none">
                                <rect x="3.5" y="4" width="17" height="17" rx="3"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path d="M3.5 9.5h17M8 4v3M16 4v3" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>Timetable</button>
                        <button class="nav-item" id="nav-fees" onclick="switchTab('fees')"><svg viewBox="0 0 24 24"
                                fill="none">
                                <rect x="3" y="6" width="18" height="13" rx="3" stroke="currentColor"
                                    stroke-width="1.8" />
                                <circle cx="12" cy="12.5" r="2.6" stroke="currentColor"
                                    stroke-width="1.8" />
                            </svg>Fees</button>
                        <button class="nav-item" id="nav-profile" onclick="switchTab('profile')"><svg
                                viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="8" r="3.4" stroke="currentColor"
                                    stroke-width="1.8" />
                                <path d="M5 20c1.2-4 4-6 7-6s5.8 2 7 6" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>Profile</button>
                    </div>

                </div>

            </div>
       
    </div>
    <script>
        function goto(id) {
            document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
            document.getElementById(id).classList.add('active');
        }

        function loginSequence() {
            goto('view-app');
        }

        function switchTab(name) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.getElementById('tab-' + name).classList.add('active');
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            document.getElementById('nav-' + name).classList.add('active');
        }
        // auto-advance splash -> onboarding
        setTimeout(() => {
            if (document.getElementById('view-splash').classList.contains('active')) goto('view-onboard');
        }, 2200);
    </script>
</body>

</html>
