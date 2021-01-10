<?php
require_once "conexion/connection.php";
require_once "answer.class.php";
error_reporting(0);

class carrito
{
    function  __construct($con)
    {
        $this->con = $con;
    }
    public function insertCarrito($json)
    {
        $_respeustas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["token"]) || !isset($datos["id_atributo"])) {
            return $_respeustas->error_400();
        } else {
            $id_atributo = $datos["id_atributo"];
            $token = $datos["token"];
            $sql = "INSERT INTO carrito (token,	id_atributo) VALUES ('" . $token . "','" . $id_atributo . "')";
            $respuesta = $this->noQuery($sql);
            if (!$respuesta == 0) {
                $result = $_respeustas->response;
                $result["result"] = array(
                    "Response" => "Se ejecuto la accion en el servidor, te registraste en el Sistema"
                );
                return $result;
            } else {
                return $_respeustas->error_500("Ocurrio un error en el servidor porfavor intenta mas tarde");
            }
        }
    }
    public function Deleteitem($json)
    {
        $_respeustas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["id"])) {
            return $_respeustas->error_400();
        } else {
            $id = $datos["id"];
            $sql = "DELETE FROM carrito WHERE Id='" . $id . "'";
            $respuesta = $this->noQuery($sql);
            if (!$respuesta == 0) {
                $result = $_respeustas->response;
                $result["result"] = array(
                    "Response" => "Se ejecuto la accion en el servidor, Se elimino en el Sistema"
                );
                return $result;
            } else {
                return $_respeustas->error_500("Ocurrio un error en el servidor porfavor intenta mas tarde");
            }
        }
    }
    public function verItems($json)
    {
        $respuestas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["token"])) {
            return $respuestas->error_400();
        } else {
            $token = $datos["token"];
            $sql = "SELECT carrito.Id,atributos.nombre, atributos.costo, atributos.rutaimagen FROM carrito,atributos,usuarios_token WHERE carrito.token=usuarios_token.token AND carrito.id_atributo=atributos.id AND carrito.token='" . $token . "'";
            $consulta = mysqli_query($this->con, $sql);
            $result = array();
            foreach ($consulta as $key) {
                $result[] = $key;
            }
            return $this->converUTF8($result);
        }
    }
    public function ObtenerDatos($sqlstr)
    {
        $consulta = mysqli_query($this->con, $sqlstr);
        $result = array();
        foreach ($consulta as $key) {
            $result[] = $key;
        }
        return $this->converUTF8($result);
    }
    public function noQuery($sqlstr)
    {
        if (mysqli_query($this->con, $sqlstr)) {
            return 1;
        } else {
            return 0;
        }
    }
    private function converUTF8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }
}
