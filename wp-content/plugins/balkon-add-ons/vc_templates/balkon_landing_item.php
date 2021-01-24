<?php
/* add_ons_php */
$css = $el_class = $demos = $title = $subtitle = $link = $is_dark = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'demo-list landing-item-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
if($is_dark == 'yes') $css_classes[] = 'black-bg';
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

$demos = (array) vc_param_group_parse_atts( $demos );
?>
<div class="<?php echo esc_attr( $css_class );?>">
    <div class="container">
        <?php
        if($title != '') : ?>
        <h3><?php echo wp_kses_post( $title );?></h3>
        <?php 
        endif ; ?>
        <?php if($subtitle != '') echo wp_kses_post( $subtitle );?>
        <ul class="demo-items-list clearfix">
            <?php foreach ( $demos as $key => $demo ) { ?>  
            <li class="demo-item demo-item-<?php echo esc_attr( $key +1 );?>">  
                <div class="demo-links-header"><?php echo isset( $demo['demo_title'] ) ? $demo['demo_title'] : '';?></div>
                <?php if(isset($demo['demo_img'])) echo wp_get_attachment_image( $demo['demo_img'] , 'full' ); ?>
                <div class="demo-links-wrap clearfix">
                <?php 
                if(isset($demo['demo_prev1'])) {
                    //parse link
                    $link = ( '||' === $demo['demo_prev1'] ) ? '' : $demo['demo_prev1'];
                    $link = vc_build_link( $link );
                    $use_link = false;
                    $attributes = array();
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

                    $attributes[] = 'class="demo_preview-1"';
                    $attributes = implode( ' ', $attributes );

                    if($a_title == '') $a_title = esc_html__('View Demo','balkon-add-ons' );

                    echo '<a ' . $attributes . '>'.$a_title.'</a>';
                }
                if(isset($demo['demo_prev2'])) {
                    //parse link
                    $link = ( '||' === $demo['demo_prev2'] ) ? '' : $demo['demo_prev2'];
                    $link = vc_build_link( $link );
                    $use_link = false;
                    $attributes = array();
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

                    $attributes[] = 'class="demo_preview-2"';
                    $attributes = implode( ' ', $attributes );

                    if($a_title == '') $a_title = esc_html__('View Demo','balkon-add-ons' );

                    echo '<a ' . $attributes . '>'.$a_title.'</a>';
                }
                ?>
                </div>
            </li>
            <?php } ?>
                                                                 
        </ul>
    </div>
</div>

