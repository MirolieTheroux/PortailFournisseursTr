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