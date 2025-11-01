/**
 * Theme JavaScript
 *
 * @package Payge_Theme
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {

        // TEMPORARILY DISABLED - Force all login links to use our custom login page
        // function interceptLoginLinks() {
        //     // Intercept all login-related links
        //     $('a[href*="wp-login.php"], a[href*="wordpress.com/log-in"], a[href*="jetpack-sso"]').each(function() {
        //         $(this).attr('href', '/login/');
        //     });

        //     // Also check for any dynamic login links
        //     $(document).on('click', 'a[href*="wp-login.php"], a[href*="wordpress.com/log-in"], a[href*="jetpack-sso"]', function(e) {
        //         e.preventDefault();
        //         window.location.href = '/login/';
        //         return false;
        //     });
        // }

        // // Run immediately and periodically to catch dynamic content
        // interceptLoginLinks();
        // setInterval(interceptLoginLinks, 1000);

        // JavaScript login interceptors removed - letting PMPro handle login natively

        // Harmoni-style header scroll effect
        $(window).on('scroll', function() {
            var scrollTop = $(window).scrollTop();
            var header = $('.site-header');

            if (scrollTop > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });

        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('#primary-menu, .nav-menu').toggleClass('active');
            $('.auth-navigation').toggleClass('active');
            $('.menu-close').toggleClass('active');
            $('body').toggleClass('menu-open');
        });

        // Mobile menu close
        $('.menu-close').on('click', function() {
            $('.menu-toggle').removeClass('active');
            $('#primary-menu, .nav-menu').removeClass('active');
            $('.auth-navigation').removeClass('active');
            $('.menu-close').removeClass('active');
            $('body').removeClass('menu-open');
        });

        // Video card click handler
        $('.video-card').on('click', function() {
            var videoUrl = $(this).data('video-url');
            if (videoUrl) {
                // For now, just open in new tab
                // In a real implementation, you'd open a modal or video player
                window.open(videoUrl, '_blank');
            }
        });

        // Membership card billing toggle
        $('.toggle-btn').on('click', function() {
            var billingType = $(this).data('billing');

            // Update toggle buttons
            $('.toggle-btn').removeClass('active');
            $(this).addClass('active');

            // Update pricing display
            $('.price-section').removeClass('active');
            $('.' + billingType + '-price').addClass('active');
        });

        // Testimonials horizontal carousel
        const testimonialsGrid = $('.testimonials-grid');
        const cardWidth = 360 + 32; // Card width + gap (360px + 2rem)

        function scrollTestimonials(direction) {
            const scrollAmount = cardWidth; // Scroll 1 card at a time for precise control
            const currentScroll = testimonialsGrid.scrollLeft();

            if (direction === 'next') {
                testimonialsGrid.animate({
                    scrollLeft: currentScroll + scrollAmount
                }, 400);
            } else {
                testimonialsGrid.animate({
                    scrollLeft: currentScroll - scrollAmount
                }, 400);
            }
        }

        // Set initial scroll position to cut off first card
        if (testimonialsGrid.length) {
            let initialOffset;
            const screenWidth = $(window).width();

            if (screenWidth <= 768) {
                initialOffset = 60; // Mobile cutoff
            } else if (screenWidth <= 1200) {
                initialOffset = 80; // Tablet cutoff
            } else {
                initialOffset = 120; // Desktop cutoff
            }

            testimonialsGrid.scrollLeft(initialOffset);
        }

        // Navigation button clicks for testimonials
        $('.testimonials-navigation .next-btn').on('click', function() {
            scrollTestimonials('next');
        });

        $('.testimonials-navigation .prev-btn').on('click', function() {
            scrollTestimonials('prev');
        });

        // Handle window resize to maintain proper initial offset
        $(window).on('resize', function() {
            if (testimonialsGrid.length) {
                let initialOffset;
                const screenWidth = $(window).width();

                if (screenWidth <= 768) {
                    initialOffset = 60;
                } else if (screenWidth <= 1200) {
                    initialOffset = 80;
                } else {
                    initialOffset = 120;
                }

                testimonialsGrid.scrollLeft(initialOffset);
            }
        });

        // Smooth scrolling for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });

        // Removed parallax scroll effect from hero section to keep it static

        // Pricing card hover effects
        $('.pricing-card').on('mouseenter', function() {
            $(this).addClass('hovered');
        }).on('mouseleave', function() {
            $(this).removeClass('hovered');
        });

        // Feature cards animation on scroll
        if (typeof IntersectionObserver !== 'undefined') {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                    }
                });
            }, observerOptions);

            // Observe feature cards
            document.querySelectorAll('.feature-card, .video-card, .pricing-card').forEach(function(card) {
                observer.observe(card);
            });
        }

        // Video Library Filter Functionality
        $('.filter-btn').on('click', function() {
            var filter = $(this).data('filter');

            // Update active button
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            // Filter video cards
            if (filter === 'all') {
                $('.video-card').removeClass('hidden');
            } else {
                $('.video-card').each(function() {
                    var cardLevel = $(this).data('level');
                    if (cardLevel === filter) {
                        $(this).removeClass('hidden');
                    } else {
                        $(this).addClass('hidden');
                    }
                });
            }
        });

        // Video Search Functionality
        $('.video-search').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('.video-card').each(function() {
                var title = $(this).find('.video-title').text().toLowerCase();
                var description = $(this).find('.video-description').text().toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        });

        // Load More Button
        $('.load-more-btn').on('click', function() {
            var $button = $(this);
            var originalText = $button.text();

            $button.text('Loading...').prop('disabled', true);

            // Simulate loading more videos (replace with actual Vimeotheque integration)
            setTimeout(function() {
                // This would be replaced with actual video loading
                $button.text(originalText).prop('disabled', false);

                // Show success message or load actual videos
                // Ready for Vimeotheque integration
            }, 1000);
        });

        // Video Card Interactions for Library Page
        $(document).on('click', '.video-card', function() {
            // This will be enhanced when Vimeotheque is integrated
            var title = $(this).find('.video-title').text();
            // Video interaction ready for Vimeotheque integration

            // Add loading state
            $(this).addClass('loading');

            // Remove loading state after a moment
            setTimeout(() => {
                $(this).removeClass('loading');
            }, 500);
        });

        // Form validation for contact forms - DISABLED for PMPro compatibility
        // Skip PMPro forms to avoid conflicts
        $('form').not('.pmpro_form, #pmpro_form, [action*="pmpro"], [action*="checkout"], [action*="membership"]').on('submit', function(e) {
            var form = $(this);
            var hasErrors = false;

            // Basic email validation
            form.find('input[type="email"]').each(function() {
                var email = $(this).val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailRegex.test(email)) {
                    $(this).addClass('error');
                    hasErrors = true;
                } else {
                    $(this).removeClass('error');
                }
            });

            // Required field validation
            form.find('[required]').each(function() {
                if (!$(this).val().trim()) {
                    $(this).addClass('error');
                    hasErrors = true;
                } else {
                    $(this).removeClass('error');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                // You could show an error message here
            }
        });

        // Force styling on profile and change password pages
        if (window.location.href.indexOf('your-profile') !== -1) {
            $('body').addClass('profile-page-view');

            // Add styling classes to forms that might not have them
            $('.pmpro_checkout, .pmpro_form, form').addClass('pmpro_profile_form');

            // Ensure page background is white
            $('body, #content').css('background-color', 'white');
        }

        if (window.location.href.indexOf('change-password') !== -1) {
            $('body').addClass('change-password-view');

            // Add styling classes to forms that might not have them
            $('.pmpro_checkout, .pmpro_form, form[action*="change-password"]').addClass('pmpro_profile_form');

            // Ensure page background is white
            $('body, #content').css('background-color', 'white');
        }

        // Force spacing on membership levels page
        if (window.location.href.indexOf('membership-levels') !== -1) {
            $('#content, .site-main').css({
                'padding-top': '2rem',
                'margin-top': '1rem',
                'max-width': '1000px',
                'margin-left': 'auto',
                'margin-right': 'auto'
            });
        }

        // Force spacing on membership checkout page
        if (window.location.href.indexOf('membership-checkout') !== -1 || window.location.href.indexOf('checkout') !== -1) {
            $('#content, .site-main').css({
                'padding-top': '2rem',
                'margin-top': '1rem',
                'max-width': '1000px',
                'margin-left': 'auto',
                'margin-right': 'auto'
            });
        }

        // Hero Animation Functions (defined early for use in window.load)
        window.wrapTextInLetters = function(element) {
            // Get text from data-text attribute
            const text = element.getAttribute('data-text');
            if (!text) return;

            element.innerHTML = '';

            // Wrap each character
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
        };

        window.animateLetters = function(element, delay = 0) {
            const letters = element.querySelectorAll('.hero-letter');
            letters.forEach((letter, index) => {
                setTimeout(() => {
                    letter.classList.add('animate-in');
                }, delay + (index * 50)); // 50ms between each letter
            });
        };

        window.animateLettersQuick = function(element, delay = 0) {
            const letters = element.querySelectorAll('.hero-letter');
            letters.forEach((letter, index) => {
                setTimeout(() => {
                    letter.classList.add('animate-in');
                }, delay + (index * 15)); // 15ms between each letter - much faster
            });
        };

        // Community Navigation Functionality
        window.initCommunityNav = function() {
            const navButtons = document.querySelectorAll('.nav-button');
            const descriptions = document.querySelectorAll('.community-description');

            navButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetContent = button.getAttribute('data-content');

                    // Remove active class from all buttons
                    navButtons.forEach(btn => btn.classList.remove('active'));

                    // Add active class to clicked button
                    button.classList.add('active');

                    // Hide all descriptions
                    descriptions.forEach(desc => desc.classList.remove('active'));

                    // Show target description
                    const targetDescription = document.querySelector(`[data-content="${targetContent}"].community-description`);
                    if (targetDescription) {
                        setTimeout(() => {
                            targetDescription.classList.add('active');
                        }, 100); // Small delay for smooth transition
                    }
                });
            });
        };

        // Scroll Animation Observer
        window.initScrollAnimations = function() {
            const observerOptions = {
                threshold: 0.2,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;

                        // Animate community video/image
                        if (element.classList.contains('community-image')) {
                            const media = element.querySelector('img, video');
                            if (media) {
                                setTimeout(() => {
                                    media.classList.add('animate-in');
                                }, 200);
                            }
                        }

                        // Animate secondary image with slight delay
                        if (element.classList.contains('community-secondary-image')) {
                            const img = element.querySelector('img');
                            if (img) {
                                setTimeout(() => {
                                    img.classList.add('animate-in');
                                }, 600);
                            }
                        }

                        // Animate pricing cards with staggered timing
                        if (element.classList.contains('pricing-card')) {
                            const cards = document.querySelectorAll('.pricing-card');
                            const cardIndex = Array.from(cards).indexOf(element);
                            setTimeout(() => {
                                element.classList.add('animate-in');
                            }, 200 + (cardIndex * 200)); // 200ms delay between cards
                        }

                        observer.unobserve(element);
                    }
                });
            }, observerOptions);

            // Observe community section elements
            const communityImage = document.querySelector('.community-image');
            const secondaryImage = document.querySelector('.community-secondary-image');

            if (communityImage) observer.observe(communityImage);
            if (secondaryImage) observer.observe(secondaryImage);

            // Observe pricing cards
            const pricingCards = document.querySelectorAll('.pricing-card');
            pricingCards.forEach(card => observer.observe(card));
        };

        // Initialize hero animations on front page
        if ($('body').hasClass('home')) {
            // Wrap hero text lines in letter spans
            const heroLine1 = document.querySelector('.hero-line-1');
            const heroLine2 = document.querySelector('.hero-line-2');
            const heroLine3 = document.querySelector('.hero-line-3');

            if (heroLine1) {
                window.wrapTextInLetters(heroLine1);
            }
            if (heroLine2) {
                window.wrapTextInLetters(heroLine2);
            }
            if (heroLine3) {
                window.wrapTextInLetters(heroLine3);
            }

            // Initialize scroll animations
            window.initScrollAnimations();

            // Initialize community navigation
            window.initCommunityNav();
        }

        // Style invoice pages
        if (window.location.href.indexOf('?invoice=') !== -1 || window.location.href.indexOf('&invoice=') !== -1) {
            $('body').addClass('invoice-page');

            // Apply invoice styling
            $('#content, .site-main').css({
                'padding-top': '2rem',
                'margin-top': '1rem',
                'max-width': '800px',
                'margin-left': 'auto',
                'margin-right': 'auto',
                'background-color': 'white'
            });

            // Style invoice content
            $('.pmpro_invoice, .invoice-content, .membership-invoice').css({
                'background-color': 'white',
                'border': '1px solid #e0e0e0',
                'border-radius': '8px',
                'padding': '2rem',
                'margin': '2rem 0',
                'box-shadow': '0 2px 10px rgba(0,0,0,0.1)'
            });
        }



    });

    // Window load
    $(window).on('load', function() {
        // Hide loading indicators, if any
        $('.loading').fadeOut();

        // Initialize any other components that need the page to be fully loaded

        // Hero animations on front page
        if ($('body').hasClass('home')) {
            // Step 1: Animate image container growing in
            setTimeout(() => {
                $('.hero-image-container').addClass('animate-in');
            }, 500); // Start after 500ms

            // Step 2: Show hero content (fade in the container)
            setTimeout(() => {
                $('.hero-content').addClass('animate-in');
            }, 1200); // Start after image animation

            // Step 3: Animate hero text lines
            setTimeout(() => {
                const heroLine1 = document.querySelector('.hero-line-1');
                const heroLine2 = document.querySelector('.hero-line-2');
                const heroLine3 = document.querySelector('.hero-line-3');

                if (heroLine1) {
                    window.animateLetters(heroLine1, 0);
                }
                if (heroLine2) {
                    window.animateLettersQuick(heroLine2, 500);
                }
                if (heroLine3) {
                    window.animateLettersQuick(heroLine3, 800);
                }
            }, 1400); // Start 200ms after content fade

            // Step 5: Animate buttons
            setTimeout(() => {
                $('.hero-buttons .universal-btn, .hero-buttons .btn-primary, .hero-buttons .btn-secondary').each(function(index) {
                    const $btn = $(this);
                    setTimeout(() => {
                        $btn.css({
                            'opacity': '1',
                            'transform': 'translateY(0)',
                            'transition': 'opacity 0.6s ease, transform 0.6s cubic-bezier(0.16, 1, 0.3, 1)'
                        });
                    }, index * 200); // Stagger buttons
                });
            }, 3000); // Start after subtitle animation
        }
    });

    // FAQ Toggle functionality
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });

})(jQuery);