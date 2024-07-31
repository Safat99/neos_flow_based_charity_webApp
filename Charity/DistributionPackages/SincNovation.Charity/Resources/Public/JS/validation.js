// Functions to handle donation code validation result

async function validateCode() {
    const codeInput = document.getElementById('donationCode');
    const code = codeInput.value.trim();

    if (code === '') {
        showMessage('Bitte geben Sie einen Code ein / Please enter a code', true);
        return;
    }

    const result = await validateDonationCode(code);
    processDonationCodeValidationResult(result);
}

function processDonationCodeValidationResult(result) {
    if (result.status === 'success') {
        showMessage('');
        // Fetch and handle the list of organizations
        // fetchOrganizations().then(handleOrganizationsList);
        window.location.href = 'org';
    } else {
        showMessage(result.message, true)
    }
}

function showMessage(message, isError = false) {
    const messageElement = document.getElementById('message');
    const codeInput = document.getElementById('donationCode');
    messageElement.textContent = message;
    
    if (isError) {
        messageElement.classList.add('text-danger');
        messageElement.style.display = 'block'; // Show the error messag
        codeInput.classList.add('error');
    } else {
        messageElement.classList.remove('text-danger');
        messageElement.style.display = 'none'; // Hide the message
        codeInput.classList.remove('error');
    }
}

// function showMessage(htmlMessage, isError = false) {
//     const messageContainer = document.getElementById('message');
//     messageContainer.innerHTML = htmlMessage;  // Set the HTML content
//     messageContainer.style.display = htmlMessage ? 'block' : 'none';
//     messageContainer.style.color = isError ? 'red' : 'green';
// }
