// let inputLicenceRbq;
// let selectStatusRbq;
// let selectTypeRbq;
// let subcategorieContainerRbq;
// let subcategoriesCheckBoxesRbq;

// document.addEventListener("DOMContentLoaded", function () {
//   addRbqValidationListeners();
// });

// function addRbqValidationListeners(){
//   inputLicenceRbq = document.getElementById("licenceRbq");
//   inputLicenceRbq.addEventListener('input', validateRbqLicence);

//   selectStatusRbq = document.getElementById("statusRbq");
//   selectStatusRbq.addEventListener('change', validateRbqStatus);

//   selectTypeRbq = document.getElementById("typeRbq");
//   selectTypeRbq.addEventListener('change', validateRbqType);

//   subcategorieContainerRbq = document.getElementById("subcategories-container");
//   subcategoriesCheckBoxesRbq = subcategorieContainerRbq.getElementsByClassName("rbq-subcategories-check");
//   selectTypeRbq.addEventListener('change', validateRbqType);
//   for(let checkbox of subcategoriesCheckBoxesRbq){
//     checkbox.addEventListener('click', validateRbqCategories);
//   }
// }

// function validateRbqLicence() {
//   const parentDiv = inputLicenceRbq.parentElement;
//   const invalidNumberMessage = parentDiv.querySelector('.licenceInvalidNumber');
//   const invalidSizeMessage = parentDiv.querySelector('.licenceInvalidSize');

//   // Reset all error messages
//   invalidNumberMessage.style.display = 'none';
//   invalidSizeMessage.style.display = 'none';

//   // Basic validation logic
//   if (isNaN(inputLicenceRbq.value)) {
//     inputLicenceRbq.classList.remove('is-valid');
//     inputLicenceRbq.classList.add('is-invalid');
//     invalidNumberMessage.style.display = 'block';
//   }
//   else if(!inputLicenceRbq.value){
//     inputLicenceRbq.classList.remove('is-invalid');
//     inputLicenceRbq.classList.remove('is-valid');
//   }
//   else if(inputLicenceRbq.value.length !== 10){
//     inputLicenceRbq.classList.remove('is-valid');
//     inputLicenceRbq.classList.add('is-invalid');
//     invalidSizeMessage.style.display = 'block';
//   }
//   else {
//     inputLicenceRbq.classList.remove('is-invalid');
//     inputLicenceRbq.classList.add('is-valid');
//   }

//   inputLicenceRbq.classList.add('was-validated');
//   validateRbqStatus();
//   validateRbqType();
//   validateRbqCategories();
// }

// function validateRbqStatus() {
//   const parentDiv = selectStatusRbq.parentElement;
//   const invalidStatusRequired = parentDiv.querySelector('.statusInvalidRequired');
//   const invalidStatusRequiredNot = parentDiv.querySelector('.statusInvalidRequiredNot');

//   // Reset all error messages
//   invalidStatusRequired.style.display = 'none';
//   invalidStatusRequiredNot.style.display = 'none';

//   // Basic validation logic
//   if(inputLicenceRbq.value){
//     if(!selectStatusRbq.value){
//       selectStatusRbq.classList.remove('is-valid');
//       selectStatusRbq.classList.add('is-invalid');
//       invalidStatusRequired.style.display = 'block';
//     }
//     else{
//       selectStatusRbq.classList.remove('is-invalid');
//       selectStatusRbq.classList.add('is-valid');
//     }
//   }
//   else{
//     if(selectStatusRbq.value){
//       selectStatusRbq.classList.remove('is-valid');
//       selectStatusRbq.classList.add('is-invalid');
//       invalidStatusRequiredNot.style.display = 'block';
//     }
//     else{
//       selectStatusRbq.classList.remove('is-invalid');
//       selectStatusRbq.classList.add('is-valid');
//     }
//   }

//   selectStatusRbq.classList.add('was-validated');
// }

// function validateRbqType() {
//   const parentDiv = selectTypeRbq.parentElement;
//   const invalidTypeRequired = parentDiv.querySelector('.typeInvalidRequired');
//   const invalidTypeRequiredNot = parentDiv.querySelector('.typeInvalidRequiredNot');

//   // Reset all error messages
//   invalidTypeRequired.style.display = 'none';
//   invalidTypeRequiredNot.style.display = 'none';

//   // Basic validation logic
//   if(inputLicenceRbq.value){
//     if(!selectTypeRbq.value){
//       selectTypeRbq.classList.remove('is-valid');
//       selectTypeRbq.classList.add('is-invalid');
//       invalidTypeRequired.style.display = 'block';
//     }
//     else{
//       selectTypeRbq.classList.remove('is-invalid');
//       selectTypeRbq.classList.add('is-valid');
//     }
//   }
//   else{
//     if(selectTypeRbq.value){
//       selectTypeRbq.classList.remove('is-valid');
//       selectTypeRbq.classList.add('is-invalid');
//       invalidTypeRequiredNot.style.display = 'block';
//     }
//     else{
//       selectTypeRbq.classList.remove('is-invalid');
//       selectTypeRbq.classList.add('is-valid');
//     }
//   }

//   selectTypeRbq.classList.add('was-validated');
// }

// function validateRbqCategories(){
//   const parentDiv = subcategorieContainerRbq.parentElement;
//   const invalidSubcategorieRequired = parentDiv.querySelector('.subcategorieInvalidRequired');
//   const invalidSubcategorieRequiredNot = parentDiv.querySelector('.subcategorieInvalidRequiredNot');

//   // Reset all error messages
//   invalidSubcategorieRequired.style.display = 'none';
//   invalidSubcategorieRequiredNot.style.display = 'none';

//   let subcategorieFound = false;

//   for(let checkbox of subcategoriesCheckBoxesRbq){
//     if(checkbox.checked){
//       subcategorieFound = true;
//     }
//   }
//   if(inputLicenceRbq.value){
//     if(subcategorieFound){
//       subcategorieContainerRbq.classList.remove('is-invalid');
//       subcategorieContainerRbq.classList.add('is-valid');
//     }
//     else{
//       subcategorieContainerRbq.classList.remove('is-valid');
//       subcategorieContainerRbq.classList.add('is-invalid');
//       invalidSubcategorieRequired.style.display = 'block';
//     }
//   }
//   else{
//     if(subcategorieFound){
//       subcategorieContainerRbq.classList.remove('is-valid');
//       subcategorieContainerRbq.classList.add('is-invalid');
//       invalidSubcategorieRequiredNot.style.display = 'block';
//     }
//     else{
//       subcategorieContainerRbq.classList.remove('is-invalid');
//       subcategorieContainerRbq.classList.add('is-valid');
//     }
//   }
// }

// function validateRbqAll(){
//   validateRbqLicence();
//   validateRbqStatus();
//   validateRbqType();
//   validateRbqCategories();
// }