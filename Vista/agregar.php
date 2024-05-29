<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mynomina';

// Crear conexión
$conn = new mysqli($server, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

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
        echo "Datos agregados correctamente";
    } else {
        echo "Error al agregar datos: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="agregar.php" method="post">
        <label for="identificacion">Identificación:</label>
        <input type="text" id="identificacion" name="identificacion" required><br><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <label for="salario">Salario:</label>
        <input type="number" id="salario" name="salario" required><br><br>
        
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mynomina';

// Crear conexión
$conn = new mysqli($server, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Consulta SQL para seleccionar los registros
$sql = "SELECT identificacion, nombre, apellido, salario FROM empleados";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Imprimir los datos en una tabla HTML
    echo "<table border='1'>
            <tr>
                <th>Identificación</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Salario</th>
            </tr>";

    // Iterar sobre los resultados y mostrar cada registro
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["identificacion"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["apellido"]."</td>
                <td>".$row["salario"]."</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros.";
}

// Cerrar conexión
$conn->close();
?>
<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mynomina';

// Crear conexión
$conn = new mysqli($server, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Si se recibió una solicitud POST (es decir, si se envió el formulario de edición)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $salario = $_POST['salario'];

    // Consulta SQL para actualizar los datos
    $sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', salario='$salario' WHERE identificacion='$identificacion'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos actualizados correctamente";
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }
}

// Obtener el ID del empleado a editar (puede provenir de un parámetro GET o POST)
$identificacion_a_editar = $_GET['identificacion'];

// Consulta SQL para seleccionar los datos del empleado a editar
$sql = "SELECT identificacion, nombre, apellido, salario FROM empleados WHERE identificacion='$identificacion_a_editar'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar el formulario de edición con los datos del empleado
    $row = $result->fetch_assoc();
    ?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="identificacion" value="<?php echo $row['identificacion']; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
        Apellido: <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>"><br>
        Salario: <input type="text" name="salario" value="<?php echo $row['salario']; ?>"><br>
        <input type="submit" value="Guardar Cambios">
    </form>
    <?php
} else {
    echo "No se encontraron datos para editar.";
}

// Cerrar conexión
$conn->close();
?>
<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mynomina';

// Crear conexión
$conn = new mysqli($server, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Si se recibió una solicitud GET con el ID del empleado a eliminar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['identificacion'])) {
    // Obtener el ID del empleado a eliminar
    $identificacion_a_eliminar = $_GET['identificacion'];

    // Consulta SQL para eliminar el empleado
    $sql = "DELETE FROM empleados WHERE identificacion='$identificacion_a_eliminar'";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado eliminado correctamente";
    } else {
        echo "Error al eliminar empleado: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
