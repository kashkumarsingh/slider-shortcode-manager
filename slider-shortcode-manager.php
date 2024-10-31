<?php
/**
 * Plugin Name: Slider Shortcode Manager
 * Description: A plugin to create a shortcode for displaying sliders using Owl Carousel.
 * Version: 1.1
 * Author: Kashkumar Singh
 * License: GPL2
 * Text Domain: slider-shortcode-manager
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Autoload Composer dependencies (if any)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Autoload classes
spl_autoload_register(function ($class_name) {
    $prefix = 'Slider\\';
    $base_dir = __DIR__ . '/includes/';

    // Ensure the class starts with the defined prefix
    if (strpos($class_name, $prefix) === 0) {
        // Remove the prefix from the class name
        $relative_class = substr($class_name, strlen($prefix));

        // Convert class name to file path
        $file = $base_dir . 'class-' . strtolower(str_replace('_', '-', $relative_class)) . '.php';

        // Require the file if it exists
        if (file_exists($file)) {
            require $file;
        } else {
            error_log("Autoload failed: file $file does not exist.");
        }
    }
});


// Main Plugin Class with Singleton Pattern
class SliderShortcodeManager
{
    private static ?self $instance = null;

    private function __construct()
    {
        $this->define_constants();
        $this->initialize_components();
    }

    public static function get_instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function define_constants(): void
    {
        if (!defined('CPT_MANAGER_TEXT_DOMAIN')) {
            define('CPT_MANAGER_TEXT_DOMAIN', 'slider-shortcode-manager');
        }
    }

    private function initialize_components(): void {
        \Slider\Slider_CPT_Manager::register();
        \Slider\Slider_Shortcode::register();
        \Slider\Slider_Assets_Manager::register();
    }
}

// Initialize the plugin
SliderShortcodeManager::get_instance();
