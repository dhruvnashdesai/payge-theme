<?php get_header(); ?>

<!-- DEBUG: Front page template is loading -->
<div style="background: yellow; padding: 10px; text-align: center; margin: 10px;">
    DEBUG: Front-page.php template loaded successfully
</div>

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
    <section class="hero" style="background: purple !important; min-height: 500px !important; padding: 50px !important;">

        <!-- DEBUG: Hero section HTML is generating -->
        <div style="background: white; color: black; padding: 20px; margin: 20px; border: 5px solid red;">
            <h1>DEBUG: HERO SECTION HTML IS WORKING</h1>
            <p>If you see this, the HTML is generating but CSS might not be applied</p>
        </div>

        <div class="hero-image-container" style="background: cyan !important; min-height: 300px !important;">

            <!-- DEBUG: Show exact HTML structure -->
            <div style="background: yellow; color: black; padding: 10px; margin: 10px; border: 3px solid black;">
                <strong>DEBUG HTML STRUCTURE:</strong><br>
                hero-image-container exists ✓<br>
                About to render hero-content, hero-text-content, and hero-line elements...
            </div>

            <div class="hero-content" style="background: orange !important; padding: 20px !important;">
                <div class="hero-text-content" style="background: red !important; padding: 15px !important;">
                    <h1 class="hero-line-1" style="background: white !important; color: black !important; padding: 10px !important; font-size: 48px !important; margin: 10px 0 !important;">POWERED BY PAYGE</h1>
                    <h2 class="hero-line-2" style="background: white !important; color: black !important; padding: 10px !important; font-size: 24px !important; margin: 10px 0 !important;">PILATES INSPIRED STRENGTH MOVEMENT</h2>
                    <h3 class="hero-line-3" style="background: white !important; color: black !important; padding: 10px !important; font-size: 18px !important; margin: 10px 0 !important;">EST. 2025</h3>
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
                    <h2 class="community-title">Where strength meets <em>mobility</em></h2>

                    <!-- Community Navigation Buttons -->
                    <div class="community-nav">
                        <button class="nav-button active" data-content="1">1</button>
                        <button class="nav-button" data-content="2">2</button>
                        <button class="nav-button" data-content="3">3</button>
                        <button class="nav-button" data-content="4">4</button>
                    </div>

                    <div class="community-description-container">
                        <p class="community-description active" data-content="1">Founded with a passion for creating a welcoming space where everyone can connect, grow, and thrive, we've become a vibrant community of individuals dedicated to improving their body, mind, and spirit.</p>
                        <p class="community-description" data-content="2">Through expert instruction and personalized attention, we guide you on a transformative journey that strengthens not just your body, but your confidence and mental clarity as well.</p>
                        <p class="community-description" data-content="3">Our comprehensive approach combines traditional Pilates principles with modern techniques, ensuring every session challenges you while respecting your individual pace and goals.</p>
                        <p class="community-description" data-content="4">Join a supportive community where beginners feel welcomed and advanced practitioners continue to grow, all within our beautifully designed studio space.</p>
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
                        // Get video from WordPress customizer or fallback to placeholder
                        $community_video_url = get_theme_mod('payge_community_video_url', '');
                        $fallback_image = get_template_directory_uri() . '/assets/images/testimonial-1.jpg';

                        if (!empty($community_video_url)) : ?>
                            <video autoplay muted loop playsinline poster="<?php echo $fallback_image; ?>">
                                <source src="<?php echo esc_url($community_video_url); ?>" type="video/mp4">
                                <!-- Fallback image for unsupported browsers/mobile -->
                                <img src="<?php echo $fallback_image; ?>" alt="Community member practicing">
                            </video>
                        <?php else : ?>
                            <!-- Fallback image when no video is set -->
                            <img src="<?php echo $fallback_image; ?>" alt="Community member practicing">
                        <?php endif; ?>
                    </div>

                    <!-- Secondary Image - Top Right -->
                    <div class="community-secondary-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pic1.png" alt="Pilates practice">
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
                        <video autoplay muted loop playsinline class="pricing-video">
                            <source src="<?php echo get_template_directory_uri(); ?>/assets/images/filler-vid.mp4" type="video/mp4">
                            <!-- Fallback image -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pricing-fallback.jpg" alt="Pricing video">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to wrap each letter in a span
    function wrapLetters(element) {
        const text = element.getAttribute('data-text');
        element.innerHTML = '';

        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const span = document.createElement('span');
            span.classList.add('hero-letter');

            if (char === ' ') {
                span.classList.add('space');
                span.innerHTML = '&nbsp;';
            } else {
                span.textContent = char;
            }

            element.appendChild(span);
        }
    }

    // Wrap letters for all hero text lines
    const heroLines = document.querySelectorAll('.hero-line-1, .hero-line-2, .hero-line-3');
    heroLines.forEach(wrapLetters);

    // Animate letters in sequence
    function animateLetters() {
        const allLetters = document.querySelectorAll('.hero-letter');
        let delay = 0;

        allLetters.forEach((letter, index) => {
            setTimeout(() => {
                letter.classList.add('animate-in');
            }, delay);
            delay += 50; // 50ms delay between each letter
        });

        // Animate buttons after all letters are done
        setTimeout(() => {
            const heroButtons = document.querySelector('.hero-buttons');
            if (heroButtons) {
                heroButtons.style.opacity = '1';
                heroButtons.style.transform = 'translateY(0)';
            }
        }, delay + 500);
    }

    // Start animation after a short delay
    setTimeout(animateLetters, 500);

    // Pricing video animation
    const pricingVideo = document.querySelector('.pricing-video');
    if (pricingVideo) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        observer.observe(pricingVideo);
    }
});
</script>

<?php get_footer(); ?>