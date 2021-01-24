<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Section_Title
 */
$el_class = $css = $title_text = $subtitle_text = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'balkon_sec-title',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr($css_class );?>">
    <div class="pr-title">
        <?php if(!empty($title_text)) echo esc_html($title_text);?>
        <?php if(!empty($subtitle_text)):?>
        <span><?php echo esc_html($subtitle_text);?></span>
        <?php endif;?>
    </div>
    <?php echo wpb_js_remove_wpautop($content,true);?>
</div>
<div class="clearfix"></div>