//Get elements in /users/edit
//Function called in /users/edit

function sendAddUserForm() {
  let response =  validateAddUserModal();
  const errorsMessage = modalAddUserContainer.querySelectorAll(".invalid-feedback");
  let errors = false;
  errorsMessage.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      errors = true;
    }
  });
  console.log(errors);
  if (!errors) {
    const divUser = document.createElement("div");
    divUser.classList.add("row", "user-table", "mx-0", "py-1", "listUsers");
    userListContainer.appendChild(divUser);

    const divEmailParent = document.createElement("div");
    divEmailParent.classList.add("col-5", "text-center", "ps-2");
    divUser.appendChild(divEmailParent);

    const divEmail = document.createElement("div");
    divEmail.classList.add("text-start", "userEmails");
    divEmail.textContent = userSelectEmailModal.value; 
    divEmailParent.appendChild(divEmail);

    const inputHiddenId = document.createElement("input");
    inputHiddenId.type = "hidden";
    inputHiddenId.value = userSelectEmailModal.value;
    divEmailParent.appendChild(inputHiddenId);

    const divRole = document.createElement("div");
    divRole.classList.add("col-5", "text-center", "ps-1", "selects");
    divUser.appendChild(divRole);

    const roleSelect = document.createElement("select");
    roleSelect.classList.add("form-select");
    roleSelect.value = userSelectRoleModal.value;

    const roles = [
      { value: "admin", text: "Administrateur" },
      { value: "responsable", text: "Responsable" },
      { value: "clerk", text: "Commis" },
    ];

    roles.forEach(role => {
      const option = document.createElement("option");
      option.value = role.value;
      option.textContent = role.text;
      if (role.value === userSelectRoleModal.value) {
        option.selected = true; 
      }
      roleSelect.appendChild(option);
    });
    divRole.appendChild(roleSelect);

    const maxAdminError = document.createElement("div");
    maxAdminError.classList.add("invalid-feedback", "text-start");
    maxAdminError.id = "maxAdminSelect" + (userListContainer.children.length);
    maxAdminError.style.display = "none"; 
    maxAdminError.textContent = "Il ne peut y avoir que deux administrateurs."; 
    divRole.appendChild(maxAdminError);

    const minAdminError = document.createElement("div");
    minAdminError.classList.add("invalid-feedback", "text-start");
    minAdminError.id = "minAdmins" + (userListContainer.children.length);
    minAdminError.style.display = "none"; 
    minAdminError.textContent = "Il doit y avoir deux administrateurs."; 
    divRole.appendChild(minAdminError);

    const removeUser = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "svg"
    );
    removeUser.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removeUser.setAttribute("width", "35");
    removeUser.setAttribute("height", "35");
    removeUser.setAttribute("fill", "currentColor");
    removeUser.setAttribute("class", "bi bi-x col-2 removeUser");
    removeUser.setAttribute("viewBox", "0 0 16 16");
    removeUser.style.cursor = "pointer";
    removeUser.innerHTML = `
      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    `;
    divUser.appendChild(removeUser);
    removeUser.addEventListener("click", function() {
      const role = roleSelect.value;
      const errorMessageMin = document.getElementById(`minAdmins${userListContainer.children.length}`);
      const errorMessageMax = document.getElementById(`maxAdminSelect${userListContainer.children.length}`);
      const errorMin = validateRoleBeforeRemoving(role);
      if (errorMin) {
        select.classList.add("is-invalid");
        errorMessageMin.style.display = 'block';
      }
      else {
        if(errorMessageMin.style.display != "block" && errorMessageMax.style.display != "block" ){
          divUser.remove();
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
    });
    modalAddUser.hide();
  }
}


