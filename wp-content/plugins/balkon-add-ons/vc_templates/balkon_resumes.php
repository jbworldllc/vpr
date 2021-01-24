<?php
/* add_ons_php */
$el_class = $css = $count = $order_by = $order = $ids = $thumbnail_cols = $show_pagination = $content_type = $date_cols = $show_readmore = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'resumes-list-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

$resume_item_cl = array(
    'resume-item',
    $thumbnail_cols,
);
$resume_item_cl = implode( ' ', array_filter( $resume_item_cl ) );
if(is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}


if(!empty($ids)){
	$ids = explode(",", $ids);
	$args = array(
	    'post_type'		 => 'cth_resume',
        'paged' => $paged,
        'posts_per_page'=> $count,
	    'post__in' => $ids,
	    'orderby'=> $order_by,
	    'order'=> $order,
        'post_status'       => 'publish',
	);
}else{
	$args = array(
	    'post_type'		 => 'cth_resume',
        'paged' => $paged,
        'posts_per_page'=> $count,
	    'orderby'=> $order_by,
	    'order'=> $order,
        'post_status'       => 'publish',
	);
}
$resumes = new WP_Query($args);


?>
<?php if($resumes->have_posts()) {  ?>


<div class="<?php echo esc_attr($css_class ); ?>">

    <div class="row resumes-list-holder resumes-list-<?php echo esc_attr( $thumbnail_cols );?>">
    <?php    
    while($resumes->have_posts()) : $resumes->the_post();
    ?>
        <div class="<?php echo esc_attr($resume_item_cl );?>">

            <div class="row">
                <?php 
                if($date_cols != '' ) : ?>
                <?php if($date_cols < 12) : ?>
                <div class="col-md-<?php echo esc_attr( $date_cols );?>">
                <?php else : ?>
                <div class="col-md-12 resume-date-top">
                <?php endif;?>
                    <div class="cus-inner-title fl-wrap">
                        <h3><?php echo get_post_meta( get_the_ID(),'_balkon_resume_date', true );?></h3>
                    </div>
                </div>
                <?php endif;?>
                <?php 
                if($date_cols != ''  && $date_cols < 12) : ?>
                <div class="col-md-<?php echo (12 - $date_cols);?>">
                <?php else : ?>
                <div class="col-md-12">
                <?php endif ; ?>
                    <h4 class="resume-title">
                    <?php if( $show_readmore == 'yes' ):?>
                    <a href="<?php the_permalink();?>" class="resume-link">
                    <?php endif;?>
                    <?php the_title();?>
                    <?php if( $show_readmore == 'yes' ):?>
                    </a>
                    <?php endif;?>
                    </h4>
                    <?php 
                    if($content_type == 'content'){
                        echo '<div class="resume-content">';
                        the_content( );
                        echo '</div>';
                    }elseif($content_type == 'excerpt'){
                        echo '<div class="resume-excerpt">';
                        the_excerpt();
                        echo '</div>';
                    }

                    ?>
                    <span class="custom-inner-dec"></span>
                </div>
            </div>

        </div>
    <?php 
    endwhile; ?>
        
    </div>
    
</div>

<?php if($show_pagination =='yes') balkon_custom_pagination($resumes->max_num_pages,$range = 2,$resumes,false);?>
   

<?php
}

/* Restore original Post Data */
wp_reset_postdata();

?>