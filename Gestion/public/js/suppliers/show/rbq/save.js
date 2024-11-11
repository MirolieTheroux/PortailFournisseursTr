//Get elements in /suppliers/show/rbq/edit

document.addEventListener("DOMContentLoaded", function () {
  addRbqSaveListeners();
});

function addRbqSaveListeners(){
  formRbq = document.querySelector("#licence-section form");
  formRbq.addEventListener("submit", async (event)=>{
    event.preventDefault();

    validateRbqAll();

    const currentSectionErrors = rbqContainer.querySelectorAll(".invalid-feedback");
    
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