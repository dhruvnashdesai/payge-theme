<?php
/**
 * Simple debug output for posts and categories
 */

// Include WordPress
require_once('../../../wp-load.php');

// 1. Check members category
echo "=== MEMBERS CATEGORY CHECK ===\n";
$members_cat = get_category_by_slug('members');
if ($members_cat) {
    echo "✅ Members category exists (ID: {$members_cat->term_id})\n";

    // Get posts in members category
    $members_posts = get_posts(array(
        'post_type' => 'post',
        'numberposts' => -1,
        'post_status' => array('publish', 'private'),
        'category_name' => 'members'
    ));

    echo "Found " . count($members_posts) . " posts in members category:\n";
    foreach ($members_posts as $post) {
        echo "- ID: {$post->ID}, Title: {$post->post_title}, Status: {$post->post_status}\n";

        // Check for video metadata
        $video_id = get_post_meta($post->ID, '_vimeo_video_id', true);
        if (!$video_id) {
            $video_id = get_post_meta($post->ID, 'vimeo_video_id', true);
        }
        if ($video_id) {
            echo "  → Has video ID: $video_id\n";
        }
    }
} else {
    echo "❌ Members category not found\n";

    // Show all categories
    echo "\nAll categories:\n";
    $all_cats = get_categories();
    foreach ($all_cats as $cat) {
        echo "- {$cat->slug} (ID: {$cat->term_id})\n";
    }
}

// 2. Check smart query function
echo "\n=== SMART QUERY FUNCTION TEST ===\n";
if (function_exists('payge_theme_smart_video_query')) {
    echo "✅ Function payge_theme_smart_video_query exists\n";
    $smart_videos = payge_theme_smart_video_query(array('posts_per_page' => 5));
    echo "Smart query found " . count($smart_videos) . " videos:\n";
    foreach ($smart_videos as $video) {
        echo "- ID: {$video->ID}, Title: {$video->post_title}\n";
    }
} else {
    echo "❌ Function payge_theme_smart_video_query not found\n";
}

// 3. Check post 45 specifically
echo "\n=== POST 45 CHECK ===\n";
$post_45 = get_post(45);
if ($post_45) {
    echo "✅ Post 45 exists: {$post_45->post_title} (Type: {$post_45->post_type})\n";
} else {
    echo "❌ Post 45 not found\n";
}

echo "\nDEBUG COMPLETE\n";
?>