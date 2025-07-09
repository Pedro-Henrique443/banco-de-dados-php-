<?php

namespace Model;

use Model\Connection;

use PDO;
use PDOException;

require_once __DIR__ . '../../Config/configuration.php';

class User{
    private $db;

    /**
     * Metodo que ira ser executado toda vez que
     * for criado de um objeto de classe -> USER
     */
    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    // FUNÇÃO DE CRIAR USUÁRIO 
    public function registerUser($user_fullname, $email, $password)
    {
        try {
            // inserção de dados na linguagem SQL
            $sql = "INSERT INTO user (user_fullname, email, password, created_at) 
                    VALUES (:user_fullname, :email, :password, NOW())";
            // Preparar o banco de dados para receber o chamado acima
            $conn = $this->db->prepare($sql);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Referenciar os dados passados pelo comando sql com os parâmetros da função
            $conn->bindParam(':user_fullname', $user_fullname,PDO::PARAM_STR);
            $conn->bindParam(':email', $email,PDO::PARAM_STR);
            $conn->bindParam(':password',$hashedPassword,PDO::PARAM_STR);

            // Executar tudo
            $conn->execute();

        } catch (PDOException $error) {
            // Exibir mensagem de erro
            echo "Erro ao executar o comando" . $error->getMessage();
            return false;
        }
    }
}

?>