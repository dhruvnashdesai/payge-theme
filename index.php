<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Payge_Theme
 */

get_header();
?>

<!-- DEBUG: INDEX.PHP template is loading instead of front-page.php -->
<div style="background: orange; color: white; padding: 20px; text-align: center; font-size: 24px; font-weight: bold;">
    DEBUG: INDEX.PHP TEMPLATE IS LOADING - This means front-page.php is not being used
</div>

<?php ?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>
        <?php if (is_home() && !is_front_page()) : ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="container">
            <div class="posts-container">
                <?php
                // Start the Loop.
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php
                            if (is_singular()) :
                                the_title('<h1 class="entry-title">', '</h1>');
                            else :
                                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                            endif;
                            ?>
                        </header>

                        <div class="entry-content">
                            <?php
                            if (is_singular()) :
                                the_content();
                            else :
                                the_excerpt();
                            endif;

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'payge-theme'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php if (!is_singular()) : ?>
                            <footer class="entry-footer">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="btn">
                                    <?php esc_html_e('Read More', 'payge-theme'); ?>
                                </a>
                            </footer>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>

                <?php
                // Pagination
                the_posts_navigation(array(
                    'prev_text' => esc_html__('Older posts', 'payge-theme'),
                    'next_text' => esc_html__('Newer posts', 'payge-theme'),
                ));
                ?>
            </div>
        </div>

    <?php else : ?>
        <div class="container">
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Nothing here', 'payge-theme'); ?></h1>
                </header>

                <div class="page-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'payge-theme'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url(admin_url('post-new.php'))
                            );
                            ?>
                        </p>
                    <?php elseif (is_search()) : ?>
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'payge-theme'); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'payge-theme'); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    <?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();