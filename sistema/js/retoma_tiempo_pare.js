
//-------------------------------INICIO DE RECIBIMIENTO DATA JSON---------------------- 

fetch('../sistema/Envio_HoraInicio.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error:', data.error);
        } else {
            console.log('Hora de inicio del pare:', data.HoraInicioPare);
            console.log('Hora de fin del pare:', data.HoraFinPare);
            // Llama a la función para iniciar el cronómetro
            startTimer(data.HoraInicioPare);
        }
    })
    .catch(error => console.error('Error al obtener los datos:', error));

//-------------------------------FIN DE RECIBIMIENTO DATA JSON----------------------    

//-------------------------------INICIO CRONOMETRO EN BASE AL TIEMPO DE PARE----------------------  

// Función para formatear el tiempo en minutos y segundos
function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
}

// Función para iniciar el cronómetro
function startTimer(horaInicioPare) {
    // Convertir HoraInicioPare a un objeto Date
    const [hours, minutes, seconds] = horaInicioPare.split(':').map(Number);
    const start = new Date();
    start.setHours(hours, minutes, seconds, 0); // Configura la hora de inicio

    console.log('Fecha y hora de inicio:', start);

    // Función para actualizar el cronómetro
    function updateTimer() {
        const now = new Date(); // Hora actual
        const elapsedSeconds = Math.floor((now - start) / 1000); // Tiempo transcurrido en segundos
        document.getElementById('timer').textContent = formatTime(elapsedSeconds);
    }

    // Actualizar el cronómetro cada segundo
    setInterval(updateTimer, 1000);
}

// Iniciar el cronómetro cuando se cargue la página
window.onload = function() {
    fetch('../sistema/Envio_HoraInicio.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
            } else {
                console.log('Hora de inicio del pare:', data.HoraInicioPare);
                console.log('Hora de fin del pare:', data.HoraFinPare);
                // Llama a la función para iniciar el cronómetro
                startTimer(data.HoraInicioPare);
            }
        })
        .catch(error => console.error('Error al obtener los datos:', error));
};

//-------------------------------FIN CRONOMETRO EN BASE AL TIEMPO DE PARE----------------------  
