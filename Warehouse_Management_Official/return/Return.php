<?php 
    include "../return/returnHandler.php";
    include "../config/db.php";
    
    $totalReturn = getTotalReturn();
    //var_dump($totalReturn);

    $detailReturns = getDeTailReturn();
    //var_dump($detailReturns);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="../return/InStock.css">
</head>
<body>
    <header class="header">
        <button class="header-option-btn" id="toggle-sidebar-btn">
            <img src="../images/nav.png" alt="Options" class="button-icon">
        </button>
        <a href="../employee/employeeProfile.php">
            <button class="header-avatar-btn" id="avatar-btn">
                <img src="../images/avatar.png" alt="Avatar" class="avatar-icon">
            </button>
        </a>
        
        
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
                        <p id="inStockText">Shipment Return</p>
                        <div class="button-container">
                            <a href="../pick/Pick.php"><button  type="button" class="btn btn-brand" id="pickStockButton">Delivery</button></a>
                        </div>
                    </div>
                    <hr>
                    <div class="features">
                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Quick search...">
                            <img src="../images//icon/search_Icon.png" alt="Search Icon" class="search-icon">
                        </div>
                        <div class="total-box">
                            Total: <?= $totalReturn['total'] ?>
                        </div>
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
                        <div class="shipment-column">Shipment ID</div>
                        <div class="shipment-column">Pick ID</div>
                        <div class="shipment-column">Pick Time</div>
                        <div class="shipment-column">Problem</div>
                        <div class="shipment-column">Status</div>
                    </div> <hr>
                    <?php foreach($detailReturns as $return) {?>
                        <div class="shipment-details">
                        <div class="shipment-column"><?= $return['shipmentID'] ?> </div>
                        <div class="shipment-column"><?= $return['id'] ?></div>
                        <div class="shipment-column"><?= $return['pickTime'] ?></div>
                        <div class="shipment-column"><?= $return['problemDescription'] ?></div>
                        <div class="shipment-column"><?= $return['status'] ?></div>
                    </div>

                    <?php } ?>
                </div>
            </div>
        </div>     
        </div>
    </div>
    <script src="../return/InStock.js"></script>
    <script src="../javascript/Head_Side.js"></script>
</body>
</html>
