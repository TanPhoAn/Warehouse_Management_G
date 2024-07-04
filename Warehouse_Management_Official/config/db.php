<?php 
$conn = mysqli_connect('localhost', 'root', '', 'warehouse_2024_01');
$conn->set_charset("utf8mb4");
if(!$conn){
    echo 'Connect error: ' . mysqli_connect_error();
}else{
    session_start();
}

?> 
