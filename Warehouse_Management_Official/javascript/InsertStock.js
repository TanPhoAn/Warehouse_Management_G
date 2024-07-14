// Function to toggle the sidebar visibility
document.getElementById('toggle-sidebar-btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('sidebar-hidden');
});

// Function to suggest Bin Location based on the area of the shipment


// Function to check if the insertion is completed
function checkInsertionCompleted(event) {
    // Hiển thị cửa sổ xác nhận
    if (!confirm("Are you sure to leave this page?")) {
        // Ngăn chặn hành động mặc định của nút (ví dụ: chuyển hướng trang)
        event.preventDefault();
    }
}

// Thêm sự kiện onclick cho các nút bên ngoài Content
document.querySelectorAll('.sidebar-menu li a, .sidebar-bottom-menu li a').forEach(button => {
    button.addEventListener('click', checkInsertionCompleted);
});

// Function to clear the form
function clearForm() {
    document.querySelector('form').reset();
}

// Function to confirm cancellation
function cancelForm() {
    if (confirm("Are you sure you want to cancel and clear all entered information?")) {
        clearForm();
        window.location.href = 'InStock.html';
    }
}

// Add event listener to the Cancel button
document.querySelector('button[onclick="cancelForm()"]').addEventListener('click', cancelForm);

//---------------------------------------------------------------------------------------------------------------------------------
