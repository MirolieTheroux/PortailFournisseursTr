fetchServices()

/*function highlightText(text, searchTerm) {
  const regex = new RegExp(`(${searchTerm})`, 'gi'); // Create a regex to match the search term
  return text.replace(regex, '<span class="highlight">$1</span>'); // Wrap matches in a span
}*/

//TEST
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
//ENDTEST

function fetchServices() {
    const searchTerm = document.getElementById('service-search').value;

    // Make an AJAX request to the server to get filtered services
    fetch(`/services?search=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
            const serviceList = document.getElementById('service-list');
            serviceList.innerHTML = ''; // Clear previous results

            data.forEach(service => {
                const serviceItem = document.createElement('div');
                serviceItem.classList.add('row', 'align-items-start', 'mt-2');

                // Highlighting the code and description with the search term
                const highlightedCode = highlightText(service.code, searchTerm);
                const highlightedDescription = highlightText(service.description, searchTerm);

                serviceItem.innerHTML = `
                    <div class="col-1 col-md-1 d-flex flex-column justify-content-start">
                        <input class="form-check-input" type="checkbox" onclick="checkedbox(this)" id="category${service.id}" value="">
                    </div>
                    <div class="col-3 col-md-3 d-flex flex-column justify-content-start">
                        <label class="form-check-label" for="category${service.id}">${highlightedCode}</label>
                    </div>
                    <div class="col-8 col-md-8 d-flex flex-column justify-content-start">
                        <label class="form-check-label" for="category${service.id}">${highlightedDescription}</label>
                    </div>
                `;
                serviceList.appendChild(serviceItem);
            });
        })
        .catch(error => console.error('Error fetching services:', error));
}