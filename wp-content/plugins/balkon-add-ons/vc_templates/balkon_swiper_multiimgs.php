<?php
/* add_ons_php */
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $mousewheel - false
 * @var $autoplay - ''
 * @var $loop - false
 * @var $direction - horizontal
 * @var $speed - 300
 * @var $slider_style - normal/parallax_style
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Home_Swiper
 */
$el_class = $css = $mousewheel = $keyboard = $autoplay = $loop = $direction = $speed = $effect = $opacity = $slideimages = $disable_zoom = $parallax_value = $show_progress = $show_nav = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'fs-gallery-wrap home-slider fl-wrap full-height swiper-multiimgs',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
if($disable_zoom == 'yes'){
    $css_classes[] =' disa-zoom';
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

if(!empty($slideimages)){
    $images = explode(",", $slideimages);

    if(!empty($images)) : 

    	$dataArr = array();
    	$dataArr['speed'] = (int)$speed;
    	$dataArr['direction'] = $direction;
    	if(is_numeric($autoplay)) $dataArr['autoplay'] = (int)$autoplay;
    	if($loop == 'yes') $dataArr['loop'] = true;
    	if($mousewheel == 'yes') $dataArr['mousewheelControl'] = true;
    	if($keyboard == 'yes') $dataArr['keyboardControl'] = true;
    	$dataArr['effect'] = $effect;

    	


	?>
	<div class="<?php echo esc_attr($css_class );?>" data-opts='<?php echo json_encode($dataArr);?>'>
        <?php 
        if($show_progress == 'yes') : ?>
        <div class="slide-progress-container">
            <div class="slide-progress-content">
                <div class="slide-progress-warp">
                    <div class="slide-progress"></div>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="swiper-container" data-scrollax-parent="true">
            <div class="swiper-wrapper"  >
                <?php foreach ($images as $key => $img) {
                	$at_img = get_post($img);
		            $at_des = $at_img->post_content;
		        ?>
		        <div class="swiper-slide">
			        <div class="bg"  data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($img, 'balkon_fuls_thumb') );?>" data-scrollax="properties: { <?php echo esc_attr( $parallax_value );?> }" ></div>
	                <a href="<?php echo wp_get_attachment_url( $img );?>" class="gallery-popup image-popup"><i class="fa fa-search"></i></a>
	                <?php if($at_des != '') : ?>
	                <?php if($opacity != '') : ?>
	                <div class="overlay" style="opacity: <?php echo esc_attr($opacity );?>"></div>  
	                <?php endif;?>      
	                <div class="hero-wrap alt">
	                    <div class="container">
	                        <div class="hero-item">
	                        	<?php echo wp_kses_post( $at_des );?>
	                        </div>
	                    </div>
	                </div>
	                <?php endif;?>
			    </div>
		        <?php
		        } ?>
                
            </div>
            <?php 
            if($show_nav == 'yes') : ?>
            <div class="sw-button swiper-button-next"><i class="fa fa-angle-right"></i></div>
            <div class="sw-button swiper-button-prev"><i class="fa fa-angle-left"></i></div>
            <?php endif;?>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php
    endif;
}

?>