<?php
/* add_ons_php */
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $galleryimgs
 * @var $columns
 * @var $spacing
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Images_Gallery_Masonry
 */
$css = $el_class = $galleryimgs = $columns = $spacing = $show_zoom = '';
$loaded = $show_loadmore = $lmore_items = $show_img_desc = $show_img_title = $thumbnail_size = $show_filter = $filter_list = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'balkon_images_gallery_wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
if($show_zoom != 'yes'){
    $css_classes[] =' gallery_disabled';
}
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );



if(!empty($galleryimgs)){
    $lmore_data = false;
    if($show_loadmore == 'yes'){
        $lmore_data = array();
        $lmore_data['images'] = $galleryimgs;
        $lmore_data['loaded'] = $loaded;
        $lmore_data['action'] = 'balkon_lm_gal';
        $lmore_data['lmore_items'] = $lmore_items;
        $lmore_data['show_img_title'] = $show_img_title;
        $lmore_data['show_img_desc'] = $show_img_desc;

    }

    $gal_imgs = explode(",", $galleryimgs);

    if(!empty($gal_imgs)) : 
        
        

        $gal_classes = 'gallery-items '. $columns.'-columns ver-'.$spacing.'-pad hid-por-info';

        if($show_zoom == 'yes')  $gal_classes .= ' lightgallery';
    ?>
    <div class="<?php echo esc_attr($css_class );?>">
        <?php
        if($show_filter == 'yes' && $filter_list != '') :
        ?>
        <div class="folio-grid-filter-wrap">
            <div class="images-filter-width">
                <div class="filter-holder inline-filter bold-filter fl-wrap">
                    <div class="filter-button"><span><?php esc_html_e('Filter : ','balkon-add-ons' );?></span></div>
                    <div class="gallery-filters">
                    <?php if(balkon_get_option('folio_filter_all')): ?>
                        <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"><?php esc_html_e('All Images','balkon-add-ons' );?></a>
                    <?php endif;?>
                        <?php
                        $filter_list = explode("|", $filter_list);
                        foreach($filter_list as $key => $fil) { ?>
                            <?php if(!balkon_get_option('folio_filter_all') && $key == 0 ): ?>
                                <a href="#" class="gallery-filter gallery-filter-active" data-filter=".<?php echo sanitize_title($fil ); ?>"><?php echo esc_html($fil ); ?></a>
                            <?php else : ?>
                                <a href="#" class="gallery-filter " data-filter=".<?php echo sanitize_title($fil ); ?>"><?php echo esc_html($fil ); ?></a>
                            <?php endif;?>
                        <?php } ?>
                    </div>
                    <div class="count-folio">
                        <div class="num-album"></div>
                        <div class="all-album"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif; ?>
        
        <div class="<?php echo esc_attr($gal_classes );?>" data-looped="1" 
        <?php if($show_loadmore == 'yes' && count($gal_imgs) > $loaded ):?>
         data-lm-request="<?php echo esc_url(admin_url( 'admin-ajax.php' ) ) ;?>"
         data-lm-nonce="<?php echo wp_create_nonce( 'balkon_lm_gal' ); ?>"
         data-lm-settings="<?php echo esc_attr(json_encode($lmore_data) ); ?>"
        <?php endif;?>>
            <div class="grid-sizer"></div>
            <?php foreach ($gal_imgs as $key => $img) { 
                if($key < $loaded) {

                    $at_img = get_post($img);

                    $at_tit = $at_img->post_title;
                    $at_cap = $at_img->post_excerpt;
                    $at_des = $at_img->post_content;

                    $item_filter = '';

                    if( preg_match_all('/-f-([^-]*)-f-/m', $at_cap, $matches ) !== false ){
                        if(!empty($matches[1])){
                            foreach ($matches[1] as $fil) {
                                $item_filter .= ' '.sanitize_title( $fil );
                            }
                        }
                    }

            ?>
            <div class="gallery-item <?php echo esc_attr( $item_filter );?>">
                <div class="grid-item-holder">
                    <div class="box-item">
                        <?php echo wp_get_attachment_image( $img, 'balkon_gallery_thumb'); ?>
                        <div class="overlay"></div>
                        
                        <a href="<?php echo esc_url( wp_get_attachment_url($img ) );?>" class="image-popup popup-image"><i class="fa fa-search"></i></a>
                    </div>
                    <?php if($show_img_title == 'yes' || $show_img_desc == 'yes' ) : ?>
                    <div class="grid-item">
                        <?php if($show_img_title == 'yes') : ?>
                        <h3><?php echo esc_html( $at_tit );?></h3>
                        <?php endif;?>
                        <?php if($show_img_desc == 'yes') echo wp_kses_post( $at_des ); ?>
                    </div>
                    <?php endif;?>
                </div>
            </div>
            <?php
                }
            } 

            ?> 

            
        </div>
        <?php if($show_loadmore == 'yes' && count($gal_imgs) > $loaded ):?>
        <div class="gallery-lmore-holder">
            <a class="gallery-load-more" data-click="1" data-remain="yes" href="#"><?php echo wp_kses(__('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>','balkon-add-ons'), array('i'=>array('class'=>array()),'span'=>array('class'=>array()),) );?></a>
        </div>
        <?php endif;?>

    </div>

    <?php
    endif;
}

?>