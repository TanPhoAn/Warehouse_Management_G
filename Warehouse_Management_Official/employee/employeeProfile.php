<?php 
include '../config/db.php';
include '../employee/employeeHandler.php';
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $role = $_SESSION['role'];
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $contact = $_SESSION['contact'];
    $error = ['oldpass' => '', 'newpass' => '', 'confirmpass' => ''];
    // $oldPassword = $_POST['old-password'];
    // $newPassword = $_POST['new-password'];
    // $confirmPassword = $_POST['confirm-password'];
    // changePassword($_POST, $new_user);
    if(isset($_POST['update_employee'])){
        updateEmployee($_POST, $error);
        var_dump($_POST);
    }
    //var_dump($_SESSION);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="../css/employeeProfile.css">
</head>
<body>
    <header class="header">
        <button class="header-option-btn" id="toggle-sidebar-btn">
            <img src="../images/nav.png" alt="Options" class="button-icon">
        </button>
        <button class="header-avatar-btn" id="avatar-btn" href="../employee/employeeProfile.php">
            <img src="../images/avatar.png" alt="Avatar-icon" class="avatar-icon">
        </button>
        
    </header>
    <div class="main-container" style="height: 86vh;" >
        <aside class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li><a href="../Dashboard.php" id="dashboard-btn"><img src="../images/Home.png" alt="Dashboard Icon" class="menu-icon"><span>Dashboard</span></a></li>
                <li><a href="../InsertStock.php" id="instock-btn"><img src="../images/InStock_Icon.png" alt="Insotck Icon" class="menu-icon"><span>In Stock</span></a></li>
                <li><a href="../pick/Pick.php" id="pick-btn"><img src="../images/list.png" alt="Pick Icon" class="menu-icon"><span>Pick</span></a></li>
                <li><a href="../return/Return.php" id="dashboard-btn"><img src="../images/stockReturn.png" alt="Return Icon" class="menu-icon"><span>Return</span></a></li>
            </ul>
            <ul class="sidebar-bottom-menu">
                <li><a href="#settings"><img src="../images/Setting.png" alt="Settings Icon" class="menu-icon"><span>Settings</span></a></li>
                <li><a href="#logout" id="logout-btn"><img src="../images/logOut.png" alt="Log Out Icon" class="menu-icon"><span>Log Out</span></a></li>

            </ul>
        </aside>
        <div class="content">
            <div class="profile-section">
                <h2>Employee Profile</h2>
                <div class="profile-container">
                    
                        <div class="profile-left">
                            
                            <img src="../images/avatar.png" alt="Avatar" class="avatar" id="avatar-preview">
                            </br>
                        
                            <button class="browse-button p-3" id="browse-button" onclick="myFunction()" value="submit form" >Browse</button>
                            <input type="file" id="avatar-input" style="display: none;" accept="image/*">
            
                        </div>
                        
                    <div class="profile-right">
                        <form id="employee-info-form">
                            <div class="form-row">
                                <label for="employee-id">Employee ID</label>
                                <input type="text" style="font-size: medium;" id="employee-id" name="employee-id" value="<?php echo $id ?>" >
                            </div>
                            <div class="form-row">
                                <label for="first-name">First Name</label>
                                <input type="text" style="font-size: medium;" id="first-name" name="first-name" readonly value="<?php echo $fname ?>">
                            </div>
                            <div class="form-row">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" style="font-size: medium;" name="last-name" readonly value="<?php echo $lname ?>">
                            </div>
                            <div class="form-row">
                                <label for="contact">Contact</label>
                                <input type="text" id="contact" style="font-size: medium;" name="contact" value="<?php echo $contact ?>" readonly>
                            </div>
                            <div class="form-row">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" style="font-size: medium;" readonly value="<?php echo $email ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="password-section">
                <h2>Change Password</h2>
                <form id="change-password-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-row">
                        <label for="old-password">Old Password</label>
                        <div class="d-flex">
                        <input type="password" id="old-password" name="old-password" >
                        <div class="text" style="color: red;" id="oldpass"><?php echo $error['oldpass'] ;?></div>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <label for="new-password">New Password</label>
                        <div class="d-flex">
                            <input type="password" id="new-password" name="new-password" >
                            <div class="text" style="color: red;" id="oldpass"><?php echo $error['newpass'] ;?></div>
                        </div> 
                    </div>
                    <div class="form-row">
                        <label for="confirm-password">Confirm New Password</label>
                        <div class="d-flex">
                            <input type="password" id="confirm-password" name="confirm-password" >
                            <div class="text" style="color: red;" id="oldpass"><?php echo $error['confirmpass'] ;?></div>
                        </div>
                    </div>
                    <div class="form-button-container">
                        <button type="submit" class="change-button" name="update_employee">Change</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <script src="../javascript/employeeProfile.js"></script>
   
</body>
</html>
