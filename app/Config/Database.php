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
            // Cargar variables de entorno desde un archivo .env
            $envFile = __DIR__ . '/../../.env';
            if (file_exists($envFile)) {
                $envVars = parse_ini_file($envFile);
                self::$host = $envVars['DB_HOST'] ?? 'localhost';
                self::$db_name = $envVars['DB_DATABASE'] ?? '';
                self::$username = $envVars['DB_USERNAME'] ?? '';
                self::$password = $envVars['DB_PASSWORD'] ?? '';
            } else {
                throw new Exception('Archivo .env no encontrado');
            }

            $con = mysqli_init();

            // Ruta absoluta al archivo .pem
            $caCertPath = __DIR__ . '/certs/DigiCertGlobalRootCA.crt.pem';

            // Configurar SSL
            mysqli_ssl_set($con, null, null, $caCertPath, null, null);

            // Conectar
            if (!mysqli_real_connect(
                $con,
                self::$host,
                self::$username,
                self::$password,
                self::$db_name,
                3306,
                null,
                MYSQLI_CLIENT_SSL
            )) {
                error_log("Error de conexión: " . mysqli_connect_error());
                die("No se pudo establecer conexión segura con la base de datos.");
            }

            $con->set_charset("utf8mb4");

            self::$instance = $con;
        }

        return self::$instance;
    }
}
