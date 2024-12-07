// Added to cart notification function

let addToCartBtn = document.getElementsByClassName("text");

addToCartBtn[0].addEventListener("click",()=>{
    let text = document.getElementsByClassName("cart-notification-p");
    let circleNotification = document.getElementsByClassName("cart-notification-circle");
    
    let counter = text[0].textContent;


    if(circleNotification[0].style.display == ''){
        circleNotification[0].style.display = 'flex';
        addToCartBtn[0].style.cursor = 'default';
        addToCartBtn[0].disabled = true;
        counter++;
        text[0].textContent = counter;
    }
    
})