function calcularNomina2() {
    const fechaInicio = new Date(document.getElementById('fechaInicio').value);
    const fechaFinal = new Date(document.getElementById('fechaFinal').value);
    const auxilioTransporte = parseFloat(document.getElementById('auxilioTransporte').value);
    const salarioMensual = parseFloat(document.getElementById('salarioMensual').value);
  
    // Verificar si las fechas son válidas
    if (isNaN(fechaInicio.getTime()) || isNaN(fechaFinal.getTime())) {
      document.getElementById('resultado2').innerText = 'Por favor, introduce fechas válidas.';
      return;
    }
  
    // Calcular días trabajados
    const diasTrabajados = (fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24);
  
    // Calcular salario (incluyendo auxilio de transporte si aplica)
    let salarioTotal = diasTrabajados * (salarioMensual / 30);
    if (auxilioTransporte && auxilioTransporte > 0) {
      salarioTotal += auxilioTransporte;
    }
  
    document.getElementById('resultado2').innerText = `El salario total es: $${salarioTotal.toFixed(2)}`;
  }
