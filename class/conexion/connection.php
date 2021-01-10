<?php
class connection
{
    private $db_table = "employee";
    private $server;
    private $user;
    private $pwd;
    private $bd_name;
    private $port;
    private $conexion;
    function __construct()
    {
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value["server"];
            $this->user = $value["user"];
            $this->pwd = $value["pwd"];
            $this->port = $value["port"];
            $this->bd_name = $value["bdname"];
        }
        $this->conexion = mysqli_connect($this->server, $this->user, $this->pwd, $this->bd_name, $this->port);
        if (mysqli_connect_error()) {
            echo "Ocurrio un error: " . mysqli_connect_error();
            die();
        }
    }

    public function getConection()
    {
        return $this->conexion;
    }
    private function datosConexion()
    {
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . "\config");
        return json_decode($jsondata, true);
    }
}
