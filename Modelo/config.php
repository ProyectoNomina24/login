<?php
session_start();

// Incluye el archivo que contiene la lógica de conexión a la base de datos
require '../Controler/database.php';

// Verifica si existe una sesión activa para el usuario
if (isset($_SESSION['usuario_id'])) {
    // Verifica si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibe los datos del formulario
        $nuevo_email = $_POST['email'];
        $nueva_contraseña = $_POST['password'];

        // Prepara y ejecuta la consulta SQL para actualizar los datos del usuario
        $query = "UPDATE usuario SET email = :email, password = :password WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':email', $nuevo_email);
        $statement->bindParam(':password', $nueva_contraseña);
        $statement->bindParam(':id', $_SESSION['usuario_id']);

        if ($statement->execute()) {
            echo "¡Los datos del usuario se actualizaron correctamente!";
        } else {
            echo "Hubo un error al actualizar los datos del usuario.";
        }
    }

    // Prepara una consulta SQL para seleccionar información del usuario basado en su ID
    $records = $conn->prepare('SELECT identificacion, nombre, apellido, email FROM usuario WHERE id = :id');
    // Vincula el valor del ID de usuario almacenado en la sesión al marcador de posición :id en la consulta preparada
    $records->bindParam(':id', $_SESSION['usuario_id']);
    // Ejecuta la consulta preparada
    $records->execute();
    // Obtiene los resultados de la consulta y los almacena en un array asociativo
    $results = $records->fetch(PDO::FETCH_ASSOC);

    // Verifica si se encontraron resultados
    if ($results) {
        // Asigna los resultados a la variable $user
        $user = $results;
    }
} else {
    // Si no hay una sesión activa para el usuario, redirige a la página de inicio de sesión
    header("Location: login.php");
    // Detiene la ejecución del script
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
</head>
<link rel="stylesheet" href="../CSS2/load.css">
<link rel="stylesheet" href="/CSS2/config.css">
<link rel="stylesheet" href="../CSS2/style.css">
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

        <div class="main-container">
            <div class="left-container container">
                <div class="donut-chart-block block">
                    <h2 class="titular">Estadísticas de Audiencia por SO</h2>
                    <div class="donut-chart">

                        <div id="porcion1" class="recorte">
                            <div class="quesito ios" data-rel="21"></div>
                        </div>
                        <div id="porcion2" class="recorte">
                            <div class="quesito mac" data-rel="39"></div>
                        </div>
                        <div id="porcion3" class="recorte">
                            <div class="quesito win" data-rel="31"></div>
                        </div>
                        <div id="porcionFin" class="recorte">
                            <div class="quesito linux" data-rel="9"></div>
                        </div>

                        <p class="center-date">JUNIO<br><span class="scnd-font-color">2024</span></p>
                    </div>
                    <ul class="os-percentages horizontal-list">
                        <li>
                            <p class="ios os scnd-font-color">iOS</p>
                            <p class="os-percentage">21<sup>%</sup></p>
                        </li>
                        <li>
                            <p class="mac os scnd-font-color">Mac</p>
                            <p class="os-percentage">48<sup>%</sup></p>
                        </li>
                        <li>
                            <p class="linux os scnd-font-color">Linux</p>
                            <p class="os-percentage">9<sup>%</sup></p>
                        </li>
                        <li>
                            <p class="win os scnd-font-color">Win</p>
                            <p class="os-percentage">32<sup>%</sup></p>
                        </li>
                    </ul>
                </div>
                <div class="line-chart-block block clear">
                    <div class="line-chart">

                        <div class='grafico'>
                            <ul class='eje-y'>
                                <li data-ejeY='30'></li>
                                <li data-ejeY='20'></li>
                                <li data-ejeY='10'></li>
                                <li data-ejeY='0'></li>
                            </ul>
                            <ul class='eje-x'>
                                <li>Abril</li>
                                <li>Mayo</li>
                                <li>Junio</li>
                            </ul>
                            <span data-valor='25'>
                                <span data-valor='8'>
                                    <span data-valor='13'>
                                        <span data-valor='5'>
                                            <span data-valor='23'>
                                                <span data-valor='12'>
                                                    <span data-valor='15'>
                                                    </span></span></span></span></span></span></span>
                        </div>
                    </div>
                    <ul class="time-lenght horizontal-list">
                        <li><a class="time-lenght-btn" href="#14">Semana</a></li>
                        <li><a class="time-lenght-btn" href="#15">Mes</a></li>
                        <li><a class="time-lenght-btn" href="#16">Año</a></li>
                    </ul>
                    <ul class="month-data clear">
                        <li>
                            <p>Abril<span class="scnd-font-color"> 2024</span></p>
                            <p><span class="entypo-plus increment"> </span>21<sup>%</sup></p>
                        </li>
                        <li>
                            <p>Mayo<span class="scnd-font-color"> 2024</span></p>
                            <p><span class="entypo-plus increment"> </span>48<sup>%</sup></p>
                        </li>
                        <li>
                            <p>Junio<span class="scnd-font-color"> 2024</span></p>
                            <p><span class="entypo-plus increment"> </span>35<sup>%</sup></p>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- USUARIO -->
            <div class="middle-container container">
                <div class="profile block">
                    <br>
                    <div class="profile-picture big-profile-picture clear">
                        <img width="150px" alt="" src="/imagenes/user2.png">
                    </div>
                    <h1 class="user-name"><?php echo $user['nombre']; ?></h1>
                    <h1 class="user-name"><?php echo $user['apellido']; ?></h1>
                    <h1 class="user-name"><?php echo $user['identificacion']; ?></h1>
                    <div class="profile-description">
                        <p class="scnd-font-color"><?php echo $user['email']; ?></p>
                    </div>
                </div>
                <!--MENSAJES-->
                <div class="tweets block">
                    <h2 class="titular"><span class="icon zocial-twitter"></span>Respuestas pendientes</h2>
                    <div class="tweet first">
                        <p>Comer helado hoy? <a class="tweet-link" href="#17">@Quora</a></p>
                        <p><a class="time-ago scnd-font-color" href="#18">Hace 3 minutos..</a></p>
                    </div>
                    <div class="tweet">
                        <p>vamos al Cesde<a class="tweet-link" href="#19">#CreativeCloud</a></p>
                        <p><a class="scnd-font-color" href="#20">Hace 6 horas..</a></p>
                    </div>
                </div>
                <!-- REDES SOCIALES-->
                <ul class="social block">
                    <li><a href="#50">
                            <div class=" icon"><span class="fa-brands fa-square-facebook"></span></div>
                            <h2 class="facebook titular">COMPARTIR EN FACEBOOK</h2>
                    </li></a>
                    <li><a href="#51">
                            <div class="twitter icon"><span class="fa-brands fa-square-x-twitter"></span></div>
                            <h2 class="twitter titular">COMPARTIR EN TWITTER</h2>
                    </li></a>
                    <li><a href="#52">
                            <div class="googleplus icon"><span class="fa-brands fa-google-plus"></span></div>
                            <h2 class="googleplus titular">COMPARTIR EN GOOGLE+</h2>
                    </li></a>
                </ul>
            </div>

            <!-- RIGHT-CONTAINER -->
            <div class="right-container container">
                <!--EDITAR USUARIO-->
                <form class="account block" action="editar_usuario.php" method="post">
                    <h2 class="titular">EDITAR</h2>
                    <div class="input-container">
                        <input type="email" class="email text-input" placeholder="Email" id="email" name="email" required>
                    </div>
                    <div class="input-container">
                        <input type="password" placeholder="Password" class="password text-input" id="password" name="password" required>
                    </div>
                    <p class="scnd-font-color">Olvidaste la contraseña?</p>
                    <input class="sign-in button" type="submit" value="Actualizar" style="color: white;">
                </form>
                <!-- CALENDARIO DIA -->
                <div class="calendar-day block">
                    <div class="arrow-btn-container">
                        <a class="arrow-btn left" href="#200"><span class="icon fa-solid fa-arrow-left"></span></a>
                        <h2 class="titular" id="day-of-week"></h2>
                        <a class="arrow-btn right" href="#201"><span class="icon fa-solid fa-arrow-right"></span></a>
                    </div>
                    <p class="the-day" id="day-number"></p>
                    <a class="add-event button" href="#27">Añadir Evento</a>
                </div>
                <!-- CALENDARIO MES-->
                <div class="calendar-month block">
                    <div class="arrow-btn-container">
                        <a class="arrow-btn left" href="#202"><span class="icon fa-solid fa-arrow-left"></span></a>
                        <h2 class="titular" id="month-year"></h2>
                        <a class="arrow-btn right" href="#203"><span class="icon fa-solid fa-arrow-right"></span></a>
                    </div>
                    <table class="calendar">
                        <thead class="days-week">
                            <tr>
                                <th>D</th>
                                <th>L</th>
                                <th>M</th>
                                <th>M</th>
                                <th>J</th>
                                <th>V</th>
                                <th>S</th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body">
                            <!-- Los días del mes se generarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div> <!-- end right-container -->
        </div> <!-- end main-container -->
    </div>
    <script>
        // Espera 3 segundos y luego muestra el contenido principal
        setTimeout(function() {
            document.querySelector('.load').style.display = 'none'; // Oculta la animación de carga
            document.getElementById('main-content').style.display = 'block'; // Muestra el contenido principal
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>
    <script>
        // Obtiene el elemento del día de la semana y del número del día
        var dayOfWeekElement = document.getElementById('day-of-week');
        var dayNumberElement = document.getElementById('day-number');

        // Array con los nombres de los días de la semana
        var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Obtiene la fecha actual
        var currentDate = new Date();

        // Obtiene el día de la semana (0 para domingo, 1 para lunes, etc.)
        var dayOfWeek = currentDate.getDay();

        // Obtiene el número del día del mes
        var dayOfMonth = currentDate.getDate();

        // Actualiza el contenido de los elementos con el día de la semana y el número del día
        dayOfWeekElement.textContent = daysOfWeek[dayOfWeek];
        dayNumberElement.textContent = dayOfMonth;
    </script>
    <script src="../menu.js"></script>
    <script src="/JS/calendario.js"></script>
</body>

</html>