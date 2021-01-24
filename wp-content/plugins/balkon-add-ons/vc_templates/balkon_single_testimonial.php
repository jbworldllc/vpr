<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $extra_class
 * @var $count
 * @var $order_by
 * @var $order
 * @var $ids
 * @var $show_avatar
 * @var $show_navigation
 * @var $autoplay
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Single_Testimonial
 */
$extra_class = $id = $show_avatar = $css = $show_title = $show_rating = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'single-testim-holder fl-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );


if(!empty($id)){
	$args = array(
	    'post_type'		 => 'cth_testimonial',
	    'p' => intval($id),
        'post_status'       => 'publish',
	    
	);
}else{
	$args = array(
	    'post_type'		 => 'cth_testimonial',
	    'posts_per_page' => 1,
        'post_status'       => 'publish',
	    
	);
}
$testimonial = new WP_Query($args);

?>
<?php if($testimonial->have_posts()) {       ?>
<div class="<?php echo esc_attr($css_class ); ?>">

        <?php        
        while($testimonial->have_posts()) : $testimonial->the_post();  
        ?>
            <div class="testi-item fl-wrap">
                <?php if($show_avatar == 'yes') : ?>
                    <?php the_post_thumbnail('balkontest-thumb' , array('class'=>'testi-slider-thumb') ); ?>
                <?php endif;?>
                <?php if($show_title === 'yes') :?>
                    <h3><?php the_title( );?></h3>
                <?php endif;?>
                <?php 
                if($show_rating === 'yes') :
                    $rated = get_post_meta(get_the_id(), '_balkon_testim_rate', true ); 
                    if($rated != '' && $rated != 'no'){
                        $ratedval = floatval($rated);
                        echo '<ul class="testi-star-rating">';
                        for ($i=1; $i <= 5; $i++) { 
                            if($i <= $ratedval){
                                echo '<li><i class="fa fa-star"></i></li>';
                            }else{
                                if($i - 0.5 == $ratedval){
                                    echo '<li><i class="fa fa-star-half-o"></i></li>';
                                }else{
                                    echo '<li><i class="fa fa-star-o"></i></li>';
                                }
                            }
                            
                        }
                        echo '</ul>';
                    }else{
                        esc_html_e('Not Rated','balkon-add-ons' );
                    }

                endif;

                ?>
                <?php the_content( ); ?>
            </div>

        <?php 
        endwhile; ?>

</div>

<?php
}

/* Restore original Post Data */
wp_reset_postdata();

?>