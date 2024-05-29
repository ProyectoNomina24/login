// Función para cargar el menú lateral dinámicamente
function cargarMenu() {
    // Código para cargar el menú
    var menu = `
        <div class="sidebar">
            <ul class="menu">
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
                    <a href="www.google.com">
                        <i class="fa-regular fa-folder-open"></i>
                        <span>Historial</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Personas</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="../Vista/salir.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    `;

    // Insertar el menú en el cuerpo del documento
    document.body.insertAdjacentHTML('beforeend', menu);
}

// Función para alternar el menú lateral en dispositivos móviles
function toggleMenu(event) {
    // Alternar la clase 'is-active' en el botón de hamburguesa
    this.classList.toggle('is-active');
    // Alternar la clase 'is_active' en el menú lateral
    document.querySelector(".sidebar").classList.toggle("is_active");
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

// Llamar a la función cargarMenu al cargar la página
window.onload = cargarMenu;
