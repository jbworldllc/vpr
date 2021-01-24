<?php
/* add_ons_php */
$el_class = $css =  $opacity = $video = $mute = $loop = $bgimg = $parallax_value =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'balkon-hosted-video',
    'fl-wrap full-height hero-content',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$video_attrs = ' autoplay';
if($mute == '1') $video_attrs .=' muted';
if($loop == '1') $video_attrs .=' loop';
?>
<div class="<?php echo esc_attr($css_class );?>" data-scrollax-parent="true" >
    <div class="media-container" data-scrollax="properties: { <?php echo esc_attr($parallax_value);?> }" >
        <div class="video-mask"></div>
        <div class="video-holder">
            <div class="video-container">
                <video<?php echo esc_attr( $video_attrs );?> class="bgvid">
                    <source src="<?php echo esc_url( $video );?>" type="video/mp4">
                </video>
            </div>
            <div class="mob-bg bg" data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($bgimg, 'balkon_fuls_thumb') );?>"></div>
        </div>
    </div>
    <?php if($opacity != '') : ?>
    <div class="overlay" style="opacity: <?php echo esc_attr($opacity );?>"></div>  
    <?php endif;?>        
    <div class="hero-wrap alt">
        <div class="container">
            <div class="hero-item">
                <?php echo wpb_js_remove_wpautop($content,true);?>
            </div>
        </div>
    </div>
</div>
