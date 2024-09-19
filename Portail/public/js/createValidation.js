function validateIdentification() {
    const input = document.getElementById('email');
    const valid = document.getElementById('neqValid');
    const invalid1 = document.getElementById('neqInvalid1');
    const invalid2 = document.getElementById('neqInvalid1');

    // Reset all error messages
    invalid1.style.display = 'none';
    invalid2.style.display = 'none';
    
    // Basic validation logic
    if (!input.value) {
      error1.style.display = 'block';
      input.classList.add('is-invalid');
    } else if (input.value.length < 5) {
      error2.style.display = 'block';
      input.classList.add('is-invalid');
    } else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
    }

    input.classList.add('was-validated');
  };