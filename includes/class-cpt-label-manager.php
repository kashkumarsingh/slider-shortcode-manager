<?php
namespace Slider; // Define the namespace for the class
class CPT_Label_Manager {
    private string $singular;
    private string $plural;

    public function __construct(string $singular, string $plural) {
        $this->singular = $singular;
        $this->plural = $plural;
    }

    public function get_labels(): array {
        return [
            'name'                  => __($this->plural, CPT_MANAGER_TEXT_DOMAIN),
            'singular_name'         => __($this->singular, CPT_MANAGER_TEXT_DOMAIN),
            'add_new_item'          => __('Add New ' . $this->singular, CPT_MANAGER_TEXT_DOMAIN),
            'edit_item'             => __('Edit ' . $this->singular, CPT_MANAGER_TEXT_DOMAIN),
            'new_item'              => __('New ' . $this->singular, CPT_MANAGER_TEXT_DOMAIN),
            'view_item'             => __('View ' . $this->singular, CPT_MANAGER_TEXT_DOMAIN),
            'search_items'          => __('Search ' . $this->plural, CPT_MANAGER_TEXT_DOMAIN),
            'not_found'             => __('No ' . strtolower($this->plural) . ' found', CPT_MANAGER_TEXT_DOMAIN),
            'not_found_in_trash'    => __('No ' . strtolower($this->plural) . ' found in Trash', CPT_MANAGER_TEXT_DOMAIN),
        ];
    }
}