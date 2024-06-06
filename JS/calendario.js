// Obtiene el elemento del mes y año
var monthYearElement = document.getElementById('month-year');

// Array con los nombres de los meses
var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

// Obtiene la fecha actual
var currentDate = new Date();

// Obtiene el mes actual (0 para enero, 1 para febrero, etc.)
var currentMonth = currentDate.getMonth();

// Obtiene el año actual
var currentYear = currentDate.getFullYear();

// Actualiza el contenido del elemento con el mes y año actual
monthYearElement.textContent = months[currentMonth] + ' ' + currentYear;

// Obtiene el primer día del mes
var firstDayOfMonth = new Date(currentYear, currentMonth, 1);

// Obtiene el día de la semana del primer día del mes (0 para domingo, 1 para lunes, etc.)
var firstDayOfWeek = firstDayOfMonth.getDay();

// Obtiene el número de días en el mes
var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

// Genera dinámicamente los días del mes en el calendario
var calendarBodyElement = document.getElementById('calendar-body');
var dayCounter = 1;

for (var i = 0; i < 6; i++) {
    var row = calendarBodyElement.insertRow();
    
    for (var j = 0; j < 7; j++) {
        if (i === 0 && j < firstDayOfWeek) {
            // Celda vacía para los días anteriores al primer día del mes
            var cell = row.insertCell();
            cell.textContent = '';
        } else if (dayCounter > daysInMonth) {
            // Celda vacía para los días después del último día del mes
            var cell = row.insertCell();
            cell.textContent = '';
        } else {
            // Celda con el número del día del mes
            var cell = row.insertCell();
            cell.textContent = dayCounter;
            dayCounter++;
            
            // Agrega la clase 'today' si el día coincide con el día actual
            if (dayCounter - 1 === currentDate.getDate()) {
                cell.classList.add('today');
            }
        }
    }
}
