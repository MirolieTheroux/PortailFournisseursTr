/*** Section Licence RBQ ***/
document.addEventListener('DOMContentLoaded', function() {
  const entrepreneurContainer = document.getElementById('entrepreneur-categories');
  const ownerBuilderContainer = document.getElementById('ownerBuilder-categories');
  const typeRbqSelect = document.getElementById('typeRbq');

  typeRbqSelect.addEventListener('change', function(event) {
      console.log(typeRbqSelect.value)
      if(typeRbqSelect.value === 'entrepreneur'){
        ownerBuilderContainer.classList.add('d-none'); 
        ownerBuilderContainer.classList.remove('d-block');

        entrepreneurContainer.classList.add('d-block'); 
        entrepreneurContainer.classList.remove('d-none'); 
      }
      else if(typeRbqSelect.value === 'ownerBuilder'){ 
        entrepreneurContainer.classList.add('d-none'); 
        entrepreneurContainer.classList.remove('d-block'); 
        
        ownerBuilderContainer.classList.add('d-block'); 
        ownerBuilderContainer.classList.remove('d-none'); 
      }
      else{
        entrepreneurContainer.classList.add('d-none'); 
        entrepreneurContainer.classList.remove('d-block'); 
        ownerBuilderContainer.classList.add('d-none'); 
        ownerBuilderContainer.classList.remove('d-block');
      }
  });
});