//Get elements in /users/edit

function validateAddUserModal(){
  validateUserEmail(userSelectEmailModal.value);
  validateRoleModal();
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

function validateRoleModal() {
  if (getNumberAdminsListUsers() === 2 && selectRoleModal.value === "admin") {
    selectRoleModal.classList.add('is-invalid');
    maxAdminModal.style.display = 'block';
  } else {
    selectRoleModal.classList.remove('is-invalid');
    maxAdminModal.style.display = 'none';
  }
}

 function validateExistingUserRole() {
  let errorMax = false;
  let errorMin = false;
  if (getNumberAdminsListUsers() > 2)
    errorMax = true;
  else if (getNumberAdminsListUsers() <= 1)
    errorMin = true;
  else{
    errorMax = false;
    errorMax = false;
  }
  return { errorMax, errorMin };
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
