let selectedDistrictArea = [];
let citiesAndDA;
let citiesList;
let DAList;
let districtAreas;
let uniqueDA;
let uniqueCity;
let citiesListTemplate;

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
  const DAList = document.getElementById("districtAreas");
  const DAOptions = DAList.querySelectorAll(".multi-select-option");
  for(let i=0 ; i < DAOptions.length ; i++){
    DAOptions[i].addEventListener('click', ()=>{
      updateCityList();
      invokeSelectChange(DAOptions[i]);
    })
  }

  const cityList = document.getElementById("cities");
  const cityOptions = cityList.querySelectorAll(".multi-select-option");
  for(let i=0 ; i < cityOptions.length ; i++){
    cityOptions[i].addEventListener('click', ()=>{
      invokeSelectChange(cityOptions[i]);
    })
  }

  const workCategoriesList = document.getElementById("workCategories");
  const workCategoriesOptions = workCategoriesList.querySelectorAll(".multi-select-option");
  for(let i=0 ; i < workCategoriesOptions.length ; i++){
    workCategoriesOptions[i].addEventListener('click', ()=>{
      invokeSelectChange(workCategoriesOptions[i]);
      updateWorkSubcategoryCounters();
    })
  }

  const statusList = document.getElementById("status");
  const statusOptions = statusList.querySelectorAll(".multi-select-option");
  for(let i=0 ; i < statusOptions.length ; i++){
    statusOptions[i].addEventListener('click', ()=>{
      invokeSelectChange(statusOptions[i]);
    })
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
}

function invokeSelectChange(option){
  const optionParent = option.parentElement;
  const select = optionParent.parentElement;
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
});