<?php
/**
 * Plugin Name: Slider Shortcode Manager
 * Description: A plugin to create a shortcode for displaying sliders using Owl Carousel.
 * Version: 1.1
 * Author: Kashkumar Singh
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

// Include required classes
require_once plugin_dir_path(__FILE__) . 'includes/class-slider-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-slider-cpt-manager.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-slider-assets-manager.php';

// Main Plugin Class with Singleton Pattern
class SliderShortcodeManager {

    private static ?self $instance = null;

    private function __construct() {
        // Initialize all components of the plugin
        $this->initialize_components();
    }

    public static function get_instance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function initialize_components(): void {
        Slider_CPT_Manager::register();
        Slider_Shortcode::register();
        Slider_Assets_Manager::register();
    }
}

// Initialize the plugin
SliderShortcodeManager::get_instance();
