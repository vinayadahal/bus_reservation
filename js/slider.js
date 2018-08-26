var timeout;
var slideIndex = 1;
var previous = 0;
var slides = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("dot");
if (dots.length > 0) {
    showSlides(slideIndex);
}

function nextSlide() {
    clearTimeout(timeout);
    showSlides(slideIndex);
}

function lastSlide() {
    clearTimeout(timeout);
    slideIndex = (previous - 1);
    showSlides(slideIndex);
}

// Thumbnail image controls
function currentSlide(n) {
    clearTimeout(timeout);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";

    timeout = setTimeout(function () {
        showSlides(slideIndex);
    }, 3000);
    previous = slideIndex;
    slideIndex++;
}