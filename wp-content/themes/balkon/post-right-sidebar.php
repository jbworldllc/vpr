<?php
/* banner-php */
/**
 * Template Name: Post Right Sidebar
 * Template Post Type: post
 */
if ( post_password_required() ) {
    get_template_part( 'password_protected_page' );
    return;
}
$show_page_header = get_post_meta(get_the_ID(),'_balkon_show_page_header',true );

get_header(); 

$sb_w = balkon_global_var('blog-single-sidebar-width') ? balkon_global_var('blog-single-sidebar-width') : 4;

?>
<div class="content">
	<?php if($show_page_header == 'yes') :
		$show_page_title = get_post_meta(get_the_ID(),'_balkon_show_page_title',true );
		$page_header_sub = get_post_meta(get_the_ID(),'_balkon_page_header_sub',true );
	?>
    <section class="parallax-section header-section" data-scrollax-parent="true">
        <div class="bg"  data-bg="<?php echo esc_url( get_post_meta( get_the_ID(), '_balkon_page_header_bg', true ) );?>" data-scrollax="properties: { translateY: '200px' }"></div>
        <div class="overlay"></div>
        <div class="container big-container">
            <div class="section-title">
            <?php 
            if( $page_header_sub!= '' ) : ?>
                <h3 class="head-sec-subtitle"><?php echo esc_html( $page_header_sub );?></h3>
                <div class="separator trsp-separator"></div>
            <?php endif;?>
            <?php if($show_page_title) : ?>
            	<h1 class="head-sec-title"><?php single_post_title( ); ?></h1>
            <?php endif ; ?>
                <?php 
                    echo wp_kses_post( get_post_meta(get_the_ID(),'_balkon_page_header_intro',true ) );
                ?>
                <a href="#sec1" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span><?php esc_html_e('scroll down','balkon' );?></span></a>
            </div>
        </div>
    </section>

    <?php endif;?>

	<section id="sec1">
        <div class="container">
            <div class="row">
                
                <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-posts hassidebar">

                    <div class="post-container fl-wrap">
                        <?php while(have_posts()) : the_post(); ?>

							<?php get_template_part('content','single' ); ?>

			            <?php endwhile;?>
                    </div>
                </div>
                
                <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                    <div class="blog-sidebar fl-wrap fixed-bar right-sidebar">
                        <?php 
                            get_sidebar(); 
                        ?>                 
                    </div>
                </div>

                
            </div>
            <div class="limit-box fl-wrap"></div>
            <?php balkon_post_nav();?> 
        </div>
    </section>
</div>
<?php

get_footer( );