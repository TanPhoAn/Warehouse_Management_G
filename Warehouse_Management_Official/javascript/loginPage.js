document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const rememberMeCheckbox = document.getElementById('remember-me');

    // Load saved credentials if Remember Me was checked
    if (localStorage.getItem('rememberMe') === 'true') {
        usernameInput.value = localStorage.getItem('username');
        passwordInput.value = localStorage.getItem('password');
        rememberMeCheckbox.checked = true;
    }

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = usernameInput.value;
        const password = passwordInput.value;
        const rememberMe = rememberMeCheckbox.checked;

        // Debugging logs
        console.log('Username:', username);
        console.log('Password:', password);
        console.log('Remember Me:', rememberMe);

        // Simple validation for demo purposes
        if ((username === 'admin' && password === 'admin') || (username === 'user' && password === 'password')) {
            if (username === 'admin' && password === 'admin') {
                window.location.href = "employeeProfile.html";
            } else if (username === 'user' && password === 'password') {
                alert('Login successful!');
                window.location.href = "employeeProfile.html";
            }     
        } else {
            alert('Invalid username or password.');
        }
    });
});