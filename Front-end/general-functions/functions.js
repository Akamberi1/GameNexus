// Display login and signup function

let profile = document.getElementsByClassName("profile-logo");


profile[0].addEventListener('click',()=>{
    let loginSignup = document.getElementsByClassName('loginSignupPop');
    
    if(loginSignup[0].style.display == ''){
        loginSignup[0].style.display = 'block';
        document.getElementsByClassName("overlay")[0].style.display = 'flex'
    }
    // else if(loginSignup[0].style.display == 'block'){
    //     loginSignup[0].style.display = '';
    // }


    // loginSignup[0].style.display = 'block';
})

const overlay = document.querySelector(".overlay");
overlay.addEventListener("click",()=>{
    document.getElementsByClassName('loginSignupPop')[0].style.display = '';
    document.getElementsByClassName("overlay")[0].style.display ='';
})


// redirect to login and signup page function

let loginSignup = document.getElementsByClassName("lS");

loginSignup[0].addEventListener("click",()=>{
    console.log("click!");
    window.location.href = '../Login/login.html';

})


loginSignup[1].addEventListener("click",()=>{

    window.location.href = '../Register/registration-form.php';

})


// Redirect to cart page after clicking cart logo;

let shoppingLogo = document.getElementsByClassName("shopping-logo");
let circleNotification = document.getElementsByClassName("cart-notification-circle");

shoppingLogo[0].addEventListener("click",()=>{

    window.location.href = '../Cart/cart.php';

    circleNotification[0].style.display = "";

})

// redirect to product-details page after clicking on a product

let products = document.querySelectorAll(".product");

products.forEach(product => {
    product.addEventListener("click",()=>{
        console.log("Working!")
        window.location.href = '../Product-details/product-details.html';

    })
});


let facebook = document.getElementById("facebook");
let instagram = document.getElementById("instagram");
let twitter = document.getElementById("twitter");

facebook.addEventListener("click",()=>{
    window.location.href = "https://www.facebook.com/arlind.kamberi.9/";
})
instagram.addEventListener("click",()=>{
    window.location.href = "https://www.instagram.com/arlindkamberii/";
})
twitter.addEventListener("click",()=>{
    window.location.href = "https://x.com/Kaiyoto_lol";
})