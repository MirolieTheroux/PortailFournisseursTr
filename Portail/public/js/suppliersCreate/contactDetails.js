async function getCitiesAndDistrickAreas() {
    try {
        const response = await fetch("https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=19385b4e-5503-4330-9e59-f998f5918363&fields=munnom,regadm&sort=munnom,regadm&limit=1400");

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

    const districtAreas = citiesAndDA.map((da) => da.regadm.replace(/--/g, '-'));
    const uniqueDA = Array.from(new Set(districtAreas)).sort();

    function addQuebecCities() {
        selectCity.innerHTML = "";
        citiesAndDA.forEach((city) => {
            let optionCity = document.createElement("option");
            optionCity.text = city.munnom;
            optionCity.value = city.munmom;
            selectCity.add(optionCity);
        });
        if (oldCity) {
            selectCity.value = oldCity;
        }
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
        optionDA.value = DA.replace(/\s*\(.*?\)/, '');
        districtArea.add(optionDA);
    });

    if (oldDistrictArea) {
        districtArea.value = oldDistrictArea;
    }

}

function savePhoneNumbers(phoneNumbers) {
    localStorage.setItem('phoneNumbers', JSON.stringify(phoneNumbers));
}

function loadPhoneNumbers() {
    const savedPhoneNumbers = localStorage.getItem('phoneNumbers');
    return savedPhoneNumbers ? JSON.parse(savedPhoneNumbers) : [];
}

function addPhoneNumber() {
    const typephone = document.getElementById("contactDetailsPhoneType").value;
    const phoneNumber = document.getElementById("contactDetailsPhoneNumber").value;
    const phoneExtension = document.getElementById("contactDetailsPhoneExtension").value || "-";
    
    const phoneNumbers = loadPhoneNumbers();
    phoneNumbers.push({ type: typephone, number: phoneNumber, extension: phoneExtension });
    savePhoneNumbers(phoneNumbers);

    displayPhoneNumbers();

    document.getElementById("contactDetailsPhoneNumber").value = "";
    document.getElementById("contactDetailsPhoneExtension").value = "";
}

function displayPhoneNumbers() {
    const phoneNumberList = document.getElementById("phoneNumberList");
    phoneNumberList.innerHTML = '';

    const phoneNumbers = loadPhoneNumbers();
    phoneNumbers.forEach((phone, index) => {
        const newphoneNumber = document.createElement("div");
        newphoneNumber.classList.add("row", "mb-2", "align-items-center", "justify-content-between");

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

        const removephoneNumber = document.createElementNS("http://www.w3.org/2000/svg", "svg");
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
})

//Validation 
function validatePhoneNumber(phoneNumber) {
    if (!phoneNumber) {
        return 'Le numéro de téléphone est requis.';
    }

    const digitsOnly = phoneNumber.replace(/-/g, '');
    if (digitsOnly.length !== 10 || isNaN(digitsOnly)) {
        return 'Le numéro de téléphone doit contenir exactement 10 chiffres.';
    }

    const phoneRegex = /^\d{3}-\d{3}-\d{4}$/;
    if (!phoneRegex.test(phoneNumber)) {
        return 'Le format du numéro de téléphone doit être ###-###-####.';
    }
    return null; 
}

function validatePhoneExtension(extension) {
    if (!extension) {
        return null; 
    }

    if (isNaN(extension)) {
        return 'L\'extension doit être un nombre.';
    }

    if (extension.length > 6) {
        return 'L\'extension ne doit pas dépasser 6 chiffres.';
    }
    return null;
}







