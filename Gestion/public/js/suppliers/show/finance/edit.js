let financeContainer;
let btnCancelFinances;
let btnEditFinances; 
let btnSaveFinances; 
let financeInputs; 
let financeSelect; 
let financeChecks; 

document.addEventListener("DOMContentLoaded", function () {
  getFinanceSectionElements();
  addFinanceSectionListeners();
});

function getFinanceSectionElements(){
  financeContainer = document.getElementById('finances-section');
  btnCancelFinances = document.getElementById("btnCancelFinances");
  btnSaveFinances = document.getElementById("btnSaveFinances");
  btnEditFinances = document.getElementById("btnEditFinances");
  financeInputs = financeContainer.getElementsByClassName("form-control");
  financeSelect = financeContainer.querySelector(".form-select");
  financeChecks = financeContainer.getElementsByClassName("form-check-input");
}
function addFinanceSectionListeners(){
  if(btnEditFinances)
    btnEditFinances.addEventListener('click', enableFinanceSectionEdit);
}

function enableFinanceSectionEdit(){
  btnCancelFinances.classList.remove("d-none");
  btnSaveFinances.classList.remove("d-none");
  btnEditFinances.classList.add("d-none");
  financeSelect.removeAttribute("disabled");
  for (let index = 0; index < financeInputs.length; index++) {
    financeInputs[index].removeAttribute("disabled");
    if(financeInputs[index].value === "N/A")
      financeInputs[index].value = ""
  }
  for (let index = 0; index < financeChecks.length; index++) {
    financeChecks[index].removeAttribute("disabled");
  }
}