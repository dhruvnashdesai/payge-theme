/**
 * Customizer live preview script
 *
 * @package Payge_Theme
 */

(function($) {
    'use strict';

    // Site title and description
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Header text color
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
                $('.site-title a, .site-description').css({
                    'color': to
                });
            }
        });
    });

    // Hero title
    wp.customize('payge_hero_title', function(value) {
        value.bind(function(to) {
            $('.hero h1').text(to);
        });
    });

    // Hero subtitle
    wp.customize('payge_hero_subtitle', function(value) {
        value.bind(function(to) {
            $('.hero .subheadline').text(to);
        });
    });

    // Hero button text
    wp.customize('payge_hero_button_text', function(value) {
        value.bind(function(to) {
            $('.hero .btn').text(to);
        });
    });

    // Hero button URL
    wp.customize('payge_hero_button_url', function(value) {
        value.bind(function(to) {
            $('.hero .btn').attr('href', to);
        });
    });

    // Monthly price
    wp.customize('payge_monthly_price', function(value) {
        value.bind(function(to) {
            $('.pricing-card:not(.pricing-card-featured) .amount').text(to);
        });
    });

    // Annual price
    wp.customize('payge_annual_price', function(value) {
        value.bind(function(to) {
            $('.pricing-card-featured .amount').text(to);
        });
    });

    // Primary color
    wp.customize('payge_primary_color', function(value) {
        value.bind(function(to) {
            var style = '<style id="payge-primary-color">' +
                '.btn, .feature-icon, .pricing-badge, .pricing-card-featured { background-color: ' + to + ' !important; }' +
                'h1, h2, h3, h4, h5, h6, .site-title a, .video-title { color: ' + to + ' !important; }' +
                '.pricing-card-featured { border-color: ' + to + ' !important; }' +
                '</style>';

            if ($('#payge-primary-color').length) {
                $('#payge-primary-color').replaceWith(style);
            } else {
                $('head').append(style);
            }
        });
    });

    // Accent color
    wp.customize('payge_accent_color', function(value) {
        value.bind(function(to) {
            var style = '<style id="payge-accent-color">' +
                '.video-level.beginner, .pricing-features li:before, .savings { color: ' + to + ' !important; }' +
                '.video-level.beginner { background-color: ' + to + '20 !important; }' +
                '</style>';

            if ($('#payge-accent-color').length) {
                $('#payge-accent-color').replaceWith(style);
            } else {
                $('head').append(style);
            }
        });
    });

})(jQuery);