function calcularNomina() {
  // Obtener los valores del formulario
  const salarioMensual = parseFloat(document.getElementById('salarioMensual').value);
  const auxilioTransporte = parseFloat(document.getElementById('auxilioTransporte').value);
  const pagosExtras = parseFloat(document.getElementById('pagosExtras').value);
  const deducciones = parseFloat(document.getElementById('deducciones').value);
  const fechaInicio = new Date(document.getElementById('fechaInicio').value);
  const fechaFinal = new Date(document.getElementById('fechaFinal').value);

  // Calcular días trabajados
  const diasTrabajados = Math.ceil((fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24));

  // Calcular cesantías
  const cesantias = ((salarioMensual + auxilioTransporte) * diasTrabajados) / 360;

  // Calcular intereses sobre cesantías
  const interesesCesantias = (cesantias * diasTrabajados * 0.12) / 360;

  // Calcular prima de servicios
  const primaServicios = (salarioMensual * diasTrabajados) / 360;

  // Calcular vacaciones
  const vacaciones = (salarioMensual * diasTrabajados) / 720;

  // Calcular total a pagar antes de deducciones
  const totalAntesDeducciones = salarioMensual + auxilioTransporte + pagosExtras + cesantias + interesesCesantias + primaServicios + vacaciones;

  // Calcular total a pagar después de deducciones
  const salarioNeto = totalAntesDeducciones - deducciones;

  // Mostrar el resultado en el DOM
  document.getElementById('salarioNetoResult').innerText = "$ " + salarioNeto.toFixed(2);
}
