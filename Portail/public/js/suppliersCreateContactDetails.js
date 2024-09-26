function addressAutocomplete(containerElement, callback, options) {
    const MIN_ADDRESS_LENGTH = 3;
    const DEBOUNCE_DELAY = 300;
    let focusedItemIndex = -1;
    let currentItems = [];
    let currentTimeout, currentPromiseReject;

    const inpuphoneement = document.getElementById("contactDetails-searchAddress");

    inpuphoneement.addEventListener("input", function () {
        const currentValue = this.value;

        if (currentTimeout) clearTimeout(currentTimeout);
        if (currentPromiseReject) currentPromiseReject({ canceled: true });

        if (!currentValue || currentValue.length < MIN_ADDRESS_LENGTH) return false;

        currentTimeout = setTimeout(() => {
            currentTimeout = null;

            const promise = new Promise((resolve, reject) => {
                currentPromiseReject = reject;
                const apiKey = window.geoapifyApiKey;
                const url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(currentValue)}&format=json&limit=10&lang=en&apiKey=${apiKey}`;

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
                        inpuphoneement.value = result.formatted;
                        callback(result);
                        document.getElementById("contactDetails-civicNumber").value = result.housenumber || "";
                        document.getElementById("contactDetails-streetName").value = result.street || "";
                        document.getElementById("contactDetails-province").value = result.state ||"";
                        document.getElementById("contactDetails-districtArea").value = result.region || "";
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

    inpuphoneement.addEventListener("keydown", function (e) {
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
        inpuphoneement.value = currentItems[index].formatted;
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

async function getCities() {
    try {
        const response = await fetch("https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=19385b4e-5503-4330-9e59-f998f5918363&fields=munnom&sort=munnom&limit=1400");
        
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
async function addCitiesInSelect() {
    const cities = await getCities();
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

    if (province.value === "Quebec") {
        addQuebecCities();
    } else {
        selectCity.classList.add("d-none");
        inputCity.classList.remove("d-none");
        inputCity.setAttribute("type", "text");
    }

    province.addEventListener("change", () => {
        if (province.value === "Quebec") {
            addQuebecCities();
        } else {
            selectCity.classList.add("d-none");
            inputCity.classList.remove("d-none");
            inputCity.setAttribute("type", "text");
        }
    });
}

async function getDistrictAreas(){
    try {
        const response = await fetch("https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=19385b4e-5503-4330-9e59-f998f5918363&fields=regadm&sort=regadm&limit=1400");
        
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

async function addDistrictAreasInSelect() {
    const districtAreas = await getDistrictAreas();
    const uniquedistrictAreas = [...new Set(districtAreas)]
    console.log(uniquedistrictAreas);
    //sortir chaque résultat des objets
    const selectDistricArea = document.getElementById("contactDetails-districtArea");
    
    // <option value="Abitibi-Témiscamingue" {{ old('contactDetails-districtArea') == 'Abitibi-Témiscamingue' ? 'selected' : '' }}>Abitibi-Témiscamingue (région 08)</option>

    function addDistricArea() {
        selectDistricArea.innerHTML = "";
        districtAreas.forEach((districtArea) => {
            let optiondistrictArea = document.createElement("option");
            optiondistrictArea.text = districtArea.regadm;
            selectDistricArea.add(optiondistrictArea);
        });

        selectCity.classList.remove("d-none");
        inputCity.classList.add("d-none");
    }
}

function addphoneNumber() {
    const typephone = document.getElementById("contactDetails-phoneType").value;
    const phoneNumber = document.getElementById("contactDetails-phoneNumber");
    const phoneExtension = document.getElementById("contactDetails-phoneExtension");
    const phoneNumberList = document.getElementById("phoneNumberList");

    console.log(document.getElementById("option").value);
    const newphoneNumber = document.createElement("div");
    newphoneNumber.classList.add("row", "mb-2", "align-items-center");

    const colphoneType = document.createElement("div");
    colphoneType.classList.add("col-md-3");
    colphoneType.textContent = typephone;
    newphoneNumber.appendChild(colphoneType);

    const colphoneNum = document.createElement("div");
    colphoneNum.classList.add("col-md-4");
    colphoneNum.textContent = phoneNumber.value;
    newphoneNumber.appendChild(colphoneNum);

    const colphoneExtension = document.createElement("div");
    colphoneExtension.classList.add("col-md-3");
    colphoneExtension.textContent = phoneExtension.value ? phoneExtension.value : "-";
    newphoneNumber.appendChild(colphoneExtension);

    const colRemove = document.createElement("div");
    colRemove.classList.add("col-md-2", "d-flex", "justify-content-center");

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
    removephoneNumber.addEventListener("click", function() {
        phoneNumberList.removeChild(newphoneNumber);
    });

    colRemove.appendChild(removephoneNumber);
    newphoneNumber.appendChild(colRemove);

    phoneNumberList.appendChild(newphoneNumber);

    const divphoneNumberList = document.getElementById("div-phoneNumberList");
    divphoneNumberList.classList.remove("d-none");

    document.getElementById("contactDetails-phoneNumber").value = "";
    document.getElementById("contactDetails-phoneExtension").value = "";
}


document.addEventListener("DOMContentLoaded", function(){
   const addNumber = document.getElementById("add-icon");
   addNumber.addEventListener("click", function(event){
        event.preventDefault();
        addphoneNumber();
    });

    addressAutocomplete(document.getElementById("autocomplete-container"), (data) => {
    }, {
    });
    addCitiesInSelect();
    addDistrictAreasInSelect();

    //Ajuster hauteur boîte # phoneNumber
    var firstInput = document.getElementById("contactDetails-civicNumber"); 
    var lastInput = document.getElementById("contactDetails-website");       
    var phoneNumberListContainer = document.getElementById("contactDetails-phoneNumberList");
    var totalHeight = 0;
    
    if (firstInput && lastInput) {
        var firstInputTop = firstInput.getBoundingClientRect().top;
        var lastInputBottom = lastInput.getBoundingClientRect().bottom;
        
        totalHeight = lastInputBottom - firstInputTop;
        phoneNumberListContainer.style.height = totalHeight + "px";
    }
})







