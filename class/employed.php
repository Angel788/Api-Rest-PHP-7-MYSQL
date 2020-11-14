<?php
class  employed
{
    public $con;

    private $db_table = "atributos";

    public $id;
    public $name;
    public $nombre;
    public $email;
    public $age;
    public $designation;
    public $created;
    public $marca;
    public $costo;
    public $descripcion;
    public $rutaimagen;
    public $noserie;

    function  __construct($con)
    {
        $this->con = $con;
    }

    public function getEmployed()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $consulta = mysqli_query($this->con, $sqlQuery);
        $result = array();
        foreach ($consulta as $key) {
            $result[] = $key;
        }
        return $this->converUTF8($result);
    }
    public function insertEmployed()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->noserie = htmlspecialchars(strip_tags($this->noserie));
        $this->costo = htmlspecialchars(strip_tags($this->costo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->rutaimagen = htmlspecialchars(strip_tags($this->rutaimagen));
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        nombre = '" . $this->name . "', 
                        Marca = '" . $this->marca . "', 
                        noserie = '" . $this->noserie . "', 
                        costo = '" . $this->costo . "', 
                        descripcion = '" . $this->descripcion . "'
                        rutaimagen= '" . $this->rutaimagen . "' 
                        ";


        if (mysqli_query($this->con, $sqlQuery)) {
            return true;
        } else {
            echo (mysqli_error($this->con));
            return false;
        }
    }
    public function getSingleEmployee()
    {
        $sqlQuery = "SELECT 
                  id,
                  Marca,
                  nombre,
                  noserie,
                  costo,
                  descripcion,
                  rutaimagen
                FROM
                " . $this->db_table . "
            WHERE 
                id = " . $this->id . "
            LIMIT 0,1";

        $stmt = mysqli_query($this->con, $sqlQuery);

        $dataRow = mysqli_fetch_array($stmt);

        $this->marca = $dataRow['Marca'];
        $this->name = $dataRow['nombre'];
        $this->noserie = $dataRow['noserie'];
        $this->costo = $dataRow['costo'];
        $this->descripcion = $dataRow['descripcion'];
        $this->rutaimagen = $dataRow['rutaimagen'];
    }
    public function updateEmplayed(string $url)
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->noserie = htmlspecialchars(strip_tags($this->noserie));
        $this->costo = htmlspecialchars(strip_tags($this->costo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->rutaimagen = htmlspecialchars(strip_tags($this->rutaimagen));
        $sqlQuery = "INSERT INTO 
                        " . $this->db_table . "
                    SET
                        nombre = '" . $this->name . "', 
                        Marca = '" . $this->marca . "', 
                        noserie = '" . $this->noserie . "', 
                        costo = '" . $this->costo . "', 
                        descripcion = '" . $this->descripcion . "'
                        rutaimagen= '" . $url . "/" . $this->name . "' 
                        ";

        if (mysqli_query($this->con, $sqlQuery)) {
            return true;
        }
        return false;
    }
    public function deleteEmplayed()
    {

        $this->id = htmlspecialchars(strip_tags($this->id));
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = '" . $this->id . "'";

        if (mysqli_query($this->con, $sqlQuery)) {
            return true;
        } else {
            return false;
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
