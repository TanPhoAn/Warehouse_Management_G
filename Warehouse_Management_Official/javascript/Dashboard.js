document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleSidebarBtn = document.getElementById('toggle-sidebar-btn');
    const content = document.querySelector('.content');

    toggleSidebarBtn.addEventListener('click', function () {
        sidebar.classList.toggle('sidebar-hidden');
        if (sidebar.classList.contains('sidebar-hidden')) {
            content.classList.remove('content-collapsed');
            content.classList.add('content-expanded');
        } else {
            content.classList.remove('content-expanded');
            content.classList.add('content-collapsed');
        }
    });

    const logoutBtn = document.getElementById('logout-btn');
    const avatarBtn = document.getElementById('avatar-btn');
    const dashboardBtn = document.getElementById('dashboard-btn');

    logoutBtn.addEventListener('click', function () {
        const confirmLogout = confirm('Are you sure you want to log out?');
        if (confirmLogout) {
            window.location.href = '../Warehouse_Management_Official/loginPage.php';
        } else {
            console.log('Log out cancelled');
        }
    });

    avatarBtn.addEventListener('click', function () {
        window.location.href = '../Warehouse_Management_Official/employee/employeeProfile.php';
    });

    dashboardBtn.addEventListener('click', function () {
        window.location.href = 'Dashboard.php';
    });

    document.getElementById('instock-btn').addEventListener('click', function () {
        window.location.href = 'InStock.html';
    });

    document.getElementById('pick-btn').addEventListener('click', function () {
        window.location.href = 'Pick.html';
    });

    document.getElementById('return-btn').addEventListener('click', function () {
        window.location.href = 'Return.html';
    });
});

// const exampleModal = document.getElementById('exampleModal')
// if (exampleModal) {
//   exampleModal.addEventListener('show.bs.modal', event => {
//     // Button that triggered the modal
//     const button = event.relatedTarget
//     // Extract info from data-bs-* attributes
//     const recipient = button.getAttribute('data-bs-whatever')
//     // If necessary, you could initiate an Ajax request here
//     // and then do the updating in a callback.

//     // Update the modal's content.
//     const modalTitle = exampleModal.querySelector('.modal-title')
//     const modalBodyInput = exampleModal.querySelector('.modal-body input')

//     modalTitle.textContent = `New message to ${recipient}`
//     modalBodyInput.value = recipient
//   })
// }
