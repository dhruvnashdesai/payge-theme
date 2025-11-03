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
        // Check if we have page content (block editor content)
        if (have_posts()) :
            while (have_posts()) : the_post();
                // Display the page content (which will contain our PMPro block)
                the_content();
            endwhile;
        else :
            // Fallback if no content or PMPro is not available
            if (function_exists('pmpro_url') && shortcode_exists('pmpro_login')) {
                echo do_shortcode('[pmpro_login show_menu="false" show_logout_link="false"]');
            } else {
                ?>
                <div class="login-fallback">
                    <p>Login functionality is currently unavailable. Please try again later.</p>
                    <p><a href="<?php echo home_url(); ?>">Return to Home</a></p>
                </div>
                <?php
            }
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>