// Display login and signup function

let profile = document.getElementsByClassName("profile-logo");


profile[0].addEventListener('click',()=>{
    let loginSignup = document.getElementsByClassName('loginSignupPop')
    
    if(loginSignup[0].style.display == ''){
        loginSignup[0].style.display = 'block';
    }
    else if(loginSignup[0].style.display == 'block'){
        loginSignup[0].style.display = '';
    }


    // loginSignup[0].style.display = 'block';
})


// redirect to login and signup page function

let loginSignup = document.getElementsByClassName("lS");

loginSignup[0].addEventListener("click",()=>{
    console.log("click!");
    window.location.href = '../Login/login.html';

})


loginSignup[1].addEventListener("click",()=>{

    window.location.href = '../Register/registration-form.html';

})


// Redirect to cart page after clicking cart logo;

let shoppingLogo = document.getElementsByClassName("shopping-logo");
let circleNotification = document.getElementsByClassName("cart-notification-circle");

shoppingLogo[0].addEventListener("click",()=>{

    window.location.href = '../Cart/cart.html';

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


