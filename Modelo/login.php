<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
  header('Location: /liquidar');
  exit; // Add exit to stop further execution
}

require '../Controler/database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM usuario WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  if ($results && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['usuario_id'] = $results['id'];
    header("Location: ../Modelo/navb.php");
    exit; // Add exit to stop further execution
  } else {
    $message = 'Lo siento, sus datos no coinciden';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="../CSS2/Login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="wrapper">
  <h1>Bienvenido!</h1>
  <form action="login.php" method="POST"> <!-- Corrected form action -->
    <div class="input-box">
      <input name="email" type="text" placeholder="Ingrese su correo">
      <i class="bx bxs-user"></i>
    </div>
    <div class="input-box">
      <input name="password" type="password" placeholder="Ingrese su contraseña">
      <i class="bx bxs-lock-alt"></i>
    </div>
    <div class="remember-forgot">
      <label><input type="checkbox">Remember me</label>
      <a href="#">Forgot password?</a>
    </div>
    <div class="register-link">
      <p>Don't have an account? <a href="registro.php">Register</a></p>
    </div>
    <?php if (!empty($message)) : ?>
      <p><?php echo $message; ?></p> <!-- Display error message -->
    <?php endif; ?>
    <br>
    <input class="btn" type="submit" value="Enviar">
  </form>
</div>
</body>
</html>
