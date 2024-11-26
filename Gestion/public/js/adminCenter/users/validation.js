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
  const emailInvalidUnique = document.getElementById("emailExist");
  if (emailExists) {
    userSelectEmailModal.classList.add("is-invalid");
    emailInvalidUnique.style.display = "block";
  } else {
    userSelectEmailModal.classList.remove("is-invalid");
    emailInvalidUnique.style.display = "none";
  }
}

function validateRoleModal() {
  const maxAdminModal = document.getElementById('maxAdminModal');
  //let numberAdmins = await checkAdmins();
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
  if (getNumberAdminsListUsers() === 2 && role === "admin")
    errorMin = true;
  else
    errorMin = false;
  return errorMin ;
}

// async function checkEmailUniqueUser(email){
//   const response = await fetch('/settings/addUser/checkEmailUser', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
//     },
//     body: JSON.stringify({ email: email }) 
//   });
//   const data = await response.json();
//   return data.exists;
// }

// async function checkAdmins(){
//   const response = await fetch('/settings/addUser/checkAdmins', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
//     },        
//   })
//   const data = await response.json();
//   return data.count;
// }

function getNumberAdminsListUsers(){
  let numberAdmins = 0;
  selectsRoleShow.forEach(select => {
    if(select.value == "admin")
      numberAdmins++;
  });
  return numberAdmins;
}
