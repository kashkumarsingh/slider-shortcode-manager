<?php
namespace Slider; // Define the namespace for the class
class Slider_Assets_Manager {

    public static function register() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'conditionally_enqueue_assets']);
    }

    public static function conditionally_enqueue_assets(): void {
        // Check if the slider shortcode is present on the page
        if (is_singular() && has_shortcode(get_post()->post_content, 'slider')) {
            // Enqueue main slider styles
            wp_enqueue_style(
                'slider-styles', 
                plugin_dir_url(__FILE__) . '../assets/build/main.min.css', 
                [], 
                filemtime(plugin_dir_path(__FILE__) . '../assets/build/main.min.css')
            );

            // Enqueue main slider script with vendor dependencies
            wp_enqueue_script(
                'slider-scripts', 
                plugin_dir_url(__FILE__) . '../assets/build/main.min.js', 
                ['jquery'], 
                filemtime(plugin_dir_path(__FILE__) . '../assets/build/main.min.js'), 
                true
            );

            // Enqueue vendor script (if code splitting is applied and vendor chunk exists)
            if (file_exists(plugin_dir_path(__FILE__) . '../assets/build/vendor.min.js')) {
                wp_enqueue_script(
                    'slider-vendor-scripts', 
                    plugin_dir_url(__FILE__) . '../assets/build/vendor.min.js', 
                    [], 
                    filemtime(plugin_dir_path(__FILE__) . '../assets/build/vendor.min.js'), 
                    true
                );
            }
        }
    }
}
