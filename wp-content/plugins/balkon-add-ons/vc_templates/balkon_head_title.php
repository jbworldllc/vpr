<?php
/* add_ons_php */
$el_class = $css = $title_text = $subtitle_text = $show_sep = $scroll_url = $scroll_icon = $scroll_text = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'balkon_section-title',
    'section-title',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr($css_class );?>">
    <?php if($subtitle_text !=''):?>
    <h3 class="head-sec-subtitle"><?php echo esc_html($subtitle_text);?></h3>
        <?php if($show_sep == 'yes') : ?>
        <div class="separator trsp-separator"></div>
        <?php endif; ?>
    <?php endif;?>
    <?php if($title_text !=''):?>
    <h1 class="head-sec-title"><?php echo wp_kses_post( $title_text );?></h1>
    <?php endif;?>
    <?php echo wpb_js_remove_wpautop($content,true);?>
    <?php if($scroll_url !=''):?>
    <a href="<?php echo esc_url( $scroll_url );?>" class="custom-scroll-link sect-scroll-link">
        <?php if($scroll_icon !=''):?>
        <i class="<?php echo esc_attr( $scroll_icon );?>"></i>
        <?php endif;?>
        <?php if($scroll_text !=''):?>
        <span><?php echo esc_html($scroll_text); ?></span>
        <?php endif;?>
    </a>
    <?php endif;?>
</div>