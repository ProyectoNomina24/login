function manejarModal() {
    const open = document.getElementById('open');
    const resultados = document.getElementById('resultados');
    const close = document.getElementById('btn-close');

    open.addEventListener('click', () => {
        resultados.classList.add('show');
    });

    close.addEventListener('click', () => {
        resultados.classList.remove('show');
    });
}

manejarModal(); // Llamada a la función para inicializar los eventos
