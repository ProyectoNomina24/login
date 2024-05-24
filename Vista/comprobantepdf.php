<?php
// Obtener los datos del formulario
$data = json_decode(file_get_contents('php://input'), true);

// Aquí deberías generar el PDF con los datos recibidos
// Por simplicidad, aquí simplemente se muestra el contenido de los datos recibidos
echo json_encode($data);
?>