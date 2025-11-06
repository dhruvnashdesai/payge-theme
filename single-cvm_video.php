<?php
/**
 * Single Video Template for Vimeotheque Videos
 *
 * @package Payge_Theme
 */

get_header();

// Check membership status with debugging
$has_membership = function_exists('pmpro_hasMembershipLevel') ? pmpro_hasMembershipLevel() : false;
$is_logged_in = is_user_logged_in();

// Debug info (remove in production)
if (current_user_can('manage_options')) {
    echo '<!-- Debug: PMPro function exists: ' . (function_exists('pmpro_hasMembershipLevel') ? 'YES' : 'NO') . ' -->';
    echo '<!-- Debug: Has membership: ' . ($has_membership ? 'YES' : 'NO') . ' -->';
    echo '<!-- Debug: Is logged in: ' . ($is_logged_in ? 'YES' : 'NO') . ' -->';
    if (function_exists('pmpro_hasMembershipLevel') && $is_logged_in) {
        $user_level = pmpro_getMembershipLevelForUser();
        echo '<!-- Debug: User level: ' . print_r($user_level, true) . ' -->';
    }
}
?>

<main class="single-video-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>

            <!-- Temporary debug info -->
            <?php if (current_user_can('manage_options')) : ?>
                <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 20px 0; border-radius: 5px;">
                    <strong>Debug Info (Admin Only):</strong><br>
                    PMPro Function Exists: <?php echo function_exists('pmpro_hasMembershipLevel') ? 'YES' : 'NO'; ?><br>
                    Is Logged In: <?php echo $is_logged_in ? 'YES' : 'NO'; ?><br>
                    Has Membership: <?php echo $has_membership ? 'YES' : 'NO'; ?><br>
                    <?php if ($is_logged_in && function_exists('pmpro_getMembershipLevelForUser')) :
                        $user_level = pmpro_getMembershipLevelForUser();
                        echo 'User Level: ' . ($user_level ? $user_level->name . ' (ID: ' . $user_level->id . ')' : 'None');
                    endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($has_membership) : ?>
                <!-- Member: Show full video content -->
                <article class="video-content">
                    <header class="video-header">
                        <h1 class="video-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="video-embed">
                        <?php
                        // Use Vimeotheque shortcode with unbranded parameters
                        echo do_shortcode('[cvm_video id="' . get_the_ID() . '" width="100%" aspect_ratio="16x9" title="0" byline="0" portrait="0" color="878175" logo="0" pip="0"]');
                        ?>
                    </div>

                    <?php if (get_the_content()) : ?>
                        <div class="video-description">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                </article>

            <?php else : ?>
                <!-- Non-member: Show paywall -->
                <article class="video-content">
                    <header class="video-header">
                        <h1 class="video-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="video-paywall">
                        <div class="paywall-overlay">
                            <div class="paywall-content">
                                <div class="paywall-icon">🔒</div>
                                <h2>This video is for members only</h2>
                                <p>Join POWERED to unlock access to our complete video library with classes for all levels.</p>

                                <div class="paywall-buttons">
                                    <?php if ($is_logged_in) : ?>
                                        <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="btn btn-primary">Upgrade Your Membership</a>
                                        <a href="<?php echo home_url('/library/'); ?>" class="btn btn-secondary">Back to Library</a>
                                    <?php else : ?>
                                        <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="btn btn-primary">Subscribe Now</a>
                                        <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('login') : home_url('/membership-account/'); ?>" class="btn btn-secondary">Already a Member? Log In</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (get_the_content()) : ?>
                        <div class="video-description">
                            <p><em>This video description is available to members only.</em></p>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endif; ?>

        <?php endwhile; ?>
    </div>
</main>

<style>
.video-paywall {
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    margin: 20px 0;
}

.paywall-overlay {
    padding: 60px 40px;
    text-align: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.paywall-content .paywall-icon {
    font-size: 48px;
    margin-bottom: 20px;
    opacity: 0.7;
}

.paywall-content h2 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.75rem;
}

.paywall-content p {
    margin: 0 0 30px 0;
    color: #666;
    font-size: 1.1rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.paywall-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.paywall-buttons .btn {
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.paywall-buttons .btn-primary {
    background: #878175;
    color: white;
}

.paywall-buttons .btn-primary:hover {
    background: #6d665a;
    transform: translateY(-2px);
}

.paywall-buttons .btn-secondary {
    background: transparent;
    color: #878175;
    border: 2px solid #878175;
}

.paywall-buttons .btn-secondary:hover {
    background: #878175;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .paywall-overlay {
        padding: 40px 20px;
    }

    .paywall-content h2 {
        font-size: 1.5rem;
    }

    .paywall-buttons {
        flex-direction: column;
        align-items: center;
    }

    .paywall-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<?php get_footer(); ?>