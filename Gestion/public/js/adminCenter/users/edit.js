let btnEditUser;
let btnCancelUser;
let btnAddUser;
let btnSaveUsers;

document.addEventListener("DOMContentLoaded", function () {
  getElementsEditUser();
  addUsersSectionListeners()
});

function getElementsEditUser(){
  btnEditUser = document.getElementById("btnEditUser");
  btnAddUser = document.getElementById("btnAddUsers");
  btnCancelUser = document.getElementById("btnCancelUser");
  btnSaveUsers = document.getElementById("btnSaveUsers");
}

function addUsersSectionListeners() {
  btnEditUser.addEventListener("click",enableUsersSectionEdit);
}

function enableUsersSectionEdit(){
  btnAddUser.classList.remove("d-none");
  btnCancelUser.classList.remove("d-none");
  btnSaveUsers.classList.remove("d-none");
  btnEditUser.classList.add("d-none");
}