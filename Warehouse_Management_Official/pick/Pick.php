<?php 
    include "../pick/pickHandler.php";
    include "../config/db.php";
    $countpicks = count(getPick());
    $picks = getPick();


    if(isset($_POST['exportButton'])){
        $fp = fopen('file.csv', 'w');
        if(!$fp){
            var_dump("File existed!!!!");
        }else{
            foreach ($picks as $fields) {
                fputcsv($fp, $fields);
            }
            
            fclose($fp);
            echo "<script>alert('Export file success!!!')</script>";
        }
        }
        
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick</title>
    <link rel="stylesheet" href="../pick/InStock.css">
</head>
<body>
    <header class="header">
        <button class="header-option-btn" id="toggle-sidebar-btn">
            <img src="../images/nav.png" alt="Options" class="button-icon">
        </button>
        <button class="header-avatar-btn" id="avatar-btn">
            <img src="../images/avatar.png" alt="Avatar" class="avatar-icon">
        </button>
        
    </header>
    <div class="main-container">
        <aside class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li><a href="../Dashboard.php" id="dashboard-btn"><img src="../images/Home.png" alt="Dashboard Icon" class="menu-icon"><span>Dashboard</span></a></li>
                <li><a href="../insertStock/InStock.php" id="instock-btn"><img src="../images/InStock_Icon.png" alt="Insotck Icon" class="menu-icon"><span>In Stock</span></a></li>
                <li><a href="../pick/Pick.php" id="pick-btn"><img src="../images/list.png" alt="Pick Icon" class="menu-icon"><span>Pick</span></a></li>
                <li><a href="../return/Return.php" id="dashboard-btn"><img src="../images/stockReturn.png" alt="Return Icon" class="menu-icon"><span>Return</span></a></li>
            </ul>
            <ul class="sidebar-bottom-menu">
                <li><a href="#settings"><img src="../images/Setting.png" alt="Settings Icon" class="menu-icon"><span>Settings</span></a></li>
                <li><a href="#logout" id="logout-btn"><img src="../images/logOut.png" alt="Log Out Icon" class="menu-icon"><span>Log Out</span></a></li>
            </ul>
        </aside>
        <div class="content" id="content">
            <div class="content" id="content">
                <div id="blockAInfo" class="block-info features" style="display: block;">
                    <div class="block-header">
                        <p id="inStockText">Pick</p>
                        <div class="button-container">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                                <button id="newStockButton" name="exportButton" type="submit">Export to Excel</button>
                                <button id="pickStockButton">Import Orders</button>
                                <a href="../order/order.php"><button id="pickStockButton" class="btn btn-brand" type="button">+ New Orders</button></a>
                            </form>
                            
                            
                            
                        </div>
                    </div>
                    <hr>
                    <div class="features">
                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Quick search...">
                            <img src="../images/icon/search_Icon.png" alt="Search Icon" class="search-icon">
                        </div>
                        
                            <div class="total-box inline-block" aria-readonly="true" type="text">Total: <?php echo $countpicks;?></div>
                            
                        
                        <div style="position: relative; display: inline-block;">
                            <input type="date" id="datePicker" style="display: none;">
                            <button class="date-picker-button" id="datePickerButton">&#128197;</button>
                        </div>
                        <div class="dropdown-container">
                            <select id="statusDropdown">
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="shipment-details">
                        <div class="shipment-column">Pick ID</div>
                        <div class="shipment-column">Order ID</div>
                        <div class="shipment-column">Time Picking</div>
                        <div class="shipment-column">Status</div>
                    </div> <hr>
                    <?php foreach($picks as $pick){ ?>
                        <div class="shipment-details">
                            <div class="shipment-column"><?php echo $pick['id'] ?></div>
                            <div class="shipment-column"><?php echo $pick['orderID'] ?></div>
                            <div class="shipment-column"><?php echo $pick['pickTime'] ?></div>
                            <div class="shipment-column"><?php echo $pick['status'] ?></div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="../pick/InStock.js"></script>
    <script src="../javascript/Head_Side.js"></script>
</body>
</html>
