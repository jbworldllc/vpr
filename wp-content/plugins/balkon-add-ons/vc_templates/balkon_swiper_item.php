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
    <div class="bg"  data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($slideimg, 'balkon_fuls_thumb') );?>" data-scrollax="properties: { <?php echo esc_attr( $parallax_value );?> }" ></div>
    <a href="<?php echo wp_get_attachment_url( $slideimg );?>" class="gallery-popup image-popup"><i class="fa fa-search"></i></a>
    <?php if($content != '') : ?>
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
    <?php endif;?>
</div>