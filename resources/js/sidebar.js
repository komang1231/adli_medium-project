const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const mainWrapper = document.querySelector('.main-wrapper');

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainWrapper.classList.toggle('sidebar-collapsed');
});

const sidebarItems = document.querySelectorAll('.sidebar-item');

sidebarItems.forEach(item => {
    item.addEventListener('click', () => {

        sidebarItems.forEach(item => {
            item.classList.remove('active');
        });

        item.classList.add('active');
    });
});