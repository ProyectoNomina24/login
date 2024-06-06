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
  <title>Liquidar</title>
</head>
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/calc.css">
<link rel="stylesheet" href="../CSS/calcDos.css">
<link rel="stylesheet" href="../CSS/resultados.css">
<link rel="stylesheet" href="../CSS2/estilosModal.css">
<link rel="stylesheet" href="../CSS2/load.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
  /* Estilos para ocultar solo el contenido principal */
  #main-content {
    display: none;
  }
</style>

<body>
  <!--CARGA-->
  <div class="load">
    <hr />
    <hr />
    <hr />
    <hr />
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
      <a href="/Modelo/config.php" target="_blank"><i class="fas fa-cog"></i></a>
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

  <!--MENU HAMBURGUESA-->
  <div id="main-content">
    <div class="hamburger">
      <div class="_layer -top"></div>
      <div class="_layer -mid"></div>
      <div class="_layer -bottom"></div>
    </div>



    <!--INICIO CALCULADORA-->
    <div id="contenido1">
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
            <table id="tablaResultados" style="border-collapse: collapse;">
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
            <button class="btnpdf" id="pdf"><i class="fa-solid fa-file-export"><a class="linkpdf" href="../Vista/liquidar.php"  onclick="generarLiquidarPDF()" target="_blank">Exportar PDF</a></i></button>
            <button class="cerrar-modal" id="btn-close">Cerrar</button>
          </div>
        </div>
      </nav>
    </div>

  </div>

  <script src="../menu.js"></script>
  <script src="../JS/calcular.js"></script>
  <script src="../JS/modal.js"></script>
  <script src="../JS/liquidarpdf.js"></script>

  <script>
    // Espera 3 segundos y luego muestra el contenido principal
    setTimeout(function() {
      document.querySelector('.load').style.display = 'none'; // Oculta la animación de carga
      document.getElementById('main-content').style.display = 'block'; // Muestra el contenido principal
    }, 3000); // 3000 milisegundos = 3 segundos
  </script>
</body>

</html>