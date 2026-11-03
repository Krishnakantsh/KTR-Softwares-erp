@extends('apps/StudentApp/Layouts/app')

@section('title', 'Timetable — KTR Student')

@section('content')
    <div class="status-bar">
        <span>9:41</span>
        <button class="menu-btn" onclick="toggleDrawer()">☰</button>
    </div>

    <div class="scroll" style="padding:0 18px;">
        <h2 style="font-size:19px; margin-bottom:14px;">Today's Schedule</h2>

        <div class="list-card">
            <div class="hw-row" style="justify-content:space-between;">
                <div>
                    <div style="font-size:14px; font-weight:700;">Physics</div>
                    <div style="font-size:11px; color:var(--ink-soft);">Room 204 · Dr. Verma</div>
                </div>
                <div style="font-size:12px; font-weight:700; color:var(--primary);">08:30 AM</div>
            </div>

            <div class="hw-row" style="justify-content:space-between;">
                <div>
                    <div style="font-size:14px; font-weight:700;">Mathematics</div>
                    <div style="font-size:11px; color:var(--ink-soft);">Room 204 · Mrs. Kapoor</div>
                </div>
                <div style="font-size:12px; font-weight:700; color:var(--primary);">09:25 AM</div>
            </div>

            <div class="hw-row" style="justify-content:space-between;">
                <div>
                    <div style="font-size:14px; font-weight:700;">Chemistry</div>
                    <div style="font-size:11px; color:var(--ink-soft);">Lab 1 · Mr. Roy</div>
                </div>
                <div style="font-size:12px; font-weight:700; color:var(--primary);">10:20 AM</div>
            </div>
        </div>
    </div>
@endsection