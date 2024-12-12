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
  const iconValidCircle = step.querySelector('.icon-valid-circle');
  const iconInvalidCircle = step.querySelector('.icon-invalid-circle');
  const icon = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
      <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z"/>
    </svg>`;
  step.querySelector('.icon-valid').innerHTML = icon;
  iconValidCircle.classList.remove('d-none'); 
  iconInvalidCircle.classList.add('d-none'); 
}

function addErrorIcon(stepIndex) {
  const step = progressBarSteps[stepIndex];
  const iconInvalidCircle = step.querySelector('.icon-invalid-circle');
  const iconValidCircle = step.querySelector('.icon-valid-circle');
  const icon = `
  <svg fill="white" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z"/>
  </svg>`;
  step.querySelector('.icon-invalid').innerHTML = icon;
  iconInvalidCircle.classList.remove('d-none'); 
  iconValidCircle.classList.add('d-none'); 
}

