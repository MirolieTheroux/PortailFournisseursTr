let sections;
let navSectionsDivs;

document.addEventListener("DOMContentLoaded", async function () {
    getSectionsInfo();
});

function getSectionsInfo() {
  sections = document.getElementsByClassName("show-section");
  navSectionsDivs = Array.from(document.querySelectorAll(".shadow-sm > div")).slice(1);
  navSectionsDivs.forEach((div) => {
    div.style.cursor = 'pointer'; 
    div.addEventListener("click", function () {
      showSectionDoc(div.id.replace('-nav-button', '-section'));
    });
  });
}

function showSectionDoc(id) {
  for (let i = 0; i < sections.length; i++) {
    sections[i].classList.add("d-none");
  }

  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");
}
