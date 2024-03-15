// Obtiene el elemento HTML con ID "timer" para mostrar el temporizador
const displayTimer = document.getElementById("timer");

// Almacena el identificador del intervalo de tiempo para el temporizador
let timerInterval;

// Almacena los segundos, minutos y horas del temporizador, inicializados en 0
let seconds = 0;
let minutes = 0;
let hours = 0;

// Función para iniciar el temporizador
function startTimer() {
    // Llama a la función updateTimer cada 1000 milisegundos (1 segundo)
    timerInterval = setInterval(updateTimer, 1000);
}

// Función para pausar el temporizador
function pauseTimer() {
    // Detiene el intervalo de tiempo del temporizador
    clearInterval(timerInterval);
}

// Función para reiniciar el temporizador
function resetTimer() {
    // Detiene el intervalo de tiempo del temporizador
    clearInterval(timerInterval);
    // Reinicia los segundos, minutos y horas a 0
    seconds = 0;
    minutes = 0;
    hours = 0;
    // Actualiza el contenido del elemento HTML para mostrar el tiempo reiniciado
    updateDisplay();
}

// Función para actualizar el temporizador
function updateTimer() {
    // Incrementa los segundos, minutos y horas según sea necesario
    incrementTime();
    // Actualiza el contenido del elemento HTML para mostrar el tiempo actualizado
    updateDisplay();
}

// Función para incrementar los segundos, minutos y horas del temporizador
function incrementTime() {
    seconds++;
    if (seconds === 60) {
        seconds = 0;
        minutes++;
    }
    if (minutes === 60) {
        minutes = 0;
        hours++;
    }
}

// Función para actualizar el contenido del elemento HTML con el tiempo formateado
function updateDisplay() {
    // Utiliza plantillas de cadenas para formatear el tiempo como HH:MM:SS
    displayTimer.textContent = `${formatTime(hours)}:${formatTime(minutes)}:${formatTime(seconds)}`;
}

// Función para formatear el tiempo (segundos, minutos u horas) como dos dígitos
function formatTime(time) {
    return time < 10 ? `0${time}` : time;
}