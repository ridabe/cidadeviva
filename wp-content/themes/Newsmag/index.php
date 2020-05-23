<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

if (!defined('ABSPATH')) {
    die('No direct access allowed');
}

get_header();
?>

    <div class="td-container td-blog-index">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <div class="td-page-header td-pb-padding-side">
                            <?php echo tagdiv_page_generator::get_breadcrumbs(array('template'=>'home')) ?>
                        </div>
                        <?php
                        get_template_part('loop' );
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
