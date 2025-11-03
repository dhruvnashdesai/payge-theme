<?php
/**
 * Template Name: Login Page
 * PMPro Login page template
 *
 * @package Payge_Theme
 */

// Check if user is already logged in
if (is_user_logged_in()) {
    wp_redirect(home_url('/library/'));
    exit;
}

get_header();
?>

<main class="login-page-wrapper">
    <div class="login-page-container">
        <?php
        // Simple content display with fallback
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        } else {
            // Fallback shortcode
            echo do_shortcode('[pmpro_login show_menu="false" show_logout_link="false"]');
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>