function generarLiquidarPDF() {
    const resultadoTotal = document.getElementById('salarioTotalResult').innerText;
    const Dias = document.getElementById('diasresultado').innerText;
    const Vacaciones = document.getElementById('vacacionesTotalResult').innerText;
    const Prima = document.getElementById('primaServiciosTotalResult').innerText;
    const Interes = document.getElementById('interesesCesantiasTotalResult').innerText;
    const Cesantias = document.getElementById('cesantiasTotalResult').innerText;

    window.location.href = `../Vista/liquidar_pdf.php?resultadoTotal=${resultadoTotal}&Dias=${Dias}&Vacaciones=${Vacaciones}&Prima=${Prima }&Interes=${Interes}&Cesantias=${Cesantias}`;
}
