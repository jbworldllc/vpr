<?php
/* add_ons_php */
$el_class = $value = $units = $color = $width = $line_width = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'balkon_circle-progress',
    'piechart',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div class="<?php echo esc_attr($css_class ); ?>" data-unit="<?php echo esc_attr($units );?>"  data-color="<?php echo esc_attr($color );?>" data-width="<?php echo esc_attr($width );?>" data-lwidth="<?php echo esc_attr($line_width );?>">
    <span class="chart" data-percent="<?php echo esc_attr( $value );?>">
        <span class="percent"></span>
    </span>
    <div class="clearfix"></div>
    <div class="skills-description">
        <?php echo wpb_js_remove_wpautop($content,true);?>
    </div>
</div>
