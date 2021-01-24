<?php
/* add_ons_php */
$el_class = $css = $values = $columns = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'social-wrap fl-wrap',
    'social-'.$columns.'-cols',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

$values = (array) vc_param_group_parse_atts( $values );
?>
<div class="<?php echo esc_attr($css_class ); ?>">
    <ul>
    <?php foreach ( $values as $data ) { ?>
        <li>
            <a href="<?php echo isset( $data['url'] ) &&  $data['url'] != '' ? $data['url'] : 'javascript:void(0)';?>" target="<?php echo isset( $data['target'] ) ? $data['target'] : '_blank';?>" >
                <i class="<?php echo isset( $data['icon'] ) ? $data['icon'] : 'fa fa-facebook';?>"></i>
                <?php 
                if(isset($data['text']) && $data['text'] != '') : ?>
                <span class="icon-text"><?php echo esc_html( $data['text'] );?></span>
                <?php endif;?>
            </a>
        </li>
    <?php } ?>  
    </ul>
</div>