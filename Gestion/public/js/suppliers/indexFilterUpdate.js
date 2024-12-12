function updateDistrictAreas(){
  console.log(suppliersRegions);
  const districtAreasContainer = document.getElementById('districtAreas');
  const districtAreasMultiSelect = districtAreasContainer.querySelector('.multi-select-options');
  const districtAreasOptions = districtAreasMultiSelect.querySelectorAll('.multi-select-option');
  console.log(districtAreasOptions);

  districtAreasOptions.forEach(option => {
    if(suppliersRegions.includes(option.dataset.value))
      option.classList.remove("d-none");
    else
      option.classList.add("d-none");
  });
}