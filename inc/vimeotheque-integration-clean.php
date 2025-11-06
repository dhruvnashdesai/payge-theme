<?php
/**
 * Vimeotheque Integration Helper Functions (Clean Version)
 *
 * This file contains working functions for integrating with Vimeotheque PRO.
 *
 * @package Payge_Theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if Vimeotheque is active
 */
function payge_theme_is_vimeotheque_active() {
    return class_exists('Vimeotheque\\Core') ||
           class_exists('CVM_Video_Post') ||
           class_exists('Codeflavors\\VideoPost\\Plugin') ||
           function_exists('cvm_get_video_post');
}

/**
 * Get the correct Vimeotheque post type
 */
function payge_theme_get_vimeo_post_type() {
    // Check which post types exist
    if (post_type_exists('vimeo-video')) {
        return 'vimeo-video';
    } elseif (post_type_exists('cvm_video')) {
        return 'cvm_video';
    } elseif (post_type_exists('video')) {
        return 'video';
    }
    return false;
}

/**
 * Smart video query - simplified working version
 */
function payge_theme_smart_video_query($args = array()) {
    $defaults = array(
        'posts_per_page' => 12,
        'post_status' => 'publish'
    );

    $args = wp_parse_args($args, $defaults);

    // Method 1: Direct get_posts with members category filter
    $direct_posts = get_posts(array(
        'post_type' => 'vimeo-video',
        'numberposts' => $args['posts_per_page'],
        'post_status' => array('publish', 'private'),
        'suppress_filters' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'vimeo-videos',
                'field' => 'slug',
                'terms' => 'members'
            )
        )
    ));

    if (!empty($direct_posts)) {
        return $direct_posts;
    }

    // Method 2: Fallback without taxonomy filter
    $fallback_posts = get_posts(array(
        'post_type' => 'vimeo-video',
        'numberposts' => $args['posts_per_page'],
        'post_status' => array('publish', 'private'),
        'suppress_filters' => true
    ));

    return $fallback_posts;
}

/**
 * Debug Vimeotheque installation
 */
function payge_theme_debug_vimeotheque() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $debug_info = array();

    // Check plugin classes
    $plugin_classes = array(
        'Vimeotheque\\Core' => 'Vimeotheque PRO Core',
        'CVM_Video_Post' => 'Vimeotheque Lite',
        'Codeflavors\\VideoPost\\Plugin' => 'Vimeotheque PRO (new namespace)'
    );

    foreach ($plugin_classes as $class => $description) {
        $debug_info['classes'][$class] = class_exists($class) ? 'Active' : 'Not Found';
    }

    // Check functions
    $functions = array('cvm_get_video_post', 'cvm_video_embed_html', 'cvm_get_video_data');
    foreach ($functions as $func) {
        $debug_info['functions'][$func] = function_exists($func) ? 'Available' : 'Not Found';
    }

    // Check post types
    $post_types = array('vimeo-video', 'cvm_video', 'video');
    foreach ($post_types as $post_type) {
        $debug_info['post_types'][$post_type] = post_type_exists($post_type) ? 'Registered' : 'Not Registered';
    }

    return $debug_info;
}