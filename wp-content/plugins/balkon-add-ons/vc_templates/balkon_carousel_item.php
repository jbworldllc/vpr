<?php
/* add_ons_php */
$el_class = $css = $slideimg = $opacity  = $parallax_value = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'swiper-slide swiper-singleimg-item',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr( $css_class );?>">
    <a href="<?php echo wp_get_attachment_url( $slideimg );?>" class="gallery-popup popgal"><i class="fa fa-search"></i></a>
    <?php echo wp_get_attachment_image( $slideimg, 'balkon_hoz_thumb', '',  array('class'=> 'balkon-carousel-img') );?>
    
    <?php if($content != '') : ?>
        <div class="thumb-info">
            <?php echo wpb_js_remove_wpautop($content,true);?>
        </div>
    <?php endif;?>
</div>