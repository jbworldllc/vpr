<?php
/* banner-php */
/**
 * Template Name: Page Fullwidth
 *
 */
if ( post_password_required() ) {
    get_template_part( 'password_protected_page' );
    return;
}
$sb_w = balkon_global_var('blog-sidebar-width') ? balkon_global_var('blog-sidebar-width') : 4;

$show_page_header = get_post_meta(get_the_ID(),'_balkon_show_page_header',true );
get_header(); ?>
<div class="content">
    <?php if($show_page_header == 'yes') :
        $show_page_title = get_post_meta(get_the_ID(),'_balkon_show_page_title',true );
        $page_header_sub = get_post_meta(get_the_ID(),'_balkon_page_header_sub',true );
    ?>
    <section class="parallax-section header-section" data-scrollax-parent="true">
        <div class="bg"  data-bg="<?php echo esc_url( get_post_meta( get_the_ID(), '_balkon_page_header_bg', true ) );?>" data-scrollax="properties: { translateY: '200px' }"></div>
        <div class="overlay"></div>
        <div class="container big-container">
            <div class="section-title">
            <?php 
            if( $page_header_sub!= '' ) : ?>
                <h3 class="head-sec-subtitle"><?php echo esc_html( $page_header_sub );?></h3>
                <div class="separator trsp-separator"></div>
            <?php endif;?>
            <?php if($show_page_title) : ?>
                <h1 class="head-sec-title"><?php single_post_title( ); ?></h1>
            <?php endif ; ?>
                <?php 
                    echo wp_kses_post( get_post_meta(get_the_ID(),'_balkon_page_header_intro',true ) );
                ?>
                <a href="#sec1" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span><?php esc_html_e('scroll down','balkon' );?></span></a>
            </div>
        </div>
    </section>

    <?php endif;?>

    <?php while(have_posts()) : the_post(); ?>

        <?php get_template_part( 'content', 'page-fullwidth'); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</div>
<?php 
get_footer( );

