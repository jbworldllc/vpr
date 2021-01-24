<?php
/* add_ons_php */

$css = $el_class =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'balkon-folio-cats-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div class="<?php echo esc_attr($css_class );?>">
    <div class="pr-tags fl-wrap">
		<span><?php echo  esc_html__( 'Tags: ', 'balkon-add-ons' ); ?></span>
		<?php if(get_the_tags( )) { ?>
		<ul>
			<?php the_tags('<li>','</li><li>','</li>');?>
		</ul>
		<?php } ?>
    </div>
</div>