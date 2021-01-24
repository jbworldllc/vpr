<?php
/* banner-php */
get_header(); 

$sb_w = balkon_global_var('blog-sidebar-width') ? balkon_global_var('blog-sidebar-width') : 4;
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
            $cat_sub_title = esc_html__('Archive','balkon' );
            if( $cat_sub_title != '' ) : ?>
                <h3 class="head-sec-subtitle"><?php echo wp_kses_post( $cat_sub_title );?></h3>
                <div class="separator trsp-separator"></div>
            <?php endif;?>
                <h1 class="head-sec-title"><?php the_archive_title() ;?></h1>
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