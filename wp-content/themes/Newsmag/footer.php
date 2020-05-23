<?php
do_action( 'tdc_footer' );
if ( has_action( 'tdc_footer' ) ) {
    return;
}
?>
        <div class="td-sub-footer-container td-container td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-sub-footer-menu">
                    <div class="td-pb-padding-side">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'=> 'td-subfooter-menu',
                            'fallback_cb' => 'tagdiv_wp_no_footer_menu',
                            'depth' => 2
                        ));

                        function tagdiv_wp_no_footer_menu() {
                            if ( current_user_can( 'switch_themes' ) ) {
	                            echo '<ul class="">';
	                            echo '<li class="menu-item-first"><a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php?action=locations">Add menu</a></li>';
	                            echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="td-pb-span4 td-sub-footer-copy">
                    <div class="td-pb-padding-side">
                        &copy; Newsmag WordPress Theme by TagDiv
                    </div>
                </div>
            </div>
        </div>

    </div><!--close td-outer-container-->
</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

</body>
</html>
