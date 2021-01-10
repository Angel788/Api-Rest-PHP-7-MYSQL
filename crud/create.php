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

$data = json_decode(file_get_contents("php://input"));
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . "/Media/img";
$servidor = "http://" . $_SERVER["HTTP_HOST"] . "/Media/img";

$items->marca = $_POST['marca'];
$items->name = $_POST['name'];
$items->noserie = $_POST['noserie'];
$items->costo = $_POST['costo'];
$items->descripcion = $_POST['descripcion'];
$searchString = " ";
$replaceString = "-";
$namefile = str_replace($searchString, $replaceString, $originalString);
if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . "/" . $namefile . ".jpg")){
    echo "Se subio el archivo"
}
$filename = $servidor . "/" . $namefile . ".jpg";
if ($items->insertEmployed($filename)) {
    echo 'Employee created successfully.';
} else {
    echo ($items->name . "" . $items->email);
    echo 'Employee could not be created.';
}
//$_FILES['imagen']['tmp_name']