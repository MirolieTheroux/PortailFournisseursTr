let btnCancelUser;
let btnAddUser;
let btnSaveUsers;
let modalAddUser;
let modalAddUserContainer;
let btnAddUserModal;
let userSelectEmailModal;
let selectsRoleShow;
let formAddUser;

document.addEventListener("DOMContentLoaded", function () {
  getElements(); 
  usersListeners();
});

function getElements(){
  btnAddUser = document.getElementById("btnAddUsers");
  btnCancelUser = document.getElementById("btnCancelUser");
  btnSaveUsers = document.getElementById("btnSaveUsers");
  modalAddUserContainer = document.getElementById("modalAddUser")
  modalAddUser =  new bootstrap.Modal(modalAddUserContainer);
  btnAddUserModal = document.getElementById("addUserModal");
  formAddUser = document.getElementById("addUserForm");
  userSelectEmailModal = document.getElementById("userEmail");
  selectsRoleShow = document.getElementsByName("userRolesShow[]");
}

function usersListeners() {
  btnAddUser.addEventListener("click", ()=>{
    modalAddUser.show();
  });

  if(userSelectEmailModal){
    userSelectEmailModal.addEventListener('change', validateUserEmail);

  }
    
  if(selectRoleModal){
    selectRoleModal.addEventListener('change', function(event){
      validateRole(event,selectRoleModal.value);
    });
  }
    

  btnAddUserModal.addEventListener("click", ()=>{
    sendAddUserForm();
  });

  selectsRoleShow.forEach(select=>{
    select.addEventListener("change", function(event){
      validateRole(event, select.value);
      
    });
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