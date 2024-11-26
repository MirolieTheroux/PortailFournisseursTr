//Get elements in /users/edit
//Function called in /users/edit

async function sendAddUserForm() {
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