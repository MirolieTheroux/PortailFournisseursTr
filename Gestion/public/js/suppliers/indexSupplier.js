let selectedDistrictArea = [];
let citiesAndDA;
let citiesList;
let DAList;
let districtAreas;
let uniqueDA;
let uniqueCity;
let citiesListTemplate;
let pageLoaded = false;

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
  citiesAndDA = await getCitiesAndDistrickAreas();
  citiesList = document.getElementById("cities");
  DAList = document.getElementById("districtAreas");

  districtAreas = citiesAndDA.map((da) =>
    da.regadm.replace(/--/g, "-")
  );
  uniqueDA = Array.from(new Set(districtAreas)).sort();
  uniqueCity = Array.from(new Set(citiesAndDA.map((city)=>city.munnom)))
  uniqueCity.splice(uniqueCity.indexOf("Toponyme à venir"),1);

  addCities(citiesList);
  addDistrictsAreas();

  return true;
}

function addCities(citiesListSelect) {
  citiesListSelect.innerHTML = "";
  uniqueCity.forEach((city) => {
      let optionCity = document.createElement("option");
      optionCity.value = city;
      optionCity.text = city;
      if(selectedDistrictArea.length === 0){
        citiesListSelect.appendChild(optionCity);
      }
      else{
        if(selectedDistrictArea.includes(citiesAndDA.find(x => x.munnom === city).regadm.replace(/--/g, "-")))
          citiesListSelect.appendChild(optionCity);
      }
  });
}

function addDistrictsAreas(){
  uniqueDA.forEach((DA) => {
    let optionDA = document.createElement("option");
    optionDA.text = DA;
    optionDA.value = DA;
    DAList.appendChild(optionDA);
  });
}

function addListeners(){
  if(pageLoaded){
    removeListeners()
  }
  const options = document.querySelectorAll(".multi-select-option");
  for(let i=0 ; i < options.length ; i++){
    options[i].addEventListener('click', invokeSelectChange);
  }
}

function removeListeners(){
  const options = document.querySelectorAll(".multi-select-option");
  for(let i=0 ; i < options.length ; i++){
    options[i].removeEventListener('click', invokeSelectChange);
  }
}

function updateCityList(){
  DAList = document.getElementById("districtAreas");
  const DASelectedOptions = DAList.querySelectorAll(".multi-select-selected");
  selectedDistrictArea = []
  for(let i=0 ; i < DASelectedOptions.length ; i++){
    selectedDistrictArea.push(DASelectedOptions[i].children[1].innerHTML);
  }
  
  const citiesContainer = document.getElementById("citiesContainer");
  const citiesDiv = citiesContainer.querySelector('div');
  citiesDiv.replaceWith(citiesListTemplate);
  const citiesSelect = citiesContainer.querySelector('select');
  addCities(citiesSelect);
  new MultiSelect(citiesSelect);
  refreshListeners();
  updateCitiesFilter();
}

function invokeSelectChange(event){
  const option = event.target;
  const select = option.closest('.multi-select');
  
  if(select.id == 'districtAreas'){
    updateCityList();
  }
  else if(select.id == 'workCategories'){
    updateWorkSubcategoryCounters();
  }

  select.dispatchEvent(new Event('change'));
}

function makeOptionListTemplate(){
  citiesListTemplate = document.getElementById("cities").cloneNode();
}

function refreshListeners(){
  addListeners();
  //Is in the index.blade.php file
  addjQueryListeners();
}

function updateWorkSubcategoryCounters(){
  const workCategoriesList = document.getElementById("workCategories");
  const workCategoriesInputs = workCategoriesList.querySelectorAll('input');
  const workCategoriesCountSpan = document.getElementById("workSubCategoryCount");
  workCategoriesCountSpan.innerHTML = workCategoriesInputs.length-1;
}

document.addEventListener("DOMContentLoaded", async function () {
  let response = await addCitiesAndDAInSelect();
  makeOptionListTemplate();
  document.querySelectorAll('[data-multi-select]').forEach(select => new MultiSelect(select));
  refreshListeners();
  pageLoaded = true;

  updateDistrictAreas();
  updateCitiesFilter();
  updateWorkSubcategoriesFilter();
  updateStatusFilter();
  updateProductsServicesFilter();
});