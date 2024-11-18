let modalAddUser;
let modalAddUserContainer;
let btnAddUserModal;
let userSelectEmail;
let selectRole;
let formAddUser;

document.addEventListener("DOMContentLoaded", function () {
  getElements();
  addUserValidationListeners();
});

function getElements(){
  modalAddUserContainer = document.getElementById("modalAddUser")
  modalAddUser =  new bootstrap.Modal(modalAddUserContainer);
  btnAddUserModal = document.getElementById("addUserModal");
  formAddUser = document.getElementById("addUserForm");
  userSelectEmail = document.getElementById("userEmail");
  selectRole = document.getElementById("userRole");
}

function addUserValidationListeners(){
  btnAddUser.addEventListener("click", ()=>{
    modalAddUser.show();
  });
  if(userSelectEmail)
    userSelectEmail.addEventListener('change', validateUserEmail);
  if(selectRole)
    selectRole.addEventListener('change', validateRole);
  btnAddUserModal.addEventListener("click", ()=>{
    sendAddUserForm();
  });
}

async function sendAddUserForm(){
  let response = await validateAllUser();  
  const errorsMessage = modalAddUserContainer.querySelectorAll(".invalid-feedback");
  let errors = false;
  errorsMessage.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      errors = true;
    }
  });
  if (!errors) {
    formAddUser.submit();
  }
}
