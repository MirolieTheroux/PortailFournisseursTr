//Get elements in /users/edit

function validateAddUserModal(){
  validateUserEmail(userSelectEmailModal.value);
}

function validateUserEmail(email) {
  usersEmailList = document.querySelectorAll(".userEmails")
  const emails = Array.from(usersEmailList).map((div) =>
    div.textContent.trim()
  );
  const emailExists = emails.includes(email);
  if (emailExists) {
    userSelectEmailModal.classList.add("is-invalid");
    emailInvalidUnique.style.display = "block";
  } else {
    userSelectEmailModal.classList.remove("is-invalid");
    emailInvalidUnique.style.display = "none";
  }
}

 function validateExistingUserRole() {
  let errorMin = false;
  if (getNumberAdminsListUsers() <= 1)
    errorMin = true;
  else
    errorMin = false;
  
  return errorMin;
}

function validateRoleBeforeRemoving(role) {
  let errorMin = false;
  if (getNumberAdminsListUsers() === 2  && role === "admin")
    errorMin = true;
  else if(getNumberAdminsListUsers() < 2  && role === "admin")
    errorMin = true;
  else
    errorMin = false;
  return errorMin ;
}

function getNumberAdminsListUsers(){
  let numberAdmins = 0;
  selectsRoleShow = document.getElementsByName("userRolesShow[]");
  selectsRoleShow.forEach(select => {
    if(select.value == "admin")
      numberAdmins++;
  });
  return numberAdmins;
}

function resetErrorMessagesRolesValid() {
  const errorMin = validateExistingUserRole();

  if (!errorMin) {
    errorMessagesMin.forEach((message) => {
      const select = message.closest('.selects').querySelector('select');
      select.classList.remove("is-invalid");
      message.style.display = 'none';
    });
  }
}

function removeErrorMessagesModal(){
  emailInvalidUnique.style.display = "none";
  userSelectEmailModal.classList.remove("is-invalid");
  selectRoleModal.classList.remove('is-invalid');
  maxAdminModal.style.display = 'none';
}

