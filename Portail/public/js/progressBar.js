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
    nextButton.addEventListener("click", () => {
      if (isSectionValid(currentStep) && (currentStep < steps.length - 1)) {
        steps[currentStep].classList.remove("current");
        progressBarSteps[currentStep].classList.remove("section-invalid");
        progressBarSteps[currentStep].classList.add("section-valid");
        currentStep++;  
        steps[currentStep].classList.add("current");
        showSectionForm(currentStep);
      }
      else{
        progressBarSteps[currentStep].classList.add("section-invalid");
        progressBarSteps[currentStep].classList.remove("section-valid");
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

document.addEventListener("DOMContentLoaded", function () {
  getSectionsForm();
  showSectionForm(currentStep); 
  nextSectionButton();
  previousSectionButton();
  navigationProgressBar();
});
