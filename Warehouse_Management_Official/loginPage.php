<?php 
    include "./config/db.php";
    $username = $password= $role = '';
    $errors = array('username' => '', 'password' => '', 'role' => '');
    if(isset($_POST['login_submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM employees WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $employee = mysqli_fetch_assoc($result);
        
        if($employee){
            // success
            
            
            $_SESSION['username'] = $employee['username'] ;
            $_SESSION['password'] = $employee['password'] ;
            $_SESSION['fname'] = $employee['fname'] ;
            $_SESSION['lname'] = $employee['lname'] ;
            $_SESSION['role'] = $employee['role'] ;
            $_SESSION['id'] = $employee['id'] ;
            $_SESSION['contact'] = $employee['contact'] ;
            $_SESSION['email'] = $employee['email'];
            // $_SESSION['orderId'] = "";
            // $_SESSION['order_package_id'] = "";
            // $_SESSION['order_employee_id'] = "";
            // $_SESSION['orderDescription'] = "";
            // $_SESSION['order_pick_date'] = "";
            // $_SESSION['orderStatus'] = "";
            mysqli_free_result($result);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

                header('Location: employee\employeeProfile.php'); 
            
        } else {
            //echo  'query error: ' . mysqli_error($conn);
            echo '<script>alert("Invalid employee account");</script>';
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/loginPage.css">
</head>
<body>
    <div class="container" >
        <div class="login-section">
            <h2>Login</h2>
            <form id="loginForm" method="POST" action="loginPage.php">
                <label for="username">Username*</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" placeholder="Minimum 8 characters" required>

                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <button type="submit" name="login_submit" value="Submit">Login</button>
            </form>
        </div>
        <div class="image-section">
            <img src="images/loginPage_background.jpg" alt="Image">
        </div>
    </div>
    <script>localStorage.clear()</script>
</body>
</html>
