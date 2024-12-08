let registerButton = document.getElementsByClassName("btn-submit");

registerButton[0].addEventListener("click", (event) => {
    event.preventDefault(); // Prevent form submission

    const username = document.getElementById("username");
    const email = document.getElementById("email-address");
    const confirmEmail = document.getElementById("confirm-email");
    const password = document.getElementById("password");
    const country = document.getElementById("select-country");
    const isHuman = document.getElementById("i-am-human").checked;
    const agreeTerms = document.getElementById("agree-terms").checked;

    const usernameRegex = /^(?!.*\s)[a-zA-Z0-9]{3,20}$/; // No whitespace, 3-20 characters
    const passwordRegex = /^(?!.*\s)(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 chars, 1 letter, 1 number, no whitespace
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email validation

    // Username validation
    if (username.value.trim() === "" || username.value == null) {
        alert("Username can't be blank!");
        username.focus();
        return false;
    } else if (!usernameRegex.test(username.value)) {
        alert("Username must be 3-20 characters long and contain only letters and numbers (no whitespace)!");
        username.focus();
        return false;
    }

    // Email validation
    if (email.value.trim() === "" || email.value == null) {
        alert("Email can't be blank!");
        email.focus();
        return false;
    } else if (!emailRegex.test(email.value)) {
        alert("Invalid email format. Make sure it includes '@' and a domain (e.g., '.com').");
        email.focus();
        return false;
    }

    // Confirm email validation
    if (email.value !== confirmEmail.value) {
        alert("Email addresses do not match.");
        confirmEmail.focus();
        return false;
    }

    // Password validation
    if (password.value.trim() === "" || password.value == null) {
        alert("Password can't be blank!");
        password.focus();
        return false;
    } else if (!passwordRegex.test(password.value)) {
        alert("Password must be at least 8 characters long and contain at least one letter and one number (no whitespace)!");
        password.focus();
        return false;
    }

    // Country validation
    if (country.value === "") {
        alert("Please select your country of residence.");
        country.focus();
        return false;
    }

    // Human verification
    if (!isHuman) {
        alert("Please confirm that you are human.");
        return false;
    }

    // Terms agreement
    if (!agreeTerms) {
        alert("You must be 13 years of age or older and agree to the terms.");
        return false;
    }

    // Success
    console.log("Registration Successful!");
    console.log("Username:", username.value);
    console.log("Email:", email.value);
    console.log("Password:", password.value);
    console.log("Country:", country.value);

    // Reset the form after successful validation
    let registrationForm = document.getElementById("registration-form");

    window.location.href = "../Login/login.html"; // Redirect to Login
    registrationForm.reset(); // Reset the form
});
