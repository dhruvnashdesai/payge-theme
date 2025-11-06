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

/**
 * Simple and safe AJAX handler for video embeds
 */
function payge_theme_safe_video_embed() {
    // Security checks
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'video_embed_nonce')) {
        wp_send_json_error('Security check failed');
    }

    $post_id = intval($_POST['post_id'] ?? 0);

    if (!$post_id) {
        wp_send_json_error('Invalid post ID');
    }

    // Get the post
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'vimeo-video') {
        wp_send_json_error('Video not found');
    }

    // Generate embed using Vimeotheque shortcode - match plugin settings (900x506px)
    $embed_html = do_shortcode('[cvm_video id="' . $post_id . '" width="900" height="506" title="0" byline="0" portrait="0" color="878175" logo="0" pip="0"]');

    // Debug: Log what we're getting
    if (current_user_can('manage_options')) {
        error_log('Vimeotheque embed HTML: ' . $embed_html);
    }

    if (empty($embed_html)) {
        wp_send_json_error('Could not generate video embed');
    }

    // Add additional wrapper with explicit sizing
    $wrapped_html = '<div style="width: 100%; height: 500px; position: relative;">' . $embed_html . '</div>';

    wp_send_json_success($wrapped_html);
}

// Safe AJAX registration
add_action('wp_ajax_payge_video_embed', 'payge_theme_safe_video_embed');
add_action('wp_ajax_nopriv_payge_video_embed', 'payge_theme_safe_video_embed');