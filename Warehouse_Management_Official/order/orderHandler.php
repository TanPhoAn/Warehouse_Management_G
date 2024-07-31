<?php 
    $order = [
        "packageID" => '',
        "employeeID" => '',
        "description" => '',
        "pickDate" => '',
        "status" => '',
        "orderID" => '',
    ];
    $errors = [
        'employeeID-error' => '',
        'packageID-error' => '',
        'status-error' => '',

    ];
    function validateInsertOrder($orders, &$errors){
        if(empty($orders['employeeID'])){
            $errors['employeeID-error'] = "You need to enter ID";
        }
    }
    function getIDMax(){
        global $conn; 
        $sql = "SELECT MAX(id) max FROM orders";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    function insertOrder($orders){
        global $conn;
        $order['packageID'] = $orders['packageID'];
        $order['employeeID'] = $orders['employeeID'];
        $order['description'] = $orders['description'];
        $order['pickDate'] = $orders['pickDate'];
        $order['status'] = $orders['status'];
        $temp = getIDMax();
        $order['orderID'] = $temp['max'] +1;
        $sql = "INSERT INTO orders(id,packageID, employeeID, description,  status, pickDate)  VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt-> bind_param("iiisss", $order['orderID'],  $order['packageID'], $order['employeeID'], $order['description'], $order['status'], $order['pickDate']);
        $stmt->execute();
        
        Header("Location: order.php");
    }
   
?>  