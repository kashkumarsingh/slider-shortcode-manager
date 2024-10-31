<?php

class Slider_CPT_Manager {

    // Static property for the slider post type
    private static string $post_type = 'slider';

    public static function register(): void {
        add_action('init', [__CLASS__, 'register_slider_cpt']);
    }

    public static function register_slider_cpt(): void {
        $args = [
            'label'               => 'Sliders',
            'public'              => true,
            'show_ui'             => true,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'supports'            => ['title', 'editor', 'thumbnail'],
            'show_in_rest'        => true,
        ];
        register_post_type(self::$post_type, $args);
    }

    // Method to get the post type name
    public static function get_post_type(): string {
        return self::$post_type;
    }
}
