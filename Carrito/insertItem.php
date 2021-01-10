<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../class/carrito.class.php";
require_once "../class/answer.class.php";
require_once "../class/conexion/connection.php";

$_con = new connection();
$_respuestas = new respuestas();
$_carrito = new carrito($_con->getConection());

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");
    $datosArraY = $_carrito->insertCarrito($postBody);
    echo json_encode($datosArraY);
} else {
    echo ("Metodo no permitido");
}
