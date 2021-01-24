<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $cat_ids
 * @var $cat_order_by
 * @var $cat_order
 * @var $order
 * @var $order_by
 * @var $ids
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Portfolios
 */
$css = $el_class = $cat_ids = $cat_order = $cat_order_by = $order = $order_by = $ids = $ids_not = $show_filter = $posts_per_page = $columns_grid = $spacing = $show_info = 
$show_excerpt = $show_view_project = $enable_gallery = $view_all_link = $show_overlay = $show_pagination = $show_loadmore = $hoz_style = $show_cat = $show_counter = $show_share = '';
$loadmore_posts = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'horizontal-folio-main-wrap resize-carousel-holder hpw',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

switch ($hoz_style) {
    case 'two':
        $css_class .= ' folio-style-two-wrap';
        break;
    
    case 'three':
        $css_class .= ' folio-style-three-wrap';
        break;

    default:
        $css_class .= '  no-authei no-autfg folio-style-one-wrap';
        break;
}

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
        $portfolio_args = array(
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
        $portfolio_args = array(
            'post_type' => 'portfolio',
            'paged' => $paged,
            'posts_per_page'=> $posts_per_page,
            'post__not_in' => $ids_not,
            'orderby'=> $order_by,
            'order'=> $order,

            'post_status'       => 'publish',
        );
    }else{
        $portfolio_args = array(
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
        $portfolio_args['tax_query'][] = array(
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

$portfolios = new WP_Query($portfolio_args); 

if($portfolios->have_posts()) : 
    
?>



    <div class="fixed-panel fixed-filter">
        <?php    
        if($show_filter == 'yes') : 

            $term_args['taxonomy'] = 'portfolio_cat';

            $portfolio_cats = get_terms($term_args); 

        ?>
        <?php if(count($portfolio_cats)): ?>
        <div class="filter-button"><?php esc_html_e('Filter','balkon-add-ons' );?></div>
        <div class="gallery-filters ">
            <span><?php esc_html_e('Filter: ','balkon-add-ons' );?></span>
            <a href="#" class="gallery-filter transition2 gallery-filter_active" data-filter="*"><?php esc_html_e('All','balkon-add-ons' );?></a>
            <?php foreach($portfolio_cats as $portfolio_cat) { ?>
            <a href="#" class="gallery-filter transition2" data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
            <?php } ?> 
        </div>
        <?php endif; 
        endif; //end showfillter
        ?>
        <?php if($show_counter === 'yes') :?>
        <div class="folio-counter inline-counter">
            <div class="num-album"></div>
            <div class="all-album"></div>
            <?php echo wp_kses_post( '<i class="fa fa-align-right"></i>' );?>
            
        </div>
        <?php endif;?>

        <?php if( balkon_get_option('share_names') != '' && $show_share === 'yes' ): ?>
        <div class="share-holder hid-share ">
            <div class="showshare"><span><?php esc_html_e('Share ','balkon-add-ons' );?></span><i class="fa fa-bullhorn"></i></div>
            <div class="share-container  isShare" data-share="['<?php echo esc_attr( implode("','", array_map("trim",explode(",", balkon_get_option('share_names') ) ) ) );?>']"></div>
        </div>
        <?php endif;?>
    </div>

<?php 

$grid_cls = 'folio-gallery';
$grid_cls .= ' '.$columns_grid.'-ver-columns';
$grid_cls .= ' hoz-'.$spacing.'-pad';

//show load more
if($show_loadmore == 'yes')
    $grid_cls .= ' use-loadmore';

if($enable_gallery == 'yes')
    $grid_cls .= ' gallery_enabled';

switch ($hoz_style) {
    case 'two':
        $grid_cls .= ' vis-desc';
        $hoz_style_page = 'style2';
        break;
    
    case 'three':
        $grid_cls .= ' hde';
        $hoz_style_page = 'style3';
        break;

    default:
        $grid_cls .= ' hid-desc';
        $hoz_style_page = 'style1';
        break;
}
$additional_vars =  array(
        'enable_gallery'=>$enable_gallery,
        'show_view_project'=>$show_view_project,
        'show_cat'=>$show_cat,
        'show_excerpt'=>$show_excerpt,
    );
?>

    <div class="p_horizontal_wrap res-protoc hoz-wrap-<?php echo esc_attr($spacing ) ;?>-pad">
        <div id="portfolio_horizontal_container"  class="mb-ath folio-hoz-gallery <?php echo esc_attr($grid_cls );?>" 
        <?php if( $show_loadmore == 'yes' && ( $posts_per_page != '-1' && $portfolios->found_posts && $portfolios->found_posts > $posts_per_page ) ):
        $lmore_data = $portfolio_args;
        $lmore_data['action'] = 'balkon_lm_folio';
        $lmore_data['lmore_items'] = $loadmore_posts;
        $lmore_data['layout'] = 'hoz';// grid, ver, hoz
        $lmore_data['additional_vars'] = $additional_vars;
        $lmore_data['folio_style'] = $hoz_style_page;
        ?>
         data-lm-request="<?php echo esc_url(admin_url( 'admin-ajax.php' ) ) ;?>"
         data-lm-nonce="<?php echo wp_create_nonce( 'balkon_lm_folio' ); ?>"
         data-lm-settings="<?php echo esc_attr(json_encode($lmore_data) ); ?>"
        <?php endif;?>
        >
            <?php while($portfolios->have_posts()) : $portfolios->the_post(); ?>
                
                <?php balkon_get_template_part( 'portfolio-hoz', $hoz_style_page , $additional_vars ); ?>

            <?php endwhile;?>

            <?php if( $show_loadmore == 'yes' && ( $posts_per_page != '-1' && $portfolios->found_posts && $portfolios->found_posts > $posts_per_page ) ): ?>
                <div class="hoz-folio-lmore-holder">
                    <a class="hoz-folio-load-more" data-remain="yes" data-click="1" href="#"><?php echo wp_kses(__('<i class="fa fa-spinner fa-pulse"></i> <span class="sr-only">Loading...</span>','balkon-add-ons'), array('i'=>array('class'=>array()),'span'=>array('class'=>array()),) );?></a>
                </div>  
            <?php endif; ?> 

        </div>
    </div>
<?php endif; ?>

</div>
<div class="clearfix"></div>
<?php wp_reset_postdata();?>

