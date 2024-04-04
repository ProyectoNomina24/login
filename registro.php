<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['nombre'])||!empty($_POST['apellido'])||!empty($_POST['email'])  || !empty($_POST['password'])) {
    $sql = "INSERT INTO usuario (nombre,apellido,email, password) VALUES (:nombre,:apellido,:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario creado correctamente';
    } else {
      $message = 'Lo siento, no se puedo crear su cuenta, verifique nuevamente';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="CSS/stilos.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registra tu usuario</h1>
    <span>O <a href="login.php">Inicia sesión</a></span>

    <form action="registro.php" method="POST">
    <input name="nombre" type="text" placeholder="Ingrese su nombre">
    <input name="apellido" type="text" placeholder="Ingrese su apellido">
      <input name="email" type="text" placeholder="Ingrese su correo">
      <input name="password" type="password" placeholder="Ingrese su contrasena">
      
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>