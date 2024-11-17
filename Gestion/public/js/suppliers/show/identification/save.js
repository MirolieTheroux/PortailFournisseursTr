//Get elements in /suppliers/show/contacts/edit

document.addEventListener("DOMContentLoaded", function () {
  addIdSaveListeners();
});

function addIdSaveListeners(){
  formIdentification = document.querySelector("#identification-section form");
  formIdentification.addEventListener("submit", async (event)=>{
    event.preventDefault();
    let response = await validateIdentificationAll();

    const currentSectionErrors = idContainer.querySelectorAll(".invalid-feedback");
    
    let errors = false;
    currentSectionErrors.forEach(errorMessage => {
      if (errorMessage.style.display == "block") {
        errors = true;
      }
    });

    if(!errors){
      event.target.submit();
    }
  ;});
}










