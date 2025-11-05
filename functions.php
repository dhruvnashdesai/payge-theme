<?php
/**
 * Minimal Payge Theme functions for debugging
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function payge_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'payge-theme'),
        'footer'  => esc_html__('Footer Menu', 'payge-theme'),
    ));
}
add_action('after_setup_theme', 'payge_theme_setup');

