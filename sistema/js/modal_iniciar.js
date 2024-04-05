const btnAbrirModal =
document.querySelector("#btn-modal-iniciar");

const btnCerrarModal =
document.querySelector("#btn-cerrar-modal-iniciar");

const modalInicio=
document.querySelector("#modal-iniciar")

btnAbrirModal.addEventListener("click",()=>{
    modalInicio.showModal();

})


btnCerrarModal.addEventListener("click",()=>{
    modalInicio.close();


})