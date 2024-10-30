<?php

class Slider_Shortcode {

    public function __construct() {
        add_shortcode('slider', [$this, 'render_slider']);
    }

    public function render_slider($atts) {
        // Query for the Slider Custom Post Type (CPT)
        $args = [
            'post_type' => 'slider',
            'posts_per_page' => -1,
        ];

        $slider_query = new WP_Query($args);

        // Check if there are any slides
        if ($slider_query->have_posts()) {
            // BEM-compliant structure for the slider
            $output = '<div class="slider slider--active owl-carousel">';

            while ($slider_query->have_posts()) {
                $slider_query->the_post();
                $output .= '<div class="slider__item">';

                if (has_post_thumbnail()) {
                    // SEO best practice: Alt attribute for images
                    $output .= get_the_post_thumbnail(get_the_ID(), 'full', ['alt' => esc_attr(get_the_title())]);
                }

                // Keep title and content in HTML for SEO, but visually hide them
                $output .= '<h2 class="slider__title slider__title--hidden">' . esc_html(get_the_title()) . '</h2>';
                $output .= '<div class="slider__content slider__content--hidden">' . wpautop(get_the_content()) . '</div>';
                $output .= '</div>';
            }

            $output .= '</div>'; // Close slider container
            wp_reset_postdata();

            // Return the HTML for the slider
            return $output;
        }

        // Return message if no slides are found
        return '<p class="slider__no-items">No sliders found.</p>';
    }
}
