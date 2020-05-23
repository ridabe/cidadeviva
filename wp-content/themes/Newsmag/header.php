<?php
do_action( 'tdc_header' );
if ( has_action( 'tdc_header' ) ) {
    return;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class('tagdiv-small-theme'); ?>>

<!-- Mobile Search -->
<div class="td-search-background"></div>
<div class="td-search-wrap-mob">
    <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
        <form method="get" class="td-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="td-search-close">
                <a href="#"><i class="td-icon-close-mobile"></i></a>
            </div>
            <div role="search" class="td-search-input">
                <span><?php esc_attr_e('Search', 'newsmag' )?></span>
                <label for="td-header-search-mob">
                    <input id="td-header-search-mob" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                </label>
            </div>
        </form>
        <div id="td-aj-search-mob"></div>
    </div>
</div>

<!-- Mobile Menu -->
<div class="td-menu-background"></div>
<div id="td-mobile-nav">
    <div class="td-mobile-container">
        <div class="td-menu-socials-wrap">
            <div class="td-mobile-close">
                <a href="#"><i class="td-icon-close-mobile"></i></a>
            </div>
        </div>
        <div class="td-mobile-content">
            <?php

            wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'menu_class'=> 'td-mobile-main-menu',
                    'fallback_cb' => 'tagdiv_wp_no_mobile_menu',
                    'link_after' => '<i class="td-icon-menu-right td-element-after"></i>'
                )
            );

            // if no menu
            function tagdiv_wp_no_mobile_menu() {
                if ( current_user_can( 'switch_themes' ) ) {
	                // this is the default menu
	                echo '<ul class="">';
	                echo '<li class="menu-item-first"><a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php?action=locations">Add menu</a></li>';
	                echo '</ul>';
                }
            }

            ?>
        </div>
    </div>
</div>

<div id="td-outer-wrap">
    <div class="td-outer-container">
        <div class="td-header-wrap td-header-container td-header-style-0">
            <div class="td-header-row td-header-header">
                <div class="td-header-sp-logo">
                    <?php
                    $td_logo_text = get_bloginfo('name');
                    $td_tagline_text = get_bloginfo('description');

                    if ( !empty( $td_logo_title ) ) {
                        $td_logo_title = ' title="' . $td_logo_title . '"';
                    }

                    // H1 on logo when there's no title with H1 in page
                    $td_use_h1_logo = false;
                    if ( is_home() ) {
                        $td_use_h1_logo = true;
                    }
                    ?>
                    <div class="td-logo-text-container">
                        <?php if($td_use_h1_logo === true) { echo '<h1 class="td-logo">'; }; ?>
                        <a class="td-logo-wrap" href="<?php echo esc_url(home_url( '/' )); ?>">
                            <span class="td-logo-text"><?php if(!$td_logo_text) { echo "NEWSMAG"; } else { echo esc_attr( $td_logo_text ); } ?></span>
                        </a>
                        <?php if($td_use_h1_logo === true) { echo '</h1>'; }; ?>
                        <span class="td-tagline-text"><?php if(!$td_tagline_text) { echo "DISCOVER THE ART OF PUBLISHING"; } else { echo esc_attr( $td_tagline_text ); } ?></span>
                    </div>
                </div>
            </div>
            <div class="td-header-menu-wrap">
                <div class="td-header-row td-header-border td-header-main-menu">
                    <div id="td-header-menu" class="tagdiv-theme-menu" role="navigation">
                        <div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a></div>
                        <?php

                        wp_nav_menu(
                            array(
                                'theme_location' => 'header-menu',
                                'fallback_cb' => 'tagdiv_wp_page_menu',
                                'menu_class'=> 'sf-menu'
                            )
                        );

                        //if no menu
                        function tagdiv_wp_page_menu() {
                            if ( current_user_can( 'switch_themes' ) ) {
	                            //this is the default menu
	                            echo '<ul class="sf-menu">';
	                            echo '<li class="menu-item-first"><a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php?action=locations">Add menu</a></li>';
	                            echo '</ul>';
                            }
                        }

                        ?>
                    </div>
                    <div class="td-search-wrapper">
                        <div id="td-top-search">
                            <!-- Search -->
                            <div class="header-search-wrap">
                                <div class="dropdown header-search">
                                    <a id="td-header-search-button" href="#" role="button"><i class="td-icon-search"></i></a>
                                    <a id="td-header-search-button-mob" href="#" role="button"><i class="td-icon-search"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-search-wrap">
                        <div class="dropdown header-search">
                            <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
                                <form role="search" method="get" class="td-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <label for="td-header-search">
                                        <input id="td-header-search" class="needsclick" type="text" value="<?php echo get_search_query(); ?>" name="s" />
                                        <input id="td-header-search-top" class="wpb_button wpb_btn-inverse btn" type="submit" value="<?php esc_attr_e('Search', 'newsmag') ?>" />
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>