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
            <a href="${org.link}" class="card-link" target="_blank">${org.link}</a>
            <p class="card-text">${org.description}</p>                
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

// Fetch organizations and display them when the page loads
document.addEventListener('DOMContentLoaded', () => {
    fetchOrganizations().then(handleOrganizationList);
});

// Function to create a donation
async function createDonation() {
    const selectedCard = document.querySelector('.card.selected');
    if (!selectedCard) {
        alert('Please select an organization.');
        return;
    }

    const organizationId = parseInt(selectedCard.dataset.orgId, 10);
    const donationCode = localStorage.getItem('donationCode');

    try {
        const result = await createDonationAPI(organizationId, donationCode);
        if (result.success === true) {
            alert('Donation successful!');
            // Optionally redirect to a success page or update the UI
            window.location.href = 'done';
        } else {
            alert('Failed to create donation: ' + result.message);
        }
    } catch (error) {
        console.error('Error creating donation:', error);
        alert('An error occurred while processing your donation.');
    }
}
