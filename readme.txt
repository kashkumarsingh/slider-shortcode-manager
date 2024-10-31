Slider Shortcode Manager
Contributors: Kashkumar Singh
Version: 1.1
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Description
Slider Shortcode Manager is a robust WordPress plugin for creating and displaying sliders using a custom post type and the Owl Carousel library. The plugin adheres to OOP, SOLID principles, DRY, and implements the Singleton pattern, ensuring clean, modular, and easily maintainable code.

This plugin registers a custom post type "Slider" and provides a [slider] shortcode that displays slider posts with an Owl Carousel implementation.

Features
Custom Post Type: Easily manage sliders as a separate post type.
Shortcode: Embed the slider on any page with the [slider] shortcode.
Enqueue Assets Conditionally: Loads scripts and styles only when the slider shortcode is used.
OOP & Design Patterns: Follows OOP, SOLID principles, DRY, and Singleton pattern for modular code.
Dependency Injection: Applied for handling classes and dependencies effectively.
Installation
Upload the plugin files to the /wp-content/plugins/slider-shortcode-manager directory or install it via the WordPress Plugins screen directly.
Activate the plugin through the 'Plugins' screen in WordPress.
Add slider items via the Sliders menu in the WordPress dashboard.
Use [slider] shortcode on any page or post to display the slider.
Usage
Adding a Slider:

Go to Sliders in your WordPress dashboard.
Click Add New and create your slider items.
Displaying the Slider:

Use the [slider] shortcode on any page or post where you want the slider to appear.
Shortcode Attributes
The shortcode currently doesn’t accept attributes. It simply displays all posts under the "Slider" custom post type.

Code Structure
Here’s a breakdown of the plugin's file structure:
slider-shortcode-manager
├── assets/
│   ├── build/
│   │   ├── main.min.css         # Main CSS file for the slider
│   │   └── main.min.js          # JavaScript for the slider
├── includes/
│   ├── class-cpt-label-manager.php   # Class for managing CPT labels
│   ├── class-slider-assets-manager.php # Manages conditional asset enqueuing
│   ├── class-slider-cpt-manager.php  # Handles the custom post type registration
│   ├── class-slider-shortcode.php   # Manages the slider shortcode
├── vendor/                          # (optional) Composer dependencies
├── slider-shortcode-manager.php      # Main plugin file

Main Classes
CPT_Label_Manager (class-cpt-label-manager.php): Generates labels for the custom post type dynamically based on singular and plural names.

Slider_Assets_Manager (class-slider-assets-manager.php): Manages conditional loading of assets only when the [slider] shortcode is present on a page.

Slider_CPT_Manager (class-slider-cpt-manager.php): Registers the custom post type "Slider."

Slider_Shortcode (class-slider-shortcode.php): Registers and renders the [slider] shortcode to display the slider items.

Design Patterns & Principles
Singleton Pattern: Used in SliderShortcodeManager to ensure a single instance of the main plugin class.
Dependency Injection: Encouraged across classes to ensure flexible class management.
DRY Principle: Reduces redundant code and makes functions reusable across the plugin.
SOLID Principles:
Single Responsibility: Each class has a focused responsibility (e.g., asset management, CPT registration).
Open-Closed: Classes are open for extension but closed for modification by adhering to OOP principles.
Development
Autoloading
Classes are autoloaded using spl_autoload_register, following the Slider namespace. Each class file is prefixed with class- and uses lowercase naming conventions to match class names.

Adding Dependencies
If any additional libraries are needed, you can add them via Composer in the vendor directory and include them in the main plugin file.

Constants
CPT_MANAGER_TEXT_DOMAIN is defined as a constant and used for localization. Ensure this is updated if the text domain changes.

Contributing
Contributions are welcome! Please follow these steps:

Fork the repository.
Create a new branch for your feature.
Commit your changes.
Create a pull request with a description of your changes.
Changelog
Version 1.1
Initial release with CPT for sliders, shortcode, and conditional asset loading.
Implemented Singleton pattern and Dependency Injection for flexibility.
License
This plugin is licensed under the GPLv2 or later. See the LICENSE file for more information.

