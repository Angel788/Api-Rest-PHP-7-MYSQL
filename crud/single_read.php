<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../class/conexion/connection.php";
include_once "../class/employed.php";


$database = new connection();
$con = $database->getConection();

$items = new employed($con);


$items->id = isset($_GET['id']) ? $_GET['id'] : die();
$items->getSingleEmployee();
if ($items->name != null) {
    // create array
    $emp_arr = array(
        "id" =>  $items->id,
        "Marca" => $items->marca,
        "nombre" => $items->name,
        "costo" => $items->costo,
        "descripcion" => $items->descripcion,
        "rutaimagen" => $items->rutaimagen,
        "noserie" => $items->noserie
    );
    echo json_encode($emp_arr);
    http_response_code(200);
    //echo json_encode($emp_arr);
} else {
    http_response_code(404);
    echo json_encode("Employee not found.");
}
