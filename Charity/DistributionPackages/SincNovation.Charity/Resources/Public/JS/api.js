// API call to validate donation code
async function validateDonationCode(code) {
    try{
        const response = await fetch(`/donation-code/validate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                code: code,
            })
        });
        return response.json();
    } catch (error) {
        console.error('Error', error);
        return {success: false, message: 'An error occured'};
    }
}

// API call to get the list of organizations
async function fetchOrganizations() {
    const response = await fetch(`/organizations/list`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    return response.json();
}

// API call to create a donation
async function createDonationAPI(organizationId, donationCode) {
    const response = await fetch(`/donations/createDonation`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            organizationId: organizationId,
            donationCode: donationCode
        })
    });
    return response.json();
}