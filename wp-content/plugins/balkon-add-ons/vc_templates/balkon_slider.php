<?php
/* add_ons_php */
$el_class = $css = $autoplay = $loop = $direction = $speed = $effect = $slideimages  = $show_nav = $thumbnail_size =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'single-slider folio-single-slider',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

if(!empty($slideimages)){
    $images = explode(",", $slideimages);

    if(!empty($images)) : 

        $dataArr = array();
        $dataArr['speed'] = (int)$speed;
        $dataArr['direction'] = $direction;
        if(is_numeric($autoplay)) $dataArr['autoplay'] = (int)$autoplay;
        if($loop == 'yes') $dataArr['loop'] = true;
        $dataArr['effect'] = $effect;

        if( strpos($thumbnail_size, "x") !== false){
            $thumbnail_size = explode("x", $thumbnail_size);
        }


    ?>
    <div class="<?php echo esc_attr($css_class );?>" data-opts='<?php echo json_encode($dataArr);?>'>
        
        <div class="swiper-container">
            <div class="swiper-wrapper"  >
                <?php foreach ($images as $key => $img) {
                ?>
                <div class="swiper-slide">
                    <?php
                    echo wp_get_attachment_image( $img, $thumbnail_size ); ?>
                </div>

                <?php
                } ?>
                
            </div>
            <div class="swiper-pagination"></div>
            <?php 
            if($show_nav == 'yes') : ?>
            <div class="sw-button swiper-button-next"><i class="fa fa-angle-right"></i></div>
            <div class="sw-button swiper-button-prev"><i class="fa fa-angle-left"></i></div>
            <?php endif;?>
            
        </div>
    </div>
    <?php
    endif;
}

?>