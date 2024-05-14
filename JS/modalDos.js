function manejarModalDos() {
    const open = document.getElementById('openModalDos');
    const resultados = document.getElementById('resultadosDos');
    const close = document.getElementById('btn-cerrar');

    openModalDos.addEventListener('click', () => {
        resultados.classList.add('show-Dos');
    });

    close.addEventListener('click', () => {
        resultados.classList.remove('show-Dos');
    });
}

manejarModalDos(); // Llamada a la función para inicializar los eventos