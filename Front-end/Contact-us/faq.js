const contactSubmitBtn = document.getElementById("submit-contact-btn");

contactSubmitBtn.addEventListener("click",(event)=>{
    event.preventDefault();

    // Regex-es
    const usernameRegex = /^(?!.*\s)[a-zA-Z0-9]{3,20}$/;
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    const subjectRegex = /^[A-Za-z0-9\s\-,.;!?()&'"]{3,100}$/;
    const messageRegex = /^[A-Za-z0-9\s\-,.;!?()&'"\n]{10,500}$/;

    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const subject = document.getElementById("subject");
    const message = document.getElementById("message");

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

    if(email.value.trim() === "" || email.value.trim() == null){
        alert("Email cant be blank!");
        email.focus();
        return false;
    }
    else if(!emailRegex.test(email.value.trim())){
        alert("Please enter a valid email address. The format: example@domain.com");
        email.focus();
        return false;
    }

    if(subject.value === "" || subject.value == null){
        alert("Subject is empty!");
        subject.focus();
        return false;
    }
    else if(!subjectRegex.test(subject.value)){
        alert("Subject must be between 3 and 100 characters long and can only contain letters, numbers, spaces, and common punctuation marks.");
        subject.focus();
        return false;
    }

    if(message.value === "" || message.value == null){
        alert("Message is empty!");
        message.focus();
        return false;
    }
    else if(!messageRegex.test(message.value)){
        alert("Message must be between 10 and 500 characters long and can only contain letters, numbers, spaces, and common punctuation marks.");
        message.focus();
        return false;
    }

    console.log("Sent!")
    console.log("Username:", username.value);
    console.log("Email:", email.value);
    console.log("Subject:", subject.value);
    console.log("Message:", message.value);

    const contactForm = document.getElementById("contact-us-form");

    contactForm.reset();

    alert("Your message has been sent.Thank you for reaching out! We'll try to reply as fast as we can. ^^");
    window.location.href = "/Front-end/Home/home.html";

})

// Dropdown logic

// const questions = document.querySelectorAll(".answers");

// questions.forEach(question =>{
//     question.addEventListener("click",()=>{

//         console.log("click")
//         let description = document.getElementsByClassName("extra-description");
        
//         let faqForm = document.getElementsByClassName("faqNForm");

//         description[0].style.display = "block";
//         question.style.height = "27vh";


//     })


// })


const questions = document.querySelectorAll(".answers");

questions.forEach(question => {
    question.addEventListener("click", () => {
        
        
        const allDescriptions = document.querySelectorAll(".extra-description");
        allDescriptions.forEach(description => {
            description.style.display = "none";
        });
        
        
        questions.forEach(q => {
            q.style.height = "13vh"; 
        });

        
        let description = question.querySelector(".extra-description");
        
        
        if (description) {
            description.style.display = "block"; 
            question.style.height = "27vh";
        }
    });
});