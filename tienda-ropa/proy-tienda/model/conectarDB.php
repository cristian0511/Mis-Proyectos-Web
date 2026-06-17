<?php


function conectaBaseDatos(){
    // Configuración de los parámetros para el servidor local
    $host = 'localhost';
    $db   = 'db_tienda';
    $user = 'root';       // Usuario por defecto en entornos locales (XAMPP/WAMP)
    $pass = '';           // Contraseña por defecto (vacía en XAMPP)
    $charset = 'utf8mb4'; // Soporte completo para caracteres especiales y emojis

    // Construcción del Data Source Name (DSN)
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    
    // Opciones recomendadas de PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de errores
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna los datos como arreglos asociativos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación; usa preparaciones reales del motor
    ];

    try {
        // Creamos la instancia de PDO
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (\PDOException $e) {
        // En producción es mejor registrar el error en un log y no mostrar detalles internos
        // Pero para desarrollo local, esto te ayudará a debuggear rápidamente:
        die("Error crítico de conexión en la base de datos: " . $e->getMessage());
    }
}
?>