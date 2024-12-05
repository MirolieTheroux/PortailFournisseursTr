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
let emailInvalidUnique;
let maxAdminModal;
let selectRoleModal;
let errorMessagesMax;
let errorMessagesMin;

document.addEventListener("DOMContentLoaded", function () {
  getElementsUsers(); 
  usersListeners();
});

function getElementsUsers(){
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
  emailInvalidUnique = document.getElementById("emailExist");
  maxAdminModal = document.getElementById('maxAdminModal');
  selectRoleModal = document.getElementById("userRoleModal");
  errorMessagesMin = document.querySelectorAll(".minErrors")
}

function usersListeners() {
  btnAddUser.addEventListener("click", ()=>{
    removeErrorMessagesModal();
    modalAddUser.show();
  });

  if (userSelectEmailModal) {
    userSelectEmailModal.addEventListener("change", function () {
      validateUserEmail(userSelectEmailModal.value);
    });
  }


  selectsRoleShow.forEach(select => {
    select.addEventListener("change", function () {
      editUser(select);
    });
  });
  removeUser();
  btnAddUserModal.addEventListener("click", ()=>{
    addUser();
    getElementsUsers();
  });
}

function editUser(select) {
  resetErrorMessagesRolesValid() ;
  const errorMessageMin = select.parentElement.querySelector(".invalid-feedback[id^='minAdmins']");
  const errorMin  = validateExistingUserRole();

  if (errorMin) {
    select.classList.add("is-invalid");
    errorMessageMin.style.display = 'block';
  } else {
    select.classList.remove("is-invalid");
    errorMessageMin.style.display = 'none';
  }
}

