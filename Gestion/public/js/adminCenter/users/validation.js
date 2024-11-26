//Get elements in /users/edit
const selectRoleModal = document.getElementById("userRoleModal");

function validateAddUserModal(){
  validateUserEmail(userSelectEmailModal.value);
  validateRoleModal();
}

// async function validateUserEmail(){
//   const emailInvalidUnique = document.getElementById('emailExist');
//   let emailExist = await checkEmailUniqueUser(userSelectEmailModal.value);
//   if(emailExist){
//     userSelectEmailModal.classList.add('is-invalid');
//     emailInvalidUnique.style.display = 'block';
//   }
//   else{
//     userSelectEmailModal.classList.remove('is-invalid');
//     emailInvalidUnique.style.display = 'none';
//   }
// }

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
  console.log(getNumberAdminsListUsers());
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
  console.log(getNumberAdminsListUsers());
  if (getNumberAdminsListUsers() === 2 || getNumberAdminsListUsers() < 2 && role === "admin")
    errorMin = true;
  else
    errorMin = false;
  return errorMin ;
}

function getNumberAdminsListUsers(){
  let numberAdmins = 0;
  selectsRoleShow = document.getElementsByName("userRolesShow[]");
  selectsRoleShow.forEach(select => {
    console.log(select);
    if(select.value == "admin")
      numberAdmins++;
  });
  return numberAdmins;
}
