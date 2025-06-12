<?php
// app/Config/Database.php

namespace App\Config;

use mysqli;
use Exception;

class Database
{
    private static $host;
    private static $db_name;
    private static $username;
    private static $password;

    private static $instance = null;

    private function __construct() {}

    public static function getConnection()
    {
        if (self::$instance === null) {
            self::$host     = getenv('DB_HOST')     ?: 'localhost';
            self::$db_name  = getenv('DB_DATABASE') ?: 'geroynatis';
            self::$username = getenv('DB_USERNAME') ?: 'root';
            self::$password = getenv('DB_PASSWORD') ?: '';

            self::$instance = new mysqli(
                self::$host,
                self::$username,
                self::$password,
                self::$db_name
            );

            if (self::$instance->connect_error) {
                error_log("Error de conexión: " . self::$instance->connect_error);
                die("Lo sentimos, no podemos conectar con la base de datos en este momento.");
            }

            self::$instance->set_charset("utf8mb4");
        }

        return self::$instance;
    }
}
