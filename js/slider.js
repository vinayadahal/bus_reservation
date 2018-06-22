var timeout;
var slideIndex = 1;

showSlides(slideIndex);



// Next/previous controls
//function plusSlides(n) {
////    console.log("console: " + (slideIndex += n));
//    clearTimeout(timeout);
////    showSlides(slideIndex += n);
//
//    if (n === -1) {
//        showSlides(slideIndex + n);
//    } else {
//        showSlides(slideIndex);
//    }
//}

function nextSlide() {
    clearTimeout(timeout);
    showSlides(slideIndex);
}

function lastSlide() {
    clearTimeout(timeout);
    
//    showSlides(slideIndex += -1);
    console.log(slideIndex += -1);
}

// Thumbnail image controls
function currentSlide(n) {
    clearTimeout(timeout);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
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
    console.log(slideIndex);

    timeout = setTimeout(function () {
        showSlides(slideIndex);
    }, 3000);
    slideIndex++;
}

//function continous_slider() {
//    console.log("Bla");
//    var i;
//    var slides = document.getElementsByClassName("mySlides");
//    var dots = document.getElementsByClassName("dot");
//    for (i = 0; i < slides.length; i++) {
//        slides[i].style.display = "none";
//    }
//    for (i = 0; i < dots.length; i++) {
//        dots[i].className = dots[i].className.replace(" active", "");
//    }
//    slides[slideIndex - 1].style.display = "block";
//    dots[slideIndex - 1].className += " active";
//    slideIndex++;
//    setTimeout(function () {
//        continous_slider()
//    }, 3000);
//}


