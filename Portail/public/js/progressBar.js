const identificationSection = document.getElementById("identification-section");
const contactDetailsSection = document.getElementById("contactDetails-section");
const contactsSection = document.getElementById("contacts-section");
const productsServicesSection = document.getElementById("productsServices-section");
const licenceSection = document.getElementById("licence-section");
const attachmentsSection = document.getElementById("attachments-section");
const progressBarSteps = document.getElementById("progressBar").children;

const allSections = [
  identificationSection, 
  contactDetailsSection,
  contactsSection, 
  productsServicesSection, 
  licenceSection, 
  attachmentsSection, 
];

let sectionsProgressBar;
let sectionsForm;
let nextButtons;
let previousButtons;
let steps;
let errorMessages;
let isValidated;
let currentStep = 0;

document.addEventListener("DOMContentLoaded", function () {
  getSectionsForm();
  showSectionForm(currentStep); 
  nextSectionButton();
  previousSectionButton();
  navigationProgressBar();
});

function getSectionsForm() {
  sectionsForm = document.querySelectorAll(".form-section");
  nextButtons = document.querySelectorAll(".next-button");
  previousButtons = document.querySelectorAll(".previous-button");
  steps = document.querySelectorAll(".arrow-steps .step");
  errorMessages = document.querySelectorAll(".invalid-feedback");
  isValidated = document.querySelectorAll(".was-validated")
  sectionsProgressBar = document.querySelectorAll(".clickFleche"); 
}

function showSectionForm(index) {
  allSections.forEach(section => section.classList.add("d-none"));
  allSections[index].classList.remove("d-none");
  steps.forEach(step => step.classList.remove("current"));
  steps[index].classList.add("current");
}

function isSectionValid(index) {
  const currentSection = allSections[index];
  const currentSectionErrors = currentSection.querySelectorAll(".invalid-feedback");
  let isValid = true;
  
  currentSectionErrors.forEach(errorMessage => {
    if (errorMessage.style.display == "block" && !(errorMessage.id == "invalidRequiredPhoneNumber" || errorMessage.id == "invalidPhoneNumberNumeric" || errorMessage.id == "invalidPhoneNumberFormat" || errorMessage.id == "invalidPhoneExtension" || errorMessage.id == "invalidPhoneExtensionLength" || errorMessage.id == "invalidAddPhoneNumber")) {
      isValid = false;
    }
  });
  return isValid;
}

function nextSectionButton(){
  nextButtons.forEach((nextButton) => {
    nextButton.addEventListener("click", async () => {
      if(nextButton.id == "identification-button"){
        let response = await validateIdentificationAll();
      }
      if (isSectionValid(currentStep) && (currentStep < steps.length)) {
        progressBarSteps[currentStep].classList.remove("section-invalid");
        progressBarSteps[currentStep].classList.add("section-valid");
        addValidationIcon(currentStep);
        currentStep++;  
        steps[currentStep].classList.add("current");
        showSectionForm(currentStep);
      }
      else{
        progressBarSteps[currentStep].classList.add("section-invalid");
        progressBarSteps[currentStep].classList.remove("section-valid");
        addErrorIcon(currentStep);
      }
    });
  });
}

function previousSectionButton(){
  previousButtons.forEach((previousButton) => {
    previousButton.addEventListener("click", () => {
      if (currentStep > 0) {
        steps[currentStep].classList.remove("current");
        currentStep--;
        steps[currentStep].classList.add("current");
        showSectionForm(currentStep);
      }
    });
  });
}

function navigationProgressBar(){
  sectionsProgressBar.forEach((section, index) => {
    section.addEventListener("click", () => {
      if (index > currentStep) {
        currentStep = index; 
        showSectionForm(currentStep); 
      
      } else {
        currentStep = index;
        showSectionForm(currentStep);
      }
    });
  });
}

function addValidationIcon(stepIndex) {
  const step = progressBarSteps[stepIndex];
  const icon = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
      <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z"/>
    </svg>`;
  step.querySelector('.icon-valid').innerHTML = icon;
}

function addErrorIcon(stepIndex) {
  const step = progressBarSteps[stepIndex];
  const icon = `
    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20" fill="white"><path d="M16,8a1,1,0,0,0-1.414,0L12,10.586,9.414,8A1,1,0,0,0,8,9.414L10.586,12,8,14.586A1,1,0,0,0,9.414,16L12,13.414,14.586,16A1,1,0,0,0,16,14.586L13.414,12,16,9.414A1,1,0,0,0,16,8Z"/>
    <path d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z"/>
    </svg>`;
  step.querySelector('.icon-invalid').innerHTML = icon;
}