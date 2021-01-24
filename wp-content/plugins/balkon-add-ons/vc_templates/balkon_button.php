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
$css = $el_class = $title = $icon = $link = $is_popup = $is_bgcolor = $is_scrolling = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$attributes = array();

$css_classes = array(
    'balkon_btn_wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );


//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = $link['title'];
    $a_target = $link['target'];
    $a_rel = $link['rel'];
}

if ( $use_link ) {
    $attributes[] = 'href="' . trim( $a_href ) . '"';
    $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
    if ( ! empty( $a_target ) ) {
        $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
    }
    if ( ! empty( $a_rel ) ) {
        $attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
    }
}
$linkcls = 'btn float-btn flat-btn';
if($is_popup === 'yes'){
    $linkcls .= ' single-popup-image';
}else{
    $linkcls .= ' ajax';
}
if($is_bgcolor === 'yes'){
    $linkcls .= ' color-bg';
}
if($is_scrolling === 'yes'){
    $linkcls .= ' custom-scroll-link';
}

$attributes[] = 'class="'.$linkcls.'"';

$attributes = implode( ' ', $attributes );

?>

<div class="<?php echo esc_attr($css_class ); ?>">
    <?php echo '<a ' . $attributes . '>';?><span><?php echo esc_attr($title );?></span>
    <?php if(!empty($title)): ?>
    <i class="<?php echo esc_attr($icon );?>"></i>
    <?php endif;?>
    </a>
</div>