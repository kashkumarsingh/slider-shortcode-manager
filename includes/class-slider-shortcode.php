<?php
namespace Slider;

use WP_Query;

class Slider_Shortcode {
    public static function register(): void {
        add_shortcode('slider', [__CLASS__, 'render_slider']);
    }

    public static function render_slider(array $atts): string {
        error_log('Slider Shortcode - Raw Attributes: ' . print_r($atts, true));

        $atts = shortcode_atts([
            'numberofslides'   => -1,
            'defaultposttype'  => Slider_CPT_Manager::get_post_type(),
            'slidernavigation' => 'true',
            'autoplay'         => 'true',
            'linkto'           => '',
        ], $atts, 'slider');

        error_log('Slider Shortcode - After shortcode_atts: ' . print_r($atts, true));

        $number_of_slides = intval($atts['numberofslides']);
        $post_type = sanitize_key($atts['defaultposttype']);
        $navigation = filter_var($atts['slidernavigation'], FILTER_VALIDATE_BOOLEAN);
        $autoplay = filter_var($atts['autoplay'], FILTER_VALIDATE_BOOLEAN);
        $link_to = sanitize_text_field($atts['linkto']);

        error_log("Slider Shortcode - Post Type: $post_type, Number of Slides: $number_of_slides, Navigation: " . ($navigation ? 'true' : 'false') . ", Autoplay: " . ($autoplay ? 'true' : 'false') . ", LinkTo: '$link_to'");

        if (!post_type_exists($post_type)) {
            error_log("Post type '$post_type' does not exist, falling back to 'slider'");
            $post_type = Slider_CPT_Manager::get_post_type();
        }

        $args = [
            'post_type'      => $post_type,
            'posts_per_page' => $number_of_slides,
            'post_status'    => 'publish',
        ];

        $slider_query = new WP_Query($args);
        error_log("Slider Query - Found Posts: " . $slider_query->found_posts);

        if ($slider_query->have_posts()) {
            $slider_id = 'slider-' . uniqid();
            $slider_html = sprintf(
                '<div id="%s" class="swiper slider slider--active" data-navigation="%s" data-autoplay="%s">',
                esc_attr($slider_id),
                esc_attr($navigation ? 'true' : 'false'),
                esc_attr($autoplay ? 'true' : 'false')
            );
            $slider_html .= '<div class="swiper-wrapper">';

            // Check if post type has permalinks (except for 'slider')
            $post_type_obj = get_post_type_object($post_type);
            $has_permalinks = $post_type_obj->public && $post_type !== 'slider' && !empty(get_permalink($slider_query->posts[0]->ID));

            // Resolve linkto URL once if needed
            $linkto_url = '';
            if (!empty($link_to) && ($post_type === 'slider' || !$has_permalinks)) {
                $link_post = get_page_by_path($link_to, OBJECT, 'page');
                if ($link_post) {
                    $linkto_url = get_permalink($link_post->ID);
                    error_log("Slider Shortcode - LinkTo URL: $linkto_url");
                } else {
                    error_log("Slider Shortcode - LinkTo '$link_to' not found");
                }
            }

            while ($slider_query->have_posts()) {
                $slider_query->the_post();
                $post_id = get_the_ID();
                $slider_html .= '<div class="swiper-slide slider__item">';
                if (has_post_thumbnail()) {
                    $thumbnail = get_the_post_thumbnail(
                        $post_id,
                        'full',
                        ['alt' => esc_attr(get_the_title()), 'class' => 'slider__image']
                    );
                    if ($has_permalinks) {
                        // Link to post permalink for non-'slider' public post types
                        $permalink = get_permalink($post_id);
                        $slider_html .= '<a href="' . esc_url($permalink) . '" class="slider__link">' . $thumbnail . '</a>';
                    } elseif (!empty($linkto_url)) {
                        // Link to linkto URL for 'slider' or non-public post types
                        $slider_html .= '<a href="' . esc_url($linkto_url) . '" class="slider__link">' . $thumbnail . '</a>';
                    } else {
                        // No link
                        $slider_html .= $thumbnail;
                    }
                }
                $slider_html .= '<h2 class="screen-reader-text">' . esc_html(get_the_title()) . '</h2>';
                $slider_html .= '<div class="screen-reader-text">' . wp_kses_post(get_the_content()) . '</div>';
                $slider_html .= '</div>';
            }

            $slider_html .= '</div>';
            $slider_html .= '<div class="swiper-pagination"></div>';
            if ($navigation) {
                $slider_html .= '<div class="swiper-button-prev"></div>';
                $slider_html .= '<div class="swiper-button-next"></div>';
            }
            $slider_html .= '</div>';

            wp_reset_postdata();
            return $slider_html;
        }

        return '<p class="slider__no-items">' . esc_html__('No items found for this slider.', 'slider-shortcode-manager') . '</p>';
    }
}