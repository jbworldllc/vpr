<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (!function_exists( 'shortcode_noo_before_after'))
{
    function shortcode_noo_before_after( $atts ) {
        global $noo_ba_uri;
        extract(
            shortcode_atts(
                array(
                    'items'         => array(
                        array(
                            'bimg'  => '',
                            'blabel'    => '',
                            'aimg'      => '',
                            'alabel'    => '',
                            'overlayimg'   => '',
                        ),
                    ),
                    'width'         => '100%',
                    'direction'     => 'horizontal',
                    'type'          => 'mouse_move',
                    'control_offset'=> '50',
                    'control_color' => '#fff',
                    'items_display' => 1,
                    'items_display_tablet' => 1,
                    'items_display_mobile' => 1,
                    'loop'          => '',
                    'auto_height'   => '',
                    'auto_play'   => '',
                    'margin'        => 0,
                    'class'         => '',
                ),
                $atts
                )
            );
        $items = json_decode( urldecode($items), true );
        $items_count    = count($items);
        $slick_arrows   = $items_count > 1 ? apply_filters('noo_before_after_slideshow_slick_arrows', 'true') : 'false' ;
        $slick_dots   = $items_count > 1 ? apply_filters('noo_before_after_slideshow_slick_dots','true') : 'false' ;
        $comp_type = $type;
        $comp_direct = $direction;
        
        $noo_caret_up = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z"/></svg>';
        $noo_caret_down = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1408 704q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"/></svg>';
        $noo_caret_left = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 448v896q0 26-19 45t-45 19-45-19l-448-448q-19-19-19-45t19-45l448-448q19-19 45-19t45 19 19 45z"/></svg>';
        $noo_caret_right = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1152 896q0 26-19 45l-448 448q-19 19-45 19t-45-19-19-45v-896q0-26 19-45t45-19 45 19l448 448q19 19 19 45z"/></svg>';
        $icon_1 = $comp_direct == 'horizontal' ? $noo_caret_left : $noo_caret_up;
        $icon_2 = $comp_direct == 'horizontal' ? $noo_caret_right : $noo_caret_down;
        
        $direct_class = $comp_direct == 'horizontal' ? 'nba-horizontal' : 'nba-vertical';
        $unique_id = uniqid();
        
        //Slide variables
        $loop = $loop != '' ? 'true' : 'false';
        $auto_height = $auto_height != '' ? 'true' : 'false';
        $auto_play   = $auto_play != '' ? 'true' : 'false';
        
        $custom_css = "
            .noo-ba-wrapper-{$unique_id} {
                width: {$width};
            }
            .noo-before-after-slideshow-{$unique_id} .noo-slider {
                border-color: {$control_color};
            }
            .noo-before-after-slideshow-{$unique_id} .noo-slider:before,
            .noo-before-after-slideshow-{$unique_id} .noo-slider:after {
                background: {$control_color};
            }
            .noo-before-after-slideshow-{$unique_id} .noo-slider svg {
                fill: {$control_color};
            }
            .noo-before-after-slideshow-{$unique_id} .slick-slide {
                margin: {$margin}px;
            }
            ";
        wp_register_style( 'noo-before-after-style', false );
        wp_enqueue_style( 'noo-before-after-style' );
        wp_add_inline_style( 'noo-before-after-style', $custom_css );
        
        wp_register_script( 'noo-before-after-slide', $noo_ba_uri . '/assets/js/noo-before-after-inline.js', array(), null, true );
        wp_enqueue_script( 'noo-before-after-slide' );
        ob_start();
        ?>
        <div class="noo-before-after-slideshow-wrapper noo-ba-wrapper-<?php echo $unique_id; ?> <?php echo $class; ?>">
            <div class="noo-slick-carousel noo-before-after-slideshow-<?php echo $unique_id; ?>">
        <?php
        foreach($items as $k => $item) {
            $rand_id = uniqid();
            $alabel = isset($item['alabel']) ? $item['alabel'] : '';
            $blabel = isset($item['blabel']) ? $item['blabel'] : '';
            $bimg = isset($item['bimg']) ? $item['bimg'] : '';
            $aimg = isset($item['aimg']) ? $item['aimg'] : '';
            $before_image = wp_get_attachment_image_src($bimg, "full");
            $after_image = wp_get_attachment_image_src($aimg, "full");
            $overlayimg = isset($item['overlayimg']) ? $item['overlayimg'] : '';
            if($bimg != '' && $aimg != '') {
            ?>
            <div class="noo-before-after-single-container">
                <div class="noo-inner noo-inner-<?php echo $rand_id; ?> <?php echo $direct_class ?>" data-direction="<?php echo $comp_direct; ?>" data-type="<?php echo $comp_type; ?>" data-offset="<?php echo $control_offset; ?>" data-before_label="<?php echo $blabel; ?>" data-after_label="<?php echo $alabel; ?>">
                    <img src="<?php echo $after_image[0] ?>" alt="" class="nba-after-img noo-after-img nba-img">
                    <img src="<?php echo $before_image[0] ?>" alt="" class="nba-before-img noo-before-img nba-img">

                    <?php if($overlayimg != '') { ?>
                        <img class="nba-overimage noo-overlay-img nba-img" src="<?php echo wp_get_attachment_image_src($overlayimg, "full")[0] ?>" alt="">
                    <?php } ?>
                    <div class="noo-slider">
                        <div class="noo-caret-left">
                            <?php echo $icon_1; ?>
                        </div>
                        <div class="noo-caret-right">
                            <?php echo $icon_2; ?>
                        </div>
                    </div>
                    <?php
                    $script = "
                    jQuery(document).ready(function(){
                        jQuery(function(){
                            jQuery('.noo-inner-{$rand_id}').nooImageComparison({
                                control_offset: {$control_offset},
                                direction: '{$comp_direct}',
                                before_label: '{$blabel}',
                                after_label: '{$alabel}',
                                comparison_type: '{$comp_type}',
                            });
                        });
                    })";
                    wp_add_inline_script( 'noo-before-after-slide', $script ); 
                    ?>
                </div>

            </div>

            <?php
            }
        } ?>
            </div>
            <?php
            $slide_script = "jQuery(document).ready( function() {
                    jQuery('.noo-before-after-slideshow-{$unique_id}').slick({
                        infinite: {$loop},
                        adaptiveHeight: {$auto_height},
                        autoplay: {$auto_play},
                        autoplaySpeed: 3000,
                        arrows: {$slick_arrows},
                        dots: {$slick_dots},
                        slidesToScroll: 1,
                        draggable: false,
                        swipe: false,
                        slidesToShow: {$items_display},
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: {$items_display_tablet}
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: {$items_display_mobile}
                                }
                            }
                        ]
                    }).on('breakpoint', function(event, slick, breakpoint) {
                        jQuery('.noo-before-after-slideshow-{$unique_id} .noo-inner').each(function() {
                            let cur = jQuery(this);
                            let data = cur.data();

                            cur.nooImageComparison({
                                control_offset: data.offset,
                                direction: data.direction,
                                before_label: data.before_label,
                                after_label: data.after_label,
                                comparison_type: data.type,
                            });

                        });
                    }).on('setPosition', function(slick) {
                        jQuery('.noo-before-after-slideshow-{$unique_id} .noo-inner').each(function() {
                            let cur = jQuery(this);
                            let data = cur.data();

                            cur.nooImageComparison({
                                control_offset: data.offset,
                                direction: data.direction,
                                before_label: data.before_label,
                                after_label: data.after_label,
                                comparison_type: data.type,
                            });

                        });
                    });
                });";
                wp_add_inline_script( 'noo-before-after-slide', $slide_script ); 
            ?>
        </div>
<?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}
