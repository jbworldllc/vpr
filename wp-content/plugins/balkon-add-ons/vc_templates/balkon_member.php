<?php
/* add_ons_php */
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $name //
 * @var $job //
 * @var $photo
 * @var $socials
 * @var $disable_overlay
 * @var $dis_right_deco
 * @var $parallax_value
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Member
 */
$el_class = $id = $css = $show_excerpt = $show_readmore = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'mem-single-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

if(!empty($id)){
    $args = array(
        'post_type'      => 'member',
        'p' => intval($id),

        'post_status'       => 'publish',
        
    );
}else{
    $args = array(
        'post_type'      => 'member',
        'posts_per_page' => 1,

        'post_status'       => 'publish',
        
    );
}
$member = new WP_Query($args);

?>
<?php if($member->have_posts()) {       ?>
<div class="<?php echo esc_attr($css_class ); ?>">

        <?php        
        while($member->have_posts()) : $member->the_post();  
        ?>
            
            <div class="team-box">
                <div class="team-photo">
                    <div class="overlay"></div>
                    <ul class="team-social">
                        <?php if(get_post_meta(get_the_ID(), '_balkon_twitterurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('Follow on Twitter','balkon-add-ons');?>" href="<?php echo esc_url( get_post_meta(get_the_ID(), '_balkon_twitterurl' ,true) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if(get_post_meta(get_the_ID(), '_balkon_facebookurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('Like on Facebook','balkon-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_balkon_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if(get_post_meta(get_the_ID(), '_balkon_googleplusurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('Circle on Google Plus','balkon-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_balkon_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        <?php } ?>
                        <?php if(get_post_meta(get_the_ID(), '_balkon_linkedinurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('Be Friend on Linkedin','balkon-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_balkon_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <?php } ?>
                        <?php if(get_post_meta(get_the_ID(), '_balkon_instagramurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('Follow on Instagram','balkon-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_balkon_instagramurl' ,true) ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                        <?php if(get_post_meta(get_the_ID(), '_balkon_tumblrurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('Follow on  Tumblr','balkon-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_balkon_tumblrurl' ,true) ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                        <?php } ?>  
                        <?php if(get_post_meta(get_the_ID(), '_balkon_behanceurl' ,true)!=''){ ?>
                            <li><a title="<?php esc_html_e('View Behance profile','balkon-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_balkon_behanceurl' ,true) ); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
                        <?php } ?>
                    </ul>
                    <?php 
                    if(has_post_thumbnail( )){

                        the_post_thumbnail( 'balkon_member_thumb', array('class'=>'respimg') );
                    } 
                    ?><span class="mem-hover-find"><?php esc_html_e('Find on','balkon-add-ons' );?></span>                                         
                </div>
                <div class="team-info">
                    <h3>
                    <?php if( $show_readmore == 'yes' ):?>
                    <a href="<?php the_permalink();?>" class="member-link">
                    <?php endif;?>
                    <?php the_title();?>
                    <?php if( $show_readmore == 'yes' ):?>
                    </a>
                    <?php endif;?>
                    </h3>
                    <?php 
                    if($show_excerpt == 'yes'){
                        echo '<div class="team-excerpt">';
                        the_excerpt();
                        echo '</div>';
                    }?>
                </div>
            </div> 
            

        <?php 
        endwhile; ?>

</div>

<?php
}

/* Restore original Post Data */
wp_reset_postdata();
