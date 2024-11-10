let idContainer;
let btnCancelId;
let btnModifyId; 
let btnSaveId; 
let idInputs; 

document.addEventListener("DOMContentLoaded", function () {
  getIdSectionElements();
  addIdSectionListeners();
});

function getIdSectionElements(){
  idContainer = document.getElementById('identification-section');
  btnCancelId = document.getElementById("btnCancelId");
  btnSaveId = document.getElementById("btnSaveId");
  btnModifyId = document.getElementById("btnModifyId");
  idInputs = idContainer.getElementsByClassName("form-control");
}
function addIdSectionListeners(){
  btnModifyId.addEventListener('click', enableIdSectionEdit);
}

function enableIdSectionEdit(){
  btnCancelId.classList.remove("d-none");
  btnSaveId.classList.remove("d-none");
  btnModifyId.classList.add("d-none");
  for (let index = 0; index < idInputs.length; index++) {
    idInputs[index].removeAttribute("disabled");
  }

  emptyNAinputsId();
}

function emptyNAinputsId(){
  const inputs = idContainer.querySelectorAll(".form-control");
  inputs.forEach(input => {
    if(input.value === "N/A"){
      input.value = "";
    }
  });
}