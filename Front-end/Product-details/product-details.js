let profile = document.getElementsByClassName("profile-logo");
let loginSignup = document.getElementsByClassName('loginSignupPop')


profile[0].addEventListener('click',()=>{

    if(loginSignup[0].style.display == ''){
        loginSignup[0].style.display = 'block';
    }
    else if(loginSignup[0].style.display == 'block'){
        loginSignup[0].style.display = '';
    }


    // loginSignup[0].style.display = 'block';
})