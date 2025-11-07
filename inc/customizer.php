<?php
/**
 * Payge Theme Customizer
 *
 * @package Payge_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function payge_theme_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'payge_theme_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'payge_theme_customize_partial_blogdescription',
            )
        );
    }

    // Add Payge Theme Options Section
    $wp_customize->add_section('payge_theme_options', array(
        'title'    => esc_html__('Payge Theme Options', 'payge-theme'),
        'priority' => 30,
    ));

    // Hero Section Settings
    $wp_customize->add_setting('payge_hero_title', array(
        'default'           => 'Transform Your Body Through Pilates',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_hero_title', array(
        'label'   => esc_html__('Hero Title', 'payge-theme'),
        'section' => 'payge_theme_options',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('payge_hero_subtitle', array(
        'default'           => 'Discover strength, flexibility, and mindfulness in our premium studio',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_hero_subtitle', array(
        'label'   => esc_html__('Hero Subtitle', 'payge-theme'),
        'section' => 'payge_theme_options',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('payge_hero_button_text', array(
        'default'           => 'Start Your Journey',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_hero_button_text', array(
        'label'   => esc_html__('Hero Button Text', 'payge-theme'),
        'section' => 'payge_theme_options',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('payge_hero_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_hero_button_url', array(
        'label'   => esc_html__('Hero Button URL', 'payge-theme'),
        'section' => 'payge_theme_options',
        'type'    => 'url',
    ));

    // Membership Pricing Settings
    $wp_customize->add_setting('payge_monthly_price', array(
        'default'           => '29',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_monthly_price', array(
        'label'   => esc_html__('Monthly Price', 'payge-theme'),
        'section' => 'payge_theme_options',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('payge_annual_price', array(
        'default'           => '290',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_annual_price', array(
        'label'   => esc_html__('Annual Price', 'payge-theme'),
        'section' => 'payge_theme_options',
        'type'    => 'text',
    ));

    // Community Video Settings
    $wp_customize->add_setting('payge_community_video_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('payge_community_video_url', array(
        'label'       => esc_html__('Community Video URL', 'payge-theme'),
        'description' => esc_html__('Upload video to Media Library and paste URL here for the "Where strength meets mobility" section', 'payge-theme'),
        'section'     => 'payge_theme_options',
        'type'        => 'url',
    ));

    // Theme Colors
    $wp_customize->add_setting('payge_primary_color', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'payge_primary_color', array(
        'label'   => esc_html__('Primary Color', 'payge-theme'),
        'section' => 'payge_theme_options',
    )));

    $wp_customize->add_setting('payge_accent_color', array(
        'default'           => '#2d7d32',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'payge_accent_color', array(
        'label'   => esc_html__('Accent Color', 'payge-theme'),
        'section' => 'payge_theme_options',
    )));

    // Add Social Media Section
    $wp_customize->add_section('payge_social_media', array(
        'title'    => esc_html__('Social Media', 'payge-theme'),
        'priority' => 30,
    ));

    // Add Instagram URL Setting
    $wp_customize->add_setting('payge_instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('payge_instagram_url', array(
        'label'       => esc_html__('Instagram URL', 'payge-theme'),
        'section'     => 'payge_social_media',
        'type'        => 'url',
        'description' => esc_html__('Enter your Instagram profile URL (e.g., https://instagram.com/yourprofile)', 'payge-theme'),
    ));
}
add_action('customize_register', 'payge_theme_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function payge_theme_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function payge_theme_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function payge_theme_customize_preview_js() {
    wp_enqueue_script('payge-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'payge_theme_customize_preview_js');