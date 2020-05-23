<?php
/*  ----------------------------------------------------------------------------
    the search template
 */

get_header();

?>

    <div class="td-container">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <div class="td-page-header td-pb-padding-side">
							<?php echo tagdiv_page_generator::get_breadcrumbs(array('template'=>'search')) ?>

                            <h1 class="entry-title td-page-title">
								<?php
								if (get_search_query() != '') { ?>
                                    <span class="td-search-query"><?php echo get_search_query(); ?></span> - <span> <?php  esc_html_e('search results', 'newsmag') ?></span>
								<?php } else { ?>
                                    <span><?php esc_html_e('Search', 'newsmag') ?></span>
								<?php } ?>
                            </h1>
                            <div class="search-page-search-wrap">
                                <form method="get" class="td-search-form-widget" action="<?php echo esc_url(home_url( '/' )); ?>">
                                    <div role="search">
                                        <input class="td-widget-search-input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'newsmag') ?>" />
                                    </div>
                                </form>
                                <div class="td_search_subtitle">
									<?php
									if (get_search_query() != '') {
										esc_html_e('If you\'re not happy with the results, please do another search', 'newsmag');
									} ?>
                                </div>
                            </div>
                        </div>
						<?php
						get_template_part('loop-archive' );
						tagdiv_page_generator::get_pagination();
						?>
                    </div>
                </div>
                <div class="td-pb-span4 td-main-sidebar">
                    <div class="td-ss-main-sidebar">
						<?php dynamic_sidebar( 'td-default' ); ?>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->
        </div>
    </div> <!-- /.td-container -->

<?php
get_footer();
?>