<?php
require_once "../class/auth.class.php";
require_once "../class/conexion/connection.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$_con = new connection();
$_respuestas = new respuestas();
$_auth = new auth($_con->getConection());

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");
    $datosArray = $_auth->newUser($postBody);
    echo json_encode($datosArray);
}
