//Get elements in /suppliers/show/contactDetails/edit

document.addEventListener("DOMContentLoaded", function () {
    addContactDetailsSaveListeners();
});
  
function addContactDetailsSaveListeners(){
  if(btnSaveContactDetails)
    btnSaveContactDetails.addEventListener('click', saveContactDetails);
}
  
function saveContactDetails(event){
  validateContactDetailsAll();
  const currentSectionErrors = contactDetailsContainer.querySelectorAll(".invalid-feedback");
  
  currentSectionErrors.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      event.preventDefault();
    }
  });
}