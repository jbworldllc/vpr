<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $map_lat
 * @var $map_long
 * @var $map_address
 * @var $map_zoom
 * @var $map_marker
 * @var $parallax_value
 * @var $default_style
 * @var $map_height
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Gmap
 */
$css = $el_class = $map_lat = $map_long = $map_address = $map_zoom = $map_marker = $parallax_value = $default_style = $map_height = $add_address = '';
$zoom_control = $maptype_control = $scale_control = $scroll_wheel = $street_view = $draggable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(!empty($map_marker)){
	$map_marker = wp_get_attachment_url($map_marker );
}
$dataArr = array();
    $dataArr['zoom'] = (int)$map_zoom;

    $dataArr['zoomControl'] = (bool)$zoom_control;
    $dataArr['mapTypeControl'] = (bool)$maptype_control;
    $dataArr['scaleControl'] = (bool)$scale_control;
    $dataArr['scrollwheel'] = (bool)$scroll_wheel;
    $dataArr['streetViewControl'] = (bool)$street_view;
    $dataArr['draggable'] = (bool)$draggable;

$css_classes = array(
    'balkon-map-box-wrap map-box',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );


?>
<div class="<?php echo esc_attr($css_class ); ?>" 
    <?php if($map_height != '500'):?>
	  style="height:<?php echo esc_attr($map_height );?>px" 
    <?php endif;?>
    >
        <div class="map-canvas" data-lat="<?php echo esc_attr($map_lat );?>" data-long="<?php echo esc_attr($map_long );?>" data-loc="<?php echo esc_attr($map_address );?>"  data-marker="<?php echo esc_url($map_marker );?>" data-dfstyle="<?php echo esc_attr($default_style );?>" data-add="<?php echo esc_attr($add_address );?>" data-options='<?php echo json_encode($dataArr);?>' 
        <?php if($map_height != '500'):?>
		  style="height:<?php echo esc_attr($map_height );?>px" 
	    <?php endif;?>
    ></div>
</div>