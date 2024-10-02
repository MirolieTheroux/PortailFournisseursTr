function addressAutocomplete(containerElement, callback, options) {
    const MIN_ADDRESS_LENGTH = 3;
    const DEBOUNCE_DELAY = 300;
    let focusedItemIndex = -1;
    let currentItems = [];
    let currentTimeout, currentPromiseReject;

    const inputSearchAddress = document.getElementById("contactDetailsSearchAddress");

    inputSearchAddress.addEventListener("input", function () {
        const currentValue = this.value;

        if (currentTimeout) clearTimeout(currentTimeout);
        if (currentPromiseReject) currentPromiseReject({ canceled: true });

        if (!currentValue || currentValue.length < MIN_ADDRESS_LENGTH) return false;

        currentTimeout = setTimeout(() => {
            currentTimeout = null;

            const promise = new Promise((resolve, reject) => {
                currentPromiseReject = reject;
                const apiKey = window.geoapifyApiKey;
                const url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(currentValue)}&format=json&limit=10&lang=fr&apiKey=${apiKey}`;

                fetch(url).then(response => {
                    currentPromiseReject = null;
                    if (response.ok) {
                        response.json().then(data => resolve(data));
                    } else {
                        response.json().then(data => reject(data));
                    }
                });
            });

            promise.then((data) => {
                currentItems = data.results;
                closeDropDownList();
                const autocompleteItemsElement = document.createElement("div");
                autocompleteItemsElement.setAttribute("class", "autocomplete-items");
                containerElement.appendChild(autocompleteItemsElement);

                data.results.forEach((result, index) => {
                    const itemElement = document.createElement("div");
                    itemElement.innerHTML = result.formatted;
                    autocompleteItemsElement.appendChild(itemElement);

                    itemElement.addEventListener("click", function () {
                        inputSearchAddress.value = result.formatted;
                        callback(result);
                        document.getElementById("contactDetailsCivicNumber").value = result.housenumber || "";
                        document.getElementById("contactDetailsStreetName").value = result.street || "";
                        document.getElementById("contactDetailsPovince").value = result.state || "";
                        document.getElementById("contactDetailsDistrictArea").value = result.region || "";
                        document.getElementById("contactDetailsPostalCode").value = result.postcode || "";
                        document.getElementById("contactDetailsCitySelect").value = result.city || "";
                        closeDropDownList();
                    });
                });
            }).catch(err => {
                if (!err.canceled) {
                    console.error(err);
                }
            });
        }, DEBOUNCE_DELAY);
    });

    inputSearchAddress.addEventListener("keydown", function (e) {
        const autocompleteItemsElement = containerElement.querySelector(".autocomplete-items");
        if (autocompleteItemsElement) {
            const itemElements = autocompleteItemsElement.gephoneementsByTagName("div");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                focusedItemIndex = (focusedItemIndex + 1) % itemElements.length;
                setActive(itemElements, focusedItemIndex);
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                focusedItemIndex = (focusedItemIndex - 1 + itemElements.length) % itemElements.length;
                setActive(itemElements, focusedItemIndex);
            } else if (e.key === "Enter") {
                e.preventDefault();
                if (focusedItemIndex > -1) {
                    itemElements[focusedItemIndex].click();
                }
            }
        }
    });

    function setActive(items, index) {
        if (!items || !items.length) return;
        [...items].forEach(item => item.classList.remove("autocomplete-active"));
        items[index].classList.add("autocomplete-active");
        inputSearchAddress.value = currentItems[index].formatted;
        callback(currentItems[index]);
    }

    function closeDropDownList() {
        const autocompleteItemsElement = containerElement.querySelector(".autocomplete-items");
        if (autocompleteItemsElement) {
            containerElement.removeChild(autocompleteItemsElement);
        }
        focusedItemIndex = -1;
    }
}

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
// pour que ca autofill je met la value des select = à la valeur que me donne l'API. Si on veut que ca fonctionne ils doivent être
//écrits pareils donc quand je remplis mes selects pour la value soit je garde en francais (ce que tu ma dit de ne pas faire)
//ou je met en anglais la value (trouver un moyen de traduire) et ce pour tout (province, ville et région).
//code région admin?met où
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

    //vérif
    

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

    addressAutocomplete(document.getElementById("autocomplete-container"), (data) => {
    }, {
    });
    addCitiesAndDAInSelect();

    //Ajuster hauteur boîte # phoneNumber
    var firstInput = document.getElementById("contactDetailsCivicNumber");
    var lastInput = document.getElementById("contactDetailsWebsite");
    var phoneNumberListContainer = document.getElementById("contactDetailsPhoneNumberList");
    var totalHeight = 0;

    if (firstInput && lastInput) {
        var firstInputTop = firstInput.getBoundingClientRect().top;
        var lastInputBottom = lastInput.getBoundingClientRect().bottom;

        totalHeight = lastInputBottom - firstInputTop;
        phoneNumberListContainer.style.height = totalHeight + "px";
    }
})

//Validation 
function validatePhoneNumber(phoneNumber) {
    // Vérifie si le champ est vide
    if (!phoneNumber) {
        return 'Le numéro de téléphone est requis.';
    }

    // Vérifie si le numéro a exactement 10 chiffres sans tirets
    const digitsOnly = phoneNumber.replace(/-/g, '');
    if (digitsOnly.length !== 10 || isNaN(digitsOnly)) {
        return 'Le numéro de téléphone doit contenir exactement 10 chiffres.';
    }

    // Vérifie si le format est ###-###-####
    const phoneRegex = /^\d{3}-\d{3}-\d{4}$/;
    if (!phoneRegex.test(phoneNumber)) {
        return 'Le format du numéro de téléphone doit être ###-###-####.';
    }

    return null; // Aucun message d'erreur si la validation est correcte
}

function validatePhoneExtension(extension) {
    // Vérifie si l'extension est vide (optionnelle)
    if (!extension) {
        return null; // Aucun message d'erreur, car l'extension est facultative
    }

    // Vérifie si l'extension est numérique
    if (isNaN(extension)) {
        return 'L\'extension doit être un nombre.';
    }

    // Vérifie si l'extension est d'au plus 6 chiffres
    if (extension.length > 6) {
        return 'L\'extension ne doit pas dépasser 6 chiffres.';
    }

    return null; // Aucun message d'erreur si la validation est correcte
}







