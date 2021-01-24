<?php
/* banner-php */
get_header(); 


$tax_header_image = '';
$tax_show_header = 'yes';
$t_id = get_queried_object()->term_id;
$term_meta = get_option( "balkon_taxonomy_portfolio_cat_$t_id" );
if($term_meta !== false){
    if( isset($term_meta['cat_header_image']['url']) ){
        $tax_header_image = $term_meta['cat_header_image']['url'];
    }
    if( isset($term_meta['tax_show_header']) ){
        $tax_show_header = $term_meta['tax_show_header'];
    }
}


    
?>
<div class="content">
<?php if($tax_show_header !== 'no') :?>
    <section class="parallax-section header-section" data-scrollax-parent="true">
        <div class="bg"  data-bg="<?php echo esc_url($tax_header_image );?>" data-scrollax="properties: { translateY: '200px' }"></div>
        <div class="overlay"></div>
        <div class="container big-container">
            <div class="section-title">
            <?php 
            $cat_sub_title = esc_html__('Category','balkon' );
            if( $cat_sub_title != '' ) : ?>
                <h3 class="head-sec-subtitle"><?php echo wp_kses_post( $cat_sub_title );?></h3>
                <div class="separator trsp-separator"></div>
            <?php endif;?>
                <h1 class="head-sec-title"><?php single_term_title( ) ;?></h1>
                <?php echo term_description( );?>
                <a href="#sec1" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span><?php esc_html_e('scroll down','balkon' );?></span></a>
            </div>
        </div>
    </section>
<?php endif;?>
<?php

switch ( balkon_global_var('folio_layout') ) {
    case 'masonry':
    case 'masonry_sidebar':
        get_template_part('taxonomy-portfolio-masonry' );
        break;    
    default:
        get_template_part('taxonomy-portfolio-parallax' );
        break;
}
get_footer(); 
