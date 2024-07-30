// Function to handle and display the list of organizations
function handleOrganizationList(data) {
    const organizations = data.organizations;
    const organizationContainer = document.getElementById('organizationContainer');
    organizationContainer.innerHTML = ''; // Clear any existing content

    organizations.forEach(org => {
        const card = document.createElement('div');
        card.className = 'card';
        card.dataset.orgId = org.id; // Store the organization ID in a data attribute
        card.innerHTML = `
            <img src="${org.imageUrl}" class="card-img-top" alt="${org.name}">
            <div class="card-body">
                <h5 class="card-title">${org.name}</h5>
                <p class="card-text">${org.description}</p>
                <a href="${org.link}" class="card-link" target="_blank">${org.name}</a>
            </div>
        `;
        // Add event listener to highlight and select the card
        card.addEventListener('click', () => {
            // Remove the 'selected' class from any previously selected cards
            document.querySelectorAll('.card.selected').forEach(selectedCard => {
                selectedCard.classList.remove('selected');
            });
            // Add the 'selected' class to the clicked card
            card.classList.add('selected');
        });
        organizationContainer.appendChild(card);
    });
}

// Fetch organizations and display them
fetchOrganizations().then(handleOrganizationList);
