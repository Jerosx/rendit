// INICIO CREACIÓN DE FUNCIÓN PARA LA HORA Y QUE SE ACTUALICE EN VIVO

// Esta función se encarga de actualizar la hora en tiempo real en la página
function actualizarHora() {
    var fecha = new Date(); // Se crea un nuevo objeto Date que representa la fecha y hora actuales
    var hora = fecha.getHours(); // Se obtiene la hora actual
    var minutos = fecha.getMinutes(); // Se obtienen los minutos actuales
    var segundos = fecha.getSeconds(); // Se obtienen los segundos actuales
    var ampm = hora >= 12 ? 'PM' : 'AM'; // Se determina si es AM o PM
    hora = hora % 12; // Se convierte la hora al formato de 12 horas
    hora = hora ? hora : 12; // Si la hora es 0, se establece como 12
    hora = hora < 10 ? "0" + hora : hora; // Se agrega un 0 delante de la hora si es menor que 10
    minutos = minutos < 10 ? "0" + minutos : minutos; // Se agrega un 0 delante de los minutos si son menores que 10
    segundos = segundos < 10 ? "0" + segundos : segundos; // Se agrega un 0 delante de los segundos si son menores que 10
    var horaActual = hora + ":" + minutos + ":" + segundos + " " + ampm; // Se construye la cadena de la hora actual
    document.getElementById("hora").innerHTML = horaActual; // Se actualiza el contenido del elemento con el ID "hora" en la página HTML con la hora actual
}

// Esta línea programa la ejecución de la función actualizarHora cada segundo.
setInterval(actualizarHora, 1000);

// FIN CREACIÓN DE FUNCIÓN PARA LA HORA Y QUE SE ACTUALICE EN VIVO
