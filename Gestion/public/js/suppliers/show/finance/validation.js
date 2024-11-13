let inputFinanceTps;
let inputFinanceTvq;
let selectFinancePaimentCondition;
let checkFinanceCurrencyCAD;
let checkFinanceCurrencyUSD;
let checkFinanceCommunicationModeEmail;
let checkFinanceCommunicationModeMail;

document.addEventListener("DOMContentLoaded", function () {
  addFinanceValidationListeners();
});

function addFinanceValidationListeners(){
  inputFinanceTps = document.getElementById("financesTps");
  inputFinanceTps.addEventListener('blur', validateTps);

  inputFinanceTvq = document.getElementById("financesTvq");
  inputFinanceTvq.addEventListener('blur', validateTvq);

  selectFinancePaimentCondition = document.getElementById("financesPaymentConditions");
  selectFinancePaimentCondition.addEventListener('change', validateFinancePaymentCondition);

  checkFinanceCurrencyCAD = document.getElementById("flexRadioCAD");
  checkFinanceCurrencyCAD.addEventListener('click', validateFinanceCurrency);

  checkFinanceCurrencyUSD = document.getElementById("flexRadioUS");
  checkFinanceCurrencyUSD.addEventListener('click', validateFinanceCurrency);

  checkFinanceCommunicationModeEmail = document.getElementById("flexRadioEmail");
  checkFinanceCommunicationModeEmail.addEventListener('change', validateFinanceCommunationMode);

  checkFinanceCommunicationModeMail = document.getElementById("flexRadioMail");
  checkFinanceCommunicationModeMail.addEventListener('change', validateFinanceCommunationMode);
}

function validateTps() {
  const parentDiv = inputFinanceTps.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.tpsInvalidRequired');
  const invalidFormatMessage = parentDiv.querySelector('.tpsInvalidFormat');

  const regexTps = /^\d{9}RT\d{4}$/;

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidFormatMessage.style.display = 'none';

  // Basic validation logic
  if(!inputFinanceTps.value){
    inputFinanceTps.classList.remove('is-valid');
    inputFinanceTps.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if(!inputFinanceTps.value.match(regexTps)){
    inputFinanceTps.classList.remove('is-valid');
    inputFinanceTps.classList.add('is-invalid');
    invalidFormatMessage.style.display = 'block';
  }
  else {
    inputFinanceTps.classList.remove('is-invalid');
    inputFinanceTps.classList.add('is-valid');
  }

  inputFinanceTps.classList.add('was-validated');
}

function validateTvq() {
  const parentDiv = inputFinanceTvq.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.tvqInvalidRequired');
  const invalidFormatMessage = parentDiv.querySelector('.tvqInvalidFormat');

  const regexTvqNumber = /^\d{10}$/;
  const regexTvqTQ = /^\d{10}TQ\d{4}$/;
  const regexTvqNR = /^NR\d{8}$/;

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidFormatMessage.style.display = 'none';

  // Basic validation logic
  if(!inputFinanceTvq.value){
    inputFinanceTvq.classList.remove('is-valid');
    inputFinanceTvq.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if(!(inputFinanceTvq.value.match(regexTvqNumber)||inputFinanceTvq.value.match(regexTvqTQ)||inputFinanceTvq.value.match(regexTvqNR))){
    inputFinanceTvq.classList.remove('is-valid');
    inputFinanceTvq.classList.add('is-invalid');
    invalidFormatMessage.style.display = 'block';
  }
  else {
    inputFinanceTvq.classList.remove('is-invalid');
    inputFinanceTvq.classList.add('is-valid');
  }

  inputFinanceTvq.classList.add('was-validated');
}

function validateFinancePaymentCondition() {
  const parentDiv = selectFinancePaimentCondition.parentElement;
  const invalidStatusRequired = parentDiv.querySelector('.paymentInvalidRequired');

  // Reset all error messages
  invalidStatusRequired.style.display = 'none';

  // Basic validation logic
  if(!selectFinancePaimentCondition.value){
    selectFinancePaimentCondition.classList.remove('is-valid');
    selectFinancePaimentCondition.classList.add('is-invalid');
    invalidStatusRequired.style.display = 'block';
  }
  else{
    selectFinancePaimentCondition.classList.remove('is-invalid');
    selectFinancePaimentCondition.classList.add('is-valid');
  }

  selectFinancePaimentCondition.classList.add('was-validated');
}

function validateFinanceCurrency(){
  const parentDiv = document.getElementById('currencyRadios');
  const currencyInvalidRequired = parentDiv.querySelector('.currencyInvalidRequired');

  // Reset all error messages
  currencyInvalidRequired.style.display = 'none';

  if(!(checkFinanceCurrencyCAD.checked || checkFinanceCurrencyUSD.checked)){
    currencyInvalidRequired.style.display = 'block';
  }
}

function validateFinanceCommunationMode(){
  const parentDiv = document.getElementById('commnucationModeRadios');
  const currencyInvalidRequired = parentDiv.querySelector('.communicationModeInvalidRequired');

  // Reset all error messages
  currencyInvalidRequired.style.display = 'none';

  if(!(checkFinanceCommunicationModeEmail.checked || checkFinanceCommunicationModeMail.checked)){
    currencyInvalidRequired.style.display = 'block';
  }
}

function validateFinanceAll(){
  validateTps();
  validateTvq();
  validateFinancePaymentCondition();
  validateFinanceCurrency();
  validateFinanceCommunationMode();
}