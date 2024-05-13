<?php
session_start();

require '../Controler/database.php';

if (isset($_SESSION['usuario_id'])) {
  $records = $conn->prepare('SELECT id, email, password FROM usuario WHERE id = :id');
  $records->bindParam(':id', $_SESSION['usuario_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Bienvenido a Mynomina</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script src="https://kit.fontawesome.com/162e2e5f40.js"></script>
  <link rel="stylesheet" href="../CSS2/style.css">
  
  <link rel="stylesheet" href="../CSS/calc.css">
  <link rel="stylesheet" href="../CSS/resultados.css">
</head>

<body>
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
      <div class="user-profile" id="myProfile">
      </div>
    </div>
  </div>
  <!--MENSAJE BIENVENIDO-->
  <?php if (!empty($user)) : ?>
    <br style=""><?= $user['email']; ?>
    
  <!--FIN NAVBAR-->




    <nav class="calc">
      <div id="formulario">
        <h2>Calculadora de Nómina</h2>
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio">

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal">

        <label for="auxilioTransporte">Auxilio de Transporte:</label>
        <input type="number" id="auxilioTransporte" placeholder="Ingrese el auxilio de transporte">

        <label for="pagosExtras">Pagos extras:</label>
        <input type="number" id="pagosExtras" placeholder="Ingrese sus pagos extras">

        <label for="salarioMensual">Salario Mensual:</label>
        <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual">

        <button onclick="calcularNomina()">Calcular Nómina</button>
      </div>

      <div id="resultados">
        <h2>Resultados</h2>
        <table id="tablaResultados">
          <thead>
            <tr>
              <th>Cesantías</th>
              <th>Intereses sobre Cesantías</th>
              <th>Prima de Servicios</th>
              <th>Vacaciones</th>
              <th>Total a Pagar</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td id="cesantiasTotalResult"></td>
              <td id="interesesCesantiasTotalResult"></td>
              <td id="primaServiciosTotalResult"></td>
              <td id="vacacionesTotalResult"></td>
              <td id="salarioTotalResult"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </nav>






    <div id="contenido2" style="display: none;">
      <nav class="calc">
        <h1>Calculadora de Nómina</h1>
        <div id="formulario">
          <h2>Datos del Empleado</h2>
          <label for="fechaInicio">Fecha de Inicio:</label>
          <input type="date" id="fechaInicio" required>

          <label for="fechaFinal">Fecha Final:</label>
          <input type="date" id="fechaFinal" required>
          <label for="salarioMensual">Salario Mensual:</label>
          <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual" required>

          <label for="auxilioTransporte">Auxilio de Transporte:</label>
          <input type="number" id="auxilioTransporte" placeholder="Ingrese el auxilio de transporte" required>

          <label for="pagosExtras">Pagos Extras:</label>
          <input type="number" id="pagosExtras" placeholder="Ingrese los pagos extras">

          <label for="otrasDeducciones">Otras Deducciones:</label>
          <input type="number" id="otrasDeducciones" placeholder="Ingrese sus otras deducciones">

          <button onclick="calcularMiNomina()">Calcular Nómina</button>
        </div>
      

        <div id="resultados">
          <h2>Resultado</h2>
          <div id="salarioNetoResult"></div>
        </div>
      </nav>
    </div>
    <?php else : ?>
      <?php endif; ?>
      
      <script src="menu.js"></script>
      <script src="../JS/calcular.js"></script>
      <script src="../JS/calcular2.js"></script>
      <script src="../JS/otro.js"></script>
    </body>
</html>