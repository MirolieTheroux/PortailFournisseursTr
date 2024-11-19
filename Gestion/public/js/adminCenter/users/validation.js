const selectRoleModal = document.getElementById("userRoleModal");

async function validateAllUser(){
  await validateUserEmail();
  await validateRole(selectRoleModal);
}

async function validateUserEmail(){
  const emailInvalidUnique = document.getElementById('emailExist');
  let emailExist = await checkEmailUniqueUser(userSelectEmailModal.value);
  if(emailExist){
   
    userSelectEmailModal.classList.add('is-invalid');
    emailInvalidUnique.style.display = 'block';
  }
  else{
    userSelectEmailModal.classList.remove('is-invalid');
    emailInvalidUnique.style.display = 'none';
  }
}

async function validateRole(event,roleValue){
  const maxAdminModal = document.getElementById('maxAdminModal');
  const maxAdminSelect = document.getElementById('maxAdminSelect');
  let numberAdmins = await checkAdmins(); 
  if(numberAdmins == 2 && roleValue == "admin"){
    selectRoleModal.classList.add('is-invalid');
    maxAdminModal.style.display = 'block';
    maxAdminSelect.style.display = 'block';
  }
  else{
    selectRoleModal.classList.remove('is-invalid');
    maxAdminModal.style.display = 'none';
    maxAdminSelect.style.display = 'none';
  }
}

async function checkEmailUniqueUser(email){
  const response = await fetch('/settings/addUser/checkEmailUser', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },
    body: JSON.stringify({ email: email }) 
  });
  const data = await response.json();
  return data.exists;
}

async function checkAdmins(){
  const response = await fetch('/settings/addUser/checkAdmins', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },        
  })
  const data = await response.json();
  return data.count;
}

