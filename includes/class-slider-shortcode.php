<?php

class Slider_Shortcode {

    public static function register(): void {
        add_shortcode('slider', [__CLASS__, 'render_slider']);
    }

    public static function render_slider(array $atts): string {
        // Use the post type from the CPT manager class
        $args = [
            'post_type' => Slider_CPT_Manager::get_post_type(),
            'posts_per_page' => -1,
        ];

        $slider_query = new WP_Query($args);

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
                            'alt' => esc_attr(get_the_title()),
                            'class' => 'slider__image'
                        ]
                    );
                }

                $output .= '<h2 class="screen-reader-text">' . esc_html(get_the_title()) . '</h2>';
                $output .= '<div class="screen-reader-text">' . wp_kses_post(get_the_content()) . '</div>';
                $output .= '</div>';
            }

            $output .= '</div>';
            wp_reset_postdata();

            return $output;
        }

        return '<p class="slider__no-items">No sliders found.</p>';
    }
}
