<?php
/* add_ons_php */
$el_class = $css = $ser_title = $ser_price = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'serv-item',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div class="<?php echo esc_attr($css_class );?>">
	<div class="content-wrap">
		<?php if(!empty($ser_title)):?>
        <h3 class="bold-title"><?php echo esc_html($ser_title);?></h3>
        <?php endif;?>
        <?php echo wpb_js_remove_wpautop($content,true);?>
        <?php if(!empty($ser_price)):?>
        <div class="serv-price-wrap">
            <?php echo preg_replace('/-span-(.*)-span-/', "<span>$1</span>", esc_html($ser_price) ); ?>
        </div>
        <?php endif;?>
        <div class="clearfix"></div>
        <span class="bold-separator"></span>
    </div>
</div>