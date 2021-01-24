<?php
/* add_ons_php */
$el_class = $css = $cat_ids = $order = $order_by = $ids = $posts_per_page = $show_date = $show_cat = $show_excerpt = $show_view_project = '';
$mousewheel = $keyboard = $autoplay = $loop = $direction = $speed = $effect = $slideimages = $disable_zoom = $show_scrollbar = $show_nav = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'portfolios_carousel-wrap',
    'slider-wrap homecarousel lightgallery lg-synk',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
if($disable_zoom == 'yes'){
    $css_classes[] =' disa-zoom';
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

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

    $post_args['tax_query'][] = array(
        'taxonomy' => 'portfolio_cat',
        'field' => 'term_id',
        'terms' => explode(",", $cat_ids),
        'operator' => 'NOT IN',
    );
}

     
$folio_posts = new WP_Query($post_args); 

if($folio_posts->have_posts()) : 
    $dataArr = array();
    $dataArr['speed'] = (int)$speed;
    $dataArr['direction'] = $direction;
    if(is_numeric($autoplay)) $dataArr['autoplay'] = (int)$autoplay;
    if($loop == 'yes') $dataArr['loop'] = true;
    if($mousewheel == 'yes') $dataArr['mousewheelControl'] = true;
    if($keyboard == 'yes') $dataArr['keyboardControl'] = true;
    $dataArr['effect'] = $effect;   
?>
<div class="<?php echo esc_attr($css_class );?>" data-opts='<?php echo json_encode($dataArr);?>'>
    <div class="swiper-container" data-scrollax-parent="true">
        <div class="swiper-wrapper">
            <?php while($folio_posts->have_posts()) : $folio_posts->the_post(); ?>
            <div class="swiper-slide">
                <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( ) );?>" class=" gallery-popup popgal"><i class="fa fa-search"></i></a>
                <?php the_post_thumbnail( 'balkon_hoz_thumb', array('class'=> 'balkon-carousel-img') );?>
                <div class="thumb-info">
                    <?php if($show_date == 'yes'||$show_cat == 'yes'):?>
                        <ul>
                        <?php if($show_date == 'yes'):?>
                            <li><a href="#"><?php the_time( get_option('date_format') );?></a></li>
                        <?php endif;?>
                        <?php 
                        if($show_cat == 'yes'):
                        $terms = get_the_terms(get_the_ID(), 'portfolio_cat');
                        if ( $terms && ! is_wp_error( $terms ) ){
                            foreach( $terms as $key => $term){
                                
                                echo sprintf( '<li><a href="%1$s">%2$s</a></li>',
                                    esc_url( get_term_link( $term->slug, 'portfolio_cat' ) ),
                                    esc_html( $term->name )
                                );
                            }
                        }
                        ?>
                        <?php endif;?>
                        </ul>
                    <?php endif;?> 
                    <h3><a href="<?php the_permalink( );?>"><?php the_title( );?></a></h3>
                    <?php if($show_excerpt == 'yes'){
                        the_excerpt();
                    }?>
                    <?php if($show_view_project == 'yes'):?>
                    <a href="<?php the_permalink( );?>" class="btn float-btn flat-btn"><?php esc_html_e('View Project','balkon-add-ons' );?></a>
                    <?php endif;?>
                </div>
            </div>
            <?php endwhile;?>
        </div>
        <?php 
        if($show_nav == 'yes') : ?>
        <div class="sw-button swiper-button-next"><i class="fa fa-angle-right"></i></div>
        <div class="sw-button swiper-button-prev"><i class="fa fa-angle-left"></i></div>
        <?php endif;?>
        <?php 
        if($show_scrollbar == 'yes') : ?>
        <div class="swiper-scrollbar"></div>
        <?php endif;?>
    </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata();?>
