<?php

require '../Controler/database.php';

$message = '';

if (!empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['identificacion']) || !empty($_POST['email'])  || !empty($_POST['password'])) {
  $sql = "INSERT INTO usuario (nombre, apellido, identificacion, email, password) VALUES (:nombre, :apellido, :identificacion, :email, :password)";


  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nombre', $_POST['nombre']);
  $stmt->bindParam(':apellido', $_POST['apellido']);
  $stmt->bindParam(':identificacion', $_POST['identificacion']);
  $stmt->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $password);
try{
  
  if ($stmt->execute()) {
    $message = '<span style="color: white;text-align: center; fonnt-size:25px; font-weight: bold;">Usuario creado correctamente</span>';
  } else {
    $message = 'Lo siento, no se pudo crear su cuenta, verifique nuevamente';
  }
}catch (PDOException $e){
  $message = 'Error al ejecutar la consulta' . $e->getMessage();
}
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="../CSS2/registro.css">
</head>

<body>
  
  
    <br>
    <br>
  <div class="login-box">
    <h2>Registra tu usuario</h2>
    <div class="login-link">
      <p>O <a href="../Modelo/login.php">Inicia sesión</a></p>
      </div>
      <br>
      <br>
      <form id="registrationForm" action="registro.php" method="POST">
  <div class="user-box">
    <input name="nombre" type="text" required="">
    <label>Ingrese su nombre</label>
  </div>
  <div class="user-box">
    <input name="apellido" type="text" required="">
    <label>Ingrese su apellido</label>
  </div>
  <div class="user-box">
    <input name="identificacion" type="number" required="">
    <label>Ingrese su identificacion</label>
  </div>
  <div class="user-box">
    <input name="email" id="email" type="email" required="">
    <label>Ingrese su correo</label>
  </div>
  <div class="user-box">
    <input name="password" id="password" type="password" required="">
    <label>Ingrese su contraseña</label>
  </div>
  <button type="submit" class="custom-btn btn"><span>Enviar</span></button>
  <br><br>
  <div id="mensaje" style="display:none;"><?php echo $message; ?></div>
</form>
  </div>

  <script src="../JS/registrarse.js"></script>
  <script src="../JS/mensaje.js"></script>
</body>
</html>