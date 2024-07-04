document.addEventListener('DOMContentLoaded', function () {
    // Sidebar toggle
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

    // Compare passwords
    /*Compare old password with new password
    Compare matching of 2 password (new and confirm) */
    // document.getElementById('change-password-form').addEventListener('submit', function (e) {
    //     e.preventDefault();

    //     const oldPassword = document.getElementById('old-password').value;
    //     const newPassword = document.getElementById('new-password').value;
    //     const confirmPassword = document.getElementById('confirm-password').value;

    //     if (newPassword.length < 8) {
    //         alert('New password must be at least 8 characters long.');
    //         return;
    //     }

    //     if (newPassword === oldPassword) {
    //         alert('New password cannot be the same as the old password.');
    //         return;
    //     }

    //     if (newPassword !== confirmPassword) {
    //         alert('New passwords do not match.');
    //         return;
    //     }

    //     // Perform the password change action, for example, send it to the server.
    //     console.log('Old Password:', oldPassword);
    //     console.log('New Password:', newPassword);
    //     alert('Password changed successfully.');
    // });

    // Browse avatar picture
    const browseButton = document.getElementById('browse-button');
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');

    browseButton.addEventListener('click', function () {
        avatarInput.click();
    });

    avatarInput.addEventListener('change', function () {
        const file = avatarInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                avatarPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const logoutBtn = document.getElementById('logout-btn');

    logoutBtn.addEventListener('click', function () {
        // Hiển thị cửa sổ xác nhận khi nhấp vào nút Log Out
        const confirmLogout = confirm('Are you sure you want to log out?');

        if (confirmLogout) {
            // Nếu người dùng chọn Yes, chuyển hướng đến trang loginPage
            window.location.href = '../loginPage.php';
        } else {
            // Nếu người dùng chọn No, không làm gì cả
            console.log('Log out cancelled');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const avatarBtn = document.getElementById('avatar-btn');

    avatarBtn.addEventListener('click', function () {
        // Chuyển hướng trang về employee profile
        window.location.href = '../employee/employeeProfile.php';
    });
});
