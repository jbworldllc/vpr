<?php
/* add_ons_php */
$el_class = $css = $bgimg = $opacity = $parallax_value = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'balkon-home-image fl-wrap full-height hero-content par-bg',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr($css_class );?>" data-scrollax-parent="true" >
    <div class="bg"  data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($bgimg, 'balkon_fuls_thumb') );?>" data-scrollax="properties: { <?php echo esc_attr( $parallax_value );?> }" ></div>    
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

