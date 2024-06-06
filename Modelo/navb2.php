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
  <title>Calcular</title>
</head>
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/calc.css">
<link rel="stylesheet" href="../CSS/calcDos.css">
<link rel="stylesheet" href="../CSS/resultados.css">
<link rel="stylesheet" href="../CSS2/estilosModal.css">
<link rel="stylesheet" href="../CSS2/modalDos.css">
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


    <!--CALCULADORA DOS-->

    <div id="contenido2">
      <nav class="calcDos">
        <div id="formulario">
          <i class="calkDos fa-solid fa-money-bill-wave"></i>
          <span>Calcular</span>
          <form id="formularioDos">
            <label for="Inicio">Fecha de Inicio:</label>
            <input type="date" id="Inicio" name="Inicio" required>

            <label for="Final">Fecha Final:</label>
            <input type="date" id="Final" name="Final" required>

            <label for="salario">Salario Mensual:</label>
            <input type="number" id="salario" name="salario" placeholder="Ingrese el salario mensual" required>

            <label for="auxilio">Auxilio de Transporte:</label>
            <input type="number" id="auxilio" name="auxilio" placeholder="Ingrese el auxilio de transporte">

            <label for="Extras">Pagos Extras:</label>
            <input type="number" id="Extras" name="Extras" placeholder="Ingrese los pagos extras">

            <label for="Deducciones">Otras Deducciones:</label>
            <input type="number" id="Deducciones" name="Deducciones" placeholder="Ingrese sus otras deducciones">

            <button class="btn-liquidar" id="openDos" type="button" onclick="calcularMiNomina(); manejarModalDos();">Calcular Nómina</button>
          </form>
          <div class="modalDos-container" id="resultadoDos">
            <div class="modalDos">
              <div id="resultado"></div>

              <button class="btnpdf2" id="pdf"><i class="fa-solid fa-file-export"><a class="linkpdf" href="../Vista/generar_pdf.php"  onclick="generarPDF()" target="_blank">Exportar PDF</a></i></button>
              <button class="cerrar-modalDos" id="btn-cerrar">Cerrar</button>
            </div>
          </div>
        </div>
      </nav>

    </div>

    <script>
      function calcularMiNomina() {

        const fechaInicio = new Date(document.getElementById('Inicio').value);
        const fechaFinal = new Date(document.getElementById('Final').value);
        const salarioMensual = parseFloat(document.getElementById('salario').value);
        const auxilioTransporte = parseFloat(document.getElementById('auxilio').value) || 0;
        const pagosExtras = parseFloat(document.getElementById('Extras').value) || 0;
        const otrasDeducciones = parseFloat(document.getElementById('Deducciones').value) || 0;

        // Calcular los días trabajados
        const diasTrabajados = Math.ceil((fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24));

        // Calcular el salario bruto
        const salarioBruto = salarioMensual + auxilioTransporte;

        // Calcular las deducciones
        const desDeducciones = (salarioBruto * 0.08);
        const deducciones = salarioBruto - desDeducciones;

        // Calcular el salario neto
        const salarioNeto = ((salarioBruto + pagosExtras) - otrasDeducciones) / 2;

        // Formatear el salario neto con separadores de decenas de mil
        const salarioNetoFormateado = salarioNeto.toLocaleString();
        console.log(salarioNetoFormateado);

        // Mostrar el resultado

        document.getElementById('resultado').innerHTML = `
       
        <p style="color: black;">Total a Pagar: $${salarioNetoFormateado}</p>
        
    `;
      }
    </script>



    <script>
      function generarPDF() {
        // Obtener el total a pagar
        const totalAPagar = document.getElementById('resultado').innerText.split(': ')[1];
        const Salario = document.getElementById('salario').value;
        const Auxiliot = document.getElementById('auxilio').value;
        const Extra = document.getElementById('Extras').value;
        const Deduccion = document.getElementById('Deducciones').value;


        // Redirigir al archivo PHP con el total y el nombre de usuario como parámetros GET
        window.location.href = `../Vista/generar_pdf.php?totalAPagar=${totalAPagar}&Salario=${Salario}&Auxiliot=${Auxiliot}&Extra=${Extra}&Deduccion=${Deduccion}`;
      }
    </script>

  </div>

  <script src="../menu.js"></script>
  <script src="../JS/calcular.js"></script>
  <script src="../JS/modalDos.js"></script>

  <script>
    // Espera 3 segundos y luego muestra el contenido principal
    setTimeout(function() {
      document.querySelector('.load').style.display = 'none'; // Oculta la animación de carga
      document.getElementById('main-content').style.display = 'block'; // Muestra el contenido principal
    }, 1000); //segundos
  </script>
</body>

</html>