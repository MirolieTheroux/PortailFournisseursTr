
async function validateAllUser(){
  await validateUserEmail();
  await validateRole();
}

async function validateUserEmail(){
  const emailInvalidUnique = document.getElementById('emailExist');
  let emailExist = await checkEmailUniqueUser(userSelectEmail.value);
  if(emailExist){
   
    userSelectEmail.classList.add('is-invalid');
    emailInvalidUnique.style.display = 'block';
  }
  else{
    userSelectEmail.classList.remove('is-invalid');
    emailInvalidUnique.style.display = 'none';
  }
}

async function validateRole(){
  const maxAdmin = document.getElementById('maxAdmin');
  let numberAdmins = await checkAdmins();
  if(numberAdmins == 2 && selectRole.value == "admin"){
    selectRole.classList.add('is-invalid');
    maxAdmin.style.display = 'block';
  }
  else{
    selectRole.classList.remove('is-invalid');
    maxAdmin.style.display = 'none';
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
