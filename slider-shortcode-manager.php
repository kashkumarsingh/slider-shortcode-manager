<?php
/**
 * Plugin Name: Slider Shortcode Manager
 * Description: A plugin to create a shortcode for displaying sliders using Owl Carousel.
 * Version: 1.0
 * Author: Your Name
 * License: GPL2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Autoload Composer dependencies (if any)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Include the shortcode class
require_once plugin_dir_path(__FILE__) . 'includes/class-slider-shortcode.php';

// Main plugin class
class SliderShortcodeManager {

    private static $instance = null;

    private function __construct() {
        // Initialize the plugin
        $this->register_shortcodes();
        $this->enqueue_assets();
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function register_shortcodes() {
        new Slider_Shortcode();
    }

    private function enqueue_assets() {
        add_action('wp_enqueue_scripts', function() {
            wp_enqueue_style('slider-styles', plugin_dir_url(__FILE__) . 'assets/build/main.min.css');
            wp_enqueue_script('slider-scripts', plugin_dir_url(__FILE__) . 'assets/build/main.min.js', ['jquery'], null, true);
        });
    }
}

// Initialize the plugin
SliderShortcodeManager::get_instance();
