<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $number
 * @var $icon_class
 * @var $parallax_value
 * @var $content - shortcode content
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Counter
 */
$el_class = $number = $icon_class = $parallax_value = $is_last = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'inline-fact',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );


if($is_last == 'yes'){
	$css_class .= ' is_last';
}
?>
<div class="<?php echo esc_attr($css_class ); ?>">
    <div class="milestone-counter">
    	<?php if(!empty($icon_class)) :?>
	    <i class="<?php echo esc_attr($icon_class );?>"></i>
		<?php endif;?>
        <div class="stats animaper">
            <div class="num" data-content="<?php echo esc_attr($number );?>" data-num="<?php echo esc_attr($number );?>"><?php echo esc_attr($number );?></div>
        </div>
    </div>
    <?php echo wpb_js_remove_wpautop($content);?>
</div>