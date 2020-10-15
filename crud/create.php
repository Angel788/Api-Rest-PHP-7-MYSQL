<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once "../class/conexion/connection.php";
    include_once "../class/employed.php";

    $database= new connection();
    $con=$database->getConection();
   
    $items= new employed($con);

    $data = json_decode(file_get_contents("php://input"));

    $items->name = $data->name;
    $items->email = $data->email;
    $items->age = $data->age;
    $items->designation = $data->designation;
    $items->created = $data->created;
    
    if($items->insertEmployed()){
        echo 'Employee created successfully.';
    } else{
        echo($items->name ."".$items->email);
        echo 'Employee could not be created.';
    }
?>