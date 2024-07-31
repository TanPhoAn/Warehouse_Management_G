<?php 
    function getPick(){
        global $conn;
        $sql = "SELECT * FROM picks";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);

    }
    
?>