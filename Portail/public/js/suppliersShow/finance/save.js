//Get elements in /suppliers/show/rbq/edit
let formFinance

document.addEventListener("DOMContentLoaded", function () {
  addFinanceSaveListeners();
});

function addFinanceSaveListeners(){
  formFinance = document.querySelector("#finances-section form");
  formFinance.addEventListener("submit", async (event)=>{
    event.preventDefault();

    validateFinanceAll();

    const currentSectionErrors = financeContainer.querySelectorAll(".invalid-feedback");
    
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