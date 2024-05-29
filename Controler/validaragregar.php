<?php
require '../Controler/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $salario = $_POST['salario'];

    // Consulta SQL para insertar datos
    $sql = "INSERT INTO empleados (identificacion, nombre, apellido, salario) VALUES ('$identificacion', '$nombre', '$apellido', '$salario')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos agregados correctamente";
    } else {
        echo "Error al agregar datos: " . $conn->error;
    }
}
$conn->close();
?>