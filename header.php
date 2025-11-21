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
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

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

            <!-- Social & Auth Navigation -->
            <div class="auth-navigation">
                <!-- Instagram Icon -->
                <a href="<?php echo esc_url(get_theme_mod('payge_instagram_url', '#')); ?>" class="social-icon instagram-icon" target="_blank" aria-label="Follow us on Instagram">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" fill="currentColor"/>
                    </svg>
                </a>

                <!-- Auth Button -->
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('account') : home_url('/membership-account/'); ?>" class="membership-account-btn">Account</a>
                <?php else: ?>
                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('login') : home_url('/membership-account/'); ?>" class="membership-account-btn">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">