<?php
/**
 * Temporary Login Debug Page
 * Create a page with slug "debug-login" and assign this template to test
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

get_header();
?>

<div style="padding: 40px; max-width: 800px; margin: 0 auto; font-family: Arial, sans-serif;">
    <h1>Login Debug Information</h1>

    <div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h2>WordPress Functions</h2>
        <p><strong>is_user_logged_in():</strong> <?php echo is_user_logged_in() ? 'TRUE' : 'FALSE'; ?></p>
        <p><strong>current_user_can('administrator'):</strong> <?php echo current_user_can('administrator') ? 'TRUE' : 'FALSE'; ?></p>
        <p><strong>is_admin():</strong> <?php echo is_admin() ? 'TRUE' : 'FALSE'; ?></p>
        <p><strong>is_page('login'):</strong> <?php echo is_page('login') ? 'TRUE' : 'FALSE'; ?></p>
    </div>

    <div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h2>PMPro Functions</h2>
        <p><strong>function_exists('pmpro_url'):</strong> <?php echo function_exists('pmpro_url') ? 'TRUE' : 'FALSE'; ?></p>
        <p><strong>shortcode_exists('pmpro_login'):</strong> <?php echo shortcode_exists('pmpro_login') ? 'TRUE' : 'FALSE'; ?></p>
        <p><strong>class_exists('MemberOrder'):</strong> <?php echo class_exists('MemberOrder') ? 'TRUE' : 'FALSE'; ?></p>
        <?php if (function_exists('pmpro_url')): ?>
        <p><strong>pmpro_url('login'):</strong> <?php echo pmpro_url('login'); ?></p>
        <p><strong>pmpro_url('levels'):</strong> <?php echo pmpro_url('levels'); ?></p>
        <?php endif; ?>
    </div>

    <div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h2>Active Plugins</h2>
        <?php
        $active_plugins = get_option('active_plugins');
        foreach ($active_plugins as $plugin) {
            echo '<p>' . $plugin . '</p>';
        }
        ?>
    </div>

    <div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h2>Server Variables</h2>
        <p><strong>REQUEST_URI:</strong> <?php echo $_SERVER['REQUEST_URI'] ?? 'Not set'; ?></p>
        <p><strong>PHP Version:</strong> <?php echo PHP_VERSION; ?></p>
        <p><strong>WordPress Version:</strong> <?php echo get_bloginfo('version'); ?></p>
    </div>

    <div style="background: #fff3cd; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #856404;">
        <h2>Test PMPro Shortcode</h2>
        <?php
        if (function_exists('pmpro_url') && shortcode_exists('pmpro_login')) {
            echo '<p>Attempting to render PMPro login shortcode:</p>';
            echo do_shortcode('[pmpro_login show_menu="false" show_logout_link="false"]');
        } else {
            echo '<p style="color: red;">PMPro login shortcode is not available!</p>';
        }
        ?>
    </div>

    <div style="background: #d4edda; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #155724;">
        <h2>Actions to Take</h2>
        <ol>
            <li>If PMPro functions show FALSE, activate the Paid Memberships Pro plugin</li>
            <li>Go to WordPress Admin → Pages → Find your login page → Make sure it has slug "login"</li>
            <li>Make sure the login page has "Login Page" template assigned</li>
            <li>Try accessing <a href="/login/">/login/</a> directly</li>
        </ol>
    </div>
</div>

<?php get_footer(); ?>