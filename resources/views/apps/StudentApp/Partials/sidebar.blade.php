<div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

<aside class="drawer" id="sidebarDrawer">
    <div class="drawer-header">
        @include('apps/StudentApp/Partials/avatar', [
            'name' => 'Aarav Sharma', 
            'img' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150'
        ])
        <div class="drawer-user-info">
            <h3>Aarav Sharma</h3>
            <p>Grade 10-B · Roll 14</p>
        </div>
    </div>

    <ul class="drawer-menu">
        <li><a href="{{ route('app.student.dashboard') }}">🏠 Dashboard</a></li>
        <li><a href="{{ route('app.student.attendance') }}">✓ Attendance</a></li>
        <li><a href="{{ route('app.student.timetable') }}">📚 Timetable</a></li>
        <li><a href="{{ route('app.student.fees') }}">₹ Fees</a></li>
        <li><a href="{{ route('app.student.profile') }}">👤 Profile</a></li>
        <li><a href="{{ route('app.login') }}" style="color: var(--danger);">🚪 Log Out</a></li>
    </ul>
</aside>