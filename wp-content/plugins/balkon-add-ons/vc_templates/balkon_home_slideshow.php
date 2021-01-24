<?php
/* add_ons_php */
$css = $el_class = $slideimgs = $opacity = $mousewheel = $keyboard = $autoplay = $loop = $direction = $speed = $effect = $parallax_value  = $show_progress = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts ); 

$css_classes = array(
    'balkon-home-slideshow',
    'fs-gallery-wrap home-slider fl-wrap full-height',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
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
    if(!empty($slideimgs)){
        $slideshows = explode(",", $slideimgs);
        if(!empty($slideshows)) : 
        ?>
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
        <div class="swiper-container" data-scrollax-parent="true" >
            <div class="swiper-wrapper"  >
            <?php foreach ($slideshows as $key => $img) {?>
                <div class="swiper-slide">
                    <div class="bg"  data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($img, 'balkon_fuls_thumb') );?>" data-scrollax="properties: { <?php echo esc_attr($parallax_value);?> }" ></div>
                </div>
            <?php
            } ?>    
            </div>
        </div>
        <?php
        endif;
    }
    ?>
    <?php if($opacity != '') : ?>
    <div class="overlay" style="opacity: <?php echo esc_attr($opacity );?>"></div>  
    <?php endif;?>       
    <div class="hero-wrap alt">
        <div class="container">
            <div class="hero-item">
                <?php echo wpb_js_remove_wpautop($content,true);?>
            </div>
        </div>
    </div>             
</div>