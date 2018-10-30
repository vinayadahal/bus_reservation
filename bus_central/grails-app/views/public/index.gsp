<!doctype html>
<html>
<head>
    <meta name="layout" content="template"/>
    <title>Home - Bus Central</title>
</head>

<body>
<div class="slider_wrap">
    <!-- Slideshow container -->
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <!--<div class="numbertext">1 / 3</div>-->
            <asset:image src="slider/1-2.jpg" style="width: 100%"/>
            <!--<div class="text">Caption Text</div>-->
        </div>

        <div class="mySlides fade">
            <!--<div class="numbertext">1 / 3</div>-->
            <asset:image src="slider/bus1.jpg" style="width: 100%"/>
            <!--<div class="text">Caption Text</div>-->
        </div>
        <!-- Next and previous buttons -->
        <a class="prev" onclick="lastSlide()">&#10094;</a>
        <a class="next" onclick="nextSlide()">&#10095;</a>

        <!-- The dots/circles -->
        <div class="dot_wrap" style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>

    </div>
</div>
</body>
</html>
