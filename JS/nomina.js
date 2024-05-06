function mostrarContenido(idContenido) {
    // Ocultar todos los contenidos
    var contenidos = document.querySelectorAll('div[id^="contenido"]');
    contenidos.forEach(function(contenido) {
      contenido.style.display = 'none';
    });
  
    // Mostrar el contenido específico
    var contenidoMostrar = document.getElementById(idContenido);
    if (contenidoMostrar) {
      contenidoMostrar.style.display = 'block';
    }
  }