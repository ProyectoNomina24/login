<?php
session_start();

require './Controler/database.php';

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
  <link rel="stylesheet" href="CSS/styleIndex.css">
  <link rel="stylesheet" href="CSS/calc.css">
  <link rel="stylesheet" href="CSS/footer.css">
  <link rel="stylesheet" href="precios.css">
  <link rel="stylesheet" href="quienes.css">
</head>

<body>
  <div id="menuContainer" class="menu-container"></div>

  <!-- Start Navigation Bar -->
  <nav class="navbar js-navbar">
    <ul class="menu">
      <div class="logo-container">
        <img class="logoM" src="/imagenes/moneda.png" alt="">
        <p class="text-logo">My Nomina</p>
      </div>
      <li>
        <a class="hasDropdown" href="#">Funciones <i class="fa fa-angle-down"></i></a>

        <ul class="container">
          <div class="container__list">
            <div class="container__listItem">
              <div>Nómina y Seguridad Social</div>
            </div>
            <div class="container__listItem">
              <div>Vinculación</div>
            </div>
            <div class="container__listItem">
              <div>Bienestar Financiero</div>
            </div>
          </div>
        </ul>
      </li>
      <li>
        <a class="hasDropdown" href="#">Recursos<i class="fa fa-angle-down"></i></a>
        <ul class="container has-multi">
          <div class="container__list container__list-multi">
            <div class="container__listItem">
              <div>Blog</div>
            </div>
            <div class="container__listItem">
              <div>Blibioteca</div>
            </div>
            <div class="container__listItem">
              <div>Centro de ayuda</div>
            </div>
        </ul>
      </li>
      <li>
        <a href="#">Porque My Nomina?</a>
      </li>
      <li>
        <a href="index.html">Precios</a>
      </li>
    </ul>
  </nav>

  <!-- End Navigation Bar -->

  <?php if (!empty($user)) : ?>
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




    <br>
    <br>
    <a class="link-1" href="salir.php">
      Salir
    </a>
  <?php else : ?>

    <div id="container">
      <h1 class="msjBienvenido">Bienvenido</h1>
      <br>
      <h1 class="msjBienvenido">Inicia sesión</h1>
      <h1 class="msjBienvenido2"> o </h1>
      <h1 class="msjBienvenido">crea una cuenta con nosotros</h1>
      <br>
      <div id="containerBut">
        <a class="link-1" href="./Modelo/login.php">Inicia sesión</a>
        <a class="link-2" href="./Modelo/registro.php">Regístrate</a>

      </div>
    </div>

    <footer>
      <div class="row">
        <div class="col">
          <h1 class="logo2">My Nomina</h1>
          <p>Recibe las últimas actualizaciones y noticias directamente en tu correo electrónico</p>
        </div>
        <div class="col">
          <h3>Office <div class="underline"><span></span></div>
          </h3>
          <p>ITPL Road</p>
          <p>Medellin, Antioquia</p>
          <p>PIN 650054, Colombia</p>
          <p class="email-id">MyNomina@gmail.com</p>
          <h4>+57 - 3242330008</h4>
        </div>
        <div class="col">
          <h3>Links <div class="underline"><span></span></div>
          </h3>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">Contacts</a></li>
          </ul>
        </div>
        <div class="col">
          <h3>Newsletter <div class="underline"><span></span></div>
          </h3>
          <form action="">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" placeholder="Enter your Email" required>
            <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
          </form>
          <div class="social-icons">
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-brands fa-pinterest"></i>
          </div>
        </div>
      </div>
      <hr>
      <p class="cop">My Nomina 2024 | All Rigths Reserved</p>
    </footer>
  <?php endif; ?>
</body>
<script src="JS/script.js"></script>

</html>