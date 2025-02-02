document.addEventListener("DOMContentLoaded", function() {
    let registerButton = document.querySelector(".btn-submit");

    registerButton.addEventListener("click", function(event) {
        event.preventDefault();

        const username = document.getElementById("username");
        const email = document.getElementById("email-address");
        const confirmEmail = document.getElementById("confirm-email");
        const password = document.getElementById("password");
        const roles = document.getElementById("select-role");
        const country = document.getElementById("select-country");
        const isHuman = document.getElementById("i-am-human").checked;
        const agreeTerms = document.getElementById("agree-terms").checked;

        const usernameRegex = /^(?!.*\s)[a-zA-Z0-9]{3,20}$/;
        const passwordRegex = /^(?!.*\s)(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        let isValid = true; // Flag to track overall form validity

        if (username.value.trim() === "" || username.value == null) {
            alert("Username can't be blank!");
            username.focus();
            isValid = false;
        } else if (!usernameRegex.test(username.value)) {
            alert("Username must be 3-20 characters long and contain only letters and numbers (no whitespace)!");
            username.focus();
            isValid = false;
        }

        if (email.value.trim() === "" || email.value == null) {
            alert("Email can't be blank!");
            email.focus();
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            alert("Invalid email format. Make sure it includes '@' and a domain (e.g., '.com').");
            email.focus();
            isValid = false;
        }

        if (email.value !== confirmEmail.value) {
            alert("Email addresses do not match.");
            confirmEmail.focus();
            isValid = false;
        }

        if (password.value.trim() === "" || password.value == null) {
            alert("Password can't be blank!");
            password.focus();
            isValid = false;
        } else if (!passwordRegex.test(password.value)) {
            alert("Password must be at least 8 characters long and contain at least one letter and one number (no whitespace)!");
            password.focus();
            isValid = false;
        }

        if (roles.value === "") {
            alert("Please select a role (Admin or User).");
            roles.focus();
            isValid = false;
        }

        if (country.value === "") {
            alert("Please select your country of residence.");
            country.focus();
            isValid = false;
        }

        if (!isHuman) {
            alert("Please confirm that you are human.");
            isValid = false;
        }

        if (!agreeTerms) {
            alert("You must be 13 years of age or older and agree to the terms.");
            isValid = false;
        }

        if (isValid) {
            console.log("Registration Successful!");
            console.log("Username:", username.value);
            console.log("Email:", email.value);
            console.log("Password:", password.value);
            console.log("Roles:", roles.value);
            console.log("Country:", country.value);

            let registrationForm = document.getElementById("registration-form");

            // Proceed to submit the form or redirect after validations
            window.location.href = "../Login/login.html";
            registrationForm.reset(); // Reset the form after successful registration
        }
    });
});
