<?php 
 $new_user = [
    "password" =>  '',
    "newPassword" => '',
    "confirmPassword" => '',
 ];


//  $errors = ["old-password" => "", 
//             "new-password" => "", 
//             "confirm-password" => "" ];
    // $oldPassword = $_POST['old-password'];
    // $newPassword = $_POST['new-password'];
    // $confirmPassword = $_POST['confirm-[password'];
function validatePasswordChange($new_user, &$error){
    $new_temp = $new_user['new-password'];
    if(empty($new_user['old-password'])){
        $error['oldpass'] = "You must enter the current password";   
        //var_dump("emty");
    }
    if(empty($new_user['new-password'])){
        $error['newpass'] = "You must enter the new password";
    }else{
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $new_temp)){
            $error['newpass'] = "Your password must contains at least 01 number, 01 letter, and 8 characters";
        }
    }
    if(empty($new_user['confirm-password'])){
        $error['confirmpass'] = "You must enter the new password again";
    }else{
        $confirm_temp = $new_user['confirm-password'];
        if($confirm_temp !== $new_temp){
            $error['confirmpass'] = "You need to enter the correct new password";
        }
    }
}
function updateEmployee($new_user, &$error){
    global $conn;
    $new_user['id'] = $_SESSION['id']; 
    
        validatePasswordChange($new_user, $error);
        // var_dump($_POST);
        // var_dump($error);
        //validatePasswordChange($new_user);
        //var_dump('error not display old pass');
        if($new_user['old-password'] === $_SESSION['password']){
            $sql = "UPDATE employees SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si",$new_user['new-password'], $new_user['id'] );
            $stmt->execute();
            $_SESSION['password'] = $new_user['new-password'];       
            header('Location: ../employee/employeeProfile.php ');
            //var_dump($_SESSION['password']); 
        }else{
            // echo '<script>alert("Invalid user password");</script>';
        }
    

}
?>
