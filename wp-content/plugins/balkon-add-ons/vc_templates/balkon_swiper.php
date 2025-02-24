<?php
/* add_ons_php */
$el_class = $css = $mousewheel = $keyboard = $autoplay = $loop = $direction = $speed = $effect = $slideimages = $disable_zoom = $show_progress = $show_nav = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'fs-gallery-wrap home-slider fl-wrap full-height swiper-singleimg',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
if($disable_zoom == 'yes'){
    $css_classes[] =' disa-zoom';
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

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
            <?php echo wpb_js_remove_wpautop($content);?>
        </div>
        <?php 
        if($show_nav == 'yes') : ?>
        <div class="sw-button swiper-button-next"><i class="fa fa-angle-right"></i></div>
        <div class="sw-button swiper-button-prev"><i class="fa fa-angle-left"></i></div>
        <?php endif;?>
        <div class="swiper-pagination"></div>
    </div>
</div>
