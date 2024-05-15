
  function calcularMiNomina() {
      // Obtener los valores del formulario
      const fechaInicio = new Date(document.getElementById('Inicio').value);
      const fechaFinal = new Date(document.getElementById('Final').value);
      const salarioMensual = parseFloat(document.getElementById('salario').value);
      const auxilioTransporte = parseFloat(document.getElementById('auxilio').value);
      const pagosExtras = parseFloat(document.getElementById('Extras').value);
      const otrasDeducciones = parseFloat(document.getElementById('Deducciones').value);

      // Calcular los días trabajados
      const diasTrabajados = Math.ceil((fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24));

      console.log("Días trabajados:", diasTrabajados);

      // Calcular el salario bruto
      const valorHora = 43333; // Valor por hora (por ejemplo)
      const salarioBruto = salarioMensual + auxilioTransporte;

      console.log("Salario bruto:", salarioBruto);

      // Calcular las deducciones
      const desDeducciones = (salarioBruto * 0.08);
      const deducciones = salarioBruto - desDeducciones;

      console.log("Deducciones:", deducciones);

      // Calcular el salario neto
      const salarioNeto = ((salarioBruto + pagosExtras) - otrasDeducciones) / 2;

      console.log("Salario neto antes de redondeo:", salarioNeto);

      // Mostrar el resultado
      document.getElementById('salarioNeto').innerText = "Total a Pagar: $" + salarioNeto.toFixed(2);
      console.log("Salario neto después de redondeo:", salarioNeto.toFixed(2));
  }


