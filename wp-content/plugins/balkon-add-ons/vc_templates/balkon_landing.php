<?php
/* add_ons_php */
$css = $el_class = $light_logo = $dark_logo = $introtext = $cta_link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'landing-wrapper balkon-landing-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr( $css_class );?>">
    <div class="partcile-dec" data-count="200" data-color="#ccc"></div>
	<div class="logo-holder">
    	<div class="logo-wrap alt">
        	<div class="logo-container">
        		<?php if($light_logo != '') echo wp_get_attachment_image( $light_logo, 'full', '',  array('class'=>'logo-vis') ); ?>
        		<?php if($dark_logo != '') echo wp_get_attachment_image( $dark_logo, 'full', '',  array('class'=>'logo-notvis') ); ?>
        	</div>
            <div class="logo-text">
            	<?php echo wp_kses_post( $introtext ); ?>
            <?php
            	//parse link
                $link = ( '||' === $cta_link ) ? '' : $cta_link;
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

                $attributes[] = 'class="btn float-btn flat-btn"';
                $attributes = implode( ' ', $attributes );

                if($a_title == '') $a_title = esc_html__('Buy Now $59','balkon-add-ons' );

                echo '<a ' . $attributes . '>'.$a_title.'</a>';
            ?>
            </div>
        </div>
    </div>
    <div class="content-wrap">
		<?php echo wpb_js_remove_wpautop($content);?>
    </div>
</div>