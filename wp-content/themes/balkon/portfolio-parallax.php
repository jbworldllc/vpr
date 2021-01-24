<?php
/* banner-php */
if(!isset($col_width)){
    $col_width = balkon_global_var('folio_parallax_colwidth');
}
if(!isset($first_side)){
    $first_side = balkon_global_var('folio_parallax_first');
}
if(!isset($parallax_value)){
    $parallax_value = balkon_global_var('folio_parallax_value');
}else{
    $parallax_value = stripslashes($parallax_value);
}

if(!isset($show_number)){
    $show_number = balkon_global_var('folio_parallax_number');
}elseif($show_number == 'yes'){
    $show_number = true;
}else{
    $show_number = false;
}
if(!isset($show_date)){
    $show_date = balkon_global_var('folio_parallax_date');
}elseif($show_date == 'yes'){
    $show_date = true;
}else{
    $show_date = false;
}
if(!isset($show_cat)){
    $show_cat = balkon_global_var('folio_parallax_cats');
}elseif($show_cat == 'yes'){
    $show_cat = true;
}else{
    $show_cat = false;
}
if(!isset($show_excerpt)){
    $show_excerpt = balkon_global_var('folio_parallax_excerpt');
}elseif($show_excerpt == 'yes'){
    $show_excerpt = true;
}else{
    $show_excerpt = false;
}
if(!isset($show_view_project)){
    $show_view_project = balkon_global_var('folio_parallax_tosingle');
}elseif($show_view_project == 'yes'){
    $show_view_project = true;
}else{
    $show_view_project = false;
}

$folio_video_link = get_post_meta(get_the_ID(), '_balkon_folio_video', true);
if(!isset($pin))  $pin = 1;
?>
    <?php 
    $col_cl = 'col-md-'.$col_width;
    if($first_side ==='left'){
        $is_dir = 'left';
        $text_side = 'right-pos';
        if($pin%2 == 0){
            //right
            $is_dir = 'right';
            $text_side = 'left-pos';
        }
    }elseif($first_side ==='right'){
        $is_dir = 'right';
        $text_side = 'left-pos';
        if($pin%2 == 0){
            //left
            $is_dir = 'left';
            $text_side = 'right-pos';
        }
    }else{
        $is_dir = 'center';
        $col_cl = 'col-md-'.$col_width.' col-md-offset-'.round((12-$col_width)/2, 0 , PHP_ROUND_HALF_DOWN);
        $text_side = 'center-pos right-pos';
        if($pin%2 == 0){
            $text_side = 'center-pos left-pos';
        }
    }
    ?>
<!-- <?php echo esc_attr($pin);?> -->
<div <?php post_class('gallery-item gallery-item-full folio-parallax');?>>
    <div class="row">
        <?php if($is_dir === 'right'):?>
        <div class="col-md-<?php echo esc_attr( 12 - $col_width );?>"></div>
        <?php endif;?>
        <div class="<?php echo esc_attr($col_cl );?>">
            <div class="parallax-item fl-wrap" data-scrollax-parent="true">
                <div class="parallax-header fl-wrap">
                <?php if($show_number) : ?>
                    <span><?php echo zeroise($pin, 2);?>.</span>
                <?php endif ; ?>
                    <?php if($show_date||$show_cat):?>
                        <ul>
                        <?php if($show_date):?>
                            <li><a href="#"><?php the_time( get_option('date_format') );?></a></li>
                        <?php endif;?>
                        <?php 
                        if($show_cat):
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
                </div>
                <?php if($folio_video_link!=""){ ?> 
                <div class="folio-para-video">
                    <div class="resp-video-holder">
                        <div class="resp-video">
                           <?php echo wp_oembed_get( $folio_video_link ); ?>
                        </div>
                    </div>
                </div>
                <?php }else { the_post_thumbnail( 'balkon_folio_thumb'); } ?>
                <div class="parallax-text <?php echo esc_attr($text_side );?>" data-scrollax="properties: { <?php echo esc_attr( $parallax_value );?> }">
                    <h3><a href="<?php the_permalink();?>"><?php the_title( );?></a></h3>
                    <?php if($show_excerpt){
                        the_excerpt();
                    }?>
                    <?php if($show_view_project):?>
                        <a href="<?php the_permalink();?>" class="btn float-btn flat-btn"><?php esc_html_e('View project','balkon');?></a>
                    <?php endif;?>                         
                </div>
            </div>
        </div>
        <?php if($is_dir === 'left'):?>
        <div class="col-md-<?php echo esc_attr( 12 - $col_width );?>"></div>
        <?php endif;?>
    </div>
    <!-- <?php echo esc_attr($pin);?> end-->
</div>