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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
</head>
<link rel="stylesheet" href="../CSS2/load.css">
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/pers.css">
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/btnMenu.css">
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
        <!--Inicio Body seccion-->
        <div class="main">
            <div class="header--wrapper">
                <div class="header--title">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Personas</span>
                    <h2>My Nómina</h2>
                </div>
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Buscar" />
                </div>
            </div>
            <!--Fin Body seccion-->
            <!-- tarjetas-->
            <div class="card-container">
                <h3 class="main--title">Empleados</h3>
                <div class="card--wrapper">

                    <div class="payment--card light-red">
                        <div class="car--header">
                            <div class="amount">
                                <span class="title">
                                    Edward Muñoz
                                </span><span class="amount--value">Pago Pendiente</span>
                            </div>
                            <i class="fa-regular icon fa-user dark-blue"></i>
                        </div>
                        <span class="card-detail">1.039.705.345</span>
                    </div>

                    <div class="payment--card light-purple">
                        <div class="car--header">
                            <div class="amount">
                                <span class="title">
                                    Anderson Alzate
                                </span><span class="amount--value">Pago Pendiente</span>
                            </div>
                            <i class="fa-regular icon fa-user dark-blue"></i>
                        </div>
                        <span class="card-detail">1.039.708.845</span>
                    </div>

                    <div class="payment--card light-green">
                        <div class="car--header">
                            <div class="amount">
                                <span class="title">
                                    Gustavo Vanegas
                                </span><span class="amount--value">Pago Realizado</span>
                            </div>
                            <i class="fa-regular icon fa-user dark-blue"></i>
                        </div>
                        <span class="card-detail">1.039.856.468</span>
                    </div>

                    <div class="payment--card light-blue">
                        <div class="car--header">
                            <div class="amount">
                                <span class="title">
                                    My Nómina
                                </span><span class="amount--value">Editar Usuario</span>
                            </div>
                            <i class="fa-regular icon fa-pen-to-square dark-red"></i>
                        </div>
                        <span class="card-detail">**** *** ***</span>
                    </div>
                    <div class="payment--card light-green">
                        <div class="car--header">
                            <div class="amount">
                                <span class="title">
                                    My Nómina
                                </span><span class="amount--value">Crear Usuario</span>
                            </div>
                            <i class="fa-solid icon fa-plus dark-green"></i>
                        </div>
                        <span class="card-detail">**** *** ***</span>
                    </div>
                </div>
                <!--BOTON MENU -->
                <nav class="menuBtn">
                    <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
                    <label class="menu-open-button" for="menu-open">
                        <span class="lines line-1"></span>
                        <span class="lines line-2"></span>
                        <span class="lines line-3"></span>
                    </label>

                    <a href="#" class="menu-item blue"> <i class="option fa fa-anchor"></i> </a>
                    <a href="#" class="menu-item green"> <i class="option fa fa-coffee"></i> </a>
                    <a href="#" class="menu-item red"> <i class="option  fa fa-heart"></i> </a>
                    <a href="#" class="menu-item purple"> <i class="option  fa fa-microphone"></i> </a>
                    <a href="#" class="menu-item orange"> <i class="option  fa fa-star"></i> </a>
                    <a href="#" class="menu-item lightblue"> <i class="option  fa fa-diamond"></i> </a>
                </nav>
            </div>
            <!--fin tarjetas-->
            <br>
            <br>
        </div>


        <script>
            // Espera 3 segundos y luego muestra el contenido principal
            setTimeout(function() {
                document.querySelector('.load').style.display = 'none'; // Oculta la animación de carga
                document.getElementById('main-content').style.display = 'block'; // Muestra el contenido principal
            }, 1000); // segundos
        </script>
        <script src="/menu.js"></script>
</body>

</html>