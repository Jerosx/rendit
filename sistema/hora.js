//INICIO CREACIÓN DE FUNCIÓN PARA LA HORA Y QUE SE ACTUALICE EN VIVO

function actualizarHora() { // Esta línea define una función llamada actualizarHora

    var fecha = new Date(); // Esta línea crea un nuevo objeto Date, que representa la fecha y la hora actuales.
    
    var hora = fecha.getHours(); // Estas líneas obtienen la hora, los minutos y los segundos de la fecha actual.
    var minutos = fecha.getMinutes();
    var segundos = fecha.getSeconds();
    
    var ampm = hora >= 12 ? 'PM' : 'AM'; // Esta línea determina si la hora es mayor o igual a 12 para decidir si es AM o PM.
    
    hora = hora % 12; // Estas líneas convierten la hora al formato de 12 horas.
    hora = hora ? hora : 12; // Si hora es 0, entonces es 12
    
    hora = hora < 10 ? "0" + hora : hora; // Estas líneas agregan un cero delante de los minutos y segundos si son menores que 10.
    minutos = minutos < 10 ? "0" + minutos : minutos;
    segundos = segundos < 10 ? "0" + segundos : segundos;
    
    var horaActual = hora + ":" + minutos + ":" + segundos + " " + ampm;  // Esta línea construye una cadena con la hora, los minutos, los segundos y AM/PM.
    
    document.getElementById("hora").innerHTML = horaActual;  // Esta línea actualiza el contenido del elemento con el ID "hora" en el HTML con la hora actual.
    
    setTimeout(actualizarHora, 1000);  // Esta línea programa la ejecución de la función actualizarHora cada segundo.
}

//FIN CREACIÓN DE FUNCIÓN PARA LA HORA Y QUE SE ACTUALICE EN VIVO