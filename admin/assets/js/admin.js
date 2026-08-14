document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.querySelector('.mobile-sidebar-toggle');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });
    }

    document.addEventListener('click', function (event) {
        if (!sidebar || !toggle) {
            return;
        }

        const insideSidebar = sidebar.contains(event.target);
        const clickedToggle = toggle.contains(event.target);

        if (window.innerWidth <= 900 && !insideSidebar && !clickedToggle) {
            sidebar.classList.remove('open');
        }
    });
});
