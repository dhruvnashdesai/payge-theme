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
                <!-- Video on left -->
                <div class="hero-video-wrapper">
                    <?php
                    // Get the featured video with custom unbranded embed
                    $featured_video = get_post(45);

                    if ($featured_video && $featured_video->post_status === 'publish') {
                        // Display unbranded Vimeo video
                        echo '<div class="hero-video-embed">';

                        // Use Vimeotheque shortcode with custom parameters to remove branding
                        echo do_shortcode('[cvm_video id="45" title="0" byline="0" portrait="0" color="878175" logo="0" pip="0"]');

                        echo '</div>';
                    } else {
                        // Fallback placeholder if video not found
                        ?>
                        <div class="hero-video-placeholder">
                            <div class="video-placeholder-content">
                                <div class="play-icon">▶</div>
                                <h3>Featured Class</h3>
                                <p>Preview video loading...</p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Title and description on right -->
                <div class="hero-video-info">
                    <h1>Video Library</h1>
                    <p>Sign up to get the full video library</p>
                    <div class="hero-signup-button">
                        <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="universal-btn">
                            <span class="universal-btn-circle">
                                <span class="universal-btn-arrow">
                                    <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.7071 8.07136C21.0976 7.68084 21.0976 7.04767 20.7071 6.65715L14.3431 0.293189C13.9526 -0.0973355 13.3195 -0.0973355 12.9289 0.293189C12.5384 0.683713 12.5384 1.31688 12.9289 1.7074L18.5858 7.36426L12.9289 13.0211C12.5384 13.4116 12.5384 14.0448 12.9289 14.4353C13.3195 14.8258 13.9526 14.8258 14.3431 14.4353L20.7071 8.07136ZM0 7.36426L8.74228e-08 8.36426L20 8.36426L20 7.36426L20 6.36426L-8.74228e-08 6.36426L0 7.36426Z" fill="black"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="universal-btn-text">Sign Up</span>
                        </a>
                    </div>
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
                            <h3>Unlock your fitness journey with POWERED</h3>
                            <p>Get unlimited access to our complete video library with classes for all levels</p>
                            <div class="paywall-buttons">
                                <?php if ($is_logged_in) : ?>
                                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="btn btn-primary">Choose Your Plan</a>
                                <?php else : ?>
                                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('levels') : '/membership-levels/'; ?>" class="btn btn-primary">Subscribe Now</a>
                                    <a href="<?php echo function_exists('pmpro_url') ? pmpro_url('login') : home_url('/membership-account/'); ?>" class="btn btn-secondary">Already a Member? Log In</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                // Improved Vimeotheque video query with debugging
                $video_args = array(
                    'post_type' => array('vimeo-video', 'cvm_video', 'video'),
                    'posts_per_page' => -1,
                    'post_status' => array('publish', 'private'), // More specific status check
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

                // Debug output (remove in production)
                if (current_user_can('manage_options')) {
                    echo '<!-- Debug: Query args: ' . print_r($video_args, true) . ' -->';
                }

                $video_query = new WP_Query($video_args);

                // Additional debug info
                if (current_user_can('manage_options')) {
                    echo '<!-- Debug: Found posts: ' . $video_query->found_posts . ' -->';
                    echo '<!-- Debug: SQL Query: ' . $video_query->request . ' -->';
                    $debug_info = payge_theme_debug_vimeotheque();
                    echo '<!-- Debug: Vimeotheque status: ' . print_r($debug_info, true) . ' -->';
                }

                if ($video_query->have_posts()) :
                    while ($video_query->have_posts()) : $video_query->the_post();
                        $post_type = get_post_type();

                        // Handle both Vimeotheque and manual videos
                        if ($post_type === 'cvm_video' || $post_type === 'vimeo-video') {
                            // Vimeotheque video
                            $video_post = cvm_get_video_post(get_the_ID());
                            $video_url = $video_post ? $video_post->video_id : '';
                            $video_duration = $video_post ? $video_post->duration : '';
                        } else {
                            // Manual video
                            $video_url = get_post_meta(get_the_ID(), 'vimeo_video_id', true);
                            $video_duration = get_post_meta(get_the_ID(), 'video_duration', true);
                        }

                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                        <div class="video-card" data-video-id="<?php echo esc_attr($video_url); ?>" data-post-id="<?php echo get_the_ID(); ?>">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="video-card-link">
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
                            </a>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Try alternative query method if main query fails
                    if (current_user_can('manage_options')) {
                        echo '<!-- Debug: Main query failed, trying smart video query -->';
                    }
                    $smart_videos = payge_theme_smart_video_query(array('posts_per_page' => -1));

                    if (!empty($smart_videos)) :
                        // Convert to query-like structure for the loop
                        global $post;
                        $original_post = $post;

                        if (current_user_can('manage_options')) {
                            echo '<!-- Debug: Smart query found ' . count($smart_videos) . ' videos -->';
                        }

                        foreach ($smart_videos as $smart_video) :
                            $post = $smart_video;
                            setup_postdata($post);
                            $post_type = get_post_type();

                            // Handle both Vimeotheque and manual videos
                            if ($post_type === 'cvm_video' || $post_type === 'vimeo-video') {
                                // Vimeotheque video
                                if (function_exists('cvm_get_video_post')) {
                                    $video_post = cvm_get_video_post(get_the_ID());
                                    $video_url = $video_post ? $video_post->video_id : '';
                                    $video_duration = $video_post ? $video_post->duration : '';
                                } else {
                                    $video_url = get_post_meta(get_the_ID(), '_vimeo_video_id', true);
                                    $video_duration = get_post_meta(get_the_ID(), '_video_duration', true);
                                }
                            } else {
                                // Manual video
                                $video_url = get_post_meta(get_the_ID(), 'vimeo_video_id', true);
                                if (!$video_url) {
                                    $video_url = get_post_meta(get_the_ID(), '_vimeo_video_id', true);
                                }
                                $video_duration = get_post_meta(get_the_ID(), 'video_duration', true);
                                if (!$video_duration) {
                                    $video_duration = get_post_meta(get_the_ID(), '_video_duration', true);
                                }
                            }

                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                            <div class="video-card" data-video-id="<?php echo esc_attr($video_url); ?>" data-post-id="<?php echo get_the_ID(); ?>">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="video-card-link">
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
                            </a>
                <?php
                        endforeach;
                        wp_reset_postdata();
                        $post = $original_post;
                    else :
                        // Final fallback to placeholder videos if no videos found
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
                    endif; // End smart video query check
                endif; // End main query check
                ?>
            </div>

        </div>
    </section>
</main>

<!-- Video Modal (HTML only for now) -->
<div id="video-modal" class="video-modal" style="display: none;">
    <div class="video-modal-backdrop"></div>
    <div class="video-modal-content">
        <button class="video-modal-close" aria-label="Close video">&times;</button>
        <div class="video-modal-header">
            <h2 id="video-modal-title">Video Title</h2>
        </div>
        <div class="video-modal-body">
            <div id="video-modal-embed">Modal content will go here</div>
        </div>
    </div>
</div>

<style>
.video-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.video-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
}

.video-modal-content {
    position: relative;
    background: #fff;
    border-radius: 8px;
    max-width: 90vw;
    max-height: 90vh;
    width: 900px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.video-modal-close {
    position: absolute;
    top: 15px;
    right: 20px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 10;
}

.video-modal-header {
    padding: 20px 20px 10px;
    border-bottom: 1px solid #eee;
}

.video-modal-body {
    padding: 0;
    min-height: 400px;
}

#video-modal-embed {
    width: 100%;
    min-height: 500px;
}

#video-modal-embed iframe {
    width: 100%;
    height: 500px;
    border: none;
}

#video-modal-embed .vimeotheque-video {
    width: 100% !important;
    height: 500px !important;
}

#video-modal-embed .vimeotheque-video iframe {
    width: 100% !important;
    height: 500px !important;
}

/* Aggressive override for all video elements */
#video-modal-embed * {
    max-width: 100% !important;
}

#video-modal-embed iframe,
#video-modal-embed .vimeotheque-video,
#video-modal-embed .video-embed,
#video-modal-embed .wp-video,
#video-modal-embed .video-container,
#video-modal-embed div[style*="width"],
#video-modal-embed div[style*="height"] {
    width: 100% !important;
    height: 500px !important;
    min-height: 500px !important;
    max-width: 100% !important;
}

@media (max-width: 768px) {
    .video-modal-content {
        width: 95vw;
        margin: 20px;
    }

    #video-modal-embed,
    #video-modal-embed iframe,
    #video-modal-embed .vimeotheque-video,
    #video-modal-embed .vimeotheque-video iframe {
        height: 300px !important;
    }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('video-modal');
    const modalTitle = document.getElementById('video-modal-title');
    const modalEmbed = document.getElementById('video-modal-embed');
    const closeBtn = document.querySelector('.video-modal-close');
    const backdrop = document.querySelector('.video-modal-backdrop');

    // Test: Open modal when any video card is clicked
    document.addEventListener('click', function(e) {
        const videoCard = e.target.closest('.video-card-link');
        if (videoCard) {
            e.preventDefault();

            // Get video title for testing
            const card = videoCard.closest('.video-card');
            const title = card.querySelector('.video-title').textContent;

            // Show modal immediately
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            // Set title
            modalTitle.textContent = title;

            // Show loading state with proper sizing
            modalEmbed.style.width = '100%';
            modalEmbed.style.height = '500px';
            modalEmbed.innerHTML = '<div id="video-loading" style="width: 100%; height: 500px; display: flex; align-items: center; justify-content: center; background: #000; border-radius: 8px; position: relative;"><div style="width: 40px; height: 40px; border: 4px solid rgba(255,255,255,0.3); border-top: 4px solid #fff; border-radius: 50%; animation: spin 1s linear infinite;"></div></div>';

            // Load video via AJAX
            const postId = card.dataset.postId;
            loadVideoEmbed(postId);
        }
    });

    // Close modal functions
    function closeModal() {
        modal.style.display = 'none';
        modalEmbed.innerHTML = '';
        document.body.style.overflow = '';
    }

    closeBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display !== 'none') {
            closeModal();
        }
    });

    // Function to load video embed via AJAX
    function loadVideoEmbed(postId) {
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'action': 'payge_video_embed',
                'post_id': postId,
                'nonce': '<?php echo wp_create_nonce('video_embed_nonce'); ?>'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalEmbed.innerHTML = data.data;

                // Aggressive video sizing - multiple attempts
                const forceVideoSize = () => {
                    const allElements = modalEmbed.querySelectorAll('*');

                    allElements.forEach(element => {
                        // Force size on iframes
                        if (element.tagName === 'IFRAME') {
                            element.style.width = '100% !important';
                            element.style.height = '500px !important';
                            element.style.minHeight = '500px !important';
                            element.style.maxWidth = '100% !important';
                            element.setAttribute('width', '100%');
                            element.setAttribute('height', '500');
                        }

                        // Force size on container elements
                        if (element.classList.contains('vimeotheque-video') ||
                            element.classList.contains('video-embed') ||
                            element.tagName === 'DIV') {
                            element.style.width = '100% !important';
                            element.style.height = '500px !important';
                            element.style.minHeight = '500px !important';
                            element.style.maxWidth = '100% !important';
                        }
                    });
                };

                // Force sizing immediately and after delays
                forceVideoSize();
                setTimeout(forceVideoSize, 100);
                setTimeout(forceVideoSize, 500);
                setTimeout(forceVideoSize, 1000);

                console.log('Video loaded and sized');
            } else {
                modalEmbed.innerHTML = '<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading video: ' + data.data + '</div>';
            }
        })
        .catch(error => {
            console.error('Error loading video:', error);
            modalEmbed.innerHTML = '<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading video. Please try again.</div>';
        });
    }
});
</script>

<?php get_footer(); ?>