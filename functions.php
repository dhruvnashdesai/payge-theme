<?php
/**
 * Payge Theme functions and definitions
 *
 * @package Payge_Theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function payge_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for HTML5 markup.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom backgrounds.
    add_theme_support('custom-background', array(
        'default-color' => 'fefefe',
    ));

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Enqueue editor styles.
    add_editor_style('editor-style.css');

    // Register navigation menus.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'payge-theme'),
        'footer'  => esc_html__('Footer Menu', 'payge-theme'),
    ));

    // Set content width.
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'payge_theme_setup');

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

/**
 * Enqueue scripts and styles.
 */
function payge_theme_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style('payge-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Add custom font CSS with correct absolute path
    $font_css = "
        @font-face {
            font-family: 'TAN AEGEAN';
            src: url('" . get_template_directory_uri() . "/assets/fonts/TAN-AEGEAN-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
    ";
    wp_add_inline_style('payge-theme-style', $font_css);

    // Enqueue custom CSS for front page and video library
    if (is_front_page()) {
        wp_enqueue_style('payge-theme-front-page', get_template_directory_uri() . '/css/front-page.css', array('payge-theme-style'), time());
    }

    if (is_page('library') || is_page_template('page-library.php')) {
        wp_enqueue_style('payge-theme-library', get_template_directory_uri() . '/css/library.css', array('payge-theme-style'), wp_get_theme()->get('Version'));
    }

    if (is_page('membership-levels') || is_page_template('page-membership-levels.php')) {
        wp_enqueue_style('payge-theme-membership-levels', get_template_directory_uri() . '/css/membership-levels.css', array('payge-theme-style'), wp_get_theme()->get('Version'));
    }

    // Load login styles on custom login page AND PMPro login pages
    if (is_page('login') || is_page_template('page-login.php') ||
        (function_exists('pmpro_is_login_page') && pmpro_is_login_page()) ||
        strpos($_SERVER['REQUEST_URI'] ?? '', 'login') !== false ||
        strpos($_SERVER['REQUEST_URI'] ?? '', 'pmpro') !== false) {
        wp_enqueue_style('payge-theme-login', get_template_directory_uri() . '/css/login.css', array('payge-theme-style'), wp_get_theme()->get('Version'));
    }

    // Enqueue PMPro custom styling (check if PMPro is active and load on all pages)
    if (function_exists('pmpro_hasMembershipLevel')) {
        wp_enqueue_style('payge-theme-pmpro', get_template_directory_uri() . '/css/pmpro-styling.css', array('payge-theme-style'), wp_get_theme()->get('Version'), 'all');
    }

    // Enqueue comment reply script on singular posts/pages with comments open
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Enqueue custom JavaScript - Skip on PMPro pages to avoid conflicts
    $is_pmpro_page = false;

    // Check for PMPro pages
    if (function_exists('pmpro_is_checkout') && pmpro_is_checkout()) {
        $is_pmpro_page = true;
    }

    // Check URL for PMPro-related paths
    $current_url = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($current_url, 'membership') !== false ||
        strpos($current_url, 'checkout') !== false ||
        strpos($current_url, 'pmpro') !== false ||
        strpos($current_url, 'levels') !== false) {
        $is_pmpro_page = true;
    }

    if (!$is_pmpro_page) {
        wp_enqueue_script('payge-theme-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), wp_get_theme()->get('Version'), true);
    }
}
add_action('wp_enqueue_scripts', 'payge_theme_scripts');

/**
 * Add custom body classes
 */
function payge_theme_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page-template';
    }

    if (is_page('library') || is_page_template('page-library.php')) {
        $classes[] = 'library-template';
    }

    return $classes;
}
add_filter('body_class', 'payge_theme_body_classes');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom post types and fields for video library
 */
require get_template_directory() . '/inc/custom-post-types.php';


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
 * Add support for custom header image
 */
function payge_theme_custom_header_setup() {
    add_theme_support('custom-header', apply_filters('payge_theme_custom_header_args', array(
        'default-image'      => '',
        'default-text-color' => '1a1a1a',
        'width'              => 1920,
        'height'             => 1080,
        'flex-height'        => true,
        'wp-head-callback'   => 'payge_theme_header_style',
    )));
}
add_action('after_setup_theme', 'payge_theme_custom_header_setup');

/**
 * Styles the header image and text displayed on the blog.
 */
function payge_theme_header_style() {
    $header_text_color = get_header_textcolor();

    if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
        return;
    }

    ?>
    <style type="text/css">
    .site-title,
    .site-description {
        color: #<?php echo esc_attr($header_text_color); ?>;
    }
    </style>
    <?php
}

/**
 * Custom Login Page Styling
 */
function payge_theme_login_stylesheet() {
    wp_enqueue_style('payge-theme-login', get_template_directory_uri() . '/css/pmpro-styling.css', array(), wp_get_theme()->get('Version'));
}
add_action('login_enqueue_scripts', 'payge_theme_login_stylesheet');

/**
 * Customize Login Page
 */
function payge_theme_login_page_customization() {
    ?>
    <style type="text/css">
        /* PMPro Login Page Card Styling */
        .pmpro_login_wrap,
        .login #login {
            width: 600px !important;
            max-width: 600px !important;
            padding: 0 !important;
            background: white !important;
            border-radius: 12px !important;
            border: 1px solid #e0e0e0 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
            overflow: hidden !important;
            margin: 3rem auto !important;
        }

        .login #loginform,
        .pmpro_login_wrap form,
        .pmpro_login_wrap .pmpro_login_form {
            background: white !important;
            border: none !important;
            box-shadow: none !important;
            padding: 2rem !important;
            border-radius: 0 !important;
            text-align: left !important;
        }

        .login #loginform h1,
        .pmpro_login_wrap h2 {
            font-family: 'TAN AEGEAN', 'Helvetica World', 'Helvetica', Arial, sans-serif !important;
            font-size: 1.5rem !important;
            color: #1a1a1a !important;
            margin: 0 0 1.5rem 0 !important;
            font-weight: normal !important;
            text-align: left !important;
        }

        .login #loginform h1 a {
            display: none !important;
        }

        .login #loginform h1:before,
        .pmpro_login_wrap h2:before {
            content: 'Sign into your account' !important;
            display: block !important;
            font-family: 'TAN AEGEAN', 'Helvetica World', 'Helvetica', Arial, sans-serif !important;
            font-size: 1.5rem !important;
            color: #1a1a1a !important;
            font-weight: normal !important;
            text-align: left !important;
            margin-bottom: 0.5rem !important;
        }

        .login #loginform h1:after,
        .pmpro_login_wrap h2:after {
            content: 'Enter your details below to access your account' !important;
            display: block !important;
            font-family: 'Helvetica World', 'Helvetica', Arial, sans-serif !important;
            font-size: 0.9rem !important;
            color: #666 !important;
            font-weight: normal !important;
            margin-top: 0.5rem !important;
            text-align: left !important;
        }

        .pmpro_login_wrap h2 {
            font-size: 0 !important;
            line-height: 0 !important;
        }

        .login #loginform .user-user-login-wrap,
        .login #loginform .user-pass-wrap {
            margin-bottom: 1.5rem !important;
        }

        .login #loginform label {
            font-family: 'Helvetica World', 'Helvetica', Arial, sans-serif !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            color: #1a1a1a !important;
            display: block !important;
            margin-bottom: 0.5rem !important;
        }

        .login #loginform input[type="text"],
        .login #loginform input[type="password"],
        .pmpro_login_wrap input[type="text"],
        .pmpro_login_wrap input[type="email"],
        .pmpro_login_wrap input[type="password"] {
            width: 100% !important;
            padding: 0.75rem 1rem !important;
            border: 2px solid #e0e0e0 !important;
            border-radius: 6px !important;
            font-size: 0.9rem !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
            background-color: white !important;
            box-sizing: border-box !important;
            font-family: 'Helvetica World', 'Helvetica', Arial, sans-serif !important;
            margin: 0 !important;
        }

        .login #loginform input[type="text"]:focus,
        .login #loginform input[type="password"]:focus,
        .pmpro_login_wrap input[type="text"]:focus,
        .pmpro_login_wrap input[type="email"]:focus,
        .pmpro_login_wrap input[type="password"]:focus {
            outline: none !important;
            border-color: #1a1a1a !important;
            box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1) !important;
        }

        .login #loginform .forgetmenot {
            display: none !important;
        }

        .login #loginform #wp-submit,
        .pmpro_login_wrap input[type="submit"],
        .pmpro_login_wrap .pmpro_btn {
            width: 100% !important;
            background-color: #1a1a1a !important;
            color: #f0e7d7 !important;
            border: none !important;
            padding: 0.75rem 1rem !important;
            border-radius: 6px !important;
            font-family: 'TAN AEGEAN', 'Helvetica World', 'Helvetica', Arial, sans-serif !important;
            font-size: 0.9rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
            height: auto !important;
            line-height: normal !important;
        }

        .login #loginform #wp-submit:hover,
        .pmpro_login_wrap input[type="submit"]:hover,
        .pmpro_login_wrap .pmpro_btn:hover {
            background-color: #333 !important;
            transform: translateY(-1px) !important;
        }

        .login #nav {
            text-align: left !important;
            padding: 0 2rem 1rem 2rem !important;
            margin: 0 !important;
            font-size: 0.875rem !important;
            color: #666 !important;
            background: white !important;
            border: none !important;
        }

        .login #nav a {
            color: #666 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
            font-size: 0.875rem !important;
        }

        .login #nav a:hover {
            color: #1a1a1a !important;
            text-decoration: underline !important;
        }

        .login #backtoblog {
            display: none !important;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'payge_theme_login_page_customization');

/**
 * PMPro Logout Redirect Fix
 */
function payge_theme_logout_redirect() {
    wp_redirect(home_url('/'));
    exit();
}
add_action('wp_logout', 'payge_theme_logout_redirect');

// Login URL override functions removed - letting PMPro handle login URLs natively

/**
 * Security enhancements
 */
// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Remove WordPress version from RSS feeds
function payge_theme_remove_version() {
    return '';
}
add_filter('the_generator', 'payge_theme_remove_version');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Performance optimizations
 */
// Remove query strings from static resources
function payge_theme_remove_query_strings($src) {
    $parts = explode('?ver', $src);
    return $parts[0];
}
add_filter('script_loader_src', 'payge_theme_remove_query_strings', 15, 1);
add_filter('style_loader_src', 'payge_theme_remove_query_strings', 15, 1);

// Defer parsing of JavaScript - DISABLED for PMPro compatibility
// This was causing "JavaScript errors on the page" for PMPro signup forms
// function payge_theme_defer_parsing_of_js($url) {
//     if (is_admin()) return $url;
//     if (false === strpos($url, '.js')) return $url;
//     if (strpos($url, 'jquery.js')) return $url;
//     return str_replace(' src', ' defer src', $url);
// }
// add_filter('script_loader_tag', 'payge_theme_defer_parsing_of_js', 10);

