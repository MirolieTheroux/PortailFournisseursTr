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
}

function usersListeners() {
  btnAddUser.addEventListener("click", ()=>{
    modalAddUser.show();
  });

  if(userSelectEmailModal){
    userSelectEmailModal.addEventListener("change", validateUserEmail);

  }
    
  if(selectRoleModal){
    selectRoleModal.addEventListener('change', validateRoleModal)
  }

  selectsRoleShow.forEach((select, index) => {
    select.addEventListener("change", async function (event) {
      const errorMessageMax = document.getElementById(`maxAdminSelect${index + 1}`);
      const errorMessageMin = document.getElementById(`minAdmins${index + 1}`);
      const { errorMax, errorMin } = await validateExistingUserRoleMaxAdmin(select.value);
      if (errorMax) {
        select.classList.add("is-invalid");
        errorMessageMax.style.display = 'block';
        errorMessageMin.style.display = 'none';
      } 
      else{
        selectsRoleShow.forEach((otherSelect, otherIndex) => {
          const otherErrorMessageMax = document.getElementById(`maxAdminSelect${otherIndex + 1}`);
          otherSelect.classList.remove("is-invalid");
          otherErrorMessageMax.style.display = 'none';
       });
      }
      if (errorMin) {
        select.classList.add("is-invalid");
        errorMessageMin.style.display = 'block';
        errorMessageMax.style.display = 'none'; 
      }
      else{
        selectsRoleShow.forEach((otherSelect, otherIndex) => {
          const otherErrorMessageMin = document.getElementById(`minAdmins${otherIndex + 1}`);
          otherSelect.classList.remove("is-invalid");
          otherErrorMessageMin.style.display = 'none';
        });
      } 
    });
  });

  btnAddUserModal.addEventListener("click", ()=>{
    sendAddUserForm();
  });
}

async function sendAddUserForm(){
  let response = await validateAddUserModal();  
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