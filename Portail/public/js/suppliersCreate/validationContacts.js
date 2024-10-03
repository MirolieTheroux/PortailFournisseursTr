function validateContactsName(id) {
  console.log(id)
  const input = document.getElementById(id);
  const parentDiv = input.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.nameInvalidRequired');
  const invalidSymbolsMessage = parentDiv.querySelector('.nameInvalidSymbols');

  const regex = /^[a-zA-ZÀ-ÿ\'\-]+$/g;

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidSymbolsMessage.style.display = 'none';
  
  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if(!input.value.match(regex)){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidSymbolsMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }
  
  input.classList.add('was-validated');
};

function validateContactsJob(id) {
  const input = document.getElementById(id);
  const parentDiv = input.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.jobInvalidRequired');

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  
  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }
  
  input.classList.add('was-validated');
};

function validateContactsEmail(id) {
  const input = document.getElementById(id);
  const parentDiv = input.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.emailInvalidRequired');
  const invalidFormatMessage = parentDiv.querySelector('.emailInvalidFormat');

  const regex = /^([-!#-'*+/-9=?A-Z^-~]+(\.[-!#-'*+/-9=?A-Z^-~]+)*|"([]!#-[^-~ \t]|(\\[\t -~]))+")@[0-9A-Za-z]([0-9A-Za-z-]{0,61}[0-9A-Za-z])?(\.[0-9A-Za-z]([0-9A-Za-z-]{0,61}[0-9A-Za-z])?)+$/g;

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidFormatMessage.style.display = 'none';
  
  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if (!input.value.match(regex)) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidFormatMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }
  
  input.classList.add('was-validated');
};

function validateIdentificationPassword() {
  const input = document.getElementById('password');
  const valid1 = document.getElementById('passwordValid1');
  const invalid1 = document.getElementById('passwordInvalid1');
  const invalid2 = document.getElementById('passwordInvalid2');
  const invalid3 = document.getElementById('passwordInvalid3');
  const invalid4 = document.getElementById('passwordInvalid4');
  const invalid5 = document.getElementById('passwordInvalid5');
  const invalid6 = document.getElementById('passwordInvalid6');

    // Reset all error messages
    valid1.style.display = 'none';
    invalid1.style.display = 'none';
    invalid2.style.display = 'none';
    invalid3.style.display = 'none';
    invalid4.style.display = 'none';
    invalid5.style.display = 'none';
    invalid6.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid1.style.display = 'block';
    }
    else if (input.value.length < 7) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid2.style.display = 'block';
    }
    else if (!input.value.match(/[a-z]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid3.style.display = 'block';
    }
    else if (!input.value.match(/[A-Z]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid4.style.display = 'block';
    }
    else if (!input.value.match(/[0-9]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid5.style.display = 'block';
    }
    else if (!input.value.match(/[^a-zA-Z0-9]/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid6.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid1.style.display = 'block';
    }
    
    input.classList.add('was-validated');

    validateIdentificationPasswordConfirmation();
};


function validateIdentificationPasswordConfirmation() {
  const input = document.getElementById('password_confirmation');
  const confirmation = document.getElementById('password');
  const valid1 = document.getElementById('password_confirmationValid1');
  const invalid1 = document.getElementById('password_confirmationInvalid1');
  const invalid2 = document.getElementById('password_confirmationInvalid2');

    // Reset all error messages
    valid1.style.display = 'none';
    invalid1.style.display = 'none';
    invalid2.style.display = 'none';
    
    // Basic validation logic
    if (!confirmation.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid1.style.display = 'block';
    }
    else if (input.value !== confirmation.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid2.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid1.style.display = 'block';
    }
    
    input.classList.add('was-validated');
};

function checkedbox(me) {
  // Get the checkbox
  var checkBox = me;
  // Get the output text
  var text = document.getElementById("selected" + me.id);

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}