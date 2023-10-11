<?php
    class User{

        private $conn;

        private $dbTable = "users";

        public $id;
        public $name;
        public $phone;
        public $organization;
      
        public function __construct($db){
            $this->conn = $db;
        }

        public function getUsers(){
            $sqlQuery = "SELECT id, name, phone, organization
               FROM " . $this->dbTable . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                    name = :name, 
                    phone = :phone, 
                    organization = :organization";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->organization=htmlspecialchars(strip_tags($this->organization));
                   
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":organization", $this->organization);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleUser(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        phone, 
                        organization
                      FROM
                        ". $this->dbTable ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->phone = $dataRow['phone'];
            $this->organization = $dataRow['organization'];
        }      
        
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                    name = :name, 
                    phone = :phone, 
                    organization = :organization
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->organization=htmlspecialchars(strip_tags($this->organization));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":organization", $this->organization);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>