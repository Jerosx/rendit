const btnAbrirModalParar =
document.querySelector("#btn-modal-parar");

const btnCerrarModalParar =
document.querySelector("#btn-cerrar-modal-parar");

const modalParar=
document.querySelector("#modal-parar")

btnAbrirModalParar.addEventListener("click",()=>{
    modalParar.showModal();

})


btnCerrarModalParar.addEventListener("click",()=>{
    modalParar.close();


})