<?php
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
            self::$host     = getenv('DB_HOST')     ?: 'geroynatis.mysql.database.azure.com';
            self::$db_name  = getenv('DB_DATABASE') ?: 'geroynatis';
            self::$username = getenv('DB_USERNAME') ?: 'Daniel';
            self::$password = getenv('DB_PASSWORD') ?: '';

            $caCertPath = __DIR__ . '/../../certs/DigiCertGlobalRootG2.crt.pem';

            // Iniciar conexión
            $mysqli = mysqli_init();

            if (!file_exists($caCertPath)) {
                die("Certificado CA no encontrado en: $caCertPath");
            }

            // Establecer SSL con certificado
            $mysqli->ssl_set(null, null, $caCertPath, null, null);

            // Conexión con SSL
            if (!$mysqli->real_connect(
                self::$host,
                self::$username,
                self::$password,
                self::$db_name,
                3306,
                null,
                MYSQLI_CLIENT_SSL
            )) {
                die('Error de conexión SSL: ' . mysqli_connect_error());
            }

            $mysqli->set_charset("utf8mb4");
            self::$instance = $mysqli;
        }

        return self::$instance;
    }
}

