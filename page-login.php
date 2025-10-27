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

<main class="login-page">
    <div class="login-container">
        <div class="login-card">
            <!-- Card Header -->
            <div class="login-header">
                <h1 class="login-title">Sign into your account</h1>
                <p class="login-description">Enter your details below to access your account</p>
            </div>

            <!-- PMPro Login Form -->
            <div class="login-content">
                <?php echo do_shortcode('[pmpro_login show_menu="false" show_logout_link="false"]'); ?>

                <div class="login-footer">
                    Don't have an account?
                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>">
                        Sign up
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>