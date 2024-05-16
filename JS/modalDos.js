function manejarModalDos() {
    const open = document.getElementById('openDos');
    const resultados = document.getElementById('resultadoDos');
    const close = document.getElementById('btn-cerrar');

    open.addEventListener('click', () => {
        resultados.classList.add('show-Dos');
    });

    close.addEventListener('click', () => {
        resultados.classList.remove('show-Dos');
    });
}

manejarModalDos(); // Llamada a la función para inicializar los eventos