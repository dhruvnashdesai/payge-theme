<?php
/**
 * Custom Post Types for Payge Theme
 *
 * @package Payge_Theme
 */

/**
 * Register Video custom post type
 */
function payge_theme_register_video_post_type() {
    $labels = array(
        'name'                  => _x('Videos', 'Post Type General Name', 'payge-theme'),
        'singular_name'         => _x('Video', 'Post Type Singular Name', 'payge-theme'),
        'menu_name'             => __('Videos', 'payge-theme'),
        'name_admin_bar'        => __('Video', 'payge-theme'),
        'archives'              => __('Video Archives', 'payge-theme'),
        'attributes'            => __('Video Attributes', 'payge-theme'),
        'parent_item_colon'     => __('Parent Video:', 'payge-theme'),
        'all_items'             => __('All Videos', 'payge-theme'),
        'add_new_item'          => __('Add New Video', 'payge-theme'),
        'add_new'               => __('Add New', 'payge-theme'),
        'new_item'              => __('New Video', 'payge-theme'),
        'edit_item'             => __('Edit Video', 'payge-theme'),
        'update_item'           => __('Update Video', 'payge-theme'),
        'view_item'             => __('View Video', 'payge-theme'),
        'view_items'            => __('View Videos', 'payge-theme'),
        'search_items'          => __('Search Video', 'payge-theme'),
        'not_found'             => __('Not found', 'payge-theme'),
        'not_found_in_trash'    => __('Not found in Trash', 'payge-theme'),
        'featured_image'        => __('Featured Image', 'payge-theme'),
        'set_featured_image'    => __('Set featured image', 'payge-theme'),
        'remove_featured_image' => __('Remove featured image', 'payge-theme'),
        'use_featured_image'    => __('Use as featured image', 'payge-theme'),
        'insert_into_item'      => __('Insert into video', 'payge-theme'),
        'uploaded_to_this_item' => __('Uploaded to this video', 'payge-theme'),
        'items_list'            => __('Videos list', 'payge-theme'),
        'items_list_navigation' => __('Videos list navigation', 'payge-theme'),
        'filter_items_list'     => __('Filter videos list', 'payge-theme'),
    );

    $args = array(
        'label'                 => __('Video', 'payge-theme'),
        'description'           => __('Pilates videos for the video library', 'payge-theme'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'taxonomies'            => array('video_category', 'video_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-video-alt3',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('video', $args);
}
add_action('init', 'payge_theme_register_video_post_type', 0);

/**
 * Register Video Categories taxonomy
 */
function payge_theme_register_video_category_taxonomy() {
    $labels = array(
        'name'                       => _x('Video Categories', 'Taxonomy General Name', 'payge-theme'),
        'singular_name'              => _x('Video Category', 'Taxonomy Singular Name', 'payge-theme'),
        'menu_name'                  => __('Categories', 'payge-theme'),
        'all_items'                  => __('All Categories', 'payge-theme'),
        'parent_item'                => __('Parent Category', 'payge-theme'),
        'parent_item_colon'          => __('Parent Category:', 'payge-theme'),
        'new_item_name'              => __('New Category Name', 'payge-theme'),
        'add_new_item'               => __('Add New Category', 'payge-theme'),
        'edit_item'                  => __('Edit Category', 'payge-theme'),
        'update_item'                => __('Update Category', 'payge-theme'),
        'view_item'                  => __('View Category', 'payge-theme'),
        'separate_items_with_commas' => __('Separate categories with commas', 'payge-theme'),
        'add_or_remove_items'        => __('Add or remove categories', 'payge-theme'),
        'choose_from_most_used'      => __('Choose from the most used', 'payge-theme'),
        'popular_items'              => __('Popular Categories', 'payge-theme'),
        'search_items'               => __('Search Categories', 'payge-theme'),
        'not_found'                  => __('Not Found', 'payge-theme'),
        'no_terms'                   => __('No categories', 'payge-theme'),
        'items_list'                 => __('Categories list', 'payge-theme'),
        'items_list_navigation'      => __('Categories list navigation', 'payge-theme'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('video_category', array('video'), $args);
}
add_action('init', 'payge_theme_register_video_category_taxonomy', 0);

/**
 * Register Video Tags taxonomy
 */
function payge_theme_register_video_tag_taxonomy() {
    $labels = array(
        'name'                       => _x('Video Tags', 'Taxonomy General Name', 'payge-theme'),
        'singular_name'              => _x('Video Tag', 'Taxonomy Singular Name', 'payge-theme'),
        'menu_name'                  => __('Tags', 'payge-theme'),
        'all_items'                  => __('All Tags', 'payge-theme'),
        'parent_item'                => __('Parent Tag', 'payge-theme'),
        'parent_item_colon'          => __('Parent Tag:', 'payge-theme'),
        'new_item_name'              => __('New Tag Name', 'payge-theme'),
        'add_new_item'               => __('Add New Tag', 'payge-theme'),
        'edit_item'                  => __('Edit Tag', 'payge-theme'),
        'update_item'                => __('Update Tag', 'payge-theme'),
        'view_item'                  => __('View Tag', 'payge-theme'),
        'separate_items_with_commas' => __('Separate tags with commas', 'payge-theme'),
        'add_or_remove_items'        => __('Add or remove tags', 'payge-theme'),
        'choose_from_most_used'      => __('Choose from the most used', 'payge-theme'),
        'popular_items'              => __('Popular Tags', 'payge-theme'),
        'search_items'               => __('Search Tags', 'payge-theme'),
        'not_found'                  => __('Not Found', 'payge-theme'),
        'no_terms'                   => __('No tags', 'payge-theme'),
        'items_list'                 => __('Tags list', 'payge-theme'),
        'items_list_navigation'      => __('Tags list navigation', 'payge-theme'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('video_tag', array('video'), $args);
}
add_action('init', 'payge_theme_register_video_tag_taxonomy', 0);

/**
 * Add custom meta boxes for video post type
 */
function payge_theme_add_video_meta_boxes() {
    add_meta_box(
        'video_details',
        __('Video Details', 'payge-theme'),
        'payge_theme_video_details_callback',
        'video',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'payge_theme_add_video_meta_boxes');

/**
 * Video details meta box callback
 */
function payge_theme_video_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('payge_theme_save_video_details', 'payge_theme_video_details_nonce');

    // Retrieve existing values
    $video_url = get_post_meta($post->ID, '_video_url', true);
    $video_duration = get_post_meta($post->ID, '_video_duration', true);
    $video_level = get_post_meta($post->ID, '_video_level', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="video_url">' . __('Video URL', 'payge-theme') . '</label></th>';
    echo '<td><input type="url" id="video_url" name="video_url" value="' . esc_attr($video_url) . '" size="50" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="video_duration">' . __('Duration (e.g., 25:30)', 'payge-theme') . '</label></th>';
    echo '<td><input type="text" id="video_duration" name="video_duration" value="' . esc_attr($video_duration) . '" size="10" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="video_level">' . __('Skill Level', 'payge-theme') . '</label></th>';
    echo '<td>';
    echo '<select id="video_level" name="video_level">';
    echo '<option value="beginner"' . selected($video_level, 'beginner', false) . '>' . __('Beginner', 'payge-theme') . '</option>';
    echo '<option value="intermediate"' . selected($video_level, 'intermediate', false) . '>' . __('Intermediate', 'payge-theme') . '</option>';
    echo '<option value="advanced"' . selected($video_level, 'advanced', false) . '>' . __('Advanced', 'payge-theme') . '</option>';
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Save video details meta box data
 */
function payge_theme_save_video_details($post_id) {
    // Check if nonce is valid
    if (!isset($_POST['payge_theme_video_details_nonce']) || !wp_verify_nonce($_POST['payge_theme_video_details_nonce'], 'payge_theme_save_video_details')) {
        return;
    }

    // Check if user has permissions to save data
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Check if not an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save video URL
    if (isset($_POST['video_url'])) {
        update_post_meta($post_id, '_video_url', esc_url_raw($_POST['video_url']));
    }

    // Save video duration
    if (isset($_POST['video_duration'])) {
        update_post_meta($post_id, '_video_duration', sanitize_text_field($_POST['video_duration']));
    }

    // Save video level
    if (isset($_POST['video_level'])) {
        update_post_meta($post_id, '_video_level', sanitize_text_field($_POST['video_level']));
    }
}
add_action('save_post', 'payge_theme_save_video_details');