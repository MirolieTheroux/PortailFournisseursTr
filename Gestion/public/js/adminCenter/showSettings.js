let containerNavigationSettings;
let divsMenuSettings;
let lastClickedDiv = null;
let sectionsSettings;
let iconsNav; 
let iconsNavClicked;

document.addEventListener("DOMContentLoaded", function () {
  getElementsNav();
  navigationMenu();
});

function getElementsNav(){
  containerNavigationSettings = document.getElementsByClassName("left-nav")[0];
  divsMenuSettings = containerNavigationSettings.children;
  sectionsSettings = document.getElementsByClassName("show-section");
  iconsNav = document.querySelectorAll("svg:not(.section-clicked)");
  iconsNavClicked = document.querySelectorAll(".section-clicked");
}

function showSettingsSection(id){
  for (let i = 0; i < sectionsSettings.length; i++) {
    sectionsSettings[i].classList.add("d-none");
  }
  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");
}

function navigationMenu(){
  const sectionFromUrl = window.location.hash.substring(1);
  if (sectionFromUrl) {
    showSettingsSection(sectionFromUrl);  
  }
  for (let i = 0; i < divsMenuSettings.length; i++) {
    divsMenuSettings[i].addEventListener("click", () =>{
      if(lastClickedDiv){
        lastClickedDiv.classList.remove("bg-gray")
      }
      lastClickedDiv = divsMenuSettings[i];
      divsMenuSettings[i].classList.add("bg-gray");
      divsMenuSettings[i].style.cursor = "pointer";
     showSettingsSection(divsMenuSettings[i].id.replace("-nav-button", "-section"));
     settingClicked(divsMenuSettings[i]);
    })
  }
}

function settingClicked(div){
  iconsNavClicked.forEach(icon =>{
    icon.style.fill = "#0B2341";
    icon.classList.add("d-none");
  })
  iconsNav.forEach(icon =>{
    icon.classList.remove("d-none");
  })
  const clickedIcon = div.querySelector(".section-clicked");
  const defaultIcon = div.querySelector("svg:not(.section-clicked)");
  if (clickedIcon && defaultIcon) {
    clickedIcon.classList.toggle("d-none");
    defaultIcon.classList.toggle("d-none");
  }
}