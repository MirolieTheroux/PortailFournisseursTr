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
    

    input.classList.add('was-validated');
};