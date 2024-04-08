<?php
  session_start();

  require 'database.php';

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
    <link rel="stylesheet" href="CSS/stilos.css">
    <link rel="stylesheet" href="CSS/calc.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido: <?= $user['email']; ?>
      <br>

      
     
<nav class="calc">

      <div id="formulario">
  <h2>Calculadora de Nómina</h2>
  <label for="fechaInicio">Fecha de Inicio:</label>
  <input type="date" id="fechaInicio">

  <label for="fechaFinal">Fecha Final:</label>
  <input type="date" id="fechaFinal">

  <label for="auxilioTransporte">Auxilio de Transporte:</label>
  <input type="number" id="auxilioTransporte" placeholder="Ingrese el auxilio de transporte">

  <label for="salarioMensual">Salario Mensual:</label>
  <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual">

  <button onclick="calcularNomina()">Calcular Nómina</button>

  <div id="resultado"></div>
</div>
</nav>

<script src="JS/script.js"></script>

                                
                                
<br>
<br>
      
      <a class="link-1" href="salir.php">
        Salir
      </a>
    <?php else: ?>
      <h1>Bienvenido... Inicia sesión o crea una cuenta con nosotros</h1>

      <a class="link-1" href="login.php">Iniciar sesión</a> O
      <a class="link-1" href="registro.php">Registrate</a>
    <?php endif; ?>
  </body>
</html>