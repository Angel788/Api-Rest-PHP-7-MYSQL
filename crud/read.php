<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once "../class/conexion/connection.php";
    include_once "../class/employed.php";

    $database= new connection();
    $con=$database->getConection();
   
    $items= new employed($con);
     $stmt=$items->getEmployed();
     //$employed1=$database->getEmployed();
     echo json_encode($stmt);
    
?>