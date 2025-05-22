<?php
class Database
{
    public static function getInstance()
    {
        return new PDO("mysql:host=localhost;dbname=venda", "root", "");
    }
}
?>