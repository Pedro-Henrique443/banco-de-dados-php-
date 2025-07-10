<?php
namespace Model;

use PDO;
use PDOException;
use Model\Connection;


class Imcs{
    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function createImc($weight, $height,$result){
        try{
            $sql = "ISERT INTO imcs (weight, height, result, created_at) 
                    VALUES (:weight, :height, :result, NOW())";

            $conn = $this->db->prepare($sql);
            
            $conn->bindParam(":weight", $weight, PDO::PARAM_STR);
            $conn->bindParam(":height", $height, PDO::PARAM_STR);
            $conn->bindParam(":result", $result, PDO::PARAM_STR);   
            
            return $conn->execute();
        }
        catch(PDOException $error) {
            echo "Erro ao criar IMC: " . $error->getMessage();
            return false;
    }
}


}





?>