const btnAbrirModalTerminar =
document.querySelector("#btn-modal-terminar");

const btnCerrarModalTerminar =
document.querySelector("#btn-cerrar-modal-terminar");

const modalTerminar=
document.querySelector("#modal-terminar")

btnAbrirModalTerminar.addEventListener("click",()=>{
    modalTerminar.showModal();

})


btnCerrarModalTerminar.addEventListener("click",()=>{
    modalTerminar.close();


})