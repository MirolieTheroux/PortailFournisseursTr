function validateIdentificationNeq() {
  const input = document.getElementById('neq');
  const valid1 = document.getElementById('neqValid1');
  const valid2 = document.getElementById('neqValid2');
  const invalid1 = document.getElementById('neqInvalid1');
  const invalid2 = document.getElementById('neqInvalid2');
  const invalid3 = document.getElementById('neqInvalid3');
  const invalid4 = document.getElementById('neqInvalid4');
  const invalid5 = document.getElementById('neqInvalid5');
    // Reset all error messages
    valid1.style.display = 'none';
    valid2.style.display = 'none';
    invalid1.style.display = 'none';
    invalid2.style.display = 'none';
    invalid3.style.display = 'none';
    invalid4.style.display = 'none';
    invalid5.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid1.style.display = 'block';
    }
    else if (!input.value.match(/^11|22|33|88/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid1.style.display = 'block';
    }
    else if (!input.value.match(/^..(4|5|6|7|8|9)/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid2.style.display = 'block';
    }
    else if (input.value.match(/\D/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid3.style.display = 'block';
    }
    else if (input.value.length !== 10) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid4.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid2.style.display = 'block';
    }
    
    //TODO Le NEQ est déjà enregistrer pour un autre compte!

    input.classList.add('was-validated');
};

function validateIdentificationName() {
  const input = document.getElementById('name');
  const valid1 = document.getElementById('nameValid1');
  const invalid1 = document.getElementById('nameInvalid1');
    // Reset all error messages
    valid1.style.display = 'none';
    invalid1.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid1.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid1.style.display = 'block';
    }
    
    input.classList.add('was-validated');
};

function validateIdentificationEmail() {
  const input = document.getElementById('email');
  const valid1 = document.getElementById('emailValid1');
  const invalid1 = document.getElementById('emailInvalid1');
  const invalid2 = document.getElementById('emailInvalid2');
  const invalid3 = document.getElementById('emailInvalid3');
  const invalid4 = document.getElementById('emailInvalid4');
    // Reset all error messages
    valid1.style.display = 'none';
    invalid1.style.display = 'none';
    invalid2.style.display = 'none';
    invalid3.style.display = 'none';
    invalid4.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid1.style.display = 'block';
    }
    else if (input.value.match(/^@/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid2.style.display = 'block';
    }
    else if (!input.value.match(/@/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid3.style.display = 'block';
    }
    else if (input.value.match(/@$/)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalid4.style.display = 'block';
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      valid1.style.display = 'block';
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