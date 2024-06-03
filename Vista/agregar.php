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
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
   <center>
       <h2>Registro de Empleados</h2>
       <!-- Mostrar el mensaje -->
       <?php echo $mensaje; ?>
       <!-- Formulario de registro -->
       <form action="#" method="post">
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

       <!-- Lista de empleados -->
       <h2>Lista de Empleados</h2>
       <table border="1">
           <tr>
               <th>Identificación</th>
               <th>Nombre</th>
               <th>Apellido</th>
               <th>Salario</th>
           </tr>
           <?php
           // Mostrar los datos de los empleados en la tabla
           if ($resultado->num_rows > 0) {
               while($fila = $resultado->fetch_assoc()) {
                   echo "<tr>";
                   echo "<td>" . $fila["identificacion"] . "</td>";
                   echo "<td>" . $fila["nombre"] . "</td>";
                   echo "<td>" . $fila["apellido"] . "</td>";
                   echo "<td>" . $fila["salario"] . "</td>";
                   echo "</tr>";
               }
           } else {
               echo "<tr><td colspan='4'>No hay empleados registrados</td></tr>";
           }
           ?>
       </table>
   </center>
</body>
</html>
