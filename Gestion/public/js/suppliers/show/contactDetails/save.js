//Get elements in /suppliers/show/contactDetails/edit

document.addEventListener("DOMContentLoaded", function () {
    addContactDetailsSaveListeners();
  });
  
  function addContactDetailsSaveListeners(){
    btnSaveContactDetails.addEventListener('click', saveContactDetails);
  }
  
  function saveContactDetails(event){
    validateContactDetailsAll();
  
    const currentSectionErrors = contactDetailsContainer.querySelectorAll(".invalid-feedback");
    
    currentSectionErrors.forEach(errorMessage => {
      console.log("Test invalid input");
      if (errorMessage.style.display == "block") {
        console.log("Test invalid input visible");
        event.preventDefault();
      }
    });
  }