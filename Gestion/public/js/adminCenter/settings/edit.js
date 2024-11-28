let approverEmailInput;
let financesEmailInput;
let maxsizeFilesInput;
let timeBeforeRevisionMonthInput;
let approverEmailInvalidEmpty;
let approverEmailInvalidFormat;
let financesEmailInvalidEmpty;
let financesEmailInvalidFormat;
let maxsizeFilesInvalidEmpty;
let maxsizeFilesInvalidFormat;
let timeBeforeRevisionMonthInvalidEmpty;
let timeBeforeRevisionMonthInvalidFormat;

document.addEventListener("DOMContentLoaded", function () {
	getElementsSettings();
	settingsListeners();
});

function getElementsSettings() {
  approverEmailInput = document.getElementById("approverEmail");
  financesEmailInput = document.getElementById("financesEmail");
  maxsizeFilesInput = document.getElementById("maxSizeFiles");
  timeBeforeRevisionMonthInput = document.getElementById("timeBeforeRevisionMonth");
  approverEmailInvalidEmpty = document.getElementById("approverEmailInvalidEmpty");
  approverEmailInvalidFormat = document.getElementById("approverEmailInvalidFormat");
  financesEmailInvalidEmpty = document.getElementById("financesEmailInvalidEmpty");
  financesEmailInvalidFormat = document.getElementById("financesEmailInvalidFormat");
  maxsizeFilesInvalidEmpty = document.getElementById("maxsizeFilesInvalidEmpty");
  maxsizeFilesInvalidFormat = document.getElementById("maxsizeFilesInvalidFormat");
  timeBeforeRevisionMonthInvalidEmpty = document.getElementById("timeBeforeRevisionMonthInvalidEmpty");
  timeBeforeRevisionMonthInvalidFormat = document.getElementById("timeBeforeRevisionMonthInvalidFormat");
}

function settingsListeners() {
  //Get functions in /settings/validation
  approverEmailInput.addEventListener("blur", function () {
    validateEmailInput(approverEmailInput, approverEmailInvalidEmpty, approverEmailInvalidFormat);
  })
  financesEmailInput.addEventListener("blur", function () {
    validateEmailInput(financesEmailInput, financesEmailInvalidEmpty, financesEmailInvalidFormat);
  })
  maxsizeFilesInput.addEventListener("blur", function () {
    validateNumericInput(maxsizeFilesInput, maxsizeFilesInvalidEmpty, maxsizeFilesInvalidFormat);
  })
  timeBeforeRevisionMonthInput.addEventListener("blur", function () {
    validateNumericInput(timeBeforeRevisionMonthInput, timeBeforeRevisionMonthInvalidEmpty, timeBeforeRevisionMonthInvalidFormat);
  })
}