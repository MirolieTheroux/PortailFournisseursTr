//Get elements in /users/edit
//Function called in /users/edit
function addUser() {
  let response =  validateAddUserModal();
  const errorsMessage = modalAddUserContainer.querySelectorAll(".invalid-feedback");
  let errors = false;
  errorsMessage.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      errors = true;
    }
  });
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
    inputHiddenId.setAttribute("name", "usersIds[]")
    inputHiddenId.value = "-1";
    divEmailParent.appendChild(inputHiddenId);
    const inputHiddenEmail = document.createElement("input");
    inputHiddenEmail.type = "hidden";
    inputHiddenEmail.value = userSelectEmailModal.value;
    inputHiddenEmail.setAttribute("name", "userEmails[]")
    divEmailParent.appendChild(inputHiddenEmail);

    const divRole = document.createElement("div");
    divRole.classList.add("col-5", "text-center", "ps-1", "selects");
    divUser.appendChild(divRole);

    const roleSelect = document.createElement("select");
    roleSelect.classList.add("form-select");
    roleSelect.setAttribute("name", "userRolesShow[]");
    roleSelect.setAttribute("id", "userRoleShow" + (userListContainer.children.length))
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

    const minAdminError = document.createElement("div");
    minAdminError.classList.add("invalid-feedback", "text-start", "minErrors");
    minAdminError.id = "minAdmins" + (userListContainer.children.length);
    minAdminError.style.display = "none"; 
    minAdminError.textContent = "Il doit y avoir deux administrateurs."; 
    divRole.appendChild(minAdminError);

    const removeUserSvg = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "svg"
    );
    removeUserSvg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removeUserSvg.setAttribute("width", "35");
    removeUserSvg.setAttribute("height", "35");
    removeUserSvg.setAttribute("fill", "currentColor");
    removeUserSvg.setAttribute("class", "bi bi-x col-2 removeUser");
    removeUserSvg.setAttribute("viewBox", "0 0 16 16");
    removeUserSvg.style.cursor = "pointer";
    removeUserSvg.innerHTML = `
      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    `;
    divUser.appendChild(removeUserSvg);
    modalAddUser.hide();
    getElementsUsers();
    resetErrorMessagesRolesValid();
    //Fonction in /users/delete
    removeUser();
    //Fonction in /users/edit
    roleSelect.addEventListener("change", function () {
      editUser(roleSelect);
    });
  }
}


