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
//var_dump($_POST);
// $ordersID = getOrderID();
// var_dump($ordersID);
// if(isset($_POST['checkSubmit'])){
//     validateStatusChange($order, $_POST, $errors);
// }
if(isset($_POST['submitStatusChange'])){
    applyStatusChange($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="css/Dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/> 
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
                <li><a href="../Warehouse_Management_Official/insertStock/InStock.php" id="instock-btn"><img src="images/InStock_Icon.png" alt="Insotck Icon" class="menu-icon"><span>In Stock</span></a></li>
                <li><a href="../Warehouse_Management_Official/pick/Pick.php" id="pick-btn"><img src="images/list.png" alt="Pick Icon" class="menu-icon"><span>Pick</span></a></li>
                <li><a href="../Warehouse_Management_Official/return/Return.php" id="dashboard-btn"><img src="images/stockReturn.png" alt="Return Icon" class="menu-icon"><span>Return</span></a></li>
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
                        <h3>Pick the Order</h3>
                        <p><img src="images/icon/pick_Shipment.png" class="icon"><?= count(countPickShipment()) ?></p>
                    </div>
                    <div class="card">
                        <h3>Shipment Return</h3>
                        <p><img src="images/icon/return_Shipment.png" class="icon"><?= count(countReturn()) ?></p>
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
                    <ul class="stock-info  inline-block row">
                        <li class="col"><strong>OrderID</strong> <span id="orderID"></span></li>
                        <li class="col"><strong>Package</strong> <span id="category"></span></li>
                        <li class="col"><strong>Date</strong> <span id="date"></span></li>
                        <li class="col"><strong>Status</strong> <span id="status"></span></li>
                        <li class="col">
                            
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" style="display: block;"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    EDIT STATUS
                                </button>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Status of Order: </h5>
                                                <div class="modal-body">
                                                    <input type="text" name="editStatus_ID" id="editStatus_ID" size="25">
                                                    <div class="text" style="color: red;" id="editStatus_ID_error"><?php echo $errors['editStatus_ID_error'] ;?></div>
                                                </div>
                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                            </div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Status change to: </h5>
                                                <div class="modal-body">
                                                    <input type="text" name="editStatus_status" id="editStatus_status" size="25">
                                                    <div class="text" style="color: red;" id="editStatus_status_error"><?php echo $errors['editStatus_status_error'] ;?></div>
                                                </div>
                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                            </div>
                                            <!-- <div class="container inline-block text-align-center">
                                                <button type="button" class="btn btn-primary m-auto"   name="checkSubmit" onclick="checkStatus()">Check</button>
                                            </div> -->
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="submitStatusChange">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <!-- Modal -->                                         
                        </li>
                    </ul>
                    <?php foreach($orders as $order) {?>
                    <ul class="stock-info inline-block row float-left">
                        <li class="col"><?php echo $order['id'] ; ?><span name="orderID"></span></li>
                        <li class="col"><?php echo $order['packageID'] ; ?><span name="order_packageID"></span></li>
                        <li class="col"><?php echo $order['pickDate'] ; ?><span name="date"></span></li>
                        <li class="col"><?php echo $order['status'] ?><span name="status"></span></li>
                         <li></li>              
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>