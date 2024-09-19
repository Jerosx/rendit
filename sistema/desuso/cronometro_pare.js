// Esta función se ejecuta cuando se carga la página
window.onload = function() {
    var timerDisplay = document.getElementById('timer'); // Se obtiene el elemento con el ID "timer"
    var startTime;

    // Esta función inicia el cronómetro
    function startTimer() {
        startTime = Date.now(); // Se obtiene el tiempo actual
        updateTimer(); // Se llama a la función para actualizar el cronómetro
    }

    // Esta función actualiza el cronómetro
    function updateTimer() {
        var elapsedTime = Date.now() - startTime; // Se calcula el tiempo transcurrido

        var minutes = Math.floor(elapsedTime / 60000); // Se calculan los minutos
        var seconds = Math.floor((elapsedTime % 60000) / 1000); // Se calculan los segundos

        // Formato MM/SS
        var timeString = formatTwoDigits(minutes) + ':' + formatTwoDigits(seconds);

        timerDisplay.textContent = timeString; // Se actualiza el contenido del elemento con el tiempo transcurrido

        // Esta línea programa la ejecución de la función updateTimer para que se llame a sí misma cada segundo.
        requestAnimationFrame(updateTimer);
    }

    // Se llama a la función startTimer para iniciar el cronómetro
    startTimer();
};

// Esta función formatea los dígitos a dos cifras agregando un cero delante si es necesario
function formatTwoDigits(number) {
    return (number < 10 ? '0' : '') + number;
}

