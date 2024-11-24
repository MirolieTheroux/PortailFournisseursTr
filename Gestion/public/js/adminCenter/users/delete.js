//Get elements in /users/edit
//Function called in /users/edit
function removeUser() {
  listUsers.forEach((user, index) => {
    user.childNodes.forEach((child) => {
      if (child.nodeName === "svg")
        child.addEventListener("click", async function (event) {
          const parentContainer = child.closest(".user-table");
          const select = parentContainer.querySelector(".selects select");
          const role = select.value;
          const errorMessageMin = document.getElementById(`minAdmins${index + 1}`);
          const errorMin = await validateRoleBeforeRemoving(role);
          if (errorMin) {
            select.classList.add("is-invalid");
            errorMessageMin.style.display = 'block';
          }
          else {
            user.remove();
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
    });
  });
}