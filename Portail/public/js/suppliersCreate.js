/*** Section Licence RBQ ***/
document.addEventListener('DOMContentLoaded', function() {
  const entrepreneurContainer = document.getElementById('entrepreneur-categories');
  const ownerBuilderContainer = document.getElementById('ownerBuilder-categories');
  const noCategoriesContainer = document.getElementById('no-categories');
  const typeRbqSelect = document.getElementById('typeRbq');
  const checkboxes = document.querySelectorAll('input.form-check-input');

  typeRbqSelect.addEventListener('change', function(event) {
      if(typeRbqSelect.value === 'entrepreneur'){
        ownerBuilderContainer.classList.add('d-none'); 
        ownerBuilderContainer.classList.remove('d-block');
        noCategoriesContainer.classList.add('d-none'); 
        noCategoriesContainer.classList.remove('d-block');
        entrepreneurContainer.classList.add('d-block'); 
        entrepreneurContainer.classList.remove('d-none'); 
      }
      else if(typeRbqSelect.value === 'ownerBuilder'){ 
        entrepreneurContainer.classList.add('d-none'); 
        entrepreneurContainer.classList.remove('d-block'); 
        noCategoriesContainer.classList.add('d-none'); 
        noCategoriesContainer.classList.remove('d-block');
        ownerBuilderContainer.classList.add('d-block'); 
        ownerBuilderContainer.classList.remove('d-none'); 
      }
      else{
        entrepreneurContainer.classList.add('d-none'); 
        entrepreneurContainer.classList.remove('d-block'); 
        ownerBuilderContainer.classList.add('d-none'); 
        ownerBuilderContainer.classList.remove('d-block');
        noCategoriesContainer.classList.add('d-block'); 
        noCategoriesContainer.classList.remove('d-none');
      }
      checkboxes.forEach(checkbox => {
        checkbox.checked  = false;
      });
  });
});