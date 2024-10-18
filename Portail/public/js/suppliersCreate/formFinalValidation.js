document.getElementById("form").addEventListener("submit", (event) => {validatateAll(event);});



function validatateAll(event){

  let isFormInvalid = false;
  for( let i = 0; i < allSections.length; i++){
    const buttonValidation = allSections[i].querySelector(".next-button");
    if(buttonValidation !== null )
      buttonValidation.click();
    const inputs = allSections[i].querySelectorAll(".form-control");
    let isInvalid = false;
    inputs.forEach(input => {
      if (input.classList.contains("is-invalid"))
        isInvalid = true;
    });
    if(isInvalid){
      progressBarSteps[i].classList.add("section-invalid");
      progressBarSteps[i].classList.remove("section-valid");
      isFormInvalid = true;
    }
    else{
      progressBarSteps[i].classList.remove("section-invalid");
      progressBarSteps[i].classList.add("section-valid");
    }
      
  }
  if(isFormInvalid) {
    event.preventDefault();
  }
} 

