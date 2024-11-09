let navSectionsDivs;
let lastClickedDiv = null; 

// NAVIGATE SECTIONS FORM
function getSectionsInfo() {
  const navSectionsDivs = Array.from(document.querySelectorAll(".shadow-sm > div")).slice(1);
  const sectionFromUrl = window.location.hash.substring(1);
  if (sectionFromUrl) {
    showSectionDoc(sectionFromUrl);  
  }
  navSectionsDivs.forEach((div) => {
    div.addEventListener("click", function () {
      if (lastClickedDiv) {
        lastClickedDiv.classList.remove("bg-gray");
      }
      lastClickedDiv = div;
      div.classList.add("bg-gray");
      div.style.cursor = "pointer"; 
      showSectionDoc(div.id.replace("-nav-button", "-section"));
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

document.querySelectorAll(".py-1.rounded").forEach(button => {
  button.querySelectorAll("svg").forEach(svg => {
    svg.style.fill = "#0B2341";
  });
  button.addEventListener("click", function () {
    document.querySelectorAll(".section-clicked").forEach(icon => icon.classList.add("d-none"));

    document.querySelectorAll(".py-1.rounded svg").forEach(icon => icon.classList.add("d-none"));
    document.querySelectorAll(".py-1.rounded svg:not(.section-clicked)").forEach(icon => icon.classList.remove("d-none"));
    const clickedIcon = this.querySelector(".section-clicked");
    const defaultIcon = this.querySelector("svg:not(.section-clicked)");
    if (clickedIcon && defaultIcon) {
      clickedIcon.classList.toggle("d-none");
      defaultIcon.classList.toggle("d-none");
    }
  });
});





