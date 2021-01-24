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
 * @var $this WPBakeryShortCode_Balkon_Testimonials
 */
$el_class = $css = $count = $order_by = $order = $ids = $show_avatar = $show_navigation = $show_count = $show_title = $show_rating = '';
$mousewheel = $keyboard = $autoplay = $loop = $direction = $speed = $effect = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'testimonials-slider-holder',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );


if(!empty($ids)){
	$ids = explode(",", $ids);
	$args = array(
	    'post_type'		 => 'cth_testimonial',
	    'post__in' => $ids,
	    'orderby'=> $order_by,
	    'order'=> $order,

        'post_status'       => 'publish',
	);
}else{
	$args = array(
	    'post_type'		 => 'cth_testimonial',
	    'posts_per_page' => $count,
	    'orderby'=> $order_by,
	    'order'=> $order,

        'post_status'       => 'publish'
	);
}
$testimonials = new WP_Query($args);

    $dataArr = array();
    $dataArr['speed'] = (int)$speed;
    $dataArr['direction'] = $direction;
    if(is_numeric($autoplay)) $dataArr['autoplay'] = (int)$autoplay;
    if($loop == 'yes') $dataArr['loop'] = true;
    if($mousewheel == 'yes') $dataArr['mousewheelControl'] = true;
    if($keyboard == 'yes') $dataArr['keyboardControl'] = true;
    $dataArr['effect'] = $effect;

?>
<?php if($testimonials->have_posts()) {       ?>
<div class="<?php echo esc_attr($css_class ); ?>">
    <div class="single-slider testilider fl-wrap" data-opts='<?php echo json_encode($dataArr);?>'>
        <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php        
            while($testimonials->have_posts()) : $testimonials->the_post();  
            ?>
                <div class="swiper-slide">
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
                </div>
            <?php 
            endwhile; ?>
            </div>
            <?php if($show_count === 'yes') :?>
            <div class="swiper-pagination"></div>
            <?php endif;?>
            <?php if($show_navigation === 'yes') :?>
            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php
}

/* Restore original Post Data */
wp_reset_postdata();

?>