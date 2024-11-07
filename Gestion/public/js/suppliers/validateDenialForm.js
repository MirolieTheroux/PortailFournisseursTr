let denialForm;
let txtAreaDeniedReason;
let denialReasonRequiredError;

document.addEventListener("DOMContentLoaded", function () {
  getDenialElements();
  addDenialListener();
});

function getDenialElements(){
  denialForm = document.getElementById('denialForm');
  txtAreaDeniedReason = document.getElementById('deniedReason');
  denialReasonRequiredError = document.getElementById('denialReasonRequiredError');
}

function addDenialListener(){
  denialForm.addEventListener('submit', validateReason)
}

function validateReason(event){
  if(!txtAreaDeniedReason.value){
    event.preventDefault();
    
    txtAreaDeniedReason.classList.add('is-invalid');
    txtAreaDeniedReason.classList.add('was-validated');
    denialReasonRequiredError.style.display = 'block';
  }
}