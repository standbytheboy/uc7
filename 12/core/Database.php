<?php
class Database
{
    public static function getInstance()
    {
        $db_host = "localhost";
        $db_name = "venda"; // Certifique-se que este banco de dados existe
        $db_user = "root";
        $db_pass = ""; // Sua senha do MySQL

        try {
            $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Opcional para aula, mas bom
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro de conexão com o banco: " . $e->getMessage());
        }
    }
}
?>