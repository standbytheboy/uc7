<?php
class Database {
    private static $db = null;

    public static function getInstance() {
        if(self::$db === null) {
            self::$db = new PDO("mysql:host=localhost;dbname=agenda", 'root', '');
            return self::$db;
        }

    }
}

?>