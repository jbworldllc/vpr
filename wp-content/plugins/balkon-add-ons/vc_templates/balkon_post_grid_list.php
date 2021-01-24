<?php
/* add_ons_php */

/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $cat_ids
 * @var $order
 * @var $order_by
 * @var $ids
 * @var $show_pagination
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Post_Masonry_List
 */
$css = $el_class = $cat_ids = $order = $order_by = $ids = $ids_not = $posts_per_page = $show_pagination = $css = $columns_grid = $show_loadmore = $hide_featured = $pagi_style = $always_next_prev = $lmore_items = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__in' => $ids,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status'       => 'publish',
    );
}elseif(!empty($ids_not)){
    $ids_not = explode(",", $ids_not);
    $post_args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status'       => 'publish',
    );
}else{
    $post_args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status'       => 'publish',
    );
}





if(!empty($cat_ids))
    $post_args['cat'] = $cat_ids;


$css_classes = array(
    'fl-wrap posts-list-holder',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr($css_class );?>">
<?php 
    $blog_posts = new WP_Query($post_args);
    if($blog_posts->have_posts()) : ?>
        <?php while($blog_posts->have_posts()) : $blog_posts->the_post(); ?>

            <?php 
                if(balkon_get_option('blog_list_show_format')) {
                    get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
                }else{
                    get_template_part('content' );
                }   
            ?>

        <?php endwhile; ?>


        <?php
        if($show_pagination == 'yes')
        balkon_custom_pagination($blog_posts->max_num_pages,$range = 2, $blog_posts ,false);

        ?>

    <?php else: ?>

        <?php get_template_part('content','none' ); ?>

    <?php endif; ?> 

</div>
<div class="clearfix"></div>
<?php wp_reset_postdata();?>