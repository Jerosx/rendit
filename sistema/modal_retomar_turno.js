const btnAbrirModalRetomar =
document.querySelector("#btn-modal-retomar");

const btnCerrarModalRetomar =
document.querySelector("#btn-cerrar-modal-retomar");

const modalRetomar=
document.querySelector("#modal-retomar")

btnAbrirModalRetomar.addEventListener("click",()=>{
    modalRetomar.showModal();

})


btnCerrarModalRetomar.addEventListener("click",()=>{
    modalRetomar.close();


})