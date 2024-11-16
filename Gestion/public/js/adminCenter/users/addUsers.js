let btnAddUser;
let modalAddUser;

document.addEventListener("DOMContentLoaded", function () {
  getElements();
  addUserSettingsListeners();
});

function getElements(){
  btnAddUser = document.getElementById("btnAddUsers");
  modalAddUser =  new bootstrap.Modal(document.getElementById("modalAddUser"));
}

function addUserSettingsListeners(){
  btnAddUser.addEventListener("click", showModalAddUser);
}

function showModalAddUser(){
  modalAddUser.show();
}


