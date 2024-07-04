<?php
    $newPackage = [
        "package-name" => '',
        "package-barcode" => '',
        "package-quantity" => '',
        "package-category" => '',
        "package-exp-date" => '',
        "package-mfg-date" => '',
        "package-description" => '',
        "packageWeight" => '',
        "packageLength" => '',
        "packageWidth" => '',
        "shipment-id" => '',
        "employeeID" => '',
        "carModel" => '',
        "shipmentValue" => '',
        "driverName" => '',

    ];
    $errors = [
        "insertStock-error" => '' 
];
    function getShipmentID(){
        global $conn;
        $sql = "SELECT id from shipments ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }
    function validateInsertPackage($newPackage, &$errors){
        if(empty($newPackage['package-name']) || empty($newPackage['package-barcode']) 
        ||  empty($newPackage['package-category'])
        || empty($newPackage['package-quantity'])|| empty($newPackage['packageWeight'])
        || empty($newPackage['packageLength'])|| empty($newPackage['packageWidth'])
        || empty($newPackage['employeeID'])|| empty($newPackage['shipmentValue'])
        || empty($newPackage['driverName'])){
            $errors['insertStock-error'] = "You must enter this field"; 
    }
}
    function insertPackage($newPackage){
        global $conn;
        //$shipmentID = getShipmentID();
        
            $sql1 = "INSERT INTO packages( bar_code, package_name, package_quantity, 
            category, package_description, exp_date, mfg_date, width, length, weight) 
                    VALUES ('?','?','?','?','?','?','?','?','?','?')";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("isissssiii",$newPackage['package-barcode'], 
            $newPackage['package-name'],
            $newPackage['package-quantity'],$newPackage['package-category'],
            $newPackage['package-description'],$newPackage['package-exp-date'],$newPackage['package-mfg-date'],
            $newPackage['packageWidth'],$newPackage['packageLength'],$newPackage['packageWeight']);
            // $sql2 = "INSERT INTO shipments(value, carModel, driveName, employeeID) VALUES (?,?,?,?)";      
            // $stmt2 = $conn->prepare($sql2);
            // $stmt2->bind_param("issi", $newPackage['shipmentValue'],$newPackage['carModel'],$newPackage['driverName'],$newPackage['employeeID'] );
            
            $stmt1->execute();
            //$stmt2->execute();   
            header('Location: ../Warehouse_management_Official/InsertStock.php');
        
        
    }

?>