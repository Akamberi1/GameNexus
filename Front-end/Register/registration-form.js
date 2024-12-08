let registerButton = document.getElementsByClassName("btn-submit");

registerButton[0].addEventListener("click", (event) => {
    event.preventDefault();

    const username = document.getElementById("username");
    const email = document.getElementById("email-address");
    const confirmEmail = document.getElementById("confirm-email");
    const password = document.getElementById("password");
    const country = document.getElementById("select-country");
    const isHuman = document.getElementById("i-am-human").checked;
    const agreeTerms = document.getElementById("agree-terms").checked;

    const usernameRegex = /^(?!.*\s)[a-zA-Z0-9]{3,20}$/;
    const passwordRegex = /^(?!.*\s)(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; 
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

    if (username.value.trim() === "" || username.value == null) {
        alert("Username can't be blank!");
        username.focus();
        return false;
    } else if (!usernameRegex.test(username.value)) {
        alert("Username must be 3-20 characters long and contain only letters and numbers (no whitespace)!");
        username.focus();
        return false;
    }

    if (email.value.trim() === "" || email.value == null) {
        alert("Email can't be blank!");
        email.focus();
        return false;
    } else if (!emailRegex.test(email.value)) {
        alert("Invalid email format. Make sure it includes '@' and a domain (e.g., '.com').");
        email.focus();
        return false;
    }

    if (email.value !== confirmEmail.value) {
        alert("Email addresses do not match.");
        confirmEmail.focus();
        return false;
    }

    if (password.value.trim() === "" || password.value == null) {
        alert("Password can't be blank!");
        password.focus();
        return false;
    } else if (!passwordRegex.test(password.value)) {
        alert("Password must be at least 8 characters long and contain at least one letter and one number (no whitespace)!");
        password.focus();
        return false;
    }

    if (country.value === "") {
        alert("Please select your country of residence.");
        country.focus();
        return false;
    }

    if (!isHuman) {
        alert("Please confirm that you are human.");
        return false;
    }

    if (!agreeTerms) {
        alert("You must be 13 years of age or older and agree to the terms.");
        return false;
    }

    console.log("Registration Successful!");
    console.log("Username:", username.value);
    console.log("Email:", email.value);
    console.log("Password:", password.value);
    console.log("Country:", country.value);

    let registrationForm = document.getElementById("registration-form");

    window.location.href = "../Login/login.html";
    registrationForm.reset();
});
