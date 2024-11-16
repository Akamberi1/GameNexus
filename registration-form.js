document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email-address');
    const confirmEmailInput = document.getElementById('confirm-email');
    const passwordInput = document.getElementById('password');
    
    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const confirmEmailError = document.getElementById('confirmEmailError');
    const passwordError = document.getElementById('passwordError');

    usernameInput.classList.remove('error');
    emailInput.classList.remove('error');
    confirmEmailInput.classList.remove('error');
    passwordInput.classList.remove('error');

    usernameError.style.display = 'none';
    emailError.style.display = 'none';
    confirmEmailError.style.display = 'none';
    passwordError.style.display = 'none';

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; 

    let isValid = true;

    if (usernameInput.value.trim() === "") {
        usernameInput.classList.add('error');
        usernameError.style.display = 'block';
        isValid = false;
    }

    if (!emailRegex.test(emailInput.value)) {
        emailInput.classList.add('error');
        emailError.style.display = 'block';
        isValid = false;
    }

    if (confirmEmailInput.value !== emailInput.value) {
        confirmEmailInput.classList.add('error');
        confirmEmailError.style.display = 'block';
        isValid = false;
    }

    if (!passwordRegex.test(passwordInput.value)) {
        passwordInput.classList.add('error');
        passwordError.style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        alert('Registration successful!');
    }
});