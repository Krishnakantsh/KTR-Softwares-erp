function toggleDrawer() {
    const drawer = document.getElementById("sidebarDrawer");
    const overlay = document.getElementById("drawerOverlay");

    if (drawer && overlay) {
        drawer.classList.toggle("active");
        overlay.classList.toggle("active");
    }
}


