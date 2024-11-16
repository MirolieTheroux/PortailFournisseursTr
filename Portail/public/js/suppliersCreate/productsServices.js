const productsCategories = document.getElementById('products-categories');
let debounceTimer = 0;
let offset = 0;
const limit = 50;
let scrolled = false;
let totalCount = 0;
let curentCount = 0;

function fetchServices() {
    const searchTerm = document.getElementById('service-search').value;

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        fetch(`/services?search=${encodeURIComponent(searchTerm)}&offset=${offset}&limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                const serviceList = document.getElementById('service-list');
                
                if (offset === 0) {
                    serviceList.innerHTML = ''; // Clear previous results
                }
                curentCount = data.services.length + offset;
                totalCount = data.total_count;

                const resultCount = document.getElementById('results-count');
                resultCount.innerHTML = `${curentCount} sur ${totalCount} resultat(s)`; // Update with count of results shown vs total

                data.services.forEach(service => {
                    const serviceItem = document.createElement('div');
                    serviceItem.classList.add('row', 'align-items-start', 'py-2', 'hover-options', 'user-select-none');

                    // Original values for non-highlighted cloning
                    const originalCode = service.code;
                    const originalDescription = service.description;

                    // Highlighting the code and description with the search term
                    const highlightedCode = highlightText(originalCode, searchTerm);
                    const highlightedDescription = highlightText(originalDescription, searchTerm);

                    serviceItem.innerHTML = `
                        <div class="col-4 col-md-12 col-xl-4 d-flex flex-column justify-content-start">
                            <label class="form-check-label" id="category${service.code}">${highlightedCode}</label>
                        </div>
                        <div class="col-8 col-md-11 offset-md-1 offset-xl-0 col-xl-8 d-flex flex-column justify-content-start">
                            <label class="form-check-label" id="category${service.code}">${highlightedDescription}</label>
                        </div>
                    `;

                    // Check for existing cloned services and hide originals if found
                    const clonedService = document.querySelector(`#service-selected [data-code="${service.code}"]`);
                    if (clonedService) {
                        serviceItem.classList.add('disabled-options'); // Hide the original if a cloned service exists
                    }

                    // Handle click event for selecting service
                    serviceItem.addEventListener('click', function () {
                        serviceItem.classList.add('disabled-options');

                        // Clone the service without the highlight
                        const selectedService = document.createElement('div');
                        selectedService.classList.add('row', 'align-items-start', 'py-2', 'hover-options', 'user-select-none');
                        selectedService.dataset.code = service.code;

                        selectedService.innerHTML = `
                            <input type="text" name="products_services[]" value="${originalCode}" class="d-none">
                            <div class="col-4 col-md-12 col-xl-4 d-flex flex-column justify-content-start">
                                ${originalCode}
                            </div>
                            <div class="col-8 col-md-11 offset-md-1 offset-xl-0 col-xl-8 d-flex flex-column justify-content-start">
                                ${originalDescription}
                            </div>
                        `;

                        // Handle click event on the cloned service to remove it and show the original
                        addSelectedServiceListener(selectedService);

                        // Insert the cloned service into the selected services list
                        const selectedContainer = document.getElementById('service-selected');
                        selectedContainer.appendChild(selectedService);
                    });

                    serviceList.appendChild(serviceItem);
                });

                // Call update function to handle hiding originals if cloned versions exist
                updateServiceList();
            })
            .catch(error => console.error('Error fetching services:', error));
            scrolled = false;
    }, 500); // 0.5 second delay
}

function loadMoreServices() {
    if (productsCategories.scrollTop >= productsCategories.scrollHeight-606  && scrolled == false && curentCount < totalCount){
        offset += limit; // Increment offset
        scrolled = true;
        fetchServices(); // Fetch services with new offset
    }
}

function updateServiceList() {
    // Get all cloned services
    const clonedServices = document.querySelectorAll('#service-selected .row');
    
    clonedServices.forEach(clonedService => {
        const clonedCode = clonedService.dataset.code;
        const originalService = document.getElementById(`category${clonedCode}`);
        
        // Hide the original if it exists and has a corresponding cloned version
        if (originalService) {
            originalService.closest('.row').classList.add('disabled-options'); // Hide the original service
        }
    });
}

productsCategories.addEventListener('scroll', loadMoreServices);

fetchServices();
var searchBar = document.getElementById('service-search');
searchBar.addEventListener("input", function() {
    offset = 0; // Reset offset when searching new terms
    productsCategories.scrollTop = 0;
    fetchServices();
});


function removeAccents(text) {
    return text.normalize('NFD').replace(/[\u0300-\u036f]/g, ''); // Normalize and remove accents
}

function highlightText(text, searchTerm) {
    const normalizedText = removeAccents(text);
    const normalizedSearchTerm = removeAccents(searchTerm);

    // Find the starting index of the match
    const index = normalizedText.toLowerCase().indexOf(normalizedSearchTerm.toLowerCase());

    // If the search term is found in the text, highlight it
    if (index !== -1) {
        const highlightedText = `
            ${text.substring(0, index)}<span class="highlight">${text.substring(index, index + searchTerm.length)}</span>${text.substring(index + searchTerm.length)}
        `;
        return highlightedText;
    }

    // Return the original text if no match is found
    return text;
}

getSelectedServiceElements();
function getSelectedServiceElements(){
    const selectedServiceContainer = document.getElementById('service-selected');
    const selectedServiceList = selectedServiceContainer.children;

    for (let index = 0; index < selectedServiceList.length; index++) {
        const selectedService = selectedServiceList[index];
        addSelectedServiceListener(selectedService);
    }
}

function addSelectedServiceListener(selectedService){
    selectedService.addEventListener('click', function () {
        const selectedServiceCode = selectedService.querySelector('input').value;

        const originalService = document.getElementById(`category${selectedServiceCode}`);
        if (originalService) {
            originalService.closest('.row').classList.remove('disabled-options'); // Show the original service
        }

        const selectedContainer = document.getElementById('service-selected');
        selectedContainer.removeChild(selectedService);
    });
}