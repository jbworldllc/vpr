<?php
/* add_ons_php */
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $show_all
 * @var $all_link
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Portfolio_Comment
 */
$css = $el_class =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'balkon-folio-details-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div class="<?php echo esc_attr($css_class );?>">
	<div class="det-info">
		<?php echo rawurldecode( base64_decode( strip_tags( $content ) ) ) ;?>
	</div>
    
</div>