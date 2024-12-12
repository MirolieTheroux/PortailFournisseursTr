function updateDistrictAreas(){
  const districtAreasContainer = document.getElementById('districtAreas');
  const districtAreasMultiSelect = districtAreasContainer.querySelector('.multi-select-options');
  const districtAreasOptions = districtAreasMultiSelect.querySelectorAll('.multi-select-option');

  districtAreasOptions.forEach(option => {
    if(suppliersRegions.includes(option.dataset.value))
      option.classList.remove("d-none");
    else
      option.classList.add("d-none");
  });
}

function updateCitiesFilter(){
  const citiesContainer = document.getElementById('cities');
  const citiesMultiSelect = citiesContainer.querySelector('.multi-select-options');
  const CitiesOptions = citiesMultiSelect.querySelectorAll('.multi-select-option');

  CitiesOptions.forEach(option => {
    if(suppliersCities.includes(option.dataset.value))
      option.classList.remove("d-none");
    else
      option.classList.add("d-none");
  });
}

function updateWorkSubcategoriesFilter(){
  const workCategoriesContainer = document.getElementById('workCategories');
  const workCategoriesMultiSelect = workCategoriesContainer.querySelector('.multi-select-options');
  const workCategoriesOptions = workCategoriesMultiSelect.querySelectorAll('.multi-select-option');

  workCategoriesOptions.forEach(option => {
    if(suppliersWorkCategoriesCodes.includes(option.dataset.value))
      option.classList.remove("d-none");
    else
      option.classList.add("d-none");
  });
}

function updateProductsServicesFilter(){
  console.log(suppliersProductsServicesCodes);
}

function updateStatusFilter(){
  const statusContainer = document.getElementById('status');
  const statusMultiSelect = statusContainer.querySelector('.multi-select-options');
  const statusOptions = statusMultiSelect.querySelectorAll('.multi-select-option');

  statusOptions.forEach(option => {
    if(suppliersStatus.includes(option.dataset.value))
      option.classList.remove("d-none");
    else
      option.classList.add("d-none");
  });
}