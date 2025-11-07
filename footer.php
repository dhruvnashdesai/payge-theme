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
                    <?php echo '&copy; ' . date('Y') . ' POWERED by Payge. All rights reserved.'; ?>
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