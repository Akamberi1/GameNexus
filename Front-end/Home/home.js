document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".slider");
    const slides = document.querySelectorAll(".carousel-linqet");
    const prevButton = document.querySelector(".prev");
    const nextButton = document.querySelector(".next");

    let index = 0; // Track the current position
    const visibleSlides = 3; // Number of visible slides
    const totalSlides = slides.length;
    const slideWidth = slides[0].offsetWidth; // Width of each slide + margin (adjust if needed)

    // Function to update slider position
    function updateSlider() {
        slider.style.transform = `translateX(-${index * slideWidth}px)`;
    }

    // Next button click
    nextButton.addEventListener("click", function () {
        console.log("clicked right!");
        if (index < totalSlides - visibleSlides) {
            index++;
        } else {
            index = 0; // Loop back to the first slide
        }
        updateSlider();
    });

    // Previous button click
    prevButton.addEventListener("click", function () {
        console.log("clicked left!");
        if (index > 0) {
            index--;
        } else {
            index = totalSlides - visibleSlides; // Loop to the last visible set
        }
        updateSlider();
    });
});