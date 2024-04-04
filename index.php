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
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido: <?= $user['email']; ?>
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