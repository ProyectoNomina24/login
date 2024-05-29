function cargarMenu() {
    // Código para cargar el menú
    var menu = `
        <div class="sidebar">
        <div class="menu">
        <div class="logo">
            <img src="../imagenes/moneda.png" alt="Logo">
        </div>
            
                <li>
                    <a class="links" href="#" onclick="mostrarContenido('contenido1')">
                    <i class="fas fa-sack-dollar"></i>
                    <span>Liquidar</span>
                    </a>
                    
                </li>
                <li>
                <a href="#">
                        <i class="fa-solid fa-gamepad"></i>
                        <span>Torre de control</span>
                    </a>
                </li>
                <li>
                <a class="links" href="#" onclick="mostrarContenido('contenido2')">
                    <i class="fa-solid fa-money-bill-wave"></i>
                        <span>Calcular</span>
                    </a>
                </li>
                <li>
                <a class="links" href="#" onclick="mostrarContenido('contenido4')">
                        <i class="fa-regular fa-folder-open"></i>
                        <span>Historial</span>
                    </a>
                </li>
                <li>
                <a class="links" href="#" onclick="mostrarContenido('contenido3')">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Personas</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>
                        <span>Configuracion</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="../Vista/salir.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesion</span>
                    </a>
                    <?php else : ?>
                    <?php endif; ?>
                </li>
            </div>
        </div>
    `;
    
    document.body.innerHTML += menu;
}

// Llamada a la función cargarMenu al cargar la página
window.onload = cargarMenu;

//Codigo para desplegar un modal al darle click a la imagen de perfil
document.addEventListener("DOMContentLoaded", function() {
    var profile = document.getElementById("myProfile");
    var modal = document.getElementById("myModal");
    var modalImage = document.getElementById("modalImage");
    var closeButton = document.getElementsByClassName("close")[0];

    profile.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeButton.addEventListener("click", function() {
        modal.style.display = "none";
    });
});

  



