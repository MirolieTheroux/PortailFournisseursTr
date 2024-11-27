//Get elements in /users/edit
//Function called in /users/edit
function removeUser() {
  listUsers.forEach((user, index) => {
    user.childNodes.forEach((child) => {
      if (child.nodeName === "svg"){     
        child.addEventListener("click", function () {
          const parentContainer = child.closest(".user-table");
          const select = parentContainer.querySelector(".selects select");
          const role = select.value;
          const errorMessageMin = document.getElementById(`minAdmins${index + 1}`);
          const errorMessageMax = document.getElementById(`maxAdminSelect${index + 1}`);
          const errorMin =  validateRoleBeforeRemoving(role);
          if (errorMin) {
            select.classList.add("is-invalid");
            errorMessageMin.style.display = 'block';
          }
          else {
            if(errorMessageMin.style.display != "block" && errorMessageMax.style.display != "block" ){
              user.remove();
            }
            if (getNumberAdminsListUsers() == 2) {
              selectsRoleShow.forEach((otherSelect) => {
                otherSelect.classList.remove("is-invalid");
              });
              const currentSectionErrors = showUsersContainer.querySelectorAll(".invalid-feedback");
              currentSectionErrors.forEach(errorMessage => {
                errorMessage.style.display = 'none';
              });
            }
          }
        })
      }
    });
  });
}
