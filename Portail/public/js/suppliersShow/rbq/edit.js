let rbqContainer;
let btnCancelRbq;
let btnEditRbq; 
let btnSaveRbq; 
let rbqInput; 
let rbqSelects; 
let rbqChecks; 
let rbqSubcategoryTitle; 

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
  rbqChecks = rbqContainer.getElementsByClassName("form-check-input");
  rbqSubcategoryTitle = rbqContainer.getElementsByClassName("subcategory-title");
}
function addRbqSectionListeners(){
  btnEditRbq.addEventListener('click', enableRbqSectionEdit);
}

function enableRbqSectionEdit(){
  btnCancelRbq.classList.remove("d-none");
  btnSaveRbq.classList.remove("d-none");
  btnEditRbq.classList.add("d-none");
  rbqInput.removeAttribute("disabled");
  for (let index = 0; index < rbqSelects.length; index++) {
    rbqSelects[index].removeAttribute("disabled");
  }
  for (let index = 0; index < rbqChecks.length; index++) {
    rbqChecks[index].removeAttribute("disabled");
    rbqChecks[index].parentElement.classList.remove("d-none");
  }
  for (let index = 0; index < rbqSubcategoryTitle.length; index++) {
    rbqSubcategoryTitle[index].classList.remove("d-none");
  }
}