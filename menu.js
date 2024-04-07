function cargarMenu() {
    // Código para cargar el menú
    var menu = `
        <div class="sidebar">
        <div class="menu">
        <div class="logo">
            <img src="./imagenes/moneda.png" alt="Logo">
        </div>
            
                <li>
                    <a href="#">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <span>Calcular</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-gamepad"></i>
                        <span>Torre de control</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-sack-dollar"></i>
                        <span>Liquidar</span>
                    </a>
                </li>
                <li>
                    <a href="#">
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
                        <span>Configuracion</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesion</span>
                    </a>
                </li>
            </div>
        </div>
    `;
    
    document.body.innerHTML += menu;
}

// Llamada a la función cargarMenu al cargar la página
window.onload = cargarMenu;



