let arrayDistrictAreas = [];
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

const provinceContactDetails = document.getElementById("contactDetailsProvince");
const selectCityContactDetails = document.getElementById("contactDetailsCitySelect");
const inputCityContactDetails = document.getElementById("contactDetailsInputCity");
const districtAreaContactDetails = document.getElementById("contactDetailsDistrictArea");

let selectedCity;
let selectedDistictArea;
let selectedProvince;

document.addEventListener("DOMContentLoaded", function () {
  selectedCity = selectCityContactDetails.value;
  selectedDistictArea = districtAreaContactDetails.value;
  selectedProvince = provinceContactDetails.value;
  districtAreaContactDetails.setAttribute("disabled", "");
});

async function addCitiesAndDAInSelect() {
  const citiesAndDA = await getCitiesAndDistrickAreas();
  const optionsCity = [];
  const optionsDA = [];

  const districtAreas = citiesAndDA.map((da) =>
    da.regadm.replace(/--/g, "-")
  );
  const uniqueDA = Array.from(new Set(districtAreas)).sort();
  const uniqueCity = Array.from(new Set(citiesAndDA.map((city)=>city.munnom)))
  uniqueCity.splice(uniqueCity.indexOf("Toponyme à venir"),1);
  function addQuebecCities() {
    selectCityContactDetails.innerHTML = "";
    uniqueCity.forEach((city) => {
        let optionCity = document.createElement("option");
        optionCity.text = city;
        optionCity.value = city;
        selectCityContactDetails.add(optionCity);
        optionsCity.push(optionCity);
    });
    selectCityContactDetails.classList.remove("d-none");
    inputCityContactDetails.classList.add("d-none");
    selectCityContactDetails.value = selectedCity;
  }
 
  if (provinceContactDetails.value === "Québec") {
    addQuebecCities();
    //districtAreaContactDetails.removeAttribute("disabled", "");
    addDistrictsAreas()
  } else {
    selectCityContactDetails.classList.add("d-none");
    inputCityContactDetails.classList.remove("d-none");
  }

  provinceContactDetails.addEventListener("change", () => {
    if (provinceContactDetails.value === "Québec") {
      addQuebecCities();
      districtAreaContactDetails.removeAttribute("disabled");
      addDistrictsAreas()
    } else {
      selectCityContactDetails.classList.add("d-none");
      inputCityContactDetails.classList.remove("d-none");
      inputCityContactDetails.setAttribute("type", "text");
      districtAreaContactDetails.setAttribute("disabled", "");
  
      districtAreaContactDetails.innerHTML = "";
      let optionNA = document.createElement("option");
      optionNA.value = "N/A";
      optionNA.textContent = "N/A";
      optionNA.setAttribute("selected", "selected");
      districtArea.add(optionNA);
    }
  });
  function addDistrictsAreas(){
    districtAreaContactDetails.innerHTML = "";
    uniqueDA.forEach((DA) => {
      let optionDA = document.createElement("option");
      optionDA.text = DA;
      optionDA.value = DA;
      districtAreaContactDetails.add(optionDA);
      optionsDA.push(optionDA);
      arrayDistrictAreas.push(DA);
    });
    districtAreaContactDetails.value = selectedDistictArea;
  }

  selectCityContactDetails.addEventListener("change", () =>{
    let cityAndDA = citiesAndDA.find(city => city.munnom === selectCityContactDetails.value);
    let daWithoutDoubleDash = cityAndDA.regadm.replace(/--/g, "-");
    if(cityAndDA)
    districtAreaContactDetails.value = daWithoutDoubleDash;
  });
}
