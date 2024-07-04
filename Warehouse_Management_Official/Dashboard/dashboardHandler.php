<?php 
function countShipment(){
    global $conn;
    $sql = "SELECT * from shipments order by shipments.id ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getOrder(){
    global $conn;
    $sql = "SELECT * from orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getShipment(){
    global $conn;
    $sql = "SELECT * from shipments";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getPackage(){
    global $conn;
    $sql = "SELECT * from packages";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getShipmentID(){
    global $conn;
    $sql = "SELECT id from shipments ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function  countPackageOfShipment($shipment){

    global $conn;
    $sql = "SELECT p.id 
    FROM packages p, shipments s
    where p.shipmentID = s.id and s.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $shipment);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function countSpace($packages,  &$actualSpace){
    $singlePackage = '';
    $totalPackage = '';
    //var_dump($totalPackage);
    foreach($packages as $package){
        $singlePackage = (double)$package['width'] * (double)$package['length'];
        $totalPackage = (double)$totalPackage + (double)$singlePackage;
    }
    (double)$actualSpace -= $totalPackage;
    return (double)$actualSpace; 
}

?>