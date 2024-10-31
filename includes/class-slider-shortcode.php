<?php
namespace Slider; // Define the namespace for the class

use WP_Query; // Import WP_Query for cleaner code

/**
 * Class Slider_Shortcode
 * Handles the registration and rendering of the slider shortcode
 */
class Slider_Shortcode {

    /**
     * Register the shortcode
     */
    public static function register(): void {
        add_shortcode('slider', [__CLASS__, 'render_slider']);
    }

    /**
     * Render the slider
     *
     * @param array $atts Shortcode attributes
     * @return string Rendered HTML output of the slider
     */
    public static function render_slider(array $atts): string {
        // Use the post type from the CPT manager class
        $args = [
            'post_type' => Slider_CPT_Manager::get_post_type(),
            'posts_per_page' => -1, // Get all posts
        ];

        $slider_query = new WP_Query($args); // Use WP_Query to fetch posts

        if ($slider_query->have_posts()) {
            $output = '<div class="slider slider--active owl-carousel">';

            while ($slider_query->have_posts()) {
                $slider_query->the_post();

                $output .= '<div class="slider__item">';
                if (has_post_thumbnail()) {
                    $output .= get_the_post_thumbnail(
                        get_the_ID(),
                        'full',
                        [
                            'alt' => esc_attr(get_the_title()), // Set alt attribute for accessibility
                            'class' => 'slider__image'
                        ]
                    );
                }

                $output .= '<h2 class="screen-reader-text">' . esc_html(get_the_title()) . '</h2>'; // For screen readers
                $output .= '<div class="screen-reader-text">' . wp_kses_post(get_the_content()) . '</div>'; // Content for screen readers
                $output .= '</div>'; // Close slider item
            }

            $output .= '</div>'; // Close slider container
            wp_reset_postdata(); // Reset the global post object

            return $output; // Return the rendered output
        }

        return '<p class="slider__no-items">No sliders found.</p>'; // Message if no posts found
    }
}
