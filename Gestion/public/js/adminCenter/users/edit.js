let btnCancelUser;
let btnAddUser;
let btnSaveUsers;
let showUsersContainer;
let modalAddUser;
let modalAddUserContainer;
let btnAddUserModal;
let userSelectEmailModal;
let selectsRoleShow;
let formAddUser;
let listUsers;

document.addEventListener("DOMContentLoaded", function () {
  getElements(); 
  usersListeners();
});

function getElements(){
  btnAddUser = document.getElementById("btnAddUsers");
  btnCancelUser = document.getElementById("btnCancelUser");
  btnSaveUsers = document.getElementById("btnSaveUsers");
  showUsersContainer = document.getElementById("users-section");
  modalAddUserContainer = document.getElementById("modalAddUser")
  modalAddUser =  new bootstrap.Modal(modalAddUserContainer);
  btnAddUserModal = document.getElementById("addUserModal");
  formAddUser = document.getElementById("addUserForm");
  userSelectEmailModal = document.getElementById("userEmail");
  selectsRoleShow = document.getElementsByName("userRolesShow[]");
  listUsers = document.querySelectorAll(".listUsers");
}

function usersListeners() {
  btnAddUser.addEventListener("click", ()=>{
    modalAddUser.show();
  });

  if(userSelectEmailModal)
    userSelectEmailModal.addEventListener("change", validateUserEmail);
  
  if(selectRoleModal)
    selectRoleModal.addEventListener('change', validateRoleModal)

  editUser();
  removeUser();
  btnAddUserModal.addEventListener("click", ()=>{
    sendAddUserForm();
  });
}

function editUser(){
  selectsRoleShow.forEach((select, index) => {
    select.addEventListener("change",  function (event) {
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
      resetErrorMessagesRolesValid();
    });
  });
}

function resetErrorMessagesRolesValid(){
  const { errorMax, errorMin } =  validateExistingUserRole();
  if (!errorMax) {
    selectsRoleShow.forEach((otherSelect, otherIndex) => {
      const otherErrorMessageMax = document.getElementById(`maxAdminSelect${otherIndex + 1}`);
      otherSelect.classList.remove("is-invalid");
      if(otherErrorMessageMax != null)
        otherErrorMessageMax.style.display = 'none';
   });
  } 
 
  if (!errorMin) {
    selectsRoleShow.forEach((otherSelect, otherIndex) => {
      const otherErrorMessageMin = document.getElementById(`minAdmins${otherIndex + 1}`);
      otherSelect.classList.remove("is-invalid");
      if(otherErrorMessageMin != null)
        otherErrorMessageMin.style.display = 'none';
    });
  }
 
}

