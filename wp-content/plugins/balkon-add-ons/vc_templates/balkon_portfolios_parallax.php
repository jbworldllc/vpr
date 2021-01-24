<?php
/* add_ons_php */
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $cat_ids
 * @var $cat_order_by
 * @var $cat_order
 * @var $order
 * @var $order_by
 * @var $ids
 * @var $first_side
 * @var $show_date
 * @var $show_cat
 * @var $show_excerpt
 * @var $show_view_project
 * @var $view_all_link
 * @var $parallax_value
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Portfolios_Parallax
 */
$el_class = $css = $cat_ids = $cat_order = $cat_order_by = $order = $order_by = $ids = $ids_not = $show_filter = $show_counter = $filter_width = $posts_per_page = $columns_grid = $spacing = $show_info = $first_side = $view_all_link = $show_date = $show_cat = $show_excerpt = $show_view_project = $parallax_value = $show_number = $col_width = '';
$show_loadmore = $loadmore_posts = $show_pagination = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'portfolio_parallax-wrap',
    'folio-grid-folios-wrap',//for infites croll
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if( empty($col_width)) {
	$col_width = '6';
}
?>
<?php 
    if(is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }
    if(!empty($ids)){
        $ids = explode(",", $ids);
        $post_args = array(
            'post_type' => 'portfolio',
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
            'post_type' => 'portfolio',
            'paged' => $paged,
            'posts_per_page'=> $posts_per_page,
            'post__not_in' => $ids_not,
            'orderby'=> $order_by,
            'order'=> $order,

            'post_status'       => 'publish',
        );
    }else{
        $post_args = array(
            'post_type' => 'portfolio',
            'paged' => $paged,
            'posts_per_page'=> $posts_per_page,
            'orderby'=> $order_by,
            'order'=> $order,

            'post_status'       => 'publish',
        );
    }
    
    if(!empty($cat_ids)){
        $term_args = array(
            'orderby'           => $cat_order_by, 
            'order'             => $cat_order,
            'exclude'           => $cat_ids,
            'parent'            => 0,
            
        ); 
        $post_args['tax_query'][] = array(
            'taxonomy' => 'portfolio_cat',
            'field' => 'term_id',
            'terms' => explode(",", $cat_ids),
            'operator' => 'NOT IN',
        );
    }else{
        $term_args = array(
            'orderby'           => $cat_order_by, 
            'order'             => $cat_order,
            'parent' => 0,
            
        ); 
    }

?>

<?php $folio_posts = new WP_Query($post_args); 

if($folio_posts->have_posts()) : 
    $grid_cls = 'gallery-items';

    //show load more
    if($show_loadmore == 'yes')
        $grid_cls .= ' use-loadmore';

    $additional_vars = array(
        'col_width' => $col_width,
        'first_side' => $first_side,
        'parallax_value' => $parallax_value,
        'show_number' => $show_number,
        'show_date' => $show_date,
        'show_cat' => $show_cat,
        'show_excerpt' => $show_excerpt,
        'show_view_project' => $show_view_project,
    );

?>
<div class="<?php echo esc_attr($css_class );?>">
    <?php    
    if($show_filter == 'yes') : 

        $term_args['taxonomy'] = 'portfolio_cat';

        $portfolio_cats = get_terms($term_args); 

    ?>
    <?php if(count($portfolio_cats)){

        
        balkon_get_template_part('filter', 'folio', array('portfolio_cats'=>$portfolio_cats,'show_counter'=>$show_counter,'filter_width'=>$filter_width) );

    }  ?>

    <?php endif;?>

    <div class="<?php echo esc_attr($grid_cls );?>" 
        <?php if( $show_loadmore == 'yes' && ( $posts_per_page != '-1' && $folio_posts->found_posts && $folio_posts->found_posts > $posts_per_page ) ):
        $lmore_data = $post_args;
        $lmore_data['action'] = 'balkon_lm_folio';
        $lmore_data['lmore_items'] = $loadmore_posts;
        $lmore_data['additional_vars'] = $additional_vars;
        $lmore_data['layout'] = 'parallax';// grid, ver, hoz
        ?>
         data-lm-request="<?php echo esc_url(admin_url( 'admin-ajax.php' ) ) ;?>"
         data-lm-nonce="<?php echo wp_create_nonce( 'balkon_lm_folio' ); ?>"
         data-lm-settings="<?php echo esc_attr( json_encode($lmore_data) ); ?>"
        <?php endif;?>>
            <div class="grid-sizer"></div>

            <?php $pin = 1; while($folio_posts->have_posts()) : $folio_posts->the_post(); ?>
                

                <?php 
                $additional_vars['pin'] = $pin;
                balkon_get_template_part('portfolio', 'parallax', $additional_vars); 



                ?>

            <?php $pin++; endwhile;?>

            

    </div>

    <?php if( $show_pagination == 'yes' ) balkon_custom_pagination($folio_posts->max_num_pages, $range = 2, $folio_posts , false)  ;?>

    <?php if( $show_loadmore == 'yes' && ( $posts_per_page != '-1' && $folio_posts->found_posts && $folio_posts->found_posts > $posts_per_page ) ) : ?>
    <div class="folio-grid-lmore-holder">
        <a class="folio-load-more" data-click="1" data-remain="yes" href="#"><?php echo wp_kses(__('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>','balkon-add-ons'), array('i'=>array('class'=>array()),'span'=>array('class'=>array()),) );?></a>
    </div>
    <?php endif; ?>
                                        
</div>
<?php if(!empty($view_all_link)):?>
    <div class="custom-link-holder folio-para-view-all">
        <a href="<?php echo esc_url($view_all_link );?>" class="btn float-btn flat-btn" ><?php esc_html_e('View All Projects','balkon-add-ons');?></a>   
    </div>
    <?php endif;?>  
<div class="cleafix"></div>
<?php endif; ?>
<?php wp_reset_postdata();?>
