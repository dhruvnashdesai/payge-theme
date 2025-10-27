<?php
/**
 * Template Name: Homepage
 * Template for the Homepage
 *
 * @package Payge_Theme
 */

get_header(); ?>

<?php
// Get customizer values with defaults
$hero_title = get_theme_mod('payge_hero_title', 'Transform Your Body Through Pilates');
$hero_subtitle = get_theme_mod('payge_hero_subtitle', 'Discover strength, flexibility, and mindfulness in our premium studio');
$hero_button_text = get_theme_mod('payge_hero_button_text', 'Start Your Journey');
$hero_button_url = get_theme_mod('payge_hero_button_url', '#');
$monthly_price = get_theme_mod('payge_monthly_price', '29');
$annual_price = get_theme_mod('payge_annual_price', '290');
?>

<main class="landing-page">
    <!-- Hero Section -->
    <section class="hero">
        <!-- Membership Card -->
        <div class="membership-card">
            <div class="card-header">
                <h3>Join Pilates w Payge</h3>
                <div class="billing-toggle">
                    <button class="toggle-btn active" data-billing="monthly">Monthly</button>
                    <button class="toggle-btn" data-billing="yearly">Yearly</button>
                </div>
            </div>

            <div class="pricing-display">
                <div class="price-section monthly-price active">
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="amount"><?php echo esc_html($monthly_price); ?></span>
                        <span class="period">/month</span>
                    </div>
                    <p class="billing-description">Billed monthly</p>
                </div>

                <div class="price-section yearly-price">
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="amount"><?php echo esc_html($annual_price); ?></span>
                        <span class="period">/year</span>
                    </div>
                    <p class="billing-description">Billed annually</p>
                    <p class="savings">Save $<?php echo esc_html((($monthly_price * 12) - $annual_price)); ?></p>
                </div>
            </div>

            <div class="card-features">
                <ul>
                    <li>Unlimited access to video library</li>
                    <li>New classes added weekly</li>
                    <li>All skill levels included</li>
                    <li>Stream on any device</li>
                </ul>
            </div>

            <a href="/membership" class="membership-btn">START FREE TRIAL</a>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-header">
                <h2>What Our Members Say</h2>
            </div>

            <div class="testimonials-slideshow">
                <div class="testimonials-container">
                    <div class="testimonial-slide active">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-mark">"</div>
                                <p class="testimonial-text">This is where testimonial text will go. You can fill this in later with real member feedback about their Pilates experience.</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h4 class="author-name">Member Name</h4>
                                    <p class="author-title">Member Since 2023</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-mark">"</div>
                                <p class="testimonial-text">Another testimonial will go here. This creates a nice slideshow effect for showcasing multiple member experiences.</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h4 class="author-name">Another Member</h4>
                                    <p class="author-title">Member Since 2022</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-mark">"</div>
                                <p class="testimonial-text">A third testimonial example that demonstrates the sliding carousel functionality for member reviews.</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h4 class="author-name">Third Member</h4>
                                    <p class="author-title">Member Since 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="testimonials-nav">
                    <button class="nav-btn prev-btn" aria-label="Previous testimonial">‹</button>
                    <div class="nav-dots">
                        <button class="dot active" data-slide="0"></button>
                        <button class="dot" data-slide="1"></button>
                        <button class="dot" data-slide="2"></button>
                    </div>
                    <button class="nav-btn next-btn" aria-label="Next testimonial">›</button>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>