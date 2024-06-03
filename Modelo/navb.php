<?php
  session_start();

  require '../Controler/database.php';

  if (isset($_SESSION['usuario_id'])) {
    
    $records = $conn->prepare('SELECT id, email, password FROM usuario WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results) {
    
      $user = $results;
      
    }
    
  } else {
    header("Location: login.php");
    exit;
  }
?>


<!DOCTYPE html>
<html lang="Es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
</head>
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/calc.css">
<link rel="stylesheet" href="../CSS/calcDos.css">
<link rel="stylesheet" href="../CSS/resultados.css">
<link rel="stylesheet" href="../CSS2/estilosModal.css">
<link rel="stylesheet" href="../CSS2/modalDos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<body>
   <div class="hamburger">
    <div class="_layer -top"></div>
    <div class="_layer -mid"></div>
    <div class="_layer -bottom"></div>
  </div>
  <!--INICIO NAVBAR-->
  <div class="nav" id="main-nav">
    <input type="checkbox" id="nav-check">
    <div class="nav-btn">
      <label for="nav-check">
        <span></span>
        <span></span>
        <span></span>
      </label>
    </div>

    <div class="nav-links">
      <a href="#" target="_blank">Centro de ayuda</a>
      <a href="#" target="_blank"><i class="fas fa-cog"></i></a>
      <a href="#" target="_blank"><i class="fa-solid fa-volume-off"></i></a>
      <a href="#" target="_blank"><i class="fa-regular fa-bell"></i></a>
      <img class="user-profile" src="../imagenes/user2.png" alt="">
      <?php if (!empty($user)) : ?>
         <p><?= $user['email']; ?>
<?php else : ?>
<?php endif; ?>
    </div>
  </div>
  <!--FIN NAVBAR-->

 

  <!--INICIO CALCULADORA-->
  <div id="contenido1" style="display: none;">
    <nav class="calc">
      <div id="formulario">
        <i class="calk fas fa-sack-dollar">
          <span>Liquidar</span>
        </i>
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio">

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal">

        <label for="auxilioTransporte">Auxilio de Transporte:</label>
        <input type="number" id="auxilioTransporte" placeholder="Ingrese el Aux de Transporte">

        <label for="pagosExtras">Pagos extras:</label>
        <input type="number" id="pagosExtras" placeholder="Ingrese sus pagos extras">

        <label for="salarioMensual">Salario Mensual:</label>
        <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual">

        <button class="btn-cal" id="open" onclick="calcularNomina(); manejarModal();">Calcular Nómina</button>
        
      </div>


      <div class="modal-container" id="resultados">
        <div class="modal">
          <h2>Resultados</h2>
          <div id="diasvacaciones"></div>
          <table id="tablaResultados">
            <thead>
              <tr>
                <th>Cesantías</th>
                <th>Intereses sobre Cesantías</th>
                <th>Prima de Servicios</th>
                <th>Vacaciones</th>
                <th>Dias Vacaciones</th>
                <th>Total a Pagar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="cesantiasTotalResult"></td>
                <td id="interesesCesantiasTotalResult"></td>
                <td id="primaServiciosTotalResult"></td>
                <td id="vacacionesTotalResult"></td>
                <td id="diasresultado"></td>
                <td id="salarioTotalResult"></td>
              </tr>
            </tbody>
          </table>
          <div id="pdf"><a href="../Vista/liquidar_pdf.php" style="color:black" style="text-decoration:none;" onclick="generarLiquidarPDF()" target="_blank">Descargar Comprobante</a></div>
          <button class="cerrar-modal" id="btn-close">Cerrar</button>
        </div>
      </div>
    </nav>
  </div>
  


  <!--CALCULADORA DOS-->

  <div id="contenido2" style="display: none;">
    <nav class="calcDos">
      <div id="formulario">
        <i class="calkDos fa-solid fa-money-bill-wave"></i>
        <span>Calcular</span>
        <form id="formularioDos">
          <label for="Inicio">Fecha de Inicio:</label>
          <input type="date" id="Inicio" name="Inicio" required>

          <label for="Final">Fecha Final:</label>
          <input type="date" id="Final" name="Final" required>

          <label for="salario">Salario Mensual:</label>
          <input type="number" id="salario" name="salario" placeholder="Ingrese el salario mensual" required>

          <label for="auxilio">Auxilio de Transporte:</label>
          <input type="number" id="auxilio" name="auxilio" placeholder="Ingrese el auxilio de transporte">

          <label for="Extras">Pagos Extras:</label>
          <input type="number" id="Extras" name="Extras" placeholder="Ingrese los pagos extras">

          <label for="Deducciones">Otras Deducciones:</label>
          <input type="number" id="Deducciones" name="Deducciones" placeholder="Ingrese sus otras deducciones">

          <button class="btn-liquidar" id="openDos" type="button" onclick="calcularMiNomina(); manejarModalDos();">Calcular Nómina</button>
        </form>
<div class="modalDos-container" id="resultadoDos">
  <div class="modalDos">
    <div  id="resultado"></div>
    
    <div id="pdf"><a class="link_pdf" href="../Vista/generar_pdf.php" style="color:black" style="text-decoration:none;" onclick="generarPDF()" target="_blank">Descargar Comprobante</a></div>
    <button class="cerrar-modalDos" id="btn-cerrar">Cerrar</button>
  </div>
</div>
      </div>
    </nav>
  
  </div>
  
  <script>
    function calcularMiNomina() {
       
      const fechaInicio = new Date(document.getElementById('Inicio').value);
      const fechaFinal = new Date(document.getElementById('Final').value);
      const salarioMensual = parseFloat(document.getElementById('salario').value);
      const auxilioTransporte = parseFloat(document.getElementById('auxilio').value) || 0;
      const pagosExtras = parseFloat(document.getElementById('Extras').value) || 0;
      const otrasDeducciones = parseFloat(document.getElementById('Deducciones').value) || 0;

      // Calcular los días trabajados
      const diasTrabajados = Math.ceil((fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24));

      // Calcular el salario bruto
      const salarioBruto = salarioMensual + auxilioTransporte;

      // Calcular las deducciones
      const desDeducciones = (salarioBruto * 0.08);
      const deducciones = salarioBruto - desDeducciones;

      // Calcular el salario neto
      const salarioNeto = ((salarioBruto + pagosExtras) - otrasDeducciones) / 2;

      // Formatear el salario neto con separadores de decenas de mil
      const salarioNetoFormateado = salarioNeto.toLocaleString();
      console.log(salarioNetoFormateado);
      
      // Mostrar el resultado
      
      document.getElementById('resultado').innerHTML = `
       
        <p style="color: black;">Total a Pagar: $${salarioNetoFormateado}</p>
        
    `;
    }
  </script>
 
  
 
 <script>
    function generarPDF() {
    // Obtener el total a pagar
    const totalAPagar = document.getElementById('resultado').innerText.split(': ')[1];
    const Salario = document.getElementById('salario').value;
    const Auxiliot = document.getElementById('auxilio').value;
    const Extra = document.getElementById('Extras').value;
    const Deduccion = document.getElementById('Deducciones').value;
    

    // Imprimir el valor para verificar
    console.log("Valor de totalAPagar:", totalAPagar);
    console.log("Valor del salario:", Salario);
    
    

    // Redirigir al archivo PHP con el total y el nombre de usuario como parámetros GET
    window.location.href = `../Vista/generar_pdf.php?totalAPagar=${totalAPagar}&Salario=${Salario}&Auxiliot=${Auxiliot}&Extra=${Extra}&Deduccion=${Deduccion}`;
}

</script>


  <br>
  <br>

  <!--Agregar-->
  <div id="contenido3" style="display: none;">

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

      
       </table>
   </center>
</body>
</html>


<!--Consultar-->

<div id="contenido4" style="display: none;">

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
</head>
<body>
   <center>
       <h2>Lista de Empleados</h2>
       <table border="1">
           <tr>
               <th>Identificación</th>
               <th>Nombre</th>
               <th>Apellido</th>
               <th>Salario</th>
           </tr>
           <?php
           require '../Controler/database.php';

           // Crear conexión
           $conn = new mysqli($server, $username, $password, $database);

           // Verificar conexión
           if ($conn->connect_error) {
               die("La conexión falló: " . $conn->connect_error);
           }

           // Consulta SQL para obtener la lista de empleados
           $sql_lista = "SELECT * FROM empleados";
           $resultado = $conn->query($sql_lista);

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

           // Cerrar conexión
           $conn->close();
           ?>
       </table>
   </center>
</body>
</html>






<script src="../menu.js"></script>
<script src="../JS/calcular.js"></script>
<script src="../JS/nomina.js"></script>
<script src="../JS/modal.js"></script>
<script src="../JS/modalDos.js"></script>
<script src="../JS/liquidarpdf.js"></script>


</body>
</html>