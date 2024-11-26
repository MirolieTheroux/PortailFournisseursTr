let btnCancelUser;
let btnAddUser;
let btnSaveUsers;
let showUsersContainer;
let userListContainer;
let modalAddUser;
let modalAddUserContainer;
let btnAddUserModal;
let userSelectEmailModal;
let userSelectRoleModal;
let selectsRoleShow;
let formAddUser;
let listUsers;
let usersEmailList;

document.addEventListener("DOMContentLoaded", function () {
  getElements(); 
  usersListeners();
});

function getElements(){
  btnAddUser = document.getElementById("btnAddUsers");
  btnCancelUser = document.getElementById("btnCancelUser");
  btnSaveUsers = document.getElementById("btnSaveUsers");
  showUsersContainer = document.getElementById("users-section");
  userListContainer = document.getElementById("userList")
  modalAddUserContainer = document.getElementById("modalAddUser")
  modalAddUser =  new bootstrap.Modal(modalAddUserContainer);
  btnAddUserModal = document.getElementById("addUserModal");
  formAddUser = document.getElementById("addUserForm");
  userSelectEmailModal = document.getElementById("userEmail");
  userSelectRoleModal = document.getElementById("userRoleModal");
  selectsRoleShow = document.getElementsByName("userRolesShow[]");
  listUsers = document.querySelectorAll(".listUsers");
}

function usersListeners() {
  btnAddUser.addEventListener("click", ()=>{
    modalAddUser.show();
  });

  editUser();
  removeUser();
  btnAddUserModal.addEventListener("click", ()=>{
    sendAddUserForm();
  });
 
}

function editUser(){
  selectsRoleShow.forEach((select, index) => {
    select.addEventListener("change",  function (event) {   
      resetErrorMessagesRolesValid();
      const errorMessageMax = document.getElementById(`maxAdminSelect${index + 1}`);
      const errorMessageMin = document.getElementById(`minAdmins${index + 1}`);
      const { errorMax, errorMin } =  validateExistingUserRole();
      if (errorMax && select.value === "admin") {
        select.classList.add("is-invalid");
        errorMessageMax.style.display = 'block';
        errorMessageMin.style.display = 'none';
      } 
      else{
      select.classList.remove("is-invalid");
      errorMessageMax.style.display = 'none';
      }
      if (errorMin) {
        select.classList.add("is-invalid");
        errorMessageMin.style.display = 'block';
        errorMessageMax.style.display = 'none'; 
      }
      else{
        select.classList.remove("is-invalid");
        errorMessageMin.style.display = 'none';
      } 
   
    });
  });
}

function resetErrorMessagesRolesValid() {
  const { errorMax, errorMin } = validateExistingUserRole();
  selectsRoleShow = document.getElementsByName("userRolesShow[]");
  if (!errorMax) {
    selectsRoleShow.forEach((select, index) => {
      const errorMessageMax = document.getElementById(`maxAdminSelect${index + 1}`);
      if (errorMessageMax) 
      { 
        select.classList.remove("is-invalid");
        errorMessageMax.style.display = 'none';
      }
    });
  }

  if (!errorMin) {
    selectsRoleShow.forEach((select, index) => {
      const errorMessageMin = document.getElementById(`minAdmins${index + 1}`);
      if (errorMessageMin)
      { 
        select.classList.remove("is-invalid");
        errorMessageMin.style.display = 'none';
      }
    });
  }
}


