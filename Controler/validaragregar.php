<?php
require '../Controler/database.php';

// Crear conexión
$conn = new mysqli($server, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Definir una variable para almacenar el mensaje
$mensaje = "";

// Si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $salario = $_POST['salario'];

    // Consulta SQL para insertar datos
    $sql = "INSERT INTO empleados (identificacion, nombre, apellido, salario) VALUES ('$identificacion', '$nombre', '$apellido', '$salario')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Usuario creado correctamente";
    } else {
        $mensaje = "Error al crear usuario: " . $conn->error;
    }
}

// Consulta SQL para obtener la lista de empleados
$sql_lista = "SELECT * FROM empleados";
$resultado = $conn->query($sql_lista);

// Cerrar conexión
$conn->close();
?>

