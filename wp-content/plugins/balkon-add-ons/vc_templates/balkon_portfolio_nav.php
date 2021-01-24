<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $show_all
 * @var $all_link
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Service
 */
$css = $el_class = $show_all = $all_link = $same_term = $show_tooltip = $nav_title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'folio-nav-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

$in_same_term = false;
if($same_term == 'yes'){
    $in_same_term = true;
}

?>
<div class="<?php echo esc_attr($css_class );?>">
    <div class="content-nav">
        <ul>
            <li>
            <?php
            $prev_post = get_adjacent_post( $in_same_term, '', true, 'portfolio_cat' );
            if ( is_a( $prev_post, 'WP_Post' ) ) :
            ?>
                <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="ln" title="<?php echo get_the_title($prev_post->ID ); ?>"><i class="fa fa fa-angle-left"></i><span class="tooltip"><?php echo get_the_title($prev_post->ID ); ?></span></a>
            <?php else : ?>
                <a href="javascript:void(0)" class="ln">&nbsp;</a>
            <?php endif ?>
            </li>
            
            <li>
            <?php if($show_all  == 'yes') :?>
                <div class="list">
                <?php if(!empty($all_link)) :?>
                    <a href="<?php echo esc_url($all_link ); ?>">
                <?php else :?>
                    <a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>">
                <?php endif;?>                        
                    <span>
                    <i class="b1 c1"></i><i class="b1 c2"></i><i class="b1 c3"></i>
                    <i class="b2 c1"></i><i class="b2 c2"></i><i class="b2 c3"></i>
                    <i class="b3 c1"></i><i class="b3 c2"></i><i class="b3 c3"></i>
                    </span></a>
                </div>
            <?php endif;?>
            </li>
            
            <li>
            <?php
            $next_post = get_adjacent_post( $in_same_term, '', false, 'portfolio_cat' );
            if ( is_a( $next_post, 'WP_Post' ) ) :
            ?>
                <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="rn" title="<?php echo get_the_title($next_post->ID ); ?>"><i class="fa fa fa-angle-right"></i><span class="tooltip"><?php echo get_the_title($next_post->ID ); ?></span></a>
            <?php else : ?>
                <a href="javascript:void(0)" class="rn">&nbsp;</a>
            <?php endif ?>
            </li>
            
        </ul>
    </div>

</div>