<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Payge_Theme
 */

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>

            <div class="footer-info">
                <div class="site-info">
                    <a href="<?php echo esc_url(__('https://wordpress.org/', 'payge-theme')); ?>">
                        <?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf(esc_html__('Proudly powered by %s', 'payge-theme'), 'WordPress');
                        ?>
                    </a>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('Theme: %1$s by %2$s.', 'payge-theme'), 'Payge Theme', '<a href="#">Payge Studio</a>');
                    ?>
                </div>

                <?php
                // Footer navigation menu
                if (has_nav_menu('footer')) :
                    ?>
                    <nav class="footer-navigation">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer',
                                'menu_id'        => 'footer-menu',
                                'container'      => false,
                                'menu_class'     => 'footer-menu',
                                'depth'          => 1,
                                'fallback_cb'    => false,
                            )
                        );
                        ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>