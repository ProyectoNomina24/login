


function calcularNomina() {





    const fechaInicio = new Date(document.getElementById('fechaInicio').value);
    const fechaFinal = new Date(document.getElementById('fechaFinal').value);
    const auxilioTransporte = parseFloat(document.getElementById('auxilioTransporte').value);
    const pagosExtras = parseFloat(document.getElementById('pagosExtras').value);
    const salarioMensual = parseFloat(document.getElementById('salarioMensual').value);
  
  
    if (isNaN(fechaInicio.getTime()) || isNaN(fechaFinal.getTime())) {
        document.getElementById('salarioTotalResult').innerText = 'Por favor, introduce fechas válidas.';
        return;
    }
  
    const diasTrabajados = (fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24);
    const cesantias = ((salarioMensual + auxilioTransporte) * diasTrabajados) / 360;
    const interesesCesantias = (cesantias * diasTrabajados * 0.12) / 360;
    const primaServicios = (salarioMensual * diasTrabajados) / 360;
    const vacaciones = (salarioMensual * diasTrabajados) / 720;
    const salarioTotalGlobal = cesantias + interesesCesantias + primaServicios + vacaciones + pagosExtras;
  
  document.getElementById("cesantiasTotalResult").innerText = "$ " + cesantias.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  document.getElementById("interesesCesantiasTotalResult").innerText = "$ " + interesesCesantias.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  document.getElementById("primaServiciosTotalResult").innerText = "$ " + primaServicios.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  document.getElementById("vacacionesTotalResult").innerText = "$ " + vacaciones.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  document.getElementById("salarioTotalResult").innerText = "$ " + salarioTotalGlobal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  
  
  
  }
  