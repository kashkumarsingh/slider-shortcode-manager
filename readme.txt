# Slider Shortcode Manager

**Contributors:** Kashkumar Singh  
**Version:** 1.1  
**Requires at least:** 5.0  
**Tested up to:** 6.4  
**Stable tag:** 1.1  
**License:** GPLv2 or later  
**License URI:** [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)  

---

## Description

**Slider Shortcode Manager** is a versatile WordPress plugin for creating and displaying sliders via a custom post type and the Owl Carousel library. The plugin is structured using OOP, SOLID principles, DRY, and the Singleton pattern, making it modular, maintainable, and extendable.

This plugin registers a custom post type "Slider" and provides a `[slider]` shortcode to display slider posts with Owl Carousel integration.

## Features

- **Custom Post Type (CPT):** Manage sliders as a separate post type.
- **Shortcode Usage:** Embed the slider on any page with `[slider]`.
- **Conditional Asset Loading:** Enqueues assets only on pages where the slider shortcode is present.
- **OOP & Design Patterns:** Adheres to OOP, SOLID principles, DRY, and Singleton pattern.
- **Dependency Injection:** Used across classes for managing dependencies.

---

## Installation

1. Upload the plugin files to the `/wp-content/plugins/slider-shortcode-manager` directory or install via the WordPress Plugins screen.
2. Activate the plugin in WordPress.
3. Add slider items through the **Sliders** menu.
4. Insert `[slider]` shortcode on any page or post.

## Usage

1. **Adding Slider Items:**
   - Navigate to **Sliders** in the WordPress dashboard.
   - Click **Add New** to create slider items.

2. **Displaying the Slider:**
   - Use the `[slider]` shortcode on any page or post to render the slider.

---

## Main Classes

### CPT_Label_Manager (`class-cpt-label-manager.php`)
Generates labels for the custom post type dynamically based on singular and plural names.

### Slider_Assets_Manager (`class-slider-assets-manager.php`)
Manages conditional loading of assets only when the `[slider]` shortcode is present.

### Slider_CPT_Manager (`class-slider-cpt-manager.php`)
Registers the "Slider" custom post type.

### Slider_Shortcode (`class-slider-shortcode.php`)
Registers and renders the `[slider]` shortcode to display slider items.

---

## Design Patterns & Principles

- **Singleton Pattern:** Used in `SliderShortcodeManager` to ensure a single instance of the main plugin class.
- **Dependency Injection:** Implemented across classes for effective management of dependencies.
- **DRY Principle:** Reduces redundant code, making functions reusable.
- **SOLID Principles:**
  - **Single Responsibility:** Each class has a distinct responsibility (e.g., asset management, CPT registration).
  - **Open-Closed Principle:** Classes are open for extension but closed for modification.

---

## Development

### Autoloading
Classes are autoloaded using `spl_autoload_register` under the `Slider` namespace. Each class file is prefixed with `class-` and uses lowercase naming conventions matching class names.

### Adding Dependencies
If needed, additional libraries can be added through Composer in the `vendor` directory and included in the main plugin file.

### Constants
`CPT_MANAGER_TEXT_DOMAIN` is defined as a constant for localization. Update if the text domain changes.

---

## Contributing

Contributions are welcome! To contribute:

1. **Fork** the repository.
2. **Create a new branch** for your feature.
3. **Commit your changes**.
4. **Create a pull request** with a description of your changes.

---

## Changelog

### Version 1.1
- Initial release with custom post type for sliders, shortcode, and conditional asset loading.
- Implemented Singleton pattern and Dependency Injection.

---

## License

This plugin is licensed under the GPLv2 or later. See the LICENSE file for more information.
