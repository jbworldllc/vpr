<?php
/* add_ons_php */
$css = $el_class = $cat_ids = $cat_order = $cat_order_by = $order = $order_by = $ids = $ids_not = $show_filter = $posts_per_page = $columns_grid = $spacing = $show_info = 
$show_excerpt = $show_view_project = $enable_gallery = $view_all_link = $show_overlay = $show_pagination = $show_loadmore = $hoz_style = $show_cat = $show_counter = $show_share = $filter_width = $sidebar_filter = $sidebar_title = '';

$loadmore_posts = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'archive-portfolio-masonry-style-wrap grid-folio-main-wrap',
    'folio-masonry-style-'.$hoz_style.'-wrap',
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if($sidebar_filter == 'yes') $css_class .= ' folio-masonry-sidebar-filter';
?>


<div class="<?php echo esc_attr($css_class );?>">

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

    <?php    
    if($show_filter == 'yes') : 

        $term_args['taxonomy'] = 'portfolio_cat';

        $portfolio_cats = get_terms($term_args); 

    ?>
    <?php if(count($portfolio_cats)){

        if($sidebar_filter == 'yes') balkon_get_template_part('filter', 'folio-sidebar', array('portfolio_cats'=>$portfolio_cats,'show_counter'=>$show_counter,'filter_width'=>$filter_width, 'sidebar_title'=>$sidebar_title) ); 
        else balkon_get_template_part('filter', 'folio', array('portfolio_cats'=>$portfolio_cats,'show_counter'=>$show_counter,'filter_width'=>$filter_width) );

    }  ?>

<?php endif;?>

    


<?php $folio_posts = new WP_Query($post_args); 

if($folio_posts->have_posts()) : 

    $grid_cls = 'gallery-items folio-gallery';
    $grid_cls .= ' '.$columns_grid.'-columns';
    $grid_cls .= ' ver-'.$spacing.'-pad';

    //show load more
    if($show_loadmore == 'yes')
        $grid_cls .= ' use-loadmore';

    if($enable_gallery == 'yes') $grid_cls .= ' gallery_enabled lightgallery';
    else $grid_cls .= ' gallery_disabled';




    switch ($hoz_style) {
        case 'style2':
            $grid_cls .= ' vis-por-info';
            break;
        default:
            $grid_cls .= ' hid-por-info';
            break;
    }



    $additional_vars =  array(
        'show_view_project'=>$show_view_project,
        'show_cat'=>$show_cat,
        'show_excerpt'=>$show_excerpt,
    );

?>
<?php if($sidebar_filter == 'yes') : ?>
    <div class="folio-grid-folios-wrap fl-wrap column-content">
<?php else : ?>
    <div class="folio-grid-folios-wrap">
<?php endif;?>
        <div class="<?php echo esc_attr($grid_cls );?>" 
        <?php if( $show_loadmore == 'yes' && ( $posts_per_page != '-1' && $folio_posts->found_posts && $folio_posts->found_posts > $posts_per_page ) ):
        $lmore_data = $post_args;
        $lmore_data['action'] = 'balkon_lm_folio';
        $lmore_data['lmore_items'] = $loadmore_posts;
        $lmore_data['layout'] = 'masonry';// grid, ver, hoz
        $lmore_data['additional_vars'] = $additional_vars;
        ?>
         data-lm-request="<?php echo esc_url(admin_url( 'admin-ajax.php' ) ) ;?>"
         data-lm-nonce="<?php echo wp_create_nonce( 'balkon_lm_folio' ); ?>"
         data-lm-settings="<?php echo esc_attr(json_encode($lmore_data) ); ?>"
        <?php endif;?>
        >
            <div class="grid-sizer"></div>
            <div class="grid-sizer-second"></div>
            <div class="grid-sizer-three"></div>

            <?php while($folio_posts->have_posts()) : $folio_posts->the_post(); ?>
                
                <?php 
                balkon_get_template_part( 'portfolio', 'masonry' , $additional_vars ); 
                ?>

            <?php endwhile;?> 
            
        </div>
        <?php if( $show_pagination == 'yes' ) balkon_custom_pagination($folio_posts->max_num_pages, $range = 2, $folio_posts , false)  ;?>

        <?php if( $show_loadmore == 'yes' && ( $posts_per_page != '-1' && $folio_posts->found_posts && $folio_posts->found_posts > $posts_per_page ) ) : ?>
        <div class="folio-grid-lmore-holder">
            <a class="folio-load-more" data-click="1" data-remain="yes" href="#"><?php echo wp_kses(__('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>','balkon-add-ons'), array('i'=>array('class'=>array()),'span'=>array('class'=>array()),) );?></a>
        </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

</div>
<?php if($sidebar_filter == 'yes') echo '<div class="limit-box fl-wrap"></div>'; ?>
<?php wp_reset_postdata();?>

