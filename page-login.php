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
                <?php
                // Use PMPro's built-in login shortcode
                if (function_exists('pmpro_login_forms_handler')) {
                    echo do_shortcode('[pmpro_login show_menu="false" show_logout_link="false"]');
                } else {
                    // Fallback to WordPress login form if PMPro isn't available
                    wp_login_form(array(
                        'redirect' => home_url('/library/'),
                        'form_id' => 'loginform',
                        'label_username' => 'Email or Username',
                        'label_password' => 'Password',
                        'label_remember' => 'Remember Me',
                        'label_log_in' => 'Log In',
                        'remember' => true
                    ));
                }
                ?>

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