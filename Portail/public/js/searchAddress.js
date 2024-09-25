function addressAutocomplete(containerElement, callback, options) {
    const MIN_ADDRESS_LENGTH = 3;
    const DEBOUNCE_DELAY = 300;
    let focusedItemIndex = -1;
    let currentItems = [];
    let currentTimeout, currentPromiseReject;

    const inputElement = document.getElementById("contactDetails-searchAddress");

    inputElement.addEventListener("input", function () {
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
                        inputElement.value = result.formatted;
                        callback(result);
                        document.getElementById("contactDetails-civicNumber").value = result.housenumber || "";
                        document.getElementById("contactDetails-streetName").value = result.street || "";
                        document.getElementById("contactDetails-province").value = result.state ||"";
                        document.getElementById("contactDetails-region").value = result.region || "";
                        document.getElementById("contactDetails-postalCode").value = result.postcode || "";
                        document.getElementById("contactDetails-citySelect").value = result.city || "";
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

    inputElement.addEventListener("keydown", function (e) {
        const autocompleteItemsElement = containerElement.querySelector(".autocomplete-items");
        if (autocompleteItemsElement) {
            const itemElements = autocompleteItemsElement.getElementsByTagName("div");
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
        inputElement.value = currentItems[index].formatted;
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

async function getCitiesAndRegion() {
    try {
        const response = await fetch("https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=19385b4e-5503-4330-9e59-f998f5918363&fields=munnom,regadm&sort=regadm,munnom&limit=1400");
        
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
//vérifier que même si on enlève un des 2 inputs, que lorsqu"on envoit le formulaire il prenne le bon champ pour envoyer dans la BD
//Voir avec le required with
async function addCitiesInDropDown() {
    const cities = await getCitiesAndRegion();
    const province = document.getElementById("contactDetails-province");
    const selectCity = document.getElementById("contactDetails-citySelect");
    const inputCity = document.getElementById("contactDetails-inputCity");

    function addQuebecCities() {
        selectCity.innerHTML = "";
        cities.forEach((city) => {
            let optionCity = document.createElement("option");
            optionCity.text = city.munnom;
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
}

function addTelNumber() {
    const typeTel = document.getElementById("contactDetails-telType").value;
    const telNumber = document.getElementById("contactDetails-telNumber");
    const telExtension = document.getElementById("contactDetails-telExtension");
    const telNumberList = document.getElementById("telNumberList");

    if (telNumberList.children.length === 0) {
        const headerRow = document.createElement("div");
        headerRow.classList.add("row", "fw-bold", "mb-2"); 

        const headerTelType = document.createElement("div");
        headerTelType.classList.add("col-md-3","mt-3");
        headerTelType.textContent = "Type";

        const headerTelNum = document.createElement("div");
        headerTelNum.classList.add("col-md-4","mt-3");
        headerTelNum.textContent = "# Tel";

        const headerTelExtension = document.createElement("div");
        headerTelExtension.classList.add("col-md-3","mt-3");
        headerTelExtension.textContent = "Poste";

        const headerRemove = document.createElement("div");
        headerRemove.classList.add("col-md-2");

        headerRow.appendChild(headerTelType);
        headerRow.appendChild(headerTelNum);
        headerRow.appendChild(headerTelExtension);
        headerRow.appendChild(headerRemove);

        telNumberList.appendChild(headerRow);
    }

    const newTelNumber = document.createElement("div");
    newTelNumber.classList.add("row", "mb-2", "align-items-center");

    const colTelType = document.createElement("div");
    colTelType.classList.add("col-md-3");
    colTelType.textContent = typeTel;
    newTelNumber.appendChild(colTelType);

    const colTelNum = document.createElement("div");
    colTelNum.classList.add("col-md-4");
    colTelNum.textContent = telNumber.value;
    newTelNumber.appendChild(colTelNum);

    const colTelExtension = document.createElement("div");
    colTelExtension.classList.add("col-md-3");
    colTelExtension.textContent = telExtension.value ? telExtension.value : "-";
    newTelNumber.appendChild(colTelExtension);

    const colRemove = document.createElement("div");
    colRemove.classList.add("col-md-2", "d-flex", "justify-content-center");

    const removeTelNumber = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    removeTelNumber.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removeTelNumber.setAttribute("width", "38");
    removeTelNumber.setAttribute("height", "38");
    removeTelNumber.setAttribute("fill", "currentColor");
    removeTelNumber.setAttribute("class", "bi bi-trash-fill");
    removeTelNumber.setAttribute("viewBox", "0 0 16 16");
    removeTelNumber.style.cursor = "pointer";
    removeTelNumber.innerHTML = `
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    `;
    removeTelNumber.addEventListener("click", function() {
        telNumberList.removeChild(newTelNumber);
    });

    colRemove.appendChild(removeTelNumber);
    newTelNumber.appendChild(colRemove);

    telNumberList.appendChild(newTelNumber);

    const divTelNumberList = document.getElementById("div-telNumberList");
    divTelNumberList.classList.remove("d-none");

    document.getElementById("contactDetails-telNumber").value = "";
    document.getElementById("contactDetails-telExtension").value = "";
}


document.addEventListener("DOMContentLoaded", function(){
   const addNumber = document.getElementById("add-icon");

   addNumber.addEventListener("click", function(event){
        event.preventDefault();
        addTelNumber();
    });

    addressAutocomplete(document.getElementById("autocomplete-container"), (data) => {
    }, {
    });
    addCitiesInDropDown();

    //Ajuster hauteur boîte # telNumber
    var firstInput = document.getElementById("contactDetails-civicNumber"); 
    var lastInput = document.getElementById("contactDetails-website");       
    var telNumberListContainer = document.getElementById("contactDetails-telNumberList");
    var totalHeight = 0;
    
    if (firstInput && lastInput) {
        var firstInputTop = firstInput.getBoundingClientRect().top;
        var lastInputBottom = lastInput.getBoundingClientRect().bottom;
        
        totalHeight = lastInputBottom - firstInputTop;
        telNumberListContainer.style.height = totalHeight + "px";
    }
})







