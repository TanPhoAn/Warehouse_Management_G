<?php 
 function getIDMax(){
    global $conn; 
    $sql = "SELECT MAX(id) max FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function insertCsvToDatabase($pathFile){
    
    $pathFile = "C:\Users\ASUS\Downloads\importTest.csv";
    $path = str_replace('\\', '/', $pathFile);
     var_dump($path);
    
    
    // $= fopen($path, "r") or die("Unable to open file!");
    // $order = fread($myfile,filesize($path));
    // $orderSplit = explode(',',$order);
    // $orderDetail = [
    //     'packageID' => $orderSplit[0],
    //     'employeeID' => $orderSplit[1],
    //     'description' => $orderSplit[2],
    //     'time' => $orderSplit[3],
    //     'status' => $orderSplit[4]
    // ];
    //var_dump($orderSplit);
    // $myfile  = fopen($path, "r");
    // $order = fread($myfile,filesize($path));
    // $orderSplits = explode(',',$order);
    if ($file = fopen($path, "r")) {
        global $conn;
        while(!feof($file)) {
            $line = fgets($file);
            $orderSplits = explode(',',$line);
            $temp = getIDMax();

            $orderDetail = [
            'id' => $temp['max'] +1,
            'packageID' => $orderSplits[0],
            'employeeID' => $orderSplits[1],
            'description' => $orderSplits[2],
            'status' => $orderSplits[3],
            'time' => $orderSplits[4]
            ];
            var_dump($orderDetail);
            $stmt = $conn->prepare("INSERT INTO orders (id,packageID, employeeID, description, status, pickDate) VALUES (?,?, ?, ?, ?, ?)");    
            $stmt->bind_param("iiisss",$orderDetail['id'], $orderDetail['packageID'], $orderDetail['employeeID'], $orderDetail['description'], $orderDetail['status'], $orderDetail['time']);
            $stmt->execute();
        }
        fclose($file);
        
        echo '<script>
        alert("Insert order(s) successfully");
        window.location.href = "../pick/insertNewOrder.php";    
        </script>';
        
    }
}

?>