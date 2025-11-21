<?php get_header(); ?>

<?php
// Get customizer values with defaults
$hero_title = get_theme_mod('payge_hero_title', 'Transform Your Body Through Pilates');
$hero_subtitle = get_theme_mod('payge_hero_subtitle', 'Discover strength, flexibility, and mindfulness in our premium studio');
$hero_button_text = get_theme_mod('payge_hero_button_text', 'Start Your Journey');
$hero_button_url = get_theme_mod('payge_hero_button_url', '#');

// Get PMPro level data
$pmpro_levels = function_exists('pmpro_getAllLevels') ? pmpro_getAllLevels() : array();
$monthly_level = null;

// Find the first level (assuming monthly membership)
if (!empty($pmpro_levels)) {
    $monthly_level = array_values($pmpro_levels)[0];
}

$monthly_price = $monthly_level ? number_format($monthly_level->initial_payment, 2) : '29.00';
$monthly_title = $monthly_level ? $monthly_level->name : 'Monthly Access';
?>

<main class="landing-page">
    <!-- Harmoni-Style Hero Section -->
    <section class="hero">
        <div class="hero-image-container">
            <div class="hero-content">
                <div class="hero-text-content">
                    <!-- Desktop/Tablet version - image -->
                    <div class="desktop-hero-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/herosizing2.png" alt="POWERED BY PAYGE - PILATES INSPIRED STRENGTH MOVEMENT - EST. 2025" />
                    </div>

                    <!-- Mobile version - image -->
                    <div class="mobile-hero-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mobileimage2.png" alt="POWERED BY PAYGE - PILATES INSPIRED STRENGTH MOVEMENT - EST. 2025" />
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="/membership-levels" class="universal-btn">
                        <span class="universal-btn-circle">
                            <span class="universal-btn-arrow">
                                <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                                </svg>
                            </span>
                        </span>
                        <span class="universal-btn-text">Sign Up</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Where Strength Meets Mobility Section -->
    <section class="community-section">
        <div class="container">
            <div class="community-layout">
                <!-- Left Side Content -->
                <div class="community-content">
                    <h2 class="community-title">Movement for the Mind & Body</h2>

                    <!-- Community Description -->
                    <div class="community-description-container">
                        <p class="community-description-desktop"><strong>POWERED</strong> was created to build a strong and supportive community. These classes combine sculpt-style training with Pilates-inspired movements to enhance <strong>strength, flexibility, and coordination</strong>, all while keeping you grounded in your body. Each session is designed to help you move <strong>out of your head and into your body</strong>, deepening your <strong>mind-body connection</strong>. I believe everyone deserves the opportunity to move their body <strong>anytime, anywhere</strong>. POWERED offers something for <strong>every body and every level</strong>, meeting you where you are and helping you grow from there.</p>
                        <p class="community-description-mobile">POWERED offers something for <strong>every body and every level</strong>, meeting you where you are and helping you grow from there.</p>
                    </div>

                    <a href="/membership-levels" class="community-btn">
                        <span class="community-btn-circle">
                            <span class="community-btn-arrow">
                                <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                                </svg>
                            </span>
                        </span>
                        <span class="community-btn-text">Sign Up</span>
                    </a>
                </div>

                <!-- Right Side Media Container -->
                <div class="community-media">
                    <!-- Main Video -->
                    <div class="community-image">
                        <?php
                        // Get video from WordPress customizer or use default video
                        $community_video_url = get_theme_mod('payge_community_video_url', get_template_directory_uri() . '/assets/videos/section2vid.mp4');
                        $fallback_image = get_template_directory_uri() . '/assets/images/testimonial-1.jpg';
                        ?>

                        <video autoplay muted loop playsinline poster="<?php echo $fallback_image; ?>">
                            <source src="<?php echo esc_url($community_video_url); ?>" type="video/mp4">
                            <!-- Fallback image for unsupported browsers/mobile -->
                            <img src="<?php echo $fallback_image; ?>" alt="Community member practicing">
                        </video>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section - Harmoni Style -->
    <section class="pricing-section">
        <div class="container">
            <div class="pricing-layout">
                <!-- Left Side Content -->
                <div class="pricing-content">
                    <h2 class="pricing-title">Pricing</h2>

                    <!-- Video Container -->
                    <div class="pricing-video-container">
                        <video autoplay muted loop playsinline class="pricing-video" preload="auto" style="opacity: 1 !important; transform: scale(1) !important; position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;">
                            <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/landscapevid.mp4" type="video/mp4">
                        </video>
                    </div>

                    <div class="pricing-bottom">
                        <a href="/contact" class="contact-btn">
                            <span class="contact-btn-circle">
                                <span class="btn-arrow">
                                    <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="contact-btn-text">Sign Up</span>
                        </a>
                    </div>
                </div>

                <!-- Right Side Single Card -->
                <div class="pricing-cards">
                    <div class="pricing-card">
                        <div class="card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L15 9L22 9L17 14L19 21L12 17L5 21L7 14L2 9L9 9Z"/>
                            </svg>
                        </div>
                        <h3 class="card-title"><?php echo esc_html($monthly_title); ?></h3>
                        <div class="card-price">
                            <span class="price-amount">$<?php echo esc_html($monthly_price); ?></span>
                            <span class="price-period">per month</span>
                        </div>
                        <div class="founder-badge">Founder Pricing</div>
                        <div class="card-content-wrapper">
                            <p class="card-description">Get access to our full library of online workouts at the founders price</p>
                        </div>
                        <a href="/membership-levels" class="card-btn">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="faq-header">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-subtitle">Everything you need to know about POWERED classes</p>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">What is POWERED?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>An online platform created with the goal to give you access to fun workouts anywhere and anytime. These classes are a fusion of sculpt style training with Pilates inspired movements, designed to build strength, flexibility, and coordination, all while keeping you deeply connected to your body.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">Will there be classes for beginners?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! POWERED offers classes for all levels: beginner, intermediate, and advanced. Workouts range from 10 to 50 minutes, so you can choose what fits your schedule and experience level.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">What equipment do I need?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>Many classes will require no equipment at all, making it easy to join from anywhere. For those workouts that do use props, you might find yourself using some of the following: a set of weights, ankle weights, yoga blocks, a Pilates ball, resistance bands, or sliders.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">What certifications does Payge have?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>I earned my mat Pilates certification through STOTT Pilates by Merrithew. This training inspired me to create the sculpt-style classes I now teach, blending strength and mindful movement.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>