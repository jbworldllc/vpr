<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $title
 * @var $icon
 * @var $link
 * @var $content - shortcode content
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Button
 */
$css = $el_class = $img = $thumbnail_size = $over_color = $action = $popup_img = $video_url = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$attributes = array();

$css_classes = array(
    'balkon_image-popup box-item',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if( strpos($thumbnail_size, "x") !== false){
    $thumbnail_size = explode("x", $thumbnail_size);
}
if ($popup_img == '') $popup_img = $img;
?>
<div class="<?php echo esc_attr($css_class ); ?>">
    <?php echo wp_get_attachment_image( $img, $thumbnail_size, '', array('class'=>'respimg') );?>
    <?php if($over_color != '') : ?>
    <div class="overlay" style="background-color: <?php echo esc_attr( $over_color );?>"></div>
    <?php endif;?>
    <?php if($action == 'video') : ?>
    <a href="<?php echo esc_url( $video_url );?>" class="image-popup popup-image"><i class="fa fa-youtube-play"></i></a>
    <?php endif;?>
    <?php if($action == 'image') : ?>
    <a href="<?php echo wp_get_attachment_url( $popup_img );?>" class="image-popup popup-image"><i class="fa fa-search"></i></a>
    <?php endif;?>
</div>