<?php
/**
 * Template Name: Login Page
 * Custom login page template
 *
 * @package Payge_Theme
 */

// Handle login form submission BEFORE any output
$login_error = '';

if (isset($_POST['login_submit'])) {
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => $remember
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        $login_error = $user->get_error_message();
    } else {
        // Successful login - redirect to library page
        if (isset($_GET['redirect_to'])) {
            $redirect_url = esc_url_raw($_GET['redirect_to']);
        } else {
            $redirect_url = home_url('/library/');
        }

        wp_redirect($redirect_url);
        exit;
    }
}

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

            <!-- Login Form -->
            <div class="login-content">
                <?php if ($login_error): ?>
                    <div class="login-error">
                        <?php echo esc_html($login_error); ?>
                    </div>
                <?php endif; ?>

                <form method="post" class="login-form">
                    <div class="form-field">
                        <label for="username">Email or Username</label>
                        <input type="text"
                               id="username"
                               name="username"
                               placeholder="Enter your email or username"
                               required
                               value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>">
                    </div>

                    <div class="form-field">
                        <div class="password-label-wrapper">
                            <label for="password">Password</label>
                            <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-password-link">
                                Forgot your password?
                            </a>
                        </div>
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               required>
                    </div>

                    <button type="submit" name="login_submit" class="login-submit-btn">
                        Log In
                    </button>

                    <div class="login-footer">
                        Don't have an account?
                        <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>">
                            Sign up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>