<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calculadora de Nómina</title>
</head>
<body>

<h1>Calculadora de Nómina</h1>

<form id="salaryForm">
  <label for="hoursWorked">Horas Trabajadas:</label>
  <input type="number" id="hoursWorked" name="hoursWorked" required><br><br>
  
  <label for="hourlyRate">Tarifa por Hora:</label>
  <input type="number" id="hourlyRate" name="hourlyRate" required><br><br>
  
  <button type="submit">Calcular Nómina</button>
</form>

<div id="result"></div>

<script>
document.getElementById('salaryForm').addEventListener('submit', function(event) {
  event.preventDefault();
  
  // Obtener los valores de las entradas
  const hoursWorked = parseFloat(document.getElementById('hoursWorked').value);
  const hourlyRate = parseFloat(document.getElementById('hourlyRate').value);
  
  // Calcular el salario total
  const totalSalary = hoursWorked * hourlyRate;
  
  // Mostrar el resultado
  document.getElementById('result').innerHTML = `El salario total es: $${totalSalary.toFixed(2)}`;
});
</script>

</body>
</html>
