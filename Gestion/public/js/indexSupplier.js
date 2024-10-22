let selectedDistrictArea = [];

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
  const citiesList = document.getElementById("cities");
  const DAList = document.getElementById("districtAreas");

  const districtAreas = citiesAndDA.map((da) =>
    da.regadm.replace(/--/g, "-")
  );
  const uniqueDA = Array.from(new Set(districtAreas)).sort();
  const uniqueCity = Array.from(new Set(citiesAndDA.map((city)=>city.munnom)))
  uniqueCity.splice(uniqueCity.indexOf("Toponyme à venir"),1);

  addQuebecCities();
  addDistrictsAreas();

  return true;

  function addQuebecCities() {
    citiesList.innerHTML = "";
    uniqueCity.forEach((city) => {
        let optionCity = document.createElement("option");
        optionCity.value = city;
        optionCity.text = city;
        citiesList.appendChild(optionCity);
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
}

function addListenerDistrictAreaOptions(){
  const DAList = document.getElementById("districtAreas");
  const DAOptions = DAList.querySelectorAll(".multi-select-option");

  for(let i=0 ; i < DAOptions.length ; i++){
    DAOptions[i].addEventListener('click', ()=>{
      updateCityList();
    })
  }
}

function updateCityList(){
  const DAList = document.getElementById("districtAreas");
  const DASelectedOptions = DAList.querySelectorAll(".multi-select-selected");
  selectedDistrictArea = []
  for(let i=0 ; i < DASelectedOptions.length ; i++){
    selectedDistrictArea.push(DASelectedOptions[i].children[1].innerHTML);
  }
  console.log(selectedDistrictArea);
}

document.addEventListener("DOMContentLoaded", async function () {
  let response = await addCitiesAndDAInSelect();
  document.querySelectorAll('[data-multi-select]').forEach(select => new MultiSelect(select));
  addListenerDistrictAreaOptions();
});