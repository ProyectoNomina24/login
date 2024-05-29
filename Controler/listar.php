<?php
require '../Controler/database.php';

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