<?php
/**
 * Debug script for Vimeotheque integration
 * Access at: yoursite.com/wp-content/themes/payge-theme/debug-vimeotheque.php
 */

// Include WordPress
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    die('WordPress not found');
}

// Check if user can manage options (admin)
if (!current_user_can('manage_options')) {
    die('Access denied');
}

echo "<h1>Vimeotheque Debug Report</h1>";

// 1. Check plugin status
echo "<h2>1. Plugin Status</h2>";
if (class_exists('Vimeotheque\\Core') || function_exists('cvm_get_video_post')) {
    echo "✅ Vimeotheque plugin is active<br>";
} else {
    echo "❌ Vimeotheque plugin not found<br>";
}

// 2. Check post 198 specifically
echo "<h2>2. Post 198 Details</h2>";
$post_198 = get_post(198);
if ($post_198) {
    echo "✅ Post 198 exists<br>";
    echo "Post Type: " . $post_198->post_type . "<br>";
    echo "Post Status: " . $post_198->post_status . "<br>";
    echo "Post Title: " . $post_198->post_title . "<br>";
    echo "Post Name (slug): " . $post_198->post_name . "<br>";

    // Check meta
    $meta = get_post_meta(198);
    echo "<h3>Post Meta:</h3>";
    foreach ($meta as $key => $value) {
        if (strpos($key, 'vimeo') !== false || strpos($key, 'video') !== false) {
            echo $key . ": " . print_r($value, true) . "<br>";
        }
    }
} else {
    echo "❌ Post 198 not found<br>";
}

// 3. Check what post types are registered
echo "<h2>3. Registered Post Types</h2>";
$post_types = get_post_types(array('public' => true), 'objects');
foreach ($post_types as $post_type) {
    if (strpos($post_type->name, 'video') !== false || strpos($post_type->name, 'vimeo') !== false) {
        echo "✅ " . $post_type->name . " - " . $post_type->label . "<br>";
    }
}

// 4. Direct query test
echo "<h2>4. Direct Query Tests</h2>";

// Test each post type individually
$post_types_to_test = array('vimeo-video', 'cvm_video', 'video');
foreach ($post_types_to_test as $type) {
    $query = new WP_Query(array(
        'post_type' => $type,
        'post_status' => 'any',
        'posts_per_page' => -1
    ));
    echo "Post type '$type': " . $query->found_posts . " posts found<br>";

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo "  - ID: " . get_the_ID() . ", Title: " . get_the_title() . ", Status: " . get_post_status() . "<br>";
        }
        wp_reset_postdata();
    }
}

// 5. Database check
echo "<h2>5. Database Check</h2>";
global $wpdb;
$results = $wpdb->get_results("SELECT ID, post_type, post_status, post_title FROM {$wpdb->posts} WHERE ID = 198 OR post_title LIKE '%minute%' OR post_title LIKE '%35%'");
echo "Direct database query results:<br>";
foreach ($results as $result) {
    echo "ID: {$result->ID}, Type: {$result->post_type}, Status: {$result->post_status}, Title: {$result->post_title}<br>";
}
?>