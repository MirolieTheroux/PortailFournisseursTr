let navSectionsDivs;
let lastClickedDiv = null; 

document.addEventListener("DOMContentLoaded", function () {
  getSectionsInfo();
});
// NAVIGATE SECTIONS FORM
function getSectionsInfo() {
  const navSectionsDivs = document.querySelectorAll(".nav-button");
  const mobileNavButtons = document.querySelectorAll(".mobile-icon-svg");
  const sectionFromUrl = window.location.hash.substring(1);

  if (sectionFromUrl) {
    showSectionDoc(sectionFromUrl);
    const sectionNavto = sectionFromUrl.split('-')[0];
    const sectionNavButton = document.getElementById(sectionNavto + '-nav-button');
    const sectionMobileButton = document.getElementById(sectionNavto + '-nav-mobile');
    
    if (window.innerWidth >= 920) {
      changeSVGFill(sectionNavButton);
      sectionNavButton.classList.add("bg-gray"); 
      lastClickedDiv = sectionNavButton;
    } else {
      changeSVGFill(sectionMobileButton);
      sectionMobileButton.classList.add("bg-gray"); 
      lastClickedDiv = sectionMobileButton;
    }
  } else {
    const sectionNavButton = document.getElementById('requestStatus-nav-button');
    const sectionMobileButton = document.getElementById('requestStatus-nav-mobile');
    
    if (window.innerWidth >= 920) {
      changeSVGFill(sectionNavButton);
      sectionNavButton.classList.add("bg-gray");
      lastClickedDiv = sectionNavButton;
    } else {
      changeSVGFill(sectionMobileButton);
      sectionMobileButton.classList.add("bg-gray");
      lastClickedDiv = sectionMobileButton;
    }
  }
  
  navSectionsDivs.forEach((div) => {
    div.querySelectorAll("svg").forEach(svg => {
      svg.style.fill = "#0B2341";
    });
    div.addEventListener("click", function () {
      if (lastClickedDiv) {
        lastClickedDiv.classList.remove("bg-gray");
      }
      lastClickedDiv = div;
      div.classList.add("bg-gray");
      div.style.cursor = "pointer"; 
      showSectionDoc(div.id.replace("-nav-button", "-section"));
      changeSVGFill(div);
    });
  });

  mobileNavButtons.forEach((div) => {
    div.querySelectorAll("svg").forEach(svg => {
      svg.style.fill = "#0B2341";
    });
    div.addEventListener("click", function () {
      if (lastClickedDiv) {
        lastClickedDiv.classList.remove("bg-gray");
      }
      lastClickedDiv = div;
      div.classList.add("bg-gray");
      div.style.cursor = "pointer"; 
      showSectionDoc(div.id.replace("-nav-mobile", "-section"));
      changeSVGFill(div);
    });
  });
}


function showSectionDoc(id) {
  const sections = document.getElementsByClassName("show-section");
  for (let i = 0; i < sections.length; i++) {
    sections[i].classList.add("d-none");
  }
  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");
  displayedSection.scrollIntoView({ behavior: 'smooth' });
}

function changeSVGFill(div){
  document.querySelectorAll(".section-clicked").forEach(icon => icon.classList.add("d-none"));

  document.querySelectorAll(".nav-button svg:not(.section-clicked)").forEach(icon => icon.classList.remove("d-none"));
  document.querySelectorAll(".mobile-icon-svg svg:not(.section-clicked)").forEach(icon => icon.classList.remove("d-none"));
  const clickedIcon = div.querySelector(".section-clicked");
  const defaultIcon = div.querySelector("svg:not(.section-clicked)");
  if (clickedIcon && defaultIcon) {
    clickedIcon.classList.toggle("d-none");
    defaultIcon.classList.toggle("d-none");
  }
}