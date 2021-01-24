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
$css = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'balkon-folio-comments',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

if ( comments_open() || get_comments_number() ) {
	echo '<div class="'.esc_attr($css_class ).'">';
	comments_template();
	echo '</div>';
}