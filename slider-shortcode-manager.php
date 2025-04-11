<?php
/**
 * Plugin Name: Slider Shortcode Manager
 * Plugin URI: https://your-site.com/slider-shortcode-manager
 * Description: A plugin to create a customizable slider shortcode using Owl Carousel, supporting multiple post types.
 * Version: 2.0.0
 * Author: KNS
 * Author URI: https://your-site.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: slider-shortcode-manager
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

define('SLIDER_SHORTCODE_MANAGER_VERSION', '2.0.0');

// Autoload Composer dependencies (if any)
spl_autoload_register(function ($class_name) {
    $prefix = 'Slider\\';
    $base_dir = __DIR__ . '/includes/';
    if (strpos($class_name, $prefix) === 0) {
        $relative_class = substr($class_name, strlen($prefix));
        $file = $base_dir . 'class-' . strtolower(str_replace('_', '-', $relative_class)) . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            error_log("Autoload failed: file $file does not exist.");
        }
    }
});

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
class SliderShortcodeManager {
    private static ?self $instance = null;

    private function __construct() {
        $this->define_constants();
        $this->initialize_components();
        $this->check_version();
    }

    public static function get_instance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function define_constants(): void {
        if (!defined('CPT_MANAGER_TEXT_DOMAIN')) {
            define('CPT_MANAGER_TEXT_DOMAIN', 'slider-shortcode-manager');
        }
    }

    private function initialize_components(): void {
        \Slider\Slider_CPT_Manager::register();
        \Slider\Slider_Shortcode::register();
        \Slider\Slider_Assets_Manager::register();
    }

    private function check_version(): void {
        $current_version = get_option('slider_shortcode_manager_version', '1.1');
        if (version_compare($current_version, SLIDER_SHORTCODE_MANAGER_VERSION, '<')) {
            update_option('slider_shortcode_manager_version', SLIDER_SHORTCODE_MANAGER_VERSION);
            // Future: Add migration logic here if needed
        }
    }
}

SliderShortcodeManager::get_instance();
