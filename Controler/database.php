<?php

// Obtener credenciales desde variables de entorno
$dbname = getenv('SUPABASE_DB_NAME');
$user = getenv('SUPABASE_DB_USER');
$password = getenv('SUPABASE_DB_PASS');


if ( !$dbname || !$user || !$password) {
    die("Credenciales de Supabase no configuradas correctamente.");
}

try {
    $conn = pg_connect("dbname=$dbname user=$user password=$password");
    if (!$conn) {
        die("Error de conexión a la base de datos: " . pg_last_error());
    }
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}

?>