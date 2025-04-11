import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import '../../scss/styles.scss';
import '../../scss/styles.scss';

Swiper.use([Navigation, Pagination, Autoplay]);
jQuery(function ($) {
    console.log('Swiper JS loaded');
    $('.slider--active').each(function () {
        const $slider = $(this);
        const navigation = $slider.data('navigation') === 'true';
        const autoplayAttr = $slider.attr('data-autoplay');
        const autoplay = autoplayAttr === 'true';
        const slideCount = $slider.find('.swiper-slide').length;

        // Detect if in sidebar
        const isSidebar = $slider.closest('.widget, .sidebar, #secondary').length > 0;

        console.log('Slider ID:', $slider.attr('id'));
        console.log('Navigation:', navigation);
        console.log('Autoplay Attr:', autoplayAttr);
        console.log('Autoplay:', autoplay);
        console.log('Slide Count:', slideCount);
        console.log('Is Sidebar:', isSidebar);

        new Swiper($slider[0], {
            loop: slideCount > 3,
            spaceBetween: 10,
            grabCursor: true,
            autoplay: autoplay ? {
                delay: 2500,
                disableOnInteraction: false,
            } : false,
            navigation: navigation ? {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            } : false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                600: { slidesPerView: 2 },
                1000: isSidebar ? 
                    { slidesPerView: 1 } : // Sidebar: 1 slide at 1000px
                    { slidesPerView: slideCount > 2 ? 3 : 1 }, // Front page: 3 or 1
            },
        });
    });
});