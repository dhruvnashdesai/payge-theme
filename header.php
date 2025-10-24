<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Payge_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <!-- EMERGENCY CSS - BYPASS FILE LOADING ISSUES -->
    <style>
        /* Force hero section to be visible */
        .hero {
            width: 100% !important;
            min-height: 600px !important;
            background: linear-gradient(rgba(26, 26, 26, 0.4), rgba(26, 26, 26, 0.4)), #6c7c7c !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 50px !important;
        }

        .hero-image-container {
            width: 90% !important;
            height: 500px !important;
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: 20px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }

        .hero-text-content h1,
        .hero-text-content h2,
        .hero-text-content h3 {
            color: white !important;
            margin: 10px 0 !important;
            opacity: 1 !important;
            transform: none !important;
            display: block !important;
        }

        .hero-line-1 { font-size: 48px !important; font-weight: bold !important; }
        .hero-line-2 { font-size: 24px !important; }
        .hero-line-3 { font-size: 18px !important; }

        /* DEBUG: Confirm this CSS loads */
        body::before {
            content: "EMERGENCY CSS LOADED" !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            background: lime !important;
            color: black !important;
            padding: 10px !important;
            z-index: 9999 !important;
            font-weight: bold !important;
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'payge-theme'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <!-- Logo -->
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/symbol.png" alt="<?php bloginfo('name'); ?>" class="logo-image">
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'payge-theme'); ?></span>
                </button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => 'payge_theme_fallback_menu',
                    )
                );
                ?>
            </nav>

            <!-- Auth Button -->
            <div class="auth-navigation">
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('account') : home_url('/membership-account/'); ?>" class="membership-account-btn">Account</a>
                <?php else: ?>
                    <a href="/login" class="membership-account-btn">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">

<?php
/**
 * Fallback menu if no menu is assigned
 */
function payge_theme_fallback_menu() {
    echo '<ul id="primary-menu" class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'payge-theme') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/library/')) . '">' . esc_html__('Library', 'payge-theme') . '</a></li>';
    echo '</ul>';
}
?>