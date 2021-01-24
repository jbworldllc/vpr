<?php
/* banner-php */

get_header(); ?>

<div class="content">
<?php
if( balkon_global_var('show_folio_header') ) :?>
    <section class="parallax-section header-section" data-scrollax-parent="true">
        <div class="bg"  data-bg="<?php echo esc_url( balkon_global_var('folio_header_image','url', true ) );?>" data-scrollax="properties: { translateY: '200px' }"></div>
        <div class="overlay"></div>
        <div class="container big-container">
            <div class="section-title">
            <?php 
                if( balkon_global_var('folio_head_subtitle') ) : ?>
                <h3 class="head-sec-subtitle"><?php echo wp_kses_post( balkon_global_var('folio_head_subtitle') );?></h3>
                <div class="separator trsp-separator"></div>
            <?php endif;?>
                <h1 class="head-sec-title"><?php echo wp_kses_post( balkon_global_var('folio_head_title') );?></h1>
                <?php echo wp_kses_post( balkon_global_var('folio_head_desc') ); ?> 
                <a href="#sec1" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span><?php esc_html_e('scroll down','balkon' );?></span></a>
            </div>
        </div>
    </section>
<?php endif;?>
<?php

switch ( balkon_global_var('folio_layout') ) {
    case 'masonry':
        get_template_part('archive-portfolio-masonry' );
        break;
    case 'masonry_sidebar':
        get_template_part('archive-portfolio-masonry-sidebar' );
        break;     
    default:
        get_template_part('archive-portfolio-parallax' );
        break;
}
get_footer(); 