<?php
/* banner-php */

$hide_header = 'no';
$menu_position = balkon_global_var('menu_position');
if(is_singular( )){
    $hide_header = get_post_meta(get_the_ID(),'_balkon_hide_navigation',true ) ;
    $menu_position = get_post_meta(get_the_ID(),'_balkon_menu_position',true ) ;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class();?>>
        <?php if( balkon_global_var("show_loader") ):?>
        <div id="balkon-loader" class="loader-holder">
            <div id="movingBallG">
                <div class="movingBallLineG"></div>
                <div id="movingBallG_1" class="movingBallG"></div>
            </div>
        </div>
        <div id="main-theme">
        <?php else :?>
        <div id="main-theme" class="is-hide-loader">
        <?php endif;?>

        <?php if($hide_header !== 'yes') :?>
            <header class="main-header balkon-header">
                <!-- logo -->
               <a class="logo-holder" href="<?php echo esc_url(home_url('/'));?>">
                    <?php if( balkon_global_var('logo_first','url',true) ):?>
                    <img src="<?php echo esc_url( balkon_global_var('logo_first','url',true) );?>" 
                    <?php if( balkon_global_var('logo_size_width') != '' ):?>
                     width="<?php echo esc_attr( balkon_global_var('logo_size_width') );?>" 
                    <?php endif;?>
                    <?php if( balkon_global_var('logo_size_height') != '' ):?>
                     height="<?php echo esc_attr( balkon_global_var('logo_size_height') );?>" 
                     style="height:<?php echo esc_attr( balkon_global_var('logo_size_height') );?>px;"
                    <?php endif;?>
                     class="balkon-logo" alt="<?php bloginfo('name');?>" />
                    <?php endif;?>
                    <?php if( balkon_global_var('logo_text') != '' ):?>
                        <h1 class="logo_text"><?php echo esc_html( balkon_global_var('logo_text') );?></h1>
                    <?php endif;?>
                    <?php if( balkon_global_var('slogan') != '' ):?>
                        <h3 class="slogan"><em><?php echo esc_html( balkon_global_var('slogan') );?></em></h3>
                    <?php endif;?>
                </a> 
                <?php if( balkon_global_var('share_names') != '' ||is_active_sidebar('social_share_widget' )): ?> 
                <div class="show-share-wrap">
                    <div class="show-share"><span><?php esc_html_e('Share','balkon' );?></span><i class="fa fa-share-alt"></i></div>
                </div>
                <?php endif;?>      
                <?php if(balkon_global_var('show_search')) : ?>   
                <div class="show-search show-fixed-search vissearch"><i class="fa fa-search"></i></div>
                <?php endif ; ?>
                <?php 
                $term_args = array(
                    'orderby'           => balkon_global_var('folio_filter_orderby'),
                    'order'             => balkon_global_var('folio_filter_order'),
                ); 
                $term_args['taxonomy'] = 'portfolio_cat';
                $portfolio_cats = get_terms($term_args); 
                if ( ! empty( $portfolio_cats ) && ! is_wp_error( $portfolio_cats ) ){
                ?>
                <div class="menufilter">
                    <div class="gallery-filters hid-filter">
                    <?php if(balkon_global_var('folio_filter_all')): ?>
                        <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"><?php esc_html_e('All Works','balkon' );?></a>
                    <?php endif;?>
                    <?php $key = 0; foreach($portfolio_cats as $portfolio_cat) { ?>
                        <?php if(!balkon_global_var('folio_filter_all') && $key == 0 ): ?>
                            <a href="#" class="gallery-filter gallery-filter-active" data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
                        <?php else : ?>
                            <a href="#" class="gallery-filter " data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
                        <?php endif;?>
                    <?php $key++; } ?>
                    <?php if( balkon_global_var('folio_show_counter') ) : ?>
                        <div class="count-folio round-counter clearfix">
                            <div class="num-album"></div>
                            <div class="all-album"></div>
                        </div>
                    <?php endif;?>
                    </div>
                    
                    <div class="filter-button"><?php esc_html_e('Filter','balkon' );?></div>
                </div>

                <?php
                } ?>

                <?php 
                if($menu_position == 'sidebar') : ?>
                <div class="sb-menu-button-wrap">
                    <div class="sb-menu-button vis-m"><span></span><span></span><span></span></div>
                </div>
                <div class="header-info">
                    <?php echo wp_kses_post( balkon_global_var( 'menusb_header_info' ) ); ?>
                </div>
                <?php else : ?>
                <div class="nav-button-wrap">
                    <div class="nav-button vis-main-menu"><span></span><span></span><span></span></div>
                </div>
                <div class="nav-holder">
                   <?php get_template_part('templates/nav','top');?>
                </div>
                <?php endif ; ?>
            </header>
            <?php 
            if($menu_position == 'sidebar') : ?>
            <div class="sb-overlay"></div>
            <div class="sidebar-menu fl-wrap">
                <div class="hid-men-wrap">
                    <a class="sb-logo" href="<?php echo esc_url(home_url('/'));?>">
                    <?php if( balkon_global_var('menusb_logo','url',true) ):?>
                    <img src="<?php echo esc_url( balkon_global_var('menusb_logo','url',true) );?>" class="balkon-sublogo" alt="<?php bloginfo('name');?>" />
                    <?php endif;?>
                    </a>
                    <div class="clearfix"></div>
                    <?php get_template_part('templates/nav','sidebar');?>
                    <div class="fl-wrap sb-menu-footer">
                        <?php echo wp_kses_post( balkon_global_var( 'menusb_copyright' ) ); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

                   

        <?php endif;?>
            <!--=============== wrapper ===============-->  
            <div id="wrapper">
                <div class="content-holder<?php if($hide_header == 'yes') echo ' header-hidden' ;?>" id="balkon-content-wrapper">

                    <?php 
                    $dynamic_menu = get_post_meta(get_the_ID(), "_balkon_dynamic_menu", true);
                    if(!empty($dynamic_menu)&&$dynamic_menu != 'none'){

                        $defaults1= array(
                            'menu'            => '',
                            'theme_location'  => $dynamic_menu,
                            'container'       => 'nav',
                            'container_class' => 'scroll-nav scroll-init fl-wrap',
                            'container_id'    => 'scroll-nav-id',
                            'menu_class'      => 'balkon_scroll-nav',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'walker'          => new Walker_Nav_Menu(),
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                        );
                        if ( has_nav_menu( $dynamic_menu ) ) { ?>
                        <div class="sroll-nav-wrap">
                            <div class="sroll-nav-container">
                        <?php
                            wp_nav_menu( $defaults1 );
                        ?>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    ?>
                    




