<?php
require_once "conexion/connection.php";
require_once "answer.class.php";
error_reporting(0);

class auth
{
    private $con;
    function  __construct($con)
    {
        $this->con = $con;
    }
    public function login($json)
    {
        $_respeustas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["usuario"]) || !isset($datos["password"])) {
            return $_respeustas->error_400();
        } else {
            $usuario = $datos["usuario"];
            $password = $datos["password"];
            $password = $this->encriptar($password);
            $datos = $this->obtenerDatosUsuario($usuario);
            if (!$datos == 0) {
                if ($password == $datos[0]["paswword"]) {
                    if ($datos[0]["estado"] === "Activo") {
                        $verifica = $this->insertarToken($datos[0]["userId"]);
                        if (!$verifica == 0) {
                            $result = $_respeustas->response;
                            $result["result"] = array(
                                "token" => $verifica,
                                "correo" => $datos[0]["usuario"],
                                "userId" => $datos[0]["userId"]
                            );
                            return $result;
                        } else {
                            return $_respeustas->error_500("Error en el servidor, no se pudieron guardar los archivos intenta mas tarde");
                        }
                    } else {
                        return $_respeustas->error_200("El ususario esta inactivo");
                    }
                } else {
                    return $_respeustas->error_200("El password es invalido");
                }
            } else {
                echo "No existe linea 31";
                return $_respeustas->error_200("El ususuario $usuario no existe");
            }
        }
    }
    private function obtenerDatosUsuario($correo)
    {
        $query = "SELECT userId,paswword,estado FROM usuarios WHERE usuario ='" . $correo . "' LIMIT 0,1";
        $datos = $this->ObtenerDatos($query);
        $datosJSON = json_encode($datos[0]);
        if (isset($datos[0]["userId"])) {
            return $datos;
        } else {
            return 0;
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
    private function encriptar($string)
    {
        return md5($string);
    }
    private function insertarToken($usuarioid)
    {
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        $date = date("Y-m-d H:i");
        $estado = "Activo";
        $query = "INSERT INTO usuarios_token (userId,token,estado,fecha) VALUES('" . $usuarioid . "','" . $token . "','" . $estado . "','" . $date . "')";
        $verifica = mysqli_query($this->con, $query);
        if ($verifica) {
            return $token;
        } else {
            return 0;
        }
    }
    public function newUser($json)
    {
        $_respeustas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["usuario"]) || !isset($datos["password"])) {
            return $_respeustas->error_400();
        } else {
            $usuario = $datos["usuario"];
            $password = $datos["password"];
            $password = $this->encriptar($password);
            $sql = "INSERT INTO usuarios (usuario,paswword,estado) VALUES ('" . $usuario . "','" . $password . "','Activo')";
            $respuesta = $this->noQuery($sql);
            if (!$respuesta == 0) {
                $result = $_respeustas->response;
                $result["result"] = array(
                    "Response" => "Se ejecuto la accion en el servidor, te registraste en el Sistema",
                    "Correo" => $usuario
                );
                return $result;
            } else {
                return $_respeustas->error_500("Ocurrio un error en el servidor porfavor intenta mas tarde");
            }
        }
    }
    public function actualizarUser($json)
    {
        $_respeustas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["usuario"]) || !isset($datos["pasword"]) || !isset($datos["usuarioOld"]) || !isset($datos["passwordOld"])) {
            return $_respeustas->error_400();
        } else {
            $usuario = $datos["usuario"];
            $password = $datos["password"];
            $usuarioOld = $datos["usuarioOld"];
            $passwordOld = $datos["passwordOld"];
            $passwordOld = $this->encriptar($passwordOld);
            $password = $this->encriptar($password);
            $sql = "UPDATE usuarios SET usuario = '" . $usuario . "', paswword = '" . $password . "' WHERE (ususario='" . $usuarioOld . "' OR paswword='" . $passwordOld . "')";
            $respuesta = $this->noQuery($sql);
            if (!$respuesta == 0) {
                $result = $_respeustas->response;
                $result["result"] = array(
                    "Response" => "Se ejecuto la accion en el servidor",
                    "Correo" => $usuario
                );
                return $result;
            } else {
                return $_respeustas->error_500("Ocurrio un error en el servidor porfavor intenta mas tarde");
            }
        }
    }
    public function DeleteUser($json)
    {
        $_respeustas = new respuestas();
        $datos = json_decode($json, true);
        if (!isset($datos["usuario"])) {
            return $_respeustas->error_400();
        } else {
            $id = $datos["usuario"];
            $sql = "DELETE FROM usuarios WHERE ususario='" . $id . "'";
            $respuesta = $this->noQuery($sql);
            if (!$respuesta == 0) {
                $result = $_respeustas->response;
                $result["result"] = array(
                    "Response" => "Se ejecuto la accion en el servidor",
                    "Correo" => $id
                );
                return $result;
            } else {
                return $_respeustas->error_500("Ocurrio un error en el servidor porfavor intenta mas tarde");
            }
        }
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
}
