<?php
/**
 * DIY Meta Tag - Tag Class
 *
 * Handles individual meta tag objects and their functionality.
 * Provides methods for validating and outputting meta tags.
 *
 * @package DIY_Meta_Tag
 * @since 1.0.0
 */

class DIYMT_Tag {
    public $type;
    public $key;
    public $value;

    public function __construct($tag_data) {
        $this->type = $tag_data['type'] ?? '';
        $this->key = $tag_data['key'] ?? '';
        $this->value = $tag_data['value'] ?? '';
    }

    public function is_valid() {
        return !empty($this->key) && !empty($this->value);
    }

    public function output() {
        $type = esc_attr($this->type);
        $key = esc_attr($this->key);
        $value = esc_attr($this->value);
        return "<meta $type=\"$key\" content=\"$value\">";
    }
} 