<?php
/* banner-php */

$folio_style = balkon_global_var('folio_style');
?>
<?php
if(is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$post_args = array(
    'post_type' => 'portfolio',
    'paged' => $paged,
    'posts_per_page'=> balkon_global_var('folio_posts_per_page'),
    'orderby'=> balkon_global_var('folio_archive_orderby'),
    'order'=> balkon_global_var('folio_archive_order'),

    'post_status'       => 'publish',
);

$folio_posts = new WP_Query($post_args);
?>

<?php if($folio_posts->have_posts()) : ?>
<?php
$css_classes = array(
    'archive-portfolio-masonry-style-wrap grid-folio-main-wrap folio-masonry-sidebar',
    'folio-masonry-style-'.$folio_style.'-wrap'
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr($css_class );?>" id="sec1">
    
    <?php 

    if( balkon_global_var('folio_show_filter') ) : 

        $term_args = array(
            'orderby'           => balkon_global_var('folio_filter_orderby'),
            'order'             => balkon_global_var('folio_filter_order'),
      
        ); 

        $term_args['taxonomy'] = 'portfolio_cat';

        $portfolio_cats = get_terms($term_args); 

    ?>
    <div class="fixed-filter-wrap">
        <div class="partcile-dec" data-count="110" data-color="#ccc"></div>
        <div class="fixed-filter fl-wrap">
            <h3 class="fixed-sec-title"><?php echo wp_kses_post( balkon_global_var('folio_head_title') );?></h3>
            <div class="bold-separator"></div>
            <div class="filter-button hid-filt-button"><?php esc_html_e('Filter','balkon' );?></div>
            <div class="gallery-filters">
            <?php if(balkon_global_var('folio_filter_all')): ?>
                <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"><?php esc_html_e('All Works','balkon' );?></a>
            <?php endif;?>
                <?php $key = 0; foreach($portfolio_cats as $portfolio_cat) { ?>
                    <?php if(!balkon_global_var('folio_filter_all') && $key == 0 ): ?>
                        <a href="#" class="gallery-filter gallery-filter-active" data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
                    <?php else : ?>
                        <a href="#" class="gallery-filter " data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
                    <?php endif;?>
                <?php $key++; } ?>
            </div>
            <div class="clearfix"></div>
            <?php if( balkon_global_var('folio_show_counter') ) : ?>
            <div class="count-folio clearfix">
                <div class="num-album"></div>
                <div class="all-album"></div>
            </div>
            <?php endif;?>
        </div>
    </div>
    <?php 
    endif; //end showfillter
    ?>
    <div class="fl-wrap column-content">
        <?php
        $grid_cls = 'gallery-items folio-gallery';
        $grid_cls .= ' '.balkon_global_var('folio_column').'-columns';
        $grid_cls .= ' ver-'.balkon_global_var('folio_pad').'-pad';

        //show load more
        if(balkon_global_var('folio_show_loadmore'))
            $grid_cls .= ' use-loadmore';

        if(balkon_global_var('folio_enable_gallery')) $grid_cls .= ' gallery_enabled lightgallery';
        else $grid_cls .= ' gallery_disabled';




        switch ($folio_style) {
            case 'style2':
                $grid_cls .= ' vis-por-info';
                break;
            default:
                $grid_cls .= ' hid-por-info';
                break;
        }
        ?>
        <div class="folio-grid-folios-wrap fogrid-<?php echo esc_attr( balkon_global_var('folio_grid_content_width') );?>">

                <div class="<?php echo esc_attr($grid_cls );?>" 
                <?php if( balkon_global_var('folio_use_pagi_infinite') && (balkon_global_var('folio_posts_per_page') != '-1' && $folio_posts->found_posts && $folio_posts->found_posts > balkon_global_var('folio_posts_per_page') ) ):
                $lmore_data = $post_args;
                $lmore_data['action'] = 'balkon_lm_folio';
                $lmore_data['lmore_items'] = balkon_global_var('folio_loadmore_items');
                $lmore_data['layout'] = 'masonry';// grid, ver, hoz
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
                        
                        <?php get_template_part( 'portfolio', 'masonry' ); ?>

                    <?php endwhile;?>   
                </div>

                <?php if( balkon_global_var('folio_show_pagination') ) balkon_custom_pagination($folio_posts->max_num_pages, $range = 2, $folio_posts , false)  ;?>
                
                <?php if( balkon_global_var('folio_use_pagi_infinite') && (balkon_global_var('folio_posts_per_page') != '-1' && $folio_posts->found_posts && $folio_posts->found_posts > balkon_global_var('folio_posts_per_page') ) ): ?>
                <div class="folio-grid-lmore-holder">
                    <a class="folio-load-more" data-click="1" data-remain="yes" href="#"><?php echo wp_kses(__('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>','balkon'), array('i'=>array('class'=>array()),'span'=>array('class'=>array()),) );?></a>
                </div>
                <?php endif; ?>
                
        </div>
    </div>
</div>
<?php endif;?>
<?php wp_reset_postdata(); ?>

<?php echo wp_kses_post( balkon_global_var('folio_after_grid_content') ); ?>

</div>
<div class="limit-box fl-wrap"></div>
