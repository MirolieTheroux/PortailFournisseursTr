let psContainer;
let btnCancelPS;
let btnEditPS;
let btnSavePS;
let psShowContainer;
let psEditContainer;

document.addEventListener("DOMContentLoaded", function () {
  getPSSectionElements();
  addPSSectionListeners();
});

function getPSSectionElements(){
  psContainer = document.getElementById('productsServices-section');
  btnCancelPS = document.getElementById("btnCancelProductsServices");
  btnSavePS = document.getElementById("btnSaveProductsServices");
  btnEditPS = document.getElementById("btnEditProductsServices");
  psShowContainer = document.getElementById("productServiceShowContainer");
  psEditContainer = document.getElementById("productServiceEditContainer");
}
function addPSSectionListeners(){
  if(btnEditPS)
    btnEditPS.addEventListener('click', enablePSSectionEdit);
}

function enablePSSectionEdit(){
  btnEditPS.classList.add("d-none");
  psShowContainer.classList.add("d-none");
  btnCancelPS.classList.remove("d-none");
  btnSavePS.classList.remove("d-none");
  psEditContainer.classList.remove("d-none");
}