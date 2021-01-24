<?php
/* banner-php */
get_header(); 

$sb_w = balkon_global_var('blog-sidebar-width') ? balkon_global_var('blog-sidebar-width') : 4;
$show_user_info = get_user_meta(get_the_author_meta('ID'), '_balkon_show_user_info' ,true);
?>
<div class="content">
<?php
if( balkon_global_var('show_blog_header') ) :?>
    <section class="parallax-section header-section" data-scrollax-parent="true">
        <div class="bg"  data-bg="<?php echo esc_url( balkon_global_var('blog_header_image','url', true ) );?>" data-scrollax="properties: { translateY: '200px' }"></div>
        <div class="overlay op1"></div>
        <div class="container big-container">
            <div class="section-title">
            <?php 
            $cat_sub_title = esc_html__('Author','balkon' );
            if( $cat_sub_title != '' ) : ?>
                <h3 class="head-sec-subtitle"><?php echo wp_kses_post( $cat_sub_title );?></h3>
                <div class="separator trsp-separator"></div>
            <?php endif;?>
                <h1 class="head-sec-title"><?php echo get_the_author() ;?></h1>
                <a href="#sec1" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span><?php esc_html_e('scroll down','balkon' );?></span></a>
            </div>
        </div>
    </section>
<?php endif;?>
    <section id="sec1">
        <div class="container">
            <div class="row">
                <?php if( balkon_global_var('blog_layout') ==='left_sidebar' && is_active_sidebar('sidebar-1')):?>
                <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                    <div class="blog-sidebar fl-wrap fixed-bar left-sidebar">
                        <?php 
                            get_sidebar(); 
                        ?>                 
                    </div>
                </div>
                <?php endif;?>
                <?php if( balkon_global_var('blog_layout') ==='fullwidth' || !is_active_sidebar('sidebar-1')):?>
                <div class="col-md-12 display-posts nosidebar">
                <?php else:?>
                <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-posts hassidebar">
                <?php endif;?>
                    <?php if($show_user_info == 'yes') :?>
                    <div class="post-author clearfix">
                        <div class="author-img">
                            <?php 
                                echo get_avatar(get_the_author_meta('user_email'),$size='80',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80' );
                            ?>  
                        </div>
                        <div class="author-content">
                            <h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('nickname');?></a></h5>
                            <p><?php echo get_the_author_meta('description');?></p>
                            <?php if ( 'no' !== _x( 'yes', 'Show author socials on single post page: yes or no', 'balkon' ) ) : ?>
                            <div class="author-social">
                                <ul>
                                    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_twitterurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_html_e('Follow on Twitter','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_twitterurl' ,true)); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_facebookurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_html_e('Like on Facebook','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_googleplusurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_html_e('Circle on Google Plus','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_linkedinurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_html_e('Be Friend on Linkedin','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_instagramurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_html_e('Follow on Instagram','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_instagramurl' ,true) ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_tumblrurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_html_e('Follow on  Tumblr','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_tumblrurl' ,true) ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                                    <?php } ?>  
                                </ul>
                            </div>
                            <?php endif; ?>  
                        </div>
                    </div>

                    <?php endif;?>

                    <div class="post-container fl-wrap">
                        <?php
                        if(balkon_global_var('blog-grid-style') == 'list') {
                            get_template_part('blog-grid-list' );
                        }else{
                            get_template_part('blog-grid-masonry' );
                        }?>
                    </div>
                </div>
                <?php if( balkon_global_var('blog_layout') ==='right_sidebar' && is_active_sidebar('sidebar-1')):?>
                <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                    <div class="blog-sidebar fl-wrap fixed-bar right-sidebar">
                        <?php 
                            get_sidebar(); 
                        ?>                 
                    </div>
                </div>
                <?php endif;?>
                
            </div>
            <div class="limit-box fl-wrap"></div>
            <?php
            balkon_pagination( );
            ?>
            
        </div>
    </section>
</div>

<?php 
get_footer( );
