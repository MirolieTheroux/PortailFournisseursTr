let rangeMonths;
let rangeInputMonths;

document.addEventListener("DOMContentLoaded", function () {
	getElementsSettings();
	settingsListeners();
});

function getElementsSettings() {
	rangeMonths = document.getElementById("rangeValueMonths");
	rangeInputMonths = document.getElementById("timeBeforeRevisionMonth");
}

function settingsListeners() {
	rangeInputMonths.addEventListener('input', function() {
    rangeMonths.textContent = rangeInputMonths.value; 
  });
}