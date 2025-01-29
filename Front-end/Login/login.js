// Validation of login form

let button = document.getElementsByClassName("btn-submit");


button[0].addEventListener('click',(event)=>{

    const usernameRegex = /^(?!.*\s)[a-zA-Z0-9]{3,20}$/;

    const passwordRegex = /^(?!.*\s)(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    

    console.log("Clickin!");

    // event.preventDefault();
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    if(username.value.trim() === "" || username.value.trim() == null){
        alert("Username cant be blank!");
        username.focus();
        return false;
    }
    else if(!usernameRegex.test(username.value)){
        alert("Username must be 3-20 characters long and can only contain letters and numbers.(No whitespaces !)");
        username.focus();
        return false;
    }

    if(password.value.trim() === "" || password.value.trim() == null){
        alert("Password cant be blank!");
        password.focus();
        return false;
    }
    else if(!passwordRegex.test(password.value)){
        alert("Password must be at least 8 characters long and contain at least one letter and one number.(No whitespaces !)");
        password.focus();
        return false;
    }

    console.log("Sent!")
    console.log("Username:", username.value);
    console.log("Password:", password.value);

    // Reset the form after submission
    let loginForm = document.getElementById("login-form");

    // window.location.href = "../../Back-end/login/login.php";

    loginForm.reset();

})