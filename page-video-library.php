<?php get_header(); ?>

<main class="video-library-page">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Video Library</h1>
            <p>Access your complete collection of Pilates classes. Stream anytime, anywhere.</p>
        </div>
    </section>

    <!-- Video Library Section -->
    <section class="video-library">
        <div class="container">
            <div class="video-grid">
                <?php
                // Query for video posts
                $video_args = array(
                    'post_type' => 'video',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                );

                $video_query = new WP_Query($video_args);

                if ($video_query->have_posts()) :
                    while ($video_query->have_posts()) : $video_query->the_post();
                        $video_url = get_post_meta(get_the_ID(), '_video_url', true);
                        $video_duration = get_post_meta(get_the_ID(), '_video_duration', true);
                        $video_level = get_post_meta(get_the_ID(), '_video_level', true);
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if (!$thumbnail_url) {
                            $thumbnail_url = 'https://via.placeholder.com/400x225/e8e6e1/666666?text=' . urlencode(get_the_title());
                        }
                ?>
                        <div class="video-card" data-video-url="<?php echo esc_url($video_url); ?>">
                            <div class="video-thumbnail" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                                <div class="video-overlay">
                                    <div class="play-button"></div>
                                </div>
                                <?php if ($video_duration) : ?>
                                    <div class="video-duration"><?php echo esc_html($video_duration); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="video-info">
                                <h3 class="video-title"><?php the_title(); ?></h3>
                                <p class="video-description"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                <div class="video-meta">
                                    <?php if ($video_level) : ?>
                                        <span class="video-level <?php echo esc_attr($video_level); ?>">
                                            <?php echo esc_html(ucfirst($video_level)); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($video_duration) : ?>
                                        <span><?php echo esc_html(str_replace(':', ' min ', $video_duration)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <!-- Empty State -->
                    <div class="empty-state">
                        <h3><?php esc_html_e('No Videos Found', 'payge-theme'); ?></h3>
                        <p><?php esc_html_e('Check back soon for new Pilates videos!', 'payge-theme'); ?></p>
                        <?php if (current_user_can('edit_posts')) : ?>
                            <p><a href="<?php echo esc_url(admin_url('post-new.php?post_type=video')); ?>" class="btn">
                                <?php esc_html_e('Add Your First Video', 'payge-theme'); ?>
                            </a></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>