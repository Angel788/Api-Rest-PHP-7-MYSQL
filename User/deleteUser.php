<?php
require_once "../class/auth.class.php";
require_once "../class/conexion/connection.php";

$_con = new connection();
$_respuestas = new respuestas();
$_auth = new auth($_con->getConection());

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");
    $datosArray = $_auth->DeleteUser($postBody);
    echo json_encode($datosArray);
}
