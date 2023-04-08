<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    public static function getPDO() {
        static $db = null;

        if ($db === null) {
            $host = getenv('DB_HOST');
            $dbname = getenv('DB_NAME');
            $username = getenv('DB_USERNAME');
            $password = getenv('DB_PASSWORD');
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
            } catch(PDOException $e) {
                throw new PDOException($e->getMessage(), 500);
            }
        }

        return $db;
    }
}