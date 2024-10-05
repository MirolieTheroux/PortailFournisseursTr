async function getCitiesAndDistrickAreas() {
    try {
        const response = await fetch(
            "https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=19385b4e-5503-4330-9e59-f998f5918363&fields=munnom,regadm&sort=munnom,regadm&limit=1400"
        );

        if (response.ok) {
            const data = await response.json();
            return data.result.records;
        } else {
            const errorData = await response.json();
            console.error("Erreur:", errorData);
            throw new Error("Erreur lors de la récupération des données");
        }
    } catch (error) {
        console.error("Erreur de réseau:", error);
        throw error;
    }
}
async function addCitiesAndDAInSelect() {
    const citiesAndDA = await getCitiesAndDistrickAreas();
    const province = document.getElementById("contactDetailsPovince");
    const selectCity = document.getElementById("contactDetailsCitySelect");
    const inputCity = document.getElementById("contactDetailsInputCity");
    const districtArea = document.getElementById("contactDetailsDistrictArea");

    const districtAreas = citiesAndDA.map((da) =>
        da.regadm.replace(/--/g, "-")
    );
    const uniqueDA = Array.from(new Set(districtAreas)).sort();

    function addQuebecCities() {
        selectCity.innerHTML = "";
        citiesAndDA.forEach((city) => {
            let optionCity = document.createElement("option");
            optionCity.text = city.munnom;
            optionCity.value = city.munnom;
            selectCity.add(optionCity);
        });
        selectCity.classList.remove("d-none");
        inputCity.classList.add("d-none");
    }

    if (province.value === "Québec") {
        addQuebecCities();
    } else {
        selectCity.classList.add("d-none");
        inputCity.classList.remove("d-none");
        inputCity.setAttribute("type", "text");
    }

    province.addEventListener("change", () => {
        if (province.value === "Québec") {
            addQuebecCities();
        } else {
            selectCity.classList.add("d-none");
            inputCity.classList.remove("d-none");
            inputCity.setAttribute("type", "text");
        }
    });

    districtArea.innerHTML = "";
    uniqueDA.forEach((DA) => {
        let optionDA = document.createElement("option");
        optionDA.text = DA;
        optionDA.value = DA.replace(/\s*\(.*?\)/, "");
        districtArea.add(optionDA);
    });
}

function savePhoneNumbers(phoneNumbers) {
    localStorage.setItem("phoneNumbers", JSON.stringify(phoneNumbers));
}

function loadPhoneNumbers() {
    const savedPhoneNumbers = localStorage.getItem("phoneNumbers");
    return savedPhoneNumbers ? JSON.parse(savedPhoneNumbers) : [];
}

function addPhoneNumber() {
    const typePhone = document.getElementById("contactDetailsPhoneType").value;
    const phoneNumber = document.getElementById(
        "contactDetailsPhoneNumber"
    ).value;
    const phoneExtension =
        document.getElementById("contactDetailsPhoneExtension").value || "-";

    const phoneNumbers = loadPhoneNumbers();
    phoneNumbers.push({
        type: typePhone,
        number: phoneNumber,
        extension: phoneExtension,
    });
    savePhoneNumbers(phoneNumbers);

    displayPhoneNumbers();

    document.getElementById("contactDetailsPhoneNumber").value = "";
    document.getElementById("contactDetailsPhoneExtension").value = "";
}

function displayPhoneNumbers() {
    const phoneNumberList = document.getElementById("phoneNumberList");
    phoneNumberList.innerHTML = "";

    const phoneNumbers = loadPhoneNumbers();
    phoneNumbers.forEach((phone, index) => {
        const newphoneNumber = document.createElement("div");
        newphoneNumber.classList.add(
            "row",
            "mb-2",
            "align-items-center",
            "justify-content-between"
        );

        const colphoneType = document.createElement("div");
        colphoneType.classList.add("col-2", "text-start");
        colphoneType.textContent = phone.type;
        newphoneNumber.appendChild(colphoneType);

        const colphoneNum = document.createElement("div");
        colphoneNum.classList.add("col-6", "text-center");
        colphoneNum.textContent = phone.number;
        newphoneNumber.appendChild(colphoneNum);

        const colphoneExtension = document.createElement("div");
        colphoneExtension.classList.add("col-2", "text-center");
        colphoneExtension.textContent = phone.extension;
        newphoneNumber.appendChild(colphoneExtension);

        const colRemove = document.createElement("div");
        colRemove.classList.add("col-2", "d-flex", "justify-content-center");

        const removephoneNumber = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "svg"
        );
        removephoneNumber.setAttribute("xmlns", "http://www.w3.org/2000/svg");
        removephoneNumber.setAttribute("width", "38");
        removephoneNumber.setAttribute("height", "38");
        removephoneNumber.setAttribute("fill", "currentColor");
        removephoneNumber.setAttribute("class", "bi bi-trash-fill");
        removephoneNumber.setAttribute("viewBox", "0 0 16 16");
        removephoneNumber.style.cursor = "pointer";
        removephoneNumber.innerHTML = `
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
        `;
        removephoneNumber.addEventListener("click", function () {
            phoneNumbers.splice(index, 1);
            savePhoneNumbers(phoneNumbers);
            displayPhoneNumbers();
        });

        colRemove.appendChild(removephoneNumber);
        newphoneNumber.appendChild(colRemove);

        phoneNumberList.appendChild(newphoneNumber);
    });
}
window.onload = function () {
    displayPhoneNumbers();
};

document.addEventListener("DOMContentLoaded", function () {
    const addNumber = document.getElementById("add-icon");
    addNumber.addEventListener("click", function (event) {
        event.preventDefault();
        addPhoneNumber();
    });
    addCitiesAndDAInSelect();
});

//Validation
const regexAlphanum = /^[a-zA-Z0-9 ]+$/;
const regexAlphanumAndSpecialCar =/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~ ]+$/;

function validateCivicNumber(id) {
  const input = document.getElementById(id);
  const invalidRequiredCivicNumber = document.getElementById("invalidRequiredCivicNumber");
  const invalidCivicNumber = document.getElementById("invalidCivicNumber");
  const invalidCivicNumberLength = document.getElementById("invalidCivicNumberLength");
  // Reset all error messages
  invalidRequiredCivicNumber.style.display = "none";
  invalidCivicNumber.style.display = "none";
  invalidCivicNumberLength.style.display = "none";
    // Basic validation logic
  if(!input.value) {
    console.log("ici");
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredCivicNumber.style.display ="block";
  }else if(!input.value.match(regexAlphanum)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidCivicNumber.style.display ="block";
  }else if(input.value.length > 8) {
    console.log("8");
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidCivicNumberLength.style.display = "block";
  }else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add('was-validated');
}

function validateStreetName(id) {
  const input = document.getElementById(id);
  const invalidRequiredStreetName = document.getElementById("invalidRequiredStreetName");
  const invalidStreetName = document.getElementById("invalidStreetName");
  const invalidStreetNameLength = document.getElementById("invalidStreetNameLength");

  // Reset all error messages
  invalidRequiredStreetName.style.display = "none"
  invalidStreetName.style.display = "none";
  invalidStreetNameLength.style.display = "none";
  // Basic validation logic
  if(!input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredStreetName.style.display = "block";
  } else if(!input.value.match(regexAlphanumAndSpecialCar)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidStreetName.style.display = "block";
  } else if(input.value.length > 64) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidStreetNameLength.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add('was-validated');
}

function validateOfficeNumber(id){
  const input = document.getElementById(id);
  const invalidOfficeNumber = document.getElementById("invalidOfficeNumber");
  const invalidOfficeNumberLength = document.getElementById("invalidOfficeNumberLength");

  // Reset all error messages
  invalidOfficeNumber.style.display = "none";
  invalidOfficeNumberLength.style.display = "none";
  // Basic validation logic
 if(!input.value.match(regexAlphanum) && (input.value !== "")) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidOfficeNumber.style.display = "block";
  } else if(input.value.length > 8) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidOfficeNumberLength.style.display = "block";
  } else if(!input.value){
    input.classList.remove("is-invalid");
    input.classList.remove("is-valid");
  }else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add('was-validated');
}

function validateCity(id){
  const input = document.getElementById(id);
  const invalidRequiredCity = document.getElementById("invalidRequiredCity");
  const invalidCityLength = document.getElementById("invalidCityLength");

  // Reset all error messages
  invalidRequiredCity.style.display = "none";
  invalidCityLength.style.display = "none";
  // Basic validation logic
 if(!input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredCity.style.display = "block";
  } else if(input.value.length > 64) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidCityLength.style.display = "block";
  }else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add('was-validated');
}

function validatePostalCodeOnInput(id) {
  const regexFullCP = /^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/; 
  const input = document.getElementById(id);
  const invalidRequiredPostalCode = document.getElementById("invalidRequiredPostalCode");
  const invalidPostalCodeFormat = document.getElementById("invalidPostalCodeFormat");
  const invalidPostalCodeLength = document.getElementById("invalidPostalCodeLength");

  // Reset all error messages
  invalidRequiredPostalCode.style.display = "none";
  invalidPostalCodeFormat.style.display = "none";
  invalidPostalCodeLength.style.display = "none";

  const pcValue = input.value.replace(/\s+/g, '').toUpperCase(); 

  // Basic validation logiée
  if (!input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredPostalCode.style.display = "block";
  } else if (pcValue.length > 6) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeLength.style.display = "block";
  } else if (pcValue.length === 1 && !/^[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 2 && !/^[A-Za-z]\d$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 3 && !/^[A-Za-z]\d[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 4 && !/^[A-Za-z]\d[A-Za-z]\d$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 5 && !/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 6 && !regexFullCP.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add('was-validated');
}

function formatPostalCodeOnBlur(id) {
  const input = document.getElementById(id);
  const pcValue = input.value.replace(/\s+/g, '').toUpperCase(); 

  if (/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/.test(pcValue)) {
    input.value = pcValue.replace(/\s+/g, '').toUpperCase().replace(/^([A-Za-z]\d[A-Za-z])(\d[A-Za-z]\d)$/, '$1 $2');
  }
}

function validateWebsiteOnBlur(id){
  const urlRegex = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9.-]+)(\.[a-zA-Z]{2,})(\/[^\s]*)?$/;
  const input = document.getElementById(id);
  const invalidWebsite = document.getElementById("invalidWebsite");
  const invalidWebsiteLength = document.getElementById("invalidWebsiteLength");

  // Reset all error messages
  invalidWebsite.style.display = "none";
  invalidWebsiteLength.style.display = "none";
  // Basic validation logic
 if(!urlRegex.test(input.value) && (input.value !== "")) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidWebsite.style.display = "block";
  } else if(input.value.length > 64) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidWebsiteLength.style.display = "block";
  }else if(!input.value){
    input.classList.remove("is-invalid");
    input.classList.remove("is-valid");
  }else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add('was-validated');
}

function validateContactDetailsAll() {
    const inputs = document.querySelectorAll(".contactDetails-input");
    const oninput = new Event("input");

    inputs.forEach((input) => {
        input.dispatchEvent(oninput);
    });
}
