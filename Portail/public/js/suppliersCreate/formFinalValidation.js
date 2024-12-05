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
    const iconContainer = progressStep.querySelector(".icon-valid");

    if (isInvalid) {
      progressStep.classList.add("section-invalid");
      progressStep.classList.remove("section-valid");
      isFormInvalid = true;

      if (iconContainer) {
        iconContainer.innerHTML = `
          <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20" fill="white">
            <path d="M16,8a1,1,0,0,0-1.414,0L12,10.586,9.414,8A1,1,0,0,0,8,9.414L10.586,12,8,14.586A1,1,0,0,0,9.414,16L12,13.414,14.586,16A1,1,0,0,0,16,14.586L13.414,12,16,9.414A1,1,0,0,0,16,8Z"/>
            <path d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z"/>
          </svg>`;
      }
    } else {
      progressStep.classList.remove("section-invalid");
      progressStep.classList.add("section-valid");

      if (iconContainer) {
        iconContainer.innerHTML = `
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
            <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z"/>
          </svg>`;
      }
    }
  }

  if (isFormInvalid) {
    event.preventDefault();
  }
}
