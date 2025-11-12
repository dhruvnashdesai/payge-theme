<?php
/**
 * Template for Membership Levels page
 * Overrides PMPro default styling with custom pricing cards
 *
 * @package Payge_Theme
 */

get_header();

// Get membership levels
$levels = pmpro_getAllLevels(false, true);
?>

<main class="membership-levels-page">
    <!-- Hero Section - REMOVED -->
    <?php // Title removed for cleaner layout ?>

    <!-- Pricing Cards Section -->
    <section class="membership-pricing-section">
        <div class="container">
            <div class="membership-pricing-cards">

                <?php if ($levels) : ?>
                    <?php foreach ($levels as $level) : ?>
                        <?php
                        // Format price
                        $cost_text = pmpro_getLevelCost($level, true, true);
                        $price = $level->initial_payment;
                        $is_free = ($level->id == 0 || $price == 0);
                        ?>

                        <!-- Membership Card -->
                        <div class="membership-card <?php echo $is_free ? 'free-card' : 'premium-card'; ?> <?php echo (!$is_free && $level->id == 1) ? 'featured' : ''; ?>">
                            <?php if (!$is_free && $level->id == 1) : ?>
                                <div class="featured-badge">Most Popular</div>
                            <?php endif; ?>

                            <div class="card-icon">
                                <?php if ($is_free) : ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                <?php else : ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L15 9L22 9L17 14L19 21L12 17L5 21L7 14L2 9L9 9Z"/>
                                    </svg>
                                <?php endif; ?>
                            </div>

                            <h3 class="card-title"><?php echo $is_free ? 'Free' : esc_html($level->name); ?></h3>

                            <?php if (!$is_free) : ?>
                                <div class="card-price">
                                    <span class="price-amount">$<?php echo number_format($price, 2); ?></span>
                                    <span class="price-period">
                                        <?php
                                        if ($level->cycle_number == 1) {
                                            echo 'per ' . $level->cycle_period;
                                        } else {
                                            echo 'per ' . $level->cycle_number . ' ' . $level->cycle_period . 's';
                                        }
                                        ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if (!$is_free && $level->trial_amount !== null && $level->trial_limit > 0) : ?>
                                <div class="trial-badge">
                                    <?php echo $level->trial_limit; ?> day<?php echo ($level->trial_limit != 1) ? 's' : ''; ?> free trial
                                </div>
                            <?php endif; ?>

                            <div class="card-content-wrapper">
                                <?php if (!$is_free) : ?>
                                    <ul class="card-features">
                                        <li>Complete video library access</li>
                                        <li>All class levels & styles</li>
                                        <li>New videos added weekly</li>
                                        <li>Mobile & desktop streaming</li>
                                        <li>Cancel anytime</li>
                                    </ul>

                                    <?php if ($level->description) : ?>
                                        <p class="card-description"><?php echo esc_html($level->description); ?></p>
                                    <?php else : ?>
                                        <p class="card-description">Perfect for dedicated practitioners who want unlimited access to our complete library.</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <?php if (!$is_free) : ?>
                                <a href="<?php echo pmpro_url('checkout', '?level=' . $level->id); ?>" class="card-btn primary">
                                    Start Membership
                                </a>
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No membership levels found. Please contact the administrator.</p>
                <?php endif; ?>

            </div>

            <!-- Additional Info -->
            <div class="membership-info">
                <p>All memberships include our satisfaction guarantee. Cancel anytime with no hassle.</p>
                <p>Already a member? <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('login') : home_url('/login/'); ?>">Log in here</a></p>
            </div>

        </div>
    </section>
</main>

<?php get_footer(); ?>