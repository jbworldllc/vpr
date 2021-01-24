<?php

class Noo_Before_After_Elementor_Widget extends \Elementor\Widget_Base
{
    
    public function get_name()
    {
        return "noo-before-after";
    }
    
    public function get_title()
    {
        return __( 'Noo Before After', 'noo-before-after' );
    }
    
    public function get_icon()
    {
        return 'fa fa-image';
    }
    
    public function get_categories()
    {
        return [ 'general' ];
    }
    
    public function get_script_depends() {
        return [ 'elementor-noo-before-after' ];
    }
    
    protected function _register_controls()
    {
        /**
         * General Section
         */
        $this->start_controls_section(
            'general_section',
            [
                'label' => __( 'General', 'noo-before-after' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
            );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'bimg',
            [
                'label' => __( 'Before Image', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
            );
        $repeater->add_control(
            'blabel',
            [
                'label' => __( 'Before Image Label', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Before', 'noo-before-after' ),
                'default' => ''
            ]
            );
        $repeater->add_control(
            'aimg',
            [
                'label' => __( 'After Image', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
            );
        $repeater->add_control(
            'alabel',
            [
                'label' => __( 'After Image Label', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'After', 'noo-before-after' ),
                'default' => ''
            ]
            );
        $repeater->add_control(
            'overlayimg',
            [
                'label' => __( 'Overlay Image', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
            );
        // Slide Items
        $this->add_control(
            'items',
            [
                'label' => __( 'Slide Items', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => 'Item',
            ]
            );
        $this->add_control(
            'width',
            [
                'label' => __( 'Width', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Example: 50% or 200px', 'noo-before-after' ),
                'default' => '100%'
            ]
            );
        $this->add_control(
            'direction',
            [
                'label' => __( 'Direction', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => __( 'Horizontal', 'noo-before-after' ),
                    'vertical' => __( 'Vertical', 'noo-before-after' ),
                ],
                'default' => 'horizontal'
            ]
            );
        $this->add_control(
            'type',
            [
                'label' => __( 'Type', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'mouse_move' => __( 'Hover', 'noo-before-after' ),
                    'click' => __( 'Click', 'noo-before-after' ),
                    'drag' => __( 'Drag', 'noo-before-after' ),
                ],
                'default' => 'mouse_move'
            ]
            );
        $this->end_controls_section();
        
        /**
         * Control Bar Section
         */
        $this->start_controls_section(
            'controlbar_section',
            [
                'label' => __( 'Control Bar', 'noo-before-after' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
            );
        //Offset
        $this->add_control(
            'control_offset',
            [
                'label' => __( 'Offset', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
            );
        //Color
        $this->add_control(
            'control_color',
            [
                'label' => __( 'Color', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .noo-slider' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .noo-slider:before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .noo-slider:after' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .noo-slider svg' => 'fill: {{VALUE}}'
                ],
            ]
            );
        $this->end_controls_section();
        
        /**
         * Slide Options Section
         */
        $this->start_controls_section(
            'slideoptions_section',
            [
                'label' => __( 'Slide Options', 'noo-before-after' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
            );
        //Items display
        $items_display = range( 1, 6 );
        $items_display = array_combine( $items_display, $items_display );
        $this->add_responsive_control(
            'items_display',
            [
                'label' => __( 'Item Per Slide', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''  => __('Default', 'noo-before-after'),
                ] + $items_display,
                'frontend_available' => true,
                'desktop_default' => '',
                'tablet_default' => '',
                'mobile_default' => '',
            ]
            );
        // Loop
        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'noo-before-after' ),
                'label_off' => __( 'No', 'noo-before-after' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
            );
        // auto_height
        $this->add_control(
            'auto_height',
            [
                'label' => __( 'Auto Height', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'noo-before-after' ),
                'label_off' => __( 'No', 'noo-before-after' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
            );
        // auto_play
        $this->add_control(
            'auto_play',
            [
                'label' => __( 'Auto Play', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'noo-before-after' ),
                'label_off' => __( 'No', 'noo-before-after' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
            );
        // item_space
        $this->add_control(
            'item_space',
            [
                'label' => __( 'Item Spacing', 'noo-before-after' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
            ]
            );
        $this->end_controls_section();
    }
    
    protected function render()
    {
        global $noo_ba_uri;
        $settings = $this->get_settings_for_display();
        //set variables
        $items          = $settings['items'];
        $items_count    = count($items);
        $slick_arrows   = $items_count > 1 ? apply_filters('noo_before_after_slideshow_slick_arrows', 'true') : 'false' ;
        $slick_dots   = $items_count > 1 ? apply_filters('noo_before_after_slideshow_slick_dots', 'true') : 'false' ;
        $width          = $settings['width'] == '' ? '100%' : $settings['width'];
        $direction      = $settings['direction'];
        $type           = $settings['type'];
        $offset         = $settings['control_offset'];
        $color          = $settings['control_color'];
        $items_display  = $settings['items_display'] == '' ? 1 : $settings['items_display'];
        $items_display_tablet  = $settings['items_display_tablet'] == '' ? 1 : $settings['items_display_tablet'];
        $items_display_mobile  = $settings['items_display_mobile'] == '' ? 1 : $settings['items_display_mobile'];
        
        $item_space        = $settings['item_space'];
        $noo_caret_up = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z"/></svg>';
        $noo_caret_down = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1408 704q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"/></svg>';
        $noo_caret_left = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 448v896q0 26-19 45t-45 19-45-19l-448-448q-19-19-19-45t19-45l448-448q19-19 45-19t45 19 19 45z"/></svg>';
        $noo_caret_right = '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1152 896q0 26-19 45l-448 448q-19 19-45 19t-45-19-19-45v-896q0-26 19-45t45-19 45 19l448 448q19 19 19 45z"/></svg>';
        $icon_1 = $direction == 'horizontal' ? $noo_caret_left : $noo_caret_up;
        $icon_2 = $direction == 'horizontal' ? $noo_caret_right : $noo_caret_down;
        $direction_class = $direction == 'horizontal' ? 'nba-horizontal' : 'nba-vertical';
        $loop = $settings['loop'] == 'yes' ? 'true' : 'false';
        $auto_height = $settings['auto_height'] == 'yes' ? 'true' : 'false';
        $auto_play = $settings['auto_play'] == 'yes' ? 'true' : 'false';
        $unique_id = uniqid();
        
        if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $custom_css = "
            .noo-ba-wrapper-{$unique_id} {
                width: {$width};
            }
            .noo-before-after-slideshow-{$unique_id} .slick-slide {
                margin: {$item_space['size']}{$item_space['unit']};
            }
            ";
            wp_register_style( 'noo-before-after-style', false );
            wp_enqueue_style( 'noo-before-after-style' );
            wp_add_inline_style('noo-before-after-style', $custom_css);
        } else { ?>
            <style>
            .noo-ba-wrapper-<?php echo $unique_id ?> {
                width: <?php echo $width ?>;
            }
            .noo-before-after-slideshow-<?php echo $unique_id ?> .slick-slide {
                margin: <?php echo $item_space['size'].$item_space['unit'] ?>;
            }
            </style>
        <?php }
        wp_register_script( 'noo-before-after-slide', $noo_ba_uri . '/assets/js/noo-before-after-inline.js', array(), null, true );
        wp_enqueue_script( 'noo-before-after-slide' );
        ?>
        <div class="noo-before-after-slideshow-wrapper noo-ba-wrapper-<?php echo $unique_id; ?>">
            <div class="noo-slick-carousel noo-before-after-slideshow-<?php echo $unique_id; ?>">
                <?php
                foreach($items as $k => $item) {
                    $rand_id = uniqid();
                    $alabel = $item['alabel'];
                    $blabel = $item['blabel'];
                    $bimg = $item['bimg']['id'] != '' ? $item['bimg']['url'] : '';
                    $aimg = $item['aimg']['id'] != '' ? $item['aimg']['url'] : '';
                    $overlayimg = $item['overlayimg']['id'] != '' ? $item['overlayimg']['url'] : '';
                    if($bimg != '' && $aimg != '') {
                    ?>
                    <div class="noo-before-after-single-container">
                        <div class=" noo-inner noo-inner<?php echo $rand_id; ?> <?php echo $direction_class ?>" data-direction="<?php echo $direction ?>" data-type="<?php echo $type; ?>" data-offset="<?php echo $offset['size']; ?>" data-before_label="<?php echo $blabel; ?>" data-after_label="<?php echo $alabel; ?>">
                            <img src="<?php echo $aimg ?>" alt="" class="nba-after-img noo-after-img nba-img">
                            <img src="<?php echo $bimg ?>" alt="" class="nba-before-img noo-before-img nba-img">

                            <?php if($overlayimg != '') { ?>
                                <img class="nba-overimage noo-overlay-img nba-img" src="<?php echo $overlayimg; ?>" alt="">
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
                            if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                            $script = "
                                    jQuery('.noo-inner-{$rand_id}').nooImageComparison({
                                        control_offset: {$offset['size']},
                                        direction: '{$direction}',
                                        before_label: '{$blabel}',
                                        after_label: '{$alabel}',
                                        comparison_type: '{$type}',
                                    });";
                                wp_add_inline_script( 'noo-before-after-slide', $script ); 
                            } else { ?>
                            <script>
                                jQuery(function(){
                                    jQuery('.noo-inner-<?php echo $rand_id; ?>').nooImageComparison({
                                        control_offset: <?php echo $offset['size']; ?>,
                                        direction: '<?php echo $direction; ?>',
                                        before_label: '<?php echo $blabel; ?>',
                                        after_label: '<?php echo $alabel; ?>',
                                        comparison_type: '<?php echo $type; ?>',
                                    });
                                });
                            </script>
                            <?php }
                            ?>
                        </div>

                    </div>
                <?php }} ?>
            </div>
            <?php 
            if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
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
            } else { ?>
            <script>
                jQuery(document).ready( function() {
                    jQuery(".noo-before-after-slideshow-<?php echo $unique_id; ?>").slick({
                        infinite: <?php echo $loop; ?>,
                        adaptiveHeight: <?php echo $auto_height; ?>,
                        autoplay: <?php echo $auto_play; ?>,
                        autoplaySpeed: 3000,
                        arrows: <?php echo $slick_arrows?>,
                        dots: <?php echo $slick_dots?>,
                        slidesToScroll: 1,
                        draggable: false,
                        swipe: false,
                        slidesToShow: <?php echo $items_display; ?>,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: <?php echo $items_display_tablet; ?>
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: <?php echo $items_display_mobile; ?>
                                }
                            }
                        ]
                    }).on('breakpoint', function(event, slick, breakpoint) {
                        jQuery('.noo-before-after-slideshow-<?php echo $unique_id;?> .noo-inner').each(function() {
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
                        jQuery('.noo-before-after-slideshow-<?php echo $unique_id;?> .noo-inner').each(function() {
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
                });
            </script>
            <?php }
            ?>
        </div>
        <?php
    }

    protected function _content_template()
    {
    }
}
