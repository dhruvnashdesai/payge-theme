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
        @font-face {
            font-family: 'Glacial Indifference';
            src: url('" . get_template_directory_uri() . "/assets/fonts/GlacialIndifference-Bold.otf') format('opentype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Gotham Rounded';
            src: url('" . get_template_directory_uri() . "/assets/fonts/gotham-rounded-light.otf') format('opentype');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Gotham Rounded';
            src: url('" . get_template_directory_uri() . "/assets/fonts/gotham-rounded-light.otf') format('opentype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }
    ";
    wp_add_inline_style('payge-theme-style', $font_css);

    // Enqueue custom CSS for front page and video library
    wp_enqueue_style('payge-theme-front-page', get_template_directory_uri() . '/css/front-page.css', array('payge-theme-style'), wp_get_theme()->get('Version'));

    if (is_page('library') || is_page_template('page-library.php')) {
        wp_enqueue_style('payge-theme-library', get_template_directory_uri() . '/css/library.css', array('payge-theme-style'), wp_get_theme()->get('Version'));
    }

    if (is_page('membership-levels') || is_page_template('page-membership-levels.php')) {
        wp_enqueue_style('payge-theme-membership-levels', get_template_directory_uri() . '/css/membership-levels.css', array('payge-theme-style'), wp_get_theme()->get('Version'));
    }

    // Enqueue PMPro custom styling (includes login page styling)
    if (function_exists('pmpro_hasMembershipLevel')) {
        wp_enqueue_style('payge-theme-pmpro', get_template_directory_uri() . '/css/pmpro-styling.css', array('payge-theme-style'), wp_get_theme()->get('Version'), 'all');
    }

    // Enqueue comment reply script on singular posts/pages with comments open
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Enqueue custom JavaScript
    wp_enqueue_script('payge-theme-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'payge_theme_scripts');

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

/**
 * Force theme CSS to load after PMPro CSS - Following PMPro CSS Guidelines
 * This ensures our custom styles override PMPro's default styles
 */
function payge_theme_force_css_priority() {
    // Check for SPECIFIC PMPro pages only - avoid homepage and library
    $is_pmpro_page = false;
    $current_url = $_SERVER['REQUEST_URI'] ?? '';

    // Check for account pages
    if (function_exists('pmpro_is_account_page') && pmpro_is_account_page()) {
        $is_pmpro_page = true;
    }

    // Check for login pages - but NOT homepage or library
    if (function_exists('pmpro_is_login_page') && pmpro_is_login_page() &&
        !is_front_page() && !is_page('library')) {
        $is_pmpro_page = true;
    }

    // Only target specific membership URLs, exclude homepage and library
    if ((strpos($current_url, 'membership-account') !== false ||
         strpos($current_url, '/login') !== false) &&
        strpos($current_url, '/library') === false &&
        $current_url !== '/' && !is_front_page()) {
        $is_pmpro_page = true;
    }

    if ($is_pmpro_page) {
        // Add cache busting to force CSS reload
        wp_dequeue_style('payge-theme-style');
        wp_enqueue_style(
            'payge-theme-style-pmpro',
            get_stylesheet_uri(),
            array(),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'payge_theme_force_css_priority', 999);

/**
 * Custom Login Page Styling
 */
function payge_theme_login_stylesheet() {
    wp_enqueue_style('payge-theme-login', get_template_directory_uri() . '/css/pmpro-styling.css', array(), wp_get_theme()->get('Version'));
}
add_action('login_enqueue_scripts', 'payge_theme_login_stylesheet');

/**
 * PMPro Logout Redirect Fix
 */
function payge_theme_logout_redirect() {
    wp_redirect(home_url('/'));
    exit();
}
add_action('wp_logout', 'payge_theme_logout_redirect');

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
 * Vimeotheque integration functions
 */
require get_template_directory() . '/inc/vimeotheque-integration-clean.php';

/**
 * Add Video Difficulty Level Meta Box
 */
function payge_add_video_difficulty_meta_box() {
    add_meta_box(
        'video_difficulty',
        'Video Difficulty Level',
        'payge_video_difficulty_meta_box_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'payge_add_video_difficulty_meta_box');

/**
 * Video Difficulty Meta Box Callback
 */
function payge_video_difficulty_meta_box_callback($post) {
    wp_nonce_field('payge_save_video_difficulty', 'payge_video_difficulty_nonce');

    $current_difficulty = get_post_meta($post->ID, '_video_difficulty', true);
    if (!$current_difficulty) {
        $current_difficulty = 'intermediate'; // Default
    }

    $difficulties = array(
        'beginner' => 'Beginner',
        'intermediate' => 'Intermediate',
        'advanced' => 'Advanced'
    );

    echo '<p><strong>Select difficulty level for this video:</strong></p>';
    foreach ($difficulties as $value => $label) {
        $checked = $current_difficulty === $value ? 'checked' : '';
        echo '<label style="display: block; margin-bottom: 8px;">';
        echo '<input type="radio" name="video_difficulty" value="' . esc_attr($value) . '" ' . $checked . '> ';
        echo esc_html($label);
        echo '</label>';
    }
}

/**
 * Save Video Difficulty Meta Box Data
 */
function payge_save_video_difficulty_meta_box($post_id) {
    // Check nonce
    if (!isset($_POST['payge_video_difficulty_nonce']) ||
        !wp_verify_nonce($_POST['payge_video_difficulty_nonce'], 'payge_save_video_difficulty')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the difficulty level
    if (isset($_POST['video_difficulty'])) {
        $difficulty = sanitize_text_field($_POST['video_difficulty']);
        $valid_difficulties = array('beginner', 'intermediate', 'advanced');

        if (in_array($difficulty, $valid_difficulties)) {
            update_post_meta($post_id, '_video_difficulty', $difficulty);
        }
    }
}
add_action('save_post', 'payge_save_video_difficulty_meta_box');

/**
 * Add inline CSS for checkout page to override fonts - NUCLEAR OPTION
 */
function payge_theme_checkout_font_override() {
    // Only load on checkout pages
    if (function_exists('pmpro_is_checkout') && pmpro_is_checkout()) {
        echo '<style type="text/css">
        /* CHECKOUT PAGE FONT OVERRIDE - INLINE TO ENSURE MAXIMUM PRIORITY */
        body.pmpro-checkout h1,
        body.pmpro-checkout h2,
        body.pmpro-checkout h3,
        body.pmpro-checkout h4,
        body.pmpro-checkout h5,
        body.pmpro-checkout h6,
        .pmpro-checkout h1,
        .pmpro-checkout h2,
        .pmpro-checkout h3,
        .pmpro-checkout h4,
        .pmpro-checkout h5,
        .pmpro-checkout h6,
        #pmpro_form h1,
        #pmpro_form h2,
        #pmpro_form h3,
        .pmpro_form h1,
        .pmpro_form h2,
        .pmpro_form h3,
        /* FORM LABELS AND TEXT */
        body.pmpro-checkout label,
        .pmpro-checkout label,
        #pmpro_form label,
        .pmpro_form label,
        .pmpro_checkout-field label,
        .pmpro_checkout-fields label,
        .pmpro_checkout-field-username label,
        .pmpro_checkout-field-password label,
        .pmpro_checkout-field-password2 label,
        .pmpro_checkout-field-bemail label,
        .pmpro_checkout-field-bconfirmemail label,
        .pmpro_checkout-field-tos label,
        .pmpro_tos label,
        body.pmpro-checkout .pmpro_tos,
        .pmpro-checkout .pmpro_tos,
        #pmpro_form .pmpro_tos {
            font-family: "Gotham Rounded", "Helvetica", Arial, sans-serif !important;
        }

        /* REDUCE TOP SPACING ON CHECKOUT PAGE */
        body.pmpro-checkout,
        .pmpro-checkout {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        body.pmpro-checkout #content,
        body.pmpro-checkout .site-main,
        body.pmpro-checkout main,
        .pmpro-checkout #content,
        .pmpro-checkout .site-main,
        .pmpro-checkout main {
            padding-top: 2rem !important;
            margin-top: 0 !important;
        }

        #pmpro_form,
        .pmpro_form,
        .pmpro-checkout-form {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        </style>';
    }
}
add_action('wp_head', 'payge_theme_checkout_font_override', 1000);


