var navLinks = document.getElementById("navLinks");
function showMenu(){
    navLinks.style.right = "0";
}
function hideMenu(){
    navLinks.style.right = "-200px";
}


const slides = document.querySelectorAll('.campus-col');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentSlide = 0;
    const slidesToShow = 3; // Number of slides to show at once

    function showSlides() {
        const totalSlides = slides.length;
        const maxSlideIndex = Math.ceil(totalSlides / slidesToShow) - 1; // Calculate the maximum slide index
        currentSlide = Math.max(0, Math.min(currentSlide, maxSlideIndex)); // Ensure currentSlide is within bounds
        const offset = -currentSlide * (100 / slidesToShow); // Calculate the offset for the transform
        slides.forEach((slide) => {
            slide.style.transform = `translateX(${offset}%)`;
        });
    }

    function nextSlide() {
        const totalSlides = slides.length;
        if (currentSlide < Math.ceil(totalSlides / slidesToShow) - 1) {
            currentSlide++;
        }
        showSlides();
    }

    function prevSlide() {
        if (currentSlide > 0) {
            currentSlide--;
        }
        showSlides();
    }

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    // Initially show the first set of slides
    showSlides();


    const gameSlides = document.querySelectorAll('.game-col');
    const gamePrevButton = document.querySelector('.game-slider .prevs');
    const gameNextButton = document.querySelector('.game-slider .nexts');
    let gameCurrentSlide = 0;
    const gameSlidesToShow = 3; // Number of slides to show at once

    function showGameSlides() {
        const totalGameSlides = gameSlides.length;
        const maxGameSlideIndex = Math.ceil(totalGameSlides / gameSlidesToShow) - 1; // Calculate the maximum slide index
        gameCurrentSlide = Math.max(0, Math.min(gameCurrentSlide, maxGameSlideIndex)); // Ensure currentSlide is within bounds
        const offset = -gameCurrentSlide * (100 / gameSlidesToShow); // Calculate the offset for the transform
        gameSlides.forEach((slide) => {
            slide.style.transform = `translateX(${offset}%)`;
        });
    }

    function gameNextSlide() {
        const totalGameSlides = gameSlides.length;
        if (gameCurrentSlide < Math.ceil(totalGameSlides / gameSlidesToShow) - 1) {
            gameCurrentSlide++;
        }
        showGameSlides();
    }

    function gamePrevSlide() {
        if (gameCurrentSlide > 0) {
            gameCurrentSlide--;
        }
        showGameSlides();
    }

    gameNextButton.addEventListener('click', gameNextSlide);
    gamePrevButton.addEventListener('click', gamePrevSlide);

    // Initially show the first set of slides
    showGameSlides();
