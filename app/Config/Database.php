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

            // Inicializa mysqli para configurar SSL
            $mysqli = mysqli_init();

            // Ruta al certificado CA (ajusta la ruta según donde subas el archivo)
            $caCertPath = __DIR__ . '/../../certs/DigiCertGlobalRootG2.crt.pem';

            // Configura SSL - si no tienes cliente cert/key, pasan NULL
            $mysqli->ssl_set(NULL, NULL, $caCertPath, NULL, NULL);

            // Conexión segura
            $mysqli->real_connect(self::$host, self::$username, self::$password, self::$db_name);

            if ($mysqli->connect_error) {
                error_log("Error de conexión: " . $mysqli->connect_error);
                die("Lo sentimos, no podemos conectar con la base de datos en este momento.");
            }

            $mysqli->set_charset("utf8mb4");

            self::$instance = $mysqli;
        }

        return self::$instance;
    }
}
