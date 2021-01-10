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

//$data = json_decode(file_get_contents("php://input"));

$nombre_imagen = $_FILES['imagen']['name'];
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . "/Media/Img";
$servidor = "http://" . $_SERVER["HTTP_HOST"] . "/Media/Img";

// employee values
$searchString = " ";
$replaceString = "-";
$items->id = $_POST['idprod'];
$items->marca = $_POST['marca'];
$items->name = $_POST['name'];
$items->noserie = $_POST['noserie'];
$items->costo = $_POST['costo'];
$items->descripcion = $_POST['descripcion'];
$originalString = $items->name;
$namefile = str_replace($searchString, $replaceString, $originalString);
$filename = $carpeta_destino . "/" . $namefile . ".jpg";
$archivoserver = $servidor . "/" . $namefile . ".jpg";
$file_dir = $carpeta_destino . "/" . $namefile . ".jpg";
if (file_exists($filename)) {
    $success = unlink($filename);
}
if (move_uploaded_file($_FILES['imagen']['tmp_name'], $file_dir)) {
    echo "Se subio el archivo";
} else {
    echo "No se subio el archivo";
}
if ($items->updateEmplayed($archivoserver)) {
    echo json_encode("Employee data updated.");
} else {
    echo json_encode("Data could not be updated");
}
