const neqInput = document.getElementById('neq');
neqInput.addEventListener('input', validateIdentificationNeq);

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
  if (!neqInput.value) {
    neqInput.classList.remove('is-invalid');
    neqInput.classList.remove('is-valid');
  }
  else if (!neqInput.value.match(/^11|22|33|88/)) {
    neqInput.classList.remove('is-valid');
    neqInput.classList.add('is-invalid');
    invalidStart.style.display = 'block';
  }
  else if (neqInput.value.match(/\D/)) {
    neqInput.classList.remove('is-valid');
    neqInput.classList.add('is-invalid');
    invalidCharacters.style.display = 'block';
  }
  else if (neqInput.value.length !== 10) {
    neqInput.classList.remove('is-valid');
    neqInput.classList.add('is-invalid');
    invalidAmount.style.display = 'block';
  }
  else {
    neqInput.classList.remove('is-invalid');
    neqInput.classList.add('is-valid');
  }

  neqInput.classList.add('was-validated');
};

const nameInput = document.getElementById('name');
nameInput.addEventListener('input', validateIdentificationName);

function validateIdentificationName() {
  const start = document.getElementById('nameStart');
  const valid = document.getElementById('nameValid');
  const invalidEmpty = document.getElementById('nameInvalidEmpty');

  // Reset all error messages
  start.style.display = 'none';
  valid.style.display = 'none';
  invalidEmpty.style.display = 'none';
  
  // Basic validation logic
  if (!nameInput.value) {
    nameInput.classList.remove('is-valid');
    nameInput.classList.add('is-invalid');
    invalidEmpty.style.display = 'block';
  }
  else {
    nameInput.classList.remove('is-invalid');
    nameInput.classList.add('is-valid');
    valid.style.display = 'block';
  }
  
  nameInput.classList.add('was-validated');
};

const emailInput = document.getElementById('email');
emailInput.addEventListener('input', validateIdentificationEmail);

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
  if (!emailInput.value) {
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidEmpty.style.display = 'block';
  }
  else if (emailInput.value.match(/^@/)) {
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidStart.style.display = 'block';
  }
  else if (!emailInput.value.match(/@/)) {
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidNoArobase.style.display = 'block';
  }
  else if (emailInput.value.match(/@.*@/)) {
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidManyArobase.style.display = 'block';
  }
  else if (emailInput.value.match(/@$/)) {
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidEmptyDomain.style.display = 'block';
  }
  else if (!emailInput.value.match(/@.*\./)){
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidDomainFormat.style.display = 'block';
  }
  else if (emailInput.value.match(/(@\.)|(\.$)/)){
    emailInput.classList.remove('is-valid');
    emailInput.classList.add('is-invalid');
    invalidDomainDot.style.display = 'block';
  }
  else {
    emailInput.classList.remove('is-invalid');
    emailInput.classList.add('is-valid');
  }
  
  emailInput.classList.add('was-validated');
};

const passwordInput = document.getElementById('password');
passwordInput.addEventListener('input', validateIdentificationPassword);

function validateIdentificationPassword() {
  const start = document.getElementById('passwordStart');
  const valid = document.getElementById('passwordValid');
  const invalidEmpty = document.getElementById('passwordInvalidEmpty');
  const invalidAmount = document.getElementById('passwordInvalidAmount');
  const invalidLowercase = document.getElementById('passwordInvalidLowercase');
  const invalidUppercase = document.getElementById('passwordInvalidUppercase');
  const invalidNumber = document.getElementById('passwordInvalidNumber');
  const invalidSpecial = document.getElementById('passwordInvalidSpecial');

    // Reset all error messages
    start.style.display = 'none';
    valid.style.display = 'none';
    invalidEmpty.style.display = 'none';
    invalidAmount.style.display = 'none';
    invalidLowercase.style.display = 'none';
    invalidUppercase.style.display = 'none';
    invalidNumber.style.display = 'none';
    invalidSpecial.style.display = 'none';
    
    // Basic validation logic
    if (!passwordInput.value) {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
      invalidEmpty.style.display = 'block';
    }
    else if (passwordInput.value.length < 7 || passwordInput.value.length > 12) {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
      invalidAmount.style.display = 'block';
    }
    else if (!passwordInput.value.match(/[a-z]/)) {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
      invalidLowercase.style.display = 'block';
    }
    else if (!passwordInput.value.match(/[A-Z]/)) {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
      invalidUppercase.style.display = 'block';
    }
    else if (!passwordInput.value.match(/[0-9]/)) {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
      invalidNumber.style.display = 'block';
    }
    else if (!passwordInput.value.match(/[^a-zA-Z0-9]/)) {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
      invalidSpecial.style.display = 'block';
    }
    else {
      passwordInput.classList.remove('is-invalid');
      passwordInput.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    passwordInput.classList.add('was-validated');

    validateIdentificationPasswordConfirmation(false);
};

const passwordConfirmInput = document.getElementById('password_confirmation');
passwordConfirmInput.addEventListener("input", (event)=>{
  validateIdentificationPasswordConfirmation(true);
});

let defaultIsEdited = false;
function validateIdentificationPasswordConfirmation(hasBeenEdited) {
  if (defaultIsEdited == false){
    defaultIsEdited = hasBeenEdited;
  }
  if (defaultIsEdited == true){
    const start = document.getElementById('password_confirmationStart');
    const valid = document.getElementById('password_confirmationValid');
    const invalidDifferent = document.getElementById('password_confirmationInvalidDifferent');

    // Reset all error messages
    start.style.display = 'none';
    valid.style.display = 'none';
    invalidDifferent.style.display = 'none';
    
    // Basic validation logic
    if (passwordConfirmInput.value !== passwordInput.value) {
      passwordConfirmInput.classList.remove('is-valid');
      passwordConfirmInput.classList.add('is-invalid');
      invalidDifferent.style.display = 'block';
    }
    else {
      passwordConfirmInput.classList.remove('is-invalid');
      passwordConfirmInput.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    passwordConfirmInput.classList.add('was-validated');
  }
};

const idSectionNext = document.getElementById("identification-button");
idSectionNext.addEventListener("click", async ()=>{
  await validateIdentificationAll();
});

async function validateIdentificationAll(){
  validateIdentificationNeq();
  validateIdentificationName();
  validateIdentificationEmail();
  validateIdentificationPassword();
  validateIdentificationPasswordConfirmation(true);

  if(emailInput.classList.contains("is-valid")){
    let emailExist = await checkEmailUnique(emailInput.value, neqInput.value);
    if(emailExist){
      const emailInvalidUnique = document.getElementById('emailInvalidUnique');
      emailInput.classList.remove('is-valid');
      emailInput.classList.add('is-invalid');
      emailInvalidUnique.style.display = 'block';
    }
  }

  if(neqInput.classList.contains("is-valid")){
    let neqExist = await checkNeqUnique(neqInput.value);
    if(neqExist){
      const neqInvalidExist = document.getElementById('neqInvalidExist');
      neqInput.classList.remove('is-valid');
      neqInput.classList.add('is-invalid');
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
  const data = await response.json();
  return data.exists;
}