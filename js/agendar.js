const openPerfil = document.querySelector("[data-openPerfil]");
const closePerfil = document.querySelector("[data-btnClosePerfil]");
const modal = document.querySelector("[data-modal-perfil]");

openPerfil.addEventListener("click", () => {
  modal.showModal();
});
closePerfil.addEventListener("click", () => {
  modal.close();
});

// show cadastrar novo veiculos

const showNewVehicle = document.querySelector("[data-showNewVehicle]");
const formNewVehicle = document.querySelector("[data-newVehicle]");
const vehicleContainer = document.querySelector("[data-vehicleContainer]");

showNewVehicle.addEventListener("click", () => {
  formNewVehicle.classList.toggle("hide");
  formNewVehicle.classList.toggle("show");
  vehicleContainer.classList.toggle("muilt-container-open");

  if (!formNewVehicle.classList.contains("hide")) {
    showNewVehicle.textContent = "FECHAR";
    showNewVehicle.classList.remove("btn-dark");
    showNewVehicle.classList.add("btn-danger");
  } else {
    showNewVehicle.textContent = "CADASTAR";
    showNewVehicle.classList.remove("btn-danger");
    showNewVehicle.classList.add("btn-dark");
  }
});

