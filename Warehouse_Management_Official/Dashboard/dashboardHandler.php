<?php 
$errors = [
    'editStatus_status_error' => '',
    'editStatus_ID_error' => '',
];
$pick = [
    'id' => "",
    'orderID' => '',
    'pickTime' => '',
    'status' => '',
];
$order = [
    'id' => '',
    'packageID' =>'',
    'employeeID' => '',
    'description' => '',
    'pickDate' => '',
    'status' => '',
];

function countShipment(){
    global $conn;
    $sql = "SELECT * from shipments order by shipments.id ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function countPickShipment(){
    global $conn;
    $sql = "SELECT * from picks  ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function countReturn(){
    global $conn;
    $sql = "SELECT * from returns  ";
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
function getOrderID(){
    global $conn;
    $sql = "SELECT id from orders";
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

function validateStatusChange($order, $orders, &$errors){
    $id = $orders['editStatus_ID'];
    $status = $orders['editStatus_status'];
    $ordersID = getOrderID();
    $ordersIDarray = array();
    
    foreach($ordersID as $order){
        array_push($ordersIDarray, $order['id']);
    }
    var_dump($ordersIDarray);
    if(empty($id)){
        $errors['StatusChangeID'] = "You need to enter order ID";
    }
    else if(!in_array("$id", $ordersIDarray)){
        $errors['StatusChangeID'] = "There is no ID match";
    }else if(!preg_match('/^[1-9][0-9]*$/', $id)){
        $errors['StatusChangeID'] = "You need to enter number";
    }  else{
        $order['id'] = $id;
    }
    
    if($status !== "preparing" || $status !== "picking" || $status !== "complete" || $status !== "returning" ){
        $errors['editStatus_status_error'] = "The status must be specific: preparing, picking, complete or returning ";
    }else{
        $order['status'] = $status;
    }
}
// function applyStatusChange($order, $orders, &$errors){
    
//     global $conn;
//     $time = date('d-m-y h:i:s');
//     //validateStatusChange($order, $orders, $errors);
//     $sql1 = "UPDATE orders SET status = ? where id = ?";
//     $stmt1 = $conn -> prepare($sql1);
//     $stmt1->bind_param('si', $order['status'] , $order['id']);
//     $stmt1->execute();

//     if($order['status'] === "picking"){
//         $sql2 = "INSERT INTO picks(orderID, pickTime, status) VALUES (?,?,?,?)";
//         $stmt2 = $conn->prepare($sql2);
//         $stmt2->bind_param('iss', $order['id'], $time, $order['status']);
//         $stmt2->execute();
//     }else if($order['status'] === "returning"){
//         //  $sql3 = "INSERT INTO returns(orderID, pickTime, status) VALUES (?,?,?,?)";
//         // $stmt3 = $conn->prepare($sql3);
//         // $stmt3->bind_param('iss', $order['id'], $time, $order['status']);
//         // $stmt3->execute();
//     }
    
    

// }
function applyStatusChange($order){
    
    global $conn;
    date_default_timezone_get('Asia/Ho_Chi_Minh');
    $time = date('y-m-d h:i:s');
    
    $id = (int)$order['editStatus_ID'];
    $status = $order['editStatus_status'];
    //validateStatusChange($order, $orders, $errors);
    $sql1 = "UPDATE orders SET status = ? where id = ?";
    $stmt1 = $conn -> prepare($sql1);
    $stmt1->bind_param('si', $status, $id);
    $stmt1->execute();

    if($order['editStatus_status'] === "picking"){
        $sql2 = "INSERT INTO picks(orderID, pickTime, status) VALUES (?,?,?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('iss', $id, $time, $status);
        $stmt2->execute();
    }else if($order['status'] === "returning"){
        $sql3 = "INSERT INTO returns(orderID, status) VALUES (?,?)";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('is', $order['editStatus_ID'], $order['editStatus_status']);
        $stmt3->execute();
    }
    
    header("Location: Dashboard.php");

}
?>

<!-- <script>
    function checkStatus(){
        
        // let id =parseFloat(document.getElementById('editStatus_ID').value);
        // let status = document.getElementById('editStatus_status').value;
        let orderIDarray = [];
        let orderIDElements = document.querySelectorAll('[name="orderID"]');


        orderIDElements.forEach(function(element){
            orderIDarray.push(element.textContent.trim());
        });
        console.log(orderIDarray);
        if(!id){
            alert('You need to enter order ID!!!!');
        }
        else if(!orderIDarray.includes(id)){
            alert('Order ID not match!!!');
        }else{
            //
        }
    }
</script> -->