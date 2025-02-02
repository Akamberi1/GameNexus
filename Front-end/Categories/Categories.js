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

document.addEventListener("DOMContentLoaded", () => {
    const carousels = document.querySelectorAll(".carousel-images");
    const imageWidth = 33.33; // Percentage width of images
    
    carousels.forEach((carousel) => {
      let images = carousel.querySelectorAll("img");
      let index = 0;
  
      // Duplicate images for infinite effect
      images.forEach((img) => {
        let clone = img.cloneNode(true);
        carousel.appendChild(clone);
      });
  
      function showNextImage() {
        index++;
  
        // Apply smooth transition
        carousel.style.transition = "transform 0.8s ease-in-out";
        carousel.style.transform = `translateX(-${index * imageWidth}%)`;
  
        // Reset loop when reaching the cloned set
        if (index >= images.length) {
          setTimeout(() => {
            carousel.style.transition = "none"; // Instantly reset without animation
            index = 0;
            carousel.style.transform = `translateX(0)`;
          }, 800); // Match the transition speed for perfect sync
        }
      }
  
      setInterval(showNextImage, 3000);
    });
  });
  
  
