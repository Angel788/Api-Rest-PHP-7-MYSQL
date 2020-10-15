<?php
    class  employed {
        public $con;

        private $db_table = "employee";

        public $id;
        public $name;
        public $email;
        public $age;
        public $designation;
        public $created;

        function  __construct($con){
            $this->con=$con;
        }
        
        public function getEmployed(){
            $sqlQuery="SELECT id, name, email, age, designation, created FROM " . $this->db_table . "";
            $consulta=mysqli_query($this->con,$sqlQuery);
            $result= array();
            foreach($consulta as $key){
                $result[]=$key;
            }
            return $this->converUTF8($result);
            
        }
        public function insertEmployed(){
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
           $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = '".$this->name."', 
                        email = '". $this->email."', 
                        age = '". $this->age."', 
                        designation = '". $this->designation."', 
                        created = '". $this->created."'";
           
           
            if(mysqli_query($this->con,$sqlQuery)){
               return true;
            }
            else{
                echo(mysqli_error($this->con));
                return false;
            }
        }
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
            id, 
            name, 
            email, 
            age, 
            designation, 
            created
            FROM
                ". $this->db_table ."
            WHERE 
                id = ".$this->id."
            LIMIT 0,1";
            $stmt=mysqli_query($this->con,$sqlQuery);

            $dataRow = mysqli_fetch_array($stmt);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->age = $dataRow['age'];
            $this->designation = $dataRow['designation'];
            $this->created = $dataRow['created'];
           
        }
        public function updateEmplayed(){
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
             $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = '".$this->name."', 
                        email = '". $this->email."', 
                        age = '". $this->age."', 
                        designation = '". $this->designation."', 
                        created = '". $this->created."'
                        WHERE
                        id='".$this->id."'";
        
            if(mysqli_query($this->con,$sqlQuery)){
               return true;
            }
            return false;
        }
        public function deleteEmplayed(){

            $this->id=htmlspecialchars(strip_tags($this->id));
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = '".$this->id."'";

            if(mysqli_query($this->con,$sqlQuery)){
                return true;
            }
            else{
                return false;
            }
        }
        private function converUTF8($array){
            array_walk_recursive($array,function(&$item,$key){
                if(!mb_detect_encoding($item,'utf-8',true)){
                    $item=utf8_encode($item);
                }
            });
            return $array;
        }
    }
?>