<?php
/**
 * Debug script to check post structure and members category
 */

// Include WordPress
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    die('WordPress not found');
}

echo "<h1>Posts Debug Report</h1>";

// 1. Check members category
echo "<h2>1. Members Category Check</h2>";
$members_cat = get_category_by_slug('members');
if ($members_cat) {
    echo "✅ Members category exists (ID: {$members_cat->term_id})<br>";

    // Get posts in members category
    $members_posts = get_posts(array(
        'post_type' => 'post',
        'numberposts' => 10,
        'post_status' => array('publish', 'private'),
        'category_name' => 'members'
    ));

    echo "Found " . count($members_posts) . " posts in members category:<br>";
    foreach ($members_posts as $post) {
        echo "- ID: {$post->ID}, Title: {$post->post_title}, Status: {$post->post_status}<br>";

        // Check for video metadata
        $video_id = get_post_meta($post->ID, '_vimeo_video_id', true);
        if (!$video_id) {
            $video_id = get_post_meta($post->ID, 'vimeo_video_id', true);
        }
        if ($video_id) {
            echo "  → Has video ID: $video_id<br>";
        }
    }
} else {
    echo "❌ Members category not found<br>";
}

// 2. Check all posts with video metadata
echo "<h2>2. All Posts with Video Metadata</h2>";
global $wpdb;
$video_posts = $wpdb->get_results("
    SELECT DISTINCT p.ID, p.post_title, p.post_status, p.post_type, pm.meta_key, pm.meta_value
    FROM {$wpdb->posts} p
    JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
    WHERE (pm.meta_key LIKE '%vimeo%' OR pm.meta_key LIKE '%video%')
    AND p.post_status IN ('publish', 'private')
    ORDER BY p.ID
");

if ($video_posts) {
    echo "Found " . count($video_posts) . " metadata entries for video posts:<br>";
    $current_post_id = null;
    foreach ($video_posts as $row) {
        if ($current_post_id !== $row->ID) {
            if ($current_post_id !== null) echo "<br>";
            echo "<strong>Post {$row->ID}: {$row->post_title} ({$row->post_type}, {$row->post_status})</strong><br>";
            $current_post_id = $row->ID;
        }
        echo "  → {$row->meta_key}: {$row->meta_value}<br>";
    }
} else {
    echo "❌ No posts with video metadata found<br>";
}

// 3. Test the smart query function
echo "<h2>3. Smart Query Function Test</h2>";
if (function_exists('payge_theme_smart_video_query')) {
    echo "✅ Function payge_theme_smart_video_query exists<br>";
    $smart_videos = payge_theme_smart_video_query(array('posts_per_page' => 5));
    echo "Smart query found " . count($smart_videos) . " videos:<br>";
    foreach ($smart_videos as $video) {
        echo "- ID: {$video->ID}, Title: {$video->post_title}<br>";
    }
} else {
    echo "❌ Function payge_theme_smart_video_query not found<br>";
}
?>