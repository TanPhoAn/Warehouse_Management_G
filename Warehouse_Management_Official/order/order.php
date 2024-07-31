<?php 
    include "../config/db.php";
    include "../insertStock/insertStockHandler.php";
    include "../order/orderHandler.php";
    if(isset($_POST['insert-order'])) {
        
        // validateInsertOrder($_POST, $errors);
        insertOrder($_POST);
        var_dump($_POST);
        
    }
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Stock</title>
    <link rel="stylesheet" href="../css/InsertStock.css">
</head>
<body>
    <header class="header">
        <button class="header-option-btn" id="toggle-sidebar-btn">
            <img src="../images/nav.png" alt="Options" class="button-icon">
        </button>
        <a href="../Warehouse_Management_Official/employee/employeeProfile.php">
        <button class="header-avatar-btn"  id="avatar-btn">
            <img src="../images/avatar.png" alt="Avatar" class="avatar-icon">
        </button>
        </a>
        
        
    </header>
    <div class="main-container" style="height: 105vh;">
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
            <form  method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                
                           
                <h2 style="font-size: xx-large;">Insert Order</h2>
                <div class="form-row">
                    <div class="form-column">
                        <div class="form-group d-flex row">
                            <label for="employeeID" class="col-lg-6">EmployeeID*</label>
                            <div class="row">
                                <input type="text" id="employeeID" name="employeeID" size="49" class="col-lg-12" >
                                
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="packageID">Package ID*</label>
                            <input type="text" id="packageID" name="packageID" size="30" required>
                            
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description"  size="30" name="description">
                        </div>
                        <div class="form-group">
                            <label for="pickDate">Pick Date<span  style="font-size: 21px">(YYYY/MM/DD)</span></label>
                            <input type="text" id="pickDate" size="30" name="pickDate" >
                            
                        </div>
                        <div class="form-group">
                            <label for="status">Status*</label>
                            <input type="text" id="status" name="status" required size="30">
                            
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group right">
                        <button type="submit" name="insert-order">Insert</button>
                        <button type="button" onclick="cancelForm()">Cancel</button>
                    </div>
                </div>
            </form> 
        </div>  
    </div>
    <script src="../javascript/InsertStock.js"></script>
    
</body>
</html>
