let idNeqInput;
let idNameInput;
let idEmailInput;
let formIdentification;

document.addEventListener("DOMContentLoaded", function () {
  addIdValidationListeners();
});

function addIdValidationListeners(){
  idNeqInput = document.getElementById('neq');
  idNeqInput.addEventListener('blur', validateIdentificationNeq);
  
  idNameInput = document.getElementById('name');
  idNameInput.addEventListener('blur', validateIdentificationName);

  idEmailInput = document.getElementById('email');
  idEmailInput.addEventListener('blur', validateIdentificationEmail);
}

function validateIdentificationNeq() {
  const invalidStart = document.getElementById('neqInvalidStart');
  const invalidCharacters = document.getElementById('neqInvalidCharacters');
  const invalidAmount = document.getElementById('neqInvalidAmount');
  const invalidExist = document.getElementById('neqInvalidExist');

  // Reset all error messages
  invalidStart.style.display = 'none';
  invalidCharacters.style.display = 'none';
  invalidAmount.style.display = 'none';
  invalidExist.style.display = 'none';
  
  // Basic validation logic
  if (!idNeqInput.value) {
    idNeqInput.classList.remove('is-invalid');
    idNeqInput.classList.remove('is-valid');
  }
  else if (!idNeqInput.value.match(/^11|22|33|88/)) {
    idNeqInput.classList.remove('is-valid');
    idNeqInput.classList.add('is-invalid');
    invalidStart.style.display = 'block';
  }
  else if (idNeqInput.value.match(/\D/)) {
    idNeqInput.classList.remove('is-valid');
    idNeqInput.classList.add('is-invalid');
    invalidCharacters.style.display = 'block';
  }
  else if (idNeqInput.value.length !== 10) {
    idNeqInput.classList.remove('is-valid');
    idNeqInput.classList.add('is-invalid');
    invalidAmount.style.display = 'block';
  }
  else {
    idNeqInput.classList.remove('is-invalid');
    idNeqInput.classList.add('is-valid');
  }

  idNeqInput.classList.add('was-validated');
};

function validateIdentificationName() {
  const start = document.getElementById('nameStart');
  const valid = document.getElementById('nameValid');
  const invalidEmpty = document.getElementById('nameInvalidEmpty');

  // Reset all error messages
  start.style.display = 'none';
  valid.style.display = 'none';
  invalidEmpty.style.display = 'none';
  
  // Basic validation logic
  if (!idNameInput.value) {
    idNameInput.classList.remove('is-valid');
    idNameInput.classList.add('is-invalid');
    invalidEmpty.style.display = 'block';
  }
  else {
    idNameInput.classList.remove('is-invalid');
    idNameInput.classList.add('is-valid');
    valid.style.display = 'block';
  }
  
  idNameInput.classList.add('was-validated');
};

function validateIdentificationEmail() {
  const invalidEmpty = document.getElementById('emailInvalidEmpty');
  const invalidStart = document.getElementById('emailInvalidStart');
  const invalidNoArobase = document.getElementById('emailInvalidNoArobase');
  const invalidManyArobase = document.getElementById('emailInvalidManyArobase');
  const invalidEmptyDomain = document.getElementById('emailInvalidEmptyDomain');
  const invalidDomainFormat = document.getElementById('emailInvalidDomainFormat');
  const invalidDomainDot = document.getElementById('emailInvalidDomainDot');
  const emailInvalidUnique = document.getElementById('emailInvalidUnique');

  // Reset all error messages
  invalidEmpty.style.display = 'none';
  invalidStart.style.display = 'none';
  invalidNoArobase.style.display = 'none';
  invalidManyArobase.style.display = 'none';
  invalidEmptyDomain.style.display = 'none';
  invalidDomainFormat.style.display = 'none';
  invalidDomainDot.style.display = 'none';
  emailInvalidUnique.style.display = 'none';
  
  // Basic validation logic
  if (!idEmailInput.value) {
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidEmpty.style.display = 'block';
  }
  else if (idEmailInput.value.match(/^@/)) {
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidStart.style.display = 'block';
  }
  else if (!idEmailInput.value.match(/@/)) {
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidNoArobase.style.display = 'block';
  }
  else if (idEmailInput.value.match(/@.*@/)) {
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidManyArobase.style.display = 'block';
  }
  else if (idEmailInput.value.match(/@$/)) {
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidEmptyDomain.style.display = 'block';
  }
  else if (!idEmailInput.value.match(/@.*\./)){
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidDomainFormat.style.display = 'block';
  }
  else if (idEmailInput.value.match(/(@\.)|(\.$)/)){
    idEmailInput.classList.remove('is-valid');
    idEmailInput.classList.add('is-invalid');
    invalidDomainDot.style.display = 'block';
  }
  else {
    idEmailInput.classList.remove('is-invalid');
    idEmailInput.classList.add('is-valid');
  }
  
  idEmailInput.classList.add('was-validated');
};

async function validateIdentificationAll(){
  validateIdentificationNeq();
  validateIdentificationName();
  validateIdentificationEmail();

  if(idEmailInput.classList.contains("is-valid")){
    let emailExist = await checkEmailUnique(idEmailInput.value, idNeqInput.value);
    if(emailExist){
      const emailInvalidUnique = document.getElementById('emailInvalidUnique');
      idEmailInput.classList.remove('is-valid');
      idEmailInput.classList.add('is-invalid');
      emailInvalidUnique.style.display = 'block';
    }
  }

  if(idNeqInput.classList.contains("is-valid")){
    let neqExist = await checkNeqUnique(idNeqInput.value);
    if(neqExist){
      const neqInvalidExist = document.getElementById('neqInvalidExist');
      idNeqInput.classList.remove('is-valid');
      idNeqInput.classList.add('is-invalid');
      neqInvalidExist.style.display = 'block';
    }
  }
}

async function checkEmailUnique(email, neq){
  const response = await fetch('/suppliers/checkEmail', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },        
    body: JSON.stringify({ email: email, neq: neq })
  })
  const data = await response.json();
  return data.exists;
}

async function checkNeqUnique(neq){
  const response = await fetch('/suppliers/checkNeq', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },        
    body: JSON.stringify({ neq: neq })
  })
  console.log(response);
  const data = await response.json();
  return data.exists;
}