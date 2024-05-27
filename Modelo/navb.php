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
  <title>Dashboard</title>
</head>
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/calc.css">
<link rel="stylesheet" href="../CSS/calcDos.css">
<link rel="stylesheet" href="../CSS/resultados.css">
<link rel="stylesheet" href="../CSS2/estilosModal.css">
<link rel="stylesheet" href="../CSS2/modalDos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<body>
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
      <a href="#" target="_blank"><i class="fas fa-cog"></i></a>
      <a href="#" target="_blank"><i class="fa-solid fa-volume-off"></i></a>
      <a href="#" target="_blank"><i class="fa-regular fa-bell"></i></a>
      <div class="user-profile" id="myProfile">
      </div>
    </div>
  </div>
  <!--FIN NAVBAR-->

  <center> <?php if (!empty($user)) : ?>
      <br style=""><?= $user['email']; ?>
  </center>

  <!--INICIO CALCULADORA-->
  <div id="contenido1" style="display: none;">
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
          <table id="tablaResultados">
            <thead>
              <tr>
                <th>Cesantías</th>
                <th>Intereses sobre Cesantías</th>
                <th>Prima de Servicios</th>
                <th>Vacaciones</th>
                <th>Total a Pagar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="cesantiasTotalResult"></td>
                <td id="interesesCesantiasTotalResult"></td>
                <td id="primaServiciosTotalResult"></td>
                <td id="vacacionesTotalResult"></td>
                <td id="salarioTotalResult"></td>
              </tr>
            </tbody>
          </table>
          <button class="cerrar-modal" id="btn-close">Cerrar</button>
        </div>
      </div>
    </nav>
  </div>

  <!--CALCULADORA DOS-->

  <div id="contenido2" style="display: none;">
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
    <!--<div id="pdf"><a href="../Vista/comprobantepdf.php" onclick="generarPDF()" target="_blank">Descargar Comprobante</a></div>-->
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

      // Mostrar el resultado
      document.getElementById('resultado').innerHTML = `
       
        <p>Total a Pagar: $${salarioNetoFormateado}</p>
    `;
    }
  </script>

<script>
    function generarPDF() {
        // Recopilar datos del formulario
        const fechaInicio = document.getElementById('Inicio').value;
        const fechaFinal = document.getElementById('Final').value;
        const salarioMensual = parseFloat(document.getElementById('salario').value);
        const auxilioTransporte = parseFloat(document.getElementById('auxilio').value) || 0;
        const pagosExtras = parseFloat(document.getElementById('Extras').value) || 0;
        const otrasDeducciones = parseFloat(document.getElementById('Deducciones').value) || 0;

        // Realizar cálculos
        const diasTrabajados = Math.ceil((new Date(fechaFinal) - new Date(fechaInicio)) / (1000 * 60 * 60 * 24));
        const salarioBruto = salarioMensual + auxilioTransporte;
        const desDeducciones = salarioBruto * 0.08;
        const deducciones = salarioBruto - desDeducciones;
        const salarioNeto = ((salarioBruto + pagosExtras) - otrasDeducciones) / 2;

        // Construir el objeto con los datos a enviar al servidor
        const data = {
            fechaInicio: fechaInicio,
            fechaFinal: fechaFinal,
            salarioMensual: salarioMensual,
            auxilioTransporte: auxilioTransporte,
            pagosExtras: pagosExtras,
            otrasDeducciones: otrasDeducciones,
            salarioNeto: salarioNeto
        };

        // Enviar los datos al servidor para generar el PDF
        fetch('../Vista/comprobantepdf.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }
            return response.blob();
        })
        .then(blob => {
            // Crear un objeto URL para el blob
            const url = window.URL.createObjectURL(blob);

            // Crear un enlace para descargar el PDF
            const a = document.createElement('a');
            a.href = url;
            a.download = 'comprobante.pdf';
            document.body.appendChild(a);
            a.click();

            // Limpiar el objeto URL
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>







  <br>
  <br>
<?php else : ?>
<?php endif; ?>




<script src="../menu.js"></script>
<script src="../JS/calcular.js"></script>
<script src="../JS/nomina.js"></script>
<script src="../JS/modal.js"></script>
<script src="../JS/modalDos.js"></script>


</body>

</html>