<?php

require 'database.php';

$message = '';

if (!empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['email'])  || !empty($_POST['password'])) {
  $sql = "INSERT INTO usuario (nombre,apellido,email, password) VALUES (:nombre,:apellido,:email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nombre', $_POST['nombre']);
  $stmt->bindParam(':apellido', $_POST['apellido']);
  $stmt->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
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
  <link rel="stylesheet" href="CSS2/registro.css">
</head>

<body>
  <div class="login-box">

    <h2>Registra tu usuario</h2>
    <br>
    <div class="login-link">
      <p>O <a href="login.php">Inicia sesión</a></p>
      </div>
      <br>
    <form="registro.php" method="POST">
      <div class="user-box">
        <input name="nombre" type="text" required="">
        <label>Ingrese su nombre</label>
      </div>
      <div class="user-box">
        <input name="apellido" type="text" required="">
        <label>Ingrese su apellido</label>
      </div>
      <div class="user-box">
        <input name="email" type="text" required="">
        <label>Ingrese su correo</label>
      </div>
      <div class="user-box">
        <input name="password" type="password" required="">
        <label>Ingrese su contraseña</label>
      </div>
      <button class="custom-btn btn"><span>Enviar</span></button>
      </form>
  </div>
</body>
</html>