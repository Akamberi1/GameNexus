document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const username = document.getElementById('username').value;
    const email = document.getElementById('email-address').value;
    const confirmEmail = document.getElementById('confirm-email').value;
    const password = document.getElementById('password').value;
    const country = document.getElementById('select-country').value;
    const isHuman = document.getElementById('i-am-human').checked;
    const agreeTerms = document.getElementById('agree-terms').checked;

    const usernameRegex = /^[a-zA-Z0-9]{3,20}$/; 
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; 
    
    let isValid = true;

    if (!usernameRegex.test(username)) {
        alert('Username must be 3-20 characters long and can only contain letters and numbers.');
        isValid = false;
    }

    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        isValid = false;
    }

    if (email !== confirmEmail) {
        alert('Email addresses do not match.');
        isValid = false;
    }

    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long and contain at least one letter and one number.');
        isValid = false;
    }

    if (country === "") {
        alert('Please select your country of residence.');
        isValid = false;
    }

    if (!isHuman) {
        alert('Please confirm that you are human.');
        isValid = false;
    }

    if (!agreeTerms) {
        alert('You must be 13 years of age or older and agree to the terms.');
        isValid = false;
    }

    if (isValid) {
        alert('Form submitted successfully!');
    }
});