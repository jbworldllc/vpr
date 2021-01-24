<?php
/* banner-php */
if(!isset($show_view_project)){
    $show_view_project = balkon_global_var('folio_show_readmore');
}elseif($show_view_project == 'yes'){
    $show_view_project = true;
}else{
    $show_view_project = false;
}

if(!isset($show_cat)){
    $show_cat = balkon_global_var('folio_show_cat_grid');
}elseif($show_cat == 'yes'){
    $show_cat = true;
}else{
    $show_cat = false;
}
if(!isset($show_excerpt)){
    $show_excerpt = balkon_global_var('folio_show_excerpt');
}elseif($show_excerpt == 'yes'){
    $show_excerpt = true;
}else{
    $show_excerpt = false;
}

$folio_video_link = get_post_meta(get_the_ID(), '_balkon_folio_video', true);
$masonry_size = get_post_meta(get_the_ID(), '_balkon_masonry_size', true);
$masonry_thumb_size = 'balkon_masonry_'.$masonry_size;
?>
<div <?php post_class('gallery-item foli-man-style1 gallery-item-'.$masonry_size);?>>
    <div class="grid-item-holder">
        <?php if($folio_video_link!=""){ ?> 
            <div class="resp-video-holder">
                <div class="resp-video">
                   <?php echo wp_oembed_get( $folio_video_link ); ?>
                </div>
            </div>
        <?php }else { ?>
            <div class="box-item">
                <?php the_post_thumbnail($masonry_thumb_size);?>
                <div class="overlay"></div>
                <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( ) );?>" class="image-popup-gal popup-image"><i class="fa fa-search"></i></a>
            </div>
            <div class="grid-item">
                <h3><?php if($show_view_project): ?>
                <a href="<?php the_permalink();?>">
                <?php endif;?>
                <?php the_title();?>
                <?php if($show_view_project): ?>
                </a>
                <?php endif;?></h3>
                <?php 
                $terms = get_the_terms(get_the_ID(), 'portfolio_cat');
                if ( $terms && ! is_wp_error( $terms ) && $show_cat ){
                echo '<span>';
                    foreach( $terms as $key => $term){
                        if($key > 0){
                            echo ' / ';
                        }
                        echo sprintf( '<a href="%1$s">%2$s</a>',
                            esc_url( get_term_link( $term->slug, 'portfolio_cat' ) ),
                            esc_html( $term->name )
                        );
                    }
                echo '</span>';
                }
                ?>
                <?php if($show_excerpt){
                    echo '<div class="folio-excerpt">';
                    the_excerpt();
                    echo '</div>';
                }?>
                
            </div>
        <?php 
        } ?>
    </div>
</div>