document.getElementById("form").addEventListener("submit", (event) => {
  validatateAll(event);
});

function validatateAll(event) {
  let isFormInvalid = false;

  for (let i = 0; i < allSections.length; i++) {
    const buttonValidation = allSections[i].querySelector(".next-button");

    if (buttonValidation !== null) buttonValidation.click();

    const inputs = allSections[i].querySelectorAll(".form-control");
    let isInvalid = false;

    inputs.forEach(input => {
      if (input.classList.contains("is-invalid")) isInvalid = true;
    });

    const progressStep = progressBarSteps[i];
    const iconInvalid = progressStep.querySelector(".icon-invalid"); 
    const iconValid = progressStep.querySelector(".icon-valid"); 
    const iconInvalidCircle = progressStep.querySelector(".icon-invalid-circle");
    const iconValidCircle = progressStep.querySelector(".icon-valid-circle");

    if (isInvalid) {
      progressStep.classList.add("section-invalid");
      progressStep.classList.remove("section-valid");
      isFormInvalid = true;

      if (iconInvalid) {
        iconInvalid.innerHTML = `
        <svg fill="white" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z"/>
        </svg>`;
      }

      if (iconInvalidCircle) {
        iconInvalidCircle.classList.remove('d-none'); 
        iconValidCircle.classList.add('d-none');  
      }
    } else {
      progressStep.classList.remove("section-invalid");
      progressStep.classList.add("section-valid");

      if (iconValid) {
        iconValid.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z"/>
        </svg>`;
      }

      if (iconValidCircle) {
        iconValidCircle.classList.remove('d-none');  
        iconInvalidCircle.classList.add('d-none');  
      }
    }
  }

  if (isFormInvalid) {
    event.preventDefault();
  }
}
