//Get elements in /settings/edit
document.addEventListener("DOMContentLoaded", function () {
    addSettingsSaveListeners();
});
  
function addSettingsSaveListeners(){
    btnSaveSettings.addEventListener('click', saveSettings);
}
  
function saveSettings(event){
  const currentSectionErrors = settingsContainer.querySelectorAll(".invalid-feedback");
  console.log(currentSectionErrors);
  currentSectionErrors.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      event.preventDefault();
    }
  });
}