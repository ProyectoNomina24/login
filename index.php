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
  <title>Bienvenido a Mynómina</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="CSS/styleIndex.css">
  <link rel="stylesheet" href="CSS/calc.css">
  <link rel="stylesheet" href="CSS/footer.css">
  <link rel="stylesheet" href="precios.css">


</head>

<body>
  <div class="hamburger">
    <div class="_layer -top"></div>
    <div class="_layer -mid"></div>
    <div class="_layer -bottom"></div>
  </div>

  <!-- Start Navigation Bar -->
  <nav class="navbar js-navbar">
    <ul class="menu">
      <div class="logo-container">
        <img class="logoM" src="./imagenes/moneda.png" alt="">
        <p class="text-logo">My Nómina</p>
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
              <div>Biblioteca</div>
            </div>
            <div class="container__listItem">
              <div>Centro de ayuda</div>
            </div>
          </div>
        </ul>
      </li>
      <li>
        <a href="quienes_somos.html">Quienes Somos?</a>
      </li>
      <li>
        <a href="index.html">Precios</a>
      </li>
    </ul>
  </nav>

  <!-- JavaScript para alternar el menú lateral -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    function toggleMenu(event) {
      // Alternar la clase 'is-active' en el botón de hamburguesa
      this.classList.toggle('is-active');
      // Alternar la clase 'is_active' en el menú de navegación
      document.querySelector(".navbar").classList.toggle("is_active");
      // Evitar el comportamiento predeterminado del enlace
      event.preventDefault();
    }

    // Obtener el botón de hamburguesa por su clase
    var menuButton = document.querySelector('.hamburger');

    // Verificar si el botón de hamburguesa existe antes de agregar un event listener
    if (menuButton) {
      // Agregar un event listener para alternar el menú al hacer clic en el botón de hamburguesa
      menuButton.addEventListener('click', toggleMenu);
    }

    const menuItems = document.querySelectorAll('.menu li a.hasDropdown');

    menuItems.forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const submenu = this.nextElementSibling;
        if (window.innerWidth <= 768) { // Verifica el ancho de la pantalla
          if (submenu.classList.contains('container--is-visible')) {
            submenu.classList.remove('container--is-visible');
            // Rotar la flecha hacia arriba cuando el submenú se oculta
            this.querySelector('i').classList.remove('rotate-down');
          } else {
            // Cierra otros submenús abiertos
            document.querySelectorAll('.container.container--is-visible').forEach(openSubmenu => {
              openSubmenu.classList.remove('container--is-visible');
              // Rotar la flecha hacia arriba cuando se cierran otros submenús
              openSubmenu.previousElementSibling.querySelector('i').classList.remove('rotate-down');
            });
            submenu.classList.add('container--is-visible');
            // Rotar la flecha hacia arriba cuando el submenú se muestra
            this.querySelector('i').classList.add('rotate-down');
          }
        }
      });
    });
  });
</script>


  <!-- End Navigation Bar -->

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

</body>

<script src="JS/script.js"></script>
<script src="https://kit.fontawesome.com/162e2e5f40.js"></script>

</html>