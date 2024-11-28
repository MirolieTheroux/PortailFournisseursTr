//Get elements in /settings/edit

function validateEmailInput(input, errorEmpty, errorFormat) {
  const regex = /^([-!#-'*+/-9=?A-Z^-~]+(\.[-!#-'*+/-9=?A-Z^-~]+)*|"([]!#-[^-~ \t]|(\\[\t -~]))+")@[0-9A-Za-z]([0-9A-Za-z-]{0,61}[0-9A-Za-z])?(\.[0-9A-Za-z]([0-9A-Za-z-]{0,61}[0-9A-Za-z])?)+$/g;
  errorEmpty.style.display = 'none';
  errorFormat.style.display = 'none';
  
  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    errorEmpty.style.display = 'block';
  }
  else if (!input.value.match(regex)) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    errorFormat.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }
  input.classList.add('was-validated');
};

function validateNumericInput(input, errorEmpty, errorFormat){
  errorEmpty.style.display = 'none';
  errorFormat.style.display = 'none';
  
  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    errorEmpty.style.display = 'block';
  }
  else if (isNaN(input.value)) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    errorFormat.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }
  input.classList.add('was-validated');
};
