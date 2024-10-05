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

function validateContactsPhone(id) {
  const input = document.getElementById(id);
  const parentDiv = input.closest(".phone-container");
  const invalidRequiredMessage = parentDiv.querySelector('.phoneInvalidRequired');
  const invalidNumberMessage = parentDiv.querySelector('.phoneInvalidNumber');

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidNumberMessage.style.display = 'none';

  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if(isNaN(input.value)){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidNumberMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
};

function validateContactsExtension(id) {
    const input = document.getElementById(id);
    const parentDiv = input.closest(".phone-container");
    const invalidNumberMessage = parentDiv.querySelector('.phoneInvalidExtension');

    // Reset all error messages
    invalidNumberMessage.style.display = 'none';

    // Basic validation logic
    if (isNaN(input.value)) {
      input.classList.remove('is-valid');
      input.classList.add('is-invalid');
      invalidNumberMessage.style.display = 'block';
    }
    else if(!input.value){
        input.classList.remove('is-invalid');
        input.classList.remove('is-valid');
    }
    else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
    }

    input.classList.add('was-validated');
  };
