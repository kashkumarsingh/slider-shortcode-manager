<?php
namespace Slider;

class Slider_Assets_Manager {
    private static $assets_loaded = false;

    public static function register() {
        add_filter('do_shortcode_tag', [__CLASS__, 'enqueue_assets_on_shortcode'], 10, 3);
    }

    public static function enqueue_assets_on_shortcode($output, $tag, $attr): string {
        if ($tag === 'slider' && !self::$assets_loaded) {
            error_log("Slider Shortcode - Enqueuing Assets"); // Debug

            wp_enqueue_style(
                'slider-styles',
                plugin_dir_url(__FILE__) . '../assets/build/main.min.css',
                [],
                filemtime(plugin_dir_path(__FILE__) . '../assets/build/main.min.css')
            );

            wp_enqueue_script(
                'slider-scripts',
                plugin_dir_url(__FILE__) . '../assets/build/main.min.js',
                ['jquery'],
                filemtime(plugin_dir_path(__FILE__) . '../assets/build/main.min.js'),
                true
            );

            wp_localize_script(
                'slider-scripts',
                'sliderSettings',
                [
                    'nonce' => wp_create_nonce('slider_nonce'),
                ]
            );

            self::$assets_loaded = true;
        }
        return $output;
    }
}