<?php

// CONFIGURAÇÃO DE USO

// EXEMPLO DE USO EM OUTRAS CLASSES = use model\Connection
namespace Model;

use PDO;
use PDOException;

// BUSCANDO DADOS DE CONFIGURAÇÃO DO BANCO DE DADOS
require_once __DIR__ . "../../Config/configuration.php";

class Connection
{
    // ATRIBUTO ESTÁTICO QUE IRÁ PERMITIR A CONEXÃO ABAIXO
    private static $conn;

    // CONEXÃO COM O BANCO DE DADOS
    public static function getInstance()
    {
        // CRIAR UMA NOVA CONEXÃO SOMENTE SE ELA NÃO EXISTIR
        try {
            if (empty(self::$conn)) {
                self::$conn = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . '', DB_USER, '' . DB_PASSWORD);
            }
        } catch (PDOException $error) {
            die("Erro ao estabelecer conexão: " . $error->getMessage());
        }
        return self::$conn;
    }
}






?>