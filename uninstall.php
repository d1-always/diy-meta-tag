<?php
/**
 * DIY Meta Tag - Uninstall Script
 *
 * This file is executed when the plugin is uninstalled.
 * It removes all plugin data from the database.
 *
 * @package DIY_Meta_Tag
 * @since 1.0.0
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete all post meta data created by this plugin
global $wpdb;

// Delete all meta data for posts and pages
$wpdb->delete(
    $wpdb->postmeta,
    array('meta_key' => 'diymt_data'),
    array('%s')
);

// Clean up any cached data
wp_cache_flush();

// Optional: Add a log entry for debugging (remove in production)
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('DIY Meta Tag plugin has been uninstalled and all data removed.');
}