<?php
    $newPackage = [
        "package-name" => '',
        "package-barcode" => '',
        "package-quantity" => '',
        "package-category" => '',
        "package-description" => '',
        "packageWeight" => '',
        "packageLength" => '',
        "packageWidth" => '',


    ];
    $errors = [
        "insertStock-error" => '' 
];
    //assign BIN A
    // bin A has shelf with 3 tiers
    $binA_width = 100;
    $binA_lengdth = 300;
    $binA_area =3*(((double)$binA_width + (double)$binA_lengdth) *2);
    //assign BIN B
    // bin B has shelf with 4 tiers
    $binB_width = 300;
    $binB_lengdth = 900;
    $binB_area =4*(((double)$binB_width + (double)$binB_lengdth) *2);

    //assign BIN C
    // bin B has shelf with 2 tiers
    $binC_width = 50;
    $binC_lengdth = 150;
    $binC_area =2*(((double)$binC_width + (double)$binC_lengdth) *2);

    //bin Number
    $binNum = "";
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
            category, package_description,  width, length, weight) 
                    VALUES ('?','?','?','?','?','?','?','?')";
            $stmt1 = $conn->prepare($sql1);
            
            $stmt1->bind_param("ssissddd",$newPackage['package-barcode'], 
            $newPackage['package-name'],
            $newPackage['package-quantity'],$newPackage['package-category'],
            $newPackage['package-description'],
            $newPackage['packageWidth'],$newPackage['packageLength'],$newPackage['packageWeight']);
            // $sql2 = "INSERT INTO shipments(value, carModel, driveName, employeeID) VALUES (?,?,?,?)";      
            // $stmt2 = $conn->prepare($sql2);
            // $stmt2->bind_param("issi", $newPackage['shipmentValue'],$newPackage['carModel'],$newPackage['driverName'],$newPackage['employeeID'] );
            
            $stmt1->execute();
            //$stmt2->execute();   
            header('Location: ../Warehouse_management_Official/InsertStock.php');
        
        
    }
function updateShipmentID(){
    global $conn;
    $sql = 'SELECT id FROM shipments ORDER BY id DESC LIMIT 1';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();

}
function updatePackageID(){
    global $conn;
    $sql = 'SELECT id FROM packages ORDER BY id DESC LIMIT 1';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();

}
function insertPackage1($newPackage){
    global $conn;
    $conn->set_charset("utf8mb4");
    //$shipmentID = getShipmentID();
    
        $bar_code = $newPackage['package-barcode'];
        $name = $newPackage['package-name'];
        $quantity = $newPackage['package-quantity'];        
        $category = $newPackage['package-category'];
        $description = $newPackage['package-description'];
        $exp = $newPackage['package-exp-date'];
        $mfg = $newPackage['package-mfg-date'];
        $width = $newPackage['packageWidth'];
        $length = $newPackage['packageLength'];
        $height = $newPackage['packageWeight'];
        $bin = $newPackage['binLocation'];
       
        if(empty($newPackage['package-exp-date'])){
            $exp = null;
        }
        if(empty($newPackage['package-mfg-date'])){
            $mfg = null;
        }
        if($bin == "Block A"){
            $bin = 1;
        }else if($bin == "Block B"){
            $bin = 2;
        }else if($bin == "Block C"){
            $bin = 3;
        }else{
            $bin = 0;
        }
        $sql1 = "INSERT INTO packages(bin_location, bar_code, package_name, package_quantity, 
            category, package_description,  width, length, weight, exp_date, mfg_date) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sssissiiiss",$bin,$bar_code,$name, $quantity, $category, $description, $width, $length, $height, $exp, $mfg);

        $stmt1->execute();

        $sql2 = "INSERT INTO shipments(value, carModel, driveName, employeeID) VALUES (?,?,?,?)";      
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("issi", $newPackage['shipmentValue'],$newPackage['carModel'],$newPackage['driverName'],$newPackage['employeeID'] );
        
        $stmt2->execute();
        
        $pk = updatePackageID();
        $pkIDnew = $pk['id'];
        $newShipmentIDD= updateShipmentID();
        $ship = $newShipmentIDD['id'];
        // var_dump($newShipmentIDD['id']);
        // var_dump($pkIDnew);
        $sql3 = "UPDATE packages set shipmentID = ? where id = ?";      
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("ii", $ship, $pkIDnew);
        $stmt3->execute();
        header('Location: ../Warehouse_management_Official/InsertStock.php');
}       

function getPackgageFromBinA(){
    global $conn;
    $sql = "SELECT p.width, p.length FROM packages p where p.bin_location = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getPackgageFromBinB(){
    global $conn;
    $sql = "SELECT p.width, p.length FROM packages p where p.bin_location = 2";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getPackgageFromBinC(){
    global $conn;
    $sql = "SELECT p.width, p.length FROM packages p where p.bin_location = 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function calculateCurrentBinA(){
    $packagesHold = getPackgageFromBinA();
    //var_dump($packagesHold);
    $totalArea = 0.00;                
    foreach($packagesHold as $package){
        
          $totalArea = (double)$totalArea +
           (((double)$package['width'] +(double)$package['length']) *2); 
        
    }
    $totalLeft =$GLOBALS['binA_area'] - (double)$totalArea;
    return $totalLeft;
}
function calculateCurrentBinB(){
    $packagesHold = getPackgageFromBinB();
    $totalArea = 0.00;           
    foreach($packagesHold as $package){
          $totalArea = (double)$totalArea + 
          (((double)$package['width'] +(double)$package['length']) *2); 
    }
    $totalLeft =$GLOBALS['binB_area'] - (double)$totalArea;
    return $totalLeft;
}
function calculateCurrentBinC(){
    $packagesHold = getPackgageFromBinC();
    $totalArea = 0.00;                
    foreach($packagesHold as $package){
          $totalArea = (double)$totalArea + 
          (((double)$package['width'] +(double)$package['length']) *2);    
    }
    $totalLeft =$GLOBALS['binC_area'] - (double)$totalArea;
    return $totalLeft;

}
function getBlockAinfo(){
    global $conn;
    $sql = "SELECT * FROM packages where packages.bin_location = 1";
    $stmt = $conn-> prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getBlockBinfo(){
    global $conn;
    $sql = "SELECT * FROM packages where packages.bin_location = 2";
    $stmt = $conn-> prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
function getBlockCinfo(){
    global $conn;
    $sql = "SELECT * FROM packages where packages.bin_location = 3";
    $stmt = $conn-> prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}
?>

<script>function suggestBinLocation() {
    var length = parseFloat(document.getElementById('packageLength').value);
    var width = parseFloat(document.getElementById('packageWidth').value);
    var perimeter = (length + width) * 2 ;  
    var binLocation = '';
    var availableBinA = <?php echo calculateCurrentBinA() ?>;
    var availableBinB = <?php echo calculateCurrentBinB() ?>;
    var availableBinC = <?php echo calculateCurrentBinC() ?>;
    if (perimeter <= availableBinA)  {
        binLocation = 'Block A' ;
    } else if(perimeter <= availableBinB){
        binLocation = 'Block B' ;
    }else if(perimeter <= availableBinC){
        binLocation = 'Block C' ;
    }else{
        binLocation = "Unavailable place. Please contact the manager!";
    }

    document.getElementById('binLocation').value = binLocation;
}</script>