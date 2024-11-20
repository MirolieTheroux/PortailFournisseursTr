//Get elements in /users/edit

document.addEventListener("DOMContentLoaded", function () {
    addContactDetailsSaveListeners();
});
  
function addContactDetailsSaveListeners(){
    btnSaveUsers.addEventListener('click', saveUsers);
}
  
function saveUsers(event){
  const currentSectionErrors = showUsersContainer.querySelectorAll(".invalid-feedback");
  currentSectionErrors.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      event.preventDefault();
    }
  });
}