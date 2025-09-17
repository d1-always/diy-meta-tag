<?php
/**
 * Plugin Name: DIY Meta Tag
 * Plugin URI: https://github.com/d1-always/diy-meta-tag
 * Description: A simple and powerful plugin to manage custom meta tags for posts and pages. Perfect for SEO optimization and adding custom metadata.
 * Version: 1.0.1
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Author: sandy, lshfyy
 * Author URI: https://github.com/d1-always
 * Text Domain: diy-meta-tag
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * DIY Meta Tag is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * DIY Meta Tag is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DIY Meta Tag. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 *
 * @package DIY_Meta_Tag
 * @version 1.0.1
 * @author sandy, lshfyy
 * @copyright 2024 sandy, lshfyy
 * @license GPL-2.0-or-later
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('DIYMT_VERSION', '1.0.1');
define('DIYMT_PLUGIN_FILE', __FILE__);
define('DIYMT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DIYMT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DIYMT_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main DIY Meta Tag Plugin Class
 *
 * @since 1.0.0
 */
class DIY_Meta_Tag {

    /**
     * Plugin instance
     *
     * @var DIY_Meta_Tag
     * @since 1.0.0
     */
    private static $instance = null;

    /**
     * Get plugin instance
     *
     * @return DIY_Meta_Tag
     * @since 1.0.0
     */
    public static function instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    private function __construct() {
        add_action('init', array($this, 'init'));
        
        // Activation and deactivation hooks
        register_activation_hook(DIYMT_PLUGIN_FILE, array($this, 'activate'));
        register_deactivation_hook(DIYMT_PLUGIN_FILE, array($this, 'deactivate'));
    }

    /**
     * Initialize the plugin
     *
     * @since 1.0.0
     */
    public function init() {
        // Load required files
        $this->load_dependencies();
        
        // Initialize admin functionality
        if (is_admin()) {
            $this->init_admin();
        }
        
        // Add frontend hooks
        add_action('wp_head', array($this, 'output_meta_tags'), 1);
        
        // Trigger loaded action
        do_action('diymt_loaded');
    }


    /**
     * Load required files
     *
     * @since 1.0.0
     */
    private function load_dependencies() {
        require_once DIYMT_PLUGIN_DIR . 'diymt-tag.php';
    }

    /**
     * Initialize admin functionality
     *
     * @since 1.0.0
     */
    private function init_admin() {
        require_once DIYMT_PLUGIN_DIR . 'diy-meta-tag-admin.php';
    }

    /**
     * Output meta tags in the head section
     *
     * @since 1.0.0
     */
    public function output_meta_tags() {
        // Get meta tags for current post/page
        $meta_tags = $this->get_post_meta_tags();
        
        if (empty($meta_tags)) {
            return;
        }

        // Filter meta tags before output
        $meta_tags = apply_filters('diymt_head_meta_tags_pre', $meta_tags);
        
        // Process and validate tags
        $valid_tags = array();
        foreach ($meta_tags as $tag) {
            if ($tag instanceof DIYMT_Tag && $tag->is_valid()) {
                $valid_tags[$tag->output()] = true; // Use as key to prevent duplicates
            }
        }

        // Apply final filter
        $valid_tags = apply_filters('diymt_head_meta_tags', array_keys($valid_tags));

        // Output tags
        if (!empty($valid_tags)) {
            echo "\n\t\t<!-- DIY Meta Tag -->";
            foreach ($valid_tags as $tag_html) {
                echo "\n\t\t" . $tag_html;
            }
            echo "\n\t\t<!-- / DIY Meta Tag -->\n";
        }

        // Trigger action after output
        do_action('diymt_head', $valid_tags);
    }

    /**
     * Get meta tags for the current post
     *
     * @param int|false $post_id Post ID (optional)
     * @return array Array of DIYMT_Tag objects
     * @since 1.0.0
     */
    public function get_post_meta_tags($post_id = false) {
        if (empty($post_id)) {
            $post_id = get_the_ID();
        }

        if (empty($post_id)) {
            return array();
        }

        $meta_tag_data = get_post_meta($post_id, 'diymt_data', true);

        // Handle serialized data
        if (is_string($meta_tag_data) && is_serialized($meta_tag_data)) {
            $meta_tag_data = unserialize($meta_tag_data);
        }

        $meta_tags = array();
        if (is_array($meta_tag_data)) {
            foreach ($meta_tag_data as $tag_data) {
                if (!empty($tag_data['key']) && !empty($tag_data['value'])) {
                    $meta_tags[] = new DIYMT_Tag($tag_data);
                }
            }
        }

        return $meta_tags;
    }

    /**
     * Plugin activation
     *
     * @since 1.0.0
     */
    public function activate() {
        // Set default options if needed
        if (!get_option('diymt_version')) {
            add_option('diymt_version', DIYMT_VERSION);
        }

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation
     *
     * @since 1.0.0
     */
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Get plugin version
     *
     * @return string
     * @since 1.0.0
     */
    public function get_version() {
        return DIYMT_VERSION;
    }

    /**
     * Check if current WordPress version is supported
     *
     * @return bool
     * @since 1.0.0
     */
    public function is_wp_version_supported() {
        global $wp_version;
        return version_compare($wp_version, '5.0', '>=');
    }

    /**
     * Check if current PHP version is supported
     *
     * @return bool
     * @since 1.0.0
     */
    public function is_php_version_supported() {
        return version_compare(PHP_VERSION, '7.4', '>=');
    }
}

/**
 * Initialize the plugin
 *
 * @since 1.0.0
 */
function diymt_init() {
    return DIY_Meta_Tag::instance();
}

// Initialize plugin
diymt_init();

/**
 * Helper function to get plugin instance
 *
 * @return DIY_Meta_Tag
 * @since 1.0.0
 */
function diymt() {
    return DIY_Meta_Tag::instance();
}