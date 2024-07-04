<?php 
include '../Warehouse_Management_Official/config/db.php';
include '../Warehouse_Management_Official/Dashboard/dashboardHandler.php';
$shipmentCount = countShipment();
$shipments = getShipment();
$orders = getOrder();
$packages = getPackage();
// /var_dump(countPackageOfShipment(1)) ;
// $shipmentIDarray = getShipmentID();
// var_dump($shipmentIDarray);
// $packageOfShipment = countPackageOfShipment($shipmentIDarray);
// var_dump($packageOfShipment);
$actualSpace = 5000000; //500 m2 = 5.000.000 cm2
$actualSpaceAfter = (double)countSpace($packages,$actualSpace);
//var_dump((double)$actualSpaceAfter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="css/Dashboard.css">
</head>
<body>
    <header class="header">
        <button class="header-option-btn" id="toggle-sidebar-btn">
            <img src="images/nav.png" alt="Options" class="button-icon">
        </button>
        <button class="header-avatar-btn" id="avatar-btn">
            <img src="images/avatar.png" alt="Avatar" class="avatar-icon">
        </button>
        
    </header>
    <div class="main-container">
        <aside class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li><a href="Dashboard.php" id="dashboard-btn"><img src="images/Home.png" alt="Dashboard Icon" class="menu-icon"><span>Dashboard</span></a></li>
                <li><a href="InsertStock.php" id="instock-btn"><img src="images/InStock_Icon.png" alt="Insotck Icon" class="menu-icon"><span>In Stock</span></a></li>
                <li><a href="Pick.html" id="pick-btn"><img src="images/list.png" alt="Pick Icon" class="menu-icon"><span>Pick</span></a></li>
                <li><a href="Return.html" id="dashboard-btn"><img src="images/stockReturn.png" alt="Return Icon" class="menu-icon"><span>Return</span></a></li>
            </ul>
            <ul class="sidebar-bottom-menu">
                <li><a href="#settings"><img src="images/Setting.png" alt="Settings Icon" class="menu-icon"><span>Settings</span></a></li>
                <li><a href="#logout" id="logout-btn"><img src="images/logOut.png" alt="Log Out Icon" class="menu-icon"><span>Log Out</span></a></li>

            </ul>
        </aside>
        
        <main class="content">
            <section class="dashboard-section">
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Shipment in Warehouse</h3>
                        <p><img src="images/icon/Shipment.png" class="icon"><?=count($shipmentCount)?></p>
                    </div>
                    <div class="card">
                        <h3>Pick the Shipment</h3>
                        <p><img src="images/icon/pick_Shipment.png" class="icon">Processing</p>
                    </div>
                    <div class="card">
                        <h3>Shipment Return</h3>
                        <p><img src="images/icon/return_Shipment.png" class="icon">Processing</p>
                    </div>
                    <div class="card">
                        <h3>Space Available</h3>
                        <p><img src="images/icon/space.png" class="icon"><?= $actualSpaceAfter ?> cm2</p>
                    </div>
                </div>
            </section>
            
            <div class="boxes-container">
                <section class="stockAlert-section box">
                    <h2>Stock Alert</h2>
                    <hr class="divider">
                    <ul class="stock-info">
                        <li><strong>OrderID</strong> <span id="orderID"></span></li>
                        <li><strong>Package</strong> <span id="category"></span></li>
                        <li><strong>Date</strong> <span id="date"></span></li>
                        <li><strong>Quantity</strong> <span id="quantity"></span></li>
                        <li><strong>Status</strong> <span id="status"></span></li>
                    </ul>
                    <?php foreach($orders as $order) {?>
                    <ul class="stock-info inline-block" style="padding: 5px;">
                        <li><?php echo $order['id'] ; ?><span name="orderID"></span></li>
                        <li><?php echo $order['packageID'] ; ?><span name="order_packageID"></span></li>
                        <li><?php echo $order['pickDate'] ; ?><span name="date"></span></li>
                        <li>Processing<span name="quantity"></span></li>
                        <li><?php echo $order['status'] ?><span name="status"></span></li>
                    </ul>
                    <?php }?>
                </section>
        
                <section class="newShipment-section box">
                    <h2>Shipment Arrived</h2>
                    <hr class="divider">
                    <ul class="shipment-info">
                        <li><strong>Shipment ID</strong> <span id="newOrderID"></span></li>
                        <li><strong>Quantity</strong> <span id="newQuantity"></span></li>
                        <li><strong>Time</strong> <span id="newTime"></span></li>
                    </ul>
                    <?php foreach($shipments as $shipment){ ?>
                    <ul class="shipment-info">
                        <li><strong><?php echo $shipment['id'] ?></strong><span id="newOrderID"></span></li>
                        <li><strong><?= count(countPackageOfShipment($shipment['id'])) ?></strong> <span id="newQuantity"></span></li>
                        <li><strong><?php echo $shipment['receiveDate'] ?></strong> <span id="newTime"></span></li>
                    </ul>
                    <?php  } ?>

                </section>
            </div>
        </main>
        
        </div>
    </div>
    <script src="../Warehouse_Management_Official/javascript/Dashboard.js"></script>
</body>
</html>