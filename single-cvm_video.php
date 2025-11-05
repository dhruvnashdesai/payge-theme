<?php
/**
 * Single Video Template for Vimeotheque Videos
 *
 * @package Payge_Theme
 */

get_header(); ?>

<main class="single-video-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article class="video-content">
                <header class="video-header">
                    <h1 class="video-title"><?php the_title(); ?></h1>
                </header>

                <div class="video-embed">
                    <?php
                    // Use Vimeotheque shortcode with unbranded parameters
                    echo do_shortcode('[cvm_video id="' . get_the_ID() . '" width="100%" aspect_ratio="16x9" title="0" byline="0" portrait="0" color="878175" logo="0" pip="0"]');
                    ?>
                </div>

                <?php if (get_the_content()) : ?>
                    <div class="video-description">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>