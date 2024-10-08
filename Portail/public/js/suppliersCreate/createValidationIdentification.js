function validateIdentificationNeq() {
  const input = document.getElementById('neq');
  const start = document.getElementById('neqStart');
  const valid = document.getElementById('neqValid');
  const invalidStart = document.getElementById('neqInvalidStart');
  const invalidThird = document.getElementById('neqInvalidThird');
  const invalidCharacters = document.getElementById('neqInvalidCharacters');
  const invalidAmount = document.getElementById('neqInvalidAmount');
  const invalidExist = document.getElementById('neqInvalidExist');
    // Reset all error messages
    start.style.display = 'none';
    valid.style.display = 'none';
    invalidStart.style.display = 'none';
    invalidThird.style.display = 'none';
    invalidCharacters.style.display = 'none';
    invalidAmount.style.display = 'none';
    invalidExist.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid.style.display = 'block';
    }
    else if (!input.value.match(/^11|22|33|88/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidStart.style.display = 'block';
    }
    else if (!input.value.match(/^..(4|5|6|7|8|9)/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidThird.style.display = 'block';
    }
    else if (input.value.match(/\D/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidCharacters.style.display = 'block';
    }
    else if (input.value.length !== 10) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidAmount.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    //TODO::Le NEQ est déjà enregistrer pour un autre compte!

    input.classList.add('was-validated');
};

function validateIdentificationName() {
  const input = document.getElementById('name');
  const start = document.getElementById('nameStart');
  const valid = document.getElementById('nameValid');
  const invalidEmpty = document.getElementById('nameInvalidEmpty');
    // Reset all error messages
    start.style.display = 'none';
    valid.style.display = 'none';
    invalidEmpty.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidEmpty.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    input.classList.add('was-validated');
};

function validateIdentificationEmail() {
  const input = document.getElementById('email');
  const start = document.getElementById('emailStart');
  const valid = document.getElementById('emailValid');
  const invalidEmpty = document.getElementById('emailInvalidEmpty');
  const invalidStart = document.getElementById('emailInvalidStart');
  const invalidNoArobase = document.getElementById('emailInvalidNoArobase');
  const invalidManyArobase = document.getElementById('emailInvalidManyArobase');
  const invalidEmptyDomain = document.getElementById('emailInvalidEmptyDomain');
  const invalidDomainFormat = document.getElementById('emailInvalidDomainFormat');
  const invalidDomainDot = document.getElementById('emailInvalidDomainDot');
    // Reset all error messages
    start.style.display = 'none';
    valid.style.display = 'none';
    invalidEmpty.style.display = 'none';
    invalidStart.style.display = 'none';
    invalidNoArobase.style.display = 'none';
    invalidManyArobase.style.display = 'none';
    invalidEmptyDomain.style.display = 'none';
    invalidDomainFormat.style.display = 'none';
    invalidDomainDot.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidEmpty.style.display = 'block';
    }
    else if (input.value.match(/^@/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidStart.style.display = 'block';
    }
    else if (!input.value.match(/@/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidNoArobase.style.display = 'block';
    }
    else if (input.value.match(/@.*@/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidManyArobase.style.display = 'block';
    }
    else if (input.value.match(/@$/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidEmptyDomain.style.display = 'block';
    }
    else if (!input.value.match(/@.*\./)){
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidDomainFormat.style.display = 'block';
    }
    else if (input.value.match(/(@\.)|(\.$)/)){
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidDomainDot.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    input.classList.add('was-validated');
};

function validateIdentificationPassword() {
  const input = document.getElementById('password');
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
    if (!input.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidEmpty.style.display = 'block';
    }
    else if (input.value.length < 7 || input.value.length > 12) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidAmount.style.display = 'block';
    }
    else if (!input.value.match(/[a-z]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidLowercase.style.display = 'block';
    }
    else if (!input.value.match(/[A-Z]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidUppercase.style.display = 'block';
    }
    else if (!input.value.match(/[0-9]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidNumber.style.display = 'block';
    }
    else if (!input.value.match(/[^a-zA-Z0-9]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidSpecial.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    input.classList.add('was-validated');

    validateIdentificationPasswordConfirmation(false);
};

let test = false;
function validateIdentificationPasswordConfirmation(hasBeenEdited) {
  if (test == false){
    test = hasBeenEdited;
  }
  if (test == true){
    const input = document.getElementById('password_confirmation');
    const confirmation = document.getElementById('password');
    const start = document.getElementById('password_confirmationStart');
    const valid = document.getElementById('password_confirmationValid');
    const invalidDifferent = document.getElementById('password_confirmationInvalidDifferent');

    // Reset all error messages
    start.style.display = 'none';
    valid.style.display = 'none';
    invalidDifferent.style.display = 'none';
    
    // Basic validation logic
    if (input.value !== confirmation.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidDifferent.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid.style.display = 'block';
    }
    
    input.classList.add('was-validated');
  }
};