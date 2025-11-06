<?php
/**
 * Single Video Template for Vimeotheque Videos (Regular Posts)
 * This template is used when a post is in the "members" category
 *
 * @package Payge_Theme
 */

get_header();

// Since videos are now regular posts, PMPro's built-in restrictions should work automatically
// Check if this post is in the members category and has video content
$post_categories = wp_get_post_categories(get_the_ID());
$members_cat = get_category_by_slug('members');
$is_member_video = false;

if ($members_cat) {
    $is_member_video = in_array($members_cat->term_id, $post_categories);
}

// Check for video content
$video_id = get_post_meta(get_the_ID(), '_vimeo_video_id', true);
if (!$video_id) {
    $video_id = get_post_meta(get_the_ID(), 'vimeo_video_id', true);
}
?>

<main class="single-video-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article class="video-content">
                <header class="video-header">
                    <h1 class="video-title"><?php the_title(); ?></h1>
                </header>

                <?php if ($video_id) : ?>
                    <div class="video-embed">
                        <?php
                        // Use Vimeotheque shortcode with unbranded parameters
                        echo do_shortcode('[cvm_video id="' . get_the_ID() . '" width="100%" height="506" title="0" byline="0" portrait="0" color="878175" logo="0" pip="0"]');
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (get_the_content()) : ?>
                    <div class="video-description">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>

                <?php if ($is_member_video) : ?>
                    <div class="video-meta">
                        <p><em>This is a members-only video. Access is controlled by your membership level.</em></p>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>