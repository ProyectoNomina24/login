function mostrarContenido(idContenido) {
  // Definir un array con los IDs de los contenidos
  var idsContenidos = ['contenido1', 'contenido2', 'contenido3', 'contenido4', 'contenido5'];

  // Ocultar todos los contenidos
  idsContenidos.forEach(function(id) {
      var contenido = document.getElementById(id);
      if (contenido) {
          contenido.style.display = 'none';
      }
  });

  // Mostrar el contenido específico
  var contenidoMostrar = document.getElementById(idContenido);
  if (contenidoMostrar) {
      contenidoMostrar.style.display = 'block';
  }
}
