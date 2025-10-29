<?php get_header(); ?>

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
    <!-- Harmoni-Style Hero Section -->
    <section class="hero">
        <div class="hero-image-container">
            <div class="hero-content">
                <div class="hero-text-content">
                    <h1 class="hero-line-1" data-text="POWERED BY PAYGE">POWERED BY PAYGE</h1>
                    <h2 class="hero-line-2" data-text="PILATES INSPIRED STRENGTH MOVEMENT">PILATES INSPIRED STRENGTH MOVEMENT</h2>
                    <h3 class="hero-line-3" data-text="EST. 2025">EST. 2025</h3>
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
                        <p class="community-description-single"><strong>POWERED</strong> was created with the intention of growing a strong and supportive community. These classes are a fusion of sculpt-style training with Pilates-inspired movements, designed to build <strong>strength, flexibility, and coordination</strong>—all while keeping you deeply connected to your body. Every session is crafted to help you get <strong>out of your head and into your body</strong>, focusing on the deep <strong>mind-body connection</strong>. I believe everyone deserves the chance to move their body—<strong>anytime, anywhere</strong>. POWERED offers something for <strong>every body and every level</strong>— meeting you where you are at and building you up from there!</p>
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
                    <h2 class="pricing-title">Pricing for the girls</h2>

                    <!-- Video Container -->
                    <div class="pricing-video-container">
                        <video autoplay muted loop playsinline class="pricing-video" preload="auto" style="opacity: 1 !important; transform: scale(1) !important; position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;">
                            <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/landscapevid.mp4" type="video/mp4">
                            <p style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: red; font-weight: bold; z-index: 10;">VIDEO NOT LOADING: <?php echo get_template_directory_uri(); ?>/assets/videos/filler-vid.mp4</p>
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
                        <h3 class="card-title">Monthly Access</h3>
                        <div class="card-price">
                            <span class="price-original">$<?php echo esc_html($monthly_price); ?></span>
                            <span class="price-amount">$27.99</span>
                            <span class="price-period">first 3 months</span>
                        </div>
                        <div class="founder-badge">Founder Pricing</div>
                        <div class="card-content-wrapper">
                            <p class="card-description">Perfect for trying our classes before committing. Ideal for unpredictable schedules.</p>
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
                <p class="faq-subtitle">Everything you need to know about our Pilates classes</p>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">What should I bring to my first class?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>Just bring a water bottle and wear comfortable workout clothes. We provide all the mats and equipment you'll need for class.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">Are classes suitable for beginners?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>Absolutely! Our classes are designed to accommodate all fitness levels. We offer modifications for every exercise to ensure everyone feels comfortable and challenged.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">How often should I attend classes?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>We recommend 2-3 classes per week for optimal results. However, even one class per week can provide significant benefits for your strength, flexibility, and overall well-being.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-question-text">Can I cancel my membership anytime?</span>
                        <div class="faq-toggle">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, you have complete flexibility with your membership. You can cancel anytime with 30 days notice, and we offer the option to pause your membership if needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section - Harmoni Style -->
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.png" alt="Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">"Joining these Pilates classes has been life-changing. I feel more energized every day."</p>
                        <div class="testimonial-author">
                            <span class="author-name">Sarah, Pilates Enthusiast</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.png" alt="Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">"Joining these yoga classes has been life-changing. I feel more energized every day."</p>
                        <div class="testimonial-author">
                            <span class="author-name">Sarah, Yoga Enthusiast</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.png" alt="Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">"The instructors are amazing and the flexibility I've gained is incredible."</p>
                        <div class="testimonial-author">
                            <span class="author-name">Mike, Fitness Enthusiast</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.png" alt="Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">"Best decision I ever made for my health and wellness journey."</p>
                        <div class="testimonial-author">
                            <span class="author-name">Emma, Wellness Coach</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.png" alt="Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">"The community here is so supportive and welcoming to all levels."</p>
                        <div class="testimonial-author">
                            <span class="author-name">Lisa, Community Member</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.png" alt="Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">"I've never felt stronger or more confident in my body than I do now."</p>
                        <div class="testimonial-author">
                            <span class="author-name">Alex, Regular Member</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="testimonials-navigation">
                <button class="nav-btn prev-btn" aria-label="Previous testimonials">‹</button>
                <button class="nav-btn next-btn" aria-label="Next testimonials">›</button>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>