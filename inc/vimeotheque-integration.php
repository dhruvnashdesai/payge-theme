<?php
/**
 * Vimeotheque Integration Helper Functions
 *
 * This file contains placeholder functions and documentation
 * for integrating with Vimeotheque PRO when ready.
 *
 * @package Payge_Theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if Vimeotheque is active
 */
function payge_theme_is_vimeotheque_active() {
    return class_exists('Vimeotheque\Core') ||
           class_exists('CVM_Video_Post') ||
           class_exists('Codeflavors\\VideoPost\\Plugin') ||
           function_exists('cvm_get_video_post');
}

/**
 * Get the correct Vimeotheque post type
 */
function payge_theme_get_vimeo_post_type() {
    // Check which post types exist
    if (post_type_exists('vimeo-video')) {
        return 'vimeo-video';
    } elseif (post_type_exists('cvm_video')) {
        return 'cvm_video';
    } elseif (post_type_exists('video')) {
        return 'video';
    }
    return false;
}

/**
 * Debug Vimeotheque installation
 */
function payge_theme_debug_vimeotheque() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $debug_info = array();

    // Check plugin classes
    $plugin_classes = array(
        'Vimeotheque\\Core' => 'Vimeotheque PRO Core',
        'CVM_Video_Post' => 'Vimeotheque Lite',
        'Codeflavors\\VideoPost\\Plugin' => 'Vimeotheque PRO (new namespace)'
    );

    foreach ($plugin_classes as $class => $description) {
        $debug_info['classes'][$class] = class_exists($class) ? 'Active' : 'Not Found';
    }

    // Check functions
    $functions = array('cvm_get_video_post', 'cvm_video_embed_html', 'cvm_get_video_data');
    foreach ($functions as $func) {
        $debug_info['functions'][$func] = function_exists($func) ? 'Available' : 'Not Found';
    }

    // Check post types
    $post_types = array('vimeo-video', 'cvm_video', 'video');
    foreach ($post_types as $post_type) {
        $debug_info['post_types'][$post_type] = post_type_exists($post_type) ? 'Registered' : 'Not Registered';
    }

    return $debug_info;
}

/**
 * Get featured video for hero section
 *
 * This function will be used to get the featured video
 * for the library page hero section when Vimeotheque is active.
 */
function payge_theme_get_featured_video() {
    if (!payge_theme_is_vimeotheque_active()) {
        return false;
    }

    // Placeholder for Vimeotheque integration
    // When implemented, this would query for a featured video
    // Example query structure:
    /*
    $args = array(
        'post_type' => 'vimeo-video',
        'meta_key' => '_is_featured',
        'meta_value' => '1',
        'posts_per_page' => 1
    );
    return get_posts($args);
    */

    return false;
}

/**
 * Get video library grid
 *
 * Improved function to get videos for the grid display
 * Works with or without Vimeotheque active
 */
function payge_theme_get_video_library($args = array()) {
    // Get the correct post type to use
    $vimeo_post_type = payge_theme_get_vimeo_post_type();

    // Default arguments - include multiple post types as fallback
    $post_types = array();
    if ($vimeo_post_type) {
        $post_types[] = $vimeo_post_type;
    }
    // Always include our custom video type as fallback
    if (post_type_exists('video')) {
        $post_types[] = 'video';
    }

    if (empty($post_types)) {
        return false;
    }

    $defaults = array(
        'post_type' => $post_types,
        'posts_per_page' => 12,
        'post_status' => array('publish'),
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_vimeo_video_id',
                'compare' => 'EXISTS'
            ),
            array(
                'key' => 'vimeo_video_id',
                'compare' => 'EXISTS'
            ),
            array(
                'key' => '_video_url',
                'compare' => 'EXISTS'
            )
        )
    );

    $final_args = wp_parse_args($args, $defaults);

    return get_posts($final_args);
}

/**
 * Alternative direct database query for videos
 */
function payge_theme_get_videos_direct($limit = 12) {
    global $wpdb;

    $post_types = "'vimeo-video', 'cvm_video', 'video'";

    $sql = $wpdb->prepare("
        SELECT p.*,
               vm1.meta_value as vimeo_id,
               vm2.meta_value as video_url,
               vm3.meta_value as duration
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} vm1 ON (p.ID = vm1.post_id AND vm1.meta_key = '_vimeo_video_id')
        LEFT JOIN {$wpdb->postmeta} vm2 ON (p.ID = vm2.post_id AND vm2.meta_key = '_video_url')
        LEFT JOIN {$wpdb->postmeta} vm3 ON (p.ID = vm3.post_id AND vm3.meta_key = '_video_duration')
        WHERE p.post_type IN ({$post_types})
        AND p.post_status = 'publish'
        ORDER BY p.post_date DESC
        LIMIT %d
    ", $limit);

    return $wpdb->get_results($sql);
}

/**
 * Smart video query - tries multiple methods with hook interference detection
 */
function payge_theme_smart_video_query($args = array()) {
    $defaults = array(
        'posts_per_page' => 12,
        'post_status' => 'publish'
    );

    $args = wp_parse_args($args, $defaults);

    // Method 1: Try Vimeotheque function if available
    if (function_exists('cvm_get_videos')) {
        $videos = cvm_get_videos($args);
        if (!empty($videos)) {
            return $videos;
        }
    }

    // Method 2: Direct get_posts (bypasses some WP_Query filters)
    $direct_posts = get_posts(array(
        'post_type' => 'vimeo-video',
        'numberposts' => $args['posts_per_page'],
        'post_status' => array('publish', 'private'),
        'suppress_filters' => true // Key: bypass filters that might interfere
    ));

    if (!empty($direct_posts)) {
        if (current_user_can('manage_options')) {
            error_log('Vimeotheque Debug: get_posts() found ' . count($direct_posts) . ' videos');
        }
        return $direct_posts;
    }

    // Method 3: WP_Query with filter suppression
    $wp_query_args = array(
        'post_type' => 'vimeo-video',
        'posts_per_page' => $args['posts_per_page'],
        'post_status' => array('publish', 'private'),
        'suppress_filters' => true,
        'no_found_rows' => false
    );

    $query = new WP_Query($wp_query_args);
    if ($query->have_posts()) {
        $posts = $query->posts;
        wp_reset_postdata();
        return $posts;
    }

    // Method 4: Try our improved library function
    $videos = payge_theme_get_video_library($args);
    if (!empty($videos)) {
        return $videos;
    }

    // Method 5: Try direct database query
    $videos = payge_theme_get_videos_direct($args['posts_per_page']);
    if (!empty($videos)) {
        // Convert to WP_Post objects
        $post_objects = array();
        foreach ($videos as $video) {
            $post_objects[] = get_post($video->ID);
        }
        return $post_objects;
    }

    // Method 6: Last resort - any posts with video-related meta
    $fallback_args = array(
        'post_type' => 'any',
        'posts_per_page' => $args['posts_per_page'],
        'post_status' => $args['post_status'],
        'suppress_filters' => true,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_vimeo_video_id',
                'compare' => 'EXISTS'
            ),
            array(
                'key' => 'vimeo_video_id',
                'compare' => 'EXISTS'
            )
        )
    );

    return get_posts($fallback_args);
}

/**
 * Get video embed for display
 *
 * This function will be used to get the proper video embed
 * with custom styling and no Vimeo branding.
 */
function payge_theme_get_video_embed($video_id, $options = array()) {
    if (!payge_theme_is_vimeotheque_active()) {
        return '';
    }

    // Default embed options to remove Vimeo branding
    $defaults = array(
        'byline' => 0,
        'portrait' => 0,
        'title' => 0,
        'color' => '878175', // Match theme color
        'autopause' => 1,
        'autoplay' => 0,
        'loop' => 0,
        'muted' => 0
    );

    $options = wp_parse_args($options, $defaults);

    // Placeholder for Vimeotheque integration
    // When implemented, this would return the properly formatted embed
    // with custom branding removed

    return '';
}

/**
 * Filter video categories for display
 */
function payge_theme_get_video_categories() {
    if (!payge_theme_is_vimeotheque_active()) {
        return array();
    }

    // Placeholder for getting video categories/tags
    // This would be used for the filter buttons

    return array(
        'beginner' => 'Beginner',
        'intermediate' => 'Intermediate',
        'advanced' => 'Advanced'
    );
}

/**
 * Custom video card template
 *
 * This function renders a video card with the theme's styling
 */
function payge_theme_render_video_card($video_post) {
    if (!$video_post) {
        return;
    }

    // Extract video data
    $video_id = $video_post->ID;
    $title = get_the_title($video_id);
    $description = get_the_excerpt($video_id);
    $thumbnail = get_the_post_thumbnail_url($video_id, 'medium');
    $video_url = get_post_meta($video_id, '_vimeo_video_url', true);
    $duration = get_post_meta($video_id, '_vimeo_duration', true);
    $level = get_post_meta($video_id, '_video_level', true) ?: 'beginner';

    ?>
    <div class="video-card" data-level="<?php echo esc_attr($level); ?>" data-video-url="<?php echo esc_url($video_url); ?>">
        <div class="video-thumbnail">
            <?php if ($thumbnail): ?>
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
            <?php else: ?>
                <div class="video-placeholder-thumb">
                    <div class="play-overlay">
                        <div class="play-button">▶</div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($duration): ?>
                <div class="video-duration"><?php echo esc_html($duration); ?></div>
            <?php endif; ?>
        </div>

        <div class="video-info">
            <h3 class="video-title"><?php echo esc_html($title); ?></h3>
            <p class="video-description"><?php echo esc_html($description); ?></p>
            <div class="video-meta">
                <span class="video-level"><?php echo esc_html(ucfirst($level)); ?></span>
                <span class="video-date"><?php echo get_the_date('M j, Y', $video_id); ?></span>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Integration hooks for when Vimeotheque is activated
 */
add_action('init', function() {
    if (payge_theme_is_vimeotheque_active()) {
        // Add any initialization code for Vimeotheque integration
        // This is where you'd hook into Vimeotheque actions/filters

        // Example: Custom video post meta fields
        // add_action('add_meta_boxes', 'payge_theme_add_video_meta_boxes');

        // Example: Filter video embed parameters
        // add_filter('vimeotheque_embed_params', 'payge_theme_custom_embed_params');
    }
});

/**
 * Documentation for Vimeotheque integration steps:
 *
 * 1. Install and activate Vimeotheque PRO
 * 2. Connect your Vimeo account (Pro/Business/Premium required for custom branding)
 * 3. Import your video library using Vimeotheque's import tools
 * 4. Configure video privacy settings in Vimeo dashboard
 * 5. Set up membership integration (if using membership plugin)
 * 6. Replace placeholder functions in this file with actual Vimeotheque queries
 * 7. Update page-library.php to use these functions instead of placeholder content
 * 8. Test video playback with custom branding removed
 *
 * Key Vimeotheque features to leverage:
 * - Automatic video importing from Vimeo channels/showcases
 * - Custom video post types with metadata
 * - Built-in membership plugin compatibility
 * - Custom embed parameters for branding removal
 * - Video categorization and tagging
 * - Playlist creation and management
 */