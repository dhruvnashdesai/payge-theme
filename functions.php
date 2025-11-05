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
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('responsive-embeds');
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'payge-theme'),
        'footer'  => esc_html__('Footer Menu', 'payge-theme'),
    ));
}
add_action('after_setup_theme', 'payge_theme_setup');

/**
 * Fallback menu if no menu is assigned
 */
function payge_theme_fallback_menu() {
    echo '<ul id="primary-menu" class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'payge-theme') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/library/')) . '">' . esc_html__('Library', 'payge-theme') . '</a></li>';
    echo '</ul>';
}

/**
 * Modify excerpt length
 */
function payge_theme_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'payge_theme_excerpt_length');

/**
 * Modify excerpt more string
 */
function payge_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'payge_theme_excerpt_more');

/**
 * Register widget area.
 */
function payge_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'payge-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'payge-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'payge-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets to the footer.', 'payge-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'payge_theme_widgets_init');

