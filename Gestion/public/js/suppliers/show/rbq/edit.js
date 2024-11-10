let rbqContainer;
let btnCancelRbq;
let btnEditRbq; 
let btnSaveRbq; 
let rbqInput; 
let rbqSelects; 

document.addEventListener("DOMContentLoaded", function () {
  getRbqSectionElements();
  addRbqSectionListeners();
});

function getRbqSectionElements(){
  rbqContainer = document.getElementById('licence-section');
  btnCancelRbq = document.getElementById("btnCancelRbq");
  btnSaveRbq = document.getElementById("btnSaveRbq");
  btnEditRbq = document.getElementById("btnEditRbq");
  rbqInput = rbqContainer.querySelector(".form-control");
  rbqSelects = rbqContainer.getElementsByClassName("form-select");
}
function addRbqSectionListeners(){
  btnEditRbq.addEventListener('click', enableRbqSectionEdit);
}

function enableRbqSectionEdit(){
  console.log('test')
  btnCancelRbq.classList.remove("d-none");
  btnSaveRbq.classList.remove("d-none");
  btnEditRbq.classList.add("d-none");
  rbqInput.removeAttribute("disabled");
  for (let index = 0; index < rbqSelects.length; index++) {
    rbqSelects[index].removeAttribute("disabled");
  }
}