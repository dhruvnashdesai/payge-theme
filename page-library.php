<?php
/**
 * Template Name: Library
 * Template for the Video Library page
 *
 * @package Payge_Theme
 */

get_header();

// Check membership status
$has_membership = function_exists('pmpro_hasMembershipLevel') ? pmpro_hasMembershipLevel() : false;
$is_logged_in = is_user_logged_in();
?>

<main class="video-library-page <?php echo $has_membership ? 'has-membership' : 'no-membership'; ?>">
    <!-- Hero Video Section - Visible to All -->
    <section class="hero-video-section">
        <div class="container">
            <div class="hero-video-content">
                <div class="hero-video-wrapper">
                    <!-- Featured video placeholder - always visible -->
                    <div class="hero-video-placeholder">
                        <div class="video-placeholder-content">
                            <div class="play-icon">▶</div>
                            <h3>Featured Class</h3>
                            <p>Morning Flow - Full Body Pilates</p>
                        </div>
                    </div>
                </div>

                <div class="hero-video-info">
                    <h1>Video Library</h1>
                    <p>Access our complete collection of Pilates classes. From beginner-friendly sessions to advanced workouts, find the perfect class for your practice.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Grid Section -->
    <section class="video-grid-section <?php echo $has_membership ? 'has-membership' : 'no-membership'; ?>">
        <div class="container">
            <?php if ($has_membership) : ?>
                <h2>Your Complete Video Library</h2>
            <?php endif; ?>

            <div class="video-grid">
                <?php if (!$has_membership) : ?>
                    <div class="paywall-overlay-content">
                        <div class="paywall-cta">
                            <h3>Unlock Your Full Pilates Journey</h3>
                            <p>Get unlimited access to our complete video library with expert-led classes for all levels.</p>
                            <div class="paywall-buttons">
                                <?php if ($is_logged_in) : ?>
                                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="btn btn-primary">Choose Your Plan</a>
                                <?php else : ?>
                                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="btn btn-primary">Subscribe Now</a>
                                    <a href="<?php echo home_url('/login/'); ?>" class="btn btn-secondary">Already a Member? Log In</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                // Query Vimeotheque videos
                $video_args = array(
                    'post_type' => 'cvm_video',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                );

                $video_query = new WP_Query($video_args);

                if ($video_query->have_posts()) :
                    while ($video_query->have_posts()) : $video_query->the_post();
                        // Get Vimeotheque video data
                        $video_post = cvm_get_video_post(get_the_ID());
                        $video_url = $video_post ? $video_post->video_id : '';
                        $video_duration = $video_post ? $video_post->duration : '';
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                        <div class="video-card" data-video-id="<?php echo esc_attr($video_url); ?>">
                            <div class="video-thumbnail">
                                <?php if ($thumbnail_url) : ?>
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>" />
                                <?php else : ?>
                                    <div class="video-placeholder-thumb">
                                        <div class="placeholder-content">No Thumbnail</div>
                                    </div>
                                <?php endif; ?>

                                <div class="video-overlay">
                                    <div class="play-button">▶</div>
                                </div>

                                <?php if ($video_duration) : ?>
                                    <div class="video-duration"><?php echo esc_html($video_duration); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="video-info">
                                <h3 class="video-title"><?php the_title(); ?></h3>
                                <p class="video-description"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                <div class="video-meta">
                                    <span class="video-date"><?php echo get_the_date('M j, Y'); ?></span>
                                    <?php if ($video_duration) : ?>
                                        <span class="video-length"><?php echo esc_html($video_duration); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback to placeholder videos if no Vimeotheque videos
                    for ($i = 1; $i <= 12; $i++):
                ?>
                        <div class="video-card">
                            <div class="video-thumbnail">
                                <div class="video-placeholder-thumb">
                                    <div class="placeholder-content">Sample Video <?php echo $i; ?></div>
                                </div>
                                <div class="video-overlay">
                                    <div class="play-button">▶</div>
                                </div>
                                <div class="video-duration">25:30</div>
                            </div>

                            <div class="video-info">
                                <h3 class="video-title">Sample Class <?php echo $i; ?></h3>
                                <p class="video-description">A focused Pilates session targeting core strength and flexibility.</p>
                                <div class="video-meta">
                                    <span class="video-date">Dec <?php echo $i; ?>, 2024</span>
                                    <span class="video-level"><?php echo ucfirst(['beginner', 'intermediate', 'advanced'][($i - 1) % 3]); ?></span>
                                </div>
                            </div>
                        </div>
                <?php
                    endfor;
                endif;
                ?>
            </div>

        </div>
    </section>
</main>

<?php get_footer(); ?>