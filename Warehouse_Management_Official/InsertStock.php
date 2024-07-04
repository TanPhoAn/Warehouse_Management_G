<?php 
    include "../Warehouse_Management_Official/config/db.php";
    include "../Warehouse_Management_Official/insertStock/insertStockHandler.php";
    if(isset($_POST['insert-packages'])) {
        //validateInsertPackage($_POST, $errors);
        insertPackage($_POST);
        var_dump($_POST);
    }else{
        var_dump("cant run insertPackage() function !!!");
        var_dump($_POST);
        
    }

        //var_dump($_SESSION);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Stock</title>
    <link rel="stylesheet" href="../Warehouse_Management_Official/css/InsertStock.css">
</head>
<body>
    <header class="header">
        <button class="header-option-btn" id="toggle-sidebar-btn">
            <img src="images/nav.png" alt="Options" class="button-icon">
        </button>
        <a href="../Warehouse_Management_Official/employee/employeeProfile.php">
        <button class="header-avatar-btn"  id="avatar-btn">
            <img src="images/avatar.png" alt="Avatar" class="avatar-icon">
        </button>
        </a>
        
        
    </header>
    <div class="main-container" style="height: 122vh;">
        <aside class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li><a href="../Warehouse_Management_Official/Dashboard.php" id="dashboard-btn"><img src="images/Home.png" alt="Dashboard Icon" class="menu-icon"><span>Dashboard</span></a></li>
                <li><a href="../Warehouse_Management_Official/InsertStock.php" id="instock-btn"><img src="images/InStock_Icon.png" alt="Insotck Icon" class="menu-icon"><span>In Stock</span></a></li>
                <li><a href="Pick.html" id="pick-btn"><img src="images/list.png" alt="Pick Icon" class="menu-icon"><span>Pick</span></a></li>
                <li><a href="Return.html" id="dashboard-btn"><img src="images/stockReturn.png" alt="Return Icon" class="menu-icon"><span>Return</span></a></li>
            </ul>
            <ul class="sidebar-bottom-menu">
                <li><a href="#settings"><img src="images/Setting.png" alt="Settings Icon" class="menu-icon"><span>Settings</span></a></li>
                <li><a href="#logout" id="logout-btn"><img src="images/logOut.png" alt="Log Out Icon" class="menu-icon"><span>Log Out</span></a></li>
            </ul>
        </aside>
        <div class="content">
            <h1>Insert Package</h1> <hr>
            <form  method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="form-row">
                    <div class="form-column">
                        <div class="form-group">
                            <label for="package-name">Package Name *</label>
                            <input type="text" id="package-name" name="package-name" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="shipment-id">shipment ID *</label>
                            <input type="text" id="shipment-id" name="shipment-id" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div> -->
                        <div class="form-group">
                            <label for="barcode">Barcode *</label>
                            <input type="text" id="barcode" name="package-barcode" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity *</label>
                            <input type="number" id="quantity" name="package-quantity" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <label for="category">Category *</label>
                            <input type="text" id="category" name="package-category" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <label for="exp-date">ExpDate</label>
                            <input type="date" id="exp-date" name="package-exp-date">
                        </div>
                        <div class="form-group">
                            <label for="mfg-date">MFGDate</label>
                            <input type="date" id="mfg-date" name="package-mfg-date">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="package-description" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-group">
                            <label for="packageWeight">Package Weight*</label>
                            <input type="number" id="shipmentWeight" name="packageWeight" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <label for="packageLength">Package Length*</label>
                            <input type="number" id="packageLength" name="packageLength" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <label for="packageWidth">Package Width*</label>
                            <input type="number" id="packageWidth" name="packageWidth" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="suggestBinLocation()">Check</button>
                        </div>
                        <div class="form-group">
                            <label for="binLocation">Bin Location</label>
                            <input type="text" id="binLocation" name="binLocation" readonly>
                        </div>
                    </div>
                </div><hr>
            
            <h1>Additional Information</h1>
                <div class="form-row">
                    <div class="form-column">
                        <div class="form-group">
                            <label for="employeeID">EmployeeID*</label>
                            <input type="text" id="employeeID" name="employeeID" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                        <div class="form-group">
                            <label for="driverName">Driver Name*</label>
                            <input type="text" id="driverName" name="driverName" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-group">
                            <label for="carModel">Car Model</label>
                            <input type="text" id="carModel" name="carModel">
                        </div>
                        <div class="form-group">
                            <label for="shipmentValue">Shipment Value*</label>
                            <input type="number" id="shipmentValue" name="shipmentValue" required>
                            <div class="text" style="color: red;"><?php echo $errors['insertStock-error'] ;?></div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group right">
                        <button type="submit" name="insert-packages">Insert</button>
                        <button type="button" onclick="cancelForm()">Cancel</button>
                    </div>
                </div>
            </form> 
        </div>  
        </div>
    </div>
    <script src="../Warehouse_Management_Official/javascript/InsertStock.js"></script>
    
</body>
</html>
