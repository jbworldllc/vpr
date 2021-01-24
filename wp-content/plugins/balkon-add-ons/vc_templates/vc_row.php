<?php
/* add_ons_php */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$disable_element = '';
$output = $after_output = '';



// for custom fields
$cth_layout
 = $no_padding = $balkon_bg_color
 = $overlay_color
 = $is_fullwidth

 = $parallax_inner = $parallax_inner_val  = $parallax_inner_pos
 = $bg_video_type = $bg_video = $bg_video_mute = $bg_video_loop

 = $use_particle = $particle_count = $particle_color

/* For portfolio layout */
 = $gallery_images

 = $items = $autoplay = $autoplayspeed = $autoplaytimeout = $responsive = $autoheight = $loop = $dots = $smartspeed = $center = $autowidth 

 = $show_thumbs = $show_cap = $show_zoom = $show_more_info

 = $gal_columns = $gal_space

 = $video_id = $video_bg_id = $video_quality = $video_mute

 = '';

 $loaded = $show_loadmore = $lmore_items = $show_img_desc = $show_img_title = '';


$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($cth_layout == 'balkon_homefullheight_sec'){ //layout #1 ?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'balkon_sec balkon_fulh_sec full-height no-padding no-col-pad',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    $balkon_bg_color
);

if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}

$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?><?php echo !empty($parallax_inner_val) ? ' data-scrollax-parent="true"' : '' ;?>>
                  
    <?php 
        if ( $is_fullwidth === 'yes' ) { ?>
        <div class="container-fluid full-height">
    <?php }elseif($is_fullwidth === 'wide'){ ?>
        <div class="container row-container-wide full-height">
    <?php }else { ?>
        <div class="container full-height">
    <?php
    }    ?>
            <div class="wpb_row full-height">
                <?php echo wpb_js_remove_wpautop($content); ?>
            </div>
        </div>
    <?php if(!empty($parallax_inner)) :?>
    <?php 
    $bgcls = 'bg '; 
    $bgcls .= $parallax_inner_pos.'-dec-bg';
    if(!empty($parallax_inner_val)){
        $bgcls .= ' para-bg';
    }?>
    <div class="<?php echo esc_attr($bgcls );?>" data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($parallax_inner, 'balkon_fuls_thumb') );?>"
    <?php if(!empty($parallax_inner_val)): ?>
     data-scrollax="properties:{<?php echo esc_attr($parallax_inner_val );?>}"
    <?php endif; ?>
    ></div>
    <?php if($overlay_color != '') : ?>
    <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color );?>;"></div>
    <?php endif;?>
    <?php endif;?>
    <?php if($use_particle == 'yes') : ?>
    <div class="partcile-dec" data-count="<?php echo esc_attr( $particle_count );?>" data-color="<?php echo esc_attr( $particle_color );?>"></div>
    <?php endif;?>
</section>

<?php }elseif($cth_layout == 'balkon_head_sec'){ //layout #2?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'balkon_sec balkon_page_head_sec parallax-section header-section',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    $balkon_bg_color
);
if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if($no_padding == 'yes'){
    $css_class .= ' no-padding';
}
?>

<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?><?php echo !empty($parallax_inner_val) ? ' data-scrollax-parent="true"' : '' ;?>>
<?php 
if ( $is_fullwidth === 'yes' ) { ?>
    <div class="container-fluid">
    <?php }elseif($is_fullwidth === 'wide'){ ?>
    <div class="container row-container-wide">
    <?php }else { ?>
    <div class="container">
    <?php
    }    ?>
        <div class="row">
            <?php echo wpb_js_remove_wpautop($content); ?>
        </div>
    </div>
    <?php if(!empty($parallax_inner)) :?>
    <?php 
    $bgcls = 'bg '; 
    if(!empty($parallax_inner_val)){
        $bgcls .= ' para-bg';
    }?>
    <div class="<?php echo esc_attr($bgcls );?>" data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($parallax_inner, 'balkon_fuls_thumb') );?>"
    <?php if(!empty($parallax_inner_val)): ?>
     data-scrollax="properties:{<?php echo esc_attr($parallax_inner_val );?>}"
    <?php endif; ?>
    ></div>
    <?php if($overlay_color != '') : ?>
    <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color );?>;"></div>
    <?php endif;?>
    <?php endif;?>
    <?php if($use_particle == 'yes') : ?>
    <div class="partcile-dec" data-count="<?php echo esc_attr( $particle_count );?>" data-color="<?php echo esc_attr( $particle_color );?>"></div>
    <?php endif;?>
</section>

<?php }elseif($cth_layout == 'balkon_page_sec'){ //layout #3?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'balkon_sec balkon_page_sec',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    $balkon_bg_color
);
if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if($no_padding == 'yes'){
    $css_class .= ' no-padding';
}
if($parallax_inner != '' && $parallax_inner_val != '' && $parallax_inner_pos == 'cover') $css_class .= ' parallax-section';
?>

<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?><?php echo !empty($parallax_inner_val) ? ' data-scrollax-parent="true"' : '' ;?>>
<?php 
if ( $is_fullwidth === 'yes' ) { ?>
    <div class="container-fluid">
    <?php }elseif($is_fullwidth === 'wide'){ ?>
    <div class="container row-container-wide">
    <?php }else { ?>
    <div class="container">
    <?php
    }    ?>
        <div class="row">
            <?php echo wpb_js_remove_wpautop($content); ?>
        </div>
    </div>
    <?php if(!empty($parallax_inner)) :?>
    <?php 
    $bgcls = 'bg '; 
    $bgcls .= $parallax_inner_pos.'-dec-bg';
    if(!empty($parallax_inner_val)){
        $bgcls .= ' para-bg';
    }?>
    <div class="<?php echo esc_attr($bgcls );?>" data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($parallax_inner, 'balkon_fuls_thumb') );?>"
    <?php if(!empty($parallax_inner_val)): ?>
     data-scrollax="properties:{<?php echo esc_attr($parallax_inner_val );?>}"
    <?php endif; ?>
    ></div>
    <?php if($overlay_color != '') : ?>
    <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color );?>;"></div>
    <?php endif;?>
    <?php endif;?>
    <?php if($use_particle == 'yes') : ?>
    <div class="partcile-dec" data-count="<?php echo esc_attr( $particle_count );?>" data-color="<?php echo esc_attr( $particle_color );?>"></div>
    <?php endif;?>
</section>

<?php }elseif($cth_layout == 'balkon_video_bg_sec'){ //layout #4?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'balkon_sec balkon_video_bg_sec',
    'parallax-section',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    $balkon_bg_color
);
if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if($no_padding == 'yes'){
    $css_class .= ' no-padding';
}
?>

<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?><?php echo !empty($parallax_inner_val) ? ' data-scrollax-parent="true"' : '' ;?>>
    
    <?php 
    if($bg_video != '' ) : ?>
    <div class="media-container" <?php if(!empty($parallax_inner_val)): ?>
             data-scrollax="properties:{<?php echo esc_attr($parallax_inner_val );?>}"
            <?php endif; ?>>
        <div class="video-mask"></div>
        <div class="video-holder">
        <?php if($bg_video_type == 'hosted') : 
            $video_attrs = ' autoplay';
            if($bg_video_mute == '1') $video_attrs .=' muted';
            if($bg_video_loop == '1') $video_attrs .=' loop';
        ?>
            <div class="video-container">
                <video<?php echo esc_attr( $video_attrs );?> class="bgvid">
                    <source src="<?php echo esc_url( $bg_video );?>" type="video/mp4">
                </video>
            </div>
        <?php elseif($bg_video_type == 'vimeo') : 
            $dataArr = array();
            $dataArr['video'] = $bg_video;
            $dataArr['quality'] = '1080p';
            $dataArr['mute'] = $bg_video_mute;
            $dataArr['loop'] = $bg_video_loop;
        ?>
            <div  class="background-vimeo" data-opts='<?php echo json_encode( $dataArr );?>'></div>
        <?php else : ?>
            <div  class="background-youtube" data-vid="<?php echo esc_attr( $bg_video );?>" data-mt="<?php echo esc_attr( $bg_video_mute );?>" data-ql="highres" data-ftb="1" data-pos="0" data-rep="<?php echo esc_attr( $bg_video_loop );?>"></div>
        <?php endif ; ?>
            
            <?php if(!empty($parallax_inner)) :?>
            <?php 
            $bgcls = 'bg mob-bg'; 
            //$bgcls .= $parallax_inner_pos.'-dec-bg';
            if(!empty($parallax_inner_val)){
                $bgcls .= ' para-bg';
            }?>
            <div class="<?php echo esc_attr($bgcls );?>" data-bg="<?php echo esc_url(balkon_get_attachment_thumb_link($parallax_inner, 'balkon_fuls_thumb') );?>"
            <?php if(!empty($parallax_inner_val)): ?>
             data-scrollax="properties:{<?php echo esc_attr($parallax_inner_val );?>}"
            <?php endif; ?>
            ></div>
            
            <?php endif;?>

        </div>
    </div>
    <?php 
    endif ; ?>
    <?php if($overlay_color != '') : ?>
    <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color );?>;"></div>
    <?php endif;?>
<?php 
if ( $is_fullwidth === 'yes' ) { ?>
    <div class="container-fluid">
    <?php }elseif($is_fullwidth === 'wide'){ ?>
    <div class="container row-container-wide">
    <?php }else { ?>
    <div class="container">
    <?php
    }    ?>
        <div class="row">
            <?php echo wpb_js_remove_wpautop($content); ?>
        </div>
    </div>
    
    <?php if($use_particle == 'yes') : ?>
    <div class="partcile-dec" data-count="<?php echo esc_attr( $particle_count );?>" data-color="<?php echo esc_attr( $particle_color );?>"></div>
    <?php endif;?>
</section>

<?php
}else{

    $output = '';
    wp_enqueue_script( 'wpb_composer_front_js' );

    $el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

    $css_classes = array(
        'vc_row',
        'wpb_row',
        //deprecated
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );

    if ( 'yes' === $disable_element ) {
        if ( vc_is_page_editable() ) {
            $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
        } else {
            return '';
        }
    }

    if ( vc_shortcode_custom_css_has_property( $css, array(
            'border',
            'background',
        ) ) || $video_bg || $parallax
    ) {
        $css_classes[] = 'vc_row-has-fill';
    }

    if ( ! empty( $atts['gap'] ) ) {
        $css_classes[] = 'vc_column-gap-' . $atts['gap'];
    }

    if ( ! empty( $atts['rtl_reverse'] ) ) {
        $css_classes[] = 'vc_rtl-columns-reverse';
    }

    $wrapper_attributes = array();
    // build attributes for wrapper
    if ( ! empty( $el_id ) ) {
        $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
    }
    if ( ! empty( $full_width ) ) {
        $wrapper_attributes[] = 'data-vc-full-width="true"';
        $wrapper_attributes[] = 'data-vc-full-width-init="false"';
        if ( 'stretch_row_content' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
        } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
            $css_classes[] = 'vc_row-no-padding';
        }
        $after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
    }

    if ( ! empty( $full_height ) ) {
        $css_classes[] = 'vc_row-o-full-height';
        if ( ! empty( $columns_placement ) ) {
            $flex_row = true;
            $css_classes[] = 'vc_row-o-columns-' . $columns_placement;
            if ( 'stretch' === $columns_placement ) {
                $css_classes[] = 'vc_row-o-equal-height';
            }
        }
    }

    if ( ! empty( $equal_height ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-equal-height';
    }

    if ( ! empty( $content_placement ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-content-' . $content_placement;
    }

    if ( ! empty( $flex_row ) ) {
        $css_classes[] = 'vc_row-flex';
    }

    $has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

    $parallax_speed = $parallax_speed_bg;
    if ( $has_video_bg ) {
        $parallax = $video_bg_parallax;
        $parallax_speed = $parallax_speed_video;
        $parallax_image = $video_bg_url;
        $css_classes[] = 'vc_video-bg-container';
        wp_enqueue_script( 'vc_youtube_iframe_api_js' );
    }

    if ( ! empty( $parallax ) ) {
        wp_enqueue_script( 'vc_jquery_skrollr_js' );
        $wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
        $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
        if ( false !== strpos( $parallax, 'fade' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fade';
            $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
        } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fixed';
        }
    }

    if ( ! empty( $parallax_image ) ) {
        if ( $has_video_bg ) {
            $parallax_image_src = $parallax_image;
        } else {
            $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
            $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
            if ( ! empty( $parallax_image_src[0] ) ) {
                $parallax_image_src = $parallax_image_src[0];
            }
        }
        $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
    }
    if ( ! $parallax && $has_video_bg ) {
        $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
    $wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

    $output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div>';
    $output .= $after_output;

    echo $output;

}
