import 'owl.carousel'; // Ensure Owl Carousel is installed via npm
import '../../scss/styles.scss'; // Import your SCSS for styles

// Initialize Owl Carousel
jQuery(document).ready(function ($) {
    $('.owl-carousel').owlCarousel({
        items: 2,
        loop: true,
        margin: 15,
        nav: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });
});
