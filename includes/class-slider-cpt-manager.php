<?php
namespace Slider; // Define the namespace for the class
class Slider_CPT_Manager {
    // Static property for the slider post type
    private static string $post_type = 'slider';
    private static string $singular = 'Slider';
    private static string $plural = 'Sliders';

    public static function register(): void {
        add_action('init', [__CLASS__, 'register_slider_cpt']);
    }

    public static function register_slider_cpt(): void {
        $label_manager = new CPT_Label_Manager(self::$singular, self::$plural);
        
        $args = [
            'labels'              => $label_manager->get_labels(),
            'public'              => true,
            'show_ui'             => true,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'supports'            => ['title', 'editor', 'thumbnail'],
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-slides', // Icon for Slider
        ];
        
        register_post_type(self::$post_type, $args);
    }

    // Method to get the post type name
    public static function get_post_type(): string {
        return self::$post_type;
    }
}
