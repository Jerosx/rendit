// Declaración de variables
let timerInterval; // Almacena el identificador del intervalo de tiempo para el temporizador
let seconds = 0; // Almacena los segundos del temporizador, inicializado en 0
let minutes = 0; // Almacena los minutos del temporizador, inicializado en 0
let hours = 0; // Almacena las horas del temporizador, inicializado en 0
let displayTimer = document.getElementById("timer"); // Obtiene el elemento HTML con ID "timer" para mostrar el temporizador

// Función para iniciar el temporizador
function startTimer() {
    timerInterval = setInterval(updateTimer, 1000); // Llama a la función updateTimer cada 1000 milisegundos (1 segundo)
}

// Función para pausar el temporizador
function pauseTimer() {
    clearInterval(timerInterval); // Detiene el intervalo de tiempo del temporizador
}

// Función para reiniciar el temporizador
function resetTimer() {
    clearInterval(timerInterval); // Detiene el intervalo de tiempo del temporizador
    seconds = 0; // Reinicia los segundos a 0
    minutes = 0; // Reinicia los minutos a 0
    hours = 0; // Reinicia las horas a 0
    displayTimer.textContent = formatTime(hours) + ":" + formatTime(minutes) + ":" + formatTime(seconds); // Actualiza el contenido del elemento HTML para mostrar el tiempo reiniciado
}

// Función para actualizar el temporizador
function updateTimer() {
    seconds++; // Incrementa los segundos
    if (seconds === 60) { // Si los segundos llegan a 60
        seconds = 0; // Reinicia los segundos a 0
        minutes++; // Incrementa los minutos
    }
    if (minutes === 60) { // Si los minutos llegan a 60
        minutes = 0; // Reinicia los minutos a 0
        hours++; // Incrementa las horas
    }
    // Actualiza el contenido del elemento HTML para mostrar el tiempo actualizado en formato HH:MM:SS
    displayTimer.textContent = formatTime(hours) + ":" + formatTime(minutes) + ":" + formatTime(seconds);
}

// Función para formatear el tiempo (segundos, minutos o horas) como dos dígitos (agregando un cero al principio si es necesario)
function formatTime(time) {
    return time < 10 ? "0" + time : time;
}

