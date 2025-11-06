<?php
/**
 * Template Name: Vimeo Debug
 * Simple debugging page for Vimeotheque integration
 *
 * @package Payge_Theme
 */

get_header(); ?>

<main class="debug-page">
    <div class="container">
        <h1>Vimeotheque Debug Information</h1>

        <?php if (current_user_can('manage_options')) : ?>

            <div class="debug-section">
                <h2>1. Plugin Status</h2>
                <?php
                $debug_info = payge_theme_debug_vimeotheque();
                if ($debug_info) {
                    echo '<pre>' . print_r($debug_info, true) . '</pre>';
                } else {
                    echo '<p>Debug function not available.</p>';
                }
                ?>
            </div>

            <div class="debug-section">
                <h2>2. Post Type Check</h2>
                <?php
                $post_type = payge_theme_get_vimeo_post_type();
                if ($post_type) {
                    echo '<p>✅ Found Vimeo post type: <strong>' . $post_type . '</strong></p>';
                } else {
                    echo '<p>❌ No Vimeo post type found</p>';
                }
                ?>
            </div>

            <div class="debug-section">
                <h2>3. Video Query Test</h2>
                <?php
                $videos = payge_theme_smart_video_query(array('posts_per_page' => 5));
                if ($videos) {
                    echo '<p>✅ Found ' . count($videos) . ' videos</p>';
                    echo '<ul>';
                    foreach ($videos as $video) {
                        echo '<li>ID: ' . $video->ID . ' - Title: ' . $video->post_title . ' - Type: ' . $video->post_type . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>❌ No videos found</p>';
                }
                ?>
            </div>

            <div class="debug-section">
                <h2>4. Specific Post Check (ID: 198)</h2>
                <?php
                $post_198 = get_post(198);
                if ($post_198) {
                    echo '<p>✅ Post 198 found</p>';
                    echo '<ul>';
                    echo '<li>Title: ' . $post_198->post_title . '</li>';
                    echo '<li>Post Type: ' . $post_198->post_type . '</li>';
                    echo '<li>Status: ' . $post_198->post_status . '</li>';
                    echo '<li>Permalink: <a href="' . get_permalink(198) . '">' . get_permalink(198) . '</a></li>';
                    echo '</ul>';

                    // Check meta data
                    $meta = get_post_meta(198);
                    if (!empty($meta)) {
                        echo '<h3>Post Meta:</h3>';
                        echo '<pre>' . print_r($meta, true) . '</pre>';
                    }
                } else {
                    echo '<p>❌ Post 198 not found</p>';
                }
                ?>
            </div>

        <?php else : ?>
            <p>You must be an administrator to view debug information.</p>
        <?php endif; ?>

    </div>
</main>

<style>
.debug-section {
    margin: 20px 0;
    padding: 20px;
    border: 1px solid #ddd;
    background: #f9f9f9;
}

.debug-section h2 {
    margin-top: 0;
}

pre {
    background: #fff;
    padding: 10px;
    border: 1px solid #ccc;
    overflow-x: auto;
}
</style>

<?php get_footer(); ?>