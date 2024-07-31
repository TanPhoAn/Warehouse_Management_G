<?php 
    include "../config/db.php";
    include "../pick/insertNewOrderHandler.php";
    
    if(isset($_POST['insertNewOrder'])){
      
      insertCsvToDatabase($_POST['csvFile']);
      var_dump("SUCESS");
    }else{
      var_dump("FAIL");
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
        <a href="../employee/employeeProfile.php">
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
            <h1>Insert New Order from CSV file(enter full source path)</h1>
                <!-- <div class="form-row">
                    <div class="form-column">
                        <div class="form-group">
                          <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                            <div id="drag_upload_file">
                              <p>Drop File here</p>
                              <p><input type="button" value="Select File" onclick="file_explorer()"></p>
                              <input type="file" id="selectfile">
                            </div>
                          </div>
                          <div class="img-content"></div>
                        </div>
                    </div>
                </div> -->
                <div class="form-row">
                    <div class="form-column">
                        <div class="form-group ">
                            <label for="employeeID">Insert CSV file Here: </label>
                            <input type="text" id="csvFile" name="csvFile" accept=".csv" required>
                            
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group right">
                        <button type="submit" name="insertNewOrder">Insert</button>
                        <button type="button" onclick="cancelForm()">Cancel</button>
                    </div>
                </div>
            </form> 
        </div>  
        </div>
    </div>
    
    <script src="../javascript/InsertStock.js"></script>
</body>
</html>
